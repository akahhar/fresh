<?php
defined('BASEPATH') or exit('No direct script access allowed');
require './modules/quickbooks/vendor/autoload.php';

use oasis\names\specification\ubl\schema\xsd\QualifiedDatatypes_2\PortCodeType;
use QuickBooksOnline\API\DataService\DataService;

class Quickbooks extends Admin_Controller
{
    /**
     * Controler __construct function to initialize options.
     */
    public function __construct()
    {
        parent::__construct();
        $this->qbConfig = array(
            'ClientID' => config_item('quickbooks_client_id'),
            'ClientSecret' => config_item('quickbooks_client_secret'),
            'RedirectURI' => base_url() . 'admin/quickbooks/callback',
            'baseUrl' => "development",
            'QBORealmID' => "The Company ID which the app wants to access",
        
        );
        $this->host = 'quickbooks';
        $this->cn = config_item('quickbooks_sync_each_time');
    }
    
    public function settings()
    {
        $data = array();
        $data['title'] = 'QuickBooks Settings';
        
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div>', '</div>');
        $this->form_validation->set_rules('client_id', lang('client_id'), 'required');
        $this->form_validation->set_rules('client_secret', lang('client_secret'), 'required');
        $this->form_validation->set_rules('quickbooks_sync_each_time', lang('quickbooks_sync_each_time'), 'required');
        
        $data['client_id'] = config_item('quickbooks_client_id');
        $data['client_secret'] = config_item('quickbooks_client_secret');
        
        if ($this->form_validation->run() == true) {
            $quickbooks_client_id = $this->input->post('client_id', false);
            $quickbooks_client_secret = $this->input->post('client_secret', false);
            $quickbooks_sync_each_time = $this->input->post('quickbooks_sync_each_time', false);
            $this->db->query("INSERT INTO tbl_config (config_key, value) VALUES('quickbooks_client_id', '$quickbooks_client_id') ON DUPLICATE KEY UPDATE value='$quickbooks_client_id'");
            $this->db->query("INSERT INTO tbl_config (config_key, value) VALUES('quickbooks_client_secret', '$quickbooks_client_secret') ON DUPLICATE KEY UPDATE value='$quickbooks_client_secret'");
            $this->db->query("INSERT INTO tbl_config (config_key, value) VALUES('quickbooks_sync_each_time', '$quickbooks_sync_each_time') ON DUPLICATE KEY UPDATE value='$quickbooks_sync_each_time'");
            redirect('admin/quickbooks');
        } else {
            $s_data['form_error'] = validation_errors();
            $this->session->set_userdata($s_data);
        }
        
        $data['subview'] = $this->load->view('settings', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }
    
    public function index()
    {
        $data = array();
        $data['page'] = 'QuickBooks';
        $data['title'] = 'QuickBooks';
        
        $data['client_id'] = config_item('quickbooks_client_id');
        $data['client_secret'] = config_item('quickbooks_client_secret');
        
        $dataService = $this->qbooks_data_service();
        if (!empty($dataService)) {
            $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
            $data['authUrl'] = $authUrl = $OAuth2LoginHelper->getAuthorizationCodeURL();
            $_SESSION['authUrl'] = $authUrl;
            if (isset($_SESSION['sessionAccessToken'])) {
                
                $data['accessToken'] = $accessToken = $_SESSION['sessionAccessToken'];
                $data['accessTokenJson'] = array(
                    'token_type' => 'bearer',
                    'access_token' => $accessToken->getAccessToken(),
                    'refresh_token' => $accessToken->getRefreshToken(),
                    'x_refresh_token_expires_in' => $accessToken->getRefreshTokenExpiresAt(),
                    'expires_in' => $accessToken->getAccessTokenExpiresAt()
                );
                
                $dataService->updateOAuth2Token($accessToken);
                $data['oauthLoginHelper'] = $dataService->getOAuth2LoginHelper();
                $data['CompanyInfo'] = $companyInfo = $dataService->getCompanyInfo();
            }
        }
        
        $data['subview'] = $this->load->view('index', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }
    
    public function callback()
    {
        $this->processCode();
    }
    
    function processCode()
    {
        // Create SDK instance
        $dataService = $this->qbooks_data_service();
        $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
        $parseUrl = $this->parseAuthRedirectUrl($_SERVER['QUERY_STRING']);
        /*
         * Update the OAuth2Token
         */
        $accessToken = $OAuth2LoginHelper->exchangeAuthorizationCodeForToken($parseUrl['code'], $parseUrl['realmId']);
        $dataService->updateOAuth2Token($accessToken);
        
        /*
         * Setting the accessToken for session variable
         */
        $_SESSION['qb_realmId'] = $parseUrl['realmId'];
        $_SESSION['sessionAccessToken'] = $accessToken;
    }
    
    function parseAuthRedirectUrl($url)
    {
        parse_str($url, $qsArray);
        return array(
            'code' => $qsArray['code'],
            'realmId' => $qsArray['realmId']
        );
    }
    
    function qbooks_data_service()
    {
        if (!empty($this->qbConfig['ClientID'])) {
            return DataService::Configure(array(
                'auth_mode' => 'oauth2',
                'ClientID' => $this->qbConfig['ClientID'],
                'ClientSecret' => $this->qbConfig['ClientSecret'],
                'RedirectURI' => $this->qbConfig['RedirectURI'],
                'scope' => 'com.intuit.quickbooks.accounting openid profile email phone address',
                'baseUrl' => $this->qbConfig['baseUrl'],
            
            ));
        }
    }
    
    function refreshToken()
    {
        $accessToken = $_SESSION['sessionAccessToken'];
        $dataService = DataService::Configure(array(
            'auth_mode' => 'oauth2',
            'ClientID' => $this->qbConfig['ClientID'],
            'ClientSecret' => $this->qbConfig['ClientSecret'],
            'RedirectURI' => $this->qbConfig['RedirectURI'],
            'baseUrl' => $this->qbConfig['baseUrl'],
            'QBORealmID' => $_SESSION['qb_realmId'],
            'refreshTokenKey' => $accessToken->getRefreshToken(),
        ));
        
        $OAuth2LoginHelper = $dataService->getOAuth2LoginHelper();
        $refreshedAccessTokenObj = $OAuth2LoginHelper->refreshToken();
        $dataService->updateOAuth2Token($refreshedAccessTokenObj);
        $_SESSION['sessionAccessToken'] = $refreshedAccessTokenObj;
        return $refreshedAccessTokenObj;
    }
    
    function makeAPICall()
    {
        $dataService = $this->qbooks_data_service();
        $accessToken = $_SESSION['sessionAccessToken'];
        $dataService->updateOAuth2Token($accessToken);
        return $dataService;
    }
    
    public function fetch_data($IntuitEntity, $ids_to_send = null)
    {
        $entities = array();
        $refreshedAccessTokenObj = $this->refreshToken();
        $dataService = $this->makeAPICall();
        $whereSql = '';
        if (isset($ids_to_send) && is_array($ids_to_send)) {
            if (!empty($ids_to_send)) {
                $ids_to_send = implode("','", $ids_to_send);
                $whereSql .= "WHERE id in ('$ids_to_send')";
                $entities = $dataService->Query("Select * from $IntuitEntity $whereSql  ORDERBY Id");
            }
        } else {
            $entities = $dataService->Query("Select * from $IntuitEntity  ORDERBY Id");
        }
        
        $error = $dataService->getLastError();
        if ($error) {
            if ($error->getHttpStatusCode() == '401') {
            }
            echo "The Status code is: " . $error->getHttpStatusCode() . "\n";
            echo "The Helper message is: " . $error->getOAuthHelperError() . "\n";
            echo "The Response message is: " . $error->getResponseBody() . "\n";
            exit();
        }
        $entities = json_decode(json_encode($entities), true);
        return $entities;
    }
    
    public function clients()
    {
        if ($this->input->is_ajax_request()) {
            $rata['sync_result'] = $this->ins_customers();
            echo json_encode($rata);
            exit;
        }
        redirect('admin/dashboard');
    }
    
    public function suppliers()
    {
        if ($this->input->is_ajax_request()) {
            $rata['sync_result'] = $this->ins_suppliers();
            echo json_encode($rata);
            exit;
        }
        redirect('admin/dashboard');
    }
    
    public function items()
    {
        if ($this->input->is_ajax_request()) {
            $rata['sync_result'] = $this->ins_items();
            echo json_encode($rata);
            exit;
        }
        redirect('admin/dashboard');
    }
    
    public function invoices()
    {
        if ($this->input->is_ajax_request()) {
            $rata['sync_result'] = $this->ins_invoices();
            echo json_encode($rata);
            exit;
        }
        redirect('admin/dashboard');
    }
    
    public function purchases()
    {
        if ($this->input->is_ajax_request()) {
            $rata['sync_result'] = $this->ins_purchases();
            echo json_encode($rata);
            exit;
        }
        redirect('admin/dashboard');
    }
    
    public function expenses()
    {
        if ($this->input->is_ajax_request()) {
            $rata['sync_result'] = $this->ins_expenses();
            echo json_encode($rata);
            exit;
        }
        redirect('admin/dashboard');
    }
    
    public function projects()
    {
        if ($this->input->is_ajax_request()) {
            $rata['sync_result'] = $this->ins_projects();
            echo json_encode($rata);
            exit;
        }
        redirect('admin/dashboard');
    }
    
    public function payments()
    {
        if ($this->input->is_ajax_request()) {
            $rata['sync_result'] = $this->ins_payments();
            echo json_encode($rata);
            exit;
        }
        redirect('admin/dashboard');
    }
    
    public function purchase_payments()
    {
        
        if ($this->input->is_ajax_request()) {
            $rata['sync_result'] = $this->ins_purchase_payments();
            echo json_encode($rata);
            exit;
        }
        redirect('admin/dashboard');
    }
    
    public function ins_customers($remote_contacts_ids = null)
    {
        $return = 'No  (new) customer is found to be synchronized';
        
        $fetch_customers = $this->fetch_data('Customer', $remote_contacts_ids);
        $customers = !empty($fetch_customers) ? $fetch_customers : array();
        
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
                $remote_contact_id = $c['Id'];
                if ($c['IsProject'] == 'false' && !isset($tbl_customers_remote_ids[$remote_contact_id])) {
                    $ins_data = array();
                    $ins_data['name'] = $c['DisplayName'];
                    $ins_data['email'] = $c['PrimaryEmailAddr']['Address'];
                    $ins_data['short_note'] = $c['Notes'];
                    $ins_data['website'] = $c['domain'];
                    $ins_data['phone'] = $c['PrimaryPhone']['FreeFormNumber'];
                    $ins_data['mobile'] = isset($c['Mobile']['FreeFormNumber']) ? $c['Mobile']['FreeFormNumber'] : " ";
                    $ins_data['fax'] = isset($c['Fax']['FreeFormNumber']) ? $c['Fax']['FreeFormNumber'] : " ";
                    $ins_data['address'] = $c['BillAddr']['Line1'] . '</br>' . $c['BillAddr']['Line2'] . '</br>' . $c['BillAddr']['Line3'] . '</br>' . $c['BillAddr']['Line4'] . '</br>' . $c['BillAddr']['Line5'];
                    $ins_data['city'] = $c['BillAddr']['City'];
                    $ins_data['zipcode'] = $c['BillAddr']['PostalCode'];
                    $ins_data['currency'] = $c['CurrencyRef'];
                    // $ins_data['sms_notification'] = ;
                    //$ins_data['skype_id'] = $c['skype_user_name'];
                    // $ins_data['linkedin'] = ;
                    // $ins_data['facebook'] = ;
                    // $ins_data['twitter'] = ;
                    $ins_data['country'] = $c['BillAddr']['Country'];
                    // $ins_data['vat'] = ;
                    // $ins_data['hosting_company'] = ;
                    // $ins_data['hostname'] = ;
                    // $ins_data['port'] = ;
                    // $ins_data['username'] = ;
                    $ins_data['latitude'] = $c['BillAddr']['Lat'];
                    $ins_data['longitude'] = $c['BillAddr']['Long'];
                    //$ins_data['customer_group_id'] = ;
                    $ins_data['host'] = $this->host;
                    $ins_data['remote_contact_id'] = $remote_contact_id;
                    
                    $ins[] = $ins_data;
                    $cn++;
                    if (null === $remote_contacts_ids && $cn == $this->cn) break;
                }
            }
            if (!empty($ins)) {
                $this->db->insert_batch('tbl_client', $ins);
                $return = count($ins) . ' customers are synchronized, Please synchronize again';
            } else {
                $return = 'All customers are now synchronized';
            }
        }
        return $return;
    }
    
    public function ins_projects($remote_contacts_ids = null)
    {
        $return = 'No  (new) project is found to be synchronized';
        $num_remote_items = 0;
        $num_items_in_db = 0;
        $num_ins_items = 0;
        $projects = $this->fetch_data('Customer', $remote_contacts_ids);
        
        $ins = array();
        $remote_contacts_ids = array();
        $cn = 0;
        
        if (!empty($projects)) {
            $num_remote_items = count($projects);
            $tbl_items_remote_ids = array();
            $where = array('host' => $this->host);
            $tbl_saved_items_res = $this->get_remote_project_ids_from_tbl($this->host, 'tbl_project');
            if (!empty($tbl_saved_items_res)) {
                $num_items_in_db = count($tbl_saved_items_res);
                $tbl_items_remote_ids = array_flip($tbl_saved_items_res);
            }
            
            foreach ($projects as $v) {
                $remote_project_id = $v['Id'];
                if ($v['IsProject'] == 'true' && !isset($tbl_items_remote_ids[$remote_project_id])) {
                    $data = array();
                    $data['project_name'] = $v['DisplayName'];
                    $data['client_id'] = 0;
                    //$data['start_date'] = 0;
                    // $data['end_date'] = 0;
                    
                    //$data['project_cost'] = $v['total_task_amount']['value'];
                    $data['project_status'] = $v['status'];
                    
                    $data['host'] = $this->host;
                    $data['remote_project_id'] = $remote_project_id;
                    $contact_id = $v['ParentRef'];
                    $data['remote_contact_id'] = $contact_id;
                    $ins[] = $data;
                    $remote_contacts_ids[] = $contact_id;
                    $cn++;
                    if ($cn == $this->cn) break;
                }
            }
            
            if (!empty($ins)) {
                $this->db->insert_batch('tbl_project', $ins);
                $return = count($ins) . ' projects are synchronized, Please synchronize again';
            } else {
                $return = 'All projects are now synchronized';
            }
        }
        $this->ins_customers($remote_contacts_ids, null);
        
        $this->update_tbl_projects_clients_ids($this->host);
        
        return $return;
    }
    
    public function ins_suppliers($remote_contacts_ids = null)
    {
        $return = 'No  (new) vendor / supplier is found to be synchronized';
        
        $fetch_contacts = $this->fetch_data('Vendor', $remote_contacts_ids);
        $customers = !empty($fetch_contacts) ? $fetch_contacts : array();
        if (!empty($customers)) {
            $num_remote_customers = 0;
            $num_customers_in_db = 0;
            $num_ins_customers = 0;
            
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
                $remote_contact_id = $c['Id'];
                if (!isset($tbl_customers_remote_ids[$remote_contact_id])) {
                    $ins_data = array();
                    $ins_data['name'] = $c['DisplayName'];
                    $ins_data['email'] = isset($c['PrimaryEmailAddr']['Address']) ? $c['PrimaryEmailAddr']['Address'] : " ";
                    //$ins_data['short_note'] = $c['Notes'];
                    //$ins_data['website'] = $c['domain'];
                    $ins_data['phone'] = isset($c['PrimaryPhone']) ? $c['PrimaryPhone']['FreeFormNumber'] : '';
                    $ins_data['mobile'] = isset($c['Mobile']['FreeFormNumber']) ? $c['Mobile']['FreeFormNumber'] : " ";
                    if (isset($c['BillAddr'])) {
                        $ins_data['address'] = $c['BillAddr']['Line1'] . '</br>' . $c['BillAddr']['Line2'] . '</br>' . $c['BillAddr']['Line3'] . '</br>' . $c['BillAddr']['Line4'] . '</br>' . $c['BillAddr']['Line5'];
                    } else {
                        $ins_data['address'] = '';
                    }
                    //$ins_data['city'] = $c['BillAddr']['City'];
                    //$ins_data['zipcode'] = $c['BillAddr']['PostalCode'];
                    //$ins_data['currency'] = $c['CurrencyRef'];
                    
                    //$ins_data['country'] = $c['BillAddr']['Country'];
                    // $ins_data['vat'] = ;
                    
                    //$ins_data['latitude'] = $c['BillAddr']['Lat'];
                    //$ins_data['longitude'] = $c['BillAddr']['Long'];
                    //$ins_data['customer_group_id'] = ;
                    $ins_data['host'] = $this->host;
                    $ins_data['remote_contact_id'] = $remote_contact_id;
                    $ins[] = $ins_data;
                    $cn++;
                    if (null === $remote_contacts_ids && $cn == $this->cn) break;
                }
            }
            
            if (!empty($ins)) {
                $this->db->insert_batch('tbl_suppliers', $ins);
                // echo $this->db->last_query(); exit;
                $num_ins_customers = count($ins);
                $left_customers = $num_remote_customers - $num_customers_in_db - $num_ins_customers;
                if ($left_customers > 0) {
                    $return = $left_customers . ' vendors / suppliers are still left to be synchronized, Please synchronize again';
                } else {
                    $return = 'All vendors / suppliers are now synchronized';
                }
            }
        }
        return $return;
    }
    
    public function ins_items($ids_to_send = null)
    {
        $return = 'No  (new) item is found to be synchronized';
        $num_remote_items = 0;
        $num_items_in_db = 0;
        $num_ins_items = 0;
        $items = $this->fetch_data('item', $ids_to_send);
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
                $remote_item_id = $v['Id'];
                if (!isset($tbl_items_remote_ids[$remote_item_id])) {
                    $data = array();
                    $data['item_name'] = $v['Name'];
                    $data['item_desc'] = $v['Description'];
                    //$data['code'] = $v['code'];
                    //$data['cost_price'] = $v['purchase_details']['unit_price'];
                    $data['unit_cost'] = $v['UnitPrice'];
                    //$data['unit_type'] = $v['unit_type'];
                    $data['quantity'] = $v['QtyOnHand'];
                    
                    $data['host'] = 'quickbooks';
                    $data['remote_item_id'] = $remote_item_id;
                    $ins[] = $data;
                    $cn++;
                    if (null === $ids_to_send && $cn == $this->cn) break;
                }
            }
        }
        
        if (!empty($ins)) {
            $this->db->insert_batch('tbl_saved_items', $ins);
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
    
    public function ins_invoices($remote_invoices_ids = null)
    {
        $return = 'No  (new) invoices are found to be synchronized';
        $num_remote_invoices = 0;
        $num_invoices_in_db = 0;
        $num_ins_invoices = 0;
        $invoices = $this->fetch_data('invoice', $remote_invoices_ids);
        
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
                
                $remote_invoice_id = $v['Id'];
                if (!isset($tbl_invoices_remote_ids[$remote_invoice_id])) {
                    $data = array();
                    //$client_id  = $client_res->client_id;
                    // invoices_id, recur_start_date, recur_end_date, reference_no, client_id, project_id, invoice_date,
                    // invoice_month, invoice_year, due_date, alert_overdue, notes, tax, total_tax, discount_percent,
                    // recurring, recuring_frequency, recur_frequency, recur_next_date, currency, status, archived, date_sent,
                    // inv_deleted, date_saved, emailed, show_client, viewed, allow_paypal, allow_stripe, allow_2checkout,
                    // allow_authorize, allow_ccavenue, allow_braintree, allow_mollie, allow_payumoney, allow_tapPayment,
                    // allow_razorpay, permission,
                    // client_visible, discount_type, user_id, adjustment, discount_total, show_quantity_as, tags, host
                    
                    $data['reference_no'] = $v['DocNumber'];
                    //$data['client_id'] = $client_id;
                    $data['client_id'] = 0;
                    // $data['project_id'] = ;
                    $data['invoice_date'] = $v['TxnDate'];
                    $data['due_date'] = $v['DueDate'];
                    $data['user_id'] = my_id();
                    $data['currency'] = $v['CurrencyRef'];
                    // //$data['sub_total'] = $sub_total;
                    // $data['tax'] = ;
                    $data['total_tax'] = $v['TxnTaxDetail']['TotalTax'];
                    // $data['discount_percent'] = ;
                    //$data['discount_total'] = $v['total_discount'];
                    // $data['status'] = $v['status'];
                    $data['host'] = 'quickbooks';
                    $data['remote_invoice_id'] = $remote_invoice_id;
                    $data['remote_client_id'] = $v['CustomerRef'];
                    
                    $line_items = $v['Line'];
                    
                    $discount_total = 0;
                    
                    if (!empty($line_items)) {
                        foreach ($line_items as $items) {
                            if (($items['DetailType'] == 'SalesItemLineDetail')) {
                                $items_data['item_tax_total'] = $items['SalesItemLineDetail']['TaxInclusiveAmt'];
                                //$items_data['item_discount_total'] = $items['SalesItemLineDetail']['DiscountAmt'];
                                if ($items['SalesItemLineDetail']['DiscountAmt'] > 0) {
                                    $discount_total += $items['SalesItemLineDetail']['DiscountAmt'];
                                }
                                $items_data['quantity'] = $items['SalesItemLineDetail']['Qty'];
                                $items_data['unit_cost'] = $items['SalesItemLineDetail']['UnitPrice'];
                                $items_data['total_cost'] = $items['Amount'];
                                $items_data['item_name'] = '';
                                $items_data['item_desc'] = $items['Description'];
                                $items_data['remote_item_id'] = $items['SalesItemLineDetail']['ItemRef'];
                                $items_data['host'] = $this->host;
                                $items_data['remote_invoice_id'] = $remote_invoice_id;
                                $ins_items[] = $items_data;
                            }
                        }
                    }
                    
                    $data['discount_total'] = $discount_total;
                    $ins[] = $data;
                    //}
                    $cn++;
                    if (null === $remote_invoices_ids && $cn == $this->cn) break;
                }
            }
        }
        
        if (!empty($ins)) {
            $this->db->insert_batch('tbl_invoices', $ins);
            $this->db->insert_batch('tbl_items', $ins_items);
            /*  if (!empty($ins_pay)) {
                $this->db->insert_batch('tbl_payments', $ins_pay);
            } */
            $num_ins_invoices = count($ins);
            $left_invoices = $num_remote_invoices - $num_invoices_in_db - $num_ins_invoices;
            if ($left_invoices > 0) {
                $return = $left_invoices . ' invoices are still left to be synchronized, Please synchronize again';
            } else {
                $return = 'All invoices are now synchronized';
            }
        }
        
        $this->ins_invoices_clients($this->host);
        //$this->ins_invoices_items($this->host);
        
        $this->update_invoices_clients_ids($this->host);
        $this->update_items_invoices_ids($this->host);
        //$this->update_invoices_items_ids_names($this->host);
        //$this->update_payments_clients_ids($this->host);
        $this->update_payments_invoices_ids($this->host);
        
        
        return $return;
    }
    
    public function ins_payments($ids_to_send = null)
    {
        $return = 'No  (new) payments is found to be synchronized';
        $num_remote_items = 0;
        $num_items_in_db = 0;
        $num_ins_items = 0;
        $payments = $this->fetch_data('Payment');
        // echo '<pre>';
        // print_r($payments);
        // exit();
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
                $remote_payment_id = $v['Id'];
                if (!isset($existing_remote_ids[$remote_payment_id])) {
                    $data = array();
                    $data['payment_method'] = 'From ' . $this->host;
                    $data['payment_date'] = $v['TxnDate'];
                    $data['currency'] = $v['CurrencyRef'];
                    $data['invoices_id'] = 0;
                    $data['remote_payment_id'] = $remote_payment_id;
                    $data['remote_contact_id'] = $v['CustomerRef'];
                    //$data['remote_payment_method_id'] = $v['PaymentMethodRef'];
                    $data['remote_account_id'] = $v['DepositToAccountRef'];
                    $data['host'] = $this->host;
                    if (isset($v['Line']['LinkedTxn']['TxnType']) && $v['Line']['LinkedTxn']['TxnType'] == 'Invoice') {
                        //$data['amount'] = $v['TotalAmt'];
                        $data['amount'] = $v['Line']['Amount'];
                        $remote_invoice_id = $v['Line']['LinkedTxn']['TxnId'];
                        $data['remote_invoice_id'] = $remote_invoice_id;
                        $payments_invoices_ids[] = $remote_invoice_id;
                    } else {
                        foreach ($v['Line'] as $m) {
                            if ($m['LinkedTxn']['TxnType'] == 'Invoice') {
                                $data['amount'] = $m['Amount'];
                                $remote_invoice_id = $m['LinkedTxn']['TxnId'];
                                $data['remote_invoice_id'] = $remote_invoice_id;
                                $payments_invoices_ids[] = $remote_invoice_id;
                            }
                        }
                    }
                    
                    $ins[] = $data;
                    $cn++;
                    if (null === $ids_to_send && $cn == $this->cn) break;
                }
            }
        }
        
        if (!empty($ins)) {
            $this->db->insert_batch('tbl_payments', $ins);
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
        //$this->update_payments_clients_ids($this->host);
        
        return $return;
    }
    
    public function ins_purchase_payments($ids_to_send = null)
    {
        $return = 'No  (new) purchase payments is found to be synchronized';
        $num_remote_items = 0;
        $num_items_in_db = 0;
        
        $num_ins_items = 0;
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
                //if($v['payment_type'] == 'ACCPAYPAYMENT'){
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
                //}
            }
        }
        
        if (!empty($ins)) {
            $this->db->insert_batch('tbl_purchase_payments', $ins);
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
    
    public function ins_purchases($remote_invoices_ids = null)
    {
        $return = 'No  (new) purchase are found to be synchronized';
        $num_remote_invoices = 0;
        $num_invoices_in_db = 0;
        $num_ins_invoices = 0;
        $invoices = $this->fetch_data('PurchaseOrder ', $remote_invoices_ids);
        // echo '<pre>';
        // print_r(count($invoices));
        // print_r($invoices[0]);
        // print_r($invoices[1]);
        // echo '</pre>';
        // exit();
        
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
                //if ($v['LinkedTxn']['TxnType'] == 'Bill') {
                $remote_invoice_id = $v['Id'];
                if (!isset($tbl_invoices_remote_ids[$remote_invoice_id])) {
                    $data = array();
                    //$data['reference_no'] =  !empty($v['reference']) ?  $v['reference'] . ' : ' : '' . $v['invoice_number'];
                    //$data['client_id'] = $client_id;
                    $data['supplier_id'] = 0;
                    // $data['project_id'] = ;
                    $data['purchase_date'] = $v['TxnDate'];
                    $data['due_date'] = $v['DueDate'];
                    $data['user_id'] = my_id();
                    //$data['currency'] = $v['currency_code'];
                    // //$data['sub_total'] = $sub_total;
                    $data['total'] = $v['TotalAmt'];
                    // $data['tax'] = ;
                    //$data['total_tax'] = $v['total_tax'];
                    // $data['discount_percent'] = ;
                    //$data['discount_total'] = isset($v['total_discount']) ? $v['total_discount'] : 0;
                    // $data['status'] = $v['status'];
                    $data['host'] = $this->host;
                    $data['remote_invoice_id'] = $remote_invoice_id;
                    $data['remote_supplier_id'] = $v['VendorRef'];
                    
                    $line_items = $v['Line'];
                    if (!empty($line_items)) {
                        if (isset($line_items['ItemBasedExpenseLineDetail'])) {
                            $items_data = array();
                            $items_data['purchase_id'] = 0;
                            //$items_data['item_tax_total'] = $items['tax_amount'];
                            $items_data['quantity'] = $line_items['ItemBasedExpenseLineDetail']['Qty'];
                            $items_data['unit_cost'] = $line_items['ItemBasedExpenseLineDetail']['UnitPrice'];
                            $items_data['total_cost'] = $line_items['Amount'];
                            $items_data['item_name'] = '';
                            $items_data['item_desc'] = $line_items['Description'];
                            //$items_data['remote_item_id'] = $items['line_item_id'];
                            $items_data['remote_item_id'] = $line_items['ItemBasedExpenseLineDetail']['ItemRef'];
                            $items_data['host'] = $this->host;
                            $items_data['remote_invoice_id'] = $remote_invoice_id;
                            $ins_items[] = $items_data;
                        } else {
                            foreach ($line_items as $items) {
                                $items_data = array();
                                $items_data['purchase_id'] = 0;
                                //$items_data['item_tax_total'] = $items['tax_amount'];
                                $items_data['quantity'] = $items['ItemBasedExpenseLineDetail']['Qty'];
                                $items_data['unit_cost'] = $items['ItemBasedExpenseLineDetail']['UnitPrice'];
                                $items_data['total_cost'] = $items['Amount'];
                                $items_data['item_name'] = '';
                                $items_data['item_desc'] = $items['Description'];
                                //$items_data['remote_item_id'] = $items['line_item_id'];
                                $items_data['remote_item_id'] = $items['ItemBasedExpenseLineDetail']['ItemRef'];
                                $items_data['host'] = $this->host;
                                $items_data['remote_invoice_id'] = $remote_invoice_id;
                                $ins_items[] = $items_data;
                            }
                        }
                    }
                    $ins[] = $data;
                    //}
                    $cn++;
                    if (null === $remote_invoices_ids && $cn == $this->cn) break;
                }
                //}
            }
        }
        
        // echo '<pre>';
        // print_r($ins_items);
        // echo '</pre>';
        // exit();
        if (!empty($ins)) {
            $this->db->insert_batch('tbl_purchases', $ins);
            $this->db->insert_batch('tbl_purchase_items', $ins_items);
            /* if (!empty($ins_pay)) {
                $this->db->insert_batch('tbl_purchase_payments', $ins_pay);
            } */
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
        //$this->update_purchases_items_suppliers_ids($this->host);
        $this->update_purchases_payments_purchases_ids($this->host);
        
        return $return;
    }
    
    public function ins_expenses($remote_invoices_ids = null)
    {
        $return = 'No  (new) expense are found to be synchronized';
        $num_remote_invoices = 0;
        $num_invoices_in_db = 0;
        $num_ins_invoices = 0;
        $invoices = $this->fetch_data('purchase', $remote_invoices_ids);
        // echo '<pre>';
        // print_r(count($invoices));
        // print_r($invoices);
        //print_r($invoices[1]);
        // echo '</pre>';
        // exit();
        
        $ins = array();
        $ins_items = array();
        $ins_pay = array();
        $cn = 0;
        if (!empty($invoices)) {
            $num_remote_invoices = count($invoices);
            $tbl_invoices_remote_ids = array();
            $type = 'Expense';
            $remote_invoices_ids_from_tbl_invoices = $this->get_remote_invoices_ids_from_tbl($this->host, 'tbl_transactions', $type);
            if (!empty($remote_invoices_ids_from_tbl_invoices)) {
                $num_invoices_in_db = count($remote_invoices_ids_from_tbl_invoices);
                $tbl_invoices_remote_ids = array_flip($remote_invoices_ids_from_tbl_invoices);
            }
            foreach ($invoices as $v) {
                $remote_invoice_id = $v['Id'];
                if (!isset($tbl_invoices_remote_ids[$remote_invoice_id])) {
                    $data = array();
                    $data['category_id'] = 0;
                    $data['type'] = $type;
                    $data['amount'] = $v['TotalAmt'];
                    $data['paid_by'] = 0;
                    $data['date'] = $v['TxnDate'];
                    //$data['user_id'] = my_id();
                    $data['host'] = $this->host;
                    $data['remote_account_id'] = $v['AccountRef'];
                    $data['remote_contact_id'] = $v['EntityRef'];
                    $data['remote_invoice_id'] = $remote_invoice_id;
                    $line_items = $v['Line'];
                    if (!empty($line_items)) {
                        if (isset($line_items[0]['Id'])) {
                            $Description = '';
                            foreach ($line_items as $items) {
                                $Description .= '<div>' . $items['Description'] . '</div>';
                                $data['name'] = $Description;
                            }
                        } else {
                            $data['name'] = isset($line_items['Description']) ? $line_items['Description'] : '';
                        }
                    }
                    
                    $ins[] = $data;
                    $cn++;
                    if (null === $remote_invoices_ids && $cn == $this->cn) break;
                }
            }
            
            
            if (!empty($ins)) {
                $this->db->insert_batch('tbl_transactions', $ins);
                $num_ins_invoices = count($ins);
                $left_invoices = $num_remote_invoices - $num_invoices_in_db - $num_ins_invoices;
                if ($left_invoices > 0) {
                    $return = $left_invoices . ' expenses are still left to be synchronized, Please synchronize again';
                } else {
                    $return = 'All expenses are now synchronized';
                }
            }
        }
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
    
    public function ins_tasks()
    {
    }
    
    public function ins_estimates()
    {
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
    
    public function get_remote_invoices_ids_from_tbl($host, $table_name, $type = null)
    {
        $remote_invoices_ids_from_invoices_tbl = array();
        $where2 = array("host" => "$host");
        if (isset($type) && $table_name = 'tbl_transactions') {
            $where2['type'] = $type;
        }
        $tbl_invoices_d = get_any_field($table_name, $where2, 'remote_invoice_id', TRUE);
        if (!empty($tbl_invoices_d)) {
            $remote_invoices_ids_from_invoices_tbl = array_column($tbl_invoices_d, 'remote_invoice_id');
        }
        return $remote_invoices_ids_from_invoices_tbl;
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
