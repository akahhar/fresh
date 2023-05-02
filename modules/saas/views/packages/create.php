<?php
if (!empty($package_info)) {
    $id = $package_info->id;
} else {
    $id = null;
}
echo form_open(base_url('saas/packages/save_packages/' . $id), array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'data-parsley-validate' => '', 'role' => 'form')); ?>
<div class="nav-tabs-custom">
    <!-- Tabs within a box -->
    <ul class="nav nav-tabs">
        <li class="<?= $active == 1 ? 'active' : ''; ?>"><a
                    href="<?= base_url('saas/packages') ?>"><?= lang('all') . ' ' . lang('packages') ?></a>
        </li>
        <li class="<?= $active == 2 ? 'active' : ''; ?>"><a
                    href="<?= base_url('saas/packages/create') ?>"><?= lang('new') . ' ' . lang('packages') ?></a>
        </li>
        <li class="pull-right">
            <button type="submit" class="btn btn-sm btn-primary mt-sm"><?= lang('save_changes') ?></button>
        </li>
    </ul>
    <div class="tab-content bg-white">
        <div class="tab-pane <?= $active == 2 ? 'active' : ''; ?>" id="create">
            <div class="row mb-lg ">

                <div class="col-lg-6 col-md-6 br pv">
                    <div class="row">
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?= lang('name') ?>
                                <span class="required">*</span></label>

                            <div class="col-sm-8">
                                <input required type="text" name="name"
                                       placeholder="<?= lang('enter') . ' ' . lang('name') ?>"
                                       class="form-control" value="<?php
                                if (!empty($package_info->name)) {
                                    echo $package_info->name;
                                }
                                ?>"/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?= lang('amount') ?>
                                <span class="required">*</span></label>

                            <div class="col-sm-3">
                                <input required data-parsley-type="number" type="text"
                                       name="monthly_price"
                                       placeholder="<?= lang('saas_price_placeholder') ?>"
                                       class="form-control"
                                       value="<?php
                                       if (!empty($package_info->monthly_price)) {
                                           echo $package_info->monthly_price;
                                       }
                                       ?>"/>
                            </div>
                            <div class="col-sm-3">
                                <input required data-parsley-type="number" type="text"
                                       name="quarterly_price"
                                       placeholder="<?= lang('monthly') ?>"
                                       class="form-control"
                                       value="<?php
                                       if (!empty($package_info->quarterly_price)) {
                                           echo $package_info->quarterly_price;
                                       }
                                       ?>"/>
                            </div>

                            <div class="col-sm-2">
                                <input required data-parsley-type="number" type="text"
                                       name="yearly_price"
                                       placeholder="<?= lang('yearly') ?>"
                                       class="form-control"
                                       value="<?php
                                       if (!empty($package_info->yearly_price)) {
                                           echo $package_info->yearly_price;
                                       }
                                       ?>"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?= lang('trial_period') ?></label>

                            <div class="col-sm-8">
                                <input required type="text" name="trial_period"
                                       placeholder="<?= lang('enter') . ' ' . lang('name') ?>"
                                       class="form-control" value="<?php
                                if (!empty($package_info->trial_period)) {
                                    echo $package_info->trial_period;
                                }
                                ?>"/>
                            </div>
                        </div>
                        <?php
                        if (empty($package_info)) {
                            $package_info = '';
                        }
                        echo saas_packege_field('text', $package_info);
                        ?>
                    </div>

                </div>
                <div class="col-lg-6 col-md-6 br pv">
                    <div class="row">
                        <?php
                        echo saas_packege_field('checkbox', $package_info);
                        ?>
                        <div class="form-group">
                            <label for="field-1"
                                   class="col-lg-3 col-md-6 col-sm-6 control-label"><?= lang('recommended') ?></label>
                            <div class="col-lg-8 col-md-6 col-sm-6">
                                <div class="checkbox c-checkbox">
                                    <label class="needsclick">
                                        <input type="checkbox" value="Yes"
                                            <?php if (!empty($package_info) && $package_info->recommended == 'Yes') {
                                                echo 'checked';
                                            } ?> name="recommended">
                                        <span class="fa fa-check"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1"
                                   class="col-sm-3 control-label"><?= lang('status') ?></label>

                            <div class="col-sm-3">
                                <div class="checkbox-inline c-checkbox">
                                    <label>
                                        <input
                                            <?= (!empty($package_info->status) && $package_info->status == 'published' || empty($package_info) ? 'checked' : ''); ?>
                                                class="select_one" type="checkbox" name="status" value="published">
                                        <span class="fa fa-check"></span> <?= lang('published') ?>
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="checkbox-inline c-checkbox">
                                    <label>
                                        <input
                                            <?= (!empty($package_info->status) && $package_info->status == 'unpublished' ? 'checked' : ''); ?>
                                                class="select_one" type="checkbox" name="status" value="unpublished">
                                        <span class="fa fa-check"></span> <?= lang('unpublished') ?>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-xs-12 ">
                    <div class="row">
                        <label class="col-lg-1 control-label"><?= lang('description') ?> </label>
                        <div class="col-lg-11">
                        <textarea name="description" class="textarea_lg"><?php
                            if (!empty($package_info)) {
                                echo $package_info->description;
                            }
                            ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo form_close(); ?>
<script type="text/javascript">
    // click to generate packages code and random string
    $(document).ready(function () {
        $('#gen_packages').click(function () {
            // generate packages code randomly
            var text = "";
            var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
            for (var i = 0; i < 8; i++)
                text += possible.charAt(Math.floor(Math.random() * possible.length));
            $('#packages_code').val(text);
        });
    })
</script>
