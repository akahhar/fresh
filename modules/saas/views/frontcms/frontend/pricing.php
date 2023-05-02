<div class="cps-section" id="subscription-area" style="padding: 50px 0;">
    <div class="container">
        <div class="section-header text-center">
            <h2>
                <?php if (config_item('saas_front_contact_title') != '') {
                    echo config_item('saas_front_pricing_title');
                } ?>
            </h2>
            <p class="mb-lg">
                <?php if (config_item('saas_front_pricing_description') != '') {
                    echo config_item('saas_front_pricing_description');
                } ?>
            </p>
        </div>
        <div class="error_login">
            <?php
            $error = $this->session->flashdata('error');
            $success = $this->session->flashdata('success');
            if (!empty($error)) {
                ?>
                <div class="alert alert-danger">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    <?php echo $error; ?>
                </div>
            <?php } ?>
            <?php if (!empty($success)) { ?>
                <div class="alert alert-success">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                    <?php echo $success; ?>
                </div>
            <?php } ?>
        </div>
        <div class="full-body">
            <script src="<?= module_dirURL(SaaS_MODULE) ?>assets/js/vendor/jquery-1.12.4.min.js"></script>

            <?= form_open(base_url('sign-up'), array('class' => 'form-horizontal', 'id' => 'contact-form', 'enctype' => 'multipart/form-data', 'data-parsley-validate' => '', 'role' => 'form')); ?>


            <style type="text/css">
                .mb-lg {
                    margin-bottom: 30px !important;
                }

                .mt {
                    margin-top: 20px !important;
                }

                .custom-bg {
                    background: #432cd4 !important;
                    color: #FFFFff !important;
                }

                section.package-section {
                    background: #fff;
                    color: #7a90ff;
                    /*padding: 2em 0 8em;*/
                    /*min-height: 100vh;*/
                    position: relative;
                    -webkit-font-smoothing: antialiased;
                    /*margin-top: 30px;*/
                    margin-bottom: 2em !important;
                    border-radius: 10px !important;

                }

                .packaging {
                    display: -webkit-flex;
                    display: flex;
                    -webkit-flex-wrap: wrap;
                    flex-wrap: wrap;
                    -webkit-justify-content: center;
                    justify-content: center;
                    width: 100%;
                    /*margin: 0 auto 3em;*/
                }

                .packaging-item {
                    position: relative;
                    display: -webkit-flex;
                    display: flex;
                    -webkit-flex-direction: column;
                    flex-direction: column;
                    -webkit-align-items: stretch;
                    align-items: stretch;
                    text-align: center;
                    -webkit-flex: 0 1 550px;
                    flex: 0 1 550px;
                    /*margin-bottom: 2em !important;*/
                }

                .packaging-action {
                    color: inherit;
                    border: none;
                    background: none;
                }

                .packaging-action:focus {
                    outline: none;
                }

                .packaging-feature-list {
                    text-align: left;
                }

                .packaging-palden .packaging-item {
                    font-family: 'Open Sans', sans-serif;
                    cursor: default;
                    color: #84697c;
                    background: #fff;
                    box-shadow: 0 0 10px rgba(46, 59, 125, 0.23);
                    border-radius: 20px 20px 10px 10px;
                    /*margin: 1em;*/
                }

                @media screen and (min-width: 66.25em) {
                    .packaging-palden .packaging__item--featured {
                        margin: 0;
                        z-index: 10;
                        box-shadow: 0 0 20px rgba(46, 59, 125, 0.23);
                    }
                }

                .packaging-palden .packaging-deco {
                    /*border-radius: 10px 10px 0 0;*/
                    padding: 2em 0 10em;
                    position: relative;
                }

                .packaging-palden .packaging-deco-img {
                    position: absolute;
                    bottom: 0;
                    left: 0;
                    width: 100%;
                    height: 160px;
                }

                .main_package .packaging-palden .packaging-title {
                    font-size: 0.8em;;
                    margin: 0;
                    text-transform: uppercase;
                    font-weight: bold;
                    letter-spacing: normal !important;
                    color: #fff;
                }

                .packaging-palden .deco-layer {
                    -webkit-transition: -webkit-transform 0.5s;
                    transition: transform 0.5s;
                }

                .packaging-palden .packaging-item:hover .deco-layer--1 {
                    -webkit-transform: translate3d(15px, 0, 0);
                    transform: translate3d(15px, 0, 0);
                }

                .packaging-palden .packaging-item:hover .deco-layer--2 {
                    -webkit-transform: translate3d(-15px, 0, 0);
                    transform: translate3d(-15px, 0, 0);
                }

                .packaging-palden .icon {
                    font-size: 2.5em;
                }

                .main_package .packaging-palden .packaging-package {
                    font-size: 3em;
                    font-weight: bold;
                    padding: 0;
                    color: #fff;
                    margin: 0 0 0.25em 0;
                    line-height: 0.75;
                }

                .main_package .packaging-palden .packaging-currency {
                    font-size: 0.15em;
                    vertical-align: top;
                }

                .packaging-palden .packaging-period {
                    font-size: 0.15em;
                    padding: 0 0 0 0.5em;
                    font-style: italic;
                }

                .packaging-palden .packaging__sentence {
                    font-weight: bold;
                    margin: 0 0 1em 0;
                    padding: 0 0 0.5em;
                }

                .packaging-palden .packaging-feature-list {
                    margin: 0;
                    padding: 0.25em 0 15px;
                    list-style: none;
                    /*text-align: center;*/
                }

                .packaging-palden .packaging-feature {
                    padding: 2px 0;
                }

                .packaging-palden li.packaging-feature {
                    border-bottom: 1px dashed #564aa3;
                    margin-right: 33px;
                    margin-left: 20px;
                }

                .packaging-palden .packaging-action {
                    font-weight: bold;
                    margin: auto 3em 2em 3em;
                    padding: 1em 2em;
                    color: #fff;
                    border-radius: 30px;
                    -webkit-transition: background-color 0.3s;
                    transition: background-color 0.3s;
                }

                .packaging-palden .packaging-action:hover, .packaging-palden .packaging-action:focus {
                    background-color: #432cd4;
                }

                .packaging-palden .packaging-item--featured .packaging-deco {
                    padding: 5em 0 8.885em 0;
                }

                .packaging-feature i {
                    font-size: 15px;
                    float: left;
                    margin: 0px 8px 0px 0px;;
                }

                .custom_ul {
                    list-style: none;
                    padding: 0.25em 13px 0px;;
                }

                .custom_ul li {
                    border-bottom: 1px dashed #564aa3;
                    padding: 4px 0px;
                }

                .custom_ul li a {
                    padding: 0.25em 0 2.5em;
                }

                .custom_ul i {
                    font-size: 15px;
                    /*float: left;*/
                    margin: 0px 8px 0px 0px;;
                }

                .main_package .package_position {
                    text-align: initial;
                    margin: 20px;
                    display: flex;
                    flex-direction: row;
                    align-content: center;
                    justify-content: space-between;
                }

                .secondary-btn {
                    color: rgba(0, 0, 0, .87);
                    border-color: rgb(66 43 211);
                    position: relative;
                    z-index: 1;
                    font-weight: bold;
                    border-width: 2px;
                }

                .pricing_check {
                    color: #432cd4;
                }

                .pricing_times {
                    color: red;
                }

                .pt-0 {
                    padding-top: 0 !important;
                }

            </style>
            <div class="row col-lg-12">
                <?php
                $all_packages = get_result('tbl_saas_packages', array('status' => 'published'));

                if ($all_packages) {
                    foreach ($all_packages as $package) {
                        ?>
                        <div class="col-lg-4 main_package">
                            <section class="package-section">
                                <div class='packaging packaging-palden'>
                                    <div class='packaging-item'>
                                        <div class='packaging-deco custom-bg'>
                                            <svg class='packaging-deco-img' enable-background='new 0 0 300 100'
                                                 height='100px'
                                                 id='Layer_1'
                                                 preserveAspectRatio='none' version='1.1' viewBox='0 0 300 100'
                                                 width='300px'
                                                 x='0px'
                                                 xml:space='preserve'
                                                 xmlns='http://www.w3.org/2000/svg'
                                                 y='0px'>
          <path class='deco-layer deco-layer--1'
                d='M30.913,43.944c0,0,42.911-34.464,87.51-14.191c77.31,35.14,113.304-1.952,146.638-4.729&#x000A;c48.654-4.056,69.94,16.218,69.94,16.218v54.396H30.913V43.944z'
                fill='#FFFFFF' opacity='0.6'></path>
                                                <path class='deco-layer deco-layer--2'
                                                      d='M-35.667,44.628c0,0,42.91-34.463,87.51-14.191c77.31,35.141,113.304-1.952,146.639-4.729&#x000A;c48.653-4.055,69.939,16.218,69.939,16.218v54.396H-35.667V44.628z'
                                                      fill='#FFFFFF' opacity='0.6'></path>
                                                <path class='deco-layer deco-layer--3'
                                                      d='M43.415,98.342c0,0,48.283-68.927,109.133-68.927c65.886,0,97.983,67.914,97.983,67.914v3.716&#x000A;H42.401L43.415,98.342z'
                                                      fill='#FFFFFF' opacity='0.7'></path>
                                                <path class='deco-layer deco-layer--4'
                                                      d='M-34.667,62.998c0,0,56-45.667,120.316-27.839C167.484,57.842,197,41.332,232.286,30.428&#x000A;c53.07-16.399,104.047,36.903,104.047,36.903l1.333,36.667l-372-2.954L-34.667,62.998z'
                                                      fill='#FFFFFF'></path>
                            </svg>

                                            <div class='packaging-package'><span
                                                        class='packaging-currency'> </span><?= $package->name ?>
                                                <span class='packaging-period'></span>
                                            </div>

                                            <div class="package_position">
                                                <?php
                                                echo package_price($package);
                                                ?>
                                            </div>


                                        </div>
                                        <ul class='packaging-feature-list'>
                                            <?= saas_packege_list($package, 6, true) ?>
                                        </ul>

                                        <span onclick="packageDetails(<?= $package->id ?>)" style="cursor: pointer"
                                              class="text-center pricing_check"><?= lang('see_details') ?></span>

                                        <div class="pricing-btn text-center mt mb-lg">
                                            <button type="button" value="<?= $package->id ?>" name="package_id"
                                                    class="btn primary-btn pricing-btn secondary-btn"
                                                    onclick="choosePlan(<?= $package->id ?>)">
                                                <?= lang('buy_now') ?>
                                            </button>
                                        </div>

                                    </div>

                                </div>
                            </section>
                        </div>
                    <?php }
                }
                ?>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<div class="modal fade" id="package_details_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title" id="myModalLabel"><?= lang('package_details') ?></span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body pt-0" id="package_details">
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">


    // get package details by ajax and show in modal
    function packageDetails(package_id) {
        $.ajax({
            url: "<?= base_url() ?>saas/gb/get_package_info/",
            type: "POST",
            data: {package_id: package_id},
            dataType: "json",
            success: function (data) {
                $('#package_details').html(data.package_details);
                $('#package_details_modal').modal('show');

            }
        });
    }

    function choosePlan(package_id) {
        $.ajax({
            url: "<?= base_url() ?>saas/gb/signup_company/",
            type: "POST",
            data: {package_id: package_id},
            dataType: "json",
            success: function (data) {
                $('#modal-xl-con').html(data.subview);
                $('#modal-xl').modal();
            }
        });
    }

    function getPackageData(package_id, only_details = false) {
        $.ajax({
            url: "<?= base_url() ?>saas/gb/get_package_info/",
            type: "POST",
            data: {package_id: package_id},
            dataType: "json",
            success: function (data) {
                if (only_details) {
                    $('#package_details').html(data.package_details);
                    $('#package_details_modal').modal('show');
                } else {
                    $('#modal-xl-con').html(data.package_details);
                    $('#modal-xl').modal();
                }

            }
        });
    }
</script>