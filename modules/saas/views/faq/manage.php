<?= message_box('success'); ?>
<?= message_box('error');
$deleted = can_action('155', 'deleted');
?>

<div class="panel panel-custom" style="border: none;" data-collapsed="0">
    <div class="panel-heading">
        <div class="panel-title">
            <?php
            echo lang('faq');
            $unread_email = total_rows('tbl_saas_front_contact_us', array('view_status' => 0));
            echo ' (' . $unread_email . ')';
            ?>
        </div>
    </div>

    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped DataTables " id="DataTables" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th><?= lang('subject') ?></th>
                    <th><?= lang('name') ?></th>
                    <th><?= lang('email') ?></th>
                    <th><?= lang('phone') ?></th>
                    <th width="60" class="col-options no-sort"><?= lang('action') ?></th>
                </tr>
                </thead>
                <tbody>
                <script type="text/javascript">
                    $(document).ready(function () {
                        list = base_url + "saas/faq/faqList";
                    });
                </script>
                </tbody>
            </table>
        </div>
    </div>
</div>