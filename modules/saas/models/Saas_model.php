<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Saas_model extends MY_Model
{
    public $_table_name;
    public $_order_by;
    public $_primary_key;

    public function __construct()
    {
        parent::__construct();
    }

    public function save_old($data, $id = NULL)
    {
        $this->old_db = config_db(true, true);
        if ($this->_timestamps == TRUE) {
            $now = date('Y-m-d H:i:s');
            $id || $data['created'] = $now;
            $data['modified'] = $now;
        }
        $tags = $this->input->post('tags', true);
        if (!empty($tags)) {
            update_module_tags($tags);
        }
        // Insert
        if ($id === NULL) {
            !isset($data[$this->_primary_key]) || $data[$this->_primary_key] = NULL;
            $this->old_db->set($data);
            $this->old_db->insert($this->_table_name);
            $id = $this->db->insert_id();
        } // Update
        else {
            $filter = $this->_primary_filter;
            $id = $filter($id);
            $this->old_db->set($data);
            $this->old_db->where($this->_primary_key, $id);
            $this->old_db->update($this->_table_name);
        }
        return $id;
    }

    public function select_old_data($table, $id, $value = null, $where = null, $join = null, $row = null)
    {
        $this->old_db = config_db(true, true);
        if ($id == '*') {
            $this->old_db->select('*', false);
        } else {
            $this->old_db->select("$id,$value", false);
        }
        $this->old_db->from($table);

        if (!empty($join)) {
            foreach ($join as $tbl => $wh) {
                $this->old_db->join($tbl, $wh, 'left');
            }
        }
        if (!empty($where)) {
            $this->old_db->where($where);
        }
        $this->staff_query($table);
        $query = $this->old_db->get();
        if (!empty($row) && $row === 'row') {
            $result = $query->row();
        } else if (!empty($row) && $row === 'object') {
            $result = $query->result();
        } else {
            $result = $query->result_array();
        }
        if (!empty($row)) {
            return $result;
        } else {
            if (strpos($id, ".") !== false) {
                $id = trim(strstr($id, '.'), '.');
            }
            if (strpos($value, ".") !== false) {
                $value = trim(strstr($value, '.'), '.');
            }
            // explode id  by _ and get the first index
            $select = explode('_', $id);
            $select = $select[0];
            $returnResult = [lang('select_data', lang($select))];
            if (!empty($result)) {
                $returnResult += array_column($result, $value, $id);
            }
        }
        return $returnResult;
    }


    public function get_all_tabs()
    {
        $url = 'saas/settings/';
        $tabs = array(
            'system_settings' => [
                'position' => 1,
                'name' => 'system_settings',
                'url' => $url . 'index/system_settings',
                'count' => '',
                'view' => $url . 'system',
            ],
            'theme_settings' => [
                'position' => 1,
                'name' => 'theme_settings',
                'url' => $url . 'index/theme_settings',
                'count' => '',
                'view' => $url . 'theme',
            ],
            'server_settings' => [
                'position' => 2,
                'name' => 'server_settings',
                'url' => $url . 'index/server_settings',
                'count' => '',
                'view' => $url . 'server',
            ],
            'email_settings' => [
                'position' => 3,
                'name' => 'email_settings',
                'url' => $url . 'index/email_settings',
                'count' => '',
                'view' => $url . 'email',
            ],
            'email_template' => [
                'position' => 4,
                'name' => 'email_template',
                'url' => $url . 'email_template',
                'count' => '',
                'view' => $url . 'email_template',
            ],
            'payments_settings' => [
                'position' => 5,
                'name' => 'payments_settings',
                'url' => $url . 'payments',
                'count' => '',
                'view' => $url . 'payments',
            ],
            'languages' => [
                'position' => 6,
                'name' => 'languages',
                'url' => $url . 'languages',
                'count' => '',
                'view' => $url . 'languages',
            ],
            'currencyList' => [
                'position' => 7,
                'name' => 'currencyList',
                'url' => $url . 'currencyList',
                'count' => '',
                'view' => $url . 'currencyList',
            ],
            'moduleManagement' => [
                'position' => 8,
                'name' => 'moduleManagement',
                'url' => $url . 'moduleManagement',
                'count' => '',
                'view' => $url . 'moduleManagement',
            ],
            'system_update' => [
                'position' => 9,
                'name' => 'system_update',
                'url' => $url . 'system_update',
                'count' => '',
                'view' => $url . 'system_update',
            ],
        );
        return apply_filters('saas_settings_tabs', $tabs);
    }

    public function saas_menu()
    {
        $user_menu = $this->db->where('status', 1)->order_by('sort', 'time')->get('tbl_saas_menu')->result();

        $menu = array(
            'items' => array(),
            'parents' => array()
        );

        foreach ($user_menu as $v_menu) {
            $menu['items'][$v_menu->menu_id] = $v_menu;
            $menu['parents'][$v_menu->parent][] = $v_menu->menu_id;
        }

        // Builds the array lists with data from the menu table
        return $output = $this->menu->buildMenu(0, $menu);
    }

    public function test_connection($data)
    {
        if ($data['saas_server'] == 'cpanel') {
            $data['saas_cpanel_password'] = decrypt(config_item('saas_cpanel_password'));
            $result = $this->createCPanelDatabase($data, true);
            set_message($result['type'], $result['message']);
            redirect('saas/settings/index/server_settings');
        } elseif ($data['saas_server'] == 'plesk') {
            $data['saas_plesk_password'] = decrypt(config_item('saas_plesk_password'));
            $result = $this->createPleskDatabase($data, true);
            set_message($result['type'], $result['message']);
            redirect('saas/settings/index/server_settings');
        }
    }

    public function resetore_database($id)
    {
        $company_info = get_row('tbl_saas_companies', array('id' => $id));

        $this->create_tables($company_info);
    }

    public
    function create_database($id, $fresh_db = null)
    {
        $company_info = get_row('tbl_saas_companies', array('id' => $id));
        // print('<pre>'.print_r(ConfigItems('saas_server'),true).'</pre>'); exit;
        if (!empty($company_info)) {
            if (ConfigItems('saas_server') === 'cpanel') {
                $server_result = $this->createCPanelDatabase($company_info);
            } elseif (ConfigItems('saas_server') === 'plesk') {
                $server_result = $this->createPleskDatabase($company_info);
            } else {
                $server_result = $this->createLocalDatabase($company_info);
            }

            if (!empty($server_result['db_name'])) {
                if (empty($_POST['username'])) {
                    $server_result['status'] = 'running';
                }
                $this->_table_name = 'tbl_saas_companies';
                $this->_primary_key = 'id';
                $this->save($server_result, $id);
                $company_info->db_name = $server_result['db_name'];
                // Create database tables
                $this->create_tables($company_info, $fresh_db);
                $result['result'] = 'success';
            } else {
                $result['error'] = $server_result['error'];
            }
            return $result;
        }
    }

    private function install_basic_data($companyInfo, $fresh_db)
    {
        // check if already exist the email address on tbl_users
        $db_name = $companyInfo->db_name;
        $old_db_name = $this->db->database;

        // insert * from tbl_account_details and tbl_users where tbl_users.role_id != 4
        if (empty($fresh_db)) {
            $uTable = 'tbl_users';
            $aTable = 'tbl_account_details';
            $this->db->query("INSERT INTO `" . $db_name . "`.`" . $uTable . "` SELECT * FROM `" . $old_db_name . "`.`" . $uTable . "` WHERE `" . $uTable . "`.`role_id` != 4");
            $this->db->query("INSERT INTO `" . $db_name . "`.`" . $aTable . "` SELECT * FROM `" . $old_db_name . "`.`" . $aTable . "` WHERE `" . $aTable . "`.`user_id` IN (SELECT `" . $uTable . "`.`user_id` FROM `" . $db_name . "`.`" . $uTable . "`)");
        }
        $already_exist = $this->db->where('email', $companyInfo->email)->get($db_name . '.tbl_users')->row();
        if (empty($already_exist)) {
            if (!empty($_POST['username'])) {
                $username = $_POST['username'];
            } else {
                $username = $companyInfo->email;
            }


            //            $remind_me = $this->db->where('remind_date >=', date('Y-m-d', strtotime('-7 days')))->get($old_db_name . '.tbl_remind_me')->result();


            //            $reminder_all = get_result('tbl_remind_me',);
            if (!empty($_POST['password'])) {
                $password = $this->hash($_POST['password']);
            } else {
                if (empty($companyInfo->password)) {
                    $password = $this->hash('123456');
                } else {
                    $password = $companyInfo->password;
                }
            }
            if (!empty($_POST['fullname'])) {
                $fullname = $_POST['fullname'];
            } else {
                $fullname = $companyInfo->name;
            }

            if (!empty($_POST['company_country'])) {
                $company_country = $_POST['company_country'];
            } else {
                $company_country = $companyInfo->country;
            }
            if (!empty($_POST['company_address'])) {
                $company_address = $_POST['company_address'];
            } else {
                $company_address = $companyInfo->address;
            }
            if (!empty($_POST['company_name'])) {
                $company_name = $_POST['company_name'];
            } else {
                $company_name = $companyInfo->name;
            }
            if (!empty($_POST['contact_person'])) {
                $contact_person = $_POST['contact_person'];
            } else {
                $contact_person = $companyInfo->name;
            }
            if (!empty($_POST['company_city'])) {
                $company_city = $_POST['company_city'];
            } else {
                $company_city = '';
            }
            if (!empty($_POST['company_phone'])) {
                $company_phone = $_POST['company_phone'];
            } else {
                $company_phone = $companyInfo->mobile;
            }
            if (!empty($_POST['timezone'])) {
                $timezone = $_POST['timezone'];
            } else {
                $timezone = $companyInfo->timezone;
            }
            // insert username,password,email,role_id,activated,banned value into  $db_name.tbl_users
            $this->db->insert($db_name . '.tbl_users', array(
                'username' => $username,
                'password' => $password,
                'email' => $companyInfo->email,
                'role_id' => 1,
                'activated' => 1,
                'banned' => 0,
            ));
            $user_id = $this->db->insert_id();

            if (!empty($user_id)) {
                // insert user_id,fullname,country,address,mobile value into tbl_account_details
                $this->db->insert($db_name . '.tbl_account_details', array(
                    'user_id' => $user_id,
                    'fullname' => $fullname,
                    'country' => $company_country,
                    'address' => $company_address,
                    'mobile' => $companyInfo->mobile,
                ));
            }
        }

        // insert module data into tbl_modules
        $all_modules = $this->db->where('for_company', 'Yes')->get('tbl_modules')->result();
        if (!empty($all_modules)) {
            foreach ($all_modules as $module) {
                $this->db->insert($db_name . '.tbl_modules', array(
                    'module_name' => $module->module_name,
                    'installed_version' => $module->installed_version,
                    'active' => $module->active,
                ));
            }
        }

        // update site_name and site_title in tbl_config
        $this->db->query("UPDATE `" . $db_name . "`.`tbl_config` SET `value` = '" . $company_name . "' WHERE `tbl_config`.`config_key` = 'company_name'");
        $this->db->query("UPDATE `" . $db_name . "`.`tbl_config` SET `value` = '" . $company_name . "' WHERE `tbl_config`.`config_key` = 'company_legal_name'");
        $this->db->query("UPDATE `" . $db_name . "`.`tbl_config` SET `value` = '" . $contact_person . "' WHERE `tbl_config`.`config_key` = 'contact_person'");
        $this->db->query("UPDATE `" . $db_name . "`.`tbl_config` SET `value` = '" . $company_name . "' WHERE `tbl_config`.`config_key` = 'website_name'");
        $this->db->query("UPDATE `" . $db_name . "`.`tbl_config` SET `value` = '" . $company_address . "' WHERE `tbl_config`.`config_key` = 'company_address'");
        $this->db->query("UPDATE `" . $db_name . "`.`tbl_config` SET `value` = '" . $company_country . "' WHERE `tbl_config`.`config_key` = 'company_country'");
        $this->db->query("UPDATE `" . $db_name . "`.`tbl_config` SET `value` = '" . $company_city . "' WHERE `tbl_config`.`config_key` = 'company_city'");
        $this->db->query("UPDATE `" . $db_name . "`.`tbl_config` SET `value` = '" . $company_phone . "' WHERE `tbl_config`.`config_key` = 'company_phone'");
        $this->db->query("UPDATE `" . $db_name . "`.`tbl_config` SET `value` = '" . $companyInfo->email . "' WHERE `tbl_config`.`config_key` = 'company_email'");
        $this->db->query("UPDATE `" . $db_name . "`.`tbl_config` SET `value` = '" . $timezone . "' WHERE `tbl_config`.`config_key` = 'timezone'");

        if (!empty($_POST['use_postmark'])) {
            $this->db->query("UPDATE `" . $db_name . "`.`tbl_config` SET `value` = '" . $_POST['use_postmark'] . "' WHERE `tbl_config`.`config_key` = 'use_postmark'");
            $this->db->query("UPDATE `" . $db_name . "`.`tbl_config` SET `value` = '" . $_POST['postmark_api_key'] . "' WHERE `tbl_config`.`config_key` = 'postmark_api_key'");
            $this->db->query("UPDATE `" . $db_name . "`.`tbl_config` SET `value` = '" . $_POST['postmark_from_address'] . "' WHERE `tbl_config`.`config_key` = 'postmark_from_address'");
            $this->db->query("UPDATE `" . $db_name . "`.`tbl_config` SET `value` = '" . $_POST['protocol'] . "' WHERE `tbl_config`.`config_key` = 'protocol'");
            $this->db->query("UPDATE `" . $db_name . "`.`tbl_config` SET `value` = '" . $_POST['smtp_host'] . "' WHERE `tbl_config`.`config_key` = 'smtp_host'");
            $this->db->query("UPDATE `" . $db_name . "`.`tbl_config` SET `value` = '" . $_POST['smtp_user'] . "' WHERE `tbl_config`.`config_key` = 'smtp_user'");
            $this->db->query("UPDATE `" . $db_name . "`.`tbl_config` SET `value` = '" . $_POST['smtp_pass'] . "' WHERE `tbl_config`.`config_key` = 'smtp_pass'");
            $this->db->query("UPDATE `" . $db_name . "`.`tbl_config` SET `value` = '" . $_POST['smtp_port'] . "' WHERE `tbl_config`.`config_key` = 'smtp_port'");
            $this->db->query("UPDATE `" . $db_name . "`.`tbl_config` SET `value` = '" . $_POST['smtp_encryption'] . "' WHERE `tbl_config`.`config_key` = 'smtp_encryption'");
        }

        if (!empty($_POST['department'])) {
            // insert department value into tbl_department
            $this->db->insert($db_name . '.tbl_departments', array(
                'deptname' => $_POST['department'],
            ));
            $departments_id = $this->db->insert_id();
            if (!empty($departments_id)) {
                // insert designation value into tbl_designations
                $this->db->insert($db_name . '.tbl_designations', array(
                    'departments_id' => $departments_id,
                    'designations' => $_POST['designation'],
                ));
            }
        }
        return true;
    }

    private
    function create_tables($companyInfo, $fresh_db = null)
    {
        // get all tables except the tbl_saas_companies
        $tables = $this->db->list_tables();
        $tables = array_diff($tables, array(
            'tbl_saas_companies',
            'tbl_saas_applied_coupon',
            'tbl_saas_companies_history',
            'tbl_saas_companies_payment',
            'tbl_saas_coupon',
            'tbl_saas_menu',
            'tbl_saas_package_field',
            'tbl_saas_packages',
        ));
        $db_name = $companyInfo->db_name;
        $old_db_name = $this->db->database;
        $this->db->database = $db_name;
        // make sql file for each table and save it in the database
        $this->db->db_debug = false;
        $except_tables = array(
            'tbl_client_menu',
            'tbl_config',
            'tbl_countries',
            'tbl_currencies',
            'tbl_dashboard',
            'tbl_days',
            'tbl_email_templates',
            'tbl_form',
            'tbl_languages',
            'tbl_locales',
            'tbl_menu',
            'tbl_migrations',
            'tbl_online_payment',
            'tbl_payment_methods',
            'tbl_priorities',
            'tbl_priority',
            'tbl_project_settings',
            'tbl_status',
            'tbl_working_days',
        );

        foreach ($tables as $table) {
            $this->db->query("CREATE TABLE IF NOT EXISTS `" . $db_name . "`.`" . $table . "` LIKE `" . $old_db_name . "`.`" . $table . "`");
            // check if the tbl_users table then skip the tbl_users table
            if ($table == 'tbl_users' || $table == 'tbl_account_details' || $table == 'tbl_modules') {
                continue;
            }
            if (!empty($fresh_db)) {
                if (in_array($table, $except_tables)) {
                    $this->db->query("INSERT INTO `" . $db_name . "`.`" . $table . "` SELECT * FROM `" . $old_db_name . "`.`" . $table . "`");
                }
            } else {
                $this->db->query("INSERT INTO `" . $db_name . "`.`" . $table . "` SELECT * FROM `" . $old_db_name . "`.`" . $table . "`");
            }
        }
        $this->install_basic_data($companyInfo, $fresh_db);
        $this->db->db_debug = true;

        $this->db->database = $old_db_name;
        return true;
    }

    /**
     * Create cPanel database
     *
     * @param Instance $instance
     * @return void
     */
    private
    function createCPanelDatabase($company_info, $test = null)
    {
        // load Xmlapi library
        include_once(MODULES_PATH . 'saas/libraries/Xmlapi.php');
        $cpanel_password = decrypt(ConfigItems('saas_cpanel_password'));
        $output = ConfigItems('saas_cpanel_output');
        $db_username = $this->db->username;
        $xmlapi = new xmlapi(ConfigItems('saas_cpanel_host'));
        $xmlapi->password_auth(ConfigItems('saas_cpanel_username'), $cpanel_password);
        $xmlapi->set_port(ConfigItems('saas_cpanel_port'));
        $xmlapi->set_debug(1);
        $xmlapi->set_output($output);
        if (!empty($test)) {
            $status = $xmlapi->api1_query(ConfigItems('saas_cpanel_username'), "cpanel", "api1_get_cpanel_revision");
            $status = json_decode($status);
            if (!empty($status->data->reason)) {
                $result['message'] = $status->data->reason . ' please input correct Details';
                $result['type'] = 'error';
            } else {
                $result['message'] = lang('cpanel_connection_success');
                $result['type'] = 'success';
            }
            return $result;
        }
        $cpaneluser = ConfigItems('saas_cpanel_username');
        if ($output == 'json') {
            $cpaneluser_short = ConfigItems('saas_cpanel_username');
        } else {
            $cpaneluser_short = substr(ConfigItems('saas_cpanel_username'), 0, 8);
        }
        $databasename = $company_info->domain . '_' . $company_info->id;
        $create_db = $xmlapi->api1_query($cpaneluser, "Mysql", "adddb", array($databasename));
        if ($output == 'json') {
            $create_db = json_decode($create_db);
        }
        $assign_permission = $xmlapi->api1_query($cpaneluser, 'Mysql', 'adduserdb', array('' . $databasename . '', '' . $db_username . '', 'all'));
        // $assign_permission = $xmlapi->api1_query($cpaneluser, "Mysql", "adduserdb", array($cpaneluser_short . "_" . $databasename, $db_username, 'all'));
        $databasename = $cpaneluser_short . "_" . $databasename;
        if ($output == 'json') {
            $assign_permission = json_decode($assign_permission);
        }

        if (!empty($assign_permission->error)) {
            return [
                'error' => $create_db->error
            ];
        }
        return [
            'db_name' => $databasename
        ];
    }

    /**
     * Create Plesk database
     *
     * @param Instance $instance
     * @return void
     */
    private
    function createPleskDatabase($company_info, $test = null)
    {
        include_once(MODULES_PATH . 'saas/libraries/PleskApiClient.php');
        $plesk_password = decrypt(config_item('saas_plesk_password'));
        $host = config_item('saas_plesk_host');
        $login = config_item('saas_plesk_username');
        $cpaneluser_short = substr(config_item('saas_plesk_username'), 0, 8);
        $databasename = $company_info->domain . '_' . $company_info->id;
        $password = $plesk_password;
        $client = new PleskApiClient($host);
        $client->setCredentials($login, $password);

        $request = "<packet>
        <database>
           <add-db>
                <webspace-id>" . config_item('saas_plesk_webspace_id') . "</webspace-id>
                <name>" . $cpaneluser_short . '_' . $databasename . "</name>
                <type>mysql</type>
           </add-db>
        </database>
        </packet>";
        $response = $client->request($request);
        $response = simplexml_load_string($response);
        $database = $response->database;
        $database = (array)$database;;
        if ((isset($database['add-db']->result->status) && $database['add-db']->result->status != 'ok')) {
            return ['error' => $database['add-db']->result->errtext];
        } else {
            $dbId = $database['add-db']->result->id;
            $requestToAssignDefaultUser = "<packet>
            <database>
               <set-default-user>
                  <db-id>$dbId</db-id>
                  <default-user-id>1</default-user-id>
               </set-default-user>
            </database>
            </packet>";
            $response = $client->request($requestToAssignDefaultUser);
            return [
                'db_name' => $cpaneluser_short . '_' . $databasename
            ];
        }
    }

    /**
     * Create local database
     *
     * @param Instance $instance
     * @return void
     */
    private
    function createLocalDatabase($company_info)
    {
        $db_name = $company_info->domain . '_' . $company_info->id;
        $this->db->query('CREATE DATABASE IF NOT EXISTS ' . $db_name /*!40100 CHARACTER SET utf8 COLLATE 'utf8_general_ci' */);
        return [
            'db_name' => $db_name
        ];
    }

    public
    function send_activation_token_email($id)
    {
        $company_info = get_row('tbl_saas_companies', array('id' => $id));
        $activation_code = $company_info->activation_code;
        $wildcard = ConfigItems('saas_server_wildcard');
        $companyUrl = base_url();
        $domain = '&d=' . url_encode($company_info->domain);
        if (!empty($wildcard)) {
            $domain = '';
            $companyUrl = companyUrl($company_info->domain);
        }
        $sub_domain = $companyUrl . 'setup?c=' . url_encode($activation_code) . $domain;
        $activation_period = config_item('email_activation_expire') / 3600;
        $email_template = $this->check_by(array('email_group' => 'token_activate_account'), 'tbl_email_templates');

        $activatation_token = str_replace("{ACTIVATION_TOKEN}", $activation_code, $email_template->template_body);
        $activate_url = str_replace("{ACTIVATE_URL}", $sub_domain, $activatation_token);
        $activate_period = str_replace("{ACTIVATION_PERIOD}", $activation_period, $activate_url);
        $message = str_replace("{SITE_NAME}", config_item('company_name'), $activate_period);

        $params['recipient'] = $company_info->email;
        $params['subject'] = '[ ' . config_item('company_name') . ' ]' . ' ' . $email_template->subject;
        $params['message'] = $message;
        $params['resourceed_file'] = '';
        $this->send_saas_email($params);
        return true;
    }

    public
    function send_welcome_email($id)
    {
        $company_info = get_row('tbl_saas_companies', array('id' => $id));

        $sub_domain = companyUrl($company_info->domain);
        $email_template = $this->check_by(array('email_group' => 'saas_welcome_mail'), 'tbl_email_templates');
        $name = str_replace("{NAME}", $company_info->name, $email_template->template_body);
        $activate_url = str_replace("{COMPANY_URL}", $sub_domain, $name);
        $message = str_replace("{SITE_NAME}", config_item('company_name'), $activate_url);

        $params['recipient'] = $company_info->email;
        $params['subject'] = '[ ' . config_item('company_name') . ' ]' . ' ' . $email_template->subject;
        $params['message'] = $message;
        $params['resourceed_file'] = '';

        $this->send_saas_email($params);
        return true;
    }

    public
    function is_company_active()
    {
        // get activation code from get request
        $activation_code = $this->input->get('c', TRUE);
        $subdomain = $this->is_subdomain();
        if (!empty($activation_code)) {
            $activation_code = url_decode($activation_code);
            $where = array('status' => 'running', 'activation_code' => $activation_code);
        } elseif (!empty($subdomain)) {
            $where = array('status' => 'running', 'domain' => $subdomain);
        }
        if (!empty($where)) {
            $companyInfo = get_row('tbl_saas_companies', $where);
            if (!empty($companyInfo)) {
                return $companyInfo;
            }
        }
        return false;
    }


    private
    function is_subdomain($domain = null)
    {
        $isIP = @($_SERVER['SERVER_ADDR'] === trim($_SERVER['HTTP_HOST'], '[]'));
        if (!empty($isIP)) {
            return false;
        }
        $default_url = config_item('default_url');
        $base_url = guess_base_url();
        $scheme = parse_url($default_url, PHP_URL_SCHEME);
        if (empty($scheme)) {
            $default_url = 'http://' . $default_url;
        }
        $default_url = parse_url($default_url, PHP_URL_HOST);
        $base_url = parse_url($base_url, PHP_URL_HOST);
        // check www exist in base_url then remove it
        if (strpos($base_url, 'www.') !== false) {
            $base_url = str_replace('www.', '', $base_url);
        }
        // check www exist in default_url then remove it
        if (strpos($default_url, 'www.') !== false) {
            $default_url = str_replace('www.', '', $default_url);
        }
        // check default_url and base_url is not same then return the subdomain
        if ($default_url != $base_url) {
            // return first subdomain
            $subdomain = explode('.', $base_url);
            return $subdomain[0];
        }
        return false;
    }

    public
    function update_package($company_id, $post_data)
    {
        $package_id = $post_data['package_id'];
        $package_info = get_old_result('tbl_saas_packages', array('id' => $package_id), false);
        $data['updated_date'] = date('Y-m-d H:i:s');
        $data['updated_by'] = $this->session->userdata('user_id');
        $billing_cycle = $this->input->post('billing_cycle', true);
        if (empty($billing_cycle)) {
            $billing_cycle = $post_data['billing_cycle'];
        }
        $expired_date = $this->input->post('expired_date', true);
        if (empty($expired_date)) {
            $expired_date = $post_data['expired_date'];
        }
        $mark_paid = $this->input->post('mark_paid', true);
        if (empty($mark_paid)) {
            $mark_paid = $post_data['mark_paid'];
        }
        $data['frequency'] = str_replace('_price', '', $billing_cycle);;
        $data['trial_period'] = $package_info->trial_period;
        $data['is_trial'] = 'Yes';
        $data['expired_date'] = $expired_date;;
        $data['package_id'] = $package_id;
        $data['currency'] = ConfigItems('default_currency');
        $data['amount'] = $package_info->$billing_cycle;
        if (!empty($mark_paid)) {
            $data['status'] = 'running';
            $data['is_trial'] = 'No';
            $data['trial_period'] = 0;
        }


        $this->saas_model->_table_name = 'tbl_saas_companies';
        $this->saas_model->_primary_key = 'id';
        $this->saas_model->save_old($data, $company_id);

        $this->saas_model->_table_name = 'tbl_saas_companies_history';
        $this->saas_model->_primary_key = 'companies_id';
        $this->saas_model->save_old(array('active' => 0), $company_id);

        $sub_h_data = array(
            'companies_id' => $company_id,
            'currency' => $data['currency'],
            'frequency' => $data['frequency'],
            'validity' => $data['expired_date'],
            'amount' => $data['amount'],
            'active' => 1,
            'ip' => $this->input->ip_address(),
            'created_at' => date("Y-m-d H:i:s"),
            'i_have_read_agree' => 'Yes',
            'package_name' => $package_info->name,
            'employee_no' => $package_info->employee_no,
            'client_no' => $package_info->client_no,
            'project_no' => $package_info->project_no,
            'invoice_no' => $package_info->invoice_no,
            'leads_no' => $package_info->leads_no,
            'transactions' => $package_info->transactions,
            'bank_account_no' => $package_info->bank_account_no,
            'online_payment' => $package_info->online_payment,
            'calendar' => $package_info->calendar,
            'mailbox' => $package_info->mailbox,
            'live_chat' => $package_info->live_chat,
            'tickets' => $package_info->tickets,
            'tasks_no' => $package_info->tasks_no,
            'filemanager' => $package_info->filemanager,
            'stock_manager' => $package_info->stock_manager,
            'recruitment' => $package_info->recruitment,
            'attendance' => $package_info->attendance,
            'payroll' => $package_info->payroll,
            'leave_management' => $package_info->leave_management,
            'performance' => $package_info->performance,
            'training' => $package_info->training,
            'reports' => $package_info->reports,
            'payment_method' => (!empty($post_data['payment_method'])) ? $post_data['payment_method'] : 'manual',
        );

        $this->saas_model->_table_name = 'tbl_saas_companies_history';
        $this->saas_model->_primary_key = 'id';
        $companies_history_id = $this->saas_model->save_old($sub_h_data);


        $data = $post_data;
        $data['companies_id'] = $company_id;
        $data['companies_history_id'] = 10;
        if (!empty($mark_paid)) {
            $this->packagePayment($data);
        }

        // save into activities
        $activities = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'saas',
            'module_field_id' => $companies_history_id,
            'activity' => ('activity_new_saas_payment'),
            'icon' => 'fa-shopping-cart',
            'value1' => $data['amount'],
            'value2' => $data['currency'],
        );
        // Update into tbl_project
        $this->saas_model->_table_name = "tbl_activities"; //table name
        $this->saas_model->_primary_key = "activities_id";
        $this->saas_model->save_old($activities);

        $this->send_email_to_company($company_id);
        return true;
    }

    public
    function send_email_to_company($company_id)
    {
        // send email to company for assign_new_package
        $company_info = $this->select_old_data('tbl_saas_companies', 'tbl_saas_companies.*,tbl_saas_companies_history.package_name,tbl_saas_companies_history.id as company_history_id', NULL, array('tbl_saas_companies.id' => $company_id, 'tbl_saas_companies_history.active' => 1), ['tbl_saas_companies_history' => 'tbl_saas_companies.id = tbl_saas_companies_history.companies_id'], 'row');

        $email_template = get_old_result('tbl_email_templates', array('email_group' => 'assign_new_package'), false);
        $message = $email_template->template_body;
        $subject = $email_template->subject;
        $client_name = str_replace("{CLIENT}", $company_info->name, $message);
        $package_name = str_replace("{PACKAGE}", $company_info->package_name, $client_name);
        $message = str_replace("{SITE_NAME}", ConfigItems('company_name'), $package_name);
        $data['message'] = $message;
        $message = $this->load->view('email_template', $data, TRUE);
        $params['subject'] = $subject;
        $params['message'] = $message;
        $params['resourceed_file'] = '';
        $params['recipient'] = $company_info->email;
        $this->send_saas_email($params);
    }

    public
    function packagePayment($data)
    {
        $coupon_code = '';
        $package_id = $data['package_id'];
        $billing_cycle = $data['billing_cycle'];
        $is_coupon_applied = $data['is_coupon'];
        $coupon_code = $data['coupon_code'];
        $reference_no = (!empty($data['refe rence_no'])) ? $data['reference_no'] : 'SAAS-' . date('Ymd') . '-' . rand(100000, 999999);

        $discount_percentage = 0;
        $discount_amount = 0;

        if (!empty($is_coupon_applied)) {
            $where = array('code' => $coupon_code, 'status' => 'active');
            $coupon_info = get_old_result('tbl_saas_coupon', $where, false);

            if (!empty($coupon_info)) {
                $user_id = my_id();
                if (!empty($user_id)) {
                    $where = array('user_id' => $user_id, 'coupon' => $coupon_code);
                } else {
                    $where = array('email' => $data['email'], 'coupon' => $coupon_code);
                }
                $already_apply = get_old_result('tbl_saas_applied_coupon', $where, false);
                if (empty($already_apply)) {
                    $package_info = get_old_result('tbl_saas_packages', array('id' => $package_id), false);
                    $sub_total = $package_info->$billing_cycle;
                    $percentage = $coupon_info->amount;
                    if ($coupon_info->type == 1) {
                        $discount_amount = ($percentage / 100) * $sub_total;
                        $discount_percentage = $percentage . '%';
                    } else {
                        $discount_amount = $percentage;
                        $discount_percentage = $percentage;
                    }

                    $coupon_data['discount_amount'] = $discount_amount;
                    $coupon_data['discount_percentage'] = $discount_percentage;
                    $coupon_data['coupon'] = $coupon_code;
                    $coupon_data['coupon_id'] = $coupon_info->id;
                    $coupon_data['user_id'] = $user_id;
                    $coupon_data['email'] = $data['email'];
                    $coupon_data['applied_date'] = date('Y-m-d H:i:s');

                    // save into tbl_saas_applied_coupon
                    $this->saas_model->_table_name = 'tbl_saas_applied_coupon';
                    $this->saas_model->_primary_key = 'id';
                    $applied_coupon_id = $this->saas_model->save_old($coupon_data);
                }
            }
        }


        // save payment info
        $payment_date = $this->input->post('payment_date', true);
        $pdata = array(
            'reference_no' => $reference_no,
            'companies_history_id' => $data['companies_history_id'],
            'companies_id' => $data['companies_id'],
            'transaction_id' => 'TRN' . date('Ymd') . date('His') . '_' . substr(number_format(time() * rand(), 0, '', ''), 0, 6),
            'payment_method' => (!empty($data['payment_method'])) ? $data['payment_method'] : 'manual',
            'currency' => $data['currency'],
            'subtotal' => $data['amount'],
            'discount_percent' => $discount_percentage,
            'discount_amount' => $discount_amount,
            'coupon_code' => $coupon_code,
            'total_amount' => $data['amount'] - $discount_amount,
            'payment_date' => (!empty($payment_date) ? $payment_date : date("Y-m-d H:i:s")),
            'created_at' => date("Y-m-d H:i:s"),
            'ip' => $this->input->ip_address(),
        );

        $this->saas_model->_table_name = 'tbl_saas_companies_payment';
        $this->saas_model->_primary_key = 'id';
        return $companies_payment_id = $this->saas_model->save_old($pdata);
    }

    function send_saas_email($params, $test = null)
    {

        $config = array();

        // If using SMTP
        //            if (config_item('protocol') == 'smtp') {
        //                $this->load->library('encrypt');
        //                $config = array(
        //                    'protocol' => config_item('protocol'),
        //                    'smtp_host' => config_item('smtp_host'),
        //                    'smtp_port' => config_item('smtp_port'),
        //                    'smtp_user' => config_item('smtp_user'),
        //                    'smtp_pass' => config_item('smtp_pass'),
        //                    'smtp_crypto' => config_item('email_encryption'),
        //                    'crlf' => "\r\n"
        //                );
        //            }

        // Send email
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = "html";
        $config['charset'] = 'utf-8';
        $config['newline'] = "\r\n";
        $config['crlf'] = "\r\n";
        $config['smtp_timeout'] = '30';
        $config['protocol'] = config_item('saas_protocol');
        $config['smtp_host'] = config_item('saas_smtp_host');
        $config['smtp_port'] = config_item('saas_smtp_port');
        $config['smtp_user'] = trim(config_item('saas_smtp_user'));
        $config['smtp_pass'] = decrypt(config_item('saas_smtp_password'));
        $config['smtp_crypto'] = config_item('saas_smtp_encryption');

        $this->load->library('email', $config);
        $this->email->clear(true);
        $this->email->from(config_item('saas_company_email'), config_item('saas_website_name'));
        $this->email->to($params['recipient']);

        $this->email->subject($params['subject']);
        $this->email->message($params['message']);
        if ($params['resourceed_file'] != '') {
            $this->email->attach($params['resourceed_file']);
        }
        $send = $this->email->send();
        if (!empty($test)) {
            if ($send) {
                return $send;
            } else {
                $error = show_error($this->email->print_debugger());
                return $error;
            }
        } else {
            if ($send) {
                return $send;
            } else {
                send_later($params);
            }
        }
        return true;
    }
}
