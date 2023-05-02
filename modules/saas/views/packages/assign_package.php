<form action="<?= base_url('checkoutPayment') ?>" class="form-horizontal"
      enctype="multipart/form-data" data-parsley-validate="" role="form" method="post" accept-charset="utf-8"
      novalidate="">
    <style type="text/css">
        section.package-section {
            background: #fff;
            color: #7a90ff;
            /*padding: 2em 0 8em;*/
            /*min-height: 100vh;*/
            position: relative;
            -webkit-font-smoothing: antialiased;
            /*margin-top: 30px;*/
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
            margin-bottom: 2em !important;
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
            background-color: #3378ff;
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

        .pricing_check {
            color: #3378ff;
        }

        .pricing_times {
            color: red;
        }

        .ribbon-wrapper-red {
            width: 85px;
            height: 88px;
            overflow: hidden;
            position: absolute;
            top: -3px;
            right: -3px;
            z-index: 1;
        }

        .ribbon-red {
            font: 700 15px Sans-Serif;
            text-align: center;
            text-shadow: hsla(0, 0%, 100%, .5) 0 1px 0;
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            position: relative;
            padding: 7px 0;
            right: 10px;
            top: 16px;
            width: 122px;
            background-color: #f90000;
            color: #ffffff;
            background-image: -o-linear-gradient(top, #bfdc7a, #8ebf45);
            -webkit-box-shadow: 0 0 3px rgba(0, 0, 0, .3);
            box-shadow: 0 0 3px rgba(0, 0, 0, .3);
        }

    </style>
    <div class="row">
        <?php
        if ($all_packages) {
            foreach ($all_packages as $package) {
                ?>
                <div class="col-lg-3 main_package">
                    <section class="package-section">
                        <div class='packaging packaging-palden'>
                            <div class='packaging-item'>
                                <?php if (!empty($current_package) && $current_package == $package->id) { ?>
                                    <div class="ribbon-wrapper-red">
                                        <div class="ribbon-red"><?= lang('current') ?></div>
                                    </div>
                                <?php } ?>
                                <div class='packaging-deco custom-bg'>
                                    <svg class='packaging-deco-img' enable-background='new 0 0 300 100' height='100px'
                                         id='Layer_1'
                                         preserveAspectRatio='none' version='1.1' viewBox='0 0 300 100' width='300px'
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
                                    <?= saas_packege_list($package, 6) ?>
                                </ul>

                                <a data-toggle="modal" data-target="#myModal" class="text-center"
                                   href="<?= base_url('package_details/' . $package->id) ?>"><?= lang('see_details') ?></a>
                                <div class="pricing-btn text-center mt mb-lg">
                                    <button type="submit" value="<?= $package->id ?>" name="package_id"
                                            class="btn btn-primary">
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
</form>