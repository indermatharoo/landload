jQuery(document).ready(function($) {
	function calcTotal() {
		$('#actual_stock').each(function() {
			var system_stock = $('.system_stock').html();
			var actual_stock = $('#actual_stock').val();
			var price = $('#cost_price').val();
			var stock_difference = system_stock - actual_stock;
			var stock_value = (stock_difference * price);
			$('span.stock_difference').html(stock_difference.toFixed(2));
			$('span.stock_value').html(stock_value.toFixed(2));
		});
	}
	$('#actual_stock').change(function() {
		calcTotal();
	});
	calcTotal();
});
