let mix = require('laravel-mix');

mix.autoload({
    'socket.io-client': ['io', 'window.io'],
    'axios': ['axios', 'window.axios']
});


mix.js('resources/assets/js/app.js', 'public/js')
    .extract([
        'vue', 'lodash', 'axios', 'jquery', 'laravel-echo', 'socket.io-client', 'artyom.js'
    ], 'public/js/vendors.js')
    .sass('resources/assets/sass/app.scss', 'public/css');
