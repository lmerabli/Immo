<?php 
	get_header(); 
?>
	<div class="test">
		<div class="banner">
			<!-- variable wordpress du nom du site-->
			<h1><?php bloginfo('name'); ?></h1>
			<!-- variable wordpress du slogan du site-->
			<p><?php bloginfo('description'); ?></p>
		</div>
	</div>
<?php
	//get_sidebar();
	get_footer();
?>