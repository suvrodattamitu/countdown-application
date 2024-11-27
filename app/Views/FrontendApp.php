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
    private $countdownId = null;

    public function renderCountdown($countdownId)
    {
        if ( is_admin() ) {
			return;
		}

        $configs = get_post_meta($countdownId, '_ninja_countdown_configs', true);

        if( !$configs ) {
            return '<h4>This countdown is not available now!!</h4>';
        }

        $this->countdownId = $countdownId;

        $enddatetime = ($configs['timer']['enddatetime']);
        $now = time()*1000;
        $distance = $enddatetime - $now;

        //dont load assets if the time is ended
        if( $distance> 0 ) {
            $generatedCss = $this->generateCSS( $configs );
            
            add_action('wp_footer', function () use ($generatedCss) {
                echo "<style id='ninja_countdown_css'>". $generatedCss ."</style>";
            });
            
            return $this->getCountdownTimerHTML($configs);
        }
    }

    public function getCountdownTimerHTML($data)
    {
        $generatedHtml = '';
        // if ($generatedHtml = get_post_meta($this->countdownId, '_ninja_countdown_html', true)) {
        //     return $generatedHtml;
        // }

        ob_start();
        ?>
        <div class="nfd-container">
            <div class="nfd-row">
                <div id="ninja_countdown_timer_<?php echo $this->countdownId; ?>" class="ninja-countdown-timer-wrapper <?php echo 'timer-position-'.$data['styles']['position']; ?> <?php echo $data['styles']['position'] !== 'required_position' ? 'timer-floating-option-frontend' : ''; ?>">
                    <?php View::render('Frontend.CountdownTimer',$data); ?>
                </div>
            </div>
        </div>
        <?php
        $generatedHtml = ob_get_clean();

        update_post_meta($this->countdownId, '_ninja_countdown_html', $generatedHtml);
        return $generatedHtml;
    }

    public function generateCSS($configs)
    {
        $generatedCss = '';
        if ($generatedCss = get_post_meta($this->countdownId, '_ninja_countdown_css', true)) {
            return $generatedCss;
        }
        
        $prefix = '#ninja_countdown_timer_'.$this->countdownId;
        ob_start();
		?>

        <?php echo $prefix; ?> .ninja-countdown-timer-container{
            background-color: <?php echo $configs['styles']['background_color'].'!important'; ?>;
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

		<?php
        $generatedCss = ob_get_clean();
        $compressed = str_replace('; ', ';', str_replace(' }', '}', str_replace('{ ', '{',
            str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), "",
                preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $generatedCss)))));
        
        update_post_meta($this->countdownId, '_ninja_countdown_css', $compressed);

        return $compressed;
    }
}