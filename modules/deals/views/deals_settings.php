<?php
$all_pipelines = get_result('tbl_deals_pipelines');
$all_stages = get_result('tbl_customer_group', array('type' => 'stages'));
?>

<div class="nav-tabs-custom">
    <!-- Tabs within a box -->
    <ul class="nav nav-tabs">
        
        <li class="active"><a href="<?= base_url('admin/deals/deals_setting') ?>"><?= lang('deals_settings') ?></a>
        </li>
        <li>
            <a href="<?= base_url() ?>admin/deals/new_stages"><?= ' ' . lang('new_stages') ?></a>
        </li>
        <li>
            <a href="<?= base_url() ?>admin/deals/sales_pipelines"><?= ' ' . lang('sales_pipelines') ?></a>
        </li>
    </ul>
    <?php echo message_box('success') ?>
    <div class="row">
        <!-- Start Form test -->
        <div class="col-lg-12">
            
            <form method="post" action="<?php echo base_url() ?>admin/deals/save_deals_email_integration"
                  class="form-horizontal">
                <div class="panel panel-custom">
                    <div class="panel-body">
                        
                        <div class="form-group">
                            <label class="col-lg-2 control-label"><?= lang('default_pipeline') ?> <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <select name="default_pipeline" class="form-control select_box" style="width: 100%"
                                        required>
                                    <option value=""><?= lang('select_pipeline') ?></option>
                                    <?php
                                    if (!empty($all_pipelines)) {
                                        foreach ($all_pipelines as $pipelines) {
                                            
                                            ?>
                                            
                                            <option value="<?= $pipelines->pipeline_id ?>" <?php
                                            if (!empty($pipelines->pipeline_id) && $pipelines->pipeline_id == config_item('default_pipeline')) {
                                                echo 'selected';
                                            } ?>><?= $pipelines->pipeline_name ?></option>
                                        
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="col-lg-2 control-label"><?= lang('default_stage') ?> <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <select name="default_stage" class="form-control select_box" style="width: 100%"
                                        required>
                                    <option value=""><?= lang('select_stages') ?></option>
                                    <?php
                                    if (!empty($all_stages)) {
                                        foreach ($all_stages as $v_stages) {
                                            $stages_name = get_row('tbl_deals_pipelines', array('pipeline_id' => $v_stages->description));
                                            
                                            ?>
                                            
                                            <option value="<?= $v_stages->customer_group_id ?>" <?php
                                            if (!empty($v_stages->customer_group_id) && $v_stages->customer_group_id == config_item('default_stage')) {
                                                echo 'selected';
                                            } ?>><?= $v_stages->customer_group ?>
                                                <span>( <?= $stages_name->pipeline_name; ?> )</span></option>
                                        
                                        <?php }
                                    } ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label"><?= lang('default_deal_owner') ?> <span
                                        class="text-danger">*</span></label>
                            <div class="col-lg-6">
                                <select name="default_deal_owner" class="form-control select_box" style="width: 100%"
                                        required>
                                    <?php
                                    $all_users = get_staff_details();
                                    if (!empty($all_users)) {
                                        foreach ($all_users as $v_users) {
                                            ?>
                                            <option value="<?= $v_users->user_id ?>" <?php
                                            if (!empty($v_users->user_id) && $v_users->user_id == config_item('default_deal_owner')) {
                                                echo 'selected';
                                            } ?>><?= $v_users->fullname ?></option>
                                        
                                        <?php }
                                    } ?>
                                
                                
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label"></label>
                            <div class="col-lg-9">
                                <div class="pull-left">
                                    <button type="submit"
                                            class="btn btn-sm btn-primary"><?= lang('save_changes') ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>