<?php

class FiltreView
{
	/**
	 * Données
	 * @var Filtre
	 */
	private $filtre = null;
	
	public function __construct(Filtre $filtre) {
		$this->filtre = $filtre;
	}
	
	public function getForm() {
		$form = '<form method="post" action="#">';
		
		$form .= '<input type="hidden" value="add_form_filter_query" />';
		
		if ($this->filtre->hasFields()) {
			$fields = $this->filtre->getFields();
			
			foreach ($fields as $field) {
				$form .= $field->getValueHtml();
				$form .= "<br />";
			}
		}
		
		$form .= '<input type="submit" value="Filtrer" />';
		
		$form .= '</form>';
		
		return $form;
	}
}