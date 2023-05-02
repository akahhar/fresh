<style>
    #sync_result {
        background-color: #adebad;
        font-size: 1.5em;
        text-align: center;
    }

    .btn-group div {
        padding-top: 30px;
    }

    .btn-group button {
        font-size: 1.5em;
    }

    #lt_overlay {
        display: none;
        position: fixed;
        top: 0%;
        left: 0%;
        width: 100%;
        height: 100%;
        background-color: black;
        z-index: 1001;
        -moz-opacity: 0.6;
        opacity: .60;
        filter: alpha(opacity=60);
    }

    #lt_loading {
        display: none;
        position: fixed;
        color: #ccc;
        top: 30%;
        left: 40%;
        padding: 20px;
        z-index: 1002;
        overflow: auto;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <?php echo message_box('success'); ?>
        <?php echo message_box('error'); ?>
    </div>
    <div class="col-md-11">
        <?php
        if (empty($storage->getSession()) || ($_SESSION['oauth2']['expires'] !== null && $_SESSION['oauth2']['expires'] <= time())) { ?>
            <a href="<?php echo base_url(); ?>admin/xero/authorization"><img
                        src="<?php echo base_url(); ?>modules/xero/images/connect-blue.svg"></a>

        <?php } else {
            $time_left = round(($_SESSION['oauth2']['expires'] - time()) / 60);
            ?>
            <h1>You are now connected to Xero</h1>
        <?php } ?>
    </div>
    <div class="col-md-1">
        <a href="<?php echo base_url(); ?>admin/xero/settings" class="pull-right" data-toggle="tooltip"
           title="Xero Settings"><i class="fa fa-cog"></i></a>
    </div>

    <?php if (empty($storage->getSession()) || ($_SESSION['oauth2']['expires'] !== null && $_SESSION['oauth2']['expires'] <= time())) {
    } else { ?>
    <div class="col-md-12">
        </br>
        <div id="sync_result">
        </div>
        </br>
        <div class="btn-group">
            <div class=" col-sm-4">
                <button id="items_sync" class="btn  btn-success"><i class="fa fa-refresh"></i> Synchronize Items
                </button>
            </div>
            <div class=" col-sm-4">
                <button id="clients_sync" class="btn  btn-success"><i class="fa fa-refresh"></i> Synchronize Clients
                </button>
            </div>
            <div class=" col-sm-4">
                <button id="invoices_sync" class="btn  btn-success"><i class="fa fa-refresh"></i> Synchronize Invoices
                </button>
            </div>
            <div class=" col-sm-4">
                <button id="payments_sync" class="btn  btn-success"><i class="fa fa-refresh"></i> Synchronize Payments
                </button>
            </div>
            <div class=" col-sm-4">
                <button id="suppliers_sync" class="btn  btn-success"><i class="fa fa-refresh"></i> Synchronize Suppliers
                </button>
            </div>
            <div class=" col-sm-4">
                <button id="purchases_sync" class="btn  btn-success"><i class="fa fa-refresh"></i> Synchronize Purchases
                </button>
            </div>
            <div class=" col-sm-4">
                <button id="purchase_pay_sync" class="btn  btn-success"><i class="fa fa-refresh"></i> Purchase Payments
                </button>
            </div>
            <div class=" col-sm-4">
                <button id="projects_sync" class="btn  btn-success"><i class="fa fa-refresh"></i> Synchronize Projects
                </button>
            </div>
        </div>

    </div>
</div>
<?php } ?>

<script>
    $(function () {
        'use strict';
        $(document).ready(function () {
            $("#clients_sync").on("click", function () {
                ins_data_2(base_url + "admin/xero/clients");
            });
            $("#suppliers_sync").on("click", function () {
                ins_data_2(base_url + "admin/xero/suppliers");
            });
            $("#items_sync").on("click", function () {
                ins_data_2(base_url + "admin/xero/items");
            });
            $("#invoices_sync").on("click", function () {
                ins_data_2(base_url + "admin/xero/invoices");
            });
            $("#purchases_sync").on("click", function () {
                ins_data_2(base_url + "admin/xero/purchases");
            });
            $("#purchase_pay_sync").on("click", function () {
                ins_data_2(base_url + "admin/xero/purchase_payments");
            });
            $("#projects_sync").on("click", function () {
                ins_data_2(base_url + "admin/xero/projects");
            });
            $("#payments_sync").on("click", function () {
                ins_data_2(base_url + "admin/xero/payments");
            });
        });
    });

    function ins_data_2(url, datastring = '') {
        $(this).html("");
        $.ajax({
            async: false,
            url: url,
            type: 'post',
            data: datastring,
            dataType: "json",
            beforeSend: function () {
                showOverlay();
            },
            success: function (data) {
                if (data.success == 'reload') {
                    location.reload();
                }
                hideOverlay();
                $.each(data, function (index, value) {
                    $('#' + index).empty().html(value);
                });

            },
            error: function () {
                hideOverlay();
            }

        });

    }

    function showOverlay() {
        var oDiv = $("<div></div>");
        oDiv.attr("id", "lt_overlay");
        oDiv.css("display", "block");
        $("body").append(oDiv);
        var lDiv = $("<i></i>");
        lDiv.attr("id", "lt_loading");
        lDiv.addClass("fa fa-cog fa-spin fa-5x");
        lDiv.css("display", "block");
        $("body").append(lDiv);
    }

    function hideOverlay() {
        $("#lt_loading").remove();
        $("#lt_overlay").remove();
    }
</script>