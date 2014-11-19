<?php

class AdministrationController
{
	/**
	 * Nom de la requête de création
	 * @var string
	 */
	const QUERY_ADD_FILTER = "add_filter";
	const QUERY_ADD_FIELD_STEPS = "add_field_steps";
	const QUERY_ADD_FIELD_SAVE = "add_field_save";
	const QUERY_UPDATE_FILTER = "update_filter";
	const ACTION_EDIT_FILTER = 'edit';
	const ACTION_DELETE_FILTER = 'delete';
	
	/**
	 * Gestion de l'affichage des pages selon le routage sur la liste des filtres
	 */
	public function managePageList() {
		global $wpdb;
		
		$administrationView = new AdministrationView();
		
		if (isset($_POST['query'])) {
			switch ($_POST['query']) {
				// Requête de modification d'un nouveau filtre
				case self::QUERY_UPDATE_FILTER :
					$filtre = new Filtre();
					$i=0;
					
					$filtre->hydrateFromPost($_POST, true);
					
					if (isset($_SESSION['add_form_filter']['current_fields'])) {
						if (!isset($_SESSION['add_form_filter']['drag_and_drop_list_items']) || empty($_SESSION['add_form_filter']['drag_and_drop_list_items'])) {
							foreach ($_SESSION['add_form_filter']['current_fields'] as $field) {
								$field->setOrdreAffichage($i);
								
								$filtre->addField($field);
					
								$i++;
							}
						} else {
							foreach ($_SESSION['add_form_filter']['drag_and_drop_list_items'] as $key) {
								$field = $_SESSION['add_form_filter']['current_fields'][$key];
								
								if (!is_null($field)) {
									$field->setOrdreAffichage($i);
						
									$filtre->addField($field);
					
									$i++;
								}
							}
						}
					}
					
					$filtre->save();
					
					if (isset($_SESSION['add_form_filter'])) unset($_SESSION['add_form_filter']);
					
					$administrationView->displayPageList();
					break;
				case self::QUERY_ADD_FIELD_STEPS :
					$administrationView->displayFieldPage($_POST['step']);
					break;
				case AdministrationController::QUERY_ADD_FIELD_SAVE:
					$champ = new Champ();
						
					$champ->hydrateFromPost($_POST);
						
					if (!isset($_SESSION['add_form_filter']['current_fields']))
						$_SESSION['add_form_filter']['current_fields'] = array();
						
					$champ->setIdTmp(uniqid());
						
					$_SESSION['add_form_filter']['current_fields'][$champ->getIdTmp()] = $champ;
					$_SESSION['add_form_filter']['drag_and_drop_list_items'][] = $champ->getIdTmp();
					
					if (isset($_GET['id'])) {
						$filtre = new Filtre($_GET['id']);
						$administrationView->displayPageUpdate($filtre);
					}
					break;
				default :
					break;
			}
		} else if (isset($_GET['action'])) {
			switch ($_GET['action']) {
				// Requête de modification d'un filtre
				case self::ACTION_EDIT_FILTER :
					unset($_SESSION['add_form_filter']);
					
					$filtre = new Filtre($_GET['id']);
					
					if ($filtre->hasFields()) {
						$fields = $filtre->getFields();
						
						foreach ($fields as $field) {
							$_SESSION['add_form_filter']['current_fields'][$field->getId()] = $field;
							$_SESSION['add_form_filter']['drag_and_drop_list_items'][$field->getOrdreAffichage()] = $field->getId();
						}
					}
					
					$administrationView->displayPageUpdate($filtre);
					break;
					// Requête de suppression d'un filtre
				case self::ACTION_DELETE_FILTER :
					$filtre = new Filtre($_GET['id']);
					
					$filtre->delete();
					
					$administrationView->displayPageList();
					break;
				default :
					break;
			}
		} else {
			$administrationView->displayPageList();
		}
	}
	
	/**
	 * Gestion de l'affichage des pages selon le routage sur la liste de création des filtres
	 */
	public function managePageCreate() {
		global $wpdb;
		
		$administrationView = new AdministrationView();
		
		if (isset($_POST['query'])) {
			switch ($_POST['query']) {
				// Requête de création d'un nouveau filtre
				case self::QUERY_ADD_FILTER :
					$filtre = new Filtre();
					$i=0;
					
					$filtre->hydrateFromPost($_POST);
					
					if (isset($_SESSION['add_form_filter']['current_fields'])) {
						if (!isset($_SESSION['add_form_filter']['drag_and_drop_list_items']) || empty($_SESSION['add_form_filter']['drag_and_drop_list_items'])) {
							foreach ($_SESSION['add_form_filter']['current_fields'] as $field) {
								$field->setOrdreAffichage($i);
								
								$filtre->addField($field);
								
								$i++;
							}
						} else {
							foreach ($_SESSION['add_form_filter']['drag_and_drop_list_items'] as $key) {
								$field = $_SESSION['add_form_filter']['current_fields'][$key];
								
								$field->setOrdreAffichage($i); 
								
								$filtre->addField($field);
								
								$i++;
							}
						}
					}
					
					$filtre->save();
					
					if (isset($_SESSION['add_form_filter'])) unset($_SESSION['add_form_filter']);
					
					wp_redirect(admin_url('/admin.php?page=add_form_filter', 'http'), 303);
					exit;
				case self::QUERY_ADD_FIELD_STEPS :
					$administrationView->displayFieldPage($_POST['step']);
					break;
				case AdministrationController::QUERY_ADD_FIELD_SAVE:
					$champ = new Champ();
					
					$champ->hydrateFromPost($_POST);
					
					if (!isset($_SESSION['add_form_filter']['current_fields']))
						$_SESSION['add_form_filter']['current_fields'] = array();
					
					$champ->setIdTmp(uniqid());
					
					$_SESSION['add_form_filter']['current_fields'][$champ->getIdTmp()] = $champ;
					$_SESSION['add_form_filter']['drag_and_drop_list_items'][] = $champ->getIdTmp();
					
					$administrationView->displayPageCreate();
					break;
				default :
					break;
			}
		} else {
			unset($_SESSION['add_form_filter']);
			
			$administrationView->displayPageCreate();
		}
	}
	
	public function managePageAddMetaKey() {
		global $wpdb;

		$administrationView = new AdministrationView();
		
		if (isset($_POST['add_meta_key'])) {
			if (empty($_POST['name'])) throw new Exception("Name for meta_key is needed.");
			
			$wpdb->query($wpdb->prepare("INSERT INTO wp_postmeta(meta_key) VALUES(\"%s\")", str_replace(array(' ', '\'', '\\', '__'), '_', strtolower($_POST['name']))));
			
			wp_redirect(admin_url('/admin.php?page=add_form_filter_create', 'http'), 303);
			exit;
		}
		
		$administrationView->displayPageAddMetaKey();
	}
}