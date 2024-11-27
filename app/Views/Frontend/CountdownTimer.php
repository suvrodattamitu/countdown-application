<div class="ninja-countdown-timer-container">
    <div class="ninja-countdown-timer">
        <div class="ninja-countdown-timer-header">
            <div class="ninja-countdown-timer-header-title-text">
                <?php echo esc_html($timer['message']); ?>
            </div>
        </div>

        <?php 
        if ($image['show_image'] === 'true' && $image['position'] === 'before_timer') {?>
            <div class="ninja-countdown-timer-img before_timer">
                <img src="<?php echo esc_html($image['url']); ?>" />
            </div>
        <?php } ?>

        <div class="ninja-countdown-timer-item-container"  id="ninja_countdown" data-position="<?php echo esc_html($styles['position']); ?>" data-enddatetime="<?php echo esc_html($timer['enddatetime']); ?>">
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

        <?php if ($image['show_image'] === 'true' && $image['position'] === 'after_timer') {?>
            <div class="ninja-countdown-timer-img after_timer">
                <img src="<?php echo esc_html($image['url']); ?>" />
            </div>
        <?php } ?>

        <?php if( $button['show_button'] === 'true' ) {?>
            <div class="ninja-countdown-timer-button-container">
                <a class="ninja-countdown-timer-button" href="<?php echo esc_url($button['button_link']); ?>" target="<?php echo $button['new_tab'] === 'true' ? '_blank' : '' ?>">
                    <?php echo esc_html($button['button_text']); ?>
                </a>
            </div>
        <?php } ?>
    </div>
    <?php if($styles['position'] !== 'required_position'): ?>
    <div class="ninja-countdown-timer-bar-close" id="close_ninja_timer"></div>
    <?php endif; ?>
</div>
