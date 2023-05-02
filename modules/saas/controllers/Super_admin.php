<?php defined('BASEPATH') or exit('No direct script access allowed');

class Super_admin extends Gb_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('saas_model');
        $this->load->model('user_model');
        saas_access();
    }

    public function index()
    {
        // $user_id = $id;
        $data['active'] = 1;
        $data['title'] = 'User List';
        $data['breadcrumbs'] = lang('super_admin');

        $data['subview'] = $this->load->view('user/user_list', $data, true);
        $this->load->view('_layout_main', $data);
    }

    public function userList($filterBy = null)
    {
        if ($this->input->is_ajax_request()) {
            $this->load->model('datatables');
            $this->datatables->table = 'tbl_users';
            $this->datatables->join_table = array('tbl_account_details');
            $this->datatables->join_where = array('tbl_account_details.user_id=tbl_users.user_id');

            $custom_field = array();
            $action_array = array('tbl_users.user_id');
            $main_column = array('tbl_users.username', 'tbl_account_details.fullname', 'tbl_account_details.employment_id', 'tbl_account_details.language', 'tbl_account_details.phone', 'tbl_account_details.mobile', 'tbl_account_details.skype');
            $result = array_merge($main_column, $custom_field, $action_array);
            $this->datatables->column_order = $result;
            $this->datatables->column_search = $result;
            $this->datatables->order = array('tbl_users.user_id' => 'desc');
            $where = array('tbl_users.role_id' => 4);
            // get all invoice
            $fetch_data = make_datatables($where);

            $data = array();

            $edited = super_admin_access();
            $deleted = super_admin_access();
            foreach ($fetch_data as $_key => $v_user) {
                $action = null;
                $sub_array = array();
                $sub_array[] = '<img style="width: 36px;margin-right: 10px;" src="' . base_url() . staffImage($v_user->user_id) . '" class="img-circle">';;
                $sub_array[] = $v_user->fullname;
                $sub_array[] = $v_user->username;
                $active = null;
                if ($v_user->user_id != $this->session->userdata('user_id')) {
                    if (!empty($edited)) {
                        $active .= '<div class="change_user_status"><input data-id="' . $v_user->user_id . '" data-toggle="toggle" name="active" value="1" ' . ((!empty($v_user->activated) && $v_user->activated == '1') ? 'checked' : '') . ' data-on="' . lang('yes') . '" data-off="' . lang('no') . '" data-onstyle="success btn-xs" data-offstyle="danger btn-xs" type="checkbox"></div>';
                    } else {
                        if ($v_user->activated == 1) {
                            $active .= '<span class="label label-success">' . lang('active') . '</span>';
                        } else {
                            $active .= '<span class="label label-danger">' . lang('deactive') . '</span>';
                        }
                    }
                } else {
                    if ($v_user->activated == 1) {
                        $active .= '<span class="label label-success">' . lang('active') . '</span>';
                    } else {
                        $active .= '<span class="label label-danger">' . lang('deactive') . '</span>';
                    }
                }
                if ($v_user->banned == 1) {
                    $active .= '<span class="label label-danger" data-toggle="tooltip" data-placement="top" title="' . $v_user->ban_reason . '">' . lang('banned') . '</span>';
                }
                if ($v_user->user_id != $this->session->userdata('user_id')) {
                    if (!empty($edited)) {
                        if ($v_user->banned == 1) {
                            $action .= '<a data-toggle="tooltip" data-placement="top" class="btn btn-success btn-xs" title="Click to ' . lang("unbanned") . ' " href="' . base_url() . 'admin/user/set_banned/0/' . $v_user->user_id . '"><span class="fa fa-check"></span></a>' . ' ';
                        } else {
                            $action .= '<span data-toggle="tooltip" data-placement="top" title="Click to ' . lang('banned') . ' ">' . btn_banned_modal('admin/user/change_banned/' . $v_user->user_id) . '</span>' . ' ';
                        }
                    }
                    $action .= '<a data-toggle="tooltip" data-placement="top" class="btn btn-info btn-xs" title="' . lang('send') . ' ' . lang('wellcome_email') . ' " href="' . base_url() . 'admin/user/send_welcome_email/' . $v_user->user_id . '"><span class="fa fa-envelope-o"></span></a>' . ' ';


                    $action .= btn_edit('saas/super_admin/create/edit_user/' . $v_user->user_id) . ' ';
                    $action .= ajax_anchor(base_url("saas/super_admin/delete_user/$v_user->user_id"), "<i class='btn btn-xs btn-danger fa fa-trash-o'></i>", array("class" => "", "title" => lang('delete'), "data-fade-out-on-success" => "#table_" . $_key)) . ' ';
                }
                $sub_array[] = $active;
                $sub_array[] = $action;
                $data[] = $sub_array;
            }
            render_table($data, $where);
        } else {
            redirect('admin/dashboard');
        }
    }

    public function create($action = NULL, $id = NULL)
    {
        $user_id = $id;
        $data['breadcrumbs'] = lang('super_admin');
        if ($action == 'edit_user') {
            $edited = super_admin_access();
            if (!empty($edited) && $id != $this->session->userdata('user_id')) {
                $data['login_info'] = $this->db->where('user_id', $user_id)->get('tbl_users')->row();
                $data['warehouse_id'] = $this->db->where('user_id', $user_id)->get('tbl_account_details')->row();
            }
        }
        $data['active'] = 2;
        $data['title'] = 'Create User ';
        // get all language
        $data['languages'] = get_order_by('tbl_languages', array('active' => 1), 'name');
        $data['subview'] = $this->load->view('user/create', $data, true);
        $this->load->view('_layout_main', $data);
    }

    public function save_user($id = null)
    {
        if (!empty($id) && $id == my_id()) {
            set_message('error', lang('can_not_edit_yourself'));
            redirect('saas/super_admin');
        }

        $created = super_admin_access('24', 'created');
        $edited = super_admin_access('24', 'edited');
        if (!empty($created) || !empty($edited) && !empty($id)) {
            $login_data = $this->user_model->array_from_post(array('username', 'email', 'role_id'));

            $user_id = $this->input->post('user_id', true);
            // update root category
            $where = array('username' => $login_data['username']);
            $email = array('email' => $login_data['email']);
            $login_data['role_id'] = 4;
            // duplicate value check in DB
            if (!empty($user_id)) { // if id exist in db update data
                $check_id = array('user_id !=' => $user_id);
            } else { // if id is not exist then set id as null
                $check_id = null;
            }
            // check whether this input data already exist or not
            $check_user = $this->user_model->check_update('tbl_users', $where, $check_id);
            $check_email = $this->user_model->check_update('tbl_users', $email, $check_id);
            if (!empty($check_user) || !empty($check_email)) { // if input data already exist show error alert
                if (!empty($check_user)) {
                    $error = $login_data['username'];
                } else {
                    $error = $login_data['email'];
                }

                // massage for user
                $type = 'error';
                $message = "<strong style='color:#000'>" . $error . '</strong>  ' . lang('already_exist');

                $password = $this->input->post('password', TRUE);
                $confirm_password = $this->input->post('confirm_password', TRUE);
                if ($password != $confirm_password) {
                    $type = 'error';
                    $message = lang('password_does_not_match');
                }
            } else { // save and update query
                $login_data['last_ip'] = $this->input->ip_address();

                if (empty($user_id)) {
                    $password = $this->input->post('password', TRUE);
                    $login_data['password'] = $this->hash($password);
                }

                $this->user_model->_table_name = 'tbl_users'; // table name
                $this->user_model->_primary_key = 'user_id'; // $id
                if (!empty($user_id)) {
                    $id = $this->user_model->save($login_data, $user_id);
                } else {
                    $login_data['activated'] = '1';
                    $id = $this->user_model->save($login_data);
                }
                // save into tbl_account details
                $profile_data = $this->user_model->array_from_post(array('fullname', 'employment_id', 'company', 'locale', 'language', 'phone', 'mobile', 'skype', 'designations_id', 'direction', 'warehouse_id'));

                if ($login_data['role_id'] != 2) {
                    $profile_data['company'] = 0;
                }

                $account_details_id = $this->input->post('account_details_id', TRUE);
                if (!empty($_FILES['avatar']['name'])) {
                    $val = $this->user_model->uploadImage('avatar');
                    $val == TRUE || redirect('saas/super_admin');
                    $profile_data['avatar'] = $val['path'];
                }

                $profile_data['user_id'] = $id;

                $this->user_model->_table_name = 'tbl_account_details'; // table name
                $this->user_model->_primary_key = 'account_details_id'; // $id
                if (!empty($account_details_id)) {
                    $this->user_model->save($profile_data, $account_details_id);
                } else {
                    $id = $this->user_model->save($profile_data);
                }
                if (!empty($profile_data['designations_id'])) {
                    $desig = $this->db->where('designations_id', $profile_data['designations_id'])->get('tbl_designations')->row();
                    $department_head_id = $this->input->post('department_head_id', true);
                    if (!empty($department_head_id)) {
                        $head['department_head_id'] = $id;
                    } else {
                        $dep_head = $this->user_model->check_by(array('departments_id' => $desig->departments_id), 'tbl_departments');

                        if (empty($dep_head->department_head_id)) {
                            $head['department_head_id'] = $id;
                        }
                    }
                    if (!empty($desig->departments_id) && !empty($head)) {
                        $this->user_model->_table_name = "tbl_departments"; //table name
                        $this->user_model->_primary_key = "departments_id";
                        $this->user_model->save($head, $desig->departments_id);
                    }
                }

                $activities = array(
                    'user' => $this->session->userdata('user_id'),
                    'module' => 'user',
                    'module_field_id' => $id,
                    'activity' => 'activity_added_new_user',
                    'icon' => 'fa-user',
                    'value1' => $login_data['username']
                );
                $this->user_model->_table_name = 'tbl_activities';
                $this->user_model->_primary_key = "activities_id";
                $this->user_model->save($activities);
                if (!empty($id)) {
                    $this->user_model->_table_name = 'tbl_client_role'; //table name
                    $this->user_model->delete_multiple(array('user_id' => $id));
                    $all_client_menu = $this->db->get('tbl_client_menu')->result();
                    foreach ($all_client_menu as $v_client_menu) {
                        $client_role_data['menu_id'] = $this->input->post($v_client_menu->label, true);
                        if (!empty($client_role_data['menu_id'])) {
                            $client_role_data['user_id'] = $id;
                            $this->user_model->_table_name = 'tbl_client_role';
                            $this->user_model->_primary_key = 'client_role_id';
                            $this->user_model->save($client_role_data);
                        }
                    }
                }

                if (!empty($user_id)) {
                    $message = lang('update_user_info');
                } else {
                    $message = lang('save_user_info');
                }
                $type = 'success';
            }
            set_message($type, $message);
        }
        redirect('saas/super_admin'); //redirect page
    }

    public function hash($string)
    {
        return hash('sha512', $string . config_item('encryption_key'));
    }

    /*     * * Delete User ** */
    public function delete_user($id = null)
    {
        $deleted = super_admin_access('24', 'deleted');
        $user_info = $this->user_model->check_by(array('user_id' => $id), 'tbl_users');
        if (!empty($user_info)) {
            if (!empty($deleted)) {
                $this->user_model->_table_name = "tbl_users"; //table name
                $this->user_model->_primary_key = "user_id";
                $this->user_model->delete($id);

                $activity = array(
                    'user' => $this->session->userdata('user_id'),
                    'module' => 'items',
                    'module_field_id' => $id,
                    'activity' => 'activity_items_deleted',
                    'icon' => 'fa-circle-o',
                    'value1' => $user_info->username
                );
                $this->user_model->_table_name = 'tbl_activities';
                $this->user_model->_primary_key = 'activities_id';
                $this->user_model->save($activity);

                $type = 'success';
                $msg = lang('User has been successfully delete');
            } else {
                $type = 'error';
                $msg = lang('there_in_no_value');
            }
            echo json_encode(array("status" => $type, 'message' => $msg));
            exit();
        }


    }
}