<?php defined('BASEPATH') or exit('No direct script access allowed');
/*
Module Name: ZiscoERP iyzipay gateway
Description: This is ZiscoERP iyzipay gateway
Version: 1.0.1
Author: unique_coder
Requires at least: 2.1.1
*/
define('IYZIPAY_MODULE_NAME', 'iyzipay');

/**
 * Load the module helper
 */
$CI = &get_instance();

/**
 * Register language files, must be registered if the module is using languages
 */
module_languagesFiles(IYZIPAY_MODULE_NAME, [IYZIPAY_MODULE_NAME]);

$CI->load->library(array(IYZIPAY_MODULE_NAME . '/iyzipay/IyzipayBootstrap',IYZIPAY_MODULE_NAME . '/iyzipay_gateway'));
