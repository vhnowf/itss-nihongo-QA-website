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

const path = require("path");
mix.webpackConfig({
    resolve: {
        extensions: ['.js', '.json', '.vue'],
        alias: {
            '@core': path.resolve('resources/js'),
            '@admin': path.resolve('app/Modules/Admin/Resources/js'),
            '@user': path.resolve('app/Modules/User/Resources/js'),
        }
    }
});

mix.js('app/Modules/User/Resources/js/app.js', 'public/js')
    // .js('app/Modules/User/Resources/js/categories/category.js', 'public/js')
    .sass('app/Modules/User/Resources/sass/app.scss', 'public/css')
    .js('app/Modules/Admin/Resources/js/app.js', 'public/admins/js')

mix.styles([
    'public/assets/bootstrap/css/bootstrap.min.css',
    'public/assets/sweetalert2/sweetalert2.min.css',
    'public/css/core.css',
], 'public/css/frontend.min.css');

mix.scripts([
    'public/assets/bootstrap/js/bootstrap.min.js',
    'public/assets/sweetalert2/sweetalert2.min.js',
    'public/js/common.js',
    'public/js/frontend.js',
], 'public/js/frontend.min.js');

mix.styles([
    'public/assets/bootstrap/css/bootstrap.min.css',
    'public/admins/css/icons.min.css',
    'public/assets/sweetalert2/sweetalert2.min.css',
    'public/css/core.css',
    'public/assets/media/css/media.css',
    'public/admins/css/style.css'
], 'public/admins/css/admin.min.css');

mix.scripts([
    'public/js/jquery.validate.min.js',
    'public/assets/sweetalert2/sweetalert2.min.js',
    'public/js/common.js',
    'public/admins/js/admin.js',
], 'public/admins/js/admin.min.js');

if (mix.inProduction()) {
    mix.version()
}
