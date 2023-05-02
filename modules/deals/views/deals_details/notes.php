<style>
    .note-editor .note-editable {
        height: 150px;
    }
</style>


<div class="panel panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title"><?= lang('notes') ?></h3>
    </div>
    <div class="panel-body">

        <form action="<?= base_url() ?>admin/deals/save_deals_notes/<?php
                                                                    if (!empty($deals_details)) {
                                                                        echo $deals_details->id;
                                                                    }
                                                                    ?>" enctype="multipart/form-data" method="post" id="form" class="form-horizontal">
            <div class="form-group">
                <div class="col-lg-12">
                    <textarea class="form-control textarea" name="notes"><?= $deals_details->notes ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-2">
                    <button type="submit" id="sbtn" class="btn btn-primary"><?= lang('updates') ?></button>
                </div>
            </div>
        </form>
    </div>
</div>