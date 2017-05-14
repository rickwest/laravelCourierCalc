const { mix } = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.scripts([
    'public/js/theme/bootstrap-checkbox-radio-switch.js',
    'public/js/theme/bootstrap-notify.js',
    'public/js/theme/bootstrap-select.js',
    'public/js/theme/chartist.min.js',
    'public/js/theme/demo.js',
    'public/js/theme/light-bootstrap-dashboard.js'
], 'public/js/all.js');

mix.styles([
    'public/css/theme/animate.min.css',
    'public/css/theme/demo.css',
    'public/css/theme/light-bootstrap-dashboard.css',
    'public/css/theme/pe-icon-7-stroke.css',
    'public/css/theme/custom.css'
], 'public/css/all.css');