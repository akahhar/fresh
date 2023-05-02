<?= message_box('success'); ?>
<?= message_box('error');
$deleted = can_action('155', 'deleted');
?>

<div class="panel panel-custom" style="border: none;" data-collapsed="0">
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                    class="sr-only">Close</span></button>
        <div class="panel-title">
            <?= lang('view') . ' ' . lang('email') ?>
        </div>
    </div>

    <div class="panel-body">
        <?php
        if (!empty($email_info)) { ?>

            <p><strong>Subject: </strong><strong><?php echo $email_info->subject; ?></strong></p>
            <p><strong>Name</strong>: <?php echo $email_info->name; ?></p>
            <p><strong>Email: </strong><a
                        href="mailto:<?php echo $email_info->email; ?>"><?php echo $email_info->email; ?></a></p>
            <p><strong>Phone: </strong><a
                        href="tel::<?php echo $email_info->phone; ?>"><?php echo $email_info->phone; ?></a></p>
            <p><strong>Message: </strong></p>
            <?php echo $email_info->description; ?>


        <?php } ?>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('close') ?></button>
    </div>
</div>