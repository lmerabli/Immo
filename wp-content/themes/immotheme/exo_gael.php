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





function custom_post_type() {

	$labels = array();

	// array(
	// 	'name'                => _x( 'Post Types', 'Post Type General Name', 'text_domain' ),
	// 	'singular_name'       => _x( 'Post Type', 'Post Type Singular Name', 'text_domain' ),
	// 	'menu_name'           => __( 'Post Type', 'text_domain' ),
	// 	'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
	// 	'all_items'           => __( 'All Items', 'text_domain' ),
	// 	'view_item'           => __( 'View Item', 'text_domain' ),
	// 	'add_new_item'        => __( 'Add New Item', 'text_domain' ),
	// 	'add_new'             => __( 'Add New', 'text_domain' ),
	// 	'edit_item'           => __( 'Edit Item', 'text_domain' ),
	// 	'update_item'         => __( 'Update Item', 'text_domain' ),
	// 	'search_items'        => __( 'Search Item', 'text_domain' ),
	// 	'not_found'           => __( 'Not found', 'text_domain' ),
	// 	'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	// );
	$args = array(
		'label'               => __( 'post_type', 'text_domain' ),
		'description'         => __( 'Post Type Description', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( ),
		'taxonomies'          => array( 'category', 'post_tag' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'capability_type'     => 'page',
	);
	register_post_type( 'post_type', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type', 0 );




?>