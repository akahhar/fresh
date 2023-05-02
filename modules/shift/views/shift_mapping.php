<style>
    .selectpicker, .select_box {
        width: 100% !important;
    }

    .pointer {
        cursor: pointer !important;
    }
</style>
<?= message_box('success'); ?>
<?= message_box('error');
$created = can_action_by_label('shift_mapping', 'created');
$edited = can_action_by_label('shift_mapping', 'edited');
$deleted = can_action_by_label('shift_mapping', 'deleted');
if (!empty($created) || !empty($edited)) {
?>
<div class="nav-tabs-custom">
    <!-- Tabs within a box -->
    <ul class="nav nav-tabs">
        <li class="<?= $active == 1 ? 'active' : ''; ?>"><a
                    href="<?= base_url('admin/shift/shift_mapping') ?>"><?= lang('shift_mapping') ?></a></li>
        <li class="<?= $active == 2 ? 'active' : ''; ?>"><a
                    href="<?= base_url('admin/shift/assignShift') ?>"><?= lang('assign_shift') ?></a></li>
        <div class="pull-right text-center h4 mr">
            <span class="fa fa-angle-left mr-sm pointer" id="previousMonth"></span>
            <span id="month" data-date="<?= date('M-Y') ?>"><?= date('F Y') ?></span>
            <span class="fa fa-angle-right ml-sm pointer" id="NextMonth"></span>
        </div>
    </ul>
    <div class="tab-content bg-white">
        <!-- ************** general *************-->
        <div class="tab-pane <?= $active == 1 ? 'active' : ''; ?>" id="manage">
            <?php } else { ?>
            <div class="panel panel-custom">
                <header class="panel-heading ">
                    <div class="panel-title"><strong><?= lang('shift_mapping') ?></strong>
                        <div class="pull-right text-center h4 mt0">
                            <span class="fa fa-angle-left mr-sm pointer" id="previousMonth"></span>
                            <span id="month" data-date="<?= date('M-Y') ?>"><?= date('F Y') ?></span>
                            <span class="fa fa-angle-right ml-sm pointer" id="NextMonth"></span>
                        </div>
                    </div>
                </header>
                <?php } ?>
                <script type="text/javascript">
                    (function ($) {
                        "use strict";
                        var current_date = $('#month').html();
                        var now = new Date(current_date);
                        var months = new Array("January", "February", "March", "April", "May", "June", "July",
                            "August", "September", "October", "November", "December");
                        getShiftMapping("<?= date('F-Y') ?>");
                        $('#previousMonth').click(function () {
                            var past = now.setMonth(now.getMonth() - 1);
                            getShiftMapping(months[now.getMonth()] + '-' + now.getFullYear());
                            $('#month').html(months[now.getMonth()] + ' ' + now.getFullYear());
                        });
                        $('#NextMonth').click(function () {
                            var future = now.setMonth(now.getMonth() + 1);
                            getShiftMapping(months[now.getMonth()] + '-' + now.getFullYear());
                            $('#month').html(months[now.getMonth()] + ' ' + now.getFullYear());
                        });

                        function getShiftMapping(date) {
                            var formData = {
                                'date': date,
                            };
                            $.ajax({
                                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                                url: '<?= base_url('admin/shift/getShiftMapping') ?>', // the url where we want to POST
                                data: formData, // our data object
                                dataType: 'json', // what type of data do we expect back from the server
                                encode: true,
                                success: function (res) {
                                    if (res) {
                                        $('#all_shift_mapping').html(res.mapping_details);
                                    } else {
                                        alert('There was a problem with AJAX');
                                    }
                                }
                            })

                        }
                    })(jQuery);
                </script>
                
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th><?= lang('employee') ?></th>
                            <th><?= lang('shifts') ?></th>
                            <th class="text-center"><?= lang('modified_on') ?></th>
                            <th class="text-center"><?= lang('action') ?></th>
                        </tr>
                        </thead>
                        <tbody id="all_shift_mapping">
                        
                        </tbody>
                    </table>
                </div>
            </div>
        
        
        </div>
    </div>