<?php
/**
 * Plugin Name: Ninja Countdown
 * Plugin URI: https://wordpress.org/plugins/ninja-countdown
 * Description: Ninja Countdown - is an fastest and easiest alternative to add business countdown functionalities on your website.
 * Author: Light Plugins
 * Author URI: https://profiles.wordpress.org/lovelightplugins
 * License: GPLv2 or later
 * Version: 1.3.0
 * Text Domain: ninjacountdown
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!defined('NINJACOUNTDOWN_VERSION')) {
    define('NINJACOUNTDOWN_VERSION', '1.3.0');
    define('NINJACOUNTDOWN_DB_VERSION', 216);
    define('NINJACOUNTDOWN_MAIN_FILE', __FILE__);
    define('NINJACOUNTDOWN_BASENAME', plugin_basename(__FILE__));
    define('NINJACOUNTDOWN_URL', plugin_dir_url(__FILE__));
    define('NINJACOUNTDOWN_DIR', plugin_dir_path(__FILE__));

    class NinjaCountdown
    {
        public function boot()
        {
            add_action('save_post', function ($postId, $post) {
                if(has_shortcode($post->post_content, 'ninja_countdown_layout')) {
                    update_post_meta($postId, '_has_countdown_shortcode', true);
                } 
                else {
                    update_post_meta($postId, '_has_countdown_shortcode', false);
                }
            }, 10, 2);

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
            $ajaxHandler = new \NinjaCountdown\Route\CountdownHandler();
            $ajaxHandler->registerEndpoints();

            add_action('ninjacountdown/render_admin_app', function () {
                $adminApp = new \NinjaCountdown\Views\AdminApp();
                $adminApp->bootView();
            });

            //delete cache when data is updated
            add_action('ninja_countdown_meta_updated', array('\NinjaCountdown\Route\CountdownHandler', 'deleteCache'));

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
            if (defined('ELEMENTOR_VERSION')) {
                new \NinjaCountdown\Widgets\ElementorHelper();
            }
            add_action('wp_enqueue_scripts', array($this, 'loadScripts'));
            add_shortcode('ninja_countdown_layout', function ($args) {
                $args = shortcode_atts(array(
                    'id' => '',
                ), $args);

                if (!$args['id']) {
                    return;
                }

                $builder = new \NinjaCountdown\Views\FrontendApp();
                return $builder->renderCountdown($args['id']);
            });
        }

        public function loadScripts()
        {
            wp_register_style('ninjacountdown', NINJACOUNTDOWN_URL . 'public/css/countdown.css', array(), NINJACOUNTDOWN_VERSION);
            wp_register_script('countdown_manager', NINJACOUNTDOWN_URL . 'public/js/countdown_manager.js', array( 'jquery' ), NINJACOUNTDOWN_VERSION, true);
            
            global $post;
            
            if( is_a( $post, 'WP_Post' ) && get_post_meta( $post->ID, '_has_countdown_shortcode', true) ) {
                wp_enqueue_style('ninjacountdown');
                wp_enqueue_script('countdown_manager');
            }
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