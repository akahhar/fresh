<div class="form-group">
    <?php
    if (empty($front)){
    ?>
    <label for="field-1" class="col-sm-3 control-label"><?= lang('billing_cycle') ?>
        <span class="required">*</span></label>

    <div class="col-sm-5">

        <?php
        }
        echo form_dropdown('billing_cycle', $options, $type, 'style="width:100%" id="billing_cycle" onchange="get_package_info(' . $package_info->id . ',this.value)" class="form-control"'); ?>
        <small><?= lang('plan_renews') ?> <span
                    class="text-danger"><?= $renew_date; ?></span>
            @ <?= display_money($package_info->$type, default_currency()) ?>/<?= lang($type_title) ?></small>
    </div>
    <input type="hidden" name="expired_date" value="<?= $renew_date ?>">
    <?php if (empty($company_id) && empty($front) && empty(is_subdomain())) { ?>
    <div class="col-sm-4 ">
        <div class="checkbox c-checkbox  pull-left mr-lg">
            <label class="needsclick">
                <input type="checkbox" name="mark_paid" value="1">
                <span class="fa fa-check"></span><?= lang('paid') ?>
            </label>
        </div>
        <?php } ?>
        <div class="mark_as_paid hidden" style="display: none">
            <div class="checkbox c-checkbox  pull-left">
                <label class="needsclick">
                    <input type="checkbox" name="is_coupon" value="1" id="is_coupon">
                    <span class="fa fa-check"></span><?= lang('i_have_a_coupon') ?>
                </label>
            </div>
        </div>
    </div>
</div>

<div class="mark_as_paid coupon_code_area" style="display: none">
    <div class="form-group coupon_code_area" id="coupon_code_area" style="display: none">
        <label for="discount_type" class="control-label col-sm-3"><?= lang('enter_coupon_code') ?><span
                    class="required">*</span></label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="coupon_code" name="coupon_code" value=""
                   placeholder="<?= lang('enter_coupon_code') ?>">
            <span class="required" id="discount_error"></span>
        </div>
        <div class="col-sm-3">
            <button id="btn_coupon_code" type="button"
                    class="btn btn-primary btnSubmit"><?= lang('apply') ?></button>
        </div>
    </div>
    <div id="applied_discount"></div>
    <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label sub_total_text"><?= lang('amount') ?>
            <span class="required">*</span></label>

        <div class="col-sm-5">
            <input type="text" class="form-control" id="sub_total" name="amount" readonly
                   value="<?= $package_info->$type ?>">
        </div>
    </div>
    <div id="final_amount"></div>
    <?php if (empty($company_id) && empty($front) && empty(is_subdomain())) { ?>
    <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label"><?= lang('payment_date') ?>
            <span class="required">*</span></label>

        <div class="col-sm-5">
            <div class="input-group">
                <input type="text" class="form-control datepicker" name="payment_date"
                       value="<?= date('Y-m-d') ?>">
                <div class="input-group-addon">
                    <a href="#"><i class="fa fa-calendar"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label"><?= lang('payment_method') ?>
            <span class="required">*</span></label>

        <div class="col-sm-5">
            <select name="payment_method" class="form-control select_box" style="width: 100%">
                <option value=""><?= lang('select_payment_method') ?></option>
                <?php
                $payment_methods = $this->db->get('tbl_payment_methods')->result();
                if (!empty($payment_methods)) {
                    foreach ($payment_methods as $p_method) {
                        ?>
                        <option value="<?= $p_method->method_id ?>"><?= $p_method->method_name ?></option>
                        <?php
                    }
                }
                ?>
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="field-1" class="col-sm-3 control-label"><?= lang('notes') ?></label>

        <div class="col-sm-5">
            <textarea class="form-control" name="notes"></textarea>
        </div>
    </div>
</div>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function () {

        $('.datepicker').datepicker({
            autoclose: true,
            format: 'yyyy-mm-dd',
            todayBtn: "linked",
        });
        $('input[name="mark_paid"]').on('change', function () {
            if ($(this).prop('checked')) {
                $('.mark_as_paid').show();
            } else {
                $('.mark_as_paid').hide();
            }
        });
        $('input[name="is_coupon"]').on('change', function () {
            if ($(this).prop('checked')) {
                $('.coupon_code_area').show();
            } else {
                $('.coupon_code_area').hide();
            }
        });
        $('#btn_coupon_code').on('click', function () {
            var coupon_code = $('#coupon_code').val();
            var formData = {
                'coupon_code': $('#coupon_code').val(),
                'billing_cycle': '<?= $type ?>',
                'package_id': "<?= $package_info->id ?>",
                'email': $('#check_email').val(),
            };
            if (coupon_code == '') {
                alert('<?= lang('coupon_code_required') ?>');
                return false;
            }
            $.ajax({
                type: "post",
                url: "<?= base_url() ?>check_coupon_code",
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
        });
    });

</script>


