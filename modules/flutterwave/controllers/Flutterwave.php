<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Flutterwave extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('invoice_model');
        $this->callback_url = base_url() . 'flutterwave/callback';
    }


    public function pay($invoice_id)
    {
        if (isset($invoice_id)) {
            $invoice_info = $this->invoice_model->check_by(array('invoices_id' => $invoice_id), 'tbl_invoices');
        } else {
            exit('Invoice ID is not set');
        }
        $data['breadcrumbs'] = lang('paystack');
        $data['title'] = lang('make_payment');
        $invoice_due = $this->invoice_model->calculate_to('invoice_due', $invoice_id);
        if ($invoice_due <= 0) {
            $invoice_due = 0.00;
        }
        // check if the invoice due is decimal or not
        if (strpos($invoice_due, '.') == false) {
            $invoice_due = number_format($invoice_due, 2, '.', '');
        }


        $data['invoice_info'] = array(
            'item_name' => $invoice_info->reference_no,
            'item_number' => $invoice_id,
            'currency' => $invoice_info->currency,
            'amount' => $invoice_due
        );

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div>', '</div>');
        $this->form_validation->set_rules('reference_no', lang('reference_no'), 'trim|required');
        $this->form_validation->set_rules('amount', lang('amount'), 'trim|required|decimal|callback_check_amount[' . $invoice_due . ']');
        if ($this->form_validation->run() == true) {
            $client_info = get_row('tbl_client', array('client_id' => $invoice_info->client_id));
            $allow_customer_edit_amount = config_item('allow_customer_edit_amount');

            if (!empty($allow_customer_edit_amount) && $allow_customer_edit_amount == 'No') {
                $InvoiceValue = $invoice_due;
            } else {
                $InvoiceValue = $this->input->post('amount');
            }

            if (!empty($InvoiceValue)) {
                $to_data['invoice_id'] = $invoice_id;
                $to_data['email'] = $client_info->email;
                $to_data['amount'] = $InvoiceValue;
                $tranx = $this->initialize($to_data);
                $msg = str_replace('"', '', $tranx->message);
                set_message('error', 'API returned error: ' . $msg); //exit;
            }
        }

        if (!empty(validation_errors())) {
            $type = "error";
            $msg  = '';
            foreach ($this->input->post() as $k => $v) {
                $msg  .= form_error($k, '', '</br>');
            }
            if (empty($msg)) {
                $msg  = 'some thing wrong';
            }
            set_message($type, $msg);
        }

        $data['url'] = '';
        $data['subview'] = $this->load->view('pay', $data, true);
        $this->load->view('client/_layout_main', $data);
    }


    public function check_amount($paid_amount, $due)
    {
        if ($paid_amount <= 0) {
            $this->form_validation->set_message('check_amount', lang('amount_not_zero_neg'));
            return false;
        }
        if ($paid_amount > $due) {
            $this->form_validation->set_message('check_amount', lang('overpaid_amount'));
            return false;
        }

        return true;
    }

    public function initialize($to_data = array())
    {
        if (!empty($to_data['amount'])) {
            $email = $_POST['email'];
            $amount = $_POST['amount'];

            $email =  $to_data['email'];
            $amount =  $to_data['amount'];
            $invoice_id =  $to_data['invoice_id'];
            $callback_url = $this->callback_url . '/' . $invoice_id;

            //* Prepare our rave request
            $request = [
                'tx_ref' => time(),
                'amount' => $amount,
                'currency' => 'NGN',
                'payment_options' => 'card',
                'redirect_url' => $callback_url,
                'customer' => [
                    'email' => $email,
                    'name' => 'ZiscoERP Customer Name'
                ],
                'meta' => [
                    'price' => $amount
                ],
                'customizations' => [
                    'title' => 'Paying for a sample product',
                    'description' => 'sample'
                ]
            ];

            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.flutterwave.com/v3/payments',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($request),
                CURLOPT_HTTPHEADER => array(
                    "authorization: Bearer " . config_item('flutterwave_secret_key'),
                    "content-type: application/json",
                    "cache-control: no-cache"
                ),
            ));

            $response = curl_exec($curl);
            curl_close($curl);

            $res = json_decode($response);
            if ($res->status == 'success') {
                $link = $res->data->link;
                header('Location: ' . $link);
            } else {
                return $res;
            }
        }
    }


    public function callback($invoices_id)
    {
        if (isset($_GET['status'])) {
            if ($_GET['status'] == 'cancelled') {
                set_message('error', lang('cancelled_payment'));
                redirect('flutterwave/pay/' . $invoices_id);
            } elseif ($_GET['status'] == 'successful') {
                $txid = $_GET['transaction_id'];
                $curl = curl_init();
                curl_setopt_array($curl, array(
                    CURLOPT_URL => "https://api.flutterwave.com/v3/transactions/" . $txid . "/verify",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HTTPHEADER => [
                        "accept: application/json",
                        "authorization: Bearer " . config_item('flutterwave_secret_key'),
                        "cache-control: no-cache"
                    ],
                ));

                $response = curl_exec($curl);
                $err = curl_error($curl);

                if ($err) {
                    // there was an error contacting the Paystack API
                    $msg = 'Curl returned error: ' . $err;
                    set_message('error', $msg);
                    redirect('flutterwave/pay/' . $invoices_id);
                }
                $tranx = json_decode($response);

                if (!$tranx->status) {
                    $msg = 'API returned error: ' . $tranx->message;
                    set_message('error', $msg);
                    redirect('flutterwave/pay/' . $invoices_id);
                }
                if ('success' == $tranx->status) {
                    $amount = $tranx->data->amount;
                    $trans_id = $tranx->data->id;
                    $reference = $tranx->data->tx_ref;
                    $currency = $tranx->data->currency;
                    $this->addPayment($invoices_id, $amount, $trans_id, 'flutterwave');
                }
            }
        }
    }


    public function addPayment($invoices_id, $amount, $trans_id = null, $gateway = null)
    {
        $this->load->model('payments_model');
        $result = $this->payments_model->addPayment($invoices_id, $amount, $trans_id, $gateway);
        if ($result['type'] == 'success') {
            set_message($result['type'], $result['message']);
        } else {
            set_message($result['type'], $result['message']);
        }
        $client_id = $this->session->userdata('client_id');
        if (!empty($client_id)) {
            redirect('client/dashboard');
        } else {
            redirect('frontend/view_invoice/' . url_encode($invoices_id));
        }
    }
}
