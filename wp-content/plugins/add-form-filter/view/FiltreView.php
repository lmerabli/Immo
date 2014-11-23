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
		
		$form .= '<input type="hidden" name="'.AddFormFilter::HTML_TABLE_POST_NAME.'{query]" value="1" />';
		
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