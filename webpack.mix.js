let mix = require('laravel-mix');

mix.setPublicPath('public');

mix.setResourceRoot('../');

mix.js('src/Boot.js', 'public/js/ninjacountdown-boot.js')
   .js('src/main.js', 'public/js/ninjacountdown-admin.js').vue()
   .sass('src/scss/common/countdown.scss', 'public/css/countdown.css')
   .sass('src/scss/admin/app.scss', 'public/css/ninjacountdown-admin.css')
   .copy('src/images', 'public/images')
   .copy('src/countdown_manager.js', 'public/js/countdown_manager.js')
   .copy('src/countdown_widget.js', 'public/js/countdown_widget.js');