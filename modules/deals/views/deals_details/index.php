<?php
$where = array('user_id' => $this->session->userdata('user_id'), 'module_id' => $deals_details->id, 'module_name' => 'deals');
$check_existing = $this->deals_model->check_by($where, 'tbl_pinaction');
if (!empty($check_existing)) {
    $url = 'remove_todo/' . $check_existing->pinaction_id;
    $btn = 'danger';
    $title = lang('remove_todo');
} else {
    $url = 'add_todo_list/leads/' . $deals_details->id;
    $btn = 'warning';
    $title = lang('add_todo_list');
}
$can_edit = $this->deals_model->can_action('tbl_deals', 'edit', array('id' => $deals_details->id));
$edited = can_action('55', 'edited');
?>

<div class="panel panel-custom">
    <div class="panel-heading">
        <h3 class="panel-title"><?php
            if (!empty($deals_details->title)) {
                echo $deals_details->title;
            }
            ?>
            <span class="btn-xs pull-right">
                <?php
                if (!empty($can_edit) && !empty($edited)) { ?>
                    <a href="<?= base_url() ?>deals/new_deals/<?= $deals_details->id ?>"><?= lang('edit') . ' ' . lang('deals') ?></a>
                <?php }
                ?>
            </span>
        </h3>
    </div>
    
    <div class="panel-body row form-horizontal task_details">
        <div class="form-group col-sm-12">
            <div class="col-sm-6">
                <label class="control-label col-sm-5"><strong><?= lang('title') ?> :</strong>
                </label>
                <p class="form-control-static"><?php
                    if (!empty($deals_details->title)) {
                        echo $deals_details->title;
                    }
                    ?></p>
            
            </div>
            <div class="col-sm-6">
                <div class="col-sm-5 text-right">
                    <label class="control-label"><strong><?= lang('deal_owner') ?> :</strong></label>
                </div>
                <p class="form-control-static"><?php if (!empty($deals_details->default_deal_owner)) echo fullname($deals_details->default_deal_owner); ?></p>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <?php
            if ($deals_details->status == 'won') {
                $sClass = 'success';
            } elseif ($deals_details->status == 'lost') {
                $sClass = 'danger';
            } else {
                $sClass = 'warning';
            }
            ?>
            <div class="col-sm-6">
                <div class="col-sm-5 text-right">
                    <label class="control-label"><strong><?= lang('status') ?> :</strong></label>
                </div>
                <p class="form-control-static">
                    <span class="label label-<?= $sClass ?>"><?= (!empty($deals_details->status) ? lang($deals_details->status) : '-') ?></span>
                </p>
            </div>
            <div class="col-sm-6">
                <div class="col-sm-5 text-right">
                    <label class="control-label"><strong><?= lang('client') ?> :</strong></label>
                </div>
                <p class="form-control-static">
                    <?php
                    $all_client = json_decode($deals_details->client_id);
                    $client_name = '';
                    if (!empty($all_client)) {
                        foreach ($all_client as $key => $clientId) {
                            $sl = $key + 1;
                            $client_name .= '<strong>' . $sl . '.' . client_name($clientId) . ' </strong>';
                        }
                    }
                    echo $client_name;
                    ?>
                    <a data-toggle="modal" data-target="#myModal_lg" id="myModalLabel"
                       href="<?= base_url() ?>admin/deals/updateUsers/<?= $deals_details->id ?>/client"><i
                                class="fa fa-plus"></i></a>
                </p>
            </div>
        
        </div>
        <div class="form-group col-sm-12">
            <div class="col-sm-6">
                <div class="col-sm-5 text-right">
                    <label class="control-label"><strong><?= lang('deal_value') ?> :</strong></label>
                </div>
                <p class="form-control-static"><?php if (!empty($deals_details->deal_value)) echo $deals_details->deal_value; ?></p>
            </div>
            <div class="col-sm-6">
                <div class="col-sm-5 text-right">
                    <label class="control-label"><strong><?= lang('source') ?> :</strong></label>
                </div>
                <p class="form-control-static"><?php if (!empty($deals_details->source_name)) echo $deals_details->source_name; ?></p>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <div class="col-sm-6">
                <div class="col-sm-5 text-right">
                    <label class="control-label"><strong><?= lang('create') . ' ' . lang('date') ?> :</strong></label>
                </div>
                <p class="form-control-static">
                    <span><?= strftime(config_item('date_format'), strtotime($deals_details->created_at)) ?></span>
                </p>
            </div>
            <div class="col-sm-6">
                <div class="col-sm-5 text-right">
                    <label class="control-label"><strong><?= lang('close') . ' ' . lang('date') ?> :</strong></label>
                </div>
                <p class="form-control-static">
                    <span><?= strftime(config_item('date_format'), strtotime($deals_details->days_to_close)) ?></span>
                </p>
            </div>
        </div>
        
        
        <div class="form-group col-sm-12">
            
            <div class="col-sm-6">
                <div class="col-sm-5 text-right">
                    <label class="control-label"><strong><?= lang('pipeline') ?> :</strong></label>
                </div>
                <p class="form-control-static"><?php if (!empty($deals_details->pipeline_name)) echo $deals_details->pipeline_name; ?></p>
            </div>
            <div class="col-sm-6">
                <div class="col-sm-5 text-right">
                    <label class="control-label"><strong><?= lang('stage') ?> :</strong></label>
                </div>
                <p class="form-control-static"><?php if (!empty($deals_details->customer_group)) echo $deals_details->customer_group; ?></p>
            </div>
        </div>
        <div class="form-group col-sm-12">
            <div class="col-sm-6">
                <div class="col-sm-5 text-right">
                    <label class="control-label"><strong><?= lang('assigne') ?> :</strong></label>
                </div>
                <p class="form-control-static">
                    <?php
                    $all_user = json_decode($deals_details->user_id);
                    $user_name = '';
                    if (!empty($all_user)) {
                        foreach ($all_user as $key => $userId) {
                            $sl = $key + 1;
                            $user_info = get_staff_details($userId);
                            $full_name = $user_info->fullname;
                            if ($user_info->role_id == 1) {
                                $label = 'circle-danger';
                            } else {
                                $label = 'circle-success';
                            }
                            $user_name .= '<a href="#" data-toggle="tooltip" data-placement="top"
                          
                           title="' . $full_name . '"><img class="img-circle img-xs" src="' . base_url() . $user_info->avatar . '" alt="' . $full_name . '"><span class="custom-permission circle ' . $label . '  circle-lg"></span></a>';
                        }
                    }
                    echo $user_name;
                    ?>
                    <a data-toggle="modal" data-target="#myModal_lg" id="myModalLabel"
                       href="<?= base_url() ?>admin/deals/updateUsers/<?= $deals_details->id ?>/user"><i
                                class="fa fa-plus"></i></a>
                </p>
            </div>
            <div class="col-sm-6">
                <div class="col-sm-5 text-right">
                    <label class="control-label"><strong><?= lang('tags') ?> :</strong></label>
                </div>
                <p class="form-control-static"><?php echo get_tags($deals_details->tags, true); ?></p>
            </div>
        </div>
    </div>

</div>