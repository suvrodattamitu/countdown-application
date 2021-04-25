<div id="countdown-timer-wrapper" class="ninja-countdown-timer ninja-countdown-timer-1 ninja_countdown_banner_<?php echo $styles['position']; ?>">
    <div class="ninja-countdown-timer-container">
        <div class="ninja-countdown-timer">
            <div class="ninja-countdown-timer-header">
                <div class="ninja-countdown-timer-header-title-text">
                    <?php echo $timer['message']; ?>
                </div>
            </div>

            <script>

                if (!window.<?='countdown_timer_configs'?>) {
                    window.<?='countdown_timer_configs'?> = {};
                }
                window.<?='countdown_timer_configs'?> = <?= json_encode($data) ?>;

            </script>

            <div class="ninja-countdown-timer-item-container"  id="ninja_countdown" data-end_time="<?php echo $timer['currentdatetime']; ?>" data-now="<?php echo $timer['currentdatetime']; ?>">
                <div class="ninja-countdown-timer-item">
                    <div class="ninja-countdown-timer-item-group ninja-countdown-timer-item-group-days">
                        <div class="ninja-countdown-timer-item-group-inner">
                            <div class="ninja-countdown-timer-item-value-base" id="days">0</div>
                        </div>
                        <div class="ninja-countdown-timer-item-group-label" title="Days">Days</div>
                    </div>
                    <div class="ninja-countdown-timer-item-group ninja-countdown-timer-item-group-days">
                        <div class="ninja-countdown-timer-item-group-inner">
                            <div class="ninja-countdown-timer-item-value-base" id="hours">0</div>
                        </div>
                        <div class="ninja-countdown-timer-item-group-label" title="Days">Hours</div>
                    </div>

                    <div class="ninja-countdown-timer-item-group ninja-countdown-timer-item-group-days">
                        <div class="ninja-countdown-timer-item-group-inner">
                            <div class="ninja-countdown-timer-item-value-base" id="minutes">0</div>
                        </div>
                        <div class="ninja-countdown-timer-item-group-label" title="Days">Minutes</div>
                    </div>

                    <div class="ninja-countdown-timer-item-group ninja-countdown-timer-item-group-days">
                        <div class="ninja-countdown-timer-item-group-inner">
                            <div class="ninja-countdown-timer-item-value-base" id="seconds">0</div>
                        </div>
                        <div class="ninja-countdown-timer-item-group-label" title="Days">Seconds</div>
                    </div>
                </div>
            </div>

            <?php if( $button['show_button'] === 'true' ) {?>
                <div class="ninja-countdown-timer-button-container">
                    <a class="ninja-countdown-timer-button" href="<?php echo $button['button_link']; ?>" target="<?php echo $button['new_tab'] === 'true' ? '_blank' : '' ?>">
                        <?php echo $button['button_text']; ?>
                    </a>
                </div>
            <?php } ?>

        </div>

        <div class="ninja-countdown-timer-bar-close" id="close_ninja_timer"></div>
    </div>
</div>
