<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('cms_menu_model');
        $this->load->model('cms_menuitems_model');
        $this->load->model('saas_model');
    }

    public function index()
    {
        $data['title'] = config_item('website_name');
        $data['active_menu'] = "home";
        $data['page_info'] = get_row('tbl_saas_front_pages', array('slug' => 'home'));
        $data['subview'] = $this->load->view('frontcms/frontend/index', $data, true);
        $this->load->view('frontcms/_layout_front', $data);
    }

    public function page($slug = null)
    {
        $data['page_info'] = get_row('tbl_saas_front_pages', array('slug' => $slug));
        $data['active_menu'] = $slug;
        if (empty($data['page_info'])) {
            $data['page_info'] = get_row('tbl_saas_front_pages', array('pages_id' => '4'));
        }
        $data['title'] = $data['page_info']->title;
        $data['subview'] = $this->load->view('frontcms/frontend/index', $data, true);
        $this->load->view('frontcms/_layout_front', $data);
    }

    public function save_faq()
    {
        $data = $this->saas_model->array_from_post(array('name', 'email', 'phone', 'subject', 'description'));
        $this->saas_model->_table_name = 'tbl_saas_front_contact_us';
        $this->saas_model->_primary_key = 'id';
        $id = $this->saas_model->save($data);
        if (!empty($id)) {
            $email_template = $this->saas_model->check_by(array('email_group' => 'faq_request_email'), 'tbl_email_templates');
            $message = $email_template->template_body;
            $subject = $email_template->subject;

            $title = str_replace("{NAME}", $data['name'], $message);
            $Link = str_replace("{LINK}", base_url() . 'admin/front/faq/view_faq/' . $id . '/1', $title);
            $message = str_replace("{SITE_NAME}", config_item('company_name'), $Link);
            $data['message'] = $message;
            $message = $this->load->view('email_template', $data, TRUE);

            $params['subject'] = $subject;
            $params['resourceed_file'] = '';
            $params['message'] = $message;
            $all_users = all_admin();
            foreach ($all_users as $v_user) {
                $params['recipient'] = $v_user->email;
                $this->saas_model->send_saas_email($params);
            }
            echo json_encode(array('status' => 'success', 'message' => 'Your message sent. Thanks for contacting. We will Contact you Soon.'));
        } else {
            echo json_encode(array('status' => 'error'));
        }
        exit();
    }
}
