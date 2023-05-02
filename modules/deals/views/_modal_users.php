<div class="panel panel-custom">
    <div class="panel-heading">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                    class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel"><?= lang('all_users') ?></h4>
    </div>
    <div class="modal-body wrap-modal wrap">
        <form id="form_validation"
              action="<?php echo base_url() ?>admin/deals/updateUsers/<?php if (!empty($deals->id)) echo $deals->id;
              if (!empty($type)) echo '/' . $type;
              ?>"
              method="post" class="form-horizontal form-groups-bordered">
            <div class="form-group">
                <label class="col-lg-3 control-label"><?= (!empty($type) && $type === 'client') ? lang('client') : lang('assigne') ?>
                    <span class="text-danger">*</span></label>
                <div class="col-lg-8">
                    <?php
                    if (!empty($type) && $type === 'client') { ?>
                        <select name="client_id[]" multiple class="selectpicker" data-width="100%" required>
                            <?php
                            $all_clients = get_result('tbl_client');
                            if (!empty($all_clients)) {
                                foreach ($all_clients as $clients) {
                                    ?>
                                    <option value="<?= $clients->client_id ?>" <?php
                                    if (!empty($deals->client_id)) {
                                        $client_id = json_decode($deals->client_id);
                                        if (in_array($clients->client_id, $client_id)) {
                                            echo 'selected';
                                        }
                                    }
                                    ?>>
                                        <?= $clients->name ?></option>
                                <?php }
                            } ?>
                        </select>
                    <?php } else { ?>
                        <select name="user_id[]" multiple class="selectpicker" data-width="100%" required>
                            <?php
                            $all_users = get_staff_details();
                            if (!empty($all_users)) {
                                foreach ($all_users as $user) {
                                    ?>
                                    <option value="<?= $user->user_id ?>" <?php
                                    if (!empty($deals->user_id)) {
                                        $user_id = json_decode($deals->user_id);
                                        if (in_array($user->user_id, $user_id)) {
                                            echo 'selected';
                                        }
                                    }
                                    ?>>
                                        <?= $user->username ?></option>
                                <?php }
                            } ?>
                        </select>
                    <?php } ?>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= lang('close') ?></button>
                <button type="submit" class="btn btn-primary"><?= lang('update') ?></button>
            </div>
        </form>
    </div>
</div>
