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


// Now-ui-kit Theme
mix.js('resources/assets/js/themes/now-ui-kit/now-ui-kit.js', 'public/js')
   .combine(['resources/assets/js/themes/now-ui-kit/plugins/*'], 'public/js/combined.js')
   .copyDirectory('resources/assets/img/themes/now-ui-kit', 'public/img')
   .copyDirectory('resources/assets/fonts/themes/now-ui-kit', 'public/fonts/themes/now-ui-kit')
   .sass('resources/assets/sass/themes/now-ui-kit/now-ui-kit.scss','public/css');

// Paper-dashboard Theme
mix.js('resources/assets/js/themes/paper-dashboard/paper-dashboard.js', 'public/js')
   .combine(['resources/assets/js/themes/paper-dashboard/plugins/*'], 'public/js/paper-dashboard-plugins.js')
   .copyDirectory('resources/assets/img/themes/paper-dashboard', 'public/img/themes/paper-dashboard')
   .copyDirectory('resources/assets/fonts/themes/paper-dashboard', 'public/fonts/themes/paperdashboard')
   .copy('resources/assets/sass/themes/paper-dashboard/animate.min.css', 'public/css')
   .copy('resources/assets/sass/themes/paper-dashboard/themify-icons.css', 'public/css')
   .sass('resources/assets/sass/themes/paper-dashboard/paper-dashboard.scss','public/css');
