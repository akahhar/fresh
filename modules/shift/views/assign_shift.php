<style>
    .selectpicker, .select_box {
        width: 100% !important;
    }
</style>
<?php
$created = can_action_by_label('shift_mapping', 'created');
$edited = can_action_by_label('shift_mapping', 'edited');
$deleted = can_action_by_label('shift_mapping', 'deleted');
if (!empty($created) || !empty($edited)) {
    if (!empty($mapping_info)) {
        $shift_mapping_id = $mapping_info->shift_mapping_id;
        $url = base_url('admin/shift/update_shift/' . $shift_mapping_id . '/' . $mapping_info->user_id);
    } else {
        $shift_mapping_id = null;
        $url = base_url('admin/shift/assign_shift/' . $shift_mapping_id);
    }
    ?>
    <div class="nav-tabs-custom">
    <!-- Tabs within a box -->
    <ul class="nav nav-tabs">
        <li class="<?= $active == 1 ? 'active' : ''; ?>"><a
                    href="<?= base_url('admin/shift/shift_mapping') ?>"><?= lang('shift_mapping') ?></a></li>
        <li class="<?= $active == 2 ? 'active' : ''; ?>"><a
                    href="<?= base_url('admin/shift/assignShift') ?>"><?= lang('assign_shift') ?></a></li>
    </ul>
    <div class="tab-content bg-white">
        
        <div class="tab-pane <?= $active == 2 ? 'active' : ''; ?>" id="create">
            <?php echo form_open($url, array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'data-parsley-validate' => '', 'role' => 'form')); ?>
            <?php
            if (!empty($mapping_info)) { ?>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?= lang('employee') ?>
                        <span class="required"> *</span></label>
                    <div class="col-sm-5">
                        <input type="text" readonly value="<?php
                        if (!empty($mapping_info)) {
                            echo fullname($mapping_info->user_id);
                        }
                        ?>" class="form-control b0">
                        
                        <input type="hidden" name="user_id" value="<?php
                        if (!empty($mapping_info)) {
                            echo $mapping_info->user_id;
                        }
                        ?>" class="form-control">
                    </div>
                </div>
            <?php } else { ?>
                <div class="form-group">
                    <label for="field-1" class="col-sm-3 control-label"><?= lang('employee') . ' ' . lang('name') ?>
                        <span class="required"> *</span></label>
                    
                    <div class="col-sm-5">
                        <select class="by_employee form-control selectpicker" multiple
                                name="user_id[]">
                            <option value=""><?= lang('select_employee') ?>...</option>
                            <?php
                            $all_employee = $this->shift_model->get_all_employee();
                            if (!empty($all_employee)) : ?>
                                <?php foreach ($all_employee as $dept_name => $v_all_employee) : ?>
                                    <optgroup label="<?php echo $dept_name; ?>">
                                        <?php if (!empty($v_all_employee)) : foreach ($v_all_employee as $v_employee) : ?>
                                            <option value="<?php echo $v_employee->user_id; ?>" <?php
                                            if (!empty($mapping_info->user_id)) {
                                                echo $v_employee->user_id == $mapping_info->user_id ? 'selected' : '';
                                            }
                                            ?>>
                                                <?php echo $v_employee->fullname . ' ( ' . $v_employee->designations . ' )' ?></option>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </optgroup>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <script type="text/javascript">
                    (function ($) {
                        "use strict";
                        $('select[name="shift_id"]').on('change', function () {
                            var shift_id = $(this).val();
                            $.ajax({
                                url: '<?= base_url('admin/shift/getShiftInfo/') ?>' + shift_id,
                                type: "GET",
                                dataType: "json",
                                success: function (data) {
                                    $('#end_date').attr('disabled', false);
                                    if (data.error) {
                                        console.log(data.error)
                                    } else if (data.recurring == 'Yes') {
                                        $('#end_date').attr('disabled', true);
                                    } else {
                                        $('#end_date').attr('disabled', false);
                                    }
                                }
                            });
                        });
                    })(jQuery);
                </script>
            <?php } ?>
            <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?= lang('select') . ' ' . lang('shift_name') ?>
                    <span class="required"> *</span></label>
                <div class="col-sm-5">
                    <select class="by_employee form-control select_box" name="shift_id">
                        <option value=""><?= lang('select') . ' ' . lang('shift_name') ?>...</option>
                        <?php
                        $all_shift = get_result('tbl_shift', array('status' => 'published'));
                        if (!empty($all_shift)) : ?>
                            <?php foreach ($all_shift as $v_shift) : ?>
                                <option value="<?php echo $v_shift->shift_id; ?>" <?php
                                if (!empty($mapping_info->shift_id)) {
                                    echo $v_shift->shift_id == $mapping_info->shift_id ? 'selected' : '';
                                }
                                ?>>
                                    <?php echo $v_shift->shift_name ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <!-- End discount Fields -->
            <div class="form-group terms">
                <label class="col-lg-3 col-md-3 col-sm-4 control-label"><?= lang('start_date') ?> </label>
                <div class="col-lg-5 col-md-5 col-sm-7">
                    <div class="input-group">
                        <input type="text" name="start_date" value="<?php
                        if (!empty($mapping_info)) {
                            echo $mapping_info->start_date;
                        }
                        ?>" placeholder="<?= lang('start_date') ?>" class="form-control datepicker">
                        <div class="input-group-addon">
                            <a href="#"><i class="fa fa-calendar-o"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End discount Fields -->
            <div class="form-group terms" id="rend_date">
                <label class="col-lg-3 col-md-3 col-sm-4 control-label"><?= lang('end_date') ?> </label>
                <div class="col-lg-5 col-md-5 col-sm-7">
                    <div class="input-group">
                        <input type="text" <?= (!empty($mapping_info) && $mapping_info->recurring == 'Yes' ? 'readonly disabled' : '') ?>
                               name="end_date" id="end_date" value="<?php
                        if (!empty($mapping_info)) {
                            echo $mapping_info->end_date;
                        }
                        ?>" placeholder="<?= lang('end_date') ?>" class="form-control datepicker">
                        <div class="input-group-addon">
                            <a href="#"><i class="fa fa-calendar-o"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 col-md-3 col-sm-4 control-label"></label>
                <div class="col-lg-5 col-md-5 col-sm-7">
                    <?php
                    if (!empty($mapping_info)) { ?>
                        <button type="submit" class="btn btn-sm btn-primary"><?= lang('update') ?></button>
                    <?php } else {
                        ?>
                        <button type="submit" class="btn btn-sm btn-primary"><?= lang('assign_shift') ?></button>
                    <?php }
                    ?>
                
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    
    <script type="text/javascript">
        (function ($) {
            "use strict";
            $('#recurring').click(function () {
                $('#recurring_data').toggle();
                $('#rend_date').toggle();
            });
        })(jQuery);
    </script>
<?php } ?>