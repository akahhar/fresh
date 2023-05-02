<?= message_box('success'); ?>
<div class="panel panel-custom">
    <header class="panel-heading ">
        <div class="panel-title">
            <?= lang('currencyList') ?>
            <div class="pull-right">
                <?php if (super_admin_access()) { ?>
                    <span data-toggle="tooltip" data-placement="top" title="<?= lang('new_currency'); ?>"
                    </span>
                    <a data-toggle="modal" data-target="#myModal"
                       href="<?= base_url() ?>saas/settings/new_currency" class="btn btn-sm btn-success">
                        <i class="fa fa-plus text-white"></i></a>
                <?php } ?>
            </div>
        </div>

    </header>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th><?= lang('code') ?></th>
                    <th><?= lang('code_name') ?></th>
                    <th><?= lang('symbol') ?></th>
                    <th><?= lang('action') ?></th>
                </tr>
                </thead>
                <tbody>
                <?php
                $all_currencies = get_result('tbl_currencies');
                if (!empty($all_currencies)) {
                    foreach ($all_currencies as $v_currencies) {
                        $id = $this->uri->segment(4);
                        ?>
                        <tr>
                            <td>
                                <?php
                                if (!empty($id) && $id == $v_currencies->code) { ?>
                                <form method="post" action="<?= base_url() ?>saas/settings/new_currency/save/<?php
                                if (!empty($currency)) {
                                    echo $currency->code;
                                }
                                ?>" class="form-horizontal">
                                    <input type="text" name="code" value="<?php
                                    if (!empty($currency)) {
                                        echo $currency->code;
                                    }
                                    ?>" class="form-control" placeholder="<?= lang('currency_code') ?>" required>
                                    <?php } else {
                                        echo $v_currencies->code;
                                    }
                                    ?>
                            </td>
                            <td>
                                <?php
                                if (!empty($id) && $id == $v_currencies->code) { ?>
                                    <input type="text" name="name" value="<?php
                                    if (!empty($currency)) {
                                        echo $currency->name;
                                    }
                                    ?>" class="form-control" placeholder="<?= lang('currency_name') ?>" required>
                                <?php } else {
                                    echo $v_currencies->name;
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if (!empty($id) && $id == $v_currencies->code) { ?>
                                    <input type="text" name="symbol" value="<?php
                                    if (!empty($currency)) {
                                        echo $currency->symbol;
                                    }
                                    ?>" class="form-control" placeholder="<?= lang('currency_symbol') ?>" required>
                                <?php } else {
                                    echo $v_currencies->symbol;
                                }
                                ?>
                            </td>
                            <td>
                                <?php
                                if (!empty($id) && $id == $v_currencies->code) { ?>
                                    <?= btn_update() ?>
                                    </form>
                                    <?= btn_cancel('saas/settings/currencyList/') ?>
                                <?php } else { ?>
                                    <?= btn_edit('saas/settings/currencyList/' . $v_currencies->code) ?>
                                <?php }
                                ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
