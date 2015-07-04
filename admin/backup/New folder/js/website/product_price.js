jQuery(document).ready(function($) {

	$(window).load(function() {
		$('.product_list').each(function() {
			var cost_price = $(this).find('.cost_price').val();
			var product_margin = $(this).find('.product_margin').val();
			var sell_price = parseFloat(cost_price) / (1 - (parseFloat(product_margin) / 100));
			if (isNaN(sell_price)) {
				sell_price = 0;
			}
			$(this).find('.sell_price').html(parseFloat(sell_price).toFixed(2));
		});
	});

	$('.category_margin').click(function() {
		var cat_id = $(this).data('catid');
		var cat_margin = $('input[name=category_margin_' + cat_id + ']').val();
		var b_id = $('input[name=branch_id]').val();

		$("#warning-message").dialog({
			resizable: false,
			height: 180,
			modal: true,
			buttons: {
				"Yes": function() {
					$.post('catalog/price/updatecategorymargin', {category_margin: cat_margin, category_id: cat_id, branch_id: b_id}, function(data) {
						if (data.status == 1) {
							window.location.href = 'catalog/price/index/' + b_id;
						}
					}, 'json');
				},
				Cancel: function() {
					$(this).dialog("close");
				}
			}
		});

	});

	$('.cost_price').bind('change', function() {
		var parent = $(this).parents('.product_list');
		var cost_price = $(this).val();
		var product_margin = parent.find('.product_margin').val();
		var sell_price = parseFloat(cost_price) / (1 - (parseFloat(product_margin) / 100));
		if (isNaN(sell_price)) {
			sell_price = 0;
		}
		parent.find('.sell_price').html(parseFloat(sell_price).toFixed(2));
	});

	$('.product_margin').bind('change', function() {
		var parent = $(this).parents('.product_list');
		var cost_price = parent.find('.cost_price').val();
		var product_margin = $(this).val();
		var sell_price = parseFloat(cost_price) / (1 - (parseFloat(product_margin) / 100));
		if (isNaN(sell_price)) {
			sell_price = 0;
		}
		parent.find('.sell_price').html(parseFloat(sell_price).toFixed(2));
	});
});
