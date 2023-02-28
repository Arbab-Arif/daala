const mix = require('laravel-mix');
require('laravel-mix-tailwind');


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

mix.babelConfig({
    plugins: ['@babel/plugin-syntax-dynamic-import'],
});

mix.js('resources/js/backend/backend.js', 'public/backend/js/backend.js')
    .webpackConfig({
        output: {
            filename: '[name].js',
            chunkFilename: 'js/[name].js',
        },
    });

mix.js('resources/js/backend/main.js', 'public/backend/js/main.js')
    .sass('resources/sass/backend/app.scss', 'public/backend/css/main.css')
    .tailwind()
    .autoload({
        'cash-dom': ['$']
    })
    .copyDirectory('resources/fonts', 'public/backend/fonts')
    .copyDirectory('resources/images', 'public/backend/images');

// mix.js('resources/js/app.js', 'public/js/app.js')
//     .webpackConfig({
//         output: {
//             filename: '[name].js',
//             chunkFilename: 'js/[name].js',
//         },
//     })
//     .sass('resources/sass/app.scss', 'public/backend/css/app.css');
