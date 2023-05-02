<div class="col-lg-12">
    <form role="form" id="form" action="<?php echo base_url(); ?>saas/settings/save_system" method="post"
          class="form-horizontal  ">
        <section class="panel panel-custom">
            <header class="panel-heading  "><?= lang('system_settings') ?></header>
            <div class="panel-body">
                <?php echo validation_errors(); ?>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('default_language') ?></label>
                    <div class="col-lg-4">
                        <select name="saas_default_language" class="form-control select_box">
                            <?php
                            $languages =
                                $this->settings_model->get_active_languages();
                            if (!empty($languages)) {
                                foreach ($languages as $lang) :
                                    ?>
                                    <option lang="<?= $lang->code ?>"
                                            value="<?= $lang->name ?>"<?= (config_item('saas_default_language') == $lang->name ? ' selected="selected"' : '') ?>><?= ucfirst($lang->name) ?></option>
                                <?php
                                endforeach;
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('timezone') ?> <span
                                class="text-danger">*</span></label>
                    <div class="col-lg-4">
                        <select name="saas_timezone" class="form-control select_box" required>
                            <?php
                            $timezones = $this->settings_model->timezones();
                            foreach ($timezones as $timezone => $description) : ?>
                                <option
                                        value="<?= $timezone ?>"<?= (config_item('saas_timezone') == $timezone ? ' selected="selected"' : '') ?>><?= $description ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('default_currency') ?></label>
                    <div class="col-lg-4">
                        <div class="input-group">
                            <select name="saas_default_currency" class="form-control select_box" width="100%">
                                <?php
                                $currencies = get_result('tbl_currencies');
                                foreach ($currencies as $cur) : ?>
                                    <option
                                            value="<?= $cur->code ?>" <?= (config_item('saas_default_currency') == $cur->code ? ' selected="selected"' : '') ?>><?= $cur->name ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php if ($this->session->userdata('user_type') == '1') { ?>
                                <div class="input-group-addon" data-toggle="tooltip" data-placement="top"
                                     title="New Currency">
                                    <a data-toggle="modal" data-target="#myModal"
                                       href="<?= base_url() ?>saas/settings/new_currency">
                                        <i class="fa fa-plus text-danger"></i></a>
                                </div>
                                <div class="input-group-addon btn-primary" data-toggle="tooltip" data-placement="top"
                                     title="<?= lang('view_all_currency'); ?>">
                                    <a href="<?= base_url() ?>saas/settings/all_currency">
                                        <i class="fa fa-list-alt text-white"></i></a>
                                </div>
                            <?php } ?>

                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('enable_languages') ?></label>
                    <div class="col-lg-4">
                        <div class="checkbox c-checkbox">
                            <label class="needsclick">
                                <input type="checkbox" <?php
                                if (config_item('saas_enable_languages') == TRUE) {
                                    echo "checked=\"checked\"";
                                }
                                ?> name="saas_enable_languages">
                                <span class="fa fa-check"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('country') ?></label>
                    <div class="col-lg-4">
                        <select class="form-control select_box" style="width:100%" name="saas_company_country">
                            <?php
                            $countries = get_result('tbl_countries');
                            foreach ($countries as $country): ?>
                                <option <?= (config_item('saas_company_country') == $country->value ? ' selected="selected"' : '') ?>
                                        value="<?= $country->value ?>"><?= $country->value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('tos') ?></label>
                    <div class="col-lg-8">
                        <textarea class="form-control textarea_"
                                  name="saas_tos"><?= config_item('saas_tos') ?></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('privacy') ?></label>
                    <div class="col-lg-8">
                        <textarea class="form-control textarea_"
                                  name="saas_privacy"><?= config_item('saas_privacy') ?></textarea>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label"></label>
                <div class="col-lg-6">
                    <button type="submit" class="btn btn-sm btn-primary"><?= lang('save_changes') ?></button>
                </div>
            </div>
        </section>
    </form>
</div>