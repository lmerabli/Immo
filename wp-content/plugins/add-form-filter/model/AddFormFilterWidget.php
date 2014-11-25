<?php

class AddFormFilterWidget extends WP_Widget
{
	public function __construct()
	{
		parent::__construct('add_form_filter_widget', 'Add Form Filter', array('description' => 'Formulaire du filtre.'));
		
		add_action( 'pre_get_posts', array($this, 'switch_output_order' ));
	}
	
	public function widget($args, $instance)
	{
		global $wpdb;
		
		$data = $wpdb->get_row($wpdb->prepare("SELECT id FROM ".AddFormFilter::DATABASE_PREFIX.AddFormFilter::TABLE_NAME_FILTER." WHERE is_actif = %d;", 1), "ARRAY_A");
		
		if ($data['id'] > 0) {
			$filtre = new Filtre($data['id']);
			$filtreView = new FiltreView($filtre);
			
			echo $filtreView->getForm();
		} else {
			echo "<p style='color: black;'>Aucun filtre n'est actif. Veuillez en activer un dans la partie administration du plugin.</p>";
		}
		
		
	}
	
	public function switch_output_order( $q ) {
		// Si on est en front et qu'il s'agit de la requête principale de la page d'archive
		if( ! is_admin() && $q->is_main_query() ) {
			if (isset($_POST['add_form_filter'])){
		    // $first_array['meta_query']=array();
				$first_array['relation'] = 'AND';
		      	$cpt=0;
				foreach( $_POST['add_form_filter']as $metakey  => $value)
		        {
					if(!empty($value)){
						if(gettype($value)=="array")
						{
							if(!empty($value[0]))
							{
								$new_array_value =array();
								foreach ($value as  $val) {
									if(!empty($val))
										$new_array_value[]=$val;
								}
								if(count($value)==2 && !empty($value[0]) && !empty($value[1]))
								{
									$first_array[$cpt]['key']= $metakey;
									$first_array[$cpt]['value']= $new_array_value;
									$first_array[$cpt]['type']  = 'numeric';
									$first_array[$cpt]['compare']='BETWEEN';
									//$q->set( 'meta_query',array($array));
								}
								else
								{
									$first_array[$cpt]['key']= $metakey;
									$first_array[$cpt]['value']= $new_array_value;
									$first_array[$cpt]['compare']='IN';
									//$q->set( 'meta_query',array($array));
								}
								$cpt++;
							}
						}
						else
						{
							$q->set( 'meta_key', '_'.$metakey);
							$q->set('meta_value',$value);
						}
					}
				}
			
				$q->set('meta_query',$first_array);
			}
		}
		
	    // On retourne la requête
	    return $q;
	}
}