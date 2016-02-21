var elixir = require('laravel-elixir');

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
elixir.config.sourcemaps = false;

elixir(function(mix) {

    // process stylesheets
    mix.sass('app.scss','resources/assets/css/app.css')
    	.styles(['resources/assets/css/animate.css','resources/assets/css/app.css'])
    	.version('public/css/all.css');

    // process vendor libraries (javascript)
    mix.browserify('vendor.js');

    // process application javascript
    mix.scripts([
        'transitions/**/*.js',
        'components/**/*.js',
        'app.js'
    ], 'public/js/app.js');
    
});
