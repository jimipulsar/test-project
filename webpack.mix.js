const mix = require('laravel-mix');
const tailwindcss = require('tailwindcss'); /* Add this line at the top */

mix.js('resources/js/app.js', 'public/js').sourceMaps()
    .sass('resources/sass/app.scss', 'public/css')
    .copy('node_modules/font-awesome/fonts/', 'public/fonts')
    .sass('node_modules/font-awesome/scss/font-awesome.scss', 'public/css')
    .options({
        postCss: [ tailwindcss('./tailwind.config.js') ],
    })
    .version();

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