<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page extends Gb_Controller
{

    function __construct()
    {
        parent::__construct();
        $config = array(
            'field' => 'slug',
            'title' => 'title',
            'table' => 'tbl_saas_front_pages',
            'id' => 'pages_id',
        );
        $this->load->library('slug', $config);
        $this->load->config('thumbnail');
        $this->load->library('imageResize');
        $this->load->model('saas_model');
    }

    public function sync()
    {

        $sync_url = base_url('modules/saas/');
        $replace_url = "http://localhost/client_moumen/modules/saas/";

        $all_frontend_page = get_result('tbl_saas_front_pages');
        if (!empty($all_frontend_page)) {
            foreach ($all_frontend_page as $v_page) {

                $descriptions = $v_page->description;
                $new_descriptions['description'] = str_replace($replace_url, base_url('modules/saas/'), $descriptions);

                // get all client
                $this->saas_model->_table_name = 'tbl_saas_front_pages';
                $this->saas_model->_primary_key = 'pages_id';
                $this->saas_model->save($new_descriptions, $v_page->pages_id);
            }
        }
        $col_1 = str_replace(base_url(), $sync_url, config_item('saas_front_footer_col_1_description'));
        $col_2 = str_replace(base_url(), $sync_url, config_item('saas_front_footer_col_2_description'));
        $col_3 = str_replace(base_url(), $sync_url, config_item('saas_front_footer_col_3_description'));
        $col_4 = str_replace(base_url(), $sync_url, config_item('saas_front_footer_col_4_description'));

        $input_data['saas_front_footer_col_1_description'] = $col_1;
        $input_data['saas_front_footer_col_2_description'] = $col_2;
        $input_data['saas_front_footer_col_3_description'] = $col_3;
        $input_data['saas_front_footer_col_4_description'] = $col_4;
        $input_data['saas_sync_frontend'] = 'Done';
        foreach ($input_data as $key => $value) {
            $data = array('value' => $value);
            $where = array('config_key' => $key);
            $this->db->where($where)->update('tbl_config', $data);
            $exists = $this->db->where($where)->get('tbl_config');
            if ($exists->num_rows() == 0) {
                $this->db->insert('tbl_config', array("config_key" => $key, "value" => $value));
            }
        }
        // messages for user
        $type = "success";
        $message = lang('sync_success');
        set_message($type, $message);
        redirect('saas/frontcms/page');
    }

    function index($pages_id = null)
    {

        $data['title'] = lang('mpage');
        $data['category'] = config_item('pageCategory');
        $edited = super_admin_access('mpage', 'edited');
        if (!empty($pages_id) && !empty($edited)) {
            $data['active'] = 2;
            $data['page_info'] = get_row('tbl_saas_front_pages', array('pages_id' => $pages_id));
        } else {
            $data['active'] = 1;
        }
        $data['all_page'] = get_result('tbl_saas_front_pages');
        $data['subview'] = $this->load->view('frontcms/pages/index', $data, TRUE);
        $this->load->view('_layout_main', $data);
    }

    public function pageList()
    {
        if ($this->input->is_ajax_request()) {
            $this->load->model('datatables');
            $this->datatables->table = 'tbl_saas_front_pages';
            $this->datatables->join_table = array('tbl_saas_front_pages_contents');
            $this->datatables->join_where = array('tbl_saas_front_pages_contents.page_id=tbl_saas_front_pages.pages_id');
            $this->datatables->column_search = array('title', 'tbl_saas_front_pages_contents.content_type');
            $this->datatables->order = array('tbl_saas_front_pages.pages_id' => 'asc');
            $fetch_data = make_datatables();

            $data = array();
            $edited = super_admin_access('mpage', 'edited');
            $deleted = super_admin_access('mpage', 'deleted');

            foreach ($fetch_data as $_key => $pages) {
                $action = null;
                $sub_array = array();

                $sub_array[] = $pages->title;
                $sub_array[] = '<a target="_blank" href="' . base_url() . $pages->url . '">' . base_url() . $pages->url . '<a>';

                if ($pages->content_type == "gallery") {
                    $sub_array[] = '<span class="label label-green">' . $pages->content_type . '</span>';
                } elseif ($pages->content_type == "events") {
                    $sub_array[] = '<span class="label label-info">' . $pages->content_type . '</span>';
                } elseif ($pages->content_type == "notice") {
                    $sub_array[] = '<span class="label label-warning">' . $pages->content_type . '</span>';
                } else {
                    $sub_array[] = '<span class="label label-default">' . lang("standard") . '</span>';
                }

                if (!empty($edited)) {
                    $action .= btn_edit('saas/frontcms/page/index/' . $pages->pages_id) . ' ';
                }
                if (!empty($deleted) && $pages->page_type != "default") {
                    $action .= ajax_anchor(base_url("saas/frontcms/page/delete_page/$pages->pages_id"), "<i class='btn btn-xs btn-danger fa fa-trash'></i>", array("class" => "", "title" => lang('delete'), "data-fade-out-on-success" => "#table_" . $_key));
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
        $created = super_admin_access('mpage', 'created');
        $edited = super_admin_access('mpage', 'edited');
        if (!empty($created) || !empty($edited) && !empty($id)) {
            $this->saas_model->_table_name = 'tbl_saas_front_pages';
            $this->saas_model->_primary_key = 'pages_id';
            $data = $this->saas_model->array_from_post(array('title'));
            $data['description'] = $this->input->post('description');
            $data['type'] = 'page';
            $data['slug'] = $this->slug->create_uri($data, $id);
            $data['url'] = 'frontcms/' . $data['slug'];
            if (!empty($id)) {
                $action = 'activity_update_pages';
                $msg = lang('update') . ' ' . lang('page');
            } else {
                $action = 'activity_save_page';
                $msg = lang('save') . ' ' . lang('page');
            }
            $id = $this->saas_model->save($data, $id);
            $category = $this->input->post('content_category');

            if (!empty($category)) {
                if ($category != "standard") {

                    $data = array();
                    $data["page_id"] = $id;
                    $data["content_type"] = $category;
                    $this->saas_model->_table_name = 'tbl_saas_front_pages_contents';
                    $this->saas_model->_primary_key = 'id';
                    $page_type = get_row('tbl_saas_front_pages_contents', array('page_id' => $id));
                    $page_contents_id = null;
                    if (!empty($page_type)) {
                        $page_contents_id = $page_type->id;
                    }
                    $this->saas_model->save($data, $page_contents_id);
                }
            }

            $activity = array(
                'user' => $this->session->userdata('user_id'),
                'module' => 'pages',
                'module_field_id' => $id,
                'activity' => $action,
                'icon' => 'fa-circle-o',
                'value1' => (!empty($data['title']) ? $data['title'] : ''),
            );
            $this->saas_model->_table_name = 'tbl_activities';
            $this->saas_model->_primary_key = 'activities_id';
            $this->saas_model->save($activity);
            // messages for user
            $type = "success";
            $message = $msg;
            set_message($type, $message);
        } else {
            set_message('error', lang('there_in_no_value'));
        }
        redirect('saas/frontcms/page');
    }

    public function delete_page($id = null)
    {
        $deleted = super_admin_access('mpage', 'deleted');
        if (!empty($id) && !empty($deleted)) {
            $page_info = $this->saas_model->check_by(array('pages_id' => $id), 'tbl_saas_front_pages');
            $activities = array(
                'user' => $this->session->userdata('user_id'),
                'module' => 'saas_model',
                'module_field_id' => $this->session->userdata('user_id'),
                'activity' => ('activity_deleted_page'),
                'icon' => 'fa-user',
                'value1' => $page_info->title
            );

            $this->saas_model->_table_name = 'tbl_activities';
            $this->saas_model->_primary_key = "activities_id";
            $this->saas_model->save($activities);

            $this->saas_model->_table_name = 'tbl_saas_front_pages';
            $this->saas_model->_primary_key = 'pages_id';
            $this->saas_model->delete($id);

            $this->saas_model->_table_name = 'tbl_saas_front_pages_contents';
            $this->saas_model->_primary_key = 'page_id';
            $this->saas_model->delete($id);

            $type = "success";
            $message = lang('delete') . " " . lang('page');
        } else {
            $type = "error";
            $message = lang('no_permission');
        }
        echo json_encode(array("status" => $type, "message" => $message));
        exit();
    }

    public function add_image()
    {
        $data['title'] = lang('add') . ' ' . lang('menu'); //Page title
        $data['subview'] = $this->load->view('frontcms/pages/add_image', $data, FALSE);
        $this->load->view('admin/_layout_modal_large', $data); //page load
    }
}
