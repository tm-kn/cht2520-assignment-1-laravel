window.moment = require('moment');
require('tempusdominus-bootstrap-4');

$(function () {
    $('.js-datetime').datetimepicker({
        format: "YYYY-MM-DD HH:mm:ss",
    });
});
