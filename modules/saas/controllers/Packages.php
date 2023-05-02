<?php defined('BASEPATH') or exit('No direct script access allowed');

class Packages extends Gb_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('saas_model');
        saas_access();
    }

    public function index()
    {
        $data['title'] = 'Packages - Make Package';
        $data['active'] = 1;
        $data['subview'] = $this->load->view('packages/manage', $data, true);
        $this->load->view('_layout_main', $data);
    }

    public function packagesList($status = null)
    {
        if ($this->input->is_ajax_request()) {
            $this->load->model('datatables');
            $this->datatables->table = 'tbl_saas_packages';
            $column = array('name', 'trail_period', 'recommended', 'status', 'monthly_price', 'yearly_price', 'quaterly_price');

            $this->datatables->column_order = $column;
            $this->datatables->column_search = $column;
            $this->datatables->order = array('id' => 'desc');
            $where = array();
            if (!empty($status)) {
                $where = array('status' => $status);
            }
            $fetch_data = make_datatables($where);
            $data = array();

            $access = super_admin_access();
            foreach ($fetch_data as $key => $row) {
                $action = null;
                $sub_array = array();
                $name = null;
                $name .= '<a href="' . base_url() . 'package_details/' . $row->id . '" title="' . lang('details') . '" data-toggle="modal" data-target="#myModal">' . $row->name . '</a>  ';
                $sub_array[] = $name;
                $sub_array[] = $row->trial_period . ' ' . lang('days');
                $sub_array[] = package_price($row, 'row');

                $sub_array[] = ($row->recommended == 'Yes') ? '<span class="label label-success">Yes</span>' : '<span class="label label-danger">No</span>';
                $sub_array[] = $row->status == 'published' ? '<span class="label label-success">' . lang('published') . '</span>' : '<span class="label label-danger">' . lang('unpublished') . '</span>';

                if (!empty($access)) {
                    $action .= btn_edit('saas/packages/create/' . $row->id) . ' ';
                }
                $action .= btn_view_modal('package_details/' . $row->id) . ' ';
                if (!empty($access)) {

                    $action .= ajax_anchor(base_url("saas/packages/delete_packages/$row->id"), "<i class='btn btn-xs btn-danger fa fa-trash-o'></i>", array("class" => "", "title" => lang('delete'), "data-fade-out-on-success" => "#table_" . $key));
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

        $data['title'] = 'Packages - Create Package';
        $data['active'] = 2;
        if (!empty($id)) {
            $data['package_info'] = get_row('tbl_saas_packages', array('id' => $id));
            $data['title'] = 'Packages - Edit Package';
        }
        $data['subview'] = $this->load->view('packages/create', $data, true);
        $this->load->view('_layout_main', $data);
    }

    public function save_packages($id = null)
    {

        $data = $this->saas_model->array_from_post(array(
            'name', 'monthly_price', 'yearly_price', 'quarterly_price',
            'employee_no', 'client_no', 'leads_no', 'transactions', 'bank_account_no', 'tasks_no', 'project_no', 'invoice_no', 'trial_period', 'description', 'status'
        ));

        $data['online_payment'] = ($this->input->post('online_payment', true) == 'Yes') ? 'Yes' : 'No';
        $data['calendar'] = ($this->input->post('calendar') == 'Yes') ? 'Yes' : 'No';
        $data['mailbox'] = ($this->input->post('mailbox') == 'Yes') ? 'Yes' : 'No';
        $data['tickets'] = ($this->input->post('tickets') == 'Yes') ? 'Yes' : 'No';
        $data['filemanager'] = ($this->input->post('filemanager') == 'Yes') ? 'Yes' : 'No';
        $data['recruitment'] = ($this->input->post('recruitment') == 'Yes') ? 'Yes' : 'No';
        $data['attendance'] = ($this->input->post('attendance') == 'Yes') ? 'Yes' : 'No';
        $data['payroll'] = ($this->input->post('payroll') == 'Yes') ? 'Yes' : 'No';
        $data['stock_manager'] = ($this->input->post('stock_manager') == 'Yes') ? 'Yes' : 'No';
        $data['leave_management'] = ($this->input->post('leave_management') == 'Yes') ? 'Yes' : 'No';
        $data['performance'] = ($this->input->post('performance') == 'Yes') ? 'Yes' : 'No';
        $data['training'] = ($this->input->post('training') == 'Yes') ? 'Yes' : 'No';
        $data['reports'] = ($this->input->post('reports') == 'Yes') ? 'Yes' : 'No';
        $data['recommended'] = ($this->input->post('recommended') == 'Yes') ? 'Yes' : 'No';

        $all_module = all_module();
        if (!empty($all_module)) {
            foreach ($all_module as $v_module) {
                $name = 'allow_' . $v_module->module_name;
                $data[$name] = ($this->input->post($name, true) == 'Yes') ? 'Yes' : 'No';
            }
        }

        $this->saas_model->_table_name = "tbl_saas_packages"; // table name
        $this->saas_model->_primary_key = "id"; // $id
        if (!empty($id)) { // if id exist in db update data
            $check_id = array('id !=' => $id);
        } else { // if id is not exist then set id as null
            $check_id = null;
        }
        $where = array('recommended' => 'Yes');
        $already_recommended = $this->saas_model->check_update('tbl_saas_packages', $where, $check_id);
        if (!empty($already_recommended)) {
            foreach ($already_recommended as $v_recommended) {
                $udata['recommended'] = 'No';
                $this->saas_model->save($udata, $v_recommended->id);
            }
        }
        if (empty($data['recommended'])) {
            $data['recommended'] = 'No';
        }
        $this->saas_model->save($data, $id);

        set_message('success', lang('update_settings'));
        redirect('saas/packages');
    }


    public function package_details($id)
    {

        $data['title'] = 'Packages - Package Details';
        $data['package'] = get_row('tbl_saas_packages', array('id' => $id));
        $data['subview'] = $this->load->view('packages/package_details', $data, true);
        $this->load->view('_layout_main', $data);
    }


    public function delete_packages($id)
    {

        $this->saas_model->_table_name = 'tbl_saas_packages';
        $this->saas_model->_primary_key = 'id';
        $this->saas_model->delete($id);

        // messages for user
        $type = "success";
        $message = lang('package_deleted');
        set_message($type, $message);
        redirect('saas/packages');
    }


}
