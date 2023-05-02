<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Gb extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('saas_model');
    }

    public function signup_company()
    {
        $data['title'] = 'Signup Company';
        $data['package_id'] = $this->input->post('package_id', true);
        $data['package'] = get_row('tbl_saas_packages', array(
            'id' => $data['package_id']
        ));
        $data['all_packages'] = get_result('tbl_saas_packages', array('status' => 'published'));
        $data['countries'] = $this->saas_model->select_data('tbl_countries', 'value', 'value');
        $_data['subview'] = $this->load->view('saas/frontcms/frontend/signup_company', $data, true);
        echo json_encode($_data);
        exit();
    }

    public function package_details($id, $status = null)
    {

        $data['title'] = 'Dashboard';
        if (!empty($status)) {
            $data['package_info'] = get_old_result('tbl_saas_companies_history', array('id' => $id), false);
            $data['package_info']->name = $data['package_info']->package_name;
        } else {
            $data['package_info'] = get_old_result('tbl_saas_packages', array('id' => $id), false);
        }
        $data['modal_subview'] = $this->load->view('packages/package_details', $data, false);
        $this->load->view('admin/_layout_modal', $data);
    }

    public function get_package_info()
    {
        // check is ajax request
        if (!$this->input->is_ajax_request()) {
            redirect('admin/dashboard');
        }

        $data['title'] = 'Dashboard';
        $package_id = $this->input->post('package_id');
        $front = $this->input->post('front');
        $company_id = $this->input->post('company_id', true);
        $package_type = $this->input->post('package_type');
        $package_type = (!empty($package_type)) ? $package_type : 'monthly_price';
        // cut _price from package_type
        $data['type_title'] = str_replace('_price', '', $package_type);
        if ($data['type_title'] == 'quarterly') {
            $data['renew_date'] = date('Y-m-d', strtotime('+3 month'));
        } elseif ($data['type_title'] == 'yearly') {
            $data['renew_date'] = date('Y-m-d', strtotime('+1 year'));
        } else {
            $data['renew_date'] = date('Y-m-d', strtotime('+1 month'));
        }
        $data['type'] = (!empty($package_type)) ? $package_type : 'monthly_price';
        if (!empty($front)) {
            $data['package_info'] = get_row('tbl_saas_packages', array('id' => $package_id));
        } else {
            $data['package_info'] = get_old_result('tbl_saas_packages', array('id' => $package_id), false);
        }
        $data['options'] = ['monthly_price' => lang('monthly'), 'quarterly_price' => lang('quarterly'), 'yearly_price' => lang('yearly')];
        $data['company_id'] = $company_id;
        $data['front'] = $front;
        $_data['package_form_group'] = $this->load->view('saas/packages/package_billing', $data, true);
        $_data['package_details'] = $this->load->view('saas/packages/plain_package_details', $data, true);
        $_data['package_info'] = $data['package_info'];
        echo json_encode($_data);
        exit();
    }


    public function check_coupon_code()
    {
        $coupon_code = $this->input->post('coupon_code', true);
        $package_id = $this->input->post('package_id', true);
        $billing_cycle = $this->input->post('billing_cycle', true);
        $email = $this->input->post('email', true);

        $where = array('code' => $coupon_code, 'status' => 'active');
        $coupon_info = get_old_result('tbl_saas_coupon', $where, false);
        if (!empty($coupon_info)) {
            // check coupon end date must be greater than or equal to current date

            if (strtotime($coupon_info->end_date) <= strtotime(date('Y-m-d'))) {
                $result['error'] = true;
                $result['message'] = lang('coupon_expired');
                $result['coupon_code_input'] = null;
            } else {
                $user_id = my_id();
                if (!empty($user_id)) {
                    $where = array('user_id' => $user_id, 'coupon' => $coupon_code);
                } else {
                    $where = array('email' => $email, 'coupon' => $coupon_code);
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
                    $result['sub_total_text'] = display_money($sub_total, default_currency());
                    $result['sub_total_input'] = $sub_total;
                    $result['total_text'] = display_money($sub_total - $discount_amount, default_currency());
                    $result['total_input'] = $sub_total - $discount_amount;
                    $result['discount_percentage'] = $discount_percentage;
                    $result['coupon_code_input'] = $coupon_code;
                    $result['message'] = '';

                    $html = '';
                    $html .= '<div class="form-group"><label class="col-sm-3 control-label">' . lang('discount') . '</label>';
                    $html .= '<div class="col-sm-5"><div class="input-group"><span class="input-group-addon">(' . $discount_percentage . ')</span>';
                    $html .= '<input type="text" class="form-control" name="discount_amount" value="' . $discount_amount . '" readonly >';
                    $html .= '</div></div></div>';

                    $thtml = '';
                    $thtml .= '<div class="form-group"><label class="col-sm-3 control-label">' . lang('total_amount') . '</label>';
                    $thtml .= '<div class="col-sm-5"><div class="input-group"><span class="input-group-addon">' . default_currency() . '</span>';
                    $thtml .= '<input type="text" class="form-control" name="total_amount" value="' . $result['total_input'] . '" readonly >';
                    $thtml .= '</div></div></div>';

                    if ($coupon_info->package_id == 0) {
                        $result['success'] = true;
                        $result['applied_discount'] = $html;
                        $result['total_amount'] = $thtml;
                        $result['discount_amount_text'] = display_money($discount_amount, default_currency());
                        $result['discount_amount_input'] = $discount_amount;
                        $result['message'] = '';
                    } elseif ($coupon_info->package_id == $package_id) {
                        $result['success'] = true;
                        $result['html'] = $html;
                        $result['message'] = '';
                        $result['discount_amount_text'] = display_money($discount_amount, default_currency());
                        $result['discount_amount_input'] = $discount_amount;
                    } else {
                        $result['error'] = true;
                        $result['message'] = lang('the_coupon_code_is_invalid');
                        $result['coupon_code_input'] = null;
                    }
                } else {
                    $result['error'] = true;
                    $result['message'] = lang('the_coupon_code_already_used');
                    $result['coupon_code_input'] = null;
                }
            }
        } else {
            $result['error'] = true;
            $result['message'] = lang('coupon_not_exist');
            $result['coupon_code_input'] = null;
        }
        echo json_encode($result);
        exit();
    }

    function check_already_exists()
    {
        // check ajax request or not
        if (!$this->input->is_ajax_request()) {
            redirect('saas/dashboard');
        }
        $type = $this->input->post('type', true);
        $value = $this->input->post('value', true);
        $companies = get_row('tbl_saas_companies', array($type => $value));
        if (!empty($companies)) {
            $result['status'] = 'error';
            $result['message'] = lang('already_exists', lang($type));
        } else {
            $result['status'] = 'success';
        }
        echo json_encode($result);
        exit();
    }

    public function update_sub_validity($id)
    {
        $validity = $this->input->post('validity', true);
        $status = $this->input->post('status', true);

        $data = $this->total_count_date($id, $validity, $status);
        if (empty($data['status'])) {
            $data['status'] = $status;
        }
        $data['maintenance_mode'] = ($this->input->post('maintenance_mode', true) == 'on') ? 'Yes' : 'No';
        $data['remarks'] = $this->input->post('remarks', true);
        $data['maintenance_mode_message'] = $this->input->post('maintenance_mode_message', true);

        // update sub_validity into saas_companies table
        $this->saas_model->_table_name = 'tbl_saas_companies';
        $this->saas_model->_primary_key = 'id';
        $this->saas_model->save($data, $id);
        set_message('success', lang('update_settings'));
        redirect('saas/companies/details/' . $id);


    }

    function total_count_date($id, $date, $status)
    {
        $company_info = get_row('tbl_saas_companies', array('id' => $id));
        $time = date('Y-m-d', strtotime($company_info->created_date));
        $to_date = strtotime($time); //past date.
        $cur_date = strtotime($date);
        $timeleft = $cur_date - $to_date;
        $daysleft = round((($timeleft / 24) / 60) / 60);
        if ($date > $time && $status == 'expired') {
            $data['status'] = 'running';
        }
        if ($company_info->trial_period != 0) {
            $data['trial_period'] = $daysleft;
            $data['is_trial'] = 'Yes';
        } else {
            $data['trial_period'] = 0;
            $data['is_trial'] = 'No';
            $data['expired_date'] = date("Y-m-d", strtotime($daysleft . "day"));
        }
        return $data;
    }

    public function assignPackage()
    {
        $data['title'] = lang('assign_package');
        $view = '_layout_main';
        if (!empty(is_subdomain())) {
            $view = '_layout_open';
            $data['current_package'] = get_company_subscription()->package_id;
        }
        $data['all_packages'] = get_old_result('tbl_saas_packages', array('status' => 'published'));
        $data['subview'] = $this->load->view('saas/packages/assign_package', $data, TRUE);
        $this->load->view($view, $data);

    }

    public
    function checkoutPayment()
    {
        $data['package_id'] = $this->input->post('package_id', true);
        $data['frequency'] = 'monthly';
        if (empty($data['package_id'])) {
            $subs_info = get_company_subscription(null, 'running');
            $data['package_id'] = $subs_info->package_id;
            $data['frequency'] = $subs_info->frequency;
        }
        $package_info = get_old_result('tbl_saas_packages', array('id' => $data['package_id']), false);
        $data['title'] = lang('checkout') . ' ' . lang('payment') . ' ' . lang('for') . ' ' . $package_info->name;
        $data['package_info'] = $package_info;
        $data['all_packages'] = get_old_result('tbl_saas_packages', array('status' => 'published'));
        $subview = 'checkoutPayment';
        if (is_subdomain()) {
            $front_end = true;
            $data['subs_info'] = get_company_subscription();
            $subview = 'checkoutPaymentOpen';
        }
        $data['subview'] = $this->load->view('saas/packages/' . $subview, $data, TRUE);
        $user_id = $this->session->userdata('user_id');
        if (!empty($user_id) && empty($front_end)) {
            $this->load->view('_layout_main', $data); //page load
        } elseif (!empty($front_end)) {
            $this->load->view('_layout_open', $data); //page load
        } else {
            $this->load->view('frontend/_layout_main', $data); //page load
        }
    }

    public function privacy()
    {
        $data['title'] = lang('privacy');
        $data['result'] = config_item('saas_privacy');
        $data['subview'] = $this->load->view('saas/settings/privacy', $data, TRUE);
        $this->load->view('_layout_open', $data);
    }

    public function tos()
    {
        $data['title'] = lang('tos');
        $data['result'] = config_item('saas_tos');
        $data['subview'] = $this->load->view('saas/settings/privacy', $data, TRUE);
        $this->load->view('_layout_open', $data);
    }

    public function update_company_packages($companies_id = null)
    {
        if (empty($companies_id)) {
            $companies_id = $this->input->post('companies_id', true);
            $package_id = $this->input->post('package_id', true);
        }
        $company_info = get_row('tbl_saas_companies', array('id' => $companies_id));
        if (empty($package_id)) {
            $package_id = $company_info->package_id;
        }
//        if (empty($company_info->db_name)) {
        $this->saas_model->create_database($companies_id);
//        }

        if ($company_info->package_id != $package_id) {
            $package_info = get_row('tbl_saas_packages', array('id' => $package_id));

            $data['updated_date'] = date('Y-m-d H:i:s');
            $data['updated_by'] = $this->session->userdata('user_id');
            $billing_cycle = $this->input->post('billing_cycle', true);
            $mark_paid = $this->input->post('mark_paid', true);
            $data['frequency'] = str_replace('_price', '', $billing_cycle);;
            $data['trial_period'] = $package_info->trial_period;
            $data['is_trial'] = 'Yes';
            $data['expired_date'] = $this->input->post('expired_date', true);;
            $data['package_id'] = $package_id;
            $data['currency'] = ConfigItems('default_currency');
            $data['amount'] = $package_info->$billing_cycle;
            if (!empty($mark_paid)) {
                $data['status'] = 'running';
                $data['is_trial'] = 'No';
            }
            $this->saas_model->_table_name = 'tbl_saas_companies';
            $this->saas_model->_primary_key = 'id';
            $this->saas_model->save($data, $companies_id);


            $this->saas_model->_table_name = 'tbl_saas_companies_history';
            $this->saas_model->_primary_key = 'companies_id';
            $this->saas_model->save(array('active' => 0), $companies_id);

            // save saas_companies_history
            $sub_h_data = array(
                'companies_id' => $companies_id,
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
                    'companies_id' => $companies_id,
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
            $this->saas_model->save($activities);

            $type = 'success';
            $message = lang('package_successfully_assigned');
            // send email to client
            $this->saas_model->send_email_to_company($companies_id);
        } else {
            $type = 'error';
            $message = lang('you_can_not_assign_same_package_to_company');
        }
        set_message($type, $message);
        redirect('saas/dashboard');
    }


    public function completePaypalPayment($id)
    {
        $input_data = $this->session->userdata('input_info');
        if (!empty($input_data)) {
            $reference_no = $this->session->userdata('reference_no');
            $cf = $input_data['payment_method'] . '_payment';
            $paypalResponse = $this->$cf->complete_purchase([
                'token' => $reference_no,
                'amount' => $input_data['amount'],
                'currency' => $input_data['currency'],
            ]);
            // Check if error exists in the response
            if (isset($paypalResponse['L_ERRORCODE0'])) {
                set_message('error', $paypalResponse['L_SHORTMESSAGE0'] . '<br />' . $paypalResponse['L_LONGMESSAGE0']);
            } elseif (isset($paypalResponse['PAYMENTINFO_0_ACK']) && $paypalResponse['PAYMENTINFO_0_ACK'] === 'Success') {
                $input_data['transaction_id'] = $paypalResponse['PAYMENTINFO_0_TRANSACTIONID'];
                $input_data['mark_paid'] = 'Yes';
                $result = $this->saas_model->update_package($input_data['companies_id'], $input_data);
                if (!empty($result)) {
                    set_message('success', 'Payment successfully completed');
                } else {
                    set_message('error', 'Payment failed');
                }
            } else {
                $type = 'error';
                $message = lang('please_select_payment_method');
                set_message($type, $message);
            }
        }
        $this->session->unset_userdata('input_info');
        $this->session->unset_userdata('reference_no');
        redirect('admin/dashboard');
    }

    public function stipePaymentSuccess($data = null)
    {
        // receive metadata from stripe
        $data = url_decode($data);
        $data['mark_paid'] = 'Yes';
        $result = $this->saas_model->update_package($data['companies_id'], $data);
        if (!empty($result)) {
            set_message('success', 'Payment successfully completed');
        } else {
            set_message('error', 'Payment failed');
        }
        redirect('admin/dashboard');
    }

    public function paymentCancel($data = null)
    {
        $data = url_decode($data);
        $type = 'error';
        $message = lang('payment_cancelled');
        set_message($type, $message);
        redirect('admin/dashboard');
    }

    public function get_expired_date($package_type)
    {
        $type_title = str_replace('_price', '', $package_type);
        if ($type_title == 'quarterly') {
            $renew_date = date('Y-m-d', strtotime('+3 month'));
        } elseif ($type_title == 'yearly') {
            $renew_date = date('Y-m-d', strtotime('+1 year'));
        } else {
            $renew_date = date('Y-m-d', strtotime('+1 month'));
        }
        return $renew_date;
    }


    public function proceedPayment($payment_method = null)
    {
        if (!empty($payment_method)) {
            $subs_info = get_company_subscription(null, 'running');
            $data['companies_id'] = $subs_info->companies_id;
            $data['package_id'] = $subs_info->package_id;
            $data['billing_cycle'] = $subs_info->frequency . '_price';
            $data['expired_date'] = $this->get_expired_date($data['billing_cycle']);
            $data['amount'] = $subs_info->amount;
            $data['payment_method'] = $payment_method;
            $data['i_have_read_agree'] = 'on';
        } else {
            $data = $_POST;
        }
        $payment_method = $data['payment_method'] . '_payment';
        $this->$payment_method->proceedPayment($data);
    }


    public function signed_up()
    {
        $data = $this->saas_model->array_from_post(array('name', 'email', 'package_id', 'domain', 'mobile', 'address', 'country'));
        $data['domain'] = slug_it($data['domain']);
        $data['timezone'] = $this->config->item('timezone');
        $data['language'] = $this->config->item('default_language');
//        $data['password'] = $this->saas_model->hash($this->input->post('password', true));
        $data['created_date'] = date('Y-m-d H:i:s');
        $data['created_by'] = NULL;
        $data['status'] = 'pending';
        $this->load->library('uuid');
        $data['activation_code'] = $this->uuid->v4();
        $check_email = get_row('tbl_saas_companies', array('email' => $data['email']));
        // check email already exist
        $check_domain = get_row('tbl_saas_companies', array('domain' => $data['domain']));
        if (!empty($check_email)) {
            $type = 'error';
            $msg = lang('already_exists', lang('email'));
        } else if (!empty($check_domain)) {
            $type = 'error';
            $msg = lang('already_exists', lang('domain'));
        } else {
            $billing_cycle = $this->input->post('billing_cycle', true);
            $package_info = get_row('tbl_saas_packages', array('id' => $data['package_id']));

            // deduct $billing_cycle from price
            $data['frequency'] = str_replace('_price', '', $billing_cycle);;
            $data['trial_period'] = $package_info->trial_period;
            $data['is_trial'] = 'Yes';
            $data['expired_date'] = $this->input->post('expired_date', true);;
            $data['currency'] = ConfigItems('default_currency');
            $data['amount'] = $package_info->$billing_cycle;

            $this->saas_model->_table_name = 'tbl_saas_companies';
            $this->saas_model->_primary_key = 'id';
            $id = $this->saas_model->save($data);


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
            $this->saas_model->save($sub_h_data);

            $this->saas_model->send_activation_token_email($id);

            $type = "success";
            $msg = 'Registration Successfully Completed. Please check your email for activation link.';
            $activity = 'activity_save_company';

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
        }
        $message = $msg;
        set_message($type, $message);
        redirect('front/pricing');
    }

    public function upgrade()
    {
        $data['title'] = lang('upgrade') . ' ' . lang('plan');
        if (!empty($type)) {
            $data['type'] = $type;
        }
        $data['sub_info'] = get_company_subscription();
        $data['subview'] = $this->load->view('settings/upgrade', $data, TRUE);
        $this->load->view('_layout_open', $data); //page load
    }

    public function companyHistoryList($id = null)
    {
        // make datatable
        $this->db = config_db(null, true);
        $this->load->model('datatables');
        $this->datatables->table = 'tbl_saas_companies_history';
        $column = array('package_name', 'amount', 'frequency', 'created_at', 'validity', 'payment_method', 'status');
        $this->datatables->column_order = $column;
        $this->datatables->column_search = $column;
        $this->datatables->order = array('id' => 'desc');
        if ($id) {
            $where = array('tbl_saas_companies_history.companies_id' => $id);
        } else {
            $where = array();
        }
        $fetch_data = make_datatables($where);
        $data = array();
        foreach ($fetch_data as $_key => $v_history) {
            if ($v_history->active == 1) {
                $label = 'success';
                $status = 'active';
            } else {
                $label = 'warning';
                $status = 'inactive';
            }
            if ($v_history->frequency == 'monthly') {
                $frequency = lang('mo');
            } else if ($v_history->frequency == 'quarterly') {
                $frequency = lang('qu');
            } else if ($v_history->frequency == 'yearly') {
                $frequency = lang('yr');
            }
            $action = null;
            $sub_array = array();
            $sub_array[] = '<a href="' . base_url('subs_package_details/' . $v_history->id . '/1') . '"  data-toggle="modal" data-target="#myModal" >' . $v_history->package_name . '</a>';
            $sub_array[] = display_money($v_history->amount, default_currency()) . ' /' . $frequency;
            $sub_array[] = display_datetime($v_history->created_at);
            $sub_array[] = (!empty($v_history->validity) ? $v_history->validity : '-');
            $sub_array[] = $v_history->payment_method;
            $sub_array[] = '<span class="label label-' . $label . '">' . lang($status) . '</span>';
            $data[] = $sub_array;
        }
        render_table($data, $where);
    }

    public function companyPaymentList($id = null)
    {
        // make datatable
        $this->db = config_db(null, true);
        $this->load->model('datatables');
        $this->datatables->table = 'tbl_saas_companies_payment';
        $this->datatables->join_table = array('tbl_saas_companies', 'tbl_saas_companies_history');
        $this->datatables->join_where = array('tbl_saas_companies.id=tbl_saas_companies_payment.companies_id', 'tbl_saas_companies_history.id=tbl_saas_companies_payment.companies_history_id');

        $column = array('tbl_saas_companies_history.package_name', 'transaction_id', 'total_amount', 'payment_date', 'payment_method');
        $this->datatables->column_order = $column;
        $this->datatables->column_search = $column;
        $this->datatables->order = array('id' => 'desc');
        $this->datatables->select = ('tbl_saas_companies_payment.*,tbl_saas_companies_history.package_name,tbl_saas_companies.name as company_name');
        // select tbl_saas_companies_history.name
        if (!empty($id)) {
            $where = array('tbl_saas_companies_payment.companies_id' => $id);
        } else {
            $where = array();
        }
        $fetch_data = make_datatables($where);
        $data = array();
        foreach ($fetch_data as $_key => $v_history) {
            $action = null;
            $sub_array = array();
            $sub_array[] = $v_history->company_name;
            $sub_array[] = '<a href="' . base_url('subs_package_details/' . $v_history->companies_history_id . '/1') . '"  data-toggle="modal" data-target="#myModal" >' . $v_history->package_name . '</a>';
            $sub_array[] = $v_history->transaction_id;
            $sub_array[] = display_money($v_history->total_amount, $v_history->currency);
            $sub_array[] = display_datetime($v_history->payment_date);
            $sub_array[] = $v_history->payment_method;
            $data[] = $sub_array;
        }
        render_table($data, $where);
    }


    public function billing()
    {
        $data['title'] = lang('billing');
        $data['company_info'] = get_company_subscription();
        $data['subview'] = $this->load->view('companies/billing', $data, TRUE);
        $this->load->view('_layout_open', $data); //page load
    }

    public function purchase_package_details($id)
    {

        $data['title'] = 'Dashboard';
        $data['package_info'] = get_old_result('tbl_saas_companies_history', array('active' => 1, 'companies_id' => $id), false);
        $data['package_info']->name = $data['package_info']->package_name;
        $data['modal_subview'] = $this->load->view('saas/packages/package_details', $data, false);
        $this->load->view('saas/layout/_layout_modal', $data);
    }


}
