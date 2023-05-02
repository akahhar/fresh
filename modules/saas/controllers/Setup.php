<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Setup extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('saas_model');
        $this->load->model('settings_model');
        $this->load->helper('saas');
        // load config name is conf
        $this->load->config('conf');

        $config_data = get_result('tbl_config');
        foreach ($config_data as $v_config_info) {
            $this->config->set_item($v_config_info->config_key, $v_config_info->value);
        }
        $system_lang = $this->admin_model->get_lang();

        $this->config->set_item('language', $system_lang);
        $files = $this->admin_model->all_files();
        $this->lang->load('saas', $system_lang);
        if (!empty($system_lang)) {
            foreach ($files as $file => $altpath) {
                $shortfile = str_replace("_lang.php", "", $file);
                $this->lang->load($shortfile, $system_lang);
            }
        } else {
            foreach ($files as $file => $altpath) {
                $shortfile = str_replace("_lang.php", "", $file);
                $this->lang->load($shortfile, 'english');
            }
        }
        $is_active = $this->saas_model->is_company_active();
        if (!empty($is_active)) {
            redirect('login');
        }
    }

    public function index()
    {
        error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
        ini_set('max_execution_time', 30000);
        $data['title'] = lang('welcome_to') . ' ' . config_item('company_name');
        $data['step'] = 1;
        $email = $this->input->post('email', true);
        // get code from url by get method
        $code = $this->input->get('c', true);
        $domain = $this->input->get('d', true);
        if (!empty($code)) {
            $activation_token = url_decode($code);
        } else {
            $activation_token = $this->input->post('activation_token', true);
        }
        if (!empty($activation_token)) {
            $data['activation_token'] = $activation_token;
            $company_info = get_row('tbl_saas_companies', array('activation_code' => $activation_token));
            if (empty($company_info)) {
                $data['step'] = 1;
                $data['activation_token_error'] = lang('invalid_activation_code');
                $data['error'] = true;
            } else {
                $data['step'] = (!empty($_POST['step'])) ? $_POST['step'] : 1;
                $data['company_info'] = $company_info;
                $data['user_name'] = $company_info->email;
                if (empty($data['error']) && isset($_POST['step']) && $_POST['step'] == 1) {
                    // update company info and set active
                    $finish = $this->input->post('finish', true);
                    if (!empty($finish)) {
                        $this->complete_install($_POST);
                        $data['step'] = 5;
                    } else {
                        $data['step'] = 2;
                        $data['timezones'] = $this->settings_model->timezones();
                    }
                } elseif (isset($data['step']) && $data['step'] == 2) {
                    $data['step'] = 3;
                } elseif (isset($data['step']) && $data['step'] == 3) {
                    $validate_result = $this->validate_email($_POST);
                    if (!empty($validate_result['error'])) {
                        $data['step'] = 3;
                    } else {
                        $data['step'] = 4;
                    }
                } elseif (isset($data['step']) && $data['step'] == 4) {
                    $this->complete_install($_POST);
                    $data['step'] = 5;
                } elseif (isset($data['step']) && $data['step'] == 5) {
                    redirect('login');
                }
            }
        }
        $this->load->view('saas/settings/setup', $data);
    }

    private function complete_install($data)
    {
        $company_info = get_row('tbl_saas_companies', array('activation_code' => $data['activation_token']));
        if (!empty($company_info)) {
            $id = $company_info->id;

            $fresh_db = $data['fresh_database'];
            $fresh_db = (!empty($fresh_db) ? $fresh_db : '');
            $result = $this->saas_model->create_database($id, $fresh_db);
            $c_data['password'] = $this->saas_model->hash((!empty($data['password']) ? $data['password'] : '123456'));
            $c_data['status'] = 'running';
            $this->saas_model->_table_name = 'tbl_saas_companies';
            $this->saas_model->_primary_key = 'id';
            $this->saas_model->save($c_data, $id);

            $this->saas_model->send_welcome_email($id);
            return true;
        } else {
            return false;
        }
    }

    public function validate_email($post_data)
    {
        $config = array();
        // If postmark API is being used
        if ($post_data['use_postmark'] == 'TRUE') {
            $config = array(
                'api_key' => $post_data['postmark_api_key']
            );
            $this->load->library('postmark', $config);
            $this->postmark->from($post_data['postmark_from_address'], $post_data['company_name']);
            $this->postmark->to($post_data['email']);
            $this->postmark->subject('SMTP Setup Testing');
            $this->postmark->message_plain('This is test SMTP email. <br />If you received this message that means that your SMTP settings is Corrects.');
            $this->postmark->message_html('This is test SMTP email. <br />If you received this message that means that your SMTP settings is Corrects.');
            $this->postmark->send();
        } else {
            $config['wordwrap'] = true;
            $config['mailtype'] = "html";
            $config['charset'] = 'utf-8';
            $config['newline'] = "\r\n";
            $config['crlf'] = "\r\n";
            $config['protocol'] = $post_data['protocol'];
            $config['smtp_host'] = $post_data['smtp_host'];
            $config['smtp_port'] = $post_data['smtp_port'];
            $config['smtp_timeout'] = '30';
            $config['smtp_user'] = $post_data['smtp_user'];
            $config['smtp_pass'] = decrypt($post_data['smtp_pass']);
            $config['smtp_crypto'] = $post_data['smtp_encryption'];
            $this->load->library('email', $config);
            $this->email->from($post_data['email'], $post_data['company_name']);
            $this->email->to($post_data['email']);
            $this->email->subject('SMTP Setup Testing');
            $this->email->message('This is test SMTP email. <br />If you received this message that means that your SMTP settings is Corrects.');
            $send = $this->email->send();
            $result['success'] = 1;
            return $result;
        }
    }

    public function check_existing_activation_token_new($activation_token = null, $front = null)
    {
        if (!empty($this->input->post('name', true))) {
            $activation_token = $this->input->post('name', true);
        }
        if (!empty($activation_token)) {
            $check_token = $this->saas_model->check_by(array('activation_code' => $activation_token), 'tbl_saas_companies');
            if (!empty($check_token)) {
                $result['success'] = 1;
                $result['name'] = $check_token->name;
                $result['email'] = $check_token->email;
            } else {
                $result['error'] = lang('we_did_not_found_your_token');
            }
            if (empty($front)) {
                echo json_encode($result);
                exit();
            } else {
                return $result;
            }
        }
    }

    public function domain_not_available()
    {
        $sub_domain = is_subdomain();
        if (!empty($sub_domain)) {
            $domain_available = get_old_result('tbl_saas_companies', array('domain' => $sub_domain));
            if (!empty($domain_available)) {
                redirect(config_item('default_controller'));
            } else {
                $data['title'] = lang('welcome_to') . ' ' . config_item('company_name');
                $this->load->view('saas/settings/domain_not_registered', $data);
            }
        }
    }
}
