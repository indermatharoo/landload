jQuery(document).ready(function($) {
	function postData(data) {
		$( "#dialog-modal" ).dialog({
			height: 140,
			modal: true
		});
		$.post('catalog/ajax/category/updateSortOrder', data, function(data) {
			$( "#dialog-modal" ).dialog('close');
            //alert(data);
		});
	}

    var options = {
		containment: 'parent',
		opacity: 0.6,
		update: function(event, ui) {
			var data = $(this).sortable('serialize');
			postData(data);
		}
	};

	$( ".dragdrop" ).sortable(options);
	//$( "#menutree ul" ).sortable(options);
	//$( "#menutree ul ul" ).sortable(options);
});