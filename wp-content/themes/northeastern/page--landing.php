<?php
  /*
    Template Name: Landing
    Template Post Type: page
  */
?>
<?php $blog_id = get_current_blog_id(); ?>
<?php $intro_heading = get_field('intro_heading'); ?>
<?php $intro_text = get_field('intro_text'); ?>

<?php get_header(); ?>
<main id="main-content">
  <?php get_template_part('modules/_hero_landing'); ?>
  <?php if ( !post_password_required() ) : ?>
    <div class="main container container--clear">
        <aside class="main__sidebar main__sidebar--alt">
          <?php get_template_part('modules/_subnav'); ?>
          <?php while (have_rows('sidebar_modules')) : the_row(); ?>
              <?php get_template_part('modules/_' . get_row_layout()); ?>
          <?php endwhile; ?>
        </aside>
        <div class="main__content">
          <?php get_template_part('modules/_breadcrumb'); ?>
          <?php if ( $intro_heading ) : ?>
            <h2>
              <?php echo $intro_heading; ?>
            </h2>
          <?php endif; ?>
          <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <?php if ( $intro_text ) : ?>
              <?php echo $intro_text; ?>
            <?php endif; ?>
          <?php endwhile; endif; wp_reset_postdata(); ?>
        </div>
    </div>
    <div class="container">
      <hr class="block-med">
    </div>
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
  <?php else : ?>
    <div class="main container container--clear">
      <?php the_content(); ?>
    </div>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
