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

            'test_route' => 'testRoute',

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

}
