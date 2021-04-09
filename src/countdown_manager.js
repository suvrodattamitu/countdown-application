(function() {

    var distance = 0;
    var days = 0;
    var hours = 0;
    var minutes = 0;
    var seconds = 0;

    var countdown_timer_configs = window.countdown_timer_configs

    function get_timer_value() {
        var enddatetime = countdown_timer_configs.timer.enddatetime;
        var enddatetime = new Date(enddatetime);
        distance = enddatetime - new Date();

        days    = Math.floor(distance / (1000 * 60 * 60 * 24));
        hours   = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
        document.getElementById("days").innerHTML = days;
        document.getElementById("hours").innerHTML = hours;
        document.getElementById("minutes").innerHTML = minutes;
        document.getElementById("seconds").innerHTML = seconds;
    }

    var x = setInterval(function() {
        get_timer_value();
        if( distance <= 0 ) {
            days = 0;
            hours = 0;
            minutes = 0;
            seconds = 0;
            clearInterval(x);
        }
    }, 1000);

})();