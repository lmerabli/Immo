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
		$form = '<form method="post" action="?s=">';
		
		$form .= '<table>';
		
		if ($this->filtre->hasFields()) {
			$fields = $this->filtre->getFields();
			
			foreach ($fields as $field) {
				$form .= $field->getValueHtml();
				$form .= "<br />";
			}
		}
		
		$form .= '<tr><td></td><td><input type="submit" value="Filtrer" /></td></tr>';
		
		$form .= '</table>';
		
		$form .= '</form>';
		
		return $form;
	}
}