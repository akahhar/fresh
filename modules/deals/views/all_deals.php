<div id="deal_state_report_div">
    <div class="row">
        <div class="col-lg-3">
            <!-- START widget-->
            <div class="panel widget">
                <div class="panel-body pl-sm pr-sm pt-sm pb0 text-center">
                    <h3 class="mt0 mb0">
                        <strong>
                            <?php
                            // total deals value from tbl_deals
                            $total_deals = $this->db->select_sum('deal_value')->get('tbl_deals')->row();
                            echo display_money($total_deals->deal_value, default_currency());
                            ?>
                        </strong>
                    </h3>
                    <p class="text-warning m0"><?= lang('total') . ' ' . lang('deals') ?></p>
                </div>
            </div>
        </div>
        <!-- END widget-->
        
        <div class="col-lg-3">
            <!-- START widget-->
            <div class="panel widget">
                <div class="panel-body pl-sm pr-sm pt-sm pb0 text-center">
                    <h3 class="mt0 mb0">
                        <strong>
                            <?php
                            // this_months deals value from tbl_deals where created_at
                            $where = array('MONTH(created_at)' => date('m'), 'YEAR(created_at)' => date('Y'));
                            $this_months_deals = $this->db->where($where)->select_sum('deal_value')->get('tbl_deals')->row();
                            echo display_money($this_months_deals->deal_value, default_currency());
                            ?>
                        </strong>
                    
                    </h3>
                    <p class="text-primary m0"><?= lang('this_months') . ' ' . lang('deals') ?></p>
                </div>
            </div>
            <!-- END widget-->
        </div>
        <div class="col-lg-3">
            <!-- START widget-->
            <div class="panel widget">
                <div class="panel-body pl-sm pr-sm pt-sm pb0 text-center">
                    <h3 class="mt0 mb0">
                        <?php
                        // this_weeks deals value from tbl_deals where created_at
                        $where = array('WEEK(created_at)' => date('W'), 'YEAR(created_at)' => date('Y'));
                        $this_weeks_deals = $this->db->where($where)->select_sum('deal_value')->get('tbl_deals')->row();
                        echo display_money($this_weeks_deals->deal_value, default_currency());
                        ?>
                    </h3>
                    <p class="text-danger m0"><?= lang('this_weeks') . ' ' . lang('deals') ?></p>
                </div>
            </div>
            <!-- END widget-->
        </div>
        <div class="col-lg-3">
            <!-- START widget-->
            <div class="panel widget">
                <div class="panel-body pl-sm pr-sm pt-sm pb0 text-center">
                    <h3 class="mt0 mb0">
                        <?php
                        // last 30 days deals value from tbl_deals where created_at
                        $where = array('created_at >=' => date('Y-m-d', strtotime('-30 days')));
                        $last_30_days_deals = $this->db->where($where)->select_sum('deal_value')->get('tbl_deals')->row();
                        echo display_money($last_30_days_deals->deal_value, default_currency());
                        ?>
                    </h3>
                    <p class="text-success m0"><?= lang('last_30_days') . ' ' . lang('deals') ?></p>
                </div>
            </div>
            <!-- END widget-->
        </div>
    </div>
</div>

<?= message_box('success'); ?>
<?= message_box('error');
$created = can_action_by_label('deals', 'created');
$edited = can_action_by_label('deals', 'edited');
$deleted = can_action_by_label('deals', 'deleted');
if (!empty($created) || !empty($edited)) {
    ?>
    <div class="nav-tabs-custom">
    <!-- Tabs within a box -->
    <ul class="nav nav-tabs">
        
        <li class="active"><a href="<?= base_url('admin/deals/') ?>"><?= lang('all_deals') ?></a>
        </li>
        <li>
            <a href="<?= base_url() ?>admin/deals/new_deals">
                <?= ' ' . lang('new') . ' ' . lang('deals') ?></a>
        </li>
        <li class="pull-right">
            <a href="<?= base_url() ?>admin/deals/deals_setting">
                <i class="fa fa-cogs"></i>
            </a>
        </li>
    </ul>
    <div class="panel-body bg-white">
        <table class="table table-striped DataTables " id="DataTables" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th><?= lang('title') ?></th>
                <th><?= lang('deal_value') ?></th>
                <th><?= lang('tags') ?></th>
                <th><?= lang('stage') ?></th>
                <th><?= lang('close') . ' ' . lang('date') ?></th>
                <th><?= lang('status') ?></th>
                <th><?= lang('action') ?></th>
            </tr>
            </thead>
            <tbody>
            <script type="text/javascript">
                $(document).ready(function () {
                    list = base_url + "admin/deals/dealsList";
                });
            </script>
            </tbody>
        </table>
    </div>
    <?php
} ?>