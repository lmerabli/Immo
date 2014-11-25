<?php

class Champ {
	const TYPE_INPUT = "input";
	const TYPE_LISTE_DEROULANTE = "liste_deroulante";
	const TYPE_INTERVALLE = "intervalle";
	const TYPE_CALENDRIER = "calendrier";
	const TYPE_CHECKBOX = "checkbox";
	
	private $id = 0;
	private $idTmp = 0;
	private $type = "";
	private $idFiltre = 0;
	private $label = "";
	private $metaKey = "";
	private $ordreAffichage = 0;
	private $valueHtml = "";
	private $additionalInformations = array(
			"is_coche_defaut"	=> false,
			"checkbox_value"	=> "",
			"intervalle_min"	=> 0,
			"intervalle_max"	=> 0,
			"items"				=> array()
			);
	
	public function hydrateFromPost($post) {
		$this->type = $post['type'];
		$this->label = $post['label'];
		$this->metaKey = $post['meta_key'];
		
		switch ($post['type']) {
			case self::TYPE_CHECKBOX:
				if ($post['is_coche_defaut'] == "1") {
					$this->additionalInformations["is_coche_defaut"] = true;
				}
				
				$this->additionalInformations["checkbox_value"] = $post['checkbox_value'];
				break;
			case self::TYPE_INTERVALLE:
				$this->additionalInformations["intervalle_min"] = $post['intervalle_min'];
				$this->additionalInformations["intervalle_max"] = $post['intervalle_max'];
				break;
			case self::TYPE_LISTE_DEROULANTE:
				$this->additionalInformations["items"] = $post['items'];
				break;
			default:
				break;
		}
	}
	
	/**
	 * 
	 * @param StdClass $result
	 */
	public function hydrateFromResult($result) {
		$this->id = $result->id;
		$this->idFiltre = $result->id_filter;
		$this->label = $result->label;
		$this->metaKey = $result->meta_key;
		$this->ordreAffichage = $result->ordre_affichage;
		$this->valueHtml = $result->value_html;
	}
	
	public function constructHtml() {
		switch ($this->type) {
			case self::TYPE_INPUT:
				$this->valueHtml = '<label for="'.$this->getKey().'">'.$this->label.': </label>
									<input type="text" id="'.$this->getKey().'" name="'.AddFormFilter::HTML_TABLE_POST_NAME.'['.$this->getMetaKey().'][]" value="" />
									';
				break;
			case self::TYPE_CHECKBOX:
				$checked = "";
				
				if ($this->additionalInformations['is_coche_defaut']) $checked = "checked";
				
				$this->valueHtml = '<input type="checkbox" id="'.$this->getKey().'" name="'.AddFormFilter::HTML_TABLE_POST_NAME.'['.$this->metaKey.'][]" value="'.$this->additionalInformations["checkbox_value"].']" '.$checked.' />'.$this->label;
				break;
			case self::TYPE_CALENDRIER:
				$this->valueHtml = '<label for="'.$this->getKey().'">'.$this->label.'</label>
									<input type="text" id="'.$this->getKey().'" name="'.AddFormFilter::HTML_TABLE_POST_NAME.'['.$this->getMetaKey().'][]" class="datepicker" value="" />';
				break;
			case self::TYPE_INTERVALLE:
				$this->valueHtml = '
				<script>
					jQuery(document).ready(function($) {
						$( "#'.$this->getKey().'" ).slider({
							min: '.$this->additionalInformations["intervalle_min"].',
							max: '.$this->additionalInformations["intervalle_max"].'
						});
					});
				</script>
				
				<div id="'.$this->getKey().'">
				</div>';
				break;
			case self::TYPE_LISTE_DEROULANTE:
				$this->valueHtml .= '<label for="'.$this->getKey().'">'.$this->label.': </label>';
				
				$this->valueHtml .= '<select id ="'.$this->getKey().'" name="'.AddFormFilter::HTML_TABLE_POST_NAME.'['.$this->metaKey.'][]">';
				
				foreach ($this->additionalInformations["items"] as $item) {
					$this->valueHtml .= '<option value="'.$item.'">'.$item.'</option>';
				}
				
				$this->valueHtml .= '</select>';
				break;
			default:
				break;
		}
	}
	
	/**
	 * Pas de modifications (UPDATE) nécessaires
	 */
	public function save() {
		$this->insert();
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function getIdTmp() {
		return $this->idTmp;
	}
	
	public function getType() {
		return $this->type;
	}
	
	public function getIdFiltre() {
		return $this->idFiltre;
	}
	
	public function getLabel() {
		return $this->label;
	}
	
	public function getMetaKey() {
		return $this->metaKey;
	}
	
	public function getOrdreAffichage() {
		return $this->ordreAffichage;
	}
	
	public function getValueHtml() {
		if ($this->valueHtml == "") {
			$this->constructHtml();
		}
		
		return $this->valueHtml;
	}
	
	public function setId($id) {
		$this->id = $id;
	}
	
	public function setIdTmp($idTmp) {
		$this->idTmp = $idTmp;
	}
	
	public function setType($type) {
		$this->type = $type;
	}
	
	public function setIdFiltre($idFiltre) {
		$this->idFiltre = $idFiltre;
	}
	
	public function setLabel($label) {
		$this->label = $label;
	}
	
	public function setMetaKey($metaKey) {
		$this->metaKey = $metaKey;
	}
	
	public function setOrdreAffichage($ordreAffichage) {
		$this->ordreAffichage = $ordreAffichage;
	}
	
	public function setValueHtml($valueHtml) {
		$this->valueHtml = $valueHtml;
	}
	
	public function getKey() {
		$id = 0;
		
		if ($this->id>0)	$id = $this->id;
		else				$id = $this->idTmp;
		
		return md5('key_'.$id);
	}
	
	private function insert() {
		global $wpdb;

		if (empty($this->idFiltre))	return false;
		if (empty($this->metaKey))	return false;
		
		$wpdb->query(
				$wpdb->prepare(
						"INSERT INTO ".AddFormFilter::DATABASE_PREFIX.AddFormFilter::TABLE_NAME_FIELD."
						(	id_filter,
							label,
							meta_key,
							ordre_affichage,
							value_html
						) VALUES(
							%d,
							\"%s\",
							\"%s\",
							%d,
							\"%s\"
						);", $this->idFiltre, $this->label, $this->metaKey, $this->ordreAffichage, $this->valueHtml
				)
		);
	}
	
	private function update() {
		global $wpdb;
		
		if (empty($this->idFiltre))	return false;
		if (empty($this->metaKey))	return false;
	
		$wpdb->query(
				$wpdb->prepare(
						"UPDATE ".AddFormFilter::DATABASE_PREFIX.AddFormFilter::TABLE_NAME_FIELD."
						SET id_filter = %d,
							label = \"%s\",
							meta_key = \"%s\",
							ordre_affichage = %d,
							value_html = \"%s\"
						WHERE id = %d;"
						, $this->idFiltre, $this->label, $this->metaKey, $this->ordreAffichage, $this->valueHtml, $this->id
				)
		);
	}
}