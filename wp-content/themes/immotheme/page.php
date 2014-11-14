<?php
/*
Template Name: Statistiques
*/
?>
<?php get_header(); ?>
<div class="page-encart">
  <div class="page-view">
    <div class="left-side-page">
      <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
          <div class="post">
            <h1 class="post-title"><?php the_title(); ?></h1>
            <div class="post-content">
        		  <p>Contenu : <strong><?php echo the_content(); ?></strong></p>
            </div>
          </div>
        <?php endwhile; ?>
      <?php endif; ?>
    </div>
    <div class="right-side-page">
      <?php get_sidebar(); ?>
    </div>
    <?php get_footer(); ?>
  </div>
</div>

