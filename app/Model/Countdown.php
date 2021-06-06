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
    public function predefinedCountdowns()
    {
        $asset_url = NINJACOUNTDOWN_URL . 'public';
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
            'blackfriday_countdown'  => array(
                'title' => 'Black Friday',
                'image'      => $asset_url.'/images/countdowns/black_friday.png',
                'layout_type' => 'Black Friday',
                
                'settings'  => array(
                    'timer' => array(
                        'time_period'   => isset($configs['timer']['time_period']) ? $configs['timer']['time_period'] : 1,
                        'time_unit'     => isset($configs['timer']['time_unit']) ? $configs['timer']['time_unit'] : 'days',
                        'message'       => isset($configs['timer']['message']) ? $configs['timer']['message'] : 'Black Friday Sale! Get 50% off!!',
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
                        'timer_color'       => isset($configs['styles']['timer_color']) ? $configs['styles']['timer_color'] : '#ffec00',
                        'button_color'      => isset($configs['styles']['button_color']) ? $configs['styles']['button_color'] : '#ffec00',
                        'background_color'  => isset($configs['styles']['background_color']) ? $configs['styles']['background_color'] : '#000000',
                        'message_color'     => isset($configs['styles']['message_color']) ? $configs['styles']['message_color'] : '#ffec00',
                        'button_text_color' => isset($configs['styles']['button_text_color']) ? $configs['styles']['button_text_color'] : '#000000',
                        'animation'         => isset($configs['styles']['animation']) ? $configs['styles']['animation'] : 'flip'
                    )
                )
            ),

            'newyear_countdown'  => array(
                'title' => 'New Year',
                'image'      => $asset_url.'/images/countdowns/new_year.png',
                'layout_type' => 'New Year',
                
                'settings'  => array(
                    'timer' => array(
                        'time_period'   => isset($configs['timer']['time_period']) ? $configs['timer']['time_period'] : 1,
                        'time_unit'     => isset($configs['timer']['time_unit']) ? $configs['timer']['time_unit'] : 'days',
                        'message'       => isset($configs['timer']['message']) ? $configs['timer']['message'] : 'New Year is coming!! 🎉🎉',
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
                        'position'          => isset($configs['styles']['position']) ? $configs['styles']['position'] : 'required_position',
                        'timer_color'       => isset($configs['styles']['timer_color']) ? $configs['styles']['timer_color'] : '#fff',
                        'button_color'      => isset($configs['styles']['button_color']) ? $configs['styles']['button_color'] : '#ed3247',
                        'background_color'  => isset($configs['styles']['background_color']) ? $configs['styles']['background_color'] : '#211e54',
                        'message_color'     => isset($configs['styles']['message_color']) ? $configs['styles']['message_color'] : '#fff',
                        'button_text_color' => isset($configs['styles']['button_text_color']) ? $configs['styles']['button_text_color'] : '#fff',
                        'animation'         => isset($configs['styles']['animation']) ? $configs['styles']['animation'] : 'flip'
                    )
                )
            ),

            'specialoffer_countdown'  => array(
                'title' => 'Special Offer',
                'image'      => $asset_url.'/images/countdowns/special_offer.png',
                'layout_type' => 'Special Offer',
                
                'settings'  => array(
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
                        'button_text'    => isset($configs['button']['button_text']) ? $configs['button']['button_text'] : 'Shop now',
                        'new_tab'        => isset($configs['button']['new_tab']) ? $configs['button']['new_tab'] : 'true'
                    ),
                    'styles' => array(
                        'position'          => isset($configs['styles']['position']) ? $configs['styles']['position'] : 'bottom',
                        'timer_color'       => isset($configs['styles']['timer_color']) ? $configs['styles']['timer_color'] : '#fff',
                        'button_color'      => isset($configs['styles']['button_color']) ? $configs['styles']['button_color'] : '#4cca23',
                        'background_color'  => isset($configs['styles']['background_color']) ? $configs['styles']['background_color'] : '#4c1fab',
                        'message_color'     => isset($configs['styles']['message_color']) ? $configs['styles']['message_color'] : '#fff',
                        'button_text_color' => isset($configs['styles']['button_text_color']) ? $configs['styles']['button_text_color'] : '#fff',
                        'animation'         => isset($configs['styles']['animation']) ? $configs['styles']['animation'] : 'flip'
                    )
                )
            )
        );         
    }
}