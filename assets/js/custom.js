/* 
 * Tooltips icon
 */
$(function () {
    $('[data-toggle="tooltip"]').tooltip()
})
$(function () {

})
///*
// * Bootstrap Slider
// */
//$(function() {
//    /* BOOTSTRAP SLIDER */
//    $('.slider').slider();
//    //Initialize Select2 Elements
//
//});
///*
// * Time and Date Pickers
// */


$(function () {
    $('button[id="checkit"]').on("click", function () {
        $('#month').css("display", "block").css("margin-top", "20" + "px");
    });
});
/* 
 * Session Academic Calender 
 */

$(document).ready(function () {
    $('input.select_one').on('change', function () {
        $('input.select_one').not(this).prop('checked', false);
    });
});

/* 
 * Show all alert
 */
$(document).ready(function () {
    setTimeout(function () {
        $(".alert").fadeOut("slow", function () {
            $(".alert").remove();
        });

    }, 3000);

});


/*
 * Select All select
 */
$(function () {
    $('#parent_present').on('change', function () {
        $('.child_present').prop('checked', $(this).prop('checked'));
    });
    $('.child_present').on('change', function () {
        $('.child_present').prop($('.child_present:checked').length ? true : false);
    });
    $('#parent_absent').on('change', function () {
        $('.child_absent').prop('checked', $(this).prop('checked'));
    });
    $('.child_absent').on('change', function () {
        $('.child_absent').prop($('.child_absent:checked').length ? true : false);
    });
});
/*
 * Click to show 
 */

$(function () {
    $('input[id="fixed_rate"]').on("click", function () {
        if (this.checked) {
            $('div.fixed_price').show();
            $('div.hourly_rate').hide();
        } else {
            $('div.fixed_price').hide();
            $('div.hourly_rate').show();
        }
    });
    //Red color scheme for iCheck
    //$('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
    //    checkboxClass: 'icheckbox_minimal-red',
    //});
});

$(document).ready(function () {
    $('input.select_one').on('change', function () {
        $('input.select_one').not(this).prop('checked', false);
    });
});
$(function () {
    $('#parent').on('change', function () {
        $('.child').prop('checked', $(this).prop('checked'));
    });
    $('.child').on('change', function () {
        $('#parent').prop($('.child:checked').length ? true : false);
    });
});

// ************* CRM ********************
$(function () {
    $('input[id="contacted_today"]').on("click", function () {
        if (this.checked) {
            $('div#contactedtoday').hide();
        } else {
            $('div#contactedtoday').show();
        }
    });
});

$(function () {
    $('input[id="use_postmark"]').on("click", function () {
        if (this.checked) {
            $('div#postmark_config').show();
        } else {
            $('div#postmark_config').hide();
        }
    });
});

$(function () {
    $('#protocol').change(function () {
        if ($('#protocol').val() == 'smtp') {
            $('#smtp_config').show();
        } else {
            $('#smtp_config').hide();
        }
    });
    $('.company').hide();
    var client_stusus = $('#client_stusus').val();
    if (client_stusus == '2') {
        $(".company").removeAttr('disabled');
    } else {
        $(".company").attr('disabled', 'disabled');
    }
    $('#client_stusus').change(function () {
        if ($('#client_stusus').val() == '1') {
            $('.person').show();
            $('.company').hide();
            $(".company").attr('disabled', 'disabled');
            $(".person").removeAttr('disabled');
        } else {
            $('.person').hide();
            $('.company').show();
            $(".person").attr('disabled', 'disabled');
            $(".company").removeAttr('disabled');
        }
    });

    $('.easypiechart').each(function () {
        var $this = $(this), $data = $this.data(), $step = $this.find('.step'),
            $target_value = parseInt($($data.target).text()), $value = 0;
        $data.barColor || ($data.barColor = function ($percent) {
            $percent /= 100;
            return "rgb(" + Math.round(200 * $percent) + ", 200, " + Math.round(200 * (1 - $percent)) + ")";
        });
        $data.onStep = function (value) {
            $value = value;
            $step.text(parseInt(value));
            $data.target && $($data.target).text(parseInt(value) + $target_value);
        }
        $data.onStop = function () {
            $target_value = parseInt($($data.target).text());
            $data.update && setTimeout(function () {
                $this.data('easyPieChart').update(100 - $value);
            }, $data.update);
        }
        $(this).easyPieChart($data);
    });
});
