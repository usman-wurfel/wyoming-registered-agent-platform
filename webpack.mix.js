const mix = require('laravel-mix');

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
 mix.js('public/new_theme/assets/js/functions.js', 'public/js')
 .js('public/new_theme/assets/js/ityped.js', 'public/js')
 .copy('public/new_theme/assets/css/style.css', 'public/css')
 .version();