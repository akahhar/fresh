<?= message_box('success'); ?>
<?= message_box('error');
$created = super_admin_access('mpage', 'created');
$edited = super_admin_access('mpage', 'edited');
$deleted = super_admin_access('mpage', 'deleted');
?>
<div class="nav-tabs-custom">
    <!-- Tabs within a box -->
    <ul class="nav nav-tabs">
        <li class="<?= $active == 1 ? 'active' : ''; ?>">
            <a href="#pages" data-toggle="tab"><?= lang('all') ?> <?= lang('pages') ?></a>
        </li>
        <li class="<?= $active == 2 ? 'active' : ''; ?>">
            <a href="#create" data-toggle="tab"><?= lang('new') ?> <?= lang('page') ?></a>
        </li>
        <?php
        if (config_item('front_page_sync') == '') {
            ?>
            <li class="pull-right">
                <a href="<?= base_url('saas/frontcms/page/sync') ?>"><?= lang('sync') ?> <?= lang('page') ?></a>
            </li>
            <?php
        }
        ?>
    </ul>


    <!--Tab content-->
    <div class="tab-content bg-white">
        <!--All Pages-->
        <div class="tab-pane <?= $active == 1 ? 'active' : ''; ?>" id="pages">
            <div class="table-responsive">
                <table class="table table-striped DataTables " id="DataTables" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th><?= lang('title') ?></th>
                        <th><?= lang('url') ?></th>
                        <th><?= lang('page') ?> <?= lang('type') ?></th>
                        <th class="col-options no-sort"><?= lang('action') ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <script type="text/javascript">
                        $(document).ready(function () {
                            list = base_url + "saas/frontcms/page/pageList";
                        });
                    </script>
                    </tbody>
                </table>
            </div>
        </div>
        <?php if (!empty($created) || !empty($edited)) {
            if (!empty($page_info)) {
                $pages_id = $page_info->pages_id;
            } else {
                $pages_id = null;
            }
            ?>
            <div class="tab-pane <?= $active == 2 ? 'active' : ''; ?>" id="create">
                <form role="form" enctype="multipart/form-data" data-parsley-validate="" novalidate=""
                      action="<?php echo base_url(); ?>saas/frontcms/page/save_pages/<?= $pages_id ?>" method="post"
                      class="form-horizontal">

                    <div class="panel-body">
                        <div class="form-group">
                            <label class="control-label col-md-2 text-right"><?= lang('title') ?> <span
                                        class="text-danger">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" value="<?php
                                if (!empty($page_info)) {
                                    echo html_escape($page_info->title);
                                }
                                ?>" name="title" required="">
                                <?php
                                if (!empty($page_info)) {
                                    ?>
                                    <input type="hidden" class="form-control" value="<?php
                                    if (!empty($page_info)) {
                                        echo html_escape($page_info->slug);
                                    }
                                    ?>" name="slug" required="">
                                <?php } ?>
                            </div>
                        </div>
                        <input type="hidden" name="content_category" value="standard">
                        <div class="form-group">
                            <label class="control-label"> <?= lang('description') ?> <span class="text-danger">*</span></label>
                            <div class="pull-right hidden-print">
                                <a href="<?= base_url() ?>saas/frontcms/page/add_image" class="btn btn-xs btn-info"
                                   data-toggle="modal" data-placement="top" data-target="#myModal_extra_lg">
                                    <i class="fa fa-plus "></i> <?= ' ' . lang('add') . ' ' . lang('media') ?></a>
                            </div>
                            <textarea name="description"
                                      id="editor1"><?= !empty($page_info->description) ? $page_info->description : ' ' ?></textarea>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save mr-sm"></i>
                                <?= lang('save') ?>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        <?php } ?>
    </div>
</div>
<script src="https://cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>
<script>
    $(document).ready(function () {
        CKEDITOR.replace('editor1', {
            fullPage: true,
            height: 700,
            allowedContent: true
        });
    });
</script>