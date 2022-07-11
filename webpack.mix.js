const mix = require('laravel-mix');

mix.js('resources/js/admin/app.js', 'public/js/admin.js')
  .js('resources/js/client/app.js', 'public/js/app.js')
  .sass('resources/sass/admin/app.scss', 'public/css/admin.css')
  .sass('resources/sass/app.scss', 'public/css/app.css');