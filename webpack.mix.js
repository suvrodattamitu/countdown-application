let mix = require('laravel-mix');

mix.setPublicPath('public');

mix.setResourceRoot('../');

mix.js('src/Boot.js', 'public/js/ninjacountdown-boot.js')
   .js('src/main.js', 'public/js/ninjacountdown-admin.js').vue()
   .js('src/countdown_manager.js', 'public/js/countdown_manager.js')
   .sass('src/scss/common/countdown.scss', 'public/css/countdown.css')
   .sass('src/scss/admin/app.scss', 'public/css/ninjacountdown-admin.css')
   .copy('src/images', 'public/images');
