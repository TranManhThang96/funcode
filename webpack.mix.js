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

mix.js('resources/js/admin/app.js', 'public/js/admin')

mix.sass('resources/sass/admin/app.scss', 'public/css/admin');

// [categories]
mix.js('resources/js/admin/categories/index', 'public/js/admin/categories');
mix.js('resources/js/admin/categories/add', 'public/js/admin/categories');
mix.js('resources/js/admin/categories/edit', 'public/js/admin/categories');

// [articles]
mix.js('resources/js/admin/articles/add', 'public/js/admin/articles');
mix.js('resources/js/admin/articles/index', 'public/js/admin/articles');
mix.js('resources/js/admin/articles/tinymce', 'public/js/admin/articles');
mix.js('resources/js/admin/articles/references', 'public/js/admin/articles');
mix.js('resources/js/admin/articles/columns', 'public/js/admin/articles');
mix.sass('resources/sass/admin/articles/add.scss', 'public/css/admin/articles');
mix.sass('resources/sass/admin/articles/index.scss', 'public/css/admin/articles');

// [series]
mix.js('resources/js/admin/series/index', 'public/js/admin/series');
mix.js('resources/js/admin/series/add', 'public/js/admin/series');
mix.js('resources/js/admin/series/edit', 'public/js/admin/series');
mix.sass('resources/sass/admin/series/index.scss', 'public/css/admin/series');

// [series]
mix.js('resources/js/admin/tags/index', 'public/js/admin/tags');
mix.js('resources/js/admin/tags/add', 'public/js/admin/tags');
mix.js('resources/js/admin/tags/edit', 'public/js/admin/tags');


// ====== Web ======
mix.sass('resources/sass/web/app.scss', 'public/css/web');
// ===== END Web =====
