<?php
  /*
    Template Name: Faculty Related News
    Template Post Type: page
  */
?>

<?php get_header(); ?>
<main id="main-content">
  <div class="main container container--clear">
    <?php if ( !post_password_required() ) : ?>
      <?php get_template_part('modules/_breadcrumb'); ?>
      <?php get_template_part('modules/_faculty_related_news'); ?>
      <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php while (have_rows('module_blocks')) : the_row(); ?>
          <?php while (have_rows('modules')) : the_row(); ?>
            <?php get_template_part('modules/_' . get_row_layout()); ?>
          <?php endwhile; ?>
        <?php endwhile; ?>
      <?php endwhile; endif; wp_reset_postdata(); ?>
    <?php else : ?>
      <?php the_content(); ?>
    <?php endif; ?>
  </div>
</main>
<?php get_footer(); ?>
