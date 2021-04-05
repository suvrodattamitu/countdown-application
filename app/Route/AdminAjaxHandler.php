<?php

namespace NinjaCountdown\Route;
use NinjaCountdown\Model\Countdown;

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
            'update_configs' => 'updateConfigs',

        );

        if (isset($validRoutes[$route])) {
            do_action('ninjacountdown/doing_ajax_action_' . $route);
            return $this->{$validRoutes[$route]}();
        }
        do_action('ninjacountdown/admin_ajax_handler_catch', $route);
    }

    public function getConfigs() 
    {
        $data = get_option('ninja_countdown_configs',array());
        $data = (new Countdown)->formatConfigs($data);
        wp_send_json_success([
            'configs'   => $data
        ]);
    }

    public function updateConfigs() 
    {
        $configs = json_decode(wp_unslash($_REQUEST['configs']));
        $configs = json_decode(json_encode($configs), true);
        $configs = (new Countdown)->formatConfigs($configs);
        update_option('ninja_countdown_configs',$configs);
        wp_send_json_success([
            'configs'   => $configs
        ]);
    }

}