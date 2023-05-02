<style>
    .w-100 {
        width: 100% !important;
    }

    .w-45 {
        width: 45% !important;
    }

    .w-40 {
        width: 40% !important;
    }
</style>
<?php
if (!empty($all_shift_mapping)) {
    foreach ($all_shift_mapping as $user => $all_shift) {
        ?>
        <tr id="table_shift_<?= $user ?>">
            <td><?= fullname($user) ?></td>
            <td colspan="3">
                <table class="w-100">
                    <tbody>
                    <?php
                    foreach ($all_shift as $shift) {
                        $shiftName = $shift->shift_name . ' (' . display_time($shift->start_time) . ' ' . display_time($shift->end_time) . ') '; ?>
                        <tr class="p bb">
                            <td class="w-45"><?= $shiftName ?>
                                <span class="block"><?= display_date($shift->start_date);
                                    if ($shift->recurring == 'Yes' && empty($shift->end_date)) { ?> -
                                        <a onclick="return confirm('<?= lang('shift_stop_recurring') ?>')"
                                           class="label label-success mb"
                                           href="<?= base_url('admin/shift/stop_recurring/' . $shift->shift_mapping_id) ?>"
                                           title="<?= lang('stop_recurring') ?>"><i class="fa fa-retweet"></i></a>
                                    <?php } else {
                                        echo ' - ' . display_date($shift->end_date);
                                    }
                                    ?></span>
                            </td>
                            <td class="w-40"><?= display_datetime($shift->modified_on) ?></td>
                            <td>
                                <?= btn_edit(base_url('admin/shift/assignShift/' . $shift->shift_mapping_id)) ?>
                                <?= btn_delete(base_url('admin/shift/delete_mapping/' . $shift->shift_mapping_id)) ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </td>
        </tr>
        <?php
    };
} else {
    ?>
    <tr>
        <td colspan="4"><?= lang('nothing_to_display') ?></td>
    </tr>
<?php }
?>