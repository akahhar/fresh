<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Deals extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('deals_model');
        $this->load->model('tasks_model');
        $this->load->model('invoice_model');
    }
    
    public function index($id = null)
    {
        $data['title'] = lang('deals');
        $data['subview'] = $this->load->view('deals/all_deals', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }
    
    public function dealsList()
    {
        if ($this->input->is_ajax_request()) {
            $this->load->model('datatables');
            $this->datatables->table = 'tbl_deals';
            $this->datatables->join_table = array('tbl_customer_group', 'tbl_deals_source');
            $this->datatables->join_where = array('tbl_customer_group.customer_group_id=tbl_deals.stage_id', 'tbl_deals_source.source_id=tbl_deals.source_id');
            $action_array = array('tbl_deals.id');
            $main_column = array('title', 'pipeline', 'tbl_customer_group.customer_group', 'deal_value', 'tags');
            $result = array_merge($main_column, $action_array);
            $this->datatables->column_order = $result;
            $this->datatables->column_search = $result;
            
            $this->datatables->order = array('id' => 'desc');
            
            $fetch_data = make_datatables();
            $edited = can_action_by_label('deals', 'edited');
            $deleted = can_action_by_label('deals', 'deleted');
            $data = array();
            foreach ($fetch_data as $_key => $v_deals) {
                $action = null;
                $sub_array = array();
                $sub_array[] = '<a  ' . ' class="text-info" href="' . base_url() . 'admin/deals/details/' . $v_deals->id . '">' . $v_deals->title . '</a>';
                $sub_array[] = display_money($v_deals->deal_value, default_currency());
                $sub_array[] = get_tags($v_deals->tags, true);
                $sub_array[] = $v_deals->customer_group;
                $sub_array[] = display_date($v_deals->days_to_close);
                $sub_array[] = (!empty($v_deals->status) ? lang($v_deals->status) : '');
                $action .= btn_view('admin/deals/details/' . $v_deals->id) . ' ';
                if (!empty($edited)) {
                    $action .= btn_edit('admin/deals/new_deals/' . $v_deals->id) . ' ';
                }
                if (!empty($deleted)) {
                    $action .= ajax_anchor(base_url('admin/deals/delete_deals/' . $v_deals->id), "<i class='btn btn-xs btn-danger fa fa-trash-o'></i>", array("class" => "", "title" => lang('delete'), "data-fade-out-on-success" => "#table_" . $_key)) . ' ';
                }
                
                $sub_array[] = $action;
                $data[] = $sub_array;
            }
            
            render_table($data);
        } else {
            redirect('admin/dashboard');
        }
    }
    
    public function new_deals($id = NULL)
    {
        $data['title'] = lang('deals'); //Page title
        if (!empty($id)) {
            $edited = can_action_by_label('deals', 'edited');
            if (!empty($edited)) {
                $data['deals'] = $this->db->where('id', $id)->get('tbl_deals')->row();
            }
            if (empty($data['deals'])) {
                $type = "error";
                $message = lang("no_record_found");
                set_message($type, $message);
                redirect('admin/deals/new_deals');
            }
        }
        $data['subview'] = $this->load->view('deals/new_deals', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }
    
    
    public function getStateByID($id, $stage_id = null)
    {
        $all_stages = get_order_by('tbl_customer_group', array('type' => 'stages', 'description' => $id), 'order', true);
        $HTML = null;
        if (!empty($all_stages)) {
            $HTML .= '<label class="col-lg-3 control-label">' . lang('stages') . ' <span class="text-danger">*</span></label>';
            
            $HTML .= '<div class="col-sm-8"><select name="stage_id" class="form-control select_box" style="width: 100%" required >';
            foreach ($all_stages as $v_stages) {
                $HTML .= "<option value='" . $v_stages->customer_group_id . "'";
                if (!empty($stage_id) && $stage_id == $v_stages->customer_group_id || $v_stages->description == config_item('default_stage')) {
                    $HTML .= 'selected';
                };
                $HTML .= ">" . $v_stages->customer_group . "</option>";
            }
            $HTML .= '</select></div>';
        }
        echo json_encode($HTML);
        exit();
    }
    
    public function save_deals($id = NULL)
    {
        $created = can_action_by_label('deals', 'created');
        $edited = can_action_by_label('deals', 'edited');
        if (!empty($created) || !empty($edited) && !empty($id)) {
            $data = $this->deals_model->array_from_post(array(
                'title',
                'deal_value',
                'source_id',
                'days_to_close',
                'pipeline',
                'stage_id',
                'default_deal_owner',
                'tags',
            ));
            if (empty($id)) {
                $data['status'] = 'open';
            }
            $data['client_id'] = json_encode($this->input->post('client_id', true));
            $data['user_id'] = json_encode($this->input->post('user_id', true));
            
            $where = array('title' => $data['title']);
            // duplicate value check in DB
            if (!empty($id)) { // if id exist in db update data
                $user_id = array('id !=' => $id);
            } else { // if id is not exist then set id as null
                $user_id = null;
            }
            // check whether this input data already exist or not
            $check_users = $this->deals_model->check_update('tbl_deals', $where, $user_id);
            if (!empty($check_users)) { // if input data already exist show error alert
                // massage for user
                $type = 'error';
                $msg = lang('deals_already_exist');
            } else {
                
                $this->deals_model->_table_name = "tbl_deals"; // table name
                $this->deals_model->_primary_key = "id"; // $id
                $return_id = $this->deals_model->save($data, $id);
                
                if (!empty($notifyUser)) {
                    foreach ($notifyUser as $v_user) {
                        if (!empty($v_user)) {
                            if ($v_user != $this->session->userdata('user_id')) {
                                add_notification(array(
                                    'to_user_id' => $v_user,
                                    'description' => 'deals',
                                    'icon' => 'clock-o',
                                    'link' => 'admin/deals/details/' . $return_id,
                                    // 'value' => lang('by') . ' ' . $get_user->name,
                                ));
                            }
                        }
                    }
                }
                if (!empty($notifyUser)) {
                    show_notification($notifyUser);
                }
                
                if (!empty($id)) {
                    $activity = 'activity_update_deals';
                } else {
                    $activity = 'activity_added_deals';
                }
                // save into activities
                $activities = array(
                    'user' => $this->session->userdata('user_id'),
                    'module' => 'deals',
                    'module_field_id' => $return_id,
                    'activity' => $activity,
                    'icon' => 'fa-ticket',
                    'value1' => $data['title'],
                );
                // Update into tbl_project
                $this->deals_model->_table_name = "tbl_activities"; //table name
                $this->deals_model->_primary_key = "activities_id";
                $this->deals_model->save($activities);
                
                
                // messages for user
                $type = "success";
                $msg = lang('deals_information_saved');
            }
        }
        // $message = $msg;
        set_message($type, $msg);
        redirect('admin/deals');
    }
    
    public function send_promotions_email($data)
    {
        $all_clients = get_row('tbl_client', array('client_id' => $data['client_name']));
        $users_email = get_row('tbl_users', array('user_id' => $data['user_id']));
        $deals = get_row('tbl_deals', array('user_id' => $data['user_id']));
        $deals_email = config_item('deals_email');
        if (!empty($deals_email) && $deals_email == 1) {
            $email_template = email_templates(array('email_group' => 'deals_email'));
            $message = $email_template->template_body;
            $subject = $email_template->subject;
            $title = str_replace("{NAME}", $all_clients->name, $message);
            $designation = str_replace("{DEALS_TITLE}", $deals->title, $title);
            $message = str_replace("{SITE_NAME}", config_item('company_name'), $designation);
            $data['message'] = $message;
            $message = $this->load->view('email_template', $data, TRUE);
            $params['subject'] = $subject;
            $params['message'] = $message;
            $params['resourceed_file'] = '';
            $params['recipient'] = $users_email->email;
            $this->deals_model->send_email($params);
        }
        return true;
    }
    
    public function delete_deals($id = NULL)
    {
        $deleted = can_action_by_label('deals', 'deleted');
        if (!empty($deleted)) {
            $all_deals = $this->deals_model->check_by(array('id' => $id), 'tbl_deals');
            if (empty($all_deals)) {
                $type = "error";
                $message = lang("no_record_found");
                set_message($type, $message);
                redirect('admin/deals');
            }
            // save into activities
            $activities = array(
                'user' => $this->session->userdata('user_id'),
                'module' => 'deals',
                'module_field_id' => $id,
                'activity' => 'activity_delete_deals',
                'icon' => 'fa-ticket',
                'value1' => $all_deals->title,
            );
            
            // Update into tbl_project
            $this->deals_model->_table_name = "tbl_activities"; //table name
            $this->deals_model->_primary_key = "activities_id";
            $this->deals_model->save($activities);
            
            $this->deals_model->_table_name = "tbl_deals";
            $this->deals_model->_primary_key = "id";
            $this->deals_model->delete($id);;
            
            // messages for user
            $type = "success";
            $message = lang('deals_information_delete');
        }
        echo json_encode(array("status" => $type, 'message' => $message));
        exit();
    }
    
    
    public function new_stages($id = NULL, $opt = null)
    {
        $data['title'] = lang('new_stages');
        if (!empty($id)) {
            if ($id == 'stages') {
                $data['active'] = 3;
                $data['stages'] = $this->deals_model->check_by(array('customer_group_id' => $opt), 'tbl_customer_group');
            }
        }
        $data['subview'] = $this->load->view('deals/new_stages', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }
    
    public function save_sorting_stages()
    {
        $ids = $this->input->post('page_id_array', TRUE);
        $arr = explode(',', $ids);
        for ($i = 1; $i <= count($arr); $i++) {
            $this->deals_model->_table_name = 'tbl_customer_group';
            $this->deals_model->_primary_key = 'customer_group_id';
            $cate_data['order'] = $i;
            $this->deals_model->save($cate_data, $arr[$i - 1]);
        }
    }
    
    public function save_sorting_pipelines()
    {
        $ids = $this->input->post('page_id_array', TRUE);
        $arr = explode(',', $ids);
        for ($i = 1; $i <= count($arr); $i++) {
            $this->deals_model->_table_name = 'tbl_deals_pipelines';
            $this->deals_model->_primary_key = 'pipeline_id';
            $cate_data['order'] = $i;
            $this->deals_model->save($cate_data, $arr[$i - 1]);
        }
    }
    
    public function saved_stages($id = null)
    {
        $this->deals_model->_table_name = 'tbl_customer_group';
        $this->deals_model->_primary_key = 'customer_group_id';
        
        $cate_data['customer_group'] = $this->input->post('customer_group', TRUE);
        $cate_data['description'] = $this->input->post('description', TRUE);
        $cate_data['type'] = 'stages';
        
        $where = array('customer_group' => $cate_data['customer_group']);
        // duplicate value check in DB
        if (!empty($id)) { // if id exist in db update data
            $user_id = array('customer_group_id !=' => $id);
        } else { // if id is not exist then set id as null
            $user_id = null;
        }
        // check whether this input data already exist or not
        $check_users = $this->deals_model->check_update('tbl_customer_group', $where, $user_id);
        if (!empty($check_users)) { // if input data already exist show error alert
            // massage for user
            $type = 'error';
            $msg = lang('stages_already_exist');
        } else {
            $id = $this->deals_model->save($cate_data, $id);
            
            $activity = array(
                'user' => $this->session->userdata('user_id'),
                'module' => 'deals',
                'module_field_id' => $id,
                'activity' => ('stages_added'),
                // 'value1' => $cate_data['new_stages']
            );
            $this->deals_model->_table_name = 'tbl_activities';
            $this->deals_model->_primary_key = 'activities_id';
            $this->deals_model->save($activity);
            
            // messages for user
            $type = "success";
            $msg = lang('successfully_stages_added');
        }
        $message = $msg;
        set_message($type, $message);
        redirect('admin/deals/new_stages');
    }
    
    public function delete_stages($id)
    {
        $customer_group = $this->deals_model->check_by(array('customer_group_id' => $id), 'tbl_customer_group');
        $activity = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'settings',
            'module_field_id' => $id,
            'activity' => ('activity_delete_stages'),
            'value1' => $customer_group->customer_group,
        );
        $this->deals_model->_table_name = 'tbl_activities';
        $this->deals_model->_primary_key = 'activities_id';
        $this->deals_model->save($activity);
        
        $this->deals_model->_table_name = 'tbl_customer_group';
        $this->deals_model->_primary_key = 'customer_group_id';
        $this->deals_model->delete($id);
        // messages for user
        $type = "success";
        $message = lang('stages_successfully_deleted');
        echo json_encode(array("status" => $type, 'message' => $message));
        exit();
    }
    
    public function delete_pipeline($id)
    {
        $all_pipelines = $this->deals_model->check_by(array('pipeline_id' => $id), 'tbl_deals_pipelines');
        $activity = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'settings',
            'module_field_id' => $id,
            'activity' => ('activity_delete_pipelines'),
            'value1' => $all_pipelines->pipeline_name,
        );
        $this->deals_model->_table_name = 'tbl_activities';
        $this->deals_model->_primary_key = 'activities_id';
        $this->deals_model->save($activity);
        
        $this->deals_model->_table_name = 'tbl_deals_pipelines';
        $this->deals_model->_primary_key = 'pipeline_id';
        $this->deals_model->delete($id);
        // messages for user
        $type = "success";
        $message = lang('pipelines_successfully_deleted');
        echo json_encode(array("status" => $type, 'message' => $message));
        exit();
    }
    
    public function save_deals_notes($id)
    {
        
        $data = $this->deals_model->array_from_post(array('notes'));
        
        //save data into table.
        $this->deals_model->_table_name = 'tbl_deals';
        $this->deals_model->_primary_key = 'id';
        $id = $this->deals_model->save($data, $id);
        // save into activities
        $activities = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'deals',
            'module_field_id' => $id,
            'activity' => 'activity_update_notes',
            'icon' => 'fa-folder-open-o',
            'link' => 'admin/deals/details/' . $id . '/notes',
            'value1' => $data['notes'],
        );
        // Update into tbl_project
        $this->deals_model->_table_name = "tbl_activities"; //table name
        $this->deals_model->_primary_key = "activities_id";
        $this->deals_model->save($activities);
        
        $type = "success";
        $message = lang('update_deals_notes');
        set_message($type, $message);
        redirect('admin/deals/details/' . $id . '/' . 'notes');
    }
    
    public
    function saved_call($deals_id, $id = NULL)
    {
        $data = $this->deals_model->array_from_post(array('date', 'call_summary', 'client_id', 'user_id', 'call_type', 'duration'));
        $data['module'] = 'deals';
        $data['module_field_id'] = $deals_id;
        $this->deals_model->_table_name = 'tbl_calls';
        $this->deals_model->_primary_key = 'calls_id';
        $return_id = $this->deals_model->save($data, $id);
        if (!empty($id)) {
            $id = $id;
            $action = 'activity_update_deals_call';
            $msg = lang('update_deals_call');
        } else {
            $id = $return_id;
            $action = 'activity_save_deals_call';
            $msg = lang('save_deals_call');
        }
        $activity = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'deals',
            'module_field_id' => $deals_id,
            'activity' => $action,
            'icon' => 'fa-rocket',
            'link' => 'admin/deals/details/' . $deals_id . '/call',
            'value1' => $data['call_summary']
        );
        $this->deals_model->_table_name = 'tbl_activities';
        $this->deals_model->_primary_key = 'activities_id';
        $this->deals_model->save($activity);
        
        $deals_info = $this->deals_model->check_by(array('id' => $deals_id), 'tbl_deals');
        $notifiedUsers = array();
        if (!empty($deals_info->permission) && $deals_info->permission != 'all') {
            $permissionUsers = json_decode($deals_info->permission);
            foreach ($permissionUsers as $user => $v_permission) {
                array_push($notifiedUsers, $user);
            }
        } else {
            $notifiedUsers = $this->deals_model->allowed_user_id('55');
        }
        if (!empty($notifiedUsers)) {
            foreach ($notifiedUsers as $users) {
                if ($users != $this->session->userdata('user_id')) {
                    add_notification(array(
                        'to_user_id' => $users,
                        'from_user_id' => true,
                        'description' => 'not_add_call',
                        'link' => 'admin/deals/details/' . $deals_info->id . '/call',
                        'value' => lang('lead') . ' ' . $deals_info->title,
                    ));
                }
            }
            show_notification($notifiedUsers);
        }
        // messages for user
        $type = "success";
        $message = $msg;
        set_message($type, $message);
        redirect('admin/deals/details/' . $deals_id . '/' . 'call');
    }
    
    public
    function delete_deals_call($deals_id, $id)
    {
        $calls_info = $this->deals_model->check_by(array('calls_id' => $id), 'tbl_calls');
        $activity = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'deals',
            'module_field_id' => $deals_id,
            'activity' => 'activity_deals_call_deleted',
            'icon' => 'fa-rocket',
            'link' => 'admin/deals/details/' . $deals_id . '/call',
            'value1' => $calls_info->call_summary
        );
        $this->deals_model->_table_name = 'tbl_activities';
        $this->deals_model->_primary_key = 'activities_id';
        $this->deals_model->save($activity);
        
        $this->deals_model->_table_name = 'tbl_calls';
        $this->deals_model->_primary_key = 'calls_id';
        $this->deals_model->delete($id);
        $type = 'success';
        $message = lang('deals_call_deleted');
        // messages for user
        echo json_encode(array("status" => $type, 'message' => $message));
        exit();
    }
    
    public function meeting_details($mettings_id = null)
    {
        $data['title'] = lang('meeting_details');
        $data['details'] = get_row('tbl_mettings', array('mettings_id' => $mettings_id));
        $data['subview'] = $this->load->view('deals/meeting_details', $data, FALSE);
        $this->load->view('admin/_layout_modal', $data);
    }
    
    public function saved_metting($id = NULL)
    {
        $this->deals_model->_table_name = 'tbl_mettings';
        $this->deals_model->_primary_key = 'mettings_id';
        $deals_id = $this->input->post('deals_id', true);
        $data = $this->deals_model->array_from_post(array('meeting_subject', 'user_id', 'location', 'description'));
        $data['module'] = 'deals';
        $data['module_field_id'] = $deals_id;
        $data['start_date'] = strtotime($this->input->post('start_date', true) . ' ' . display_time($this->input->post('start_time', true)));
        $data['end_date'] = strtotime($this->input->post('end_date', true) . ' ' . display_time($this->input->post('end_time', true)));
        $user_id = serialize($this->deals_model->array_from_post(array('attendees')));
        if (!empty($user_id)) {
            $data['attendees'] = $user_id;
        } else {
            $data['attendees'] = '-';
        }
        
        $where = array('meeting_subject' => $data['meeting_subject']);
        // duplicate value check in DB
        if (!empty($id)) { // if id exist in db update data
            $user_id = array('mettings_id !=' => $id);
        } else { // if id is not exist then set id as null
            $user_id = null;
        }
        // check whether this input data already exist or not
        $check_users = $this->deals_model->check_update('tbl_mettings', $where, $user_id);
        if (!empty($check_users)) { // if input data already exist show error alert
            // massage for user
            $type = 'error';
            $msg = lang('meeting_already_exist');
        } else {
            $return_id = $this->deals_model->save($data, $id);
            
            if (!empty($id)) {
                $id = $id;
                $action = 'activity_update_deals_metting';
                $msg = lang('update_deals_metting');
            } else {
                // $id = $return_id;
                $action = 'activity_save_deals_metting';
                $msg = lang('save_deals_metting');
            }
            $activity = array(
                'user' => $this->session->userdata('user_id'),
                'module' => 'deals',
                'module_field_id' => $data['deals_id'],
                'activity' => $action,
                'icon' => 'fa-filter',
                'link' => 'admin/deals/details/' . $data['deals_id'] . '/mettings',
                'value1' => $data['meeting_subject']
            );
            
            $this->deals_model->_table_name = 'tbl_activities';
            $this->deals_model->_primary_key = 'activities_id';
            $this->deals_model->save($activity);
            
            $deals_info = $this->deals_model->check_by(array('id' => $data['deals_id']), 'tbl_deals');
            $notifiedUsers = array();
            if (!empty($deals_info->permission) && $deals_info->permission != 'all') {
                $permissionUsers = json_decode($deals_info->permission);
                foreach ($permissionUsers as $user => $v_permission) {
                    array_push($notifiedUsers, $user);
                }
            } else {
                $notifiedUsers = $this->deals_model->allowed_user_id('56');
            }
            if (!empty($notifiedUsers)) {
                foreach ($notifiedUsers as $users) {
                    if ($users != $this->session->userdata('user_id')) {
                        add_notification(array(
                            'to_user_id' => $users,
                            'from_user_id' => true,
                            'description' => 'not_add_meetings',
                            'link' => 'admin/deals/details/' . $data['deals_id'] . '/mettings',
                        ));
                    }
                }
                show_notification($notifiedUsers);
            }
            $type = "success";
        }
        // messages for user
        set_message($type, $msg);
        redirect('admin/deals/details/' . $deals_id . '/mettings');
    }
    
    public function delete_deals_mettings($deals_id, $id)
    {
        $mettings_info = $this->deals_model->check_by(array('mettings_id' => $id), 'tbl_mettings');
        
        $activity = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'opportunities',
            'module_field_id' => $deals_id,
            'activity' => 'activity_meeting_deleted',
            'icon' => 'fa-filter',
            'link' => 'admin/deals/details/' . $deals_id . '/mettings',
            'value1' => $mettings_info->meeting_subject
        );
        $this->deals_model->_table_name = 'tbl_activities';
        $this->deals_model->_primary_key = 'activities_id';
        $this->deals_model->save($activity);
        
        $this->deals_model->_table_name = 'tbl_mettings';
        $this->deals_model->_primary_key = 'mettings_id';
        $this->deals_model->delete($id);
        echo json_encode(array("status" => 'success', 'message' => lang('mettings_deleted')));
        exit();
    }
    
    public function save_task($id = null)
    {
        $created = can_action_by_label('54', 'created');
        $edited = can_action_by_label('54', 'edited');
        if (!empty($created) || !empty($edited) && !empty($id)) {
            $data = $this->tasks_model->array_from_post(array(
                'module',
                'module_field_id',
                'task_name',
                'category_id',
                'task_description',
                'task_start_date',
                'due_date',
                'module_field_id',
                'task_progress',
                'calculate_progress',
                'client_visible',
                'task_status',
                'hourly_rate',
                'tags',
                'billable'
            ));
            $estimate_hours = $this->input->post('task_hour', true);
            $check_flot = explode('.', $estimate_hours);
            if (!empty($check_flot[0])) {
                if (!empty($check_flot[1])) {
                    $data['task_hour'] = $check_flot[0] . ':' . $check_flot[1];
                } else {
                    $data['task_hour'] = $check_flot[0] . ':00';
                }
            } else {
                $data['task_hour'] = '0:00';
            }
            
            
            if ($data['task_status'] == 'completed') {
                $data['task_progress'] = 100;
            }
            if ($data['task_progress'] == 100) {
                $data['task_status'] = 'completed';
            }
            if (empty($id)) {
                $data['created_by'] = $this->session->userdata('user_id');
            }
            if (empty($data['billable'])) {
                $data['billable'] = 'No';
            }
            if (empty($data['hourly_rate'])) {
                $data['hourly_rate'] = '0';
            }
            $result = 0;
            
            $data['project_id'] = null;
            $data['milestones_id'] = null;
            $data['goal_tracking_id'] = null;
            $data['bug_id'] = null;
            $data['leads_id'] = null;
            $data['sub_task_id'] = null;
            $data['transactions_id'] = null;
            
            
            $permission = $this->input->post('permission', true);
            if (!empty($permission)) {
                if ($permission == 'everyone') {
                    $assigned = 'all';
                    $assigned_to['assigned_to'] = $this->tasks_model->allowed_user_id('54');
                } else {
                    $assigned_to = $this->tasks_model->array_from_post(array('assigned_to'));
                    if (!empty($assigned_to['assigned_to'])) {
                        foreach ($assigned_to['assigned_to'] as $assign_user) {
                            $assigned[$assign_user] = $this->input->post('action_' . $assign_user, true);
                        }
                    }
                }
                if (!empty($assigned)) {
                    if ($assigned != 'all') {
                        $assigned = json_encode($assigned);
                    }
                } else {
                    $assigned = 'all';
                }
                $data['permission'] = $assigned;
            } else {
                set_message('error', lang('assigned_to') . ' Field is required');
                if (empty($_SERVER['HTTP_REFERER'])) {
                    redirect('admin/tasks/all_task');
                } else {
                    redirect($_SERVER['HTTP_REFERER']);
                }
            }
            
            //save data into table.
            $this->tasks_model->_table_name = "tbl_task"; // table name
            $this->tasks_model->_primary_key = "task_id"; // $id
            $id = $this->tasks_model->save($data, $id);
            
            $this->tasks_model->set_task_progress($id);
            
            $u_data['index_no'] = $id;
            $id = $this->tasks_model->save($u_data, $id);
            $u_data['index_no'] = $id;
            $id = $this->tasks_model->save($u_data, $id);
            save_custom_field(3, $id);
            
            if ($assigned == 'all') {
                $assigned_to['assigned_to'] = $this->tasks_model->allowed_user_id('54');
            }
            
            if (!empty($id)) {
                $msg = lang('update_task');
                $activity = 'activity_update_task';
                $id = $id;
                if (!empty($assigned_to['assigned_to'])) {
                    // send update
                    $this->notify_assigned_tasks($assigned_to['assigned_to'], $id, true);
                }
            } else {
                $msg = lang('save_task');
                $activity = 'activity_new_task';
                if (!empty($assigned_to['assigned_to'])) {
                    $this->notify_assigned_tasks($assigned_to['assigned_to'], $id);
                }
            }
            
            $url = 'admin/' . $data['module'] . '/tasks/' . $id;
            // save into activities
            $activities = array(
                'user' => $this->session->userdata('user_id'),
                'module' => $data['module'],
                'module_field_id' => $data['module_field_id'],
                'activity' => $activity,
                'icon' => 'fa-tasks',
                'link' => $url,
                'value1' => $data['task_name'],
            );
            // Update into tbl_project
            $this->tasks_model->_table_name = "tbl_activities"; //table name
            $this->tasks_model->_primary_key = "activities_id";
            $this->tasks_model->save($activities);
            
            if (!empty($data['project_id'])) {
                $this->tasks_model->set_progress($data['project_id']);
            }
            
            $type = "success";
            $message = $msg;
            set_message($type, $message);
            redirect('admin/tasks/details/' . $id);
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    
    public function notify_assigned_tasks($users, $task_id, $update = null)
    {
        if (!empty($update)) {
            $email_template = email_templates(array('email_group' => 'tasks_updated'));
            $description = 'not_task_update';
        } else {
            $email_template = email_templates(array('email_group' => 'task_assigned'));
            $description = 'assign_to_you_the_tasks';;
        }
        $tasks_info = $this->tasks_model->check_by(array('task_id' => $task_id), 'tbl_task');
        $message = $email_template->template_body;
        
        $subject = $email_template->subject;
        
        $task_name = str_replace("{TASK_NAME}", $tasks_info->task_name, $message);
        
        $assigned_by = str_replace("{ASSIGNED_BY}", ucfirst($this->session->userdata('name')), $task_name);
        $Link = str_replace("{TASK_URL}", base_url() . 'admin/tasks/details/' . $tasks_info->task_id, $assigned_by);
        $message = str_replace("{SITE_NAME}", config_item('company_name'), $Link);
        
        $data['message'] = $message;
        $message = $this->load->view('email_template', $data, true);
        
        $params['subject'] = $subject;
        $params['message'] = $message;
        $params['resourceed_file'] = '';
        
        foreach ($users as $v_user) {
            $login_info = $this->tasks_model->check_by(array('user_id' => $v_user), 'tbl_users');
            $params['recipient'] = $login_info->email;
            $this->tasks_model->send_email($params);
            if ($v_user != $this->session->userdata('user_id')) {
                add_notification(array(
                    'to_user_id' => $v_user,
                    'from_user_id' => true,
                    'description' => $description,
                    'link' => 'admin/tasks/details/' . $task_id,
                    'value' => lang('task') . ' ' . $tasks_info->task_name,
                ));
            }
        }
        show_notification($users);
    }
    
    public function new_category()
    {
        $data['title'] = lang('new') . ' ' . lang('categories');
        $data['type'] = 'deals';
        $data['subview'] = $this->load->view('deals/new_category', $data, FALSE);
        $this->load->view('admin/_layout_modal', $data);
    }
    
    public function update_category($id = null)
    {
        $this->deals_model->_table_name = 'tbl_customer_group';
        $this->deals_model->_primary_key = 'customer_group_id';
        
        $cate_data['customer_group'] = $this->input->post('category_name', TRUE);
        $cate_data['description'] = $this->input->post('description', TRUE);
        $type = $this->input->post('type', TRUE);
        if (!empty($type)) {
            $cate_data['type'] = $type;
        } else {
            $cate_data['type'] = 'client';
        }
        // update root category
        $where = array('type' => $cate_data['type'], 'customer_group' => $cate_data['customer_group']);
        // duplicate value check in DB
        if (!empty($id)) { // if id exist in db update data
            $customer_group_id = array('customer_group_id !=' => $id);
        } else { // if id is not exist then set id as null
            $customer_group_id = null;
        }
        // check whether this input data already exist or not
        $check_category = $this->deals_model->check_update('tbl_customer_group', $where, $customer_group_id);
        if (!empty($check_category)) { // if input data already exist show error alert
            // massage for user
            $type = 'error';
            $msg = "<strong style='color:#000'>" . $cate_data['customer_group'] . '</strong>  ' . lang('already_exist');
        } else { // save and update query
            $id = $this->deals_model->save($cate_data, $id);
            
            $activity = array(
                'user' => $this->session->userdata('user_id'),
                'module' => 'settings',
                'module_field_id' => $id,
                'activity' => ('customer_group_added'),
                'value1' => $cate_data['customer_group']
            );
            $this->deals_model->_table_name = 'tbl_activities';
            $this->deals_model->_primary_key = 'activities_id';
            $this->deals_model->save($activity);
            
            // messages for user
            $type = "success";
            $msg = lang('category_added');
        }
        if (!empty($id)) {
            $result = array(
                'id' => $id,
                'group' => $cate_data['customer_group'],
                'status' => $type,
                'message' => $msg,
            );
        } else {
            $result = array(
                'status' => $type,
                'message' => $msg,
            );
        }
        echo json_encode($result);
        exit();
    }
    
    public
    function details($id, $active = NULL, $edit = NULL)
    {
        $data['title'] = lang('deals_details'); //Page title
        $data['deals_details'] = join_data('tbl_deals', 'tbl_deals.*, tbl_deals_source.source_name,tbl_deals_pipelines.pipeline_name,tbl_customer_group.customer_group', array('id' => $id), array('tbl_customer_group' => 'tbl_customer_group.customer_group_id = tbl_deals.stage_id', 'tbl_deals_pipelines' => 'tbl_deals.pipeline = tbl_deals_pipelines.pipeline_id', 'tbl_currencies' => 'tbl_deals.currency = tbl_currencies.code', 'tbl_deals_source' => 'tbl_deals.source_id = tbl_deals_source.source_id'));
        $data['dropzone'] = true;
        //get all task information
        if (empty($active)) {
            $data['active'] = 'details';
        } else {
            $data['active'] = $active;
        }
        $data['all_tabs'] = deals_details_tabs($id);
        $data['module'] = 'deals';
        $data['id'] = $id;
        $data['global'] = $this->load->view('deals/deals_details/global', $data, TRUE);
        $data['subview'] = $this->load->view('admin/common/tab_view', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }
    
    
    public function changeStatus($id, $status)
    {
        if (!empty($_POST) || $status === 'open') {
            $pdata['status'] = $status;
            if ($status == 'won') {
                $pdata['convert_to_project'] = $this->input->post('convert_to_project', true);
                $create_invoice = $this->input->post('create_invoice', true);
                if ($create_invoice == true) {
                    $this->createInvoice($id);
                }
                // create project if convert_to_project == true
                if ($pdata['convert_to_project'] == true) {
                    $this->createProjects($id);
                }
                
                
            } else if ($status == 'lost') {
                $pdata['lost_reason'] = $this->input->post('lost_reason');
            }
            $this->deals_model->_table_name = 'tbl_deals';
            $this->deals_model->_primary_key = 'id';
            $this->deals_model->save($pdata, $id);
            $activity = array(
                'user' => $this->session->userdata('user_id'),
                'module' => 'deals',
                'module_field_id' => $id,
                'activity' => ('activity_deals_status'),
                'value1' => $status
            );
            $this->deals_model->_table_name = 'tbl_activities';
            $this->deals_model->_primary_key = 'activities_id';
            $this->deals_model->save($activity);
            $type = "success";
            $message = lang('deals_status_change');
            set_message($type, $message);
            redirect('admin/deals/details/' . $id);
        } else {
            $data['title'] = 'Change Status';
            $data['id'] = $id;
            $data['status'] = $status;
            $data['deals_details'] = $this->deals_model->check_by(array('id' => $id), 'tbl_deals');
            $data['modal_subview'] = $this->load->view('deals/deals_details/_modal_change_status', $data, FALSE);
            $this->load->view('admin/_layout_modal', $data);
        }
    }
    
    public function createInvoice($deal_id)
    {
        $deal_info = $this->deals_model->check_by(array('id' => $deal_id), 'tbl_deals');
        if (config_item('increment_invoice_number') == 'FALSE') {
            $this->load->helper('string');
            $reference_no = config_item('invoice_prefix') . ' ' . random_string('nozero', 6);
        } else {
            $reference_no = $this->items_model->generate_invoice_number();
        }
        
        $permission = array();
        $all_user = json_decode($deal_info->user_id, true);
        if (!empty($all_user)) {
            foreach ($all_user as $user) {
                $permission[$user] = array('view', 'edit', 'delete');
            }
        }
        $permission = json_encode($permission);
        $all_client = json_decode($deal_info->client_id, true);
        $sales_info = get_result('tbl_deals_items', array('deals_id' => $deal_id));
        $all_tax_info = array();
        foreach ($sales_info as $item) {
            $tax_info = json_decode($item->item_tax_name);
            $tax_total_cost = 0;
            if (!empty($tax_info)) {
                foreach ($tax_info as $key => $v_tax_name) {
                    $i_tax_name = explode('|', $v_tax_name);
                    $taxName = $i_tax_name[0] . '|' . $i_tax_name[1];
                    $taxPercentage = $i_tax_name[1];
                    $tax_total_cost = $item->total_cost / 100 * $taxPercentage;
                    $all_tax_info[$taxName][] = $tax_total_cost;
                }
            }
        }
        // {"tax_name":["GST-1|10.00","GST-4|7.00","GST-3|5.00"],"total_tax":["54.00","37.80","27.00"]}
        $tax_name = array();
        $total_tax = array();
        foreach ($all_tax_info as $key => $v_tax_info) {
            $tax_name[] = $key;
            $total_tax[] = array_sum($v_tax_info);
        }
        $total_tax_amount = array_sum($total_tax);
        $total_taxes = array(
            'tax_name' => ($tax_name),
            'total_tax' => ($total_tax)
        );
        
        
        if (!empty($all_client)) {
            foreach ($all_client as $client) {
                $new_invoice = array(
                    'reference_no' => $reference_no,
                    'recur_start_date' => '',
                    'recur_end_date' => '',
                    'client_id' => $client,
                    'warehouse_id' => 0,
                    'invoice_date' => date('Y-m-d'),
                    'invoice_year' => date('Y'),
                    'invoice_month' => date('Y-m'),
                    'due_date' => $deal_info->days_to_close,
                    'notes' => $deal_info->notes,
                    'tax' => $total_tax_amount,
                    'total_tax' => json_encode($total_taxes),
                    'discount_type' => '',
                    'discount_percent' => '',
                    'user_id' => $deal_info->default_deal_owner,
                    'adjustment' => 0,
                    'discount_total' => 0,
                    'show_quantity_as' => 'qty',
                    'recurring' => 'No',
                    'currency' => default_currency(),
                    'status' => 'draft',
                    'permission' => $permission,
                );
                $all_payment = get_result('tbl_online_payment');
                foreach ($all_payment as $payment) {
                    $allow_gateway = 'allow_' . slug_it(strtolower($payment->gateway_name));
                    $gateway_status = slug_it(strtolower($payment->gateway_name)) . '_status';
                    if (config_item($gateway_status) == 'active') {
                        $new_invoice[$allow_gateway] = 'Yes';
                    }
                }
                
                
                $this->invoice_model->_table_name = "tbl_invoices"; //table name
                $this->invoice_model->_primary_key = "invoices_id";
                $new_invoice_id = $this->invoice_model->save($new_invoice);
                $sub_total = 0;
                $total = 0;
                if ($sales_info) {
                    foreach ($sales_info as $key => $v_item) {
                        $item_tax_name = json_decode($v_item->item_tax_name);
                        $sub_total += $v_item->total_cost;
                        $items = array(
                            'invoices_id' => $new_invoice_id,
                            'saved_items_id' => $v_item->saved_items_id,
                            'item_name' => $v_item->item_name,
                            'item_desc' => $v_item->item_desc,
                            'unit_cost' => $v_item->unit_cost,
                            'quantity' => $v_item->quantity,
                            'total_cost' => $v_item->total_cost,
                            'item_tax_rate' => $v_item->item_tax_rate,
                            'item_tax_total' => $v_item->item_tax_total,
                            'item_tax_name' => $v_item->item_tax_name,
                            'unit' => $v_item->unit,
                            'order' => $v_item->order,
                            'date_saved' => date('Y-m-d')
                        );
                        
                        $this->invoice_model->_table_name = "tbl_items"; //table name
                        $this->invoice_model->_primary_key = "items_id";
                        $this->invoice_model->save($items);
                    }
                }
            }
        }
    }
    
    public function createProjects($deal_id)
    {
        $deal_info = $this->deals_model->check_by(array('id' => $deal_id), 'tbl_deals');
        
        $projects = '';
        if (empty(config_item('projects_number_format'))) {
            $projects .= config_item('projects_prefix');
        }
        $projects .= $this->items_model->generate_projects_number();
        
        $propability = 0;
        
        $all_stages = get_order_by('tbl_customer_group', array('type' => 'stages', 'description' => $deal_info->pipeline), 'order', true);
// total stages
        if (!empty($all_stages)) {
            $total_stages = count($all_stages);
            foreach ($all_stages as $stage) {
                $res = round(100 / $total_stages);
                $propability += $res;
                if ($stage->customer_group_id == $deal_info->stage_id) {
                    break;
                }
            }
        }
        if ($deal_info->status === 'won') {
            $propability = 100;
        }
        if ($deal_info->status === 'lost') {
            $propability = 0;
        }
        
        $permission = array();
        $all_user = json_decode($deal_info->user_id, true);
        if (!empty($all_user)) {
            foreach ($all_user as $user) {
                $permission[$user] = array('view', 'edit', 'delete');
            }
        }
        $permission = json_encode($permission);
        $all_client = json_decode($deal_info->client_id, true);
        
        if (!empty($all_client)) {
            foreach ($all_client as $client) {
                $new_project = array(
                    'project_no' => $projects,
                    'project_name' => $deal_info->title,
                    'client_id' => $client,
                    'progress' => $propability,
                    'calculate_progress' => '',
                    'start_date' => date('Y-m-d'),
                    'end_date' => $deal_info->days_to_close,
                    'billing_type' => 'fixed_rate',
                    'project_cost' => $deal_info->deal_value,
                    'hourly_rate' => 0,
                    'project_status' => 'started',
                    'estimate_hours' => 0,
                    'description' => $deal_info->notes,
                    'permission' => $permission,
                );
                $this->deals_model->_table_name = "tbl_project"; //table name
                $this->deals_model->_primary_key = "project_id";
                $new_project_id = $this->deals_model->save($new_project);
                
                $tasks = $this->input->post('tasks', true);
                if (!empty($tasks)) {
                    //get tasks info by id
                    foreach ($tasks as $task_id) {
                        $task_info = get_row('tbl_task', array('task_id' => $task_id));
                        $task = array(
                            'task_name' => $task_info->task_name,
                            'project_id' => $new_project_id,
                            'milestones_id' => $task_info->milestones_id,
                            'permission' => $task_info->permission,
                            'task_description' => $task_info->task_description,
                            'task_start_date' => $task_info->task_start_date,
                            'due_date' => $task_info->due_date,
                            'task_created_date' => $task_info->task_created_date,
                            'task_status' => $task_info->task_status,
                            'task_progress' => $task_info->task_progress,
                            'task_hour' => $task_info->task_hour,
                            'tasks_notes' => $task_info->tasks_notes,
                            'timer_status' => $task_info->timer_status,
                            'client_visible' => $task_info->client_visible,
                            'timer_started_by' => $task_info->timer_started_by,
                            'start_time' => $task_info->start_time,
                            'logged_time' => $task_info->logged_time,
                            'created_by' => $task_info->created_by
                        );
                        $this->deals_model->_table_name = "tbl_task"; //table name
                        $this->deals_model->_primary_key = "task_id";
                        $this->deals_model->save($task);
                    }
                }
                
                $projects_email = config_item('projects_email');
                if (!empty($projects_email) && $projects_email == 1) {
                    $this->send_project_notify_client($new_project_id);
                    if (!empty($all_user)) {
                        $this->send_project_notify_assign_user($new_project_id, $all_user);
                    }
                    
                }
                
            }
        }
    }
    
    public function send_project_notify_assign_user($project_id, $users)
    {
        
        $project_info = $this->items_model->check_by(array('project_id' => $project_id), 'tbl_project');
        $email_template = email_templates(array('email_group' => 'assigned_project'), $project_info->client_id);
        $message = $email_template->template_body;
        
        $subject = $email_template->subject;
        
        $project_name = str_replace("{PROJECT_NAME}", $project_info->project_name, $message);
        
        $assigned_by = str_replace("{ASSIGNED_BY}", ucfirst($this->session->userdata('name')), $project_name);
        $Link = str_replace("{PROJECT_URL}", base_url() . 'admin/projects/project_details/' . $project_id, $assigned_by);
        $message = str_replace("{SITE_NAME}", config_item('company_name'), $Link);
        
        $data['message'] = $message;
        $message = $this->load->view('email_template', $data, TRUE);
        
        $params['subject'] = $subject;
        $params['message'] = $message;
        $params['resourceed_file'] = '';
        if (!empty($users)) {
            foreach ($users as $v_user) {
                $login_info = $this->items_model->check_by(array('user_id' => $v_user), 'tbl_users');
                $params['recipient'] = $login_info->email;
                $this->items_model->send_email($params);
                
                if ($v_user != $this->session->userdata('user_id')) {
                    add_notification(array(
                        'to_user_id' => $v_user,
                        'from_user_id' => true,
                        'description' => 'assign_to_you_the_project',
                        'link' => 'admin/projects/project_details/' . $project_id,
                        'value' => $project_info->project_name,
                    ));
                }
            }
            show_notification($users);
        }
    }
    
    public function send_project_notify_client($project_id, $complete = NULL)
    {
        $project_info = $this->items_model->check_by(array('project_id' => $project_id), 'tbl_project');
        if (!empty($complete)) {
            $email_template = email_templates(array('email_group' => 'complete_projects'), $project_info->client_id);
            $description = 'not_completed';
        } else {
            $email_template = email_templates(array('email_group' => 'client_notification'), $project_info->client_id);
            $description = 'not_new_project_created';
        }
        $client_info = $this->items_model->check_by(array('client_id' => $project_info->client_id), 'tbl_client');
        $message = $email_template->template_body;
        $subject = $email_template->subject;
        
        $clientName = str_replace("{CLIENT_NAME}", $client_info->name, $message);
        $project_name = str_replace("{PROJECT_NAME}", $project_info->project_name, $clientName);
        
        $Link = str_replace("{PROJECT_LINK}", base_url() . 'admin/projects/project_details/' . $project_id, $project_name);
        $message = str_replace("{SITE_NAME}", config_item('company_name'), $Link);
        
        $data['message'] = $message;
        $message = $this->load->view('email_template', $data, TRUE);
        
        $params['subject'] = $subject;
        $params['message'] = $message;
        $params['resourceed_file'] = '';
        
        $params['recipient'] = $client_info->email;
        $this->items_model->send_email($params);
        
        if (!empty($client_info->primary_contact)) {
            $notifyUser = array($client_info->primary_contact);
        } else {
            $user_info = $this->items_model->check_by(array('company' => $project_info->client_id), 'tbl_account_details');
            if (!empty($user_info)) {
                $notifyUser = array($user_info->user_id);
            }
        }
        if (!empty($notifyUser)) {
            foreach ($notifyUser as $v_user) {
                if ($v_user != $this->session->userdata('user_id')) {
                    add_notification(array(
                        'to_user_id' => $v_user,
                        'from_user_id' => true,
                        'description' => $description,
                        'link' => 'client/projects/project_details/' . $project_id,
                        'value' => $project_info->project_name,
                    ));
                }
            }
            show_notification($notifyUser);
        }
    }
    
    public
    function changeStage($deals_id, $stage_id)
    {
        $data['stage_id'] = $stage_id;
        $this->deals_model->_table_name = 'tbl_deals';
        $this->deals_model->_primary_key = 'id';
        $this->deals_model->save($data, $deals_id);
        $deals_info = join_data('tbl_deals', 'tbl_deals.*, tbl_deals_source.source_name,tbl_deals_pipelines.pipeline_name,tbl_customer_group.customer_group', array('id' => $deals_id), array('tbl_customer_group' => 'tbl_customer_group.customer_group_id = tbl_deals.stage_id', 'tbl_deals_pipelines' => 'tbl_deals.pipeline = tbl_deals_pipelines.pipeline_id', 'tbl_currencies' => 'tbl_deals.currency = tbl_currencies.code', 'tbl_deals_source' => 'tbl_deals.source_id = tbl_deals_source.source_id'));
        $activity = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'deals',
            'module_field_id' => $deals_id,
            'activity' => ('activity_update_deals'),
            'value1' => $deals_info->title,
            'value2' => $deals_info->pipeline_name . ' - ' . $deals_info->customer_group,
        );
        $this->deals_model->_table_name = 'tbl_activities';
        $this->deals_model->_primary_key = 'activities_id';
        $this->deals_model->save($activity);
        $type = "success";
        $message = lang('deals_updated');
        set_message($type, $message);
        redirect('admin/deals/details/' . $deals_id);
        
    }
    
    public
    function itemsSuggestions($id = null)
    {
        $term = $this->input->get('term', TRUE);
        $rows = $this->deals_model->getItemsInfo($term);
        if (!empty($rows)) {
            foreach ($rows as $row) {
                $row->qty = 1;
                $row->rate = $row->unit_cost;
                $row->unit = $row->unit_type;
                $row->new_itmes_id = $row->saved_items_id;
                $tax_info = json_decode($row->tax_rates_id);
                if (!empty($tax_info)) {
                    foreach ($tax_info as $tax_id) {
                        $tax = $this->db->where('tax_rates_id', $tax_id)->get('tbl_tax_rates')->row();
                        if (!empty($tax->tax_rate_name)) {
                            $tax_name[] = $tax->tax_rate_name . '|' . $tax->tax_rate_percent;
                        }
                    }
                    $tax = (object)[
                        'taxname' => (!empty($tax_name) ? ($tax_name) : null),
                    ];
                }
                if (empty($tax)) {
                    $tax = (object)[
                        'taxname' => '',
                    ];
                }
                $result = (object)array_merge((array)$row, (array)$tax);
                $pr[] = array('saved_items_id' => $row->saved_items_id, 'label' => $row->item_name . " (" . $row->code . ")", 'row' => $result);
            }
            echo json_encode($pr);
            die();
        } else {
            echo json_encode(array(array('saved_items_id' => 0, 'label' => lang('no_match_found'), 'value' => $term)));
            die();
        }
    }
    
    public
    function manuallyItems($deals_id, $items_id = null)
    {
        $data['deals_id'] = $deals_id;
        if (!empty($items_id)) {
            $data['items_info'] = get_row('tbl_deals_items', array('items_id' => $items_id));
        }
        $data['modal_subview'] = $this->load->view('deals/deals_manually_items', $data, FALSE);
        $this->load->view('admin/_layout_modal', $data);
    }
    
    public
    function delete_items($id, $deals_id)
    {
        $all_items = $this->deals_model->check_by(array('items_id' => $id), 'tbl_deals_items');
        if (empty($all_items)) {
            $data['type'] = 'error';
            $data['msg'] = lang('no_record_found');
        } else {
            // save into activities
            $activities = array(
                'user' => $this->session->userdata('user_id'),
                'module' => 'deals',
                'module_field_id' => $id,
                'activity' => 'activity_delete_deals_items',
                'icon' => 'fa-ticket',
                'value1' => $all_items->item_name,
            );
            
            // Update into tbl_project
            $this->deals_model->_table_name = "tbl_activities"; //table name
            $this->deals_model->_primary_key = "activities_id";
            $this->deals_model->save($activities);
            
            $this->deals_model->_table_name = "tbl_deals_items";
            $this->deals_model->_primary_key = "items_id";
            $this->deals_model->delete($id);
            
            $_data['id'] = $deals_id;
            $data['subview'] = $this->load->view('deals/deals_details/dealItems', $_data, true);
            $data['type'] = 'success';
            $data['msg'] = lang('deals_items_delete');
        }
        // check its ajax request
        if ($this->input->is_ajax_request()) {
            echo json_encode($data);
            exit();
        } else {
            // set message
            set_message($data['type'], $data['msg']);
            redirect('admin/deals/details/' . $deals_id . '/products');
        }
//        echo json_encode($data);
//        exit();
    }
    
    public
    function itemAddedManualy()
    {
        $items_info = (object)$this->input->post();
        $deals_id = $this->input->post('deals_id', true);
        $items_id = $this->input->post('items_id', true);
        if (!empty($items_info)) {
            $saved_items_id = 0;
            $items_info->saved_items_id = $saved_items_id;
            $items_info->code = '';
            $items_info->new_item_id = $saved_items_id;
            $tax_info = $items_info->tax_rates_id;
            $total_cost = $items_info->unit_cost * $items_info->quantity;
            $tax_name = array();
            if (!empty($tax_info)) {
                foreach ($tax_info as $v_tax) {
                    $all_tax = $this->db->where('tax_rates_id', $v_tax)->get('tbl_tax_rates')->row();
                    $tax_name[] = $all_tax->tax_rate_name . '|' . $all_tax->tax_rate_percent;
                    $item_tax_total[] = ($total_cost / 100 * $all_tax->tax_rate_percent);
                }
            }
            $item_tax_total = (!empty($item_tax_total) ? array_sum($item_tax_total) : 0);
            // $data['quantity'] = 1;
            $data['tax_rates_id'] = json_encode($items_info->tax_rates_id);
            $data['quantity'] = $items_info->quantity;
            $data['deals_id'] = $deals_id;
            $data['item_name'] = $items_info->item_name;
            $data['item_desc'] = $items_info->item_desc;
            $data['hsn_code'] = (!empty($items_info->hsn_code) ? $items_info->hsn_code : '');
            $data['unit_cost'] = $items_info->unit_cost;
            $data['unit'] = $items_info->unit;
            $data['item_tax_rate'] = '0.00';
            $data['item_tax_name'] = json_encode($tax_name);
            $data['item_tax_total'] = (!empty($item_tax_total) ? $item_tax_total : '0.00');
            $data['total_cost'] = $items_info->unit_cost * $items_info->quantity;
            $data['saved_items_id'] = $items_info->saved_items_id;
            
            $this->invoice_model->_table_name = 'tbl_deals_items';
            $this->invoice_model->_primary_key = 'items_id';
            $items_id = $this->invoice_model->save($data, $items_id);
            
            $action = ('activity_deals_items_added');
            $activity = array(
                'user' => $this->session->userdata('user_id'),
                'module' => 'deals',
                'module_field_id' => $items_id,
                'activity' => $action,
                'icon' => 'fa-circle-o',
                'value1' => $items_info->item_name
            );
            $this->invoice_model->_table_name = 'tbl_activities';
            $this->invoice_model->_primary_key = 'activities_id';
            $this->invoice_model->save($activity);
            $type = "success";
            $msg = lang('deals_item_added');
            
            $_data['id'] = $deals_id;
            $data['subview'] = $this->load->view('deals/deals_details/dealItems', $_data, true);
        } else {
            $type = "error";
            $msg = 'please Select an items';
        }
        $data['type'] = $type;
        $data['msg'] = $msg;
        echo json_encode($data);
        exit();
    }
    
    public
    function add_insert_items($deals_id)
    {
        $edited = can_action('13', 'edited');
        $can_edit = $this->invoice_model->can_action('tbl_deals', 'edit', array('id' => $deals_id));
        $deals = get_row('tbl_deals', array('id' => $deals_id));
        if (!empty($can_edit) && !empty($edited)) {
            $v_items_id = $this->input->post('saved_items_id', TRUE);
            if (!empty($v_items_id)) {
                $where = array('deals_id' => $deals_id, 'saved_items_id' => $v_items_id);
                // duplicate value check in DB
                if (!empty($deals_id)) { // if id exist in db update data
                    $user_id = array('items_id !=' => $deals_id);
                } else { // if id is not exist then set id as null
                    $user_id = null;
                }
                $items_info = $this->invoice_model->check_by(array('saved_items_id' => $v_items_id), 'tbl_saved_items');
                
                $total_tax = json_decode($deals->total_tax);
                // check whether this input data already exist or not
                $check_users = get_row('tbl_deals_items', $where);
                if (!empty($check_users)) { // if input data already exist show error alert
                    // massage for user
                    $cdata['quantity'] = $check_users->quantity + 1;
                    $cdata['total_cost'] = $items_info->unit_cost + $check_users->total_cost;
                    
                    $this->invoice_model->_table_name = 'tbl_deals_items';
                    $this->invoice_model->_primary_key = 'items_id';
                    $items_id = $this->invoice_model->save($cdata, $check_users->items_id);
                } else {
                    $tax_info = json_decode($items_info->tax_rates_id);
                    $tax_name = array();
                    if (!empty($tax_info)) {
                        foreach ($tax_info as $v_tax) {
                            $all_tax = $this->db->where('tax_rates_id', $v_tax)->get('tbl_tax_rates')->row();
                            $tax_name[] = $all_tax->tax_rate_name . '|' . $all_tax->tax_rate_percent;
                        }
                    }
                    $item_tax_total = $items_info->item_tax_total;
                    $data['quantity'] = 1;
                    $data['deals_id'] = $deals_id;
                    $data['tax_rates_id'] = ($items_info->tax_rates_id);
                    $data['item_name'] = $items_info->item_name;
                    $data['item_desc'] = $items_info->item_desc;
                    $data['hsn_code'] = $items_info->hsn_code;
                    $data['unit_cost'] = $items_info->unit_cost;
                    $data['unit'] = $items_info->unit_type;
                    $data['item_tax_rate'] = '0.00';
                    $data['item_tax_name'] = json_encode($tax_name);
                    $data['item_tax_total'] = (!empty($item_tax_total) ? $item_tax_total : '0.00');
                    $data['total_cost'] = $items_info->unit_cost;
                    $data['saved_items_id'] = $items_info->saved_items_id;
                    // get all client
                    $this->invoice_model->_table_name = 'tbl_deals_items';
                    $this->invoice_model->_primary_key = 'items_id';
                    $items_id = $this->invoice_model->save($data);
                }
                $action = ('activity_deals_items_added');
                $activity = array(
                    'user' => $this->session->userdata('user_id'),
                    'module' => 'deals',
                    'module_field_id' => $items_id,
                    'activity' => $action,
                    'icon' => 'fa-circle-o',
                    'value1' => $items_info->item_name
                );
                $this->invoice_model->_table_name = 'tbl_activities';
                $this->invoice_model->_primary_key = 'activities_id';
                $this->invoice_model->save($activity);
                $type = "success";
                $msg = lang('deals_item_added');
                $_data['id'] = $deals_id;
                $data['subview'] = $this->load->view('deals/deals_details/dealItems', $_data, true);
            } else {
                $type = "error";
                $msg = 'please Select an items';
            }
            $message = $msg;
            $data['type'] = $type;
            $data['msg'] = $msg;
            echo json_encode($data);
            exit();
        } else {
            set_message('error', lang('there_in_no_value'));
            if (empty($_SERVER['HTTP_REFERER'])) {
                redirect('admin/deals/details');
            } else {
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
    
    public
    function send_mail($id = null)
    {
        
        // $all_email = $this->input->post('email_to', TRUE);
        // foreach ($all_email as $v_email) {
        $data = $this->deals_model->array_from_post(array('subject', 'message_body', 'deals_id', 'email_to'));
        $upload_file = array();
        $resourceed_file = array();
        $files = $this->input->post("files", true);
        $target_path = getcwd() . "/uploads/";
        //process the fiiles which has been uploaded by dropzone
        if (!empty($files) && is_array($files)) {
            foreach ($files as $key => $file) {
                if (!empty($file)) {
                    $file_name = $this->input->post('file_name_' . $file, true);
                    $new_file_name = move_temp_file($file_name, $target_path);
                    $file_ext = explode(".", $new_file_name);
                    $is_image = check_image_extension($new_file_name);
                    $size = $this->input->post('file_size_' . $file, true) / 1000;
                    if ($new_file_name) {
                        $up_data = array(
                            "fileName" => $new_file_name,
                            "path" => "uploads/" . $new_file_name,
                            "fullPath" => getcwd() . "/uploads/" . $new_file_name,
                            "ext" => '.' . end($file_ext),
                            "size" => round($size, 2),
                            "is_image" => $is_image,
                        );
                        array_push($upload_file, $up_data);
                        
                        array_push($resourceed_file, $new_file_name);
                    }
                }
            }
        }
        
        $fileName = $this->input->post('fileName', true);
        $path = $this->input->post('path', true);
        $fullPath = $this->input->post('fullPath', true);
        $size = $this->input->post('size', true);
        $is_image = $this->input->post('is_image', true);
        
        if (!empty($fileName)) {
            foreach ($fileName as $key => $name) {
                $old['fileName'] = $name;
                $old['path'] = $path[$key];
                $old['fullPath'] = $fullPath[$key];
                $old['size'] = $size[$key];
                $old['is_image'] = $is_image[$key];
                
                array_push($upload_file, $old);
                array_push($resourceed_file, $name);
            }
        }
        if (!empty($upload_file)) {
            $data['attach_file'] = json_encode($upload_file);
            $idata['attach_file'] = json_encode($upload_file);
        } else {
            $data['attach_file'] = null;
            $idata['attach_file'] = NULL;
        }
        
        //  * Email Configuaration
        
        $user_id = $this->session->userdata('user_id');
        $profile_info = $this->deals_model->check_by(array('user_id' => $user_id), 'tbl_account_details');
        $user_info = $this->deals_model->check_by(array('user_id' => $user_id), 'tbl_users');
        
        // get company name
        $name = $profile_info->fullname;
        $params['subject'] = $data['subject'];
        $params['message'] = $data['message_body'];
        $params['recipient'] = $data['email_to'];
        // $file_ext = explode(";", $data['email_to']);
        // foreach ($file_ext as $key => $email) {
        //     $params['recipient'] = $email;
        
        // }
        // $send_email = $this->deals_model->send_email($params, $resourceed_file);
        $send_email = $this->send_email($params, $resourceed_file);
        
        
        // save into inbox table procees
        $idata['email_to'] = $data['email_to'];
        $idata['email_from'] = $user_info->email;
        $idata['user_id'] = $user_id;
        $idata['deals_id'] = $data['deals_id'];
        $idata['subject'] = $data['subject'];
        $idata['message_body'] = $data['message_body'];
        $idata['message_time'] = date('Y-m-d H:i:s');
        // save into inbox
        $this->deals_model->_table_name = 'tbl_deals_email';
        $this->deals_model->_primary_key = 'id';
        $this->deals_model->save($idata, $id);
        
        $activity = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'deals',
            'module_field_id' => $user_id,
            'activity' => lang('activity_msg_sent'),
            'icon' => 'fa-circle-o',
            'value1' => $data['email_to']
        );
        $this->deals_model->_table_name = 'tbl_activities';
        $this->deals_model->_primary_key = 'activities_id';
        $this->deals_model->save($activity);
        // }
        
        if ($send_email) {
            $type = "success";
            $message = lang('msg_sent');
            set_message($type, $message);
            redirect('admin/deals/details/' . $data['deals_id'] . '/email');
        } else {
            show_error($this->email->print_debugger());
        }
    }
    
    function send_email($params, $attachments = null)
    {
        
        $config = array();
        // If postmark API is being used
        if (config_item('use_postmark') == 'TRUE') {
            $config = array(
                'api_key' => config_item('postmark_api_key')
            );
            $this->load->library('postmark', $config);
            $this->postmark->from(config_item('postmark_from_address'), config_item('company_name'));
            $this->postmark->to($params['recipient']);
            $this->postmark->subject($params['subject']);
            $this->postmark->message_plain($params['message']);
            $this->postmark->message_html($params['message']);
            // Check resourceed file
            if (isset($attachments)) {
                foreach ($attachments as $files) {
                    $this->postmark->resource(base_url() . 'uploads/' . $files);
                }
            }
            $this->postmark->send();
        } else {
            // Send email
            $config['useragent'] = 'UniqueCoder LTD';
            $config['mailpath'] = "/usr/bin/sendmail"; // or "/usr/sbin/sendmail"
            $config['wordwrap'] = TRUE;
            $config['mailtype'] = "html";
            $config['charset'] = 'utf-8';
            $config['newline'] = "\r\n";
            $config['crlf'] = "\r\n";
            $config['smtp_timeout'] = '30';
            $config['protocol'] = config_item('protocol');
            $config['smtp_host'] = config_item('smtp_host');
            $config['smtp_port'] = config_item('smtp_port');
            $config['smtp_user'] = trim(config_item('smtp_user'));
            $config['smtp_pass'] = decrypt(config_item('smtp_pass'));
            $config['smtp_crypto'] = config_item('smtp_encryption');
            
            $this->load->library('email', $config);
            $this->email->clear();
            $this->email->from(config_item('company_email'), config_item('company_name'));
            $this->email->to($params['recipient']);
            
            $this->email->subject($params['subject']);
            $this->email->message($params['message']);
            if (isset($attachments)) {
                foreach ($attachments as $v_files) {
                    $this->email->attach('uploads/' . $v_files);
                }
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
    
    public
    function dealsManuallyItems()
    {
        $data['title'] = lang('added') . ' ' . lang('manually');
        $data['subview'] = $this->load->view('deals/deals_manually_items', $data, false);
        $this->load->view('admin/_layout_modal', $data);
    }
    
    public
    function email_details($deals_email_id = null)
    {
        $data['title'] = lang('email_details');
        $data['details'] = get_row('tbl_deals_email', array('id' => $deals_email_id));
        $data['subview'] = $this->load->view('deals/email_details', $data, FALSE);
        $this->load->view('admin/_layout_modal', $data);
    }
    
    public
    function call_details($deals_email_id = null)
    {
        $data['title'] = lang('call_details');
        $data['details'] = get_row('tbl_calls', array('calls_id' => $deals_email_id));
        $data['subview'] = $this->load->view('deals/call_details', $data, FALSE);
        $this->load->view('admin/_layout_modal', $data);
    }
    
    public
    function download_file($file)
    {
        $this->load->helper('download');
        if (file_exists(('uploads/' . $file))) {
            $down_data = file_get_contents('uploads/' . $file); // Read the file's contents
            force_download($file, $down_data);
        } else {
            $type = "error";
            $message = 'Operation Fieled !';
            set_message($type, $message);
            if (empty($_SERVER['HTTP_REFERER'])) {
                redirect('admin/mailbox');
            } else {
                redirect($_SERVER['HTTP_REFERER']);
            }
        }
    }
    
    public
    function delete_deals_email($deals_id, $id)
    {
        $email_info = $this->deals_model->check_by(array('id' => $id), 'tbl_deals_email');
        $activity = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'opportunities',
            'module_field_id' => $deals_id,
            'activity' => 'activity_email_deals_deleted',
            'icon' => 'fa-filter',
            'link' => 'admin/deals/details/' . $deals_id . '/email',
            'value1' => $email_info->subject
        );
        $this->deals_model->_table_name = 'tbl_activities';
        $this->deals_model->_primary_key = 'activities_id';
        $this->deals_model->save($activity);
        
        $this->deals_model->_table_name = 'tbl_deals_email';
        $this->deals_model->_primary_key = 'id';
        $this->deals_model->delete($id);
        
        echo json_encode(array("status" => 'success', 'message' => lang('deals_email_deleted')));
        exit();
    }
    
    public
    function updateUsers($deals_id, $type)
    {
        // post data
        $data['deals'] = $this->deals_model->check_by(array('id' => $deals_id), 'tbl_deals');
        $type_id = $this->input->post($type . '_id', true);
        if (!empty($type_id)) {
            $_data[$type . '_id'] = json_encode($type_id);
            $this->deals_model->_table_name = 'tbl_deals';
            $this->deals_model->_primary_key = 'id';
            $this->deals_model->save($_data, $deals_id);
            
            if ($type == 'user') {
                $this->send_assign_email($deals_id, $type_id);
                foreach ($type_id as $v_user) {
                    if ($v_user != $this->session->userdata('user_id')) {
                        add_notification(array(
                            'to_user_id' => $v_user,
                            'from_user_id' => true,
                            'description' => 'not_deals_added_you',
                            'link' => 'admin/deals/details/' . $deals_id,
                            'value' => $data['deals']->title,
                        ));
                    }
                }
                show_notification($type_id);
            }
            $type = "success";
            $message = lang('deals_update_user');
            set_message($type, $message);
            redirect('admin/deals/details/' . $deals_id);
        }
        $data['title'] = lang('update_' . $type);
        $data['type'] = $type;
        
        $data['modal_subview'] = $this->load->view('deals/_modal_users', $data, FALSE);
        $this->load->view('admin/_layout_modal', $data);
    }
    
    public
    function send_assign_email($deals_id, $users)
    {
    }
    
    public
    function deals_setting()
    {
        $data['title'] = lang('deals_settings');
        $data['subview'] = $this->load->view('deals/deals_settings', $data, TRUE);
        $this->load->view('admin/_layout_main', $data);
    }
    
    public
    function save_deals_email_integration()
    {
        $input_data = $this->deals_model->array_from_post(array(
            'encryption_deals', 'default_pipeline', 'default_stage', 'default_deal_owner', 'config_deals_host', 'config_deals_username', 'config_deals_mailbox', 'unread_deals_email', 'delete_mail_after_deals_import'
        ));
        
        $config_password = $this->input->post('config_deals_password', true);
        if (!empty($config_password)) {
            $input_data['config_deals_password'] = encrypt($config_password);
        }
        if ($input_data['encryption_deals'] == 'on') {
            $input_data['encryption_deals'] = null;
        }
        if (empty($input_data['unread_deals_email'])) {
            $input_data['unread_deals_email'] = 'on';
        }
        if (empty($input_data['delete_mail_after_deals_import'])) {
            $input_data['delete_mail_after_deals_import'] = null;
        }
        foreach ($input_data as $key => $value) {
            $data = array('value' => $value);
            $this->db->where('config_key', $key)->update('tbl_config', $data);
            $exists = $this->db->where('config_key', $key)->get('tbl_config');
            if ($exists->num_rows() == 0) {
                $this->db->insert('tbl_config', array("config_key" => $key, "value" => $value));
            }
        }
        
        $activity = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'settings',
            'module_field_id' => $this->session->userdata('user_id'),
            'activity' => ('activity_save_deals_email_integration'),
        );
        $this->deals_model->_table_name = 'tbl_activities';
        $this->deals_model->_primary_key = 'activities_id';
        $this->deals_model->save($activity);
        // messages for user
        $type = "success";
        $message = lang('save_deals_email_integration');
        set_message($type, $message);
        redirect('admin/deals/deals_setting');
    }
    
    public
    function sales_pipelines($id = NULL, $opt = null)
    {
        $data['title'] = lang('new_pipeline');
        if (!empty($id)) {
            $data['pipeline'] = $this->deals_model->check_by(array('pipeline_id' => $id), 'tbl_deals_pipelines');
        }
        $data['subview'] = $this->load->view('deals/sales_pipelines', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }
    
    public
    function saved_pipelines($id = null)
    {
        
        
        $cate_data['pipeline_name'] = $this->input->post('pipeline_name', TRUE);
        
        $where = array('pipeline_name' => $cate_data['pipeline_name']);
        // duplicate value check in DB
        if (!empty($id)) { // if id exist in db update data
            $user_id = array('pipeline_id !=' => $id);
        } else { // if id is not exist then set id as null
            $user_id = null;
        }
        // check whether this input data already exist or not
        $check_users = $this->deals_model->check_update('tbl_deals_pipelines', $where, $user_id);
        if (!empty($check_users)) { // if input data already exist show error alert
            // massage for user
            $type = 'error';
            $msg = lang('pipelines_already_exist');
        } else {
            $this->deals_model->_table_name = 'tbl_deals_pipelines';
            $this->deals_model->_primary_key = 'pipeline_id';
            $id = $this->deals_model->save($cate_data, $id);
            
            
            $activity = array(
                'user' => $this->session->userdata('user_id'),
                'module' => 'deals',
                'module_field_id' => $id,
                'activity' => ('pipelines_added'),
                // 'value1' => $cate_data['new_stages']
            );
            $this->deals_model->_table_name = 'tbl_activities';
            $this->deals_model->_primary_key = 'activities_id';
            $this->deals_model->save($activity);
            
            // messages for user
            $type = "success";
            $msg = lang('successfully_pipelines_added');
        }
        set_message($type, $msg);
        redirect('admin/deals/sales_pipelines');
    }
    
    
}
