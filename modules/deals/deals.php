<?php defined('BASEPATH') or exit('No direct script access allowed');
/*
Module Name: Deals Management for ZiscorERP
Module ID: 42561217
Module uri: https://codecanyon.net/item/deals-management-for-ziscorerp/42561217
Description: Deals  Management for ZiscoERP
Version: 1.0.1
Author: unique_coder
Author uri: https://codecanyon.net/user/unique_coder
Requires at least: 6.0.2
*/
define('DEALS_MODULE', 'deals');
$CI = &get_instance();
module_languagesFiles(DEALS_MODULE, ['deals']);
$CI->load->helper(DEALS_MODULE . '/deals');
