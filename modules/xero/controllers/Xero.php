<?php
defined('BASEPATH') or exit('No direct script access allowed');

use XeroAPI\XeroPHP\AccountingObjectSerializer;

class Xero extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_active_module('xero');
        if (empty(my_id())) {
            redirect('login');
        }
        require_once(module_dirPath(XERO_MODULE) . 'vendor/autoload.php');
        require_once(module_dirPath(XERO_MODULE) . 'libraries/Storage.php');
        
        $this->host = 'xero';
        $this->cn = config_item('xero_sync_each_time');
        $this->load->model('xero_model');
        $this->storage = new Storage();
        
        if (empty($this->storage->getSession()) || ($_SESSION['oauth2']['expires'] !== null && $_SESSION['oauth2']['expires'] <= time())) {
            if ($this->input->is_ajax_request()) {
                $rata['success'] = 'reload';
                echo json_encode($rata);
                exit();
            }
        }
        $xeroTenantId = $this->storage->getSession() ? (string)$this->storage->getSession()['tenant_id'] : FALSE;
        $action_name = $this->router->fetch_method();
        if (!$xeroTenantId && ($action_name != 'index' && $action_name != 'authorization' && $action_name != 'callback' && $action_name != 'settings')) {
            redirect('admin/xero');
        }
    }
    
    public function clients()
    {
        if ($this->input->is_ajax_request()) {
            $rata['sync_result'] = $this->ins_customers();
            echo json_encode($rata);
            exit();
        }
        redirect('admin/dashboard');
    }
    
    public function suppliers()
    {
        if ($this->input->is_ajax_request()) {
            $rata['sync_result'] = $this->ins_suppliers();
            echo json_encode($rata);
            exit();
        }
        redirect('admin/dashboard');
    }
    
    public function items()
    {
        if ($this->input->is_ajax_request()) {
            $rata['sync_result'] = $this->ins_items();
            echo json_encode($rata);
            exit();
        }
        redirect('admin/dashboard');
    }
    
    public function invoices()
    {
        if ($this->input->is_ajax_request()) {
            $rata['sync_result'] = $this->ins_invoices();
            echo json_encode($rata);
            exit();
        }
        redirect('admin/dashboard');
    }
    
    public function purchases()
    {
        if ($this->input->is_ajax_request()) {
            $rata['sync_result'] = $this->ins_purchases();
            echo json_encode($rata);
            exit();
        }
        redirect('admin/dashboard');
    }
    
    public function projects()
    {
        if ($this->input->is_ajax_request()) {
            $rata['sync_result'] = $this->ins_projects();
            echo json_encode($rata);
            exit();
        }
        redirect('admin/dashboard');
    }
    
    public function payments()
    {
        if ($this->input->is_ajax_request()) {
            $rata['sync_result'] = $this->ins_payments();
            echo json_encode($rata);
            exit();
        }
        redirect('admin/dashboard');
    }
    
    public function purchase_payments()
    {
        if ($this->input->is_ajax_request()) {
            $rata['sync_result'] = $this->ins_purchase_payments();
            echo json_encode($rata);
            exit();
        }
        redirect('admin/dashboard');
    }
    
    public function settings()
    {
        $data = array();
        $data['title'] = lang('xero_settings');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div>', '</div>');
        $this->form_validation->set_rules('xero_client_id', lang('client_id'), 'required');
        $this->form_validation->set_rules('xero_client_secret', lang('client_secret'), 'required');
        $this->form_validation->set_rules('xero_sync_each_time', lang('xero_sync_each_time'), 'required|numeric');
        if ($this->form_validation->run() == true) {
            $input_data = $this->xero_model->array_from_post(array('xero_client_id', 'xero_client_secret', 'xero_sync_each_time'));
            foreach ($input_data as $key => $value) {
                $data = array('value' => $value);
                $where = array('config_key' => $key);
                $this->db->where($where)->update('tbl_config', $data);
                $exists = $this->db->where($where)->get('tbl_config');
                if ($exists->num_rows() == 0) {
                    $this->db->insert('tbl_config', array("config_key" => $key, "value" => $value));
                }
            }
            redirect('admin/xero');
        } else {
            $s_data['form_error'] = validation_errors();
            $this->session->set_userdata($s_data);
        }
        $data['subview'] = $this->load->view('settings', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }
    
    public function index()
    {
        $data['title'] = lang('xero');
        $data['storage'] = $this->storage;
        $data['subview'] = $this->load->view('index', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }
    
    public function authorization()
    {
        // Storage Class uses sessions for storing access token (demo only)
        // you'll need to extend to your Database for a scalable solution
        $provider = $this->xero_provider();
        // Scope defines the data your app has permission to access.
        // Learn more about scopes at https://developer.xero.com/documentation/oauth2/scopes
        $options = [
            'scope' => ['openid email profile offline_access assets projects accounting.settings accounting.transactions accounting.contacts accounting.journals.read accounting.reports.read accounting.attachments']
        ];
        // This returns the authorizeUrl with necessary parameters applied (e.g. state).
        $authorizationUrl = $provider->getAuthorizationUrl($options);
        // Save the state generated for you and store it to the session.
        // For security, on callback we compare the saved state with the one returned to ensure they match.
        $_SESSION['oauth2state'] = $provider->getState();
        // Redirect the user to the authorization URL.
        header('Location: ' . $authorizationUrl);
        exit();
    }
    
    public function authorizedResource()
    {
        $xeroTenantId = (string)$this->storage->getSession()['tenant_id'];
        $apiInstance = $this->xero_api_call();
        $message = "no API calls";
        if (isset($_GET['action'])) {
            if ($_GET["action"] == 1) {
                // Get Organisation details
                $apiResponse = $apiInstance->getOrganisations($xeroTenantId);
                $message = 'Organisation Name: ' . $apiResponse->getOrganisations()[0]->getName();
            } else if ($_GET["action"] == 2) {
                try {
                    $person = new XeroAPI\XeroPHP\Models\Accounting\ContactPerson;
                    $person->setFirstName("John")
                        ->setLastName("Smith")
                        ->setEmailAddress("john.smith@24locks.com")
                        ->setIncludeInEmails(true);
                    $arr_persons = [];
                    array_push($arr_persons, $person);
                    
                    $contact = new XeroAPI\XeroPHP\Models\Accounting\Contact;
                    $contact->setName('FooBar_2')
                        ->setFirstName("Foo_2")
                        ->setLastName("Bar_2")
                        ->setEmailAddress("ben_2.bowden@24locks.com")
                        ->setContactPersons($arr_persons);
                    
                    $arr_contacts = [];
                    array_push($arr_contacts, $contact);
                    $contacts = new XeroAPI\XeroPHP\Models\Accounting\Contacts;
                    $contacts->setContacts($arr_contacts);
                    
                    $apiResponse = $apiInstance->createContacts($xeroTenantId, $contacts);
                    $message = 'New Contact Name: ' . $apiResponse->getContacts()[0]->getName();
                } catch (\XeroAPI\XeroPHP\ApiException $e) {
                    $error = AccountingObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\XeroAPI\XeroPHP\Models\Accounting\Error',
                        []
                    );
                    $message = "ApiException - " . $error->getElements()[0]["validation_errors"][0]["message"];
                }
            } else if ($_GET["action"] == 3) {
                $if_modified_since = null;
                $where = null;
                $order = null; // string
                $ids = null; // string[] | Filter by a comma-separated list of Invoice Ids.
                $invoice_numbers = null; // string[] |  Filter by a comma-separated list of Invoice Numbers.
                $contact_ids = null; // string[] | Filter by a comma-separated list of ContactIDs.
                $statuses = array("DRAFT", "SUBMITTED");;
                $page = 1; // int | e.g. page=1 – Up to 100 invoices will be returned in a single API call with line items
                $include_archived = null; // bool | e.g. includeArchived=true - Contacts with a status of ARCHIVED will be included
                $created_by_my_app = null; // bool | When set to true you'll only retrieve Invoices created by your app
                $unitdp = null; // int | e.g. unitdp=4 – You can opt in to use four decimal places for unit amounts
                try {
                    $apiResponse = $apiInstance->getInvoices($xeroTenantId, $if_modified_since, $where, $order, $ids, $invoice_numbers, $contact_ids, $statuses, $page, $include_archived, $created_by_my_app, $unitdp);
                    if (count($apiResponse->getInvoices()) > 0) {
                        $message = 'Total invoices found: ' . count($apiResponse->getInvoices());
                    } else {
                        $message = "No invoices found matching filter criteria";
                    }
                } catch (Exception $e) {
                    echo 'Exception when calling AccountingApi->getInvoices: ', $e->getMessage(), PHP_EOL;
                }
            } else if ($_GET["action"] == 4) {
                try {
                    $contact = new XeroAPI\XeroPHP\Models\Accounting\Contact;
                    $contact->setName('George Jetson')
                        ->setFirstName("George")
                        ->setLastName("Jetson")
                        ->setEmailAddress("george.jetson@aol.com");
                    
                    // Add the same contact twice - the first one will succeed, but the
                    // second contact will throw a validation error which we'll catch.
                    $arr_contacts = [];
                    array_push($arr_contacts, $contact);
                    array_push($arr_contacts, $contact);
                    $contacts = new XeroAPI\XeroPHP\Models\Accounting\Contacts;
                    $contacts->setContacts($arr_contacts);
                    
                    $apiResponse = $apiInstance->createContacts($xeroTenantId, $contacts, false);
                    $message = 'First contacts created: ' . $apiResponse->getContacts()[0]->getName();
                    
                    if ($apiResponse->getContacts()[1]->getHasValidationErrors()) {
                        $message = $message . '<br> Second contact validation error : ' . $apiResponse->getContacts()[1]->getValidationErrors()[0]["message"];
                    }
                } catch (\XeroAPI\XeroPHP\ApiException $e) {
                    $error = AccountingObjectSerializer::deserialize(
                        $e->getResponseBody(),
                        '\XeroAPI\XeroPHP\Models\Accounting\Error',
                        []
                    );
                    $message = "ApiException - " . $error->getElements()[0]["validation_errors"][0]["message"];
                }
            } else if ($_GET["action"] == 5) {
                $if_modified_since = new \DateTime("2019-01-02T19:20:30+01:00"); // \DateTime | Only records created or modified since this timestamp will be returned
                $where = null;
                $order = null; // string
                $ids = null; // string[] | Filter by a comma-separated list of Invoice Ids.
                $page = 1; // int | e.g. page=1 – Up to 100 invoices will be returned in a single API call with line items
                $include_archived = null; // bool | e.g. includeArchived=true - Contacts with a status of ARCHIVED will be included
                try {
                    $apiResponse = $apiInstance->getContacts($xeroTenantId, $if_modified_since, $where, $order, $ids, $page, $include_archived);
                    if (count($apiResponse->getContacts()) > 0) {
                        $message = 'Total contacts found: ' . count($apiResponse->getContacts());
                    } else {
                        $message = "No contacts found matching filter criteria";
                    }
                } catch (Exception $e) {
                    echo 'Exception when calling AccountingApi->getContacts: ', $e->getMessage(), PHP_EOL;
                }
            } else if ($_GET["action"] == 6) {
                $jwt = new XeroAPI\XeroPHP\JWTClaims();
                $jwt->setTokenId((string)$this->storage->getIdToken());
                // Set access token in order to get authentication event id
                $jwt->setTokenAccess((string)$this->storage->getAccessToken());
                $jwt->decode();
                echo("sub:" . $jwt->getSub() . "<br>");
                echo("sid:" . $jwt->getSid() . "<br>");
                echo("iss:" . $jwt->getIss() . "<br>");
                echo("exp:" . $jwt->getExp() . "<br>");
                echo("given name:" . $jwt->getGivenName() . "<br>");
                echo("family name:" . $jwt->getFamilyName() . "<br>");
                echo("email:" . $jwt->getEmail() . "<br>");
                echo("user id:" . $jwt->getXeroUserId() . "<br>");
                echo("username:" . $jwt->getPreferredUsername() . "<br>");
                echo("session id:" . $jwt->getGlobalSessionId() . "<br>");
                echo("authentication_event_id:" . $jwt->getAuthenticationEventId() . "<br>");
            }
        }
        $data['message'] = $message;
        $data['subview'] = $this->load->view('authorizedResource', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }
    
    public function xero_project_api()
    {
        $xeroTenantId = (string)$this->storage->getSession()['tenant_id'];
        if ($this->storage->getHasExpired()) {
            $provider = $this->xero_provider();
            $newAccessToken = $provider->getAccessToken('refresh_token', [
                'refresh_token' => $this->storage->getRefreshToken()
            ]);
            $this->storage->setToken(
                $newAccessToken->getToken(),
                $newAccessToken->getExpires(),
                $xeroTenantId,
                $newAccessToken->getRefreshToken(),
                $newAccessToken->getValues()["id_token"]
            );
        }
        
        $config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$this->storage->getSession()['token']);
        return new XeroAPI\XeroPHP\Api\ProjectApi(
            new GuzzleHttp\Client(),
            $config
        );
    }
    
    public function xero_api_call()
    {
        $xeroTenantId = (string)$this->storage->getSession()['tenant_id'];
        if ($this->storage->getHasExpired()) {
            $provider = $this->xero_provider();
            $newAccessToken = $provider->getAccessToken('refresh_token', [
                'refresh_token' => $this->storage->getRefreshToken()
            ]);
            $this->storage->setToken(
                $newAccessToken->getToken(),
                $newAccessToken->getExpires(),
                $xeroTenantId,
                $newAccessToken->getRefreshToken(),
                $newAccessToken->getValues()["id_token"]
            );
        }
        $config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$this->storage->getSession()['token']);
        return new XeroAPI\XeroPHP\Api\AccountingApi(
            new GuzzleHttp\Client(),
            $config
        );
    }
    
    public function fetch_invoices($invoice_type = null, $ids = null)
    {
        $invoices = array();
        $xeroTenantId = (string)$this->storage->getSession()['tenant_id'];
        $apiInstance = $this->xero_api_call();
        $if_modified_since = null;
        $where = null;
        if ($invoice_type == 'invoice') {
            $where = 'Type=="ACCREC"';
        } elseif ($invoice_type == 'purchase_order') {
            $where = 'Type=="ACCPAY"';
        }
        $order = 'Contact.Name ASC'; // string
        $invoice_numbers = null; // string[] |  Filter by a comma-separated list of Invoice Numbers.
        $contact_ids = null; // string[] | Filter by a comma-separated list of ContactIDs.
        $statuses = array("SUBMITTED", "APPROVED", "AUTHORISED", "PAID", "UNPAID");
        $page = null; // int | e.g. page=1 – Up to 100 invoices will be returned in a single API call with line items
        $include_archived = null; // bool | e.g. includeArchived=true - Contacts with a status of ARCHIVED will be included
        $created_by_my_app = null; // bool | When set to true you'll only retrieve Invoices created by your app
        $unitdp = null; // int | e.g. unitdp=4 – You can opt in to use four decimal places for unit amounts
        try {
            $apiResponse = $apiInstance->getInvoices($xeroTenantId, $if_modified_since, $where, $order, $ids, $invoice_numbers, $contact_ids, $statuses, $page, $include_archived, $created_by_my_app, $unitdp, null);
            if (count($apiResponse->getInvoices()) > 0) {
                $apiResponse->getInvoices();
                $invoices = $apiResponse->getInvoices();
            }
        } catch (Exception $e) {
            echo 'Exception when calling AccountingApi->getInvoices: ', $e->getMessage(), PHP_EOL;
        }
        return $invoices;
    }
    
    public function get_remote_project_ids_from_tbl($host, $table_name)
    {
        $remote_contact_ids_from_tbl_clients = array();
        $where2 = array("host" => "$host");
        $tbl_client_d = get_any_field($table_name, $where2, 'remote_project_id', TRUE);
        if (!empty($tbl_client_d)) {
            $remote_contact_ids_from_tbl_clients = array_column($tbl_client_d, 'remote_project_id');;
        }
        return $remote_contact_ids_from_tbl_clients;
    }
    
    public function ins_projects()
    {
        $return = 'No  (new) project is found to be synchronized';
        $num_remote_items = 0;
        $num_items_in_db = 0;
        $projects = $this->fetch_projects();
        $ins = array();
        $remote_contacts_ids = array();
        $cn = 0;
        if (!empty($projects['data'])) {
            $num_remote_items = count($projects);
            $tbl_items_remote_ids = array();
            $tbl_saved_items_res = $this->get_remote_project_ids_from_tbl($this->host, 'tbl_project');
            if (!empty($tbl_saved_items_res)) {
                $num_items_in_db = count($tbl_saved_items_res);
                $tbl_items_remote_ids = array_flip($tbl_saved_items_res);
            }
            foreach ($projects as $v) {
                $remote_project_id = $v['project_id'];
                if (!isset($tbl_items_remote_ids[$remote_project_id])) {
                    $data = array();
                    $data['project_name'] = $v['name'];
                    $data['client_id'] = 0;
                    $data['project_cost'] = $v['total_task_amount']['value'];
                    $data['project_status'] = $v['status'];
                    $data['host'] = $this->host;
                    $data['remote_project_id'] = $remote_project_id;
                    $contact_id = $v['contact_id'];
                    $data['remote_contact_id'] = $contact_id;
                    $ins[] = $data;
                    $remote_contacts_ids = $contact_id;
                    $cn++;
                    if ($cn == $this->cn) break;
                }
            }
        } else {
            return $projects['error'];
        }
        if (!empty($ins)) {
            $table = 'tbl_project';
            $this->db->insert_batch($table, $ins);
            $num_ins_items = count($ins);
            $left_items = $num_remote_items - $num_items_in_db - $num_ins_items;
            if ($left_items > 0) {
                $return = $left_items . ' projects are still left to be synchronized, Please synchronize again';
            } else {
                $return = 'All projects are now synchronized';
            }
        }
        $this->ins_customers($remote_contacts_ids, null);
        $this->update_tbl_projects_clients_ids($this->host);
        return $return;
    }
    
    public function fetch_items($item_id = null)
    {
        $items = array();
        $xeroTenantId = (string)$this->storage->getSession()['tenant_id'];
        $apiInstance = $this->xero_api_call();
        $if_modified_since = null;
        $where = null;
        $order = null; // string
        $unitdp = null; // int | e.g. unitdp=4 – You can opt in to use four decimal places for unit amounts
        try {
            if (isset($item_id)) {
                $apiResponse = $apiInstance->getItem($xeroTenantId, $item_id, $unitdp);
            } else {
                $apiResponse = $apiInstance->getItems($xeroTenantId, $if_modified_since, $where, $order, $unitdp);
            }
            if (count($apiResponse->getItems()) > 0) {
                $items = $apiResponse->getItems();
            }
        } catch (Exception $e) {
            echo 'Exception when calling AccountingApi->getInvoices: ', $e->getMessage(), PHP_EOL;
        }
        return $items;
    }
    
    public function ins_items($ids_to_send = null)
    {
        $return = 'No  (new) item is found to be synchronized';
        $num_remote_items = 0;
        $num_items_in_db = 0;
        $items = $this->fetch_items($ids_to_send);
        $ins = array();
        $cn = 0;
        if (!empty($items)) {
            $num_remote_items = count($items);
            $tbl_items_remote_ids = array();
            $remote_items_ids_from_tbl_saved_items = $this->get_remote_items_ids_from_tbl_saved_items($this->host);
            if (!empty($remote_items_ids_from_tbl_saved_items)) {
                $num_items_in_db = count($remote_items_ids_from_tbl_saved_items);
                $tbl_items_remote_ids = array_flip($remote_items_ids_from_tbl_saved_items);
            }
            foreach ($items as $v) {
                $remote_item_id = $v['item_id'];
                if (!isset($tbl_items_remote_ids[$remote_item_id])) {
                    $data = array();
                    $data['item_name'] = $v['name'];
                    $data['item_desc'] = $v['description'];
                    $data['unit_cost'] = $v['sales_details']['unit_price'];
                    $data['quantity'] = $v['quantity_on_hand'];
                    $data['host'] = $this->host;
                    $data['remote_item_id'] = $v['item_id'];
                    $ins[] = $data;
                    $cn++;
                    if (null === $ids_to_send && $cn == $this->cn) break;
                }
            }
        }
        if (!empty($ins)) {
            $table = 'tbl_saved_items';
            $this->db->insert_batch($table, $ins);
            $num_ins_items = count($ins);
            $left_items = $num_remote_items - $num_items_in_db - $num_ins_items;
            if ($left_items > 0) {
                $return = $left_items . ' items are still left to be synchronized, Please synchronize again';
            } else {
                $return = 'All items are now synchronized';
            }
        }
        return $return;
    }
    
    public function ins_item($item_id)
    {
        $where = array('host' => $this->host, 'remote_item_id' => $item_id);
        $item_res = get_any_field('tbl_saved_items', $where, 'saved_items_id');
        if (empty($item_res)) {
            $ins = array();
            $items = $this->fetch_items($item_id);
            if (!empty($items)) {
                foreach ($items as $v) {
                    $data = array();
                    $data['item_name'] = $v['name'];
                    $data['item_desc'] = $v['description'];
                    $data['unit_cost'] = $v['sales_details']['unit_price'];
                    $data['quantity'] = $v['quantity_on_hand'];
                    $data['host'] = $this->host;
                    $data['remote_item_id'] = $v['item_id'];
                    $ins[] = $data;
                }
            }
            if (!empty($ins)) {
                $table = 'tbl_saved_items';
                $this->db->insert_batch($table, $ins);
            }
        }
    }
    
    public function fetch_payments($payment_type, $payment_id = null)
    {
        $payments = array();
        $xeroTenantId = (string)$this->storage->getSession()['tenant_id'];
        $apiInstance = $this->xero_api_call();
        $if_modified_since = null;
        $where = null;
        if ($payment_type == 'from_client') {
            $where = 'PaymentType=="ACCRECPAYMENT"';
        } elseif ($payment_type == 'to_supplier') {
            $where = 'PaymentType=="ACCPAYPAYMENT"';
        }
        $order = null; // string
        $page = null;
        try {
            if (isset($payment_id)) {
                $apiResponse = $apiInstance->getPayment($xeroTenantId, $payment_id);
            } else {
                $apiResponse = $apiInstance->getPayments($xeroTenantId, $if_modified_since, $where, $order, $page);
            }
            if (count($apiResponse->getPayments()) > 0) {
                $payments = $apiResponse->getPayments();
            }
        } catch (Exception $e) {
            echo 'Exception when calling AccountingApi->getInvoices: ', $e->getMessage(), PHP_EOL;
        }
        return $payments;
    }
    
    public function ins_payments($ids_to_send = null)
    {
        $return = 'No (new) payments is found to be synchronized';
        $num_remote_items = 0;
        $num_items_in_db = 0;
        $payments = $this->fetch_payments('from_client');
        $ins = array();
        $payments_invoices_ids = array();
        $cn = 0;
        if (!empty($payments)) {
            $num_remote_items = count($payments);
            $existing_remote_ids = array();
            $remote_payments_ids_from_tbl_payments = $this->get_remote_payments_ids_from_table($this->host, 'tbl_payments');
            if (!empty($remote_payments_ids_from_tbl_payments)) {
                $num_items_in_db = count($remote_payments_ids_from_tbl_payments);
                $existing_remote_ids = array_flip($remote_payments_ids_from_tbl_payments);
            }
            foreach ($payments as $v) {
                $remote_payment_id = $v['payment_id'];
                if (!isset($existing_remote_ids[$remote_payment_id])) {
                    $data = array();
                    $data['amount'] = $v['amount'];
                    $data['payment_method'] = 'From ' . $this->host;
                    $data['payment_date'] = $this->convert_net_json_date($v['date']);
                    $data['currency'] = $v['invoice']['currency_code'];
                    $data['host'] = $this->host;
                    $data['remote_payment_id'] = $v['payment_id'];
                    $data['remote_invoice_id'] = $v['invoice']['invoice_id'];
                    $data['remote_contact_id'] = $v['invoice']['contact']['contact_id'];
                    $data['remote_account_id'] = $v['account']['account_id'];
                    $ins[] = $data;
                    $payments_invoices_ids[] = $v['invoice']['invoice_id'];
                    $cn++;
                    if (null === $ids_to_send && $cn == $this->cn) break;
                }
            }
        }
        
        if (!empty($ins)) {
            $table = 'tbl_payments';
            $this->db->insert_batch($table, $ins);
            if (!empty($payments_invoices_ids)) {
                $this->ins_invoices($payments_invoices_ids);
            }
            $num_ins_items = count($ins);
            $left_items = $num_remote_items - $num_items_in_db - $num_ins_items;
            if ($left_items > 0) {
                $return = $left_items . ' payments are still left to be synchronized, Please synchronize again';
            } else {
                $return = 'All payments are now synchronized';
            }
        }
        $this->ins_payments_invoices($this->host);
        $this->ins_payments_clients($this->host);
        $this->update_payments_invoices_ids($this->host);
        return $return;
    }
    
    public function ins_purchase_payments($ids_to_send = null)
    {
        $return = 'No  (new) purchase payments is found to be synchronized';
        $num_remote_items = 0;
        $num_items_in_db = 0;
        $payments = $this->fetch_payments('to_supplier');
        $ins = array();
        $payments_invoices_ids = array();
        $cn = 0;
        if (!empty($payments)) {
            $num_remote_items = count($payments);
            $existing_remote_ids = array();
            $remote_payments_ids_from_tbl_payments = $this->get_remote_payments_ids_from_table($this->host, 'tbl_purchase_payments');
            if (!empty($remote_payments_ids_from_tbl_payments)) {
                $num_items_in_db = count($remote_payments_ids_from_tbl_payments);
                $existing_remote_ids = array_flip($remote_payments_ids_from_tbl_payments);
            }
            foreach ($payments as $v) {
                $remote_payment_id = $v['payment_id'];
                if (!isset($existing_remote_ids[$remote_payment_id])) {
                    $data = array();
                    $data['purchase_id'] = 0;
                    $data['amount'] = $v['amount'];
                    $data['payment_method'] = 'From ' . $this->host;
                    $data['payment_date'] = $this->convert_net_json_date($v['date']);
                    $data['currency'] = $v['invoice']['currency_code'];
                    $data['host'] = $this->host;
                    $data['remote_payment_id'] = $v['payment_id'];
                    $invoice_id = $v['invoice']['invoice_id'];
                    $data['remote_invoice_id'] = $invoice_id;
                    $data['remote_contact_id'] = $v['invoice']['contact']['contact_id'];
                    $data['remote_account_id'] = $v['account']['account_id'];
                    $ins[] = $data;
                    $payments_invoices_ids[] = $invoice_id;
                    $cn++;
                    if (null === $ids_to_send && $cn == $this->cn) break;
                }
            }
        }
        
        if (!empty($ins)) {
            $table = 'tbl_purchase_payments';
            $this->db->insert_batch($table, $ins);
            if (!empty($payments_invoices_ids)) {
                $this->ins_purchases($payments_invoices_ids);
            }
            $num_ins_items = count($ins);
            $left_items = $num_remote_items - $num_items_in_db - $num_ins_items;
            if ($left_items > 0) {
                $return = $left_items . ' purchase payments are still left to be synchronized, Please synchronize again';
            } else {
                $return = 'All purchase payments are now synchronized';
            }
        }
        $this->ins_payments_purchases($this->host);
        $this->ins_payments_suppliers($this->host);
        $this->update_purchases_payments_purchases_ids($this->host);
        return $return;
    }
    
    
    public function convert_net_json_date($str)
    {
        $match = preg_match('/\/Date\((\d+)([-+])(\d+)\)\//', $str, $date);
        $timestamp = $date[1] / 1000;
        $operator = $date[2];
        $hours = $date[3] * 36; // Get the seconds
        $datetime = new DateTime();
        $datetime->setTimestamp($timestamp);
        $datetime->modify($operator . $hours . ' seconds');
        return $datetime->format('Y-m-d');
    }
    
    public function ins_purchases($remote_invoices_ids = null)
    {
        $return = 'No  (new) purchase are found to be synchronized';
        $num_remote_invoices = 0;
        $num_invoices_in_db = 0;
        $invoices = $this->fetch_invoices('purchase_order', $remote_invoices_ids);
        $ins = array();
        $ins_items = array();
        $ins_pay = array();
        $cn = 0;
        if (!empty($invoices)) {
            $num_remote_invoices = count($invoices);
            $tbl_invoices_remote_ids = array();
            $remote_invoices_ids_from_tbl_invoices = $this->get_remote_invoices_ids_from_tbl($this->host, 'tbl_purchases');
            if (!empty($remote_invoices_ids_from_tbl_invoices)) {
                $num_invoices_in_db = count($remote_invoices_ids_from_tbl_invoices);
                $tbl_invoices_remote_ids = array_flip($remote_invoices_ids_from_tbl_invoices);
            }
            foreach ($invoices as $v) {
                $remote_invoice_id = $v['invoice_id'];
                if (!isset($tbl_invoices_remote_ids[$remote_invoice_id])) {
                    $data = array();
                    $data['reference_no'] = !empty($v['reference']) ? $v['reference'] . ' : ' : '' . $v['invoice_number'];
                    $data['supplier_id'] = 0;
                    $data['purchase_date'] = $this->convert_net_json_date($v['date']);
                    $data['due_date'] = $this->convert_net_json_date($v['due_date']);
                    $data['user_id'] = my_id();
                    $data['total'] = $v['total'];
                    $data['total_tax'] = $v['total_tax'];
                    $data['discount_total'] = isset($v['total_discount']) ? $v['total_discount'] : 0;
                    $data['host'] = $this->host;
                    $data['remote_invoice_id'] = $v['invoice_id'];
                    $data['remote_supplier_id'] = $v['contact']['contact_id'];
                    $line_items = $v['line_items'];
                    if (!empty($line_items)) {
                        foreach ($line_items as $items) {
                            $items_data['purchase_id'] = 0;
                            $items_data['item_tax_total'] = $items['tax_amount'];
                            $items_data['quantity'] = $items['quantity'];
                            $items_data['unit_cost'] = $items['unit_amount'];
                            $items_data['total_cost'] = $items['line_amount'];
                            $items_data['item_name'] = '';
                            $items_data['item_desc'] = $items['description'];
                            $items_data['remote_item_id'] = '';
                            $items_data['host'] = $this->host;
                            $items_data['remote_invoice_id'] = $v['invoice_id'];
                            $ins_items[] = $items_data;
                        }
                    }
                    $payments = $v['payments'];
                    if (!empty($payments)) {
                        $existing_remote_ids = array();
                        $remote_payments_ids_from_tbl_payments = $remote_payments_ids_from_tbl_payments = $this->get_remote_payments_ids_from_table($this->host, 'tbl_purchase_payments');
                        if (!empty($remote_payments_ids_from_tbl_payments)) {
                            $num_items_in_db = count($remote_payments_ids_from_tbl_payments);
                            $existing_remote_ids = array_flip($remote_payments_ids_from_tbl_payments);
                        }
                        foreach ($payments as $p) {
                            $remote_payment_id = $p['payment_id'];
                            if (!isset($existing_remote_ids[$remote_payment_id])) {
                                $p_data = array();
                                $p_data['purchase_id'] = 0;
                                $p_data['amount'] = $p['amount'];
                                $p_data['payment_method'] = 'From ' . $this->host;
                                $p_data['payment_date'] = $this->convert_net_json_date($p['date']);
                                $p_data['currency'] = $v['currency_code'];
                                $p_data['host'] = $this->host;
                                $p_data['remote_payment_id'] = $p['payment_id'];
                                $p_data['remote_invoice_id'] = $v['invoice_id'];
                                $p_data['remote_contact_id'] = $v['contact']['contact_id'];
                                $ins_pay[] = $p_data;
                            }
                        }
                    }
                    $ins[] = $data;
                    $cn++;
                    if (null === $remote_invoices_ids && $cn == $this->cn) break;
                }
            }
        }
        
        if (!empty($ins)) {
            $table = 'tbl_purchases';
            $this->db->insert_batch($table, $ins);
            $table = 'tbl_purchase_items';
            $this->db->insert_batch($table, $ins_items);
            if (!empty($ins_pay)) {
                $table = 'tbl_purchase_payments';
                $this->db->insert_batch($table, $ins_pay);
            }
            $num_ins_invoices = count($ins);
            $left_invoices = $num_remote_invoices - $num_invoices_in_db - $num_ins_invoices;
            if ($left_invoices > 0) {
                $return = $left_invoices . ' purchases are still left to be synchronized, Please synchronize again';
            } else {
                $return = 'All purchases are now synchronized';
            }
        }
        
        $this->ins_purchases_suppliers($this->host);
        $this->update_purchases_suppliers_ids($this->host);
        $this->update_purchases_payments_purchases_ids($this->host);
        
        return $return;
    }
    
    public function ins_invoices($remote_invoices_ids = null)
    {
        $return = 'No  (new) invoices are found to be synchronized';
        $num_remote_invoices = 0;
        $num_invoices_in_db = 0;
        $invoices = $this->fetch_invoices('invoice', $remote_invoices_ids);
        $ins = array();
        $ins_items = array();
        $ins_pay = array();
        $cn = 0;
        if (!empty($invoices)) {
            $num_remote_invoices = count($invoices);
            $tbl_invoices_remote_ids = array();
            $remote_invoices_ids_from_tbl_invoices = $this->get_remote_invoices_ids_from_tbl($this->host, 'tbl_invoices');
            if (!empty($remote_invoices_ids_from_tbl_invoices)) {
                $num_invoices_in_db = count($remote_invoices_ids_from_tbl_invoices);
                $tbl_invoices_remote_ids = array_flip($remote_invoices_ids_from_tbl_invoices);
            }
            foreach ($invoices as $v) {
                $remote_invoice_id = $v['invoice_id'];
                
                if (!isset($tbl_invoices_remote_ids[$remote_invoice_id])) {
                    $data = array();
                    $data['reference_no'] = !empty($v['reference']) ? $v['reference'] . ' : ' : '' . $v['invoice_number'];
                    $data['client_id'] = 0;
                    $data['invoice_date'] = $this->convert_net_json_date($v['date']);
                    $data['due_date'] = $this->convert_net_json_date($v['due_date']);
                    $data['user_id'] = my_id();
                    $data['currency'] = $v['currency_code'];
                    $data['tax'] = $v['total_tax'];;
                    $data['total_tax'] = '{"tax_name":null,"total_tax":null}';
                    $data['discount_total'] = isset($v['total_discount']) ? $v['total_discount'] : 0;
                    $data['status'] = !empty($v['status']) ? $v['status'] : 'Unpaid';
                    $data['host'] = $this->host;
                    $data['remote_invoice_id'] = $v['invoice_id'];
                    $data['remote_client_id'] = $v['contact']['contact_id'];
                    $line_items = $v['line_items'];
                    if (!empty($line_items)) {
                        foreach ($line_items as $items) {
                            $items_data['invoices_id'] = 0;
                            $items_data['item_tax_total'] = $items['tax_amount'];
                            $items_data['quantity'] = $items['quantity'];
                            $items_data['unit_cost'] = $items['unit_amount'];
                            $items_data['total_cost'] = $items['line_amount'];
                            $items_data['item_name'] = '';
                            $items_data['item_desc'] = $items['description'];
                            $items_data['remote_item_id'] = '';
                            $items_data['host'] = $this->host;
                            $items_data['remote_invoice_id'] = $v['invoice_id'];
                            $ins_items[] = $items_data;
                        }
                    }
                    $payments = $v['payments'];
                    if (!empty($payments)) {
                        $existing_remote_ids = array();
                        $remote_payments_ids_from_tbl_payments = $this->get_remote_payments_ids_from_table($this->host, 'tbl_payments');
                        if (!empty($remote_payments_ids_from_tbl_payments)) {
                            $existing_remote_ids = array_flip($remote_payments_ids_from_tbl_payments);
                        }
                        foreach ($payments as $p) {
                            $remote_payment_id = $p['payment_id'];
                            if (!isset($existing_remote_ids[$remote_payment_id])) {
                                $p_data = array();
                                $p_data['invoices_id'] = 0;
                                $p_data['amount'] = $p['amount'];
                                $p_data['payment_method'] = 'From ' . $this->host;
                                $p_data['payment_date'] = $this->convert_net_json_date($p['date']);
                                $p_data['currency'] = $v['currency_code'];
                                
                                $p_data['host'] = $this->host;
                                $p_data['remote_payment_id'] = $p['payment_id'];
                                $p_data['remote_invoice_id'] = $v['invoice_id'];
                                $p_data['remote_contact_id'] = $v['contact']['contact_id'];
                                $ins_pay[] = $p_data;
                            }
                        }
                    }
                    $ins[] = $data;
                    $cn++;
                    if (null === $remote_invoices_ids && $cn == $this->cn) break;
                }
            }
        }
        
        if (!empty($ins)) {
            $table = 'tbl_invoices';
            $this->db->insert_batch($table, $ins);
            
            $table = 'tbl_items';
            $this->db->insert_batch($table, $ins_items);
            
            if (!empty($ins_pay)) {
                $table = 'tbl_payments';
                $this->db->insert_batch($table, $ins_pay);
            }
            $num_ins_invoices = count($ins);
            $left_invoices = $num_remote_invoices - $num_invoices_in_db - $num_ins_invoices;
            if ($left_invoices > 0) {
                $return = $left_invoices . ' invoices are still left to be synchronized, Please synchronize again';
            } else {
                $return = 'All invoices are now synchronized';
            }
        }
        $this->ins_invoices_clients($this->host);
        $this->update_invoices_clients_ids($this->host);
        $this->update_items_invoices_ids($this->host);
        $this->update_payments_invoices_ids($this->host);
        return $return;
    }
    
    public function ins_invoices_clients($host)
    {
        $remote_ids_to_send = array();
        $where = array("host" => "$host", "client_id" => 0);
        $tbl_invoices_res_d = get_any_field('tbl_invoices', $where, 'remote_client_id', TRUE);
        if (!empty($tbl_invoices_res_d)) {
            $remote_ids_to_send = array_column($tbl_invoices_res_d, 'remote_client_id');
        }
        $remote_contact_ids_from_tbl_clients = $this->get_remote_contact_ids_from_tbl($host, 'tbl_client');
        if (!empty($remote_contact_ids_from_tbl_clients)) {
            $remote_ids_to_send = array_unique(array_diff($remote_ids_to_send, $remote_contact_ids_from_tbl_clients), SORT_REGULAR);
        }
        if (!empty($remote_ids_to_send)) {
            $this->ins_customers($remote_ids_to_send);
        }
    }
    
    public function ins_purchases_suppliers($host)
    {
        $remote_ids_to_send = array();
        $where = array("host" => "$host", "supplier_id" => 0);
        $tbl_invoices_res_d = get_any_field('tbl_purchases', $where, 'remote_supplier_id', TRUE);
        if (!empty($tbl_invoices_res_d)) {
            $remote_ids_to_send = array_column($tbl_invoices_res_d, 'remote_supplier_id');
        }
        $remote_contact_ids_from_tbl_clients = $this->get_remote_contact_ids_from_tbl($host, 'tbl_suppliers');
        if (!empty($remote_contact_ids_from_tbl_clients)) {
            $remote_ids_to_send = array_unique(array_diff($remote_ids_to_send, $remote_contact_ids_from_tbl_clients), SORT_REGULAR);
        }
        if (!empty($remote_ids_to_send)) {
            $this->ins_suppliers($remote_ids_to_send);
        }
    }
    
    public function ins_invoices_items($host)
    {
        $remote_ids_to_send = array();
        $where = array("host" => "$host", "saved_items_id" => 0);
        $tbl_items_res_d = get_any_field('tbl_items', $where, 'remote_item_id', TRUE);
        if (!empty($tbl_items_res_d)) {
            $remote_ids_to_send = array_column($tbl_items_res_d, 'remote_item_id');
        }
        
        if (!empty($remote_ids_to_send)) {
            $remote_items_ids_from_tbl_saved_items = $this->get_remote_items_ids_from_tbl_saved_items($host);
            if (!empty($remote_items_ids_from_tbl_saved_items)) {
                $remote_ids_to_send = array_unique(array_diff($remote_ids_to_send, $remote_items_ids_from_tbl_saved_items), SORT_REGULAR);
            }
        }
        $this->ins_items($remote_ids_to_send);
        
        if (!empty($remote_ids_to_send)) {
            foreach ($remote_ids_to_send as $item_id) {
                $this->ins_item($item_id);
            }
        }
    }
    
    
    public function fetch_projects()
    {
        $projects = array();
        $xeroTenantId = (string)$this->storage->getSession()['tenant_id'];
        $apiInstance = $this->xero_project_api();
        $project_ids = null;
        $contact_id = null;
        $states = null;
        $page = null;
        $page_size = null;
        
        try {
            $apiResponse = $apiInstance->getProjects($xeroTenantId, $project_ids, $contact_id, $states, $page, $page_size);
            if (count($apiResponse['items']) > 0) {
                $projects['data'] = $apiResponse['items'];
            }
        } catch (Exception $e) {
            $projects['error'] = $e->getMessage();
        }
        return $projects;
    }
    
    public function fetch_contacts($contact_type = null, $contact_ids = null)
    {
        $xeroTenantId = (string)$this->storage->getSession()['tenant_id'];
        $apiInstance = $this->xero_api_call();
        
        $if_modified_since = new \DateTime("2019-01-02T19:20:30+01:00"); // \DateTime | Only records created or modified since this timestamp will be returned
        $where = null;
        if ($contact_type == 'customers') {
            $where = 'IsCustomer == true';
        }
        if ($contact_type == 'suppliers') {
            $where = 'IsSupplier == true';
        }
        
        $order = 'name'; // string
        $ids = null; // string[] | Filter by a comma-separated list of Invoice Ids.
        if (isset($contact_ids)) {
            $ids = $contact_ids;
        }
        $page = 1; // int | e.g. page=1 – Up to 100 invoices will be returned in a single API call with line items
        $include_archived = null; // bool | e.g. includeArchived=true - Contacts with a status of ARCHIVED will be included
        
        try {
            $apiResponse = $apiInstance->getContacts($xeroTenantId, $if_modified_since, $where, $order, $ids, $page, $include_archived);
            if (count($apiResponse->getContacts()) > 0) {
                return $apiResponse->getContacts();
            }
        } catch (Exception $e) {
            echo 'Exception when calling AccountingApi->getContacts: ', $e->getMessage(), PHP_EOL;
            exit();
        }
        return false;
    }
    
    public function ins_customers($remote_contacts_ids = null, $contact_type = 'customers')
    {
        $return = 'No  (new) customer is found to be synchronized';
        $fetch_contacts = $this->fetch_contacts($contact_type, $remote_contacts_ids);
        $customers = !empty($fetch_contacts) ? $fetch_contacts : array();
        
        if (!empty($customers)) {
            $num_remote_customers = 0;
            $num_customers_in_db = 0;
            $num_ins_customers = 0;
            
            $num_remote_customers = count($customers);
            $tbl_customers_remote_ids = array();
            $where = array('host' => $this->host, 'remote_contact_id !=' => '');
            $tbl_customers_res = get_any_field('tbl_client', $where, 'remote_contact_id', true);
            if (!empty($tbl_customers_res)) {
                $num_customers_in_db = count($tbl_customers_res);
                $tbl_customers_remote_ids = array_flip(array_column($tbl_customers_res, 'remote_contact_id'));
            }
            $ins = array();
            $cn = 0;
            foreach ($customers as $c) {
                $remote_contact_id = $c['contact_id'];
                if (!isset($tbl_customers_remote_ids[$remote_contact_id])) {
                    $ins_data = array();
                    $ins_data['name'] = $c['name'];
                    $ins_data['email'] = $c['email_address'];
                    $ins_data['phone'] = $c['contact_number'];
                    $ins_data['mobile'] = $c['phones'][1]['phone_country_code'] . $c['phones'][1]['phone_area_code'] . $c['phones'][1]['phone_number'];
                    $ins_data['address'] = $c['addresses'][0]['address_line1'] . '</br>' . $c['addresses'][0]['address_line2'] . '</br>' . $c['addresses'][0]['address_line3'] . '</br>' . $c['addresses'][0]['address_line4'];
                    $ins_data['city'] = $c['addresses'][0]['city'];
                    $ins_data['zipcode'] = $c['addresses'][0]['postal_code'];
                    $ins_data['currency'] = $c['default_currency'];
                    $ins_data['skype_id'] = $c['skype_user_name'];
                    $ins_data['country'] = $c['addresses'][0]['country'];
                    $ins_data['host'] = $this->host;
                    $ins_data['remote_contact_id'] = $c['contact_id'];
                    $ins[] = $ins_data;
                    $cn++;
                    if (null === $remote_contacts_ids && $cn == $this->cn) break;
                }
            }
            
            if (!empty($ins)) {
                $table = 'tbl_client';
                $this->db->insert_batch($table, $ins);
                $num_ins_customers = count($ins);
                $left_customers = $num_remote_customers - $num_customers_in_db - $num_ins_customers;
                if ($left_customers > 0) {
                    $return = $left_customers . ' customers are still left to be synchronized, Please synchronize again';
                } else {
                    $return = 'All customers are now synchronized';
                }
            }
        }
        return $return;
    }
    
    public function ins_suppliers($remote_contacts_ids = null)
    {
        $return = 'No  (new) supplier is found to be synchronized';
        $fetch_contacts = $this->fetch_contacts('suppliers', $remote_contacts_ids);
        $customers = !empty($fetch_contacts) ? $fetch_contacts : array();
        if (!empty($customers)) {
            $num_customers_in_db = 0;
            $num_remote_customers = count($customers);
            $tbl_customers_remote_ids = array();
            $where = array('host' => $this->host, 'remote_contact_id !=' => '');
            $tbl_customers_res = get_any_field('tbl_suppliers', $where, 'remote_contact_id', true);
            if (!empty($tbl_customers_res)) {
                $num_customers_in_db = count($tbl_customers_res);
                $tbl_customers_remote_ids = array_flip(array_column($tbl_customers_res, 'remote_contact_id'));
            }
            
            $ins = array();
            $cn = 0;
            foreach ($customers as $c) {
                $remote_contact_id = $c['contact_id'];
                if (!isset($tbl_customers_remote_ids[$remote_contact_id])) {
                    
                    $ins_data = array();
                    $ins_data['name'] = $c['name'];
                    $ins_data['email'] = $c['email_address'];
                    $ins_data['phone'] = $c['contact_number'];
                    $ins_data['mobile'] = $c['phones'][1]['phone_country_code'] . $c['phones'][1]['phone_area_code'] . $c['phones'][1]['phone_number'];
                    $address = $c['addresses'][0]['country'];
                    $ins_data['address'] = $address;
                    $ins_data['host'] = $this->host;
                    $ins_data['remote_contact_id'] = $c['contact_id'];
                    $ins[] = $ins_data;
                    $cn++;
                    if (null === $remote_contacts_ids && $cn == $this->cn) break;
                }
            }
            
            if (!empty($ins)) {
                $table = 'tbl_suppliers';
                $this->db->insert_batch($table, $ins);
                $num_ins_customers = count($ins);
                $left_customers = $num_remote_customers - $num_customers_in_db - $num_ins_customers;
                if ($left_customers > 0) {
                    $return = $left_customers . ' suppliers are still left to be synchronized, Please synchronize again';
                } else {
                    $return = 'All suppliers are now synchronized';
                }
            }
        }
        return $return;
    }
    
    public function callback()
    {
        $provider = $this->xero_provider();
        // If we don't have an authorization code then get one
        if (!isset($_GET['code'])) {
            echo "Something went wrong, no authorization code found";
            exit();
            // Check given state against previously stored one to mitigate CSRF attack
        } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
            echo "Invalid State";
            unset($_SESSION['oauth2state']);
            exit('Invalid state');
        } else {
            try {
                // Try to get an access token using the authorization code grant.
                $accessToken = $provider->getAccessToken('authorization_code', [
                    'code' => $_GET['code']
                ]);
                $config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken((string)$accessToken->getToken());
                $identityInstance = new XeroAPI\XeroPHP\Api\IdentityApi(
                    new GuzzleHttp\Client(),
                    $config
                );
                $result = $identityInstance->getConnections();
                $this->storage->setToken(
                    $accessToken->getToken(),
                    $accessToken->getExpires(),
                    $result[0]->getTenantId(),
                    $accessToken->getRefreshToken(),
                    $accessToken->getValues()["id_token"]
                );
                redirect('admin/xero');
            } catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {
                echo "Callback failed";
                exit();
            }
        }
    }
    
    function xero_provider()
    {
        
        return new \League\OAuth2\Client\Provider\GenericProvider([
            'clientId' => config_item('xero_client_id'),
            'clientSecret' => config_item('xero_client_secret'),
            'redirectUri' => base_url() . 'admin/xero/callback',
            'urlAuthorize' => 'https://login.xero.com/identity/connect/authorize',
            'urlAccessToken' => 'https://identity.xero.com/connect/token',
            'urlResourceOwnerDetails' => 'https://api.xero.com/api.xro/2.0/Organisation'
        ]);
    }
    
    public function ins_payments_clients($host)
    {
        $remote_ids_to_send = array();
        $where = array('host' => "$host", 'paid_by' => 0);
        $tbl_payments_res_d = get_any_field('tbl_payments', $where, 'remote_contact_id', TRUE);
        if (!empty($tbl_payments_res_d)) {
            $remote_ids_to_send = array_column($tbl_payments_res_d, 'remote_contact_id');
        }
        
        $remote_contact_ids_from_tbl_clients = $this->get_remote_contact_ids_from_tbl($host, 'tbl_client');
        if (!empty($remote_contact_ids_from_tbl_clients)) {
            $remote_ids_to_send = array_unique(array_diff($remote_ids_to_send, $remote_contact_ids_from_tbl_clients), SORT_REGULAR);
        }
        if (!empty($remote_ids_to_send)) {
            $this->ins_customers($remote_ids_to_send);
        }
    }
    
    public function ins_payments_suppliers($host)
    {
        $remote_ids_to_send = array();
        $where = array('host' => "$host", 'paid_by' => 0);
        $tbl_payments_res_d = get_any_field('tbl_purchase_payments', $where, 'remote_contact_id', TRUE);
        if (!empty($tbl_payments_res_d)) {
            $remote_ids_to_send = array_column($tbl_payments_res_d, 'remote_contact_id');
        }
        
        $remote_contact_ids_from_tbl_clients = $this->get_remote_contact_ids_from_tbl($host, 'tbl_suppliers');
        if (!empty($remote_contact_ids_from_tbl_clients)) {
            $remote_ids_to_send = array_unique(array_diff($remote_ids_to_send, $remote_contact_ids_from_tbl_clients), SORT_REGULAR);
        }
        if (!empty($remote_ids_to_send)) {
            $this->ins_suppliers($remote_ids_to_send);
        }
    }
    
    public function ins_payments_invoices($host)
    {
        $remote_ids_to_send = $this->get_remote_invoices_ids_from_tbl_payments($host);
        if (!empty($remote_ids_to_send)) {
            $remote_invoices_ids_from_tbl_invoices = $this->get_remote_invoices_ids_from_tbl($host, 'tbl_invoices');
            if (!empty($remote_invoices_ids_from_tbl_invoices)) {
                $remote_ids_to_send = array_unique(array_diff($remote_ids_to_send, $remote_invoices_ids_from_tbl_invoices), SORT_REGULAR);
            }
        }
        if (!empty($remote_ids_to_send)) {
            $this->ins_invoices($remote_ids_to_send);
        }
    }
    
    public function ins_payments_purchases($host)
    {
        $remote_ids_to_send = $this->get_remote_purchases_ids_from_tbl_purchase_payments($host);
        if (!empty($remote_ids_to_send)) {
            $remote_invoices_ids_from_tbl_invoices = $this->get_remote_purchases_ids_from_tbl_purchase_payments($host);
            if (!empty($remote_invoices_ids_from_tbl_invoices)) {
                $remote_ids_to_send = array_unique(array_diff($remote_ids_to_send, $remote_invoices_ids_from_tbl_invoices), SORT_REGULAR);
            }
        }
        if (!empty($remote_ids_to_send)) {
            $this->ins_purchases($remote_ids_to_send);
        }
    }
    
    public function get_remote_contact_ids_from_tbl($host, $table_name)
    {
        $remote_contact_ids_from_tbl_clients = array();
        $where2 = array("host" => "$host");
        $tbl_client_d = get_any_field($table_name, $where2, 'remote_contact_id', TRUE);
        if (!empty($tbl_client_d)) {
            $remote_contact_ids_from_tbl_clients = array_column($tbl_client_d, 'remote_contact_id');;
        }
        return $remote_contact_ids_from_tbl_clients;
    }
    
    public function get_remote_payments_ids_from_table($host, $table_name)
    {
        $remote_payments_ids_from_tbl_payments = array();
        $where = array("host" => "$host");
        $tbl_payments_res_d = get_any_field($table_name, $where, 'remote_payment_id', TRUE);
        if (!empty($tbl_payments_res_d)) {
            $remote_payments_ids_from_tbl_payments = array_column($tbl_payments_res_d, 'remote_payment_id');
        }
        return $remote_payments_ids_from_tbl_payments;
    }
    
    public function get_remote_items_ids_from_tbl_saved_items($host)
    {
        $remote_items_ids_from_tbl_saved_items = array();
        $where2 = array("host" => "$host");
        $tbl_saved_items_d = get_any_field('tbl_saved_items', $where2, 'remote_item_id', TRUE);
        if (!empty($tbl_saved_items_d)) {
            $remote_items_ids_from_tbl_saved_items = array_column($tbl_saved_items_d, 'remote_item_id');
        }
        return $remote_items_ids_from_tbl_saved_items;
    }
    
    public function get_remote_purchases_ids_from_tbl_purchase_payments($host)
    {
        $remote_invoices_ids_from_tbl_payments = array();
        $where = array("host" => "$host", "purchase_id" => 0);
        $tbl_payments_res_d = get_any_field('tbl_purchase_payments', $where, 'remote_invoice_id', TRUE);
        if (!empty($tbl_payments_res_d)) {
            $remote_invoices_ids_from_tbl_payments = array_column($tbl_payments_res_d, 'remote_invoice_id');
        }
        return $remote_invoices_ids_from_tbl_payments;
    }
    
    public function get_remote_invoices_ids_from_tbl_payments($host)
    {
        $remote_invoices_ids_from_tbl_payments = array();
        $where = array("host" => "$host", "invoices_id" => 0);
        $tbl_payments_res_d = get_any_field('tbl_payments', $where, 'remote_invoice_id', TRUE);
        if (!empty($tbl_payments_res_d)) {
            $remote_invoices_ids_from_tbl_payments = array_column($tbl_payments_res_d, 'remote_invoice_id');
        }
        return $remote_invoices_ids_from_tbl_payments;
    }
    
    public function get_remote_invoices_ids_from_tbl($host, $table_name)
    {
        $remote_invoices_ids_from_invoices_tbl = array();
        $where2 = array("host" => "$host");
        $tbl_invoices_d = get_any_field($table_name, $where2, 'remote_invoice_id', TRUE);
        if (!empty($tbl_invoices_d)) {
            $remote_invoices_ids_from_invoices_tbl = array_column($tbl_invoices_d, 'remote_invoice_id');
        }
        return $remote_invoices_ids_from_invoices_tbl;
    }
    
    public function update_invoices_items_ids_names($host)
    {
        $this->db->query("UPDATE tbl_items
        INNER JOIN tbl_saved_items ON tbl_items.remote_item_id = tbl_saved_items.remote_item_id
        AND  tbl_items.host = '$host' AND  tbl_saved_items.host = '$host' AND tbl_saved_items.remote_item_id IS NOT NULL
        AND tbl_items.saved_items_id = 0
        SET tbl_items.saved_items_id = tbl_saved_items.saved_items_id, tbl_items.item_name = tbl_saved_items.item_name");
    }
    
    public function update_invoices_clients_ids($host)
    {
        $this->db->query("UPDATE tbl_invoices
        INNER JOIN tbl_client ON tbl_invoices.remote_client_id = tbl_client.remote_contact_id
        AND  tbl_invoices.host = '$host' AND  tbl_client.host = '$host' AND tbl_invoices.client_id = 0
        SET tbl_invoices.client_id = tbl_client.client_id");
    }
    
    public function update_purchases_suppliers_ids($host)
    {
        $this->db->query("UPDATE tbl_purchases
        INNER JOIN tbl_suppliers ON tbl_purchases.remote_supplier_id = tbl_suppliers.remote_contact_id
        AND  tbl_purchases.host = '$host' AND  tbl_suppliers.host = '$host'  AND tbl_purchases.supplier_id = 0
        SET tbl_purchases.supplier_id = tbl_suppliers.supplier_id");
    }
    
    public function update_items_invoices_ids($host)
    {
        $this->db->query("UPDATE tbl_items
        INNER JOIN tbl_invoices ON tbl_invoices.remote_invoice_id = tbl_items.remote_invoice_id
        AND  tbl_invoices.host = '$host' AND  tbl_items.host = '$host' AND tbl_items.invoices_id = 0
        SET tbl_items.invoices_id = tbl_invoices.invoices_id");
    }
    
    public function update_purchases_items_suppliers_ids($host)
    {
        $this->db->query("UPDATE tbl_purchase_items
        INNER JOIN tbl_purchases ON tbl_purchases.remote_invoice_id = tbl_purchase_items.remote_invoice_id
        AND  tbl_purchases.host = '$host' AND  tbl_purchase_items.host = '$host' AND tbl_purchase_items.purchase_id = 0
        SET tbl_purchase_items.purchase_id = tbl_purchases.purchase_id");
    }
    
    public function update_payments_invoices_ids($host)
    {
        $this->db->query("UPDATE tbl_payments
        INNER JOIN tbl_invoices ON tbl_payments.remote_invoice_id = tbl_invoices.remote_invoice_id
        AND  tbl_payments.host = '$host' AND  tbl_invoices.host = '$host' AND tbl_payments.invoices_id = 0
        SET tbl_payments.invoices_id = tbl_invoices.invoices_id");
    }
    
    public function update_purchases_payments_purchases_ids($host)
    {
        $this->db->query("UPDATE tbl_purchase_payments
        INNER JOIN tbl_purchases ON tbl_purchase_payments.remote_invoice_id = tbl_purchases.remote_invoice_id
        AND  tbl_purchase_payments.host = '$host' AND  tbl_purchases.host = '$host' AND tbl_purchase_payments.purchase_id = 0
        SET tbl_purchase_payments.purchase_id = tbl_purchases.purchase_id");
    }
    
    public function update_tbl_projects_clients_ids($host)
    {
        $this->db->query("UPDATE tbl_project
        INNER JOIN tbl_client ON tbl_project.remote_contact_id = tbl_client.remote_contact_id
        AND  tbl_project.host = '$host' AND  tbl_client.host = '$host' AND tbl_project.client_id =0
        SET tbl_project.client_id = tbl_client.client_id");
    }
    
}
