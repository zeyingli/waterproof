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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .styles([
	   	'public/css/framework7.min.css',
	   	'public/css/style.css',
   	], 'public/css/all.css')
   .styles([
         'resources/css/landing/swiper.min.css',
         'resources/css/landing/bootstrap.min.css',
         'resources/css/landing/style.css',
         'resources/css/landing/main.css',
      ], 'public/css/landing.css')
   .styles([
         'resources/css/frontend/bootstrap.min.css',
         'resources/css/frontend/material-icons.css',
         'resources/css/frontend/swiper.min.css',
         'resources/css/frontend/style.css',
      ], 'public/css/webapp.css')
   .scripts([
         'resources/js/landing/jquery-3.2.1.min.js',
         'resources/js/landing/popper.min.js',
         'resources/js/landing/bootstrap.min.js',
         'resources/js/landing/swiper.min.js',
         'resources/js/landing/main.js',
      ], 'public/js/landing.js')
   .scripts([
   		'resources/js/framework7.min.js',
   		'resources/js/jquery-3.3.1.min.js',
   		'resources/js/jquery.sparkline.min.js',
         'resources/js/routes.js',
   		'resources/js/main.js',
   	], 'public/js/all.js')
   .scripts([
         'resources/js/frontend/jquery-3.2.1.min.js',
         'resources/js/frontend/popper.min.js',
         'resources/js/frontend/bootstrap.min.js',
         'resources/js/frontend/jquery.cookie.js',
         'resources/js/frontend/jquery.sparkline.min.js',
         'resources/js/frontend/circle-progress.min.js',
         'resources/js/frontend/swiper.min.js',
         'resources/js/frontend/main.js',
      ], 'public/js/webapp.js')
   .version();
