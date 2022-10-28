<?php
  /*
    Template Name: Tertiary
    Template Post Type: page
  */
?>
<?php $blog_id = get_current_blog_id(); ?>

<?php get_header(); ?>
<main id="main-content">
  <?php if ( !post_password_required() ) : ?>
    <div class="main container container--clear">
      <aside class="main__sidebar main__sidebar--alt">
        <?php get_template_part('modules/_subnav'); ?>
      </aside>
      <div class="main__content">
        <?php get_template_part('modules/_breadcrumb'); ?>

        <h1>
          <?php echo the_title(); ?>
        </h1>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <?php while (have_rows('module_blocks')) : the_row(); ?>
            <?php while (have_rows('modules')) : the_row(); ?>
              <?php get_template_part('modules/_' . get_row_layout()); ?>
            <?php endwhile; ?>
          <?php endwhile; ?>
        <?php endwhile; endif; wp_reset_postdata(); ?>
      </div>
      <aside class="main__sidebar main__sidebar--alt">
        <?php while (have_rows('sidebar_modules')) : the_row(); ?>
            <?php get_template_part('modules/_' . get_row_layout()); ?>
        <?php endwhile; ?>
      </aside>
    </div>
  <?php else : ?>
    <div class="main container container--clear">
      <?php the_content(); ?>
    </div>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
