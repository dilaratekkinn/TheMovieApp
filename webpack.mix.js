const mix = require('laravel-mix');
require('laravel-mix-purgecss');

/**
 * JS- APP
 */
mix.postCss('resources/css/app.css','public/css',[
        require('tailwindcss')
    ])
    .purgeCss();

if (mix.inProduction()) {
    mix.version();
}
