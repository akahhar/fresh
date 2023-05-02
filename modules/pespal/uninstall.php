<?php defined('BASEPATH') or exit('No direct script access allowed');
$CI = &get_instance();
$CI->db->query("DELETE FROM `tbl_online_payment` WHERE `gateway_name` = 'pespal'");
$CI->db->query("ALTER TABLE `tbl_invoices` DROP `allow_pespal`;");
$CI->db->query("DELETE FROM `tbl_config` `tbl_config`.`config_key` = 'pespal_consumer_key'");
$CI->db->query("DELETE FROM `tbl_config` `tbl_config`.`config_key` = 'pespal_consumer_secret'");
// $CI->db->query("UPDATE `tbl_config` SET `value` = 'deactive' WHERE `tbl_config`.`config_key` = 'pespal_consumer_secret'");
