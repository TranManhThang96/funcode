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

mix.sass('resources/sass/app.scss', 'public/css');

// [categories]
mix.js('resources/js/categories/index', 'public/js/categories');
mix.js('resources/js/categories/add', 'public/js/categories');
mix.js('resources/js/categories/edit', 'public/js/categories');

// [articles]
mix.js('resources/js/articles/add', 'public/js/articles');
mix.sass('resources/sass/articles/add.scss', 'public/css/articles');

// [series]
mix.js('resources/js/series/index', 'public/js/series');
mix.js('resources/js/series/add', 'public/js/series');
mix.js('resources/js/series/edit', 'public/js/series');

