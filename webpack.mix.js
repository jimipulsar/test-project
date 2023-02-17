const mix = require('laravel-mix');
const webpack = require('webpack');

mix.autoload({ 'jquery': ['window.$', 'window.jQuery'] });

mix.js('resources/js/app.js', 'public/js').sourceMaps()
    .copy('node_modules/font-awesome/fonts/', 'public/fonts')
    .sass('node_modules/font-awesome/scss/font-awesome.scss', 'public/css')
    .postCss('resources/css/app.css', 'public/css', [
        require('postcss-import'),
        require('tailwindcss'),
        require('autoprefixer'),
    ]).version();

mix.browserSync({
    proxy: "127.0.0.1:8000",
    files: ["public/css/*.css", "public/js/*.js", "resources/views/**/*"]
});
mix.webpackConfig({
    stats: {
        children: true,
    },
});
mix.disableNotifications();