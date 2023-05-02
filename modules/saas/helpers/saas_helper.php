<?php defined('BASEPATH') or exit('No direct script access allowed');

function saas_access()
{
    if (!super_admin_access()) {
        $CI = &get_instance();
        $CI->session->set_flashdata('error', lang('access_denied'));
        redirect('admin/dashboard');
    }
}

function saas_packege_field($type = 'text', $info = '', $colLeft = 'col-lg-3', $colRight = 'col-lg-8')
{
    $all_field = get_order_by('tbl_saas_package_field', array('status' => 'active', 'field_type' => $type), 'order', 'asc');
    $html = null;
    if (!empty(super_admin_access())) {
        if (!empty($all_field)) {
            foreach ($all_field as $v_fileds) {

                $name = ($v_fileds->field_name);
                if (!empty($info)) {
                    $value = $info->$name;
                } else {
                    $value = '';
                }

                $help_text = null;
                if ($v_fileds->field_type == 'text') {
                    $html .= '<div class="form-group">
                <label class="' . $colLeft . ' control-label">' . lang($v_fileds->field_label) . '  ' . $help_text . '</label>
                <div class="' . $colRight . '">
                <input type="text" name="' . $v_fileds->field_name . '" class="form-control"  value="' . $value . '">
                <small class="text-danger">' . $v_fileds->help_text . '</small>
                </div>
                </div>';
                } else if ($v_fileds->field_type == 'email') {
                    $html .= '<div class="form-group">
                <label class="' . $colLeft . ' control-label">' . lang($v_fileds->field_label) . '  ' . $help_text . '</label>
                <div class="' . $colRight . '">
                <input type="email" name="' . $name . '" class="form-control" value="' . $value . '">
                </div>
                </div>';
                } else if ($v_fileds->field_type == 'textarea') {

                    $html .= '<div class="form-group">
                <label class="' . $colLeft . ' control-label">' . lang($v_fileds->field_label) . '  ' . $help_text . '</label>
                <div class="' . $colRight . '">
                <textarea name="' . $name . '" class="form-control">' . $value . '</textarea>
                </div>
                </div>';
                } else if ($v_fileds->field_type == 'dropdown') {
                    $html .= '<div class="form-group">
                <label class="' . $colLeft . ' control-label">' . lang($v_fileds->field_label) . '  ' . $help_text . '</label>
                <div class="' . $colRight . '">
                <select name="' . $name . '" class="form-control select_box" style="width:100%">
                ' . dropdownField($v_fileds->default_value, $value) . '

                </select>
                </div>
                </div>';
                } else if ($v_fileds->field_type == 'date') {
                    $html .= '<div class="form-group">
                <label class="' . $colLeft . ' control-label">' . lang($v_fileds->field_label) . '  ' . $help_text . '</label>
                <div class="' . $colRight . '">
                <div class="input-group">
                <input type="text" name="' . $name . '" class="form-control datepicker" value="' . (!empty($value) ? $value : date('Y-m-d')) . '">
                <div class="input-group-addon">
                <a href="#"><i class="fa fa-calendar"></i></a>
                </div>
                </div>
                </div>
                </div>';
                } else if ($v_fileds->field_type == 'checkbox') {
                    $html .= '<div class="form-group">
                <label class="' . $colLeft . ' control-label">' . lang($v_fileds->field_label) . '  ' . $help_text . '</label>
                <div class="' . $colRight . '">';
                    $html .= '<div class="checkbox c-checkbox">
                   <label class="needsclick">
                   <input type="checkbox" value="Yes" name="' . $name . '" ' . (!empty($value) && $value == 'Yes' ? 'checked' : '') . ' ' . '>
                   <span class="fa fa-check"></span>' . '
                   </label>
                </div>';
                    $html .= '</div></div>';
                } else if ($v_fileds->field_type == 'numeric') {

                    $html .= '<div class="form-group">
                <label class="' . $colLeft . ' control-label">' . lang($v_fileds->field_label) . '  ' . $help_text . '</label>
                <div class="' . $colRight . '">
                <input type="number" name="' . $name . '" class="form-control"  value="' . $value . '">
                </div>
                </div>';
                }
            }
        }
    }
    return $html;
}

function saas_packege_list($info, $limit = null, $front = null)
{
    if (!empty($front)) {
        $all_field = get_order_by('tbl_saas_package_field', array('status' => 'active'), 'order', 'asc', $limit);
    } else {
        $all_field = get_old_order_by('tbl_saas_package_field', array('status' => 'active'), 'order', 'asc', $limit);
    }

    $html = '';
    if (!empty($all_field)) {
        foreach ($all_field as $v_fileds) {
            $name = $v_fileds->field_name;
            $value = $info->$name;
            $html .= '<li class="packaging-feature">';
            if ($v_fileds->field_type == 'text') {
                if (!empty($value) && $value != 0) {
                    $html .= '<i class="fa fa-check pricing_check"></i>' . $value . ' ' . lang($v_fileds->field_label);
                } elseif (is_numeric($value) && $value == 0) {
                    $html .= '<i class="fa fa-check pricing_check"></i>' . lang('unlimited') . ' ' . lang($v_fileds->field_label);
                } else {
                    $html .= '<i class="fa fa-times pricing_times"></i><del>' . lang($v_fileds->field_label) . '</del>';
                }
            } else if ($v_fileds->field_type == 'textarea') {
            } else if ($v_fileds->field_type == 'dropdown') {
            } else if ($v_fileds->field_type == 'date') {
            } else if ($v_fileds->field_type == 'checkbox') {
                if (!empty($value) && $value == 'Yes') {
                    $html .= '<i class="fa fa-check" style="color: #3378ff"></i>' . lang($v_fileds->field_label);
                } else {
                    $html .= '<i class="fa fa-times" style="color: red"></i><del>' . lang($v_fileds->field_label) . '</del>';
                }
            } else if ($v_fileds->field_type == 'numeric') {
            }
            $html .= '</li>';
        }
    }
    return $html;
}

function package_price($package_info, $style = null)
{

    $html = '';
    $divStart = '<h3 class="packaging-title" >';
    $divEnd = '</h3>';
    if ($style == 'row') {
        $divStart = '';
        $divEnd = '<br/>';
    }
    // check $package_info->monthly_price == 0 then showing its free for month
    if ($package_info->monthly_price == 0) {
        $html .= $divStart . lang('free_for_month') . $divEnd;
    } else {
        $html .= $divStart . display_money($package_info->monthly_price, default_currency()) . ' / ' . lang('month') . $divEnd;
    }
    $html .= $divStart . display_money($package_info->quarterly_price, default_currency()) . ' / ' . lang('quarter') . $divEnd;
    $html .= $divStart . display_money($package_info->yearly_price, default_currency()) . ' / ' . lang('year') . $divEnd;
    return $html;
}


function all_module($module_for = 'menu')
{
    if ($module_for == '*') {
        $where = array('active' => 1);
    } else {
        $where = array('active' => 1, 'module_for' => $module_for);
    }
    //    return get_old_data('tbl_modules', $where, true);
}

function super_admin_access()
{
    $CI = &get_instance();
    return $CI->session->userdata('user_type') == '4';
}

function get_old_order_by($tbl, $where = null, $order_by = null, $ASC = null, $limit = null)
{
    if (!empty($tbl)) {
        $CI = &get_instance();
        $CI->old_db = config_db(true, true);
        $CI->old_db->from($tbl);
        if (!empty($where) && $where != 0) {
            $CI->old_db->where($where);
        }
        if (!empty($ASC)) {
            $order = 'ASC';
        } else {
            $order = 'DESC';
        }
        $CI->old_db->order_by($order_by, $order);
        if (!empty($limit)) {
            $CI->old_db->limit($limit);
        }
        $query_result = $CI->old_db->get();
        $result = $query_result->result();
        return $result;
    }
}


function get_old_data($table, $where, $result = null)
{
    $CI = &get_instance();
    $CI->old_db = config_db(true, true);
    $query = $CI->old_db->where($where)->get($table);
    if ($query->num_rows() > 0) {
        if (!empty($result)) {
            $row = $query->result();
        } else {
            $row = $query->row();
        }
        return $row;
    }
}

function old_any_field($tbl, $where = array(), $field = false)
{
    $CI = &get_instance();
    $CI->db->where($where);
    $query = $CI->db->get($tbl);
    if ($query->num_rows() > 0) {
        if ($field) {
            return $query->row()->$field;
        } else {
            return true;
        }
    } else {
        return false;
    }
}

function ConfigItems($name)
{
    $result = get_old_result('tbl_config', array('config_key' => $name), false);
    if (!empty($result)) {
        return $result->value;
    }
}

function trial_period($subs)
{
    if ($subs->trial_period != 0) {
        $time = date('Y-m-d H:i', strtotime($subs->created_date));
        $to_date = strtotime($time); //Future date.
        $cur_date = strtotime(date('Y-m-d H:i'));
        $timeleft = $to_date - $cur_date;
        $daysleft = round((($timeleft / 24) / 60) / 60);
        $days = ($subs->trial_period + $daysleft);
        return $days;
    } else {
        return false;
    }
}

function running_period($subs = null)
{
    if ($subs->trial_period == 0) {
        $time = date('Y-m-d H:i', strtotime($subs->expired_date));
        $to_date = strtotime($time); //Future date.
        $cur_date = strtotime(date('Y-m-d H:i'));
        $timeleft = $to_date - $cur_date;
        $daysleft = round((($timeleft / 24) / 60) / 60);
        return $daysleft;
    } else {
        return false;
    }
}

function get_old_result($tbl, $where = array(), $result = true)
{
    $CI = &get_instance();
    $CI->old_db = config_db(NULL, true);

    $CI->old_db->where($where);
    $query = $CI->old_db->get($tbl);
    if ($result) {
        return $query->result();
    } else {
        return $query->row();
    }
}

function companyUrl($subdomain = null)
{
    $base_url = '';
    if (!empty($subdomain)) {
        $default_url = config_item('default_url');
        //        $default_url = parse_url($default_url, PHP_URL_HOST);
        // check http or https and www exist in default_url then remove it
        if (strpos($default_url, 'http://') !== false) {
            $base_url = str_replace('http://', '', $default_url);
        } elseif (strpos($default_url, 'https://') !== false) {
            $base_url = str_replace('https://', '', $default_url);
        } else {
            $base_url = $default_url;
        }
        if (strpos($base_url, 'www.') !== false) {
            $base_url = str_replace('www.', '', $base_url);
        }
        $scheme = parse_url($default_url, PHP_URL_SCHEME);
        if (empty($scheme)) {
            $scheme = 'http';
        }
        $base_url = $scheme . '://' . $subdomain . '.' . $base_url;
    } else {
        $base_url .= '.' . $_SERVER['HTTP_HOST'];
        $base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
        // remove last slash from base_url
        $base_url = substr($base_url, 0, -1);
        $base_url = preg_replace('/install.*/', '', $base_url);
    }
    return $base_url;
}

function config_db($db_name = null, $default_database = null)
{
    $CI = &get_instance();
    // load config.php from module
    $config_db = $CI->config->config['config_db'];

    if (!empty($default_database)) {
        $database_name = config_item('default_database');
    } else {
        $database_name = $db_name;
    }
    $config_db['database'] = $database_name; // set database name
    $database_exist = $CI->db->query("SHOW DATABASES WHERE `database` = '" . $database_name . "'")->num_rows();
    if (!empty($database_exist)) {
        $CI->new_db = $CI->load->database($config_db, true);
        return $CI->new_db;
    }
    return false;
}


function company_db_name($domain = null)
{
    $companyInfo = get_old_data('tbl_saas_companies', ['status' => 'running', 'domain' => $domain]);
    if (!empty($companyInfo)) {
        return $companyInfo->db_name;
    }
    return false;
}

function is_company_active()
{
    $subdomain = is_subdomain();
    if (!empty($subdomain)) {
        $companyInfo = get_old_data('tbl_saas_companies', ['status' => 'running', 'domain' => $subdomain]);
        if (!empty($companyInfo)) {
            return true;
        }
    }
    return false;
}

function is_complete_setup()
{
    $sub_domain = is_subdomain();
    if (!empty($sub_domain)) {
        $domain_available = get_old_data('tbl_saas_companies', ['domain' => $sub_domain]);
        if (empty($domain_available)) {
            redirect('domain-not-available');
        }
        if ($domain_available->status == 'pending') {
            redirect(base_url('setup'));
        } else {
            return company_db_name($sub_domain);
        }
    }
}

function saas_appended_to_my_controller($db_name = null)
{
    $CI = &get_instance();
    $db_name = is_complete_setup();
    // get session data
    $db_name_s = $CI->session->userdata('db_name');
    if (empty($db_name)) {
        $db_name = $db_name_s;
        // set session data
        $CI->session->set_userdata('db_name', $db_name);
    }
    if (!empty($db_name)) {
        $CI->db = config_db($db_name);
    }
}

function saas_before_login_form()
{
    $html = '';
    if (is_subdomain() == '') {
        $html .= '<div class="form-group">';
        // append input group
        $html .= '<div class="input-group">';
        $html .= '<input type="text" class="form-control" name="account" placeholder="' . lang('account') . '" autocomplete="off">';
        $html .= '<div class="input-group-addon">';
        $html .= '<span>' . companyUrl() . '</span>';
        $html .= '</div>';

        $html .= '</div>';
        $html .= '</div>';
    }
    echo $html;
}

function saas_before_breadcrumb()
{
    $html = '';
    if (!empty(is_subdomain())) {
        $subs = get_company_subscription(null, 'running');
        $result = is_account_running($subs, true);
        if (!empty($result['trial'])) {
            $trial_period = $result['trial'];
            $type = 'trial';
            $b_text = lang('you_are_using_trial_version', $subs->package_name) . ' ' . $trial_period . ' ' . lang('days');
        } else {
            $trial_period = $result['running'];
            $type = 'running';
            $b_text = lang('your_pricing_plan_will_expired', $subs->package_name) . ' ' . $trial_period . ' ' . lang('days');
        }
        if ($trial_period <= 0) {
            redirect('upgrade');
        }
        if ($type == 'trial' || $trial_period < 3) {
            $html .= '<span class="text-sm text-danger">' . $b_text . '</span>';
            $html .= '<strong class=""><a href="' . base_url('checkoutPayment') . '"> ' . lang('upgrade') . '</a></strong>';
        }
    }
    echo $html;
}

function saas_before_user_login()
{
    $CI = &get_instance();
    $account = $CI->input->post('account', true);
    if (empty($account)) {
        $account = is_subdomain();
    }
    $account = trim($account);
    if (empty($account)) {
        return true;
    }
    // check domain is exits or not in database tbl_saas_companies
    $companyInfo = get_old_data('tbl_saas_companies', ['domain' => $account]);
    if (!empty($companyInfo)) {
        if ($companyInfo->status === 'running') {
            $db_name = $companyInfo->db_name;
            // update database into config
            $CI->db = config_db($db_name);
            // update session
            $CI->session->set_userdata('saas_company_id', $companyInfo->id);
            $CI->session->set_userdata('domain', $account);
            $CI->session->set_userdata('db_name', $db_name);
            return true;
        } else {
            set_message('error', lang('account_is_not_active'));
            redirect(site_url('login'));
        }
    } else {
        set_message('error', lang('account_not_found'));
        redirect(site_url('login'));
    }
}


function get_company_subscription($domain = null, $status = null, $order_by = null, $limit = null)
{
    if (empty($domain)) {
        $domain = is_subdomain();
    }
    if (empty($domain)) {
        return false;
    }
    $CI = &get_instance();
    $CI->old_db = config_db(NULL, true);
    $CI->old_db->select('tbl_saas_companies.*,tbl_saas_companies_history.id as company_history_id,tbl_saas_companies_history.*');
    $CI->old_db->from('tbl_saas_companies');
    $CI->old_db->join('tbl_saas_companies_history', 'tbl_saas_companies.id = tbl_saas_companies_history.companies_id', 'left');
    if (!empty($status)) {
        $CI->old_db->where('tbl_saas_companies.status', $status);
    }
    if (!empty($order_by)) {
        $CI->old_db->order_by('tbl_saas_companies.id', 'desc');
        if (!empty($limit)) {
            $CI->old_db->limit($limit);
        }
        $type = 'result';
    } else {
        $CI->old_db->where('tbl_saas_companies.domain', $domain);
        $CI->old_db->where('tbl_saas_companies_history.active', 1);
        $type = 'row';
    }
    $query = $CI->old_db->get();
    $result = $query->$type();
    return $result;
}

function is_account_running($subs, $detail = null)
{
    $result = array();
    $total_days = 0;
    if ($subs->trial_period != 0) {
        $total_days = $result['trial'] = trial_period($subs);
    } elseif ($subs->trial_period == 0) {
        $total_days = $result['running'] = running_period($subs);
    }
    if (!empty($detail)) {
        return $result;
    } else {
        return $total_days;
    }
}

function saas_more_exception_uri($except_menu)
{
    $subdomain = is_subdomain();
    if (!empty($subdomain)) {
        $subs = get_company_subscription($subdomain);
        if (!empty($subs)) {
            if ($subs->status == 'running' && $subs->maintenance_mode != 'Yes') {
                $total_days = is_account_running($subs);
                // check the $total_days is not negative or zero and must be greater than 0
                if ($total_days <= 0) {
                    redirect('upgrade');
                }
            } else {
                if ($subs->maintenance_mode == 'Yes') {
                    $maintenance_message = $subs->maintenance_mode_message;
                }
                $account_status = $subs->status;
                include_once module_dirPath('saas') . 'views/maintenance.php';
                die();
            }
            $yesNo = array(
                'attendance' => 'admin/attendance',
                'payroll' => 'admin/payroll',
                'leave_management' => 'admin/leave_management',
                'performance' => 'admin/performance',
                'training' => 'admin/training',
                'calendar' => 'admin/calendar',
                'mailbox' => 'admin/mailbox',
                'tickets' => array('admin/tickets', 'admin/report/tickets_report'),
                'filemanager' => 'admin/filemanager',
                'stock_manager' => array('admin/items', 'admin/supplier', 'admin/purchase', 'admin/return_stock', 'admin/warehouse', 'admin/all_payments'),
                'recruitment' => 'admin/job_circular',
                'reports' => 'admin/report',
                'live_chat' => 'admin/conversations',
            );
            foreach ($yesNo as $key => $value) {
                if ($subs->$key == 'No') {
                    // check if is array the assign to $except_menu and unset the key
                    if (is_array($value)) {
                        $except_menu = array_merge($except_menu, $value);
                        unset($yesNo[$key]);
                    } else {
                        $except_menu[] = $value;
                    }
                }
            }
            $numeric = array(
                'employee_no' => 'admin/users',
                'client_no' => 'admin/client',
                'project_no' => 'admin/projects',
                'tasks_no' => 'admin/tasks',
                'invoice_no' => 'admin/invoice',
                'leads_no' => 'admin/leads',
                'transactions' => 'admin/transactions',
                'bank_account_no' => 'admin/account',
            );
            foreach ($numeric as $nkey => $nvalue) {
                if (!is_numeric($subs->$nkey)) {
                    $except_menu[] = $nvalue;
                }
            }
        }
    } elseif (!empty(super_admin_access())) {
        $CI = &get_instance();
        $uri = $CI->uri->segment(1);
        if ($uri != 'saas') {
            redirect('saas/dashboard');
        }
        $except_menu = array();
    }
    return $except_menu;
}

function saas_sidebar_menu($menu)
{
    $subdomain = is_subdomain();
    if (!empty($subdomain)) {
        $subs = get_company_subscription($subdomain);
        if (empty($subs)) {
            return $menu;
        }
        $yesNo = array(
            'attendance' => array('attendance', 'time_history', 'timechange_request', 'attendance_report', 'mark_attendance'),
            'payroll' => array('payroll', 'salary_template', 'hourly_rate', 'manage_salary_details', 'employee_salary_list', 'make_payment', 'generate_payslip', 'payroll_summary', 'advance_salary', 'provident_fund', 'overtime', 'award'),
            'leave_management' => array('leave_management', 'leave_category'),
            'performance' => array('performance', 'performance_indicator', 'give_performance_appraisal', 'performance_report'),
            'training' => 'training',
            'calendar' => 'calendar',
            'mailbox' => 'mailbox',
            'tickets' => array('tickets', 'tickets_report'),
            'filemanager' => 'filemanager',
            'stock_manager' => array('admin/items', 'admin/supplier', 'admin/purchase', 'admin/return_stock', 'admin/warehouse', 'admin/all_payments'),
            'recruitment' => array('job_circular', 'jobs_posted', 'jobs_applications'),
            'reports' => array('report', 'tasks_assignment', 'bugs_assignment', 'project_report', 'account_statement', 'income_report', 'expense_report', 'income_expense', 'ledger', 'date_wise_report', 'all_income', 'all_expense', 'all_transaction', 'report_by_month', 'sales_report', 'tasks_report', 'bugs_report', 'tickets_report', 'client_report'),
            'live_chat' => 'private_chat',
        );
        $except_menu = array();
        foreach ($yesNo as $key => $value) {
            if ($subs->$key == 'No') {
                // check if is array the assign to $except_menu and unset the key
                if (is_array($value)) {
                    $except_menu = array_merge($except_menu, $value);
                    unset($yesNo[$key]);
                } else {
                    $except_menu[] = $value;
                }
            }
        }
        $numeric = array(
            'employee_no' => 'users',
            'client_no' => array('client', 'client_report'),
            'project_no' => array('projects', 'project_report', 'bugs_assignment', 'tasks_assignment'),
            'tasks_no' => array('tasks', 'tasks_report'),
            'invoice_no' => array('invoice', 'recurring_invoice', 'payments_received', 'sales_report', 'pos_sales'),
            'leads_no' => 'leads',
            'transactions' => array('transactions', 'expense', 'deposit', 'transfer', 'transactions_report', 'balance_sheet', 'transfer_report'),
            'bank_account_no' => 'bank_cash',
        );
        foreach ($numeric as $nkey => $nvalue) {
            if (!is_numeric($subs->$nkey)) {
                // check if is array the assign to $except_menu and unset the key
                if (is_array($nvalue)) {
                    $except_menu = array_merge($except_menu, $nvalue);
                    unset($numeric[$nkey]);
                } else {
                    $except_menu[] = $nvalue;
                }
            }
        }
        // check $except_menu is there into $menu->label
        foreach ($menu as $key => $value) {
            if (in_array($value->label, $except_menu)) {
                unset($menu[$key]);
            }
        }
        // add new menu into $menu as object
        $menu[] = (object)[
            'menu_id' => '36582503',
            'label' => 'billing',
            'link' => 'billing',
            'icon' => 'fa fa-money',
            'parent' => '0',
            'sort' => '1',
            'status' => '1',
            'time' => '2017-09-01 00:00:00',
        ];
    }
    return $menu;
}

function saas_before_create($table)
{
    if ($table == 'tbl_activities') {
        return true;
    }
    $subs = get_company_subscription(null, 'running');
    if (!empty(is_subdomain()) && !empty($subs)) {
        $all_table = array(
            'tbl_users' => 'employee_no',
            'tbl_client' => 'client_no',
            'tbl_project' => 'project_no',
            'tbl_task' => 'tasks_no',
            'tbl_invoices' => 'invoice_no',
            'tbl_leads' => 'leads_no',
            'tbl_transactions' => 'transactions',
            'tbl_accounts' => 'bank_account_no',
        );
        if (in_array($table, array_keys($all_table))) {
            $field = $all_table[$table];
            $value = $subs->$field;
            $total_rows = total_rows($table);
            if (!is_numeric($value)) {
                set_message('error', lang('you_can_not_add_this_is_not_included'));
                redirect('checkoutPayment');
            } elseif (is_numeric($value) && $value != 0) {
                if ($value <= $total_rows) {
                    set_message('error', lang('you_can_not_add_more_please_upgrade_the_package'));
                    redirect('checkoutPayment');
                }
            } elseif (is_numeric($value) && $value == 0) {
                return true;
            }
        }
    }
}

function saas_is_saas()
{
    $subdomain = is_subdomain();
    if (!empty($subdomain)) {
        return true;
    }
    return false;
}

function saas_filemanager_path($path)
{
    $subdomain = is_subdomain();
    if (!empty($subdomain)) {
        $path = $path . $subdomain;
        if (!is_dir($path)) {
            mkdir($path);
        }
        if (!file_exists($path . '/index.html')) {
            fopen($path . '/index.html', 'w');
        }
    }
    return $path;
}


function check_disk_space()
{
    if (is_subdomain()) {
        $subs = get_company_subscription(null, 'running');
        if (!empty($subs)) {
            $disk_space = $subs->disk_space; // 1GB
            // get number and character from string
            preg_match('/(\d+)(\w+)/', $disk_space, $matches);
            $number = $matches[1];
            $character = $matches[2];
            if ($character == 'GB') {
                $disk_space = $number * 1024 * 1024 * 1024;
            } elseif ($character == 'MB') {
                $disk_space = $number * 1024 * 1024;
            } elseif ($character == 'KB') {
                $disk_space = $number * 1024;
            }
            $mainPath = 'filemanager';
            // get saas path if saas is active using hook
            $mainPath = apply_filters('filemanager_path', $mainPath);
            $CI = &get_instance();
            $CI->load->helper('path');
            // get space used into $mainPath
            $space_used = get_dir_file_info(set_realpath($mainPath), $top_level_only = TRUE);
            $space_used = array_sum(array_map(function ($file) {
                return $file['size'];
            }, $space_used));
            $space_left = $disk_space - $space_used;
            // if space left is less than show warning message
            if ($space_left <= 0) {
                set_message('warning', lang('disk_space_is_full'));
                return false;
            }
        }
    }
    return true;
}
