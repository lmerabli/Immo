<?php
	//function temporaire
	// add_action('admin_menu','my_pannel');

	// function my_pannel(){
	// 	add_menu_page('Mon lien', 'Mon lien', 'activate_plugins','my-panel', 'render_panel',null,81);
	// }


	// function render_panel(){
	// 	$html = '';

	// 	$html .= '	
	// 				<div>
	// 					<label from="name_link" > Nom :</label>
	// 					<input name="name_link" id="name_link" ></input>
	// 				</div>



	// 			';
	// }



	// class customWidget extends WP_Widget{

	// }


	add_action('init', 'my_custom_init');

	function my_custom_init(){
		register_post_type('projet', array(
							'label' => __('Yahourt'),
							'singular_label' => __('Yahourt'),
							'public' => true,
							'show_ui' => true,
							'capability_type' => 'post',
							'hierarchical' => false,
							'supports' => array('title','excerpt','thumbnail')
		));

	}

?>