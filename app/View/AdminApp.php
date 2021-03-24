<?php

namespace NinjaCountdown\View;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Admin App Renderer and Handler
 * @since 1.0.0
 */
class AdminApp
{
    public function bootView()
    {
        echo "<style id='ninja_countdown_dynamic_style'></style> <div id='ninjacountdown-app'></div>";
    }
}
