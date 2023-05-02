<?php defined('BASEPATH') or exit('No direct script access allowed');


class Companies extends Gb_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('saas_model');
        $this->load->model('settings_model');
        saas_access();
    }


    public function index()
    {
        $data['title'] = lang('companies');
        $data['active'] = 1;
        $data['subview'] = $this->load->view('companies/manage', $data, true);
        $this->load->view('_layout_main', $data);
    }

    public function companiesList($status = null)
    {
        if ($this->input->is_ajax_request()) {
            $this->load->model('datatables');
            $this->datatables->table = 'tbl_saas_companies';
            $this->datatables->select = 'tbl_saas_packages.name as package_name,tbl_saas_companies.*';
            $this->datatables->join_table = array('tbl_saas_packages');
            $this->datatables->join_where = array('tbl_saas_packages.id=tbl_saas_companies.package_id');
            $column = array('name', 'email', 'package_name', 'domain', 'trail_period', 'status', 'monthly_price', 'yearly_price', 'quaterly_price');
            $this->datatables->column_order = $column;
            $this->datatables->column_search = $column;
            $this->datatables->order = array('id' => 'desc');
            $where = array();
            if (!empty($status)) {
                $where = array('tbl_saas_companies.status' => $status);
            }
            $fetch_data = make_datatables($where);

            $data = array();

            $access = super_admin_access();
            foreach ($fetch_data as $key => $row) {
                $action = null;
                $sub_array = array();

                $sub_array[] = '<a href="' . base_url('saas/companies/details/' . $row->id) . '">' . $row->name . '</a>';
                $sub_array[] = $row->email;
                $sub_array[] = $row->domain;
                $sub_array[] = '<a href="' . base_url() . 'saas/gb/package_details/' . $row->id . '" title="' . lang('details') . '" data-toggle="modal" data-target="#myModal">' . $row->package_name . '</a>  ';
                $sub_array[] = $row->trial_period . ' ' . lang('days');
                $sub_array[] = $row->amount . '/' . $row->frequency;

                if ($row->status == 'pending') {
                    $label = 'primary';
                } else if ($row->status == 'running') {
                    $label = 'success';
                } else if ($row->status == 'expired') {
                    $label = 'warning';
                } else {
                    $label = 'danger';
                }

                $sub_array[] = '<span class="label label-' . $label . '">' . lang($row->status) . '</span>';
                $sub_array[] = display_datetime($row->created_date);
                if (!empty($access)) {
                    $action .= btn_edit('saas/companies/create/' . $row->id) . ' ';
                }
                $action .= '<a href="' . base_url('saas/companies/send_welcome_email/' . $row->id) . '" class="btn btn-warning btn-xs" data-toggle="tooltip" data-placement="top" title="' . lang('send_welcome_mail') . '"><span class="fa fa-envelope-o"></span></a>' . ' ';

                $action .= btn_view('saas/companies/details/' . $row->id) . ' ';

                if (!empty($access)) {
                    $action .= ajax_anchor(base_url("saas/companies/delete_companies/$row->id"), "<i class='btn btn-xs btn-danger fa fa-trash-o'></i>", array("class" => "", "title" => lang('delete'), "data-fade-out-on-success" => "#table_" . $key));
                }
                $sub_array[] = $action;
                $data[] = $sub_array;
            }
            render_table($data);
        } else {
            redirect('saas/dashboard');
        }
    }

    public function create($id = null)
    {
        $data['title'] = lang('create_companies');
        if (!empty($id)) {
            $data['company_info'] = get_row('tbl_saas_companies', array('id' => $id));
            if (empty($data['company_info'])) {
                redirect('saas/companies');
            }
        }
        $data['all_packages'] = get_result('tbl_saas_packages', array('status' => 'published'));
        $data['countries'] = $this->saas_model->select_data('tbl_countries', 'value', 'value');
        $data['timezones'] = $this->settings_model->timezones();
        $data['languages'] = $this->settings_model->get_active_languages();
        $data['active'] = 2;
        $data['subview'] = $this->load->view('companies/create', $data, true);
        $this->load->view('_layout_main', $data);
    }

    public function reset_password($id)
    {
        if ($this->session->userdata('user_type') == 4) {
            $new_password = $this->input->post('password', true);
            $old_password = $this->input->post('my_password', true);
            if (!empty($new_password)) {
                $email = $this->session->userdata('email');
                $user_info = $this->db->where('user_id', my_id())->get('tbl_users')->row();
                $old_password = $this->settings_model->hash($old_password);
                if ($user_info->password == $old_password) {
                    $where = array('id' => $id);
                    $action = array('password' => $this->settings_model->hash($new_password));
                    $this->settings_model->set_action($where, $action, 'tbl_saas_companies');
                    $company_info = get_row('tbl_saas_companies', array('id' => $id));
                    if (!empty($company_info->db_name)) {
                        $this->db = config_db($company_info->db_name);
                        if (!empty($this->db)) {
                            $this->db->where('email', $company_info->email);
                            $this->db->update('tbl_users', array('password' => $this->settings_model->hash($new_password)));
                        }
                    }
                    $type = "success";
                    $message = lang('message_new_password_sent');
                } else {
                    $type = "error";
                    $message = lang('password_does_not_match');
                }
                set_message($type, $message);
                redirect('saas/companies/details/' . $id); //redirect page
            } else {
                $data['title'] = lang('see_password');
                $data['company_info'] = get_row('tbl_saas_companies', array('id' => $id));
                $data['subview'] = $this->load->view('companies/reset_password', $data, FALSE);
                $this->load->view('admin/_layout_modal', $data);
            }
        } else {
            $type = 'error';
            $message = lang('there_in_no_value');
            set_message($type, $message);
            redirect('saas/companies'); //redirect page
        }
    }

    public function save_companies($id = null)
    {
        $data = $this->saas_model->array_from_post(array('name', 'email', 'package_id', 'domain', 'timezone', 'language', 'mobile', 'address', 'country'));
        $data['domain'] = slug_it($data['domain']);
        $data['password'] = $this->saas_model->hash($this->input->post('password', true));

        $data['created_date'] = date('Y-m-d H:i:s');
        $data['created_by'] = $this->session->userdata('user_id');
        $data['status'] = 'pending';
        $this->load->library('uuid');
        $data['activation_code'] = $this->uuid->v4();
        $check_email = get_row('tbl_saas_companies', array('email' => $data['email']));
        if (!empty($id)) {
            unset($data['email']);
            unset($data['status']);
            unset($data['activation_code']);
            $company_info = get_row('tbl_saas_companies', array('id' => $id));
            $data['updated_date'] = date('Y-m-d H:i:s');
            $data['updated_by'] = $this->session->userdata('user_id');
            $check_email = '';
        }

        // check email already exist
        $check_domain = get_row('tbl_saas_companies', array('domain' => $data['domain']));
        if (!empty($check_email) && $check_email->id != $id) {
            $type = 'error';
            $msg = lang('already_exists', lang('email'));
        } else if (!empty($check_domain) && $check_domain->id != $id) {
            $type = 'error';
            $msg = lang('already_exists', lang('domain'));
        } else {
            $billing_cycle = $this->input->post('billing_cycle', true);
            $mark_paid = $this->input->post('mark_paid', true);
            $package_info = get_row('tbl_saas_packages', array('id' => $data['package_id']));
            // deduct $billing_cycle from price
            $data['frequency'] = str_replace('_price', '', $billing_cycle);;
            $data['trial_period'] = $package_info->trial_period;
            $data['is_trial'] = 'Yes';
            $data['expired_date'] = $this->input->post('expired_date', true);;
            $data['currency'] = config_item('default_currency');
            $data['amount'] = $package_info->$billing_cycle;

            if (!empty($mark_paid)) {
                $data['status'] = 'running';
                $data['is_trial'] = 'No';
            }

            $this->saas_model->_table_name = 'tbl_saas_companies';
            $this->saas_model->_primary_key = 'id';
            $id = $this->saas_model->save($data, $id);


            if (!empty($company_info) && $company_info->package_id != $data['package_id'] || empty($company_info)) {
                // save data into tbl_saas_companies_history
                // change active status to 0 for all previous data of this company

                $this->saas_model->_table_name = 'tbl_saas_companies_history';
                $this->saas_model->_primary_key = 'companies_id';
                $this->saas_model->save(array('active' => 0), $id);

                $sub_h_data = array(
                    'companies_id' => $id,
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
                    'payment_method' => (!empty($pdata['payment_method'])) ? $pdata['payment_method'] : 'manual',
                );

                $this->saas_model->_table_name = 'tbl_saas_companies_history';
                $this->saas_model->_primary_key = 'id';
                $companies_history_id = $this->saas_model->save($sub_h_data);

                // create database for this company
                if ($data['status'] == 'running') {
                    // create database for the company
                    $this->saas_model->create_database($id);
                }

                if (!empty($mark_paid)) {
                    $discount_percentage = 0;
                    $discount_amount = 0;
                    $coupon_code = '';
                    $is_coupon_applied = $this->input->post('is_coupon', true);
                    if (!empty($is_coupon_applied)) {
                        $coupon_code = $this->input->post('coupon_code', true);
                        $where = array('code' => $coupon_code, 'status' => 'active');
                        $coupon_info = get_old_data('tbl_saas_coupon', $where);

                        if (!empty($coupon_info)) {
                            $user_id = my_id();
                            if (!empty($user_id)) {
                                $where = array('user_id' => $user_id, 'coupon' => $coupon_code);
                            } else {
                                $where = array('email' => $data['email'], 'coupon' => $coupon_code);
                            }
                            $already_apply = get_old_data('tbl_saas_applied_coupon', $where);
                            if (empty($already_apply)) {
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
                                $applied_coupon_id = $this->saas_model->save($coupon_data);
                            }

                        }
                    }

                    // save payment info
                    $payment_date = $this->input->post('payment_date', true);
                    $pdata = array(
                        'reference_no' => $this->input->post('reference_no', true),
                        'companies_history_id' => $companies_history_id,
                        'companies_id' => $id,
                        'transaction_id' => 'TRN' . date('Ymd') . date('His') . '_' . substr(number_format(time() * rand(), 0, '', ''), 0, 6),
                        'payment_method' => (!empty($pdata['payment_method'])) ? $pdata['payment_method'] : 'manual',
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
                    $companies_payment_id = $this->saas_model->save($pdata);
                }
            }
            if (!empty($id)) {
                $msg = lang('update_company');
                $activity = 'activity_update_company';
            } else {
                $msg = lang('save_company');
                $activity = 'activity_save_company';
            }
            // save into activities
            $activities = array(
                'user' => $this->session->userdata('user_id'),
                'module' => 'saas',
                'module_field_id' => $id,
                'activity' => $activity,
                'icon' => 'fa-building-o',
                'value1' => $data['name']
            );
            // Update into tbl_project
            $this->saas_model->_table_name = "tbl_activities"; //table name
            $this->saas_model->_primary_key = "activities_id";
            $this->saas_model->save($activities);

            $this->saas_model->send_welcome_email($id);

            $type = "success";
        }
        $message = $msg;
        set_message($type, $message);
        redirect('saas/companies');
    }

    public
    function details($id = null)
    {
        $data['title'] = lang('details_companies');
        $data['company_info'] = $this->saas_model->select_data('tbl_saas_companies', 'tbl_saas_companies.*,tbl_saas_companies_history.package_name,tbl_saas_companies_history.id as company_history_id', NULL, array('tbl_saas_companies.id' => $id, 'tbl_saas_companies_history.active' => 1), ['tbl_saas_companies_history' => 'tbl_saas_companies.id = tbl_saas_companies_history.companies_id'], 'row');
        $data['subview'] = $this->load->view('companies/details', $data, true);
        $this->load->view('_layout_main', $data);
    }

    public function reset_db($id, $fresh_db = null)
    {
        $result = $this->saas_model->create_database($id, $fresh_db);
        if ($result['result'] == 'success') {
            $type = "success";
            $message = lang('reset_db_success');
        } else {
            $type = "error";
            $message = lang('reset_db_failed') . ' ' . $result['error'];
        }
        set_message($type, $message);
        redirect('saas/companies/details/' . $id);
    }

    public
    function invoices()
    {
        $data['title'] = lang('invoices');
        $data['active'] = 1;
        $data['subview'] = $this->load->view('companies/invoices', $data, true);
        $this->load->view('_layout_main', $data);
    }


    public
    function delete_companies($id = null)
    {
        $companyInfo = $this->saas_model->check_by(array('id' => $id), 'tbl_saas_companies');
        if (!empty($companyInfo->db_name)) {
            $this->drop_database($companyInfo->db_name);
        }
        // delete data from tbl_saas_companies_history
        $this->saas_model->_table_name = 'tbl_saas_companies_history';
        $this->saas_model->delete_multiple(array('companies_id' => $id));

        // delete data from tbl_saas_companies_payment
        $this->saas_model->_table_name = 'tbl_saas_companies_payment';
        $this->saas_model->delete_multiple(array('companies_id' => $id));

        // delete data from tbl_saas_companies
        $this->saas_model->_table_name = 'tbl_saas_companies';
        $this->saas_model->_primary_key = 'id';
        $this->saas_model->delete($id);

        // messages for user
        $type = "success";
        $message = lang('companies_deleted');
        set_message($type, $message);
        redirect('admin/saas/companies');
    }

    function drop_database($db_name)
    {
        if (ConfigItems('saas_server') === 'cpanel') {
            include_once(MODULES_PATH . 'saas/libraries/Xmlapi.php');
            $cpanel_password = decrypt(ConfigItems('saas_cpanel_password'));
            $output = ConfigItems('saas_cpanel_output');
            $db_username = $this->db->username;
            $xmlapi = new xmlapi(ConfigItems('saas_cpanel_host'));
            $xmlapi->password_auth(ConfigItems('saas_cpanel_username'), $cpanel_password);
            $xmlapi->set_port(ConfigItems('saas_cpanel_port'));
            $xmlapi->set_debug(0);
            $xmlapi->set_output($output);
            $cpaneluser = config_item('saas_cpanel_username');
            $databasename = $db_name;
            $xmlapi->api1_query($cpaneluser, 'Mysql', 'deldb', array($databasename));
        }
        // check if database exists or not in codeigniter
        $this->load->dbutil();
        if ($this->dbutil->database_exists($db_name)) {
            $this->myforge = $this->load->dbforge($db_name, TRUE);
            if ($this->myforge->drop_database($db_name)) {
                return true;
            } else {
                $this->new_db = config_db($db_name);
                if (!empty($this->new_db)) {
                    $tables = $this->new_db->list_tables();
                    foreach ($tables as $table) {
                        $this->myforge->drop_table($table);
                    }
                }
                return true;
            }
        }
        return true;
    }

    public
    function pricing($id = null)
    {
        $data['title'] = lang('pricing');
        $data['active'] = 1;
        $data['subview'] = $this->load->view('companies/pricing', $data, true);
        $this->load->view('_layout_main', $data);
    }

    public function send_welcome_email($id)
    {
        $this->saas_model->send_welcome_email($id);
        $type = "success";
        $message = lang('welcome_email_sent');
        set_message($type, $message);
        redirect('saas/companies');
    }


}

