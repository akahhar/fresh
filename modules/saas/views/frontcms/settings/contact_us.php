<?php
echo message_box('success');
echo message_box('error');
$edited = can_action_by_label('contacts', 'edited');
$deleted = can_action_by_label('contacts', 'deleted');
?>

<div class="panel panel-custom">
    <!-- Start Form -->
    <header class="panel-heading"><?= lang('contacts') ?>
    </header>
    <div class="panel-body pb-sm">
        <div class="table-responsive">
            <table class="table table-striped DataTables " id="DataTables" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th><?= lang('name') ?></th>
                    <th><?= lang('email') ?></th>
                    <th><?= lang('phone') ?></th>
                    <th><?= lang('subject') ?></th>
                    <th class="col-options no-sort"><?= lang('action') ?></th>
                </tr>
                </thead>
                <tbody>
                <script type="text/javascript">
                    $(document).ready(function () {
                        list = base_url + "saas/frontcms/contacts/contactsList";
                    });
                </script>
                </tbody>
            </table>
        </div>
    </div>
</div>

