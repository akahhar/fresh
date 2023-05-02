<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo config_item('front_site_name') . ' | ' . $title; ?></title>
    <meta name="description" content="ZiscroERP">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="<?php echo base_url() . config_item('saas_front_favicon'); ?>">
    <!-- CSS here -->
    <link rel="stylesheet" href="<?= module_dirURL(SaaS_MODULE) ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= module_dirURL(SaaS_MODULE) ?>assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= module_dirURL(SaaS_MODULE) ?>assets/css/animate.min.css">
    <link rel="stylesheet" href="<?= module_dirURL(SaaS_MODULE) ?>assets/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= module_dirURL(SaaS_MODULE) ?>assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="<?= module_dirURL(SaaS_MODULE) ?>assets/css/meanmenu.css">
    <link rel="stylesheet" href="<?= module_dirURL(SaaS_MODULE) ?>assets/css/slick.css">
    <link rel="stylesheet" href="<?= module_dirURL(SaaS_MODULE) ?>assets/css/default.css">
    <link rel="stylesheet" href="<?= module_dirURL(SaaS_MODULE) ?>assets/css/style.css">
    <link rel="stylesheet" href="<?= module_dirURL(SaaS_MODULE) ?>assets/css/responsive.css">
</head>
<body>

<!-- Header strat -->
<header id="header-sticky" class="header-area">
    <!-- header-area start -->
    <div class="container">
        <div class="row">
            <div class="col-xl-2 col-lg-2 col-md-2">
                <div class="brand">
                    <a href="<?= base_url() ?>home"><img
                                src="<?php echo base_url() . config_item('saas_company_logo') ?>"
                                alt="ZiscoERP"></a>
                </div>
            </div>
            <div class="col-xl-10 col-lg-10 col-md-10 d-none d-md-block">
                <div class="main-menu f-right d-none d-xl-block">
                    <nav id="mobile-menu">
                        <ul>
                            <?php
                            $menu_list = get_row('tbl_saas_front_menus', array('slug' => 'main-menu'));
                            if (!empty($menu_list)) {
                                $main_menus = $this->cms_menuitems_model->getMenus($menu_list->id);
                                foreach ($main_menus as $menu_key => $menu_value) {
                                    $submenus = false;
                                    $cls_menu_dropdown = "";
                                    $menu_selected = "";

                                    if (!empty($active_menu) && $menu_value['page_slug'] == $active_menu) {
                                        $menu_selected = "active";
                                    }
                                    if (empty($menu_value['page_slug'])) {
                                        if ($active_menu == 'home') {
                                            $menu_selected = "active";
                                        }
                                    }
                                    if (!empty($menu_value['submenus'])) {
                                        $submenus = true;
                                        $cls_menu_dropdown = "dropdown";
                                    }
                                    if (!empty($active_menu) && $menu_value['menu'] == $active_menu) {
                                        $menu_selected = "active";
                                    }
                                    ?>

                                    <li class="<?php echo $menu_selected . " " . $cls_menu_dropdown; ?>">
                                        <?php
                                        if (!$submenus) {
                                            $top_new_tab = '';
                                            $url = '#';

                                            if ($menu_value['open_new_tab']) {
                                                $top_new_tab = "target='_blank'";
                                            }
                                            if ($menu_value['ext_url']) {
                                                $url = $menu_value['ext_url_link'];
                                            } else {
                                                $url = site_url($menu_value['page_url']);
                                            }
                                            ?>

                                            <a href="<?php echo $url; ?>" <?php echo $top_new_tab; ?>><?php echo $menu_value['menu']; ?></a>

                                            <?php
                                        } else {
                                            $child_new_tab = '';
                                            $url = '#';
                                            ?>
                                            <a href="#" class="dropdown-toggle"
                                               data-toggle="dropdown"><?php echo $menu_value['menu']; ?> <b
                                                        class="caret"></b></a>
                                            <ul class="submenu">
                                                <?php
                                                foreach ($menu_value['submenus'] as $submenu_key => $submenu_value) {
                                                    if ($submenu_value['open_new_tab']) {
                                                        $child_new_tab = "target='_blank'";
                                                    }
                                                    if ($submenu_value['ext_url']) {
                                                        $url = $submenu_value['ext_url_link'];
                                                    } else {
                                                        $url = site_url($submenu_value['page_url']);
                                                    }
                                                    ?>
                                                    <li>
                                                        <a href="<?php echo $url; ?>" <?php echo $child_new_tab; ?> ><?php echo $submenu_value['menu'] ?></a>
                                                    </li>
                                                    <?php
                                                }
                                                ?>

                                            </ul>

                                            <?php
                                        }
                                        ?>


                                    </li>
                                    <?php
                                }
                            }
                            ?>
                            <li class="">
                                <a class="btn primary-btn header-btn" href="<?= base_url() ?>login"><i
                                            class="fal fa-user"></i><?= lang('sign_in') ?><i class="material-icons"></i></a>
                            </li>
                        </ul>

                    </nav>
                </div>
            </div>
            <div class="col-12">
                <div class="zekio-mobile-menu"></div>
            </div>
        </div>
    </div>
    <!-- header-area end -->
</header>
<!-- header end -->
<main>