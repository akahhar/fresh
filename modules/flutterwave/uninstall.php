<?php defined('BASEPATH') or exit('No direct script access allowed');
$CI = &get_instance();
$CI->db->query("DELETE FROM `tbl_online_payment` WHERE `gateway_name` = 'flutterwave'");
$CI->db->query("ALTER TABLE `tbl_invoices` DROP `allow_flutterwave`;");
$CI->db->query("UPDATE `tbl_config` SET `value` = 'deactive' WHERE `tbl_config`.`config_key` = 'flutterwave_secret_key';");
