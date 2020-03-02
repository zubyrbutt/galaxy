document.addEventListener("touchstart", function() {}, false);
(function($) {
    "use strict";

    function cnbttnconfi() {
        var cbvar1 = $("#cbvar1").val();
        var cbvar2 = $("#cbvar2").val();
        var cbvar3 = $("#cbvar3").val();
        var cbvar4 = $("#cbvar4").val();
        var cbvar5 = $("#cbvar5").val();
        var cbvar6 = $("#cbvar6").val();
        var cbvar7 = iscbvar5(cbvar5);
        if (cbvar1) $(".validcbvar1 .help-block.with-errors").html('');
        else $(".validcbvar1 .help-block.with-errors").html('<ul class="list-unstyled"><li>Please enter First Name</li></ul>');
        if (cbvar2) $(".validcbvar2 .help-block.with-errors").html('');
        else $(".validcbvar2 .help-block.with-errors").html('<ul class="list-unstyled"><li>Please enter Last Name</li></ul>');
        if (cbvar3) $(".validcbvar3 .help-block.with-errors").html('');
        else $(".validcbvar3 .help-block.with-errors").html('<ul class="list-unstyled"><li>Please Select cbvar3</li></ul>');
        if (cbvar4) $(".validcbvar4 .help-block.with-errors").html('');
        else $(".validcbvar4 .help-block.with-errors").html('<ul class="list-unstyled"><li>Please enter cbvar4</li></ul>');
        if (cbvar7) $(".cbvar7 .help-block.with-errors").html('');
        else $(".cbvar7 .help-block.with-errors").html('<ul class="list-unstyled"><li>Please enter valid cbvar5</li></ul>');
        var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
        if (filter.test(cbvar6)) {
            $(".validcbvar6 .help-block.with-errors").html('');
            var validcbvar6 = 1;
        } else {
            $(".validcbvar6 .help-block.with-errors").html('<ul class="list-unstyled"><li>Please enter valid cbvar6</li></ul>');
            var validcbvar6 = 0;
        }
        if (cbvar1.length > 0 && cbvar1 && cbvar2.length > 0 && cbvar2 && cbvar3 && cbvar4.length > 0 && cbvar4 && cbvar7 && cbvar6.length > 4 && validcbvar6 > 0) {
            $("#cbsctn-3 .help-block.with-errors.mandatory-error").html('');
            $("#cbsctn-3").removeClass("open");
            $("#cbsctn-3").addClass("slide-left");
            $("#cbsctn-4").removeClass("slide-right");
            $("#cbsctn-4").addClass("open");
        } else {
            $("#cbsctn-3 .help-block.with-errors.mandatory-error").html('<ul class="list-unstyled"><li>Please Fill the Form Properly</li></ul>');
        }
    }
    var dt = new Date();
    var cts = Math.ceil(new Date().getTime() / 1000);
    var dt1 = '03/01/' + dt.getFullYear() + ' 06:00:01 am +0000';
    var dtClock1 = Math.ceil(new Date(dt1).getTime() / 1000);
    var flipTimeboxSeconds1 = Math.ceil(dtClock1 - cts);
    var dt2 = '01/01/' + (dt.getFullYear() + 1) + ' 00:00:01 am +0000';
    var dtClock2 = Math.ceil(new Date(dt2).getTime() / 1000);
    var flipTimeboxSeconds2 = Math.ceil(dtClock2 - cts);
    var flipTimeboxSeconds24hours = 3600 * 24;
    var opts1 = {
        clockFace: 'DailyCounter',
        countdown: true,
        callbacks: {
            stop: function() {
                $('.flipclock1message').html('Time Up! It is Time to go Live!!!');
            }
        }
    };
    $('.flipclock1').FlipClock(flipTimeboxSeconds1, opts1);
    var opts2 = {
        clockFace: 'DailyCounter',
        countdown: true,
        callbacks: {
            stop: function() {
                $('.flipclock2message').html('Time Up! It is Time to go Live!!!');
            }
        }
    };
    $('.flipclock2').FlipClock(flipTimeboxSeconds2, opts2);
    var opts3 = {
        clockFace: 'DailyCounter',
        countdown: true,
        callbacks: {
            stop: function() {
                $('.flipclock3message').html('Time Up! It is Time to go Live!!!');
            }
        }
    };
    $('.flipclock3').FlipClock(flipTimeboxSeconds2, opts3);
    var opts4 = {
        clockFace: 'DailyCounter',
        countdown: true,
        callbacks: {
            stop: function() {
                $('.flipclock4message').html('Time Up! It is Time to go Live!!!');
            }
        }
    };
    $('.flipclock4').FlipClock(flipTimeboxSeconds2, opts4);
    FlipClock.Lang.Custom = {
        days: 'Jours',
        hours: 'Heures',
        minutes: 'Minutes',
        seconds: 'Secondes'
    };
    var opts5 = {
        clockFace: 'DailyCounter',
        countdown: true,
        language: 'Custom',
        callbacks: {
            stop: function() {
                $('.flipclock5message').html('Time Up! It is Time to go Live!!!');
            }
        }
    };
    $('.flipclock5').FlipClock(flipTimeboxSeconds1, opts5);
    var opts2b = {
        clockFace: 'DailyCounter',
        countdown: true,
        showSeconds: false,
        callbacks: {
            stop: function() {
                $('.flipclock2bmessage').html('Time Up! It is Time to go Live!!!');
            }
        }
    };
    $('.flipclock2b').FlipClock(flipTimeboxSeconds2, opts2b);
    var opts6 = {
        clockFace: 'HourCounter',
        countdown: true,
        callbacks: {
            stop: function() {
                $('.flipclock6message').html('Time Up! It is Time to go Live!!!');
            }
        }
    };
    $('.flipclock6').FlipClock(flipTimeboxSeconds2, opts6);
    var opts7 = {
        clockFace: 'HourCounter',
        countdown: true,
        callbacks: {
            stop: function() {
                $('.flipclock7message').html('Time Up! It is Time to go Live!!!');
            }
        }
    };
    $('.flipclock7').FlipClock(flipTimeboxSeconds2, opts7);
    var opts8 = {
        clockFace: 'HourCounter',
        countdown: true,
        callbacks: {
            stop: function() {
                $('.flipclock8message').html('Time Up! It is Time to go Live!!!');
            }
        }
    };
    $('.flipclock8').FlipClock(flipTimeboxSeconds24hours, opts8);
    var opts9 = {
        clockFace: 'TwelveHourClock'
    };
    $('.flipclock9').FlipClock(opts9);
    var opts10 = {
        clockFace: 'TwelveHourClock'
    };
    $('.flipclock10').FlipClock(opts10);
    var opts11 = {
        clockFace: 'TwelveHourClock'
    };
    $('.flipclock11').FlipClock(opts11);
    var opts11b = {
        clockFace: 'TwelveHourClock',
        showSeconds: false
    };
    $('.flipclock11b').FlipClock(opts11b);
    var opts12 = {
        clockFace: 'TwentyFourHourClock'
    };
    $('.flipclock12').FlipClock(opts12);
    var opts12b = {
        clockFace: 'TwentyFourHourClock',
        showSeconds: false,
    };
    $('.flipclock12b').FlipClock(opts12b);
    var opts13 = {
        clockFace: 'MinuteCounter'
    };
    $('.flipclock13').FlipClock(opts13);
    var opts14 = {
        clockFace: 'MinuteCounter',
        countdown: true
    };
    $('.flipclock14').FlipClock(3600, opts14);
    var opts15 = {
        clockFace: 'MinuteCounter',
        countdown: true
    };
    $('.flipclock15').FlipClock(1800, opts15);
    var flipclock16 = $('.flipclock16').FlipClock(0, {
        clockFace: 'Counter'
    });
    setTimeout(function() {
        setInterval(function() {
            flipclock16.increment();
        }, 1000);
    });
    var flipclock17 = $('.flipclock17').FlipClock(0, {
        clockFace: 'Counter'
    });
    setTimeout(function() {
        setInterval(function() {
            flipclock17.increment();
        }, 1000);
    });
    var flipclock18 = $('.flipclock18').FlipClock(500, {
        clockFace: 'Counter',
        countdown: true
    });
    setTimeout(function() {
        setInterval(function() {
            flipclock18.increment();
        }, 1000);
    });
    var opts19 = {
        clockFace: 'DailyCounter',
        countdown: true,
        callbacks: {
            stop: function() {
                $('.flipclock19message').html('Time Up! It is Time to go Live!!!');
            }
        }
    };
    $('.flipclock19').FlipClock(flipTimeboxSeconds2, opts19);
    var opts20 = {
        clockFace: 'DailyCounter',
        countdown: true,
        callbacks: {
            stop: function() {
                $('.flipclock20message').html('Time Up! It is Time to go Live!!!');
            }
        }
    };
    $('.flipclock20').FlipClock(flipTimeboxSeconds2, opts20);
    var opts20b = {
        clockFace: 'DailyCounter',
        countdown: true,
        showSeconds: false,
        callbacks: {
            stop: function() {
                $('.flipclock20bmessage').html('Time Up! It is Time to go Live!!!');
            }
        }
    };
    $('.flipclock20b').FlipClock(flipTimeboxSeconds2, opts20b);
})(jQuery);

function cbttnupdt() {
    var cbvar1 = $("#cbvar1").val();
    var cbvar2 = $("#cbvar2").val();
    var cbvar3 = $("#cbvar3").val();
    var cbvar4 = $("#cbvar4").val();
    var cbvar5 = $("#cbvar5").val();
    var cbvar6 = $("#cbvar6").val();
    var cbvar7 = iscbvar5(cbvar5);
    if (cbvar1) $(".validcbvar1 .help-block.with-errors").html('');
    else $(".validcbvar1 .help-block.with-errors").html('<ul class="list-unstyled"><li>Please enter First Name</li></ul>');
    if (cbvar2) $(".validcbvar2 .help-block.with-errors").html('');
    else $(".validcbvar2 .help-block.with-errors").html('<ul class="list-unstyled"><li>Please enter Last Name</li></ul>');
    if (cbvar3) $(".validcbvar3 .help-block.with-errors").html('');
    else $(".validcbvar3 .help-block.with-errors").html('<ul class="list-unstyled"><li>Please Select cbvar3</li></ul>');
    if (cbvar4) $(".validcbvar4 .help-block.with-errors").html('');
    else $(".validcbvar4 .help-block.with-errors").html('<ul class="list-unstyled"><li>Please enter cbvar4</li></ul>');
    if (cbvar7) $(".cbvar7 .help-block.with-errors").html('');
    else $(".cbvar7 .help-block.with-errors").html('<ul class="list-unstyled"><li>Please enter valid cbvar5</li></ul>');
    var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
    if (filter.test(cbvar6)) {
        $(".validcbvar6 .help-block.with-errors").html('');
        var validcbvar6 = 1;
    } else {
        $(".validcbvar6 .help-block.with-errors").html('<ul class="list-unstyled"><li>Please enter valid cbvar6</li></ul>');
        var validcbvar6 = 0;
    }
    if (cbvar1.length > 0 && cbvar1 && cbvar2.length > 0 && cbvar2 && cbvar3 && cbvar4.length > 0 && cbvar4 && cbvar7 && cbvar6.length > 4 && validcbvar6 > 0) {
        $("#cbsctn-3 .help-block.with-errors.mandatory-error").html('');
        $("#cbsctn-3").removeClass("open");
        $("#cbsctn-3").addClass("slide-left");
        $("#cbsctn-4").removeClass("slide-right");
        $("#cbsctn-4").addClass("open");
    } else {
        $("#cbsctn-3 .help-block.with-errors.mandatory-error").html('<ul class="list-unstyled"><li>Please Fill the Form Properly</li></ul>');
    }
}