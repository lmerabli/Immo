<?php
	//function temporaire
	require 'exo_gael.php';
	
	//script pour inclure les fichier css et js surement a completer
	function theme_name_scripts(){
		wp_enqueue_style('style_name', get_stylesheet_uri() );
		wp_enqueue_script('script_name', get_template_directory_uri() );
		

	}


/********************************************************************************/	
/******************************* TOOLS BOX **************************************/	
/********************************************************************************/	
/*
	Tableau attendu a completer si on y ajoute d'autre element
	$a_opt = array(	'name' => '' 
					,'value' => ''
					,'label' => ''
					,'class' => ''
					,'br' => ''
					,'a_select' => array(	0 => '*'
										,1 => 'tata'
										,2 => 'toto'
									)
				);
*/
	
	
	function input_txt($a_opt) {
		$html = '';
        
        if ($a_opt['label'] != 'null') {
            if (!empty($a_opt['label'])) { $sep = ' :'; } else { $sep = '  '; }
            $html.= '<label class="'.$a_opt['class'].'" for="'.$a_opt['name'].'">'.$a_opt['label'].$sep.'</label>';
        }

		$html.= '<input type="text" name="'.$a_opt['name'].'" value="'.$a_opt['value'].'" />';
        if ($a_opt['br']==1) { $html.= '<br />'; }
        
		
		return $html;
	}

	function input_pwd($a_opt) {
		$html = '';
        
        if ($a_opt['label'] != 'null') {
            if (!empty($a_opt['label'])) { $sep = ' :'; } else { $sep = '  '; }
            $html.= '<label class="'.$a_opt['class'].'" for="'.$a_opt['name'].'">'.$a_opt['label'].$sep.'</label>';
        }

		$html.= '<input type="password" name="'.$a_opt['name'].'" value="'.$a_opt['value'].'" />';
        if ($a_opt['br']==1) { $html.= '<br />'; }
        
		
		return $html;
	}


	function input_hidden($a_opt) {
		$html = '';
        
        if ($a_opt['label'] != 'null') {
            if (!empty($a_opt['label'])) { $sep = ' :'; } else { $sep = '  '; }
            $html.= '<label class="'.$a_opt['class'].'" for="'.$a_opt['name'].'">'.$a_opt['label'].$sep.'</label>';
        }

		$html.= '<input type="hidden" name="'.$a_opt['name'].'" value="'.$a_opt['value'].'" />';
        if ($a_opt['br']==1) { $html.= '<br />'; }
        
		
		return $html;
	}


    function text_area($a_opt) {
		$html = '';
		
        if ($a_opt['label'] != 'null') {
            if (!empty($a_opt['label'])) { $sep = ' :'; } else { $sep = '  '; }
            $html.= '<label class="'.$a_opt['class'].'" for="'.$a_opt['name'].'">'.$a_opt['label'].$sep.'</label>';
        }
        
		$html.= '<textarea  class="'.$a_opt['class'].'" name="'.$a_opt['name'].'" id="'.$a_opt['name'].'" >'.$a_opt['value'].'</textarea>';
		
        if ($a_opt['br']==1) { $html.= '<br />'; }
		
		return $html;
	}

	function select_opt($a_opt){
		$html = '';
        
        if ($a_opt['label'] != 'null') {
            if (!empty($a_opt['label'])) { $sep = ' :'; } else { $sep = '  '; }
            $html.= '<label class="'.$a_opt['class'].'" for="'.$a_opt['name'].'">'.$a_opt['label'].$sep.'</label>';
        }
        
        
        $html.= '<select name="'.$a_opt['name'].'" id="'.$a_opt['name'].'">';
		  	
			foreach($a_opt['a_select'] as $key=>$value){
				if($a_opt['value'] == $key){ $selected = 'selected'; }else{ $selected = ''; }
				
				$html.= '<option value="'.$key.'" '.$selected.' >'.$value.'</option>';	
			}		
		$html.= '</select>';
        
        
        
        return $html;
	}

	// Ajout de la fonction permettant de personnaliser son menu via le panel admin de Wordpress
	register_nav_menus(array( 'header' => 'Menu principal (header)'));

?>