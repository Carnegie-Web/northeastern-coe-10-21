<?php
  /*
    Template Name: Listing
    Template Post Type: page
  */
?>
<?php $blog_id = get_current_blog_id(); ?>

<?php get_header(); ?>
<main id="main-content">
  <?php get_template_part('modules/_hero_landing'); ?>
  <?php if ( !post_password_required() ) : ?>
    <div class="main container container--clear">

      
      <?php get_template_part('modules/_breadcrumb'); ?>
      <h1>
        <?php echo the_title(); ?>
      </h1>
        
      <?php while (have_rows('modules')) : the_row(); ?>
        <?php get_template_part('modules/_' . get_row_layout()); ?>
      <?php endwhile; ?>
          
    </div>
  <?php else : ?>
    <div class="main container container--clear">
      <?php the_content(); ?>
    </div>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
