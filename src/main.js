import app from './elements'
import router from './router/routes'

app.mixin({
    
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

app.use(router).mount('#ninjacountdown-app')