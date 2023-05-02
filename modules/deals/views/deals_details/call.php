<?php
$edited = can_action('55', 'edited');
$sub_active = 1;
$calls_id = $this->uri->segment(6);
if ($calls_id) {
    $sub_active = 2;
    $call_info = get_row('tbl_calls', array('calls_id' => $calls_id));
}
?>


<div class="nav-tabs-custom ">
    <!-- Tabs within a box -->
    <ul class="nav nav-tabs">
        <li class="<?= $sub_active == 1 ? 'active' : ''; ?>"><a href="#manage" data-toggle="tab"><?= lang('all_call') ?></a>
        </li>
        <?php if (!empty($edited)) { ?>
            <li class="<?= $sub_active == 2 ? 'active' : ''; ?>"><a href="#create" data-toggle="tab"><?= lang('new_call') ?></a>
            </li>
        <?php } ?>
    </ul>
    <div class="tab-content bg-white">
        <!-- ************** general *************-->
        <div class="tab-pane <?= $sub_active == 1 ? 'active' : ''; ?>" id="manage">

            <div class="table-responsive">
                <table class="table table-striped " cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><?= lang('date') ?></th>
                            <th><?= lang('call_summary') ?></th>
                            <th><?= lang('contact') ?></th>
                            <th><?= lang('responsible') ?></th>
                            <th class="col-options no-sort"><?= lang('action') ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $all_calls_info = get_result('tbl_calls', array('module_field_id' => $deals_details->id));
                        if (!empty($all_calls_info)) :
                            foreach ($all_calls_info as $v_calls) :
                                $client_info = $this->deals_model->check_by(array('client_id' => $v_calls->client_id), 'tbl_client');
                                $user = $this->deals_model->check_by(array('user_id' => $v_calls->user_id), 'tbl_users');
                        ?>
                                <tr id="leads_call_<?= $deals_details->id ?>">
                                    <td><?= strftime(config_item('date_format'), strtotime($v_calls->date)) ?>
                                    </td>
                                    <td><?= $v_calls->call_summary ?></td>
                                    <td>
                                        <?php
                                        if (!empty($client_info)) {
                                            echo $client_info->name;
                                        }
                                        ?></td>
                                    <td><?= $user->username ?></td>
                                    <td>
                                        <a href="<?= base_url('admin/deals/call_details/' . $v_calls->calls_id) ?>" class="btn btn-xs btn-info" data-placement="top" data-toggle="modal" data-target="#myModal">
                                            <i class="fa fa-list "></i></a>
                                        <?= btn_edit('admin/deals/details/' . $deals_details->id . '/call/' . $v_calls->calls_id) ?>
                                        <?php echo ajax_anchor(base_url("admin/deals/delete_deals_call/" . $deals_details->id . '/' . $v_calls->calls_id), "<i class='btn btn-xs btn-danger fa fa-trash-o'></i>", array("class" => "", "title" => lang('delete'), "data-fade-out-on-success" => "#leads_call_" . $deals_details->id)); ?>
                                    </td>
                                </tr>
                        <?php
                            endforeach;
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="tab-pane <?= $sub_active == 2 ? 'active' : ''; ?>" id="create">
            <form role="form" enctype="multipart/form-data" id="form" action="<?php echo base_url(); ?>admin/deals/saved_call/<?= $deals_details->id ?>/<?php
                                                                                                                                                        if (!empty($call_info)) {
                                                                                                                                                            echo $call_info->calls_id;
                                                                                                                                                        }
                                                                                                                                                        ?>" method="post" class="form-horizontal  ">
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('date') ?><span class="text-danger">
                            *</span></label>
                    <div class="col-lg-5">
                        <div class="input-group">
                            <input type="text" required="" name="date" class="form-control datepicker" value="<?php
                                                                                                                if (!empty($call_info->date)) {
                                                                                                                    echo $call_info->date;
                                                                                                                } else {
                                                                                                                    echo date('Y-m-d');
                                                                                                                }
                                                                                                                ?>" data-date-format="<?= config_item('date_picker_format'); ?>">
                            <div class="input-group-addon">
                                <a href="#"><i class="fa fa-calendar"></i></a>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('call_type') ?></label>
                    <div class="col-lg-5">
                        <select name="call_type" class="form-control select_box" style="width: 100%">
                            <option value="outbound" <?php if (!empty($call_info->call_type) && $call_info->call_type == 'outbound') {
                                                            echo 'selected';
                                                        } ?>><?= lang('outbound') ?></option>
                            <option value="inbound" <?php if (!empty($call_info->call_type) && $call_info->call_type  == 'inbound') {
                                                        echo 'selected';
                                                    } ?>><?= lang('inbound') ?></option>
                        </select>
                    </div>

                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('call_duration') ?></label>
                    <div class="col-lg-5">
                        <input type="text" name="duration" class="form-control" id="duration" placeholder="00:35:20" value="<?php if (!empty($call_info->duration)) {
                                                                                                                                echo $call_info->duration;
                                                                                                                            } ?>">
                    </div>

                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('contact') ?></label>
                    <div class="col-lg-5">
                        <select name="client_id" class="form-control select_box" style="width: 100%">
                            <option value=""><?= lang('select_client') ?></option>
                            <?php
                            $all_client = $this->db->get('tbl_client')->result();
                            if (!empty($all_client)) {
                                foreach ($all_client as $v_client) {
                            ?>
                                    <option value="<?= $v_client->client_id ?>" <?php
                                                                                if (!empty($call_info) && $call_info->client_id == $v_client->client_id) {
                                                                                    echo 'selected';
                                                                                }
                                                                                ?>>
                                        <?= $v_client->name ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"><?= lang('responsible') ?><span class="text-danger"> *</span></label>
                    <div class="col-lg-5">
                        <select name="user_id" class="form-control select_box" style="width: 100%" required="">
                            <option value=""><?= lang('admin_staff') ?></option>
                            <?php
                            $user_info = $this->db->where(array('role_id !=' => '2'))->get('tbl_users')->result();
                            if (!empty($user_info)) {
                                foreach ($user_info as $key => $v_user) {
                            ?>
                                    <option value="<?= $v_user->user_id ?>" <?php
                                                                            if (!empty($call_info) && $call_info->user_id == $v_user->user_id) {
                                                                                echo 'selected';
                                                                            }
                                                                            ?>><?= $v_user->username ?>
                                    </option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>

                </div>
                <!-- End discount Fields -->
                <div class="form-group terms">
                    <label class="col-lg-3 control-label"><?= lang('call_summary') ?><span class="text-danger"> *</span> </label>
                    <div class="col-lg-5">
                        <input type="text" required="" name="call_summary" class="form-control" value="<?php
                                                                                                        if (!empty($call_info->call_summary)) {
                                                                                                            echo $call_info->call_summary;
                                                                                                        }
                                                                                                        ?>">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label"></label>
                    <div class="col-lg-5">
                        <button type="submit" class="btn btn-sm btn-primary"><?= lang('updates') ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>