(function($){
	
   $(document).ready(function(){
	$('.customaddmedia').click(function(e){
		var id = e.target.id;
		console.log(id);
		var $el=$(this).parent();
		e.preventDefault();
		console.log('je passe');
		var uploader = wp.media({
			title : "Envoyer une image",
			button : {text : " Choisir un fichier"},
			multiple : false
		}).on('select',function(){
			var selection = uploader.state().get('selection');
			var attachment = selection.first().toJSON();
			console.log(attachment);
			
			$('#input_'+id).val(attachment.url);
			$('#image_'+id).attr('src',attachment.url);
			
		})
		.open();
	})
	$('#background_color, #text_color, #background_menu,.texte_menu').click(function(e){
		var id = e.target.id;
		console.log(id);
	$(function() {
				$('.background_color, .text_color, .background_menu,.texte_menu').wpColorPicker();		
			});
   });
	
   })
})(jQuery);

