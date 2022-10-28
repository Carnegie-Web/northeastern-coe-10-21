<?php
  /*
    Template Name: Program
    Template Post Type: page
  */
?>

<?php get_header(); ?>
<main id="main-content">
  <?php get_template_part('modules/_hero_program'); ?>
  <?php if ( !post_password_required() ) : ?>
    <?php get_template_part('modules/_program_overview'); ?>

    <section class="container--beige" aria-label="flexible heading">
      <div class="container">
        <div class="block-spacing container--clear">
          <div class="main__content zero">
            <h2><?php the_field('section_heading'); ?></h2>
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
              <?php while (have_rows('program_main_column_modules')) : the_row(); ?>
                <?php get_template_part('modules/_' . get_row_layout()); ?>
              <?php endwhile; ?>
            <?php endwhile; endif; wp_reset_postdata(); ?>
          </div>
          <div class="main__sidebar">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
              <?php while (have_rows('program_sidebar_modules')) : the_row(); ?>
                <?php get_template_part('modules/_' . get_row_layout()); ?>
              <?php endwhile; ?>
            <?php endwhile; endif; wp_reset_postdata(); ?>
          </div>
        </div>
      </div>
    </section>
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
