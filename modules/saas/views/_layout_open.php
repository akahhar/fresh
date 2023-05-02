<?php
$this->load->view('admin/components/htmlheader');
$opened = $this->session->userdata('opened');
$this->session->unset_userdata('opened');
$time = date('h:i:s');
$r = display_time($time);
$time1 = explode(' ', $r);
?>

<script type="text/javascript">

    function startTime() {
        var time = new Date();
        var date = time.getDate();
        var month = time.getMonth() + 1;
        var years = time.getFullYear();
        var hr = time.getHours();
        var hour = time.getHours();
        var min = time.getMinutes();
        var minn = time.getMinutes();
        var sec = time.getSeconds();
        var secc = time.getSeconds();
        if (date <= 9) {
            var dates = "0" + date;
        } else {
            dates = date;
        }
        if (month <= 9) {
            var months = "0" + month;
        } else {
            months = month;
        }
        <?php if(empty($time1[1])){?>
        var ampm = ' ';
        <?php }else{?>
        var ampm = " PM "
        if (hr < 12) {
            ampm = " AM "
        }
        if (hr > 12) {
            hr -= 12
        }
        <?php }?>

        if (hr < 10) {
            hr = " " + hr
        }
        if (min < 10) {
            min = "0" + min
        }
        if (sec < 10) {
            sec = "0" + sec
        }
        document.getElementById('date').value = years + "-" + months + "-" + dates;
        document.getElementById('clock_time').value = hour + ":" + minn + ":" + secc;
        document.getElementById('txt').innerHTML = hr + ":" + min + ":" + sec + ampm;
        var t = setTimeout(function () {
            startTime()
        }, 500);
    }

    function checkTime(i) {
        if (i < 10) {
            i = "0" + i
        }
        ;  // add zero in front of numbers < 10
        return i;
    }

</script>
<body onload="startTime();" class="<?php if (!empty($opened)) {
    echo 'offsidebar-open';
} ?> <?= config_item('aside-float') . ' ' . config_item('aside-collapsed') . ' ' . config_item('layout-boxed') . ' ' . config_item('layout-fixed') ?>">
<div class="wrapper">
    <!-- top navbar-->
    <?php $this->load->view('admin/components/header'); ?>
    <!-- sidebar-->
    <?php $this->load->view('admin/components/sidebar'); ?>
    <!-- Main section-->

    <section>
        <?php
        $active_pre_loader = config_item('active_pre_loader');
        if (!empty($active_pre_loader) && $active_pre_loader == 1) {
            ?>
            <div id="loader-wrapper">
                <div id="loader"></div>
            </div>
        <?php } ?>
        <!-- Page content-->
        <div class="content-wrapper">
            <div class="content-heading">
                <?php $user_id = $this->session->userdata('user_id');
                $c_text = null;
                if (!empty($sub_info) && $sub_info->is_trial == 'Yes') {
                    $c_text = lang('trial_version_end', $sub_info->package_name);
                } else if (!empty($sub_info) && $sub_info->is_trial == 'No') {
                    $c_text = lang('pricing_plan_version_end', $sub_info->package_name);
                }
                ?>
                <span class="text-danger"><?= $c_text ?></span>
                <div class="pull-right">

                    <div>
                        <small class="text-sm">
                            &nbsp;<?php echo lang(date('l')) . ' ' . lang(date('jS')) . ' ' . lang(date('F')) . ' ' . date('\- Y,'); ?>
                            &nbsp;<?= lang('time') ?>
                            &nbsp;<span id="txt"></span></small>
                        <input type="hidden" name="clock_date" value="" id="date">
                        <input type="hidden" name="clock_time" value="" id="clock_time">
                        <?php if (!empty($clocking->clock_id)): ?>
                            <button name="clocktime" type="submit" id="sbtn" value="2"
                                    class="btn btn-danger clock_in_button"><i
                                        class="fa fa-arrow-left"></i> <?= lang('clock_out') ?>
                            </button>
                        <?php else: ?>
                            <button name="clocktime" type="submit" id="sbtn" value="1"
                                    class="btn btn-success clock_in_button"><i
                                        class="fa fa-sign-out"></i> <?= lang('clock_in') ?>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <?php echo $subview ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Page footer-->

    <footer>
        <div class="pull-right hidden-xs">
            <?= '<b>' . lang('version') . '</b> ' . config_item('version') ?>
        </div>
        <strong>&copy; <a href="<?= config_item('copyright_url') ?>"> <?= config_item('copyright_name') ?></a>.</strong>
        All rights reserved.
    </footer>
</div>
<?php
$this->load->view('admin/components/footer');
$direction = $this->session->userdata('direction');
if (!empty($direction) && $direction == 'rtl') {
    $RTL = 'on';
} else {
    $RTL = config_item('RTL');
}
?>
<?php $this->load->view('admin/_layout_modal'); ?>
<?php $this->load->view('admin/_layout_modal_lg'); ?>
<?php $this->load->view('admin/_layout_modal_extra_lg'); ?>
<script>
    document.addEventListener("load", ins_data, false);

    function ins_data(url, datastring = '') {
        $.ajax({
            async: false,
            url: url,
            type: 'post',
            data: datastring,
            dataType: "json",
            success: function (data) {
                $.each(data, function (index, value) {
                    $('#' + index).empty().html(value);
                });

            }
        });

    }
</script>