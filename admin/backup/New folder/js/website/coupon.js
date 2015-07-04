$(document).ready(function() {
    console.log('here');
//    var v = $('#act_from').val();
//    alert(v);
    // Datepicker
    $('#active_from').datepicker({
        //showOn: "both",
        //buttonImage: "images/001_44.png",
        //buttonImageOnly: true,
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        yearRange: '2012:2050:'

    });
    
    // Datepicker
    $('#active_to').datepicker({
        //showOn: "both",
        //buttonImage: "images/001_44.png",
        //buttonImageOnly: true,
        changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm-dd',
        yearRange: '2012:2050:'
    });
});