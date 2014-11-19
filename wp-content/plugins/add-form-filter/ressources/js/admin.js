jQuery(document).ready(function($) {
	$('.drag-and-drop').sortable({
		items: '.list_item',
		opacity: 0.6,
		cursor: 'move',
		axis: 'y',
		update: function() {
			var order = $(this).sortable('serialize') + '&action=drag_and_drop';
			
			$.post(ajaxurl, order, function(response) {
				// success
			});
		}
	});
	
	$( ".datepicker" ).datepicker({
		dateFormat: "dd/mm/yy"
	});
});