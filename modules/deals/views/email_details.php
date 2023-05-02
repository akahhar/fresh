<div class="panel panel-custom">
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><?= $title ?></h4>
    </div>
    <div class="modal-body wrap-modal wrap">
        <div class="panel-body form-horizontal">
            <div class="col-md-12 notice-details-margin">
                <div class="col-sm-4 text-right">
                    <label class="control-label"><strong><?= lang('mail_to') ?> :</strong></label>
                </div>
                <div class="col-sm-8">
                    <p class="form-control-static"><?php
                                                    $file_ext = explode(";", $details->email_to);
                                                    foreach ($file_ext as $key => $email) {
                                                        echo $email . "<br>";
                                                    }
                                                    ?></p>
                </div>
            </div>
            <div class="col-md-12 notice-details-margin">
                <div class="col-sm-4 text-right">
                    <label class="control-label"><strong><?= lang('subject') ?> :</strong></label>
                </div>
                <div class="col-sm-8">
                    <p class="form-control-static"><?php if (!empty($details->subject)) echo $details->subject; ?></p>
                </div>
            </div>
            <div class="col-md-12 notice-details-margin">
                <div class="col-sm-4 text-right">
                    <label class="control-label"><strong><?= lang('mail_from') ?> :</strong></label>
                </div>
                <div class="col-sm-8">
                    <p class="form-control-static"><?php if (!empty($details->email_from)) echo $details->email_from; ?></p>
                </div>
            </div>
            <div class="col-md-12 notice-details-margin">
                <div class="col-sm-4 text-right">
                    <label class="control-label"><strong><?= lang('message_time') ?> :</strong></label>
                </div>
                <div class="col-sm-8">
                    <p class="form-control-static"><?php if (!empty($details->message_time)) echo display_date($details->message_time, true); ?></p>
                </div>
            </div>

            <div class="col-md-12 notice-details-margin">
                <div class="col-sm-4 text-right">
                    <label class="control-label"><strong><?= lang('message_body') ?> :</strong></label>
                </div>
                <div class="col-sm-8">
                    <p class="form-control-static"><?php
                                                    if (!empty($details->message_body)) {
                                                        echo $details->message_body;
                                                    }
                                                    ?></p>
                </div>
            </div>
            <div class="col-md-12 notice-details-margin">
                <div class="col-sm-4 text-right">
                    <label class="control-label"><strong><?= lang('attach_file') ?> :</strong></label>
                </div>
                <div class="col-sm-8">
                    <ul class="mailbox-attachments clearfix mt">
                        <?php
                        $uploaded_file = json_decode($details->attach_file);
                        if (!empty($uploaded_file)) :
                            foreach ($uploaded_file as $fkey => $v_files) :
                                if (!empty($v_files)) :
                        ?>
                                    <li>
                                        <?php if (!empty($v_files->is_image) && $v_files->is_image == 1) : ?>
                                            <span class="mailbox-attachment-icon has-img"><img src="<?= base_url() . $v_files->path ?>" alt="Attachment"></span>
                                        <?php else : ?>
                                            <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i></span>
                                        <?php endif; ?>
                                        <div class="mailbox-attachment-info">
                                            <a target="_blank" href="<?php echo base_url() . $details->attach_file; ?>" class="mailbox-attachment-name"><i class="fa fa-paperclip"></i>
                                                <?= $v_files->fileName ?></a>
                                            <span class="mailbox-attachment-size">
                                                <?= $v_files->size ?> <?= lang('kb') ?>
                                                <a href="<?= base_url() ?>admin/deals/download_file/<?= $fkey ?>" class="btn btn-default btn-xs pull-right"><i class="fa fa-cloud-download"></i></a>
                                            </span>
                                        </div>
                                    </li>
                        <?php
                                endif;
                            endforeach;
                        endif;
                        ?>
                    </ul>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('close') ?></button>
            </div>
        </div>
    </div>
</div>