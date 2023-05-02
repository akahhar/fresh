<?php defined('BASEPATH') or exit('No direct script access allowed');
$CI = &get_instance();
$CI->db->query("DELETE FROM `tbl_online_payment` WHERE `gateway_name` = 'paystack'");
$CI->db->query("ALTER TABLE `tbl_invoices` DROP `allow_paystack`;");
$CI->db->query("UPDATE `tbl_config` SET `value` = 'deactive' WHERE `tbl_config`.`config_key` = 'paystack_status';");
$CI->db->query("DELETE FROM `tbl_config`  WHERE `tbl_config`.`config_key` = 'paystack_secret_key'");
$CI->db->query("DELETE FROM `tbl_config`  WHERE `tbl_config`.`config_key` = 'paystack_public_key'");
