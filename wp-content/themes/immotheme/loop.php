<?php 

    /*global $wp_query;
    $args = array_merge( $wp_query->query_vars, array (
            'post_type' => 'immo',
            'posts_per_page' => 0
            ) );
    query_posts( $args );*/
    if (have_posts()) : ?>
        <p class="title">
             Tout les biens immobiliers:
             <!--Si des posts existent-->
         </p>

        <!--Boucle parcourant tout les articles-->
        <?php 
		query_posts( array (
            'post_type' => 'immo',
            'posts_per_page' => 0));

        while (have_posts()) : the_post(); ?>
            <!--Article-->
            <div class="post">
                <!--Titre de l'article-->
                <h3 class="post-title">
                    <!--URL du titre de l'article redirigeant sur l'article entier-->
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h3>

                <!-- Informations de la date, la catégorie, et l'auteur du post-->
                <p class="post-info">
                    Publié le <?php the_date("d/m/y"); ?> dans <?php the_category(', '); ?> par <?php the_author(); ?>.
                    <!--Futurs critères de séléction-->
                    <br><br>Critères sélectionnés: 
                    <?php 
                    	echo "<ul class='post-meta'>";
                    	foreach(get_post_custom() as $cle => $array_value)
                    	{
                    		if($cle != "_edit_lock" && $cle != "_edit_last")
                    			echo "<li><span class='post-meta-key'>".  str_replace("_", " ", $cle).":</span>&nbsp". $array_value[0]."</li>";
                    	}
                    	echo "</ul>";
        	        ?>
                </p>

                <!--Contenu du post-->
                <div class="post-content">
                    <?php the_excerpt("Lire la suite"); ?>
                    <?php comments_popup_link(_('Aucun commentaire'),_('<span>1</span> commentaire'),_('<span>%</span> commentaires'))?>
                </div>
            </div>
        <?php endwhile; ?>

    <?php else : ?>
    <!--Si il n'y a pas de posts existants-->
    <p class="nothing">
        Aucun article à afficher !
    </p>
<?php endif; ?>