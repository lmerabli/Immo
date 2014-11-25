jQuery(document).ready(function($) {
	sessionStorage.item_count = 2;
	
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
	
	$("#list_add_item").click(function() {
		$('#list_items').append("<input type='text' id='item_" + sessionStorage.item_count + "' name='items[" + sessionStorage.item_count + "]' value='' /> <input type='button' name='list_delete_item_" + sessionStorage.item_count + "' id='list_delete_item_" + sessionStorage.item_count + "' value='-' />" +
			"<script>jQuery(document).ready(function($) {" +
			"$('#list_delete_item_" + sessionStorage.item_count + "').click(function() {" +
				"if ($(\"#list_items input[type=text]\").length > 1) {" +
					"$('#item_" + sessionStorage.item_count + "').remove();" +
					"$('#list_delete_item_" + sessionStorage.item_count + "').remove();" +
					"$('#br_item_" + sessionStorage.item_count + "').remove();" +
				"}" +
			"});" +
			"});</script><br id='br_item_" + sessionStorage.item_count + "' />");
		
		sessionStorage.item_count++;
	});
});