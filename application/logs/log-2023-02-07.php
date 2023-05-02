<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2023-02-07 11:42:30 --> 404 Page Not Found: /index
ERROR - 2023-02-07 11:42:31 --> 404 Page Not Found: /index
ERROR - 2023-02-07 11:42:31 --> 404 Page Not Found: /index
ERROR - 2023-02-07 11:42:35 --> 404 Page Not Found: admin/Building-opng/index
ERROR - 2023-02-07 17:42:35 --> Query error: In aggregated query without GROUP BY, expression #1 of SELECT list contains nonaggregated column 'db_saas_module.tbl_estimates.estimates_id'; this is incompatible with sql_mode=only_full_group_by - Invalid query: SELECT  tbl_estimates.estimates_id, sum(tbl_estimate_items.total_cost) as cost
        FROM tbl_estimates
        LEFT JOIN tbl_estimate_items ON tbl_estimates.estimates_id = tbl_estimate_items.estimates_id
        WHERE tbl_estimates.status NOT IN ('draft', 'cancelled')
ERROR - 2023-02-07 17:42:35 --> Severity: error --> Exception: Call to a member function row() on bool /Users/local/www/ziscoerp/application/controllers/admin/Dashboard.php 153
ERROR - 2023-02-07 17:42:35 --> Query error: Expression #1 of SELECT list is not in GROUP BY clause and contains nonaggregated column 'db_saas_module.tbl_goal_tracking.goal_tracking_id' which is not functionally dependent on columns in GROUP BY clause; this is incompatible with sql_mode=only_full_group_by - Invalid query: 
        SELECT tbl_goal_tracking.goal_tracking_id, tbl_goal_type.goal_type_id, tbl_goal_type.type_name,
tbl_goal_tracking.account_id, COALESCE(SUM(tbl_goal_tracking.achievement), 0) AS target,

CASE

WHEN tbl_goal_type.type_name='achive_total_income' THEN
(SELECT COALESCE(SUM(tbl_transactions.amount), 0) FROM tbl_transactions  WHERE tbl_transactions.type='Income'  AND tbl_transactions.date >= '2023-02-01 00:00:00' AND tbl_transactions.date <= '2023-02-28 23:59:59')

WHEN tbl_goal_type.type_name='achive_total_income_by_bank'  THEN
(SELECT coalesce(SUM(tbl_transactions.amount), 0) FROM tbl_transactions
WHERE  tbl_transactions.account_id = tbl_goal_tracking.account_id
AND tbl_transactions.type='Income'  AND tbl_transactions.date >= '2023-02-01 00:00:00' AND tbl_transactions.date <= '2023-02-28 23:59:59')

WHEN tbl_goal_type.type_name='achieve_total_expense' THEN
(SELECT COALESCE(SUM(tbl_transactions.amount), 0) FROM tbl_transactions  WHERE tbl_transactions.type='Expense'  AND tbl_transactions.date >= '2023-02-01 00:00:00' AND tbl_transactions.date <= '2023-02-28 23:59:59')

WHEN tbl_goal_type.type_name='achive_total_expense_by_bank' THEN
(SELECT COALESCE(SUM(tbl_transactions.amount), 0) FROM tbl_transactions  WHERE tbl_transactions.account_id = tbl_goal_tracking.account_id AND tbl_transactions.type='Expense' AND tbl_transactions.date >= '2023-02-01 00:00:00' AND tbl_transactions.date <= '2023-02-28 23:59:59')


WHEN tbl_goal_type.type_name='make_invoice' THEN
(SELECT COALESCE(COUNT(tbl_invoices.invoices_id), 0) FROM tbl_invoices  WHERE   tbl_invoices.date_saved >= '2023-02-01 00:00:00' AND tbl_invoices.date_saved <= '2023-02-28 23:59:59')

WHEN tbl_goal_type.type_name='make_estimate' THEN
(SELECT COALESCE(COUNT(tbl_estimates.estimates_id), 0) FROM tbl_estimates  WHERE   tbl_estimates.date_saved >= '2023-02-01 00:00:00' AND tbl_estimates.date_saved <= '2023-02-28 23:59:59')

WHEN tbl_goal_type.type_name='goal_payment' THEN
(SELECT COALESCE(SUM(tbl_payments.amount), 0) FROM tbl_payments  WHERE   tbl_payments.payment_date >= '2023-02-01 00:00:00' AND tbl_payments.payment_date <= '2023-02-28 23:59:59')


WHEN tbl_goal_type.type_name='task_done' THEN
(SELECT COALESCE(COUNT(tbl_task.task_id), 0) FROM tbl_task  WHERE   tbl_task.task_created_date >= '2023-02-01 00:00:00' AND tbl_task.task_created_date <= '2023-02-28 23:59:59' AND tbl_task.task_status = 'completed')


WHEN tbl_goal_type.type_name='resolved_bugs' THEN
(SELECT COALESCE(COUNT(tbl_bug.bug_id), 0) FROM tbl_bug  WHERE   tbl_bug.update_time >= '2023-02-01 00:00:00' AND tbl_bug.update_time <= '2023-02-28 23:59:59' AND tbl_bug.bug_status = 'resolved')


WHEN tbl_goal_type.type_name='convert_leads_to_client' THEN
(SELECT COALESCE(COUNT(tbl_client.client_id), 0) FROM tbl_client  WHERE   tbl_client.date_added >= '2023-02-01 00:00:00' AND tbl_client.date_added <= '2023-02-28 23:59:59' AND tbl_client.leads_id != 0)

WHEN tbl_goal_type.type_name='direct_client' THEN
(SELECT COALESCE(COUNT(tbl_client.client_id), 0) FROM tbl_client  WHERE   tbl_client.date_added >= '2023-02-01 00:00:00' AND tbl_client.date_added <= '2023-02-28 23:59:59' AND tbl_client.leads_id = 0)

WHEN tbl_goal_type.type_name='complete_project_goal' THEN
(SELECT COALESCE(COUNT(tbl_project.project_id), 0) FROM tbl_project  WHERE   tbl_project.start_date >= '2023-02-01 00:00:00' AND tbl_project.start_date <= '2023-02-28 23:59:59' AND tbl_project.project_status = 'completed')

END
AS amount_or_count

FROM `tbl_goal_type`

LEFT JOIN  tbl_goal_tracking ON tbl_goal_tracking.goal_type_id = tbl_goal_type.goal_type_id AND tbl_goal_tracking.end_date >= '2023-02-01 00:00:00' AND tbl_goal_tracking.end_date <= '2023-02-28 23:59:59'

LEFT JOIN  tbl_transactions ON tbl_goal_tracking.account_id = tbl_transactions.account_id


GROUP BY tbl_goal_type.goal_type_id
  
ERROR - 2023-02-07 17:42:35 --> Severity: error --> Exception: Call to a member function result() on bool /Users/local/www/ziscoerp/application/models/Admin_model.php 160
ERROR - 2023-02-07 11:42:40 --> 404 Page Not Found: admin/Building-opng/index
ERROR - 2023-02-07 11:42:43 --> 404 Page Not Found: admin/Settings/building-o.png
ERROR - 2023-02-07 11:57:43 --> 404 Page Not Found: admin/Invoice/building-o.png
ERROR - 2023-02-07 11:57:45 --> 404 Page Not Found: admin/Invoice/building-o.png
ERROR - 2023-02-07 11:58:00 --> 404 Page Not Found: admin/Invoice/building-o.png
