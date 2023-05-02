<style>
        #Settings {
                font-size:2em;
        }
        #sync_result {
                background-color: #adebad;
                font-size: 1.5em;
                text-align: center;
        }
</style>
<div class="row">
        <div class="col-md-12">
                <?php echo message_box('success'); ?>
                <?php echo message_box('error'); ?>
        </div>
        <div class="col-md-11">
                <?php

                if (!isset($accessToken)) { ?>
                        <a href="#" onclick="oauth.loginPopup()" ><img src="<?php echo base_url(); ?>modules/quickbooks/assets/images/C2QB_green_btn_lg_default.png" width="178"></a>

                <?php } else {

        }  ?>
        </div>
        <div class="col-md-1">
                <a id='Settings'  href="<?php echo base_url(); ?>admin/quickbooks/settings" class="pull-right" data-toggle="tooltip" title="qucikbooks Settings"><i class="fa fa-cog"></i></a>
        </div>
<?php
        if (isset($accessToken)) { ?>

                <div class="col-md-12">

                        </br>
                        <div id="sync_result" style="background-color:#adebad; font-size:1.5em; text-align:center;">

                        </div>
                        <style>
                                .btn-group div {
                                        padding-top: 30px;
                                }

                                .btn-group button {
                                        font-size: 1.5em;
                                }
                        </style>
                        </br>
                        <div class="btn-group">
                                <div class=" col-sm-4"><button id="items_sync" class="btn  btn-success"><i class="fa fa-refresh"></i> Synchronize Items</button></div>
                                <div class=" col-sm-4"> <button id="clients_sync" class="btn  btn-success"><i class="fa fa-refresh"></i> Synchronize Clients</button></div>
                                <div class=" col-sm-4"><button id="invoices_sync" class="btn  btn-success"><i class="fa fa-refresh"></i> Synchronize Invoices</button></div>
                                <div class=" col-sm-4"> <button id="payments_sync" class="btn  btn-success"><i class="fa fa-refresh"></i> Synchronize Payments</button></div>
                                <div class=" col-sm-4"><button id="suppliers_sync" class="btn  btn-success"><i class="fa fa-refresh"></i> Synchronize Suppliers</button></div>
                                <div class=" col-sm-4"> <button id="purchases_sync" class="btn  btn-success"><i class="fa fa-refresh"></i> Synchronize Purchases</button></div>
                                <div class=" col-sm-4"> <button id="expenses_sync" class="btn  btn-success"><i class="fa fa-refresh"></i> Synchronize Expenses</button></div>
                                <!-- <div class=" col-sm-4"> <button id="purchase_pay_sync" class="btn  btn-success"><i class="fa fa-refresh"></i> Purchase Payments</button></div>-->
                                <div class=" col-sm-4"> <button id="projects_sync" class="btn  btn-success"><i class="fa fa-refresh"></i> Synchronize Projects</button></div>
                        </div>

                </div>
</div>
<?php  } ?>
<style>
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

<script>
"use strict";
var url = '<?php echo $authUrl; ?>';

var OAuthCode = function(url) {

    this.loginPopup = function (parameter) {
        this.loginPopupUri(parameter);
    }

    this.loginPopupUri = function (parameter) {

        // Launch Popup
        var parameters = "location=1,width=800,height=650";
        parameters += ",left=" + (screen.width - 800) / 2 + ",top=" + (screen.height - 650) / 2;

        var win = window.open(url, 'connectPopup', parameters);
        var pollOAuth = window.setInterval(function () {
            try {

                if (win.document.URL.indexOf("code") != -1) {
                    window.clearInterval(pollOAuth);
                    win.close();
                    location.reload();
                }
            } catch (e) {
                console.log(e)
            }
        }, 100);
    }
}

var oauth = new OAuthCode(url);

$(document).ready(function() {
        "use strict";
                $("#clients_sync").click(function() {
                        ins_data_2(base_url + "admin/quickbooks/clients");
                });
                $("#suppliers_sync").click(function() {
                        ins_data_2(base_url + "admin/quickbooks/suppliers");
                });
                $("#items_sync").click(function() {
                        ins_data_2(base_url + "admin/quickbooks/items");
                });
                $("#invoices_sync").click(function() {
                        ins_data_2(base_url + "admin/quickbooks/invoices");
                });
                $("#purchases_sync").click(function() {
                        ins_data_2(base_url + "admin/quickbooks/purchases");
                });
                $("#expenses_sync").click(function() {
                        ins_data_2(base_url + "admin/quickbooks/expenses");
                });
                $("#purchase_pay_sync").click(function() {
                        ins_data_2(base_url + "admin/quickbooks/purchase_payments");
                });
                $("#projects_sync").click(function() {
                        ins_data_2(base_url + "admin/quickbooks/projects");
                });
                $("#payments_sync").click(function() {
                        ins_data_2(base_url + "admin/quickbooks/payments");
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
                        // data: { search: request.ter},
                        beforeSend: function() {
                                showOverlay();
                        },
                        success: function(data) {
                                hideOverlay();
                                if (data.success == 'reload') {
                                        location.reload();
                                }
                                $.each(data, function(index, value) {
                                        $('#' + index).empty().html(value);
                                });

                        },
                        error: function() {
                                hideOverlay();
                        }

                });

        }

        function showOverlay() {
                // Adds the fullscreen overlay
                var oDiv = $("<div></div>");
                oDiv.attr("id", "lt_overlay");
                oDiv.css("display", "block");
                $("body").append(oDiv);

                // Adds the spinner
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