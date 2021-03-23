<?php

namespace NinjaCountdown\Route;

if (!defined('ABSPATH')) {
    exit;
}

class AdminAjaxHandler
{
    /**
     *
     * Register end points
     *
     * @since 1.0.0
     *
     **/
    public function registerEndpoints()
    {
        add_action('wp_ajax_ninja_countdown_admin_ajax', array($this, 'handeEndPoint'));

    }

    /**
     *
     * validate route
     *
     * @return method name
     * @since 1.0.0
     *
     **/
    public function handeEndPoint()
    {
        $route = sanitize_text_field($_REQUEST['route']);
        $validRoutes = array(

            'get_configs' => 'getConfigs',

        );

        if (isset($validRoutes[$route])) {
            do_action('ninjacountdown/doing_ajax_action_' . $route);
            return $this->{$validRoutes[$route]}();
        }
        do_action('ninjacountdown/admin_ajax_handler_catch', $route);
    }

    public function testRoute() 
    {

        wp_send_json_success([
            'message'   => 'success',
            'platforms' => $platforms
        ]);

    }

    public function getConfigs() 
    {

        $dateTime = current_datetime();
        $localtime = $dateTime->getTimestamp() + $dateTime->getOffset();
        $currentTime = gmdate('Y-m-d H:i:s', $localtime);

        $config = array(

            'timer' => array(
                'time_period'   => 1,
                'time_unit'     => 'days',
                'message'       => 'Get 50% off before it\'s too late ⏳',
                'currentdatetime'   => $currentTime
            ),

            'button'    => array(
                'show_button'    => 'true',
                'button_link'    => '',
                'button_text'    => 'Shop Now',
                'new_tab'        => 'true'
            ),

            'styles' => array(
                'position'          => 'top',
                'timer_color'       => '',
                'button_color'      => '',
                'background_color'  => '',
                'message_color'     => '',
                'animation'         => 'flip'
            ),

        );

        wp_send_json_success([
            'configs'   => $config
        ]);

    }

}
