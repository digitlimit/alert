let mix = require('laravel-mix');

mix.js('resources/js/alert.js', 'js')
    .sass('resources/scss/alert.scss', 'css')
    .setPublicPath('public');

mix.minify('public/js/alert.js')
    .minify('public/css/alert.css');