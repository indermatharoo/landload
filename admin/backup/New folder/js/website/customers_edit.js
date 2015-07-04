jQuery(document).ready(function($) {

	//CustomerEdit($('input:radio[name=guardian]:checked').val());
	//$("tr#guardian_discount").hide();
	$("input:radio[class=guardian]").click(function() {
		
		CustomEdit($(this).val())
	});
	
	function CustomEdit(val)
	{
		if (val == 1) {
			$("tr#guardian_discount").show();
		}
		else {
			$("tr#guardian_discount").hide();
		}
	}

	guardian=$('input:radio[name=guardian]:checked').val();
	if (guardian == 1) {
			
		$("tr#guardian_discount").show();
			
	}
	else {
		$("tr#guardian_discount").hide();
	}
	

});
