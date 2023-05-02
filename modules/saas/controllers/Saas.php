<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Saas extends Gb_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('saas_model');
        saas_access();
    }

    public function index()
    {

        $data['title'] = 'Dashboard';
        $data['breadcrumbs'] = 'Dashboard';
        $data['plan_overview'] = $this->get_package_overview();
        $data['subview'] = $this->load->view('saas', $data, true);
        $this->load->view('_layout_main', $data);
    }

    public function get_package_overview()
    {
        $frontend_pricing = get_result('tbl_saas_packages', array('status' => 'published'));
        if (!empty($frontend_pricing)) {
            foreach ($frontend_pricing as $v_pricing) {
                $result[$v_pricing->name]['pending'] = total_rows('tbl_saas_companies', array('status' => 'pending', 'package_id' => $v_pricing->id));
                $result[$v_pricing->name]['running'] = total_rows('tbl_saas_companies', array('status' => 'running', 'package_id' => $v_pricing->id));
                $result[$v_pricing->name]['expired'] = total_rows('tbl_saas_companies', array('status' => 'expired', 'package_id' => $v_pricing->id));
                $result[$v_pricing->name]['suspended'] = total_rows('tbl_saas_companies', array('status' => 'suspended', 'package_id' => $v_pricing->id));
                $result[$v_pricing->name]['terminated'] = total_rows('tbl_saas_companies', array('status' => 'terminated', 'package_id' => $v_pricing->id));
            }
            return $result;
        }
    }
}
