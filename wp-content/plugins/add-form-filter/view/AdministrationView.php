<?php

class AdministrationView
{
	private $html = "";
	
	public function addAdminMenu()
	{
		add_menu_page('Add Form Filter Plugin', 'Add Form Filter', 'manage_options', 'add_form_filter', array('AdministrationController', 'managePageList'));
		
		// Création des pages
		add_submenu_page('add_form_filter', 'Add Form Filter', 'Liste des filtres', 'manage_options', 'add_form_filter', array('AdministrationController', 'managePageList'));
		add_submenu_page('add_form_filter', 'Add Form Filter', 'Créer un filtre', 'manage_options', 'add_form_filter_create', array('AdministrationController', 'managePageCreate'));
		add_submenu_page('add_form_filter', 'Add Form Filter', 'Ajouter un post meta key', 'manage_options', 'add_form_filter_add_meta_key', array('AdministrationController', 'managePageAddMetaKey'));
	}
	
	public function getIdPageList() {
		return $this->idPageList;
	}
	
	public function getIdPageCreate() {
		return $this->idPageCreate;
	}
	
	public function displayPageList() {
		echo "<h1>".get_admin_page_title()."</h1>
		<h2>Liste des filtres</h2>";
		
		$list = new ListView();
		$list->prepare_items();
		
		echo '
		<form method="post">
    		<input type="hidden" name="page" value="ListView" />';
    		$list->search_box('Rechercher', 'search_id');
    	echo '</form>';
		
		echo '<div class="wrap">
                <div id="icon-users" class="icon32"></div>
                '.$list->display().'
            </div>';
	}
	
	public function displayPageCreate() {
		echo "
		<h1>".get_admin_page_title()."</h1>
		<h2>Créer un filtre</h2>";
		
		echo $this->getFormSettings();
	}
	
	public function displayPageUpdate($filtre) {
		echo "
		<h1>".get_admin_page_title()."</h1>
		<h2>Modifier un filtre</h2>";
		
		echo $this->getFormSettings($filtre);
	}
	
	public function displayPageAddMetaKey() {
		echo '
		<h1>'.get_admin_page_title().'</h1>
		<h2>Ajouter un post meta key</h2>
		<form method="post" action="#">
			<input type="hidden" id="add_meta_key" name="add_meta_key" value="2" />
			<label>Nom :</label><input type="text" id="name" name="name" value="" />'
			.get_submit_button('Ajouter', "primary", "submit", false).
		'</form>
		';
	}
	
	/**
	 * Affiche une des pages de création / modification d'un champ
	 * @param integer $step Correspond à l'étape 1 ou 2
	 */
	public function displayFieldPage($step) {
		global $wpdb;
		
		switch ($step) {
			case "1":
				echo "
				<h1>".get_admin_page_title()."</h1>
				<h2>Ajout d'un champ (1 / 2)</h2>";
				
				echo '<form method="post" action="#">
					<input type="hidden" id="query" name="query" value="'.AdministrationController::QUERY_ADD_FIELD_STEPS.'" />
					<input type="hidden" id="step" name="step" value="2" />
					<label>Type de champ :</label>
					<select name="type">
				    	<option value="'.Champ::TYPE_INPUT.'">Texte</option>
				    	<option value="'.Champ::TYPE_LISTE_DEROULANTE.'">Liste déroulante</option>
						<option value="'.Champ::TYPE_INTERVALLE.'">Intervalle de valeur</option>
				    	<option value="'.Champ::TYPE_CALENDRIER.'">Calendrier</option>
				    	<option value="'.Champ::TYPE_CHECKBOX.'">Zone à cocher</option>
				    </select>
					<br /><br />'
					.get_submit_button('Etape suivante >>', "primary", "submit", false)
					.'</form>';
					
				break;
			case "2":
				$metaKeys = $wpdb->get_results("SELECT * FROM `wp_postmeta`");
				
				echo '<h1>'.get_admin_page_title().'</h1>
					  <h2>Ajout d\'un champ (2 / 2)</h2>';
				
				echo '<form method="post" action="#">
					<input type="hidden" id="query" name="query" value="'.AdministrationController::QUERY_ADD_FIELD_SAVE.'" />
					<input type="hidden" id="type" name="type" value="'.$_POST['type'].'" />
					<label for="label">Label : </label><input type="texte" id="label" name="label" value="" /><br />
					<label for="label">Post meta key : </label>';
					
				echo '<select name="meta_key">';
				
				foreach ($metaKeys as $metaKey) {
					echo '<option value="'.$metaKey->meta_key.'">'.$metaKey->meta_key.'</option>';
				}
				
				echo '</select>';
				
				switch ($_POST['type']) {
					case Champ::TYPE_CHECKBOX:
						echo '
						<br />
						<label for="checkbox_value">Valeur du meta_key : </label><input type="text" id="checkbox_value" name="checkbox_value" value="" />
						<br />
						<input type="checkbox" name="is_coche_defaut" value="1">Coché par défaut dans le formulaire
						';
						break;
					case Champ::TYPE_INTERVALLE:
						echo '
						<br />
						<label for="intervalle_min">Valeur minimale : </label><input type="text" id="intervalle_min" name="intervalle_min" value="0" />
						<br />
						<label for="intervalle_max">Valeur maximale : </label><input type="text" id="intervalle_max" name="intervalle_max" value="" />
						';
						break;
					case Champ::TYPE_LISTE_DEROULANTE:
						echo '
						<br />
						<label>Entrées de la liste: </label><br />
						<div id="list_items">
							<input type="text" id="item_1" name="items[1]" value="" /> <input type="button" name="list_delete_item_1" id="list_delete_item_1" value="-" />
							<script>
								jQuery(document).ready(function($) {
									$("#list_delete_item_1").click(function() {
										if ($("#list_items input[type=text]").length > 1) {
											$(\'#item_1\').remove();
											$(\'#list_delete_item_1\').remove();
											$(\'#br_item_1\').remove();
										}
									});
								});
							</script>
							<br id="br_item_1" />
						</div>
						<p><input type="button" id="list_add_item" value="+" /></p>
						';
						break;
					default:
						break;
				}
				
				echo '<br /><br />'
					.get_submit_button('Valider', "primary", "submit", false)
					.'</form>';
					
				break;
			default:
				break;
		}
	}
	
	/**
	 * Formulaire création et modification
	 * @param Filtre $values Si renseigné, valeurs à afficher dans les champs
	 */
	private function getFormSettings($filtre = null) {
		$textButton = "Modifier";
		$query = AdministrationController::QUERY_UPDATE_FILTER;
		
		if (is_null($filtre)) {
			$filtre = new Filtre();
			$textButton = "Créer";
			$query = AdministrationController::QUERY_ADD_FILTER;
		}
		
		return $this->getFieldsTable($filtre)."<br /><br />"
		.'<form method="post" action="#">
		<input type="hidden" id="query" name="query" value="'.$query.'" />
		<input type="hidden" id="id" name="id" value="'.$filtre->getId().'" />
		<label>Nom du filtre</label> : <input type="text" name="name" id="name" value="'.$filtre->getName().'" /> '
		.get_submit_button($textButton, "primary", "submit", false)
		.'</form>';
	}
	
	private function getFieldsTable($filtre = null) {
		$html = '<form method="post">';
		
		$html.= '
		<label>Ordre des champs du formulaire :</label>
		<br />
		<table class="widefat drag-and-drop">
			<thead>
			    <tr>
			        <th>Résultat</th>
			    </tr>
			</thead>
			<tfoot>
			    <tr>
			    <th>Résultat</th>
			    </tr>
			</tfoot>
			<tbody>';
		
		if (!isset($_SESSION['add_form_filter']['current_fields']) || empty($_SESSION['add_form_filter']['current_fields'])) {
			$html .= "";
		} else {
			if (!isset($_SESSION['add_form_filter']['drag_and_drop_list_items']) || empty($_SESSION['add_form_filter']['drag_and_drop_list_items'])) {
				foreach ($_SESSION['add_form_filter']['current_fields'] as $champ) {
					if ($champ->getId() > 0) {
						$id = $champ->getId();
					} else {
						$id = $champ->getIdTmp();
					}
					
					$html .= '
					<tr id="list_items_'.$id.'" class="list_item">
					<td>'.$champ->getValueHtml().'</td> <td><input type="button" name="list_delete_item_'.$id.'" id="list_delete_item_'.$id.'" value="-" /></td>
					</tr>';
					
					$html .= '<script>
						jQuery(document).ready(function($) {
							$("#list_delete_item_'.$id.'").click(function() {
								$(\'#list_items_'.$id.'\').remove();
								
								var order = "action=delete_item_list&id='.$id.'&delete_drag_and_drop=0";
								$.post(ajaxurl, order, function(response) {
									// success
								});
							});
						});
					</script>';
				}
			} else {
				for ($i=0; $i<count($_SESSION['add_form_filter']['drag_and_drop_list_items']); $i++) {
					$key = $_SESSION['add_form_filter']['drag_and_drop_list_items'][$i];
					$champ = $_SESSION['add_form_filter']['current_fields'][$key];
						
					if ($champ->getId() > 0) {
						$id = $champ->getId();
					} else {
						$id = $champ->getIdTmp();
					}
						
					$html .= '
					<tr id="list_items_'.$id.'" class="list_item">
					<td>'.$champ->getValueHtml().'</td> <td><input type="button" name="list_delete_item_'.$id.'" id="list_delete_item_'.$id.'" value="-" /></td>
					</tr>';
					
					$html .= '<script>
						jQuery(document).ready(function($) {
							$("#list_delete_item_'.$id.'").click(function() {
								$(\'#list_items_'.$id.'\').remove();
								
								var order = "action=delete_item_list&id='.$id.'&delete_drag_and_drop=1";
								$.post(ajaxurl, order, function(response) {
									// success
								});
							});
						});
					</script>';
				}
			}
		}
			   
		$html .= '
			</tbody>
		</table>';
		
		$html .= '
		<input type="hidden" id="query" name="query" value="'.AdministrationController::QUERY_ADD_FIELD_STEPS.'" />
		<input type="hidden" id="step" name="step" value="1" />'
		.get_submit_button('Ajouter un champ', "primary", "submit", false)
		.'</form>';
			   
	   return $html;
	}
}