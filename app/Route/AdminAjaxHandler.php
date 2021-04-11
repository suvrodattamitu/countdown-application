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
            'save_configs' => 'saveConfigs',
            'get_settings' => 'getSettings',
            'save_settings' => 'saveSettings',
            'clear_configs' => 'clearConfigs'

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

    public function saveConfigs() 
    {
        $configs = json_decode(wp_unslash($_REQUEST['configs']));
        $configs = json_decode(json_encode($configs), true);
        $configs = (new Countdown)->formatConfigs($configs);
        update_option('ninja_countdown_configs',$configs);
        wp_send_json_success([
            'message'   => __('Congrats, successfully saved!', 'ninjacountdown'),
            'configs'   => $configs
        ]);
    }

    public function clearConfigs()
    {
        delete_option('ninja_countdown_configs');
        wp_send_json_success([
            'message'   => __('Congrats, successfully cleared!', 'ninjacountdown')
        ]); 
    }

    public static function getSettings()
    {
        $checked_pages = get_option('ninja_countdown_checked_pages',array());

        $pages = get_pages();
        $page_list = array(array('page_id' => '-1', 'page_title' => __('All Pages', 'ninjacountdown')));
        if (!empty($pages) && !is_wp_error($pages)) {
            foreach ($pages as $page) {
                $page_list[] = array('page_id' => $page->ID . '', 'page_title' => $page->post_title ? $page->post_title : __('Untitled', 'ninjacountdown'));
            }
        }
        wp_send_json_success([
            'pages'   => $page_list,
            'checked_pages' => $checked_pages
        ]);
    }

    public function saveSettings()
    {
        $checked_pages = json_decode(wp_unslash($_REQUEST['checked_pages']));
        $checked_pages = json_decode(json_encode($checked_pages), true);
        update_option('ninja_countdown_checked_pages',$checked_pages);
        wp_send_json_success([
            'message'   => __('Congrats, successfully saved!', 'ninjacountdown'),
            'checked_pages'   => $checked_pages
        ]);
    }

}