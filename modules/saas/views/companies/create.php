<?php
if (!empty($company_info)) {
    $id = $company_info->id;
    $frequency = $company_info->frequency;
} else {
    $id = null;
    $frequency = null;
}
echo form_open(base_url('saas/companies/save_companies/' . $id), array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'data-parsley-validate' => '', 'role' => 'form')); ?>
<div class="nav-tabs-custom">
    <!-- Tabs within a box -->
    <ul class="nav nav-tabs">
        <li class="<?= $active == 1 ? 'active' : ''; ?>"><a
                    href="<?= base_url('saas/companies') ?>"><?= lang('all') . ' ' . lang('companies') ?></a>
        </li>
        <li class="<?= $active == 2 ? 'active' : ''; ?>"><a
                    href="<?= base_url('saas/companies/create') ?>"><?= lang('new') . ' ' . lang('companies') ?></a>
        </li>
        <li class="pull-right">
            <button type="submit" id="btn_companies"
                    class="btn btn-sm btn-primary mt-sm"><?= lang('save_changes') ?></button>
        </li>
    </ul>
    <div class="tab-content bg-white">
        <div class="tab-pane <?= $active == 2 ? 'active' : ''; ?>" id="create">
            <div class="row mb-lg ">

                <div class="col-lg-7 col-md-7 ">
                    <div class="row">
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?= lang('account') ?>
                                <span class="required">*</span></label>

                            <div class="col-sm-8">
                                <input name="domain" required class="form-control main_domain" id="domain"
                                       value="<?= (!empty($company_info) ? $company_info->domain : '') ?>"
                                       placeholder="<?= lang('choose_a_domain') ?> *" type="text">
                                <small class="new_error text-danger" id="domain_error"></small>
                                <span class="help-block domain_showed"
                                      style="display: none"><?= lang('your_app_URL_will_be') ?> <strong
                                            id="sub_domain" class=""></strong></span>
                            </div>
                        </div>
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
                                    <option value=""></option>
                                    <?php
                                    if (!empty($all_packages)) {
                                        foreach ($all_packages as $v_package) {
                                            ?>
                                            <option <?php
                                            if (isset($company_info)) {
                                                if ($company_info->package_id == $v_package->id) {
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
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?= lang('name') ?>
                                <span class="required">*</span></label>

                            <div class="col-sm-8">
                                <input name="name" required class="form-control"
                                       value="<?= (!empty($company_info) ? $company_info->name : '') ?>"
                                       placeholder="<?= lang('name') ?> *"
                                       type="text">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?= lang('email') ?></label>

                            <div class="col-sm-8">
                                <input name="email"
                                       value="<?= (!empty($company_info) ? $company_info->email : '') ?>"
                                       id="check_email" class="form-control" required
                                       placeholder="<?= lang('email') ?> *"
                                       type="email">
                                <small class="new_error text-danger" id="email_error"></small>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?= lang('password') ?></label>
                            <div class="col-sm-8">
                                <?php
                                if (!empty($company_info)) { ?>
                                    <a data-toggle="modal" data-target="#myModal"
                                       href="<?= base_url() ?>saas/companies/reset_password/<?= $company_info->id ?>"
                                       class="btn btn-xs btn-primary"><?= lang('reset_password') ?></a>
                                <?php } else { ?>
                                    <div class="input-group">
                                        <input name="password"
                                               value="<?= (!empty($company_info) ? ($company_info->password) : '') ?>"
                                               id="password" class="form-control" required
                                               placeholder="<?= lang('password') ?> *"
                                               type="password">
                                        <div class="input-group-addon">
                                            <a href="javascript:void(0);" id="show_password"
                                               style="padding: 0;"><i class="fa fa-eye"></i></a>
                                        </div>
                                    </div>
                                <?php }
                                ?>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?= lang('mobile') ?></label>
                            <div class="col-sm-8">
                                <input name="mobile" class="form-control"
                                       value="<?= (!empty($company_info) ? $company_info->mobile : '') ?>"
                                       placeholder="<?= lang('mobile') ?>"
                                       type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?= lang('address') ?></label>
                            <div class="col-sm-8">
                                <input name="address" class="form-control"
                                       value="<?= (!empty($company_info) ? $company_info->address : '') ?>"
                                       placeholder="<?= lang('address') ?>"
                                       type="text">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1" class="col-sm-3 control-label"><?= lang('country') ?></label>
                            <div class="col-sm-8">
                                <select name="country" class="form-control select_box"
                                        style="width: 100%">
                                    <?php if (!empty($countries)): foreach ($countries as $key => $country): ?>
                                        <option
                                                value="<?= $country ?>" <?= (!empty($company_info->country) && $company_info->country == $country || $this->config->item('company_country') == $country ? 'selected' : NULL) ?>><?= $country ?>
                                        </option>
                                    <?php
                                    endforeach;
                                    endif;
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1"
                                   class="col-sm-3 control-label"><?= lang('select_timezone') ?></label>
                            <div class="col-sm-8">
                                <select name="timezone" class="form-control select_box"
                                        style="width: 100%">
                                    <option><?= lang('select_timezone') ?></option>
                                    <?php foreach ($timezones as $timezone => $description): ?>
                                        <option value="<?= $timezone ?>" <?= (!empty($company_info->timezone) && $company_info->timezone == $timezone || $this->config->item('timezone') == $timezone ? 'selected' : NULL) ?>><?= $description ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="field-1"
                                   class="col-sm-3 control-label"><?= lang('select_language') ?></label>
                            <div class="col-sm-8">
                                <select name="language" class="form-control select_box"
                                        style="width: 100%">
                                    <option><?= lang('select_language') ?></option>
                                    <?php foreach ($languages as $lang) : ?>
                                        <option value="<?= $lang->name ?>" <?= (!empty($company_info->language) && $company_info->language == $lang->name || $this->config->item('default_language') == $lang->name ? 'selected' : NULL) ?>><?= ucfirst($lang->name) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-lg-5 col-md-5" id="package_info">

                </div>
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
            get_package_info(package_id, '<?= $frequency?>_price', '<?= $id?>');
        }
    });
    // click to show_password with icon
    <?php
    $default_url = preg_replace('#^https?://#', '', rtrim(config_item('default_url'), '/'));
    ?>
    $(".main_domain").keyup(function () {
        var sub_domain = $(this).val();
        // remove space,special character,dot from sub_domain and replace with underscore
        sub_domain = sub_domain.replace(/\s+/g, '_').replace(/[^a-zA-Z0-9]/g, '_').replace(/\./g, '');
        var main_domain = "<?= $default_url?>";
        var http = "<?= (isset($_SERVER['HTTPS']) ? "https://" : "http://")?>";
        $('#sub_domain').html(http + sub_domain + '.' + main_domain);
        var domainDiv = $('.domain_showed');
        if ($(this).val() == "") {
            domainDiv.css("display", "none");
        } else {
            domainDiv.css("display", "block");
        }
        check_already_exists('domain', sub_domain);
    });
    // check_email_exists
    $("#check_email").keyup(function () {
        var email = $(this).val();
        check_already_exists('email', email);
    });

    function check_already_exists(type, value) {
        $.ajax({
            type: "POST",
            url: "<?= base_url()?>saas/gb/check_already_exists",
            data: {type, value},
            dataType: "json",
            success: function (data) {
                if (data.status == 'error') {
                    $('#' + type + '_error').html(data.message);
                    $('#btn_companies').attr('disabled', true);
                } else {
                    $('#btn_companies').attr('disabled', false);
                    $('#' + type + '_error').html('');
                }
            }
        });
    }

    $('#show_password').on('click', function () {
        // check the password field type if it is password field then set the attribute to text
        if ($('#password').attr('type') == 'password') {
            $('#password').attr('type', 'text');
            $('#show_password i').removeClass('fa-eye');
            $('#show_password i').addClass('fa-eye-slash');
        } else {
            // if the password field type is text then set the attribute to password
            $('#password').attr('type', 'password');
            $('#show_password i').removeClass('fa-eye-slash');
            $('#show_password i').addClass('fa-eye');
        }
    });

    function get_package_info(package_id, package_type = 'monthly_price', company_id = '<?= $id?>') {
        // check input mark_paid is checked or not
        var mark_paid = $('input[name="mark_paid"]').is(":checked");
        var is_coupon = $('input[name="is_coupon"]').is(":checked");
        $.ajax({
            type: 'POST',
            url: '<?= base_url() ?>saas/gb/get_package_info',
            data: {package_id, package_type, company_id},
            dataType: "json",
            success: function (result) {
                $('#billing_cycle').html(result.package_form_group);
                $('#package_info').html(result.package_details);
                if (mark_paid) {
                    $('.mark_as_paid').css('display', 'block');
                    $('input[name="mark_paid"]').prop('checked', true);
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
                } else {
                    $('.mark_as_paid').css('display', 'none');
                }
            }
        });
    }
</script>
