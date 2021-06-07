<div class="nfd-container">
    <div class="nfd-row">
        <div id="countdown-timer-wrapper ninja-wrapper-styler" class="ninja-countdown-timer-wrapper <?php echo 'timer-position-'.$styles['position']; ?> <?php echo $styles['position'] !== 'required_position' ? 'timer-floating-option-frontend' : ''; ?>">
            <div class="ninja-countdown-timer-container">
                <div class="ninja-countdown-timer">
                    <div class="ninja-countdown-timer-header">
                        <div class="ninja-countdown-timer-header-title-text">
                            <?php echo esc_html($timer['message']); ?>
                        </div>
                    </div>
                    <script>
                        if (!window.<?='countdown_timer_configs'?>) {
                            window.<?='countdown_timer_configs'?> = {};
                        }
                        window.<?='countdown_timer_configs'?> = <?= json_encode($data) ?>;
                    </script>
                    <div class="ninja-countdown-timer-item-container"  id="ninja_countdown" data-end_time="<?php echo esc_html($timer['currentdatetime']); ?>" data-now="<?php echo esc_html($timer['currentdatetime']); ?>">
                        <div class="ninja-countdown-timer-item">
                            <div class="ninja-countdown-timer-item-group ninja-countdown-timer-item-group-days">
                                <div class="ninja-countdown-timer-item-group-inner">
                                    <div class="ninja-countdown-timer-item" id="days">0</div>
                                </div>
                                <div class="ninja-countdown-timer-item-group-label" title="Days">Days</div>
                            </div>
                            <div class="ninja-countdown-timer-item-group ninja-countdown-timer-item-group-days">
                                <div class="ninja-countdown-timer-item-group-inner">
                                    <div class="ninja-countdown-timer-item" id="hours">0</div>
                                </div>
                                <div class="ninja-countdown-timer-item-group-label" title="Days">Hours</div>
                            </div>
                            <div class="ninja-countdown-timer-item-group ninja-countdown-timer-item-group-days">
                                <div class="ninja-countdown-timer-item-group-inner">
                                    <div class="ninja-countdown-timer-item" id="minutes">0</div>
                                </div>
                                <div class="ninja-countdown-timer-item-group-label" title="Days">Minutes</div>
                            </div>
                            <div class="ninja-countdown-timer-item-group ninja-countdown-timer-item-group-days">
                                <div class="ninja-countdown-timer-item-group-inner">
                                    <div class="ninja-countdown-timer-item" id="seconds">0</div>
                                </div>
                                <div class="ninja-countdown-timer-item-group-label" title="Days">Seconds</div>
                            </div>
                        </div>
                    </div>
                    <?php if( $button['show_button'] === 'true' ) {?>
                        <div class="ninja-countdown-timer-button-container">
                            <a class="ninja-countdown-timer-button" href="<?php echo esc_url($button['button_link']); ?>" target="<?php echo $button['new_tab'] === 'true' ? '_blank' : '' ?>">
                                <?php echo esc_html($button['button_text']); ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
                <div class="ninja-countdown-timer-bar-close" id="close_ninja_timer"></div>
            </div>
        </div>
    </div>
</div>
