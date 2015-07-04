jQuery(document).ready(function($) {
	$('#date').datepicker({
		//showOn: "both",
		//buttonImage: "../images/001_44.png",
		buttonImageOnly: true,
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd',
		yearRange: '2011:2050:'
		//defaultDate: '-5y',
	});
});