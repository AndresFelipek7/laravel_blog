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

mix.js('resources/assets/js/app.js', 'public/js')
   .sass('resources/assets/sass/app.scss', 'public/css');

mix.scripts([
	'node_modules/jquery/dist/jquery.min.js'
	'node_modules/bootstrap-sass/assets/javascripts/bootstrap.min.js'
	'resources/assets/js/hello.js'
] , 'public/js/all.js' , './');

mix.browserSync({
	proxy: 'blog_udemy.app'
});

