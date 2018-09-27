let mix = require('laravel-mix');
let path = require('path');

mix.webpackConfig({
    resolve: {
        alias: {
            '@': path.resolve(__dirname, 'resources', 'assets')
        }
    }
});

require(`${__dirname}/storage/laravel-mix/${process.env.section}.mix.js`);