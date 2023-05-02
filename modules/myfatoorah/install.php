<?php defined('BASEPATH') or exit('No direct script access allowed');
$CI = &get_instance();
$CI->db->query("INSERT INTO `tbl_online_payment` (`online_payment_id`, `gateway_name`, `icon`, `field_1`, `field_2`, `field_3`, `field_4`, `field_5`, `link`, `modal`) 
VALUES (NULL, 'myfatoorah', 'modules/myfatoorah/assets/myfatoorah.jpeg', 'myfatoorah_apikey|textarea', 'myfatoorah_test_mode|checkbox', NULL, NULL, NULL, 'myfatoorah', 'No');");
$CI->db->query("ALTER TABLE `tbl_invoices` ADD `allow_myfatoorah` ENUM('Yes','No') NULL DEFAULT NULL;");
