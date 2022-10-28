<?php
  /*
    Template Name: Department Home
    Template Post Type: page
  */
?>
<?php $hero_type = get_field('hero_type'); ?>
<?php get_header(); ?>
<main id="main-content">
  <?php if ( !post_password_required() ) : ?>
    <?php if ($hero_type == 'video') : ?>
      <?php get_template_part('modules/_hero_video'); ?>
    <?php else : ?>
      <?php get_template_part('modules/_hero_slider'); ?>
    <?php endif; ?>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <?php while (have_rows('module_blocks')) : the_row(); ?>
        <?php $bg = get_sub_field('module_block_type'); ?>
        
        <?php if($bg == '<none>'): ?>
          <section class="container">
        <?php else: ?>
          <section class="container--<?php echo $bg; ?>">
            <div class="container">
        <?php endif; ?>

        <?php while (have_rows('modules')) : the_row(); ?>
          <?php get_template_part('modules/_' . get_row_layout()); ?>
        <?php endwhile; ?>

        <?php if($bg == '<none>'): ?>
          </section>
        <?php else : ?>
            </div>
          </section>
        <?php endif; ?>

      <?php endwhile; ?>
    <?php endwhile; endif; wp_reset_postdata(); ?>
    
  <?php else : ?>
    <div class="main container container--clear">
      <?php the_content(); ?>
    </div>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
