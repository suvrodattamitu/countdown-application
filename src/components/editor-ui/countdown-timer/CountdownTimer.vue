<template>    
    <div class="nfd-container">
        <div class="nfd-row">
            <div class="ninja-countdown-timer-wrapper ninja-wrapper-styler" :class="['timer-position-'+all_configs.styles.position, all_configs.styles.position !== 'required_position' ? 'timer-floating-option-editor' : '']">
                <div class="ninja-countdown-timer-container">
                    <div class="ninja-countdown-timer-contents">
                        <div class="ninja-countdown-timer">
                            <div class="ninja-countdown-timer-header">
                                <div class="ninja-countdown-timer-header-title-text">
                                    {{ all_configs.timer.message }}
                                </div>
                            </div>
                            <div class="ninja-countdown-timer-img before_timer" v-if="all_configs.image.show_image === 'true' && all_configs.image.position === 'before_timer'">
                                <img :src="all_configs.image.url" />
                            </div>
                            <div class="ninja-countdown-timer-item-container">
                                <div class="ninja-countdown-timer-item">
                                    <div class="ninja-countdown-timer-item-group ninja-countdown-timer-item-group-days">
                                        <div class="ninja-countdown-item-contents">
                                            <div class="ninja-countdown-timer-item-group-inner">
                                                <div class="ninja-countdown-timer-item">{{days}}</div>
                                            </div>
                                        </div>
                                        <div class="ninja-countdown-timer-item-group-label" title="Days">Days</div>
                                    </div>
                                    <div class="ninja-countdown-timer-item-group ninja-countdown-timer-item-group-days">
                                        <div class="ninja-countdown-timer-item-group-inner">
                                            <div class="ninja-countdown-timer-item">{{hours}}</div>
                                        </div>
                                        <div class="ninja-countdown-timer-item-group-label" title="Days">Hours</div>
                                    </div>
                                    <div class="ninja-countdown-timer-item-group ninja-countdown-timer-item-group-days">
                                        <div class="ninja-countdown-timer-item-group-inner">
                                            <div class="ninja-countdown-timer-item">{{minutes}}</div>
                                        </div>
                                        <div class="ninja-countdown-timer-item-group-label" title="Days">Minutes</div>
                                    </div>
                                    <div class="ninja-countdown-timer-item-group ninja-countdown-timer-item-group-days">
                                        <div class="ninja-countdown-timer-item-group-inner">
                                            <div class="ninja-countdown-timer-item">{{seconds}}</div>
                                        </div>
                                        <div class="ninja-countdown-timer-item-group-label" title="Days">Seconds</div>
                                    </div>
                                </div>
                            </div>
                            <div class="ninja-countdown-timer-img after_timer" v-if="all_configs.image.show_image === 'true' && all_configs.image.position === 'after_timer'">
                                <img :src="all_configs.image.url" />
                            </div>
                            <div class="ninja-countdown-timer-button-container" v-if="all_configs.button.show_button === 'true'">
                                <a class="ninja-countdown-timer-button" :href="all_configs.button.button_link" :target="all_configs.button.new_tab ==='true' ? '_blank':'' ">
                                    {{ all_configs.button.button_text }}
                                </a>
                            </div>
                        </div>
                        <div class="ninja-countdown-timer-bar-close" v-if="all_configs.styles.position !== 'required_position'"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['all_configs'],

    data() {
        return {
            assets_url: window.NinjaCountdownAdmin.assets_url,
            distance:0,
            days: 0,
            hours: 0,
            minutes: 0,
            seconds: 0,
            unit: 'days',
            period: 1,
            enddatetime: this.all_configs.timer.enddatetime,
            currentdatetime: this.all_configs.timer.currentdatetime
        }
    },

    methods: {
        get_timer_value() {
            let enddatetime = new Date(this.enddatetime);
            let currentdatetime = new Date();
            this.distance = enddatetime - currentdatetime;

            this.days    = Math.floor(this.distance / (1000 * 60 * 60 * 24));
            this.hours   = Math.floor((this.distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            this.minutes = Math.floor((this.distance % (1000 * 60 * 60)) / (1000 * 60));
            this.seconds = Math.floor((this.distance % (1000 * 60)) / 1000);
        }
    },

    watch: {
        'all_configs.timer.time_period': {
            handler(val){
                let now = new Date();
                this.currentdatetime = new Date();
                this.period = this.all_configs.timer.time_period;
                this.unit = this.all_configs.timer.time_unit;

                let that = this;
                let x = setInterval(function() {

                    that.get_timer_value();

                    if( that.distance <= 0 ) {
                        that.days = 0;
                        that.hours = 0;
                        that.minutes = 0;
                        that.seconds = 0;
                        clearInterval(x);
                    }
                    
                }, 1000);

                let periods = {
                    days : this.period*60 * 60 * 24 * 1000,
                    hours : this.period*1000 * 60 * 60,
                    minutes : this.period*1000 * 60
                }

                this.enddatetime = now.setTime( now.getTime() + periods[this.unit] );
                this.all_configs.timer['enddatetime'] = this.enddatetime;
            },
            deep: true
        },

        'all_configs.timer.time_unit': {
            handler(val){
                let now = new Date();
                this.currentdatetime = new Date();
                this.period = this.all_configs.timer.time_period;
                this.unit = this.all_configs.timer.time_unit;

                let that = this;
                let x = setInterval(function() {

                    that.get_timer_value();

                    if( that.distance <= 0 ) {
                        that.days = 0;
                        that.hours = 0;
                        that.minutes = 0;
                        that.seconds = 0;
                        clearInterval(x);
                    }
                    
                }, 1000);

                let periods = {
                    days : this.period*60 * 60 * 24 * 1000,
                    hours : this.period*1000 * 60 * 60,
                    minutes : this.period*1000 * 60
                }

                this.enddatetime = now.setTime( now.getTime() + periods[this.unit] );
                this.all_configs.timer['enddatetime'] = this.enddatetime;
            },
            deep: true
        }
    },

    mounted() {
        let that = this;
        let x = setInterval(function() {
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