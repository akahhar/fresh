<!-- Slider-area Start -->
<section id="home" class="slider-area">
    <div class="slider-active">
        <?php
        $slider_info = get_result('tbl_saas_front_slider', array('status' => 1));
        if (!empty($slider_info)) {
            foreach ($slider_info as $sliders) {
                if ($sliders->slider_bg != '') {
                    $slider_bg = $sliders->slider_bg;
                } else {
                    $slider_bg = '';
                }
                if ($sliders->slider_img != '') {
                    $slider_img = $sliders->slider_img;
                } else {
                    $slider_img = '';
                }
                ?>
                <div class="single-slider d-flex align-items-center background-style"
                     data-background="<?php echo base_url() . $slider_bg; ?>">
                    <div class="container">
                        <div class="row">
                            <div class="col-xl-6 col-lg-6">
                                <div class="slider-content">
                                    <h2 data-animation="fadeInUp" data-delay=".4s">
                                        <?php if ($sliders->title != '') {
                                            echo($sliders->title);
                                        } ?>
                                    </h2>
                                    <?php if ($sliders->subtitle != '') { ?>
                                        <h4><?php echo($sliders->subtitle); ?></h4>
                                    <?php } ?>

                                    <?php if ($sliders->description != '') { ?>
                                        <?php echo($sliders->description); ?>
                                    <?php } ?>

                                    <?php if ($sliders->button_text_1 != '' || $sliders->button_text_2 != '') { ?>
                                        <div class="slider-button">
                                            <?php if ($sliders->button_text_1 != '' || $sliders->button_link_1 != '') { ?>
                                                <a href="<?= !empty($sliders->button_link_1) ? $sliders->button_link_1 : '#' ?>"
                                                   class="btn  theme-btn mr-15 mb-3">
                                                    <?php if ($sliders->button_icon_1 != '') { ?>
                                                        <i class="<?= $sliders->button_icon_1 ?>"></i>
                                                    <?php } ?>
                                                    <?= !empty($sliders->button_text_1) ? $sliders->button_text_1 : '' ?>
                                                </a>
                                            <?php } ?>
                                            <?php if ($sliders->button_text_2 != '' || $sliders->button_link_2 != '') { ?>
                                                <a href="<?= !empty($sliders->button_link_2) ? $sliders->button_link_2 : '#' ?>"
                                                   class="btn trial-btn slider-btn mb-3">
                                                    <?php if ($sliders->button_icon_2 != '') { ?>
                                                        <i class="<?= $sliders->button_icon_2 ?>"></i>
                                                    <?php } ?>
                                                    <?= !empty($sliders->button_text_2) ? $sliders->button_text_2 : '' ?>
                                                </a>

                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 d-none d-xl-block">
                                <div class="slider-thum " data-animation="fadeInUp" data-delay=".9s">
                                    <img src="<?php echo base_url() . $slider_img; ?>" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }
        } ?>
    </div>
</section>
<!-- Slider-area end -->