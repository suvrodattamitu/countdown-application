import app from './elements'
import router from './router/routes'

app.use(router)

app.config.globalProperties.has_pro = !!window.NinjaCountdownAdmin.pro_installed;

export default class NinjaCountdown {
    constructor() {
        this.app = app;
    }
    $adminGet(options) {
        options.action = 'ninja_countdown_admin_ajax';
        return window.jQuery.get(window.NinjaCountdownAdmin.ajaxurl, options);
    }
    $adminPost(options) {
        options.action = 'ninja_countdown_admin_ajax';
        return window.jQuery.post(window.NinjaCountdownAdmin.ajaxurl, options);
    }
}