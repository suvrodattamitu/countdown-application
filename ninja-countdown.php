<?php
/**
 * Plugin Name: Ninja Countdown
 * Plugin URI: 
 * Description: NInja Countdown - is an fastest and easiest alternative to add business countdown functionalities on your website.
 * Author: Light Plugins
 * Author URI: 
 * License: GPLv2 or later
 * Version: 1.3.1
 * Text Domain: ninjacountdown
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!defined('NINJACOUNTDOWN_VERSION')) {
    
    define('NINJACOUNTDOWN_VERSION', '1.0.0');
    define('NINJACOUNTDOWN_DB_VERSION', 120);
    define('NINJACOUNTDOWN_MAIN_FILE', __FILE__);
    define('NINJACOUNTDOWN_BASENAME', plugin_basename(__FILE__));
    define('NINJACOUNTDOWN_URL', plugin_dir_url(__FILE__));
    define('NINJACOUNTDOWN_DIR', plugin_dir_path(__FILE__));

    class NinjaCountdown
    {
        public function boot()
        {
            $this->textDomain();
            $this->loadDependencies();

            if (is_admin()) {
                $this->adminHooks();
            }
            $this->publicHooks();
        }

        public function textDomain()
        {
            load_plugin_textdomain('ninjacountdown', false, basename(dirname(__FILE__)) . '/languages');
        }

        public function loadDependencies()
        {
            require_once(NINJACOUNTDOWN_DIR . 'app/autoload.php');
        }

        public function adminHooks()
        {
            // Register Admin menu
            $menu = new \NinjaCountdown\Menu();
            $menu->register();

            // Top Level Ajax Handlers for reviews
            $ajaxHandler = new \NinjaCountdown\Route\AdminAjaxHandler();
            $ajaxHandler->registerEndpoints();

            add_action('ninjacountdown/render_admin_app', function () {
                $adminApp = new \NinjaCountdown\Views\AdminApp();
                $adminApp->bootView();
            });

            //remove all admin notice
            add_action('admin_init', function () {
                $disablePages = [
                    'ninjacountdown',
                ];
                if (isset($_GET['page']) && in_array($_GET['page'], $disablePages)) {
                    remove_all_actions('admin_notices');
                }
            });
        }

        public function publicHooks()
        {
            add_action('wp_footer', array((new \NinjaCountdown\Views\FrontendApp()), 'render'));
        }
    }

    add_action('plugins_loaded', function () {
        (new NinjaCountdown())->boot();
    });

} else {
    add_action('admin_init', function () {
        deactivate_plugins(plugin_basename(__FILE__));
    });
}