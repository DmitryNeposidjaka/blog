let mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application, as well as bundling up your JS files.
 |
 */

mix.webpackConfig({
  node: {
    fs: "empty"
  },
});

mix.js('src/js/app.js', 'dist/')
  .sass('src/sass/app.scss', 'dist/');

mix.js('src/js/admin/app.js', 'dist/admin/')
  .sass('src/sass/admin/app.scss', 'dist/admin/');
