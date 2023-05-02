<?php echo message_box('success') ?>
<?php echo message_box('error') ?>
<div class="row">
    <!-- Start Form -->
    <div class="col-lg-12">
        <form role="form" data-parsley-validate novalidate
              action="<?php echo base_url(); ?>saas/frontcms/settings/save_contact" method="post"
              enctype="multipart/form-data" class="form-horizontal  ">
            <section class="panel panel-custom">
                <header class="panel-heading"><?= lang('contact_info') ?></header>
                <div class="panel-body pb0">
                    <div class="form-group">
                        <label class="col-lg-3 control-label"> <?= lang('title') ?> </label>
                        <div class="col-lg-6">
                            <input type="text" name="saas_front_contact_title" class="form-control"
                                   value="<?php if (config_item('saas_front_contact_title') != '') {
                                       echo html_escape(config_item('saas_front_contact_title'));
                                   } ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"> <?= lang('description') ?> </label>
                        <div class="col-lg-6">
                            <textarea name="saas_front_contact_description" class="form-control textarea_"
                                      rows="4"><?php if (config_item('saas_front_contact_description') != '') {
                                    echo html_escape(config_item('saas_front_contact_description'));
                                } ?></textarea>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-lg-3 control-label"></label>
                        <div class="col-lg-6">
                            <button type="submit" class="btn btn-sm btn-primary"><?= lang('save') ?></button>
                        </div>
                    </div>
                </div>
            </section>
        </form>
        <!-- End Form -->
    </div>
</div>
