$(document).ready(function() {
    // Datepicker
    $('#md_from_date').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        yearRange: '2012:2050:'

    });
    
    // Datepicker
    $('#md_to_date').datepicker({
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        yearRange: '2012:2050:'
    });
});