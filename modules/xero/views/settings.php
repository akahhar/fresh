<div class="row">
    <div class="col-md-12">
        <?php
        echo message_box('success');
        echo message_box('error');

        ?>
        <div class="panel panel-custom">
            <header class="panel-heading ">
                <?= $title ?>
            </header>
            <form method="post" id="lead_statuss" action="<?= base_url() ?>admin/xero/settings/" class="form-horizontal"
                  data-parsley-validate="" novalidate="">
                <div class="form-group">
                    <div class="col-lg-3">
                    </div>
                    <div class="col-lg-5">
                        <?php
                        $form_error = $this->session->userdata('form_error');
                        if (!empty($form_error)) { ?>
                            <div class="alert alert-danger"><?= $form_error ?></div>
                        <?php }
                        $this->session->unset_userdata('form_error');
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('client') . ' ' . lang('id') ?> <span
                                class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control"
                               value="<?= set_value('xero_client_id', config_item('xero_client_id')); ?>"
                               name="xero_client_id">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('client') . ' ' . lang('secret'); ?> <span
                                class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <input type="password" class="form-control"
                               value="<?= set_value('xero_client_secret', config_item('xero_client_secret')); ?>"
                               name="xero_client_secret">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('xero_sync_each_time'); ?> <span
                                class="text-danger">*</span></label>
                    <div class="col-lg-5">
                        <input type="text" class="form-control"
                               value="<?= set_value('xero_sync_each_time', (!empty(config_item('xero_sync_each_time')) ? config_item('xero_sync_each_time') : '10')); ?>"
                               name="xero_sync_each_time">
                    </div>
                </div>

                <div class="modal-footer">
                    <div class="col-lg-3">
                    </div>
                    <div class="col-lg-5">
                        <button type="submit" class="btn btn-sm btn-primary"><?= lang('save') ?></button>
                    </div>
                </div>
            </form>

        </div>

    </div>