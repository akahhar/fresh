<?php defined('BASEPATH') or exit('No direct script access allowed');
$CI = &get_instance();
$CI->db->query("DELETE FROM `tbl_online_payment` WHERE `tbl_online_payment`.`gateway_name` = 'Iyzipay'");
$CI->db->query("ALTER TABLE `tbl_invoices` DROP `allow_iyzipay`;");
$CI->db->query("UPDATE `tbl_config` SET `value` = 'deactive' WHERE `tbl_config`.`config_key` = 'iyzipay_status';");
