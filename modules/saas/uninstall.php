<?php defined('BASEPATH') or exit('No direct script access allowed');
$CI = &get_instance();
if (!empty(is_subdomain())) {
    redirect('admin/dashboard');
}
// Delete the all the tables which prefix is tbl_saas_ by query
$CI->db->query("DROP TABLE IF EXISTS `tbl_saas_applied_coupon`");
$CI->db->query("DROP TABLE IF EXISTS `tbl_saas_companies`");
$CI->db->query("DROP TABLE IF EXISTS `tbl_saas_companies_history`");
$CI->db->query("DROP TABLE IF EXISTS `tbl_saas_companies_payment`");
$CI->db->query("DROP TABLE IF EXISTS `tbl_saas_coupon`");
$CI->db->query("DROP TABLE IF EXISTS `tbl_saas_front_cms_media`");
$CI->db->query("DROP TABLE IF EXISTS `tbl_saas_front_contact_us`");
$CI->db->query("DROP TABLE IF EXISTS `tbl_saas_front_menus`");
$CI->db->query("DROP TABLE IF EXISTS `tbl_saas_front_menu_items`");
$CI->db->query("DROP TABLE IF EXISTS `tbl_saas_front_pages`");
$CI->db->query("DROP TABLE IF EXISTS `tbl_saas_front_pages_contents`");
$CI->db->query("DROP TABLE IF EXISTS `tbl_saas_front_slider`");
$CI->db->query("DROP TABLE IF EXISTS `tbl_saas_menu`");
$CI->db->query("DROP TABLE IF EXISTS `tbl_saas_package_field`");
$CI->db->query("DROP TABLE IF EXISTS `tbl_saas_package_field`");
$CI->db->query("INSERT INTO `tbl_menu` (`menu_id`, `label`, `link`, `icon`, `parent`, `sort`, `status`) VALUES (137, 'translations', 'admin/settings/translations', 'fa fa-fw fa-language', '25', '36', '2')");



