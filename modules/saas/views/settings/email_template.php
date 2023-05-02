<?php
$group = $this->uri->segment(5);
$language = $this->uri->segment(4);

if (empty($language)) {
    $system_lang = $this->admin_model->get_lang();
    if (!empty($system_lang)) {
        $language = get_any_field('tbl_languages', array('name' => $system_lang), 'code');
    } else {
        $language = 'en';
    }
}
if (!empty($group)) {
    $group = $group;
} else {
    $group = 'saas';
}
$template_group = $group;

$editor = $this->data;
switch ($template_group) {
    case "saas":
        $default = "token_activate_account";
        break;
}
$sub_menu = $this->uri->segment(6);
if (!empty($sub_menu)) {
    $sub_menu = $sub_menu;
} else {
    $sub_menu = $default;
}
$setting_email = $sub_menu;

$email['saas'] = array("token_activate_account" => array("{SITE_NAME}", "{ACTIVATION_TOKEN}", "{ACTIVATE_URL}", "{ACTIVATION_PERIOD}"),
    "saas_welcome_mail" => array("{NAME}", "{SITE_NAME}", "{COMPANY_URL}"),
    "faq_request_email" => array("{NAME}", "{LINK}", "{SITE_NAME}"),
    'assign_new_package' => array("{COMPANY}", "{SITE_NAME}", "{PACKAGE}"));

?>
<form action="<?= base_url('saas/settings/email_template/' . $language . '/') ?><?= $setting_email ?>" method="post"
      class="bs-example form-horizontal">
    <section class="panel panel-custom">
        <header class="panel-heading  "> <?= lang('email_templates') ?>
            <div class="btn-group">
                <div class="nav-item dropdown">
                    <a href="#" class="navbar-nav-link dropdown-toggle legitRipple" data-toggle="dropdown"
                       aria-expanded="false">
                        <?= lang('languages') ?>
                    </a>
                    <?php
                    $languages = $this->db->where('active', 1)->order_by('name', 'ASC')->get('tbl_languages')->result(); ?>
                    <ul class="dropdown-menu animated zoomIn">
                        <?php
                        foreach ($languages as $langs) :
                            ?>
                            <li class="<?php
                            if ($language == $langs->code) {
                                echo "active";
                            } ?>"><a href="<?= base_url('admin/settings/templates/' . $langs->code . '/') ?>"
                                     class="code"><?= lang(ucwords($langs->name)) ?></a></li>
                        <?php
                        endforeach;
                        ?>
                    </ul>
                </div>
            </div>

        </header>
        <div class="panel-body">
            <div class="col-sm-12">
                <div class="btn-group">
                    <?php
                    foreach ($email[$template_group] as $label => $temp) :
                        $lang = $label;

                        switch ($label) {
                            case "saas":
                                $lang = 'token_activate_account';
                        }
                        ?>
                        <a href="<?= base_url('saas/settings/email_template/' . $language . '/') ?><?= $template_group; ?>/<?= $label; ?>"
                           class="<?php
                           if ($setting_email == $label) {
                               echo "active";
                           }
                           ?> btn btn-default mb-sm"><?= lang($label) ?></a>
                    <?php endforeach;
                    ?>
                </div>
            </div>
            <input type="hidden" name="email_group" value="<?= $setting_email; ?>">
            <input type="hidden" name="code" id="code" value="<?= $language ?>">

            <input type="hidden" name="return_url"
                   value="<?= base_url('saas/settings/email_template/' . $language . '/') ?><?= $template_group . '/' . $setting_email; ?>">
            <div class="form-group">
                <label class="col-lg-12"><?= lang('subject') ?></label>
                <div class="col-lg-12">
                    <input class="form-control" name="subject" value="<?=
                    get_any_field('tbl_email_templates', array(
                        'email_group' => $setting_email, 'code' => $language
                    ), 'subject')
                    ?>"/>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-12"><?= lang('message') ?></label>
                <div class="available_merge_fields_container">
                    <div class="col-md-12 merge_fields_col">
                        <?php
                        foreach ($email[$template_group][$setting_email] as $ltexts) { ?>
                            <span class="ml-2"><button type="button"
                                                       class="add_merge_field"><?= $ltexts ?></button> </span>
                        <?php } ?>

                    </div>
                </div>
                <div class="col-lg-12">
                            <textarea class="form-control textarea" style="height: 600px;" name="email_template">
                                <?=
                                get_any_field('tbl_email_templates', array(
                                    'email_group' => $setting_email, 'code' => $language
                                ), 'template_body')
                                ?></textarea>

                </div>
            </div>
        </div>
        <div class="panel-footer">
            <button type="submit" class="btn btn-sm btn-primary"><?= lang('save_changes') ?></button>
        </div>
    </section>
</form>
<script>

    $('.add_merge_field').on('click', function (e) {

        document.execCommand('insertHtml', false, $(this).text());
    });
</script>