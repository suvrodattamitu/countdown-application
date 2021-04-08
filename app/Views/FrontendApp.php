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

        $configs = get_option('ninja_countdown_configs',array());
        $configs = (new Countdown)->formatConfigs($configs);

        $css = self::generateCSS( $configs );

		add_action( 'wp_head', function () use ( $css ) {
			echo $css;
		} );
        
        return static::getCountdownTimerHTML($configs);
    }

    public static function getCountdownTimerHTML($data)
    {
        View::render('Frontend.CountdownTimer',$data);
    }

    public static function generateCSS($configs)
    {
        $prefix = '.ninja-countdown-timer-1';
        ob_start();
		?>

        <style type="text/css">
       
            <?php echo $prefix; ?> {
                background-color: <?php echo $configs['styles']['background_color']; ?>;
                <?php echo $configs['styles']['position']; ?>:0px;
            }
            <?php echo $prefix; ?> .ninja-countdown-timer-header-title-text{
                color: <?php echo $configs['styles']['message_color']?>;
            }
            <?php echo $prefix; ?> .ninja-countdown-timer-button{
                background-color: <?php echo $configs['styles']['button_color']; ?>
                color: <?php echo $configs['styles']['button_text_color']; ?>
            }
            <?php echo $prefix; ?> .ninja-countdown-timer-item{
                color: <?php echo $configs['styles']['timer_color']; ?>
            }

        </style>

		<?php
		return ob_get_clean();           
    }
}
