$(document).ready(function() {
	$('#select_all').change(function() {
		if ($("#select_all").is(':checked')) {
			$('.branches').prop('checked', true);
		} else {
			$('.branches').prop('checked', false);
		}
	});
	
	
	function templateTrigger() {
		var $elem = $('.template_type');
		var type = $elem.data('type');
		showTemplateView($elem.val(), type);
	}
	
	$('select[name=email]').change(function() {
		templateTrigger();
	});
	
	$('select[name=sms]').change(function() {
		templateTrigger();
	});
	
	templateTrigger();
	
	function showTemplateView(template_id,type) {
		$('.template_view').attr('src', DWS_BASE_URL  + 'marketing/showTemplate/' + template_id +'/'+ type);
	}
});