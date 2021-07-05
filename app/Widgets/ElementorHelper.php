<?php

namespace NinjaCountdown\Widgets;
use Elementor\Plugin as Elementor;
use NinjaCountdown\Widgets\CountdownWidget;

if (!defined('ABSPATH')) {
    exit;
}

class ElementorHelper
{
    public function __construct()
    {
        add_action( 'elementor/widgets/widgets_registered', array($this, 'init_widgets') );
    }

    public function init_widgets()
    {
        $this->enqueueAssets();
        $widgets_manager = Elementor::instance()->widgets_manager;

        if ( file_exists( NINJACOUNTDOWN_DIR.'app/Widgets/CountdownWidget.php' ) ) {
            require_once NINJACOUNTDOWN_DIR.'app/Widgets/CountdownWidget.php';
            $widgets_manager->register_widget_type(new CountdownWidget());
        }
    }

    public function enqueueAssets()
    {
        wp_register_style('countdown_widget_manager', NINJACOUNTDOWN_URL . 'public/css/countdown.css', array(), NINJACOUNTDOWN_VERSION);
        wp_register_script('countdown_widget_manager', NINJACOUNTDOWN_URL . 'public/js/countdown_widget.js', array( 'jquery' ), NINJACOUNTDOWN_VERSION, true);
    }
}