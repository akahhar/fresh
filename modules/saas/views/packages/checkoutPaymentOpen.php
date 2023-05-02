<?php
$company_id = !empty($subs_info) ? $subs_info->companies_id : '';
echo form_open(base_url('proceedPayment'), array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'data-parsley-validate' => '', 'role' => 'form')); ?>
<div class="panel panel-custom">
    <div class="panel-heading">
        <h4 class="panel-title"><?= lang('payment') . '  ' . lang('summery') . ' - ' ?> <span
                    id="package_name"><?= $package_info->name ?></span></h4>
    </div>
    <div class="panel-body form-horizontal">
        <div class="row mb-lg ">
            <div class="col-lg-7 col-md-7 ">
                <div class="row">
                    <input type="hidden" name="companies_id" id="company_id"
                           value="<?= !empty($subs_info) ? $subs_info->companies_id : '' ?>">
                    <div class="form-group">
                        <label for="discount_type"
                               class="control-label col-sm-3"><?= lang('select') . ' ' . lang('package') ?>
                            <span class="required">*</span></label>
                        <div class="col-sm-8">
                            <select name="package_id" onchange="get_package_info(this.value)"
                                    class="selectpicker m0"
                                    data-width="100%"
                                    data-none-selected-text="<?php echo lang('select') . ' ' . lang('package'); ?>"
                                    data-live-search="true">
                                <?php
                                if (!empty($all_packages)) {
                                    foreach ($all_packages as $v_package) {
                                        ?>
                                        <option <?php
                                        if (isset($package_info)) {
                                            if ($package_info->id == $v_package->id) {
                                                echo 'selected';
                                            }
                                        } ?> value="<?php echo $v_package->id; ?>"
                                             data-subtext="<?php echo lang('monthly') . ': ' . $v_package->monthly_price . ' ' . lang('quarterly') . ': ' . $v_package->quarterly_price . ' ' . lang('yearly') . ': ' . $v_package->yearly_price . ' ' . strip_tags(mb_substr(!empty($c_pricing->description) ? $c_pricing->description : '', 0, 200)) . '...'; ?>"><?php echo $v_package->name; ?></option>
                                    <?php } ?>
                                    <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div id="billing_cycle">

                    </div>

                    <style type="text/css">
                        .image-radio {
                            cursor: pointer;
                            box-sizing: border-box;
                            -moz-box-sizing: border-box;
                            -webkit-box-sizing: border-box;
                            border: 4px solid transparent;
                            margin-bottom: 0;
                            outline: 0;
                            /*border: 1px solid red;*/
                            overflow: hidden;
                        }

                        .image-radio .thumnail {
                            width: 100%;
                            height: 50px;
                        }

                        .image-radio input[type="radio"] {
                            display: none;
                        }

                        .image-radio-checked {
                            border-color: #3378ff;
                        }

                        .image-radio .fa {
                            position: absolute;
                            color: #3378ff;
                            /*background: #564aa38c;*/
                            /*padding: 6px 17px 10px 18px;*/
                            top: 16%;
                            font-size: 34px;
                            right: 35%;
                            /*padding: 10px;*/
                            /*top: 0;*/
                            /*right: 0;*/
                        }

                        .image-radio-checked .fa {
                            display: block !important;
                        }
                    </style>


                    <script type="text/javascript">
                        $(document).ready(function () {
                            // add/remove checked class
                            $(".image-radio").each(function () {
                                if ($(this).find('input[type="radio"]').first().attr("checked")) {
                                    $(this).addClass('image-radio-checked');
                                } else {
                                    $(this).removeClass('image-radio-checked');
                                }
                            });

                            // sync the input state
                            $(".image-radio").on("click", function (e) {
                                $(".image-radio").removeClass('image-radio-checked');
                                $(this).addClass('image-radio-checked');
                                var $radio = $(this).find('input[type="radio"]');
                                $radio.prop("checked", !$radio.prop("checked"));

                                e.preventDefault();
                            });
                        });
                    </script>


                    <div class="panel panel-custom col-md-12" style="box-shadow: 0 0px 0px 0 rgba(0,0,0,.15);">
                        <!-- Default panel contents -->
                        <div class="panel-heading">
                            <strong><?= lang('select') . ' ' . lang('payment_method') ?></strong>
                        </div>
                        <?php
                        $all_payment = get_old_result('tbl_online_payment');
                        foreach ($all_payment as $key => $payment) {
                            $gatewayName = slug_it(strtolower($payment->gateway_name));
                            $gateway_status = 'saas_' . $gatewayName . '_status';
                            $status = ConfigItems($gateway_status);
                            if (!empty($status) == 'active') { ?>
                                <div class="col-md-2 nopad text-center" data-toggle="tooltip" data-placement="top"
                                     title="<?= $payment->gateway_name ?>">
                                    <label class="image-radio">
                                        <img class="thumnail" src="<?= base_url($payment->icon) ?>"/>
                                        <input type="radio" required name="payment_method" value="<?= $gatewayName ?>"/>
                                        <i class="fa fa-check hidden"></i>
                                    </label>
                                </div>
                            <?php }
                        }
                        ?>
                    </div>
                    <div class="col-md-12">
                        <div class="checkbox c-checkbox mt-lg mb-lg pull-left">
                            <label class="needsclick">
                                <input type="checkbox" required name="i_have_read_agree">
                                <span class="fa fa-check"></span>
                                <strong class="required"><?= lang('i_have_read_agree') ?></strong>
                                <a target="_blank" href="<?= base_url('tos') ?>"><?= lang('tos') ?></a>
                                <strong class="required"><?= lang('and') ?></strong>
                                <a target="_blank" href="<?= base_url('privacy') ?>"><?= lang('privacy') ?></a>
                            </label>
                        </div>
                        <div class="col-md-3 pull-right ">
                            <button type="submit"
                                    class="btn btn-success btn-block btn-lg"><?= lang('checkout') ?></button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-5 col-md-5" id="package_info">

            </div>
        </div>

    </div>
</div>
<?php echo form_close(); ?>

<script type="text/javascript">
    // check package_id is empty or not by name
    $(document).ready(function () {
        var package_id = $('[name="package_id"]').val();
        // if package_id is not empty then trigger onchange event
        if (package_id != '') {
            get_package_info(package_id, '<?= $frequency?>_price', '<?= $company_id?>');
        }
    });

    function get_package_info(package_id, package_type = 'monthly_price', company_id = '') {
        // check input mark_paid is checked or not
        var is_coupon = $('input[name="is_coupon"]').is(":checked");
        // if company_id is empty then get from input
        if (company_id == '') {
            company_id = $('#company_id').val();
        }
        $.ajax({
            type: 'POST',
            url: '<?= base_url('get_package_info') ?>',
            data: {package_id, package_type, company_id},
            dataType: "json",
            success: function (result) {
                $('#billing_cycle').html(result.package_form_group);
                $('#package_info').html(result.package_details);
                $('#package_name').html(result.package_info.name);
                if (is_coupon) {
                    $('.coupon_code_area').show();
                    $('input[name="is_coupon"]').prop('checked', true);

                    var coupon_code = $('#coupon_code').val();
                    if (coupon_code != '') {
                        var formData = {
                            'coupon_code': $('#coupon_code').val(),
                            'billing_cycle': $('[name="billing_cycle"]').val(),
                            'package_id': $('[name="mark_paid"]').val(),
                            'email': $('#check_email').val(),
                        };
                        $.ajax({
                            type: "post",
                            url: "<?= base_url() ?>saas/gb/check_coupon_code",
                            data: formData, // our data object
                            dataType: 'json', // what type of data do we expect back from the server
                            success: function (data) {
                                if (data.success == true) {
                                    $('#applied_discount').html(data.applied_discount);
                                    $('#sub_total').val(data.sub_total_input);
                                    $('.sub_total_text').html('<?= lang('sub_total') ?>');
                                    $('#final_amount').html(data.total_amount);
                                } else {
                                    $('#discount_error').html(data.message);
                                }
                            }
                        });
                    }
                }
            }
        });
    }
</script>
