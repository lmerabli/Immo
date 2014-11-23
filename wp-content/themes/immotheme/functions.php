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

/////// reseau sociaux
	if(is_admin()) 
	{
		wp_enqueue_script('costumadminjs',  get_template_directory_uri().'/js/admin.js');
	}
	add_action('admin_menu','my_pannel');

function my_pannel()
{
	add_menu_page
	(
		'Réseaux sociaux', 
		'Réseaux sociaux', 
		'activate_plugins',
		'my_pannel',
		'render_pannel'
	
	);
}
function render_pannel()
{
	wp_enqueue_media();
	if(isset($_POST['pannel_update']))
	{	
		if(!wp_verify_nonce($_POST['pannel_noncename'],'my-pannel'))
			die('Token non valide');
		//var_dump($_POST);
		foreach($_POST['option'] as $name=>$value)
		{
			if(empty($value))
				delete_option($name);
			else
				update_option($name,$value);
		}
		?>
		<!-- faire un message  dynamique -->
		<div id="message" class="updated fade">
			<p><strong> Bravo ! </strong> Options sauvegard�es avec succ�s </p>
		</div>
		<!-- faire un message  dynamique -->
		<?php
	}
		
	?>
	<div class="wrap theme-options-page">
		<div id="icon-option-general" class="icon32"> </div>
		<h2> R�seaux Sociaux</h2>
		<form action="" method="post">
		
			<div class="theme-option-group">
				<table cellspacing=0 class="widefat options-table">
					<thead>
						<tr>
							<th colspan="2"> Mes R�seaux sociaux </th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<th scope="row"><label for="header">Header</label>
						<th>
						<td>
								<image src='<?php get_option('header','')?>' width='100'>
								<input type ="text" id="header" name="option[header]" value="<?php get_option('header','')?>" size="75">
								<a href="#" class="button customaddmedia">Choisir une image</a>
						</td></tr>
						
					</tbody>
				</table>
	</div>
	
	<?php 
	
}
		
	
	
	/////////////////fin reseau sociaux
	
	
	
	
	
	
	
	/////// Ajout de la fonction permettant de personnaliser son menu via le panel admin de Wordpress
	register_nav_menus(array( 'header' => 'Menu principal (header)'));
///ajout bdd option 	
add_action( 'admin_init', 'ImmoOpotions' );

function ImmoOpotions( )
{
	register_setting( 'my_theme', 'background_color' ); // couleur de fond sidebar
	register_setting( 'my_theme', 'text_color' );       // couleur du texte sidebar
	register_setting( 'my_theme', 'image_background');
	register_setting( 'my_theme', 'image_logo');
	register_setting( 'my_theme', 'image_banner');
}
// la fonction myThemeAdminMenu( ) sera exécutée
// quand WordPress mettra en place le menu d'admin
/// ajout dans la bar admin wordpress
add_action( 'admin_menu', 'ImmoAdminMenu' );

function ImmoAdminMenu( )
{
	//add_submenu_page( 'themes.php', 'Options thème', 'Options thème', 'administrator', 'Options thème', 'VueOptionPage' );
	add_menu_page(
		'Options thème', // le titre de la page
		'Options thème',            // le nom de la page dans le menu d'admin
		'administrator',        // le rôle d'utilisateur requis pour voir cette page
		'Options thème',        // un identifiant unique de la page
		'VueOptionPage',   // le nom d'une fonction qui affichera la page
		'',
		'60,6'
	);
	
    /*add_theme_page( 'Options thème', 'Options thème', 
    'administrator', 'Options thème', 
    'VueOptionPage' );*/


}
//// page admin
function VueOptionPage( )
{
	wp_enqueue_media();
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
			<th scope="row"><label for="image_background">Image background</label></th>
			
				<td>	<image id="image_image_background" src="'.get_option("image_background").'" width="100"></td>
				<td>	<input type ="text" id="input_image_background" name="image_background" value="'.get_option('image_background').'" size="75"></td>
				<td>	<a href="#" id="image_background" class="button customaddmedia">Choisir une image</a></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="image_logo">Image logo</label></th>
			
				<td>	<image id="image_image_logo" src="'.get_option("image_logo").'" width="100"> </td>
				<td>	<input type ="text" id="input_image_logo" name="image_logo" value="'.get_option('image_logo').'" size="75"></td>
				<td>	<a href="#" id="image_logo" class="button customaddmedia">Choisir une image</a></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="image_logo">Image Banner</label></th>
			
				<td>	<image id="image_image_banner" src="'.get_option("image_banner").'" width="100"> </td>
				<td>	<input type ="text" id="input_image_banner" name="image_banner" value="'.get_option('image_banner').'" size="75"></td>
				<td>	<a href="#" id="image_banner" class="button customaddmedia">Choisir une image</a></td>
		</tr>
		<tr valign="top">
			<th scope="row"><label for="background_color">Couleur de fond de la zone widget</label></th>
			<td><input type="text" id="background_color" name="background_color" class="small-text" value="'.get_option( 'background_color' ).'" /></td>
		</tr>

		<tr valign="top">
			<th scope="row"><label for="text_color">Couleur du texte de la zone widget</label></th>
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
	if (get_option('image_logo') != '') {
        echo '<link rel="shortcut icon" href="' .get_option('image_logo'). '"/>' . "\n";
    } else {
        ?>
        <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri() ?>/images/favicon.ico" />
        <?php
    }
?>
			
	<style type="text/css">
		<?php if (get_option('image_background') != ''){ ?>
		body, .banner {
			background: inherit;
			
			background-image: url(<?php echo get_option( 'image_background');?>);
			color: <?php echo get_option( 'text_color', '#222' ); ?>;
		}
		.body{
			background-color: white;
		}
		<?php } 
		 elseif (get_option('background_color') != ''){ ?>
		body, .banner {
			background: inherit;
			
			background: <?php echo get_option( 'background_color');?>;
			
		}
		.body{
			background-color: white;
		}
		 <?php }
		 if (get_option('image_banner') != ''){ ?>
		#banner-text{
			background-image: url(<?php echo get_option( 'image_banner');?>);
		}
		<?php } 
		if (get_option('background_color') != ''){ ?>
		.side{border: 1px solid green; width: 29.4%; background-color:<?php echo get_option('background_color'); ?>;}
			.login-box{background-color: <?php echo get_option('background_color'); ?>;}
			<?php } 
		if (get_option('text_color') != ''){ ?>
				.welcome_user{color: <?php echo get_option( 'text_color' ); ?>;}
				    .welcome_user a{text-decoration:none; font-weight: bold; color: <?php echo get_option( 'text_color' ); ?>;}

				.disconnect_user{text-decoration:none; color: <?php echo get_option( 'text_color' ); ?>;}
		<?php } ?>
	</style>
<?php
}


function themeslug_theme_customizer( $wp_customize ) {
    // Fun code will go here
}
add_action('customize_register', 'themeslug_theme_customizer');
?>