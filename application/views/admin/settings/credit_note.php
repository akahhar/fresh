<?php echo message_box('success') ?>
<div class="row">
    <!-- Start Form -->
    <div class="col-lg-12">
        <form action="<?php echo base_url() ?>admin/settings/save_credit_note" enctype="multipart/form-data"
              class="form-horizontal" method="post">
            <div class="panel panel-custom">
                <header class="panel-heading  "><?= lang('credit_note_settings') ?></header>
                <div class="panel-body">
                    <input type="hidden" name="settings" value="<?= $load_setting ?>">
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?= lang('credit_note_prefix') ?> <span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-7">
                            <input type="text" name="credit_note_prefix" class="form-control" style="width:260px"
                                   value="<?= config_item('credit_note_prefix') ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?= lang('credit_note_start_no') ?> <span
                                    class="text-danger">*</span></label>
                        <div class="col-lg-7">
                            <input type="text" name="credit_note_start_no" class="form-control" style="width:260px"
                                   value="<?= config_item('credit_note_start_no') ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?= lang('credit_note') . ' ' . lang('number_format') ?></label>
                        <div class="col-lg-5">
                            <input type="text" name="credit_note_number_format" class="form-control" style="width:260px"
                                   value="<?php
                                   if (empty(config_item('credit_note_number_format'))) {
                                       echo '[' . config_item('credit_note_prefix') . ']' . '[yyyy][mm][dd][number]';
                                   } else {
                                       echo config_item('credit_note_number_format');
                                   } ?>">
                            <small>ex [<?= config_item('credit_note_prefix') ?>] = <?= lang('credit_note_prefix') ?>
                                ,[yyyy] =
                                'Current Year (<?= date('Y') ?>)'[yy] ='Current Year (<?= date('y') ?>)',[mm] =
                                'Current Month(<?= date('M') ?>)',[m] =
                                'Current Month(<?= date('m') ?>)',[dd] = 'Current Date (<?= date('d') ?>)',[number] =
                                'Invoice Number (<?= sprintf('%04d', config_item('credit_note_start_no')) ?>)'
                            </small>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?= lang('increment_credit_note_number') ?></label>
                        <div class="col-lg-6">
                            <div class="checkbox c-checkbox">
                                <label class="needsclick">
                                    <input type="hidden" value="off" name="increment_credit_note_number"/>
                                    <input type="checkbox" <?php
                                    if (config_item('increment_credit_note_number') == 'TRUE') {
                                        echo "checked=\"checked\"";
                                    }
                                    ?> name="increment_credit_note_number">
                                    <span class="fa fa-check"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?= lang('show_item_tax') ?></label>
                        <div class="col-lg-6">
                            <div class="checkbox c-checkbox">
                                <label class="needsclick">
                                    <input type="hidden" value="off" name="show_credit_note_tax"/>
                                    <input type="checkbox" <?php
                                    if (config_item('show_credit_note_tax') == 'TRUE') {
                                        echo "checked=\"checked\"";
                                    }
                                    ?> name="show_credit_note_tax">
                                    <span class="fa fa-check"></span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group terms">
                        <label class="col-lg-3 control-label"><?= lang('credit_note_terms') ?></label>
                        <div class="col-lg-9">
                            <textarea class="form-control textarea"
                                      name="credit_note_terms"><?= config_item('credit_note_terms') ?></textarea>
                        </div>
                    </div>
                    <div class="form-group terms">
                        <label class="col-lg-3 control-label"><?= lang('credit_note_footer') ?></label>
                        <div class="col-lg-9">
                        <textarea class="form-control textarea"
                                  name="credit_note_footer"><?= config_item('credit_note_footer') ?></textarea>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-3 control-label"></div>
                    <div class="col-lg-6">
                        <button type="submit" class="btn btn-sm btn-primary"><?= lang('save_changes') ?></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- End Form -->
</div>