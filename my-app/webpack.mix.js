// webpack.mix.js
const mix = require('laravel-mix')


mix.js('resources/js/app.jsx', 'public/js')
    .postCss('resouces/css/app/css','public/css',[
        //
    ]);

// const mix = require('laravel-mix');

// mix.js('src/app.js', 'dist').setPublicPath('dist');
