<?php defined('BASEPATH') or exit('No direct script access allowed');
$CI = &get_instance();
$CI->db->query("DELETE FROM `tbl_menu` WHERE `tbl_menu`.`label` = 'deals'");
$CI->db->query("ALTER TABLE `tbl_calls` DROP `call_type`;");
$CI->db->query("ALTER TABLE `tbl_calls` DROP `duration`;");
$CI->db->query("ALTER TABLE `tbl_customer_group` DROP `order`;");
$CI->db->query("DROP TABLE IF EXISTS `tbl_deals`;");
$CI->db->query("DROP TABLE IF EXISTS `tbl_deals_email`;");
$CI->db->query("DROP TABLE IF EXISTS `tbl_deals_items`;");
$CI->db->query("DROP TABLE IF EXISTS `tbl_deals_pipelines`;");
$CI->db->query("DROP TABLE IF EXISTS `tbl_deals_source`;");

