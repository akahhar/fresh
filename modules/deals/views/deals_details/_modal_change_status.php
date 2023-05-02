<?php
if (!empty($status)) { ?>
    <form id="form_validation"
          action="<?php echo base_url() ?>admin/deals/changeStatus/<?php echo $id . '/' . $status; ?>"
          method="post" class="form-horizontal form-groups-bordered">
        <div class="panel panel-custom">
            <div class="panel-heading">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                            class="sr-only">Close</span></button>
                <h3 class="panel-title"><?php
                    if (!empty($deals_details->title)) {
                        echo $deals_details->title;
                    }
                    ?>
                </h3>
            </div>
            <div class="panel-body">
                <?php
                if ($status == 'won') {
                $btn = lang('won');
                ?>
                <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <i class="fas fa-info-sign"></i> <?= lang('deal_won_message') ?>
                </div>
                
                <div class="checkbox c-checkbox">
                    <label class="needsclick">
                        <input name="create_invoice" value="1"
                               checked type="checkbox">
                        <span class="fa fa-check"></span>
                        <?= lang('create_invoice_for_deal', $deals_details->title) ?>
                    </label>
                </div>
                
                <div class="checkbox c-checkbox">
                    <label class="needsclick">
                        <input name="convert_to_project" value="1"
                            <?= (!empty($deals_details->convert_to_project) && $deals_details->convert_to_project == 1 ? 'checked' : '')
                            ?>
                               type="checkbox">
                        <span class="fa fa-check"></span>
                        <?= lang('convert_deal_to_project', $deals_details->title) ?>
                    </label>
                </div>
                <?php
                $all_task_info = get_result('tbl_task', array('module_field_id' => $deals_details->id));
                if (!empty($all_task_info)) { ?>
                <div class="">
                    <a href="#"
                       onclick="slideToggle('#tasks_who_will_be_billed'); return false;"><b><?= lang('see_task_on_project') ?></b></a>
                    <div id="tasks_who_will_be_billed" style="display: none;">
                        <div class="checkbox c-checkbox">
                            <label>
                                <input type="checkbox"
                                       id="select_all_tasks"
                                       class="invoice_select_all_tasks">
                                <span class="fa fa-check"></span><?= lang('select_all') . ' ' . lang('task') ?>
                            </label>
                        </div>
                        <hr class="mr0 mb0 mt-sm">
                        <?php foreach ($all_task_info as $v_tasks) { ?>
                            <div class="col-sm-10">
                                <div class="checkbox c-checkbox">
                                    <label>
                                        <input value="<?= $v_tasks->task_id ?>" checked name="tasks[]"
                                               class="tasks_list" type="checkbox">
                                        <span class="fa fa-check"></span>
                                        <strong class="inline-block"><?= $v_tasks->task_name ?></strong>
                                    </label>
                                </div>
                            </div>
                            <?php
                            if ($v_tasks->task_status == 'completed') {
                                $label = 'success';
                            } elseif ($v_tasks->task_status == 'not_started') {
                                $label = 'info';
                            } elseif ($v_tasks->task_status == 'deferred') {
                                $label = 'danger';
                            } else {
                                $label = 'warning';
                            }
                            ?>
                            <div class="col-sm-2 mt-sm ">
                                <small class=""><strong
                                            class="inline-block label label-<?= $label ?>"><?= lang($v_tasks->task_status) ?></strong>
                                </small>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <?php } ?>
            <script>
                function slideToggle($id) {
                    $($id).slideToggle();
                }

                $(document).ready(function () {
                    $("#select_all_tasks").on("click", function () {
                        $(".tasks_list").prop('checked', $(this).prop('checked'));
                    });
                    $('[data-toggle="popover"]').popover();
                });
            </script>
            <?php } elseif ($status == 'lost') {
                $btn = lang('mark_as_lost');
                ?>
                <div class="p">
                    <label class=""><?= lang('lost_reason') ?> <span
                                class="text-danger">*</span></label>
                    <div class="">

                                    <textarea style="height:120px" name="lost_reason" class="form-control textarea"
                                              placeholder="<?= lang('lost_reason') ?>"><?php
                                        if (!empty($deals_details->lost_reason)) {
                                            echo $deals_details->lost_reason;
                                        }
                                        ?></textarea>
                    </div>
                </div>
            
            
            <?php }
            ?>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('close') ?></button>
                <button type="submit" class="btn btn-primary"><?= $btn ?></button>
            </div>
        </div>
    </form>
<?php }
?>