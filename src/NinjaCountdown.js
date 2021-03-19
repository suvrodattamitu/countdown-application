export default class NinjaCountdown {

    $adminGet(options) {
        options.action = 'ninja_countdown_admin_ajax';
        return window.jQuery.get(window.NinjaCountdownAdmin.ajaxurl, options);
    }

    $adminPost(options) {
        options.action = 'ninja_countdown_admin_ajax';
        return window.jQuery.post(window.NinjaCountdownAdmin.ajaxurl, options);
    }

}