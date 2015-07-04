jQuery(document).ready(function($) {
	$('.date').datepicker({
		showOn: 'both',
		buttonImage: DWS_BASE_URL + "images/calendar.gif",
		dateFormat: 'd MM yy'
	});

	$('input[name=select_all]').change(function() {
		if ($(this).is(":checked")) {
			$('input.ids').attr('checked', 'checked');
		} else {
			$('input.ids').removeAttr('checked');
		}
	});

	$('#export_csv_all').click(function() {
		$('#csv_frm').attr('action', 'company/invoices/csv_all/' + DWS_CID);
		$('#csv_frm').eq(0).submit();
	});

	$('#export_csv').click(function() {
		$('#list_frm').attr('action', 'company/invoices/csv');
		$('#list_frm').eq(0).submit();
	});

	$('#print_list').click(function() {
		$('#list_frm').attr('action', 'company/invoices/print_invoices');
		$('#list_frm').attr('target', '_blank');
		$('#list_frm').eq(0).submit();
	});

	$('.send_email').colorbox({
		iframe: true,
		width: "550px",
		height: "350px",
		close: ''
	});

	$('.mark_paid').colorbox({
		iframe: true,
		width: "550px",
		height: "350px",
		close: ''
	});

	$('.print_invoice_list').click(function() {
		window.print();
		return false;
	});

	$('.close_invoice_list').click(function() {
		parent.$.fn.colorbox.close();
		return false;
	});



});
