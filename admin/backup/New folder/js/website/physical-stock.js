jQuery(document).ready(function($) {
	function calcTotal() {
		$('.actual_stock').each(function() {
			var pid = $(this).data('pid');
			var system_stock = $('#system_stock_' + pid).val();
			var actual_stock = $('#actual_stock_' + pid).val();
			var price = $('#cost_price_' + pid).html();
			var stock_difference = system_stock - actual_stock;
			var stock_value = (stock_difference * price);
			$('#stock_difference_' + pid).val(stock_difference.toFixed(2));
			$('#stock_difference_' + pid).parent('td').children('span').html(stock_difference.toFixed(2));
			$('#stock_value_' + pid).val(stock_value.toFixed(2));
			$('#stock_value_' + pid).parent('td').children('span').html(stock_value.toFixed(2));
		});
	}
	$('.actual_stock').change(function() {
		calcTotal();
	});
	calcTotal();
});
