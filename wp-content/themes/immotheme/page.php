<?php
/*
Template Name: Statistiques
*/
?>
<?php get_header(); ?>
<div class="page">
  <div class="left-side-page">
    <?php if (have_posts()) : ?>
      <?php while (have_posts()) : the_post(); ?>
        <div class="post">
          <h1 class="post-title"><?php the_title(); ?></h1>
          <div class="post-content">
      		  <p>Contenu : <strong><?php echo the_content(); ?></strong></p>
          	<p>Nombre de Posts : <strong><?php echo wp_count_posts()->publish; ?></strong></p>
          	<p>Nombre de Pages : <strong><?php echo wp_count_posts('page')->publish; ?></strong></p>
          	<p>Nombre de commentaires publiés : <strong><?php echo wp_count_comments()->approved; ?></strong></p>
          </div>
        </div>
      <?php endwhile; ?>
    <?php endif; ?>
  </div>
  <div class="right-side-page">
    <?php get_sidebar(); ?>
  </div>
</div>

<?php get_footer(); ?>