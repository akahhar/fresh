<?php
defined('BASEPATH') or exit('No direct script access allowed');

$CI = &get_instance();
$CI->db->query(
    "INSERT INTO `tbl_menu` (`menu_id`, `label`, `link`, `icon`, `parent`, `sort`, `status`) VALUES (NULL, 'shift_management', '#', 'fa fa-arrows', 0, 3, 1);"
);
$cms_id = get_any_field('tbl_menu', array('label' => 'shift_management'), 'menu_id');
$CI->db->query(
    "INSERT INTO `tbl_menu` (`menu_id`, `label`, `link`, `icon`, `parent`, `sort`, `status`) VALUES (NULL, 'shift_mapping', 'admin/shift/shift_mapping', 'fa fa-shield', $cms_id, '1', '1'), (NULL, 'manage_shift', 'admin/shift/manage', 'fa fa-sitemap', $cms_id, '2', '1'), (NULL, 'dashboard', 'admin/shift', 'fa fa-dashboard', $cms_id, '3', '1');"
);

$CI->db->query("CREATE TABLE IF NOT EXISTS `tbl_shift` (
  `shift_id` int NOT NULL AUTO_INCREMENT,
  `shift_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `start_time` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `end_time` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `shift_before_start` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `shift_after_end` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `lunch_time` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `recurring` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'No',
  `repeat_every` int NOT NULL DEFAULT '0',
  `recurring_type` enum('day','week','month','year') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `is_default` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'No',
  `bg` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`shift_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$CI->db->query("CREATE TABLE IF NOT EXISTS `tbl_shift_mapping` (
  `shift_mapping_id` int NOT NULL AUTO_INCREMENT,
  `shift_id` int NOT NULL,
  `user_id` int NOT NULL,
  `s_user_id` int DEFAULT NULL,
  `start_date` varchar(50) DEFAULT NULL,
  `end_date` varchar(50) DEFAULT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `m_status` int DEFAULT NULL COMMENT '1= drop\r\n3= trade\r\n4 = swap',
  `trade` mediumtext,
  `reason` mediumtext,
  `swap_trade` mediumtext,
  PRIMARY KEY (`shift_mapping_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
