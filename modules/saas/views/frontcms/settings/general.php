<?php echo message_box('success') ?>
<?php echo message_box('error');
echo '<link href="' . module_dirURL(SaaS_MODULE, 'assets/css/style_media.css') . '"  rel="stylesheet" type="text/css" />';
?>

<div class="row">
    <!-- Start Form -->
    <div class="col-lg-12">
        <form role="form" data-parsley-validate novalidate
              action="<?php echo base_url(); ?>saas/frontcms/settings/general_settings" method="post"
              enctype="multipart/form-data" class="form-horizontal  ">
            <section class="panel panel-custom">
                <header class="panel-heading"><?= lang('general_settings') ?>
                </header>
                <div class="panel-body pb-sm">
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo lang('favicon') ?> (32px X 32px)</label>
                        <div class="col-lg-6">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail w-210 ">
                                    <?php if (config_item('saas_front_favicon') != '') : ?>
                                        <img src="<?php echo base_url() . config_item('saas_front_favicon'); ?>">
                                    <?php else : ?>
                                        <img src="<?= base_url('uploads/default_avatar.jpg') ?>"
                                             alt="Please Connect Your Internet">
                                    <?php endif; ?>
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail "></div>
                                <div>
                                    <span class="btn btn-default btn-file">
                                        <span class="fileinput-new">
                                            <input type="file" name="saas_front_favicon" value="upload"
                                                   class="form-controll"
                                                   data-buttonText="<?= lang('choose_file') ?>" id="myImg"/>
                                            <span class="fileinput-exists"><?= lang('change') ?></span>
                                        </span>
                                        <a href="#" class="btn btn-default fileinput-exists"
                                           data-dismiss="fileinput"><?= lang('remove') ?></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?= lang('site_logo'); ?> (150px X 140px)</label>
                        <div class="col-lg-6">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail w-210">
                                    <?php if (config_item('saas_front_nav_logo') != '') : ?>
                                        <img src="<?php echo base_url() . config_item('saas_front_nav_logo'); ?>">
                                    <?php else : ?>
                                        <img src="<?= base_url('uploads/default_avatar.jpg') ?>"
                                             alt="Please Connect Your Internet">
                                    <?php endif; ?>
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail w-210"></div>
                                <div>
                                    <span class="btn btn-default btn-file">
                                        <span class="fileinput-new">
                                            <input type="file" name="saas_front_nav_logo" value="upload"
                                                   class="form-controll" data-buttonText="<?= lang('choose_file') ?>"
                                                   id="myImg"/>
                                            <span class="fileinput-exists"><?= lang('change') ?></span>
                                        </span>
                                        <a href="#" class="btn btn-default fileinput-exists"
                                           data-dismiss="fileinput"><?= lang('remove') ?></a>
                                    </span>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?= lang('header_image'); ?></label>
                        <div class="col-lg-6">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-new thumbnail w-210">
                                    <?php if (config_item('saas_front_header_image') != '') : ?>
                                        <img src="<?php echo base_url() . config_item('saas_front_header_image'); ?>">
                                    <?php else : ?>
                                        <img src="<?= base_url('uploads/default_avatar.jpg') ?>"
                                             alt="Please Connect Your Internet">
                                    <?php endif; ?>
                                </div>
                                <div class="fileinput-preview fileinput-exists thumbnail w-210 "></div>
                                <div>
                                    <span class="btn btn-default btn-file">
                                        <span class="fileinput-new">
                                            <input type="file" name="saas_front_header_image" value="upload"
                                                   class="form-controll" data-buttonText="<?= lang('choose_file') ?>"
                                                   id="myImg"/>
                                            <span class="fileinput-exists"><?= lang('change') ?></span>
                                        </span>
                                        <a href="#" class="btn btn-default fileinput-exists"
                                           data-dismiss="fileinput"><?= lang('remove') ?></a>
                                    </span>
                                </div>


                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?= lang('home_page_slider') ?></label>

                        <div class="col-lg-6">
                            <div class="material-switch mt-sm">
                                <input name="saas_front_slider" id="ext_url" type="checkbox" value="1" <?php
                                if (config_item('saas_front_slider') != '') {
                                    echo "checked";
                                } ?> />
                                <label for="ext_url" class="label-success"></label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?= lang('home_slider_speed') ?></label>

                        <div class="col-lg-6">
                            <div class="input-group">
                                <input type="text" data-parsley-type="number"
                                       value="<?php if (config_item('home_slider_speed') != '') {
                                           echo html_escape(config_item('home_slider_speed'));
                                       } ?>" name="home_slider_speed" class="form-control">
                                <div class="input-group-addon"><?= lang('second') ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"></label>
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </section>
        </form>
        <!-- End Form -->
    </div>
</div>