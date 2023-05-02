<?= message_box('success') ?>
<?= message_box('error'); ?>
<?php
$sales_info = get_result('tbl_deals_items', array('deals_id' => $id));

?>
<div class="panel" id="sales_details">
    <div class="panel-body mt-lg">
        <style type="text/css">
            .dragger {
                background: url(../../../../assets/img/dragger.png) 0px 11px no-repeat;
                cursor: pointer;
            }

            .table>tbody>tr>td {
                vertical-align: initial;
            }
        </style>
        <span data-toggle="tooltip" data-placement="top" title="<?= lang('from_items') ?>">
            <a data-toggle="modal" data-target="#myModal_lg" href="<?= base_url() ?>admin/deals/deals_items/<?= $id ?>" title="<?= lang('item_quick_add') ?>" class="btn btn-xs btn-primary">
                <i class="fa fa-pencil text-white"></i> <?= lang('add_items') ?></a>
        </span><br><br>
        <div class="table-responsive mb-lg">
            <table class="table items invoice-items-preview" page-break-inside: auto;>
                <thead class="bg-items">
                    <tr>
                        <th>#</th>
                        <th><?= lang('items') ?></th>
                        <!-- <?php
                                $invoice_view = config_item('invoice_view');
                                if (!empty($invoice_view) && $invoice_view == '2') {
                                ?>
                            <th><?= lang('hsn_code') ?></th>
                        <?php } ?>
                        <?php
                        $qty_heading = lang('qty');
                        if (isset($sales_info) && $sales_info->show_quantity_as == 'hours' || isset($hours_quantity)) {
                            $qty_heading = lang('hours');
                        } else if (isset($sales_info) && $sales_info->show_quantity_as == 'qty_hours') {
                            $qty_heading = lang('qty') . '/' . lang('hours');
                        }
                        ?> -->
                        <th><?php echo $qty_heading; ?></th>
                        <th class="col-sm-1"><?= lang('price') ?></th>
                        <th class="col-sm-2"><?= lang('tax') ?></th>
                        <th class="col-sm-1"><?= lang('total') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($sales_info) {
                        foreach ($sales_info as $key => $v_item) :
                            $item_tax_name = json_decode($v_item->item_tax_name);
                    ?>
                            <tr class="sortable item" data-item-id="">
                                <td class="item_no dragger pl-lg"><?= $key + 1 ?></td>
                                <td><strong class="block"><?= $v_item->item_name ?>
                                </td>
                                <?php
                                $invoice_view = config_item('invoice_view');
                                if (!empty($invoice_view) && $invoice_view == '2') {
                                ?>
                                    <td><?= $v_item->hsn_code ?></td>
                                <?php } ?>
                                <td><?= $v_item->quantity . '   &nbsp' . $v_item->unit ?></td>
                                <td><?= display_money($v_item->unit_cost) ?></td>
                                <td><?php
                                    $tax_total = array();
                                    if (!empty($item_tax_name)) {
                                        foreach ($item_tax_name as $v_tax_name) {
                                            $i_tax_name = explode('|', $v_tax_name);
                                            $tax_total_cost = $v_item->total_cost / 100 * $i_tax_name[1];
                                            // $tax_total[$i_tax_name[0]] += $tax_total_cost;
                                            // print('<pre>' . print_r($tax_total, true) . '</pre>');
                                            // exit;

                                            echo '<small class="pr-sm">' . $i_tax_name[0] . ' (' . $i_tax_name[1] . ' %)' . '</small>' . display_money($tax_total_cost) . ' <br>';
                                        }
                                    }
                                    ?></td>
                                <td><?= display_money($v_item->total_cost) ?></td>
                            </tr>
                        <?php endforeach;
                    } else { ?>
                        <tr>
                            <td colspan="8"><?= lang('nothing_to_display') ?></td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
        <div class="row" style="margin-top: 35px">
            <div class="col-xs-8">
                <p class="well well-sm mt">
                    <?php
                    print('<pre>'.print_r($tax_total,true).'</pre>'); exit;
                    ?>
                </p>
            </div>
            <div class="col-sm-4 pv">
                <div class="clearfix">
                    <p class="pull-left"><?= lang('sub_total') ?></p>
                    <p class="pull-right mr">
                        <?= $sales_info->sub_total ? display_money($sales_info->sub_total) : '0.00' ?>
                    </p>
                </div>

                <?php
                $tax_info = json_decode($sales_info->total_tax);
                $tax_total = 0;
                if (!empty($tax_info)) {
                    $tax_name = $tax_info->tax_name;
                    $total_tax = $tax_info->total_tax;
                    if (!empty($tax_name)) {
                        foreach ($tax_name as $t_key => $v_tax_info) {
                            $tax = explode('|', $v_tax_info);
                            $tax_total += $total_tax[$t_key];
                ?>
                            <div class="clearfix">
                                <p class="pull-left"><?= $tax[0] . ' (' . $tax[1] . ' %)' ?></p>
                                <p class="pull-right mr">
                                    <?= display_money($total_tax[$t_key]); ?>
                                </p>
                            </div>
                <?php }
                    }
                } ?>
                <?php if ($tax_total > 0) : ?>
                    <div class="clearfix">
                        <p class="pull-left"><?= lang('total') . ' ' . lang('tax') ?></p>
                        <p class="pull-right mr">
                            <?= display_money($tax_total); ?>
                        </p>
                    </div>
                <?php endif ?>

                <?php
                $currency = get_sales_currency($sales_info); ?>
                <div class="clearfix">
                    <p class="pull-left"><?= lang('total') ?></p>
                    <p class="pull-right mr">
                        <?= display_money($sales_info->total, $currency->symbol) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <?= !empty($invoice_view) && $invoice_view > 0 ? $this->gst->summary($all_items) : ''; ?>
</div>



<script type="text/javascript">
    function print_sales_details(sales_details) {
        var printContents = document.getElementById(sales_details).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
    }
</script>