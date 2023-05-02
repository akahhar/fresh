</main>
<!-- Footer-area start -->
<footer class="footer-area bg-light pt-100 pb-60" style="<?php if (config_item('saas_front_footer_bg')) {
    echo 'background-image: url("' . module_dirURL(SaaS_MODULE) . config_item('saas_front_footer_bg') . '")';
} elseif (config_item('saas_front_footer_bg_color')) {
    echo 'background-color:' . config_item('saas_front_footer_bg_color');
} else {
    echo 'background-color: "#f8f9fa"';
} ?>">
    <div class="container">
        <div class="row">
            <div class="col-xl-4 col-lg-4 col-md-4">
                <div class="footer-widget mb-30">
                    <h4 class="widget-title">
                        <?php
                        if (config_item('saas_front_footer_col_1_title') != '') {
                            echo html_escape(config_item('saas_front_footer_col_1_title'));
                        } ?>
                    </h4>
                    <?php
                    if (config_item('saas_front_footer_col_1_description') != '') {
                        echo config_item('saas_front_footer_col_1_description');
                    } ?>

                    <ul class="footer-icons">
                        <?php if (config_item('saas_front_facebook_link') != '') { ?>
                            <li>
                                <a target="_blank"
                                   href="<?php echo html_escape(config_item('saas_front_facebook_link')); ?>">
                                    <i class="fab fa-facebook-f"></i></a>
                            </li>
                        <?php }
                        if (config_item('saas_front_twitter_link') != '') { ?>
                            <li>
                                <a target="_blank"
                                   href="<?php echo html_escape(config_item('saas_front_twitter_link')); ?>">
                                    <i class="fab fa-twitter"></i></a>
                            </li>
                        <?php }
                        if (config_item('saas_front_google_link') != '') { ?>
                            <li>
                                <a target="_blank"
                                   href="<?php echo html_escape(config_item('saas_front_google_link')); ?>">
                                    <i class="fab fa-google-plus-g"></i></a>
                            </li>
                        <?php }
                        if (config_item('saas_front_instagram_link') != '') { ?>
                            <li>
                                <a target="_blank"
                                   href="<?php echo html_escape(config_item('saas_front_instagram_link')); ?>">
                                    <i class="fab fa-instagram"></i></a>
                            </li>
                        <?php }
                        if (config_item('saas_front_linkedin_link') != '') { ?>
                            <li>
                                <a target="_blank"
                                   href="<?php echo html_escape(config_item('saas_front_linkedin_link')); ?>">
                                    <i class="fab fa-linkedin-in"></i></a>
                            </li>
                        <?php }
                        if (config_item('saas_front_pinterest_link') != '') { ?>
                            <li>
                                <a target="_blank"
                                   href="<?php echo html_escape(config_item('saas_front_pinterest_link')); ?>">
                                    <i class="fab fa-pinterest-p"></i></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-3">
                <div class="footer-widget mb-30">
                    <h4 class="widget-title">
                        <?php
                        if (config_item('saas_front_footer_col_2_title') != '') {
                            echo html_escape(config_item('saas_front_footer_col_2_title'));
                        } ?>
                    </h4>
                    <?php
                    if (config_item('saas_front_footer_col_2_description') != '') {
                        echo config_item('saas_front_footer_col_2_description');
                    } ?>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3">
                <div class="footer-widget mb-30">
                    <h4 class="widget-title">
                        <?php
                        if (config_item('saas_front_footer_col_3_title') != '') {
                            echo html_escape(config_item('saas_front_footer_col_3_title'));
                        } ?>
                    </h4>
                    <?php
                    if (config_item('saas_front_footer_col_3_description') != '') {
                        echo config_item('saas_front_footer_col_3_description');
                    } ?>
                </div>
            </div>
            <div class="col-xl-2 col-lg-2 col-md-2">
                <h4 class="widget-title">
                    <?php
                    if (config_item('saas_front_footer_col_4_title') != '') {
                        echo html_escape(config_item('saas_front_footer_col_4_title'));
                    } ?>
                </h4>
                <?php
                if (config_item('saas_front_footer_col_4_description') != '') {
                    echo(config_item('saas_front_footer_col_4_description'));
                } ?>
            </div>
        </div>
    </div>

</footer>

<div class="cps-footer-lower">
    <div class="container">
        <div class="row">
            <div class="col-sm-6 col-xs-12 xs-text-center">
                <p class="copyright"><?= html_escape(config_item('saas_front_copyright_text')) ?></p>
            </div>
            <div class="col-sm-6 col-xs-12 text-right xs-text-center">
                <?= config_item('saas_front_footer_col_bottom_description') ?>
            </div>
        </div>
    </div>
</div>
<!-- Footer-area end -->

<div class="modal fade bd-example-modal-lg" id="modal-lg" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="modal-lg-con">
            ...
        </div>
    </div>
</div>


<div class="modal fade bd-example-modal-xl" id="modal-xl" tabindex="-1" role="dialog"
     aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content" id="modal-xl-con">
            ...
        </div>
    </div>
</div>

<div class="modal fade bd-example-modal-sm" id="modal-sm" tabindex="-1" role="dialog"
     aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" id="modal-sm-con">
            ...
        </div>
    </div>
</div>


<!-- JS here -->
<script src="<?= module_dirURL(SaaS_MODULE) ?>assets/js/vendor/modernizr-3.5.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="<?= module_dirURL(SaaS_MODULE) ?>assets/js/popper.min.js"></script>
<script src="<?= module_dirURL(SaaS_MODULE) ?>assets/js/bootstrap.min.js"></script>
<script src="<?= module_dirURL(SaaS_MODULE) ?>assets/js/owl.carousel.min.js"></script>
<script src="<?= module_dirURL(SaaS_MODULE) ?>assets/js/isotope.pkgd.min.js"></script>
<script src="<?= module_dirURL(SaaS_MODULE) ?>assets/js/one-page-nav-min.js"></script>
<script src="<?= module_dirURL(SaaS_MODULE) ?>assets/js/slick.min.js"></script>
<script src="<?= module_dirURL(SaaS_MODULE) ?>assets/js/jquery.meanmenu.min.js"></script>
<script src="<?= module_dirURL(SaaS_MODULE) ?>assets/js/ajax-form.js"></script>
<script src="<?= module_dirURL(SaaS_MODULE) ?>assets/js/wow.min.js"></script>
<script src="<?= module_dirURL(SaaS_MODULE) ?>assets/js/jquery.scrollUp.min.js"></script>
<script src="<?= module_dirURL(SaaS_MODULE) ?>assets/js/imagesloaded.pkgd.min.js"></script>
<script src="<?= module_dirURL(SaaS_MODULE) ?>assets/js/jquery.magnific-popup.min.js"></script>
<script src="<?= module_dirURL(SaaS_MODULE) ?>assets/js/js_jquery.knob.js"></script>
<script src="<?= module_dirURL(SaaS_MODULE) ?>assets/js/js_jquery.appear.js"></script>
<script src="<?= module_dirURL(SaaS_MODULE) ?>assets/js/jquery.counterup.min.js"></script>
<script src="<?= module_dirURL(SaaS_MODULE) ?>assets/js/plugins.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBvEEMx3XDpByNzYNn0n62Zsq_sVYPx1zY"></script>
<script src="<?= module_dirURL(SaaS_MODULE) ?>assets/js/main.js"></script>
<script>
    $(document).ready(function () {
        function mainSlider(Speed) {
            var BasicSlider = $('.slider-active');
            BasicSlider.on('init', function (e, slick) {
                var $firstAnimatingElements = $('.single-slider:first-child').find('[data-animation]');
                doAnimations($firstAnimatingElements);
            });
            BasicSlider.on('beforeChange', function (e, slick, currentSlide, nextSlide) {
                var $animatingElements = $('.single-slider[data-slick-index="' + nextSlide + '"]').find('[data-animation]');
                doAnimations($animatingElements);
            });
            BasicSlider.slick({
                autoplay: 1,
                autoplaySpeed: Speed,
                dots: false,
                fade: true,
                arrows: false,
                responsive: [{
                    breakpoint: 767,
                    settings: {
                        dots: false,
                        arrows: false
                    }
                }]
            });

            function doAnimations(elements) {
                var animationEndEvents = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
                elements.each(function () {
                    var $this = $(this);
                    var $animationDelay = $this.data('delay');
                    var $animationType = 'animated ' + $this.data('animation');
                    $this.css({
                        'animation-delay': $animationDelay,
                        '-webkit-animation-delay': $animationDelay
                    });
                    $this.addClass($animationType).one(animationEndEvents, function () {
                        $this.removeClass($animationType);
                    });
                });
            }
        }

        var slider_speed = "<?php echo(!empty(config_item('home_slider_speed')) ? config_item('home_slider_speed') . '000' : 5000); ?>";
        mainSlider(slider_speed);

        $(document).ready(function () {
            // Function for email address validation
            function isValidEmail(emailAddress) {
                var pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
                return pattern.test(emailAddress);
            }

            $("#contactForm").on('submit', function (e) {
                e.preventDefault();
                var submitButton = $('#contactForm .contact-us-btn button');
                // preloader when submit button is clicked
                submitButton.addClass('loading');
                submitButton.attr('disabled', 'disabled');
                var data = {
                    name: $("#name").val(),
                    email: $("#email").val(),
                    phone: $("#phone").val(),
                    subject: $("#subject").val(),
                    description: $("#description").val()
                };

                if (isValidEmail(data['email']) && (data['description'].length > 1) && (data['subject'].length > 1) && (data['name'].length > 1) &&
                    (data['phone'].length > 1)) {
                    $.ajax({
                        type: "POST",
                        url: "<?= base_url('save_faq') ?>",
                        data: data,
                        dataType: 'json', // what type of data do we expect back from the server
                        success: function (response) {
                            if (response.status == 'success') {
                                $('#contactForm .input-success').delay(500).fadeIn(1000);
                                $('#contactForm .input-error').fadeOut(500);
                            } else {
                                $('#contactForm .input-error').delay(500).fadeIn(1000);
                                $('#contactForm .input-success').fadeOut(500);
                            }
                        },
                        error: function (xhr) {
                            console.log(xhr.responseText);
                        },
                        complete: function () {
                            submitButton.removeClass('loading');
                            submitButton.removeAttr('disabled');
                        }
                    });
                } else {
                    var submitButton = $('#contactForm .contact-us-btn button');
                    // preloader when submit button is clicked
                    submitButton.addClass('loading');
                    submitButton.attr('disabled', 'disabled');
                    $('#contactForm .input-error').delay(500).fadeIn(1000).html('Please fill all fields.');
                    $('#contactForm .input-success').fadeOut(500);
                }
                return false;
            });
        });
    });
</script>
</body>

</html>