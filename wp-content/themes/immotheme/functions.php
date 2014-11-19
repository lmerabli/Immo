<?php
	//function temporaire
	require 'exo_gael.php';
	
	//script pour inclure les fichier css et js surement a completer
	/*
function theme_name_scripts(){
		wp_enqueue_style('style_name', get_stylesheet_uri() );
		wp_enqueue_script('script_name', get_template_directory_uri() );
		

	}
*/
add_action("widgets_init", "theme_register_sidebars");


function theme_register_sidebars() {
      register_sidebar(array(
                      'before_widget' => '<div id="%1$s" class="widget %2$s">',
                      'after_widget' => '</div>',
                      'before_title' => '<h4 class="section">',
                      'after_title' => '</h4>',
      ));

      ;
}
	
	function my_admin_theme_style() {
	    wp_enqueue_style('my-admin-theme', get_stylesheet_uri('style.css', __FILE__));
	}
	add_action('admin_enqueue_scripts', 'my_admin_theme_style');

	function addCss(){
		wp_enqueue_style( 'css-xxx', get_bloginfo('template_url').'/css/index.css' );
	}
	add_action("wp_enqueue_scripts", "addCss");

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
///ajout bdd option 	
add_action( 'admin_init', 'ImmoOpotions' );

function ImmoOpotions( )
{
	register_setting( 'my_theme', 'background_color' ); // couleur de fond
	register_setting( 'my_theme', 'text_color' );       // couleur du texte
}
// la fonction myThemeAdminMenu( ) sera exécutée
// quand WordPress mettra en place le menu d'admin
/// ajout dans la bar admin wordpress
add_action( 'admin_menu', 'ImmoAdminMenu' );

function ImmoAdminMenu( )
{
	add_menu_page(
		'Options thème', // le titre de la page
		'Options thème',            // le nom de la page dans le menu d'admin
		'administrator',        // le rôle d'utilisateur requis pour voir cette page
		'Options thème',        // un identifiant unique de la page
		'VueOptionPage',   // le nom d'une fonction qui affichera la page
		'',
		'60,6'
	);
}
//// page admin
function VueOptionPage( )
{
	echo '<div class="wrap">
		<h2>Options de mon thème</h2>

		<form method="post" action="options.php">';
			
				// cette fonction ajoute plusieurs champs cachés au formulaire
				// pour vous faciliter le travail.
				// elle prend en paramètre le nom du groupe d'options
				// que nous avons défini plus haut.

	settings_fields( 'my_theme' );
			

	echo'
	<table class="form-table">
		<tr valign="top">
			<th scope="row"><label for="background_color">Couleur de fond</label></th>
			<td><input type="text" id="background_color" name="background_color" class="small-text" value="'.get_option( 'background_color' ).'" /></td>
		</tr>

		<tr valign="top">
			<th scope="row"><label for="text_color">Couleur du texte</label></th>
			<td><input type="text" id="text_color" name="text_color" class="small-text" value="'.get_option( 'text_color' ).'" /></td>
		</tr>
	</table>

			<p class="submit">
				<input type="submit" class="button-primary" value="Mettre à jour" />
			</p>
		</form>
	</div>';
	
}
///// ajout au head
add_action( 'wp_head', 'myThemeCss' );

function myThemeCss( )
{
	// on crée un bloc style qui appliquera nos couleurs à l'élément body
?>
	<style type="text/css">
		body {
			background-color: <?php echo get_option( 'background_color', '#fff' ); ?>;
			color: <?php echo get_option( 'text_color', '#222' ); ?>;
		}
	</style>
<?php
}


function themeslug_theme_customizer( $wp_customize ) {
    // Fun code will go here
}
add_action('customize_register', 'themeslug_theme_customizer');
?>