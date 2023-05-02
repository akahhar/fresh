<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends Gb_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('saas_model');
    }

    public function index()
    {
        $data['title'] = lang('general_settings');
        $data['page'] = lang('settings');
        $data['load_setting'] = 'general';
        $data['subview'] = $this->load->view('frontcms/settings/index', $data, TRUE);
        $this->load->view('_layout_main', $data);
    }

    public function general_settings()
    {
        $input_data = $this->saas_model->array_from_post(array('saas_front_site_name', 'saas_front_slider', 'home_slider_speed'));
        if (!empty($_FILES['saas_front_favicon']['name'])) {
            $val = $this->saas_model->uploadImage('saas_front_favicon', module_direcoty(SaaS_MODULE, 'uploads/'));
            $val == TRUE || redirect('saas/frontcms/settings');
            $input_data['saas_front_favicon'] = $val['path'];
        }
        //favicon Process
        if (!empty($_FILES['saas_front_nav_logo']['name'])) {
            $val = $this->saas_model->uploadImage('saas_front_nav_logo', module_direcoty(SaaS_MODULE, 'uploads/'));
            $val == TRUE || redirect('saas/frontcms/settings');
            $input_data['saas_front_nav_logo'] = $val['path'];
        }

        //header image
        if (!empty($_FILES['saas_front_header_image']['name'])) {
            $val = $this->saas_model->uploadImage('saas_front_header_image', module_direcoty(SaaS_MODULE, 'uploads/'));
            $val == TRUE || redirect('saas/frontcms/settings');
            $input_data['saas_front_header_image'] = $val['path'];
        }

        $this->update_config($input_data);

        $activity = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'settings',
            'module_field_id' => $this->session->userdata('user_id'),
            'activity' => ('activity_save_general_settings'),
            'value1' => $input_data['saas_front_site_name']
        );
        $this->saas_model->_table_name = 'tbl_activities';
        $this->saas_model->_primary_key = 'activities_id';
        $this->saas_model->save($activity);
        // messages for user
        $type = "success";
        $message = lang('save_general_settings');
        set_message($type, $message);
        redirect('saas/frontcms/settings');
    }

    // footer
    public function footer()
    {
        $data['title'] = lang('footer');
        $data['load_setting'] = 'footer';
        $data['subview'] = $this->load->view('frontcms/settings/index', $data, TRUE);
        $this->load->view('_layout_main', $data);
    }

    // save footer
    public function save_footer()
    {
        $input_data = $this->saas_model->array_from_post(array('saas_front_footer_col_1_title', 'saas_front_facebook_link', 'saas_front_twitter_link', 'saas_front_google_link', 'saas_front_linkedin_link', 'saas_front_pinterest_link', 'saas_front_instagram_link', 'saas_front_footer_col_1_description', 'saas_front_footer_col_2_title', 'saas_front_footer_col_2_description', 'saas_front_footer_col_3_title', 'saas_front_footer_col_3_description', 'saas_front_footer_col_4_title', 'saas_front_footer_col_4_description', 'saas_front_copyright_text', 'saas_front_footer_col_bottom_description'));
        if (!empty($_FILES['saas_front_footer_bg']['name'])) {
            $val = $this->saas_model->uploadImage('saas_front_footer_bg', module_direcoty(SaaS_MODULE, 'uploads/'));
            $val == TRUE || redirect('saas/frontcms/settings');
            $input_data['saas_front_footer_bg'] = $val['path'];
        }
        $this->update_config($input_data);

        $activity = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'settings',
            'module_field_id' => $this->session->userdata('user_id'),
            'activity' => ('save_footer_settings'),
            'value1' => 'Footer'
        );
        $this->saas_model->_table_name = 'tbl_activities';
        $this->saas_model->_primary_key = 'activities_id';
        $this->saas_model->save($activity);
        // messages for user
        $type = "success";
        $message = lang('save_general_settings');
        set_message($type, $message);
        redirect('saas/frontcms/settings/footer');
    }

    // pricint
    public function pricing()
    {
        $data['title'] = lang('pricing');
        $data['load_setting'] = 'pricing';

        $data['subview'] = $this->load->view('saas/frontcms/settings/index', $data, TRUE);
        $this->load->view('_layout_main', $data);
    }

    // save footer
    public function save_pricing()
    {
        $input_data = $this->saas_model->array_from_post(array('saas_front_pricing_title', 'saas_front_pricing_description'));

        $this->update_config($input_data);
        $activity = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'settings',
            'module_field_id' => $this->session->userdata('user_id'),
            'activity' => ('save_pricing_settings'),
            'value1' => 'pricing'
        );
        $this->saas_model->_table_name = 'tbl_activities';
        $this->saas_model->_primary_key = 'activities_id';
        $this->saas_model->save($activity);
        // messages for user
        $type = "success";
        $message = lang('save_pricing_settings');
        set_message($type, $message);
        redirect('saas/frontcms/settings/pricing');
    }


    public function contact()
    {
        $data['title'] = lang('contact');
        $data['load_setting'] = 'contact';
        $data['subview'] = $this->load->view('frontcms/settings/index', $data, TRUE);
        $this->load->view('_layout_main', $data);
    }

    public function save_contact()
    {
        $input_data = $this->saas_model->array_from_post(array('saas_front_contact_title', 'saas_front_contact_description', 'saas_front_contact_address', 'saas_front_contact_phone', 'saas_front_contact_email'));

        $this->update_config($input_data);

        $activity = array(
            'user' => $this->session->userdata('user_id'),
            'module' => 'settings',
            'module_field_id' => $this->session->userdata('user_id'),
            'activity' => ('save_contact_settings'),
            'value1' => 'Contact'
        );
        $this->saas_model->_table_name = 'tbl_activities';
        $this->saas_model->_primary_key = 'activities_id';
        $this->saas_model->save($activity);
        // messages for user
        $type = "success";
        $message = lang('save_general_settings');
        set_message($type, $message);
        redirect('saas/frontcms/settings/contact');
    }

    // slider
    public function slider($id = null)
    {
        $data['title'] = lang('slider');
        $data['load_setting'] = 'slider';
        $edited = super_admin_access('slider', 'edited');
        if (!empty($id) && !empty($edited)) {
            $data['active'] = 2;
            $data['slider_info'] = get_row('tbl_saas_front_slider', array('id' => $id));
        } else {
            $data['active'] = 1;
        }
        $data['subview'] = $this->load->view('frontcms/settings/slider', $data, TRUE);
        $this->load->view('_layout_main', $data);
    }

    public function slider_list()
    {
        if ($this->input->is_ajax_request()) {
            $this->load->model('datatables');
            $this->datatables->table = 'tbl_saas_front_slider';
            $this->datatables->column_search = array('title');
            $this->datatables->order = array('id' => 'asc');
            $fetch_data = make_datatables();
            $data = array();
            $edited = super_admin_access('slider', 'edited');
            $deleted = super_admin_access('slider', 'deleted');

            foreach ($fetch_data as $_key => $info) {
                $action = null;
                $sub_array = array();

                $sub_array[] = $info->title;
                $sub_array[] = '<img class="w-210" src="' . base_url() . $info->slider_img . '">';
                $sub_array[] = ($info->description);
                if ($info->status == 1) {
                    $sub_array[] = '<span class="label label-green">' . lang('active') . '</span>';
                } else {
                    $sub_array[] = '<span class="label label-danger">' . lang('deactive') . '</span>';
                }
                if (!empty($edited)) {
                    $action .= btn_edit('saas/frontcms/settings/slider/' . $info->id) . ' ';
                }
                if (!empty($deleted)) {
                    $action .= ajax_anchor(base_url("saas/frontcms/settings/delete_slider/$info->id"), "<i class='btn btn-xs btn-danger fa fa-trash-o'></i>", array("class" => "", "title" => lang('delete'), "data-fade-out-on-success" => "#table_" . $_key));
                }
                $sub_array[] = $action;
                $data[] = $sub_array;
            }
            render_table($data);
        } else {
            redirect('admin/dashboard');
        }
    }

    public function save_slider($id = null)
    {
        $created = super_admin_access('slider', 'created');
        $edited = super_admin_access('slider', 'edited');
        if (!empty($created) || !empty($edited) && !empty($id)) {
            $data = $this->saas_model->array_from_post(array('title', 'subtitle', 'description', 'button_icon_1', 'button_icon_1', 'button_text_1', 'button_link_1', 'button_text_2', 'button_link_2', 'status'));
            if (!empty($_FILES['slider_bg']['name'])) {
                $val = $this->saas_model->uploadImage('slider_bg', module_direcoty(SaaS_MODULE, 'uploads/'));
                $val == TRUE || redirect('saas/frontcms/settings/slider');
                $data['slider_bg'] = $val['path'];
            }

            if (!empty($_FILES['slider_img']['name'])) {
                $val = $this->saas_model->uploadImage('slider_img', module_direcoty(SaaS_MODULE, 'uploads/'));
                $val == TRUE || redirect('saas/frontcms/settings/slider');
                $data['slider_img'] = $val['path'];
            }
            $this->saas_model->_table_name = "tbl_saas_front_slider"; // table name
            $this->saas_model->_primary_key = "id"; // $id
            $this->saas_model->save($data, $id);

            if (!empty($id)) {
                $activity = 'update_slider';
                $msg = lang($activity);
            } else {
                $activity = 'save_slider';
                $msg = lang($activity);
            }
            $activity = array(
                'user' => $this->session->userdata('user_id'),
                'module' => 'settings',
                'module_field_id' => $this->session->userdata('user_id'),
                'activity' => $activity,
                'value1' => $data['title']
            );
            $this->saas_model->_table_name = 'tbl_activities';
            $this->saas_model->_primary_key = 'activities_id';
            $this->saas_model->save($activity);

            // messages for user
            $type = "success";
            $message = $msg;
        } else {
            $type = "error";
            $message = lang('there_is_no_permission');
        }
        set_message($type, $message);
        redirect('saas/frontcms/settings/slider');
    }

    public function delete_slider($id = null)
    {
        $deleted = super_admin_access('slider', 'deleted');
        if (!empty($id) && !empty($deleted)) {
            $slider_info = $this->saas_model->check_by(array('id' => $id), 'tbl_saas_front_slider');
            $activities = array(
                'user' => $this->session->userdata('user_id'),
                'module' => 'settings',
                'module_field_id' => $this->session->userdata('user_id'),
                'activity' => ('activity_deleted_page'),
                'icon' => 'fa-user',
                'value1' => $slider_info->title
            );
            $this->saas_model->_table_name = 'tbl_activities';
            $this->saas_model->_primary_key = "activities_id";
            $this->saas_model->save($activities);

            $this->saas_model->_table_name = 'tbl_saas_front_slider';
            $this->saas_model->_primary_key = 'id';
            $this->saas_model->delete($id);

            if (is_file($slider_info->slider)) {
                unlink($slider_info->slider);
            }

            // messages for user
            $type = "success";
            $message = lang('delete') . " " . lang('slider');
        } else {
            $type = "error";
            $message = lang('no_permission');
        }
        echo json_encode(array("status" => $type, 'message' => $message));
        exit();
    }

    private
    function update_config($input_data)
    {
        if (!empty($input_data)) {
            foreach ($input_data as $key => $value) {
                $where = array('config_key' => $key);
                if (strtolower($value) == 'on') {
                    $value = 'TRUE';
                } elseif (strtolower($value) == 'off') {
                    $value = 'FALSE';
                }
                $data = array('value' => $value);
                $this->db->where($where)->update('tbl_config', $data);
                $exists = $this->db->where($where)->get('tbl_config');
                if ($exists->num_rows() == 0) {
                    $this->db->insert('tbl_config', array("config_key" => $key, "value" => $value));
                }
            }
        }
        return true;
    }
}
