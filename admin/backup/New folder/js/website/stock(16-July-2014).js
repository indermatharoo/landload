jQuery(document).ready(function($) {
	//Period changed
	$('#period').change(function() {
		$.post('stock/stockorder/total_sold', {period: $(this).val()}, function(data) {
			for (var pid in data) {
				$('#total_sold_' + pid).html(data[pid]);
				$('input[name=total_sold_' + pid + ']').val(data[pid]);
			}
		}, 'json');
	});

	$('.default_stock').bind('change', function() {
		var def_val = $(this).val();
		var par = $(this).parents('.product_list');
		$(par.find("input[type=text]:not('.default_stock')")).each(function() {
			$(this).val(def_val);
			$(this).trigger('change');
		});

		totalStock(par);
	});

	$('.product_list').each(function() {
		var $par = $(this);
		totalStock($par);
	});
	
	$('select[name=branch_id]').change(function() {
		var branch_id = $(this).val();
		window.location.href = DWS_BASE_URL + "stock/stockorder/index/" + branch_id;
	});

	function totalStock($par) {
		var total_stock = 0;
		var actual_stock = $par.find('.actual_stock').html();
		$par.find('input[name="stock[]"]').each(function() {
			total_stock += parseInt($(this).val());
		});
		$par.find('.total_stock').html(total_stock);
		var total_to_order = total_stock - actual_stock;
		$par.find('.total_to_order').html(total_to_order);
	}

	function calcTotal() {
		var total = 0;
		$('.stock_qty').each(function() {
			var pid = $(this).data('pid');
			var qty = $(this).val();
			var price = $('#cost_price_' + pid).html();
			var pack = $('#pack_size_' + pid).html();
			var cost = (qty * price);
			if (pack > 0) {
				cost = cost / pack;
			}
			$('#cost_' + pid).html(cost.toFixed(2));
			total += cost;
		});
		$('#order_total').html(total.toFixed(2));
	}
	$('.stock_qty').change(function() {
		calcTotal();
	});
	calcTotal();
});
