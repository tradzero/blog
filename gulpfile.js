const elixir = require('laravel-elixir');

require('laravel-elixir-vue-2');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for your application as well as publishing vendor resources.
 |
 */

// elixir((mix) => {
//     mix.sass('app.scss')
//        .webpack('app.js');
// });
elixir((mix) => {
    /*admin*/
    mix.scripts([
        'resources/assets/js/admin.js'
    ], 'public/js/admin.js');
    /*
      bootstrap
    */
    mix.copy('vendor/almasaeed2010/adminlte/bootstrap/css/bootstrap.min.css',
                     'public/bootstrap/css/bootstrap.min.css');
    mix.copy('vendor/almasaeed2010/adminlte/bootstrap/js/bootstrap.min.js',
                     'public/bootstrap/js/bootstrap.min.js');

    /*
      css/js
    */
    mix.copy('vendor/almasaeed2010/adminlte/dist/css', 'public/adminlte/css');
    mix.copy('vendor/almasaeed2010/adminlte/dist/js/app.min.js', 'public/adminlte/js');
    /*
      jquery for compatibility
    */
    mix.copy('vendor/almasaeed2010/adminlte/plugins/jQuery/jquery-2.2.3.min.js',
                     'public/adminlte/jQuery/jquery-2.2.3.min.js');
});