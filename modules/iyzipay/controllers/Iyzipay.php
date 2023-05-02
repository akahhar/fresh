<?php defined('BASEPATH') or exit('No direct script access allowed');

class Iyzipay extends My_Controller
{
  public function __construct()
  {
    parent::__construct();
  }

  public function pay($invoice_id = NULL)
  {
    $data['breadcrumbs'] = lang('iyzipay');
    $data['title'] = lang('make_payment');
    $invoice_info = $this->invoice_model->check_by(array('invoices_id' => $invoice_id), 'tbl_invoices');

    if ($this->input->post()) {
      $this->load->model('payments_model');
      $in_data = $this->input->post();
      $in_data['item_name'] = $invoice_info->reference_no;
      $in_data['currency'] = $invoice_info->currency;
      $in_data['description'] = lang('iyzipay_redirection_alert') . ' ' . $in_data['amount'];
      $in_data['invoices_id'] = $invoice_id;
      $in_data['payment_method'] = 'iyzipay';
      $result = $this->iyzico_trigger($in_data);

      if ($result['type'] == 'success') {
        redirect($result['payment_url']);
      } else {
        set_message('error', $result['message']);
        $client_id = $this->session->userdata('client_id');
        if (!empty($client_id)) {
          redirect('client/dashboard');
        } else {
          redirect('frontend/view_invoice/' . url_encode($invoice_id));
        }
      }
    } else {
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
      $data['url'] = $this->uri->uri_string();
      $data['subview'] = $this->load->view('iyzipay', $data, FALSE);
      $this->load->view('client/_layout_modal', $data);
    }
  }
  public function iyzico_trigger($data)
  {
    IyzipayBootstrap::init();
    if (!empty($data)) {
      $invoice_info = get_row('tbl_invoices', array('invoices_id' => $data['invoices_id']));

      $iyzico = new \Iyzipay\Request\CreateCheckoutFormInitializeRequest(); 
      if (config_item('default_language') == 'turkish') {
        $lang = 'TR';
      } else {
        $lang = 'EN';
      }
      $iyzico->setLocale($lang);
      $iyzico->setConversationId($data['invoices_id']); 
      $iyzico->setPrice($data['amount']); 
      $iyzico->setPaidPrice($data['amount']); 
      $iyzico->setCurrency($data['currency']); 
      $iyzico->setBasketId($data['invoices_id']);
      $iyzico->setPaymentGroup(\Iyzipay\Model\PaymentGroup::PRODUCT);
      $iyzico->setCallbackUrl(base_url('iyzipay/complete_payment/' . $data['invoices_id'])); 

      $client_info = get_row('tbl_client', array('client_id' => $invoice_info->client_id));

      $buyer = new \Iyzipay\Model\Buyer();
      $buyer->setId($client_info->client_id); 
      $buyer->setName($client_info->name); 
      $buyer->setSurname($client_info->name); 
      $buyer->setGsmNumber($client_info->phone); 
      $buyer->setEmail($client_info->email); 
      $buyer->setIdentityNumber("00000000000"); 
      $buyer->setLastLoginDate(date('Y-m-d H:i:s')); 
      $buyer->setRegistrationDate(date('Y-m-d H:i:s')); 
      $buyer->setRegistrationAddress("Bursa"); 
      $buyer->setIp($this->input->ip_address()); 
      $buyer->setCity($client_info->city); 
      $buyer->setCountry($client_info->country); 
      $buyer->setZipCode($client_info->zipcode); 
      $iyzico->setBuyer($buyer); 

      $shippingAddress = new \Iyzipay\Model\Address(); 
      $shippingAddress->setContactName($client_info->name); 
      $shippingAddress->setCity($client_info->city); 
      $shippingAddress->setCountry($client_info->country); 
      $shippingAddress->setAddress($client_info->address); 
      $shippingAddress->setZipCode($client_info->zipcode); 
      $iyzico->setShippingAddress($shippingAddress); 

      $billingAddress = new \Iyzipay\Model\Address(); 
      $billingAddress->setContactName($client_info->name); 
      $billingAddress->setCity($client_info->city); 
      $billingAddress->setCountry($client_info->country); 
      $billingAddress->setAddress($client_info->address); 
      $billingAddress->setZipCode($client_info->zipcode); 
      $iyzico->setBillingAddress($shippingAddress); 

      $basketItems = array();
      $firstBasketItem = new \Iyzipay\Model\BasketItem(); 
      $firstBasketItem->setId($data['invoices_id']); 
      $firstBasketItem->setName($data['description']); 
      $firstBasketItem->setCategory1($data['item_name']); 
      $firstBasketItem->setCategory2($data['item_name']); 
      $firstBasketItem->setItemType(\Iyzipay\Model\BasketItemType::PHYSICAL);
      $firstBasketItem->setPrice($data['amount']); 
      $basketItems[0] = $firstBasketItem;
      $iyzico->setBasketItems($basketItems);
      
      
      $option = new \Iyzipay\Options(); 
      $option->setApiKey(config_item('Iyzipay_ApiKey')); 
      $option->setSecretKey(config_item('Iyzipay_SecretKey')); 
      $option->setBaseUrl("https://sandbox-api.iyzipay.com"); 

      $checkoutFormInitialize = \Iyzipay\Model\CheckoutFormInitialize::create($iyzico, $option); 

      $status = $checkoutFormInitialize->getStatus();
      if ($status == 'success') {
        $sdata['type'] = $status;
        $sdata['payment_url'] = $checkoutFormInitialize->getPaymentPageUrl();
      } else {
        $sdata['type'] = 'error';
        $sdata['message'] = $checkoutFormInitialize->getErrorMessage();
      }
      return $sdata; 
    }
  }


  public function complete_payment($invoice_id)
  {
    $token = $this->input->post('token'); 
    if (!empty($token)) {
      IyzipayBootstrap::init();
      $option = new \Iyzipay\Options();
      $option->setApiKey(config_item('Iyzipay_ApiKey')); 
      $option->setSecretKey(config_item('Iyzipay_SecretKey')); 
      $option->setBaseUrl("https://sandbox-api.iyzipay.com"); 

      $return = new \Iyzipay\Request\RetrieveCheckoutFormRequest();
      if (config_item('default_language') == 'turkish') {
        $lang = 'TR';
      } else {
        $lang = 'EN';
      }
      $return->setLocale($lang);
      $return->setToken($token);
      $checkoutForm = \Iyzipay\Model\CheckoutForm::retrieve($return, $option);
      $request = $checkoutForm;
      $amount = $checkoutForm->getPaidPrice();
      $invoices_id = $checkoutForm->getBasketId();
      if ($request->getPaymentStatus() === "SUCCESS") {
        $result = $this->iyzipay_gateway->addPayment($invoices_id, $amount, '', 'iyzipay');
        if ($result['type'] == 'success') {
          set_message($result['type'], $result['message']);
        } else {
          set_message($result['type'], $result['message']);
        }
      } else {
        set_message('error', $checkoutForm->getErrorMessage());
      }
    }
    $client_id = $this->session->userdata('client_id');
    if (!empty($client_id)) {
      redirect('client/dashboard');
    } else {
      redirect('frontend/view_invoice/' . url_encode($invoice_id));
    }
  }
}
