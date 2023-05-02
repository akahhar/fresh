<?= message_box('success'); ?>
<?= message_box('error');
$created = can_action_by_label('manage_shift', 'created');
$edited = can_action_by_label('manage_shift', 'edited');
$deleted = can_action_by_label('manage_shift', 'deleted');
if (!empty($created) || !empty($edited)) {
?>
<div class="nav-tabs-custom">
    <!-- Tabs within a box -->
    <ul class="nav nav-tabs">
        <li class="<?= $active == 1 ? 'active' : ''; ?>"><a
                    href="<?= base_url('admin/shift/manage') ?>"><?= lang('manage_shift') ?></a></li>
        <li class="<?= $active == 2 ? 'active' : ''; ?>"><a
                    href="<?= base_url('admin/shift/create') ?>"><?= lang('new_shift') ?></a></li>
    </ul>
    <div class="tab-content bg-white">
        <!-- ************** general *************-->
        <div class="tab-pane <?= $active == 1 ? 'active' : ''; ?>" id="manage">
            <?php } else { ?>
            <div class="panel panel-custom">
                <header class="panel-heading ">
                    <div class="panel-title"><strong><?= lang('manage_shift') ?></strong></div>
                </header>
                <?php } ?>
                <div class="table-responsive">
                    <table class="table table-striped DataTables " id="DataTables" width="100%">
                        <thead>
                        <tr>
                            <th><?= lang('shift_name') ?></th>
                            <th><?= lang('start_time') ?></th>
                            <th><?= lang('end_time') ?></th>
                            <th><?= lang('status') ?></th>
                            <?php if (!empty($edited) || !empty($deleted)) { ?>
                                <th><?= lang('action') ?></th>
                            <?php } ?>
                        </tr>
                        </thead>
                        <tbody>
                        
                        </tbody>
                        <script type="text/javascript">
                            (function ($) {
                                "use strict";
                                list = base_url + "admin/shift/shiftList";
                            })(jQuery);
                        </script>
                    </table>
                </div>
            </div>
        </div>
    </div>