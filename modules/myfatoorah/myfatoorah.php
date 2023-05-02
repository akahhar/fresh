<?php defined('BASEPATH') or exit('No direct script access allowed');
/*
Module Name: ZiscoERP myfatoorah gateway
Description: This is ZiscoERP myfatoorah gateway
Version: 1.0.1
Author: unique_coder
Requires at least: 4.0.0
*/
define('FATOO_MODULE_NAME', 'myfatoorah');

/**
 * Load the module helper
 */
$CI = &get_instance();

/**
 * Register language files, must be registered if the module is using languages
 */
module_languagesFiles(FATOO_MODULE_NAME, [FATOO_MODULE_NAME]);
