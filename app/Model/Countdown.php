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
        $period = 1;
        $unit   = 'days';

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
                        'time_period'   => 1,
                        'time_unit'     => 'days',
                        'message'       => 'Black Friday Sale! Get 50% off!!',
                        'currentdatetime'   => time(),
                        'enddatetime'       => $endTime*1000,
                    ),
                    'button'    => array(
                        'show_button'    => 'true',
                        'button_link'    => '',
                        'button_text'    => 'Shop Now',
                        'new_tab'        => 'true'
                    ),
                    'styles' => array(
                        'position'          => 'top',
                        'timer_color'       => '#ffec00',
                        'button_color'      => '#ffec00',
                        'background_color'  => '#000000',
                        'message_color'     => '#ffec00',
                        'button_text_color' => '#000000',
                        'animation'         => 'flip'
                    )
                )
            ),

            'newyear_countdown'  => array(
                'title' => 'New Year',
                'image'      => $asset_url.'/images/countdowns/new_year.png',
                'layout_type' => 'New Year',
                
                'settings'  => array(
                    'timer' => array(
                        'time_period'   => 1,
                        'time_unit'     => 'days',
                        'message'       => 'New Year is coming!! 🎉🎉',
                        'currentdatetime'   => time(),
                        'enddatetime'       => $endTime*1000,
                    ),
                    'button'    => array(
                        'show_button'    => 'true',
                        'button_link'    => '',
                        'button_text'    => 'Shop Now',
                        'new_tab'        => 'true'
                    ),
                    'styles' => array(
                        'position'          => 'required_position',
                        'timer_color'       => '#fff',
                        'button_color'      => '#ed3247',
                        'background_color'  => '#211e54',
                        'message_color'     => '#fff',
                        'button_text_color' => '#fff',
                        'animation'         => 'flip'
                    )
                )
            ),

            'specialoffer_countdown'  => array(
                'title' => 'Special Offer',
                'image'      => $asset_url.'/images/countdowns/special_offer.png',
                'layout_type' => 'Special Offer',
                
                'settings'  => array(
                    'timer' => array(
                        'time_period'   => 1,
                        'time_unit'     => 'days',
                        'message'       => 'Get 50% off before it\'s too late ⏳',
                        'currentdatetime'   => time(),
                        'enddatetime'       => $endTime*1000,
                    ),
                    'button'    => array(
                        'show_button'    => 'true',
                        'button_link'    => '',
                        'button_text'    => 'Shop now',
                        'new_tab'        => 'true'
                    ),
                    'styles' => array(
                        'position'          => 'bottom',
                        'timer_color'       => '#fff',
                        'button_color'      => '#4cca23',
                        'background_color'  => '#4c1fab',
                        'message_color'     => '#fff',
                        'button_text_color' => '#fff',
                        'animation'         => 'flip'
                    )
                )
            )
        );         
    }
}