<template>    
    <div class="ninja-countdown-timer ninja-countdown-timer-1">
        <div class="ninja-countdown-timer-container">
            <div class="ninja-countdown-timer">
                <div class="ninja-countdown-timer-header">
                    <div class="ninja-countdown-timer-header-title-text">
                        {{ all_configs.timer.message }}
                    </div>
                </div>

                <div class="ninja-countdown-timer-item-container">
                    <div class="ninja-countdown-timer-item">
                        <div class="ninja-countdown-timer-item-group ninja-countdown-timer-item-group-days">
                            <div class="ninja-countdown-timer-item-group-inner">
                                <div class="ninja-countdown-timer-item-value-base">{{hours}}</div>
                            </div>
                            <div class="ninja-countdown-timer-item-group-label" title="Days">Hours</div>
                        </div>

                        <div class="ninja-countdown-timer-item-group ninja-countdown-timer-item-group-days">
                            <div class="ninja-countdown-timer-item-group-inner">
                                <div class="ninja-countdown-timer-item-value-base">{{minutes}}</div>
                            </div>
                            <div class="ninja-countdown-timer-item-group-label" title="Days">Minutes</div>
                        </div>

                        <div class="ninja-countdown-timer-item-group ninja-countdown-timer-item-group-days">
                            <div class="ninja-countdown-timer-item-group-inner">
                                <div class="ninja-countdown-timer-item-value-base">{{seconds}}</div>
                            </div>
                            <div class="ninja-countdown-timer-item-group-label" title="Days">Seconds</div>
                        </div>
                    </div>
                </div>

                <div class="ninja-countdown-timer-button-container" v-if="all_configs.button.show_button === 'true'">
                    <a class="ninja-countdown-timer-button" :href="all_configs.button.button_link" :target="all_configs.button.new_tab ==='true' ? '_blank':'' ">
                        {{ all_configs.button.button_text }}
                    </a>
                </div>
            </div>

            <div class="ninja-countdown-timer-bar-close"></div>
        </div>
  </div>
</template>

<script>
export default {

    props:['all_configs'],

    data() {
        return {
            distance:0,
            days: 0,
            hours: 0,
            minutes: 0,
            seconds: 0,
            unit: 'days',
            period: 1,
            currentdatetime: new Date()
        }
    },

    methods: {

        get_timer_value() {
            var countDownDate = new Date(this.currentdatetime);

            let periods = {
                days : this.period*60 * 60 * 24 * 1000,
                hours : this.period*1000 * 60 * 60,
                minutes : this.period*1000 * 60
            }

            countDownDate.setTime( countDownDate.getTime() + periods[this.unit] );

            this.distance = countDownDate - new Date();

            this.days    = Math.floor(this.distance / (1000 * 60 * 60 * 24));
            this.hours   = Math.floor((this.distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            this.minutes = Math.floor((this.distance % (1000 * 60 * 60)) / (1000 * 60));
            this.seconds = Math.floor((this.distance % (1000 * 60)) / 1000);
        }

    },

    watch: {

        'all_configs.timer.time_period': {
            handler(val){
                this.currentdatetime = new Date();
                this.period = this.all_configs.timer.time_period;
                this.unit = this.all_configs.timer.time_unit;

                let that = this;
                var x = setInterval(function() {

                    that.get_timer_value();

                    if( that.distance <= 0 ) {
                        that.days = 0;
                        that.hours = 0;
                        that.minutes = 0;
                        that.seconds = 0;
                        clearInterval(x);
                    }
                    
                }, 1000);

            },
            deep: true
        },

        'all_configs.timer.time_unit': {
            handler(val){
                this.currentdatetime = new Date();
                this.period = this.all_configs.timer.time_period;
                this.unit = this.all_configs.timer.time_unit;
                let that = this;
                var x = setInterval(function() {

                    that.get_timer_value();

                    if( that.distance <= 0 ) {
                        that.days = 0;
                        that.hours = 0;
                        that.minutes = 0;
                        that.seconds = 0;
                        clearInterval(x);
                    }
                    
                }, 1000);

            },
            deep: true
        }

    },

    mounted() {

        let that = this;
        var x = setInterval(function() {

            that.get_timer_value();

            if( that.distance <= 0 ) {
                that.days = 0;
                that.hours = 0;
                that.minutes = 0;
                that.seconds = 0;
                clearInterval(x);
            }
            
        }, 1000);

    }

}
</script>