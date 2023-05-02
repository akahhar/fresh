<?php echo message_box('success') ?>
<?php echo message_box('error') ?>
<div class="row">
    <!-- Start Form -->
    <div class="col-lg-12">
        <form role="form" data-parsley-validate novalidate
              action="<?php echo base_url(); ?>saas/frontcms/settings/save_footer" method="post"
              enctype="multipart/form-data" class="form-horizontal  ">
            <section class="panel panel-custom">
                <header class="panel-heading">
                    <div class="panel-title">
                        <?= lang('footer') ?>
                        <div class="pull-right mt-0">
                            <button type="submit" class="btn btn-sm btn-primary"><?= lang('save') ?></button>
                        </div>
                    </div>
                </header>
                <div class="panel-body pb0">
                    <h4 class="panel-title">Col 1</h4>
                    <hr class="mt-lg">

                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?= lang('title') ?></label>
                        <div class="col-lg-6">
                            <input type="text"
                                   value="<?php if (config_item('saas_front_footer_col_1_title') != '') {
                                       echo html_escape(config_item('saas_front_footer_col_1_title'));
                                   } ?>" name="saas_front_footer_col_1_title" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Facebook </label>
                        <div class="col-lg-6">
                            <input type="text" value="<?php if (config_item('saas_front_facebook_link') != '') {
                                echo html_escape(config_item('saas_front_facebook_link'));
                            } ?>" name="saas_front_facebook_link" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Twitter </label>
                        <div class="col-lg-6">
                            <input type="text" value="<?php if (config_item('saas_front_twitter_link') != '') {
                                echo html_escape(config_item('saas_front_twitter_link'));
                            } ?>" name="saas_front_twitter_link" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Google+ </label>
                        <div class="col-lg-6">
                            <input type="text" value="<?php if (config_item('saas_front_google_link') != '') {
                                echo html_escape(config_item('saas_front_google_link'));
                            } ?>" name="saas_front_google_link" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Instagram </label>
                        <div class="col-lg-6">
                            <input type="text" value="<?php if (config_item('saas_front_instagram_link') != '') {
                                echo html_escape(config_item('saas_front_instagram_link'));
                            } ?>" name="saas_front_instagram_link" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Linkedin </label>
                        <div class="col-lg-6">
                            <input type="text" value="<?php if (config_item('saas_front_linkedin_link') != '') {
                                echo html_escape(config_item('saas_front_linkedin_link'));
                            } ?>" name="saas_front_linkedin_link" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Pinterest </label>
                        <div class="col-lg-6">
                            <input type="text" value="<?php if (config_item('saas_front_pinterest_link') != '') {
                                echo html_escape(config_item('saas_front_pinterest_link'));
                            } ?>" name="saas_front_pinterest_link" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-12"><?= lang('description') ?></label>
                        <div class="col-lg-12">
                            <textarea name="saas_front_footer_col_1_description" class="form-control textarea_"
                                      rows="4"><?php if (config_item('saas_front_footer_col_1_description') != '') {
                                    echo config_item('saas_front_footer_col_1_description');
                                } ?></textarea>
                        </div>
                    </div>

                    <h4 class="panel-title">Col 2</h4>
                    <hr class="mt-lg">

                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?= lang('title') ?></label>
                        <div class="col-lg-6">
                            <input type="text"
                                   value="<?php if (config_item('saas_front_footer_col_2_title') != '') {
                                       echo html_escape(config_item('saas_front_footer_col_2_title'));
                                   } ?>" name="saas_front_footer_col_2_title" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-12"><?= lang('description') ?></label>
                        <div class="col-lg-12">
                            <textarea name="saas_front_footer_col_2_description" class="form-control textarea_">
                               <?php if (config_item('saas_front_footer_col_2_description') != '') {
                                   echo config_item('saas_front_footer_col_2_description');
                               } ?>
                            </textarea>
                        </div>
                    </div>

                    <h4 class="panel-title">Col 3</h4>
                    <hr class="mt-lg">

                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?= lang('title') ?></label>
                        <div class="col-lg-6">
                            <input type="text"
                                   value="<?php if (config_item('saas_front_footer_col_3_title') != '') {
                                       echo html_escape(config_item('saas_front_footer_col_3_title'));
                                   } ?>" name="saas_front_footer_col_3_title" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-12"><?= lang('description') ?></label>
                        <div class="col-lg-12">
                            <textarea name="saas_front_footer_col_3_description" class="form-control textarea_">
                               <?php if (config_item('saas_front_footer_col_3_description') != '') {
                                   echo config_item('saas_front_footer_col_3_description');
                               } ?>
                            </textarea>
                        </div>
                    </div>


                    <h4 class="panel-title">Col 4</h4>
                    <hr class="mt-lg">

                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?= lang('title') ?></label>
                        <div class="col-lg-6">
                            <input type="text" value="<?php if (config_item('saas_front_footer_col_4_title') != '') {
                                echo html_escape(config_item('saas_front_footer_col_4_title'));
                            } ?>" name="saas_front_footer_col_4_title" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-12"><?= lang('description') ?></label>
                        <div class="col-lg-12">
                            <textarea name="saas_front_footer_col_4_description" class="form-control textarea_">
                               <?php if (config_item('saas_front_footer_col_4_description') != '') {
                                   echo config_item('saas_front_footer_col_4_description');
                               } ?>
                            </textarea>
                        </div>
                    </div>

                    <h4 class="panel-<?= lang('title') ?>mt-lg">Footer Bottom</h4>
                    <hr class="mt-lg">

                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?= lang('copyright_text') ?> </label>
                        <div class="col-lg-6">
                            <input type="text" value="<?php if (config_item('saas_front_copyright_text') != '') {
                                echo html_escape(config_item('saas_front_copyright_text'));
                            } ?>" name="saas_front_copyright_text" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-12"><?= lang('description') ?></label>
                        <div class="col-lg-12">
                            <textarea name="saas_front_footer_col_bottom_description"
                                      class="form-control textarea_">
                               <?php if (config_item('saas_front_footer_col_bottom_description') != '') {
                                   echo config_item('saas_front_footer_col_bottom_description');
                               } ?>
                            </textarea>
                        </div>
                    </div>
                </div>
            </section>
        </form>
        <!-- End Form -->
    </div>
</div>

