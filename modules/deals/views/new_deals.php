<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-tagsinput/fm.tagator.jquery.js"></script>
<div class="nav-tabs-custom">
    <!-- Tabs within a box -->
    <ul class="nav nav-tabs">
        
        <li><a href="<?= base_url('admin/deals/') ?>"><?= lang('all_deals') ?></a>
        </li>
        <li class="active">
            <a href="<?= base_url() ?>admin/deals/new_deals">
                <?= ' ' . lang('new') . ' ' . lang('deals') ?></a>
        </li>
        <li class="pull-right">
            <a href="<?= base_url() ?>admin/deals/deals_setting">
                <i class="fa fa-cogs"></i>
            </a>
        </li>
    </ul>
    <div class="panel-body bg-white">
        <form role="form" id="form" data-parsley-validate="" novalidate="" enctype="multipart/form-data"
              action="<?php echo base_url(); ?>deals/save_deals/<?= (!empty($deals->id) ? $deals->id : ''); ?>"
              method="post" class="form-horizontal form-groups-bordered">
            
            <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?= lang('title') ?> <span class="required">*</span></label>
                
                <div class="col-sm-8">
                    <input type="text" name="title" value="<?= (!empty($deals->title) ? $deals->title : ''); ?>"
                           class="form-control" required/>
                </div>
            </div>
            
            <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?= lang('deal_value') ?> <span
                            class="required">*</span></label>
                
                <div class="col-sm-8">
                    <input type="text" name="deal_value"
                           value="<?= (!empty($deals->deal_value) ? $deals->deal_value : ''); ?>" class="form-control"
                           required/>
                    <span><small><?= lang('deals_value_example') ?></small></span>
                
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label"><?= lang('source') ?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <select name="source_id" class="form-control select_box" style="width: 100%" required>
                        <?php
                        $all_deals_source = get_result('tbl_deals_source');
                        if (!empty($all_deals_source)) {
                            foreach ($all_deals_source as $deals_source) {
                                ?>
                                <option value="<?= $deals_source->source_id ?>" <?php
                                if (!empty($deals) && $deals->source_id == $deals_source->source_id) {
                                    echo 'selected';
                                }
                                ?>>
                                    <?= $deals_source->source_name ?></option>
                            <?php }
                        } ?>
                    </select>
                
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-3 control-label"><?= lang('close') . ' ' . lang('date') ?> <span
                            class="required">*</span></label>
                
                <div class="col-sm-8">
                    <div class="input-group">
                        <input type="text" name="days_to_close" required
                               placeholder="<?= lang('enter') . ' ' . lang('close') . ' ' . lang('date') ?>"
                               class="form-control start_date" value="<?php
                        if (!empty($deals->days_to_close)) {
                            echo $deals->days_to_close;
                        }
                        ?>">
                        <div class="input-group-addon">
                            <a href="#"><i class="fa fa-calendar"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label"><?= lang('pipeline') ?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <select name="pipeline" onchange="get_related_stages(this.value)" class="form-control select_box"
                            style="width: 100%" required>
                        <option value="0"><?= lang('select_pipeline') ?></option>
                        <?php
                        $all_pipelines = get_result('tbl_deals_pipelines');
                        if (!empty($all_pipelines)) {
                            foreach ($all_pipelines as $pipeline) {
                                ?>
                                <option value="<?= $pipeline->pipeline_id ?>" <?php
                                if (!empty($deals) && $deals->pipeline == $pipeline->pipeline_id) {
                                    echo 'selected';
                                }
                                ?>><?= lang($pipeline->pipeline_name) ?></option>
                            <?php }
                        } ?>
                    </select>
                
                </div>
            </div>
            <div class="form-group" id="pipelineStages">
            
            </div>
            
            
            <div class="form-group">
                <label class="col-lg-3 control-label"><?= lang('client_name') ?> <span
                            class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <select name="client_id[]" multiple class="selectpicker" data-width="100%" required>
                        <?php
                        $all_clients = get_result('tbl_client');
                        if (!empty($all_clients)) {
                            foreach ($all_clients as $clients) {
                                ?>
                                <option value="<?= $clients->client_id ?>" <?php
                                if (!empty($deals->client_id)) {
                                    $client_id = json_decode($deals->client_id);
                                    if (in_array($clients->client_id, $client_id)) {
                                        echo 'selected';
                                    }
                                }
                                ?>>
                                    <?= $clients->name ?></option>
                            <?php }
                        } ?>
                    </select>
                
                </div>
            </div>
            
            <div class="form-group">
                <label class="col-lg-3 control-label"><?= lang('deal_owner') ?> <span
                            class="text-danger">*</span></label>
                <div class="col-lg-8">
                    
                    <select name="default_deal_owner" class="selectpicker" data-width="100%" required>
                        <?php
                        $all_users = get_staff_details();
                        if (!empty($all_users)) {
                            foreach ($all_users as $user) {
                                ?>
                                <option value="<?= $user->user_id ?>" <?php
                                if (!empty($deals->default_deal_owner) && $deals->default_deal_owner == $user->user_id) {
                                    echo 'selected';
                                }
                                ?>>
                                    <?= $user->fullname
                                    . (!empty($user->employment_id) ? ' (' . ($user->employment_id) . ')' : '') ?></option>
                                ?></option>
                            <?php }
                        } ?>
                        ?>
                    
                    </select>
                
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label"><?= lang('assigne') ?> <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <select name="user_id[]" multiple class="selectpicker" data-width="100%" required>
                        <?php
                        
                        if (!empty($all_users)) {
                            foreach ($all_users as $user) {
                                ?>
                                <option value="<?= $user->user_id ?>" <?php
                                if (!empty($deals->user_id)) {
                                    $user_id = json_decode($deals->user_id);
                                    if (in_array($user->user_id, $user_id)) {
                                        echo 'selected';
                                    }
                                }
                                ?>>
                                    <?= $user->fullname
                                    . (!empty($user->employment_id) ? ' (' . ($user->employment_id) . ')' : '') ?></option>
                                ?>
                                </option>
                            <?php }
                        } ?>
                    </select>
                
                </div>
            </div>
            
            <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?= lang('tags') ?> <span class="required">*</span></label>
                
                <div class="col-sm-8">
                    <input type="text" name="tags" data-role="tagsinput" class="form-control" value="<?php
                    if (!empty($deals->tags)) {
                        echo $deals->tags;
                    }
                    ?>">
                </div>
            </div>
            <!--hidden input values -->
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-2">
                    <button type="submit" id="file-save-button"
                            class="btn btn-primary btn-block"><?= lang('save') ?></button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    <?php
    if (!empty($deals->id)) { ?>
    $(document).ready(function () {
        var pipeline_id = '<?= $deals->pipeline ?>';
        var stage_id = '<?= $deals->stage_id ?>';
        get_related_stages(pipeline_id, stage_id)
    });
    <?php  }
    ?>

    function get_related_stages(id, stage_id = null) {
        $.ajax({
            async: false,
            url: base_url + "/admin/deals/getStateByID/" + id + '/' + stage_id,
            type: 'get',
            dataType: "json",
            success: function (data) {
                init_selectpicker();
                $('#pipelineStages').html(data);
                if (id == 0) {
                    $('.pipelineStages').hide(data);
                }
            }
        });
    }

    function init_selectpicker() {

        $('body').find('select.selectpicker').not('.ajax-search').selectpicker({
            showSubtext: true,
        });
    }
</script>