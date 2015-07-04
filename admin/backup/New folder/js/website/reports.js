jQuery(document).ready(function($) {

	$(".multiselect").multiselect({
		selectedList: 9999 // 0-based index
	});



	$('#from_date').datepicker({
		buttonImageOnly: true,
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd',
		yearRange: '2011:2050:'
	});

	$('#to_date').datepicker({
		buttonImageOnly: true,
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd',
		yearRange: '2011:2050:'
	});

	$('#filter_frm').on('change', 'select[name=report_date]', function() {
		if ($('select[name=report_date]').val() == 'SpecificPeriod') {
			$('.specific_date').show();
		} else {
			$('.specific_date').hide();
		}
	});
});