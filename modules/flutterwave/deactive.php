<?php defined('BASEPATH') or exit('No direct script access allowed');
$CI = &get_instance();
$CI->db->query("UPDATE `tbl_config` SET `value` = 'deactive' WHERE `tbl_config`.`config_key` = 'flutterwave_secret_key';");

