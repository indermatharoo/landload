$(document).ready(function() {
    // Datepicker
    $('#order_from').datepicker({
        //showOn: "both",
        //buttonImage: "images/001_44.png",
        buttonImageOnly: true,
        changeMonth: true,
        changeYear: true,
        //dateFormat: 'yy-mm-dd',
        dateFormat: 'd MM yy',
        yearRange: '2012:2050:'

    });
	  $('#order_to').datepicker({
       // showOn: "both",
        //buttonImage: "images/001_44.png",
        buttonImageOnly: true,
        changeMonth: true,
        changeYear: true,
        //dateFormat: 'yy-mm-dd',
        dateFormat: 'd MM yy',
        yearRange: '2012:2050:'

    });
	
	  
});

/*$(document).ready(function() {
	// Datepicker
	$('#todate').datepicker({
		//showOn: "both",
		//buttonImage: "images/001_44.png",
		//buttonImageOnly: true,
		//changeMonth: true,
		changeYear: true,
		//dateFormat: 'yy-mm-dd',
        dateFormat: 'dd-mm-yy',
		yearRange: '2012:2050:'
	});
});*/
