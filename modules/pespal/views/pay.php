<?php
echo message_box('success');
echo message_box('error');
?>
<div class="panel panel-custom">
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><?= lang('new_payment') ?></h4>
    </div>
    <div class="modal-body">
        <p><?php //echo lang('myfatoorah_redirection_alert')
            ?></p>
        <?php
        $attributes = array('name' => 'paypal_form', 'data-parsley-validate' => "", 'novalidate' => "", 'class' => 'bs-example form-horizontal');
        echo form_open($url, $attributes);
        if (!empty($error)) { ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php }
        $this->session->unset_userdata('form_error');

        $cur = $this->invoice_model->check_by(array('code' => $invoice_info['currency']), 'tbl_currencies');
        $allow_customer_edit_amount = config_item('allow_customer_edit_amount');
        ?>

        <?php if (!empty($allow_customer_edit_amount) && $allow_customer_edit_amount == 'No') { ?>
            <input name="amount" value="<?= ($invoice_info['amount']) ?>" type="hidden">
        <?php } ?>
        <input name="currency" value="<?= ($invoice_info['currency']) ?>" type="hidden">
        <div class="form-group">
            <label class="col-lg-4 control-label"><?= lang('reference_no') ?></label>
            <div class="col-lg-4">
                <input type="text" name="reference_no" class="form-control" readonly value="<?= $invoice_info['item_name'] ?>">
            </div>
        </div>

        <div class="form-group">
            <label class="col-lg-4 control-label"><?= lang('amount') ?> ( <?= $cur->symbol ?>) </label>
            <div class="col-lg-4">
                <?php if (!empty($allow_customer_edit_amount) && $allow_customer_edit_amount == 'Yes') { ?>
                    <input type="text" required name="amount" data-parsley-type="number" data-parsley-max="<?= $invoice_info['amount'] ?>" class="form-control" value="<?= ($invoice_info['amount']) ?>">
                <?php } else { ?>
                    <input type="text" name="amount" class="form-control" value="<?= $invoice_info['amount'] ?>" readonly>
                <?php } ?>
            </div>
        </div>

        <?php   if(!empty($PaymentMethods )) { ?>
        <div class="form-group">
            <label class="col-lg-4 control-label"><?= lang('select_payment') ?> </label>
            <div class="col-lg-8 row ">
                <?php foreach ($PaymentMethods as $val) { ?>
                    <div class="col-md-2 nopad text-center" data-toggle="tooltip" data-placement="top" title="<?php echo $val->PaymentMethodEn; ?>">
                        <label class="image-radio">
                            <img class="thumnail" src="<?php echo $val->ImageUrl; ?>" alt="<?php echo $val->PaymentMethodEn; ?>" />
                            <input type="radio" required name="PaymentMethodId" value="<?php echo $val->PaymentMethodId; ?>" />
                            <i class="fa fa-check hidden"></i>


                        </label>
                    </div>
                <?php }?>
            </div>
        </div>

        <?php }?>

        <style type="text/css">
            .image-radio {
                cursor: pointer;
                box-sizing: border-box;
                -moz-box-sizing: border-box;
                -webkit-box-sizing: border-box;
                border: 4px solid transparent;
                margin-bottom: 0;
                outline: 0;
                /*border: 1px solid red;*/
                overflow: hidden;
            }

            .image-radio .thumnail {
                width: 100%;
                height: 50px;
            }

            .image-radio input[type="radio"] {
                display: none;
            }

            .image-radio-checked {
                border-color: #3378ff;
            }

            .image-radio .fa {
                position: absolute;
                color: #fff;
                background: #564aa38c;
                padding: 6px 17px 10px 14px;
                font-size: 34px;
                padding: 10px;
                top: 0;
                width: 70%;
            }

            .image-radio-checked .fa {
                display: block !important;
            }
        </style>


        <script type="text/javascript">
            $(document).ready(function() {
                // add/remove checked class
                $(".image-radio").each(function() {
                    if ($(this).find('input[type="radio"]').first().attr("checked")) {
                        $(this).addClass('image-radio-checked');
                    } else {
                        $(this).removeClass('image-radio-checked');
                    }
                });

                // sync the input state
                $(".image-radio").on("click", function(e) {
                    $(".image-radio").removeClass('image-radio-checked');
                    $(this).addClass('image-radio-checked');
                    var $radio = $(this).find('input[type="radio"]');
                    $radio.prop("checked", !$radio.prop("checked"));

                    e.preventDefault();
                });
            });
        </script>



        <div class="modal-footer"><a href="#" class="btn btn-default" data-dismiss="modal"><?= lang('close') ?></a>
            <button type="submit" class="btn btn-success"><?= lang('pay_invoice') ?></button>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<!-- /.modal-content -->