let mix = require('laravel-mix');

mix.webpackConfig({
    output: {
        chunkFilename: `js/base/chunk/chunk[name].${ mix.inProduction() ? '[chunkhash].' : '' }js${ mix.inProduction() ? '' : '?[chunkhash]' }`
    }
});

/* js */
mix.js('resources/assets/base/js/app.js', 'public/js/base');
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
mix.sass('resources/assets/base/sass/app.scss', 'public/css/base').options({
    processCssUrls: true
});
mix.copyDirectory('node_modules/iview/dist/styles/', 'public/css/base');

/* images */
mix.copyDirectory('resources/assets/base/images', 'public/images/base');