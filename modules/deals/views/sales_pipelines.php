<script src="<?= base_url() ?>assets/plugins/jquery-ui/jquery-u.min.js"></script>
<style>
    .sorting-drag-drop tr.ui-placeholder {
        padding: 24px;
        background-color: #ffffcc;
        border: 1px dotted #ccc;
        cursor: move;
        margin-top: 12px;
    }
</style>
<?= message_box('success'); ?>
<?= message_box('error');
$created = can_action('39', 'created');
$edited = can_action('39', 'edited');
$deleted = can_action('39', 'deleted');
if (!empty($created) || !empty($edited)) {
?>
    <div class="nav-tabs-custom">
        <!-- Tabs within a box -->
        <ul class="nav nav-tabs">

            <li><a href="<?= base_url('admin/deals/deals_setting') ?>"><?= lang('deals_settings') ?></a>
            </li>
            <li>
                <a href="<?= base_url() ?>admin/deals/new_stages">
                    </i> <?= ' ' . lang('new_stages') ?></a>
            </li>
            <li class="active">
                <a href="<?= base_url() ?>admin/deals/sales_pipelines"><?= ' ' . lang('sales_pipelines') ?></a>
            </li>
        </ul>

        <div class="tab-content bg-white">
            <div class="tab-pane active" id="group">

                <div class="table-responsive">
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th><?= lang('pipeline') ?></th>
                                <?php if (!empty($edited) || !empty($deleted)) { ?>
                                    <th><?= lang('action') ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody class="sorting-drag-drop sortable">
                            <?php
                            $all_pipelines = $this->db->order_by('order', 'ASC')->get('tbl_deals_pipelines')->result();
                            if (!empty($all_pipelines)) {
                                foreach ($all_pipelines as $pipelines) {

                            ?>
                                    <tr id="<?= $pipelines->pipeline_id ?>">
                                        <td><?php
                                            $id = $this->uri->segment(4);
                                            if (!empty($id) && $id == $pipelines->pipeline_id) { ?>
                                                <form method="post" action="<?= base_url() ?>admin/deals/saved_pipelines/<?php
                                                                                                                            if (!empty($pipeline)) {
                                                                                                                                echo $pipeline->pipeline_id;
                                                                                                                            }
                                                                                                                            ?>" class="form-horizontal">
                                                    <input type="text" name="pipeline_name" value="<?php
                                                                                                    if (!empty($pipeline)) {
                                                                                                        echo $pipeline->pipeline_name;
                                                                                                    }
                                                                                                    ?>" class="form-control" placeholder="<?= lang('new_pipeline') ?>" required>
                                                <?php } else {
                                                echo $pipelines->pipeline_name;
                                            }
                                                ?>
                                        </td>

                                        <td>
                                            <?php
                                            $id = $this->uri->segment(4);
                                            if (!empty($id) && $id == $pipelines->pipeline_id) { ?>
                                                <?= btn_update() ?>
                                                </form>
                                                <?= btn_cancel('admin/deals/sales_pipelines') ?>
                                            <?php } else { ?>
                                                <?php if (!empty($edited)) { ?>
                                                    <?= btn_edit('admin/deals/sales_pipelines/' . $pipelines->pipeline_id) ?>
                                                    <?php if (!empty($deleted)) { ?>
                                                        <?php echo ajax_anchor(base_url("admin/deals/delete_pipeline/" . $pipelines->pipeline_id), "<i class='btn btn-xs btn-danger fa fa-trash-o'></i>", array("class" => "", "title" => lang('delete'), "data-fade-out-on-success" => "#" . $pipelines->pipeline_id)); ?>
                                                <?php }
                                                } ?>
                                        </td>
                                    <?php } ?>
                                    </tr>
                            <?php }
                            } ?>
                            <form role="form" enctype="multipart/form-data" id="form" action="<?php echo base_url(); ?>admin/deals/saved_pipelines/<?php
                                                                                                                                                    if (!empty($stages)) {
                                                                                                                                                        echo $stages->customer_group_id;
                                                                                                                                                    }
                                                                                                                                                    ?>" method="post" class="form-horizontal  ">
                                <tr>
                                    <td><input required type="text" name="pipeline_name" class="form-control" placeholder="<?= lang('pipeline_name') ?>">
                                    </td>

                                    <td><?= btn_add() ?></td>
                                </tr>
                            </form>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php } ?>
        </div>

        <script>
            $(document).ready(function() {
                $('.sorting-drag-drop').sortable({
                    stop: function() {
                        var page_id_array = '';
                        $('.sortable tr').each(function() {
                            var id = $(this).attr('id');
                            if (page_id_array == '') {
                                page_id_array = id;
                            } else {
                                page_id_array = page_id_array + ',' + id;

                            }
                        });
                        $.ajax({
                            url: "save_sorting_pipelines",
                            method: 'POST',
                            data: 'page_id_array=' + page_id_array,
                            success: function(data) {
                                // toastr[data.status](data.message);
                                // alert('Updated Successfully');

                            }
                        })
                    }
                });
            })
        </script>