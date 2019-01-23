window.moment = require('moment');
require('tempusdominus-bootstrap-4');

$(function () {
    $('.js-datetime').each(function () {
        var value = $(this).val().trim();
        $(this).datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            date: value ? window.moment(value) : undefined,
        });
    });
});
