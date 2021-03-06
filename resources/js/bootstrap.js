window._ = require('lodash');

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.$ = window.jQuery = require('jquery');
window.Swal = require('sweetalert2');
window.onScan = require('onscan.js');
window.chart = require('chart.js');

require('select2');
require('overlayscrollbars');
require('../../vendor/almasaeed2010/adminlte/dist/js/adminlte');
require('popper.js')
require('bootstrap');
require('datatables.net')
require('datatables.net-bs4')
require('datatables.net-responsive')
require('datatables.net-responsive-bs4')
require('bootstrap4-toggle');
require('devbridge-autocomplete');
require('bootstrap-datepicker');
window.iziToast = iziToast = require('izitoast');
window.printThis = require('print-this');
window.LStorage = window.localStorage;

iziToast.settings({
    timeout: 3000,
    resetOnHover: false,
    position: 'topRight',
    icon: 'material-icons',
    transitionIn: 'flipInX',
    transitionOut: 'flipOutX',
    onOpening: function() {
        // console.log('callback abriu!');
    },
    onClosing: function() {
        // console.log("callback fechou!");
    }
});

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });