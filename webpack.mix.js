const mix = require('laravel-mix')


mix.js('resources/js/app.jsx', 'public/js')
    .postCss('resouces/css/app/css','public/css',[
        //
    ]);