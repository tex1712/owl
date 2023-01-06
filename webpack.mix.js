const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
    // .postCss('resources/css/app.css', 'public/css', [
    //     //
    // ])
    .sass('resources/sass/app.scss', 'public/css')
    .sourceMaps()
    .combine([
        'node_modules/sweetalert2/dist/sweetalert2.min.css',
        'node_modules/@fortawesome/fontawesome-free/css/all.min.css',
    ], 'public/css/vendor.css')
    .copy('node_modules/@fortawesome/fontawesome-free/webfonts', 'public/webfonts');
