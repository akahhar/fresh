<?php defined('BASEPATH') or exit('No direct script access allowed');


class Faq extends Gb_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('saas_model');

    }

    public function index()
    {
        $data['title'] = lang('faq');
        $data['subview'] = $this->load->view('faq/manage', $data, true);
        $this->load->view('_layout_main', $data);
    }

    // Show page list
    public function faqList()
    {
        if ($this->input->is_ajax_request()) {
            $this->load->model('datatables');
            $this->datatables->table = 'tbl_saas_front_contact_us';
            $this->datatables->column_search = array('subject', 'name', 'email', 'phone');
            $this->datatables->order = array('id' => 'desc');
            $fetch_data = make_datatables();

            $data = array();
            $deleted = super_admin_access('155', 'deleted');

            foreach ($fetch_data as $_key => $info) {
                $action = null;
                $sub_array = array();

                $sub_array[] = $info->subject;
                $sub_array[] = '<a title="View Email" style="' . ($info->view_status == 1 ? 'color: #656565;' : ' ') . '"  data-target="#myModal_lg" data-toggle="modal" href="' . base_url('saas/faq/view_faq/') . $info->id . '">' . $info->name . '</a>';
                $sub_array[] = '<a href="mailto:' . $info->email . '">' . $info->email . '</a>';
                $sub_array[] = '<a href="tel:' . $info->phone . '">' . $info->phone . '</a>';


                $action .= btn_view_modal('saas/faq/view_faq/' . $info->id) . ' ';
                if (!empty($deleted)) {
                    $action .= ajax_anchor(base_url("saas/faq/delete_email/$info->id"), "<i class='btn btn-xs btn-danger fa fa-trash-o'></i>", array("class" => "", "title" => lang('delete'), "data-fade-out-on-success" => "#table_" . $_key));
                }

                $sub_array[] = $action;
                $data[] = $sub_array;
            }
            render_table($data);
        } else {
            redirect('admin/dashboard');
        }
    }

    // view email
    public function view_faq($id = null, $inline = null)
    {
        $data['title'] = lang('mailbox');

        if (!empty($id)) {
            $data['email_info'] = $this->saas_model->check_by(array('id' => $id), 'tbl_saas_front_contact_us');

            if ($data['email_info']->view_status != 1) {
                $this->saas_model->_table_name = 'tbl_saas_front_contact_us';
                $this->saas_model->_primary_key = 'id';

                $this->saas_model->save(array('view_status' => 1), $id);
            }
            $view = 'modal_lg';
            $sub = false;
            if (!empty($inline)) {
                $sub = true;
                $view = 'main';
            }
            $data['subview'] = $this->load->view('saas/faq/preview', $data, $sub);
            $this->load->view('admin/_layout_' . $view, $data);
        } else {
            redirect('saas/faq');
        }
    }


    // delete email
    public function delete_faq($id = null)
    {
        if ($id) {
            $email_info = $this->saas_model->check_by(array('id' => $id), 'tbl_saas_front_contact_us');
            $activities = array(
                'user' => $this->session->userdata('user_id'),
                'module' => 'faq',
                'module_field_id' => $this->session->userdata('user_id'),
                'activity' => ('activity_deleted_faq'),
                'icon' => 'fa-user',
                'value1' => $email_info->name
            );

            $this->saas_model->_table_name = 'tbl_activities';
            $this->saas_model->_primary_key = "activities_id";
            $this->saas_model->save($activities);

            // deletre into tbl_saas_front_contact_us details by id
            $this->saas_model->_table_name = 'tbl_saas_front_contact_us';
            $this->saas_model->_primary_key = 'id';
            $this->saas_model->delete($id);

            // messages for user
            $type = "success";
            $message = lang('delete') . " " . lang('email');
        } else {
            $type = "error";
            $message = lang('no_permission');
        }
        $type = "success";
        echo json_encode(array("status" => $type, 'message' => $message));
        exit();
    }

}