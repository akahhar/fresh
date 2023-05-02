<?php

defined('BASEPATH') or exit('No direct script access allowed');

use Omnipay\Omnipay;

require_once(APPPATH . 'third_party/omnipay/vendor/autoload.php');


class Paypal_payment extends Saas_payment
{
    public function __construct()
    {
        /**
         * Call App_gateway __construct function
         */
        parent::__construct();
        /**
         * REQUIRED
         * Gateway unique id
         * The ID must be alpha/alphanumeric
         */
        $this->setId('paypal');

        /**
         * REQUIRED
         * Gateway name
         */
        $this->setName('Paypal');


        /**
         * REQUIRED
         * Hook gateway with other online payment modes
         */
//        add_action('before_add_online_payment_modes', [$this, 'initMode']);
    }

    /**
     * REQUIRED FUNCTION
     * @param array $data
     * @return mixed
     */
    public function proceedPayment($data)
    {
        if (ConfigItems('website_name') == '') {
            $company_name = ConfigItems('saas_company_name');
        } else {
            $company_name = ConfigItems('saas_website_name');
        }
        if (ConfigItems('saas_paypal_live') == 'TRUE') {
            $mode = '';
        } else {
            $mode = 'TRUE';
        }
        // Process online for PayPal payment start
        $gateway = Omnipay::create('PayPal_Express');
        $gateway->setUsername(ConfigItems('saas_paypal_api_username'));
        $gateway->setPassword(decrypt(ConfigItems('saas_paypal_api_password')));
        $gateway->setSignature(ConfigItems('saas_api_signature'));
        $gateway->setTestMode($mode);
        $logoURL = base_url(ConfigItems('saas_company_logo'));
        if ($logoURL != '' && _startsWith(site_url(), 'https://')) {
            $gateway->setlogoImageUrl($logoURL);
        }
        $gateway->setbrandName($company_name);
        $amount = (!empty($data['total_amount'])) ? $data['total_amount'] : $data['amount'];
        $data['currency'] = (!empty($data['currency'])) ? $data['currency'] : ConfigItems('saas_default_currency');
        $request_data = [
            'amount' => $amount,
            'returnUrl' => base_url('completePaypalPayment/' . $data['companies_id']),
            'cancelUrl' => $_SERVER["HTTP_REFERER"],
            'currency' => $data['currency'],
            'description' => lang('paypal_redirection_alert') . ' ' . $amount . ' ' . $data['currency']];
        try {
            $response = $gateway->purchase($request_data)->send();
            if ($response->isRedirect()) {
                $this->ci->session->set_userdata([
                    'input_info' => $data,
                    'reference_no' => $response->getTransactionReference(),
                ]);
                $response->redirect();
            } else {
                exit($response->getMessage());
            }
        } catch (\Exception $e) {
            echo $e->getMessage() . '<br />';
            exit('Sorry, there was an error processing your payment. Please try again later.');
        }
    }

    /**
     * Custom function to complete the payment after user is returned from paypal
     * @param array $data
     * @return mixed
     */
    public function complete_purchase($data)
    {
        if (ConfigItems('saas_paypal_live') == 'TRUE') {
            $mode = '';
        } else {
            $mode = 'TRUE';
        }
        $gateway = Omnipay::create('PayPal_Express');
        $gateway->setUsername(ConfigItems('saas_paypal_api_username'));
        $gateway->setPassword(decrypt(ConfigItems('saas_paypal_api_password')));
        $gateway->setSignature(ConfigItems('saas_api_signature'));
        $gateway->setTestMode($mode);
        $amount = (!empty($data['total_amount'])) ? $data['total_amount'] : $data['amount'];
        $data['currency'] = (!empty($data['currency'])) ? $data['currency'] : ConfigItems('saas_default_currency');

        $response = $gateway->completePurchase([
            'transactionReference' => $data['token'],
            'payerId' => $this->ci->input->get('PayerID'),
            'amount' => number_format($amount, ConfigItems('decimal_separator'), '.', ''),
            'currency' => $data['currency'],
        ])->send();

        $paypalResponse = $response->getData();

        return $paypalResponse;
    }
}
