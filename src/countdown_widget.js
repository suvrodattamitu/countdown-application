(function ($) {
    let distance = 0;
    let days = 0;
    let hours = 0;
    let minutes = 0;
    let seconds = 0;
    let interval = 0;

    let countdownWidgetHandler = function ($scope) {
        var $countdownContainer = $scope.find(".ninja-countdown-timer-container");
        $countdownContainer.each(function () {
            let $countdownElem = $(this);

            let position = $countdownElem.find("#ninja_countdown").data("position");
            if( position !== 'required_position') {
                $countdownElem.find('#close_ninja_timer')[0].onclick = function(){
                    if( position === 'top' ) {
                        $countdownElem[0].classList.add('timer_hidden_top');
                    }else {
                        $countdownElem[0].classList.add('timer_hidden_bottom');
                    }
                }
            }

            function get_timer_value() 
            {
                let enddatetime = parseInt($countdownElem.find("#ninja_countdown").data("enddatetime"));
                enddatetime = new Date(enddatetime);
                distance = enddatetime - new Date();

                days    = Math.floor(distance / (1000 * 60 * 60 * 24));
                hours   = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                seconds = Math.floor((distance % (1000 * 60)) / 1000);
                
                if(distance<=0) {
                    days = 0;
                    hours = 0;
                    minutes = 0;
                    seconds = 0;
                }
                
                $countdownElem.find('#days')[0].innerHTML = days;
                $countdownElem.find('#hours')[0].innerHTML = hours;
                $countdownElem.find('#minutes')[0].innerHTML = minutes;
                $countdownElem.find('#seconds')[0].innerHTML = seconds;
            }

            interval = setInterval(function() {
                get_timer_value();
                if( distance <= 0 ) {
                    $countdownElem.remove();
                    clearInterval(interval);
                }
            }, 1000);
        });      
    }

    //Elementor Support
    $(window).on("elementor/frontend/init", function () {
        elementorFrontend.hooks.addAction("frontend/element_ready/countdown-widget.default", countdownWidgetHandler);
    });
}(jQuery));