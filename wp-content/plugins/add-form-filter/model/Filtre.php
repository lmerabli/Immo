<?php

class Filtre {
	private $id = 0;
	private $name = "";
	private $isActif = false;
	private $aoFields = array();
	
	public function __construct($id = 0) {
		if ($id > 0) {
			$this->hydrateFromDatabase($id);
		}
	}
	
	/**
	 * Renvoie le HTML complet de tout le filtre et ses champs
	 * 
	 * @return string $html
	 */
	public function generateHtml() {
		$html = "";
		
		return $html;
	}
	
	/**
	 * 
	 * @param array $post
	 * @param boolean $isUpdate Vérifie si l'identifiant est fournie en cas d'update
	 */
	public function hydrateFromPost($post, $isUpdate = false) {
		$this->id = $post['id'];
		
		if ($isUpdate)	$this->checkId();
		
		$this->name = $post['name'];
	}
	
	public function save() {
		if ($this->id > 0) {
			$this->update();
		} else {
			$this->insert();
		}
	}
	
	public function delete() {
		global $wpdb;
		
		$this->checkId();
		
		$wpdb->query(
				$wpdb->prepare(
						'DELETE FROM '.AddFormFilter::DATABASE_PREFIX.AddFormFilter::TABLE_NAME_FILTER.' WHERE id=%d;'
						, $this->id
				)
		);
	}
	
	/**
	 * Ajoute un champ au filtre
	 * @param Champ $field
	 */
	public function addField($field) {
		$this->aoFields[] = $field;
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function getName() {
		return $this->name;
	}
	
	public function isActif() {
		return $this->isActif;
	}
	
	public function hasFields() {
		return count($this->aoFields);
	}
	
	/**
	 * @return array[Champ]
	 */
	public function getFields() {
		return $this->aoFields;
	}
	
	public function setId($id) {
		$this->id = $id;
	}
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function setIsActif($isActif) {
		$this->isActif = $isActif;
	}
	
	public function setFields($aoFields) {
		$this->aoFields = $aoFields;
	}
	
	/**
	 * Hydrate l'objet depuis la base de données via son ID
	 * @param integer $id
	 */
	private function hydrateFromDatabase($id) {
		global $wpdb;
	
		$data = $wpdb->get_row($wpdb->prepare("SELECT * FROM ".AddFormFilter::DATABASE_PREFIX.AddFormFilter::TABLE_NAME_FILTER." WHERE id = %d;", $id), "ARRAY_A");
	
		if (!empty($data)) {
			$this->setId($data['id']);
			$this->setName($data['name']);
			$this->setIsActif($data['is_actif']);
			
			$dataFields = $wpdb->get_results(
						$wpdb->prepare("SELECT * FROM ".AddFormFilter::DATABASE_PREFIX.AddFormFilter::TABLE_NAME_FIELD." WHERE id_filter = %d;", $this->id)
					);
			
			if (!empty($dataFields)) {
				foreach ($dataFields as $dataField) {
					$field = new Champ();
					$field->hydrateFromResult($dataField);
					$this->aoFields[$field->getOrdreAffichage()] = $field;
				}
			}
		}
	}
	
	private function insert() {
		global $wpdb;
		
		if (empty($this->name))	return false;
		
		$wpdb->query(
				$wpdb->prepare(
						"INSERT INTO ".AddFormFilter::DATABASE_PREFIX.AddFormFilter::TABLE_NAME_FILTER."(name) VALUES(\"%s\");"
						, $this->name
				)
		);
		$this->id = $wpdb->insert_id;
		
		if (count($this->aoFields) > 0) {
			foreach ($this->aoFields as $field) {
				$field->setIdFiltre($this->id);
				$field->save();
			}
		}
	}
	
	private function update() {
		global $wpdb;
		
		$this->checkId();
		
		if (empty($this->name))	return false;
		
		$wpdb->query(
				$wpdb->prepare(
						"UPDATE ".AddFormFilter::DATABASE_PREFIX.AddFormFilter::TABLE_NAME_FILTER." SET name = \"%s\" WHERE id = %d;"
						, $this->name, $this->id
				)
		);
		
		/*
		$wpdb->query(
				$wpdb->prepare(
						"DELETE FROM ".AddFormFilter::DATABASE_PREFIX.AddFormFilter::TABLE_NAME_FIELD." WHERE id_filter = %d;"
						, $this->id
				)
		);*/
		
		if (count($this->aoFields) > 0) {
			foreach ($this->aoFields as $field) {
				$field->setIdFiltre($this->id);
				$field->save();
			}
		}
	}
	
	private function checkId() {
		if ($this->id <= 0)	throw new Exception("Need ID for update or delete filter.");
	}
	
	/**
	 * Récupère tous les champs liés en base de données et alimente la collection de champs de l'objet
	 */
	private function getFieldsInDatabase() {
		
	}
}