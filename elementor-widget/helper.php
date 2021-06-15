<?php
namespace Elementor;   

// Create countdown timer category into elementor.
function init_countdown_category(){
    Plugin::instance()->elements_manager->add_category(
        'countdown-widget',
        [
            'title'  => 'Countdown Timer',
            'icon' => 'font'
        ],
        1
    );
}
add_action('elementor/init','Elementor\init_countdown_category');