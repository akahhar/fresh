<?php
defined('BASEPATH') or exit('No direct script access allowed');
$CI = &get_instance();
$CI->db->query("INSERT IGNORE INTO `tbl_online_payment` ( `gateway_name`, `icon`, `field_1`, `field_2`, `field_3`, `field_4`, `field_5`, `link`, `modal`)
VALUES ('Flutterwave', 'modules/flutterwave/assets/flutterwave.png', 'flutterwave_secret_key', 'flutterwave_public_key', NULL, NULL, NULL, 'flutterwave', 'No');");
$CI->db->query("ALTER TABLE `tbl_invoices` ADD `allow_flutterwave` ENUM('Yes','No') NULL DEFAULT NULL");


