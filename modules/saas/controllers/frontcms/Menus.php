<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Menus extends Gb_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('imageResize');
        $this->load->model('cms_menu_model');
        $this->load->model('saas_model');
    }

    function index($id = null)
    {
        $data['title'] = lang('menus');
        $edited = super_admin_access('menu', 'edited');
        if (!empty($id) && !empty($edited)) {
            $data['menu_info'] = get_row('tbl_saas_front_menus', array('id' => $id));
        } else {
            $data['all_menu'] = get_result('tbl_saas_front_menus');
        }
        $data['subview'] = $this->load->view('frontcms/menus/index', $data, TRUE);
        $this->load->view('_layout_main', $data);
    }

    public function add_menu()
    {
        $data['title'] = lang('new') . ' ' . lang('menu'); //Page title
        $data['subview'] = $this->load->view('frontcms/menus/add_menu', $data, FALSE);
        $this->load->view('admin/_layout_modal_lg', $data); //page load
    }

    public function menu_list()
    {
        if ($this->input->is_ajax_request()) {
            $this->load->model('datatables');
            $this->datatables->table = 'tbl_saas_front_menus';
            $this->datatables->column_search = array('menu');
            $this->datatables->order = array('id' => 'asc');
            $fetch_data = make_datatables();

            $data = array();
            $edited = super_admin_access('menu', 'edited');
            $deleted = super_admin_access('menu', 'deleted');
            foreach ($fetch_data as $_key => $menus) {
                $action = null;
                $sub_array = array();
                $sub_array[] = $menus->menu;
                if (!empty($edited)) {
                    $action .= btn_save('saas/frontcms/menus/add_menu_item/' . $menus->slug) . ' ';
                }
                if (!empty($deleted) && $menus->content_type != "default") {
                    $action .= ajax_anchor(base_url("saas/frontcms/menus/delete_menu/$menus->id"), "<i class='btn btn-xs btn-danger fa fa-trash-o'></i>", array("class" => "", "title" => lang('delete'), "data-fade-out-on-success" => "#table_" . $_key));
                }

                $sub_array[] = $action;
                $data[] = $sub_array;
            }
            render_table($data);
        } else {
            redirect('admin/dashboard');
        }
    }

    // save menu
    public function save_menu()
    {
        $created = super_admin_access('menu', 'created');
        if (!empty($created)) {
            $this->cms_menu_model->_table_name = 'tbl_saas_front_menus';
            $this->cms_menu_model->_primary_key = 'id';
            $data = $this->cms_menu_model->array_from_post(array('menu', 'description'));
            $config = array(
                'field' => 'slug',
                'title' => 'menu',
                'table' => 'tbl_saas_front_menus',
                'id' => 'id',
            );
            $this->load->library('slug', $config);
            $data['slug'] = $this->slug->create_uri($data);
            $where = array('slug' => $data['slug']);
            if (!empty($id)) { // if id exist in db update data
                $account_id = array('id !=' => $id);
            } else { // if id is not exist then set id as null
                $account_id = null;
            }
            $check_account = $this->cms_menu_model->check_update('tbl_saas_front_menus', $where, $account_id);
            if (!empty($check_account)) { // if input data already exist show error alert
                $type = 'error';
                $message = "<strong class='text-danger'>" . $data['slug'] . '</strong>  ' . lang('already_exist');
            } else { // save and update query
                $return_id = $this->cms_menu_model->save($data);
                $activity = array(
                    'user' => $this->session->userdata('user_id'),
                    'module' => 'menus',
                    'module_field_id' => $return_id,
                    'activity' => 'save_front_menu',
                    'icon' => 'fa-circle-o',
                    'value1' => $data['menu']
                );
                $this->cms_menu_model->_table_name = 'tbl_activities';
                $this->cms_menu_model->_primary_key = 'activities_id';
                $this->cms_menu_model->save($activity);
                $type = "success";
                $message = lang('save') . ' ' . lang('menu');
            }
        } else {
            $type = "error";
            $message = lang('there_is_no_permission');
        }
        set_message($type, $message);
        redirect('saas/frontcms/menus');
    }

    // add menu item
    public function add_menu_item($slug = null, $item_slug = null)
    {
        $edited = super_admin_access('menu', 'edited');
        if (!empty($edited)) {
            $data['title'] = lang('menu'); //Page title
            $data['page_list'] = get_result('tbl_saas_front_pages');
            $data['menu_info'] = get_row('tbl_saas_front_menus', array('slug' => $slug));
            $data['dropdown_menu_list'] = $this->cms_menu_model->getMenus($data['menu_info']->id);
            if (!empty($item_slug)) {
                $data['menu_item'] = get_row('tbl_saas_front_menu_items', array('slug' => $item_slug));
            }
            if (!empty($slug) && isset($_POST['submit'])) {
                $data = $this->cms_menu_model->array_from_post(array('menu_id', 'page_id', 'menu', 'ext_url', 'open_new_tab'));
                $config = array(
                    'field' => 'slug',
                    'title' => 'menu',
                    'table' => 'tbl_saas_front_menu_items',
                    'id' => 'id',
                );
                $this->load->library('slug', $config);
                if ($this->input->post('ext_url')) {
                    $data['ext_url_link'] = $this->input->post('ext_url_link');
                } else {
                    $data['ext_url_link'] = null;
                }
                $data['slug'] = $this->slug->create_uri($data);
                $this->cms_menu_model->_table_name = 'tbl_saas_front_menu_items';
                $this->cms_menu_model->_primary_key = 'id';

                $item_id = $this->input->post('item_id');
                if (!empty($item_id) && isset($_POST['submit'])) {
                    $edited = super_admin_access('menu', 'edited');
                    if (!empty($edited)) {
                        $id = $this->cms_menu_model->save($data, $item_id);
                        $action = "update_menu_item";
                        $msg = lang('update_menu_item');
                    }
                } else {
                    $id = $this->cms_menu_model->save($data);
                    $action = 'save_menu_item';
                    $msg = lang('save_menu_item');
                }
                // activity
                $activity = array(
                    'user' => $this->session->userdata('user_id'),
                    'module' => 'pages',
                    'module_field_id' => $id,
                    'activity' => $action,
                    'icon' => 'fa-circle-o',
                    'value1' => $data['menu']
                );
                $this->cms_menu_model->_table_name = 'tbl_activities';
                $this->cms_menu_model->_primary_key = 'activities_id';
                $this->cms_menu_model->save($activity);


                $type = "success";
                $message = $msg;
                set_message($type, $message);
                redirect('saas/frontcms/menus/add_menu_item/' . $slug);
            }
            $data['subview'] = $this->load->view('frontcms/menus/add_menu_item', $data, TRUE);
            $this->load->view('_layout_main', $data);
        } else {
            $type = "error";
            $message = lang('there_is_no_permission');
            set_message($type, $message);
            redirect('saas/frontcms/menus');
        }
    }

    // sort menu
    public function sort_menu()
    {
        $order = $this->input->post('order');
        $weight = 1;
        $array = array();
        foreach ($order as $o_key => $o_value) {
            $array[] = array(
                'id' => $o_value['id'],
                'parent_id' => 0,
                'weight' => $weight
            );
            if (isset($o_value['children'])) {
                $weight++;
                foreach ($o_value['children'] as $key => $value) {
                    $array[] = array(
                        'id' => $value['id'],
                        'parent_id' => $o_value['id'],
                        'weight' => $weight
                    );
                    $weight++;
                }
            }
            $weight++;
        }
        $this->cms_menu_model->_table_name = 'tbl_saas_front_menu_items';
        $this->cms_menu_model->save_batch($array, 'id');
    }

    // delete menu
    public function delete_menu($id = null)
    {
        $deleted = super_admin_access('menu', 'deleted');
        if (!empty($id) && !empty($deleted)) {
            $menu_info = $this->cms_menu_model->check_by(array('id' => $id), 'tbl_saas_front_menus');
            $activity = array(
                'user' => $this->session->userdata('user_id'),
                'module' => 'menus',
                'module_field_id' => $id,
                'activity' => "delete_menu",
                'icon' => 'fa-circle-o',
                'value1' => $menu_info->menu
            );
            $this->cms_menu_model->_table_name = 'tbl_activities';
            $this->cms_menu_model->_primary_key = 'activities_id';
            $this->cms_menu_model->save($activity);


            $this->cms_menu_model->_table_name = 'tbl_saas_front_menus';
            $this->cms_menu_model->_primary_key = 'id';
            $this->cms_menu_model->delete($id);
            // messages for user
            $type = "success";
            $message = lang('delete') . ' ' . lang('menu');
        } else {
            $type = "error";
            $message = lang('no_permission');
        }
        echo json_encode(array("status" => $type, 'message' => $message));
        exit();
    }

    // delete menu item
    public function delete_menu_item()
    {
        $id = $this->input->post('id');
        if (!empty($id)) {
            $item_info = $this->cms_menu_model->check_by(array('id' => $id), 'tbl_saas_front_menu_items');
            $activity = array(
                'user' => $this->session->userdata('user_id'),
                'module' => 'menus',
                'module_field_id' => $id,
                'activity' => "delete_menu_item",
                'icon' => 'fa-circle-o',
                'value1' => $item_info->menu
            );
            $this->cms_menu_model->_table_name = 'tbl_activities';
            $this->cms_menu_model->_primary_key = 'activities_id';
            $this->cms_menu_model->save($activity);

            $this->cms_menu_model->_table_name = 'tbl_saas_front_menu_items';
            $this->cms_menu_model->_primary_key = 'id';
            $this->cms_menu_model->delete($id);

            $type = "success";
            $message = lang('delete') . ' ' . lang('menu');
        } else {
            $type = "error";
            $message = lang('no_permission');
        }
        $data['status'] = $type;
        $data['msg'] = $message;
        echo json_encode($data);
        exit();
    }
}
