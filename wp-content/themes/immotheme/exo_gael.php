<?php

	add_action('init', 'my_custom_init');

	function my_custom_init(){
		
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
		$cp 		= get_post_meta($post->ID,'_cp',true);
		$ville 		= get_post_meta($post->ID,'_ville',true);
		$nb_piece 	= get_post_meta($post->ID,'_nb_piece',true);
		$nb_chambre = get_post_meta($post->ID,'_nb_chambre',true);
		$type_bien 	= get_post_meta($post->ID,'_type_bien',true);
		
		$a_surface = array(	'name' => 'surface' 
							,'value' => $surface
							,'label' => 'Surface'
							,'class' => 'label_admin'
							,'br' => 1
						);
		
		echo input_txt($a_surface);
		
		$a_prix = array(	'name' => 'prix' 
							,'value' => $prix
							,'label' => 'Prix'
							,'class' => 'label_admin'
							,'br' => 1
						);
		
		echo input_txt($a_prix);
		
		$a_cp = array(	'name' => 'cp' 
						,'value' => $cp
						,'label' => 'Code postale'
						,'class' => 'label_admin'
						,'br' => 1
					);
		
		echo input_txt($a_cp);
		
		$a_ville = array(	'name' => 'ville' 
							,'value' => $ville
							,'label' => 'Ville'
							,'class' => 'label_admin'
							,'br' => 1
						);
		
		echo input_txt($a_ville);
		
		$a_piece = array(	'name' => 'nb_piece' 
							,'value' => $nb_piece
							,'label' => 'Nombre de pieces'
							,'class' => 'label_admin'
							,'br' => 1
						);
		
		echo input_txt($a_piece);
		
		$a_chambre = array(	'name' => 'nb_chambre' 
							,'value' => $nb_chambre
							,'label' => 'Nombre de chambre'
							,'class' => 'label_admin'
							,'br' => 1
						);
		
		echo input_txt($a_chambre);
		
		$a_type = array(	'name' => 'type_bien' 
							,'value' => $type_bien
							,'label' => 'Type de bien'
							,'class' => 'label_admin'
							,'br' => 1
							,'a_select' => array(	0 => '*'
												,1 => 'Maison / Villa'
												,2 => 'Boutique'
												,3 => 'Parking'
												,4 => 'Loft/Atelier/Surface'
												,5 => 'Hôtel particulier'
												,6 => 'Appartement'
												,7 => 'Local commercial'
												,8 => 'Bureau'
												,9 => 'Bâtiment'
												,10 => 'Terrain'
												,11 => 'Immeuble'
												,12 => 'Divers'
												,13 => 'Château'
											)
				);
		
		echo select_opt($a_type);		
				
	}
	
	add_action('save_post','save_metabox');
	function save_metabox($post_id){
		if(isset($_POST['surface'])){
			update_post_meta($post_id, '_surface', sanitize_text_field($_POST['surface']));
		}
		if(isset($_POST['prix'])){
			update_post_meta($post_id, '_prix', sanitize_text_field($_POST['prix']));
		}
		if(isset($_POST['cp'])){
			update_post_meta($post_id, '_cp', sanitize_text_field($_POST['cp']));
		}
		if(isset($_POST['ville'])){
			update_post_meta($post_id, '_ville', sanitize_text_field($_POST['ville']));
		}
		if(isset($_POST['nb_piece'])){
			update_post_meta($post_id, '_nb_piece', sanitize_text_field($_POST['nb_piece']));
		}
		if(isset($_POST['nb_chambre'])){
			update_post_meta($post_id, '_nb_chambre', sanitize_text_field($_POST['nb_chambre']));
		}
		if(isset($_POST['type_bien'])){
			update_post_meta($post_id, '_type_bien', sanitize_text_field($_POST['type_bien']));
		}
	}
	
	
	


?>