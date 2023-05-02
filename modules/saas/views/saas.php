<?= message_box('error') ?>
<?= message_box('success') ?>
<style>
    .mb-0 {
        margin-bottom: 0 !important;
    }

    .p-0 {
        padding: 0 !important;
    }

    .white-box {
        background: #fff;
        padding: 25px;
        margin-bottom: 15px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, .12), 0 1px 2px rgba(0, 0, 0, .24);
    }

    .white-box .box-title {
        margin: 0 0 15px;
        font-weight: 500;
        text-transform: uppercase;
        font-size: 15px;
    }

    .white-box .box-title a {
        color: #333;
        transition: all .1s ease-in-out;
    }

    .white-box .box-title a:hover {
        color: dodgerblue;
        text-decoration: none;
    }

    .list-inline {
        padding-left: 0;
        margin-left: -5px;
        list-style: none;
    }

    .two-part li:first-child {
        width: 25%;
    }

    .two-part li:nth-child(2) {
        width: 72%;
    }

    .list-inline > li {
        display: inline-block;
        padding-right: 5px;
        padding-left: 5px;
    }

    .two-part li span, .two-part li i {
        font-size: 20px;
    }

    .two-part li span {
        font-size: 20px;
        font-weight: bold;
    }
</style>
<div class="row">
    <div class="col-md-3 col-sm-6">
        <div class="white-box">
            <h3 class="box-title">
                <a href="<?php echo base_url() ?>saas/companies/">
                    <?= lang('total_companies'); ?>
                </a>
            </h3>
            <ul class="list-inline two-part mb-0">
                <li><i class="icon-layers text-success"></i></li>
                <li class="text-right">
                        <span class="counter">
                            <?php echo total_rows('tbl_saas_companies'); ?>
                        </span>
                </li>
            </ul>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="white-box">
            <h3 class="box-title">
                <a href="<?php echo base_url() ?>saas/companies/index/running">
                    <?= lang('active_companies'); ?>
                </a>
            </h3>
            <ul class="list-inline two-part mb-0">
                <li><i class="icon-layers text-success"></i></li>
                <li class="text-right">
                        <span class="counter">
                             <?php echo total_rows('tbl_saas_companies', array('status' => 'running')); ?>
                        </span>
                </li>
            </ul>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="white-box">
            <h3 class="box-title">
                <a href="<?php echo base_url() ?>saas/companies/index/expired">
                    <?= lang('licence_expired'); ?>
                </a>
            </h3>
            <ul class="list-inline two-part mb-0">
                <li><i class="icon-layers text-success"></i></li>
                <li class="text-right">
                        <span class="counter">
                            <?php echo total_rows('tbl_saas_companies', array('status' => 'expired')); ?>
                        </span>
                </li>
            </ul>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="white-box">
            <h3 class="box-title">
                <a href="<?php echo base_url() ?>saas/companies/index/pending">
                    <?= lang('inactive_companies'); ?>
                </a>
            </h3>
            <ul class="list-inline two-part mb-0">
                <li><i class="icon-layers text-success"></i></li>
                <li class="text-right">
                        <span class="counter">
                        <?php echo total_rows('tbl_saas_companies', array('status' => 'pending')); ?>
                        </span>
                </li>
            </ul>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="white-box">
            <h3 class="box-title">
                <a href="<?php echo base_url() ?>saas/packages">
                    <?= lang('total_packages'); ?>
                </a>
            </h3>
            <ul class="list-inline two-part mb-0">
                <li><i class="icon-layers text-success"></i></li>
                <li class="text-right">
                        <span class="counter">
                            <?php echo total_rows('tbl_saas_packages'); ?>
                        </span>
                </li>
            </ul>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="white-box">
            <h3 class="box-title">
                <a href="<?php echo base_url() ?>saas/packages/index/published">
                    <?= lang('active_packages'); ?>
                </a>
            </h3>
            <ul class="list-inline two-part mb-0">
                <li><i class="icon-layers text-success"></i></li>
                <li class="text-right">
                        <span class="counter">
                            <?php echo total_rows('tbl_saas_packages', array('status' => 'published')); ?>
                        </span>
                </li>
            </ul>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="white-box">
            <h3 class="box-title">
                <a href="<?php echo base_url() ?>saas/packages/index/unpublished">
                    <?= lang('inactive_packages'); ?>
                </a>
            </h3>
            <ul class="list-inline two-part mb-0">
                <li><i class="icon-layers text-success"></i></li>
                <li class="text-right">
                        <span class="counter">
                            <?php echo total_rows('tbl_saas_packages', array('status' => 'unpublished')); ?>
                        </span>
                </li>
            </ul>
        </div>
    </div>

    <div class="col-md-3 col-sm-6">
        <div class="white-box">
            <h3 class="box-title">
                <a href="<?php echo base_url() ?>saas/faq">
                    <?= lang('faq'); ?>
                </a>
            </h3>
            <ul class="list-inline two-part mb-0">
                <li><i class="icon-layers text-success"></i></li>
                <li class="text-right">
                        <span class="counter">
                             <?php echo total_rows('tbl_saas_front_contact_us', array('view_status' => '0')); ?>
                        </span>
                </li>
            </ul>
        </div>
    </div>


    <div class="col-md-6 mt-lg">
        <div class="panel panel-custom menu" style="height: 437px;">
            <header class="panel-heading mb-0">
                <h3 class="panel-title"><?= lang('recent_subscriptions') ?></h3>
            </header>

            <div class="panel-body p-0">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Plan</th>
                        <th>Date</th>
                    </tr>
                    </thead>

                    <?php
                    $recent_reginstered = get_company_subscription(null, 'running', true, 9);

                    if (!empty($recent_reginstered)) {
                        foreach ($recent_reginstered as $_key => $v_recent_reginstered) {
                            ?>
                            <tbody>
                            <tr>
                                <td><?= $_key + 1 ?> </td>
                                <td>
                                    <a href="<?php echo base_url("saas/companies/details/$v_recent_reginstered->companies_id"); ?>"
                                    ><?= $v_recent_reginstered->name ?></a>
                                </td>
                                <td><?= $v_recent_reginstered->email ?></td>
                                <td>
                                    <a data-toggle="modal" data-target="#myModal"
                                       href="<?php echo base_url("subs_package_details/$v_recent_reginstered->company_history_id/1"); ?>"
                                       class="text-center"><?= ($v_recent_reginstered->package_name) ?></a>
                                </td>
                                <td><?= date('Y-m-d', strtotime($v_recent_reginstered->created_date)) ?></td>
                            </tr>
                            </tbody>
                        <?php }
                    } ?>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6 mt-lg">
        <div class="panel panel-custom menu" style="height: 437px;">
            <header class="panel-heading mb-0">
                <h3 class="panel-title"><?= lang('recent_licence_expired_subscriptions') ?></h3>
            </header>

            <div class="panel-body p-0">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Plan</th>
                        <th>Expired Date</th>
                    </tr>
                    </thead>

                    <?php
                    $recent_reginstered = get_company_subscription(null, 'expired', true, 6);
                    if (!empty($recent_reginstered)) {
                        foreach ($recent_reginstered as $_key => $v_recent_reginstered) {
                            ?>
                            <tbody>
                            <tr>
                                <td><?= $_key + 1 ?> </td>
                                <td>
                                    <a href="<?php echo base_url("saas/companies/details/$v_recent_reginstered->companies_id"); ?>"
                                    ><?= $v_recent_reginstered->name ?></a>
                                </td>
                                <td><?= $v_recent_reginstered->email ?></td>
                                <td>
                                    <a data-toggle="modal" data-target="#myModal"
                                       href="<?php echo base_url("subs_package_details/$v_recent_reginstered->company_history_id/1"); ?>"
                                       class="text-center"><?= $v_recent_reginstered->package_name ?></a>
                                </td>
                                <td><?= $v_recent_reginstered->expired_date ?></td>
                            </tr>
                            </tbody>
                        <?php }
                    } ?>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-12 clearfix">
        <div class="panel panel-custom menu">
            <header class="panel-heading mb-0">
                <?= lang('package') . ' ' . lang('overview') ?>
            </header>

            <div class="panel-body">
                <div id="morris-bar"></div>
            </div>
        </div>
    </div>
</div>

<!-- Morris.js charts -->
<script src="<?php echo base_url() ?>assets/plugins/raphael/raphael.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/morris/morris.min.js"></script>


<script type="text/javascript">
    $(document).ready(function () {

        var chartdata = [
            <?php
            if(!empty($plan_overview)){foreach($plan_overview as $package_name => $v_subs_info){
            ?>
            {
                y: "<?= $package_name ?>",
                a: <?= $v_subs_info['pending'] ?>,
                b: <?= $v_subs_info['running'] ?>,
                c: <?= $v_subs_info['expired'] ?>,
                d: <?= $v_subs_info['suspended'] ?>,
                e: <?= $v_subs_info['terminated'] ?>

            },
            <?php }} ?> ]


        new Morris.Bar({
            element: 'morris-bar',
            data: chartdata,
            xkey: 'y',
            ykeys: ["a", "b", "c", "d", "e"],
            labels: ["<?= lang('pending')?>", "<?= lang('running')?>", "<?= lang('expired')?>", "<?= lang('suspended')?>", "<?= lang('terminated')?>"],
            xLabelMargin: 2,
            barColors: ['#23b7e5', '#ff902b', '#f05050', '#ff902e', '#f00060'],
            resize: true,
            parseTime: false,
        });

    });
</script>


<script src="<?= module_dirURL(SaaS_MODULE) ?>assets/js/waypoints.min.js"></script>
<script src="<?= module_dirURL(SaaS_MODULE) ?>assets/js/jquery.counterup.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('.counter').counterUp({
            delay: 10,
            time: 1000
        });
    });
</script>
