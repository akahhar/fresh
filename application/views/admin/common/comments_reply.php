<?php
if (!empty($comment_reply_details)) {
    foreach ($comment_reply_details as $v_reply) {
        ?><div id="<?php echo $comment_type . "-reply-comment-form-container-" . $v_reply->task_comment_id ?>"> <div class="col-sm-1"></div> <div class="mb-mails col-sm-11"><img alt="Mail Avatar" src="<?php echo base_url() . $v_reply->avatar ?>" class="mb-mail-avatar pull-left"> <div class="mb-mail-date pull-right"><?= time_ago($v_reply->comment_datetime) ?>
                    <?php if ($v_reply->user_id == $this->session->userdata('user_id')) { ?>
                        <?php echo ajax_anchor(base_url("admin/common/delete_comments/" . $v_reply->task_comment_id), "<i class='text-danger fa fa-trash-o'></i>", array("class" => "", "title" => lang('delete'), "data-fade-out-on-success" => "#" . $comment_type . "-reply-comment-form-container-" . $v_reply->task_comment_id)); ?>
                    <?php } ?>
                </div>
                <div class="mb-mail-meta">
                    <div class="pull-left">
                        <div class="mb-mail-from"><a
                                href="<?= base_url() ?>admin/user/user_details/<?= $v_reply->user_id ?>"> <?= ($v_reply->fullname) ?></a>
                        </div>
                    </div>
                    <div
                        class="mb-mail-preview"><?php if (!empty($v_reply->comment)) echo $v_reply->comment; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php }
}
?>