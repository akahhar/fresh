<style>
    .selectpicker, .select_box {
        width: 100% !important;
    }
</style>
<?= message_box('success'); ?>
<?= message_box('error');
$created = can_action_by_label('workplace', 'created');
$edited = can_action_by_label('workplace', 'edited');
?>
<?php if (!empty($created) || !empty($edited)) {
    if (!empty($shift_info)) {
        $shift_id = $shift_info->shift_id;
    } else {
        $shift_id = null;
    }
    ?>
    <div class="nav-tabs-custom">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs">
            <li class="<?= $active == 1 ? 'active' : ''; ?>"><a
                        href="<?= base_url('admin/shift/manage') ?>"><?= lang('manage_shift') ?></a></li>
            <li class="<?= $active == 2 ? 'active' : ''; ?>"><a
                        href="<?= base_url('admin/shift/create') ?>"><?= lang('new_shift') ?></a></li>
        </ul>
        <div class="tab-content bg-white">
            
            <div class="tab-pane <?= $active == 2 ? 'active' : ''; ?>" id="create">
                <?php echo form_open(base_url('admin/shift/save_shift/' . $shift_id), array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'data-parsley-validate' => '', 'role' => 'form')); ?>
                <div class="form-group">
                    <label class="col-lg-3 col-md-3 col-sm-4 control-label"><?= lang('shift_name') ?> <span
                                class="text-danger">*</span></label>
                    <div class="col-lg-6 col-md-6 col-sm-7">
                        <input type="text" class="form-control" value="<?php
                        if (!empty($shift_info)) {
                            echo $shift_info->shift_name;
                        }
                        ?>" name="shift_name" required="">
                    </div>
                
                </div>
                <!-- End discount Fields -->
                <div class="form-group terms">
                    <label class="col-lg-3 col-md-3 col-sm-4 control-label"><?= lang('start_time') ?> </label>
                    <div class="col-lg-2">
                        <div class="input-group">
                            <input type="text" name="start_time" value="<?php
                            if (!empty($shift_info)) {
                                echo $shift_info->start_time;
                            }
                            ?>" placeholder="<?= lang('start_time') ?>" class="form-control timepicker">
                            <div class="input-group-addon">
                                <a href="#"><i class="fa fa-clock-o"></i></a>
                            </div>
                        </div>
                    </div>
                    <label class="col-lg-2 control-label"><?= lang('end_time') ?> </label>
                    <div class="col-lg-2 col-md-5 col-sm-7">
                        <div class="input-group">
                            <input type="text" name="end_time" value="<?php
                            if (!empty($shift_info)) {
                                echo $shift_info->end_time;
                            }
                            ?>" placeholder="<?= lang('end_time') ?>" class="form-control timepicker">
                            <div class="input-group-addon">
                                <a href="#"><i class="fa fa-clock-o"></i></a>
                            </div>
                        </div>
                    </div>
                </div> <!-- End discount Fields -->
                
                <div class="form-group terms">
                    <label class="col-lg-3 control-label"><?= lang('shift_before_start') ?> </label>
                    <div class="col-lg-2">
                        <div class="input-group">
                            <input type="text" name="shift_before_start" value="<?php
                            if (!empty($shift_info)) {
                                echo $shift_info->shift_before_start;
                            }
                            ?>" placeholder="<?= lang('shift_before_start') ?>" class="form-control">
                            <div class="input-group-addon">
                                <a href="#"><i class="fa fa-clock-o"></i><?= lang('minutes') ?></a>
                            </div>
                        </div>
                    </div>
                    
                    <label class="col-lg-2 control-label"><?= lang('shift_after_end') ?> </label>
                    <div class="col-lg-2">
                        <div class="input-group">
                            <input type="text" name="shift_after_end" value="<?php
                            if (!empty($shift_info)) {
                                echo $shift_info->shift_after_end;
                            }
                            ?>" placeholder="<?= lang('shift_after_end') ?>" class="form-control">
                            <div class="input-group-addon">
                                <a href="#"><i class="fa fa-clock-o"></i><?= lang('minutes') ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group terms">
                    <label class="col-lg-3 control-label"><?= lang('lunch_time') ?> </label>
                    <div class="col-lg-6">
                        <div class="input-group">
                            <input type="text" name="lunch_time" value="<?php
                            if (!empty($shift_info)) {
                                echo $shift_info->lunch_time;
                            }
                            ?>" placeholder="<?= lang('lunch_time_placeholder') ?>" class="form-control">
                            <div class="input-group-addon">
                                <a href="#"><i class="fa fa-clock-o"></i><?= lang('minutes') ?></a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php if (empty($shift_info)) { ?>
                    <div class="form-group terms">
                        <label class="col-lg-3 col-md-3 col-sm-4 control-label"><?= lang('start_date') ?> </label>
                        <div class="col-lg-2">
                            <div class="input-group">
                                <input type="text" name="start_date" value="<?php
                                if (!empty($shift_info)) {
                                    echo $shift_info->start_date;
                                }
                                ?>" placeholder="<?= lang('start_date') ?>" class="form-control datepicker">
                                <div class="input-group-addon">
                                    <a href="#"><i class="fa fa-calendar"></i></a>
                                </div>
                            </div>
                        </div>
                        <label class="col-lg-2 control-label"><?= lang('end_date') ?> </label>
                        <div class="col-lg-2 col-md-5 col-sm-7">
                            <div class="input-group">
                                <input type="text" name="end_date" id="end_date" value="<?php
                                if (!empty($shift_info)) {
                                    echo $shift_info->end_date;
                                }
                                ?>" placeholder="<?= lang('end_date') ?>" class="form-control datepicker">
                                <div class="input-group-addon">
                                    <a href="#"><i class="fa fa-calendar"></i></a>
                                </div>
                            </div>
                        </div>
                    </div> <!-- End discount Fields -->
                    <div class="form-group">
                        <label for="field-1"
                               class="col-sm-3 control-label"><?= lang('employee') . ' ' . lang('name') ?></label>
                        
                        <div class="col-sm-6">
                            <select class="by_employee form-control selectpicker" id="teamPositionFilter"
                                    data-live-search="true" multiple name="user_id[]">
                                <?php
                                $all_employee = $this->shift_model->get_all_employee();
                                if (!empty($all_employee)) : ?>
                                    <?php foreach ($all_employee as $dept_name => $v_all_employee) : ?>
                                        <optgroup label="<?php echo $dept_name; ?>">
                                            <?php if (!empty($v_all_employee)) : foreach ($v_all_employee as $v_employee) : ?>
                                                <option value="<?php echo $v_employee->user_id; ?>" <?php
                                                if (!empty($shift_info->user_id)) {
                                                    $userID = json_decode($shift_info->user_id);
                                                    if (in_array($v_employee->user_id, $userID)) {
                                                        echo 'selected';
                                                    }
                                                }
                                                ?>><?php echo $v_employee->fullname . ' ( ' . $v_employee->designations . ' )' ?></option>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </optgroup>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                <?php } ?>
                <!-- End discount Fields -->
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?= lang('status') ?></label>
                    
                    <div class="col-sm-9 row">
                        <div class="col-sm-2">
                            <div class="checkbox-inline c-checkbox">
                                <label>
                                    <input <?= (!empty($shift_info->status) && $shift_info->status == 'published' || empty($shift_info) ? 'checked' : ''); ?>
                                            class="select_one" type="checkbox" name="status" value="published">
                                    <span class="fa fa-check"></span> <?= lang('published') ?>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="checkbox-inline c-checkbox">
                                <label>
                                    <input <?= (!empty($shift_info->status) && $shift_info->status == 'unpublished' ? 'checked' : ''); ?>
                                            class="select_one" type="checkbox" name="status" value="unpublished">
                                    <span class="fa fa-check"></span> <?= lang('unpublished') ?>
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="checkbox-inline c-checkbox">
                                <label>
                                    <input <?= (!empty($shift_info->recurring) && $shift_info->recurring == 'Yes' ? 'checked' : ''); ?>
                                            type="checkbox" name="recurring" value="Yes" id="recurring">
                                    <span class="fa fa-check"></span> <?= lang('recurring') ?>
                                </label>
                            </div>
                        </div>
                        
                        <div id="recurring_data" <?php echo(!empty($shift_info) && $shift_info->recurring != 'Yes' || empty($shift_info) ? 'style="display:none"' : '') ?>>
                            <label class=" col-lg-2 control-label"><?php echo lang('repeat_every'); ?></label>
                            <div class="col-lg-3">
                                <div class="">
                                    <div class="input-group">
                                        <?php $value = (isset($shift_info->repeat_every) ? $shift_info->repeat_every : 1); ?>
                                        <input type="number" name="repeat_every" class="form-control"
                                               value="<?= $value ?>">
                                        <div class="input-group-addon p0 b0">
                                            <select name="recurring_type" class="selectpicker" data-width="100%"
                                                    data-none-selected-text="<?php echo lang('none'); ?>">
                                                <option value="week" <?php if (isset($shift_info->recurring_type) && $shift_info->recurring_type == 'week') {
                                                    echo 'selected';
                                                } ?>><?php echo lang('weeks'); ?></option>
                                                <option value="month" <?php if (isset($shift_info->recurring_type) && $shift_info->recurring_type == 'month') {
                                                    echo 'selected';
                                                } ?>><?php echo lang('months'); ?></option>
                                                <option value="year" <?php if (isset($shift_info->recurring_type) && $shift_info->recurring_type == 'year') {
                                                    echo 'selected';
                                                } ?>>
                                                    <?php echo lang('years'); ?></option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 col-md-3 col-sm-4 control-label"></label>
                    <div class="col-lg-5 col-md-5 col-sm-7">
                        <button type="submit" class="btn btn-sm btn-primary"><?= lang('create_shift') ?></button>
                    </div>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        (function ($) {
            "use strict";
            initRecurring();

            $('#recurring').click(function () {
                initRecurring();
            });

            function initRecurring() {
                $('#recurring_data').hide();
                $('#end_date').attr('disabled', false);
                if ($('#recurring').is(':checked')) {
                    $('#recurring_data').show();
                    $('#end_date').attr('disabled', true);
                }
            }
        })(jQuery);
    </script>
<?php } ?>