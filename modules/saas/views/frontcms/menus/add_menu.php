<form action="<?= base_url() ?>saas/frontcms/menus/save_menu"
      enctype="multipart/form-data" method="post">
    <div class="panel panel-custom" data-collapsed="0">
        <div class="panel-heading">
            <div class="panel-title"><?= lang('add_menu') ?></div>
        </div>

        <div class="modal-body">
            <div class="form-group clearfix">
                <label for="" class="control-label"><?= lang('menu'); ?> <span class="required">*</span></label>
                <input type="text" name="menu" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="" class="control-label"><?= lang('description'); ?></label>
                <textarea name="description" class="form-control" rows="4"></textarea>
            </div>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('close') ?></button>
            <button type="submit" class="btn btn-primary"><?= lang('save') ?></button>
        </div>
    </div>
</form>
