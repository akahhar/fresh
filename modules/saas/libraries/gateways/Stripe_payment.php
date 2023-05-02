<?php

defined('BASEPATH') or exit('No direct script access allowed');

//require_once APPPATH . '/libraries/stripe/stripe-php/init.php';
require_once(module_dirPath(SaaS_MODULE) . 'vendor/autoload.php');

class Stripe_payment extends Saas_payment

{
    protected $ci;

    protected $secretKey;

    protected $publishableKey;

    public function __construct()
    {
        $this->ci = &get_instance();
        $this->secretKey = ConfigItems('saas_stripe_private_key');
        $this->publishableKey = ConfigItems('saas_stripe_public_key');
        \Stripe\Stripe::setApiKey($this->secretKey);

        /**
         * Call App_gateway __construct function
         */
        parent::__construct();

        /**
         * REQUIRED
         * Gateway unique id
         * The ID must be alpha/alphanumeric
         */
        $this->setId('stripe');

        /**
         * REQUIRED
         * Gateway name
         */
        $this->setName('Stripe Checkout');


        /**
         * REQUIRED
         * Hook gateway with other online payment modes
         */
//        add_action('before_add_online_payment_modes', [ $this, 'initMode' ]);
    }

    public function createPaymentIntent($data)
    {
        $customer_info = get_old_result('tbl_saas_companies', array('id' => $data['companies_id']), false);
        $package_info = get_old_result('tbl_saas_packages', array('id' => $data['package_id']), false);

        if (empty($data['total_amount'])) {
            $data['total_amount'] = $data['amount'];
        }

        $session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                'price_data' => [
                    'currency' => $customer_info->currency,
                    'product_data' => [
                        'name' => 'SaaS Package Payment' . $package_info->name . ' via Stripe ',
                    ],
                    'unit_amount' => $data['total_amount'] * 100,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'metadata' => $data,
            'success_url' => base_url('stipePaymentSuccess/' . url_encode($data)),
            'cancel_url' => base_url('paymentCancel/' . url_encode($data)),
        ]);
        redirect($session->url);
    }


    public function getToken()
    {
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet .= "0123456789";
        $max = strlen($codeAlphabet) - 1;
        for ($i = 0; $i < 17; $i++) {
            $token .= $codeAlphabet[mt_rand(0, $max)];
        }
        return $token;
    }


    public function create_customer($data)
    {
        return \Stripe\Customer::create($data);
    }

    public function get_customer($id)
    {
        return \Stripe\Customer::retrieve($id);
    }

    public function update_customer_source($customer_id, $token)
    {
        \Stripe\Customer::update($customer_id, [
            'source' => $token,
        ]);
    }

    public function charge($data)
    {
        return \Stripe\Charge::create($data);
    }

    public function get_publishable_key()
    {
        return $this->publishableKey;
    }

    public function has_api_key()
    {
        return $this->secretKey != '';
    }

    public function proceedPayment($companies_id)
    {
        // proceed payment via stripe
        $result = $this->createPaymentIntent($_POST);


    }

    public function finish_payment($data)
    {
        $this->ci->load->library('stripe_core');
        $invoice_info = get_old_result('tbl_saas_companies', array('id' => $data['companies_id']), false);
        $package_info = get_old_result('tbl_saas_packages', array('id' => $data['package_id']), false);


        $metadata = array(
            'companies_id' => $data['companies_id'],
            'amount' => $data['amount'],
        );
        if (empty($data['total_amount'])) {
            $data['total_amount'] = $data['amount'];
        }

        $result = $this->ci->stripe_core->charge([
            'amount' => $data['total_amount'] * 100,
            'currency' => $invoice_info->currency,
            "card" => $_POST['stripeToken'],
            'metadata' => $metadata,
            'description' => 'SaaS Package Payment' . $package_info->name . ' via Stripe ',
        ]);
        return $result;
    }
}
