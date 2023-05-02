<?php defined('BASEPATH') or exit('No direct script access allowed');
$CI = &get_instance();
$CI->db->query("DELETE FROM `tbl_menu` WHERE `tbl_menu`.`label` = 'shift_management'");
$CI->db->query("DELETE FROM `tbl_menu` WHERE `tbl_menu`.`label` = 'shift_mapping'");
$CI->db->query("DELETE FROM `tbl_menu` WHERE `tbl_menu`.`label` = 'manage_shift'");
$CI->db->query("DELETE FROM `tbl_menu` WHERE `tbl_menu`.`link` = 'admin/shift'");
