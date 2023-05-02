<?php defined('BASEPATH') or exit('No direct script access allowed');

class Myfatoorah extends My_Controller
{
    public function __construct()
    {
        parent::__construct();
        require_once(module_dirPath(FATOO_MODULE_NAME, 'libraries/myfatoorah/PaymentMyfatoorahApiV2.php'));
        $apiKey = config_item('myfatoorah_apikey');
      
        if (config_item('myfatoorah_test_mode') == TRUE) {
            $this->MyfatoorahPayment = new PaymentMyfatoorahApiV2($apiKey, true);
        } else {
            $this->MyfatoorahPayment = new PaymentMyfatoorahApiV2($apiKey, false);
        }
        $this->view = 'admin/';
    }
    
    
    public function pay($invoice_id)
    {
        if (isset($invoice_id)) {
            $invoice_info = $this->invoice_model->check_by(array('invoices_id' => $invoice_id), 'tbl_invoices');
        } else {
            exit('Invoice ID is not set');
        }
        $data['breadcrumbs'] = lang('myfatoorah');
        $data['title'] = lang('make_payment');
        $data['PaymentMethods'] = $this->initiate();
        $client_info = get_row('tbl_client', array('client_id' => $invoice_info->client_id));
        
        $invoice_due = $this->invoice_model->calculate_to('invoice_due', $invoice_id);
        if ($invoice_due <= 0) {
            $invoice_due = 0.00;
        }
        
        $data['invoice_info'] = array(
            'item_name' => $invoice_info->reference_no,
            'item_number' => $invoice_id,
            'currency' => $invoice_info->currency,
            'amount' => $invoice_due
        );
        
        $allow_customer_edit_amount = config_item('allow_customer_edit_amount');
        
        if (!empty($allow_customer_edit_amount) && $allow_customer_edit_amount == 'No') {
            $InvoiceValue = $invoice_due;
        } else {
            $InvoiceValue = $this->input->post('amount');
        }
        $PaymentMethodId = $this->input->post('PaymentMethodId');
        
        if (!empty($PaymentMethodId)) {
            $apiKey = config_item('myfatoorah_apikey');
            
            $token = $apiKey;
            if (config_item('myfatoorah_test_mode') == TRUE) {
                $basURL = "https://apitest.myfatoorah.com";
            } else {
                $basURL = "https://api.myfatoorah.com";
            }
            $CallBackUrl = base_url() . "myfatoorah/get_pay_status/" . $invoice_id;
            $ErrorUrl = base_url() . "myfatoorah/pay_error/" . $invoice_id;
            
            if (config_item('default_language') == 'arabic') {
                $lang = 'ar';
            } else {
                $lang = 'en';
            }
            
            
            $to_data = array();
            $to_data['PaymentMethodId'] = $PaymentMethodId;
            $to_data['CustomerName'] = $client_info->name;
            $to_data['DisplayCurrencyIso'] = $invoice_info->currency;
            $mobile_arr = $this->MyfatoorahPayment->getPhone($client_info->mobile);
            if (!empty($mobile_arr)) {
                $to_data['MobileCountryCode'] = $mobile_arr[0];
                $to_data['CustomerMobile'] = $mobile_arr[1];
            }
            $to_data['CustomerEmail'] = $client_info->email;
            $to_data['InvoiceValue'] = $InvoiceValue;
            $to_data['CallBackUrl'] = $CallBackUrl;
            $to_data['ErrorUrl'] = $ErrorUrl;
            $to_data['Language'] = $lang;
            $to_data['CustomerReference'] = $invoice_info->invoices_id;
            $to_data['CustomerCivilId'] = '123456';
            $to_data['UserDefinedField'] = 'custom field';
            $to_data['ExpireDate'] = '';
            $to_data['CustomerAddress'] = [
                'address' => $client_info->address
            ];
            
            $to_data['InvoiceItems'] = [
                [
                    "ItemName" => $invoice_info->reference_no,
                    "Quantity" => 1,
                    "UnitPrice" => $InvoiceValue
                ]
            ];
            
            $CURLOPT_POSTFIELDS = json_encode($to_data);
            //####### Execute Payment ######
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => "$basURL/v2/ExecutePayment",
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => $CURLOPT_POSTFIELDS,
                CURLOPT_HTTPHEADER => array("Authorization: Bearer $token", "Content-Type: application/json"),
            ));
            
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            
            if ($err) {
                echo "cURL Error #:" . $err;
            } else {
                $response = json_decode($response, true);
                if ($response['IsSuccess'] === true) {
                    header("Location: " . $response['Data']['PaymentURL']);
                    die();
                } else {
                    $error = '';
                    $returned_errors = array_column($response['ValidationErrors'], 'Error');
                    $error .= implode("</br>", $returned_errors);
                    if (empty($error)) {
                        $error .= $response['Message'];
                    }
                    $data['error'] = $error;
                }
            }
        }
        $data['url'] = '';
        $data['subview'] = $this->load->view('myfatoorah_pay', $data, true);
        $this->load->view('client/_layout_main', $data);
    }
    
    public function initiate()
    {
        $PaymentMethods = $this->MyfatoorahPayment->getVendorGatewaysByType();
        return $PaymentMethods;
    }
    
    
    public function get_pay_status($invoices_id)
    {
        $paymentId = $this->input->get('paymentId');
        if (!isset($paymentId)) {
            set_message('error', ' the payment id is missing ');
        } else {
            $res = $this->MyfatoorahPayment->getPaymentStatus($paymentId, 'paymentId', $invoices_id);
            if ($res->IsSuccess === true) {
                $trans_id = $res->Data->InvoiceId;
                $amount = $res->Data->InvoiceValue;
                $this->addPayment($invoices_id, $amount, $trans_id, 'myfatoorah');
            } else {
                set_message('error', ' the payment is ' . $res->InvoiceStatus);
            }
        }
        $client_id = $this->session->userdata('client_id');
        if (!empty($client_id)) {
            redirect('client/dashboard');
        } else {
            redirect('frontend/view_invoice/' . url_encode($invoices_id));
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
    
    public function pay_error($invoices_id)
    {
        
        $paymentId = $this->input->get('paymentId');
        if (!isset($paymentId)) {
            $erro_msg = 'something is wrong: Payment was not made';
            //exit;
        }
        $erro_msg = 'something is wrong: Payment was not made';
        set_message('error', $erro_msg);
        $client_id = $this->session->userdata('client_id');
        if (!empty($client_id)) {
            redirect('client/dashboard');
        } else {
            redirect('frontend/view_invoice/' . url_encode($invoices_id));
        }
    }
}
