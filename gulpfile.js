var elixir = require('laravel-elixir');

require('laravel-elixir-jade');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix
        // .sass('app.scss',false, { includePaths: ['./vendor/bower_components/foundation/scss'] })

        .jade()
        // .jade({ search: 'main.jade' })
        // .jade({ scr: '/jade/partials/' })
        // .jade({ scr: '/jade/questions/' })
        // .jade({ scr: '/jade/tags/' })
        // .jade({ scr: '/jade/sites/' })
        // .jade({ scr: '/jade/auth/' })
        // .jade({ scr: '/jade/errors/' })
        // .jade({ scr: '/jade/comments/' })

        // .copy('vendor/bower_components/foundation/js','public/js')

        // .copy('vendor/bower_components/angular/angular.js','public/js')
        // .copy('vendor/bower_components/angular-foundation/mm-foundation.js','public/js')

        // .copy('vendor/bower_components/select2/dist/js','public/js/select2')
        // .copy('vendor/bower_components/select2/dist/css','public/css/select2')

        // .copy('vendor/bower_components/bootstrap-markdown/css','public/css/bootstrap-markdown')
        // .copy('vendor/bower_components/bootstrap-markdown/js','public/js/bootstrap-markdown')

        // .copy('vendor/bower_components/bootsketch/build','public')

        // .styles('select2-foundation.css','public/css/select2/foundation.css')

        // .scripts('angularBooter.js','public/js/angularBooter.js')

        // .version('css/app.css')
        ;
});
