<div class="col-sm-4" data-spy="scroll" data-offset="0" xmlns="http://www.w3.org/1999/html">
    <div class="row">

        <div class="panel panel-custom fees_payment">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><?= lang('subscription_details') ?></strong>
                </div>
            </div>
            <div class="panel-body">
                <?php
                $super_admin = super_admin_access();

                if (!empty($company_info->frequency)) {
                    if ($company_info->frequency == 'monthly') {
                        $frequency = lang('mo');
                    } else if ($company_info->frequency == 'quarterly') {
                        $frequency = lang('qu');
                    } else {
                        $frequency = lang('yr');
                    }
                    $plan_name = '<a data-toggle="modal" data-target="#myModal" href="' . base_url('saas/gb/package_details/' . $company_info->company_history_id . '/1') . '">' . $company_info->package_name . ' ' . display_money($company_info->amount, default_currency()) . ' /' . $frequency . ' ' . '</a>';
                } else {
                    $plan_name = '-';
                }
                $activation_code = null;
                if (!empty($company_info->db_name) != 0) {
                    $db_name = $company_info->db_name;
                }
                $update = true;
                if ($company_info->status == 'pending') {
                    $label = 'exclamation-triangle text-info';
                    $activation_code = $company_info->activation_code;
                    $update = null;
                } else if ($company_info->status == 'running') {
                    $label = 'check-circle text-success';
                } else if ($company_info->status == 'expired') {
                    $label = 'lock text-danger';
                } else if ($company_info->status == 'suspended') {
                    $label = 'ban text-warning';
                } else {
                    $label = 'times-circle text-danger';
                }
                $trial = null;
                $till_date = null;
                $validity_date = null;
                if ($company_info->status != 'pending') {
                    if ($company_info->trial_period != 0) {
                        $till_date = trial_period($company_info);
                        $trial = '<small class="label label-danger text-sm mt0">' . lang('trial') . '</small>';
                    } else {
                        $till_date = running_period($company_info);
                    }
                    $validity_date = date("Y-m-d", strtotime($till_date . "day"));
                }
                ?>
                <div class="bb pb pt" style="overflow: hidden">
                    <i class="pull-left fa fa-3x fa-<?= $label ?>"></i>
                    <h2 class="mt0 pull-left"><?= lang($company_info->status) . ' ' . $trial ?>
                        <?php if (!empty($till_date)) { ?>
                            <small
                                    class="block text-sm ml-sm"><?= lang('till') . ' ' . $validity_date; ?></small>
                        <?php } ?>
                    </h2>
                </div>
                <div class="bb pb-sm pt-sm">
                    <label class="control-label"><?= lang('name') ?></label>
                    <span class="pull-right"><?= $company_info->name ?></span>
                </div>
                <div class="bb pb-sm pt-sm">
                    <label class="control-label"><?= lang('email') ?></label>
                    <span class="pull-right"><?= $company_info->email ?></span>
                </div>
                <div class="bb pb-sm pt-sm">
                    <label class="control-label"><?= lang('domain') ?></label>
                    <span class="pull-right"><a target="_blank"
                                                href="<?= companyUrl($company_info->domain) ?>"> <?= $company_info->domain ?></a></span>
                </div>

                <div class="bb pb-sm pt-sm">
                    <label class="control-label"><?= lang('package') ?></label>
                    <span class="pull-right"><?= $plan_name ?></span>
                </div>
                <?php if (!empty($activation_code) && empty($db_name)) { ?>
                    <div class="bb pb-sm pt-sm">
                        <label class="control-label"><?= lang('activation_token') ?></label>
                        <span class="pull-right"><?= $activation_code ?>
                    </div>
                    <div class="bb pb-sm pt-sm">
                        <label class="control-label"><?= lang('setup_manualy') ?></label>
                        <span class="pull-right">
                        <a class="mr-lg"
                           href="<?= base_url('saas/companies/reset_db/' . $company_info->id . '/1') ?>"><?= lang('fresh_db') ?></a>
                        
                        <a href="<?= base_url('saas/companies/reset_db/' . $company_info->id) ?>"><?= lang('with_sample_db') ?></a></span>
                    </div>
                <?php }
                if (!empty($db_name) && !empty($super_admin)) { ?>
                    <div class="bb pb-sm pt-sm">
                        <label class="control-label"><?= lang('database') ?> </label>
                        <span class="pull-right"><?= $db_name ?></span>
                    </div>
                    <div class="bb pb-sm pt-sm">
                        <label class="control-label"><?= lang('restore') ?></label>
                        <span class="pull-right">
                        <a class="mr-lg"
                           href="<?= base_url('saas/companies/reset_db/' . $company_info->id . '/1') ?>"><?= lang('fresh_db') ?></a>
                        
                        <a href="<?= base_url('saas/companies/reset_db/' . $company_info->id) ?>"><?= lang('with_sample_db') ?></a></span>
                    </div>
                <?php } ?>
                <div class="pb-sm pt-sm">
                    <label class="control-label"><?= lang('created_date') ?></label>
                    <span class="pull-right"><?= display_datetime($company_info->created_date) ?></span>
                </div>
                <?php
                if (empty($super_admin)) {
                    ?>
                    <div class="pb-sm pt-sm pull-right">
                        <label class="control-label"></label>
                        <a href="<?= base_url('upgradePlan/' . $company_info->id) ?>"
                           class="btn btn-sm btn-info"><i
                                    class="fa fa-redo"></i><?= lang('upgrade') . ' ' . lang('package') ?></a>
                    </div>
                <?php }
                ?>

            </div>
        </div>
        <?php if (!empty($update) && !empty($super_admin)) { ?>
    <?php echo form_open(base_url('saas/gb/update_sub_validity/' . $company_info->id), array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'data-parsley-validate' => '', 'role' => 'form')); ?>
        <div class="panel panel-custom">
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><?= lang('update') ?></strong>
                </div>
            </div>
            <div class="panel-body">
                <div class="mt0 pt0">
                    <div class="pb-sm pt-sm">
                        <label class="control-label"><?= lang('status') ?></label>
                        <select name="status" class="form-control select_box"
                                style="width: 100%">
                            <?php
                            $subs_status = array('running', 'expired', 'suspended', 'terminated');
                            if (!empty($subs_status)): foreach ($subs_status as $sb_status): ?>
                                <option
                                        value="<?= $sb_status ?>" <?= (!empty($company_info->status) && $company_info->status == $sb_status ? 'selected' : NULL) ?>><?= lang($sb_status) ?>
                                </option>
                            <?php
                            endforeach;
                            endif;
                            ?>
                        </select>
                    </div>
                </div>
                <div class="pb-sm pt-sm">
                    <label class="control-label"><?= lang('validity') ?></label>
                    <div class="input-group">
                        <input required type="text" name="validity"
                               placeholder="<?= lang('enter') . ' ' . lang('validity') ?>"
                               class="form-control datepicker" value="<?php
                        if (!empty($validity_date)) {
                            echo $validity_date;
                        }
                        ?>">
                        <div class="input-group-addon">
                            <a href="#"><i class="fa fa-calendar"></i></a>
                        </div>
                    </div>
                </div>
                <div class="pb-sm pt-sm">
                    <label class="control-label"><?= lang('remarks') ?></label>
                    <textarea class="form-control" name="remarks"
                              required><?php if (!empty($company_info->remarks)) {
                            echo $company_info->remarks;
                        } ?></textarea>
                </div>
                <div class="pb-sm pt-sm">
                    <label class="control-label"><?= lang('put_on_maintenance') ?></label>
                    <div class="checkbox c-checkbox">
                        <label class="needsclick">
                            <input type="checkbox" <?php
                            if ($company_info->maintenance_mode == 'Yes') {
                                echo "checked=\"checked\"";
                            }
                            ?> name="maintenance_mode" id="use_postmark">
                            <span class="fa fa-check"></span>
                        </label>
                    </div>
                </div>
                <div class="pb-sm pt-sm"
                     id="postmark_config" <?php echo ($company_info->maintenance_mode != 'Yes') ? 'style="display:none"' : '' ?>>
                    <label class="control-label"><?= lang('maintenance_mode_message') ?></label>
                    <textarea class="form-control"
                              name="maintenance_mode_message"><?php if (!empty($company_info->maintenance_mode_message)) {
                            echo $company_info->maintenance_mode_message;
                        } ?></textarea>
                </div>
                <div class="pb-sm pt-sm pull-right">
                    <label class="control-label"></label>
                    <button type="submit" class="btn btn-sm btn-primary "><?= lang('update') ?></button>
                </div>
                <?php }
                if (!empty($super_admin)) {
                    ?>
                    <div class="pb-sm pt-sm pull-left">
                        <label class="control-label"></label>
                        <a href="<?= base_url('saas/companies') ?>" class="btn btn-sm btn-warning"><i
                                    class="fa fa-redo"></i><?= lang('back') ?></a>
                    </div>
                    <?php
                } else {
                }
                if (!empty($update) && !empty($super_admin)) { ?>
            </div>
        </div>
    <?php echo form_close(); ?>
    <?php } ?>
    </div>
</div>
<div id="subscriptions_history">
    <div class="show_print" style="width: 100%; border-bottom: 2px solid black;margin-bottom: 30px">
        <table style="width: 100%; vertical-align: middle;">
            <tbody>
            <tr>
                <td style="width: 50px; border: 0px;">
                    <img style="width: 50px;height: 50px;margin-bottom: 5px;"
                         src="<?= base_url(config_item('company_logo')) ?>" alt="" class="img-circle">
                </td>

                <td style="border: 0px;">
                    <p style="margin-left: 10px; font: 14px lighter;"><?= config_item('company_name') ?></p>
                </td>
            </tr>
            </tbody>
        </table>
    </div><!-- show when print start-->

    <!--  **************** show when print End ********************* -->
    <div class="col-sm-8 print_width">

        <div class="panel panel-custom">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><?= lang('subscriptions') . ' ' . lang('histories') ?></strong>
                    <div class="pull-right"><!-- set pdf,Excel start action -->
                        <label class="hidden-print control-label pull-left hidden-xs">
                            <button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title=""
                                    type="button" onclick="payment_history('subscriptions_history')"
                                    data-original-title="Print"><i class="fa fa-print"></i>
                            </button>
                        </label>
                    </div><!-- set pdf,Excel start action -->
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-striped da" id="subsTable">
                    <thead>
                    <tr>
                        <th><?= lang('name') ?></th>
                        <th><?= lang('amount') ?></th>
                        <th><?= lang('created_date') ?></th>
                        <th><?= lang('validity') ?></th>
                        <th><?= lang('method') ?></th>
                        <th><?= lang('status') ?></th>
                    </tr>
                    </thead>
                    <tbody id="pricing">
                    <script type="text/javascript">
                        $(document).ready(function () {
                            fire_datatable(base_url + "saas/gb/companyHistoryList/" + '<?= $company_info->id ?>', 'subsTable');
                        });
                    </script>
                    </tbody>
                </table>
            </div>
        </div><!--************ Payment History End***********-->
    </div>
</div>
<div id="payment_history">
    <div class="show_print" style="width: 100%; border-bottom: 2px solid black;margin-bottom: 30px">
        <table style="width: 100%; vertical-align: middle;">
            <tbody>
            <tr>
                <td style="width: 50px; border: 0px;">
                    <img style="width: 50px;height: 50px;margin-bottom: 5px;"
                         src="<?= base_url(config_item('company_logo')) ?>" alt="" class="img-circle">
                </td>

                <td style="border: 0px;">
                    <p style="margin-left: 10px; font: 14px lighter;"><?= config_item('company_name') ?></p>
                </td>
            </tr>
            </tbody>
        </table>
    </div><!-- show when print start-->

    <!--  **************** show when print End ********************* -->
    <div class="col-sm-8 print_width">

        <div class="panel panel-custom">
            <!-- Default panel contents -->
            <div class="panel-heading">
                <div class="panel-title">
                    <strong><?= lang('payment') . ' ' . lang('histories') ?></strong>
                    <div class="pull-right"><!-- set pdf,Excel start action -->
                        <label class="hidden-print control-label pull-left hidden-xs">
                            <button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title=""
                                    type="button" onclick="payment_history('payment_history')"
                                    data-original-title="Print"><i class="fa fa-print"></i>
                            </button>
                        </label>
                    </div><!-- set pdf,Excel start action -->
                </div>
            </div>

            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-striped da" id="PaymentDataTables">
                    <thead>
                    <tr>
                        <th><?= lang('company_name') ?></th>
                        <th><?= lang('package_name') ?></th>
                        <th><?= lang('transaction_id') ?></th>
                        <th><?= lang('amount') ?></th>
                        <th><?= lang('payment_date') ?></th>
                        <th><?= lang('method') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            var Paymentlist = base_url + "saas/gb/companyPaymentList/" + '<?= $company_info->id ?>';
                            fire_datatable(Paymentlist, 'PaymentDataTables');
                        });
                    </script>
                    </tbody>
                </table>
            </div>
        </div><!--************ Payment History End***********-->
    </div>
</div>
<script type="text/javascript">
    function payment_history(payment_history) {
        // remove datatable if exist
        if ($.fn.DataTable.isDataTable('#DataTables')) {
            $('#DataTables').DataTable().destroy();
        }
        var printContents = document.getElementById(payment_history).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>