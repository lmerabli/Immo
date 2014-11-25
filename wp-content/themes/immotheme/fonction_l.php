<?php

add_action('admin_init','mythemeRegisterSettings');
function mythemeRegisterSetting()
{
	register_setting('my_theme','background_color');
	register_setting('my_theme','texte_color');
}

add_action('admin_menu','mythemeAdminMenu');
function mythemeAdminMenu()
{
    add_menu_page(
        'option de min th�me',
        'Mon th�me',
        'administrator',
        'my-theme-page',
        'myThemeSettingsPage'
    );
}

function myThemeSettingsPage()
{

}


//////////////////faire un menu r�seau sociaux///////////////////
add_action('admin_menu','my_pannel');

function my_pannel()
{
	add_menu_page
	(
		'R�seaux sociaux', 
		'R�seaux sociaux', 
		'activate_plugins',
		'my_pannel',
		'render_pannel'
	
	);
}
function render_pannel()
{

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
							<th> Mes R�seaux sociaux </th>
						</tr>
					</thead>
					<tbody>
						<tr><td scope="row"><label for="twitter">Twitter</label></td></tr>
						<tr><td scope="row"><input type ="text" id="twitter" name="option[twitter]" value="<?php get_option('twitter','')?>" size="75"></td></tr>
						<tr><td scope="row"><label for="facebook">Facebook</label></td></tr>
						<tr><td scope="row"><input type ="text" id="facebook" name="option[facebook]" value="<?php get_option('facebook','')?>" size="75"></td></tr>
						<input type="hidden" name="pannel_noncename" value="<?php wp_create_nonce('my-pannel'); ?> " >
						<p class='submit'>
							<input type='submit' name='pannel_update' class='button-primary autowidth' value='Sauvegarder'>
						</p>
				</table>
	</div>
	
	<?php 
	
}
/////////////////:fin////////

////////// faire des widgets ////////////////////////////
add_action('widgets_init','theme_register_widgets');
function theme_register_widgets()
{
	register_widget('CustomWidget');
}

Class CustomWidget extends WP_Widget
{
	function CustomWidget()///instantiate the parent object
	{  
	
	}
	function Widget($args,$d) /// Widget output
	{
	
	}
	function update($new,$old)/// Save widget 
	{
	
	}
	function form($d)
	{	echo 
		"
		
		<table>
			<tr><td scope='row'><label for='lw_name'>Nom du site</label></td></tr>
			<tr><td scope='row'><input type ='text' id='lw_name' name='option[lw_name]' value='".get_option('lw_name','')."' size='75'></td></tr>
			<tr><td scope='row'><label for='lw_lien'>Nom du site</label></td></tr>
			<tr><td scope='row'><input type ='text' id='lw_lien' name='option[lw_lien]' value='".get_option('lw_lien','')."' size='75'></td></tr>
		</table>
		";
	
	}

}