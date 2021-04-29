<?php

namespace NinjaCountdown\Model;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Base Model Class
 * @since 1.0.0
 */
class Countdown
{
    public function formatConfigs($configs = array())
    {
        $dateTime = current_datetime();

        //end date
        $period = isset($configs['timer']['time_period']) ? $configs['timer']['time_period'] : 1;
        $unit   = isset($configs['timer']['time_unit']) ? $configs['timer']['time_unit'] : 'days';

        $periods = [
            'days'      => $period*60 * 60 * 24 ,
            'hours'     => $period * 60 * 60,
            'minutes'   => $period * 60
        ];

        $endTime = time() + $periods[$unit];

        return array(
            'timer' => array(
                'time_period'   => isset($configs['timer']['time_period']) ? $configs['timer']['time_period'] : 1,
                'time_unit'     => isset($configs['timer']['time_unit']) ? $configs['timer']['time_unit'] : 'days',
                'message'       => isset($configs['timer']['message']) ? $configs['timer']['message'] : 'Get 50% off before it\'s too late ⏳',
                'currentdatetime'   => isset($configs['timer']['currentdatetime']) ? $configs['timer']['currentdatetime'] : time(),
                'enddatetime'       => isset($configs['timer']['enddatetime']) ? $configs['timer']['enddatetime'] : $endTime*1000,
                'saved'             => isset($configs['timer']['saved']) ? 'yes' : 'no'
            ),

            'button'    => array(
                'show_button'    => isset($configs['button']['show_button']) ? $configs['button']['show_button'] : 'true',
                'button_link'    => isset($configs['button']['button_link']) ? $configs['button']['button_link'] : '',
                'button_text'    => isset($configs['button']['button_text']) ? $configs['button']['button_text'] : 'Shop Now',
                'new_tab'        => isset($configs['button']['new_tab']) ? $configs['button']['new_tab'] : 'true'
            ),

            'styles' => array(
                'position'          => isset($configs['styles']['position']) ? $configs['styles']['position'] : 'top',
                'timer_color'       => isset($configs['styles']['timer_color']) ? $configs['styles']['timer_color'] : '#fff',
                'button_color'      => isset($configs['styles']['button_color']) ? $configs['styles']['button_color'] : '#4cca23',
                'background_color'  => isset($configs['styles']['background_color']) ? $configs['styles']['background_color'] : '#4c1fab',
                'message_color'     => isset($configs['styles']['message_color']) ? $configs['styles']['message_color'] : '#fff',
                'button_text_color' => isset($configs['styles']['button_text_color']) ? $configs['styles']['button_text_color'] : '#fff',
                'animation'         => isset($configs['styles']['animation']) ? $configs['styles']['animation'] : 'flip'
            )
        );        
    }
}