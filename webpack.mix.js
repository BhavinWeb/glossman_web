const mix = require('laravel-mix');
require('laravel-mix-purgecss');

// ## admin Panel 
// CSS 
mix.combine([
    'public/backend/dist/css/adminlte-variable.min.css',
    'public/backend/plugins/toastr/toastr.min.css',
    'public/backend/plugins/flagicon/dist/css/flag-icon.min.css',
    'public/backend/plugins/flagicon/dist/css/bootstrap-iconpicker.min.css',
    'public/backend/css/google-font.css',
],
    'public/backend/css/vendor.min.css'
).purgeCss({ enabled: true, }).version();

mix.combine(['public/backend/css/zakirsoft.css'], 'public/backend/css/app.min.css').version();


// JS 
mix.combine([
    'public/backend/plugins/jquery/jquery.min.js',
    'public/backend/plugins/bootstrap/js/bootstrap.bundle.min.js',
    'public/backend/plugins/toastr/toastr.min.js',
    'public/backend/dist/js/adminlte.min.js',
], 'public/backend/js/vendor.min.js').version();


// ## Frontend 
// CSS 
mix.combine([
    'public/frontend/css/bootstrap.css',
    'public/frontend/plugins/aos/aos.min.css',
    'public/frontend/plugins/fancybox/jquery.fancybox.min.css',
    'public/frontend/plugins/nice-select/nice-select.min.css',
    'public/frontend/plugins/slick/slick.css',
    'public/frontend/plugins/toastr/toastr.min.css',
],
    'public/frontend/vendor.min.css'
).purgeCss({ enabled: true, }).version();

mix.combine([
    'public/frontend/css/main.css',
    'public/frontend/css/zakirsoft.css',
],
    'public/frontend/app.min.css'
).purgeCss({ enabled: true, }).version();


// JS 
mix.combine([
    'public/frontend/js/clicon.min.js',
    'public/frontend/plugins/nice-select/jquery.nice-select.min.js',
    'public/frontend/plugins/aos/aos.min.js',
    'public/frontend/plugins/counter-up/jquery.counterup.min.js',
    'public/frontend/plugins/counter-up/waypoints.min.js',
    'public/frontend/plugins/slick/slick.min.js',
    'public/frontend/plugins/countdown/jquery.countdown.min.js',
    'public/frontend/js/sweetalert2.js',
    'public/frontend/plugins/toastr/toastr.min.js',
    'public/backend/plugins/axios/axios.min.js',
], 'public/frontend/vendor.min.js').version();

mix.combine([
    'public/frontend/js/custom.js',
    'public/frontend/js/menu.js',
    'public/frontend/js/zakirsoft.js',
], 'public/frontend/app.min.js').version();

