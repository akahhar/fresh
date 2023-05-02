<?php
defined('BASEPATH') or exit('No direct script access allowed');
$CI = &get_instance();
$CI->db->query("INSERT IGNORE INTO `tbl_online_payment` ( `gateway_name`, `icon`, `field_1`, `field_2`, `field_3`, `field_4`, `field_5`, `link`, `modal`)
VALUES ('Pespal', 'modules/pespal/assets/pespal.png', 'pespal_consumer_key', 'pespal_consumer_secret', 'pespal_test_mode|checkbox', NULL, NULL, 'pespal', 'No');");
$CI->db->query("ALTER TABLE `tbl_invoices` ADD `allow_pespal` ENUM('Yes','No') NULL DEFAULT NULL");


