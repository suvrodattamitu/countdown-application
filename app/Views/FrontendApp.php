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

        $page_id = get_the_ID();

        $checked_pages = get_option('ninja_countdown_checked_pages',array());
        
        $all_pages = in_array('-1', $checked_pages);
        $specific_page = in_array($page_id, $checked_pages);

        $showTimer = $all_pages || $specific_page;
    
        if( $showTimer ) { 
            $configs = get_option('ninja_countdown_configs',array());
            $configs = (new Countdown)->formatConfigs($configs);

            $enddatetime = ($configs['timer']['enddatetime']);
            $now = time()*1000;
            $distance = $enddatetime - $now;

            //dont load assets if the time is ended
            if( $distance> 0 ) {
                wp_enqueue_style('ninjacountdown', NINJACOUNTDOWN_URL . 'public/css/countdown.css', array(), NINJACOUNTDOWN_VERSION);
                $css = self::generateCSS( $configs );
                add_action( 'wp_head', function () use ( $css ) {
                    echo $css;
                } );

                wp_enqueue_script(
                    'countdown_manager',
                    NINJACOUNTDOWN_URL . 'public/js/countdown_manager.js',
                    array( 'jquery' ),
                    NINJACOUNTDOWN_VERSION,
                    true
                );
                
                return static::getCountdownTimerHTML($configs);
            }
        }
        return;
    }

    public static function getCountdownTimerHTML($data)
    {
        View::render('Frontend.CountdownTimer',$data);
    }

    public static function generateCSS($configs)
    {
        $prefix = '.ninja-countdown-timer-1';
		?>

        <style type="text/css">
       
            <?php echo $prefix; ?> {
                background-color: <?php echo $configs['styles']['background_color'].'!important'; ?>;
                <?php echo $configs['styles']['position']; ?>:0px;
            }
            <?php echo $prefix; ?> .ninja-countdown-timer-header-title-text{
                color: <?php echo $configs['styles']['message_color'].'!important';?>;
            }
            <?php echo $prefix; ?> .ninja-countdown-timer-button{
                background-color: <?php echo $configs['styles']['button_color'].'!important'; ?>;
                color: <?php echo $configs['styles']['button_text_color'].'!important'; ?>;
            }
            <?php echo $prefix; ?> .ninja-countdown-timer-item{
                color: <?php echo $configs['styles']['timer_color'].'!important'; ?>;
            }

        </style>

		<?php
    }
}
