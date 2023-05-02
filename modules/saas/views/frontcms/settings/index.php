<div class="row">
    <div class="col-lg-12">
        <div class="col-md-2">
            <ul class="nav nav-pills nav-stacked navbar-custom-nav">
                <?php
                $can_do = true;
                if (!empty($can_do)) { ?>
                    <li class="<?php echo ($load_setting == 'general') ? 'active' : ''; ?>">
                        <a href="<?= base_url() ?>saas/frontcms/settings">
                            <i class="fa fa-fw fa-info-circle"></i>
                            <?= lang('general_settings') ?>
                        </a>
                    </li>
                <?php }
                if (!empty($can_do)) { ?>
                    <li class="<?php echo ($load_setting == 'pricing') ? 'active' : ''; ?>">
                        <a href="<?= base_url() ?>saas/frontcms/settings/pricing">
                            <i class="fa fa-money" aria-hidden="true"></i>
                            <?= lang('pricing') ?>
                        </a>
                    </li>
                <?php }
                if (!empty($can_do)) { ?>
                    <li class="<?php echo ($load_setting == 'contact') ? 'active' : ''; ?>">
                        <a href="<?= base_url() ?>saas/frontcms/settings/contact">
                            <i class="fa fa-phone"></i>
                            <?= lang('contact_info') ?>
                        </a>
                    </li>
                <?php }
                if (!empty($can_do)) { ?>
                    <li class="<?php echo ($load_setting == 'footer') ? 'active' : ''; ?>">
                        <a href="<?= base_url() ?>saas/frontcms/settings/footer">
                            <i class="fa fa-fw fa-cog"></i>
                            <?= lang('footer') ?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <section class="col-sm-10">
            <section class="">
                <?php $this->load->view('frontcms/settings/' . $load_setting) ?>
            </section>
        </section>
    </div>
</div>
