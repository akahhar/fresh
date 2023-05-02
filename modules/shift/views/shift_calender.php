<?php
$previous = date('Y-m-d', strtotime("-1 day", strtotime(reset($all_date))));
$next = date('Y-m-d', strtotime("+1 day", strtotime(end($all_date))));
?>
<style type="text/css">
    th.active,
    td.active {
        color: #59b749;
    }

    .selected {
        border: 2px solid #58b749 !important;
    }

    .pointer {
        cursor: pointer;
    }
</style>
<script type="text/javascript">
    (function ($) {
        "use strict";
        var week = $('#week');
        var previous = $('#PreviousWeek');
        var next = $('#NextWeek');
        getData('<?= date('Y-m-d') ?>');
        previous.click(function () {
            var previousDate = $(this).attr('data-previous');
            getData(previousDate);
        });

        function getData(date) {
            $.post("<?= base_url('admin/shift/getWeekDate') ?>", {
                date: date
            }, function (data, status) {
                data = JSON.parse(data);
                previous.attr('data-previous', data.firstDate);
                next.attr('data-next', data.lastDate);
                week.html(data.text);
                $('#all_shift_data').html(data.mapping_details);
            });
        }

        next.click(function () {
            var nextDate = next.attr('data-next');
            getData(nextDate);
        });
    })(jQuery);
</script>
<div class="panel panel-custom">
    <header class="panel-heading ">
        <div class="panel-title">
            <div class="text-center h4">
                <span class="fa fa-angle-left mr-sm pointer" data-previous="<?= $previous ?>" id="PreviousWeek"></span>
                <span id="week"><?= date('d-F-Y', strtotime(reset($all_date))) . ' - ' . date('d-F-Y', strtotime(end($all_date))) ?></span>
                <span class="fa fa-angle-right ml-sm pointer" data-next="<?= $next ?>" id="NextWeek"></span>
                <div class="pull-right ChangesShift">
                
                </div>
            </div>
        </div>
    </header>
    <div class="table-responsive">
        <table class="table table-striped table-bordered" id="all_shift_data">
        
        </table>
    </div>
</div>