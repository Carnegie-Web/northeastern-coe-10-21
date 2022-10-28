<?php
$post = get_field('404_page', 'options');
setup_postdata($post);
  get_header(); ?>
<main id="main-content">
  <?php if ( !post_password_required() ) : ?>
    <div class="main container container--clear">
      <aside class="main__sidebar main__sidebar--alt">
        <?php while (have_rows('sidebar_modules')) : the_row(); ?>
            <?php get_template_part('modules/_' . get_row_layout()); ?>
        <?php endwhile; ?>
      </aside>
      <div class="main__content">
        <?php get_template_part('modules/_breadcrumb'); ?>

        <h1>
          <?php echo the_title(); ?>
        </h1>
        
          <?php while (have_rows('module_blocks')) : the_row(); ?>
            <?php while (have_rows('modules')) : the_row(); ?>
              <?php get_template_part('modules/_' . get_row_layout()); ?>
            <?php endwhile; ?>
          <?php endwhile; ?>
        
      </div>
    </div>
  <?php else : ?>
    <div class="main container container--clear">
      <?php the_content(); ?>
    </div>
  <?php endif; ?>
</main>
<?php get_footer(); 

wp_reset_postdata();?>

