<style type="text/css">
    .package_details .package-section {
        background: #fff;
        color: #7a90ff;
        /*padding: 2em 0 8em;*/
        min-height: 100vh;
        position: relative;
        -webkit-font-smoothing: antialiased;
        /*margin-top: 30px;*/
    }

    .package_details .packaging {
        display: -webkit-flex;
        display: flex;
        -webkit-flex-wrap: wrap;
        flex-wrap: wrap;
        -webkit-justify-content: center;
        justify-content: center;
        width: 100%;
        margin: 0 auto 3em;
    }

    .packaging-item {
        position: relative;
        display: -webkit-flex;
        display: flex;
        -webkit-flex-direction: column;
        flex-direction: column;
        -webkit-align-items: stretch;
        align-items: stretch;
        text-align: center;
        -webkit-flex: 0 1 550px;
        flex: 0 1 550px;
    }

    .packaging-action {
        color: inherit;
        border: none;
        background: none;
    }

    .packaging-action:focus {
        outline: none;
    }

    .packaging-feature-list {
        text-align: left;
    }

    .packaging-palden .packaging-item {
        font-family: 'Open Sans', sans-serif;
        cursor: default;
        color: #84697c;
        background: #fff;
        box-shadow: 0 0 10px rgba(46, 59, 125, 0.23);
        border-radius: 20px 20px 10px 10px;
    }

    @media screen and (min-width: 66.25em) {

        .packaging-palden .packaging__item--featured {
            margin: 0;
            z-index: 10;
            box-shadow: 0 0 20px rgba(46, 59, 125, 0.23);
        }
    }

    .packaging-palden .packaging-deco {
        /*border-radius: 10px 10px 0 0;*/
        padding: 4em 0 9em;
        position: relative;
    }

    .packaging-palden .packaging-deco-img {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 160px;
    }

    .packaging-palden .packaging-title {
        font-size: 1.0em;;
        margin: 0;
        text-transform: uppercase;
        letter-spacing: 5px;
        color: #fff;
    }

    .packaging-palden .deco-layer {
        -webkit-transition: -webkit-transform 0.5s;
        transition: transform 0.5s;
    }

    .packaging-palden .packaging-item:hover .deco-layer--1 {
        -webkit-transform: translate3d(15px, 0, 0);
        transform: translate3d(15px, 0, 0);
    }

    .packaging-palden .packaging-item:hover .deco-layer--2 {
        -webkit-transform: translate3d(-15px, 0, 0);
        transform: translate3d(-15px, 0, 0);
    }

    .packaging-palden .icon {
        font-size: 2.5em;
    }

    .package_details .packaging-palden .packaging-package {
        font-size: 5em;
        font-weight: bold;
        padding: 0;
        color: #fff;
        margin: 0 0 0.25em 0;
        line-height: 0.75;
    }

    .packaging-palden .packaging-currency {
        font-size: 0.15em;
        vertical-align: top;
    }

    .packaging-palden .packaging-period {
        font-size: 0.15em;
        padding: 0 0 0 0.5em;
        font-style: italic;
    }

    .packaging-palden .packaging__sentence {
        font-weight: bold;
        margin: 0 0 1em 0;
        padding: 0 0 0.5em;
    }

    .packaging-palden .packaging-feature-list {
        margin: 0;
        padding: 0.25em 0 15px;
        list-style: none;
        /*text-align: center;*/
    }

    .packaging-palden .packaging-feature {
        padding: 2px 0;
    }

    .packaging-palden li.packaging-feature {
        border-bottom: 1px dashed #564aa3;
        margin-right: 33px;
        margin-left: 20px;
    }

    .packaging-palden .packaging-action {
        font-weight: bold;
        margin: auto 3em 2em 3em;
        padding: 1em 2em;
        color: #fff;
        border-radius: 30px;
        -webkit-transition: background-color 0.3s;
        transition: background-color 0.3s;
    }

    .packaging-palden .packaging-action:hover, .packaging-palden .packaging-action:focus {
        background-color: #3378ff;
    }

    .packaging-palden .packaging-item--featured .packaging-deco {
        padding: 5em 0 8.885em 0;
    }

    .packaging-feature i {
        font-size: 15px;
        float: left;
        margin: 0px 8px 0px 0px;;
    }

    .custom_ul {
        list-style: none;
        padding: 0.25em 13px 0px;;
    }

    .custom_ul li {
        border-bottom: 1px dashed #564aa3;
        padding: 4px 0px;
    }

    .custom_ul li a {
        padding: 0.25em 0 2.5em;
    }

    .custom_ul i {
        font-size: 15px;
        /*float: left;*/
        margin: 0px 8px 0px 0px;;
    }

    .package_details .package_position {
        text-align: initial;
        margin: 10px;
        display: flex;
        flex-direction: row;
        align-content: center;
        justify-content: space-between;
    }

    .jcenter {
        justify-content: center !important;
    }

    .package_details .package_position .packaging-title {
        letter-spacing: 2px !important;
    }

    .pricing_check {
        color: #3378ff;
    }

    .pricing_times {
        color: red;
    }
</style>
<?php
$error = $this->session->userdata('sserror');
if (!empty($error)) { ?>
    <div class="alert alert-danger"><?= $error ?></div>
    <?php
    $this->session->unset_userdata('sserror');
}

echo message_box('success');
echo message_box('error');

$c_text = null;
if (!empty($sub_info) && $sub_info->is_trial == 'Yes') {
    $c_text = lang('trial_version_end', $sub_info->package_name);
} else if (!empty($sub_info) && $sub_info->is_trial == 'No') {
    $c_text = lang('pricing_plan_version_end', $sub_info->package_name);
}
?>

<div class="modal-body pt0 wrap-modal wrap">
    <!-- PayPal Logo -->
    <div class="col-sm-8 row">
        <div class="panel panel-custom">
            <div class="panel-heading">
                <strong><?= lang('current_package') . ' ' . $sub_info->package_name . ' ' . lang('details') ?></strong>
            </div>
            <div class="panel-body">
                <span class="block mb"><strong class="text-danger bold"> <?= $c_text ?> </strong> But your data is still safe, and you can continue where you left off after paying the account fees..</span>
                <span>No taxes, or hidden fees included.<br> We accept
                    <?php
                    $activePayment = '';
                    if ($sub_info->online_payment == 'Yes') {
                        $all_payment = get_old_result('tbl_online_payment');
                        foreach ($all_payment as $payment) {
                            $status = $this->config->item('saas_' . slug_it(strtolower($payment->gateway_name)) . '_status');
                            if ($status == 'active') {
                                $activePayment .= lang(slug_it(strtolower($payment->gateway_name))) . ', ';
                            }
                        }
                    }
                    echo $activePayment;
                    ?></span>

                <section class="package-section">
                    <div class='packaging packaging-palden'>
                        <div class='packaging-item'>
                            <div class='packaging-deco custom-bg'>
                                <svg class='packaging-deco-img' enable-background='new 0 0 300 100' height='100px'
                                     id='Layer_1'
                                     preserveAspectRatio='none' version='1.1' viewBox='0 0 300 100' width='300px'
                                     x='0px'
                                     xml:space='preserve'
                                     xmlns='http://www.w3.org/2000/svg'
                                     y='0px'>
          <path class='deco-layer deco-layer--1'
                d='M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729&#x000A;c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z'
                fill='#FFFFFF' opacity='0.6'></path>
                                    <path class='deco-layer deco-layer--2'
                                          d='M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729&#x000A;c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z'
                                          fill='#FFFFFF' opacity='0.6'></path>
                                    <path class='deco-layer deco-layer--3'
                                          d='M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716&#x000A;H42.401L43.415,98.342z'
                                          fill='#FFFFFF' opacity='0.7'></path>
                                    <path class='deco-layer deco-layer--4'
                                          d='M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428&#x000A;c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z'
                                          fill='#FFFFFF'></path>
</svg>
                                <div class='packaging-package'><span
                                            class='packaging-currency'> </span><?= $sub_info->package_name ?>
                                    <span class='packaging-period'></span>
                                </div>

                                <div class="package_position <?= !empty($sub_info->frequency) ? 'jcenter' : '' ?>">
                                    <?php
                                    if (!empty($sub_info->frequency)) { ?>
                                        <h3 class="packaging-title text-center"> <?= display_money($sub_info->amount, default_currency()) . ' / ' . lang($sub_info->frequency) ?></h3>
                                    <?php } else {
                                        echo package_price($sub_info);
                                    }
                                    ?>
                                </div>


                            </div>
                            <ul class='packaging-feature-list'>
                                <?= saas_packege_list($sub_info) ?>
                            </ul>

                        </div>

                    </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="panel panel-custom" style="box-shadow: 0 0px 0px 0 rgba(0,0,0,.15);overflow: hidden">
        <!-- Default panel contents -->
        <div class="panel-heading">
            <strong><?= lang('select') . ' ' . lang('payment_method') . ' ' . lang('for') . ' ' . lang('renew') ?></strong>
        </div>
        <div class="panel-body bb mb">
            <?php
            $all_payment = get_old_result('tbl_online_payment');
            foreach ($all_payment as $key => $payment) {
                $gateway_status = $this->config->item('saas_' . slug_it(strtolower($payment->gateway_name)) . '_status');
                $gatewayName = slug_it(strtolower($payment->gateway_name));
                if ($gateway_status == 'active') { ?>
                    <a class="pull-left pb b m"
                       href="<?= base_url('proceedPayment/' . $gatewayName) ?>"
                       title="<?= lang($payment->gateway_name) ?>">
                        <img style="width: 80px;height: 50px" src="<?= base_url($payment->icon) ?>">
                    </a>

                <?php }
            }
            ?>

        </div>
        <div class="text-center mb">
            <a href="<?= base_url('updatePackage') ?>"
               class="btn btn-danger"><?= lang('or') . ' ' . lang('change') . ' ' . lang('package') ?></a>
        </div>
    </div>
</div>
</div>