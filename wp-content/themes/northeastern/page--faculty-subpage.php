<?php $blog_id = get_current_blog_id(); ?>
<?php $heading = get_field('subpage_heading'); ?>
<?php get_header(); ?>
<main id="main-content">
  <?php if ( !post_password_required() ) : ?>
    <div class="main container container--clear">
      <div class="main__content">
        <?php get_template_part('modules/_breadcrumb'); ?>

        <h1 class="h2">
          <?php echo $heading; ?>
        </h1>
        <?php while (have_rows('modules')) : the_row(); ?>
          <?php get_template_part('modules/_' . get_row_layout()); ?>
        <?php endwhile; ?>
        <p class="caption">Last Updated: <?php echo date('M Y'); ?></p>
      </div>
    </div>
  <?php else : ?>
    <div class="main container container--clear">
      <?php the_content(); ?>
    </div>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
