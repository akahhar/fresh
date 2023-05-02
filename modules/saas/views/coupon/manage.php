<div class="nav-tabs-custom">
    <!-- Tabs within a box -->
    <ul class="nav nav-tabs">
        <li class="<?= $active == 1 ? 'active' : ''; ?>"><a
                    href="<?= base_url('saas/coupon') ?>"><?= lang('all') . ' ' . lang('coupon') ?></a>
        </li>
        <li class="<?= $active == 2 ? 'active' : ''; ?>"><a
                    href="<?= base_url('saas/coupon/create') ?>"><?= lang('new') . ' ' . lang('coupon') ?></a>
        </li>
    </ul>
    <div class="tab-content bg-white">
        <!-- ************** general *************-->
        <div class="tab-pane <?= $active == 1 ? 'active' : ''; ?>" id="manage">
            <div class="table-responsive">
                <table class="table table-striped DataTables " id="DataTables" width="100%">
                    <thead>
                    <tr>
                        <th><?= lang('coupon') . ' ' . lang('for') ?></th>
                        <th><?= lang('name') ?></th>
                        <th><?= lang('code') ?></th>
                        <th><?= lang('amount') ?></th>
                        <th><?= lang('end_date') ?></th>
                        <th><?= lang('published') ?></th>
                        <th class="col-options no-sort"><?= lang('action') ?></th>
                    </tr>
                    </thead>
                    <tbody id="coupon">
                    </tbody>
                </table>
                <script type="text/javascript">
                    list = base_url + "saas/coupon/couponList";
                </script>
            </div>
        </div>

    </div>
</div>


<?php echo form_close(); ?>

<style type="text/css">
    .dragger {
        background: url(../../assets/img/dragger.png) 0px 15px no-repeat;
        cursor: pointer;
    }
</style>

<script src="<?= base_url() ?>assets/plugins/jquery-ui/jquery-u.js"></script>
<script type="text/javascript">

    $(document).ready(function () {
        $('.ajax_change_status input[type="checkbox"]').change(function () {
            var id = $(this).data().id;
            var status = $(this).is(":checked");
            if (status == true) {
                status = 1;
            } else {
                status = 0;
            }
            $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: '<?= base_url()?>admin/frontend/change_status/tbl_saas_frontend_coupon/' + id + '/' + status, // the url where we want to POST
                dataType: 'json', // what type of data do we expect back from the server
                encode: true,
                success: function (res) {
//                    console.log(res);
                    if (res) {
//                        toastr[res.status](res.message);
                    } else {
                        alert('There was a problem with AJAX');
                    }
                }
            })
        });
    })
</script>