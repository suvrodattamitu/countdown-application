<?php

namespace NinjaCountdown;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Register and initialize custom post type for Ninja Countdown
 * @since 1.0.0
 */
class PostType
{
    public static $CPTName = 'ninja_countdown';

    /**
     *
     * register custom post type using args
     * @since 1.0.0
     *
     **/
    public static function register()
    {
        $cptArgs = array(
            'capability_type' => 'post',
            'public' => false,
            'show_ui' => false,
        );
        register_post_type(self::$CPTName, $cptArgs);
    }
}

