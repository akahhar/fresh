<?php defined('BASEPATH') or exit('No direct script access allowed');
/*
Module Name: SaaS Module for ZiscoERP
Module ID: 36556984
Module uri: https://codecanyon.net/item/saas-management-for-ziscoerp/36556984
Description: SaaS Module for manging subscriptions and pricing plans for ZiscoERP
Version: 1.0.1
Author: unique_coder
Author uri: https://codecanyon.net/user/unique_coder
Requires at least: 5.0.7
*/
define('SaaS_MODULE', 'saas');
define('DefaultURL', 'http://localhost/SaaSModule/');

$CI = &get_instance();
module_languagesFiles(SaaS_MODULE, ['saas']);
$CI->load->helper(SaaS_MODULE . '/saas');
$CI->config->load(SaaS_MODULE . '/conf');
// get the saas config from the config file
$saas_config = $CI->config->item('installed');
if ($saas_config == true) {
    $CI->load->library(SaaS_MODULE . '/gateways/Saas_payment');
    $gateways = list_files(module_dirPath(SaaS_MODULE) . '/libraries/gateways');
    foreach ($gateways as $gateway) {
        $pathinfo = pathinfo($gateway);
        if ($pathinfo['extension'] == 'php') {
            $gateway = str_replace('.php', '', $gateway);
            $CI->load->library(SaaS_MODULE . '/gateways/' . $gateway);
        }
    }
}

add_action('before_user_login', 'saas_before_user_login');
add_action('before_login_form', 'saas_before_login_form');
add_action('appended_to_my_controller', 'saas_appended_to_my_controller');
add_action('appended_to_gb_controller', 'saas_access');
add_filter('more_exception_uri', 'saas_more_exception_uri');
add_filter('sidebar_menu', 'saas_sidebar_menu');
add_action('before_breadcrumb', 'saas_before_breadcrumb');
add_filter('before_create', 'saas_before_create');
add_filter('filemanager_path', 'saas_filemanager_path');
add_filter('is_saas', 'saas_is_saas');