<!-- Default panel contents -->
<div class="panel panel-custom">
    <div class="panel-heading">
        <div class="panel-title">
            <strong><?= lang('payment') . ' ' . lang('histories') ?></strong>
            <div class="pull-right"><!-- set pdf,Excel start action -->
                <label class="hidden-print control-label pull-left hidden-xs">
                    <button class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title=""
                            type="button" onclick="payment_history('payment_history')"
                            data-original-title="Print"><i class="fa fa-print"></i>
                    </button>
                </label>
            </div><!-- set pdf,Excel start action -->
        </div>
    </div>
    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-striped da" id="PaymentDataTables">
            <thead>
            <tr>
                <th><?= lang('company_name') ?></th>
                <th><?= lang('package_name') ?></th>
                <th><?= lang('transaction_id') ?></th>
                <th><?= lang('amount') ?></th>
                <th><?= lang('payment_date') ?></th>
                <th><?= lang('method') ?></th>
            </tr>
            </thead>
            <tbody>
            <script type="text/javascript">
                $(document).ready(function () {
                    var Paymentlist = base_url + "saas/gb/companyPaymentList/";
                    fire_datatable(Paymentlist, 'PaymentDataTables');
                });
            </script>
            </tbody>
        </table>
    </div>
</div>