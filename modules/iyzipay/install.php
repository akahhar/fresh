<?php defined('BASEPATH') or exit('No direct script access allowed');
$CI = &get_instance();
$exist = get_row('tbl_online_payment', array('gateway_name' => 'Iyzipay'));
if (empty($exist)) {
    $CI->db->query("INSERT INTO `tbl_online_payment` (`online_payment_id`, `gateway_name`, `icon`, `field_1`, `field_2`, `field_3`, `field_4`, `field_5`, `link`, `modal`) VALUES (NULL, 'Iyzipay', 'modules/iyzipay/assets/iyzipay.png', 'Iyzipay_ApiKey', 'Iyzipay_SecretKey', NULL, NULL, NULL, 'iyzipay', 'Yes');");
}
$CI->db->query("ALTER TABLE `tbl_invoices` ADD `allow_iyzipay` ENUM('Yes','No') NULL DEFAULT NULL;");
