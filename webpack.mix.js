let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

// Project Dependencies
mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.js('resources/assets/js/themes/now-ui-kit/now-ui-kit.js', 'public/js')
   .combine(['resources/assets/js/themes/now-ui-kit/plugins/*'], 'public/js/combined.js')
   .copyDirectory('resources/assets/img/themes/now-ui-kit', 'public/img')
   .copyDirectory('resources/assets/fonts/themes/now-ui-kit', 'public/fonts/themes/now-ui-kit')
   .sass('resources/assets/sass/themes/now-ui-kit/now-ui-kit.scss','public/css');
