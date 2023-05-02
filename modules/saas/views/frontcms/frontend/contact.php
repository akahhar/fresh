<!-- contract-us area start -->
<section id="contact" class="contact-us-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-xl-8 offset-xl-2 col-lg-8 offset-lg-2">
                <?php if (config_item('saas_front_contact_title') != null) { ?>
                    <div class="section-header text-center mb-70">
                        <h2>
                            <?php if (config_item('saas_front_contact_title') != null) {
                                echo html_escape(config_item('saas_front_contact_title'));
                            } ?>
                        </h2>
                        <?php if (config_item('saas_front_contact_description') != null) { ?>
                            <p><?php echo config_item('saas_front_contact_description'); ?></p>
                        <?php } ?>
                    </div>
                <?php } ?>

                <div class="contact-form">

                    <form action="#" id="contactForm" method="post">
                        <style>
                            .hidden {
                                display: none;
                            }
                        </style>

                        <div class="alert alert-success input-success hidden" role="alert">
                            Your message sent. Thanks for contacting.
                        </div>

                        <div class="alert alert-danger input-error hidden" role="alert">
                            Sorry, something went wrong. try again later.
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="form-box mb-40">
                                    <input id="name" name="name" type="text" placeholder="Name: * ">
                                    <span class="row-border"></span>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="form-box mb-40">
                                    <input id="email" name="email" type="email" placeholder="Email: *">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="form-box mb-40">
                                    <input id="phone" name="phone" type="text" placeholder="Phone Number: *">
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="form-box mb-40">
                                    <input id="subject" name="subject" type="text" placeholder="Subject: *">
                                </div>
                            </div>
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="form-box mb-40">
                                   <textarea id="description" name="description" cols="30" rows="10"
                                             placeholder="Your Message *"></textarea>
                                </div>
                                <div class="contact-us-btn text-center mb-30">
                                    <button type="submit" class="btn primary-btn secondary-btn text-center">
                                        Contact-now
                                    </button>
                                </div>
                            </div>
                        </div>


                    </form>
                </div>
            </div>
        </div>

    </div>
</section>
<!-- contract-us area end -->
