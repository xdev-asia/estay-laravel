const elixir = require('laravel-elixir');

require('laravel-elixir-vue');

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

elixir(function(mix){
    mix.styles([
        'public/backend/css/materialize.min.css',
        'public/backend/css/style.css',
        'public/backend/css/plugins/dropzone.min.css',
        'public/backend/css/plugins/summernote.css',
        'public/backend/css/plugins/toast.css'
    ], 'public/backend/css/booksi.css')

    .scripts([
        'public/backend/js/plugins/jquery.min.js',
        'public/backend/js/plugins/bootstrap.min.js',
        'public/backend/js/plugins/waypoints.min.js',
        'public/backend/js/plugins/counter.min.js',
        'public/backend/js/plugins/plugins.min.js',
        'public/backend/js/plugins/summernote.min.js',
        'public/backend/js/plugins/waves.min.js',
        'public/backend/js/plugins/toast.js',
        'public/backend/js/materialize.js'
    ],'public/backend/js/app.js');
});
