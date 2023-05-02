<?php defined('BASEPATH') or exit('No direct script access allowed');
/*
Module Name: Quickbooks Sync for ZiscorERP
Module ID: 31884927
Module uri: https://codecanyon.net/item/quickbooks-sync-for-ziscorerp/31884927
Description: Quickbooks Sync Management for ZiscoERP
Version: 1.0.1
Author: unique_coder
Author uri: https://codecanyon.net/user/unique_coder
Requires at least: 4.0.2
*/

define('QUICKBOOKS_MODULE', 'quickbooks');

$CI = &get_instance();
module_languagesFiles(QUICKBOOKS_MODULE, ['quickbooks']);

$CI->load->helper(QUICKBOOKS_MODULE . '/quickbooks');
