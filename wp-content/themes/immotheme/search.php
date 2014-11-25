<?php
    /**
    * Template Name: Search_template 
    */
?>
<?php get_header(); ?>
<div class="search-encart">
    <div class="search-view">

        <!-- Partie centrale-->
        <div class="search-content body">
		<?php 
//				//print_r($_SESSION);
//				 echo fL_formulaire()
				?>
            <!-- Si des éléments sont existants-->
            <?php if ( have_posts() ) : ?>

                <!-- Titre du contenu -->
                <h1 class="search-page-title">
                    <?php _e( 'Résultat pour la recherche: ', 'Immo' ); ?>
                    <span>
                        <?php the_search_query(); ?>
                    </span>
                </h1>
                                        
                <!-- Boucle des posts -->
                <?php while ( have_posts() ) : the_post() ?>
                    <div id="search-post">

                        <!-- Titre de l'élément -->
                        <h2 class="search-entry-title">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                        </h2>
                        
                        <!-- Champs personnalisés -->
                        <div class="single-post-meta">
                            <?php echo "<ul class='post-meta'>";
                                foreach(get_post_custom() as $cle => $array_value)
                                {
                                    if($cle != "_edit_lock" && $cle != "_edit_last")
                                        echo "<li><span class='post-meta-key'>".  str_replace("_", " ", $cle).":</span>&nbsp". $array_value[0]."</li>";
                                }
                                echo "</ul>"; 
                            ?>
                        </div>

                        <!-- Résumé de l'article -->
                        <div class="search-entry-summary"> 
                            <?php the_excerpt( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'Immo' )  ); ?>
                            <?php wp_link_pages('before=<div class="page-link">' . __( 'Pages:', 'Immo' ) . '&after=</div>') ?>
                        </div>          
                    </div>
                <?php endwhile; ?>
                <?php global $wp_query; $total_pages = $wp_query->max_num_pages; if ( $total_pages > 1 ) { ?>
                    <div id="nav-below" class="navigation">
                        <div class="nav-previous"><?php next_posts_link(__( '<span class="meta-nav">&laquo;</span> Older posts', 'Immo' )) ?></div>
                        <div class="nav-next"><?php previous_posts_link(__( 'Newer posts <span class="meta-nav">&raquo;</span>', 'Immo' )) ?></div>
                    </div>
                <?php } ?>          
                <?php else : ?>
                    <div id="post-0" class="post no-results not-found">
                        <h2 class="entry-title">
                            <?php _e( 'Aucun résultat trouvé', 'your-theme' ) ?>
                        </h2>
                        <div class="entry-content">
                            <p>
                                <?php _e( 'Aucun critère ne correspond à votre recherche. Nous vous invitons à faire une recherche avec des mot clé différents', 'Immo' ); ?>
                            </p>
                            <?php get_search_form(); ?>                     
                        </div>
                    </div>
            <?php endif; ?>
        </div>

        <!-- Colonne de droite -->
        <div class="sidebar-search side">
            <div class="login-box">
                <!--SI L'UTILISATEUR EST CONNECTE-->
                <?php if( is_user_logged_in() ): ?>
                    <div class="connect-box connect-box_connected">
                        <?php echo '<p class="welcome_user">Bienvenue <a href="http://localhost/Immo/wp-admin/profile.php">', $current_user->user_login,' !</a></p>'; ?>
                        <a class="disconnect_user" href="http://localhost/Immo/wp-login.php?action=logout&amp;_wpnonce=7cec4d7f3b">Déconnexion</a>
                    </div>
                <!--SI L'UTILISATEUR N'EST PAS CONNECTE-->
                <?php else :?>
                    <!-- BOITE DE CONNEXION-->
                    <div class="connect-box connect-box_notconnected">
                        <?php wp_login_form(); ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php get_sidebar(); ?>
        </div>
    </div>
    <?php get_footer(); ?>
</div>
