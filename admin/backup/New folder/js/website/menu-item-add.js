jQuery(document).ready(function($) {
	$('.hide').hide();

	function initForm(val) {
		$('.hide').hide();
		$('.'+val).show();
	}

	$('#menu_item_type').change(function() {
		initForm($(this).val());
	});

	initForm($('#menu_item_type').val());
});