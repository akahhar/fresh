<?= message_box('success'); ?>
<?= message_box('error');
?>

<div class="panel panel-custom" data-collapsed="0">
    <div class="panel-heading">
        <div class="panel-title">
            <?= lang('menu_list') ?>
            <div class="pull-right hidden-print">
                <a href="<?= base_url() ?>saas/frontcms/menus/add_menu" class="btn btn-xs btn-info" data-toggle="modal"
                   data-placement="top" data-target="#myModal">
                    <i class="fa fa-plus "></i> <?= ' ' . lang('add') . ' ' . lang('menu') ?></a>
            </div>
        </div>
    </div>

    <div class="panel-body">
        <table class="table table-striped DataTables " id="DataTables" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th><?= lang('title') ?></th>
                <th width="80px"><?= lang('action') ?></th>
            </tr>
            </thead>

            <tbody>
            <script type="text/javascript">
                $(document).ready(function () {
                    list = base_url + "saas/frontcms/menus/menu_list";
                });
            </script>
            </tbody>
        </table>
    </div>
</div>