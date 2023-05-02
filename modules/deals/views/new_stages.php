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
$all_pipelines = get_result('tbl_deals_pipelines');
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
            <li class="active">
                <a href="<?= base_url() ?>admin/deals/new_stages">
                    </i> <?= ' ' . lang('new_stages') ?></a>
            </li>
            <li>
                <a href="<?= base_url() ?>admin/deals/sales_pipelines"><?= ' ' . lang('sales_pipelines') ?></a>
            </li>
        </ul>

        <div class="tab-content bg-white">
            <div class="tab-pane active" id="group">

                <div class="table-responsive">
                    <table class="table table-striped ">
                        <thead>
                            <tr>
                                <th><?= lang('stages') ?></th>
                                <th><?= lang('pipeline') ?></th>
                                <?php if (!empty($edited) || !empty($deleted)) { ?>
                                    <th><?= lang('action') ?></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody class="sorting-drag-drop sortable">
                            <?php
                            $all_stages = $this->db->where('type', 'stages')->order_by('order', 'ASC')->get('tbl_customer_group')->result();
                            if (!empty($all_stages)) {
                                foreach ($all_stages as $v_stages) {
                                    $s_pipelines = $this->deals_model->check_by(array('pipeline_id' => $v_stages->description), 'tbl_deals_pipelines');


                            ?>
                                    <!-- <tr class="item-no " value="<?= $v_stages->customer_group_id ?>" id=" table_items_group_<?= $v_stages->customer_group_id ?>"> -->
                                    <tr class="item-no " id="<?= $v_stages->customer_group_id ?>">
                                        <td><?php
                                            $id = $this->uri->segment(5);
                                            if (!empty($id) && $id == $v_stages->customer_group_id) { ?>
                                                <form method="post" action="<?= base_url() ?>admin/deals/saved_stages/<?php
                                                                                                                        if (!empty($stages)) {
                                                                                                                            echo $stages->customer_group_id;
                                                                                                                        }
                                                                                                                        ?>" class="form-horizontal">
                                                    <input type="text" name="customer_group" value="<?php
                                                                                                    if (!empty($v_stages)) {
                                                                                                        echo $v_stages->customer_group;
                                                                                                    }
                                                                                                    ?>" class="form-control" placeholder="<?= lang('new_stages') ?>" required>
                                                <?php } else {
                                                echo $v_stages->customer_group;
                                            }
                                                ?>
                                        </td>
                                        <td><?php
                                            $id = $this->uri->segment(5);
                                            if (!empty($id) && $id == $v_stages->customer_group_id) { ?>
                                                <select name="description" class="form-control select_box" style="width: 100%" required>
                                                    <option value="">Select Pipeline</option>
                                                    <?php foreach ($all_pipelines as $key => $v_pipeline) {
                                                    ?>
                                                        <option value="<?= $v_pipeline->pipeline_id ?>" <?php
                                                                                                        if (!empty($v_stages->description) && $v_stages->description == $v_pipeline->pipeline_id) {
                                                                                                            echo 'selected';
                                                                                                        } ?>><?= $v_pipeline->pipeline_name; ?></option>
                                                    <?php } ?>
                                                </select>


                                            <?php } else {
                                                echo lang($s_pipelines->pipeline_name);
                                            }


                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $id = $this->uri->segment(5);
                                            if (!empty($id) && $id == $v_stages->customer_group_id) { ?>
                                                <?= btn_update() ?>
                                                </form>
                                                <?= btn_cancel('admin/deals/new_stages/stages/') ?>
                                            <?php } else { ?>
                                                <?php if (!empty($edited)) { ?>
                                                    <?= btn_edit('admin/deals/new_stages/stages/' . $v_stages->customer_group_id) ?>
                                                    <?php if (!empty($deleted)) { ?>
                                                        <?php echo ajax_anchor(base_url("admin/deals/delete_stages/" . $v_stages->customer_group_id), "<i class='btn btn-xs btn-danger fa fa-trash-o'></i>", array("class" => "", "title" => lang('delete'), "data-fade-out-on-success" => "#" . $v_stages->customer_group_id)); ?>
                                                <?php }
                                                } ?>
                                        </td>
                                    <?php } ?>
                                    </tr>
                            <?php }
                            } ?>
                            <form role="form" enctype="multipart/form-data" id="form" action="<?php echo base_url(); ?>admin/deals/saved_stages/<?php
                                                                                                                                                if (!empty($stages)) {
                                                                                                                                                    echo $stages->customer_group_id;
                                                                                                                                                }
                                                                                                                                                ?>" method="post" class="form-horizontal  ">
                                <tr>
                                    <td><input required type="text" name="customer_group" class="form-control" placeholder="<?= lang('stages') ?>">
                                    </td>
                                    <td>
                                        <!-- <textarea name="description" rows="1" class="form-control"></textarea> -->
                                        <select name="description" class="form-control select_box" style="width: 100%" required>
                                            <option value="">Select Pipeline</option>
                                            <?php
                                            $all_pipelines = get_result('tbl_deals_pipelines');
                                            if (!empty($all_pipelines)) {
                                                foreach ($all_pipelines as $pipeline) {
                                            ?>
                                                    <option value="<?= $pipeline->pipeline_id ?>"><?= $pipeline->pipeline_name ?></option>
                                            <?php }
                                            } ?>
                                        </select>
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
                            url: "save_sorting_stages",
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