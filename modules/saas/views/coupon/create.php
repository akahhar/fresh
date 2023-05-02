<div class="nav-tabs-custom">
    <!-- Tabs within a box -->
    <ul class="nav nav-tabs">
        <li class="<?= $active == 1 ? 'active' : ''; ?>"><a
                    href="<?= base_url('saas/coupon') ?>"><?= lang('all') . ' ' . lang('coupon') ?></a>
        </li>
        <li class="<?= $active == 2 ? 'active' : ''; ?>"><a
                    href="<?= base_url('saas/coupon/create') ?>"><?= lang('new') . ' ' . lang('coupon') ?></a>
        </li>
    </ul>
    <div class="tab-content bg-white">
        <div class="tab-pane <?= $active == 2 ? 'active' : ''; ?>" id="create">
            <?php
            if (!empty($coupon_info)) {
                $id = $coupon_info->id;
            } else {
                $id = null;
            }
            echo form_open(base_url('saas/coupon/save_coupon/' . $id), array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'data-parsley-validate' => '', 'role' => 'form')); ?>

            <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?= lang('name') ?>
                    <span class="required">*</span></label>

                <div class="col-sm-5">
                    <input required type="text" name="name"
                           placeholder="<?= lang('enter') . ' ' . lang('name') ?>"
                           class="form-control" value="<?php
                    if (!empty($coupon_info->name)) {
                        echo $coupon_info->name;
                    }
                    ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?= lang('code') ?>
                    <span class="required">*</span></label>

                <div class="col-sm-5">
                    <div class="input-group">
                        <input required type="text" id="coupon_code" name="code"
                               placeholder="<?= lang('enter') . ' ' . lang('code') ?>"
                               class="form-control" value="<?php
                        $this->load->helper('string');
                        if (!empty($coupon_info)) {
                            echo $coupon_info->code;
                        } else {
                            echo(random_string('alnum', 8));
                        }
                        ?>"/>
                        <div class="input-group-addon ">
                            <a href="#" id="gen_coupon" class="">
                                <i class="fa fa-refresh"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="field-1" class="col-sm-3 control-label"><?= lang('amount') ?>
                    <span class="required">*</span></label>

                <div class="col-sm-5">
                    <div class="input-group">
                        <input required data-parsley-type="number" type="text" name="amount"
                               placeholder="<?= lang('enter') . ' ' . lang('amount') ?>"
                               class="form-control br0" value="<?php
                        if (isset($coupon_info->amount)) {
                            echo $coupon_info->amount;
                        }
                        ?>"/>
                        <div class="input-group-addon p0 b0">
                            <select name="type" class="selectpicker" data-width="100%">
                                <option value="1" <?php
                                if (isset($coupon_info)) {
                                    if ($coupon_info->type == '1') {
                                        echo 'selected';
                                    }
                                } ?>><?php echo lang('percentage'); ?></option>
                                <option value="0" <?php if (isset($coupon_info)) {
                                    if ($coupon_info->type == '0') {
                                        echo 'selected';
                                    }
                                } ?>><?php echo lang('flat'); ?></option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label
                        class="col-lg-3 col-md-3 col-sm-3 control-label"><?= lang('end_date') ?></label>
                <div class="col-lg-5 col-md-5 col-sm-5">
                    <div class="input-group">
                        <input required type="text" name="end_date"
                               class="form-control datepicker"
                               value="<?php
                               if (!empty($coupon_info->end_date)) {
                                   echo $coupon_info->end_date;
                               } else {
                                   echo date('Y-m-d');
                               }
                               ?>" data-date-format="<?= config_item('date_picker_format'); ?>">
                        <div class="input-group-addon">
                            <a href="#"><i class="fa fa-calendar"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="discount_type"
                       class="control-label col-sm-3"><?= lang('select') . ' ' . lang('package') ?><span
                            class="required">*</span></label>
                <div class="col-sm-5">
                    <select name="pricing_id" class="selectpicker" data-width="100%">
                        <option value="0"><?= lang('all') . ' ' . lang('package') ?></option>
                        <?php
                        $all_pricing = get_order_by('tbl_saas_packages', null, 'sort', true);
                        if (!empty($all_pricing)) {
                            foreach ($all_pricing as $pricing) {
                                ?>
                                <option value="<?php echo $pricing->id; ?>" <?php
                                if (isset($coupon_info)) {
                                    if ($coupon_info->pricing_id == $pricing->id) {
                                        echo 'selected';
                                    }
                                } ?>><?php echo $pricing->name; ?></option>
                            <?php } ?>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="field-1"
                       class="col-sm-3 control-label"><?= lang('showing_on_pricing') ?></label>

                <div class="col-sm-2">
                    <div class="checkbox c-checkbox">
                        <label class="needsclick">
                            <input type="checkbox" value="Yes"
                                <?php if (!empty($coupon_info->show_on_pricing) && $coupon_info->show_on_pricing == 'Yes') {
                                    echo 'checked';
                                } ?>
                                   name="show_on_pricing"><span
                                    class="fa fa-check"></span>
                        </label>
                    </div>

                </div>

                <div class="col-sm-2">
                    <div class="checkbox-inline c-checkbox">
                        <label>
                            <input
                                <?= (!empty($coupon_info->status) && $coupon_info->status == 'active' || empty($coupon_info) ? 'checked' : ''); ?>
                                    class="select_one" type="checkbox" name="status" value="active">
                            <span class="fa fa-check"></span> <?= lang('active') ?>
                        </label>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="checkbox-inline c-checkbox">
                        <label>
                            <input
                                <?= (!empty($coupon_info->status) && $coupon_info->status == 'inactive' ? 'checked' : ''); ?>
                                    class="select_one" type="checkbox" name="status" value="inactive">
                            <span class="fa fa-check"></span> <?= lang('inactive') ?>
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="discount_type" class="control-label col-sm-3"></label>
                <div class="col-sm-4">
                    <button type="submit" id="sbtn" name="sbtn" value="1"
                            class="btn btn-block btn-success"><?= lang('save') ?></button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
<script type="text/javascript">
    // click to generate coupon code and random string
    $(document).ready(function () {
        $('#gen_coupon').click(function () {
            // generate coupon code randomly
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            for (var i = 0; i < 8; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));
            $('#coupon_code').val(text);
        });
    })
</script>
