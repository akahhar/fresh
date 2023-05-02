<?php include_once 'assets/admin-ajax.php'; ?>

<?= message_box('success'); ?>
<?= message_box('error');
$created = super_admin_access('24', 'created');
$edited = super_admin_access('24', 'edited');
$deleted = super_admin_access('24', 'deleted');
if (!empty($created) || !empty($edited)) {
?>
<div class="nav-tabs-custom">
    <!-- Tabs within a box -->
    <ul class="nav nav-tabs">
        <li class="<?= $active == 1 ? 'active' : ''; ?>"><a
                    href="<?= base_url('saas/super_admin') ?>"><?= lang('all_users') ?></a></li>
        <li class="<?= $active == 2 ? 'active' : ''; ?>"><a
                    href="<?= base_url('saas/super_admin/create') ?>"><?= lang('new_user') ?></a>
        </li>
    </ul>
    <div class="tab-content bg-white">
        <!-- ************** general *************-->
        <div class="tab-pane <?= $active == 1 ? 'active' : ''; ?>" id="manage">
            <?php } else { ?>
            <div class="panel panel-custom">
                <header class="panel-heading ">
                    <div class="panel-title"><strong><?= lang('all_users') ?></strong></div>
                </header>
                <?php } ?>
                <table class="table table-striped DataTables " id="DataTables" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="col-sm-1"><?= lang('photo') ?></th>
                        <th><?= lang('name') ?></th>
                        <th class="col-sm-2"><?= lang('username') ?></th>
                        <th class="col-sm-1"><?= lang('active') ?></th>
                        <th class="col-sm-2"><?= lang('action') ?></th>

                    </tr>
                    </thead>
                    <tbody>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            list = base_url + "saas/super_admin/userList";
                        });
                    </script>
                    </tbody>
                </table>
            </div>
        </div>
    </div>