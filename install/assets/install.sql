--
-- Table structure for table `installer`
--

CREATE TABLE IF NOT EXISTS `installer`
(
    `id`
    int
    NOT
    NULL,
    `installer_flag`
    int
    NOT
    NULL,
    PRIMARY
    KEY
(
    `id`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_accounts`
--

CREATE TABLE IF NOT EXISTS `tbl_accounts`
(
    `account_id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `account_name`
    varchar
(
    100
) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `description` varchar
(
    200
) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
    `balance` decimal
(
    18,
    2
) NOT NULL DEFAULT '0.00',
    `account_number` varchar
(
    50
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `contact_person` varchar
(
    100
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `contact_phone` varchar
(
    20
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `bank_details` text CHARACTER SET utf8 COLLATE utf8_general_ci,
    `permission` text CHARACTER SET utf8 COLLATE utf8_general_ci,
    PRIMARY KEY
(
    `account_id`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_details`
--

CREATE TABLE IF NOT EXISTS `tbl_account_details`
(
    `account_details_id`
    bigint
    UNSIGNED
    NOT
    NULL
    AUTO_INCREMENT,
    `user_id`
    int
    NOT
    NULL,
    `fullname`
    varchar
(
    160
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `employment_id` varchar
(
    200
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `warehouse_id` int DEFAULT NULL,
    `company` varchar
(
    150
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `city` varchar
(
    40
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `country` varchar
(
    100
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `locale` varchar
(
    100
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'en_US',
    `address` varchar
(
    64
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '-',
    `phone` varchar
(
    32
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '-',
    `mobile` varchar
(
    32
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
    `skype` varchar
(
    100
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '',
    `language` varchar
(
    40
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'english',
    `designations_id` int DEFAULT '0',
    `avatar` varchar
(
    200
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'uploads/default_avatar.jpg',
    `joining_date` date DEFAULT NULL,
    `present_address` text CHARACTER SET utf8 COLLATE utf8_general_ci,
    `date_of_birth` date DEFAULT NULL,
    `gender` varchar
(
    50
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `maratial_status` varchar
(
    50
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `father_name` varchar
(
    200
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `mother_name` varchar
(
    200
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `passport` varchar
(
    40
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `direction` varchar
(
    20
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    PRIMARY KEY
(
    `account_details_id`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_activities`
--

CREATE TABLE IF NOT EXISTS `tbl_activities`
(
    `activities_id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `user`
    int
    NOT
    NULL,
    `module`
    varchar
(
    32
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `module_field_id` int DEFAULT NULL,
    `activity` varchar
(
    255
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `activity_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `icon` varchar
(
    32
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'fa-coffee',
    `link` varchar
(
    200
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `value1` text CHARACTER SET utf8 COLLATE utf8_general_ci,
    `value2` text CHARACTER SET utf8 COLLATE utf8_general_ci,
    `deleted` int NOT NULL DEFAULT '0',
    PRIMARY KEY
(
    `activities_id`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_advance_salary`
--

CREATE TABLE IF NOT EXISTS `tbl_advance_salary`
(
    `advance_salary_id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `user_id`
    int
    NOT
    NULL,
    `advance_amount`
    varchar
(
    200
) NOT NULL,
    `deduct_month` varchar
(
    30
) DEFAULT NULL,
    `reason` text,
    `request_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `status` tinyint NOT NULL DEFAULT '0' COMMENT '0 =pending,1=accpect , 2 = reject and 3 = paid',
    `approve_by` int DEFAULT NULL,
    PRIMARY KEY
(
    `advance_salary_id`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_allowed_ip`
--

CREATE TABLE IF NOT EXISTS `tbl_allowed_ip`
(
    `allowed_ip_id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `allowed_ip`
    varchar
(
    100
) NOT NULL,
    `status` enum
(
    'active',
    'reject',
    'pending'
) DEFAULT 'pending',
    PRIMARY KEY
(
    `allowed_ip_id`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_announcements`
--

CREATE TABLE IF NOT EXISTS `tbl_announcements`
(
    `announcements_id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `title`
    text
    NOT
    NULL,
    `description`
    text
    NOT
    NULL,
    `user_id`
    int
    NOT
    NULL,
    `created_date`
    timestamp
    NOT
    NULL
    DEFAULT
    CURRENT_TIMESTAMP,
    `status`
    enum
(
    'published',
    'unpublished'
) NOT NULL DEFAULT 'unpublished' COMMENT '0 = unpublished, 1 = published',
    `view_status` tinyint
(
    1
) NOT NULL DEFAULT '2' COMMENT '1=Read 2=Unread',
    `start_date` date NOT NULL,
    `end_date` date NOT NULL,
    `all_client` varchar
(
    20
) DEFAULT NULL,
    `attachment` text,
    PRIMARY KEY
(
    `announcements_id`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_assign_item`
--

CREATE TABLE IF NOT EXISTS `tbl_assign_item`
(
    `assign_item_id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `stock_id`
    int
    NOT
    NULL,
    `user_id`
    int
    NOT
    NULL,
    `assign_inventory`
    int
    NOT
    NULL,
    `assign_date`
    date
    NOT
    NULL,
    PRIMARY
    KEY
(
    `assign_item_id`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attachments`
--

CREATE TABLE IF NOT EXISTS `tbl_attachments`
(
    `attachments_id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `user_id`
    int
    DEFAULT
    NULL,
    `title`
    varchar
(
    200
) NOT NULL,
    `description` text NOT NULL,
    `upload_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `module` varchar
(
    50
) DEFAULT NULL,
    `module_field_id` int DEFAULT NULL,
    PRIMARY KEY
(
    `attachments_id`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attachments_files`
--

CREATE TABLE IF NOT EXISTS `tbl_attachments_files`
(
    `uploaded_files_id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `attachments_id`
    int
    NOT
    NULL,
    `files`
    text
    NOT
    NULL,
    `uploaded_path`
    text
    NOT
    NULL,
    `file_name`
    text
    NOT
    NULL,
    `size`
    int
    NOT
    NULL,
    `ext`
    varchar
(
    100
) NOT NULL,
    `is_image` int NOT NULL,
    `image_width` int NOT NULL,
    `image_height` int NOT NULL,
    PRIMARY KEY
(
    `uploaded_files_id`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE IF NOT EXISTS `tbl_attendance`
(
    `attendance_id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `user_id`
    int
    DEFAULT
    NULL,
    `leave_application_id`
    int
    DEFAULT
    '0',
    `date_in`
    date
    DEFAULT
    NULL,
    `date_out`
    date
    DEFAULT
    NULL,
    `attendance_status`
    tinyint
(
    1
) NOT NULL DEFAULT '0' COMMENT 'status 0=absent 1=present 3 = onleave',
    `clocking_status` tinyint
(
    1
) NOT NULL,
    PRIMARY KEY
(
    `attendance_id`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_award_points`
--

CREATE TABLE IF NOT EXISTS `tbl_award_points`
(
    `award_points_id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `client_id`
    int
    NOT
    NULL,
    `user_id`
    int
    NOT
    NULL,
    `client_award_point`
    varchar
(
    100
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `user_award_point` varchar
(
    100
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `invoices_id` int NOT NULL,
    `payment_status` varchar
(
    100
) NOT NULL,
    `date` varchar
(
    40
) NOT NULL,
    PRIMARY KEY
(
    `award_points_id`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_award_program`
--

CREATE TABLE IF NOT EXISTS `tbl_award_program`
(
    `award_program_id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `program_name`
    varchar
(
    100
) NOT NULL,
    `award_rule_id` int NOT NULL,
    `client_id` int NOT NULL,
    `start_date` varchar
(
    64
) NOT NULL,
    `end_date` varchar
(
    64
) NOT NULL,
    `description` varchar
(
    200
) NOT NULL,
    `status` int NOT NULL,
    PRIMARY KEY
(
    `award_program_id`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_award_rule`
--

CREATE TABLE IF NOT EXISTS `tbl_award_rule`
(
    `award_rule_id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `rule_name`
    varchar
(
    200
) NOT NULL,
    `date_create` date NOT NULL,
    `client_id` int NOT NULL,
    `award_point_from` varchar
(
    20
) NOT NULL,
    `award_point_to` varchar
(
    20
) NOT NULL,
    `card` int NOT NULL,
    `description` text NOT NULL,
    PRIMARY KEY
(
    `award_rule_id`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bug`
--

CREATE TABLE IF NOT EXISTS `tbl_bug`
(
    `bug_id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `issue_no`
    varchar
(
    50
) DEFAULT NULL,
    `project_id` int DEFAULT NULL,
    `opportunities_id` int DEFAULT NULL,
    `task_id` int NOT NULL DEFAULT '0',
    `bug_title` varchar
(
    200
) NOT NULL,
    `bug_description` text NOT NULL,
    `bug_status` varchar
(
    30
) DEFAULT NULL,
    `notes` text CHARACTER SET utf8 COLLATE utf8_general_ci,
    `priority` varchar
(
    20
) NOT NULL,
    `severity` varchar
(
    20
) DEFAULT NULL,
    `reproducibility` text,
    `reporter` int DEFAULT NULL,
    `created_time` timestamp NULL DEFAULT NULL,
    `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `permission` text,
    `client_visible` varchar
(
    8
) DEFAULT NULL,
    PRIMARY KEY
(
    `bug_id`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_calls`
--

CREATE TABLE IF NOT EXISTS `tbl_calls`
(
    `calls_id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `leads_id`
    int
    DEFAULT
    NULL,
    `opportunities_id`
    int
    DEFAULT
    NULL,
    `client_id`
    int
    DEFAULT
    NULL,
    `user_id`
    int
    DEFAULT
    NULL,
    `module`
    varchar
(
    50
) DEFAULT NULL,
    `module_field_id` int DEFAULT NULL,
    `date` varchar
(
    20
) DEFAULT NULL,
    `call_summary` varchar
(
    200
) NOT NULL,
    PRIMARY KEY
(
    `calls_id`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_card_config`
--

CREATE TABLE IF NOT EXISTS `tbl_card_config`
(
    `card_config_id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `name`
    varchar
(
    100
) NOT NULL,
    `date_create` date DEFAULT NULL,
    `subject_card` int DEFAULT '0',
    `client_name` int DEFAULT '0',
    `membership` int DEFAULT '0',
    `company_name` int DEFAULT '0',
    `member_since` int DEFAULT '0',
    `custom_field` int DEFAULT '0',
    `custom_field_content` varchar
(
    200
) DEFAULT NULL,
    `text_color` varchar
(
    25
) DEFAULT NULL,
    PRIMARY KEY
(
    `card_config_id`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client`
--

CREATE TABLE IF NOT EXISTS `tbl_client`
(
    `client_id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `primary_contact`
    int
    DEFAULT
    NULL,
    `name`
    varchar
(
    255
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `email` varchar
(
    64
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `short_note` text CHARACTER SET utf8 COLLATE utf8_general_ci,
    `website` varchar
(
    100
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `phone` varchar
(
    64
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `mobile` varchar
(
    64
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `fax` varchar
(
    64
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `address` varchar
(
    255
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `city` varchar
(
    100
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `zipcode` varchar
(
    20
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `currency` varchar
(
    32
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'USD',
    `skype_id` varchar
(
    100
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `linkedin` varchar
(
    255
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `facebook` varchar
(
    255
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `twitter` varchar
(
    255
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `language` varchar
(
    100
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `country` varchar
(
    255
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `vat` varchar
(
    64
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `hosting_company` varchar
(
    100
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `hostname` varchar
(
    100
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `port` varchar
(
    32
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `password` text CHARACTER SET utf8 COLLATE utf8_general_ci,
    `username` varchar
(
    100
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `client_status` tinyint
(
    1
) NOT NULL COMMENT '1 = person and 2 = company',
    `profile_photo` text CHARACTER SET utf8 COLLATE utf8_general_ci,
    `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `leads_id` int DEFAULT NULL,
    `latitude` text CHARACTER SET utf8 COLLATE utf8_general_ci,
    `longitude` text CHARACTER SET utf8 COLLATE utf8_general_ci,
    `customer_group_id` int DEFAULT NULL,
    `active` varchar
(
    20
) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
    `sms_notification` tinyint
(
    1
) DEFAULT NULL,
    `permission` text CHARACTER SET utf8 COLLATE utf8_general_ci,
    PRIMARY KEY
(
    `client_id`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_menu`
--

CREATE TABLE IF NOT EXISTS `tbl_client_menu`
(
    `menu_id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `label`
    varchar
(
    20
) DEFAULT NULL,
    `link` varchar
(
    200
) DEFAULT NULL,
    `icon` varchar
(
    50
) DEFAULT NULL,
    `parent` int DEFAULT NULL,
    `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    `sort` int DEFAULT NULL,
    `status` int DEFAULT NULL,
    PRIMARY KEY
(
    `menu_id`
)
    ) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_client_menu`
--

INSERT INTO `tbl_client_menu` (`menu_id`, `label`, `link`, `icon`, `parent`, `sort`, `status`)
VALUES (1, 'projects', 'client/projects', 'fa fa-folder-open-o', 0, 3, 0),
       (2, 'bugs', 'client/bugs', 'fa fa-bug', 0, 4, 0),
       (3, 'invoices', 'client/invoice/manage_invoice', 'fa fa-shopping-cart', 0, 5, 0),
       (4, 'estimates', 'client/estimates', 'fa fa-tachometer', 0, 6, 0),
       (5, 'payments', 'client/invoice/all_payments', 'fa fa-money', 0, 7, 0),
       (6, 'tickets', 'client/tickets', 'fa fa-ticket', 0, 8, 0),
       (7, 'quotations', 'client/quotations', 'fa fa-paste', 0, 9, 0),
       (8, 'users', 'client/user/user_list', 'fa fa-users', 0, 10, 0),
       (9, 'settings', 'client/settings', 'fa fa-cogs', 0, 11, 0),
       (12, 'answered', 'client/tickets/answered', 'fa fa-circle-o', 6, 1, 0),
       (17, 'dashboard', 'client/dashboard', 'icon-speedometer', 0, 1, 0),
       (18, 'mailbox', 'client/mailbox', 'fa fa-envelope', 0, 2, 0),
       (19, 'private_chat', 'chat/conversations', 'fa fa-envelope', 0, 12, 0),
       (20, 'filemanager', 'client/filemanager', 'fa fa-file', 0, 2, 1),
       (21, 'proposals', 'client/proposals', 'fa fa-leaf', 0, 7, 1),
       (22, 'knowledgebase', 'knowledgebase', 'fa fa-question-circle', 0, 12, 1),
       (23, 'refund_items', 'client/invoice/refund_itemslist', 'icon-share-alt', 0, 6, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_client_role`
--

CREATE TABLE IF NOT EXISTS `tbl_client_role`
(
    `client_role_id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `user_id`
    int
    NOT
    NULL,
    `menu_id`
    int
    NOT
    NULL,
    PRIMARY
    KEY
(
    `client_role_id`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clock`
--

CREATE TABLE IF NOT EXISTS `tbl_clock`
(
    `clock_id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `attendance_id`
    int
    NOT
    NULL,
    `clockin_time`
    time
    DEFAULT
    NULL,
    `clockout_time`
    time
    DEFAULT
    NULL,
    `comments`
    text,
    `clocking_status`
    tinyint
(
    1
) NOT NULL DEFAULT '0' COMMENT '1= clockin_time',
    `ip_address` varchar
(
    50
) DEFAULT NULL,
    `latitude` varchar
(
    300
) DEFAULT NULL,
    `longitude` varchar
(
    300
) DEFAULT NULL,
    `location` text,
    PRIMARY KEY
(
    `clock_id`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_clock_history`
--

CREATE TABLE IF NOT EXISTS `tbl_clock_history`
(
    `clock_history_id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `user_id`
    int
    DEFAULT
    NULL,
    `clock_id`
    int
    NOT
    NULL,
    `clockin_edit`
    time
    NOT
    NULL,
    `clockout_edit`
    time
    DEFAULT
    NULL,
    `reason`
    varchar
(
    300
) NOT NULL,
    `status` tinyint
(
    1
) NOT NULL DEFAULT '1' COMMENT '1=pending and 2 = accept  3= reject',
    `notify_me` tinyint NOT NULL DEFAULT '1',
    `view_status` tinyint NOT NULL DEFAULT '2',
    `request_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY
(
    `clock_history_id`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_config`
--

CREATE TABLE IF NOT EXISTS `tbl_config`
(
    `config_key` varchar
(
    255
) NOT NULL,
    `value` text,
    PRIMARY KEY
(
    `config_key`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_config`
--

INSERT INTO `tbl_config` (`config_key`, `value`)
VALUES ('2checkout_private_key', 'CE6B7C6E-CDC4-404A-80D7-08F40CC0C65D'),
       ('2checkout_publishable_key', 'D188F8DC-3B8A-408E-A479-15A54113C461'),
       ('2checkout_seller_id', '901386312'),
       ('2checkout_status', 'deactive'),
       ('absent_color', 'rgba(247,23,36,0.92)'),
       ('absent_on_calendar', 'on'),
       ('accounting_snapshot', '0'),
       ('active_background', '#1c7086'),
       ('active_color', '#c1c1c1'),
       ('active_cronjob', 'on'),
       ('active_custom_color', '0'),
       ('active_pre_loader', '1'),
       ('advance_salary', 'true'),
       ('advance_salary_email', '1'),
       ('aim_api_login_id', '7F6eJh7uFyD'),
       ('aim_authorize_live ', 'FALSE'),
       ('aim_authorize_status', 'deactive'),
       ('aim_authorize_transaction_key', '64uhZ93mqH6c3MWf'),
       ('allowed_files', 'gif|png|jpeg|jpg|pdf|doc|txt|docx|xls|zip|rar|xls|mp4|ico'),
       ('allow_apply_job_from_login', 'TRUE'),
       ('allow_client_project', 'TRUE'),
       ('allow_client_registration', 'TRUE'),
       ('allow_customer_edit_amount', 'No'),
       ('allow_multiple_client_in_project', NULL),
       ('allow_sub_tasks', 'TRUE'),
       ('amount_to_words_lowercase', 'No'),
       ('announcements_email', '1'),
       ('api_signature', 'AZxbwZ9bPVPFFf7hCCNemacLJwlCAqoMULHXAenCuJAwtzfjGbkbaIhV'),
       ('aside-collapsed', NULL),
       ('aside-float', NULL),
       ('attendance_report', '1'),
       ('authorize', 'login id'),
       ('authorize_net_status', 'active'),
       ('authorize_transaction_key', 'transfer key'),
       ('automatic_database_backup', 'on'),
       ('automatic_email_on_recur', 'TRUE'),
       ('auto_check_for_new_notifications', '0'),
       ('auto_close_ticket', '72'),
       ('award_email', '1'),
       ('bank_cash', '0'),
       ('bitcoin_address', NULL),
       ('bitcoin_status', 'active'),
       ('body_background', 'rgba(229,252,252,0.81)'),
       ('braintree_default_account', NULL),
       ('braintree_live_or_sandbox', 'TRUE'),
       ('braintree_merchant_id', '9m2qzhrptx7wyccy'),
       ('braintree_private_key', 'aa804bc269d4a9c8d8170ab8aed353b3'),
       ('braintree_public_key', '62grv2dnvfpg599v'),
       ('braintree_status', 'active'),
       ('bugs_color', '#1f3d1c'),
       ('bugs_on_calendar', 'on'),
       ('build', '0'),
       ('ccavenue_access_code', 'AVEB75FA40AM89BEMA'),
       ('ccavenue_enable_test_mode', 'TRUE'),
       ('ccavenue_key', '201F5203749670E18D664192B594B74E'),
       ('ccavenue_merchant_id', '161761'),
       ('ccavenue_status', 'active'),
       ('chat_interval_time', '5'),
       ('client_default_menu',
        'a:1:{s:19:\"client_default_menu\";a:12:{i:0;s:2:\"17\";i:1;s:2:\"18\";i:2;s:2:\"20\";i:3;s:1:\"1\";i:4;s:1:\"2\";i:5;s:1:\"3\";i:6;s:1:\"4\";i:7;s:1:\"5\";i:8;s:2:\"21\";i:9;s:1:\"6\";i:10;s:1:\"7\";i:11;s:2:\"22\";}}'),
       ('company_address', '123, XYZ street'),
       ('company_city', 'London'),
       ('company_country', 'Pakistan'),
       ('company_domain', 'maidsontime.com'),
       ('company_email', 'nayeem.edu@gmail.com'),
       ('company_legal_name', 'Ultimate Project Manager CRM PRO'),
       ('company_logo', 'uploads/SurviCamLogoHighResTransparent.png'),
       ('company_name', 'Ultimate Project Manager CRM PRO'),
       ('company_phone', '2342432'),
       ('company_phone_2', ''),
       ('company_vat', ''),
       ('company_zip_code', 'SE1 7PB'),
       ('config_additional_flag', '/novalidate-cert'),
       ('config_host', 'mail.coderitems.com'),
       ('config_imap', '0'),
       ('config_imap_or_pop', 'on'),
       ('config_mailbox', 'INBOX'),
       ('config_password',
        '1c896e7d0fcbf64bb0921dd4bec18c947d34a5397472bb13b9f9ed95e4fd10dea45f365dde644233b2eef83f34e67cfd2fcc29b99c2835b89e8ecde5cdf233081hQfQaY72VtMiijV4wlVI6nmPwdsrMgJHALC3GCDw8E='),
       ('config_pop3', '0'),
       ('config_port', '993'),
       ('config_ssl', 'on'),
       ('config_username', 'support@coderitems.com'),
       ('contact_person', 'Ultimate Project Manager CRM PRO'),
       ('contract_expiration_reminder', ''),
       ('copyright_name', 'Uniquecoder'),
       ('copyright_url', 'https://codecanyon.net/user/unique_coder'),
       ('country', '0'),
       ('credit_note_footer', 'OKS'),
       ('credit_note_number_format', '[CR][yyyy][mm][dd][number]'),
       ('credit_note_prefix', 'CR'),
       ('credit_note_start_no', '1'),
       ('credit_note_terms', '<p>Hello        </p>'),
       ('cron_key', '34WI2L12L87I1A65M90M9A42N41D08A26I'),
       ('currency_position', '1'),
       ('date_format', '%m.%d.%Y'),
       ('date_php_format', 'Y.m.d'),
       ('date_picker_format', 'yyyy.mm.dd'),
       ('decimal_separator', ''),
       ('default_account', '7'),
       ('default_currency', 'USD'),
       ('default_currency_symbol', '$'),
       ('default_department', '2'),
       ('default_language', 'english'),
       ('default_leads_source', '1'),
       ('default_lead_permission', 'all'),
       ('default_lead_status', '1'),
       ('default_priority', 'ok'),
       ('default_status', 'closed'),
       ('default_tax', 'N;'),
       ('default_terms',
        'Thank you for <span style=\"font-weight: bold;\">your</span> busasiness. Please process this invoice within the due date.'),
       ('delete_mail_after_import', NULL),
       ('demo_mode', 'FALSE'),
       ('deposit_email', '1'),
       ('desktop_notifications', '1'),
       ('developer', 'ig63Yd/+yuA8127gEyTz9TY4pnoeKq8dtocVP44+BJvtlRp8Vqcetwjk51dhSB6Rx8aVIKOPfUmNyKGWK7C/gg=='),
       ('display_estimate_badge', '0'),
       ('display_invoice_badge', 'FALSE'),
       ('email_account_details', 'TRUE'),
       ('email_estimate_message',
        'Hi {CLIENT}<br>Thanks for your business inquiry. <br>The estimate EST {REF} is attached with this email. <br>Estimate Overview:<br>Estimate # : EST {REF}<br>Amount: {CURRENCY} {AMOUNT}<br> You can view the estimate online at:<br>{LINK}<br>Best Regards,<br>{COMPANY}'),
       ('email_invoice_message',
        'Hello {CLIENT}<br>Here is the invoice of {CURRENCY} {AMOUNT}<br>You can view the invoice online at:<br>{LINK}<br>Best Regards,<br>{COMPANY}'),
       ('email_staff_tickets', 'TRUE'),
       ('enable_languages', 'TRUE'),
       ('encryption', 'ssl'),
       ('estimate_color', 'rgba(160,29,171,1)'),
       ('estimate_footer',
        '<span style=\"font-weight: bold; line-height: 21.4px; text-align: right;\">Estimate&nbsp;</span>was created on a computer and is valid without the signature and seal'),
       ('estimate_language', 'en'),
       ('estimate_number_format', '[INV]-[yyyy]-[mm]-[dd]-[number]'),
       ('estimate_on_calendar', 'on'),
       ('estimate_prefix', 'EST'),
       ('estimate_start_no', '1'),
       ('estimate_state', 'block'),
       ('estimate_terms', 'Hey Looking forward to doing business with you.'),
       ('expense_email', '1'),
       ('favicon', 'uploads/favicon.ico'),
       ('file_max_size', '80000'),
       ('for_invoice', '0'),
       ('for_leads', NULL),
       ('for_tickets', NULL),
       ('gcal_api_key', 'AIzaSyBXcmmcboEyAgtoUtXjKXe4TfpsnEtoUDQ'),
       ('gcal_id', 'kla83orf1u7hrj6p0u5gdmpji4@group.calendar.google.com'),
       ('goal_tracking_color', '#537015'),
       ('goal_tracking_on_calendar', 'on'),
       ('google_api_key', 'AIzaSyDH0Cn1U4RGzExl3IySE9X_ZlXKpyxj2Z4'),
       ('gst_state', 'AN'),
       ('holiday_on_calendar', 'on'),
       ('imap_search', '0'),
       ('imap_search_for_leads', NULL),
       ('imap_search_for_tickets', NULL),
       ('increment_credit_note_number', 'TRUE'),
       ('increment_estimate_number', 'TRUE'),
       ('increment_invoice_number', 'TRUE'),
       ('increment_proposal_number', 'TRUE'),
       ('installed', 'TRUE'),
       ('invoices_due_after', '5'),
       ('invoice_color', '#53b567'),
       ('invoice_footer', 'Invoice was created on a computer and is valid without the signature and seal'),
       ('invoice_language', 'en'),
       ('invoice_logo', 'uploads/thumnail.png'),
       ('invoice_number_format', '[INV]-[yyyy]-[mm]-[dd]-[number]'),
       ('invoice_on_calendar', 'on'),
       ('invoice_prefix', 'INV'),
       ('invoice_start_no', '1'),
       ('invoice_state', 'block'),
       ('invoice_view', '0'),
       ('item_total_qty_alert', 'No'),
       ('job_circular_email', '1'),
       ('language', 'english'),
       ('languages', 'spanish'),
       ('last_autobackup', '1515398440'),
       ('last_check', '1436363002'),
       ('last_cronjob_run', '1515398438'),
       ('last_postmaster_run', '1532751856'),
       ('last_seen_activities', '0'),
       ('last_tickets_postmaster_run', '1532750363'),
       ('layout-boxed', NULL),
       ('layout-fixed', NULL),
       ('layout-h', NULL),
       ('leads_color', '#783131'),
       ('leads_keyword', NULL),
       ('leads_on_calendar', 'on'),
       ('leave_email', '1'),
       ('locale', 'bn_BD'),
       ('login_background', 'uploads/p3.jpg'),
       ('login_bg', 'bg-login.jpg'),
       ('login_position', 'left'),
       ('logofile', '0'),
       ('logo_or_icon', 'logo_title'),
       ('mark_attendance_from_login', 'Yes'),
       ('max_file_size', '5000'),
       ('milestone_color', '#a86495'),
       ('milestone_on_calendar', 'on'),
       ('mollie_api_key', 'test_tkjFqFF6fP92FDSwBDHpeCzBRMBQBD'),
       ('mollie_partner_id', '3106644'),
       ('mollie_status', 'active'),
       ('money_format', '2'),
       ('navbar_logo_background', 'rgba(104,155,162,0.95)'),
       ('notified_user', '[\"1\"]'),
       ('notify_bug_assignment', 'TRUE'),
       ('notify_bug_comments', 'TRUE'),
       ('notify_bug_status', 'TRUE'),
       ('notify_message_received', 'TRUE'),
       ('notify_project_assignments', 'TRUE'),
       ('notify_project_comments', 'TRUE'),
       ('notify_project_files', 'TRUE'),
       ('notify_task_assignments', 'TRUE'),
       ('notify_ticket_reopened', 'TRUE'),
       ('office_hours', '8'),
       ('office_time', 'same_time'),
       ('on_leave_color', '#bd1a10'),
       ('on_leave_on_calendar', 'on'),
       ('opportunities_color', '#349685'),
       ('opportunities_on_calendar', 'on'),
       ('overtime_email', '1'),
       ('payments_color', '#7f21c9'),
       ('payments_on_calendar', 'on'),
       ('paypal_api_password',
        'e64448f3fd988dda8ad7e0b1ba21a14c3e59a959008623d9c8bcfca8ca8f73677a82bc6d14075614ea192a98fa0494259859dd0e229ff831c1cdd7751f440cb0cS8v4CPtSoiC4rDwMliNLKtf35DXaZih8pZ7W6mRM9UJg9jYeKg0wwsnFA5Kqywv'),
       ('paypal_api_username', 'billing_api1.itsolidity.com'),
       ('paypal_cancel_url', 'paypal/cancel'),
       ('paypal_email', 'billing@coderitems.com'),
       ('paypal_ipn_url', 'paypal/t_ipn/ipn'),
       ('paypal_live', 'TRUE'),
       ('paypal_status', 'active'),
       ('paypal_success_url', 'paypal/success'),
       ('payslip_email', '1'),
       ('payumoney_enable_test_mode', NULL),
       ('payumoney_key', 'etzFvcmV'),
       ('payumoney_salt', 'Q3AbuWZ05e'),
       ('payumoney_status', 'active'),
       ('pdf_engine', 'invoicr'),
       ('performance_email', '1'),
       ('postmark_api_key', ''),
       ('postmark_from_address', ''),
       ('project_color', '#e61755'),
       ('project_details_view', '1'),
       ('project_on_calendar', 'on'),
       ('project_prefix', 'PRO'),
       ('proposal_footer',
        '<span style=\"font-weight: 700; text-align: right;\">This Proposal&nbsp;</span>was created on a computer and is valid without the signature and seal'),
       ('proposal_number_format', '[INV]-[yyyy]-[mm]-[dd]-[number]'),
       ('proposal_prefix', 'PRO-'),
       ('proposal_start_no', '1'),
       ('proposal_terms', 'Hey Looking forward to doing business with you.'),
       ('protocol', 'smtp'),
       ('purchase_code', ''),
       ('purchase_number_format', '[INV]-[yyyy]-[mm]-[dd]-[number]'),
       ('purchase_prefix', 'PUR'),
       ('purchase_start_no', '1'),
       ('pusher_app_id', '401479'),
       ('pusher_app_key', '4cf88668659dc9c987c3'),
       ('pusher_app_secret', '6fce183b214d17c20dd5'),
       ('pusher_cluster', 'ap2'),
       ('qty_calculation_from_items', 'Yes'),
       ('realtime_notification', '0'),
       ('recaptcha_secret_key', ''),
       ('recaptcha_site_key', ''),
       ('recurring_invoice', '0'),
       ('reminder_message',
        'Hello {CLIENT}<br>This is a friendly reminder to pay your invoice of {CURRENCY} {AMOUNT}<br>You can view the invoice online at:<br>{LINK}<br>Best Regards,<br>{COMPANY}'),
       ('reset_key', '34WI2L12L87I1A65M90M9A42N41D08A26I'),
       ('return_stock_number_format', '[INV]-[yyyy]-[mm]-[dd]-[number]'),
       ('return_stock_prefix', 'R'),
       ('return_stock_start_no', '1'),
       ('rows_per_table', '25'),
       ('RTL', '0'),
       ('security_token', '5027133599'),
       ('send_email_when_recur', 'TRUE'),
       ('settings', 'theme'),
       ('show_credit_note_tax', 'TRUE'),
       ('show_estimate_tax', 'TRUE'),
       ('show_invoice_tax', 'TRUE'),
       ('show_item_tax', '0'),
       ('show_login_image', 'TRUE'),
       ('show_only_logo', 'FALSE'),
       ('show_proposal_tax', 'TRUE'),
       ('sidebar_active_background', '#0f778e'),
       ('sidebar_active_color', '#b3b8cb'),
       ('sidebar_background', 'rgba(2,53,60,0.95)'),
       ('sidebar_color', '#fffafa'),
       ('sidebar_theme', 'bg-info-dark'),
       ('site_appleicon', 'logo.png'),
       ('site_author', 'William M.'),
       ('site_desc',
        'Ultimate Project Manager CRM Pro is a Web based PHP application for Freelancers - buy it on Codecanyon'),
       ('site_favicon', 'logo.png'),
       ('site_icon', 'fa-flask'),
       ('smtp_encryption', 'tls'),
       ('smtp_host', 'smtp.gmail.com'),
       ('smtp_pass',
        '3e0c1ed254fe1cde02cbd09d2f5b29b347a29a947907028da8c50835fdddc57132c8d2c954c0631354bb48bf98c865a85b5d92f5bc03cb7fd5b25db0f0a2478dy89hgMOMwtLmYOqnIQkcq8LZadeADGy03G2ERRgN+Xk='),
       ('smtp_port', '587'),
       ('smtp_user', 'nayeem.edu01@gmail.com'),
       ('stripe_private_key', 'sk_test_g7PUZTcwwFnxdlHrWSOicHfu'),
       ('stripe_public_key', 'pk_test_x9as1c9jBDpODI7IbC7D0MEB'),
       ('stripe_status', 'active'),
       ('submenu_open_background', '#227f85'),
       ('system_font', 'roboto_condensed'),
       ('tables_pagination_limit', '10'),
       ('tasks_color', '#0239c7'),
       ('tasks_on_calendar', 'on'),
       ('task_details_view', '1'),
       ('thousand_separator', ','),
       ('tickets_keyword', NULL),
       ('timezone', 'Asia/Dhaka'),
       ('time_format', 'H:i'),
       ('top_bar_background', '#1f9494'),
       ('top_bar_color', '#d9d9d9'),
       ('training_email', '1'),
       ('two_checkout_live ', 'FALSE'),
       ('unread_email', 'on'),
       ('use_gravatar', 'TRUE'),
       ('use_postmark', 'FALSE'),
       ('valid_license', 'TRUE'),
       ('version', '6.0.2'),
       ('webmaster_email', 'support@example.com'),
       ('website_name', 'Ultimate Project Manager CRM PRO');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contract_type`
--

CREATE TABLE IF NOT EXISTS `tbl_contract_type`
(
    `contract_type_id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `contract_type`
    varchar
(
    200
) DEFAULT NULL,
    `description` varchar
(
    500
) DEFAULT NULL,
    PRIMARY KEY
(
    `contract_type_id`
)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_countries`
--

CREATE TABLE IF NOT EXISTS `tbl_countries`
(
    `id`
    int
    NOT
    NULL
    AUTO_INCREMENT,
    `value`
    varchar
(
    250
) DEFAULT NULL,
    PRIMARY KEY
(
    `id`
)
    ) ENGINE=InnoDB AUTO_INCREMENT=242 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_countries`
--

INSERT INTO `tbl_countries` (`id`, `value`)
VALUES (1, 'Afghanistan'),
       (2, 'Aringland Islands'),
       (3, 'Albania'),
       (4, 'Algeria'),
       (5, 'American Samoa'),
       (6, 'Andorra'),
       (7, 'Angola'),
       (8, 'Anguilla'),
       (9, 'Antarctica'),
       (10, 'Antigua and Barbuda'),
       (11, 'Argentina'),
       (12, 'Armenia'),
       (13, 'Aruba'),
       (14, 'Australia'),
       (15, 'Austria'),
       (16, 'Azerbaijan'),
       (17, 'Bahamas'),
       (18, 'Bahrain'),
       (19, 'Bangladesh'),
       (20, 'Barbados'),
       (21, 'Belarus'),
       (22, 'Belgium'),
       (23, 'Belize'),
       (24, 'Benin'),
       (25, 'Bermuda'),
       (26, 'Bhutan'),
       (27, 'Bolivia'),
       (28, 'Bosnia and Herzegovina'),
       (29, 'Botswana'),
       (30, 'Bouvet Island'),
       (31, 'Brazil'),
       (32, 'British Indian Ocean territory'),
       (33, 'Brunei Darussalam'),
       (34, 'Bulgaria'),
       (35, 'Burkina Faso'),
       (36, 'Burundi'),
       (37, 'Cambodia'),
       (38, 'Cameroon'),
       (39, 'Canada'),
       (40, 'Cape Verde'),
       (41, 'Cayman Islands'),
       (42, 'Central African Republic'),
       (43, 'Chad'),
       (44, 'Chile'),
       (45, 'China'),
       (46, 'Christmas Island'),
       (47, 'Cocos (Keeling) Islands'),
       (48, 'Colombia'),
       (49, 'Comoros'),
       (50, 'Congo'),
       (51, 'Congo'),
       (52, ' Democratic Republic'),
       (53, 'Cook Islands'),
       (54, 'Costa Rica'),
       (55, 'Ivory Coast (Ivory Coast)'),
       (56, 'Croatia (Hrvatska)'),
       (57, 'Cuba'),
       (58, 'Cyprus'),
       (59, 'Czech Republic'),
       (60, 'Denmark'),
       (61, 'Djibouti'),
       (62, 'Dominica'),
       (63, 'Dominican Republic'),
       (64, 'East Timor'),
       (65, 'Ecuador'),
       (66, 'Egypt'),
       (67, 'El Salvador'),
       (68, 'Equatorial Guinea'),
       (69, 'Eritrea'),
       (70, 'Estonia'),
       (71, 'Ethiopia'),
       (72, 'Falkland Islands'),
       (73, 'Faroe Islands'),
       (74, 'Fiji'),
       (75, 'Finland'),
       (76, 'France'),
       (77, 'French Guiana'),
       (78, 'French Polynesia'),
       (79, 'French Southern Territories'),
       (80, 'Gabon'),
       (81, 'Gambia'),
       (82, 'Georgia'),
       (83, 'Germany'),
       (84, 'Ghana'),
       (85, 'Gibraltar'),
       (86, 'Greece'),
       (87, 'Greenland'),
       (88, 'Grenada'),
       (89, 'Guadeloupe'),
       (90, 'Guam'),
       (91, 'Guatemala'),
       (92, 'Guinea'),
       (93, 'Guinea-Bissau'),
       (94, 'Guyana'),
       (95, 'Haiti'),
       (96, 'Heard and McDonald Islands'),
       (97, 'Honduras'),
       (98, 'Hong Kong'),
       (99, 'Hungary'),
       (100, 'Iceland'),
       (101, 'India'),
       (102, 'Indonesia'),
       (103, 'Iran'),
       (104, 'Iraq'),
       (105, 'Ireland'),
       (106, 'Israel'),
       (107, 'Italy'),
       (108, 'Jamaica'),
       (109, 'Japan'),
       (110, 'Jordan'),
       (111, 'Kazakhstan'),
       (112, 'Kenya'),
       (113, 'Kiribati'),
       (114, 'Korea (north)'),
       (115, 'Korea (south)'),
       (116, 'Kuwait'),
       (117, 'Kyrgyzstan'),
       (118, 'Lao People\'s Democratic Republic'),
(119, 'Latvia'),
(120, 'Lebanon'),
(121, 'Lesotho'),
(122, 'Liberia'),
(123, 'Libyan Arab Jamahiriya'),
(124, 'Liechtenstein'),
(125, 'Lithuania'),
(126, 'Luxembourg'),
(127, 'Macao'),
(128, 'Macedonia'),
(129, 'Madagascar'),
(130, 'Malawi'),
(131, 'Malaysia'),
(132, 'Maldives'),
(133, 'Mali'),
(134, 'Malta'),
(135, 'Marshall Islands'),
(136, 'Martinique'),
(137, 'Mauritania'),
(138, 'Mauritius'),
(139, 'Mayotte'),
(140, 'Mexico'),
(141, 'Micronesia'),
(142, 'Moldova'),
(143, 'Monaco'),
(144, 'Mongolia'),
(145, 'Montserrat'),
(146, 'Morocco'),
(147, 'Mozambique'),
(148, 'Myanmar'),
(149, 'Namibia'),
(150, 'Nauru'),
(151, 'Nepal'),
(152, 'Netherlands'),
(153, 'Netherlands Antilles'),
(154, 'New Caledonia'),
(155, 'New Zealand'),
(156, 'Nicaragua'),
(157, 'Niger'),
(158, 'Nigeria'),
(159, 'Niue'),
(160, 'Norfolk Island'),
(161, 'Northern Mariana Islands'),
(162, 'Norway'),
(163, 'Oman'),
(164, 'Pakistan'),
(165, 'Palau'),
(166, 'Palestinian Territories'),
(167, 'Panama'),
(168, 'Papua New Guinea'),
(169, 'Paraguay'),
(170, 'Peru'),
(171, 'Philippines'),
(172, 'Pitcairn'),
(173, 'Poland'),
(174, 'Portugal'),
(175, 'Puerto Rico'),
(176, 'Qatar'),
(177, 'Runion'),
(178, 'Romania'),
(179, 'Russian Federation'),
(180, 'Rwanda'),
(181, 'Saint Helena'),
(182, 'Saint Kitts and Nevis'),
(183, 'Saint Lucia'),
(184, 'Saint Pierre and Miquelon'),
(185, 'Saint Vincent and the Grenadines'),
(186, 'Samoa'),
(187, 'San Marino'),
(188, 'Sao Tome and Principe'),
(189, 'Saudi Arabia'),
(190, 'Senegal'),
(191, 'Serbia and Montenegro'),
(192, 'Seychelles'),
(193, 'Sierra Leone'),
(194, 'Singapore'),
(195, 'Slovakia'),
(196, 'Slovenia'),
(197, 'Solomon Islands'),
(198, 'Somalia'),
(199, 'South Africa'),
(200, 'South Georgia and the South Sandwich Islands'),
(201, 'Spain'),
(202, 'Sri Lanka'),
(203, 'Sudan'),
(204, 'Suriname'),
(205, 'Svalbard and Jan Mayen Islands'),
(206, 'Swaziland'),
(207, 'Sweden'),
(208, 'Switzerland'),
(209, 'Syria'),
(210, 'Taiwan'),
(211, 'Tajikistan'),
(212, 'Tanzania'),
(213, 'Thailand'),
(214, 'Togo'),
(215, 'Tokelau'),
(216, 'Tonga'),
(217, 'Trinidad and Tobago'),
(218, 'Tunisia'),
(219, 'Turkey'),
(220, 'Turkmenistan'),
(221, 'Turks and Caicos Islands'),
(222, 'Tuvalu'),
(223, 'Uganda'),
(224, 'Ukraine'),
(225, 'United Arab Emirates'),
(226, 'United Kingdom'),
(227, 'United States of America'),
(228, 'Uruguay'),
(229, 'Uzbekistan'),
(230, 'Vanuatu'),
(231, 'Vatican City'),
(232, 'Venezuela'),
(233, 'Vietnam'),
(234, 'Virgin Islands (British)'),
(235, 'Virgin Islands (US)'),
(236, 'Wallis and Futuna Islands'),
(237, 'Western Sahara'),
(238, 'Yemen'),
(239, 'Zaire'),
(240, 'Zambia'),
(241, 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_credit_note`
--

CREATE TABLE IF NOT EXISTS `tbl_credit_note` (
  `credit_note_id` int NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `client_id` int DEFAULT NULL,
  `project_id` int DEFAULT '0',
  `warehouse_id` int DEFAULT NULL,
  `credit_note_date` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `credit_note_month` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `credit_note_year` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `currency` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'USD',
  `discount_percent` int DEFAULT NULL,
  `notes` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tax` int NOT NULL DEFAULT '0',
  `total_tax` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'open',
  `date_saved` timestamp NOT NULL DEFAULT '2018-12-09 23:00:00',
  `emailed` varchar(11) DEFAULT NULL,
  `permission` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `client_visible` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'No',
  `discount_type` enum('none','before_tax','after_tax') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'none',
  `user_id` int DEFAULT '0' COMMENT 'sales agent',
  `adjustment` decimal(18,2) NOT NULL DEFAULT '0.00',
  `discount_total` decimal(18,2) NOT NULL DEFAULT '0.00',
  `show_quantity_as` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tags` text,
  PRIMARY KEY (`credit_note_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_credit_note_items`
--

CREATE TABLE IF NOT EXISTS `tbl_credit_note_items` (
  `credit_note_items_id` int NOT NULL AUTO_INCREMENT,
  `credit_note_id` int NOT NULL,
  `saved_items_id` int DEFAULT '0',
  `item_tax_rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `item_tax_name` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `item_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'Item Name',
  `item_desc` longtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `unit_cost` decimal(10,2) DEFAULT '0.00',
  `quantity` decimal(10,2) DEFAULT '0.00',
  `item_tax_total` decimal(10,2) DEFAULT '0.00',
  `total_cost` decimal(10,2) DEFAULT '0.00',
  `date_saved` timestamp NOT NULL DEFAULT '2018-12-10 06:20:10',
  `unit` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `hsn_code` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `order` int DEFAULT '0',
  PRIMARY KEY (`credit_note_items_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_credit_used`
--

CREATE TABLE IF NOT EXISTS `tbl_credit_used` (
  `credit_used_id` int NOT NULL AUTO_INCREMENT,
  `invoices_id` int NOT NULL,
  `credit_note_id` int NOT NULL,
  `user_id` int NOT NULL,
  `date` date NOT NULL,
  `date_applied` datetime NOT NULL,
  `amount` decimal(18,3) NOT NULL,
  `payments_id` int DEFAULT NULL,
  PRIMARY KEY (`credit_used_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_currencies`
--

CREATE TABLE IF NOT EXISTS `tbl_currencies` (
  `code` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `symbol` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `xrate` decimal(12,5) DEFAULT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_currencies`
--

INSERT INTO `tbl_currencies` (`code`, `name`, `symbol`, `xrate`) VALUES
('AUD', 'Australian Dollar', '$', NULL),
('BAN', 'Bangladesh', 'BDT', NULL),
('BRL', 'Brazilian Real', 'R$', NULL),
('CAD', 'Canadian Dollar', '$', NULL),
('CHF', 'Swiss Franc', 'Fr', NULL),
('CLP', 'Chilean Peso', '$', NULL),
('CNY', 'Chinese Yuan', 'Â¥', NULL),
('CZK', 'Czech Koruna', 'KÄ', NULL),
('DKK', 'Danish Krone', 'kr', NULL),
('EUR', 'Euro', 'EUR', NULL),
('GBP', 'British Pound', 'BP', NULL),
('HKD', 'Hong Kong Dollar', '$', NULL),
('HUF', 'Hungarian Forint', 'Ft', NULL),
('IDR', 'Indonesian Rupiah', 'Rp', NULL),
('ILS', 'Israeli New Shekel', 'IN', NULL),
('INR', 'Indian Rupee', 'INR', NULL),
('JPY', 'Japanese Yen', 'Â¥', NULL),
('KRW', 'Korean Won', 'KW', NULL),
('MXN', 'Mexican Peso', '$', NULL),
('MYR', 'Malaysian Ringgit', 'RM', NULL),
('NOK', 'Norwegian Krone', 'kr', NULL),
('NZD', 'New Zealand Dollar', '$', NULL),
('PHP', 'Philippine Peso', 'PP', NULL),
('PKR', 'Pakistan Rupee', 'PKR', NULL),
('PLN', 'Polish Zloty', 'zl', NULL),
('RUB', 'Russian Ruble', 'RUB', NULL),
('SEK', 'Swedish Krona', 'kr', NULL),
('SGD', 'Singapore Dollar', 'S$', NULL),
('THB', 'Thai Baht', 'TB', NULL),
('TRY', 'Turkish Lira', ' TRY', NULL),
('TWD', 'Taiwan Dollar', 'NT$', NULL),
('USD', 'US Dollar', '$', '1.00000'),
('VEF', 'Bol?var Fuerte', 'Bs.', NULL),
('ZAR', 'South African Rand', 'R', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customer_group`
--

CREATE TABLE IF NOT EXISTS `tbl_customer_group` (
  `customer_group_id` bigint NOT NULL AUTO_INCREMENT,
  `type` varchar(100) DEFAULT NULL COMMENT 'customer group, item group',
  `customer_group` varchar(200) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`customer_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_custom_field`
--

CREATE TABLE IF NOT EXISTS `tbl_custom_field` (
  `custom_field_id` int NOT NULL AUTO_INCREMENT,
  `form_id` int DEFAULT NULL,
  `field_label` varchar(100) NOT NULL,
  `default_value` text,
  `help_text` varchar(200) NOT NULL,
  `field_type` enum('text','textarea','dropdown','date','checkbox','numeric','url','email') NOT NULL,
  `required` varchar(5) NOT NULL DEFAULT 'false',
  `status` enum('active','deactive') NOT NULL DEFAULT 'deactive',
  `show_on_table` varchar(5) DEFAULT NULL,
  `visible_for_admin` varchar(5) DEFAULT NULL,
  `visible_for_client` varchar(11) DEFAULT NULL,
  `show_on_details` varchar(5) NOT NULL DEFAULT '',
  PRIMARY KEY (`custom_field_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_dashboard`
--

CREATE TABLE IF NOT EXISTS `tbl_dashboard` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `col` varchar(200) DEFAULT NULL,
  `order_no` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `report` tinyint(1) NOT NULL DEFAULT '0',
  `for_staff` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_dashboard`
--

INSERT INTO `tbl_dashboard` (`id`, `name`, `col`, `order_no`, `status`, `report`, `for_staff`) VALUES
(1, 'income_expenses_report', 'col-sm-4', 1, 1, 1, 1),
(2, 'invoice_payment_report', 'col-sm-4', 2, 1, 1, 1),
(3, 'ticket_tasks_report', 'col-sm-4', 3, 1, 1, 1),
(5, 'goal_report', 'col-md-6 ', 14, 1, 0, 1),
(6, 'overdue_report', 'col-md-12', 10, 1, 0, 1),
(11, 'my_project', 'col-md-6', 32, 1, 0, 1),
(12, 'my_tasks', 'col-md-6', 35, 1, 0, 1),
(14, 'announcements', 'col-md-6', 38, 1, 0, 1),
(15, 'payments_report', 'col-md-6', 47, 1, 0, 1),
(16, 'income_expense', 'col-md-6', 23, 1, 0, 1),
(17, 'income_report', 'col-md-6', 50, 1, 0, 1),
(18, 'expense_report', 'col-md-6', 44, 1, 0, 1),
(19, 'recently_paid_invoices', 'col-md-6', 29, 1, 0, 1),
(20, 'recent_activities', 'col-md-6', 26, 1, 0, 1),
(21, 'finance_overview', 'col-md-6', 17, 1, 0, 1),
(22, 'todo_list', 'col-md-6', 40, 1, 0, 1),
(23, 'paid_amount', 'col-md-3', 2, 1, 2, 1),
(24, 'due_amount', 'col-md-3', 4, 1, 2, 1),
(25, 'invoice_amount', 'col-md-3', 1, 1, 2, 1),
(26, 'paid_percentage', 'col-md-3', 3, 1, 2, 1),
(27, 'recently_paid_invoices', 'col-sm-6', 2, 1, 3, 1),
(28, 'payments', 'col-sm-6', 1, 1, 3, 1),
(29, 'recent_invoice', 'col-sm-6', 3, 1, 3, 1),
(30, 'recent_projects', 'col-sm-6', 4, 1, 3, 1),
(31, 'recent_emails', 'col-sm-4', 5, 1, 3, 1),
(32, 'recent_activities', 'col-sm-4', 6, 1, 3, 1),
(33, 'announcements', 'col-sm-4', 7, 1, 3, 1),
(34, 'my_calendar', 'col-md-6', 18, 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_days`
--

CREATE TABLE IF NOT EXISTS `tbl_days` (
  `day_id` int NOT NULL AUTO_INCREMENT,
  `day` varchar(100) NOT NULL,
  PRIMARY KEY (`day_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_days`
--

INSERT INTO `tbl_days` (`day_id`, `day`) VALUES
(1, 'Saturday'),
(2, 'Sunday'),
(3, 'Monday'),
(4, 'Tuesday'),
(5, 'Wednesday'),
(6, 'Thursday'),
(7, 'Friday');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_departments`
--

CREATE TABLE IF NOT EXISTS `tbl_departments` (
  `departments_id` int NOT NULL AUTO_INCREMENT,
  `deptname` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `department_head_id` int DEFAULT NULL COMMENT 'department_head_id == user_id',
  `email` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `encryption` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `host` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `password` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `mailbox` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `unread_email` tinyint(1) NOT NULL DEFAULT '0',
  `delete_mail_after_import` tinyint(1) NOT NULL DEFAULT '0',
  `last_postmaster_run` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  PRIMARY KEY (`departments_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_designations`
--

CREATE TABLE IF NOT EXISTS `tbl_designations` (
  `designations_id` int NOT NULL AUTO_INCREMENT,
  `departments_id` int NOT NULL,
  `designations` varchar(100) NOT NULL,
  `permission` text,
  PRIMARY KEY (`designations_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_discipline`
--

CREATE TABLE IF NOT EXISTS `tbl_discipline` (
  `discipline_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `offence_id` int NOT NULL,
  `penalty_id` int NOT NULL,
  `discipline_break_date` varchar(100) NOT NULL,
  `discipline_action_date` varchar(100) NOT NULL,
  `discipline_remarks` varchar(200) NOT NULL,
  `discipline_comments` varchar(200) NOT NULL,
  PRIMARY KEY (`discipline_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_draft`
--

CREATE TABLE IF NOT EXISTS `tbl_draft` (
  `draft_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `to` text NOT NULL,
  `subject` varchar(300) NOT NULL,
  `message_body` text NOT NULL,
  `attach_file` text,
  `attach_file_path` text,
  `attach_filename` text,
  `message_time` datetime NOT NULL,
  `deleted` enum('Yes','No') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`draft_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_email_templates`
--

CREATE TABLE IF NOT EXISTS `tbl_email_templates` (
  `email_templates_id` int NOT NULL AUTO_INCREMENT,
  `code` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email_group` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `template_body` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`email_templates_id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_email_templates`
--

INSERT INTO `tbl_email_templates` (`email_templates_id`, `code`, `email_group`, `subject`, `template_body`) VALUES
(1, 'en', 'registration', 'Registration successful', '<div style=\"height: 7px; background-color: #535353;\"></div><div style=\"background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;\"><div style=\"text-align:center; font-size:24px; font-weight:bold; color:#535353;\">Welcome to {SITE_NAME}</div><div style=\"border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;\">Thanks for joining {SITE_NAME}. We listed your sign in details below, make sure you keep them safe.<br>To open your {SITE_NAME} homepage, please follow this link:<br><big><b><a href=\"{SITE_URL}\">{SITE_NAME} Account!</a></b></big><br>Link doesn\'t work? Copy the following link to your browser address bar:<br><a href=\"{SITE_URL}\">{SITE_URL}</a><br>Your username: {USERNAME}<br>Your email address: {EMAIL}<br>Your password: {PASSWORD}<br>Have fun!<br>The {SITE_NAME} Team.<br><br></div></div>'),
(2, 'en', 'forgot_password', 'Forgot Password', '        <div style=\"height: 7px; background-color: #535353;\"></div><div style=\"background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;\"><div style=\"text-align:center; font-size:24px; font-weight:bold; color:#535353;\">New Password</div><div style=\"border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;\">Forgot your password, huh? No big deal.<br>To create a new password, just follow this link:<br><br><big><b><a href=\"{PASS_KEY_URL}\">Create a new password</a></b></big><br>Link doesn\'t work? Copy the following link to your browser address bar:<br><a href=\"{PASS_KEY_URL}\">{PASS_KEY_URL}</a><br><br><br>You received this email, because it was requested by a <a href=\"{SITE_URL}\">{SITE_NAME}</a> user. <p></p><p>This is part of the procedure to create a new password on the system. If you DID NOT request a new password then please ignore this email and your password will remain the same.</p><br>Thank you,<br>The {SITE_NAME} Team</div></div>'),
(3, 'en', 'change_email', 'Change Email', '<div style=\"height: 7px; background-color: #535353;\"></div>\r\n<div style=\"background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;\"><div style=\"text-align:center; font-size:24px; font-weight:bold; color:#535353;\">New email address on {SITE_NAME}</div>\r\n\r\n<div style=\"border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;\">You have changed your email address for {SITE_NAME}.<br>Follow this link to confirm your new email address:<br><big><b><a href=\"{NEW_EMAIL_KEY_URL}\">Confirm your new email</a></b></big><br>Link doesn\'t work? Copy the following link to your browser address bar:<br><a href=\"{NEW_EMAIL_KEY_URL}\">{NEW_EMAIL_KEY_URL}</a><br><br>Your email address: {NEW_EMAIL}<br><br>You received this email, because it was requested by a <a href=\"{SITE_URL}\">{SITE_NAME}</a> user. If you have received this by mistake, please DO NOT click the confirmation link, and simply delete this email. After a short time, the request will be removed from the system.<br>Thank you,<br>The {SITE_NAME} Team</div>\r\n\r\n</div>'),
(4, 'en', 'activate_account', 'Activate Account', '<p>Welcome to {SITE_NAME}!</p>\r\n\r\n<p>Thanks for joining {SITE_NAME}. We listed your sign in details below, make sure you keep them safe.</p>\r\n\r\n<p>To verify your email address, please follow this link:<br />\r\n<big><strong><a href=\"{ACTIVATE_URL}\">Finish your registration...</a></strong></big><br />\r\nLink doesn&#39;t work? Copy the following link to your browser address bar:<br />\r\n<a href=\"{ACTIVATE_URL}\">{ACTIVATE_URL}</a></p>\r\n\r\n<p><br />\r\n<br />\r\nPlease verify your email within {ACTIVATION_PERIOD} hours, otherwise your registration will become invalid and you will have to register again.<br />\r\n<br />\r\n<br />\r\nYour username: {USERNAME}<br />\r\nYour email address: {EMAIL}<br />\r\nYour password: {PASSWORD}<br />\r\n<br />\r\nHave fun!<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(5, 'en', 'reset_password', 'Reset Password', '<div style=\"height: 7px; background-color: #535353;\"></div>\r\n<div style=\"background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;\"><div style=\"text-align:center; font-size:24px; font-weight:bold; color:#535353;\">New password on {SITE_NAME}</div>\r\n<div style=\"border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;\"><p>You have changed your password.<br>Please, keep it in your records so you don\'t forget it.<br></p>\r\nYour username: {USERNAME}<br>Your email address: {EMAIL}<br>Your new password: {NEW_PASSWORD}<br><br>Thank you,<br>The {SITE_NAME} Team</div>\r\n</div>'),
(6, 'en', 'bug_assigned', 'New Bug Assigned', '<p>Hi there,</p>\r\n\r\n<p>A new bug &nbsp;{BUG_TITLE} &nbsp;has been assigned to you by {ASSIGNED_BY}.</p>\r\n\r\n<p>You can view this bug by logging in to the portal using the link below.</p>\r\n\r\n<p><br />\r\n<big><strong><a href=\"{BUG_URL}\">View Bug</a></strong></big><br />\r\n<br />\r\nRegards<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(7, 'en', 'bug_updated', 'Bug status changed', '<p>Hi there,</p>\r\n\r\n<p>Bug {BUG_TITLE} has been marked as {STATUS} by {MARKED_BY}.</p>\r\n\r\n<p>You can view this bug by logging in to the portal using the link below.</p>\r\n\r\n<p><big><strong><a href=\"{BUG_URL}\">View Bug</a></strong></big><br />\r\nRegards<br />\r\nThe {SITE_NAME} Team</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(8, 'en', 'bug_comments', 'New Bug Comment Received', '<p>Hi there,</p>\r\n\r\n<p>A new comment has been posted by {POSTED_BY} to bug {BUG_TITLE}.</p>\r\n\r\n<p>You can view the comment using the link below.</p>\r\n\r\n<p><em>{COMMENT_MESSAGE}</em></p>\r\n\r\n<p><br />\r\n<big><strong><a href=\"{COMMENT_URL}\">View Comment</a></strong></big><br />\r\nRegards<br />\r\nThe {SITE_NAME} Team</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(9, 'en', 'bug_attachment', 'New bug attachment', '<p>Hi there,</p>\r\n\r\n<p>A new attachment&nbsp;has been uploaded by {UPLOADED_BY} to issue {BUG_TITLE}.</p>\r\n\r\n<p>You can view the bug using the link below.</p>\r\n\r\n<p><br />\r\n<big><strong><a href=\"{BUG_URL}\">View Bug</a></strong></big></p>\r\n\r\n<p><br />\r\nRegards<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(10, 'en', 'bug_reported', 'New bug Reported', '<p>Hi there,</p>\r\n\r\n<p>A new bug ({BUG_TITLE}) has been reported by {ADDED_BY}.</p>\r\n\r\n<p>You can view the Bug using the Dashboard Page.</p>\r\n\r\n<p><br />\r\n<big><strong><a href=\"{BUG_URL}\">View Bug</a></strong></big></p>\r\n\r\n<p><br />\r\nRegards<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(13, 'en', 'refund_confirmation', 'Refund Confirmation', '<p>Refund Confirmation</p>\r\n\r\n<p>Hello {CLIENT}</p>\r\n\r\n<p>This is confirmation that a refund has been processed for Invoice&nbsp; of {CURRENCY} {AMOUNT}&nbsp;sent on {INVOICE_DATE}.<br />\r\nYou can view the invoice online at:<br />\r\n<big><strong><a href=\"{INVOICE_LINK}\">View Invoice</a></strong></big><br />\r\n<br />\r\nBest Regards,<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(14, 'en', 'payment_confirmation', 'Payment Confirmation', '<p>Payment Confirmation</p>\r\n\r\n<p>Hello {CLIENT}</p>\r\n\r\n<p>This is a payment receipt for your invoice of {CURRENCY} {AMOUNT}&nbsp;sent on {INVOICE_DATE}.<br />\r\nYou can view the invoice online at:<br />\r\n<big><strong><a href=\"{INVOICE_LINK}\">View Invoice</a></strong></big><br />\r\n<br />\r\nBest Regards,<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(15, 'en', 'payment_email', 'Payment Received', '<div style=\"height: 7px; background-color: #535353;\"></div>\n<div style=\"background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;\"><div style=\"text-align:center; font-size:24px; font-weight:bold; color:#535353;\">Payment Received</div>\n<div style=\"border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;\"><p>Dear Customer</p>\n<p>We have received your payment of {INVOICE_CURRENCY} {PAID_AMOUNT}. </p>\n<p>Thank you for your Payment and business. We look forward to working with you again.</p>\n--------------------------<br>Regards<br>The {SITE_NAME} Team</div>\n</div>'),
(16, 'en', 'invoice_overdue_email', 'Invoice Overdue Notice', '<p>Invoice Overdue</p>\r\n\r\n<p>INVOICE {REF}</p>\r\n\r\n<p><strong>Hello {CLIENT}</strong></p>\r\n\r\n<p>This is the notice that your invoice overdue.&nbsp;The invoice {CURRENCY} {AMOUNT}. and Due Date: {DUE_DATE}</p>\r\n\r\n<p>You can view the invoice online at:<br />\r\n<big><strong><a href=\"{INVOICE_LINK}\">View Invoice</a></strong></big><br />\r\n<br />\r\nBest Regards,<br />\r\nThe {SITE_NAME} Team</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(17, 'en', 'invoice_message', 'New Invoice', '<div style=\"height: 7px; background-color: #535353;\"></div><div style=\"background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;\"><div style=\"text-align:center; font-size:24px; font-weight:bold; color:#535353;\">INVOICE {REF}</div><div style=\"border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;\"><span class=\"style1\"><span style=\"font-weight:bold;\">Hello {CLIENT}</span></span><br><br>Here is the invoice of {CURRENCY} {AMOUNT}.<br><br>You can view the invoice online at:<br><big><b><a href=\"{INVOICE_LINK}\">View Invoice</a></b></big><br><br>Best Regards<br><br>The {SITE_NAME} Team</div></div>'),
(18, 'en', 'invoice_reminder', 'Invoice Reminder', '<div style=\"height: 7px; background-color: #535353;\"></div>\r\n<div style=\"background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;\"><div style=\"text-align:center; font-size:24px; font-weight:bold; color:#535353;\">Invoice Reminder</div>\r\n<div style=\"border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;\"><p>Hello {CLIENT}</p>\r\n<br><p>This is a friendly reminder to pay your invoice of {CURRENCY} {AMOUNT}<br>You can view the invoice online at:<br><big><b><a href=\"{INVOICE_LINK}\">View Invoice</a></b></big><br><br>Best Regards,<br>The {SITE_NAME} Team</p>\r\n</div>\r\n</div>'),
(19, 'en', 'message_received', 'Message Received', '<div style=\"height: 7px; background-color: #535353;\"></div>\r\n<div style=\"background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;\"><div style=\"text-align:center; font-size:24px; font-weight:bold; color:#535353;\">Message Received</div>\r\n<div style=\"border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;\"><p>Hi {RECIPIENT},</p>\r\n<p>You have received a message from {SENDER}. </p>\r\n------------------------------------------------------------------<br><blockquote>\r\n{MESSAGE}</blockquote>\r\n<big><b><a href=\"{SITE_URL}\">Go to Account</a></b></big><br><br>Regards<br>The {SITE_NAME} Team</div>\r\n</div>'),
(20, 'en', 'estimate_email', 'New Estimate', '<p>Estimate {ESTIMATE_REF}</p>\r\n\r\n<p>Hi {CLIENT}</p>\r\n\r\n<p>Thanks for your business inquiry.</p>\r\n\r\n<p>The estimate {ESTIMATE_REF} is attached with this email.<br />\r\nEstimate Overview:<br />\r\nEstimate # : {ESTIMATE_REF}<br />\r\nAmount: {CURRENCY} {AMOUNT}<br />\r\n<br />\r\nYou can view the estimate online at:<br />\r\n<big><strong><a href=\"{ESTIMATE_LINK}\">View Estimate</a></strong></big><br />\r\n<br />\r\nBest Regards,<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(21, 'en', 'ticket_staff_email', 'New Ticket [TICKET_CODE]', '<div style=\"height: 7px; background-color: #535353;\"></div>\r\n<div style=\"background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;\"><div style=\"text-align:center; font-size:24px; font-weight:bold; color:#535353;\">New Ticket</div>\r\n<div style=\"border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;\"><p>Ticket #{TICKET_CODE} has been created by the client.</p>\r\n<p>You may view the ticket by clicking on the following link <br><br>  Client Email : {REPORTER_EMAIL}<br><br> <big><b><a href=\"{TICKET_LINK}\">View Ticket</a></b></big> <br><br>Regards<br><br>{SITE_NAME}</p>\r\n</div>\r\n</div>'),
(22, 'en', 'ticket_client_email', 'Ticket [TICKET_CODE] Opened', '<p>Ticket Opened</p>\r\n\r\n<p>Hello {CLIENT_EMAIL},</p>\r\n\r\n<p>Your ticket has been opened with us.<br />\r\n<br />\r\nTicket # {TICKET_CODE}<br />\r\nStatus : Open<br />\r\n<br />\r\nClick on the below link to see the ticket details and post additional comments.<br />\r\n<br />\r\n<big><strong><a href=\"{TICKET_LINK}\">View Ticket</a></strong></big><br />\r\n<br />\r\nRegards<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(23, 'en', 'ticket_reply_email', 'Ticket [TICKET_CODE] Response', '<div style=\"height: 7px; background-color: #535353;\"></div>\r\n<div style=\"background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;\"><div style=\"text-align:center; font-size:24px; font-weight:bold; color:#535353;\">Ticket Response</div>\r\n<div style=\"border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;\"><p>A new response has been added to Ticket #{TICKET_CODE}<br><br> Ticket : #{TICKET_CODE} <br>Status : {TICKET_STATUS} <br><br></p>\r\nTo see the response and post additional comments, click on the link below.<br><br>         <big><b><a href=\"{TICKET_LINK}\">View Reply</a> </b></big><br><br>          Note: Do not reply to this email as this email is not monitored.<br><br>     Regards<br>The {SITE_NAME} Team<br></div>\r\n</div>'),
(24, 'en', 'ticket_closed_email', 'Ticket [TICKET_CODE] Closed', '<div style=\"height: 7px; background-color: #535353;\"></div>\r\n<div style=\"background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;\"><div style=\"text-align:center; font-size:24px; font-weight:bold; color:#535353;\">Ticket Closed</div>\r\n<div style=\"border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;\">Hi {REPORTER_EMAIL}<br><br>Ticket #{TICKET_CODE} has been closed by {STAFF_USERNAME} <br><br>          Ticket : #{TICKET_CODE} <br>     Status : {TICKET_STATUS}<br><br>Replies : {NO_OF_REPLIES}<br><br>          To see the responses or open the ticket, click on the link below.<br><br>          <big><b><a href=\"{TICKET_LINK}\">View Ticket</a></b></big> <br><br>          Note: Do not reply to this email as this email is not monitored.<br><br>    Regards<br>The {SITE_NAME} Team</div>\r\n</div>'),
(26, 'en', 'task_updated', 'Task updated', '<div style=\"height: 7px; background-color: #535353;\"></div>\r\n<div style=\"background-color:#E8E8E8; margin:0px; padding:55px 20px 40px 20px; font-family:Open Sans, Helvetica, sans-serif; font-size:12px; color:#535353;\"><div style=\"text-align:center; font-size:24px; font-weight:bold; color:#535353;\">Task updated</div>\r\n<div style=\"border-radius: 5px 5px 5px 5px; padding:20px; margin-top:45px; background-color:#FFFFFF; font-family:Open Sans, Helvetica, sans-serif; font-size:13px;\"><p>Hi there,</p>\r\n<p>{TASK_NAME} in {PROJECT_TITLE} has been updated by {ASSIGNED_BY}.</p>\r\n<p>You can view this project by logging in to the portal using the link below.</p>\r\n-----------------------------------<br><big><b><a href=\"{PROJECT_URL}\">View Project</a></b></big><br><br>Regards<br>The {SITE_NAME} Team</div>\r\n</div>'),
(27, 'en', 'quotations_form', 'Your Quotation Request', '<p>QUOTATION</p>\r\n\r\n\r\n<p><strong>Hello {CLIENT}</strong><br>\r\n </p>\r\n\r\n\r\n<p>Thank you for you for filling in our Quotation Request Form.<br>\r\n<br>\r\nPlease find below are our quotation:</p>\r\n\r\n\r\n<p> </p>\r\n\r\n\r\n<table cellpadding=\"8\" xss=removed>\r\n\r\n <tbody>\r\n\r\n  <tr>\r\n\r\n   <td>Quotation Date</td>\r\n\r\n   <td><strong>{DATE}</strong></td>\r\n\r\n  </tr>\r\n\r\n  <tr>\r\n\r\n   <td>Our Quotation</td>\r\n\r\n   <td><strong>{CURRENCY} {AMOUNT}</strong></td>\r\n\r\n  </tr>\r\n\r\n  <tr>\r\n\r\n   <td>Addtitional Comments</td>\r\n\r\n   <td><strong>{NOTES}</strong></td>\r\n\r\n  </tr>\r\n\r\n </tbody>\r\n\r\n</table>\r\n\r\n\r\n<p><br>\r\nYou can view the estimate online at:<br>\r\n<big><strong><a href=\"{QUOTATION_LINK}\">View Quotation</a></strong></big></p>\r\n\r\n\r\n<p> </p>\r\n\r\n\r\n<p><br>\r\nThank you and we look forward to working with you.<br>\r\n<br>\r\nBest Regards,<br>\r\nThe {SITE_NAME} Team</p>\r\n\r\n\r\n<p> </p>'),
(28, 'en', 'client_notification', 'New project created', '<p>Hello, <strong>{CLIENT_NAME}</strong>,<br />\r\nwe have created a new project with your account.<br />\r\n<br />\r\nProject name : <strong>{PROJECT_NAME}</strong><br />\r\nYou can login to see the status of your project by using this link:<br />\r\n<big><a href=\"{PROJECT_LINK}\"><strong>View Project</strong></a></big></p>\r\n\r\n<p><br />\r\nBest Regards<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(29, 'en', 'assigned_project', 'Assigned Project', '<p>Hi There,</p>\r\n\r\n<p>A<strong> {PROJECT_NAME}</strong> has been assigned by <strong>{ASSIGNED_BY} </strong>to you.You can view this project by logging in to the portal using the link below:<br />\r\n<big><a href=\"{PROJECT_URL}\"><strong>View Project</strong></a></big><br />\r\n<br />\r\nBest Regards<br />\r\nThe {SITE_NAME} Team</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(30, 'en', 'complete_projects', 'Project Completed', '<p>Hi <strong>{CLIENT_NAME}</strong>,</p>\r\n\r\n<p>Project : <strong>{PROJECT_NAME}</strong> &nbsp;has been completed.<br />\r\nYou can view the project by logging into your portal Account:<br />\r\n<big><a href=\"{PROJECT_LINK}\"><strong>View Project</strong></a></big><br />\r\n<br />\r\nBest Regards,<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(31, 'en', 'project_comments', 'New Project Comment Received', '<p>Hi There,</p>\r\n\r\n<p>A new comment has been posted by <strong>{POSTED_BY}</strong> to project <strong>{PROJECT_NAME}</strong>.</p>\r\n\r\n<p>You can view the comment using the link below:<br />\r\n<big><a href=\"{COMMENT_URL}\"><strong>View Project</strong></a></big><br />\r\n<br />\r\n<em>{COMMENT_MESSAGE}</em><br />\r\n<br />\r\nBest Regards,<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(32, 'en', 'project_attachment', 'New Project  Attachment', '<p>Hi There,</p>\r\n\r\n<p>A new file has been uploaded by <strong>{UPLOADED_BY}</strong> to project <strong>{PROJECT_NAME}</strong>.<br />\r\nYou can view the Project using the link below:<br />\r\n<big><a href=\"{PROJECT_URL}\"><strong>View Project</strong></a></big><br />\r\n<br />\r\n<br />\r\nBest Regards,<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(33, 'en', 'responsible_milestone', 'Responsible for a Milestone', '<p>Hi There,</p>\r\n\r\n<p>You are a responsible&nbsp;for a project milestone&nbsp;<strong>{MILESTONE_NAME}</strong>&nbsp; assigned to you by <strong>{ASSIGNED_BY}</strong> in project <strong>{PROJECT_NAME}</strong>.</p>\r\n\r\n<p>You can view this Milestone&nbsp;by logging in to the portal using the link below:<br />\r\n<big><strong><a href=\"{PROJECT_URL}\">View Project</a></strong></big><br />\r\n<br />\r\n<br />\r\nBest Regards,<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(34, 'en', 'task_assigned', 'Task assigned', '<p>Hi there,</p>\r\n\r\n<p>A new task <strong>{TASK_NAME}</strong> &nbsp;has been assigned to you by <strong>{ASSIGNED_BY}</strong>.</p>\r\n\r\n<p>You can view this task by logging in to the portal using the link below.</p>\r\n\r\n<p><br />\r\n<big><strong><a href=\"{TASK_URL}\">View Task</a></strong></big><br />\r\n<br />\r\nRegards<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(35, 'en', 'tasks_comments', 'New Task Comment Received', '<p>Hi There,</p>\r\n\r\n<p>A new comment has been posted by <strong>{POSTED_BY}</strong> to <strong>{TASK_NAME}</strong>.</p>\r\n\r\n<p>You can view the comment using the link below:<br />\r\n<big><strong><a href=\"{COMMENT_URL}\">View Comment</a></strong></big><br />\r\n<br />\r\n<em>{COMMENT_MESSAGE}</em><br />\r\n<br />\r\nBest Regards,<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(36, 'en', 'tasks_attachment', 'New Tasks Attachment', '<p>Hi There,</p>\r\n\r\n<p>A new file has been uploaded by <strong>{UPLOADED_BY} </strong>to Task <strong>{TASK_NAME}</strong>.<br />\r\nYou can view the Task&nbsp;using the link below:</p>\r\n\r\n<p><br />\r\n<big><a href=\"{TASK_URL}\"><strong>View Task</strong></a></big><br />\r\n<br />\r\nBest Regards,<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(37, 'en', 'tasks_updated', 'Task updated', '<p>Hi there,</p>\r\n\r\n<p><strong>{TASK_NAME}</strong> has been updated by <strong>{ASSIGNED_BY}</strong>.</p>\r\n\r\n<p>You can view this Task by logging in to the portal using the link below.</p>\r\n\r\n<p><br />\r\n<big><strong><a href=\"{TASK_URL}\">View Task</a></strong></big><br />\r\n<br />\r\nRegards<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(38, 'en', 'goal_not_achieve', 'Not Achieve Goal', '<p><strong>Unfortunately!</strong> We failed to achieve goal!</p>\r\n\r\n<p><strong>Here is a Goal Details</strong></p>\r\n\r\n<p>Goal Type :&nbsp;<strong>{Goal_Type}</strong><br />\r\nTarget Achievement:&nbsp;<strong>{achievement}</strong><br />\r\nTotal Achievement:&nbsp;<strong>{total_achievement}</strong><br />\r\nStart Date:&nbsp;<strong>{start_date}</strong><br />\r\nEnd Date:&nbsp;<strong>{End_date}</strong><br />\r\n&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(39, 'en', 'goal_achieve', 'Achieve Goal', '<p><strong>Congratulation!</strong> We achieved new goal.</p>\r\n\r\n<p><strong>Here is a Goal Details</strong></p>\r\n\r\n<p>Goal Type :<strong>{Goal_Type}</strong><br />\r\nTarget Achievement:<strong>{achievement}</strong><br />\r\nTotal Achievement:<strong>{total_achievement}</strong><br />\r\nStart Date:<strong>{start_date}</strong><br />\r\nEnd Date:<strong>{End_date}</strong><br />\r\n&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(40, 'en', 'leave_request_email', 'A Leave Request from you', '<p>Hi there,</p>\r\n\r\n<p><strong>{NAME}</strong> &nbsp;Want to leave from you.</p>\r\n\r\n<p>You can view this leave request by logging in to the portal using the link below<br />\r\n<big><strong><a href=\"{APPLICATION_LINK}\">View Application</a></strong></big><br />\r\n<br />\r\n<br />\r\nRegards<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(41, 'en', 'leave_approve_email', 'Your leave request has been approved', '<h1>Your leave request has been approved</h1>\r\n\r\n<p><strong>Congratulations!</strong> Your leave request from <strong>{START_DATE}</strong> to <strong>{END_DATE}</strong> has been approved by your company management.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><br />\r\nRegards<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(42, 'en', 'leave_reject_email', 'Your leave request has been Rejected', '<h1>Your leave request has been Rejected</h1>\r\n\r\n<p><strong>Unfortunately !</strong>&nbsp;Your leave request from&nbsp;<strong>{START_DATE}</strong>&nbsp;to&nbsp;<strong>{END_DATE}</strong>&nbsp;has been Rejected by your company management.</p>\r\n\r\n<p><br />\r\nRegards<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(43, 'en', 'overtime_request_email', 'Overtime Request', '<p>Hi there,</p>\r\n\r\n<p><strong>{NAME}</strong>&nbsp;&nbsp;to do an overtime.<br />\r\n<br />\r\n<br />\r\nRegards<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(44, 'en', 'overtime_approved_email', 'Your overtime request has been approved', '<h1>Your leave request has been approved</h1>\r\n\r\n<p><strong>Congratulations!</strong>&nbsp;Your overtime&nbsp;request at&nbsp;<strong>{DATE}</strong>&nbsp;and&nbsp;<strong>{HOUR}</strong>&nbsp;has been approved by your company management.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><br />\r\nRegards<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(45, 'en', 'overtime_reject_email', 'Your Overtime request has been Rejected', '<h1>Your leave request has been Rejected</h1>\r\n\r\n<p><strong>Unfortunately&nbsp;!</strong>&nbsp;Your overtime&nbsp;request at&nbsp;<strong>{DATE}</strong>&nbsp;and&nbsp;<strong>{HOUR}</strong>&nbsp;has been Rejected by your company management.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p><br />\r\nRegards<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(46, 'en', 'wellcome_email', 'Welcome Email ', '<p>Hello <strong>{NAME}</strong>,</p>\r\n\r\n<p>Welcome to <strong>{COMPANY_NAME}</strong> .Thanks for joining <strong>{COMPANY_NAME}</strong>.</p>\r\n\r\n<p>We just wanted to say welcome.</p>\r\n\r\n<p>Please contact us if you need any help.</p>\r\n\r\n<p>Click here to view your profile: <strong>{COMPANY_URL}</strong></p>\r\n\r\n<p><br />\r\nHave fun!<br />\r\nThe <strong>{COMPANY_NAME}</strong> Team.</p>\r\n'),
(47, 'en', 'payslip_generated_email', 'Payslip generated', '<p>Hello&nbsp;<strong>{NAME}</strong>,</p>\r\n\r\n<p>Your payslip generated for the month <strong>{MONTH_YEAR} .</strong></p>\r\n\r\n<p><br />\r\nRegards<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(48, 'en', 'advance_salary_email', 'Advance Salary Reqeust', '<p>Hi there,</p>\r\n\r\n<p><strong>{NAME}</strong>&nbsp;&nbsp;Want to Advance Salary from you.</p>\r\n\r\n<p>You can view this Advance Salary by logging in to the portal using the link below.<br />\r\n<br />\r\n<big><strong><a href=\"{LINK}\">View Advance Salary</a></strong></big><br />\r\n<br />\r\n<br />\r\nRegards<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(49, 'en', 'advance_salary_approve_email', 'Your advance salary request has been approved', '<h1>Your advance salary request has been approved</h1>\r\n\r\n<p><strong>Congratulations!</strong>&nbsp;Your advance salary&nbsp;requested &nbsp;<strong>{AMOUNT}</strong>&nbsp;has been approved by your company management.</p>\r\n\r\n<p>This advance amount will deduct the next <strong>{DEDUCT_MOTNH}</strong> .</p>\r\n\r\n<p><br />\r\nRegards<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(50, 'en', 'advance_salary_reject_email', 'Your advance salary request has been Rejected', '<h1>Your advance salary request has been Rejected</h1>\r\n\r\n<p><strong>Unfortunately !</strong>&nbsp;Your advance salary requested&nbsp;<strong>{AMOUNT}</strong>&nbsp;has been Rejected by your company management.</p>\r\n\r\n<p><br />\r\nRegards<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(51, 'en', 'award_email', 'Award Received', '<p>Hello&nbsp;<strong>{NAME}</strong>,</p>\r\n\r\n<p>You have been&nbsp;awarded <strong>{AWARD_NAME} </strong>for this<strong> {MONTH} .</strong></p>\r\n\r\n<p><br />\r\nRegards<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(52, 'en', 'new_job_application_email', 'New job application submitted', '<p>Hi there,</p>\r\n\r\n<p>&nbsp;<strong>{NAME}&nbsp;</strong>has submitted the job application</p>\r\n\r\n<p>Please find below are job application Details:</p>\r\n\r\n<table cellpadding=\"8\" style=\"width:100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>Job Title</td>\r\n			<td><strong>{JOB_TITLE}</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Email</td>\r\n			<td><strong>{EMAIL}</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Mobile</td>\r\n			<td><strong>{MOBILE}</strong></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Cover Latter</td>\r\n			<td><strong>{COVER_LETTER}</strong></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<p><br />\r\nYou can view the Job Application online at:<br />\r\n<br />\r\n<big><strong><a href=\"{LINK}\">View Job Application</a></strong></big><br />\r\n<br />\r\nBest Regards,<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(53, 'en', 'new_notice_published', 'New Notice published', '<p>Hello&nbsp;<strong>{NAME}</strong>,</p>\r\n\r\n<p>New Notice Published&nbsp;<strong>{TITLE}</strong></p>\r\n\r\n<p><br />\r\nYou can view the Notice online at:<br />\r\n<br />\r\n<big><strong><a href=\"{LINK}\">View Notice</a></strong></big><br />\r\n<br />\r\nBest Regards,<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(54, 'en', 'new_training_email', 'Training  Assigned ', '<p>Hi there,</p>\r\n\r\n<p>A new Training  &nbsp;<strong>{TRAINING_NAME}</strong>&nbsp;&nbsp;has been assigned to you by&nbsp;<strong>{ASSIGNED_BY}</strong>.</p>\r\n\r\n<p>You can view this Training  by logging in to the portal using the link below.</p>\r\n\r\n<p><br />\r\n<big><strong><a href=\"{LINK}\">View Training</a></strong></big><br />\r\n<br />\r\nRegards<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(55, 'en', 'performance_appraisal_email', 'New Performance Appraisal', ''),
(56, 'en', 'expense_request_email', 'A New Expense Request have been Recieved', '<p>Hi there,</p>\r\n\r\n<p><strong>{NAME}</strong> &nbsp;Create a New Expense The Amount is <strong>{AMOUNT}</strong></p>\r\n\r\n<p>You can view this expense by logging in to the portal using the link below.<br />\r\n<br />\r\n<big><strong><a href=\"{URL}\">View Expense</a></strong></big><br />\r\n<br />\r\n<br />\r\nRegards,<br />\r\n<br />\r\nThe <strong>{SITE_NAME}</strong> Team</p>\r\n'),
(57, 'en', 'expense_approved_email', 'Expense Approved', '<p>Dear&nbsp;<strong>{NAME} ,</strong></p>\r\n\r\n<h1>Your Expense request has been approved</h1>\r\n\r\n<p><strong>Congratulations!</strong>&nbsp;Your Expense request from&nbsp;<strong>{AMOUNT}</strong>&nbsp;has been approved by your company management.</p>\r\n\r\n<p>Please Contact&nbsp;with our Accountant for collect the amount.</p>\r\n\r\n<p><br />\r\nRegards,<br />\r\n<br />\r\nThe {SITE_NAME} Team</p>\r\n'),
(58, 'en', 'expense_paid_email', 'Expense have been Paid', '<p>Hi there,</p>\r\n\r\n<p>The&nbsp;<strong>{NAME}</strong>&nbsp;expense&nbsp;<strong>{AMOUNT}&nbsp;</strong>has been paid by <strong>{PAID_BY}.</strong></p>\r\n\r\n<p>You can view this expense by logging in to the portal using the link below.<br />\r\n<br />\r\n<big><strong><a href=\"{URL}\">View Expense</a></strong></big><br />\r\n<br />\r\n<br />\r\nRegards,<br />\r\n<br />\r\nThe&nbsp;<strong>{SITE_NAME}</strong>&nbsp;Team</p>\r\n'),
(59, 'en', 'auto_close_ticket', 'Ticket Auto Closed', '<p>Ticket Closed</p>\r\n\r\n<p>Hello <strong>{REPORTER_EMAIL}</strong>,</p>\r\n\r\n<p>Ticket&nbsp;<strong>{SUBJECT}</strong>&nbsp;has been auto closed due to inactivity.&nbsp;<br />\r\n<br />\r\nTicket # <strong>{TICKET_CODE}</strong><br />\r\nStatus : &nbsp;<strong>{TICKET_STATUS}</strong><br />\r\n<br />\r\nTo see the responses or open the ticket, click on the link below:ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â‚¬Å¾Ã‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€šÃ‚Â ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¾Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Â¦Ãƒâ€šÃ‚Â¡ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â‚¬Å¾Ã‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Â¦Ãƒâ€šÃ‚Â¡ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€šÃ‚Â¦ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¡ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Â¦Ãƒâ€šÃ‚Â¡ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â‚¬Å¾Ã‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â¦ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¡ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã¢â‚¬Â ÃƒÂ¢Ã¢â€šÂ¬Ã¢â€žÂ¢ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡Ãƒâ€šÃ‚Â¬ÃƒÆ’Ã¢â‚¬Â¦Ãƒâ€šÃ‚Â¡ÃƒÆ’Ã†â€™Ãƒâ€ Ã¢â‚¬â„¢ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬Ãƒâ€¦Ã‚Â¡ÃƒÆ’Ã†â€™ÃƒÂ¢Ã¢â€šÂ¬Ã…Â¡ÃƒÆ’Ã¢â‚¬Å¡Ãƒâ€šÃ‚Â¹<br />\r\n<br />\r\n<big><strong><a href=\"{TICKET_LINK}\">View Ticket</a></strong></big><br />\r\n<br />\r\nRegards<br />\r\n<br />\r\nThe <strong>{SITE_NAME}</strong> Team</p>\r\n'),
(60, 'en', 'proposal_email', 'New Proposal', '<p>Proposal <strong>{PROPOSAL_REF}</strong></p> <p>Hi <strong>{CLIENT}</strong></p> <p>Thanks for your business inquiry.</p> <p>The Proposal <strong>{PROPOSAL_REF} </strong>is attached with this email.<br /> Proposal&nbsp;Overview:<br /> Proposal&nbsp;# :<strong> {PROPOSAL_REF}</strong><br /> Amount: <strong>{CURRENCY} {AMOUNT}</strong><br /> <br /> You can view the estimate online at:<br /> <big><strong><a href=\"{PROPOSAL_LINK}\">View Proposal</a></strong></big><br /> <br /> Best Regards,<br /> The <strong>{SITE_NAME}</strong> Team</p> '),
(61, 'en', 'project_overdue_email', 'Project Overdue Notice', '<p>Project Overdue</p>\r\n\r\n<p><strong>Hello {CLIENT}</strong></p>\r\n\r\n<p>This is the notice that your project overdue.&nbsp;<br />\r\n<br />\r\nProject name : <strong>{PROJECT_NAME}</strong><br />\r\nDue date : <strong>{DUE_DATE}</strong><br />\r\nYou can login to see the status of your project by using this link:<br />\r\n<big><a href=\"{PROJECT_LINK}\"><strong>View Project</strong></a></big></p>\r\n\r\n<p><br />\r\nBest Regards<br />\r\nThe {SITE_NAME} Team</p>\r\n\r\n<p>&nbsp;</p>\r\n'),
(62, 'en', 'estimate_overdue_email', 'Estimate Overdue Notice', '                                <p>Estimate {ESTIMATE_REF}</p>\r\n\r\n<p>Hi {CLIENT}</p>\r\n\r\n<p>This is the notice that your Estimate overdue. ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â¹<br>\r\n<br>\r\nEstimate Overview:<br>\r\nEstimate # : {ESTIMATE_REF}<br>\r\nDue Date: {DUE_DATE}<br>\r\nAmount: {CURRENCY} {AMOUNT}<br>\r\n<br>\r\nYou can view the estimate online at:<br>\r\n<big><strong><a href=\"{ESTIMATE_LINK}\">View Estimate</a></strong></big><br>\r\n<br>\r\nBest Regards,<br>\r\nThe {SITE_NAME} Team</p>\r\n'),
(63, 'en', 'proposal_overdue_email', 'New Estimate', '<p>Proposal&nbsp;<strong>{PROPOSAL_REF}</strong></p>\r\n\r\n<p>Hi&nbsp;<strong>{CLIENT}</strong></p>\r\n\r\n<p>This is the notice that your Proposal&nbsp;overdue.&nbsp;<br />\r\n<br />\r\nProposal&nbsp;Overview:<br />\r\nProposal&nbsp;# :<strong>&nbsp;{PROPOSAL_REF}</strong><br />\r\nDue Date: <strong>{DUE_DATE}</strong>ÃƒÆ’Ã‚Â¢ÃƒÂ¢Ã¢â‚¬Å¡Ã‚Â¬ÃƒÂ¢Ã¢â€šÂ¬Ã‚Â¹<br />\r\nAmount:&nbsp;<strong>{CURRENCY} {AMOUNT}</strong><br />\r\n<br />\r\nYou can view the estimate online at:<br />\r\n<big><strong><a href=\"{PROPOSAL_LINK}\">View Proposal</a></strong></big><br />\r\n<br />\r\nBest Regards,<br />\r\nThe&nbsp;<strong>{SITE_NAME}</strong>&nbsp;Team</p>\r\n'),
(64, 'en', 'call_for_interview', 'You have an interview offer!!!', '<p>Hello&nbsp;<strong>{NAME}</strong>,</p>\r\n\r\n<p>You have an interview offer for you.please see the details.&nbsp;<br />\r\n<br />\r\n<strong>Job Summary</strong>:<br />\r\nJob Title # :<strong>&nbsp;{JOB_TITLE}</strong><br />\r\nDesignation # :<strong>&nbsp;{DESIGNATION}</strong><br />\r\nInterview Date: <strong>{DATE}</strong></p>\r\n\r\n<p><strong>Postal Address</strong><br />\r\nPO Box 16122 Collins Street West<br />\r\nVictoria 8007 Australia<br />\r\n121 King Street, Melbourne<br />\r\nVictoria 3000 Australia &ndash;&nbsp;<a href=\"https://www.google.com.au/maps/place/Envato/@-37.8173306,144.9534631,17z/data=!3m1!4b1!4m2!3m1!1s0x6ad65d4c2b349649:0xb6899234e561db11\" target=\"_blank\">Map</a></p>\r\n\r\n<p><br />\r\nYou can view the circular details online at:<br />\r\n<big><strong><a href=\"{LINK}\">View Job Circular</a></strong></big><br />\r\n<br />\r\nBest Regards,<br />\r\nThe&nbsp;<strong>{SITE_NAME}</strong>&nbsp;Team</p>\r\n'),
(65, 'en', 'ticket_reopened_email', 'Ticket [SUBJECT] reopened', '<p>Ticket re-opened</p>\r\n\r\n<p>Hi {RECIPIENT},</p>\r\n\r\n<p>Ticket&nbsp;<strong>{SUBJECT}</strong>&nbsp;was re-opened by&nbsp;<strong>{USER}</strong>.<br />\r\nStatus :&nbsp;Open<br />\r\nClick on the below link to see the ticket details and post replies:&nbsp;<br />\r\n<a href=\"{TICKET_LINK}\"><strong>View Ticket</strong></a><br />\r\n<br />\r\n<br />\r\nBest Regards,<br />\r\n{SITE_NAME}</p>\r\n'),
(66, 'en', 'deposit_email', 'A deposit have been Received', '<p>Hi there,</p> <p>The&nbsp;<strong>{NAME}</strong>&nbsp;of deposit&nbsp;<strong>{AMOUNT}&nbsp;</strong>has been Deposit into <strong>{ACCOUNT}</strong> the new balance is <strong>{BALANCE}</strong></p> <p>You can view this deposit by logging in to the portal using the link below.<br /> <br /> <big><strong><a href=\"{URL}\">View Deposit</a></strong></big><br /> <br /> <br /> Regards,<br /> <br /> The&nbsp;<strong>{SITE_NAME}</strong>&nbsp;Team</p>'),
(67, 'en', 'clock_in_email', 'The {NAME} Just clock in', '<p>Hi there,</p>\r\n\r\n<p>TheÃ‚Â <strong>{NAME}</strong> justÃ‚Â Clock In by using The IP. The IP is:Ã‚Â <strong>{IP}</strong> and the time is: Ã‚Â <strong>{TIME}</strong><strong> </strong></p>\r\n\r\n<p>You can view this attendance by logging in to the portal using the link below.<br>\r\n<br>\r\n<big><strong><a href=\"{URL}\">View Details</a></strong></big><br>\r\n<br>\r\n<br>\r\nRegards,<br>\r\n<br>\r\nTheÃ‚Â <strong>{SITE_NAME}</strong>Ã‚Â Team</p>\r\n'),
(68, 'en', 'trying_clock_email', 'The {NAME} Trying to clock', '<p>Hi there,</p>\r\n\r\n<p>TheÃ‚Â <strong>{NAME} </strong> Trying to clockÃ‚Â in by Unknown IP.The IP is: <strong>{IP}</strong> and the time is: <strong>{TIME}</strong></p>\r\n\r\n<p>You can view this IP by logging in to the portal using the link below.<br>\r\n<br>\r\n<big><strong><a href=\"{URL}\">View Details</a></strong></big><br>\r\n<br>\r\n<br>\r\nRegards,<br>\r\n<br>\r\nTheÃ‚Â <strong>{SITE_NAME}</strong>Ã‚Â Team</p>\r\n'),
(69, 'en', 'clock_out_email', 'The {NAME} Just clock Out', '<p>Hi there,</p>\r\n\r\n<p>TheÃ‚Â <strong>{NAME}</strong>Ã‚Â justÃ‚Â Clock Out by using The IP. The IP is:Ã‚Â <strong>{IP}</strong>Ã‚Â and the time is: Ã‚Â <strong>{TIME}</strong></p>\r\n\r\n<p>You can view this attendance by logging in to the portal using the link below.<br>\r\n<br>\r\n<big><strong><a href=\"{URL}\">View Details</a></strong></big><br>\r\n<br>\r\n<br>\r\nRegards,<br>\r\n<br>\r\nTheÃ‚Â <strong>{SITE_NAME}</strong>Ã‚Â Team</p>\r\n'),
(70, 'en', 'invoice_item_refund_request', 'A new Refunded request recived for Invoice {REF}', '<p><strong>Hello </strong><br> <br> A new item refunded request received for Invoice {REF}.<br> <br> You can view the invoice online at:<br> <big><strong><a href=\"{LINK}\">View Refund Stock </a></strong></big><br> <br> Best Regards<br> <br> The {SITE_NAME} Team</p> '),
(71, 'en', 'credit_note_email', 'New Credit Note', '<p>Credit Note {credit_note_REF}</p>\r\n\r\n<p>Hi {CLIENT}</p>\r\n\r\n<p>Thanks for your business inquiry.</p>\r\n\r\n<p>The Credit Note {credit_note_REF} is attached with this email.<br />\r\nCredit Note Overview:<br />\r\nCredit Note # : {credit_note_REF}<br />\r\nAmount: {CURRENCY} {AMOUNT}<br />\r\n<br />\r\nYou can view the Credit Note online at:<br />\r\n<big><strong><a href=\"{credit_note_LINK}\">View Credit Note</a></strong></big><br />\r\n<br />\r\nBest Regards,<br />\r\nThe {SITE_NAME} Team</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_award`
--

CREATE TABLE IF NOT EXISTS `tbl_employee_award` (
  `employee_award_id` int NOT NULL AUTO_INCREMENT,
  `award_name` varchar(100) NOT NULL,
  `user_id` int DEFAULT NULL,
  `gift_item` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `award_amount` int DEFAULT NULL,
  `award_date` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `view_status` tinyint(1) DEFAULT '2' COMMENT '1=Read 2=Unread',
  `given_date` date DEFAULT NULL,
  PRIMARY KEY (`employee_award_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_bank`
--

CREATE TABLE IF NOT EXISTS `tbl_employee_bank` (
  `employee_bank_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `bank_name` varchar(300) NOT NULL,
  `branch_name` varchar(300) NOT NULL,
  `account_name` varchar(300) NOT NULL,
  `account_number` varchar(300) NOT NULL,
  `routing_number` varchar(50) DEFAULT NULL,
  `type_of_account` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`employee_bank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_document`
--

CREATE TABLE IF NOT EXISTS `tbl_employee_document` (
  `document_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `resume` text,
  `resume_path` text,
  `resume_filename` text,
  `offer_letter` text,
  `offer_letter_filename` text,
  `offer_letter_path` text,
  `joining_letter` text,
  `joining_letter_filename` text,
  `joining_letter_path` text,
  `contract_paper` text,
  `contract_paper_filename` text,
  `contract_paper_path` text,
  `id_proff` text,
  `id_proff_filename` text,
  `id_proff_path` text,
  `other_document` text,
  PRIMARY KEY (`document_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_employee_payroll`
--

CREATE TABLE IF NOT EXISTS `tbl_employee_payroll` (
  `payroll_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `salary_template_id` int DEFAULT NULL,
  `hourly_rate_id` int DEFAULT NULL,
  PRIMARY KEY (`payroll_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_estimates`
--

CREATE TABLE IF NOT EXISTS `tbl_estimates` (
  `estimates_id` int NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `client_id` int DEFAULT NULL,
  `project_id` int DEFAULT '0',
  `estimate_date` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `estimate_month` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `estimate_year` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `due_date` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `alert_overdue` tinyint(1) NOT NULL DEFAULT '0',
  `currency` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'USD',
  `discount_percent` int DEFAULT NULL,
  `notes` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tax` int NOT NULL DEFAULT '0',
  `total_tax` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Pending',
  `date_sent` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `est_deleted` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'No',
  `date_saved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `emailed` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'No',
  `show_client` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'No',
  `invoiced` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'No',
  `invoices_id` int NOT NULL DEFAULT '0',
  `warehouse_id` int DEFAULT NULL,
  `permission` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `client_visible` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'No',
  `discount_type` enum('none','before_tax','after_tax') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'none',
  `user_id` int NOT NULL DEFAULT '0' COMMENT 'sales agent',
  `adjustment` decimal(18,2) NOT NULL DEFAULT '0.00',
  `discount_total` decimal(18,2) NOT NULL DEFAULT '0.00',
  `show_quantity_as` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tags` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  PRIMARY KEY (`estimates_id`),
  UNIQUE KEY `reference_no` (`reference_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_estimate_items`
--

CREATE TABLE IF NOT EXISTS `tbl_estimate_items` (
  `estimate_items_id` int NOT NULL AUTO_INCREMENT,
  `estimates_id` int NOT NULL,
  `saved_items_id` int DEFAULT '0',
  `item_tax_rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `item_tax_name` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `item_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'Item Name',
  `item_desc` longtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `unit_cost` decimal(10,2) DEFAULT '0.00',
  `quantity` decimal(10,2) DEFAULT '0.00',
  `item_tax_total` decimal(10,2) DEFAULT '0.00',
  `total_cost` decimal(10,2) DEFAULT '0.00',
  `date_saved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `unit` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `hsn_code` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `order` int DEFAULT '0',
  PRIMARY KEY (`estimate_items_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_expense_category`
--

CREATE TABLE IF NOT EXISTS `tbl_expense_category` (
  `expense_category_id` int NOT NULL AUTO_INCREMENT,
  `expense_category` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`expense_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_files`
--

CREATE TABLE IF NOT EXISTS `tbl_files` (
  `files_id` int NOT NULL AUTO_INCREMENT,
  `project_id` int NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `uploaded_by` int NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`files_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_form`
--

CREATE TABLE IF NOT EXISTS `tbl_form` (
  `form_id` int NOT NULL AUTO_INCREMENT,
  `form_name` varchar(100) DEFAULT NULL,
  `tbl_name` varchar(25) DEFAULT NULL,
  `table_id` varchar(110) DEFAULT NULL,
  PRIMARY KEY (`form_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_form`
--

INSERT INTO `tbl_form` (`form_id`, `form_name`, `tbl_name`, `table_id`) VALUES
(1, 'deposit', 'tbl_transactions', 'transactions_id'),
(2, 'expense', 'tbl_transactions', 'transactions_id'),
(3, 'tasks', 'tbl_task', 'task_id'),
(4, 'project', 'tbl_project', 'project_id'),
(5, 'leads', 'tbl_leads', 'leads_id'),
(6, 'bugs', 'tbl_bug', 'bug_id'),
(7, 'tickets', 'tbl_tickets', 'tickets_id'),
(8, 'opportunities', 'tbl_opportunities', 'opportunities_id'),
(9, 'invoice', 'tbl_invoices', 'invoices_id'),
(10, 'estimates', 'tbl_estimates', 'estimates_id'),
(11, 'proposal', 'tbl_proposals', 'proposals_id'),
(12, 'client', 'tbl_client', 'client_id'),
(13, 'users', 'tbl_account_details', 'account_details_id'),
(14, 'job_circular', 'tbl_job_circular', 'job_circular_id'),
(15, 'training', 'tbl_training', 'training_id'),
(16, 'announcements', 'tbl_announcements', 'announcements_id'),
(17, 'leave_management', 'tbl_leave_application', 'leave_application_id'),
(18, 'items', 'tbl_saved_items', 'saved_items_id'),
(19, 'supplier', 'tbl_suppliers', 'supplier_id'),
(20, 'purchases', 'tbl_purchases', 'purchase_id'),
(21, 'Account', 'tbl_accounts', 'account_id'),
(22, 'credit_note', 'tbl_credit_note', 'credit_note_id');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_goal_tracking`
--

CREATE TABLE IF NOT EXISTS `tbl_goal_tracking` (
  `goal_tracking_id` int NOT NULL AUTO_INCREMENT,
  `subject` varchar(200) NOT NULL,
  `goal_type_id` int NOT NULL,
  `achievement` int NOT NULL,
  `start_date` varchar(20) NOT NULL,
  `end_date` varchar(20) NOT NULL,
  `account_id` int DEFAULT '0',
  `description` mediumtext NOT NULL,
  `notify_goal_achive` varchar(5) DEFAULT NULL,
  `notify_goal_not_achive` varchar(5) DEFAULT NULL,
  `permission` mediumtext,
  `email_send` varchar(5) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`goal_tracking_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_goal_type`
--

CREATE TABLE IF NOT EXISTS `tbl_goal_type` (
  `goal_type_id` int NOT NULL AUTO_INCREMENT,
  `type_name` varchar(200) NOT NULL,
  `description` mediumtext NOT NULL,
  `tbl_name` varchar(200) NOT NULL,
  `query` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`goal_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_goal_type`
--

INSERT INTO `tbl_goal_type` (`goal_type_id`, `type_name`, `description`, `tbl_name`, `query`) VALUES
(1, 'achive_total_income', 'to get total income report from this start and end date and notify user. ', 'tbl_transactions', 'Income'),
(2, 'achive_total_income_by_bank', 'to get total income report from this start and end date and notify user. ', 'tbl_transactions', 'Income'),
(3, 'achieve_total_expense', 'to get total expense report from this start and end date and notify user. ', 'tbl_transactions', 'Expense'),
(4, 'achive_total_expense_by_bank', 'to get total expense report from this start and end date and notify user. ', 'tbl_transactions', 'Expense'),
(5, 'make_invoice', 'to get targeted invoice from this start and end date and notify user. ', 'tbl_invoices', NULL),
(6, 'make_estimate', 'to get targeted estimate from this start and end date and notify user.', 'tbl_estimates', NULL),
(7, 'goal_payment', 'to get total payment report from this start and end date and notify user. ', 'tbl_payments', NULL),
(8, 'task_done', 'to get total done tasks report from this start and end date and notify user. ', 'tbl_task', NULL),
(9, 'resolved_bugs', 'to get total resolve bugs report from this start and end date and notify user. ', 'tbl_bug', NULL),
(10, 'convert_leads_to_client', 'to get total Convert leads to client report from this start and end date and notify user. ', 'tbl_client', NULL),
(11, 'direct_client', 'to get total client report from this start and end date and notify user. ', 'tbl_client', NULL),
(12, 'complete_project_goal', 'to get total complete project report from this start and end date and notify user. ', 'tbl_project', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_holiday`
--

CREATE TABLE IF NOT EXISTS `tbl_holiday` (
  `holiday_id` int NOT NULL AUTO_INCREMENT,
  `event_name` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `location` varchar(200) DEFAULT NULL,
  `color` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`holiday_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_hourly_rate`
--

CREATE TABLE IF NOT EXISTS `tbl_hourly_rate` (
  `hourly_rate_id` int NOT NULL AUTO_INCREMENT,
  `hourly_grade` varchar(200) NOT NULL,
  `hourly_rate` varchar(50) NOT NULL,
  PRIMARY KEY (`hourly_rate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_inbox`
--

CREATE TABLE IF NOT EXISTS `tbl_inbox` (
  `inbox_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `to` varchar(100) NOT NULL,
  `from` varchar(100) NOT NULL,
  `subject` varchar(300) NOT NULL,
  `message_body` text NOT NULL,
  `attach_file` text,
  `attach_file_path` text,
  `attach_filename` text,
  `message_time` datetime NOT NULL,
  `view_status` tinyint(1) NOT NULL DEFAULT '2' COMMENT '1=Read 2=Unread',
  `favourites` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0= no 1=yes',
  `notify_me` tinyint(1) NOT NULL DEFAULT '1' COMMENT '1=on 0=off',
  `deleted` enum('Yes','No') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`inbox_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_income_category`
--

CREATE TABLE IF NOT EXISTS `tbl_income_category` (
  `income_category_id` int NOT NULL AUTO_INCREMENT,
  `income_category` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  PRIMARY KEY (`income_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_invoices`
--

CREATE TABLE IF NOT EXISTS `tbl_invoices` (
  `invoices_id` int NOT NULL AUTO_INCREMENT,
  `recur_start_date` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `recur_end_date` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `reference_no` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `client_id` int NOT NULL,
  `project_id` int DEFAULT '0',
  `invoice_date` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `invoice_month` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `invoice_year` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `due_date` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `alert_overdue` tinyint(1) NOT NULL DEFAULT '0',
  `notes` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tax` decimal(10,2) NOT NULL DEFAULT '0.00',
  `total_tax` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `discount_percent` int DEFAULT NULL,
  `recurring` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'No',
  `recuring_frequency` int NOT NULL DEFAULT '31',
  `recur_frequency` varchar(12) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `recur_next_date` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `currency` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'USD',
  `status` enum('Cancelled','Unpaid','Paid','draft','partially_paid') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Unpaid',
  `archived` int DEFAULT '0',
  `date_sent` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `inv_deleted` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'No',
  `date_saved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `emailed` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'No',
  `show_client` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Yes',
  `viewed` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'No',
  `allow_paypal` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Yes',
  `allow_stripe` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Yes',
  `allow_2checkout` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Yes',
  `allow_authorize_net` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'No',
  `allow_ccavenue` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'No',
  `allow_braintree` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'No',
  `allow_mollie` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'No',
  `allow_payumoney` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'No',
  `allow_tappayment` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'Yes',
  `allow_razorpay` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'No',
  `permission` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `client_visible` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'No',
  `discount_type` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'none',
  `user_id` int NOT NULL DEFAULT '0' COMMENT 'sales agent',
  `adjustment` decimal(18,2) NOT NULL DEFAULT '0.00',
  `discount_total` decimal(18,2) NOT NULL DEFAULT '0.00',
  `show_quantity_as` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `warehouse_id` int DEFAULT NULL,
  `tags` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  PRIMARY KEY (`invoices_id`),
  UNIQUE KEY `reference_no` (`reference_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_items`
--

CREATE TABLE IF NOT EXISTS `tbl_items` (
  `items_id` int NOT NULL AUTO_INCREMENT,
  `invoices_id` int NOT NULL,
  `item_tax_rate` decimal(18,2) NOT NULL DEFAULT '0.00',
  `item_tax_name` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `item_tax_total` decimal(18,2) NOT NULL DEFAULT '0.00',
  `quantity` decimal(18,2) DEFAULT '0.00',
  `total_cost` decimal(18,2) DEFAULT '0.00',
  `item_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'Item Name',
  `item_desc` longtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `unit_cost` decimal(18,2) DEFAULT '0.00',
  `order` int DEFAULT '0',
  `date_saved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `unit` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `hsn_code` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `saved_items_id` int DEFAULT '0',
  PRIMARY KEY (`items_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_item_history`
--

CREATE TABLE IF NOT EXISTS `tbl_item_history` (
  `item_history_id` int NOT NULL AUTO_INCREMENT,
  `stock_id` int NOT NULL,
  `inventory` int NOT NULL,
  `purchase_date` date NOT NULL,
  PRIMARY KEY (`item_history_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_appliactions`
--

CREATE TABLE IF NOT EXISTS `tbl_job_appliactions` (
  `job_appliactions_id` int NOT NULL AUTO_INCREMENT,
  `job_circular_id` int NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `cover_letter` text NOT NULL,
  `resume` text NOT NULL,
  `application_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=pending 1=accept 2 = reject',
  `apply_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `send_email` varchar(20) DEFAULT NULL,
  `interview_date` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`job_appliactions_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_job_circular`
--

CREATE TABLE IF NOT EXISTS `tbl_job_circular` (
  `job_circular_id` int NOT NULL AUTO_INCREMENT,
  `job_title` varchar(200) NOT NULL,
  `designations_id` int NOT NULL,
  `vacancy_no` varchar(50) NOT NULL,
  `posted_date` date NOT NULL,
  `employment_type` enum('contractual','full_time','part_time') NOT NULL DEFAULT 'full_time',
  `experience` varchar(200) DEFAULT NULL,
  `age` varchar(200) DEFAULT NULL,
  `salary_range` varchar(200) DEFAULT NULL,
  `last_date` date NOT NULL,
  `description` text NOT NULL,
  `status` enum('published','unpublished') NOT NULL DEFAULT 'unpublished' COMMENT '1=publish 2=unpublish',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `permission` text,
  PRIMARY KEY (`job_circular_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_kb_category`
--

CREATE TABLE IF NOT EXISTS `tbl_kb_category` (
  `kb_category_id` int NOT NULL AUTO_INCREMENT,
  `category` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `description` longtext,
  `type` varchar(50) NOT NULL,
  `sort` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`kb_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_knowledgebase`
--

CREATE TABLE IF NOT EXISTS `tbl_knowledgebase` (
  `kb_id` int NOT NULL AUTO_INCREMENT,
  `kb_category_id` int NOT NULL,
  `title` text,
  `slug` text,
  `description` text,
  `attachments` text,
  `for_all` enum('Yes','No') DEFAULT 'No',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `total_view` int NOT NULL DEFAULT '0',
  `created_by` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `sort` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`kb_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_languages`
--

CREATE TABLE IF NOT EXISTS `tbl_languages` (
  `code` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `icon` varchar(45) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `active` int DEFAULT '0',
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_languages`
--

INSERT INTO `tbl_languages` (`code`, `name`, `icon`, `active`) VALUES
('ar', 'arabic', 'ae', 0),
('cs', 'czech', 'cs', 0),
('da', 'danish', 'dk', 0),
('de', 'german', 'de', 0),
('el', 'greek', 'gr', 0),
('en', 'english', 'us', 1),
('es', 'spanish', 'es', 0),
('fr', 'french', 'fr', 0),
('gu', 'gujarati', 'in', 0),
('hi', 'hindi', 'in', 0),
('id', 'indonesian', 'id', 0),
('it', 'italian', 'it', 0),
('ja', 'japanese', 'jp', 0),
('nl', 'dutch', 'nl', 0),
('no', 'norwegian', 'no', 0),
('pl', 'polish', 'pl', 0),
('pt', 'portuguese', 'pt', 0),
('ro', 'romanian', 'ro', 0),
('ru', 'russian', 'ru', 0),
('tr', 'turkish', 'tr', 0),
('vi', 'vietnamese', 'vn', 0),
('zh', 'chinese', 'cn', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leads`
--

CREATE TABLE IF NOT EXISTS `tbl_leads` (
  `leads_id` int NOT NULL AUTO_INCREMENT,
  `lead_name` varchar(50) NOT NULL,
  `client_id` int DEFAULT NULL,
  `organization` varchar(50) NOT NULL,
  `lead_status_id` int DEFAULT NULL,
  `lead_source_id` int DEFAULT NULL,
  `imported_from_email` tinyint(1) DEFAULT '0',
  `email_integration_uid` varchar(30) DEFAULT NULL,
  `company_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `address` text NOT NULL,
  `country` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `mobile` varchar(32) NOT NULL,
  `facebook` varchar(32) NOT NULL,
  `language` varchar(100) DEFAULT NULL,
  `notes` text NOT NULL,
  `created_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_contact` timestamp NULL DEFAULT NULL,
  `skype` varchar(200) NOT NULL,
  `twitter` varchar(100) NOT NULL,
  `permission` text,
  `converted_client_id` int NOT NULL DEFAULT '0',
  `index_no` int DEFAULT '0',
  `tags` text,
  `from_form_id` int DEFAULT NULL,
  PRIMARY KEY (`leads_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leads_notes`
--

CREATE TABLE IF NOT EXISTS `tbl_leads_notes` (
  `notes_id` int NOT NULL AUTO_INCREMENT,
  `leads_id` int DEFAULT NULL,
  `notes` text,
  `contacted_indicator` varchar(50) DEFAULT NULL,
  `created_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `last_contact` timestamp NULL DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL,
  `module_field_id` int DEFAULT NULL,
  PRIMARY KEY (`notes_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lead_form`
--

CREATE TABLE IF NOT EXISTS `tbl_lead_form` (
  `lead_form_id` int NOT NULL AUTO_INCREMENT,
  `form_key` varchar(32) NOT NULL,
  `form_name` varchar(200) NOT NULL,
  `lead_status_id` int NOT NULL,
  `lead_source_id` int NOT NULL,
  `language` varchar(40) DEFAULT NULL,
  `form_recaptcha` int NOT NULL DEFAULT '0',
  `submit_btn_text` varchar(40) DEFAULT NULL,
  `submit_btn_msg` text,
  `allow_duplicate` int NOT NULL DEFAULT '1',
  `track_duplicate_field` varchar(100) DEFAULT NULL,
  `form_data` mediumtext,
  `notify_lead_imported` int NOT NULL DEFAULT '1',
  `permission` text,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`lead_form_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lead_source`
--

CREATE TABLE IF NOT EXISTS `tbl_lead_source` (
  `lead_source_id` int NOT NULL AUTO_INCREMENT,
  `lead_source` varchar(100) NOT NULL,
  PRIMARY KEY (`lead_source_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_lead_status`
--

CREATE TABLE IF NOT EXISTS `tbl_lead_status` (
  `lead_status_id` int NOT NULL AUTO_INCREMENT,
  `lead_status` varchar(50) NOT NULL,
  `lead_type` varchar(20) DEFAULT NULL,
  `order_no` int DEFAULT NULL,
  PRIMARY KEY (`lead_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave_application`
--

CREATE TABLE IF NOT EXISTS `tbl_leave_application` (
  `leave_application_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `leave_category_id` int NOT NULL,
  `reason` text NOT NULL,
  `leave_type` enum('single_day','multiple_days','hours') NOT NULL DEFAULT 'single_day',
  `hours` varchar(20) DEFAULT NULL,
  `leave_start_date` date NOT NULL,
  `leave_end_date` date DEFAULT NULL,
  `application_status` int NOT NULL DEFAULT '1' COMMENT '1=pending,2=accepted 3=rejected',
  `view_status` tinyint(1) NOT NULL DEFAULT '2',
  `application_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `attachment` text,
  `comments` text,
  `approve_by` int DEFAULT NULL,
  PRIMARY KEY (`leave_application_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_leave_category`
--

CREATE TABLE IF NOT EXISTS `tbl_leave_category` (
  `leave_category_id` int NOT NULL AUTO_INCREMENT,
  `leave_category` varchar(100) NOT NULL,
  `leave_quota` int NOT NULL,
  PRIMARY KEY (`leave_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_locales`
--

CREATE TABLE IF NOT EXISTS `tbl_locales` (
  `locale` varchar(10) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `name` varchar(250) NOT NULL DEFAULT '',
  `icon` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`locale`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_locales`
--

INSERT INTO `tbl_locales` (`locale`, `code`, `language`, `name`, `icon`) VALUES
('aa_DJ', 'aa', 'afar', 'Afar (Djibouti)', 'dj'),
('aa_ER', 'aa', 'afar', 'Afar (Eritrea)', 'dj'),
('aa_ET', 'aa', 'afar', 'Afar (Ethiopia)', 'dj'),
('af_ZA', 'af', 'afrikaans', 'Afrikaans (South Africa)', 'za'),
('am_ET', 'am', 'amharic', 'Amharic (Ethiopia)', 'et'),
('an_ES', 'an', 'aragonese', 'Aragonese (Spain)', 'es'),
('ar_AE', 'ar', 'arabic', 'Arabic (United Arab Emirates)', 'es'),
('ar_BH', 'ar', 'arabic', 'Arabic (Bahrain)', NULL),
('ar_DZ', 'ar', 'arabic', 'Arabic (Algeria)', NULL),
('ar_EG', 'ar', 'arabic', 'Arabic (Egypt)', NULL),
('ar_IN', 'ar', 'arabic', 'Arabic (India)', NULL),
('ar_IQ', 'ar', 'arabic', 'Arabic (Iraq)', NULL),
('ar_JO', 'ar', 'arabic', 'Arabic (Jordan)', NULL),
('ar_KW', 'ar', 'arabic', 'Arabic (Kuwait)', NULL),
('ar_LB', 'ar', 'arabic', 'Arabic (Lebanon)', NULL),
('ar_LY', 'ar', 'arabic', 'Arabic (Libya)', NULL),
('ar_MA', 'ar', 'arabic', 'Arabic (Morocco)', NULL),
('ar_OM', 'ar', 'arabic', 'Arabic (Oman)', NULL),
('ar_QA', 'ar', 'arabic', 'Arabic (Qatar)', NULL),
('ar_SA', 'ar', 'arabic', 'Arabic (Saudi Arabia)', NULL),
('ar_SD', 'ar', 'arabic', 'Arabic (Sudan)', NULL),
('ar_SY', 'ar', 'arabic', 'Arabic (Syria)', NULL),
('ar_TN', 'ar', 'arabic', 'Arabic (Tunisia)', NULL),
('ar_YE', 'ar', 'arabic', 'Arabic (Yemen)', NULL),
('ast_ES', 'ast', 'asturian', 'Asturian (Spain)', NULL),
('as_IN', 'as', 'assamese', 'Assamese (India)', NULL),
('az_AZ', 'az', 'azerbaijani', 'Azerbaijani (Azerbaijan)', NULL),
('az_TR', 'az', 'azerbaijani', 'Azerbaijani (Turkey)', NULL),
('bem_ZM', 'bem', 'bemba', 'Bemba (Zambia)', NULL),
('ber_DZ', 'ber', 'berber', 'Berber (Algeria)', NULL),
('ber_MA', 'ber', 'berber', 'Berber (Morocco)', NULL),
('be_BY', 'be', 'belarusian', 'Belarusian (Belarus)', NULL),
('bg_BG', 'bg', 'bulgarian', 'Bulgarian (Bulgaria)', NULL),
('bn_BD', 'bn', 'bengali', 'Bengali (Bangladesh)', NULL),
('bn_IN', 'bn', 'bengali', 'Bengali (India)', NULL),
('bo_CN', 'bo', 'tibetan', 'Tibetan (China)', NULL),
('bo_IN', 'bo', 'tibetan', 'Tibetan (India)', NULL),
('br_FR', 'br', 'breton', 'Breton (France)', NULL),
('bs_BA', 'bs', 'bosnian', 'Bosnian (Bosnia and Herzegovina)', NULL),
('byn_ER', 'byn', 'blin', 'Blin (Eritrea)', NULL),
('ca_AD', 'ca', 'catalan', 'Catalan (Andorra)', NULL),
('ca_ES', 'ca', 'catalan', 'Catalan (Spain)', NULL),
('ca_FR', 'ca', 'catalan', 'Catalan (France)', NULL),
('ca_IT', 'ca', 'catalan', 'Catalan (Italy)', NULL),
('crh_UA', 'crh', 'crimean turkish', 'Crimean Turkish (Ukraine)', NULL),
('csb_PL', 'csb', 'kashubian', 'Kashubian (Poland)', NULL),
('cs_CZ', 'cs', 'czech', 'Czech (Czech Republic)', NULL),
('cv_RU', 'cv', 'chuvash', 'Chuvash (Russia)', NULL),
('cy_GB', 'cy', 'welsh', 'Welsh (United Kingdom)', NULL),
('da_DK', 'da', 'danish', 'Danish (Denmark)', NULL),
('de_AT', 'de', 'german', 'German (Austria)', NULL),
('de_BE', 'de', 'german', 'German (Belgium)', NULL),
('de_CH', 'de', 'german', 'German (Switzerland)', NULL),
('de_DE', 'de', 'german', 'German (Germany)', NULL),
('de_LI', 'de', 'german', 'German (Liechtenstein)', NULL),
('de_LU', 'de', 'german', 'German (Luxembourg)', NULL),
('dv_MV', 'dv', 'divehi', 'Divehi (Maldives)', NULL),
('dz_BT', 'dz', 'dzongkha', 'Dzongkha (Bhutan)', NULL),
('ee_GH', 'ee', 'ewe', 'Ewe (Ghana)', NULL),
('el_CY', 'el', 'greek', 'Greek (Cyprus)', NULL),
('el_GR', 'el', 'greek', 'Greek (Greece)', NULL),
('en_AG', 'en', 'english', 'English (Antigua and Barbuda)', NULL),
('en_AS', 'en', 'english', 'English (American Samoa)', NULL),
('en_AU', 'en', 'english', 'English (Australia)', NULL),
('en_BW', 'en', 'english', 'English (Botswana)', NULL),
('en_CA', 'en', 'english', 'English (Canada)', NULL),
('en_DK', 'en', 'english', 'English (Denmark)', NULL),
('en_GB', 'en', 'english', 'English (United Kingdom)', NULL),
('en_GU', 'en', 'english', 'English (Guam)', NULL),
('en_HK', 'en', 'english', 'English (Hong Kong SAR China)', NULL),
('en_IE', 'en', 'english', 'English (Ireland)', NULL),
('en_IN', 'en', 'english', 'English (India)', NULL),
('en_JM', 'en', 'english', 'English (Jamaica)', NULL),
('en_MH', 'en', 'english', 'English (Marshall Islands)', NULL),
('en_MP', 'en', 'english', 'English (Northern Mariana Islands)', NULL),
('en_MU', 'en', 'english', 'English (Mauritius)', NULL),
('en_NG', 'en', 'english', 'English (Nigeria)', NULL),
('en_NZ', 'en', 'english', 'English (New Zealand)', NULL),
('en_PH', 'en', 'english', 'English (Philippines)', NULL),
('en_SG', 'en', 'english', 'English (Singapore)', NULL),
('en_TT', 'en', 'english', 'English (Trinidad and Tobago)', NULL),
('en_US', 'en', 'english', 'English (United States)', NULL),
('en_VI', 'en', 'english', 'English (Virgin Islands)', NULL),
('en_ZA', 'en', 'english', 'English (South Africa)', NULL),
('en_ZM', 'en', 'english', 'English (Zambia)', NULL),
('en_ZW', 'en', 'english', 'English (Zimbabwe)', NULL),
('eo', 'eo', 'esperanto', 'Esperanto', NULL),
('es_AR', 'es', 'spanish', 'Spanish (Argentina)', NULL),
('es_BO', 'es', 'spanish', 'Spanish (Bolivia)', NULL),
('es_CL', 'es', 'spanish', 'Spanish (Chile)', NULL),
('es_CO', 'es', 'spanish', 'Spanish (Colombia)', NULL),
('es_CR', 'es', 'spanish', 'Spanish (Costa Rica)', NULL),
('es_DO', 'es', 'spanish', 'Spanish (Dominican Republic)', NULL),
('es_EC', 'es', 'spanish', 'Spanish (Ecuador)', NULL),
('es_ES', 'es', 'spanish', 'Spanish (Spain)', NULL),
('es_GT', 'es', 'spanish', 'Spanish (Guatemala)', NULL),
('es_HN', 'es', 'spanish', 'Spanish (Honduras)', NULL),
('es_MX', 'es', 'spanish', 'Spanish (Mexico)', NULL),
('es_NI', 'es', 'spanish', 'Spanish (Nicaragua)', NULL),
('es_PA', 'es', 'spanish', 'Spanish (Panama)', NULL),
('es_PE', 'es', 'spanish', 'Spanish (Peru)', NULL),
('es_PR', 'es', 'spanish', 'Spanish (Puerto Rico)', NULL),
('es_PY', 'es', 'spanish', 'Spanish (Paraguay)', NULL),
('es_SV', 'es', 'spanish', 'Spanish (El Salvador)', NULL),
('es_US', 'es', 'spanish', 'Spanish (United States)', NULL),
('es_UY', 'es', 'spanish', 'Spanish (Uruguay)', NULL),
('es_VE', 'es', 'spanish', 'Spanish (Venezuela)', NULL),
('et_EE', 'et', 'estonian', 'Estonian (Estonia)', NULL),
('eu_ES', 'eu', 'basque', 'Basque (Spain)', NULL),
('eu_FR', 'eu', 'basque', 'Basque (France)', NULL),
('fa_AF', 'fa', 'persian', 'Persian (Afghanistan)', NULL),
('fa_IR', 'fa', 'persian', 'Persian (Iran)', NULL),
('ff_SN', 'ff', 'fulah', 'Fulah (Senegal)', NULL),
('fil_PH', 'fil', 'filipino', 'Filipino (Philippines)', NULL),
('fi_FI', 'fi', 'finnish', 'Finnish (Finland)', NULL),
('fo_FO', 'fo', 'faroese', 'Faroese (Faroe Islands)', NULL),
('fr_BE', 'fr', 'french', 'French (Belgium)', NULL),
('fr_BF', 'fr', 'french', 'French (Burkina Faso)', NULL),
('fr_BI', 'fr', 'french', 'French (Burundi)', NULL),
('fr_BJ', 'fr', 'french', 'French (Benin)', NULL),
('fr_CA', 'fr', 'french', 'French (Canada)', NULL),
('fr_CF', 'fr', 'french', 'French (Central African Republic)', NULL),
('fr_CG', 'fr', 'french', 'French (Congo)', NULL),
('fr_CH', 'fr', 'french', 'French (Switzerland)', NULL),
('fr_CM', 'fr', 'french', 'French (Cameroon)', NULL),
('fr_FR', 'fr', 'french', 'French (France)', NULL),
('fr_GA', 'fr', 'french', 'French (Gabon)', NULL),
('fr_GN', 'fr', 'french', 'French (Guinea)', NULL),
('fr_GP', 'fr', 'french', 'French (Guadeloupe)', NULL),
('fr_GQ', 'fr', 'french', 'French (Equatorial Guinea)', NULL),
('fr_KM', 'fr', 'french', 'French (Comoros)', NULL),
('fr_LU', 'fr', 'french', 'French (Luxembourg)', NULL),
('fr_MC', 'fr', 'french', 'French (Monaco)', NULL),
('fr_MG', 'fr', 'french', 'French (Madagascar)', NULL),
('fr_ML', 'fr', 'french', 'French (Mali)', NULL),
('fr_MQ', 'fr', 'french', 'French (Martinique)', NULL),
('fr_NE', 'fr', 'french', 'French (Niger)', NULL),
('fr_SN', 'fr', 'french', 'French (Senegal)', NULL),
('fr_TD', 'fr', 'french', 'French (Chad)', NULL),
('fr_TG', 'fr', 'french', 'French (Togo)', NULL),
('fur_IT', 'fur', 'friulian', 'Friulian (Italy)', NULL),
('fy_DE', 'fy', 'western frisian', 'Western Frisian (Germany)', NULL),
('fy_NL', 'fy', 'western frisian', 'Western Frisian (Netherlands)', NULL),
('ga_IE', 'ga', 'irish', 'Irish (Ireland)', NULL),
('gd_GB', 'gd', 'scottish gaelic', 'Scottish Gaelic (United Kingdom)', NULL),
('gez_ER', 'gez', 'geez', 'Geez (Eritrea)', NULL),
('gez_ET', 'gez', 'geez', 'Geez (Ethiopia)', NULL),
('gl_ES', 'gl', 'galician', 'Galician (Spain)', NULL),
('gu_IN', 'gu', 'gujarati', 'Gujarati (India)', NULL),
('gv_GB', 'gv', 'manx', 'Manx (United Kingdom)', NULL),
('ha_NG', 'ha', 'hausa', 'Hausa (Nigeria)', NULL),
('he_IL', 'he', 'hebrew', 'Hebrew (Israel)', NULL),
('hi_IN', 'hi', 'hindi', 'Hindi (India)', NULL),
('hr_HR', 'hr', 'croatian', 'Croatian (Croatia)', NULL),
('hsb_DE', 'hsb', 'upper sorbian', 'Upper Sorbian (Germany)', NULL),
('ht_HT', 'ht', 'haitian', 'Haitian (Haiti)', NULL),
('hu_HU', 'hu', 'hungarian', 'Hungarian (Hungary)', NULL),
('hy_AM', 'hy', 'armenian', 'Armenian (Armenia)', NULL),
('ia', 'ia', 'interlingua', 'Interlingua', NULL),
('id_ID', 'id', 'indonesian', 'Indonesian (Indonesia)', NULL),
('ig_NG', 'ig', 'igbo', 'Igbo (Nigeria)', NULL),
('ik_CA', 'ik', 'inupiaq', 'Inupiaq (Canada)', NULL),
('is_IS', 'is', 'icelandic', 'Icelandic (Iceland)', NULL),
('it_CH', 'it', 'italian', 'Italian (Switzerland)', NULL),
('it_IT', 'it', 'italian', 'Italian (Italy)', NULL),
('iu_CA', 'iu', 'inuktitut', 'Inuktitut (Canada)', NULL),
('ja_JP', 'ja', 'japanese', 'Japanese (Japan)', NULL),
('ka_GE', 'ka', 'georgian', 'Georgian (Georgia)', NULL),
('kk_KZ', 'kk', 'kazakh', 'Kazakh (Kazakhstan)', NULL),
('kl_GL', 'kl', 'kalaallisut', 'Kalaallisut (Greenland)', NULL),
('km_KH', 'km', 'khmer', 'Khmer (Cambodia)', NULL),
('kn_IN', 'kn', 'kannada', 'Kannada (India)', NULL),
('kok_IN', 'kok', 'konkani', 'Konkani (India)', NULL),
('ko_KR', 'ko', 'korean', 'Korean (South Korea)', NULL),
('ks_IN', 'ks', 'kashmiri', 'Kashmiri (India)', NULL),
('ku_TR', 'ku', 'kurdish', 'Kurdish (Turkey)', NULL),
('kw_GB', 'kw', 'cornish', 'Cornish (United Kingdom)', NULL),
('ky_KG', 'ky', 'kirghiz', 'Kirghiz (Kyrgyzstan)', NULL),
('lg_UG', 'lg', 'ganda', 'Ganda (Uganda)', NULL),
('li_BE', 'li', 'limburgish', 'Limburgish (Belgium)', NULL),
('li_NL', 'li', 'limburgish', 'Limburgish (Netherlands)', NULL),
('lo_LA', 'lo', 'lao', 'Lao (Laos)', NULL),
('lt_LT', 'lt', 'lithuanian', 'Lithuanian (Lithuania)', NULL),
('lv_LV', 'lv', 'latvian', 'Latvian (Latvia)', NULL),
('mai_IN', 'mai', 'maithili', 'Maithili (India)', NULL),
('mg_MG', 'mg', 'malagasy', 'Malagasy (Madagascar)', NULL),
('mi_NZ', 'mi', 'maori', 'Maori (New Zealand)', NULL),
('mk_MK', 'mk', 'macedonian', 'Macedonian (Macedonia)', NULL),
('ml_IN', 'ml', 'malayalam', 'Malayalam (India)', NULL),
('mn_MN', 'mn', 'mongolian', 'Mongolian (Mongolia)', NULL),
('mr_IN', 'mr', 'marathi', 'Marathi (India)', NULL),
('ms_BN', 'ms', 'malay', 'Malay (Brunei)', NULL),
('ms_MY', 'ms', 'malay', 'Malay (Malaysia)', NULL),
('mt_MT', 'mt', 'maltese', 'Maltese (Malta)', NULL),
('my_MM', 'my', 'burmese', 'Burmese (Myanmar)', NULL),
('naq_NA', 'naq', 'namibia', 'Namibia', NULL),
('nb_NO', 'nb', 'norwegian bokm?l', 'Norwegian Bokm?l (Norway)', NULL),
('nds_DE', 'nds', 'low german', 'Low German (Germany)', NULL),
('nds_NL', 'nds', 'low german', 'Low German (Netherlands)', NULL),
('ne_NP', 'ne', 'nepali', 'Nepali (Nepal)', NULL),
('nl_AW', 'nl', 'dutch', 'Dutch (Aruba)', NULL),
('nl_BE', 'nl', 'dutch', 'Dutch (Belgium)', NULL),
('nl_NL', 'nl', 'dutch', 'Dutch (Netherlands)', NULL),
('nn_NO', 'nn', 'norwegian nynorsk', 'Norwegian Nynorsk (Norway)', NULL),
('no_NO', 'no', 'norwegian', 'Norwegian (Norway)', NULL),
('nr_ZA', 'nr', 'south ndebele', 'South Ndebele (South Africa)', NULL),
('nso_ZA', 'nso', 'northern sotho', 'Northern Sotho (South Africa)', NULL),
('oc_FR', 'oc', 'occitan', 'Occitan (France)', NULL),
('om_ET', 'om', 'oromo', 'Oromo (Ethiopia)', NULL),
('om_KE', 'om', 'oromo', 'Oromo (Kenya)', NULL),
('or_IN', 'or', 'oriya', 'Oriya (India)', NULL),
('os_RU', 'os', 'ossetic', 'Ossetic (Russia)', NULL),
('pap_AN', 'pap', 'papiamento', 'Papiamento (Netherlands Antilles)', NULL),
('pa_IN', 'pa', 'punjabi', 'Punjabi (India)', NULL),
('pa_PK', 'pa', 'punjabi', 'Punjabi (Pakistan)', NULL),
('pl_PL', 'pl', 'polish', 'Polish (Poland)', NULL),
('ps_AF', 'ps', 'pashto', 'Pashto (Afghanistan)', NULL),
('pt_BR', 'pt', 'portuguese', 'Portuguese (Brazil)', NULL),
('pt_GW', 'pt', 'portuguese', 'Portuguese (Guinea-Bissau)', NULL),
('pt_PT', 'pt', 'portuguese', 'Portuguese (Portugal)', NULL),
('ro_MD', 'ro', 'romanian', 'Romanian (Moldova)', NULL),
('ro_RO', 'ro', 'romanian', 'Romanian (Romania)', NULL),
('ru_RU', 'ru', 'russian', 'Russian (Russia)', NULL),
('ru_UA', 'ru', 'russian', 'Russian (Ukraine)', NULL),
('rw_RW', 'rw', 'kinyarwanda', 'Kinyarwanda (Rwanda)', NULL),
('sa_IN', 'sa', 'sanskrit', 'Sanskrit (India)', NULL),
('sc_IT', 'sc', 'sardinian', 'Sardinian (Italy)', NULL),
('sd_IN', 'sd', 'sindhi', 'Sindhi (India)', NULL),
('seh_MZ', 'seh', 'sena', 'Sena (Mozambique)', NULL),
('se_NO', 'se', 'northern sami', 'Northern Sami (Norway)', NULL),
('sid_ET', 'sid', 'sidamo', 'Sidamo (Ethiopia)', NULL),
('si_LK', 'si', 'sinhala', 'Sinhala (Sri Lanka)', NULL),
('sk_SK', 'sk', 'slovak', 'Slovak (Slovakia)', NULL),
('sl_SI', 'sl', 'slovenian', 'Slovenian (Slovenia)', NULL),
('sn_ZW', 'sn', 'shona', 'Shona (Zimbabwe)', NULL),
('so_DJ', 'so', 'somali', 'Somali (Djibouti)', NULL),
('so_ET', 'so', 'somali', 'Somali (Ethiopia)', NULL),
('so_KE', 'so', 'somali', 'Somali (Kenya)', NULL),
('so_SO', 'so', 'somali', 'Somali (Somalia)', NULL),
('sq_AL', 'sq', 'albanian', 'Albanian (Albania)', NULL),
('sq_MK', 'sq', 'albanian', 'Albanian (Macedonia)', NULL),
('sr_BA', 'sr', 'serbian', 'Serbian (Bosnia and Herzegovina)', NULL),
('sr_ME', 'sr', 'serbian', 'Serbian (Montenegro)', NULL),
('sr_RS', 'sr', 'serbian', 'Serbian (Serbia)', NULL),
('ss_ZA', 'ss', 'swati', 'Swati (South Africa)', NULL),
('st_ZA', 'st', 'southern sotho', 'Southern Sotho (South Africa)', NULL),
('sv_FI', 'sv', 'swedish', 'Swedish (Finland)', NULL),
('sv_SE', 'sv', 'swedish', 'Swedish (Sweden)', NULL),
('sw_KE', 'sw', 'swahili', 'Swahili (Kenya)', NULL),
('sw_TZ', 'sw', 'swahili', 'Swahili (Tanzania)', NULL),
('ta_IN', 'ta', 'tamil', 'Tamil (India)', NULL),
('teo_UG', 'teo', 'teso', 'Teso (Uganda)', NULL),
('te_IN', 'te', 'telugu', 'Telugu (India)', NULL),
('tg_TJ', 'tg', 'tajik', 'Tajik (Tajikistan)', NULL),
('th_TH', 'th', 'thai', 'Thai (Thailand)', NULL),
('tig_ER', 'tig', 'tigre', 'Tigre (Eritrea)', NULL),
('ti_ER', 'ti', 'tigrinya', 'Tigrinya (Eritrea)', NULL),
('ti_ET', 'ti', 'tigrinya', 'Tigrinya (Ethiopia)', NULL),
('tk_TM', 'tk', 'turkmen', 'Turkmen (Turkmenistan)', NULL),
('tl_PH', 'tl', 'tagalog', 'Tagalog (Philippines)', NULL),
('tn_ZA', 'tn', 'tswana', 'Tswana (South Africa)', NULL),
('to_TO', 'to', 'tongan', 'Tongan (Tonga)', NULL),
('tr_CY', 'tr', 'turkish', 'Turkish (Cyprus)', NULL),
('tr_TR', 'tr', 'turkish', 'Turkish (Turkey)', NULL),
('ts_ZA', 'ts', 'tsonga', 'Tsonga (South Africa)', NULL),
('tt_RU', 'tt', 'tatar', 'Tatar (Russia)', NULL),
('ug_CN', 'ug', 'uighur', 'Uighur (China)', NULL),
('uk_UA', 'uk', 'ukrainian', 'Ukrainian (Ukraine)', NULL),
('ur_PK', 'ur', 'urdu', 'Urdu (Pakistan)', NULL),
('uz_UZ', 'uz', 'uzbek', 'Uzbek (Uzbekistan)', NULL),
('ve_ZA', 've', 'venda', 'Venda (South Africa)', NULL),
('vi_VN', 'vi', 'vietnamese', 'Vietnamese (Vietnam)', NULL),
('wa_BE', 'wa', 'walloon', 'Walloon (Belgium)', NULL),
('wo_SN', 'wo', 'wolof', 'Wolof (Senegal)', NULL),
('xh_ZA', 'xh', 'xhosa', 'Xhosa (South Africa)', NULL),
('yi_US', 'yi', 'yiddish', 'Yiddish (United States)', NULL),
('yo_NG', 'yo', 'yoruba', 'Yoruba (Nigeria)', NULL),
('zh_CN', 'zh', 'chinese', 'Chinese (China)', NULL),
('zh_HK', 'zh', 'chinese', 'Chinese (Hong Kong SAR China)', NULL),
('zh_SG', 'zh', 'chinese', 'Chinese (Singapore)', NULL),
('zh_TW', 'zh', 'chinese', 'Chinese (Taiwan)', NULL),
('zu_ZA', 'zu', 'zulu', 'Zulu (South Africa)', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_manufacturer`
--

CREATE TABLE IF NOT EXISTS `tbl_manufacturer` (
  `manufacturer_id` int NOT NULL AUTO_INCREMENT,
  `manufacturer` varchar(100) NOT NULL,
  `description` text,
  PRIMARY KEY (`manufacturer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_menu`
--

CREATE TABLE IF NOT EXISTS `tbl_menu` (
  `menu_id` int NOT NULL AUTO_INCREMENT,
  `label` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `parent` int NOT NULL DEFAULT '0',
  `sort` int NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(1) DEFAULT '1' COMMENT '1= active 0=inactive',
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=213 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_menu`
--

INSERT INTO `tbl_menu` (`menu_id`, `label`, `link`, `icon`, `parent`, `sort`, `status`) VALUES
(1, 'dashboard', 'admin/dashboard', 'fa fa-dashboard', 0, 0, 1),
(2, 'calendar', 'admin/calendar', 'fa fa-calendar', 0, 1, 1),
(4, 'client', 'admin/client/manage_client', 'fa fa-users', 0, 13, 1),
(5, 'mailbox', 'admin/mailbox', 'fa fa-envelope-o', 0, 2, 1),
(6, 'tickets', 'admin/tickets', 'fa fa-ticket', 0, 10, 1),
(12, 'sales', '#', 'fa fa-shopping-cart', 0, 9, 1),
(13, 'invoice', 'admin/invoice/manage_invoice', 'fa fa-circle-o', 12, 0, 1),
(14, 'estimates', 'admin/estimates', 'fa fa-circle-o', 12, 1, 1),
(15, 'payments_received', 'admin/invoice/all_payments', 'fa fa-circle-o', 12, 3, 1),
(16, 'tax_rates', 'admin/invoice/tax_rates', 'fa fa-circle-o', 12, 5, 1),
(21, 'quotations', '#', 'fa fa-paste', 12, 7, 1),
(22, 'quotations_list', 'admin/quotations', 'fa fa-circle-o', 21, 0, 1),
(23, 'quotations_form', 'admin/quotations/quotations_form', 'fa fa-circle-o', 21, 1, 1),
(24, 'user', 'admin/user/user_list', 'fa fa-users', 0, 25, 1),
(25, 'settings', 'admin/settings', 'fa fa-cogs', 0, 26, 1),
(26, 'database_backup', 'admin/settings/database_backup', 'fa fa-database', 0, 27, 1),
(29, 'transactions_menu', '#', 'fa fa-building-o', 0, 12, 1),
(30, 'deposit', 'admin/transactions/deposit', 'fa fa-circle-o', 29, 1, 1),
(31, 'expense', 'admin/transactions/expense', 'fa fa-circle-o', 29, 0, 1),
(32, 'transfer', 'admin/transactions/transfer', 'fa fa-circle-o', 29, 2, 1),
(33, 'transactions_report', 'admin/transactions/transactions_report', 'fa fa-circle-o', 29, 3, 1),
(34, 'balance_sheet', 'admin/transactions/balance_sheet', 'fa fa-circle-o', 29, 5, 1),
(36, 'bank_cash', 'admin/account/manage_account', 'fa fa-money', 29, 6, 1),
(39, 'items', 'admin/items/items_list', 'fa fa-cube', 150, 0, 1),
(42, 'report', '#', 'fa fa-bar-chart', 0, 24, 1),
(43, 'account_statement', 'admin/report/account_statement', 'fa fa-circle-o', 146, 0, 1),
(44, 'income_report', 'admin/report/income_report', 'fa fa-circle-o', 146, 2, 1),
(45, 'expense_report', 'admin/report/expense_report', 'fa fa-circle-o', 146, 1, 1),
(46, 'income_expense', 'admin/report/income_expense', 'fa fa-circle-o', 146, 3, 1),
(47, 'date_wise_report', 'admin/report/date_wise_report', 'fa fa-circle-o', 146, 4, 1),
(48, 'all_income', 'admin/report/all_income', 'fa fa-circle-o', 146, 6, 1),
(49, 'all_expense', 'admin/report/all_expense', 'fa fa-circle-o', 146, 7, 1),
(50, 'all_transaction', 'admin/report/all_transaction', 'fa fa-circle-o', 146, 8, 1),
(51, 'recurring_invoice', 'admin/invoice/recurring_invoice', 'fa fa-circle-o', 12, 2, 1),
(52, 'transfer_report', 'admin/transactions/transfer_report', 'fa fa-circle-o', 29, 4, 1),
(53, 'report_by_month', 'admin/report/report_by_month', 'fa fa-circle-o', 146, 5, 1),
(54, 'tasks', 'admin/tasks/all_task', 'fa fa-tasks', 0, 5, 1),
(55, 'leads', 'admin/leads', 'fa fa-rocket', 0, 8, 1),
(56, 'opportunities', 'admin/opportunities', 'fa fa-filter', 0, 7, 1),
(57, 'projects', 'admin/projects', 'fa fa-folder-open-o', 0, 4, 1),
(58, 'bugs', 'admin/bugs', 'fa fa-bug', 0, 6, 1),
(59, 'project', '#', 'fa fa-folder-open-o', 42, 2, 1),
(60, 'tasks_report', 'admin/report/tasks_report', 'fa fa-circle-o', 42, 3, 1),
(61, 'bugs_report', 'admin/report/bugs_report', 'fa fa-circle-o', 42, 4, 1),
(62, 'tickets_report', 'admin/report/tickets_report', 'fa fa-circle-o', 42, 5, 1),
(63, 'client_report', 'admin/report/client_report', 'fa fa-circle-o', 42, 6, 1),
(66, 'tasks_assignment', 'admin/report/tasks_assignment', 'fa fa-dot-circle-o', 59, 0, 1),
(67, 'bugs_assignment', 'admin/report/bugs_assignment', 'fa fa-dot-circle-o', 59, 1, 1),
(68, 'project_report', 'admin/report/project_report', 'fa fa-dot-circle-o', 59, 2, 1),
(69, 'goal_tracking', 'admin/goal_tracking', 'fa fa-shield', 73, 1, 1),
(70, 'departments', 'admin/departments', 'fa fa-user-secret', 0, 14, 1),
(71, 'holiday', 'admin/holiday', 'fa fa-calendar-plus-o', 73, 0, 1),
(72, 'leave_management', 'admin/leave_management', 'fa fa-plane', 0, 20, 1),
(73, 'utilities', '#', 'fa fa-gift', 0, 23, 1),
(74, 'overtime', 'admin/utilities/overtime', 'fa fa-clock-o', 89, 9, 1),
(75, 'office_stock', '#', 'fa fa-codepen', 0, 15, 1),
(76, 'stock_category', 'admin/stock/stock_category', 'fa fa-sliders', 75, 0, 1),
(77, 'manage_stock', '#', 'fa fa-archive', 75, 2, 1),
(78, 'assign_stock', '#', 'fa fa-align-left', 75, 3, 1),
(79, 'stock_report', 'admin/stock/report', 'fa fa-line-chart', 75, 4, 1),
(81, 'stock_list', 'admin/stock/stock_list', 'fa fa-stack-exchange', 75, 1, 1),
(82, 'assign_stock', 'admin/stock/assign_stock', 'fa fa-align-left', 78, 0, 1),
(83, 'assign_stock_report', 'admin/stock/assign_stock_report', 'fa fa-bar-chart', 78, 1, 1),
(84, 'stock_history', 'admin/stock/stock_history', 'fa fa-file-text-o', 77, 0, 1),
(85, 'performance', '#', 'fa fa-dribbble', 0, 19, 1),
(86, 'performance_indicator', 'admin/performance/performance_indicator', 'fa fa-random', 85, 0, 1),
(87, 'performance_report', 'admin/performance/performance_report', 'fa fa-calendar-o', 85, 2, 1),
(88, 'give_appraisal', 'admin/performance/give_performance_appraisal', 'fa fa-plus', 85, 1, 1),
(89, 'payroll', '#', 'fa fa-usd', 0, 18, 1),
(90, 'manage_salary_details', 'admin/payroll/manage_salary_details', 'fa fa-usd', 89, 2, 1),
(91, 'employee_salary_list', 'admin/payroll/employee_salary_list', 'fa fa-user-secret', 89, 3, 1),
(92, 'make_payment', 'admin/payroll/make_payment', 'fa fa-tasks', 89, 4, 1),
(93, 'generate_payslip', 'admin/payroll/generate_payslip', 'fa fa-list-ul', 89, 5, 1),
(94, 'salary_template', 'admin/payroll/salary_template', 'fa fa-money', 89, 0, 1),
(95, 'hourly_rate', 'admin/payroll/hourly_rate', 'fa fa-clock-o', 89, 1, 1),
(96, 'payroll_summary', 'admin/payroll/payroll_summary', 'fa fa-camera-retro', 89, 6, 1),
(97, 'provident_fund', 'admin/payroll/provident_fund', 'fa fa-briefcase', 89, 8, 1),
(98, 'advance_salary', 'admin/payroll/advance_salary', 'fa fa-cc-mastercard', 89, 7, 1),
(99, 'employee_award', 'admin/award', 'fa fa-trophy', 89, 10, 1),
(100, 'announcements', 'admin/announcements', 'fa fa-bullhorn icon', 0, 22, 1),
(101, 'training', 'admin/training', 'fa fa-suitcase', 0, 21, 1),
(102, 'job_circular', '#', 'fa fa-globe', 0, 17, 1),
(103, 'jobs_posted', 'admin/job_circular/jobs_posted', 'fa fa-ticket', 102, 0, 1),
(104, 'jobs_applications', 'admin/job_circular/jobs_applications', 'fa fa-compass', 102, 1, 1),
(105, 'attendance', '#', 'fa fa-file-text', 0, 16, 1),
(106, 'timechange_request', 'admin/attendance/timechange_request', 'fa fa-calendar-o', 105, 1, 1),
(107, 'attendance_report', 'admin/attendance/attendance_report', 'fa fa-file-text', 105, 2, 1),
(108, 'time_history', 'admin/attendance/time_history', 'fa fa-clock-o', 105, 0, 1),
(109, 'pull-down', '', '', 0, 0, 0),
(110, 'filemanager', 'admin/filemanager', 'fa fa-file', 0, 3, 1),
(111, 'company_details', 'admin/settings', 'fa fa-fw fa-info-circle', 25, 1, 2),
(112, 'system_settings', 'admin/settings/system', 'fa fa-fw fa-desktop', 25, 2, 2),
(113, 'email_settings', 'admin/settings/email', 'fa fa-fw fa-envelope', 25, 3, 2),
(114, 'email_templates', 'admin/settings/templates', 'fa fa-fw fa-pencil-square', 25, 5, 2),
(115, 'email_integration', 'admin/settings/email_integration', 'fa fa-fw fa-envelope-o', 25, 6, 2),
(116, 'payment_settings', 'admin/settings/payments', 'fa fa-fw fa-dollar', 25, 7, 2),
(117, 'invoice_settings', 'admin/settings/invoice', 'fa fa-fw fa-money', 25, 8, 2),
(118, 'estimate_settings', 'admin/settings/estimate', 'fa fa-fw fa-file-o', 25, 10, 2),
(119, 'tickets_leads_settings', 'admin/settings/tickets', 'fa fa-fw fa-ticket', 25, 14, 2),
(120, 'theme_settings', 'admin/settings/theme', 'fa fa-fw fa-code', 25, 20, 2),
(121, 'working_days', 'admin/settings/working_days', 'fa fa-fw fa-calendar', 25, 22, 2),
(122, 'leave_category', 'admin/settings/leave_category', 'fa fa-fw fa-pagelines', 25, 23, 2),
(123, 'income_category', 'admin/settings/income_category', 'fa fa-fw fa-certificate', 25, 24, 2),
(124, 'expense_category', 'admin/settings/expense_category', 'fa fa-fw fa-tasks', 25, 25, 2),
(125, 'customer_group', 'admin/settings/customer_group', 'fa fa-fw fa-users', 25, 26, 2),
(127, 'lead_status', 'admin/settings/lead_status', 'fa fa-fw fa-list-ul', 25, 16, 2),
(128, 'lead_source', 'admin/settings/lead_source', 'fa fa-fw fa-arrow-down', 25, 17, 2),
(129, 'opportunities_state_reason', 'admin/settings/opportunities_state_reason', 'fa fa-fw fa-dot-circle-o', 25, 19, 2),
(130, 'custom_field', 'admin/settings/custom_field', 'fa fa-fw fa-star-o', 25, 28, 2),
(131, 'payment_method', 'admin/settings/payment_method', 'fa fa-fw fa-money', 25, 29, 2),
(132, 'cronjob', 'admin/settings/cronjob', 'fa fa-fw fa-contao', 25, 31, 2),
(133, 'menu_allocation', 'admin/settings/menu_allocation', 'fa fa-fw fa fa-compass', 25, 32, 2),
(134, 'notification', 'admin/settings/notification', 'fa fa-fw fa-bell-o', 25, 33, 2),
(135, 'email_notification', 'admin/settings/email_notification', 'fa fa-fw fa-bell-o', 25, 34, 2),
(136, 'database_backup', 'admin/settings/database_backup', 'fa fa-fw fa-database', 25, 35, 2),
(137, 'translations', 'admin/settings/translations', 'fa fa-fw fa-language', 25, 36, 2),
(138, 'system_update', 'admin/settings/system_update', 'fa fa-fw fa-pencil-square-o', 25, 37, 2),
(139, 'private_chat', 'chat/conversations', 'fa fa-envelope', 0, 28, 1),
(140, 'proposals', 'admin/proposals', 'fa fa-circle-o', 12, 4, 1),
(141, 'knowledgebase', '#', 'fa fa-question-circle', 0, 11, 1),
(142, 'categories', 'admin/knowledgebase/categories', 'fa fa-circle-o', 141, 2, 1),
(143, 'articles', 'admin/knowledgebase/articles', 'fa fa-circle-o', 141, 1, 1),
(144, 'knowledgebase', 'admin/knowledgebase', 'fa fa-circle-o', 141, 0, 1),
(145, 'dashboard_settings', 'admin/settings/dashboard', 'fa fa-fw fa-dashboard', 25, 21, 2),
(146, 'transactions_reports', '#', 'fa fa-building-o', 42, 1, 1),
(147, 'sales', 'admin/report/sales_report', 'fa fa-shopping-cart', 42, 0, 1),
(148, 'mark_attendance', 'admin/mark_attendance', 'fa fa-file-text', 105, 2, 1),
(149, 'allowed_ip', 'admin/settings/allowed_ip', 'fa fa-server', 25, 27, 2),
(150, 'stock', '#', 'icon-layers', 0, 8, 1),
(151, 'supplier', 'admin/supplier', 'icon-briefcase', 150, 1, 1),
(152, 'purchase', 'admin/purchase', 'icon-handbag', 150, 2, 1),
(153, 'return_stock', 'admin/return_stock', 'icon-share-alt', 150, 3, 1),
(154, 'purchase_payment', 'admin/purchase/all_payments', 'icon-credit-card', 150, 4, 1),
(155, 'purchase_settings', 'admin/settings/purchase', 'fa-fw icon-handbag', 25, 12, 2),
(156, 'credit_note', 'admin/credit_note', 'fa fa-circle-o', 12, 1, 1),
(157, 'projects_settings', 'admin/settings/projects', 'fa fa-fw fa-folder-open-o', 25, 9, 2),
(158, 'tags', 'admin/settings/tags', 'fa fa-fw fa-tags', 25, 11, 2),
(159, 'lead_form', 'admin/leads/all_lead_form', 'fa fa-fw fa-rocket', 25, 13, 2),
(160, 'sms_settings', 'admin/settings/sms_settings', 'fa fa-fw fa-envelope', 25, 30, 2),
(161, 'pos_sales', 'admin/invoice/pos_sales', 'fa fa-circle-o', 12, 0, 1),
(186, 'warehouse', 'admin/warehouse/manage', 'fa fa-building-o', 150, 3, 1),
(187, 'transferItem', 'admin/items/transferItem', 'fa fa-circle-o', 150, 4, 1),
(203, 'award_setting', 'admin/settings/award', 'fa fa-star', 25, 30, 2),
(204, 'award_rule_setting', 'admin/settings/award_rule_settingh', 'fa fa-star', 25, 31, 2),
(205, 'award_program_settings', 'admin/settings/award_program_settings', 'fa fa-cog', 25, 32, 2),
(206, 'client_award_points', 'admin/invoice/client_awards', 'fa fa-circle-o', 12, 10, 1),
(207, 'best_selling_product', 'admin/best_selling', 'fa fa-circle-o', 12, 11, 1),
(209, 'warning', 'admin/warning', 'fa fa-warning', 0, 3, 1),
(210, 'promotion', 'admin/promotion', 'fa fa-arrow-circle-up', 0, 4, 1),
(211, 'termination', 'admin/termination', 'fa fa-eraser', 0, 5, 1),
(212, 'resignation', 'admin/resignation', 'fa fa-scissors', 0, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mettings`
--

CREATE TABLE IF NOT EXISTS `tbl_mettings` (
  `mettings_id` int NOT NULL AUTO_INCREMENT,
  `leads_id` int DEFAULT NULL,
  `opportunities_id` int DEFAULT NULL,
  `meeting_subject` varchar(200) NOT NULL,
  `attendees` varchar(300) NOT NULL,
  `user_id` int NOT NULL,
  `module` varchar(50) DEFAULT NULL,
  `module_field_id` int DEFAULT NULL,
  `start_date` varchar(100) NOT NULL,
  `end_date` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `description` mediumtext NOT NULL,
  PRIMARY KEY (`mettings_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_migrations`
--

CREATE TABLE IF NOT EXISTS `tbl_migrations` (
  `version` bigint NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_migrations`
--

INSERT INTO `tbl_migrations` (`version`) VALUES
(602);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_milestones`
--

CREATE TABLE IF NOT EXISTS `tbl_milestones` (
  `milestones_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `project_id` int NOT NULL,
  `milestone_name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `start_date` varchar(20) NOT NULL,
  `end_date` varchar(20) NOT NULL,
  `client_visible` text,
  PRIMARY KEY (`milestones_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_modules`
--

CREATE TABLE IF NOT EXISTS `tbl_modules` (
  `module_id` int NOT NULL AUTO_INCREMENT,
  `module_name` varchar(55) NOT NULL,
  `installed_version` varchar(11) NOT NULL,
  `active` tinyint(1) NOT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notes`
--

CREATE TABLE IF NOT EXISTS `tbl_notes` (
  `notes_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `is_client` enum('Yes','No') NOT NULL DEFAULT 'No',
  `notes` mediumtext,
  `added_by` int NOT NULL,
  `added_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`notes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_notifications`
--

CREATE TABLE IF NOT EXISTS `tbl_notifications` (
  `notifications_id` int NOT NULL AUTO_INCREMENT,
  `read` int NOT NULL DEFAULT '0',
  `read_inline` tinyint(1) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL,
  `description` text NOT NULL,
  `from_user_id` int NOT NULL DEFAULT '0',
  `to_user_id` int NOT NULL DEFAULT '0',
  `name` varchar(200) DEFAULT NULL,
  `link` text,
  `icon` varchar(200) DEFAULT NULL,
  `value` text,
  PRIMARY KEY (`notifications_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_offence_category`
--

CREATE TABLE IF NOT EXISTS `tbl_offence_category` (
  `offence_id` int NOT NULL AUTO_INCREMENT,
  `offence_category` varchar(100) NOT NULL,
  PRIMARY KEY (`offence_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_online_payment`
--

CREATE TABLE IF NOT EXISTS `tbl_online_payment` (
  `online_payment_id` int NOT NULL AUTO_INCREMENT,
  `gateway_name` varchar(20) NOT NULL,
  `icon` text NOT NULL,
  `field_1` varchar(100) DEFAULT NULL,
  `field_2` varchar(100) DEFAULT NULL,
  `field_3` varchar(100) DEFAULT NULL,
  `field_4` varchar(100) DEFAULT NULL,
  `field_5` varchar(100) DEFAULT NULL,
  `link` varchar(100) DEFAULT NULL,
  `modal` enum('Yes','No') DEFAULT NULL,
  PRIMARY KEY (`online_payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_online_payment`
--

INSERT INTO `tbl_online_payment` (`online_payment_id`, `gateway_name`, `icon`, `field_1`, `field_2`, `field_3`, `field_4`, `field_5`, `link`, `modal`) VALUES
(1, 'paypal', 'asset/images/payment_logo/paypal.png', 'paypal_api_username', 'paypal_api_password|password', 'api_signature', 'paypal_live|checkbox', '', 'payment/paypal', 'Yes'),
(2, 'Stripe', 'asset/images/payment_logo/stripe.jpg', 'stripe_private_key', 'stripe_public_key', NULL, NULL, NULL, 'payment/stripe', 'Yes'),
(3, '2checkout', 'asset/images/payment_logo/2checkout.jpg', '2checkout_live|checkbox', '2checkout_publishable_key', '2checkout_private_key', '2checkout_seller_id', NULL, 'payment/checkout', 'No'),
(4, 'Authorize.net', 'asset/images/payment_logo/Authorizenet.png', 'aim_api_login_id', 'aim_authorize_transaction_key', 'aim_authorize_live|checkbox', '', '', 'payment/authorize', 'No'),
(5, 'CCAvenue', 'asset/images/payment_logo/CCAvenue.jpg', 'ccavenue_merchant_id', 'ccavenue_key', 'ccavenue_access_code', 'ccavenue_enable_test_mode|checkbox', '', 'payment/ccavenue', 'No'),
(6, 'Braintree', 'asset/images/payment_logo/Braintree.png', 'braintree_merchant_id', 'braintree_private_key', 'braintree_public_key', 'braintree_live_or_sandbox|checkbox', '', 'payment/braintree', 'No'),
(7, 'Mollie', 'asset/images/payment_logo/ideal_mollie.png', 'mollie_api_key', 'mollie_partner_id', NULL, NULL, NULL, 'payment/mollie', 'Yes'),
(8, 'PayUmoney', 'asset/images/payment_logo/payumoney.jpg', 'payumoney_key', 'payumoney_salt', 'payumoney_enable_test_mode|checkbox', '', NULL, 'payment/payumoney', 'No'),
(9, 'Razorpay', 'asset/images/payment_logo/razorpay.png', 'razorpay_key', NULL, NULL, NULL, NULL, 'payment/razorpay', 'Yes'),
(10, 'TapPayment', 'asset/images/payment_logo/tappayment.jpg', 'tap_api_key', 'tap_user_name', 'tap_password|password', 'tap_merchantID', '', 'payment/TapPayment', 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_opportunities`
--

CREATE TABLE IF NOT EXISTS `tbl_opportunities` (
  `opportunities_id` int NOT NULL AUTO_INCREMENT,
  `opportunity_name` varchar(100) NOT NULL,
  `stages` varchar(20) NOT NULL,
  `probability` varchar(20) NOT NULL,
  `close_date` varchar(20) NOT NULL,
  `opportunities_state_reason_id` int NOT NULL,
  `expected_revenue` varchar(300) DEFAULT NULL,
  `new_link` varchar(20) NOT NULL,
  `next_action` varchar(100) NOT NULL,
  `next_action_date` varchar(20) NOT NULL,
  `notes` text,
  `permission` text,
  PRIMARY KEY (`opportunities_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_opportunities_state_reason`
--

CREATE TABLE IF NOT EXISTS `tbl_opportunities_state_reason` (
  `opportunities_state_reason_id` int NOT NULL AUTO_INCREMENT,
  `opportunities_state` varchar(20) NOT NULL,
  `opportunities_state_reason` varchar(100) NOT NULL,
  PRIMARY KEY (`opportunities_state_reason_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_outgoing_emails`
--

CREATE TABLE IF NOT EXISTS `tbl_outgoing_emails` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `sent_to` varchar(64) DEFAULT NULL,
  `sent_from` varchar(64) DEFAULT NULL,
  `subject` text,
  `message` longtext,
  `date_sent` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `delivered` int DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_overtime`
--

CREATE TABLE IF NOT EXISTS `tbl_overtime` (
  `overtime_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `overtime_date` date NOT NULL,
  `overtime_hours` varchar(20) NOT NULL,
  `notes` text,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`overtime_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payments`
--

CREATE TABLE IF NOT EXISTS `tbl_payments` (
  `payments_id` int NOT NULL AUTO_INCREMENT,
  `invoices_id` int NOT NULL,
  `trans_id` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `payer_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `payment_method` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `amount` longtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `currency` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'USD',
  `notes` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `payment_date` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `month_paid` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `year_paid` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `paid_by` int NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `account_id` int NOT NULL DEFAULT '0' COMMENT 'account_id means tracking deposit from which account',
  PRIMARY KEY (`payments_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_payment_methods`
--

CREATE TABLE IF NOT EXISTS `tbl_payment_methods` (
  `payment_methods_id` int NOT NULL AUTO_INCREMENT,
  `method_name` varchar(64) NOT NULL DEFAULT 'Paypal',
  PRIMARY KEY (`payment_methods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_payment_methods`
--

INSERT INTO `tbl_payment_methods` (`payment_methods_id`, `method_name`) VALUES
(1, 'Online'),
(2, 'PayPal'),
(3, 'Payoneer'),
(4, 'Bank Transfer'),
(5, 'Cash ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_penalty_category`
--

CREATE TABLE IF NOT EXISTS `tbl_penalty_category` (
  `penalty_id` int NOT NULL AUTO_INCREMENT,
  `penalty_type` varchar(100) NOT NULL,
  `fine_amount` int NOT NULL,
  `penalty_days` varchar(10) NOT NULL,
  PRIMARY KEY (`penalty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_performance_apprisal`
--

CREATE TABLE IF NOT EXISTS `tbl_performance_apprisal` (
  `performance_appraisal_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `general_remarks` text NOT NULL,
  `appraisal_month` varchar(100) NOT NULL,
  `customer_experiece_management` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `marketing` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `management` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `administration` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `presentation_skill` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `quality_of_work` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `efficiency` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `integrity` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 (S) = Satisfactory, 2 (U) = Unsatisfactory, 3 (N) = Needs Improvement',
  `professionalism` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 (S) = Satisfactory, 2 (U) = Unsatisfactory, 3 (N) = Needs Improvement',
  `team_work` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 (S) = Satisfactory, 2 (U) = Unsatisfactory, 3 (N) = Needs Improvement',
  `critical_thinking` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 (S) = Satisfactory, 2 (U) = Unsatisfactory, 3 (N) = Needs Improvement',
  `conflict_management` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 (S) = Satisfactory, 2 (U) = Unsatisfactory, 3 (N) = Needs Improvement',
  `attendance` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 (S) = Satisfactory, 2 (U) = Unsatisfactory, 3 (N) = Needs Improvement',
  `ability_to_meed_deadline` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 (S) = Satisfactory, 2 (U) = Unsatisfactory, 3 (N) = Needs Improvement',
  PRIMARY KEY (`performance_appraisal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_performance_indicator`
--

CREATE TABLE IF NOT EXISTS `tbl_performance_indicator` (
  `performance_indicator_id` int NOT NULL AUTO_INCREMENT,
  `designations_id` int NOT NULL,
  `customer_experiece_management` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `marketing` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `management` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `administration` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `presentation_skill` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `quality_of_work` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `efficiency` tinyint(1) DEFAULT NULL COMMENT 'Technical - 1 = Beginner, 2 = Intermediate, 3 = Advanced, 4 = Expert / Leader',
  `integrity` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 = Beginner, 2 = Intermediate, 3 = Advanced',
  `professionalism` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 = Beginner, 2 = Intermediate, 3 = Advanced',
  `team_work` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 = Beginner, 2 = Intermediate, 3 = Advanced',
  `critical_thinking` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 = Beginner, 2 = Intermediate, 3 = Advanced',
  `conflict_management` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 = Beginner, 2 = Intermediate, 3 = Advanced',
  `attendance` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 = Beginner, 2 = Intermediate, 3 = Advanced',
  `ability_to_meed_deadline` tinyint(1) DEFAULT NULL COMMENT 'Behavioural - 1 = Beginner, 2 = Intermediate, 3 = Advanced',
  PRIMARY KEY (`performance_indicator_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pinaction`
--

CREATE TABLE IF NOT EXISTS `tbl_pinaction` (
  `pinaction_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `module_id` int NOT NULL,
  `module_name` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`pinaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_priorities`
--

CREATE TABLE IF NOT EXISTS `tbl_priorities` (
  `priority` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_priorities`
--

INSERT INTO `tbl_priorities` (`priority`) VALUES
('High'),
('medium'),
('low');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_priority`
--

CREATE TABLE IF NOT EXISTS `tbl_priority` (
  `priority_id` int NOT NULL AUTO_INCREMENT,
  `priority` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`priority_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_priority`
--

INSERT INTO `tbl_priority` (`priority_id`, `priority`) VALUES
(1, 'High'),
(2, 'Medium'),
(3, 'Low'),
(4, 'ok');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_private_chat`
--

CREATE TABLE IF NOT EXISTS `tbl_private_chat` (
  `private_chat_id` int NOT NULL AUTO_INCREMENT,
  `chat_title` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`private_chat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_private_chat_messages`
--

CREATE TABLE IF NOT EXISTS `tbl_private_chat_messages` (
  `private_chat_messages_id` int NOT NULL AUTO_INCREMENT,
  `private_chat_id` int NOT NULL,
  `user_id` int NOT NULL,
  `message` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `message_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`private_chat_messages_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_private_chat_users`
--

CREATE TABLE IF NOT EXISTS `tbl_private_chat_users` (
  `private_chat_users_id` int NOT NULL AUTO_INCREMENT,
  `private_chat_id` int NOT NULL,
  `user_id` int NOT NULL,
  `to_user_id` int NOT NULL,
  `active` int NOT NULL COMMENT '0 == minimize chat,1 == open chat and  2 == close chat ',
  `unread` int NOT NULL,
  `title` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `deleted` int NOT NULL DEFAULT '0' COMMENT 'keep last message id',
  PRIMARY KEY (`private_chat_users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project`
--

CREATE TABLE IF NOT EXISTS `tbl_project` (
  `project_id` int NOT NULL AUTO_INCREMENT,
  `project_no` varchar(100) DEFAULT NULL,
  `project_name` varchar(100) NOT NULL,
  `category_id` int DEFAULT NULL,
  `client_id` text,
  `progress` varchar(50) NOT NULL,
  `calculate_progress` varchar(50) DEFAULT NULL,
  `start_date` varchar(20) NOT NULL,
  `end_date` varchar(20) NOT NULL,
  `alert_overdue` tinyint(1) NOT NULL DEFAULT '0',
  `project_cost` decimal(18,2) NOT NULL DEFAULT '0.00',
  `demo_url` varchar(100) NOT NULL,
  `project_status` varchar(20) NOT NULL,
  `description` text,
  `notify_client` enum('Yes','No') NOT NULL,
  `timer_status` enum('on','off') DEFAULT NULL,
  `timer_started_by` int DEFAULT NULL,
  `start_time` int DEFAULT NULL,
  `logged_time` int DEFAULT NULL,
  `permission` text,
  `notes` text,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `hourly_rate` varchar(200) DEFAULT NULL,
  `fixed_rate` varchar(200) DEFAULT NULL,
  `project_settings` text,
  `with_tasks` enum('yes','no') NOT NULL DEFAULT 'no',
  `estimate_hours` varchar(50) DEFAULT NULL,
  `billing_type` varchar(50) DEFAULT NULL,
  `tags` text,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_project_settings`
--

CREATE TABLE IF NOT EXISTS `tbl_project_settings` (
  `settings_id` int NOT NULL AUTO_INCREMENT,
  `settings` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_project_settings`
--

INSERT INTO `tbl_project_settings` (`settings_id`, `settings`, `description`) VALUES
(1, 'show_team_members', 'view team members'),
(2, 'show_milestones', 'view project milestones'),
(5, 'show_project_tasks', 'view project tasks'),
(6, 'show_project_attachments', 'view project attachments'),
(7, 'show_timesheets', 'view project timesheets'),
(8, 'show_project_bugs', 'view project bugs'),
(9, 'show_project_history', 'view project history'),
(10, 'show_project_calendar', 'view project calendars'),
(11, 'show_project_comments', 'view project comments'),
(13, 'show_gantt_chart', 'view Gantt chart'),
(14, 'show_project_hours', 'view project hours'),
(15, 'comment_on_project_tasks', 'access To comment on project tasks'),
(16, 'show_project_tasks_attachments', 'view task attachments'),
(20, 'show_tasks_hours', 'show_tasks_hours'),
(21, 'show_finance_overview', 'show_finance_overview'),
(22, 'show_staff_finance_overview', 'admin and staff can see the price');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_promotions`
--

CREATE TABLE IF NOT EXISTS `tbl_promotions` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `designation_id` int NOT NULL,
  `from_designations` int NOT NULL,
  `promotion_title` varchar(190) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `promotion_date` date NOT NULL,
  `description` varchar(190) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_proposals`
--

CREATE TABLE IF NOT EXISTS `tbl_proposals` (
  `proposals_id` int NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `subject` varchar(500) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `module` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `module_id` int DEFAULT '0',
  `proposal_date` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `proposal_month` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `proposal_year` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `due_date` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `alert_overdue` tinyint(1) DEFAULT '0',
  `currency` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'USD',
  `notes` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `tax` int NOT NULL DEFAULT '0',
  `total_tax` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'draft',
  `date_sent` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `proposal_deleted` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'No',
  `emailed` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'No',
  `show_client` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'No',
  `convert` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'No',
  `convert_module` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `convert_module_id` int DEFAULT '0',
  `converted_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `permission` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `discount_type` enum('none','before_tax','after_tax') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'none',
  `discount_percent` int NOT NULL DEFAULT '0',
  `discount_total` decimal(18,2) NOT NULL DEFAULT '0.00',
  `warehouse_id` int DEFAULT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `adjustment` decimal(18,2) NOT NULL DEFAULT '0.00',
  `show_quantity_as` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tags` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `allowed_cmments` enum('Yes','No') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Yes',
  PRIMARY KEY (`proposals_id`),
  UNIQUE KEY `reference_no` (`reference_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_proposals_items`
--

CREATE TABLE IF NOT EXISTS `tbl_proposals_items` (
  `proposals_items_id` int NOT NULL AUTO_INCREMENT,
  `proposals_id` int NOT NULL,
  `saved_items_id` int DEFAULT '0',
  `item_name` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'Item Name',
  `item_desc` longtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `quantity` decimal(10,2) DEFAULT '0.00',
  `unit_cost` decimal(10,2) DEFAULT '0.00',
  `item_tax_rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `item_tax_name` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `item_tax_total` decimal(10,2) DEFAULT '0.00',
  `total_cost` decimal(10,2) DEFAULT '0.00',
  `date_saved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order` int DEFAULT '0',
  `unit` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `hsn_code` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  PRIMARY KEY (`proposals_items_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchases`
--

CREATE TABLE IF NOT EXISTS `tbl_purchases` (
  `purchase_id` int NOT NULL AUTO_INCREMENT,
  `supplier_id` int DEFAULT NULL,
  `reference_no` varchar(100) DEFAULT NULL,
  `total` decimal(20,2) DEFAULT NULL,
  `update_stock` enum('Yes','No') DEFAULT 'Yes',
  `stock_updated` enum('Yes','No') NOT NULL DEFAULT 'No',
  `status` varchar(20) DEFAULT NULL,
  `emailed` enum('Yes','No') DEFAULT NULL,
  `date_sent` varchar(20) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `warehouse_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `discount_type` enum('none','before_tax','after_tax') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'none',
  `discount_percent` decimal(10,2) DEFAULT NULL,
  `adjustment` decimal(18,2) DEFAULT NULL,
  `discount_total` decimal(18,2) DEFAULT NULL,
  `show_quantity_as` varchar(10) DEFAULT NULL,
  `permission` text,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_tax` text,
  `tax` decimal(20,2) DEFAULT NULL,
  `notes` text,
  `tags` text,
  PRIMARY KEY (`purchase_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_items`
--

CREATE TABLE IF NOT EXISTS `tbl_purchase_items` (
  `items_id` int NOT NULL AUTO_INCREMENT,
  `purchase_id` int NOT NULL,
  `item_tax_rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `item_tax_name` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `item_tax_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `quantity` decimal(10,2) DEFAULT '0.00',
  `total_cost` decimal(10,2) DEFAULT '0.00',
  `item_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'Item Name',
  `item_desc` longtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `unit_cost` decimal(10,2) DEFAULT '0.00',
  `order` int DEFAULT '0',
  `date_saved` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `unit` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `hsn_code` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `saved_items_id` int DEFAULT '0',
  PRIMARY KEY (`items_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_purchase_payments`
--

CREATE TABLE IF NOT EXISTS `tbl_purchase_payments` (
  `payments_id` int NOT NULL AUTO_INCREMENT,
  `purchase_id` int DEFAULT NULL,
  `trans_id` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `payment_method` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `amount` longtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `currency` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'USD',
  `notes` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `month_paid` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `year_paid` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `paid_to` int NOT NULL,
  `paid_by` int DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `account_id` int NOT NULL DEFAULT '0' COMMENT 'account_id means tracking deduct from which account',
  PRIMARY KEY (`payments_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotationforms`
--

CREATE TABLE IF NOT EXISTS `tbl_quotationforms` (
  `quotationforms_id` int NOT NULL AUTO_INCREMENT,
  `quotationforms_title` varchar(200) NOT NULL,
  `quotationforms_code` text NOT NULL,
  `quotationforms_status` varchar(20) NOT NULL DEFAULT 'enabled' COMMENT 'enabled/disabled',
  `quotations_created_by_id` int NOT NULL,
  `quotationforms_date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`quotationforms_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotations`
--

CREATE TABLE IF NOT EXISTS `tbl_quotations` (
  `quotations_id` int NOT NULL AUTO_INCREMENT,
  `quotations_form_title` varchar(250) NOT NULL,
  `user_id` int DEFAULT NULL,
  `client_id` int DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `quotations_amount` decimal(10,2) DEFAULT NULL,
  `notes` text,
  `reviewer_id` int DEFAULT NULL,
  `reviewed_date` date DEFAULT NULL,
  `quotations_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quotations_status` varchar(15) DEFAULT 'pending' COMMENT 'completed/pending',
  `is_convert` enum('Yes','No') NOT NULL DEFAULT 'No',
  `convert_module` varchar(20) DEFAULT NULL,
  `convert_module_id` int DEFAULT NULL,
  PRIMARY KEY (`quotations_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quotation_details`
--

CREATE TABLE IF NOT EXISTS `tbl_quotation_details` (
  `quotation_details_id` int NOT NULL AUTO_INCREMENT,
  `quotations_id` int NOT NULL,
  `quotation_form_data` text,
  `quotation_data` text,
  PRIMARY KEY (`quotation_details_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reminders`
--

CREATE TABLE IF NOT EXISTS `tbl_reminders` (
  `reminder_id` int NOT NULL AUTO_INCREMENT,
  `description` text,
  `date` datetime NOT NULL,
  `notified` enum('Yes','No') NOT NULL DEFAULT 'No',
  `module` varchar(200) NOT NULL,
  `module_id` int NOT NULL,
  `user_id` varchar(40) NOT NULL,
  `notify_by_email` enum('Yes','No') NOT NULL DEFAULT 'No',
  `created_by` int NOT NULL,
  PRIMARY KEY (`reminder_id`),
  KEY `rel_id` (`module`),
  KEY `rel_type` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resignations`
--

CREATE TABLE IF NOT EXISTS `tbl_resignations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `notice_date` date NOT NULL,
  `resignation_date` date NOT NULL,
  `description` varchar(190) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_return_stock`
--

CREATE TABLE IF NOT EXISTS `tbl_return_stock` (
  `return_stock_id` int NOT NULL AUTO_INCREMENT,
  `module` enum('client','supplier') DEFAULT NULL,
  `module_id` int DEFAULT NULL,
  `main_status` varchar(200) DEFAULT NULL,
  `invoices_id` int DEFAULT NULL,
  `warehouse_id` int DEFAULT NULL,
  `reference_no` varchar(100) DEFAULT NULL,
  `total` decimal(20,2) DEFAULT NULL,
  `update_stock` enum('Yes','No') DEFAULT 'Yes',
  `status` varchar(20) DEFAULT NULL,
  `emailed` enum('Yes','No') DEFAULT NULL,
  `date_sent` varchar(20) DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `return_stock_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `discount_type` enum('none','before_tax','after_tax') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'none',
  `discount_percent` decimal(10,2) DEFAULT NULL,
  `adjustment` decimal(18,2) DEFAULT NULL,
  `discount_total` decimal(18,2) DEFAULT NULL,
  `show_quantity_as` varchar(10) DEFAULT NULL,
  `permission` text,
  `created` timestamp NOT NULL DEFAULT '2019-05-02 12:00:00',
  `total_tax` text,
  `tax` decimal(20,2) DEFAULT NULL,
  `notes` text,
  PRIMARY KEY (`return_stock_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_return_stock_items`
--

CREATE TABLE IF NOT EXISTS `tbl_return_stock_items` (
  `items_id` int NOT NULL AUTO_INCREMENT,
  `return_stock_id` int NOT NULL,
  `invoice_items_id` int DEFAULT NULL,
  `item_tax_rate` decimal(10,2) NOT NULL DEFAULT '0.00',
  `item_tax_name` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `item_tax_total` decimal(10,2) NOT NULL DEFAULT '0.00',
  `quantity` decimal(10,2) DEFAULT '0.00',
  `total_cost` decimal(10,2) DEFAULT '0.00',
  `item_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'Item Name',
  `item_desc` longtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `unit_cost` decimal(10,2) DEFAULT '0.00',
  `order` int DEFAULT '0',
  `date_saved` timestamp NOT NULL DEFAULT '2019-05-02 12:00:00',
  `unit` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `hsn_code` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `saved_items_id` int DEFAULT '0',
  PRIMARY KEY (`items_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_return_stock_payments`
--

CREATE TABLE IF NOT EXISTS `tbl_return_stock_payments` (
  `payments_id` int NOT NULL AUTO_INCREMENT,
  `return_stock_id` int DEFAULT NULL,
  `trans_id` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `payment_method` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `amount` longtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `currency` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'USD',
  `notes` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `payment_date` date DEFAULT NULL,
  `month_paid` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `year_paid` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `module` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `paid_to` int DEFAULT NULL,
  `paid_by` int DEFAULT NULL,
  `created_date` timestamp NULL DEFAULT '1999-12-29 12:00:00',
  `account_id` int NOT NULL DEFAULT '0' COMMENT 'account_id means tracking deduct from which account',
  PRIMARY KEY (`payments_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salary_allowance`
--

CREATE TABLE IF NOT EXISTS `tbl_salary_allowance` (
  `salary_allowance_id` int NOT NULL AUTO_INCREMENT,
  `salary_template_id` int NOT NULL,
  `allowance_label` varchar(200) NOT NULL,
  `allowance_value` varchar(200) NOT NULL,
  PRIMARY KEY (`salary_allowance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salary_deduction`
--

CREATE TABLE IF NOT EXISTS `tbl_salary_deduction` (
  `salary_deduction_id` int NOT NULL AUTO_INCREMENT,
  `salary_template_id` int NOT NULL,
  `deduction_label` varchar(200) NOT NULL,
  `deduction_value` varchar(200) NOT NULL,
  PRIMARY KEY (`salary_deduction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salary_payment`
--

CREATE TABLE IF NOT EXISTS `tbl_salary_payment` (
  `salary_payment_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `payment_month` varchar(20) NOT NULL,
  `fine_deduction` varchar(200) NOT NULL,
  `payment_type` varchar(20) NOT NULL,
  `comments` text,
  `paid_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deduct_from` int NOT NULL DEFAULT '0' COMMENT 'deduct from means tracking deduct from which account',
  PRIMARY KEY (`salary_payment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salary_payment_allowance`
--

CREATE TABLE IF NOT EXISTS `tbl_salary_payment_allowance` (
  `salary_payment_allowance_id` int NOT NULL AUTO_INCREMENT,
  `salary_payment_id` int NOT NULL,
  `salary_payment_allowance_label` varchar(200) NOT NULL,
  `salary_payment_allowance_value` varchar(200) NOT NULL,
  PRIMARY KEY (`salary_payment_allowance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salary_payment_deduction`
--

CREATE TABLE IF NOT EXISTS `tbl_salary_payment_deduction` (
  `salary_payment_deduction` int NOT NULL AUTO_INCREMENT,
  `salary_payment_id` int NOT NULL,
  `salary_payment_deduction_label` varchar(200) NOT NULL,
  `salary_payment_deduction_value` varchar(200) NOT NULL,
  PRIMARY KEY (`salary_payment_deduction`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salary_payment_details`
--

CREATE TABLE IF NOT EXISTS `tbl_salary_payment_details` (
  `salary_payment_details_id` int NOT NULL AUTO_INCREMENT,
  `salary_payment_id` int NOT NULL,
  `salary_payment_details_label` varchar(200) NOT NULL,
  `salary_payment_details_value` varchar(200) NOT NULL,
  PRIMARY KEY (`salary_payment_details_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salary_payslip`
--

CREATE TABLE IF NOT EXISTS `tbl_salary_payslip` (
  `payslip_id` int NOT NULL AUTO_INCREMENT,
  `payslip_number` varchar(100) DEFAULT NULL,
  `salary_payment_id` int NOT NULL,
  `payslip_generate_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`payslip_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salary_template`
--

CREATE TABLE IF NOT EXISTS `tbl_salary_template` (
  `salary_template_id` int NOT NULL AUTO_INCREMENT,
  `salary_grade` varchar(200) NOT NULL,
  `basic_salary` varchar(200) NOT NULL,
  `overtime_salary` varchar(100) NOT NULL,
  PRIMARY KEY (`salary_template_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_saved_items`
--

CREATE TABLE IF NOT EXISTS `tbl_saved_items` (
  `saved_items_id` int NOT NULL AUTO_INCREMENT,
  `item_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'Item Name',
  `code` varchar(100) DEFAULT NULL,
  `manufacturer_id` int DEFAULT NULL,
  `barcode_symbology` varchar(50) NOT NULL,
  `upload_file` text,
  `cost_price` decimal(20,2) NOT NULL DEFAULT '0.00',
  `item_desc` longtext CHARACTER SET utf8 COLLATE utf8_general_ci,
  `unit_cost` decimal(18,2) DEFAULT '0.00',
  `customer_group_id` int NOT NULL DEFAULT '0',
  `unit_type` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tax_rates_id` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `item_tax_rate` decimal(18,2) DEFAULT '0.00',
  `item_tax_total` decimal(18,2) DEFAULT '0.00',
  `quantity` decimal(18,2) DEFAULT '0.00',
  `total_cost` decimal(18,2) DEFAULT '0.00',
  `hsn_code` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  PRIMARY KEY (`saved_items_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sent`
--

CREATE TABLE IF NOT EXISTS `tbl_sent` (
  `sent_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `to` varchar(100) NOT NULL,
  `subject` varchar(300) NOT NULL,
  `message_body` text NOT NULL,
  `attach_file` text,
  `attach_file_path` text,
  `attach_filename` text,
  `message_time` datetime NOT NULL,
  `deleted` enum('Yes','No') NOT NULL DEFAULT 'No',
  PRIMARY KEY (`sent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sessions`
--

CREATE TABLE IF NOT EXISTS `tbl_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_sessions`
--

INSERT INTO `tbl_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('1h17lopokb99tq04564kr8ah00mt386u', '::1', 1660751272, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636303735313237313b6d656e755f6163746976655f69647c613a323a7b693a303b733a333a22323039223b693a313b733a313a2230223b7d75726c7c733a31333a2261646d696e2f7761726e696e67223b757365725f726f6c6c7c613a3135313a7b693a303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a313a2231223b733a353a226c6162656c223b733a393a2264617368626f617264223b733a343a226c696e6b223b733a31353a2261646d696e2f64617368626f617264223b733a343a2269636f6e223b733a31353a2266612066612d64617368626f617264223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a313a2232223b733a353a226c6162656c223b733a383a2263616c656e646172223b733a343a226c696e6b223b733a31343a2261646d696e2f63616c656e646172223b733a343a2269636f6e223b733a31343a2266612066612d63616c656e646172223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a313a2234223b733a353a226c6162656c223b733a363a22636c69656e74223b733a343a226c696e6b223b733a32363a2261646d696e2f636c69656e742f6d616e6167655f636c69656e74223b733a343a2269636f6e223b733a31313a2266612066612d7573657273223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223133223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a313a2235223b733a353a226c6162656c223b733a373a226d61696c626f78223b733a343a226c696e6b223b733a31333a2261646d696e2f6d61696c626f78223b733a343a2269636f6e223b733a31363a2266612066612d656e76656c6f70652d6f223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a313a2236223b733a353a226c6162656c223b733a373a227469636b657473223b733a343a226c696e6b223b733a31333a2261646d696e2f7469636b657473223b733a343a2269636f6e223b733a31323a2266612066612d7469636b6574223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223130223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223132223b733a353a226c6162656c223b733a353a2273616c6573223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31393a2266612066612d73686f7070696e672d63617274223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2239223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223133223b733a353a226c6162656c223b733a373a22696e766f696365223b733a343a226c696e6b223b733a32383a2261646d696e2f696e766f6963652f6d616e6167655f696e766f696365223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223134223b733a353a226c6162656c223b733a393a22657374696d61746573223b733a343a226c696e6b223b733a31353a2261646d696e2f657374696d61746573223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223135223b733a353a226c6162656c223b733a31373a227061796d656e74735f7265636569766564223b733a343a226c696e6b223b733a32363a2261646d696e2f696e766f6963652f616c6c5f7061796d656e7473223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223136223b733a353a226c6162656c223b733a393a227461785f7261746573223b733a343a226c696e6b223b733a32333a2261646d696e2f696e766f6963652f7461785f7261746573223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2235223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a31303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223231223b733a353a226c6162656c223b733a31303a2271756f746174696f6e73223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31313a2266612066612d7061737465223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2237223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a31313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223232223b733a353a226c6162656c223b733a31353a2271756f746174696f6e735f6c697374223b733a343a226c696e6b223b733a31363a2261646d696e2f71756f746174696f6e73223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223231223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a31323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223233223b733a353a226c6162656c223b733a31353a2271756f746174696f6e735f666f726d223b733a343a226c696e6b223b733a33323a2261646d696e2f71756f746174696f6e732f71756f746174696f6e735f666f726d223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223231223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a31333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223234223b733a353a226c6162656c223b733a343a2275736572223b733a343a226c696e6b223b733a32303a2261646d696e2f757365722f757365725f6c697374223b733a343a2269636f6e223b733a31313a2266612066612d7573657273223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223235223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a31343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223235223b733a353a226c6162656c223b733a383a2273657474696e6773223b733a343a226c696e6b223b733a31343a2261646d696e2f73657474696e6773223b733a343a2269636f6e223b733a31303a2266612066612d636f6773223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223236223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a31353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223236223b733a353a226c6162656c223b733a31353a2264617461626173655f6261636b7570223b733a343a226c696e6b223b733a33303a2261646d696e2f73657474696e67732f64617461626173655f6261636b7570223b733a343a2269636f6e223b733a31343a2266612066612d6461746162617365223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223237223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a31363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223239223b733a353a226c6162656c223b733a31373a227472616e73616374696f6e735f6d656e75223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31363a2266612066612d6275696c64696e672d6f223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223132223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a31373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223330223b733a353a226c6162656c223b733a373a226465706f736974223b733a343a226c696e6b223b733a32363a2261646d696e2f7472616e73616374696f6e732f6465706f736974223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223239223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a31383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223331223b733a353a226c6162656c223b733a373a22657870656e7365223b733a343a226c696e6b223b733a32363a2261646d696e2f7472616e73616374696f6e732f657870656e7365223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223239223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a31393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223332223b733a353a226c6162656c223b733a383a227472616e73666572223b733a343a226c696e6b223b733a32373a2261646d696e2f7472616e73616374696f6e732f7472616e73666572223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223239223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a32303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223333223b733a353a226c6162656c223b733a31393a227472616e73616374696f6e735f7265706f7274223b733a343a226c696e6b223b733a33383a2261646d696e2f7472616e73616374696f6e732f7472616e73616374696f6e735f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223239223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a32313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223334223b733a353a226c6162656c223b733a31333a2262616c616e63655f7368656574223b733a343a226c696e6b223b733a33323a2261646d696e2f7472616e73616374696f6e732f62616c616e63655f7368656574223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223239223b733a343a22736f7274223b733a313a2235223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a32323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223336223b733a353a226c6162656c223b733a393a2262616e6b5f63617368223b733a343a226c696e6b223b733a32383a2261646d696e2f6163636f756e742f6d616e6167655f6163636f756e74223b733a343a2269636f6e223b733a31313a2266612066612d6d6f6e6579223b733a363a22706172656e74223b733a323a223239223b733a343a22736f7274223b733a313a2236223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a32333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223339223b733a353a226c6162656c223b733a353a226974656d73223b733a343a226c696e6b223b733a32323a2261646d696e2f6974656d732f6974656d735f6c697374223b733a343a2269636f6e223b733a31303a2266612066612d63756265223b733a363a22706172656e74223b733a333a22313530223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a32343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223432223b733a353a226c6162656c223b733a363a227265706f7274223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31353a2266612066612d6261722d6368617274223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223234223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a32353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223433223b733a353a226c6162656c223b733a31373a226163636f756e745f73746174656d656e74223b733a343a226c696e6b223b733a33303a2261646d696e2f7265706f72742f6163636f756e745f73746174656d656e74223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a32363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223434223b733a353a226c6162656c223b733a31333a22696e636f6d655f7265706f7274223b733a343a226c696e6b223b733a32363a2261646d696e2f7265706f72742f696e636f6d655f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a32373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223435223b733a353a226c6162656c223b733a31343a22657870656e73655f7265706f7274223b733a343a226c696e6b223b733a32373a2261646d696e2f7265706f72742f657870656e73655f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a32383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223436223b733a353a226c6162656c223b733a31343a22696e636f6d655f657870656e7365223b733a343a226c696e6b223b733a32373a2261646d696e2f7265706f72742f696e636f6d655f657870656e7365223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a32393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223437223b733a353a226c6162656c223b733a31363a22646174655f776973655f7265706f7274223b733a343a226c696e6b223b733a32393a2261646d696e2f7265706f72742f646174655f776973655f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a33303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223438223b733a353a226c6162656c223b733a31303a22616c6c5f696e636f6d65223b733a343a226c696e6b223b733a32333a2261646d696e2f7265706f72742f616c6c5f696e636f6d65223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2236223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a33313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223439223b733a353a226c6162656c223b733a31313a22616c6c5f657870656e7365223b733a343a226c696e6b223b733a32343a2261646d696e2f7265706f72742f616c6c5f657870656e7365223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2237223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a33323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223530223b733a353a226c6162656c223b733a31353a22616c6c5f7472616e73616374696f6e223b733a343a226c696e6b223b733a32383a2261646d696e2f7265706f72742f616c6c5f7472616e73616374696f6e223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2238223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a33333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223531223b733a353a226c6162656c223b733a31373a22726563757272696e675f696e766f696365223b733a343a226c696e6b223b733a33313a2261646d696e2f696e766f6963652f726563757272696e675f696e766f696365223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a33343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223532223b733a353a226c6162656c223b733a31353a227472616e736665725f7265706f7274223b733a343a226c696e6b223b733a33343a2261646d696e2f7472616e73616374696f6e732f7472616e736665725f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223239223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a33353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223533223b733a353a226c6162656c223b733a31353a227265706f72745f62795f6d6f6e7468223b733a343a226c696e6b223b733a32383a2261646d696e2f7265706f72742f7265706f72745f62795f6d6f6e7468223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2235223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a33363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223534223b733a353a226c6162656c223b733a353a227461736b73223b733a343a226c696e6b223b733a32303a2261646d696e2f7461736b732f616c6c5f7461736b223b733a343a2269636f6e223b733a31313a2266612066612d7461736b73223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2235223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a33373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223535223b733a353a226c6162656c223b733a353a226c65616473223b733a343a226c696e6b223b733a31313a2261646d696e2f6c65616473223b733a343a2269636f6e223b733a31323a2266612066612d726f636b6574223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2238223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a33383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223536223b733a353a226c6162656c223b733a31333a226f70706f7274756e6974696573223b733a343a226c696e6b223b733a31393a2261646d696e2f6f70706f7274756e6974696573223b733a343a2269636f6e223b733a31323a2266612066612d66696c746572223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2237223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a33393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223537223b733a353a226c6162656c223b733a383a2270726f6a65637473223b733a343a226c696e6b223b733a31343a2261646d696e2f70726f6a65637473223b733a343a2269636f6e223b733a31393a2266612066612d666f6c6465722d6f70656e2d6f223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a34303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223538223b733a353a226c6162656c223b733a343a2262756773223b733a343a226c696e6b223b733a31303a2261646d696e2f62756773223b733a343a2269636f6e223b733a393a2266612066612d627567223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2236223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a34313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223539223b733a353a226c6162656c223b733a373a2270726f6a656374223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31393a2266612066612d666f6c6465722d6f70656e2d6f223b733a363a22706172656e74223b733a323a223432223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a34323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223630223b733a353a226c6162656c223b733a31323a227461736b735f7265706f7274223b733a343a226c696e6b223b733a32353a2261646d696e2f7265706f72742f7461736b735f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223432223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a34333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223631223b733a353a226c6162656c223b733a31313a22627567735f7265706f7274223b733a343a226c696e6b223b733a32343a2261646d696e2f7265706f72742f627567735f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223432223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a34343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223632223b733a353a226c6162656c223b733a31343a227469636b6574735f7265706f7274223b733a343a226c696e6b223b733a32373a2261646d696e2f7265706f72742f7469636b6574735f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223432223b733a343a22736f7274223b733a313a2235223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a34353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223633223b733a353a226c6162656c223b733a31333a22636c69656e745f7265706f7274223b733a343a226c696e6b223b733a32363a2261646d696e2f7265706f72742f636c69656e745f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223432223b733a343a22736f7274223b733a313a2236223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a34363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223636223b733a353a226c6162656c223b733a31363a227461736b735f61737369676e6d656e74223b733a343a226c696e6b223b733a32393a2261646d696e2f7265706f72742f7461736b735f61737369676e6d656e74223b733a343a2269636f6e223b733a31383a2266612066612d646f742d636972636c652d6f223b733a363a22706172656e74223b733a323a223539223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a34373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223637223b733a353a226c6162656c223b733a31353a22627567735f61737369676e6d656e74223b733a343a226c696e6b223b733a32383a2261646d696e2f7265706f72742f627567735f61737369676e6d656e74223b733a343a2269636f6e223b733a31383a2266612066612d646f742d636972636c652d6f223b733a363a22706172656e74223b733a323a223539223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a34383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223638223b733a353a226c6162656c223b733a31343a2270726f6a6563745f7265706f7274223b733a343a226c696e6b223b733a32373a2261646d696e2f7265706f72742f70726f6a6563745f7265706f7274223b733a343a2269636f6e223b733a31383a2266612066612d646f742d636972636c652d6f223b733a363a22706172656e74223b733a323a223539223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a34393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223639223b733a353a226c6162656c223b733a31333a22676f616c5f747261636b696e67223b733a343a226c696e6b223b733a31393a2261646d696e2f676f616c5f747261636b696e67223b733a343a2269636f6e223b733a31323a2266612066612d736869656c64223b733a363a22706172656e74223b733a323a223733223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a35303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223730223b733a353a226c6162656c223b733a31313a226465706172746d656e7473223b733a343a226c696e6b223b733a31373a2261646d696e2f6465706172746d656e7473223b733a343a2269636f6e223b733a31373a2266612066612d757365722d736563726574223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223134223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a35313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223731223b733a353a226c6162656c223b733a373a22686f6c69646179223b733a343a226c696e6b223b733a31333a2261646d696e2f686f6c69646179223b733a343a2269636f6e223b733a32313a2266612066612d63616c656e6461722d706c75732d6f223b733a363a22706172656e74223b733a323a223733223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a35323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223732223b733a353a226c6162656c223b733a31363a226c656176655f6d616e6167656d656e74223b733a343a226c696e6b223b733a32323a2261646d696e2f6c656176655f6d616e6167656d656e74223b733a343a2269636f6e223b733a31313a2266612066612d706c616e65223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223230223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a35333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223733223b733a353a226c6162656c223b733a393a227574696c6974696573223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31303a2266612066612d67696674223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223233223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a35343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223734223b733a353a226c6162656c223b733a383a226f76657274696d65223b733a343a226c696e6b223b733a32343a2261646d696e2f7574696c69746965732f6f76657274696d65223b733a343a2269636f6e223b733a31333a2266612066612d636c6f636b2d6f223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2239223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a35353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223735223b733a353a226c6162656c223b733a31323a226f66666963655f73746f636b223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31333a2266612066612d636f646570656e223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223135223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a35363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223736223b733a353a226c6162656c223b733a31343a2273746f636b5f63617465676f7279223b733a343a226c696e6b223b733a32363a2261646d696e2f73746f636b2f73746f636b5f63617465676f7279223b733a343a2269636f6e223b733a31333a2266612066612d736c6964657273223b733a363a22706172656e74223b733a323a223735223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a35373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223737223b733a353a226c6162656c223b733a31323a226d616e6167655f73746f636b223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31333a2266612066612d61726368697665223b733a363a22706172656e74223b733a323a223735223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a35383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223738223b733a353a226c6162656c223b733a31323a2261737369676e5f73746f636b223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31363a2266612066612d616c69676e2d6c656674223b733a363a22706172656e74223b733a323a223735223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a35393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223739223b733a353a226c6162656c223b733a31323a2273746f636b5f7265706f7274223b733a343a226c696e6b223b733a31383a2261646d696e2f73746f636b2f7265706f7274223b733a343a2269636f6e223b733a31363a2266612066612d6c696e652d6368617274223b733a363a22706172656e74223b733a323a223735223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a36303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223831223b733a353a226c6162656c223b733a31303a2273746f636b5f6c697374223b733a343a226c696e6b223b733a32323a2261646d696e2f73746f636b2f73746f636b5f6c697374223b733a343a2269636f6e223b733a32303a2266612066612d737461636b2d65786368616e6765223b733a363a22706172656e74223b733a323a223735223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a36313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223832223b733a353a226c6162656c223b733a31323a2261737369676e5f73746f636b223b733a343a226c696e6b223b733a32343a2261646d696e2f73746f636b2f61737369676e5f73746f636b223b733a343a2269636f6e223b733a31363a2266612066612d616c69676e2d6c656674223b733a363a22706172656e74223b733a323a223738223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a36323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223833223b733a353a226c6162656c223b733a31393a2261737369676e5f73746f636b5f7265706f7274223b733a343a226c696e6b223b733a33313a2261646d696e2f73746f636b2f61737369676e5f73746f636b5f7265706f7274223b733a343a2269636f6e223b733a31353a2266612066612d6261722d6368617274223b733a363a22706172656e74223b733a323a223738223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a36333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223834223b733a353a226c6162656c223b733a31333a2273746f636b5f686973746f7279223b733a343a226c696e6b223b733a32353a2261646d696e2f73746f636b2f73746f636b5f686973746f7279223b733a343a2269636f6e223b733a31373a2266612066612d66696c652d746578742d6f223b733a363a22706172656e74223b733a323a223737223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a36343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223835223b733a353a226c6162656c223b733a31313a22706572666f726d616e6365223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31343a2266612066612d6472696262626c65223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223139223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a36353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223836223b733a353a226c6162656c223b733a32313a22706572666f726d616e63655f696e64696361746f72223b733a343a226c696e6b223b733a33393a2261646d696e2f706572666f726d616e63652f706572666f726d616e63655f696e64696361746f72223b733a343a2269636f6e223b733a31323a2266612066612d72616e646f6d223b733a363a22706172656e74223b733a323a223835223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a36363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223837223b733a353a226c6162656c223b733a31383a22706572666f726d616e63655f7265706f7274223b733a343a226c696e6b223b733a33363a2261646d696e2f706572666f726d616e63652f706572666f726d616e63655f7265706f7274223b733a343a2269636f6e223b733a31363a2266612066612d63616c656e6461722d6f223b733a363a22706172656e74223b733a323a223835223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a36373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223838223b733a353a226c6162656c223b733a31343a22676976655f61707072616973616c223b733a343a226c696e6b223b733a34343a2261646d696e2f706572666f726d616e63652f676976655f706572666f726d616e63655f61707072616973616c223b733a343a2269636f6e223b733a31303a2266612066612d706c7573223b733a363a22706172656e74223b733a323a223835223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a36383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223839223b733a353a226c6162656c223b733a373a22706179726f6c6c223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a393a2266612066612d757364223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223138223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a36393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223930223b733a353a226c6162656c223b733a32313a226d616e6167655f73616c6172795f64657461696c73223b733a343a226c696e6b223b733a33353a2261646d696e2f706179726f6c6c2f6d616e6167655f73616c6172795f64657461696c73223b733a343a2269636f6e223b733a393a2266612066612d757364223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a37303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223931223b733a353a226c6162656c223b733a32303a22656d706c6f7965655f73616c6172795f6c697374223b733a343a226c696e6b223b733a33343a2261646d696e2f706179726f6c6c2f656d706c6f7965655f73616c6172795f6c697374223b733a343a2269636f6e223b733a31373a2266612066612d757365722d736563726574223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a37313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223932223b733a353a226c6162656c223b733a31323a226d616b655f7061796d656e74223b733a343a226c696e6b223b733a32363a2261646d696e2f706179726f6c6c2f6d616b655f7061796d656e74223b733a343a2269636f6e223b733a31313a2266612066612d7461736b73223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a37323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223933223b733a353a226c6162656c223b733a31363a2267656e65726174655f706179736c6970223b733a343a226c696e6b223b733a33303a2261646d696e2f706179726f6c6c2f67656e65726174655f706179736c6970223b733a343a2269636f6e223b733a31333a2266612066612d6c6973742d756c223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2235223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a37333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223934223b733a353a226c6162656c223b733a31353a2273616c6172795f74656d706c617465223b733a343a226c696e6b223b733a32393a2261646d696e2f706179726f6c6c2f73616c6172795f74656d706c617465223b733a343a2269636f6e223b733a31313a2266612066612d6d6f6e6579223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a37343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223935223b733a353a226c6162656c223b733a31313a22686f75726c795f72617465223b733a343a226c696e6b223b733a32353a2261646d696e2f706179726f6c6c2f686f75726c795f72617465223b733a343a2269636f6e223b733a31333a2266612066612d636c6f636b2d6f223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a37353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223936223b733a353a226c6162656c223b733a31353a22706179726f6c6c5f73756d6d617279223b733a343a226c696e6b223b733a32393a2261646d696e2f706179726f6c6c2f706179726f6c6c5f73756d6d617279223b733a343a2269636f6e223b733a31383a2266612066612d63616d6572612d726574726f223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2236223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a37363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223937223b733a353a226c6162656c223b733a31343a2270726f766964656e745f66756e64223b733a343a226c696e6b223b733a32383a2261646d696e2f706179726f6c6c2f70726f766964656e745f66756e64223b733a343a2269636f6e223b733a31353a2266612066612d627269656663617365223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2238223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a37373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223938223b733a353a226c6162656c223b733a31343a22616476616e63655f73616c617279223b733a343a226c696e6b223b733a32383a2261646d696e2f706179726f6c6c2f616476616e63655f73616c617279223b733a343a2269636f6e223b733a31393a2266612066612d63632d6d617374657263617264223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2237223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a37383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223939223b733a353a226c6162656c223b733a31343a22656d706c6f7965655f6177617264223b733a343a226c696e6b223b733a31313a2261646d696e2f6177617264223b733a343a2269636f6e223b733a31323a2266612066612d74726f706879223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a323a223130223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a37393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313030223b733a353a226c6162656c223b733a31333a22616e6e6f756e63656d656e7473223b733a343a226c696e6b223b733a31393a2261646d696e2f616e6e6f756e63656d656e7473223b733a343a2269636f6e223b733a31393a2266612066612d62756c6c686f726e2069636f6e223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223232223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a38303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313031223b733a353a226c6162656c223b733a383a22747261696e696e67223b733a343a226c696e6b223b733a31343a2261646d696e2f747261696e696e67223b733a343a2269636f6e223b733a31343a2266612066612d7375697463617365223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223231223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a38313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313032223b733a353a226c6162656c223b733a31323a226a6f625f63697263756c6172223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31313a2266612066612d676c6f6265223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223137223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a38323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313033223b733a353a226c6162656c223b733a31313a226a6f62735f706f73746564223b733a343a226c696e6b223b733a33303a2261646d696e2f6a6f625f63697263756c61722f6a6f62735f706f73746564223b733a343a2269636f6e223b733a31323a2266612066612d7469636b6574223b733a363a22706172656e74223b733a333a22313032223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a38333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313034223b733a353a226c6162656c223b733a31373a226a6f62735f6170706c69636174696f6e73223b733a343a226c696e6b223b733a33363a2261646d696e2f6a6f625f63697263756c61722f6a6f62735f6170706c69636174696f6e73223b733a343a2269636f6e223b733a31333a2266612066612d636f6d70617373223b733a363a22706172656e74223b733a333a22313032223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a38343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313035223b733a353a226c6162656c223b733a31303a22617474656e64616e6365223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31353a2266612066612d66696c652d74657874223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223136223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a38353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313036223b733a353a226c6162656c223b733a31383a2274696d656368616e67655f72657175657374223b733a343a226c696e6b223b733a33353a2261646d696e2f617474656e64616e63652f74696d656368616e67655f72657175657374223b733a343a2269636f6e223b733a31363a2266612066612d63616c656e6461722d6f223b733a363a22706172656e74223b733a333a22313035223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a38363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313037223b733a353a226c6162656c223b733a31373a22617474656e64616e63655f7265706f7274223b733a343a226c696e6b223b733a33343a2261646d696e2f617474656e64616e63652f617474656e64616e63655f7265706f7274223b733a343a2269636f6e223b733a31353a2266612066612d66696c652d74657874223b733a363a22706172656e74223b733a333a22313035223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a38373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313038223b733a353a226c6162656c223b733a31323a2274696d655f686973746f7279223b733a343a226c696e6b223b733a32393a2261646d696e2f617474656e64616e63652f74696d655f686973746f7279223b733a343a2269636f6e223b733a31333a2266612066612d636c6f636b2d6f223b733a363a22706172656e74223b733a333a22313035223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a38383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313039223b733a353a226c6162656c223b733a393a2270756c6c2d646f776e223b733a343a226c696e6b223b733a303a22223b733a343a2269636f6e223b733a303a22223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2230223b7d693a38393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313130223b733a353a226c6162656c223b733a31313a2266696c656d616e61676572223b733a343a226c696e6b223b733a31373a2261646d696e2f66696c656d616e61676572223b733a343a2269636f6e223b733a31303a2266612066612d66696c65223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a39303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313131223b733a353a226c6162656c223b733a31353a22636f6d70616e795f64657461696c73223b733a343a226c696e6b223b733a31343a2261646d696e2f73657474696e6773223b733a343a2269636f6e223b733a32333a2266612066612d66772066612d696e666f2d636972636c65223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a39313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313132223b733a353a226c6162656c223b733a31353a2273797374656d5f73657474696e6773223b733a343a226c696e6b223b733a32313a2261646d696e2f73657474696e67732f73797374656d223b733a343a2269636f6e223b733a31393a2266612066612d66772066612d6465736b746f70223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a39323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313133223b733a353a226c6162656c223b733a31343a22656d61696c5f73657474696e6773223b733a343a226c696e6b223b733a32303a2261646d696e2f73657474696e67732f656d61696c223b733a343a2269636f6e223b733a32303a2266612066612d66772066612d656e76656c6f7065223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a39333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313134223b733a353a226c6162656c223b733a31353a22656d61696c5f74656d706c61746573223b733a343a226c696e6b223b733a32343a2261646d696e2f73657474696e67732f74656d706c61746573223b733a343a2269636f6e223b733a32353a2266612066612d66772066612d70656e63696c2d737175617265223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a313a2235223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a39343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313135223b733a353a226c6162656c223b733a31373a22656d61696c5f696e746567726174696f6e223b733a343a226c696e6b223b733a33323a2261646d696e2f73657474696e67732f656d61696c5f696e746567726174696f6e223b733a343a2269636f6e223b733a32323a2266612066612d66772066612d656e76656c6f70652d6f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a313a2236223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a39353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313136223b733a353a226c6162656c223b733a31363a227061796d656e745f73657474696e6773223b733a343a226c696e6b223b733a32333a2261646d696e2f73657474696e67732f7061796d656e7473223b733a343a2269636f6e223b733a31383a2266612066612d66772066612d646f6c6c6172223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a313a2237223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a39363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313137223b733a353a226c6162656c223b733a31363a22696e766f6963655f73657474696e6773223b733a343a226c696e6b223b733a32323a2261646d696e2f73657474696e67732f696e766f696365223b733a343a2269636f6e223b733a31373a2266612066612d66772066612d6d6f6e6579223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a313a2238223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a39373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313138223b733a353a226c6162656c223b733a31373a22657374696d6174655f73657474696e6773223b733a343a226c696e6b223b733a32333a2261646d696e2f73657474696e67732f657374696d617465223b733a343a2269636f6e223b733a31383a2266612066612d66772066612d66696c652d6f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223130223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a39383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313139223b733a353a226c6162656c223b733a32323a227469636b6574735f6c656164735f73657474696e6773223b733a343a226c696e6b223b733a32323a2261646d696e2f73657474696e67732f7469636b657473223b733a343a2269636f6e223b733a31383a2266612066612d66772066612d7469636b6574223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223134223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a39393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313230223b733a353a226c6162656c223b733a31343a227468656d655f73657474696e6773223b733a343a226c696e6b223b733a32303a2261646d696e2f73657474696e67732f7468656d65223b733a343a2269636f6e223b733a31363a2266612066612d66772066612d636f6465223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223230223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3130303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313231223b733a353a226c6162656c223b733a31323a22776f726b696e675f64617973223b733a343a226c696e6b223b733a32373a2261646d696e2f73657474696e67732f776f726b696e675f64617973223b733a343a2269636f6e223b733a32303a2266612066612d66772066612d63616c656e646172223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223232223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3130313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313232223b733a353a226c6162656c223b733a31343a226c656176655f63617465676f7279223b733a343a226c696e6b223b733a32393a2261646d696e2f73657474696e67732f6c656176655f63617465676f7279223b733a343a2269636f6e223b733a32313a2266612066612d66772066612d706167656c696e6573223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223233223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3130323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313233223b733a353a226c6162656c223b733a31353a22696e636f6d655f63617465676f7279223b733a343a226c696e6b223b733a33303a2261646d696e2f73657474696e67732f696e636f6d655f63617465676f7279223b733a343a2269636f6e223b733a32333a2266612066612d66772066612d6365727469666963617465223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223234223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3130333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313234223b733a353a226c6162656c223b733a31363a22657870656e73655f63617465676f7279223b733a343a226c696e6b223b733a33313a2261646d696e2f73657474696e67732f657870656e73655f63617465676f7279223b733a343a2269636f6e223b733a31373a2266612066612d66772066612d7461736b73223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223235223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3130343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313235223b733a353a226c6162656c223b733a31343a22637573746f6d65725f67726f7570223b733a343a226c696e6b223b733a32393a2261646d696e2f73657474696e67732f637573746f6d65725f67726f7570223b733a343a2269636f6e223b733a31373a2266612066612d66772066612d7573657273223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223236223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3130353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313237223b733a353a226c6162656c223b733a31313a226c6561645f737461747573223b733a343a226c696e6b223b733a32363a2261646d696e2f73657474696e67732f6c6561645f737461747573223b733a343a2269636f6e223b733a31393a2266612066612d66772066612d6c6973742d756c223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223136223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3130363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313238223b733a353a226c6162656c223b733a31313a226c6561645f736f75726365223b733a343a226c696e6b223b733a32363a2261646d696e2f73657474696e67732f6c6561645f736f75726365223b733a343a2269636f6e223b733a32323a2266612066612d66772066612d6172726f772d646f776e223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223137223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3130373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313239223b733a353a226c6162656c223b733a32363a226f70706f7274756e69746965735f73746174655f726561736f6e223b733a343a226c696e6b223b733a34313a2261646d696e2f73657474696e67732f6f70706f7274756e69746965735f73746174655f726561736f6e223b733a343a2269636f6e223b733a32343a2266612066612d66772066612d646f742d636972636c652d6f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223139223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3130383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313330223b733a353a226c6162656c223b733a31323a22637573746f6d5f6669656c64223b733a343a226c696e6b223b733a32373a2261646d696e2f73657474696e67732f637573746f6d5f6669656c64223b733a343a2269636f6e223b733a31383a2266612066612d66772066612d737461722d6f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223238223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3130393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313331223b733a353a226c6162656c223b733a31343a227061796d656e745f6d6574686f64223b733a343a226c696e6b223b733a32393a2261646d696e2f73657474696e67732f7061796d656e745f6d6574686f64223b733a343a2269636f6e223b733a31373a2266612066612d66772066612d6d6f6e6579223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223239223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3131303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313332223b733a353a226c6162656c223b733a373a2263726f6e6a6f62223b733a343a226c696e6b223b733a32323a2261646d696e2f73657474696e67732f63726f6e6a6f62223b733a343a2269636f6e223b733a31383a2266612066612d66772066612d636f6e74616f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223331223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3131313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313333223b733a353a226c6162656c223b733a31353a226d656e755f616c6c6f636174696f6e223b733a343a226c696e6b223b733a33303a2261646d696e2f73657474696e67732f6d656e755f616c6c6f636174696f6e223b733a343a2269636f6e223b733a32323a2266612066612d66772066612066612d636f6d70617373223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223332223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3131323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313334223b733a353a226c6162656c223b733a31323a226e6f74696669636174696f6e223b733a343a226c696e6b223b733a32373a2261646d696e2f73657474696e67732f6e6f74696669636174696f6e223b733a343a2269636f6e223b733a31383a2266612066612d66772066612d62656c6c2d6f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223333223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3131333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313335223b733a353a226c6162656c223b733a31383a22656d61696c5f6e6f74696669636174696f6e223b733a343a226c696e6b223b733a33333a2261646d696e2f73657474696e67732f656d61696c5f6e6f74696669636174696f6e223b733a343a2269636f6e223b733a31383a2266612066612d66772066612d62656c6c2d6f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223334223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3131343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313336223b733a353a226c6162656c223b733a31353a2264617461626173655f6261636b7570223b733a343a226c696e6b223b733a33303a2261646d696e2f73657474696e67732f64617461626173655f6261636b7570223b733a343a2269636f6e223b733a32303a2266612066612d66772066612d6461746162617365223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223335223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3131353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313337223b733a353a226c6162656c223b733a31323a227472616e736c6174696f6e73223b733a343a226c696e6b223b733a32373a2261646d696e2f73657474696e67732f7472616e736c6174696f6e73223b733a343a2269636f6e223b733a32303a2266612066612d66772066612d6c616e6775616765223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223336223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3131363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313338223b733a353a226c6162656c223b733a31333a2273797374656d5f757064617465223b733a343a226c696e6b223b733a32383a2261646d696e2f73657474696e67732f73797374656d5f757064617465223b733a343a2269636f6e223b733a32373a2266612066612d66772066612d70656e63696c2d7371756172652d6f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223337223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3131373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313339223b733a353a226c6162656c223b733a31323a22707269766174655f63686174223b733a343a226c696e6b223b733a31383a22636861742f636f6e766572736174696f6e73223b733a343a2269636f6e223b733a31343a2266612066612d656e76656c6f7065223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223238223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a3131383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313430223b733a353a226c6162656c223b733a393a2270726f706f73616c73223b733a343a226c696e6b223b733a31353a2261646d696e2f70726f706f73616c73223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a3131393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313431223b733a353a226c6162656c223b733a31333a226b6e6f776c6564676562617365223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a32313a2266612066612d7175657374696f6e2d636972636c65223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223131223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a3132303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313432223b733a353a226c6162656c223b733a31303a2263617465676f72696573223b733a343a226c696e6b223b733a33303a2261646d696e2f6b6e6f776c65646765626173652f63617465676f72696573223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313431223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a3132313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313433223b733a353a226c6162656c223b733a383a2261727469636c6573223b733a343a226c696e6b223b733a32383a2261646d696e2f6b6e6f776c65646765626173652f61727469636c6573223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313431223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a3132323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313434223b733a353a226c6162656c223b733a31333a226b6e6f776c6564676562617365223b733a343a226c696e6b223b733a31393a2261646d696e2f6b6e6f776c6564676562617365223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313431223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a3132333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313435223b733a353a226c6162656c223b733a31383a2264617368626f6172645f73657474696e6773223b733a343a226c696e6b223b733a32343a2261646d696e2f73657474696e67732f64617368626f617264223b733a343a2269636f6e223b733a32313a2266612066612d66772066612d64617368626f617264223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223231223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3132343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313436223b733a353a226c6162656c223b733a32303a227472616e73616374696f6e735f7265706f727473223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31363a2266612066612d6275696c64696e672d6f223b733a363a22706172656e74223b733a323a223432223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a3132353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313437223b733a353a226c6162656c223b733a353a2273616c6573223b733a343a226c696e6b223b733a32353a2261646d696e2f7265706f72742f73616c65735f7265706f7274223b733a343a2269636f6e223b733a31393a2266612066612d73686f7070696e672d63617274223b733a363a22706172656e74223b733a323a223432223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a3132363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313438223b733a353a226c6162656c223b733a31353a226d61726b5f617474656e64616e6365223b733a343a226c696e6b223b733a32313a2261646d696e2f6d61726b5f617474656e64616e6365223b733a343a2269636f6e223b733a31353a2266612066612d66696c652d74657874223b733a363a22706172656e74223b733a333a22313035223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a3132373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313439223b733a353a226c6162656c223b733a31303a22616c6c6f7765645f6970223b733a343a226c696e6b223b733a32353a2261646d696e2f73657474696e67732f616c6c6f7765645f6970223b733a343a2269636f6e223b733a31323a2266612066612d736572766572223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223237223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3132383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313530223b733a353a226c6162656c223b733a353a2273746f636b223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31313a2269636f6e2d6c6179657273223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2238223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a3132393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313531223b733a353a226c6162656c223b733a383a22737570706c696572223b733a343a226c696e6b223b733a31343a2261646d696e2f737570706c696572223b733a343a2269636f6e223b733a31343a2269636f6e2d627269656663617365223b733a363a22706172656e74223b733a333a22313530223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a3133303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313532223b733a353a226c6162656c223b733a383a227075726368617365223b733a343a226c696e6b223b733a31343a2261646d696e2f7075726368617365223b733a343a2269636f6e223b733a31323a2269636f6e2d68616e64626167223b733a363a22706172656e74223b733a333a22313530223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a3133313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313533223b733a353a226c6162656c223b733a31323a2272657475726e5f73746f636b223b733a343a226c696e6b223b733a31383a2261646d696e2f72657475726e5f73746f636b223b733a343a2269636f6e223b733a31343a2269636f6e2d73686172652d616c74223b733a363a22706172656e74223b733a333a22313530223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a3133323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313534223b733a353a226c6162656c223b733a31363a2270757263686173655f7061796d656e74223b733a343a226c696e6b223b733a32373a2261646d696e2f70757263686173652f616c6c5f7061796d656e7473223b733a343a2269636f6e223b733a31363a2269636f6e2d6372656469742d63617264223b733a363a22706172656e74223b733a333a22313530223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a3133333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313535223b733a353a226c6162656c223b733a31373a2270757263686173655f73657474696e6773223b733a343a226c696e6b223b733a32333a2261646d696e2f73657474696e67732f7075726368617365223b733a343a2269636f6e223b733a31383a2266612d66772069636f6e2d68616e64626167223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223132223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3133343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313536223b733a353a226c6162656c223b733a31313a226372656469745f6e6f7465223b733a343a226c696e6b223b733a31373a2261646d696e2f6372656469745f6e6f7465223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a3133353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313537223b733a353a226c6162656c223b733a31373a2270726f6a656374735f73657474696e6773223b733a343a226c696e6b223b733a32333a2261646d696e2f73657474696e67732f70726f6a65637473223b733a343a2269636f6e223b733a32353a2266612066612d66772066612d666f6c6465722d6f70656e2d6f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a313a2239223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3133363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313538223b733a353a226c6162656c223b733a343a2274616773223b733a343a226c696e6b223b733a31393a2261646d696e2f73657474696e67732f74616773223b733a343a2269636f6e223b733a31363a2266612066612d66772066612d74616773223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223131223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3133373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313539223b733a353a226c6162656c223b733a393a226c6561645f666f726d223b733a343a226c696e6b223b733a32353a2261646d696e2f6c656164732f616c6c5f6c6561645f666f726d223b733a343a2269636f6e223b733a31383a2266612066612d66772066612d726f636b6574223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223133223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3133383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313630223b733a353a226c6162656c223b733a31323a22736d735f73657474696e6773223b733a343a226c696e6b223b733a32373a2261646d696e2f73657474696e67732f736d735f73657474696e6773223b733a343a2269636f6e223b733a32303a2266612066612d66772066612d656e76656c6f7065223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223330223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3133393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313631223b733a353a226c6162656c223b733a393a22706f735f73616c6573223b733a343a226c696e6b223b733a32333a2261646d696e2f696e766f6963652f706f735f73616c6573223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a3134303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313836223b733a353a226c6162656c223b733a393a2277617265686f757365223b733a343a226c696e6b223b733a32323a2261646d696e2f77617265686f7573652f6d616e616765223b733a343a2269636f6e223b733a31363a2266612066612d6275696c64696e672d6f223b733a363a22706172656e74223b733a333a22313530223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a3134313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313837223b733a353a226c6162656c223b733a31323a227472616e736665724974656d223b733a343a226c696e6b223b733a32343a2261646d696e2f6974656d732f7472616e736665724974656d223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313530223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a3134323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22323033223b733a353a226c6162656c223b733a31333a2261776172645f73657474696e67223b733a343a226c696e6b223b733a32303a2261646d696e2f73657474696e67732f6177617264223b733a343a2269636f6e223b733a31303a2266612066612d73746172223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223330223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3134333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22323034223b733a353a226c6162656c223b733a31383a2261776172645f72756c655f73657474696e67223b733a343a226c696e6b223b733a33343a2261646d696e2f73657474696e67732f61776172645f72756c655f73657474696e6768223b733a343a2269636f6e223b733a31303a2266612066612d73746172223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223331223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3134343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22323035223b733a353a226c6162656c223b733a32323a2261776172645f70726f6772616d5f73657474696e6773223b733a343a226c696e6b223b733a33373a2261646d696e2f73657474696e67732f61776172645f70726f6772616d5f73657474696e6773223b733a343a2269636f6e223b733a393a2266612066612d636f67223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223332223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2232223b7d693a3134353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22323036223b733a353a226c6162656c223b733a31393a22636c69656e745f61776172645f706f696e7473223b733a343a226c696e6b223b733a32373a2261646d696e2f696e766f6963652f636c69656e745f617761726473223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a323a223130223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a3134363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22323037223b733a353a226c6162656c223b733a32303a22626573745f73656c6c696e675f70726f64756374223b733a343a226c696e6b223b733a31383a2261646d696e2f626573745f73656c6c696e67223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a323a223131223b733a343a2274696d65223b733a31393a22323032322d30382d31372032313a34373a3130223b733a363a22737461747573223b733a313a2231223b7d693a3134373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22323039223b733a353a226c6162656c223b733a373a227761726e696e67223b733a343a226c696e6b223b733a31333a2261646d696e2f7761726e696e67223b733a343a2269636f6e223b733a31333a2266612066612d7761726e696e67223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d30382d30362031353a34373a3031223b733a363a22737461747573223b733a313a2231223b7d693a3134383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22323130223b733a353a226c6162656c223b733a393a2270726f6d6f74696f6e223b733a343a226c696e6b223b733a31353a2261646d696e2f70726f6d6f74696f6e223b733a343a2269636f6e223b733a32313a2266612066612d6172726f772d636972636c652d7570223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d30382d30362031353a34393a3238223b733a363a22737461747573223b733a313a2231223b7d693a3134393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22323131223b733a353a226c6162656c223b733a31313a227465726d696e6174696f6e223b733a343a226c696e6b223b733a31373a2261646d696e2f7465726d696e6174696f6e223b733a343a2269636f6e223b733a31323a2266612066612d657261736572223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2235223b733a343a2274696d65223b733a31393a22323032322d30382d30362031353a35303a3435223b733a363a22737461747573223b733a313a2231223b7d693a3135303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22323132223b733a353a226c6162656c223b733a31313a2272657369676e6174696f6e223b733a343a226c696e6b223b733a31373a2261646d696e2f72657369676e6174696f6e223b733a343a2269636f6e223b733a31343a2266612066612d73636973736f7273223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2236223b733a343a2274696d65223b733a31393a22323032322d30382d30362031353a35343a3331223b733a363a22737461747573223b733a313a2231223b7d7d);
INSERT INTO `tbl_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('5h5tiqstq4rte5rq4hshmnoi0pshmvsu', '::1', 1669696851, 0x5f5f63695f6c6173745f726567656e65726174657c693a313636393639363835303b6d656e755f6163746976655f69647c613a323a7b693a303b733a333a22313130223b693a313b733a313a2230223b7d75726c7c733a31373a2261646d696e2f66696c656d616e61676572223b757365725f726f6c6c7c613a3135313a7b693a303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a313a2231223b733a353a226c6162656c223b733a393a2264617368626f617264223b733a343a226c696e6b223b733a31353a2261646d696e2f64617368626f617264223b733a343a2269636f6e223b733a31353a2266612066612d64617368626f617264223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a313a2232223b733a353a226c6162656c223b733a383a2263616c656e646172223b733a343a226c696e6b223b733a31343a2261646d696e2f63616c656e646172223b733a343a2269636f6e223b733a31343a2266612066612d63616c656e646172223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a313a2234223b733a353a226c6162656c223b733a363a22636c69656e74223b733a343a226c696e6b223b733a32363a2261646d696e2f636c69656e742f6d616e6167655f636c69656e74223b733a343a2269636f6e223b733a31313a2266612066612d7573657273223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223133223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a313a2235223b733a353a226c6162656c223b733a373a226d61696c626f78223b733a343a226c696e6b223b733a31333a2261646d696e2f6d61696c626f78223b733a343a2269636f6e223b733a31363a2266612066612d656e76656c6f70652d6f223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a313a2236223b733a353a226c6162656c223b733a373a227469636b657473223b733a343a226c696e6b223b733a31333a2261646d696e2f7469636b657473223b733a343a2269636f6e223b733a31323a2266612066612d7469636b6574223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223130223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223132223b733a353a226c6162656c223b733a353a2273616c6573223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31393a2266612066612d73686f7070696e672d63617274223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2239223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223133223b733a353a226c6162656c223b733a373a22696e766f696365223b733a343a226c696e6b223b733a32383a2261646d696e2f696e766f6963652f6d616e6167655f696e766f696365223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223134223b733a353a226c6162656c223b733a393a22657374696d61746573223b733a343a226c696e6b223b733a31353a2261646d696e2f657374696d61746573223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223135223b733a353a226c6162656c223b733a31373a227061796d656e74735f7265636569766564223b733a343a226c696e6b223b733a32363a2261646d696e2f696e766f6963652f616c6c5f7061796d656e7473223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223136223b733a353a226c6162656c223b733a393a227461785f7261746573223b733a343a226c696e6b223b733a32333a2261646d696e2f696e766f6963652f7461785f7261746573223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2235223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a31303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223231223b733a353a226c6162656c223b733a31303a2271756f746174696f6e73223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31313a2266612066612d7061737465223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2237223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a31313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223232223b733a353a226c6162656c223b733a31353a2271756f746174696f6e735f6c697374223b733a343a226c696e6b223b733a31363a2261646d696e2f71756f746174696f6e73223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223231223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a31323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223233223b733a353a226c6162656c223b733a31353a2271756f746174696f6e735f666f726d223b733a343a226c696e6b223b733a33323a2261646d696e2f71756f746174696f6e732f71756f746174696f6e735f666f726d223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223231223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a31333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223234223b733a353a226c6162656c223b733a343a2275736572223b733a343a226c696e6b223b733a32303a2261646d696e2f757365722f757365725f6c697374223b733a343a2269636f6e223b733a31313a2266612066612d7573657273223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223235223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a31343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223235223b733a353a226c6162656c223b733a383a2273657474696e6773223b733a343a226c696e6b223b733a31343a2261646d696e2f73657474696e6773223b733a343a2269636f6e223b733a31303a2266612066612d636f6773223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223236223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a31353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223236223b733a353a226c6162656c223b733a31353a2264617461626173655f6261636b7570223b733a343a226c696e6b223b733a33303a2261646d696e2f73657474696e67732f64617461626173655f6261636b7570223b733a343a2269636f6e223b733a31343a2266612066612d6461746162617365223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223237223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a31363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223239223b733a353a226c6162656c223b733a31373a227472616e73616374696f6e735f6d656e75223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31363a2266612066612d6275696c64696e672d6f223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223132223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a31373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223330223b733a353a226c6162656c223b733a373a226465706f736974223b733a343a226c696e6b223b733a32363a2261646d696e2f7472616e73616374696f6e732f6465706f736974223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223239223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a31383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223331223b733a353a226c6162656c223b733a373a22657870656e7365223b733a343a226c696e6b223b733a32363a2261646d696e2f7472616e73616374696f6e732f657870656e7365223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223239223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a31393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223332223b733a353a226c6162656c223b733a383a227472616e73666572223b733a343a226c696e6b223b733a32373a2261646d696e2f7472616e73616374696f6e732f7472616e73666572223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223239223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a32303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223333223b733a353a226c6162656c223b733a31393a227472616e73616374696f6e735f7265706f7274223b733a343a226c696e6b223b733a33383a2261646d696e2f7472616e73616374696f6e732f7472616e73616374696f6e735f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223239223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a32313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223334223b733a353a226c6162656c223b733a31333a2262616c616e63655f7368656574223b733a343a226c696e6b223b733a33323a2261646d696e2f7472616e73616374696f6e732f62616c616e63655f7368656574223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223239223b733a343a22736f7274223b733a313a2235223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a32323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223336223b733a353a226c6162656c223b733a393a2262616e6b5f63617368223b733a343a226c696e6b223b733a32383a2261646d696e2f6163636f756e742f6d616e6167655f6163636f756e74223b733a343a2269636f6e223b733a31313a2266612066612d6d6f6e6579223b733a363a22706172656e74223b733a323a223239223b733a343a22736f7274223b733a313a2236223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a32333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223339223b733a353a226c6162656c223b733a353a226974656d73223b733a343a226c696e6b223b733a32323a2261646d696e2f6974656d732f6974656d735f6c697374223b733a343a2269636f6e223b733a31303a2266612066612d63756265223b733a363a22706172656e74223b733a333a22313530223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a32343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223432223b733a353a226c6162656c223b733a363a227265706f7274223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31353a2266612066612d6261722d6368617274223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223234223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a32353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223433223b733a353a226c6162656c223b733a31373a226163636f756e745f73746174656d656e74223b733a343a226c696e6b223b733a33303a2261646d696e2f7265706f72742f6163636f756e745f73746174656d656e74223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a32363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223434223b733a353a226c6162656c223b733a31333a22696e636f6d655f7265706f7274223b733a343a226c696e6b223b733a32363a2261646d696e2f7265706f72742f696e636f6d655f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a32373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223435223b733a353a226c6162656c223b733a31343a22657870656e73655f7265706f7274223b733a343a226c696e6b223b733a32373a2261646d696e2f7265706f72742f657870656e73655f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a32383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223436223b733a353a226c6162656c223b733a31343a22696e636f6d655f657870656e7365223b733a343a226c696e6b223b733a32373a2261646d696e2f7265706f72742f696e636f6d655f657870656e7365223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a32393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223437223b733a353a226c6162656c223b733a31363a22646174655f776973655f7265706f7274223b733a343a226c696e6b223b733a32393a2261646d696e2f7265706f72742f646174655f776973655f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a33303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223438223b733a353a226c6162656c223b733a31303a22616c6c5f696e636f6d65223b733a343a226c696e6b223b733a32333a2261646d696e2f7265706f72742f616c6c5f696e636f6d65223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2236223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a33313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223439223b733a353a226c6162656c223b733a31313a22616c6c5f657870656e7365223b733a343a226c696e6b223b733a32343a2261646d696e2f7265706f72742f616c6c5f657870656e7365223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2237223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a33323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223530223b733a353a226c6162656c223b733a31353a22616c6c5f7472616e73616374696f6e223b733a343a226c696e6b223b733a32383a2261646d696e2f7265706f72742f616c6c5f7472616e73616374696f6e223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2238223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a33333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223531223b733a353a226c6162656c223b733a31373a22726563757272696e675f696e766f696365223b733a343a226c696e6b223b733a33313a2261646d696e2f696e766f6963652f726563757272696e675f696e766f696365223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a33343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223532223b733a353a226c6162656c223b733a31353a227472616e736665725f7265706f7274223b733a343a226c696e6b223b733a33343a2261646d696e2f7472616e73616374696f6e732f7472616e736665725f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223239223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a33353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223533223b733a353a226c6162656c223b733a31353a227265706f72745f62795f6d6f6e7468223b733a343a226c696e6b223b733a32383a2261646d696e2f7265706f72742f7265706f72745f62795f6d6f6e7468223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2235223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a33363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223534223b733a353a226c6162656c223b733a353a227461736b73223b733a343a226c696e6b223b733a32303a2261646d696e2f7461736b732f616c6c5f7461736b223b733a343a2269636f6e223b733a31313a2266612066612d7461736b73223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2235223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a33373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223535223b733a353a226c6162656c223b733a353a226c65616473223b733a343a226c696e6b223b733a31313a2261646d696e2f6c65616473223b733a343a2269636f6e223b733a31323a2266612066612d726f636b6574223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2238223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a33383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223536223b733a353a226c6162656c223b733a31333a226f70706f7274756e6974696573223b733a343a226c696e6b223b733a31393a2261646d696e2f6f70706f7274756e6974696573223b733a343a2269636f6e223b733a31323a2266612066612d66696c746572223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2237223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a33393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223537223b733a353a226c6162656c223b733a383a2270726f6a65637473223b733a343a226c696e6b223b733a31343a2261646d696e2f70726f6a65637473223b733a343a2269636f6e223b733a31393a2266612066612d666f6c6465722d6f70656e2d6f223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a34303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223538223b733a353a226c6162656c223b733a343a2262756773223b733a343a226c696e6b223b733a31303a2261646d696e2f62756773223b733a343a2269636f6e223b733a393a2266612066612d627567223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2236223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a34313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223539223b733a353a226c6162656c223b733a373a2270726f6a656374223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31393a2266612066612d666f6c6465722d6f70656e2d6f223b733a363a22706172656e74223b733a323a223432223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a34323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223630223b733a353a226c6162656c223b733a31323a227461736b735f7265706f7274223b733a343a226c696e6b223b733a32353a2261646d696e2f7265706f72742f7461736b735f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223432223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a34333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223631223b733a353a226c6162656c223b733a31313a22627567735f7265706f7274223b733a343a226c696e6b223b733a32343a2261646d696e2f7265706f72742f627567735f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223432223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a34343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223632223b733a353a226c6162656c223b733a31343a227469636b6574735f7265706f7274223b733a343a226c696e6b223b733a32373a2261646d696e2f7265706f72742f7469636b6574735f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223432223b733a343a22736f7274223b733a313a2235223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a34353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223633223b733a353a226c6162656c223b733a31333a22636c69656e745f7265706f7274223b733a343a226c696e6b223b733a32363a2261646d696e2f7265706f72742f636c69656e745f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223432223b733a343a22736f7274223b733a313a2236223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a34363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223636223b733a353a226c6162656c223b733a31363a227461736b735f61737369676e6d656e74223b733a343a226c696e6b223b733a32393a2261646d696e2f7265706f72742f7461736b735f61737369676e6d656e74223b733a343a2269636f6e223b733a31383a2266612066612d646f742d636972636c652d6f223b733a363a22706172656e74223b733a323a223539223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a34373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223637223b733a353a226c6162656c223b733a31353a22627567735f61737369676e6d656e74223b733a343a226c696e6b223b733a32383a2261646d696e2f7265706f72742f627567735f61737369676e6d656e74223b733a343a2269636f6e223b733a31383a2266612066612d646f742d636972636c652d6f223b733a363a22706172656e74223b733a323a223539223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a34383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223638223b733a353a226c6162656c223b733a31343a2270726f6a6563745f7265706f7274223b733a343a226c696e6b223b733a32373a2261646d696e2f7265706f72742f70726f6a6563745f7265706f7274223b733a343a2269636f6e223b733a31383a2266612066612d646f742d636972636c652d6f223b733a363a22706172656e74223b733a323a223539223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a34393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223639223b733a353a226c6162656c223b733a31333a22676f616c5f747261636b696e67223b733a343a226c696e6b223b733a31393a2261646d696e2f676f616c5f747261636b696e67223b733a343a2269636f6e223b733a31323a2266612066612d736869656c64223b733a363a22706172656e74223b733a323a223733223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a35303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223730223b733a353a226c6162656c223b733a31313a226465706172746d656e7473223b733a343a226c696e6b223b733a31373a2261646d696e2f6465706172746d656e7473223b733a343a2269636f6e223b733a31373a2266612066612d757365722d736563726574223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223134223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a35313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223731223b733a353a226c6162656c223b733a373a22686f6c69646179223b733a343a226c696e6b223b733a31333a2261646d696e2f686f6c69646179223b733a343a2269636f6e223b733a32313a2266612066612d63616c656e6461722d706c75732d6f223b733a363a22706172656e74223b733a323a223733223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a35323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223732223b733a353a226c6162656c223b733a31363a226c656176655f6d616e6167656d656e74223b733a343a226c696e6b223b733a32323a2261646d696e2f6c656176655f6d616e6167656d656e74223b733a343a2269636f6e223b733a31313a2266612066612d706c616e65223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223230223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a35333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223733223b733a353a226c6162656c223b733a393a227574696c6974696573223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31303a2266612066612d67696674223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223233223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a35343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223734223b733a353a226c6162656c223b733a383a226f76657274696d65223b733a343a226c696e6b223b733a32343a2261646d696e2f7574696c69746965732f6f76657274696d65223b733a343a2269636f6e223b733a31333a2266612066612d636c6f636b2d6f223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2239223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a35353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223735223b733a353a226c6162656c223b733a31323a226f66666963655f73746f636b223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31333a2266612066612d636f646570656e223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223135223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a35363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223736223b733a353a226c6162656c223b733a31343a2273746f636b5f63617465676f7279223b733a343a226c696e6b223b733a32363a2261646d696e2f73746f636b2f73746f636b5f63617465676f7279223b733a343a2269636f6e223b733a31333a2266612066612d736c6964657273223b733a363a22706172656e74223b733a323a223735223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a35373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223737223b733a353a226c6162656c223b733a31323a226d616e6167655f73746f636b223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31333a2266612066612d61726368697665223b733a363a22706172656e74223b733a323a223735223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a35383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223738223b733a353a226c6162656c223b733a31323a2261737369676e5f73746f636b223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31363a2266612066612d616c69676e2d6c656674223b733a363a22706172656e74223b733a323a223735223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a35393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223739223b733a353a226c6162656c223b733a31323a2273746f636b5f7265706f7274223b733a343a226c696e6b223b733a31383a2261646d696e2f73746f636b2f7265706f7274223b733a343a2269636f6e223b733a31363a2266612066612d6c696e652d6368617274223b733a363a22706172656e74223b733a323a223735223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a36303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223831223b733a353a226c6162656c223b733a31303a2273746f636b5f6c697374223b733a343a226c696e6b223b733a32323a2261646d696e2f73746f636b2f73746f636b5f6c697374223b733a343a2269636f6e223b733a32303a2266612066612d737461636b2d65786368616e6765223b733a363a22706172656e74223b733a323a223735223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a36313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223832223b733a353a226c6162656c223b733a31323a2261737369676e5f73746f636b223b733a343a226c696e6b223b733a32343a2261646d696e2f73746f636b2f61737369676e5f73746f636b223b733a343a2269636f6e223b733a31363a2266612066612d616c69676e2d6c656674223b733a363a22706172656e74223b733a323a223738223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a36323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223833223b733a353a226c6162656c223b733a31393a2261737369676e5f73746f636b5f7265706f7274223b733a343a226c696e6b223b733a33313a2261646d696e2f73746f636b2f61737369676e5f73746f636b5f7265706f7274223b733a343a2269636f6e223b733a31353a2266612066612d6261722d6368617274223b733a363a22706172656e74223b733a323a223738223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a36333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223834223b733a353a226c6162656c223b733a31333a2273746f636b5f686973746f7279223b733a343a226c696e6b223b733a32353a2261646d696e2f73746f636b2f73746f636b5f686973746f7279223b733a343a2269636f6e223b733a31373a2266612066612d66696c652d746578742d6f223b733a363a22706172656e74223b733a323a223737223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a36343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223835223b733a353a226c6162656c223b733a31313a22706572666f726d616e6365223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31343a2266612066612d6472696262626c65223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223139223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a36353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223836223b733a353a226c6162656c223b733a32313a22706572666f726d616e63655f696e64696361746f72223b733a343a226c696e6b223b733a33393a2261646d696e2f706572666f726d616e63652f706572666f726d616e63655f696e64696361746f72223b733a343a2269636f6e223b733a31323a2266612066612d72616e646f6d223b733a363a22706172656e74223b733a323a223835223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a36363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223837223b733a353a226c6162656c223b733a31383a22706572666f726d616e63655f7265706f7274223b733a343a226c696e6b223b733a33363a2261646d696e2f706572666f726d616e63652f706572666f726d616e63655f7265706f7274223b733a343a2269636f6e223b733a31363a2266612066612d63616c656e6461722d6f223b733a363a22706172656e74223b733a323a223835223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a36373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223838223b733a353a226c6162656c223b733a31343a22676976655f61707072616973616c223b733a343a226c696e6b223b733a34343a2261646d696e2f706572666f726d616e63652f676976655f706572666f726d616e63655f61707072616973616c223b733a343a2269636f6e223b733a31303a2266612066612d706c7573223b733a363a22706172656e74223b733a323a223835223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a36383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223839223b733a353a226c6162656c223b733a373a22706179726f6c6c223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a393a2266612066612d757364223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223138223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a36393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223930223b733a353a226c6162656c223b733a32313a226d616e6167655f73616c6172795f64657461696c73223b733a343a226c696e6b223b733a33353a2261646d696e2f706179726f6c6c2f6d616e6167655f73616c6172795f64657461696c73223b733a343a2269636f6e223b733a393a2266612066612d757364223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a37303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223931223b733a353a226c6162656c223b733a32303a22656d706c6f7965655f73616c6172795f6c697374223b733a343a226c696e6b223b733a33343a2261646d696e2f706179726f6c6c2f656d706c6f7965655f73616c6172795f6c697374223b733a343a2269636f6e223b733a31373a2266612066612d757365722d736563726574223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a37313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223932223b733a353a226c6162656c223b733a31323a226d616b655f7061796d656e74223b733a343a226c696e6b223b733a32363a2261646d696e2f706179726f6c6c2f6d616b655f7061796d656e74223b733a343a2269636f6e223b733a31313a2266612066612d7461736b73223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a37323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223933223b733a353a226c6162656c223b733a31363a2267656e65726174655f706179736c6970223b733a343a226c696e6b223b733a33303a2261646d696e2f706179726f6c6c2f67656e65726174655f706179736c6970223b733a343a2269636f6e223b733a31333a2266612066612d6c6973742d756c223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2235223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a37333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223934223b733a353a226c6162656c223b733a31353a2273616c6172795f74656d706c617465223b733a343a226c696e6b223b733a32393a2261646d696e2f706179726f6c6c2f73616c6172795f74656d706c617465223b733a343a2269636f6e223b733a31313a2266612066612d6d6f6e6579223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a37343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223935223b733a353a226c6162656c223b733a31313a22686f75726c795f72617465223b733a343a226c696e6b223b733a32353a2261646d696e2f706179726f6c6c2f686f75726c795f72617465223b733a343a2269636f6e223b733a31333a2266612066612d636c6f636b2d6f223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a37353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223936223b733a353a226c6162656c223b733a31353a22706179726f6c6c5f73756d6d617279223b733a343a226c696e6b223b733a32393a2261646d696e2f706179726f6c6c2f706179726f6c6c5f73756d6d617279223b733a343a2269636f6e223b733a31383a2266612066612d63616d6572612d726574726f223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2236223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a37363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223937223b733a353a226c6162656c223b733a31343a2270726f766964656e745f66756e64223b733a343a226c696e6b223b733a32383a2261646d696e2f706179726f6c6c2f70726f766964656e745f66756e64223b733a343a2269636f6e223b733a31353a2266612066612d627269656663617365223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2238223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a37373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223938223b733a353a226c6162656c223b733a31343a22616476616e63655f73616c617279223b733a343a226c696e6b223b733a32383a2261646d696e2f706179726f6c6c2f616476616e63655f73616c617279223b733a343a2269636f6e223b733a31393a2266612066612d63632d6d617374657263617264223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2237223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a37383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223939223b733a353a226c6162656c223b733a31343a22656d706c6f7965655f6177617264223b733a343a226c696e6b223b733a31313a2261646d696e2f6177617264223b733a343a2269636f6e223b733a31323a2266612066612d74726f706879223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a323a223130223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a37393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313030223b733a353a226c6162656c223b733a31333a22616e6e6f756e63656d656e7473223b733a343a226c696e6b223b733a31393a2261646d696e2f616e6e6f756e63656d656e7473223b733a343a2269636f6e223b733a31393a2266612066612d62756c6c686f726e2069636f6e223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223232223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a38303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313031223b733a353a226c6162656c223b733a383a22747261696e696e67223b733a343a226c696e6b223b733a31343a2261646d696e2f747261696e696e67223b733a343a2269636f6e223b733a31343a2266612066612d7375697463617365223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223231223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a38313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313032223b733a353a226c6162656c223b733a31323a226a6f625f63697263756c6172223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31313a2266612066612d676c6f6265223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223137223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a38323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313033223b733a353a226c6162656c223b733a31313a226a6f62735f706f73746564223b733a343a226c696e6b223b733a33303a2261646d696e2f6a6f625f63697263756c61722f6a6f62735f706f73746564223b733a343a2269636f6e223b733a31323a2266612066612d7469636b6574223b733a363a22706172656e74223b733a333a22313032223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a38333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313034223b733a353a226c6162656c223b733a31373a226a6f62735f6170706c69636174696f6e73223b733a343a226c696e6b223b733a33363a2261646d696e2f6a6f625f63697263756c61722f6a6f62735f6170706c69636174696f6e73223b733a343a2269636f6e223b733a31333a2266612066612d636f6d70617373223b733a363a22706172656e74223b733a333a22313032223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a38343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313035223b733a353a226c6162656c223b733a31303a22617474656e64616e6365223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31353a2266612066612d66696c652d74657874223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223136223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a38353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313036223b733a353a226c6162656c223b733a31383a2274696d656368616e67655f72657175657374223b733a343a226c696e6b223b733a33353a2261646d696e2f617474656e64616e63652f74696d656368616e67655f72657175657374223b733a343a2269636f6e223b733a31363a2266612066612d63616c656e6461722d6f223b733a363a22706172656e74223b733a333a22313035223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a38363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313037223b733a353a226c6162656c223b733a31373a22617474656e64616e63655f7265706f7274223b733a343a226c696e6b223b733a33343a2261646d696e2f617474656e64616e63652f617474656e64616e63655f7265706f7274223b733a343a2269636f6e223b733a31353a2266612066612d66696c652d74657874223b733a363a22706172656e74223b733a333a22313035223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a38373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313038223b733a353a226c6162656c223b733a31323a2274696d655f686973746f7279223b733a343a226c696e6b223b733a32393a2261646d696e2f617474656e64616e63652f74696d655f686973746f7279223b733a343a2269636f6e223b733a31333a2266612066612d636c6f636b2d6f223b733a363a22706172656e74223b733a333a22313035223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a38383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313039223b733a353a226c6162656c223b733a393a2270756c6c2d646f776e223b733a343a226c696e6b223b733a303a22223b733a343a2269636f6e223b733a303a22223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2230223b7d693a38393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313130223b733a353a226c6162656c223b733a31313a2266696c656d616e61676572223b733a343a226c696e6b223b733a31373a2261646d696e2f66696c656d616e61676572223b733a343a2269636f6e223b733a31303a2266612066612d66696c65223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a39303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313131223b733a353a226c6162656c223b733a31353a22636f6d70616e795f64657461696c73223b733a343a226c696e6b223b733a31343a2261646d696e2f73657474696e6773223b733a343a2269636f6e223b733a32333a2266612066612d66772066612d696e666f2d636972636c65223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a39313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313132223b733a353a226c6162656c223b733a31353a2273797374656d5f73657474696e6773223b733a343a226c696e6b223b733a32313a2261646d696e2f73657474696e67732f73797374656d223b733a343a2269636f6e223b733a31393a2266612066612d66772066612d6465736b746f70223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a39323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313133223b733a353a226c6162656c223b733a31343a22656d61696c5f73657474696e6773223b733a343a226c696e6b223b733a32303a2261646d696e2f73657474696e67732f656d61696c223b733a343a2269636f6e223b733a32303a2266612066612d66772066612d656e76656c6f7065223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a39333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313134223b733a353a226c6162656c223b733a31353a22656d61696c5f74656d706c61746573223b733a343a226c696e6b223b733a32343a2261646d696e2f73657474696e67732f74656d706c61746573223b733a343a2269636f6e223b733a32353a2266612066612d66772066612d70656e63696c2d737175617265223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a313a2235223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a39343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313135223b733a353a226c6162656c223b733a31373a22656d61696c5f696e746567726174696f6e223b733a343a226c696e6b223b733a33323a2261646d696e2f73657474696e67732f656d61696c5f696e746567726174696f6e223b733a343a2269636f6e223b733a32323a2266612066612d66772066612d656e76656c6f70652d6f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a313a2236223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a39353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313136223b733a353a226c6162656c223b733a31363a227061796d656e745f73657474696e6773223b733a343a226c696e6b223b733a32333a2261646d696e2f73657474696e67732f7061796d656e7473223b733a343a2269636f6e223b733a31383a2266612066612d66772066612d646f6c6c6172223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a313a2237223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a39363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313137223b733a353a226c6162656c223b733a31363a22696e766f6963655f73657474696e6773223b733a343a226c696e6b223b733a32323a2261646d696e2f73657474696e67732f696e766f696365223b733a343a2269636f6e223b733a31373a2266612066612d66772066612d6d6f6e6579223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a313a2238223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a39373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313138223b733a353a226c6162656c223b733a31373a22657374696d6174655f73657474696e6773223b733a343a226c696e6b223b733a32333a2261646d696e2f73657474696e67732f657374696d617465223b733a343a2269636f6e223b733a31383a2266612066612d66772066612d66696c652d6f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223130223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a39383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313139223b733a353a226c6162656c223b733a32323a227469636b6574735f6c656164735f73657474696e6773223b733a343a226c696e6b223b733a32323a2261646d696e2f73657474696e67732f7469636b657473223b733a343a2269636f6e223b733a31383a2266612066612d66772066612d7469636b6574223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223134223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a39393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313230223b733a353a226c6162656c223b733a31343a227468656d655f73657474696e6773223b733a343a226c696e6b223b733a32303a2261646d696e2f73657474696e67732f7468656d65223b733a343a2269636f6e223b733a31363a2266612066612d66772066612d636f6465223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223230223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3130303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313231223b733a353a226c6162656c223b733a31323a22776f726b696e675f64617973223b733a343a226c696e6b223b733a32373a2261646d696e2f73657474696e67732f776f726b696e675f64617973223b733a343a2269636f6e223b733a32303a2266612066612d66772066612d63616c656e646172223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223232223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3130313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313232223b733a353a226c6162656c223b733a31343a226c656176655f63617465676f7279223b733a343a226c696e6b223b733a32393a2261646d696e2f73657474696e67732f6c656176655f63617465676f7279223b733a343a2269636f6e223b733a32313a2266612066612d66772066612d706167656c696e6573223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223233223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3130323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313233223b733a353a226c6162656c223b733a31353a22696e636f6d655f63617465676f7279223b733a343a226c696e6b223b733a33303a2261646d696e2f73657474696e67732f696e636f6d655f63617465676f7279223b733a343a2269636f6e223b733a32333a2266612066612d66772066612d6365727469666963617465223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223234223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3130333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313234223b733a353a226c6162656c223b733a31363a22657870656e73655f63617465676f7279223b733a343a226c696e6b223b733a33313a2261646d696e2f73657474696e67732f657870656e73655f63617465676f7279223b733a343a2269636f6e223b733a31373a2266612066612d66772066612d7461736b73223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223235223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3130343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313235223b733a353a226c6162656c223b733a31343a22637573746f6d65725f67726f7570223b733a343a226c696e6b223b733a32393a2261646d696e2f73657474696e67732f637573746f6d65725f67726f7570223b733a343a2269636f6e223b733a31373a2266612066612d66772066612d7573657273223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223236223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3130353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313237223b733a353a226c6162656c223b733a31313a226c6561645f737461747573223b733a343a226c696e6b223b733a32363a2261646d696e2f73657474696e67732f6c6561645f737461747573223b733a343a2269636f6e223b733a31393a2266612066612d66772066612d6c6973742d756c223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223136223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3130363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313238223b733a353a226c6162656c223b733a31313a226c6561645f736f75726365223b733a343a226c696e6b223b733a32363a2261646d696e2f73657474696e67732f6c6561645f736f75726365223b733a343a2269636f6e223b733a32323a2266612066612d66772066612d6172726f772d646f776e223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223137223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3130373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313239223b733a353a226c6162656c223b733a32363a226f70706f7274756e69746965735f73746174655f726561736f6e223b733a343a226c696e6b223b733a34313a2261646d696e2f73657474696e67732f6f70706f7274756e69746965735f73746174655f726561736f6e223b733a343a2269636f6e223b733a32343a2266612066612d66772066612d646f742d636972636c652d6f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223139223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3130383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313330223b733a353a226c6162656c223b733a31323a22637573746f6d5f6669656c64223b733a343a226c696e6b223b733a32373a2261646d696e2f73657474696e67732f637573746f6d5f6669656c64223b733a343a2269636f6e223b733a31383a2266612066612d66772066612d737461722d6f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223238223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3130393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313331223b733a353a226c6162656c223b733a31343a227061796d656e745f6d6574686f64223b733a343a226c696e6b223b733a32393a2261646d696e2f73657474696e67732f7061796d656e745f6d6574686f64223b733a343a2269636f6e223b733a31373a2266612066612d66772066612d6d6f6e6579223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223239223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3131303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313332223b733a353a226c6162656c223b733a373a2263726f6e6a6f62223b733a343a226c696e6b223b733a32323a2261646d696e2f73657474696e67732f63726f6e6a6f62223b733a343a2269636f6e223b733a31383a2266612066612d66772066612d636f6e74616f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223331223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3131313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313333223b733a353a226c6162656c223b733a31353a226d656e755f616c6c6f636174696f6e223b733a343a226c696e6b223b733a33303a2261646d696e2f73657474696e67732f6d656e755f616c6c6f636174696f6e223b733a343a2269636f6e223b733a32323a2266612066612d66772066612066612d636f6d70617373223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223332223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3131323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313334223b733a353a226c6162656c223b733a31323a226e6f74696669636174696f6e223b733a343a226c696e6b223b733a32373a2261646d696e2f73657474696e67732f6e6f74696669636174696f6e223b733a343a2269636f6e223b733a31383a2266612066612d66772066612d62656c6c2d6f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223333223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3131333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313335223b733a353a226c6162656c223b733a31383a22656d61696c5f6e6f74696669636174696f6e223b733a343a226c696e6b223b733a33333a2261646d696e2f73657474696e67732f656d61696c5f6e6f74696669636174696f6e223b733a343a2269636f6e223b733a31383a2266612066612d66772066612d62656c6c2d6f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223334223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3131343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313336223b733a353a226c6162656c223b733a31353a2264617461626173655f6261636b7570223b733a343a226c696e6b223b733a33303a2261646d696e2f73657474696e67732f64617461626173655f6261636b7570223b733a343a2269636f6e223b733a32303a2266612066612d66772066612d6461746162617365223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223335223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3131353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313337223b733a353a226c6162656c223b733a31323a227472616e736c6174696f6e73223b733a343a226c696e6b223b733a32373a2261646d696e2f73657474696e67732f7472616e736c6174696f6e73223b733a343a2269636f6e223b733a32303a2266612066612d66772066612d6c616e6775616765223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223336223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3131363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313338223b733a353a226c6162656c223b733a31333a2273797374656d5f757064617465223b733a343a226c696e6b223b733a32383a2261646d696e2f73657474696e67732f73797374656d5f757064617465223b733a343a2269636f6e223b733a32373a2266612066612d66772066612d70656e63696c2d7371756172652d6f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223337223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3131373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313339223b733a353a226c6162656c223b733a31323a22707269766174655f63686174223b733a343a226c696e6b223b733a31383a22636861742f636f6e766572736174696f6e73223b733a343a2269636f6e223b733a31343a2266612066612d656e76656c6f7065223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223238223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a3131383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313430223b733a353a226c6162656c223b733a393a2270726f706f73616c73223b733a343a226c696e6b223b733a31353a2261646d696e2f70726f706f73616c73223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a3131393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313431223b733a353a226c6162656c223b733a31333a226b6e6f776c6564676562617365223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a32313a2266612066612d7175657374696f6e2d636972636c65223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223131223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a3132303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313432223b733a353a226c6162656c223b733a31303a2263617465676f72696573223b733a343a226c696e6b223b733a33303a2261646d696e2f6b6e6f776c65646765626173652f63617465676f72696573223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313431223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a3132313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313433223b733a353a226c6162656c223b733a383a2261727469636c6573223b733a343a226c696e6b223b733a32383a2261646d696e2f6b6e6f776c65646765626173652f61727469636c6573223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313431223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a3132323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313434223b733a353a226c6162656c223b733a31333a226b6e6f776c6564676562617365223b733a343a226c696e6b223b733a31393a2261646d696e2f6b6e6f776c6564676562617365223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313431223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a3132333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313435223b733a353a226c6162656c223b733a31383a2264617368626f6172645f73657474696e6773223b733a343a226c696e6b223b733a32343a2261646d696e2f73657474696e67732f64617368626f617264223b733a343a2269636f6e223b733a32313a2266612066612d66772066612d64617368626f617264223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223231223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3132343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313436223b733a353a226c6162656c223b733a32303a227472616e73616374696f6e735f7265706f727473223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31363a2266612066612d6275696c64696e672d6f223b733a363a22706172656e74223b733a323a223432223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a3132353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313437223b733a353a226c6162656c223b733a353a2273616c6573223b733a343a226c696e6b223b733a32353a2261646d696e2f7265706f72742f73616c65735f7265706f7274223b733a343a2269636f6e223b733a31393a2266612066612d73686f7070696e672d63617274223b733a363a22706172656e74223b733a323a223432223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a3132363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313438223b733a353a226c6162656c223b733a31353a226d61726b5f617474656e64616e6365223b733a343a226c696e6b223b733a32313a2261646d696e2f6d61726b5f617474656e64616e6365223b733a343a2269636f6e223b733a31353a2266612066612d66696c652d74657874223b733a363a22706172656e74223b733a333a22313035223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a3132373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313439223b733a353a226c6162656c223b733a31303a22616c6c6f7765645f6970223b733a343a226c696e6b223b733a32353a2261646d696e2f73657474696e67732f616c6c6f7765645f6970223b733a343a2269636f6e223b733a31323a2266612066612d736572766572223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223237223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3132383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313530223b733a353a226c6162656c223b733a353a2273746f636b223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31313a2269636f6e2d6c6179657273223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2238223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a3132393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313531223b733a353a226c6162656c223b733a383a22737570706c696572223b733a343a226c696e6b223b733a31343a2261646d696e2f737570706c696572223b733a343a2269636f6e223b733a31343a2269636f6e2d627269656663617365223b733a363a22706172656e74223b733a333a22313530223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a3133303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313532223b733a353a226c6162656c223b733a383a227075726368617365223b733a343a226c696e6b223b733a31343a2261646d696e2f7075726368617365223b733a343a2269636f6e223b733a31323a2269636f6e2d68616e64626167223b733a363a22706172656e74223b733a333a22313530223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a3133313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313533223b733a353a226c6162656c223b733a31323a2272657475726e5f73746f636b223b733a343a226c696e6b223b733a31383a2261646d696e2f72657475726e5f73746f636b223b733a343a2269636f6e223b733a31343a2269636f6e2d73686172652d616c74223b733a363a22706172656e74223b733a333a22313530223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a3133323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313534223b733a353a226c6162656c223b733a31363a2270757263686173655f7061796d656e74223b733a343a226c696e6b223b733a32373a2261646d696e2f70757263686173652f616c6c5f7061796d656e7473223b733a343a2269636f6e223b733a31363a2269636f6e2d6372656469742d63617264223b733a363a22706172656e74223b733a333a22313530223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a3133333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313535223b733a353a226c6162656c223b733a31373a2270757263686173655f73657474696e6773223b733a343a226c696e6b223b733a32333a2261646d696e2f73657474696e67732f7075726368617365223b733a343a2269636f6e223b733a31383a2266612d66772069636f6e2d68616e64626167223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223132223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3133343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313536223b733a353a226c6162656c223b733a31313a226372656469745f6e6f7465223b733a343a226c696e6b223b733a31373a2261646d696e2f6372656469745f6e6f7465223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a3133353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313537223b733a353a226c6162656c223b733a31373a2270726f6a656374735f73657474696e6773223b733a343a226c696e6b223b733a32333a2261646d696e2f73657474696e67732f70726f6a65637473223b733a343a2269636f6e223b733a32353a2266612066612d66772066612d666f6c6465722d6f70656e2d6f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a313a2239223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3133363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313538223b733a353a226c6162656c223b733a343a2274616773223b733a343a226c696e6b223b733a31393a2261646d696e2f73657474696e67732f74616773223b733a343a2269636f6e223b733a31363a2266612066612d66772066612d74616773223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223131223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3133373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313539223b733a353a226c6162656c223b733a393a226c6561645f666f726d223b733a343a226c696e6b223b733a32353a2261646d696e2f6c656164732f616c6c5f6c6561645f666f726d223b733a343a2269636f6e223b733a31383a2266612066612d66772066612d726f636b6574223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223133223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3133383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313630223b733a353a226c6162656c223b733a31323a22736d735f73657474696e6773223b733a343a226c696e6b223b733a32373a2261646d696e2f73657474696e67732f736d735f73657474696e6773223b733a343a2269636f6e223b733a32303a2266612066612d66772066612d656e76656c6f7065223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223330223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3133393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313631223b733a353a226c6162656c223b733a393a22706f735f73616c6573223b733a343a226c696e6b223b733a32333a2261646d696e2f696e766f6963652f706f735f73616c6573223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a3134303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313836223b733a353a226c6162656c223b733a393a2277617265686f757365223b733a343a226c696e6b223b733a32323a2261646d696e2f77617265686f7573652f6d616e616765223b733a343a2269636f6e223b733a31363a2266612066612d6275696c64696e672d6f223b733a363a22706172656e74223b733a333a22313530223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a3134313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313837223b733a353a226c6162656c223b733a31323a227472616e736665724974656d223b733a343a226c696e6b223b733a32343a2261646d696e2f6974656d732f7472616e736665724974656d223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313530223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a3134323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22323033223b733a353a226c6162656c223b733a31333a2261776172645f73657474696e67223b733a343a226c696e6b223b733a32303a2261646d696e2f73657474696e67732f6177617264223b733a343a2269636f6e223b733a31303a2266612066612d73746172223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223330223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3134333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22323034223b733a353a226c6162656c223b733a31383a2261776172645f72756c655f73657474696e67223b733a343a226c696e6b223b733a33343a2261646d696e2f73657474696e67732f61776172645f72756c655f73657474696e6768223b733a343a2269636f6e223b733a31303a2266612066612d73746172223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223331223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3134343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22323035223b733a353a226c6162656c223b733a32323a2261776172645f70726f6772616d5f73657474696e6773223b733a343a226c696e6b223b733a33373a2261646d696e2f73657474696e67732f61776172645f70726f6772616d5f73657474696e6773223b733a343a2269636f6e223b733a393a2266612066612d636f67223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223332223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2232223b7d693a3134353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22323036223b733a353a226c6162656c223b733a31393a22636c69656e745f61776172645f706f696e7473223b733a343a226c696e6b223b733a32373a2261646d696e2f696e766f6963652f636c69656e745f617761726473223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a323a223130223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a3134363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22323037223b733a353a226c6162656c223b733a32303a22626573745f73656c6c696e675f70726f64756374223b733a343a226c696e6b223b733a31383a2261646d696e2f626573745f73656c6c696e67223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a323a223131223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a3134373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22323039223b733a353a226c6162656c223b733a373a227761726e696e67223b733a343a226c696e6b223b733a31333a2261646d696e2f7761726e696e67223b733a343a2269636f6e223b733a31333a2266612066612d7761726e696e67223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a3134383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22323130223b733a353a226c6162656c223b733a393a2270726f6d6f74696f6e223b733a343a226c696e6b223b733a31353a2261646d696e2f70726f6d6f74696f6e223b733a343a2269636f6e223b733a32313a2266612066612d6172726f772d636972636c652d7570223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a3134393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22323131223b733a353a226c6162656c223b733a31313a227465726d696e6174696f6e223b733a343a226c696e6b223b733a31373a2261646d696e2f7465726d696e6174696f6e223b733a343a2269636f6e223b733a31323a2266612066612d657261736572223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2235223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d693a3135303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22323132223b733a353a226c6162656c223b733a31313a2272657369676e6174696f6e223b733a343a226c696e6b223b733a31373a2261646d696e2f72657369676e6174696f6e223b733a343a2269636f6e223b733a31343a2266612066612d73636973736f7273223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2236223b733a343a2274696d65223b733a31393a22323032322d31312d32392031303a34303a3233223b733a363a22737461747573223b733a313a2231223b7d7d);
INSERT INTO `tbl_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('dnmmgrc2aufsaeblf403aeuuavugcier', '::1', 1653909049, 0x5f5f63695f6c6173745f726567656e65726174657c693a313635333930383734373b6d656e755f6163746976655f69647c613a323a7b693a303b733a333a22313039223b693a313b733a313a2230223b7d75726c7c733a33313a2261646d696e2f696e766f6963652f696e766f6963655f64657461696c732f33223b757365725f726f6c6c7c613a3134373a7b693a303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a313a2231223b733a353a226c6162656c223b733a393a2264617368626f617264223b733a343a226c696e6b223b733a31353a2261646d696e2f64617368626f617264223b733a343a2269636f6e223b733a31353a2266612066612d64617368626f617264223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a313a2232223b733a353a226c6162656c223b733a383a2263616c656e646172223b733a343a226c696e6b223b733a31343a2261646d696e2f63616c656e646172223b733a343a2269636f6e223b733a31343a2266612066612d63616c656e646172223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a313a2234223b733a353a226c6162656c223b733a363a22636c69656e74223b733a343a226c696e6b223b733a32363a2261646d696e2f636c69656e742f6d616e6167655f636c69656e74223b733a343a2269636f6e223b733a31313a2266612066612d7573657273223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223133223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a313a2235223b733a353a226c6162656c223b733a373a226d61696c626f78223b733a343a226c696e6b223b733a31333a2261646d696e2f6d61696c626f78223b733a343a2269636f6e223b733a31363a2266612066612d656e76656c6f70652d6f223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a313a2236223b733a353a226c6162656c223b733a373a227469636b657473223b733a343a226c696e6b223b733a31333a2261646d696e2f7469636b657473223b733a343a2269636f6e223b733a31323a2266612066612d7469636b6574223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223130223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223132223b733a353a226c6162656c223b733a353a2273616c6573223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31393a2266612066612d73686f7070696e672d63617274223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2239223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223133223b733a353a226c6162656c223b733a373a22696e766f696365223b733a343a226c696e6b223b733a32383a2261646d696e2f696e766f6963652f6d616e6167655f696e766f696365223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223134223b733a353a226c6162656c223b733a393a22657374696d61746573223b733a343a226c696e6b223b733a31353a2261646d696e2f657374696d61746573223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223135223b733a353a226c6162656c223b733a31373a227061796d656e74735f7265636569766564223b733a343a226c696e6b223b733a32363a2261646d696e2f696e766f6963652f616c6c5f7061796d656e7473223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223136223b733a353a226c6162656c223b733a393a227461785f7261746573223b733a343a226c696e6b223b733a32333a2261646d696e2f696e766f6963652f7461785f7261746573223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2235223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a31303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223231223b733a353a226c6162656c223b733a31303a2271756f746174696f6e73223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31313a2266612066612d7061737465223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2237223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a31313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223232223b733a353a226c6162656c223b733a31353a2271756f746174696f6e735f6c697374223b733a343a226c696e6b223b733a31363a2261646d696e2f71756f746174696f6e73223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223231223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a31323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223233223b733a353a226c6162656c223b733a31353a2271756f746174696f6e735f666f726d223b733a343a226c696e6b223b733a33323a2261646d696e2f71756f746174696f6e732f71756f746174696f6e735f666f726d223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223231223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a31333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223234223b733a353a226c6162656c223b733a343a2275736572223b733a343a226c696e6b223b733a32303a2261646d696e2f757365722f757365725f6c697374223b733a343a2269636f6e223b733a31313a2266612066612d7573657273223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223235223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a31343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223235223b733a353a226c6162656c223b733a383a2273657474696e6773223b733a343a226c696e6b223b733a31343a2261646d696e2f73657474696e6773223b733a343a2269636f6e223b733a31303a2266612066612d636f6773223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223236223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a31353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223236223b733a353a226c6162656c223b733a31353a2264617461626173655f6261636b7570223b733a343a226c696e6b223b733a33303a2261646d696e2f73657474696e67732f64617461626173655f6261636b7570223b733a343a2269636f6e223b733a31343a2266612066612d6461746162617365223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223237223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a31363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223239223b733a353a226c6162656c223b733a31373a227472616e73616374696f6e735f6d656e75223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31363a2266612066612d6275696c64696e672d6f223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223132223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a31373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223330223b733a353a226c6162656c223b733a373a226465706f736974223b733a343a226c696e6b223b733a32363a2261646d696e2f7472616e73616374696f6e732f6465706f736974223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223239223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a31383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223331223b733a353a226c6162656c223b733a373a22657870656e7365223b733a343a226c696e6b223b733a32363a2261646d696e2f7472616e73616374696f6e732f657870656e7365223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223239223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a31393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223332223b733a353a226c6162656c223b733a383a227472616e73666572223b733a343a226c696e6b223b733a32373a2261646d696e2f7472616e73616374696f6e732f7472616e73666572223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223239223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a32303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223333223b733a353a226c6162656c223b733a31393a227472616e73616374696f6e735f7265706f7274223b733a343a226c696e6b223b733a33383a2261646d696e2f7472616e73616374696f6e732f7472616e73616374696f6e735f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223239223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a32313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223334223b733a353a226c6162656c223b733a31333a2262616c616e63655f7368656574223b733a343a226c696e6b223b733a33323a2261646d696e2f7472616e73616374696f6e732f62616c616e63655f7368656574223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223239223b733a343a22736f7274223b733a313a2235223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a32323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223336223b733a353a226c6162656c223b733a393a2262616e6b5f63617368223b733a343a226c696e6b223b733a32383a2261646d696e2f6163636f756e742f6d616e6167655f6163636f756e74223b733a343a2269636f6e223b733a31313a2266612066612d6d6f6e6579223b733a363a22706172656e74223b733a323a223239223b733a343a22736f7274223b733a313a2236223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a32333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223339223b733a353a226c6162656c223b733a353a226974656d73223b733a343a226c696e6b223b733a32323a2261646d696e2f6974656d732f6974656d735f6c697374223b733a343a2269636f6e223b733a31303a2266612066612d63756265223b733a363a22706172656e74223b733a333a22313530223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a32343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223432223b733a353a226c6162656c223b733a363a227265706f7274223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31353a2266612066612d6261722d6368617274223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223234223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a32353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223433223b733a353a226c6162656c223b733a31373a226163636f756e745f73746174656d656e74223b733a343a226c696e6b223b733a33303a2261646d696e2f7265706f72742f6163636f756e745f73746174656d656e74223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a32363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223434223b733a353a226c6162656c223b733a31333a22696e636f6d655f7265706f7274223b733a343a226c696e6b223b733a32363a2261646d696e2f7265706f72742f696e636f6d655f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a32373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223435223b733a353a226c6162656c223b733a31343a22657870656e73655f7265706f7274223b733a343a226c696e6b223b733a32373a2261646d696e2f7265706f72742f657870656e73655f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a32383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223436223b733a353a226c6162656c223b733a31343a22696e636f6d655f657870656e7365223b733a343a226c696e6b223b733a32373a2261646d696e2f7265706f72742f696e636f6d655f657870656e7365223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a32393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223437223b733a353a226c6162656c223b733a31363a22646174655f776973655f7265706f7274223b733a343a226c696e6b223b733a32393a2261646d696e2f7265706f72742f646174655f776973655f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a33303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223438223b733a353a226c6162656c223b733a31303a22616c6c5f696e636f6d65223b733a343a226c696e6b223b733a32333a2261646d696e2f7265706f72742f616c6c5f696e636f6d65223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2236223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a33313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223439223b733a353a226c6162656c223b733a31313a22616c6c5f657870656e7365223b733a343a226c696e6b223b733a32343a2261646d696e2f7265706f72742f616c6c5f657870656e7365223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2237223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a33323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223530223b733a353a226c6162656c223b733a31353a22616c6c5f7472616e73616374696f6e223b733a343a226c696e6b223b733a32383a2261646d696e2f7265706f72742f616c6c5f7472616e73616374696f6e223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2238223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a33333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223531223b733a353a226c6162656c223b733a31373a22726563757272696e675f696e766f696365223b733a343a226c696e6b223b733a33313a2261646d696e2f696e766f6963652f726563757272696e675f696e766f696365223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a33343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223532223b733a353a226c6162656c223b733a31353a227472616e736665725f7265706f7274223b733a343a226c696e6b223b733a33343a2261646d696e2f7472616e73616374696f6e732f7472616e736665725f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223239223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a33353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223533223b733a353a226c6162656c223b733a31353a227265706f72745f62795f6d6f6e7468223b733a343a226c696e6b223b733a32383a2261646d696e2f7265706f72742f7265706f72745f62795f6d6f6e7468223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313436223b733a343a22736f7274223b733a313a2235223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a33363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223534223b733a353a226c6162656c223b733a353a227461736b73223b733a343a226c696e6b223b733a32303a2261646d696e2f7461736b732f616c6c5f7461736b223b733a343a2269636f6e223b733a31313a2266612066612d7461736b73223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2235223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a33373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223535223b733a353a226c6162656c223b733a353a226c65616473223b733a343a226c696e6b223b733a31313a2261646d696e2f6c65616473223b733a343a2269636f6e223b733a31323a2266612066612d726f636b6574223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2238223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a33383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223536223b733a353a226c6162656c223b733a31333a226f70706f7274756e6974696573223b733a343a226c696e6b223b733a31393a2261646d696e2f6f70706f7274756e6974696573223b733a343a2269636f6e223b733a31323a2266612066612d66696c746572223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2237223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a33393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223537223b733a353a226c6162656c223b733a383a2270726f6a65637473223b733a343a226c696e6b223b733a31343a2261646d696e2f70726f6a65637473223b733a343a2269636f6e223b733a31393a2266612066612d666f6c6465722d6f70656e2d6f223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a34303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223538223b733a353a226c6162656c223b733a343a2262756773223b733a343a226c696e6b223b733a31303a2261646d696e2f62756773223b733a343a2269636f6e223b733a393a2266612066612d627567223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2236223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a34313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223539223b733a353a226c6162656c223b733a373a2270726f6a656374223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31393a2266612066612d666f6c6465722d6f70656e2d6f223b733a363a22706172656e74223b733a323a223432223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a34323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223630223b733a353a226c6162656c223b733a31323a227461736b735f7265706f7274223b733a343a226c696e6b223b733a32353a2261646d696e2f7265706f72742f7461736b735f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223432223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a34333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223631223b733a353a226c6162656c223b733a31313a22627567735f7265706f7274223b733a343a226c696e6b223b733a32343a2261646d696e2f7265706f72742f627567735f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223432223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a34343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223632223b733a353a226c6162656c223b733a31343a227469636b6574735f7265706f7274223b733a343a226c696e6b223b733a32373a2261646d696e2f7265706f72742f7469636b6574735f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223432223b733a343a22736f7274223b733a313a2235223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a34353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223633223b733a353a226c6162656c223b733a31333a22636c69656e745f7265706f7274223b733a343a226c696e6b223b733a32363a2261646d696e2f7265706f72742f636c69656e745f7265706f7274223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223432223b733a343a22736f7274223b733a313a2236223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a34363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223636223b733a353a226c6162656c223b733a31363a227461736b735f61737369676e6d656e74223b733a343a226c696e6b223b733a32393a2261646d696e2f7265706f72742f7461736b735f61737369676e6d656e74223b733a343a2269636f6e223b733a31383a2266612066612d646f742d636972636c652d6f223b733a363a22706172656e74223b733a323a223539223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a34373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223637223b733a353a226c6162656c223b733a31353a22627567735f61737369676e6d656e74223b733a343a226c696e6b223b733a32383a2261646d696e2f7265706f72742f627567735f61737369676e6d656e74223b733a343a2269636f6e223b733a31383a2266612066612d646f742d636972636c652d6f223b733a363a22706172656e74223b733a323a223539223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a34383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223638223b733a353a226c6162656c223b733a31343a2270726f6a6563745f7265706f7274223b733a343a226c696e6b223b733a32373a2261646d696e2f7265706f72742f70726f6a6563745f7265706f7274223b733a343a2269636f6e223b733a31383a2266612066612d646f742d636972636c652d6f223b733a363a22706172656e74223b733a323a223539223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a34393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223639223b733a353a226c6162656c223b733a31333a22676f616c5f747261636b696e67223b733a343a226c696e6b223b733a31393a2261646d696e2f676f616c5f747261636b696e67223b733a343a2269636f6e223b733a31323a2266612066612d736869656c64223b733a363a22706172656e74223b733a323a223733223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a35303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223730223b733a353a226c6162656c223b733a31313a226465706172746d656e7473223b733a343a226c696e6b223b733a31373a2261646d696e2f6465706172746d656e7473223b733a343a2269636f6e223b733a31373a2266612066612d757365722d736563726574223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223134223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a35313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223731223b733a353a226c6162656c223b733a373a22686f6c69646179223b733a343a226c696e6b223b733a31333a2261646d696e2f686f6c69646179223b733a343a2269636f6e223b733a32313a2266612066612d63616c656e6461722d706c75732d6f223b733a363a22706172656e74223b733a323a223733223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a35323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223732223b733a353a226c6162656c223b733a31363a226c656176655f6d616e6167656d656e74223b733a343a226c696e6b223b733a32323a2261646d696e2f6c656176655f6d616e6167656d656e74223b733a343a2269636f6e223b733a31313a2266612066612d706c616e65223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223230223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a35333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223733223b733a353a226c6162656c223b733a393a227574696c6974696573223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31303a2266612066612d67696674223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223233223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a35343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223734223b733a353a226c6162656c223b733a383a226f76657274696d65223b733a343a226c696e6b223b733a32343a2261646d696e2f7574696c69746965732f6f76657274696d65223b733a343a2269636f6e223b733a31333a2266612066612d636c6f636b2d6f223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2239223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a35353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223735223b733a353a226c6162656c223b733a31323a226f66666963655f73746f636b223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31333a2266612066612d636f646570656e223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223135223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a35363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223736223b733a353a226c6162656c223b733a31343a2273746f636b5f63617465676f7279223b733a343a226c696e6b223b733a32363a2261646d696e2f73746f636b2f73746f636b5f63617465676f7279223b733a343a2269636f6e223b733a31333a2266612066612d736c6964657273223b733a363a22706172656e74223b733a323a223735223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a35373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223737223b733a353a226c6162656c223b733a31323a226d616e6167655f73746f636b223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31333a2266612066612d61726368697665223b733a363a22706172656e74223b733a323a223735223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a35383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223738223b733a353a226c6162656c223b733a31323a2261737369676e5f73746f636b223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31363a2266612066612d616c69676e2d6c656674223b733a363a22706172656e74223b733a323a223735223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a35393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223739223b733a353a226c6162656c223b733a31323a2273746f636b5f7265706f7274223b733a343a226c696e6b223b733a31383a2261646d696e2f73746f636b2f7265706f7274223b733a343a2269636f6e223b733a31363a2266612066612d6c696e652d6368617274223b733a363a22706172656e74223b733a323a223735223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a36303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223831223b733a353a226c6162656c223b733a31303a2273746f636b5f6c697374223b733a343a226c696e6b223b733a32323a2261646d696e2f73746f636b2f73746f636b5f6c697374223b733a343a2269636f6e223b733a32303a2266612066612d737461636b2d65786368616e6765223b733a363a22706172656e74223b733a323a223735223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a36313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223832223b733a353a226c6162656c223b733a31323a2261737369676e5f73746f636b223b733a343a226c696e6b223b733a32343a2261646d696e2f73746f636b2f61737369676e5f73746f636b223b733a343a2269636f6e223b733a31363a2266612066612d616c69676e2d6c656674223b733a363a22706172656e74223b733a323a223738223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a36323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223833223b733a353a226c6162656c223b733a31393a2261737369676e5f73746f636b5f7265706f7274223b733a343a226c696e6b223b733a33313a2261646d696e2f73746f636b2f61737369676e5f73746f636b5f7265706f7274223b733a343a2269636f6e223b733a31353a2266612066612d6261722d6368617274223b733a363a22706172656e74223b733a323a223738223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a36333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223834223b733a353a226c6162656c223b733a31333a2273746f636b5f686973746f7279223b733a343a226c696e6b223b733a32353a2261646d696e2f73746f636b2f73746f636b5f686973746f7279223b733a343a2269636f6e223b733a31373a2266612066612d66696c652d746578742d6f223b733a363a22706172656e74223b733a323a223737223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a36343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223835223b733a353a226c6162656c223b733a31313a22706572666f726d616e6365223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31343a2266612066612d6472696262626c65223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223139223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a36353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223836223b733a353a226c6162656c223b733a32313a22706572666f726d616e63655f696e64696361746f72223b733a343a226c696e6b223b733a33393a2261646d696e2f706572666f726d616e63652f706572666f726d616e63655f696e64696361746f72223b733a343a2269636f6e223b733a31323a2266612066612d72616e646f6d223b733a363a22706172656e74223b733a323a223835223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a36363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223837223b733a353a226c6162656c223b733a31383a22706572666f726d616e63655f7265706f7274223b733a343a226c696e6b223b733a33363a2261646d696e2f706572666f726d616e63652f706572666f726d616e63655f7265706f7274223b733a343a2269636f6e223b733a31363a2266612066612d63616c656e6461722d6f223b733a363a22706172656e74223b733a323a223835223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a36373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223838223b733a353a226c6162656c223b733a31343a22676976655f61707072616973616c223b733a343a226c696e6b223b733a34343a2261646d696e2f706572666f726d616e63652f676976655f706572666f726d616e63655f61707072616973616c223b733a343a2269636f6e223b733a31303a2266612066612d706c7573223b733a363a22706172656e74223b733a323a223835223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a36383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223839223b733a353a226c6162656c223b733a373a22706179726f6c6c223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a393a2266612066612d757364223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223138223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a36393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223930223b733a353a226c6162656c223b733a32313a226d616e6167655f73616c6172795f64657461696c73223b733a343a226c696e6b223b733a33353a2261646d696e2f706179726f6c6c2f6d616e6167655f73616c6172795f64657461696c73223b733a343a2269636f6e223b733a393a2266612066612d757364223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a37303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223931223b733a353a226c6162656c223b733a32303a22656d706c6f7965655f73616c6172795f6c697374223b733a343a226c696e6b223b733a33343a2261646d696e2f706179726f6c6c2f656d706c6f7965655f73616c6172795f6c697374223b733a343a2269636f6e223b733a31373a2266612066612d757365722d736563726574223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a37313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223932223b733a353a226c6162656c223b733a31323a226d616b655f7061796d656e74223b733a343a226c696e6b223b733a32363a2261646d696e2f706179726f6c6c2f6d616b655f7061796d656e74223b733a343a2269636f6e223b733a31313a2266612066612d7461736b73223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a37323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223933223b733a353a226c6162656c223b733a31363a2267656e65726174655f706179736c6970223b733a343a226c696e6b223b733a33303a2261646d696e2f706179726f6c6c2f67656e65726174655f706179736c6970223b733a343a2269636f6e223b733a31333a2266612066612d6c6973742d756c223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2235223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a37333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223934223b733a353a226c6162656c223b733a31353a2273616c6172795f74656d706c617465223b733a343a226c696e6b223b733a32393a2261646d696e2f706179726f6c6c2f73616c6172795f74656d706c617465223b733a343a2269636f6e223b733a31313a2266612066612d6d6f6e6579223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a37343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223935223b733a353a226c6162656c223b733a31313a22686f75726c795f72617465223b733a343a226c696e6b223b733a32353a2261646d696e2f706179726f6c6c2f686f75726c795f72617465223b733a343a2269636f6e223b733a31333a2266612066612d636c6f636b2d6f223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a37353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223936223b733a353a226c6162656c223b733a31353a22706179726f6c6c5f73756d6d617279223b733a343a226c696e6b223b733a32393a2261646d696e2f706179726f6c6c2f706179726f6c6c5f73756d6d617279223b733a343a2269636f6e223b733a31383a2266612066612d63616d6572612d726574726f223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2236223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a37363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223937223b733a353a226c6162656c223b733a31343a2270726f766964656e745f66756e64223b733a343a226c696e6b223b733a32383a2261646d696e2f706179726f6c6c2f70726f766964656e745f66756e64223b733a343a2269636f6e223b733a31353a2266612066612d627269656663617365223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2238223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a37373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223938223b733a353a226c6162656c223b733a31343a22616476616e63655f73616c617279223b733a343a226c696e6b223b733a32383a2261646d696e2f706179726f6c6c2f616476616e63655f73616c617279223b733a343a2269636f6e223b733a31393a2266612066612d63632d6d617374657263617264223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a313a2237223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a37383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a323a223939223b733a353a226c6162656c223b733a31343a22656d706c6f7965655f6177617264223b733a343a226c696e6b223b733a31313a2261646d696e2f6177617264223b733a343a2269636f6e223b733a31323a2266612066612d74726f706879223b733a363a22706172656e74223b733a323a223839223b733a343a22736f7274223b733a323a223130223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a37393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313030223b733a353a226c6162656c223b733a31333a22616e6e6f756e63656d656e7473223b733a343a226c696e6b223b733a31393a2261646d696e2f616e6e6f756e63656d656e7473223b733a343a2269636f6e223b733a31393a2266612066612d62756c6c686f726e2069636f6e223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223232223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a38303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313031223b733a353a226c6162656c223b733a383a22747261696e696e67223b733a343a226c696e6b223b733a31343a2261646d696e2f747261696e696e67223b733a343a2269636f6e223b733a31343a2266612066612d7375697463617365223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223231223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a38313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313032223b733a353a226c6162656c223b733a31323a226a6f625f63697263756c6172223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31313a2266612066612d676c6f6265223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223137223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a38323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313033223b733a353a226c6162656c223b733a31313a226a6f62735f706f73746564223b733a343a226c696e6b223b733a33303a2261646d696e2f6a6f625f63697263756c61722f6a6f62735f706f73746564223b733a343a2269636f6e223b733a31323a2266612066612d7469636b6574223b733a363a22706172656e74223b733a333a22313032223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a38333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313034223b733a353a226c6162656c223b733a31373a226a6f62735f6170706c69636174696f6e73223b733a343a226c696e6b223b733a33363a2261646d696e2f6a6f625f63697263756c61722f6a6f62735f6170706c69636174696f6e73223b733a343a2269636f6e223b733a31333a2266612066612d636f6d70617373223b733a363a22706172656e74223b733a333a22313032223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a38343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313035223b733a353a226c6162656c223b733a31303a22617474656e64616e6365223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31353a2266612066612d66696c652d74657874223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223136223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a38353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313036223b733a353a226c6162656c223b733a31383a2274696d656368616e67655f72657175657374223b733a343a226c696e6b223b733a33353a2261646d696e2f617474656e64616e63652f74696d656368616e67655f72657175657374223b733a343a2269636f6e223b733a31363a2266612066612d63616c656e6461722d6f223b733a363a22706172656e74223b733a333a22313035223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a38363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313037223b733a353a226c6162656c223b733a31373a22617474656e64616e63655f7265706f7274223b733a343a226c696e6b223b733a33343a2261646d696e2f617474656e64616e63652f617474656e64616e63655f7265706f7274223b733a343a2269636f6e223b733a31353a2266612066612d66696c652d74657874223b733a363a22706172656e74223b733a333a22313035223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a38373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313038223b733a353a226c6162656c223b733a31323a2274696d655f686973746f7279223b733a343a226c696e6b223b733a32393a2261646d696e2f617474656e64616e63652f74696d655f686973746f7279223b733a343a2269636f6e223b733a31333a2266612066612d636c6f636b2d6f223b733a363a22706172656e74223b733a333a22313035223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a38383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313039223b733a353a226c6162656c223b733a393a2270756c6c2d646f776e223b733a343a226c696e6b223b733a303a22223b733a343a2269636f6e223b733a303a22223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2230223b7d693a38393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313130223b733a353a226c6162656c223b733a31313a2266696c656d616e61676572223b733a343a226c696e6b223b733a31373a2261646d696e2f66696c656d616e61676572223b733a343a2269636f6e223b733a31303a2266612066612d66696c65223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a39303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313131223b733a353a226c6162656c223b733a31353a22636f6d70616e795f64657461696c73223b733a343a226c696e6b223b733a31343a2261646d696e2f73657474696e6773223b733a343a2269636f6e223b733a32333a2266612066612d66772066612d696e666f2d636972636c65223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a39313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313132223b733a353a226c6162656c223b733a31353a2273797374656d5f73657474696e6773223b733a343a226c696e6b223b733a32313a2261646d696e2f73657474696e67732f73797374656d223b733a343a2269636f6e223b733a31393a2266612066612d66772066612d6465736b746f70223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a39323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313133223b733a353a226c6162656c223b733a31343a22656d61696c5f73657474696e6773223b733a343a226c696e6b223b733a32303a2261646d696e2f73657474696e67732f656d61696c223b733a343a2269636f6e223b733a32303a2266612066612d66772066612d656e76656c6f7065223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a39333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313134223b733a353a226c6162656c223b733a31353a22656d61696c5f74656d706c61746573223b733a343a226c696e6b223b733a32343a2261646d696e2f73657474696e67732f74656d706c61746573223b733a343a2269636f6e223b733a32353a2266612066612d66772066612d70656e63696c2d737175617265223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a313a2235223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a39343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313135223b733a353a226c6162656c223b733a31373a22656d61696c5f696e746567726174696f6e223b733a343a226c696e6b223b733a33323a2261646d696e2f73657474696e67732f656d61696c5f696e746567726174696f6e223b733a343a2269636f6e223b733a32323a2266612066612d66772066612d656e76656c6f70652d6f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a313a2236223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a39353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313136223b733a353a226c6162656c223b733a31363a227061796d656e745f73657474696e6773223b733a343a226c696e6b223b733a32333a2261646d696e2f73657474696e67732f7061796d656e7473223b733a343a2269636f6e223b733a31383a2266612066612d66772066612d646f6c6c6172223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a313a2237223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a39363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313137223b733a353a226c6162656c223b733a31363a22696e766f6963655f73657474696e6773223b733a343a226c696e6b223b733a32323a2261646d696e2f73657474696e67732f696e766f696365223b733a343a2269636f6e223b733a31373a2266612066612d66772066612d6d6f6e6579223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a313a2238223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a39373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313138223b733a353a226c6162656c223b733a31373a22657374696d6174655f73657474696e6773223b733a343a226c696e6b223b733a32333a2261646d696e2f73657474696e67732f657374696d617465223b733a343a2269636f6e223b733a31383a2266612066612d66772066612d66696c652d6f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223130223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a39383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313139223b733a353a226c6162656c223b733a32323a227469636b6574735f6c656164735f73657474696e6773223b733a343a226c696e6b223b733a32323a2261646d696e2f73657474696e67732f7469636b657473223b733a343a2269636f6e223b733a31383a2266612066612d66772066612d7469636b6574223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223134223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a39393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313230223b733a353a226c6162656c223b733a31343a227468656d655f73657474696e6773223b733a343a226c696e6b223b733a32303a2261646d696e2f73657474696e67732f7468656d65223b733a343a2269636f6e223b733a31363a2266612066612d66772066612d636f6465223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223230223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3130303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313231223b733a353a226c6162656c223b733a31323a22776f726b696e675f64617973223b733a343a226c696e6b223b733a32373a2261646d696e2f73657474696e67732f776f726b696e675f64617973223b733a343a2269636f6e223b733a32303a2266612066612d66772066612d63616c656e646172223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223232223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3130313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313232223b733a353a226c6162656c223b733a31343a226c656176655f63617465676f7279223b733a343a226c696e6b223b733a32393a2261646d696e2f73657474696e67732f6c656176655f63617465676f7279223b733a343a2269636f6e223b733a32313a2266612066612d66772066612d706167656c696e6573223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223233223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3130323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313233223b733a353a226c6162656c223b733a31353a22696e636f6d655f63617465676f7279223b733a343a226c696e6b223b733a33303a2261646d696e2f73657474696e67732f696e636f6d655f63617465676f7279223b733a343a2269636f6e223b733a32333a2266612066612d66772066612d6365727469666963617465223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223234223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3130333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313234223b733a353a226c6162656c223b733a31363a22657870656e73655f63617465676f7279223b733a343a226c696e6b223b733a33313a2261646d696e2f73657474696e67732f657870656e73655f63617465676f7279223b733a343a2269636f6e223b733a31373a2266612066612d66772066612d7461736b73223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223235223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3130343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313235223b733a353a226c6162656c223b733a31343a22637573746f6d65725f67726f7570223b733a343a226c696e6b223b733a32393a2261646d696e2f73657474696e67732f637573746f6d65725f67726f7570223b733a343a2269636f6e223b733a31373a2266612066612d66772066612d7573657273223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223236223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3130353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313237223b733a353a226c6162656c223b733a31313a226c6561645f737461747573223b733a343a226c696e6b223b733a32363a2261646d696e2f73657474696e67732f6c6561645f737461747573223b733a343a2269636f6e223b733a31393a2266612066612d66772066612d6c6973742d756c223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223136223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3130363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313238223b733a353a226c6162656c223b733a31313a226c6561645f736f75726365223b733a343a226c696e6b223b733a32363a2261646d696e2f73657474696e67732f6c6561645f736f75726365223b733a343a2269636f6e223b733a32323a2266612066612d66772066612d6172726f772d646f776e223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223137223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3130373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313239223b733a353a226c6162656c223b733a32363a226f70706f7274756e69746965735f73746174655f726561736f6e223b733a343a226c696e6b223b733a34313a2261646d696e2f73657474696e67732f6f70706f7274756e69746965735f73746174655f726561736f6e223b733a343a2269636f6e223b733a32343a2266612066612d66772066612d646f742d636972636c652d6f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223139223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3130383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313330223b733a353a226c6162656c223b733a31323a22637573746f6d5f6669656c64223b733a343a226c696e6b223b733a32373a2261646d696e2f73657474696e67732f637573746f6d5f6669656c64223b733a343a2269636f6e223b733a31383a2266612066612d66772066612d737461722d6f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223238223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3130393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313331223b733a353a226c6162656c223b733a31343a227061796d656e745f6d6574686f64223b733a343a226c696e6b223b733a32393a2261646d696e2f73657474696e67732f7061796d656e745f6d6574686f64223b733a343a2269636f6e223b733a31373a2266612066612d66772066612d6d6f6e6579223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223239223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3131303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313332223b733a353a226c6162656c223b733a373a2263726f6e6a6f62223b733a343a226c696e6b223b733a32323a2261646d696e2f73657474696e67732f63726f6e6a6f62223b733a343a2269636f6e223b733a31383a2266612066612d66772066612d636f6e74616f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223331223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3131313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313333223b733a353a226c6162656c223b733a31353a226d656e755f616c6c6f636174696f6e223b733a343a226c696e6b223b733a33303a2261646d696e2f73657474696e67732f6d656e755f616c6c6f636174696f6e223b733a343a2269636f6e223b733a32323a2266612066612d66772066612066612d636f6d70617373223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223332223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3131323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313334223b733a353a226c6162656c223b733a31323a226e6f74696669636174696f6e223b733a343a226c696e6b223b733a32373a2261646d696e2f73657474696e67732f6e6f74696669636174696f6e223b733a343a2269636f6e223b733a31383a2266612066612d66772066612d62656c6c2d6f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223333223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3131333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313335223b733a353a226c6162656c223b733a31383a22656d61696c5f6e6f74696669636174696f6e223b733a343a226c696e6b223b733a33333a2261646d696e2f73657474696e67732f656d61696c5f6e6f74696669636174696f6e223b733a343a2269636f6e223b733a31383a2266612066612d66772066612d62656c6c2d6f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223334223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3131343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313336223b733a353a226c6162656c223b733a31353a2264617461626173655f6261636b7570223b733a343a226c696e6b223b733a33303a2261646d696e2f73657474696e67732f64617461626173655f6261636b7570223b733a343a2269636f6e223b733a32303a2266612066612d66772066612d6461746162617365223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223335223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3131353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313337223b733a353a226c6162656c223b733a31323a227472616e736c6174696f6e73223b733a343a226c696e6b223b733a32373a2261646d696e2f73657474696e67732f7472616e736c6174696f6e73223b733a343a2269636f6e223b733a32303a2266612066612d66772066612d6c616e6775616765223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223336223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3131363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313338223b733a353a226c6162656c223b733a31333a2273797374656d5f757064617465223b733a343a226c696e6b223b733a32383a2261646d696e2f73657474696e67732f73797374656d5f757064617465223b733a343a2269636f6e223b733a32373a2266612066612d66772066612d70656e63696c2d7371756172652d6f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223337223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3131373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313339223b733a353a226c6162656c223b733a31323a22707269766174655f63686174223b733a343a226c696e6b223b733a31383a22636861742f636f6e766572736174696f6e73223b733a343a2269636f6e223b733a31343a2266612066612d656e76656c6f7065223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223238223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a3131383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313430223b733a353a226c6162656c223b733a393a2270726f706f73616c73223b733a343a226c696e6b223b733a31353a2261646d696e2f70726f706f73616c73223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a3131393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313431223b733a353a226c6162656c223b733a31333a226b6e6f776c6564676562617365223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a32313a2266612066612d7175657374696f6e2d636972636c65223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a323a223131223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a3132303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313432223b733a353a226c6162656c223b733a31303a2263617465676f72696573223b733a343a226c696e6b223b733a33303a2261646d696e2f6b6e6f776c65646765626173652f63617465676f72696573223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313431223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a3132313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313433223b733a353a226c6162656c223b733a383a2261727469636c6573223b733a343a226c696e6b223b733a32383a2261646d696e2f6b6e6f776c65646765626173652f61727469636c6573223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313431223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a3132323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313434223b733a353a226c6162656c223b733a31333a226b6e6f776c6564676562617365223b733a343a226c696e6b223b733a31393a2261646d696e2f6b6e6f776c6564676562617365223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313431223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a3132333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313435223b733a353a226c6162656c223b733a31383a2264617368626f6172645f73657474696e6773223b733a343a226c696e6b223b733a32343a2261646d696e2f73657474696e67732f64617368626f617264223b733a343a2269636f6e223b733a32313a2266612066612d66772066612d64617368626f617264223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223231223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3132343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313436223b733a353a226c6162656c223b733a32303a227472616e73616374696f6e735f7265706f727473223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31363a2266612066612d6275696c64696e672d6f223b733a363a22706172656e74223b733a323a223432223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a3132353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313437223b733a353a226c6162656c223b733a353a2273616c6573223b733a343a226c696e6b223b733a32353a2261646d696e2f7265706f72742f73616c65735f7265706f7274223b733a343a2269636f6e223b733a31393a2266612066612d73686f7070696e672d63617274223b733a363a22706172656e74223b733a323a223432223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a3132363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313438223b733a353a226c6162656c223b733a31353a226d61726b5f617474656e64616e6365223b733a343a226c696e6b223b733a32313a2261646d696e2f6d61726b5f617474656e64616e6365223b733a343a2269636f6e223b733a31353a2266612066612d66696c652d74657874223b733a363a22706172656e74223b733a333a22313035223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a3132373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313439223b733a353a226c6162656c223b733a31303a22616c6c6f7765645f6970223b733a343a226c696e6b223b733a32353a2261646d696e2f73657474696e67732f616c6c6f7765645f6970223b733a343a2269636f6e223b733a31323a2266612066612d736572766572223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223237223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3132383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313530223b733a353a226c6162656c223b733a353a2273746f636b223b733a343a226c696e6b223b733a313a2223223b733a343a2269636f6e223b733a31313a2269636f6e2d6c6179657273223b733a363a22706172656e74223b733a313a2230223b733a343a22736f7274223b733a313a2238223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a3132393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313531223b733a353a226c6162656c223b733a383a22737570706c696572223b733a343a226c696e6b223b733a31343a2261646d696e2f737570706c696572223b733a343a2269636f6e223b733a31343a2269636f6e2d627269656663617365223b733a363a22706172656e74223b733a333a22313530223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a3133303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313532223b733a353a226c6162656c223b733a383a227075726368617365223b733a343a226c696e6b223b733a31343a2261646d696e2f7075726368617365223b733a343a2269636f6e223b733a31323a2269636f6e2d68616e64626167223b733a363a22706172656e74223b733a333a22313530223b733a343a22736f7274223b733a313a2232223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a3133313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313533223b733a353a226c6162656c223b733a31323a2272657475726e5f73746f636b223b733a343a226c696e6b223b733a31383a2261646d696e2f72657475726e5f73746f636b223b733a343a2269636f6e223b733a31343a2269636f6e2d73686172652d616c74223b733a363a22706172656e74223b733a333a22313530223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a3133323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313534223b733a353a226c6162656c223b733a31363a2270757263686173655f7061796d656e74223b733a343a226c696e6b223b733a32373a2261646d696e2f70757263686173652f616c6c5f7061796d656e7473223b733a343a2269636f6e223b733a31363a2269636f6e2d6372656469742d63617264223b733a363a22706172656e74223b733a333a22313530223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a3133333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313535223b733a353a226c6162656c223b733a31373a2270757263686173655f73657474696e6773223b733a343a226c696e6b223b733a32333a2261646d696e2f73657474696e67732f7075726368617365223b733a343a2269636f6e223b733a31383a2266612d66772069636f6e2d68616e64626167223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223132223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3133343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313536223b733a353a226c6162656c223b733a31313a226372656469745f6e6f7465223b733a343a226c696e6b223b733a31373a2261646d696e2f6372656469745f6e6f7465223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2231223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a3133353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313537223b733a353a226c6162656c223b733a31373a2270726f6a656374735f73657474696e6773223b733a343a226c696e6b223b733a32333a2261646d696e2f73657474696e67732f70726f6a65637473223b733a343a2269636f6e223b733a32353a2266612066612d66772066612d666f6c6465722d6f70656e2d6f223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a313a2239223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3133363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313538223b733a353a226c6162656c223b733a343a2274616773223b733a343a226c696e6b223b733a31393a2261646d696e2f73657474696e67732f74616773223b733a343a2269636f6e223b733a31363a2266612066612d66772066612d74616773223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223131223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3133373b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313539223b733a353a226c6162656c223b733a393a226c6561645f666f726d223b733a343a226c696e6b223b733a32353a2261646d696e2f6c656164732f616c6c5f6c6561645f666f726d223b733a343a2269636f6e223b733a31383a2266612066612d66772066612d726f636b6574223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223133223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3133383b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313630223b733a353a226c6162656c223b733a31323a22736d735f73657474696e6773223b733a343a226c696e6b223b733a32373a2261646d696e2f73657474696e67732f736d735f73657474696e6773223b733a343a2269636f6e223b733a32303a2266612066612d66772066612d656e76656c6f7065223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223330223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3133393b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313631223b733a353a226c6162656c223b733a393a22706f735f73616c6573223b733a343a226c696e6b223b733a32333a2261646d696e2f696e766f6963652f706f735f73616c6573223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a313a2230223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a3134303b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313836223b733a353a226c6162656c223b733a393a2277617265686f757365223b733a343a226c696e6b223b733a32323a2261646d696e2f77617265686f7573652f6d616e616765223b733a343a2269636f6e223b733a31363a2266612066612d6275696c64696e672d6f223b733a363a22706172656e74223b733a333a22313530223b733a343a22736f7274223b733a313a2233223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a3134313b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22313837223b733a353a226c6162656c223b733a31323a227472616e736665724974656d223b733a343a226c696e6b223b733a32343a2261646d696e2f6974656d732f7472616e736665724974656d223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a333a22313530223b733a343a22736f7274223b733a313a2234223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a3134323b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22323033223b733a353a226c6162656c223b733a31333a2261776172645f73657474696e67223b733a343a226c696e6b223b733a32303a2261646d696e2f73657474696e67732f6177617264223b733a343a2269636f6e223b733a31303a2266612066612d73746172223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223330223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3134333b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22323034223b733a353a226c6162656c223b733a31383a2261776172645f72756c655f73657474696e67223b733a343a226c696e6b223b733a33343a2261646d696e2f73657474696e67732f61776172645f72756c655f73657474696e6768223b733a343a2269636f6e223b733a31303a2266612066612d73746172223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223331223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3134343b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22323035223b733a353a226c6162656c223b733a32323a2261776172645f70726f6772616d5f73657474696e6773223b733a343a226c696e6b223b733a33373a2261646d696e2f73657474696e67732f61776172645f70726f6772616d5f73657474696e6773223b733a343a2269636f6e223b733a393a2266612066612d636f67223b733a363a22706172656e74223b733a323a223235223b733a343a22736f7274223b733a323a223332223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2232223b7d693a3134353b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22323036223b733a353a226c6162656c223b733a31393a22636c69656e745f61776172645f706f696e7473223b733a343a226c696e6b223b733a32373a2261646d696e2f696e766f6963652f636c69656e745f617761726473223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a323a223130223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d693a3134363b4f3a383a22737464436c617373223a383a7b733a373a226d656e755f6964223b733a333a22323037223b733a353a226c6162656c223b733a32303a22626573745f73656c6c696e675f70726f64756374223b733a343a226c696e6b223b733a31383a2261646d696e2f626573745f73656c6c696e67223b733a343a2269636f6e223b733a31343a2266612066612d636972636c652d6f223b733a363a22706172656e74223b733a323a223132223b733a343a22736f7274223b733a323a223131223b733a343a2274696d65223b733a31393a22323032322d30352d33302031373a30353a3137223b733a363a22737461747573223b733a313a2231223b7d7d);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_status`
--

CREATE TABLE IF NOT EXISTS `tbl_status` (
  `status_id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(200) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_status`
--

INSERT INTO `tbl_status` (`status_id`, `status`) VALUES
(1, 'answered'),
(2, 'closed'),
(3, 'open'),
(5, 'in_progress');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock`
--

CREATE TABLE IF NOT EXISTS `tbl_stock` (
  `stock_id` int NOT NULL AUTO_INCREMENT,
  `stock_sub_category_id` int DEFAULT NULL,
  `item_name` varchar(200) NOT NULL,
  `total_stock` int DEFAULT NULL,
  PRIMARY KEY (`stock_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock_category`
--

CREATE TABLE IF NOT EXISTS `tbl_stock_category` (
  `stock_category_id` int NOT NULL AUTO_INCREMENT,
  `stock_category` varchar(200) NOT NULL,
  PRIMARY KEY (`stock_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock_sub_category`
--

CREATE TABLE IF NOT EXISTS `tbl_stock_sub_category` (
  `stock_sub_category_id` int NOT NULL AUTO_INCREMENT,
  `stock_category_id` int NOT NULL,
  `stock_sub_category` varchar(200) NOT NULL,
  PRIMARY KEY (`stock_sub_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_suppliers`
--

CREATE TABLE IF NOT EXISTS `tbl_suppliers` (
  `supplier_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` text,
  `vat` varchar(200) DEFAULT NULL,
  `permission` text,
  PRIMARY KEY (`supplier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tags`
--

CREATE TABLE IF NOT EXISTS `tbl_tags` (
  `tag_id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(300) DEFAULT NULL,
  `style` text,
  PRIMARY KEY (`tag_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task`
--

CREATE TABLE IF NOT EXISTS `tbl_task` (
  `task_id` int NOT NULL AUTO_INCREMENT,
  `project_id` int DEFAULT NULL,
  `milestones_id` int DEFAULT NULL,
  `opportunities_id` int DEFAULT NULL,
  `goal_tracking_id` int DEFAULT NULL,
  `sub_task_id` int DEFAULT NULL,
  `transactions_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `task_name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `task_description` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `task_start_date` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `task_created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `task_status` varchar(30) DEFAULT NULL,
  `task_progress` int DEFAULT NULL,
  `calculate_progress` varchar(200) DEFAULT NULL,
  `task_hour` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `tasks_notes` text,
  `timer_status` enum('on','off') NOT NULL DEFAULT 'off',
  `timer_started_by` varchar(300) DEFAULT NULL,
  `start_time` varchar(300) DEFAULT NULL,
  `logged_time` varchar(300) DEFAULT '0',
  `leads_id` int DEFAULT NULL,
  `bug_id` int DEFAULT NULL,
  `module` varchar(50) DEFAULT NULL,
  `module_field_id` int DEFAULT NULL,
  `created_by` int DEFAULT NULL,
  `permission` text,
  `client_visible` varchar(5) DEFAULT NULL,
  `custom_date` text,
  `hourly_rate` decimal(18,2) DEFAULT '0.00',
  `billable` varchar(20) NOT NULL DEFAULT 'No',
  `index_no` int DEFAULT NULL,
  `milestones_order` int NOT NULL DEFAULT '0',
  `tags` text,
  PRIMARY KEY (`task_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tasks_timer`
--

CREATE TABLE IF NOT EXISTS `tbl_tasks_timer` (
  `tasks_timer_id` int NOT NULL AUTO_INCREMENT,
  `task_id` int DEFAULT NULL,
  `user_id` int DEFAULT NULL,
  `timer_status` enum('on','off') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'off',
  `start_time` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `end_time` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `date_timed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reason` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `edited_by` int DEFAULT NULL,
  `project_id` int DEFAULT NULL,
  PRIMARY KEY (`tasks_timer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_task_comment`
--

CREATE TABLE IF NOT EXISTS `tbl_task_comment` (
  `task_comment_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int DEFAULT NULL,
  `comment` text NOT NULL,
  `comments_attachment` text,
  `comment_datetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `module` varchar(50) DEFAULT NULL,
  `module_field_id` int DEFAULT NULL,
  `attachments_id` int DEFAULT '0',
  `uploaded_files_id` int DEFAULT '0',
  `comments_reply_id` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`task_comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tax_rates`
--

CREATE TABLE IF NOT EXISTS `tbl_tax_rates` (
  `tax_rates_id` int NOT NULL AUTO_INCREMENT,
  `tax_rate_name` varchar(25) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0',
  `tax_rate_percent` decimal(10,2) NOT NULL DEFAULT '0.00',
  `permission` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  KEY `Index 1` (`tax_rates_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_terminations`
--

CREATE TABLE IF NOT EXISTS `tbl_terminations` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` int NOT NULL,
  `attachment` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `notice_date` date NOT NULL,
  `termination_date` date NOT NULL,
  `termination_type` varchar(190) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `description` varchar(190) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tickets`
--

CREATE TABLE IF NOT EXISTS `tbl_tickets` (
  `tickets_id` int NOT NULL AUTO_INCREMENT,
  `project_id` int DEFAULT '0',
  `ticket_code` varchar(32) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `subject` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `body` text,
  `status` varchar(200) DEFAULT NULL,
  `departments_id` int DEFAULT NULL,
  `reporter` int DEFAULT '0',
  `priority` varchar(50) DEFAULT NULL,
  `upload_file` text,
  `comment` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `permission` text,
  `tags` text,
  `last_reply` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`tickets_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_tickets_replies`
--

CREATE TABLE IF NOT EXISTS `tbl_tickets_replies` (
  `tickets_replies_id` int NOT NULL AUTO_INCREMENT,
  `tickets_id` bigint DEFAULT NULL,
  `ticket_reply_id` int DEFAULT '0',
  `body` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `replier` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `replierid` int DEFAULT NULL,
  `attachment` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`tickets_replies_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_todo`
--

CREATE TABLE IF NOT EXISTS `tbl_todo` (
  `todo_id` int NOT NULL AUTO_INCREMENT,
  `title` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_id` longtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `due_date` date NOT NULL,
  `status` int NOT NULL DEFAULT '0' COMMENT '1= in_progress 2= on hold 3= done',
  `assigned` int NOT NULL DEFAULT '0',
  `order` int NOT NULL,
  PRIMARY KEY (`todo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_training`
--

CREATE TABLE IF NOT EXISTS `tbl_training` (
  `training_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `assigned_by` int NOT NULL,
  `training_name` varchar(100) NOT NULL,
  `vendor_name` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `finish_date` date NOT NULL,
  `training_cost` varchar(300) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0 = pending, 1 = started, 2 = completed, 3 = terminated',
  `performance` tinyint(1) DEFAULT '0' COMMENT '0 = not concluded, 1 = satisfactory, 2 = average, 3 = poor, 4 = excellent',
  `remarks` text NOT NULL,
  `upload_file` text,
  `permission` text,
  PRIMARY KEY (`training_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transactions`
--

CREATE TABLE IF NOT EXISTS `tbl_transactions` (
  `transactions_id` int NOT NULL AUTO_INCREMENT,
  `project_id` int DEFAULT NULL,
  `account_id` int NOT NULL,
  `invoices_id` int NOT NULL DEFAULT '0',
  `warehouse_id` int DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `transaction_prefix` varchar(50) DEFAULT NULL,
  `type` enum('Income','Expense','Transfer') NOT NULL,
  `category_id` int DEFAULT NULL,
  `amount` decimal(18,2) NOT NULL,
  `recurring_type` varchar(50) DEFAULT NULL,
  `repeat_every` int DEFAULT NULL,
  `recurring` enum('Yes','No') DEFAULT NULL,
  `total_cycles` int DEFAULT NULL,
  `done_cycles` int DEFAULT NULL,
  `custom_recurring` tinyint(1) DEFAULT '0',
  `last_recurring_date` date DEFAULT NULL,
  `recurring_from` int DEFAULT NULL,
  `paid_by` int DEFAULT '0',
  `payment_methods_id` varchar(100) DEFAULT NULL,
  `reference` varchar(200) NOT NULL,
  `status` enum('non_approved','paid','unpaid') DEFAULT 'non_approved',
  `notes` text NOT NULL,
  `tags` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `tax` decimal(18,2) NOT NULL DEFAULT '0.00',
  `date` date NOT NULL,
  `create_date` datetime DEFAULT NULL,
  `debit` decimal(18,2) NOT NULL DEFAULT '0.00',
  `credit` decimal(18,2) NOT NULL DEFAULT '0.00',
  `total_balance` decimal(18,2) NOT NULL DEFAULT '0.00',
  `transfer_id` int NOT NULL DEFAULT '0',
  `permission` text,
  `attachement` text,
  `client_visible` enum('Yes','No') NOT NULL DEFAULT 'No',
  `added_by` int NOT NULL DEFAULT '0',
  `paid` int NOT NULL DEFAULT '0',
  `billable` enum('Yes','No') NOT NULL DEFAULT 'No',
  `deposit` text,
  `deposit_2` text,
  `under_55` text,
  PRIMARY KEY (`transactions_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transfer`
--

CREATE TABLE IF NOT EXISTS `tbl_transfer` (
  `transfer_id` int NOT NULL AUTO_INCREMENT,
  `to_account_id` int NOT NULL,
  `from_account_id` int NOT NULL,
  `amount` decimal(18,2) NOT NULL,
  `payment_methods_id` int NOT NULL,
  `reference` varchar(200) NOT NULL,
  `status` enum('Cleared','Uncleared','Reconciled','Void') NOT NULL DEFAULT 'Cleared',
  `notes` text NOT NULL,
  `date` date NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'Transfer',
  `permission` mediumtext,
  `attachement` mediumtext,
  PRIMARY KEY (`transfer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transfer_item`
--

CREATE TABLE IF NOT EXISTS `tbl_transfer_item` (
  `transfer_item_id` int NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(50) DEFAULT NULL,
  `date` varchar(100) DEFAULT NULL,
  `status` enum('pending','complete','send','approved','rejected') DEFAULT NULL,
  `shipping_cost` varchar(100) DEFAULT NULL,
  `notes` text,
  `attachment` text,
  `from_warehouse_id` int NOT NULL,
  `to_warehouse_id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `show_quantity_as` varchar(20) DEFAULT NULL,
  `tax` decimal(18,3) DEFAULT NULL,
  `total_tax` text NOT NULL,
  `permission` text,
  PRIMARY KEY (`transfer_item_id`),
  UNIQUE KEY `reference_no` (`reference_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_transfer_itemlist`
--

CREATE TABLE IF NOT EXISTS `tbl_transfer_itemlist` (
  `transfer_itemList_id` int NOT NULL AUTO_INCREMENT,
  `transfer_item_id` int NOT NULL,
  `saved_items_id` int DEFAULT '0',
  `warehouse_id` int DEFAULT NULL,
  `item_tax_rate` decimal(10,2) DEFAULT '0.00',
  `item_tax_name` text,
  `item_name` varchar(150) DEFAULT 'Item Name',
  `item_desc` longtext,
  `unit_cost` decimal(10,2) DEFAULT '0.00',
  `quantity` decimal(10,2) DEFAULT '0.00',
  `item_tax_total` decimal(10,2) DEFAULT '0.00',
  `total_cost` decimal(10,2) DEFAULT '0.00',
  `date_saved` timestamp NOT NULL DEFAULT '2018-12-10 22:00:00',
  `unit` varchar(200) DEFAULT NULL,
  `hsn_code` text,
  `order` int DEFAULT '0',
  PRIMARY KEY (`transfer_itemList_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_uploaded_files`
--

CREATE TABLE IF NOT EXISTS `tbl_uploaded_files` (
  `uploaded_files_id` int NOT NULL,
  `files_id` int NOT NULL,
  `files` text NOT NULL,
  `uploaded_path` text NOT NULL,
  `file_name` text NOT NULL,
  `size` int NOT NULL,
  `ext` varchar(100) NOT NULL,
  `is_image` int NOT NULL,
  `image_width` int NOT NULL,
  `image_height` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `role_id` int NOT NULL DEFAULT '2',
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `new_password_key` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `new_email_key` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `last_ip` varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `online_time` int NOT NULL DEFAULT '0' COMMENT '1 = online 0 = offline ',
  `permission` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `active_email` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `smtp_email_type` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `smtp_encription` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `smtp_action` varchar(5) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `smtp_host_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `smtp_username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `smtp_password` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `smtp_port` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `smtp_additional_flag` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `last_postmaster_run` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `media_path_slug` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_role`
--

CREATE TABLE IF NOT EXISTS `tbl_user_role` (
  `user_role_id` int NOT NULL AUTO_INCREMENT,
  `designations_id` int DEFAULT NULL,
  `menu_id` int NOT NULL,
  `view` int DEFAULT '0',
  `created` int DEFAULT '0',
  `edited` int DEFAULT '0',
  `deleted` int DEFAULT '0',
  PRIMARY KEY (`user_role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_warehouse`
--

CREATE TABLE IF NOT EXISTS `tbl_warehouse` (
  `warehouse_id` int NOT NULL AUTO_INCREMENT,
  `warehouse_code` varchar(100) DEFAULT NULL,
  `warehouse_name` varchar(250) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `address` text,
  `image` text,
  `permission` text,
  `status` enum('published','unpublished') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'published',
  PRIMARY KEY (`warehouse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_warehouses_products`
--

CREATE TABLE IF NOT EXISTS `tbl_warehouses_products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `warehouse_id` int NOT NULL,
  `quantity` decimal(15,4) NOT NULL,
  `rack` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `warehouse_id` (`warehouse_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_warnings`
--

CREATE TABLE IF NOT EXISTS `tbl_warnings` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `warning_to` int NOT NULL,
  `warning_by` int NOT NULL,
  `warning_type` int NOT NULL,
  `attachment` text CHARACTER SET utf8 COLLATE utf8_general_ci,
  `subject` varchar(190) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `warning_date` date NOT NULL,
  `description` varchar(190) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_working_days`
--

CREATE TABLE IF NOT EXISTS `tbl_working_days` (
  `working_days_id` int NOT NULL AUTO_INCREMENT,
  `day_id` int NOT NULL,
  `start_hours` varchar(20) NOT NULL,
  `end_hours` varchar(20) NOT NULL,
  `flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`working_days_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;