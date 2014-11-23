<?php
    /**
    * Template Name: Search_template 
    */
?>
<?php get_header(); ?>
<div class="search-encart">
    <div class="search-view">

        <!-- Partie centrale-->
        <div class="search-content">
            <div class="search-content-head">
                <h1 class="search-title"><?php printf(__('Résultat de votre recherche: %s', 'Immo'), '' . get_search_query() . ''); ?></h1>
            </div>
            <div class="search-encart-post">
                <?php if (have_posts()) : ?>
                    <?php get_template_part('loop', 'search'); ?>

                <?php else : ?>
                    <article id="post-0" class="post no-results not-found">
                        <header class="entry-header">
                            <h1 class="entry-title">
                                <?php _e('Aucun résultat', 'infoway'); ?>
                            </h1>
                        </header>

                        <div class="entry-content">
                            <p>
                                <?php _e('Aucun résultat de correspond à votre recherche. Nous vous invitons à effectuer une recherche avec des mots-clés différents', 'infoway'); ?>
                            </p>
                            <?php get_search_form(); ?>
                        </div>

                    </article>
                <?php endif; ?>
            </div>
        </div>

        <!-- Colonne de droite -->
        <div class="sidebar-search">
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
