jQuery(document).ready(function($) {
	$('input[name=select_all]').change(function() {
		if ($(this).is(":checked")) {
			$('input.ids').attr('checked', 'checked');
		} else {
			$('input.ids').removeAttr('checked');
		}
	});

	$('#approve_all').click(function() {
		//$('#list_frm').attr('action', 'company/invoices/csv_all/' + DWS_CID);
		$('#list_frm').eq(0).submit();
	});

});
