<?php echo message_box('success') ?>
<?php echo message_box('error') ?>

<div class="row">
    <!-- Start Form -->
    <div class="col-lg-12">
        <form role="form" id="form" action="<?php echo base_url(); ?>saas/frontcms/settings/save_pricing" method="post"
              enctype="multipart/form-data" class="form-horizontal  ">
            <section class="panel panel-custom">
                <header class="panel-heading"><?= lang('pricing') ?></header>
                <div class="panel-body pb-sm">
                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo lang('title') ?> </label>

                        <div class="col-lg-6">
                            <input type="text" value="<?php if (config_item('saas_front_pricing_title') != '') {
                                echo config_item('saas_front_pricing_title');
                            } ?>" name="saas_front_pricing_title" class="form-control">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label"><?php echo lang('description') ?> </label>

                        <div class="col-lg-6">
                            <textarea name="saas_front_pricing_description" class="form-control textarea_"
                                      rows="3"><?php if (config_item('saas_front_pricing_description') != '') {
                                    echo config_item('saas_front_pricing_description');
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
