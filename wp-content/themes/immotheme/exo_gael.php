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
		/*
$labels = array(
						'name'               => _x( 'Books', 'post type general name', 'your-plugin-textdomain' ),
						'singular_name'      => _x( 'Book', 'post type singular name', 'your-plugin-textdomain' ),
						'menu_name'          => _x( 'Books', 'admin menu', 'your-plugin-textdomain' ),
						'name_admin_bar'     => _x( 'Book', 'add new on admin bar', 'your-plugin-textdomain' ),
						'add_new'            => _x( 'Add New', 'book', 'your-plugin-textdomain' ),
						'add_new_item'       => __( 'Add New Book', 'your-plugin-textdomain' ),
						'new_item'           => __( 'New Book', 'your-plugin-textdomain' ),
						'edit_item'          => __( 'Edit Book', 'your-plugin-textdomain' ),
						'view_item'          => __( 'View Book', 'your-plugin-textdomain' ),
						'all_items'          => __( 'All Books', 'your-plugin-textdomain' ),
						'search_items'       => __( 'Search Books', 'your-plugin-textdomain' ),
						'parent_item_colon'  => __( 'Parent Books:', 'your-plugin-textdomain' ),
						'not_found'          => __( 'No books found.', 'your-plugin-textdomain' ),
						'not_found_in_trash' => __( 'No books found in Trash.', 'your-plugin-textdomain' )
					);
		
		$args = array(
						'labels'             => $labels,
						'public'             => true,
						'publicly_queryable' => true,
						'show_ui'            => true,
						'show_in_menu'       => true,
						'query_var'          => true,
						'rewrite'            => array( 'slug' => 'book' ),
						'capability_type'    => 'post',
						'has_archive'        => true,
						'hierarchical'       => false,
						'menu_position'      => null,
						'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
					);
		
		
		register_post_type( 'book', $args );
*/
		
		
		
		
		
		
		
		
		
		register_post_type('immo', array(	'label' 			=> __('Immobiliers'),
											'singular_label'	=> __('Immobilier'),
											'public' 			=> true,
											'show_ui' 			=> true,
											'capability_type' 	=> 'post',
											'hierarchical' 		=> false,
											'rewrite' => array("slug" => "projects"),
											'query_var' => "projets", // This goes to the WP_Query schema
											'supports' 			=> array(	'title',
																			'editor',
																		)//ici le sujet qui m'interesse
							
											)
		);

	}




	add_action('add_meta_boxes','init_metabox');
	
	function init_metabox(){
		add_meta_box('info_bien', 'Informations sur bien', 'info_client', 'immo','normal');
	}
	
	
	function info_client($post){
		$surface    = get_post_meta($post->ID,'_surface',true);
		$prix   	= get_post_meta($post->ID,'_prix',true);
		
		echo '<label for="surface">Surface : </label>';
		echo '<input id="surface" style="width: 50px;" type="text" name="surface" value="'.$surface.'" />';
		echo '<label for="prix">Prix : </label>';
		echo '<input id="prix" type="text" name="prix" value="'.$prix.'" />';
		
		
	}
	
	add_action('save_post','save_metabox');
	function save_metabox($post_id){
		if(isset($_POST['surface'])){
			update_post_meta($post_id, '_surface', sanitize_text_field($_POST['surface']));
		}
		if(isset($_POST['prix'])){
			update_post_meta($post_id, '_prix', sanitize_text_field($_POST['prix']));
		}
	}
	
	
	
	

/*

function custom_post_type() {

	$labels = array();

	array(
		'name'                => _x( 'Post Types', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Post Type', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Post Type', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
		'all_items'           => __( 'All Items', 'text_domain' ),
		'view_item'           => __( 'View Item', 'text_domain' ),
		'add_new_item'        => __( 'Add New Item', 'text_domain' ),
		'add_new'             => __( 'Add New', 'text_domain' ),
		'edit_item'           => __( 'Edit Item', 'text_domain' ),
		'update_item'         => __( 'Update Item', 'text_domain' ),
		'search_items'        => __( 'Search Item', 'text_domain' ),
		'not_found'           => __( 'Not found', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	
	
	
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
*/

// Hook into the 'init' action
//add_action( 'init', 'custom_post_type', 0 );




?>