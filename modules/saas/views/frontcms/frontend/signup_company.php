<form action="<?= base_url('signed_up') ?>" class="" id="contact-form" enctype="multipart/form-data"
      data-parsley-validate="" role="form" method="post" accept-charset="utf-8">
    <div class="card panel-custom">
        <div class="card-header">
        <span class="panel-title"><?php echo
            lang('signup'); ?> -
            <span class="package-name"><?php echo $package->name; ?></span>
        </span>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
        </div>
        <div class="card-body">
            <div class="row mb-lg form-horizontal">
                <div class="column col-md-6 col-sm-6 col-xs-12 ">

                    <div class="form-group">
                        <input name="domain" required class="form-control main_domain" id="domain"
                               value="<?= (!empty($company_info) ? $company_info->domain : '') ?>"
                               placeholder="<?= lang('choose_a_domain') ?> *" type="text">
                        <small class="new_error text-danger" id="domain_error"></small>
                        <?php
                        if (config_item('saas_server_wildcard') == 'TRUE') {
                            ?>
                            <span class="help-block domain_showed"
                                  style="display: none"><?= lang('your_app_URL_will_be') ?> <strong
                                        id="sub_domain" class=""></strong></span>
                            <?php
                        }
                        ?>

                    </div>
                    <div class="form-group">
                        <select name="package_id" onchange="get_package_info(this.value)" class="form-control"
                                style="width: 100%">
                            <option value=""><?= lang('select') . ' ' . lang('package') ?></option>
                            <?php
                            if (!empty($all_packages)) {
                                foreach ($all_packages as $v_package) {
                                    ?>
                                    <option <?php
                                    if (isset($package_id)) {
                                        if ($package_id == $v_package->id) {
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
                    <div id="billing_cycle">

                    </div>
                    <div class="form-group">

                        <input name="name" required class="form-control"
                               value="<?= (!empty($company_info) ? $company_info->name : '') ?>"
                               placeholder="<?= lang('name') ?> *"
                               type="text">
                    </div>

                    <div class="form-group">
                        <input name="email"
                               value="<?= (!empty($company_info) ? $company_info->email : '') ?>"
                               id="check_email" class="form-control" required
                               placeholder="<?= lang('email') ?> *"
                               type="email">
                        <small class="new_error text-danger" id="email_error"></small>

                    </div>

                    <div class="form-group">

                        <input name="mobile" class="form-control"
                               value="<?= (!empty($company_info) ? $company_info->email : '') ?>"
                               placeholder="<?= lang('mobile') ?>"
                               type="text">
                    </div>
                    <div class="form-group">
                        <input name="address" class="form-control"
                               value="<?= (!empty($company_info) ? $company_info->address : '') ?>"
                               placeholder="<?= lang('address') ?>"
                               type="text">
                    </div>
                    <div class="form-group">
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
                    <div class="d-flex row mb-0 mt-4" style="margin-bottom: 0!important;">
                        <div class="col-md-4 justify-content-start">
                            <button type="submit" id="btn_companies"
                                    class="btn primary-btn pricing-btn secondary-btn"><?= lang('register') ?>
                            </button>
                        </div>
                        <div class="col-md-8 justify-content-end">
                            <p class="pt-lg text-right"><?= lang('already_have_an_account') ?>
                                <a href="<?= base_url('login') ?>"
                                   class="ml-2 btn primary-btn pricing-btn secondary-btn"><?= lang('sign_in') ?></a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-5 col-md-5" id="package_info">

                </div>
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
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

    // check package_id is empty or not by name
    $(document).ready(function () {
        var package_id = '<?php echo $package_id; ?>';
        // if package_id is not empty then trigger onchange event
        if (package_id != '') {
            get_package_info(package_id, 'monthly_price');
        }
    });

    function get_package_info(package_id, package_type = 'monthly_price', company_id = '') {
        $.ajax({
            type: 'POST',
            url: '<?= base_url() ?>saas/gb/get_package_info',
            data: {package_id, package_type, company_id, front: true},
            dataType: "json",
            success: function (result) {
                $('.package-name').html(result.package_info.name);
                $('#billing_cycle').html(result.package_form_group);
                $('#package_info').html(result.package_details);
            }
        });
    }
</script>