<?php
defined('BASEPATH') or exit('No direct script access allowed');
$CI = &get_instance();
$CI->db->query("INSERT INTO `tbl_menu` (`menu_id`, `label`, `link`, `icon`, `parent`, `sort`, `time`, `status`) VALUES (NULL, 'deals', 'admin/deals', 'fa fa-file-text', '0', '0', current_timestamp(), '1');");
$CI->db->query("ALTER TABLE `tbl_calls` ADD `call_type` VARCHAR(50) NULL DEFAULT NULL AFTER `call_summary`;");
$CI->db->query("ALTER TABLE `tbl_calls` ADD `duration` VARCHAR(50) NULL DEFAULT NULL AFTER `call_type`;");
$CI->db->query("ALTER TABLE `tbl_customer_group` ADD `order` INT(11) NULL DEFAULT NULL AFTER `description`;");

$CI->db->query("CREATE TABLE IF NOT EXISTS `tbl_deals` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(191) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `deal_value` decimal(10,2) NOT NULL DEFAULT '0.00',
  `tags` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `source_id` int DEFAULT NULL,
  `status` varchar(100) DEFAULT 'open',
  `notes` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `pipeline` tinyint DEFAULT NULL,
  `currency` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'USD',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `days_to_close` date DEFAULT NULL,
  `user_id` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `project_id` int DEFAULT NULL,
  `client_id` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `stage_id` int NOT NULL,
  `default_deal_owner` int NOT NULL,
  `convert_to_project` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `lost_reason` text,
  `tax` decimal(18,2) DEFAULT NULL,
  `total_tax` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");
$CI->db->query("CREATE TABLE IF NOT EXISTS `tbl_deals_email` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email_to` varchar(100) DEFAULT NULL,
  `deals_id` int NOT NULL,
  `subject` varchar(230) DEFAULT NULL,
  `message_body` varchar(512) DEFAULT NULL,
  `uploads` varchar(512) DEFAULT NULL,
  `user_id` int NOT NULL,
  `files` text NOT NULL,
  `uploaded_path` text NOT NULL,
  `file_name` text NOT NULL,
  `size` int NOT NULL,
  `ext` varchar(100) NOT NULL,
  `is_image` int NOT NULL,
  `message_time` datetime NOT NULL,
  `attach_file` text,
  `email_from` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$CI->db->query("CREATE TABLE IF NOT EXISTS `tbl_deals_items` (
  `items_id` int NOT NULL AUTO_INCREMENT,
  `deals_id` int NOT NULL,
  `tax_rates_id` text,
  `item_tax_rate` decimal(18,2) NOT NULL DEFAULT '0.00',
  `item_tax_name` text,
  `item_tax_total` decimal(18,2) NOT NULL DEFAULT '0.00',
  `quantity` decimal(18,2) DEFAULT '0.00',
  `total_cost` decimal(18,2) DEFAULT '0.00',
  `item_name` varchar(255) DEFAULT 'Item Name',
  `item_desc` longtext,
  `unit_cost` decimal(18,2) DEFAULT '0.00',
  `order` int DEFAULT '0',
  `date_saved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `unit` varchar(200) DEFAULT NULL,
  `hsn_code` text,
  `saved_items_id` int DEFAULT '0',
  PRIMARY KEY (`items_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");
$CI->db->query("CREATE TABLE IF NOT EXISTS `tbl_deals_pipelines` (
  `pipeline_id` int NOT NULL AUTO_INCREMENT,
  `pipeline_name` varchar(100) NOT NULL,
  `description` varchar(512) DEFAULT NULL,
  `order` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`pipeline_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;");


$CI->db->query("CREATE TABLE IF NOT EXISTS `tbl_deals_source` (
  `source_id` int(11) NOT NULL AUTO_INCREMENT,
  `source_name` varchar(100) NOT NULL,
  PRIMARY KEY (`source_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;");

$CI->db->query("INSERT INTO `tbl_deals_source` (`source_id`, `source_name`) VALUES
(1, 'Facebook'),
(2, 'Google Organic'),
(3, 'Web'),
(4, 'Twitter'),
(5, 'Client Referral'),
(6, 'Youtube'),
(7, 'Mailchimp'),
(8, 'Previous Client'),
(9, 'Email List'),
(10, 'Google Ads');");

