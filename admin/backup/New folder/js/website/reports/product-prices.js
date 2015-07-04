jQuery(document).ready(function($) {

	function loadCompanies(val) {
		$('.branch_changed').show();
		$('#report_filter').block({
			message: '<p>loading...</p>'
		});

		$.post('reports/ajax/companies_by_branch_for_price', {branch_id: val, company_id:DWS_COMPANY_SELECTED}, function(data) {
			$('.branch_changed').hide();
			$('#report_filter').unblock();
			$('.company_holder').html(data.message);
		}, 'json');
	}
	if($('select[name=branch_id]').val() != '') {
		loadCompanies($('select[name=branch_id]').val());
	}
	$('select[name=branch_id]').change(function() {
		loadCompanies($(this).val());
	});
});