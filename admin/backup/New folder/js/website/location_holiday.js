jQuery(document).ready(function($) {
    $("#date").datepicker({
        buttonImage: "images/calendar.gif",
        buttonImageOnly: true,
        showOn: "both",
        minDate: 0,
        dateFormat: "dd/mm/yy"
    });
});