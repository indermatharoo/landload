$(document).ready(function() {
	$('#loading_products').hide();
	function loadProducts() {
		if ($('#category_id').val() == '') {
			return;
		}
		$('#loading_products').show();
		$('#category_id').attr('disabled', 'disabled');
		$('#product_id').attr('disabled', 'disabled');
		$('#product_holder').load(DWS_BASE_URL + 'branches/product_promotions/list_products/' + $('#category_id').val() + "/" + DWS_PRODUCT_ID, function() {
			$('#loading_products').hide();
			$('#category_id').removeAttr('disabled');
			$('#product_id').removeAttr('disabled');
		});
	}
	$('#category_id').change(function() {
		//loadProducts();
	});
	//loadProducts();

	// Datepicker
	$('#pp_from_date').datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd',
		yearRange: '2012:2050:'

	});

	// Datepicker
	$('#pp_to_date').datepicker({
		changeMonth: true,
		changeYear: true,
		dateFormat: 'yy-mm-dd',
		yearRange: '2012:2050:'
	});
});