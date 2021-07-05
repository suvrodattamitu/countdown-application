import mitt from 'mitt';
window.mitt = window.mitt || new mitt()

window.NinjaCountdown.app.mixin({
    methods: {
        $adminGet(options) {
            options.action = 'ninja_countdown_admin_ajax';
            return window.jQuery.get(window.NinjaCountdownAdmin.ajaxurl, options);
        },
        $adminPost(options) {
            options.action = 'ninja_countdown_admin_ajax';
            return window.jQuery.post(window.NinjaCountdownAdmin.ajaxurl, options);
        }
    }
})

window.NinjaCountdown.app.mount('#ninjacountdown-app');