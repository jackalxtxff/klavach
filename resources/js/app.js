export const notyf = new Notyf({
    position: {
        x: 'right',
        y: 'top',
    },
    dismissible: true,
    duration: 5000
});

export const csrfToken = $('meta[name="csrf-token"]').attr('content');

// window.bootstrap = require('bootstrap/dist/js/bootstrap.bundle.js');
require('./bootstrap');
require('./general');
require('./admin/ajaxFilter');
