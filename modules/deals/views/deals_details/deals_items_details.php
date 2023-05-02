<?= message_box('success') ?>
<?= message_box('error');
$itemType = 'deals';
?>
<div class="panel" id="sales_details">
    <div class="panel-body mt-lg">
        <style type="text/css">
            .dragger {
                background: url(../../../../assets/img/dragger.png) 0px 11px no-repeat;
                cursor: pointer;
            }

            .table > tbody > tr > td {
                vertical-align: initial;
            }
        </style>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon" title="<?= lang('search_product_by_name_code') ?>">
                    <i class="fa fa-barcode"></i>
                </div>
                <input type="text" placeholder="<?= lang('search_product_by_name_code'); ?>" id="<?= $itemType ?>_item"
                       class="form-control">
                <div class="input-group-addon" title="<?= lang('add') . ' ' . lang('manual') ?>" data-toggle="tooltip"
                     data-placement="top">
                    <a data-toggle="modal" data-target="#myModal_lg"
                       href="<?= base_url() ?>admin/deals/manuallyItems/<?= $id ?>"><i class="fa fa-plus"></i></a>
                </div>
            </div>
        </div>
        <div id="dealItems">
            <?php $this->load->view('deals/deals_details/dealItems') ?>
        </div>
    </div>
</div>
<script src="<?= base_url() ?>assets/plugins/jquery-ui/jquery-u.min.js"></script>

<script type="text/javascript">
    let forID = 'deals';
    let pStore = forID + 'Items'
    let forItem = forID + '_item'
    $("#" + forItem).autocomplete({
        source: function (request, response) {
            $.ajax({
                url: '<?= base_url('admin/deals/itemsSuggestions') ?>',
                dataType: "json",
                data: {
                    term: request.term,
                    for: forItem,
                },
                success: function (data) {
                    response(data);
                }
            });
        },
        minLength: 1,
        autoFocus: false,
        delay: 200,
        response: function (event, ui) {
            if ($(this).val().length >= 16 && ui.content[0].saved_items_id == 0) {
                $(this).val('');
            } else if (ui.content.length == 1 && ui.content[0].saved_items_id != 0) {
                ui.item = ui.content[0];
                $(this).data('ui-autocomplete')._trigger('select', 'autocompleteselect', ui);
                $(this).autocomplete('close');
                $(this).val('');
            } else if (ui.content.length == 1 && ui.content[0].saved_items_id == 0) {
                $(this).val('');
            }
        },
        select: function (event, ui) {
            event.preventDefault();
            if (ui.item.saved_items_id !== 0) {
                var row = addItem(ui.item.row);
                if (row) {
                    $(this).val('');
                }
            } else {
                alert('<?php echo lang('no_result_found'); ?>');
                $(this).val('');
            }
        }
    });
    $("#" + forItem).bind('keypress', function (e) {
        if (e.keyCode == 13) {
            e.preventDefault();
            $(this).autocomplete("search");
        }
    });

    function addItem(data, manual = false) {
        var saved_items_id = data.saved_items_id;
        var deal_id = '<?= $id ?>';
        $.ajax({
            type: 'post',
            url: base_url + 'admin/deals/add_insert_items/' + deal_id,
            dataType: "json",
            data: {
                saved_items_id
            },
            success: function (data) {
                $('#dealItems').html(data.subview);
                $('#deals_item').val('');
            }
        });

    }

    $("body").on('click', '.itemManualy', function (e) {
        e.preventDefault();
        var form = $(this).closest('form');
        var data = form.serialize();
        $.ajax({
            type: 'post',
            url: '<?= base_url() ?>admin/deals/itemAddedManualy/',
            data: data,
            dataType: "json",
            success: function (data) {
                if (data !== null) {
                    $('#dealItems').html(data.subview);
                    form[0].reset();
                } else {
                    alert('<?php echo lang('no_result_found'); ?>');
                }
                $('#myModal_lg').modal('hide');
            }
        });
    });
    $(".deleteBtn").click(function (e) {
        var href = $(this).attr('href');
        e.preventDefault();
        // ajax delete items using href
        $.ajax({
            url: href,
            type: 'GET',
            dataType: "json",
            success: function (data) {
                if (data.type == 'success') {
                    toastr[data.type](data.msg);
                    $('#dealItems').html(data.subview);
                } else {
                    alert('There was a problem with AJAX');
                }
            }
        });

    });
</script>