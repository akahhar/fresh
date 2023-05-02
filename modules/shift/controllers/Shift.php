<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Shift extends Admin_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('shift_model');
    }
    
    public function index()
    {
        $data['title'] = lang('shift_calender');
        $data['subview'] = $this->load->view('shift_calender', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }
    
    public function manage($id = NULL)
    {
        $data['title'] = lang('manage_shift');
        $data['active'] = 1;
        $data['subview'] = $this->load->view('manage_shift', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }
    
    public function shiftList()
    {
        if ($this->input->is_ajax_request()) {
            $this->load->model('datatables');
            $this->datatables->table = 'tbl_shift';
            $columb = array('shift_name', 'start_time', 'end_time', 'status');
            $this->datatables->column_order = $columb;
            $this->datatables->column_search = $columb;
            $this->datatables->order = array('shift_id' => 'desc');
            $fetch_data = make_datatables();
            $data = array();
            
            $edited = can_action_by_label('manage_shift', 'edited');
            $deleted = can_action_by_label('manage_shift', 'deleted');
            foreach ($fetch_data as $key => $row) {
                $sub_array = array();
                $can_edit = $this->shift_model->can_action('tbl_shift', 'edit', array('shift_id' => $row->shift_id));
                $can_delete = $this->shift_model->can_action('tbl_shift', 'delete', array('shift_id' => $row->shift_id));
                $name = null;
                $name .= $row->shift_name;
                if ($row->is_default == 'Yes') {
                    $name .= ' <span class="label label-success">' . lang('default') . '</span>';
                } elseif ($row->recurring == 'Yes') {
                    $name .= ' <a onclick="return confirm(' . lang('shift_cancel_recurring') . ')" href="' . base_url() . 'admin/shift/cancel_recurring/' . $row->shift_id . '" class="label label-danger mb" title="' . lang('cancel_recurring') . '"><i class="fa fa-times"></i></a>';
                }
                $sub_array[] = $name;
                $sub_array[] = display_time($row->start_time);
                $sub_array[] = display_time($row->end_time);
                $sub_array[] = lang($row->status);
                $action = null;
                if (!empty($can_edit) && !empty($edited)) {
                    $action .= btn_edit('admin/shift/create/' . $row->shift_id) . ' ';
                    $action .= '<a href="' . base_url() . 'admin/shift/make_default/' . $row->shift_id . '" class="btn btn-success btn-xs" title="' . lang('make_default') . '"  data-toggle="tooltip" data-placement="top"><i class="fa fa-bullseye"></i></a>' . ' ';
                }
                if (!empty($can_delete) && !empty($deleted)) {
                    $action .= ajax_anchor(base_url("admin/shift/delete_shift/$row->shift_id"), "<i class='btn btn-xs btn-danger fa fa-trash-o'></i>", array("class" => "", "title" => lang('delete'), "data-fade-out-on-success" => "#table_" . $key));
                }
                $sub_array[] = $action;
                $data[] = $sub_array;
            }
            render_table($data);
        } else {
            redirect('admin/dashboard');
        }
    }
    
    public function create($id = null)
    {
        $data['title'] = lang('create_shift');
        $data['active'] = 2;
        if (!empty($id)) {
            $can_edit = $this->shift_model->can_action('tbl_shift', 'edit', array('shift_id' => $id));
            $edited = can_action_by_label('manage_shift', 'edited');
            if (!empty($can_edit) && !empty($edited)) {
                $data['shift_info'] = $this->shift_model->check_by(array('shift_id' => $id), 'tbl_shift');
            }
        }
        $data['subview'] = $this->load->view('create_shift', $data, true);
        $this->load->view('admin/_layout_main', $data); //page load
    }
    
    
    public function save_shift($id = NULL)
    {
        $created = can_action_by_label('manage_shift', 'created');
        $edited = can_action_by_label('manage_shift', 'edited');
        if (!empty($created) && !empty($edited)) {
            $this->shift_model->_table_name = 'tbl_shift';
            $this->shift_model->_primary_key = 'shift_id';
            // input data
            $sdata = $this->shift_model->array_from_post(array('shift_name', 'start_time', 'end_time', 'shift_before_start', 'shift_after_end', 'lunch_time', 'status')); //input post
            $sdata['recurring'] = ($this->input->post('recurring', true) == 'Yes') ? 'Yes' : 'No';
            if ($sdata['recurring'] == 'No') {
                $sdata['repeat_every'] = 0;
                $sdata['recurring_type'] = 'day';
            } else {
                $sdata['repeat_every'] = $this->input->post('repeat_every', true);
                if ($sdata['repeat_every'] == 0 || empty($sdata['repeat_every'])) {
                    set_message('error', 'you need to insert a recurring value to start recurring');
                    redirect('manage');
                }
                $sdata['recurring_type'] = $this->input->post('recurring_type', true);
            }
            if (!empty($id)) { // dublicacy check
                $shift_id = array('shift_id !=' => $id);
            } else {
                $shift_id = null;
            }
            // check check_shift by where
            // if not empty show alert message else save data
            $check_shift = $this->shift_model->check_update('tbl_shift', array('shift_name' => $sdata['shift_name']), $shift_id);
            if (!empty($check_shift)) { // if input data already exist show error alert
                // massage for user
                $type = 'error';
                $msg = "<strong style='color:#000'>" . $sdata['shift_name'] . '</strong>  ' . lang('already_exist');
            } else { // save and update query    
                if (!empty($id)) {
                    $id = $this->shift_model->save($sdata, $id);
                    $dd = true;
                } else {
                    $id = $this->shift_model->save($sdata);
                    $dd = $this->assign_shift($id, 'new');
                }
                $activity = array(
                    'user' => $this->session->userdata('user_id'),
                    'module' => 'settings',
                    'module_field_id' => $id,
                    'activity' => ('activity_added_a_shift'),
                    'value1' => $sdata['shift_name']
                );
                $this->shift_model->_table_name = 'tbl_activities';
                $this->shift_model->_primary_key = 'activities_id';
                $this->shift_model->save($activity);
                
                // messages for user
                $type = "success";
                $msg = lang('shift_added');
                // messages for user
            }
            $message = $msg;
            set_message($type, $message);
        }
        if (!empty($dd)) {
            redirect('admin/shift/manage');
        }
    }
    
    
    public function delete_shift($id)
    {
        $deleted = can_action_by_label('manage_shift', 'deleted');
        if (!empty($deleted)) {
            $shift_info = $this->shift_model->check_by(array('shift_id' => $id), 'tbl_shift');
            $activity = array(
                'user' => $this->session->userdata('user_id'),
                'module' => 'settings',
                'module_field_id' => $id,
                'activity' => ('activity_deleted_a_shift'),
                'value1' => $shift_info->shift
            );
            $this->shift_model->_table_name = 'tbl_activities';
            $this->shift_model->_primary_key = 'activities_id';
            $this->shift_model->save($activity);
            
            //save data into table.
            $this->shift_model->_table_name = "tbl_shift_mapping"; // table name
            $this->shift_model->delete_multiple(array('shift_id' => $id));
            
            $this->shift_model->_table_name = 'tbl_shift';
            $this->shift_model->_primary_key = 'shift_id';
            $this->shift_model->delete($id);
            
            $type = "success";
            $msg = lang('delete_successfully');
            echo json_encode(array("status" => $type, 'message' => $msg));
            exit();
        }
    }
    
    public function make_default($id)
    {
        $edited = can_action_by_label('manage_shift', 'edited');
        $can_edit = $this->shift_model->can_action('tbl_shift', 'edit', array('shift_id' => $id));
        if (!empty($edited) && !empty($can_edit)) {
            $shift_info = $this->shift_model->check_by(array('shift_id' => $id), 'tbl_shift');
            if ($shift_info->status == 'unpublished') {
                $type = "error";
                $message = lang('the_unpublished_shift_cannot_default');
            } else {
                $this->db->set('is_default', 'No');
                $this->db->where('is_default', 'Yes')->update('tbl_shift');
                
                $data['is_default'] = 'Yes';
                
                $this->shift_model->_table_name = 'tbl_shift';
                $this->shift_model->_primary_key = 'shift_id';
                $this->shift_model->save($data, $id);
                
                $type = "success";
                $message = lang('information_updated_successfully');
            }
            set_message($type, $message);
            redirect('admin/shift/manage');
        }
    }
    
    public function shift_mapping($id = null)
    {
        $data['title'] = lang('shift_mapping');
        $data['active'] = 1;
        $data['subview'] = $this->load->view('shift_mapping', $data, TRUE);
        $this->load->view('admin/_layout_main', $data); //page load
    }
    
    public function assignShift($id = null)
    {
        $data['title'] = lang('assign_shift');
        $data['active'] = 2;
        if ($id) {
            $edited = can_action_by_label('shift_mapping', 'edited');
            if (!empty($edited)) {
                $data['mapping_info'] = $this->shift_model->shiftMappingInfo($id);
            }
        }
        $data['subview'] = $this->load->view('assign_shift', $data, true);
        $this->load->view('admin/_layout_main', $data); //page load
    }
    
    public function assignNewShift($shift_id = NULL)
    {
        $shiftFor = $this->input->post('shiftFor', true);
        foreach ($shiftFor as $key => $data) {
            $decodedata = explode('data', $data);
            $user_id = $decodedata['1'];
            $date[$user_id][] = $decodedata['0'];
        }
        $shiftInfo = get_row('tbl_shift', array('shift_id' => $shift_id));
        if (!empty($shiftInfo) && $shiftInfo->recurring == 'Yes') {
            $smdata['m_status'] = 6;
        }
        
        $getAllDate = $this->shift_model->getConsecutiveDate($date);
        
        if (!empty($getAllDate)) {
            foreach ($getAllDate as $key => $vallDate) {
                foreach ($vallDate as $userID => $allDate) {
                    $end_date = (!empty($allDate[1]) ? $allDate[1] : $allDate[0]);
                    $smdata['user_id'] = $userID;
                    $smdata['s_user_id'] = $userID;
                    $smdata['shift_id'] = $shift_id;
                    $smdata['start_date'] = $allDate[0];
                    $smdata['end_date'] = $end_date;
                    $check = get_row('tbl_shift_mapping', array('s_user_id' => $decodedata['2'], 'start_date' => $allDate[0]));
                    $shift_mapping_id = null;
                    if (!empty($check)) {
                        $shift_mapping_id = $check->shift_mapping_id;
                    }
                    
                    $this->shift_model->_table_name = 'tbl_shift_mapping';
                    $this->shift_model->_primary_key = 'shift_mapping_id';
                    $id = $this->shift_model->save($smdata, $shift_mapping_id);
                }
            }
        }
        if (!empty($id)) {
            $jData['status'] = 'success';
            $jData['message'] = lang('shift_added');
        }
        echo json_encode($jData);
        exit();
    }
    
    public function assign_shift_by_date($data)
    {
        $decodedata = explode('data', url_decode($data));
        $shift_id = $decodedata['0'];
        $date = $decodedata['1'];
        $smdata['user_id'] = $decodedata['2'];
        $smdata['s_user_id'] = $decodedata['2'];
        $smdata['shift_id'] = $shift_id;
        $smdata['start_date'] = $date;
        $smdata['end_date'] = $date;
        
        $shiftInfo = get_row('tbl_shift', array('shift_id' => $shift_id));
        if (!empty($shiftInfo) && $shiftInfo->recurring == 'Yes') {
            $smdata['m_status'] = 6;
        }
        
        $check = get_row('tbl_shift_mapping', array('s_user_id' => $decodedata['2'], 'start_date' => $date));
        $shift_mapping_id = null;
        if (!empty($check)) {
            $shift_mapping_id = $check->shift_mapping_id;
        }
        
        $this->shift_model->_table_name = 'tbl_shift_mapping';
        $this->shift_model->_primary_key = 'shift_mapping_id';
        $id = $this->shift_model->save($smdata, $shift_mapping_id);
        
        $activity = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'settings',
            'module_field_id' => $id,
            'activity' => ('activity_added_a_shift'),
            'value1' => $shiftInfo->shift_name
        );
        $this->shift_model->_table_name = 'tbl_activities';
        $this->shift_model->_primary_key = 'activities_id';
        $this->shift_model->save($activity);
        
        // messages for user
        $type = "success";
        $msg = lang('shift_added');
        $message = $msg;
        set_message($type, $message);
        redirect('admin/shift');
    }
    
    public function assign_shift($sid = NULL, $create = null)
    {
        $created = can_action_by_label('manage_shift', 'created');
        $edited = can_action_by_label('manage_shift', 'edited');
        if (!empty($created) && !empty($edited)) {
            $this->shift_model->_table_name = 'tbl_shift_mapping';
            $this->shift_model->_primary_key = 'shift_mapping_id';
            
            //input data
            $shift_id = $this->input->post('shift_id', true);
            if (!empty($create)) {
                $shift_id = $sid;
            } else {
                $id = $sid;
            }
            $start_date = $this->input->post('start_date', true);
            $end_date = $this->input->post('end_date', true);
            $user_id = $this->input->post('user_id', true);
            
            $smdata['start_date'] = $start_date;
            $smdata['end_date'] = $end_date;
            
            $shiftInfo = get_row('tbl_shift', array('shift_id' => $shift_id));
            if (!empty($shiftInfo) && $shiftInfo->recurring == 'Yes') {
                $smdata['end_date'] = NULL;
            }
            $last_id = get_order_by('tbl_shift_mapping', array('shift_mapping_id !=' => NULL), 'shift_mapping_id', NULL, 1);
            if (!empty($last_id[0]->shift_mapping_id)) {
                $last_id = $last_id[0]->shift_mapping_id;
            } else {
                $last_id = 1;
            }
            
            if (!empty($user_id)) {
                foreach ($user_id as $userid) {
                    $check_conflic = $this->shift_model->checkConflicShift($userid, $start_date, $end_date);
                    if (!empty($check_conflic)) {
                        $conflic_data[$userid] = $check_conflic;
                        $conflic_data[$userid]['to'] = $shiftInfo;
                        $conflic_data[$userid]['to']->start_date = $start_date;
                        $conflic_data[$userid]['to']->end_date = (empty($end_date) ? date('Y-m-d') : $end_date);
                    } else {
                        $smdata['shift_id'] = $shift_id;
                        $smdata['user_id'] = $userid;
                        $smdata['s_user_id'] = $userid;
                        $indata[] = $smdata;
                    }
                    $last_id++;
                }
                if (!empty($indata)) {
                    $this->db->insert_batch('tbl_shift_mapping', $indata);
                }
            }
            
            if (!empty($conflic_data)) {
                $data['title'] = lang('conflicts_found');
                $data['conflic_data'] = $conflic_data;
                $data['inputData'] = $smdata;
                $data['shiftName'] = $shiftInfo->shift_name . ' (' . display_time($shiftInfo->start_time) . ' ' . display_time($shiftInfo->end_time) . ') ';
                $data['subview'] = $this->load->view('conflic_shift_mapping', $data, TRUE);
                $this->load->view('admin/_layout_main', $data); //page load
            } else {
                
                $activity = array(
                    'user' => $this->session->userdata('user_id'),
                    'module' => 'settings',
                    'module_field_id' => $id,
                    'activity' => ('activity_added_a_shift'),
                    'value1' => $shiftInfo->shift_name
                );
                $this->shift_model->_table_name = 'tbl_activities';
                $this->shift_model->_primary_key = 'activities_id';
                $this->shift_model->save($activity);
                if (!empty($create)) {
                    return true;
                }
                // messages for user
                $type = "success";
                $msg = lang('shift_added');
                $message = $msg;
                set_message($type, $message);
                redirect('admin/shift/shift_mapping');
            }
        }
    }
    
    
    public function update_shift($mapping_id, $userid)
    {
        $created = can_action_by_label('shift_mapping', 'created');
        $edited = can_action_by_label('shift_mapping', 'edited');
        $user_id = $this->input->post('user_id', true);
        if (!empty($created) && !empty($edited) && $user_id == $userid) {
            $this->shift_model->_table_name = 'tbl_shift_mapping';
            $this->shift_model->_primary_key = 'shift_mapping_id';
            //input data
            $shift_id = $this->input->post('shift_id', true);
            $start_date = $this->input->post('start_date', true);
            $end_date = $this->input->post('end_date', true);
            $mappingInfo = $this->shift_model->shiftMappingInfo($mapping_id);
            
            if ($mappingInfo->recurring == 'No') {
                $smdata['end_date'] = $end_date;
            } else {
                $smdata['end_date'] = NULL;
            }
            
            if ($mappingInfo->shift_id != $shift_id) {
                $check_conflic = $this->shift_model->checkConflicShift($userid, $start_date, $end_date);
                
                if (!empty($check_conflic)) {
                    $conflic_data[$userid]['first'] = reset($check_conflic);
                    if ($conflic_data[$userid]['first'][0]->shift_id != $shift_id) {
                        $conflic_data[$userid]['first'][0]->c_satrt_date = array_key_first($check_conflic);
                        $conflic_data[$userid]['last'] = end($check_conflic);
                        $conflic_data[$userid]['last'][0]->c_end_date = array_key_last($check_conflic);
                        $conflic_data[$userid]['to'] = $mappingInfo;
                        $conflic_data[$userid]['to']->start_date = $start_date;
                        $conflic_data[$userid]['to']->end_date = (empty($end_date) ? date('Y-m-d') : $end_date);
                    }
                }
            } else {
                $smdata['shift_id'] = $shift_id;
                $smdata['start_date'] = $start_date;
                $smdata['user_id'] = $userid;
                $smdata['s_user_id'] = $userid;
                
                $this->shift_model->save($smdata, $mapping_id);
            }
            
            if (!empty($conflic_shift)) {
                $data['title'] = lang('conflicts_found');
                $data['conflic_data'] = $conflic_data;
                $data['subview'] = $this->load->view('conflic_shift_mapping', $data, TRUE);
                $this->load->view('admin/_layout_main', $data); //page load
            } else {
                $activity = array(
                    'user' => $this->session->userdata('user_id'),
                    'module' => 'settings',
                    'module_field_id' => $mapping_id,
                    'activity' => ('activity_added_a_shift'),
                    'value1' => $mappingInfo->shift_name
                );
                $this->shift_model->_table_name = 'tbl_activities';
                $this->shift_model->_primary_key = 'activities_id';
                $this->shift_model->save($activity);
                
                // messages for user
                $type = "success";
                $msg = lang('shift_added');
                $message = $msg;
                set_message($type, $message);
                redirect('admin/shift/shift_mapping');
            }
        }
    }
    
    public
    function update_conflic()
    {
        $update_conflic_update = $this->input->post('update_conflic_update', true);
        if (!empty($update_conflic_update)) {
            $conflic_user = $this->input->post('conflic_user', true);
            $conflic_data = ($this->input->post('conflic_shift', true));
            
            $this->shift_model->_table_name = 'tbl_shift_mapping';
            $this->shift_model->_primary_key = 'shift_mapping_id';
            
            if (!empty($conflic_data)) {
                foreach ($conflic_data as $key => $appliyed) {
                    $decodedata = explode('data', url_decode($appliyed));
                    $conflicted_id = json_decode($decodedata[0]);
                    $newShiftData = json_decode($decodedata[1]);
                    
                    if (!empty($newShiftData)) {
                        foreach ($newShiftData as $id => $date) {
                            
                            $willBeMapID[] = $id;
                            $mappingInfo = $this->shift_model->shiftMappingInfo($id);
                            if ($mappingInfo->recurring == 'Yes') {
                                $sdate['m_status'] = 6;
                            }
                            if (!empty($date[0])) {
                                $wudate['end_date'] = $wudate['start_date'] = $date[0][0];
                                if (!empty($date[0][1])) {
                                    $wudate['end_date'] = $date[0][1];
                                }
                                $this->shift_model->save($wudate, $id);
                                unset($date[0]);
                            }
                            if (!empty($date[1])) {
                                $wudate['shift_id'] = $mappingInfo->shift_id;
                                $wudate['user_id'] = $mappingInfo->user_id;
                                $wudate['s_user_id'] = $mappingInfo->s_user_id;
                                foreach ($date as $key => $vdate) {
                                    $wudate['start_date'] = $vdate[0];
                                    $wudate['end_date'] = $vdate[1];
                                    $this->shift_model->save($wudate);
                                }
                            }
                        }
                        $willBeMapID = array_values(array_unique($willBeMapID));
                        foreach ($conflicted_id as $conflicMapID) {
                            if (!in_array($conflicMapID, $willBeMapID)) {
                                $this->shift_model->delete($conflicMapID);
                            }
                        }
                    }
                }
            }
            if (!empty($conflic_user)) {
                foreach ($conflic_user as $cuser => $data) {
                    if (!empty($data)) {
                        $decode_data = explode('data', url_decode($data));
                        
                        $shift_id = $decode_data[0];
                        $start_date = $decode_data[1];
                        $end_date = $decode_data[2];
                        $audate['shift_id'] = $shift_id;
                        $shift_name = get_row('tbl_shift', array('shift_id' => $shift_id));
                        $audate['end_date'] = $end_date;
                        if ($shift_name->recurring == 'Yes') {
                            $sdate['end_date'] = NULL;
                        }
                        $audate['start_date'] = $start_date;
                        $audate['user_id'] = $cuser;
                        $audate['s_user_id'] = $cuser;
                        $this->shift_model->_table_name = 'tbl_shift_mapping';
                        $this->shift_model->_primary_key = 'shift_mapping_id';
                        $this->shift_model->save($audate);
                    }
                }
            }
            $type = "success";
            $message = lang('update_conflic_successfully');
        } else {
            $type = "error";
            $message = lang('update_conflic_error');
        }
        
        set_message($type, $message);
        redirect('admin/shift/shift_mapping');
    }
    
    public
    function delete_mapping($mapping_id)
    {
        $mappingInfo = $this->shift_model->shiftMappingInfo($mapping_id);
        $shift_name = $mappingInfo->shift_name . ' (' . display_time($mappingInfo->start_time) . ' ' . display_time($mappingInfo->end_time) . ') ';
        
        $activity = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'settings',
            'module_field_id' => $mapping_id,
            'activity' => ('activity_delete_a_shift_mapping'),
            'value1' => $shift_name
        );
        $this->shift_model->_table_name = 'tbl_activities';
        $this->shift_model->_primary_key = 'activities_id';
        $this->shift_model->save($activity);
        
        //save data into table.
        $this->shift_model->_table_name = "tbl_shift_mapping"; // table name
        $this->shift_model->_primary_key = "shift_mapping_id"; // $id
        $this->shift_model->delete($mapping_id);
        
        // messages for user
        $type = "success";
        $message = lang('activity_delete_a_shift_mapping');
        set_message($type, $message);
        redirect('admin/shift/shift_mapping');
    }
    
    public
    function getShiftMapping()
    {
        if ($this->input->is_ajax_request()) {
            $date = $this->input->post('date', true);
            $_data['all_shift_mapping'] = $this->shift_model->get_shift_data($date);
            $data['mapping_details'] = $this->load->view('all_shift_mapping', $_data, TRUE);
            echo json_encode($data);
            exit();
        } else {
            redirect('shift_mapping');
        }
    }
    
    public
    function getWeekDate()
    {
        $date = $this->input->post('date', true);
        $all_date = $this->shift_model->weekly_date($date);
        $_data['all_date'] = $all_date;
        $data['firstDate'] = date('Y-m-d', strtotime("-1 day", strtotime(reset($all_date))));
        $data['lastDate'] = date('Y-m-d', strtotime("+1 day", strtotime(end($all_date))));
        $data['text'] = date('d-F-Y', strtotime(reset($all_date))) . ' - ' . date('d-F-Y', strtotime(end($all_date)));
        $_data['all_mapping'] = $this->shift_model->get_data_by_week($date);
        $data['mapping_details'] = $this->load->view('shift_by_week', $_data, TRUE);
        echo json_encode($data);
        exit();
    }
    
    public
    function stop_recurring($mapping_id)
    {
        $mappingInfo = $this->shift_model->shiftMappingInfo($mapping_id);
        if (!empty($mappingInfo)) {
            $data['end_date'] = date('Y-m-d');
            $data['recurring'] = 'No';
            $data['repeat_every'] = 0;
            $this->shift_model->_table_name = "tbl_shift_mapping"; // table name
            $this->shift_model->_primary_key = "shift_mapping_id"; // $id
            $this->shift_model->save($data, $mapping_id);
            $shift_name = $mappingInfo->shift_name . ' (' . display_time($mappingInfo->start_time) . ' ' . display_time($mappingInfo->end_time) . ') ';
            $activity = array(
                'user' => $this->session->userdata('user_id'),
                'module' => 'settings',
                'module_field_id' => $mapping_id,
                'activity' => ('activity_stop_shift_recurring'),
                'value1' => $shift_name . ' ' . display_date($mappingInfo->start_date) . ' ' . display_date($mappingInfo->end_date)
            );
            $this->shift_model->_table_name = 'tbl_activities';
            $this->shift_model->_primary_key = 'activities_id';
            $this->shift_model->save($activity);
            
            // messages for user
            $type = "success";
            $message = lang('stop_shift_recurring_successfully');
            set_message($type, $message);
            redirect('admin/shift/shift_mapping');
        }
    }
    
    public
    function getShiftInfo($shift_id)
    {
        if (!empty($shift_id)) {
            $shiftInfo = get_row('tbl_shift', array('shift_id' => $shift_id));
            if (!empty($shiftInfo)) {
                echo json_encode($shiftInfo);
                exit();
            }
        }
        echo json_encode(array('error' => 'something_went_wrong'));
        exit();
    }
    
    public
    function cancel_recurring($shift_id)
    {
        $shiftInfo = get_row('tbl_shift', array('shift_id' => $shift_id));
        if (!empty($shiftInfo)) {
            $data['recurring'] = 'No';
            $data['repeat_every'] = 0;
            
            $this->shift_model->_table_name = "tbl_shift"; // table name
            $this->shift_model->_primary_key = "shift_id"; // $id
            $this->shift_model->save($data, $shift_id);
            
            $shift_name = $shiftInfo->shift_name . ' (' . display_time($shiftInfo->start_time) . ' ' . display_time($shiftInfo->end_time) . ') ';
            $activity = array(
                'user' => $this->session->userdata('user_id'),
                'module' => 'settings',
                'module_field_id' => $shift_id,
                'activity' => ('activity_stop_shift_recurring'),
                'value1' => $shift_name
            );
            $this->shift_model->_table_name = 'tbl_activities';
            $this->shift_model->_primary_key = 'activities_id';
            $this->shift_model->save($activity);
            
            // messages for user
            $type = "success";
            $message = lang('cancel_shift_recurring_successfully');
            set_message($type, $message);
            redirect('admin/shift/manage');
        }
    }
}
