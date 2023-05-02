<thead>
<tr>
    <th><?= lang('employee') ?></th>
    <?php
    foreach ($all_date as $v_date) {
        ?>
        <th class="<?= $v_date == date('Y-m-d') ? 'active' : '' ?>"><?= $v_date ?></th>
    <?php }
    ?>
</tr>
</thead>
<tbody>
<?php
if (!empty($all_mapping)) {
    foreach ($all_mapping as $userID => $v_mapping) { ?>
        <tr>
            <td><?= fullname($userID) ?></td>
            <?php
            foreach ($v_mapping as $date => $mapping) {
                foreach ($mapping as $mappingInfo) {
                    $holiday = '';
                    if (!empty($mappingInfo->day)) {
                        $class = 'warning';
                        $chng = '';
                        $holiday = true;
                        $shift_name = '<span class="">' . lang('weekly_holiday') . '</span>';
                    } else if (!empty($mappingInfo->leave_application_id)) {
                        $ltip = '';
                        if (!empty($mappingInfo->leave_category)) {
                            $ltip .= $mappingInfo->leave_category . '<br>';
                            if ($mappingInfo->leave_type == 'multiple_days') {
                                $ltip .= display_date($mappingInfo->leave_start_date) . ' to ' . display_date($mappingInfo->leave_end_date);
                            } else if ($mappingInfo->leave_type == 'single') {
                                $ltip .= display_date($mappingInfo->leave_start_date);
                            } else if ($mappingInfo->leave_type == 'hour') {
                                $ltip .= lang('hourly') . ' ' . lang('leave') . ": " . $mappingInfo->hours . ":00" . ' ' . lang('hour') . "'>" . lang('hourly') . ' ' . lang('leave');
                            }
                        }
                        $class = 'danger';
                        $shift_name = '<span class="" data-html="true" data-toggle="tooltip" data-placement="top" title="' . $ltip . '">' . lang('on_leave') . '</span>';
                    } else if (!empty($mappingInfo->holiday_id)) {
                        $class = 'info';
                        $shift_name = '<span class="" style="' . $mappingInfo->color . '" data-toggle="tooltip" data-placement="top" title="' . $mappingInfo->event_name . '">' . lang('public_holiday') . '</span>';
                    } else {
                        $chng = true;
                        if (!empty($mappingInfo->shift_name)) {
                            $class = 'default';
                            $shift_name = '<span class="">' . $mappingInfo->shift_name . '<span class="block"> (' . display_time($mappingInfo->start_time) . ' ' . display_time($mappingInfo->end_time) . ') </span></span>';
                        } else {
                            $class = 'success';
                            $shift_name = lang('available');
                        }
                    }
                    $change = '<div class="btn-group ml-lg"><button type="button" data-toggle="dropdown"  class="btn-xs btn btn-' . $class . '" aria-expanded="false">' . $shift_name . '</button>';
                    if (!empty($chng)) {
                        $change .= '<ul role="menu" class="dropdown-menu animated zoomIn">';
                        $all_shift = get_result('tbl_shift', array('status' => 'published'));
                        if (!empty($all_shift)) {
                            foreach ($all_shift as $v_shift) {
                                $recuring = ($v_shift->recurring == 'Yes' ? '<i class="fa fa-retweet"></i>' : '');
                                $data = url_encode($v_shift->shift_id . 'data' . $date . 'data' . $userID);
                                $change .= '<li class="' . (!empty($mappingInfo->shift_id) && $mappingInfo->shift_id == $v_shift->shift_id ? 'active' : '') . '"><a href="' . base_url('admin/shift/assign_shift_by_date/' . $data) . '">' . $v_shift->shift_name . '<span> (' . display_time($v_shift->start_time) . ' ' . display_time($v_shift->end_time) . ') </span>' . $recuring . '</a> </li>';
                            }
                        }
                        $change .= '</ul>';
                    }
                    $change .= '</div>';
                }
                ?>
                <td class="<?= (empty($holiday) ? 'markDIV' : '') ?> <?= $date == date('Y-m-d') ? 'active' : '' ?> p-lg"
                    id="<?= $date . 'data' . $userID ?>">
                    <div class=""><?= $change ?></div>
                </td>
                <?php
            } ?>
        </tr>
    <?php }
}
?>
</tbody>

<script type="text/javascript">
    (function ($) {
        "use strict";
        let select = $('.markDIV');
        let SubmitShift = $('.SubmitShift');
        let ShiftData = '';
        <?php
            $change = '<div class="btn-group ml-lg "><button type="button" data-toggle="dropdown"  class="btn btn-danger" aria-expanded="false">' . lang('change') . '</button>';
            $change .= '<ul role="menu" class="dropdown-menu animated zoomIn pull-right">';
            $all_shift = get_result('tbl_shift', array('status' => 'published'));
            if (!empty($all_shift)) {
                foreach ($all_shift as $v_shift) {
                    $recuring = ($v_shift->recurring == 'Yes' ? '<i class="fa fa-retweet"></i>' : '');
                    $change .= '<li class="SubmitShift" data-shift-id="' . $v_shift->shift_id . '"><a href="#">' . $v_shift->shift_name . '<span> (' . display_time($v_shift->start_time) . ' ' . display_time($v_shift->end_time) . ') </span>' . $recuring . '</a> </li>';
                }
            }
            $change .= '</ul>';
            $change .= '</div>';
            ?>;
        let change = '<?= $change ?>';
        select.on("click", function (e) {
            $('.ChangesShift').empty();
            if (e.shiftKey || e.ctrlKey || e.metaKey) {
                $(this).toggleClass("selected");
            } else {
                if ($(this).hasClass("selected")) {
                    $(".markDIV").removeClass("selected");
                } else {
                    $(".markDIV").removeClass("selected");
                    $(this).addClass("selected");
                }
            }
            var selectedIds = $('.selected').map(function () {
                return this.id;
            }).get();

            if (selectedIds.length > 0) {
                $('.ChangesShift').append(change);
                ShiftData = selectedIds;
            }
        });
        $(document).on("click", ".SubmitShift", function (e) {
            const shiftID = $(this).attr('data-shift-id');
            var formData = {
                'shiftFor': ShiftData,
            };
            $.ajax({
                type: 'POST', // define the type of HTTP verb we want to use (POST for our form)
                url: '<?= base_url() ?>admin/shift/assignNewShift/' + shiftID, // the url where we want to POST
                data: formData, // our data object
                dataType: 'json', // what type of data do we expect back from the server
                encode: true,
                success: function (res) {
                    if (res) {
                        toastr[res.status](res.message);
                        location.reload();
                    } else {
                        alert('There was a problem with AJAX');
                    }
                }
            })
        });
    })(jQuery);
</script>