<?php echo form_open(base_url('admin/shift/update_conflic'), array('class' => 'form-horizontal', 'enctype' => 'multipart/form-data', 'data-parsley-validate' => '', 'role' => 'form'));

?>
<div class="panel panel-custom">
    <header class="panel-heading ">
        <div class="panel-title">
            <strong><?= lang('conflicts_found') . ' for <span class="text-danger">' . $shiftName . ' ' . lang('date') . ':' . $inputData['start_date'] . ' to ' . $inputData['end_date'] . '</spna>' ?></strong>
            <div class="pull-right">
                <input type="submit" class="btn btn-xs btn-primary" name="update_conflic_update"
                       value="<?= lang('submit') ?>"/>
                <a href="<?= base_url('admin/shift/calendar') ?>"
                   class="btn btn-xs btn-danger"><?= lang('cancel') ?></a>
            </div>
        </div>
    </header>
    <div class="table-responsive">
        <table class="table table-striped" id="">
            <tr>
                <th><?= lang('users') ?></th>
                <th><?= lang('existing_shift') ?></th>
                <th><?= lang('changed_shift') ?></th>
                <th><?= lang('action') ?></th>
            </tr>
            <?php
            if (!empty($conflic_data)) {
                foreach ($conflic_data as $user => $conflic_datum) { ?>
                    <tr>
                        <td><?= fullname($user) ?></td>
                        <?php
                        ksort($conflic_datum);
                        $all_shift = array();
                        if (!empty($conflic_datum)) {
                            foreach ($conflic_datum as $date => $conflicData) {
                                if (!empty($conflicData) && is_array($conflicData)) {
                                    $shiftDate[$conflicData[0]->shift_mapping_id] = $this->shift_model->GetDays($conflicData[0]->start_date, $conflicData[0]->end_date);;
                                    $conflicDate[$conflicData[0]->shift_mapping_id][] = $date;
                                    $conflicInShort[] = $date;
                                }
                            }
                        }
                        foreach ($shiftDate as $shift_mapping_id => $shiftdate) {
                            if (!empty($shiftdate)) {
                                $NewData[$shift_mapping_id] = array_values(array_diff($shiftdate, $conflicDate[$shift_mapping_id]));
                            }
                        }
                        foreach ($NewData as $shift_mapping_id => $new_data) {
                            if (!empty($new_data)) {
                                foreach ($new_data as $key => $date) {
                                    $purifiedFromNew[$date] = $shift_mapping_id;
                                }
                            }
                        }
                        
                        foreach ($purifiedFromNew as $date => $shift_mapping_id) {
                            if (in_array($date, $conflicInShort)) {
                                unset($purifiedFromNew[$date]);
                            }
                        }
                        
                        if (!empty($purifiedFromNew)) {
                            foreach ($purifiedFromNew as $date => $id) {
                                $sortingDate[$id][] = $date;
                            }
                        }
                        //Check for consecutive dates within a set and return as range
                        $conflicInfo = $this->shift_model->getConsecutiveDate($conflicDate);
                        $shiftWillBe = $this->shift_model->getConsecutiveDate($sortingDate);
                        ?>
                        <td class="text-danger">
                            <?php
                            if (!empty($conflicInfo)) {
                                foreach ($conflicInfo as $key => $allconflicDate) {
                                    foreach ($allconflicDate as $mapping_id => $all_date) {
                                        $conflicMapID[] = $mapping_id;
                                        $shipInfo = $this->shift_model->shiftMappingInfo($mapping_id);
                                        $conflicShift = $shipInfo->shift_name . ' (' . display_time($shipInfo->start_time) . ' ' . display_time($shipInfo->end_time) . ') '; ?>
                                        <?= $conflicShift ?> <span
                                                class="block">(<?= $all_date[0] . (!empty($all_date[1]) ? ' - ' . $all_date[1] : '') ?>)</span>
                                        <hr class="m0">
                                    
                                    <?php }
                                }
                            }
                            $conflicMapID = array_values(array_unique($conflicMapID));
                            ?>
                        
                        </td>
                        <td class="text-success">
                            <?= $shiftName ?><span
                                    class="block">(<?= $inputData['start_date'] . ' - ' . $inputData['end_date'] ?>)</span>
                            <hr class="m0">
                            <?php
                            $willBeMapID = array();
                            if (!empty($shiftWillBe)) {
                                foreach ($shiftWillBe as $key => $allWillBeDate) {
                                    foreach ($allWillBeDate as $mapping_id => $allDate) {
                                        $willBeMapID[$mapping_id][] = $allDate;
                                        $shipInfo = $this->shift_model->shiftMappingInfo($mapping_id);
                                        $WillBeShift = $shipInfo->shift_name . ' (' . display_time($shipInfo->start_time) . ' ' . display_time($shipInfo->end_time) . ') '; ?>
                                        <div class="text-info"><?= $WillBeShift ?> <span
                                                    class="block">(<?= $allDate[0] . (!empty($allDate[1]) ? ' - ' . $allDate[1] : '') ?>)</span>
                                        </div>
                                        <hr class="m0">
                                    <?php }
                                }
                            }
                            ?>
                            <input type="hidden" name="conflic_shift[<?= $user ?>]" id="_conflic_user_<?= $user ?>"
                                   value="<?= url_encode(json_encode($conflicMapID) . 'data' . json_encode($willBeMapID)) ?>">
                            <input name="conflic_user[<?= $user ?>]" id="conflic_user_<?= $user ?>" type="hidden"
                                   value="<?= url_encode($conflic_datum['to']->shift_id . 'data' . $conflic_datum['to']->start_date . 'data' . $conflic_datum['to']->end_date) ?>">
                        </td>
                        
                        <td>
                            <input class="btn btn-danger btn-xs" name="conflic_user_<?= $user ?>"
                                   onclick="exclude_conflic(this);" type="button" value="<?= lang('exclude') ?>">
                        </td>
                    </tr>
                <?php }
            }
            ?>
        </table>
    </div>
</div>
<?php echo form_close(); ?>
<script type="text/javascript">
    (function ($) {
        "use strict";

        function exclude_conflic(val) {
            var name = $("#" + val.name);
            var cname = $("#_" + val.name);
            name.attr('name', 'excluded'); // this can't ever work
            name.attr('value', 'excluded'); // this can't ever work
            cname.attr('name', 'excluded'); // this can't ever work
            cname.attr('value', 'excluded'); // this can't ever work
            val.name = 'excluded';
            val.value = 'excluded';
        }
    })(jQuery);
</script>