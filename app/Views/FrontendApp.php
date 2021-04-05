<?php

namespace NinjaCountdown\Views;
use NinjaCountdown\Views\View;
use NinjaCountdown\Model\Countdown;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Public App Renderer and Handler
 * @since 1.0.0
 */
class FrontendApp
{
    public function render()
    {
        if ( is_admin() ) {
			return;
		}

        wp_enqueue_script(
			'countdown_manager',
			NINJACOUNTDOWN_URL . 'public/js/countdown_manager.js',
			array( 'jquery' ),
			NINJACOUNTDOWN_VERSION,
			true
		);

        // $css = self::generateCSS( $config, $template );

		// add_action( 'wp_head', function () use ( $css ) {
		// 	echo $css;
		// } );
        
        return static::getCountdownTimerHTML();
    }

    public static function getCountdownTimerHTML()
    {
        $data = get_option('ninja_countdown_configs',array());
        $data = (new Countdown)->formatConfigs($data);
        View::render('countdown-timer.CountdownTimer',$data);
    }
}
