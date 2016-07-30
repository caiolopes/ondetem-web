var elixir = require('laravel-elixir');

require( 'elixir-coffeeify' );

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix.sass('app.scss');
    mix.coffeeify(['app.coffee']);
    mix.copy('node_modules/font-awesome/fonts/', 'public/build/fonts/');
    mix.version(['css/app.css', 'js/app.js']);
});
