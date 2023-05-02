<?php
defined('BASEPATH') or exit('No direct script access allowed');


// write the database information to the config file
$CI = &get_instance();
$CI->load->helper('file');
$sample_path = module_dirPath(SaaS_MODULE) . 'config/conf.sample.php';
$config_path = module_dirPath(SaaS_MODULE) . 'config/conf.php';

@chmod($config_path, 0666);
if (@copy($sample_path, $config_path) === false) {
    die('Unable to copy sample config file to config folder . please make sure you have permission to copy conf.sample file');
}


$config_file = file_get_contents($config_path);
$config_file = str_replace("%HOSTNAME%", $CI->db->hostname, $config_file);
$config_file = str_replace("%USERNAME%", $CI->db->username, $config_file);
$config_file = str_replace("%PASSWORD%", $CI->db->password, $config_file);
$config_file = str_replace("%DATABASE%", $CI->db->database, $config_file);
$config_file = str_replace("%DOMAIN%", base_url(), $config_file);
$config_file = str_replace("%installed%", true, $config_file);

if (!$fp = fopen($config_path, 'wb')) {
    die('Unable to write to config file');
}

flock($fp, LOCK_EX);
fwrite($fp, $config_file, strlen($config_file));
flock($fp, LOCK_UN);
fclose($fp);
@chmod($config_path, 0644);


if (config_item('installed') === true) {
    if (!empty(is_subdomain())) {
        redirect('admin/dashboard');
    }
}


$CI->db->query("CREATE TABLE IF NOT EXISTS `tbl_saas_applied_coupon` (
  `id` int NOT NULL AUTO_INCREMENT,
  `discount_amount` varchar(100) DEFAULT NULL,
  `discount_percentage` varchar(100) DEFAULT NULL,
  `coupon_id` int DEFAULT NULL,
  `email` varchar(60) DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `coupon` varchar(50) DEFAULT NULL,
  `applied_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

$CI->db->query("CREATE TABLE IF NOT EXISTS `tbl_saas_companies` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `domain` varchar(250) DEFAULT NULL,
  `status` enum('pending','running','expired','suspended','terminated') DEFAULT 'pending',
  `activation_code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `package_id` int NOT NULL,
  `db_name` varchar(120) DEFAULT NULL,
  `amount` decimal(18,2) NOT NULL DEFAULT '0.00',
  `frequency` enum('monthly','yearly','quarterly') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `trial_period` varchar(20) DEFAULT NULL,
  `is_trial` enum('Yes','No') DEFAULT 'No',
  `expired_date` date DEFAULT NULL,
  `currency` varchar(20) DEFAULT NULL,
  `timezone` varchar(250) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `address` text,
  `remarks` text,
  `maintenance_mode_message` varchar(200) DEFAULT NULL,
  `maintenance_mode` varchar(20) DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int DEFAULT NULL,
  `updated_date` datetime DEFAULT NULL,
  `updated_by` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$CI->db->query("CREATE TABLE IF NOT EXISTS `tbl_saas_companies_history` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `companies_id` int DEFAULT NULL,
  `amount` decimal(25,5) NOT NULL DEFAULT '0.00000',
  `attendance` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `payroll` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `leave_management` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `performance` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `training` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `reports` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ip` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `i_have_read_agree` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'Yes',
  `payment_method` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `frequency` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `validity` date DEFAULT NULL,
  `active` int NOT NULL DEFAULT '1',
  `source` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `package_name` varchar(250) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `employee_no` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `client_no` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `project_no` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `invoice_no` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `leads_no` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `transactions` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `bank_account_no` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `online_payment` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `calendar` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `mailbox` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `live_chat` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tickets` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tasks_no` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `filemanager` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `stock_manager` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `recruitment` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `currency` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `saas_companies_instance_id_foreign` (`companies_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");

$CI->db->query("CREATE TABLE IF NOT EXISTS `tbl_saas_companies_payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `companies_history_id` int DEFAULT NULL,
  `companies_id` int NOT NULL,
  `reference_no` text,
  `transaction_id` text,
  `payment_method` varchar(50) DEFAULT NULL,
  `payment_date` varchar(20) DEFAULT NULL,
  `currency` varchar(20) DEFAULT NULL,
  `subtotal` varchar(50) DEFAULT NULL,
  `discount_percent` varchar(50) DEFAULT NULL,
  `discount_amount` varchar(50) DEFAULT NULL,
  `coupon_code` varchar(50) DEFAULT NULL,
  `total_amount` varchar(50) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$CI->db->query("CREATE TABLE IF NOT EXISTS `tbl_saas_coupon` (
  `id` int NOT NULL AUTO_INCREMENT,
  `package_id` int NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `code` varchar(50) DEFAULT NULL,
  `amount` varchar(50) DEFAULT NULL,
  `type` tinyint(1) DEFAULT '0' COMMENT '0=fixed,1=discount',
  `end_date` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `show_on_pricing` enum('Yes','No') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$CI->db->query("CREATE TABLE IF NOT EXISTS `tbl_saas_front_cms_media` (
  `id` int NOT NULL AUTO_INCREMENT,
  `image` varchar(300) DEFAULT NULL,
  `thumb_path` varchar(300) DEFAULT NULL,
  `dir_path` varchar(300) DEFAULT NULL,
  `img_name` varchar(300) DEFAULT NULL,
  `thumb_name` varchar(300) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `file_type` varchar(100) DEFAULT NULL,
  `file_ext` varchar(50) DEFAULT NULL,
  `file_size` varchar(100) NOT NULL,
  `vid_url` mediumtext NOT NULL,
  `vid_title` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=145 DEFAULT CHARSET=utf8;");
$CI->db->query("INSERT INTO `tbl_saas_front_cms_media` (`id`, `image`, `thumb_path`, `dir_path`, `img_name`, `thumb_name`, `file_type`, `file_ext`, `file_size`, `vid_url`, `vid_title`) VALUES
(127, NULL, 'modules/saas/uploads/', 'modules/saas/uploads/', 'l4.jpg', 'l4.jpg', 'image', 'image/jpg', '98.19', '', ''),
(128, NULL, 'modules/saas/uploads/', 'modules/saas/uploads/', 'l2.jpg', 'l2.jpg', 'image', 'image/jpg', '72.5', '', ''),
(129, NULL, 'modules/saas/uploads/', 'modules/saas/uploads/', 'l1.jpg', 'l1.jpg', 'image', 'image/jpg', '86.27', '', ''),
(130, NULL, 'modules/saas/uploads/', 'modules/saas/uploads/', 'powerfull-features01.png', 'powerfull-features01.png', 'image', 'image/png', '20.75', '', ''),
(131, NULL, 'modules/saas/uploads/', 'modules/saas/uploads/', 'team03.png', 'team03.png', 'image', 'image/jpg', '142.07', '', ''),
(132, NULL, 'modules/saas/uploads/', 'modules/saas/uploads/', 'team02.jpg', 'team02.jpg', 'image', 'image/jpg', '88.26', '', ''),
(133, NULL, 'modules/saas/uploads/', 'modules/saas/uploads/', 'team01.jpg', 'team01.jpg', 'image', 'image/jpg', '69.41', '', ''),
(134, NULL, 'modules/saas/uploads/', 'modules/saas/uploads/', 'slack-3.png', 'slack-3.png', 'image', 'image/png', '27.59', '', ''),
(135, NULL, 'modules/saas/uploads/', 'modules/saas/uploads/', '1.jpg', '1.jpg', 'image', 'image/jpg', '56.14', '', ''),
(136, NULL, 'modules/saas/uploads/', 'modules/saas/uploads/', '1-1.jpg', '1-1.jpg', 'image', 'image/jpg', '62.59', '', ''),
(137, NULL, 'modules/saas/uploads/', 'modules/saas/uploads/', '1-2.jpg', '1-2.jpg', 'image', 'image/jpg', '59.38', '', ''),
(138, NULL, 'modules/saas/uploads/', 'modules/saas/uploads/', 'slack-1.svg', 'slack-1.svg', 'image', 'image/svg+xml', '45.93', '', ''),
(139, NULL, 'modules/saas/uploads/', 'modules/saas/uploads/', 'slack-2.svg', 'slack-2.svg', 'image', 'image/svg+xml', '10.31', '', ''),
(140, NULL, 'modules/saas/uploads/', 'modules/saas/uploads/', 'icon1.png', 'icon1.png', 'image', 'image/png', '0.72', '', ''),
(141, NULL, 'modules/saas/uploads/', 'modules/saas/uploads/', 'blog03.jpg', 'blog03.jpg', 'image', 'image/jpg', '120.05', '', ''),
(142, NULL, 'modules/saas/uploads/', 'modules/saas/uploads/', 'blog02.jpg', 'blog02.jpg', 'image', 'image/jpg', '180.06', '', ''),
(143, NULL, 'modules/saas/uploads/', 'modules/saas/uploads/', 'blog01.jpg', 'blog01.jpg', 'image', 'image/jpg', '150.62', '', ''),
(144, NULL, 'modules/saas/uploads/', 'modules/saas/uploads/', 'Zisco-banner-5.png', 'Zisco-banner-5.png', 'image', 'image/png', '72.9', '', '');");
$CI->db->query("CREATE TABLE IF NOT EXISTS `tbl_saas_front_contact_us` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `phone` varchar(22) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `subject` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `view_status` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;");
$CI->db->query("CREATE TABLE IF NOT EXISTS `tbl_saas_front_menus` (
  `id` int NOT NULL AUTO_INCREMENT,
  `menu` varchar(100) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `description` mediumtext,
  `open_new_tab` int NOT NULL DEFAULT '0',
  `ext_url` mediumtext NOT NULL,
  `ext_url_link` mediumtext NOT NULL,
  `publish` int NOT NULL DEFAULT '0',
  `content_type` varchar(10) NOT NULL DEFAULT 'manual',
  `is_active` varchar(10) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;");
$CI->db->query("INSERT INTO `tbl_saas_front_menus` (`id`, `menu`, `slug`, `description`, `open_new_tab`, `ext_url`, `ext_url_link`, `publish`, `content_type`, `is_active`) VALUES
(1, 'Main Menu', 'main-menu', 'Main menu', 0, '', '', 0, 'default', 'no'),
(2, 'Bottom Menu', 'bottom-menu', 'Bottom Menu', 0, '', '', 0, 'default', 'no');");
$CI->db->query("CREATE TABLE IF NOT EXISTS `tbl_saas_front_menu_items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `menu_id` int NOT NULL,
  `menu` varchar(100) DEFAULT NULL,
  `page_id` int NOT NULL,
  `parent_id` int NOT NULL,
  `ext_url` mediumtext,
  `open_new_tab` int DEFAULT '0',
  `ext_url_link` mediumtext,
  `slug` varchar(200) DEFAULT NULL,
  `weight` int DEFAULT NULL,
  `publish` int NOT NULL DEFAULT '0',
  `description` mediumtext,
  `is_active` varchar(10) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;");
$CI->db->query("INSERT INTO `tbl_saas_front_menu_items` (`id`, `menu_id`, `menu`, `page_id`, `parent_id`, `ext_url`, `open_new_tab`, `ext_url_link`, `slug`, `weight`, `publish`, `description`, `is_active`) VALUES
(1, 1, 'Home', 1, 0, NULL, NULL, NULL, 'home', 1, 0, NULL, 'no'),
(3, 1, 'About', 128, 0, NULL, NULL, NULL, 'about', 2, 0, NULL, 'no'),
(16, 2, 'Home', 1, 0, NULL, NULL, NULL, 'home-1', 1, 0, NULL, 'no'),
(17, 2, 'About Us', 114, 0, NULL, NULL, NULL, 'about-us', 2, 0, NULL, 'no'),
(20, 2, 'Gallery', 117, 0, NULL, NULL, NULL, 'gallery-1', 6, 0, NULL, 'no'),
(21, 2, 'Contact Us', 76, 0, NULL, NULL, NULL, 'contact-us-1', 7, 0, NULL, 'no'),
(45, 1, 'Pricing', 125, 0, NULL, NULL, NULL, 'pricing', 4, 0, NULL, 'no'),
(48, 1, 'Contact Us', 2, 0, NULL, NULL, NULL, 'contact-us', 7, 0, NULL, 'no'),
(50, 1, 'Gallary', 130, 0, NULL, NULL, NULL, 'gallary-1', 6, 0, NULL, 'no'),
(51, 1, 'Blog', 129, 0, NULL, NULL, NULL, 'blog', 5, 0, NULL, 'no'),
(52, 1, 'Features', 132, 0, NULL, NULL, NULL, 'features', 3, 0, NULL, 'no');");
$CI->db->query("CREATE TABLE IF NOT EXISTS `tbl_saas_front_pages` (
  `pages_id` int NOT NULL AUTO_INCREMENT,
  `page_type` varchar(10) NOT NULL DEFAULT 'manual',
  `is_homepage` int DEFAULT '0',
  `title` varchar(250) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `meta_title` mediumtext,
  `meta_description` mediumtext,
  `meta_keyword` mediumtext,
  `feature_image` varchar(200) NOT NULL,
  `description` longtext,
  `publish_date` date NOT NULL,
  `publish` int DEFAULT '0',
  `sidebar` int DEFAULT '0',
  `is_active` varchar(10) DEFAULT 'no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`pages_id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8;");
$CI->db->query("INSERT INTO `tbl_saas_front_pages` (`pages_id`, `page_type`, `is_homepage`, `title`, `url`, `type`, `slug`, `meta_title`, `meta_description`, `meta_keyword`, `feature_image`, `description`, `publish_date`, `publish`, `sidebar`, `is_active`) VALUES
(1, 'default', 0, 'Home', 'front/home', 'page', 'home', 'Home Page', 'Home Page                                                                                                                                                                                                                         ', 'Home Page', '', '<section class=\"features-area pt-100 pb-70\" id=\"features\">\r\n    <div class=\"container\">\r\n        <div class=\"section-header text-center mb-50\">\r\n            <h2>Features designed for you</h2>\r\n            \r\n            <p>We believe we have created the most efficient SaaS landing page for your users. Landing page<br>\r\n                with features that will convince you to use it for your SaaS business.</p>\r\n        </div>\r\n        \r\n        <div class=\"row\">\r\n            <div class=\"col-xl-4 col-lg-4 col-md-6\">\r\n                <div class=\"fetures-wrapper text-center\">\r\n                    <div class=\"fetures-icon mb-20\"><img alt=\"\"\r\n                                                         src=\"http://localhost/client_moumen/modules/saas/uploads/icon1.png\">\r\n                    </div>\r\n                    \r\n                    <div class=\"fetures-text\">\r\n                        <h4>Responsive <span>Layout Template</span></h4>\r\n                        \r\n                        <p>Responsive code that makes your landing page look good on all devices (desktops, tablets, and\r\n                            phones). Created with mobile specialists.</p>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            \r\n            <div class=\"col-xl-4 col-lg-4 col-md-6\">\r\n                <div class=\"fetures-wrapper active text-center\">\r\n                    <div class=\"fetures-icon mb-20\"><img alt=\"\"\r\n                                                         src=\"http://localhost/client_moumen/modules/saas/uploads/icon1.png\">\r\n                    </div>\r\n                    \r\n                    <div class=\"fetures-text\">\r\n                        <h4><span>SaaS Landing Page</span> Analysis</h4>\r\n                        \r\n                        <p>A perfect structure created after we analized trends in SaaS landing page designs. Analysis\r\n                            made to the most popular SaaS businesses.</p>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            \r\n            <div class=\"col-xl-4 col-lg-4 col-md-6\">\r\n                <div class=\"fetures-wrapper mb-30 text-center\">\r\n                    <div class=\"fetures-icon mb-20\"><img alt=\"\"\r\n                                                         src=\"http://localhost/client_moumen/modules/saas/uploads/icon1.png\">\r\n                    </div>\r\n                    \r\n                    <div class=\"fetures-text\">\r\n                        <h4><span>Smart</span> BEM <span>Grid</span></h4>\r\n                        \r\n                        <p>Blocks, Elements and Modifiers. A smart HTML/CSS structure that can easely be reused. Layout\r\n                            driven by the purpose of modularity.</p>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</section>\r\n\r\n<section class=\"our-team bg-light pt-100 pb-70\">\r\n    <div class=\"container\">\r\n        <div class=\"row\">\r\n            <div class=\"col-xl-8 offset-xl-2 col-lg-8 offset-lg-2\">\r\n                <div class=\"section-header text-center mb-70\">\r\n                    <h2>Creative Heads</h2>\r\n                    \r\n                    <p>Generally, every customer wants a product or service that solves their problem, worth their<br>\r\n                        money, and is delivered with amazing customer service</p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        \r\n        <div class=\"row\">\r\n            <div class=\"col-xl-4 col-lg-4 col-md-4\">\r\n                <div class=\"team-box mb-30\">\r\n                    <div class=\"team-img text-center\"><img alt=\"image\"\r\n                                                           src=\"http://localhost/client_moumen/modules/saas/uploads/team01.jpg\">\r\n                        <div class=\"team-overlay\">&lt;!--Team Social--&gt;\r\n                            <ul class=\"team-social\">\r\n                                \r\n                                \r\n                                <li><a class=\"facebook-bg\" href=\"#\"><i class=\"fab fa-facebook-f\"></i></a><br></li>\r\n                                \r\n                                \r\n                                <li><a class=\"twitter-bg\" href=\"#\"><i class=\"fab fa-twitter\"></i></a><br></li>\r\n                                \r\n                                \r\n                                <li><a class=\"instagram-bg\" href=\"#\"><i class=\"fab fa-instagram\"></i></a><br></li>\r\n                                \r\n                                \r\n                                <li><a class=\"pinterest-bg\" href=\"#\"><i class=\"fab fa-pinterest-p\"></i></a><br></li>\r\n                            \r\n                            \r\n                            </ul>\r\n                        </div>\r\n                    </div>\r\n                    \r\n                    <div class=\"team-text text-center\">\r\n                        <h5>Alex Walkin</h5>\r\n                        <span>Owner / Co-founder</span></div>\r\n                    \r\n                    <div class=\"progess-wrapper\">\r\n                        <div class=\"single-skill mb-30\">\r\n                            <div class=\"bar-title\">\r\n                                <h4>Marketing Online <span class=\"f-right\">80%</span></h4>\r\n                            </div>\r\n                            \r\n                            <div class=\"progress\">\r\n                                <div class=\"progress-bar wow slideInLeft\" data-wow-duration=\"1s\" data-wow-delay=\".6s\"\r\n                                     role=\"progressbar\" style=\"width: 80%;\" aria-valuenow=\"80\" aria-valuemin=\"0\"\r\n                                     aria-valuemax=\"100\"></div>\r\n                            </div>\r\n                        </div>\r\n                        \r\n                        <div class=\"single-skill mb-20\">\r\n                            <div class=\"bar-title\">\r\n                                <h4>SEO Services <span class=\"f-right\">70%</span></h4>\r\n                            </div>\r\n                            \r\n                            <div class=\"progress\">\r\n                                <div class=\"progress-bar wow slideInLeft\" data-wow-duration=\"1s\" data-wow-delay=\".6s\"\r\n                                     role=\"progressbar\" style=\"width: 70%;\" aria-valuenow=\"70\" aria-valuemin=\"0\"\r\n                                     aria-valuemax=\"100\"></div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            \r\n            <div class=\"col-xl-4 col-lg-4 col-md-4\">\r\n                <div class=\"team-box mb-30\">\r\n                    <div class=\"team-img text-center\"><img alt=\"image\"\r\n                                                           src=\"http://localhost/client_moumen/modules/saas/uploads/team03.png\">\r\n                        <div class=\"team-overlay\">\r\n                            <ul class=\"team-social\">\r\n                                \r\n                                \r\n                                <li><a class=\"facebook-bg\" href=\"#\"><i class=\"fab fa-facebook-f\"></i></a><br></li>\r\n                                \r\n                                \r\n                                <li><a class=\"twitter-bg\" href=\"#\"><i class=\"fab fa-twitter\"></i></a><br></li>\r\n                                \r\n                                \r\n                                <li><a class=\"instagram-bg\" href=\"#\"><i class=\"fab fa-instagram\"></i></a><br></li>\r\n                                \r\n                                \r\n                                <li><a class=\"pinterest-bg\" href=\"#\"><i class=\"fab fa-pinterest-p\"></i></a><br></li>\r\n                            \r\n                            \r\n                            </ul>\r\n                        </div>\r\n                    </div>\r\n                    \r\n                    <div class=\"team-text text-center\">\r\n                        <h5>Teena Hhon</h5>\r\n                        <span>Lead Designer</span></div>\r\n                    \r\n                    <div class=\"progess-wrapper\">\r\n                        <div class=\"single-skill mb-30\">\r\n                            <div class=\"bar-title\">\r\n                                <h4>Web Designing<span class=\"f-right\">75%</span></h4>\r\n                            </div>\r\n                            \r\n                            <div class=\"progress\">\r\n                                <div class=\"progress-bar wow slideInLeft\" data-wow-duration=\"1s\" data-wow-delay=\".6s\"\r\n                                     role=\"progressbar\" style=\"width: 75%;\" aria-valuenow=\"75\" aria-valuemin=\"0\"\r\n                                     aria-valuemax=\"100\"></div>\r\n                            </div>\r\n                        </div>\r\n                        \r\n                        <div class=\"single-skill mb-20\">\r\n                            <div class=\"bar-title\">\r\n                                <h4>Print Media<span class=\"f-right\">90%</span></h4>\r\n                            </div>\r\n                            \r\n                            <div class=\"progress\">\r\n                                <div class=\"progress-bar wow slideInLeft\" data-wow-duration=\"1s\" data-wow-delay=\".6s\"\r\n                                     role=\"progressbar\" style=\"width: 90%;\" aria-valuenow=\"90\" aria-valuemin=\"0\"\r\n                                     aria-valuemax=\"100\"></div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n            \r\n            <div class=\"col-xl-4 col-lg-4 col-md-4\">\r\n                <div class=\"team-box mb-30\">\r\n                    <div class=\"team-img text-center\"><img alt=\"image\"\r\n                                                           src=\"http://localhost/client_moumen/modules/saas/uploads/team02.jpg\">\r\n                        <div class=\"team-overlay\">\r\n                            <ul class=\"team-social\">\r\n                                \r\n                                \r\n                                <li><a class=\"facebook-bg\" href=\"#\"><i class=\"fab fa-facebook-f\"></i></a><br></li>\r\n                                \r\n                                \r\n                                <li><a class=\"twitter-bg\" href=\"#\"><i class=\"fab fa-twitter\"></i></a><br></li>\r\n                                \r\n                                \r\n                                <li><a class=\"instagram-bg\" href=\"#\"><i class=\"fab fa-instagram\"></i></a><br></li>\r\n                                \r\n                                \r\n                                <li><a class=\"pinterest-bg\" href=\"#\"><i class=\"fab fa-pinterest-p\"></i></a><br></li>\r\n                            \r\n                            \r\n                            </ul>\r\n                        </div>\r\n                    </div>\r\n                    \r\n                    <div class=\"team-text text-center\">\r\n                        <h5>David Emron</h5>\r\n                        <span>Web Development</span></div>\r\n                    \r\n                    <div class=\"progess-wrapper\">\r\n                        <div class=\"single-skill mb-30\">\r\n                            <div class=\"bar-title\">\r\n                                <h4>PHP Programer<span class=\"f-right\">90%</span></h4>\r\n                            </div>\r\n                            \r\n                            <div class=\"progress\">\r\n                                <div class=\"progress-bar wow slideInLeft\" data-wow-duration=\"1s\" data-wow-delay=\".6s\"\r\n                                     role=\"progressbar\" style=\"width: 90%;\" aria-valuenow=\"90\" aria-valuemin=\"0\"\r\n                                     aria-valuemax=\"100\"></div>\r\n                            \r\n                            </div>\r\n                        </div>\r\n                        \r\n                        <div class=\"single-skill mb-20\">\r\n                            <div class=\"bar-title\">\r\n                                <h4>Java Scripts<span class=\"f-right\">80%</span></h4>\r\n                            </div>\r\n                            \r\n                            <div class=\"progress\">\r\n                                <div class=\"progress-bar wow slideInLeft\" data-wow-duration=\"1s\" data-wow-delay=\".6s\"\r\n                                     role=\"progressbar\" style=\"width: 80%;\" aria-valuenow=\"80\" aria-valuemin=\"0\"\r\n                                     aria-valuemax=\"100\"></div>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</section>', '2019-01-14', 1, 1, 'no'),
(2, 'default', 0, 'Contact us', 'front/contact-us', 'page', 'contact-us', '', '', '', '', '<p>Don\'t write in this page. </p>', '2019-01-14', 0, NULL, 'no'),
(3, 'default', 0, 'Terms & Conditions', 'front/terms-conditions', 'page', 'terms-conditions', '', '', '', '', '<div class=\"works-area gray-bg pt-120 pb-100\">\r\n            <div class=\"container\">       <h4>Introduction</h4>\r\n\r\n\r\n<p xss=\"removed\">These Website Standard Terms and Conditions written on this webpage shall manage your use of our website,&nbsp;<span class=\"highlight preview_website_name\" xss=\"removed\">Webiste Name</span>&nbsp;accessible at&nbsp;<span class=\"highlight preview_website_url\" xss=\"removed\">Website.com</span>.</p>\r\n\r\n\r\n\r\n<p xss=\"removed\">These Terms will be applied fully and affect to your use of this Website. By using this Website, you agreed to accept all terms and conditions written in here. You must not use this Website if you disagree with any of these Website Standard Terms and Conditions.</p>\r\n\r\n\r\n\r\n<p xss=\"removed\">Minors or people below 18 years old are not allowed to use this Website.</p>\r\n\r\n\r\n\r\n<h4>Intellectual Property Rights</h4>\r\n\r\n\r\n\r\n<p xss=\"removed\">Other than the content you own, under these Terms,&nbsp;<span class=\"highlight preview_company_name\" xss=\"removed\">Company Name</span>&nbsp;and/or its licensors own all the intellectual property rights and materials contained in this Website.</p>\r\n\r\n\r\n\r\n<p xss=\"removed\">You are granted limited license only for purposes of viewing the material contained on this Website.</p>\r\n\r\n\r\n\r\n<h4>Restrictions</h4>\r\n\r\n\r\n\r\n<p xss=\"removed\">You are specifically restricted from all of the following:</p>\r\n\r\n\r\n\r\n<ul xss=\"removed\">\r\n\r\n\r\n\r\n<li xss=\"removed\">publishing any Website material in any other media;</li>\r\n\r\n\r\n\r\n<li xss=\"removed\">selling, sublicensing and/or otherwise commercializing any Website material;</li>\r\n\r\n\r\n\r\n<li xss=\"removed\">publicly performing and/or showing any Website material;</li>\r\n\r\n\r\n\r\n<li xss=\"removed\">using this Website in any way that is or may be damaging to this Website;</li>\r\n\r\n\r\n\r\n<li xss=\"removed\">using this Website in any way that impacts user access to this Website;</li>\r\n\r\n\r\n\r\n<li xss=\"removed\">using this Website contrary to applicable laws and regulations, or in any way may cause harm to the Website, or to any person or business entity;</li>\r\n\r\n\r\n\r\n<li xss=\"removed\">engaging in any data mining, data harvesting, data extracting or any other similar activity in relation to this Website;</li>\r\n\r\n\r\n\r\n<li xss=\"removed\">using this Website to engage in any advertising or marketing.</li>\r\n\r\n\r\n\r\n</ul>\r\n\r\n\r\n\r\n<p xss=\"removed\">Certain areas of this Website are restricted from being access by you and&nbsp;<span class=\"highlight preview_company_name\" xss=\"removed\">Company Name</span>&nbsp;may further restrict access by you to any areas of this Website, at any time, in absolute discretion. Any user ID and password you may have for this Website are confidential and you must maintain confidentiality as well.</p>\r\n\r\n\r\n\r\n<h4>Your Content</h4>\r\n\r\n\r\n\r\n<p xss=\"removed\">In these Website Standard Terms and Conditions, â€œYour Contentâ€ shall mean any audio, video text, images or other material you choose to display on this Website. By displaying Your Content, you grant&nbsp;<span class=\"highlight preview_company_name\" xss=\"removed\">Company Name</span>&nbsp;a non-exclusive, worldwide irrevocable, sub licensable license to use, reproduce, adapt, publish, translate and distribute it in any and all media.</p>\r\n\r\n\r\n\r\n<p xss=\"removed\">Your Content must be your own and must not be invading any third-party\'s rights.&nbsp;<span class=\"highlight preview_company_name\" xss=\"removed\">Company Name</span>&nbsp;reserves the right to remove any of Your Content from this Website at any time without notice.</p>\r\n\r\n\r\n\r\n<h4>No warranties</h4>\r\n\r\n\r\n\r\n<p xss=\"removed\">This Website is provided â€œas is,â€ with all faults, and&nbsp;<span class=\"highlight preview_company_name\" xss=\"removed\">Company Name</span>&nbsp;express no representations or warranties, of any kind related to this Website or the materials contained on this Website. Also, nothing contained on this Website shall be interpreted as advising you.</p>\r\n\r\n\r\n\r\n<h4>Limitation of liability</h4>\r\n\r\n\r\n\r\n<p xss=\"removed\">In no event shall&nbsp;<span class=\"highlight preview_company_name\" xss=\"removed\">Company Name</span>, nor any of its officers, directors and employees, shall be held liable for anything arising out of or in any way connected with your use of this Website whether such liability is under contract. &nbsp;<span class=\"highlight preview_company_name\" xss=\"removed\">Company Name</span>, including its officers, directors and employees shall not be held liable for any indirect, consequential or special liability arising out of or in any way related to your use of this Website.</p>\r\n\r\n\r\n\r\n<h4>Indemnification<br>You hereby indemnify to the fullest extent&nbsp;<span class=\"highlight preview_company_name\" xss=\"removed\">Company Name</span>&nbsp;from and against any and/or all liabilities, costs, demands, causes of action, damages and expenses arising in any way related to your breach of any of the provisions of these Terms.</h4>\r\n\r\n\r\n\r\n<h2 xss=\"removed\"><p xss=\"removed\"></p>\r\n\r\n\r\n\r\n</h2>\r\n\r\n\r\n\r\n<h4>Severability</h4>\r\n\r\n\r\n\r\n<p xss=\"removed\">If any provision of these Terms is found to be invalid under any applicable law, such provisions shall be deleted without affecting the remaining provisions herein.</p>\r\n\r\n\r\n\r\n<h4>Variation of Terms</h4>\r\n\r\n\r\n\r\n<p xss=\"removed\"><span class=\"highlight preview_company_name\" xss=\"removed\">Company Name</span>&nbsp;is permitted to revise these Terms at any time as it sees fit, and by using this Website you are expected to review these Terms on a regular basis.</p>\r\n\r\n\r\n\r\n<h4>Assignment</h4>\r\n\r\n\r\n\r\n<p xss=\"removed\">The&nbsp;<span class=\"highlight preview_company_name\" xss=\"removed\">Company Name</span>&nbsp;is allowed to assign, transfer, and subcontract its rights and/or obligations under these Terms without any notification. However, you are not allowed to assign, transfer, or subcontract any of your rights and/or obligations under these Terms.</p>\r\n\r\n\r\n\r\n<h4>Entire Agreement</h4>\r\n\r\n\r\n\r\n<p xss=\"removed\">These Terms constitute the entire agreement between&nbsp;<span class=\"highlight preview_company_name\" xss=\"removed\">Company Name</span>&nbsp;and you in relation to your use of this Website, and supersede all prior agreements and understandings.</p>\r\n\r\n\r\n\r\n<h4>Governing Law &amp; Jurisdiction</h4>\r\n\r\n\r\n\r\n<p xss=\"removed\">These Terms will be governed by and interpreted in accordance with the laws of the State of&nbsp;<span class=\"highlight preview_country\" xss=\"removed\">Country</span>, and you submit to the non-exclusive jurisdiction of the state and federal courts located in&nbsp;<span class=\"highlight preview_country\" xss=\"removed\">Country</span>&nbsp;for the resolution of any disputes.</p>\r\n\r\n\r\n\r\n</div>\r\n\r\n\r\n\r\n    </div>', '2019-01-14', 0, NULL, 'no'),
(4, 'default', 0, '404 not Found', 'front/404-not-found', 'page', '404-not-found', '', '                                ', '', '', '\n<div class=\"cps-main-wrap\">\n<div class=\"cps-section cps-section-padding\">\n<div class=\"container text-center\">\n<div class=\"cps-404-content\">\n<h3 class=\"cps-404-title\">Hey Error 404</h3>\n\n<p class=\"cps-404-text\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna</p>\n<a class=\"btn btn-to-home\" href=\"#\" tppabs=\"#\">Back to Home</a></div>\n</div>\n</div>\n</div>\n', '2019-01-14', 0, NULL, 'no'),
(125, 'default', 0, 'Pricing', 'front/pricing', 'page', 'pricing', NULL, NULL, NULL, '', '<section class=\"cps-section cps-section-padding cps-gray-bg\" id=\"pricing\">\n<div class=\"container\">\n<div class=\"row\">\n<div class=\"col-md-12 col-xs-12\">\n<div class=\"cps-section-header text-center\">\n<h3 class=\"cps-section-title\">Affordation Pricing</h3>\n\n<p class=\"cps-section-text\">We are expert in Digital Marketing like Search Engine Optimization, Social Media Marketing, Lead Generation, Research, Google Advertising, Real Time Analysis and many more</p>\n</div>\n</div>\n</div>\n\n<div class=\"row\">\n<div class=\"cps-packages col-md-12\">\n<div class=\"col-sm-4 col-xs-12\">\n<div class=\"cps-package style-2\">\n<div class=\"cps-package-header\">\n<h4 class=\"cps-pack-name\">Free</h4>\n</div>\n\n<div class=\"cps-package-body\">\n<p class=\"cps-pack-price\">Free</p>\n\n<ul class=\"cps-pack-feature-list\">\n <li>Unlimited Access</li>\n <li>Free Setup</li>\n <li>Plugin Supports</li>\n <li>No API Access</li>\n <li>Unlimited Supports</li>\n</ul>\n</div>\n\n<div class=\"cps-pack-footer\"><a class=\"btn btn-square\" href=\"#\">Get Started</a></div>\n</div>\n</div>\n\n<div class=\"col-sm-4 col-xs-12\">\n<div class=\"cps-package style-2\">\n<div class=\"cps-package-header\">\n<h4 class=\"cps-pack-name\">Standard</h4>\n</div>\n\n<div class=\"cps-package-body\">\n<p class=\"cps-pack-price\">$25</p>\n\n<ul class=\"cps-pack-feature-list\">\n <li>Unlimited Access</li>\n <li>Free Setup</li>\n <li>Plugin Supports</li>\n <li>No API Access</li>\n <li>Unlimited Supports</li>\n</ul>\n</div>\n\n<div class=\"cps-pack-footer\"><a class=\"btn btn-square\" href=\"#\">Get Started</a></div>\n</div>\n</div>\n\n<div class=\"col-sm-4 col-xs-12\">\n<div class=\"cps-package style-2\">\n<div class=\"cps-package-header\">\n<h4 class=\"cps-pack-name\">Enterprise</h4>\n</div>\n\n<div class=\"cps-package-body\">\n<p class=\"cps-pack-price\">$35</p>\n\n<ul class=\"cps-pack-feature-list\">\n <li>Unlimited Access</li>\n <li>Free Setup</li>\n <li>Plugin Supports</li>\n <li>No API Access</li>\n <li>Unlimited Supports</li>\n</ul>\n</div>\n\n<div class=\"cps-pack-footer\"><a class=\"btn btn-square\" href=\"#\">Get Started</a></div>\n</div>\n</div>\n</div>\n</div>\n</div>\n\n<div class=\"cps-section cps-section-padding\">\n<div class=\"container\">\n<div class=\"row\">\n<div class=\"col-md-12 text-center\">\n<div class=\"cps-section-header text-center\">\n<h3 class=\"cps-section-title\">Get started today</h3>\n\n<p class=\"cps-section-text\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut</p>\n</div>\n<a class=\"btn btn-square btn-primary\" href=\"#\">Get Started Today!</a></div>\n</div>\n</div>\n</div>\n</section>\n', '2019-01-14', 0, 0, 'no'),
(126, 'default', 0, 'Privacy Policy', 'front/privacy-policy', 'page', 'privacy-policy', NULL, NULL, NULL, '', '<section class=\"works-area bg-light pt-120 pb-100\">\r\n            <div class=\"container\"><h4 class=\"text-center\">WELCOME TO SOFTWARE ADVICE! PLEASE TAKE TIME TO READ OUR PRIVACY POLICY!</h4>\r\n\r\n\r\n\r\n<p style=\"margin-bottom: 1.25rem; text-align: center; text-rendering: optimizelegibility; padding: 0px; line-height: 1.6; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px; color: rgb(77, 77, 77);\">This Privacy Policy covers the privacy practices of Software Advice, a Texas company, and our Affiliates (\"Software Advice\" \"we\" or \"us\"), along with the Sites on which this Privacy Policy is posted (the \"Sites\"). This Policy does not apply to those of our Affiliates, which due to their different business models, have developed their own privacy policies: CEB, Iconoculture, L2&nbsp;and&nbsp;Gartner.</p>\r\n\r\n\r\n\r\n<p style=\"margin-bottom: 1.25rem; text-align: center; text-rendering: optimizelegibility; padding: 0px; line-height: 1.6; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px; color: rgb(77, 77, 77);\"><span style=\"line-height: inherit; font-weight: 700;\">WHAT WE DO:</span>&nbsp;We millions of users to research and evaluate the right software solutions and services for their organizations. As part of our comprehensive directory of products and services, we provide verified user reviews, original research&nbsp;and&nbsp;personalized guidance. Users may also connect directly with software vendors that choose to participate in our lead generation programs.</p>\r\n\r\n\r\n\r\n<p style=\"margin-bottom: 1.25rem; text-align: center; text-rendering: optimizelegibility; padding: 0px; line-height: 1.6; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px; color: rgb(77, 77, 77);\"><span style=\"line-height: inherit; font-weight: 700;\">OUR PRIVACY PRACTICES:</span>&nbsp;While using our Sites and Services, and as part of the normal course of business, we may collect personal information (\"Information\") about you. We want you to understand how we use the information we collect, and that you share with us, and how you may protect your privacy while using our Sites.</p>\r\n\r\n\r\n\r\n<p style=\"margin-bottom: 1.25rem; text-align: center; text-rendering: optimizelegibility; padding: 0px; line-height: 1.6; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px; color: rgb(77, 77, 77);\"><span style=\"line-height: inherit; font-weight: 700;\">YOUR CONSENT:</span>&nbsp;When you provide your Information to us, you consent to the collection, storage and use of your Information by us, our Affiliates and third parties in accordance with the terms set out in this Policy. \"Affiliate\" is any legal entity that controls, is controlled by or is under common control with Gartner (our parent company).</p>\r\n\r\n\r\n</div>\r\n\r\n\r\n</section>', '2019-01-14', 0, 0, 'no'),
(128, 'default', 0, 'About US', 'front/about-us', 'page', 'about-us', NULL, NULL, NULL, '', '\n<section class=\"powerful-features gray-bg pt-120 pb-50\" id=\"features\">\n<div class=\"container\">\n<div class=\"row\">\n<div class=\"col-xl-12\">\n<div class=\"section-header mb-80 text-center\">\n<h2>Powerful Features</h2>\n\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod</p>\n</div>\n</div>\n\n<div class=\"col-xl-4 col-lg-4\">\n<div class=\"powerful-features-single-step mb-70 mt-80\">\n<div class=\"features-text text-right fix pr-30\"><span>Easy Instalations</span>\n\n<p>Lorem ipsum dolor sit amet consectr ncididunt ut labore et dolore</p>\n</div>\n</div>\n\n<div class=\"powerful-features-single-step mb-70\">\n<div class=\"features-text text-right fix pr-30\"><span>Real Time Customizat </span>\n\n<p>Lorem ipsum dolor sit amet consectr ncididunt ut labore et dolore</p>\n</div>\n</div>\n\n<div class=\"powerful-features-single-step mb-70\">\n<div class=\"features-text text-right fix pr-30\"><span>Customer Support</span>\n\n<p>Lorem ipsum dolor sit amet consectr ncididunt ut labore et dolore</p>\n</div>\n</div>\n</div>\n\n<div class=\"col-xl-4 col-lg-4\">\n<div class=\"powerfull-features-img\"><img alt=\"\" src=\"http://localhost/client_moumen/modules/saas/powerfull-features01.png\"></div>\n</div>\n\n<div class=\"col-xl-4 col-lg-4\">\n<div class=\"powerful-features-single-step mb-70 mt-80\">\n<div class=\"features-text pl-30 fix\"><span>Easy Editable</span>\n\n<p>Lorem ipsum dolor sit amet consectr ncididunt ut labore et dolore</p>\n</div>\n</div>\n\n<div class=\"powerful-features-single-step mb-70\">\n<div class=\"features-text pl-30 fix\"><span>Clean & Unique Design</span>\n\n<p>Lorem ipsum dolor sit amet consectr ncididunt ut labore et dolore</p>\n</div>\n</div>\n\n<div class=\"powerful-features-single-step mb-70\">\n<div class=\"features-text pl-30 fix\"><span>Clean Code</span>\n\n<p>Lorem ipsum dolor sit amet consectr ncididunt ut labore et dolore</p>\n</div>\n</div>\n</div>\n</div>\n</div>\n</section>\n\n<section class=\"powerful-features-video pt-205 pb-130\">\n<div class=\"container\">\n<div class=\"powerfull-features-video position-relative\"><img alt=\"\" src=\"http://localhost/client_moumen/modules/saas/powerfull-features-video.jpg\"></div>\n</div>\n</section>\n\n', '2019-01-14', 0, 0, 'no'),
(129, 'default', 0, 'Blog', 'front/blog', 'page', 'blog', NULL, NULL, NULL, '', '<section id=\"latest-blog\" class=\"blog-area pt-120 pb-65\">\r\n    <div class=\"container\">            <!-- Section-header start -->\r\n        <div class=\"section-header text-center mb-80\"><h2>Latest Blog</h2>\r\n            <p>Lorem ipsum dolor sit amet consectetur adipie</p>\r\n        </div>\r\n        <!-- Section-header end -->\r\n        <div class=\"row\">\r\n            <div class=\"col-xl-4 col-lg-4\">                    <!-- Blog-wrapper start -->\r\n                <div class=\"blog-wrapper mb-30\">\r\n                    <div class=\"blog-img\"><img src=\"http://localhost/client_moumen/modules/saas/uploads/blog01.jpg\"\r\n                                               alt=\"blog01\">\r\n                    </div>\r\n                    <div class=\"blog-text\"><h4><a href=\"#\">iOS Performance Tricks Make Your App Feel Performant</a></h4>\r\n                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incide idunt\r\n                            utabore et dolore magna aliqua.</p>\r\n                        <hr class=\"mb-20\">\r\n                        <div class=\"block-link\"><span><i class=\"fal fa-user\"></i>David Watson</span> <span><i\r\n                                        class=\"fal fa-calendar-alt\"></i>15 Apr 2019</span></div>\r\n                    </div>\r\n                </div>\r\n                <!-- Blog-wrapper end -->                </div>\r\n            <div class=\"col-xl-4 col-lg-4\">                    <!-- Blog-wrapper start -->\r\n                <div class=\"blog-wrapper mb-30\">\r\n                    <div class=\"blog-img\"><img src=\"http://localhost/client_moumen/modules/saas/uploads/blog02.jpg\"\r\n                                               alt=\"blog01\">\r\n                    </div>\r\n                    <div class=\"blog-text\"><h4><a href=\"#\">New JavaScript Feature That Will Change How Regex</a></h4>\r\n                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incide idunt\r\n                            utabore et dolore magna aliqua.</p>\r\n                        <hr class=\"mb-20\">\r\n                        <div class=\"block-link\"><span><i class=\"fal fa-user\"></i>David Watson</span> <span><i\r\n                                        class=\"fal fa-calendar-alt\"></i>15 Apr 2019</span></div>\r\n                    </div>\r\n                </div>\r\n                <!-- Blog-wrapper end -->                </div>\r\n            <div class=\"col-xl-4 col-lg-4\">                    <!-- Blog-wrapper start -->\r\n                <div class=\"blog-wrapper mb-30\">\r\n                    <div class=\"blog-img\"><img src=\"http://localhost/client_moumen/modules/saas/uploads/blog03.jpg\"\r\n                                               alt=\"blog01\">\r\n                    </div>\r\n                    <div class=\"blog-text\"><h4><a href=\"#\">Webhosting Compared Test The Uptime Of Hosts</a></h4>\r\n                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incide idunt\r\n                            utabore et dolore magna aliqua.</p>\r\n                        <hr class=\"mb-20\">\r\n                        <div class=\"block-link\"><span><i class=\"fal fa-user\"></i>David Watson</span> <span><i\r\n                                        class=\"fal fa-calendar-alt\"></i>15 Apr 2019</span></div>\r\n                    </div>\r\n                </div>\r\n                <!-- Blog-wrapper end -->                </div>\r\n            <div class=\"col-xl-4 col-lg-4\">                    <!-- Blog-wrapper start -->\r\n                <div class=\"blog-wrapper mb-30\">\r\n                    <div class=\"blog-img\"><img src=\"http://localhost/client_moumen/modules/saas/uploads/blog04.jpg\"\r\n                                               alt=\"blog01\">\r\n                    </div>\r\n                    <div class=\"blog-text\"><h4><a href=\"#\">Webhosting Compared Test The Uptime Of Hosts</a></h4>\r\n                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incide idunt\r\n                            utabore et dolore magna aliqua.</p>\r\n                        <hr class=\"mb-20\">\r\n                        <div class=\"block-link\"><span><i class=\"fal fa-user\"></i>David Watson</span> <span><i\r\n                                        class=\"fal fa-calendar-alt\"></i>15 Apr 2019</span></div>\r\n                    </div>\r\n                </div>\r\n                <!-- Blog-wrapper end -->                </div>\r\n            <div class=\"col-xl-4 col-lg-4\">                    <!-- Blog-wrapper start -->\r\n                <div class=\"blog-wrapper mb-30\">\r\n                    <div class=\"blog-img\"><img src=\"http://localhost/client_moumen/modules/saas/uploads/blog05.jpg\"\r\n                                               alt=\"blog01\">\r\n                    </div>\r\n                    <div class=\"blog-text\"><h4><a href=\"#\">Webhosting Compared Test The Uptime Of Hosts</a></h4>\r\n                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incide idunt\r\n                            utabore et dolore magna aliqua.</p>\r\n                        <hr class=\"mb-20\">\r\n                        <div class=\"block-link\"><span><i class=\"fal fa-user\"></i>David Watson</span> <span><i\r\n                                        class=\"fal fa-calendar-alt\"></i>15 Apr 2019</span></div>\r\n                    </div>\r\n                </div>\r\n                <!-- Blog-wrapper end -->                </div>\r\n            <div class=\"col-xl-4 col-lg-4\">                    <!-- Blog-wrapper start -->\r\n                <div class=\"blog-wrapper mb-30\">\r\n                    <div class=\"blog-img\"><img src=\"http://localhost/client_moumen/modules/saas/uploads/blog06.jpg\"\r\n                                               alt=\"blog01\">\r\n                    </div>\r\n                    <div class=\"blog-text\"><h4><a href=\"#\">Webhosting Compared Test The Uptime Of Hosts</a></h4>\r\n                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incide idunt\r\n                            utabore et dolore magna aliqua.</p>\r\n                        <hr class=\"mb-20\">\r\n                        <div class=\"block-link\"><span><i class=\"fal fa-user\"></i>David Watson</span> <span><i\r\n                                        class=\"fal fa-calendar-alt\"></i>15 Apr 2019</span></div>\r\n                    </div>\r\n                </div>\r\n                <!-- Blog-wrapper end -->                </div>\r\n        </div>\r\n    </div>\r\n</section>', '2019-01-14', 0, 0, 'no'),
(130, 'default', 0, 'Gallery', 'front/gallery', 'page', 'gallery', NULL, NULL, NULL, '', '<!-- our-gallery strat-->\r\n<div class=\"our-gallery pt-120 pb-100\">\r\n    <div class=\"container\">\r\n        <div class=\"section-header mb-80 text-center\"><h2>Our Latest Works</h2>\r\n            \r\n            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit sed do eiusmod</p>\r\n        \r\n        </div>\r\n        \r\n        <div class=\"row\">\r\n            <div class=\"col-xl-4\">\r\n                <div class=\"gallery-item mb-30\" data-gallery=\"http://localhost/client_moumen/modules/saas/uploads/blog01.jpg\">\r\n                    <div class=\"gallery-text\"><a href=\"http://localhost/client_moumen/modules/saas/uploads/blog01.jpg\"\r\n                                                 class=\"popup-image\"><i class=\"fal fa-plus\"></i></a>\r\n                        <p>Be bold and make a statement</p>\r\n                    \r\n                    </div>\r\n                \r\n                </div>\r\n            \r\n            </div>\r\n            \r\n            <div class=\"col-xl-4\">\r\n                <div class=\"gallery-item mb-30\" data-gallery=\"http://localhost/client_moumen/modules/saas/uploads/blog02.jpg\">\r\n                    <div class=\"gallery-text\"><a href=\"http://localhost/client_moumen/modules/saas/uploads/blog02.jpg\"\r\n                                                 class=\"popup-image\"><i class=\"fal fa-plus\"></i></a>\r\n                        <p>Be bold and make a statement</p>\r\n                    \r\n                    </div>\r\n                \r\n                </div>\r\n            \r\n            </div>\r\n            \r\n            <div class=\"col-xl-4\">\r\n                <div class=\"gallery-item mb-30\" data-gallery=\"http://localhost/client_moumen/modules/saas/uploads/blog03.jpg\">\r\n                    <div class=\"gallery-text\"><a href=\"http://localhost/client_moumen/modules/saas/uploads/blog03.jpg\"\r\n                                                 class=\"popup-image\"><i class=\"fal fa-plus\"></i></a>\r\n                        <p>Be bold and make a statement</p>\r\n                    \r\n                    </div>\r\n                \r\n                </div>\r\n            \r\n            </div>\r\n            \r\n            <div class=\"col-xl-4\">\r\n                <div class=\"gallery-item mb-30\"\r\n                     data-gallery=\"http://localhost/client_moumen/modules/saas/uploads/blog04.jpg\">\r\n                    <div class=\"gallery-text\"><a href=\"http://localhost/client_moumen/modules/saas/uploads/blog04.jpg\"\r\n                                                 class=\"popup-image\"><i class=\"fal fa-plus\"></i></a>\r\n                        <p>Be bold and make a statement</p>\r\n                    \r\n                    </div>\r\n                \r\n                </div>\r\n            \r\n            </div>\r\n            \r\n            <div class=\"col-xl-4\">\r\n                <div class=\"gallery-item mb-30\" data-gallery=\"http://localhost/client_moumen/modules/saas/uploads/blog05.jpg\">\r\n                    <div class=\"gallery-text\"><a href=\"http://localhost/client_moumen/modules/saas/uploads/blog03.jpg\"\r\n                                                 class=\"popup-image\"><i class=\"fal fa-plus\"></i></a>\r\n                        <p>Be bold and make a statement</p>\r\n                    \r\n                    </div>\r\n                \r\n                </div>\r\n            \r\n            </div>\r\n            \r\n            <div class=\"col-xl-4\">\r\n                <div class=\"gallery-item mb-30\" data-gallery=\"http://localhost/client_moumen/modules/saas/uploads/blog06.jpg\">\r\n                    <div class=\"gallery-text\"><a href=\"http://localhost/client_moumen/modules/saas/uploads/blog01.jpg\"\r\n                                                 class=\"popup-image\"><i class=\"fal fa-plus\"></i></a>\r\n                        <p>Be bold and make a statement</p>\r\n                    \r\n                    </div>\r\n                \r\n                </div>\r\n            \r\n            </div>\r\n        \r\n        </div>\r\n    \r\n    </div>\r\n\r\n</div>\r\n\r\n<!-- our-gallery end-->', '2019-01-14', 0, 0, 'no');");
$CI->db->query("INSERT INTO `tbl_saas_front_pages` (`pages_id`, `page_type`, `is_homepage`, `title`, `url`, `type`, `slug`, `meta_title`, `meta_description`, `meta_keyword`, `feature_image`, `description`, `publish_date`, `publish`, `sidebar`, `is_active`) VALUES
(132, 'manual', 0, 'Features', 'front/features', 'page', 'features', NULL, NULL, NULL, '', '<div class=\"cps-section cps-section-padding\" id=\"service-box\">\r\n    <div class=\"container\">\r\n        <div class=\"row\">\r\n            <div class=\"col-md-12\">\r\n                <div class=\"cps-section-header text-center style-4\">\r\n                    <h3 class=\"cps-section-title\">A better way to work together</h3>\r\n                    \r\n                    <p class=\"cps-section-text\">SaaSera is the <span>Popular Collaboration</span> App among others.\r\n                        Amazing<br>\r\n                        Dashboard with all tools.</p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        \r\n        <div class=\"row\">\r\n            <div class=\"cps-service-boxs\">\r\n                <div class=\"col-sm-4\">\r\n                    <div class=\"cps-service-box style-7\">\r\n                        <div class=\"cps-service-icon\"><i class=\"fa fa-comments\"></i></div>\r\n                        \r\n                        <h4 class=\"cps-service-title\">Instant Messaging</h4>\r\n                        \r\n                        <p class=\"cps-service-text\">Develop quality cms theme to enable people build their site within a\r\n                            day</p>\r\n                        <a class=\"service-more\" href=\"#\">Learn More </a></div>\r\n                </div>\r\n                \r\n                <div class=\"col-sm-4\">\r\n                    <div class=\"cps-service-box style-7\">\r\n                        <div class=\"cps-service-icon\"><i class=\"fa fa-headphones\"></i></div>\r\n                        \r\n                        <h4 class=\"cps-service-title\">Calls</h4>\r\n                        \r\n                        <p class=\"cps-service-text\">Take idea from client and convert that idea to a live, bug free and\r\n                            highly secured software</p>\r\n                        <a class=\"service-more\" href=\"#\">Learn More </a></div>\r\n                </div>\r\n                \r\n                <div class=\"col-sm-4\">\r\n                    <div class=\"cps-service-box style-7\">\r\n                        <div class=\"cps-service-icon\"><i class=\"fa fa-headphones\"></i></div>\r\n                        \r\n                        <h4 class=\"cps-service-title\">Channels</h4>\r\n                        \r\n                        <p class=\"cps-service-text\">Make highly productive apps for multiple mobile device.</p>\r\n                        <a class=\"service-more\" href=\"#\">Learn More </a></div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>\r\n\r\n<div class=\"cps-section cps-section-padding cps-gray-bg\">\r\n    <div class=\"container\">\r\n        <div class=\"row\">\r\n            <div class=\"col-md-12\">\r\n                <div class=\"cps-section-header text-center\">\r\n                    <h3 class=\"cps-section-title\">Number #1 Team Communication Application</h3>\r\n                    \r\n                    <p class=\"cps-section-text\">Discover the great features</p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        \r\n        <div class=\"cps-sub-section\">\r\n            <div class=\"row\">\r\n                <div class=\"col-sm-6 col-xs-12\">\r\n                    <h4 class=\"cps-subsection-title\">Communicate Faster from everywhere</h4>\r\n                    \r\n                    <p class=\"cps-subsection-text\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do\r\n                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis\r\n                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure\r\n                        dolor in reprehenderit in voluptate velit</p>\r\n                </div>\r\n                \r\n                <div class=\"col-sm-6 col-xs-12\"><img alt=\"...\" class=\"img-responsive\" src=\"http://localhost/client_moumen/modules/saas/uploads/slack-1.svg\"\r\n                                                     tppabs=\"http://localhost/client_moumen/modules/saas/uploads/slack-1.svg\">\r\n                </div>\r\n            </div>\r\n        </div>\r\n        \r\n        <div class=\"cps-sub-section\">\r\n            <div class=\"row\">\r\n                <div class=\"col-sm-6 col-sm-push-6 col-xs-12\">\r\n                    <h4 class=\"cps-subsection-title\">Share your files instantly</h4>\r\n                    \r\n                    <p class=\"cps-subsection-text\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do\r\n                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis\r\n                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure\r\n                        dolor in reprehenderit in voluptate velit</p>\r\n                </div>\r\n                \r\n                <div class=\"col-sm-6 col-sm-pull-6 col-xs-12\"><img alt=\"...\" class=\"img-responsive\"\r\n                                                                   src=\"http://localhost/client_moumen/modules/saas/uploads/slack-2.svg\"\r\n                                                                   tppabs=\"http://localhost/client_moumen/modules/saas/uploads/slack-2.svg\">\r\n                </div>\r\n            </div>\r\n        </div>\r\n        \r\n        <div class=\"cps-sub-section\">\r\n            <div class=\"row\">\r\n                <div class=\"col-sm-6 col-xs-12\">\r\n                    <h4 class=\"cps-subsection-title\">Connect with your other profiles</h4>\r\n                    \r\n                    <p class=\"cps-subsection-text\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do\r\n                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis\r\n                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure\r\n                        dolor in reprehenderit in voluptate velit</p>\r\n                </div>\r\n                \r\n                <div class=\"col-sm-6 col-xs-12 text-center\"><img alt=\"...\" class=\"img-responsive features-side-img\"\r\n                                                                 src=\"http://localhost/client_moumen/modules/saas/uploads/slack-3.png\"\r\n                                                                 tppabs=\"http://localhost/client_moumen/modules/saas/uploads/slack-3.png\">\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>\r\n\r\n    <div class=\"container\">\r\n        <div class=\"row\">\r\n            <div class=\"col-md-12\">\r\n                <div class=\"cps-section-header text-center style-4\">\r\n                    <h3 class=\"cps-section-title\">A better way to work together</h3>\r\n                    \r\n                    <p class=\"cps-section-text\">SaaSera is the <span>Popular Collaboration</span> App among others.\r\n                        Amazing<br>\r\n                        Dashboard with all tools.</p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        \r\n        <div class=\"row\">\r\n            <div class=\"cps-service-boxs\">\r\n                <div class=\"col-sm-4\">\r\n                    <div class=\"cps-service-box style-7\">\r\n                        <div class=\"cps-service-icon\"><i class=\"fa fa-comments\"></i></div>\r\n                        \r\n                        <h4 class=\"cps-service-title\">Instant Messaging</h4>\r\n                        \r\n                        <p class=\"cps-service-text\">Develop quality cms theme to enable people build their site within a\r\n                            day</p>\r\n                        <a class=\"service-more\" href=\"#\">Learn More </a></div>\r\n                </div>\r\n                \r\n                <div class=\"col-sm-4\">\r\n                    <div class=\"cps-service-box style-7\">\r\n                        <div class=\"cps-service-icon\"><i class=\"fa fa-headphones\"></i></div>\r\n                        \r\n                        <h4 class=\"cps-service-title\">Calls</h4>\r\n                        \r\n                        <p class=\"cps-service-text\">Take idea from client and convert that idea to a live, bug free and\r\n                            highly secured software</p>\r\n                        <a class=\"service-more\" href=\"#\">Learn More </a></div>\r\n                </div>\r\n                \r\n                <div class=\"col-sm-4\">\r\n                    <div class=\"cps-service-box style-7\">\r\n                        <div class=\"cps-service-icon\"><i class=\"fa fa-sliders\"></i></div>\r\n                        \r\n                        <h4 class=\"cps-service-title\">Channels</h4>\r\n                        \r\n                        <p class=\"cps-service-text\">Make highly productive apps for multiple mobile device.</p>\r\n                        <a class=\"service-more\" href=\"#\">Learn More </a></div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>\r\n\r\n<div class=\"cps-section cps-section-padding cps-gray-bg\">\r\n    <div class=\"container\">\r\n        <div class=\"row\">\r\n            <div class=\"col-md-12\">\r\n                <div class=\"cps-section-header text-center\">\r\n                    <h3 class=\"cps-section-title\">Number #1 Team Communication Application</h3>\r\n                    \r\n                    <p class=\"cps-section-text\">Discover the great features</p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n        \r\n        <div class=\"cps-sub-section\">\r\n            <div class=\"row\">\r\n                <div class=\"col-sm-6 col-xs-12\">\r\n                    <h4 class=\"cps-subsection-title\">Communicate Faster from everywhere</h4>\r\n                    \r\n                    <p class=\"cps-subsection-text\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do\r\n                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis\r\n                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure\r\n                        dolor in reprehenderit in voluptate velit</p>\r\n                </div>\r\n                \r\n                <div class=\"col-sm-6 col-xs-12\"><img alt=\"...\" class=\"img-responsive\" src=\"http://localhost/client_moumen/modules/saas/uploads/slack-1.svg\"\r\n                                                     tppabs=\"http://localhost/client_moumen/modules/saas/uploads/slack-1.svg\">\r\n                </div>\r\n            </div>\r\n        </div>\r\n        \r\n        <div class=\"cps-sub-section\">\r\n            <div class=\"row\">\r\n                <div class=\"col-sm-6 col-sm-push-6 col-xs-12\">\r\n                    <h4 class=\"cps-subsection-title\">Share your files instantly</h4>\r\n                    \r\n                    <p class=\"cps-subsection-text\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do\r\n                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis\r\n                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure\r\n                        dolor in reprehenderit in voluptate velit</p>\r\n                </div>\r\n                \r\n                <div class=\"col-sm-6 col-sm-pull-6 col-xs-12\"><img alt=\"...\" class=\"img-responsive\"\r\n                                                                   src=\"http://localhost/client_moumen/modules/saas/uploads/slack-2.svg\"\r\n                                                                   tppabs=\"http://localhost/client_moumen/modules/saas/uploads/slack-2.svg\">\r\n                </div>\r\n            </div>\r\n        </div>\r\n        \r\n        <div class=\"cps-sub-section\">\r\n            <div class=\"row\">\r\n                <div class=\"col-sm-6 col-xs-12\">\r\n                    <h4 class=\"cps-subsection-title\">Connect with your other profiles</h4>\r\n                    \r\n                    <p class=\"cps-subsection-text\">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do\r\n                        eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis\r\n                        nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure\r\n                        dolor in reprehenderit in voluptate velit</p>\r\n                </div>\r\n                \r\n                <div class=\"col-sm-6 col-xs-12 text-center\"><img alt=\"...\" class=\"img-responsive features-side-img\"\r\n                                                                 src=\"http://localhost/client_moumen/modules/saas/uploads/slack-3.png\"\r\n                                                                 tppabs=\"http://localhost/client_moumen/modules/saas/uploads/slack-3.png\">\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</div>\r\n\r\n', '2021-06-20', 0, 0, 'no');");
$CI->db->query("CREATE TABLE IF NOT EXISTS `tbl_saas_front_pages_contents` (
  `id` int NOT NULL AUTO_INCREMENT,
  `page_id` int DEFAULT NULL,
  `content_type` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;");
$CI->db->query("CREATE TABLE IF NOT EXISTS `tbl_saas_front_slider` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(350) DEFAULT NULL,
  `subtitle` text NOT NULL,
  `description` text,
  `slider_bg` varchar(255) NOT NULL,
  `slider_img` text,
  `button_text_1` varchar(255) DEFAULT NULL,
  `button_text_2` varchar(255) DEFAULT NULL,
  `button_icon_1` varchar(100) DEFAULT NULL,
  `button_icon_2` varchar(100) DEFAULT NULL,
  `button_link_1` varchar(255) DEFAULT NULL,
  `button_link_2` varchar(255) DEFAULT NULL,
  `sort` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;");
$CI->db->query("INSERT INTO `tbl_saas_front_slider` (`id`, `title`, `subtitle`, `description`, `slider_bg`, `slider_img`, `button_text_1`, `button_text_2`, `button_icon_1`, `button_icon_2`, `button_link_1`, `button_link_2`, `sort`, `status`) VALUES
(1, 'Better Management  <br>  Less Expense', 'Not sure about Pro? Try trial first!', '                                                                                                <div class=\"slider-intro-list mb-40\">                                        <ul>                                            <li><span class=\"fal fa-check\"></span>Unlimited Projects.</li>                                            <li><span class=\"fal fa-check\"></span>Unlimited Team Members.</li>                                            <li><span class=\"fal fa-check\"></span>Unlimited Disk Space.</li>                                        </ul>                                    </div>                                                                                    ', 'modules/saas/uploads/slider-bg-01.jpeg', 'modules/saas/uploads/slider-thum-01.png', 'Take Off', '14 days free trial', NULL, 'fal fa-user-alt mr-1', '', '', 0, 1),
(2, 'Business Growth', 'Not sure about Pro? Try trial first!', '                                                                <div class=\"slider-intro-list mb-40\">                                        <ul>                                            <li><span class=\"fal fa-check\"></span>Unlimited Accounts.</li>                                            <li><span class=\"fal fa-check\"></span>Unlimited Team Members.</li>                                            <li><span class=\"fal fa-check\"></span>Unlimited Disk Space.</li>                                        </ul>                                    </div>                                                        ', 'modules/saas/uploads/14_1.png', 'modules/saas/uploads/mock-1.png', 'Start Live Demo', '', NULL, NULL, '', '', NULL, 1),
(3, 'Financial Service', 'Try trial first!', '                                                                                                                                                                                                <div class=\"slider-intro-list mb-40\">                                        <ul>                                            <li><span class=\"fal fa-check\"></span> Unlimited Expense.</li>                                            <li><span class=\"fal fa-check\"></span> Unlimited Transaction.</li>                                            <li><span class=\"fal fa-check\"></span>Unlimited Deposit.</li><li><span class=\"fal fa-check\"></span>Unlimited Transfer.</li>                                        </ul>                                    </div>                                                                                                                                                                        ', 'modules/saas/uploads/wonderfull-bg01.jpg', 'modules/saas/uploads/imac.png', 'See Live Demp', '14 days free trial', NULL, NULL, '', '', NULL, 1),
(4, 'Powerful services', 'We believe we have created the most efficient SaaS landing page for your users', '                                                                                                <div class=\"slider-intro-list mb-40\">                                        <ul>                                            <li><span class=\"fal fa-check\"></span> Unlimited Expense.</li>                                            <li><span class=\"fal fa-check\"></span> Unlimited Transaction.</li>                                            <li><span class=\"fal fa-check\"></span>Unlimited Deposit.</li><li><span class=\"fal fa-check\"></span>Unlimited Transfer.</li>                                        </ul>                                    </div>                                                                                    ', 'modules/saas/uploads/login_cover.jpg', 'modules/saas/uploads/dashboard-2.png', 'Take Off', '10 days free trial', NULL, NULL, '', '', NULL, 1);
");
$CI->db->query("CREATE TABLE IF NOT EXISTS `tbl_saas_menu` (
  `menu_id` int NOT NULL AUTO_INCREMENT,
  `label` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `parent` int NOT NULL DEFAULT '0',
  `sort` int NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) DEFAULT '1' COMMENT '1= active 0=inactive',
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=173 DEFAULT CHARSET=utf8;");
$CI->db->query("INSERT INTO `tbl_saas_menu` (`menu_id`, `label`, `link`, `icon`, `parent`, `sort`, `status`) VALUES
(1, 'dashboard', 'saas', 'fa fa-dashboard', 0, 1, 1),
(2, 'packages', 'saas/packages', 'fa fa-shield', 0, 2, 1),
(3, 'companies', 'saas/companies', 'icon icon-people', 0, 3, 1),
(4, 'invoices', 'saas/companies/invoices', 'fa fa-book', 0, 4, 1),
(5, 'super_admin', 'saas/super_admin', 'icon icon-people', 0, 5, 1),
(7, 'settings', 'saas/settings', 'fa fa-gears', 0, 7, 1),
(8, 'faq', 'saas/faq', 'fa fa-user-md', 0, 8, 1),
(9, 'coupon', 'saas/coupon', 'fa fa-gift', 0, 6, 1),
(10, 'assign_package', 'assignPackage', 'fa fa-sign-in', 0, 2, 1),
(11, 'frontcms', '#', 'fa fa-empire', 0, 6, 1),
(12, 'menu', 'saas/frontcms/menus', 'fa fa-outdent', 11, 0, 1),
(13, 'mpage', 'saas/frontcms/page', 'fa fa-table', 11, 1, 1),
(14, 'media', 'saas/frontcms/media', 'fa fa-image', 11, 2, 1),
(15, 'slider', 'saas/frontcms/settings/slider', 'fa fa-sliders', 11, 3, 1),
(16, 'settings', 'saas/frontcms/settings', 'fa fa-cogs', 11, 5, 1);
");

$CI->db->query("CREATE TABLE IF NOT EXISTS `tbl_saas_packages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `monthly_price` decimal(18,2) DEFAULT '0.00',
  `quarterly_price` decimal(18,2) DEFAULT '0.00',
  `yearly_price` decimal(18,2) DEFAULT '0.00',
  `sort` int DEFAULT NULL,
  `employee_no` varchar(20) DEFAULT NULL,
  `client_no` varchar(20) DEFAULT NULL,
  `project_no` varchar(20) DEFAULT NULL,
  `invoice_no` varchar(20) DEFAULT NULL,
  `leads_no` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `transactions` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `bank_account_no` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `online_payment` varchar(50) NOT NULL,
  `calendar` varchar(50) DEFAULT NULL,
  `mailbox` varchar(50) DEFAULT NULL,
  `live_chat` varchar(50) DEFAULT NULL,
  `tickets` varchar(50) DEFAULT NULL,
  `tasks_no` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `filemanager` varchar(50) DEFAULT NULL,
  `stock_manager` varchar(50) DEFAULT NULL,
  `recruitment` varchar(50) DEFAULT NULL,
  `attendance` varchar(50) DEFAULT NULL,
  `payroll` varchar(50) DEFAULT NULL,
  `leave_management` varchar(50) DEFAULT NULL,
  `performance` varchar(50) DEFAULT NULL,
  `training` varchar(50) DEFAULT NULL,
  `reports` varchar(50) DEFAULT NULL,
  `disk_space` varchar(100) DEFAULT NULL,
  `trial_period` varchar(20) DEFAULT NULL,
  `description` text,
  `status` varchar(50) DEFAULT NULL,
  `recommended` enum('Yes','No') DEFAULT 'No',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;");
$CI->db->query("INSERT INTO `tbl_saas_packages` (`id`, `name`, `monthly_price`, `quarterly_price`, `yearly_price`, `sort`, `employee_no`, `client_no`, `project_no`, `invoice_no`, `leads_no`, `transactions`, `bank_account_no`, `online_payment`, `calendar`, `mailbox`, `live_chat`, `tickets`, `tasks_no`, `filemanager`, `stock_manager`, `recruitment`, `attendance`, `payroll`, `leave_management`, `performance`, `training`, `reports`, `disk_space`, `trial_period`, `description`, `status`, `recommended`) VALUES
(1, 'BIZTEAM', '20.00', '63.00', '3000.00', 4, '10', '0', '0', '0', '0', '0', '0', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', '0', 'Yes', NULL, 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', '50GB', '30', '', 'published', 'No'),
(2, 'BIZPLUS', '20.00', '63.00', '300.00', 3, '5', '0', '0', '0', '0', '0', '0', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', '0', 'Yes', NULL, 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', '50GB', '30', '', 'published', 'No'),
(3, 'FREE PLAN', '300.00', '45.00', '36.00', 1, '2', '1000', '30', '0', '1000', '50', '1', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', '100', 'No', NULL, 'No', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', '5GB', '30', '<p><br></p><p><br></p><p><br></p>', 'published', 'No'),
(4, 'BIZPLAN', '300.00', '69.00', '69.00', 2, '5', '2000', '100', '100', '1000', '0', '1', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', '500', 'Yes', NULL, 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', '1GB', '14', '', 'published', 'No'),
(5, 'TEAMPLUS', '0.00', '600.00', '10.00', 5, '500', '0', '0', '0', '0', '0', '0', 'Yes', 'No', 'Yes', 'Yes', 'Yes', '0', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', '100GB', '15', 'ssdfffds', 'unpublished', 'Yes');
");
$CI->db->query("CREATE TABLE IF NOT EXISTS `tbl_saas_package_field` (
  `field_id` int NOT NULL AUTO_INCREMENT,
  `field_label` varchar(250) NOT NULL,
  `field_name` varchar(250) NOT NULL,
  `field_type` enum('text','textarea','checkbox','radio','date') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'text',
  `help_text` varchar(250) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `order` int NOT NULL,
  PRIMARY KEY (`field_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;");

$CI->db->query("CREATE TABLE IF NOT EXISTS `tbl_saas_package_field` (
  `field_id` int NOT NULL AUTO_INCREMENT,
  `field_label` varchar(250) NOT NULL,
  `field_name` varchar(250) NOT NULL,
  `field_type` enum('text','textarea','checkbox','radio','date') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'text',
  `help_text` varchar(250) NOT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active',
  `order` int NOT NULL,
  PRIMARY KEY (`field_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;");

$CI->db->query("INSERT INTO `tbl_saas_package_field` (`field_id`, `field_label`, `field_name`, `field_type`, `help_text`, `status`, `order`) VALUES
(1, 'employee_no', 'employee_no', 'text', 'use 0 = unlimited and empty = not included', 'active', 1),
(2, 'client_no', 'client_no', 'text', 'use 0 = unlimited and empty = not included', 'active', 2),
(3, 'leads', 'leads_no', 'text', 'use 0 = unlimited and empty = not included', 'active', 3),
(4, 'transaction', 'transactions', 'text', 'use 0 = unlimited and empty = not included', 'active', 4),
(5, 'bank_account_no', 'bank_account_no', 'text', 'use 0 = unlimited and empty = not included', 'active', 5),
(6, 'tasks_no', 'tasks_no', 'text', 'use 0 = unlimited and empty = not included', 'active', 6),
(7, 'project_no', 'project_no', 'text', 'use 0 = unlimited and empty = not included', 'active', 7),
(8, 'invoice_no', 'invoice_no', 'text', 'use 0 = unlimited and empty = not included', 'active', 8),
(9, 'online_payment', 'online_payment', 'checkbox', '', 'active', 9),
(10, 'calendar', 'calendar', 'checkbox', '', 'inactive', 10),
(11, 'mailbox', 'mailbox', 'checkbox', '', 'active', 11),
(12, 'tickets', 'tickets', 'checkbox', '', 'active', 12),
(13, 'filemanager', 'filemanager', 'checkbox', '', 'active', 13),
(14, 'recruitment', 'recruitment', 'checkbox', '', 'active', 14),
(15, 'attendance', 'attendance', 'checkbox', '', 'active', 15),
(16, 'payroll', 'payroll', 'checkbox', '', 'active', 16),
(17, 'leave_management', 'leave_management', 'checkbox', '', 'active', 17),
(18, 'performance', 'performance', 'checkbox', '', 'active', 18),
(19, 'training', 'training', 'checkbox', '', 'active', 19),
(20, 'reports', 'reports', 'checkbox', '', 'active', 20),
(21, 'stock_manager', 'stock_manager', 'checkbox', '', 'active', 14);");

$CI->db->query("INSERT INTO `tbl_config` (`config_key`, `value`) VALUES
('saas_active_background', '#8d3d3d'),
('saas_active_color', '#b55252'),
('saas_active_custom_color', '1'),
('saas_active_pre_loader', '1'),
('saas_api_signature', ''),
('saas_aside-collapsed', NULL),
('saas_aside-float', NULL),
('saas_body_background', '#976464'),
('saas_company_country', 'Bangladesh'),
('saas_company_email', 'nayeem.edu@gmail.com'),
('saas_company_logo', 'uploads/Zisco-ERP.png'),
('saas_cpanel_host', 'codexcube.com'),
('saas_cpanel_output', 'json'),
('saas_cpanel_password', 'cXZ4L1dVRU9VTzlNbitYS040MFhSZz09'),
('saas_cpanel_port', '2083'),
('saas_cpanel_username', 'cxvvcxvcxvcx'),
('saas_default_currency', 'USD'),
('saas_default_language', 'english'),
('saas_enable_languages', 'TRUE'),
('saas_favicon', 'uploads/Zisco-ERP.png'),
('saas_front_contact_address', NULL),
('saas_front_contact_description', 'Do you wanna know more or have any query, Feel free to contact with us at&nbsp;<a href=\"mailto:uniquecoder007@gmail.com\" xss=removed>uniquecoder007@gmail.com</a> or <a href=\"https://wa.me/8801723611125 text=I\'m interested in your your Product\" xss=removed>WhatsApp’s at +8801723611125 </a>or <a href=\"skype:coderitems?chat\" xss=removed>Skype at coderitems </a>. Our 24/7 Dedicated support team are waiting to solve your doubt :)'),
('saas_front_contact_email', NULL),
('saas_front_contact_phone', NULL),
('saas_front_contact_title', 'Get in Touch'),
('saas_front_copyright_text', 'Copyright 2022, <a href=\"codexcube.com\">codexcube.com</a>. All Rights Reserved'),
('saas_front_facebook_link', 'https://www.facebook.com/nayem.tct'),
('saas_front_favicon', 'modules/saas/uploads/codexcube-logo.jpg'),
('saas_front_footer_col_1_description', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna<br><span xss=\"removed\">Copyright © 2022 UniqueCoder LTD.</span><br xss=\"removed\"><span xss=\"removed\">All Rights Reserved. Proudly made in EU.</span></p><div><span xss=\"removed\"><br></span></div>'),
('saas_front_footer_col_1_title', 'ZiscoERP '),
('saas_front_footer_col_2_description', '<ul class=\"footer-link\" xss=\"removed\">\n<li><a href=\"#\" xss=\"removed\">About</a></li>\n<li><a href=\"#\" xss=\"removed\">Carrers</a></li>\n<li><a href=\"#\" xss=\"removed\">Awards</a></li>\n<li><a href=\"#\" xss=\"removed\">Locations</a></li>\n<li><a href=\"#\" xss=\"removed\">Users Program</a></li>\n</ul>'),
('saas_front_footer_col_2_title', 'Company'),
('saas_front_footer_col_3_description', '<ul class=\"footer-link\" xss=\"removed\">\n<li><a href=\"#\" xss=\"removed\">Integrations</a></li>\n<li><a href=\"#\" xss=\"removed\">API</a></li>\n<li><a href=\"#\" xss=\"removed\">Documentation</a></li>\n<li><a href=\"#\" xss=\"removed\">Pricing</a></li>\n<li><a href=\"#\" xss=\"removed\">Release Notes</a></li>\n</ul>'),
('saas_front_footer_col_3_title', 'Products'),
('saas_front_footer_col_4_description', '                                                              <ul class=\"contact-list\" xss=\"removed\"><li><i class=\"fa fa-map-marker-alt\"></i><p>127 Park Street Ave<br>Miami, FL 8546</p></li><li><i class=\"fa fa-phone\"></i><p>+1-2354-854769</p></li><li><i class=\"fas fa-envelope\"></i><p>127 Park Street Ave<br>Miami, FL 8546</p></li></ul>                                                        '),
('saas_front_footer_col_4_title', 'Contact US'),
('saas_front_footer_col_bottom_description', '                                                              <ul class=\"footer-menu\">\n                            <li><a href=\"#\">Legal</a></li>\n                            <li><a href=\"#\">Terms & Conditions</a></li>\n                            <li><a href=\"#\">Contact</a></li>\n                        </ul>                                                        '),
('saas_front_google_link', 'https://www.google.com/rr'),
('saas_front_header_image', 'modules/saas/uploads/header-image.png'),
('saas_front_instagram_link', 'https://www.instagram.com/tt'),
('saas_front_linkedin_link', 'https://www.linkedin.com/yyy'),
('saas_front_nav_logo', 'modules/saas/uploads/cron_logo_white.png'),
('saas_front_pinterest_link', 'https://www.linkedin.com/yyy'),
('saas_front_pricing_description', 'We believe we have created the most efficient SaaS landing page for your users. Landing page</br>\nwith features that will convince you to use it for your SaaS business.'),
('saas_front_pricing_title', 'Our Plans'),
('saas_front_site_name', NULL),
('saas_front_slider', '1'),
('saas_front_twitter_link', 'https://twitter.com/ddd'),
('saas_layout-boxed', NULL),
('saas_layout-fixed', NULL),
('saas_layout-h', NULL),
('saas_login_background', 'uploads/Zisco-ERP.png'),
('saas_login_position', 'right'),
('saas_logo_or_icon', 'logo_title'),
('saas_navbar_logo_background', '#712a2a'),
('saas_paypal_api_password', 'S1V6bktSYmc4SFpBN3ppc1lidjNmOEpsekd2OVB5ZFhHNVBQS05UOTl3bz0='),
('saas_paypal_api_username', 'admin'),
('saas_paypal_live', 'FALSE'),
('saas_paypal_status', 'active'),
('saas_plesk_host', 'dsa'),
('saas_plesk_password', 'bnBZbHM2UlRhMzUzTWNnWlA2NnlHdz09'),
('saas_plesk_username', 'asd'),
('saas_plesk_webspace_id', 'das'),
('saas_privacy', '<h4 class=\"text-center\" style=\"font-family: \" source=\"\" sans=\"\" pro\",=\"\" sans-serif;=\"\" color:=\"\" rgb(38,=\"\" 38,=\"\" 38);\"=\"\">WELCOME TO SOFTWARE ADVICE! PLEASE TAKE TIME TO READ OUR PRIVACY POLICY!</h4><h4 class=\"text-center\" xss=\"removed\"><p style=\"margin-bottom: 1.25rem; font-weight: 400; text-rendering: optimizelegibility; padding: 0px; line-height: 1.6; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px; color: rgb(77, 77, 77);\">This Privacy Policy covers the privacy practices of Software Advice, a Texas company, and our Affiliates (\"Software Advice\" \"we\" or \"us\"), along with the Sites on which this Privacy Policy is posted (the \"Sites\"). This Policy does not apply to those of our Affiliates, which due to their different business models, have developed their own privacy policies: CEB, Iconoculture, L2&nbsp;and&nbsp;Gartner.</p><p style=\"margin-bottom: 1.25rem; font-weight: 400; text-rendering: optimizelegibility; padding: 0px; line-height: 1.6; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px; color: rgb(77, 77, 77);\"><span style=\"line-height: inherit; font-weight: 700;\">WHAT WE DO:</span>&nbsp;We millions of users to research and evaluate the right software solutions and services for their organizations. As part of our comprehensive directory of products and services, we provide verified user reviews, original research&nbsp;and&nbsp;personalized guidance. Users may also connect directly with software vendors that choose to participate in our lead generation programs.</p><p style=\"margin-bottom: 1.25rem; font-weight: 400; text-rendering: optimizelegibility; padding: 0px; line-height: 1.6; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px; color: rgb(77, 77, 77);\"><span style=\"line-height: inherit; font-weight: 700;\">OUR PRIVACY PRACTICES:</span>&nbsp;While using our Sites and Services, and as part of the normal course of business, we may collect personal information (\"Information\") about you. We want you to understand how we use the information we collect, and that you share with us, and how you may protect your privacy while using our Sites.</p><p style=\"margin-bottom: 1.25rem; font-weight: 400; text-rendering: optimizelegibility; padding: 0px; line-height: 1.6; font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 16px; color: rgb(77, 77, 77);\"><span style=\"line-height: inherit; font-weight: 700;\">YOUR CONSENT:</span>&nbsp;When you provide your Information to us, you consent to the collection, storage and use of your Information by us, our Affiliates and third parties in accordance with the terms set out in this Policy. \"Affiliate\" is any legal entity that controls, is controlled by or is under common control with Gartner (our parent company).</p></h4>'),
('saas_protocol', 'smtp'),
('saas_RTL', '0'),
('saas_server', 'local'),
('saas_server_wildcard', 'TRUE'),
('saas_show-scrollbar', NULL),
('saas_sidebar_active_background', '#a88383'),
('saas_sidebar_active_color', '#cb7676'),
('saas_sidebar_background', '#c97777'),
('saas_sidebar_color', '#ad8383'),
('saas_sidebar_theme', 'bg-white'),
('saas_smtp_encryption', 'ssl'),
('saas_smtp_host', 'mail.codexcube.com'),
('saas_smtp_password', 'aVo0ZGtZb2FMbGJPRVc4cnp3ZFlrdz09'),
('saas_smtp_port', '30'),
('saas_smtp_user', 'info@codexcube.com'),
('saas_stripe_private_key', 'sk_test_51KdCMMHWrYjxokEi91zazlGhxSxUZb6HGw2eGttyV1MexQgQC46Dyyl7tyLFG5ZW5tqORnjtC5fAYbR0PCZRtBR000G2Fmg0YT'),
('saas_stripe_public_key', 'pk_test_51KdCMMHWrYjxokEif0kYihW5lI2rfnrxkM3zlsBRfv8SNQ6WKbpef4Jqoat7dBYrFpTevQeW8zXES7hoIVi1wRPj003qdqwyX2'),
('saas_stripe_status', 'active'),
('saas_submenu_open_background', '#b68484'),
('saas_sync_frontend', 'Done'),
('saas_timezone', 'Asia/Dhaka'),
('saas_top_bar_background', '#a72d2d'),
('saas_top_bar_color', '#c16969'),
('saas_tos', '<h4 style=\"font-family: &quot;Source Sans Pro&quot;, sans-serif; color: rgb(38, 38, 38);\">Introduction</h4><p xss=\"removed\" style=\"color: rgb(38, 38, 38); font-size: 13px;\">These Website Standard Terms and Conditions written on this webpage shall manage your use of our website,&nbsp;<span class=\"highlight preview_website_name\" xss=\"removed\">Webiste Name</span>&nbsp;accessible at&nbsp;<span class=\"highlight preview_website_url\" xss=\"removed\">Website.com</span>.</p><p xss=\"removed\" style=\"color: rgb(38, 38, 38); font-size: 13px;\">These Terms will be applied fully and affect to your use of this Website. By using this Website, you agreed to accept all terms and conditions written in here. You must not use this Website if you disagree with any of these Website Standard Terms and Conditions.</p><p xss=\"removed\" style=\"color: rgb(38, 38, 38); font-size: 13px;\">Minors or people below 18 years old are not allowed to use this Website.</p><h4 style=\"font-family: &quot;Source Sans Pro&quot;, sans-serif; color: rgb(38, 38, 38);\">Intellectual Property Rights</h4><p xss=\"removed\" style=\"color: rgb(38, 38, 38); font-size: 13px;\">Other than the content you own, under these Terms,&nbsp;<span class=\"highlight preview_company_name\" xss=\"removed\">Company Name</span>&nbsp;and/or its licensors own all the intellectual property rights and materials contained in this Website.</p><p xss=\"removed\" style=\"color: rgb(38, 38, 38); font-size: 13px;\">You are granted limited license only for purposes of viewing the material contained on this Website.</p><h4 style=\"font-family: &quot;Source Sans Pro&quot;, sans-serif; color: rgb(38, 38, 38);\">Restrictions</h4><p xss=\"removed\" style=\"color: rgb(38, 38, 38); font-size: 13px;\">You are specifically restricted from all of the following:</p><ul xss=\"removed\" style=\"color: rgb(38, 38, 38); font-size: 13px;\"><li xss=\"removed\">publishing any Website material in any other media;</li><li xss=\"removed\">selling, sublicensing and/or otherwise commercializing any Website material;</li><li xss=\"removed\">publicly performing and/or showing any Website material;</li><li xss=\"removed\">using this Website in any way that is or may be damaging to this Website;</li><li xss=\"removed\">using this Website in any way that impacts user access to this Website;</li><li xss=\"removed\">using this Website contrary to applicable laws and regulations, or in any way may cause harm to the Website, or to any person or business entity;</li><li xss=\"removed\">engaging in any data mining, data harvesting, data extracting or any other similar activity in relation to this Website;</li><li xss=\"removed\">using this Website to engage in any advertising or marketing.</li></ul><p xss=\"removed\" style=\"color: rgb(38, 38, 38); font-size: 13px;\">Certain areas of this Website are restricted from being access by you and&nbsp;<span class=\"highlight preview_company_name\" xss=\"removed\">Company Name</span>&nbsp;may further restrict access by you to any areas of this Website, at any time, in absolute discretion. Any user ID and password you may have for this Website are confidential and you must maintain confidentiality as well.</p><h4 style=\"font-family: &quot;Source Sans Pro&quot;, sans-serif; color: rgb(38, 38, 38);\">Your Content</h4><p xss=\"removed\" style=\"color: rgb(38, 38, 38); font-size: 13px;\">In these Website Standard Terms and Conditions, â€œYour Contentâ€ shall mean any audio, video text, images or other material you choose to display on this Website. By displaying Your Content, you grant&nbsp;<span class=\"highlight preview_company_name\" xss=\"removed\">Company Name</span>&nbsp;a non-exclusive, worldwide irrevocable, sub licensable license to use, reproduce, adapt, publish, translate and distribute it in any and all media.</p><p xss=\"removed\" style=\"color: rgb(38, 38, 38); font-size: 13px;\">Your Content must be your own and must not be invading any third-party\'s rights.&nbsp;<span class=\"highlight preview_company_name\" xss=\"removed\">Company Name</span>&nbsp;reserves the right to remove any of Your Content from this Website at any time without notice.</p><h4 style=\"font-family: &quot;Source Sans Pro&quot;, sans-serif; color: rgb(38, 38, 38);\">No warranties</h4><p xss=\"removed\" style=\"color: rgb(38, 38, 38); font-size: 13px;\">This Website is provided â€œas is,â€ with all faults, and&nbsp;<span class=\"highlight preview_company_name\" xss=\"removed\">Company Name</span>&nbsp;express no representations or warranties, of any kind related to this Website or the materials contained on this Website. Also, nothing contained on this Website shall be interpreted as advising you.</p><h4 style=\"font-family: &quot;Source Sans Pro&quot;, sans-serif; color: rgb(38, 38, 38);\">Limitation of liability</h4><p xss=\"removed\" style=\"color: rgb(38, 38, 38); font-size: 13px;\">In no event shall&nbsp;<span class=\"highlight preview_company_name\" xss=\"removed\">Company Name</span>, nor any of its officers, directors and employees, shall be held liable for anything arising out of or in any way connected with your use of this Website whether such liability is under contract. &nbsp;<span class=\"highlight preview_company_name\" xss=\"removed\">Company Name</span>, including its officers, directors and employees shall not be held liable for any indirect, consequential or special liability arising out of or in any way related to your use of this Website.</p><h4 style=\"font-family: &quot;Source Sans Pro&quot;, sans-serif; color: rgb(38, 38, 38);\">Indemnification<br>You hereby indemnify to the fullest extent&nbsp;<span class=\"highlight preview_company_name\" xss=\"removed\">Company Name</span>&nbsp;from and against any and/or all liabilities, costs, demands, causes of action, damages and expenses arising in any way related to your breach of any of the provisions of these Terms.</h4><h2 xss=\"removed\" style=\"font-family: &quot;Source Sans Pro&quot;, sans-serif; color: rgb(38, 38, 38);\"><p xss=\"removed\"></p></h2><h4 style=\"font-family: &quot;Source Sans Pro&quot;, sans-serif; color: rgb(38, 38, 38);\">Severability</h4><p xss=\"removed\" style=\"color: rgb(38, 38, 38); font-size: 13px;\">If any provision of these Terms is found to be invalid under any applicable law, such provisions shall be deleted without affecting the remaining provisions herein.</p><h4 style=\"font-family: &quot;Source Sans Pro&quot;, sans-serif; color: rgb(38, 38, 38);\">Variation of Terms</h4><p xss=\"removed\" style=\"color: rgb(38, 38, 38); font-size: 13px;\"><span class=\"highlight preview_company_name\" xss=\"removed\">Company Name</span>&nbsp;is permitted to revise these Terms at any time as it sees fit, and by using this Website you are expected to review these Terms on a regular basis.</p><h4 style=\"font-family: &quot;Source Sans Pro&quot;, sans-serif; color: rgb(38, 38, 38);\">Assignment</h4><p xss=\"removed\" style=\"color: rgb(38, 38, 38); font-size: 13px;\">The&nbsp;<span class=\"highlight preview_company_name\" xss=\"removed\">Company Name</span>&nbsp;is allowed to assign, transfer, and subcontract its rights and/or obligations under these Terms without any notification. However, you are not allowed to assign, transfer, or subcontract any of your rights and/or obligations under these Terms.</p><h4 style=\"font-family: &quot;Source Sans Pro&quot;, sans-serif; color: rgb(38, 38, 38);\">Entire Agreement</h4><p xss=\"removed\" style=\"color: rgb(38, 38, 38); font-size: 13px;\">These Terms constitute the entire agreement between&nbsp;<span class=\"highlight preview_company_name\" xss=\"removed\">Company Name</span>&nbsp;and you in relation to your use of this Website, and supersede all prior agreements and understandings.</p><h4 style=\"font-family: &quot;Source Sans Pro&quot;, sans-serif; color: rgb(38, 38, 38);\">Governing Law &amp; Jurisdiction</h4><p xss=\"removed\" style=\"color: rgb(38, 38, 38); font-size: 13px;\">These Terms will be governed by and interpreted in accordance with the laws of the State of&nbsp;<span class=\"highlight preview_country\" xss=\"removed\">Country</span>, and you submit to the non-exclusive jurisdiction of the state and federal courts located in&nbsp;<span class=\"highlight preview_country\" xss=\"removed\">Country</span>&nbsp;for the resolution of any disputes.</p>'),
('saas_website_name', 'ZiscoERP - Powerful HR, Accounting, CRM System');");

$CI->db->query(
    "INSERT INTO `tbl_email_templates` (`email_templates_id`, `code`, `email_group`, `subject`, `template_body`) VALUES
(NULL, 'en', 'token_activate_account', 'Activate Account', '<p>Welcome to {SITE_NAME}!</p>\n\n<p>Thanks for joining {SITE_NAME}. We listed your activation token below.</p>\n\n<p>To verify your Your activation token please copy the activation code: <strong> {ACTIVATION_TOKEN} </strong><br>\n<br>\nplease follow this link:<br>\n<big><strong><a href=\"{ACTIVATE_URL}\">Start your registration...</a></strong></big><br>\nLink doesn&#39;t work? Copy the following link to your browser address bar:<br>\n<a href=\"{ACTIVATE_URL}\">{ACTIVATE_URL}</a></p>\n\n<p><br>\n<br>\nPlease verify Your activation token within {ACTIVATION_PERIOD} hours, otherwise, your registration will become invalid and you will have to register again.<br>\n<br>\n<br>\nHave fun!<br>\nThe {SITE_NAME} Team</p>\n'),
(NULL, 'en', 'assign_new_package', 'Assign New Package', '<p>Dear {COMPANY},</p>\n\n<p>Your package has been updated to {PACKAGE}</p>\n\n<p>Thank you,</p>\n\n<br>\nHave fun!<br>\nThe {SITE_NAME} Team<p></p>'),
(NULL, 'en', 'saas_welcome_mail', 'Welcome Email ', '<p>Hello <span xss=removed><span xss=\"removed\">{NAME}</span>,</span></p><p>Welcome to <span xss=removed>{SITE_NAME}!</span></p><p>Thanks for joining <span xss=removed>{SITE_NAME}.</span> We listed your company details below, make sure you keep them safe your account details</p><p>Click here to view your URL<span xss=removed> {COMPANY_URL}</span></p><p>please follow this link:<br><big><strong><a href=\"http://{SITE_URL}\" target=\"_blank\">View your company details...</a></strong></big><br>Link doesn\'t work? Copy the following link to your browser address bar:<br><a href=\"{COMPANY_URL}\">{COMPANY_URL}</a></p><p><br><br><br>Have fun!<br>The <span xss=removed>{SITE_NAME} </span>Team</p>'),
(NULL, 'en', 'faq_request_email', 'FAQ request from website', '<p>Hi there,</p>\r\n\r\n<p><strong>{NAME}</strong> Want to contact with you from website.</p>\r\n\r\n<p>You can view the request by logging in to the portal using the link below<br>\r\n<big><strong><a href=\"{LINK}\">View Details</a></strong></big><br>\r\n<br>\r\n<br>\r\nRegards<br>\r\n<br>\r\nThe {SITE_NAME} Team</p>\r\n');"
);


//$CI->db->query("DELETE FROM `tbl_menu` WHERE `tbl_menu`.`label` = 'system_settings'");
$CI->db->query("DELETE FROM `tbl_menu` WHERE `tbl_menu`.`label` = 'translations'");

$CI->db->query("ALTER TABLE `tbl_modules` ADD `for_company` ENUM('Yes','No') NOT NULL DEFAULT 'Yes' AFTER `installed_version`;");
$CI->db->query("UPDATE `tbl_modules` SET `for_company` = 'No' WHERE `tbl_modules`.`module_name` = 'saas';");

// update tbl_users role_id=4 where user_id = my_id()
$CI->db->query("UPDATE `tbl_users` SET `role_id` = '4' WHERE `tbl_users`.`user_id` = '" . my_id() . "';");
$CI->db->query("INSERT INTO `tbl_saas_package_field` (`field_id`, `field_label`, `field_name`, `field_type`, `help_text`, `status`, `order`) VALUES (NULL, 'disk_space', 'disk_space', 'text', 'Include it with MB,GB,TB etc like 1GB. use 0 = unlimited and empty = not included', 'active', '2');");
$CI->db->query("ALTER TABLE `tbl_saas_companies_history` ADD `disk_space` VARCHAR(50) NULL DEFAULT NULL AFTER `currency`;");