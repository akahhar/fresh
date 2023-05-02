<!-- Page Header -->
<?php
if (config_item('saas_front_header_image') != '') {
    $header_img = config_item('saas_front_header_image');
} ?>

<style>
    .page-header {
        height: 200px;
    }

    .page-header-title h5 {
        margin-top: 100px;
        color: #ffffff;
        line-height: 1;
    }

    .page-header-title h5 span {
        font-size: 12px;
        font-weight: lighter;
    }
</style>

<!-- Page-Header -->
<div class="page-header" style="background-image: url('<?= base_url() . $header_img ?>');">
    <div class="page-header-bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-header-title d-flex align-items-center justify-content-center">
                        <h5 class="text-center">
                            <?= (!empty($title) ? $title : '') ?>
                            <br>
                            <span>
                                <?php
                                $url = end($this->uri->segments);
                                $url = str_replace('-', ' ', $url);
                                ?>
                               <a href="<?php echo site_url(); ?>">Home</a> /
                                <?php echo(!empty($url) ? ucfirst($url) : ''); ?>

                            </span>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Page-Header End-->
