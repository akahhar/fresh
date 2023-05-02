<div class="table-responsive">
    <table class="table table-striped DataTables bulk_table" id="DataTables" cellspacing="0" width="100%">
        <thead>
            <tr>
                <?php //if (!empty($deleted)) { 
                ?>
                <th data-orderable="false">
                    <div class="checkbox c-checkbox">
                        <label class="needsclick">
                            <input id="select_all" type="checkbox">
                            <span class="fa fa-check"></span></label>
                    </div>
                </th>
                <?php //} 
                ?>
                <th><?= lang('complaint') . ' ' . lang('code') ?></th>
                <th><?= lang('description') ?></th>
                <th class="col-date"><?= lang('complaint') . ' ' . lang('date') ?></th>
                <th class="col-date"><?= lang('due_date') ?></th>
                <th><?= lang('status') ?></th>
                <?php $show_custom_fields = custom_form_table(7, null);
                if (!empty($show_custom_fields)) {
                    foreach ($show_custom_fields as $c_label => $v_fields) {
                        if (!empty($c_label)) {
                ?>
                            <th><?= $c_label ?> </th>
                <?php }
                    }
                }
                ?>

                <th><?= lang('action') ?></th>
            </tr>
        </thead>
        <tbody>
            <script type="text/javascript">
                $(document).ready(function() {
                    list = base_url + "complaints/complaint/complaintsList";
                    bulk_url = base_url + "complaints/complaint/bulk_delete";
                    <?php if (admin_head()) { ?>
                        $('.filtered > .dropdown-toggle').on('click', function() {
                            if ($('.group').css('display') == 'block') {
                                $('.group').css('display', 'none');
                            } else {
                                $('.group').css('display', 'block')
                            }
                        });
                        $('.all_filter').on('click', function() {
                            $('.to_account').removeAttr("style");
                            $('.from_account').removeAttr("style");
                            $('.from_reporter').removeAttr("style");
                        });
                        $('.from_account li').on('click', function() {
                            if ($('.to_account').css('display') == 'block') {
                                $('.to_account').removeAttr("style");
                                $('.from_reporter').removeAttr("style");
                                $('.from_account').css('display', 'block');
                            } else if ($('.from_reporter').css('display') == 'block') {
                                $('.to_account').removeAttr("style");
                                $('.from_reporter').removeAttr("style");
                                $('.from_account').css('display', 'block');
                            } else {
                                $('.from_account').css('display', 'block')
                            }
                        });

                        $('.to_account li').on('click', function() {
                            if ($('.from_account').css('display') == 'block') {
                                $('.from_account').removeAttr("style");
                                $('.from_reporter').removeAttr("style");
                                $('.to_account').css('display', 'block');
                            } else if ($('.from_reporter').css('display') == 'block') {
                                $('.from_reporter').removeAttr("style");
                                $('.from_account').removeAttr("style");
                                $('.to_account').css('display', 'block');
                            } else {
                                $('.to_account').css('display', 'block');
                            }
                        });
                        $('.from_reporter li').on('click', function() {
                            if ($('.to_account').css('display') == 'block') {
                                $('.to_account').removeAttr("style");
                                $('.to_account').removeAttr("style");
                                $('.from_reporter').css('display', 'block');
                            } else if ($('.from_account').css('display') == 'block') {
                                $('.to_account').removeAttr("style");
                                $('.from_account').removeAttr("style");
                                $('.from_reporter').css('display', 'block');
                            } else {
                                $('.from_reporter').css('display', 'block');
                            }
                        });
                        $('.filter_by').on('click', function() {
                            $('.filter_by').removeClass('active');
                            $('.group').css('display', 'block');
                            $(this).addClass('active');
                            var filter_by = $(this).attr('id');
                            if (filter_by) {
                                filter_by = filter_by;
                            } else {
                                filter_by = '';
                            }
                            var search_type = $(this).attr('search-type');
                            if (search_type) {
                                search_type = '/' + search_type;
                            } else {
                                search_type = '';
                            }
                            table_url(base_url + "complaints/complaint/complaintsList/" + filter_by + search_type);
                        });
                    <?php } ?>

                    $('.filter_by_type').on('click', function() {
                        var filter_by = $(this).attr('id');
                        if (filter_by) {
                            filter_by = filter_by;
                        } else {
                            filter_by = '';
                        }
                        table_url(base_url + "complaints/complaint/complaintsList/" + filter_by);
                    });
                });
            </script>
        </tbody>
    </table>
</div>