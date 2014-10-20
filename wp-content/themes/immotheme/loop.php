<?php if (have_posts()) : ?>
  <p class="title">
    Tout les articles:
    <!--Si des posts existent-->
  </p>

  <!--Boucle parcourant tout les articles-->
  <?php while (have_posts()) : the_post(); ?>
    <!--Article-->
    <div class="post">
      <!--Titre de l'article-->
      <h3 class="post-title">
        <!--URL du titre de l'article redirigeant sur l'article entier-->
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
      </h3>

      <!-- Informations de la date, la catégorie, et l'auteur du post-->
      <p class="post-info">
        Le <?php the_date("d/m/y"); ?> dans <?php the_category(', '); ?> par <?php the_author(); ?>.
        <!--Futurs critères de séléction-->
        <br>Critères: <?php the_meta() ?>
      </p>

      <!--Contenu du post-->
      <div class="post-content">
        <?php the_content("Lire la suite"); ?>
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