<?php

class AddFormFilterWidget extends WP_Widget
{
	public function __construct()
	{
		parent::__construct('add_form_filter_widget', 'Add Form Filter', array('description' => 'Formulaire du filtre.'));
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
}