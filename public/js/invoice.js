$().ready(function() {
    // collapse messages
    $('#messages div.alert:not(.alert-danger)').delay(4000 + ($('#messages div.alert:not(.alert-danger)').length * 500)).slideUp(500);
});