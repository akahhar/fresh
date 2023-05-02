<?php
defined('BASEPATH') or exit('No direct script access allowed');

$CI = &get_instance();
$CI->db->query(
    "INSERT INTO `tbl_menu` (`menu_id`, `label`, `link`, `icon`, `parent`, `sort`, `time`, `status`)
  VALUES (NULL, 'quickbooks', 'admin/quickbooks', 'fa fa-refresh', '0', '3', CURRENT_TIMESTAMP, '1');"
);


$CI->db->query("ALTER TABLE `tbl_client` ADD  `host` VARCHAR(100) DEFAULT  ''");
$CI->db->query("UPDATE `tbl_client` SET `host` = 'system' WHERE host = ''");
$CI->db->query("ALTER TABLE `tbl_client` ADD  `remote_contact_id` VARCHAR(224)  DEFAULT  NULL");

$CI->db->query("ALTER TABLE `tbl_suppliers` ADD  `host` VARCHAR(100) DEFAULT  ''");
$CI->db->query("UPDATE `tbl_suppliers` SET `host` = 'system' WHERE host = ''");
$CI->db->query("ALTER TABLE `tbl_suppliers` ADD  `remote_contact_id`  VARCHAR(224)  DEFAULT  NULL");


$CI->db->query("ALTER TABLE `tbl_invoices` ADD  `host` VARCHAR(100) DEFAULT  ''");
$CI->db->query("UPDATE `tbl_invoices` SET `host` = 'system' WHERE host = ''");
$CI->db->query("ALTER TABLE `tbl_invoices` ADD  `remote_invoice_id` VARCHAR(224)  DEFAULT  NULL");
$CI->db->query("ALTER TABLE `tbl_invoices` ADD  `remote_client_id` VARCHAR(224)  DEFAULT  NULL");
$CI->db->query("ALTER TABLE `tbl_invoices` DROP INDEX IF EXISTS `reference_no`");
$CI->db->query("ALTER TABLE `tbl_invoices` ADD UNIQUE  `remote_invoice_key` USING HASH(`host`, `remote_invoice_id`)");

$CI->db->query("ALTER TABLE `tbl_saved_items` ADD  `host` VARCHAR(100) DEFAULT ''");
$CI->db->query("UPDATE `tbl_saved_items` SET `host` = 'system' WHERE host = ''");
$CI->db->query("ALTER TABLE `tbl_saved_items` ADD  `remote_item_id` VARCHAR(224)  DEFAULT  NULL");


$CI->db->query("ALTER TABLE `tbl_items` ADD  `host` VARCHAR(100) DEFAULT ''");
$CI->db->query("UPDATE `tbl_items` SET `host` = 'system' WHERE host = ''");
$CI->db->query("ALTER TABLE `tbl_items` ADD  `remote_item_id` VARCHAR(224)  DEFAULT  NULL");
$CI->db->query("ALTER TABLE `tbl_items` ADD  `remote_invoice_id` VARCHAR(224) DEFAULT NULL");

$CI->db->query("ALTER TABLE `tbl_payments` ADD  `host` VARCHAR(100) DEFAULT ''");
$CI->db->query("UPDATE `tbl_payments` SET `host` = 'system' WHERE host = ''");
$CI->db->query("ALTER TABLE `tbl_payments` ADD  `remote_payment_id` VARCHAR(224)  DEFAULT  NULL");
$CI->db->query("ALTER TABLE `tbl_payments` ADD  `remote_invoice_id` VARCHAR(224) DEFAULT NULL");
$CI->db->query("ALTER TABLE `tbl_payments` ADD  `remote_contact_id` VARCHAR(224) DEFAULT NULL");
$CI->db->query("ALTER TABLE `tbl_payments` ADD  `remote_account_id` VARCHAR(224) DEFAULT NULL");
$CI->db->query("ALTER TABLE `tbl_payments` ADD UNIQUE  `remote_payment_key`(`host`, `remote_payment_id`)");


$CI->db->query("ALTER TABLE `tbl_purchases` ADD  `host` VARCHAR(100) DEFAULT  ''");
$CI->db->query("UPDATE `tbl_purchases` SET `host` = 'system' WHERE host = ''");
$CI->db->query("ALTER TABLE `tbl_purchases` ADD  `remote_invoice_id` VARCHAR(224)  DEFAULT  NULL");
$CI->db->query("ALTER TABLE `tbl_purchases` ADD  `remote_supplier_id` VARCHAR(224)  DEFAULT  NULL");
$CI->db->query("ALTER TABLE `tbl_purchases` DROP INDEX IF EXISTS `reference_no`");
$CI->db->query("ALTER TABLE `tbl_purchases` ADD UNIQUE  `remote_purchase_key` USING HASH(`host`, `remote_purchase_id`)");

$CI->db->query("ALTER TABLE `tbl_purchase_items` ADD  `host` VARCHAR(100) DEFAULT ''");
$CI->db->query("UPDATE `tbl_purchase_items` SET `host` = 'system' WHERE host = ''");
$CI->db->query("ALTER TABLE `tbl_purchase_items` ADD  `remote_item_id` VARCHAR(224)  DEFAULT  NULL");
$CI->db->query("ALTER TABLE `tbl_purchase_items` ADD  `remote_invoice_id` VARCHAR(224) DEFAULT NULL");


$CI->db->query("ALTER TABLE `tbl_purchase_payments` ADD  `host` VARCHAR(100) DEFAULT ''");
$CI->db->query("UPDATE `tbl_purchase_payments` SET `host` = 'system' WHERE host = ''");
$CI->db->query("ALTER TABLE `tbl_purchase_payments` ADD  `remote_payment_id` VARCHAR(224)  DEFAULT  NULL");
$CI->db->query("ALTER TABLE `tbl_purchase_payments` ADD  `remote_invoice_id` VARCHAR(224) DEFAULT NULL");
$CI->db->query("ALTER TABLE `tbl_purchase_payments` ADD  `remote_contact_id` VARCHAR(224) DEFAULT NULL");
$CI->db->query("ALTER TABLE `tbl_purchase_payments` ADD  `remote_account_id` VARCHAR(224) DEFAULT NULL");
$CI->db->query("ALTER TABLE `tbl_purchase_payments` ADD UNIQUE  `remote_payment_key`(`host`, `remote_payment_id`)");


$CI->db->query("ALTER TABLE `tbl_project` ADD  `host` VARCHAR(100) DEFAULT  ''");
$CI->db->query("UPDATE `tbl_project` SET `host` = 'system' WHERE host = ''");
$CI->db->query("ALTER TABLE `tbl_project` ADD  `remote_project_id` VARCHAR(224)  DEFAULT  NULL");
$CI->db->query("ALTER TABLE `tbl_project` ADD  `remote_contact_id` VARCHAR(224)  DEFAULT  NULL");
$CI->db->query("ALTER TABLE `tbl_project` CHARACTER SET utf8 COLLATE utf8_unicode_ci");
$CI->db->query("ALTER TABLE tbl_project CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci");

$CI->db->query("ALTER TABLE `tbl_transactions` ADD  `host` VARCHAR(100) DEFAULT  ''");
$CI->db->query("UPDATE `tbl_transactions` SET `host` = 'system' WHERE host = ''");
$CI->db->query("ALTER TABLE `tbl_transactions` ADD  `remote_account_id` VARCHAR(224) DEFAULT NULL");
$CI->db->query("ALTER TABLE `tbl_transactions` ADD  `remote_contact_id` VARCHAR(224)  DEFAULT  NULL");
$CI->db->query("ALTER TABLE `tbl_transactions` ADD  `remote_invoice_id` VARCHAR(224)  DEFAULT  NULL");
$CI->db->query("ALTER TABLE `tbl_transactions` ADD UNIQUE `remote_transaction_key` USING HASH(`host`, `type`, `remote_invoice_id`)");



