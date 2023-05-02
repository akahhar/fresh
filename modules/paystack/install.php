<?php
defined('BASEPATH') or exit('No direct script access allowed');
$CI = &get_instance();
$CI->db->query("INSERT IGNORE INTO `tbl_online_payment` ( `gateway_name`, `icon`, `field_1`, `field_2`, `field_3`, `field_4`, `field_5`, `link`, `modal`)
VALUES ('paystack', 'modules/paystack/assets/paystack.jpeg', 'paystack_secret_key', 'paystack_public_key', NULL, NULL, NULL, 'paystack', 'No');");
$CI->db->query("ALTER TABLE `tbl_invoices` ADD `allow_paystack` ENUM('Yes','No') NULL DEFAULT NULL");


