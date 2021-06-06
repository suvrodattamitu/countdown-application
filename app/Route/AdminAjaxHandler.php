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
            'clear_configs' => 'clearConfigs',

            //new app 
            'update_countdown_title' => 'updateCountdownTitle',

            //predefined meta
            'get_predefined_template' => 'all',

            //countdown meta
            'create_countdown_meta'   => 'createCountdownMeta',
            'get_countdown_meta'     => 'getCountdownMeta',
            'update_countdown_meta'  => 'updateCountdownMeta',

            //all countdowns
            'get_all_countdowns' => 'getallCountdowns',
            'delete_countdown'   => 'deleteCountdown',
            'duplicate_countdown'=> 'duplicateCountdown',

        );

        if (isset($validRoutes[$route])) {
            do_action('ninjacountdown/doing_ajax_action_' . $route);
            return $this->{$validRoutes[$route]}();
        }
        do_action('ninjacountdown/admin_ajax_handler_catch', $route);
    }

    //new app start
    public function updateCountdownTitle()
    {
        $countdownId = intval($_REQUEST['countdown_id']);
        $countdownTitle = sanitize_text_field($_REQUEST['countdown_title']);
        $data = array(
            'ID' => $countdownId,
            'post_title' => $countdownTitle
        );
        wp_update_post($data);
        wp_send_json_success(array(
            'message' => __(' Title successfully updated', 'fizzycountdowns')
        ), 200);
    }

    public function getallCountdowns()
    {
        $perPage = intval($_REQUEST['per_page']);
        $pageNumber = intval($_REQUEST['page_number']);
        $searchString = sanitize_text_field($_REQUEST['search_string']);
        $OFFSET = ($pageNumber-1)*$perPage;

        $postType = 'ninja_countdown';
        $postStatus = 'publish';

        global $wpdb;
        $table_name = $wpdb->prefix . "posts";

        $totalCountdowns = count($wpdb->get_results("SELECT * FROM $table_name WHERE post_type='$postType' AND post_status='$postStatus' AND ( post_title LIKE '%$searchString%' OR post_content LIKE '%$searchString%' )"));
        $allCountdowns = $wpdb->get_results("SELECT * FROM $table_name WHERE post_type='$postType' AND post_status='$postStatus' AND ( post_title LIKE '%$searchString%' OR post_content LIKE '%$searchString%' )  ORDER BY ID DESC LIMIT $perPage OFFSET $OFFSET ");

        wp_send_json_success([
            'allCountdowns'  => $allCountdowns,
            'total'     => $totalCountdowns
        ], 200);
    }

    public function deleteCountdown()
    {
        $countdownId = intval($_REQUEST['countdown_id']);
        wp_delete_post($countdownId, true);
        delete_post_meta($countdownId, '_ninja_countdown_configs', true);
        delete_post_meta($countdownId, '_ninja_countdown_html', true);
        wp_send_json_success([
            'message' => __('Countdown deleted successfully', 'fizzycountdowns'),
        ], 200);
    }

    public function duplicateCountdown()
    {
        $oldCountdownId = intval($_REQUEST['countdown_id']);
        $oldCountdown = get_post($oldCountdownId, 'ARRAY_A');

        $newCountdownId = wp_insert_post([
            'post_title'    => '(Duplicate) ' .$oldCountdown['post_title'],
            'post_content'  => $oldCountdown['post_content'],
            'post_type'     => 'ninja_countdown',
            'post_status'   => 'publish',
            'post_author'   => get_current_user_id()
        ]);

        $oldCountdownMeta = get_post_meta($oldCountdownId, '_ninja_countdown_configs', true);

        if ($oldCountdownMeta) {
            update_post_meta($newCountdownId, '_ninja_countdown_configs', $oldCountdownMeta);
        }

        wp_send_json_success([
            'message' => __('Countdown successfully duplicated', 'fizzycountdowns'),
            'countdown_id' => $newCountdownId
        ], 200);
    }

    public function createCountdownMeta()
    {
        $predefined = sanitize_text_field($_REQUEST['type']);
        $countdowns = (new Countdown())->predefinedCountdowns();

        if ( isset($countdowns[$predefined]) ) {
            $predefinedTemplate = $countdowns[$predefined];
            $templateData = array(
                'post_title' => $predefinedTemplate['title'],
                'post_content' => $predefinedTemplate['layout_type'],
                'post_type' => 'ninja_countdown',
                'post_status' => 'publish'
            );

            

            $templateId = wp_insert_post($templateData);
            update_post_meta($templateId, '_ninja_countdown_configs', $predefinedTemplate['settings'] );
            wp_update_post([
                'ID' => $templateId,
                'post_title' => $predefinedTemplate['title'] . ' (#' . $templateId . ')'
            ]);

            if (is_wp_error($templateId)) {
                wp_send_json_error(array(
                    'message' => $templateId->get_error_message()
                ), 423);
            }

            wp_send_json_success(array(
                'message' => __('Template Successfully created', 'fizzycountdowns'),
                'template_id' => $templateId
            ), 200);
        }

        wp_send_json_error([
            'message' => __("The selected template couldn't be found.", 'fizzycountdowns')
        ], 423);
    }

    public function getCountdownMeta()
    {
        $countdownId = intval($_REQUEST['countdown_id']);
        $countdownDetails = get_post($countdownId);
        $countdownMeta    = get_post_meta($countdownId, '_ninja_countdown_configs', true);

        wp_send_json_success([
            'message' => 'success',
            'countdown_id' => $countdownId,
            'countdown_details' => $countdownDetails,
            'countdown_meta' => $countdownMeta,
        ], 200);
    }

    public function updateCountdownMeta() 
    {
        $countdownId = intval($_REQUEST['countdown_id']);
        $countdownMeta = wp_unslash(sanitize_text_field($_REQUEST['countdown_meta']));
        $countdownMeta = json_decode($countdownMeta, true);
        update_post_meta($countdownId, '_ninja_countdown_configs', $countdownMeta);

        do_action('ninja_countdown_meta_updated', $countdownId, $countdownMeta);

        wp_send_json_success([
            'message'   => __('Congrats, successfully saved!', 'fizzycountdowns'),
        ], 200);
    }

    public function all()
    {
        $data = array();
        $predefinedCountdowns = (new Countdown())->predefinedCountdowns();
        foreach ($predefinedCountdowns as $key => $item) {
            $data[$key] = array(
                'title'      => $item['title'],
                'layout_type'=> $item['layout_type'],
                'image'      => $item['image'],
            );
        }
        wp_send_json_success([
            'templates'=>$data
        ], 200);
    }

    public static function deleteCache($countdownId) {
        delete_post_meta($countdownId, '_ninja_countdown_html', false);
        delete_post_meta($countdownId, '_ninja_countdown_css', false);
    }

    //new app end

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