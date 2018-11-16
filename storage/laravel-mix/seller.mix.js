let mix = require('laravel-mix');

mix.webpackConfig({
    output: {
        chunkFilename: `js/seller/chunk/chunk[name].${ mix.inProduction() ? '[chunkhash].' : '' }js${ mix.inProduction() ? '' : '?[chunkhash]' }`
    }
});

/* js */
mix.js('resources/assets/seller/js/app.js', 'public/js/seller');
mix.extract([
    'axios',
    'vue',
    'vue-router',
    'iview'
]);

mix.autoload({
    vue: ['Vue']
});

if (mix.inProduction()) {
    mix.version();
}

mix.babelConfig({});


/* css */
mix.sass('resources/assets/seller/sass/app.scss', 'public/css/seller').options({
    processCssUrls: true
});
mix.copyDirectory('node_modules/iview/dist/styles/', 'public/css/seller');

/* images */
mix.copyDirectory('resources/assets/seller/images', 'public/images/seller');

mix.copyDirectory('resources/assets/seller/js/libs/ueditor', 'public/ueditor');