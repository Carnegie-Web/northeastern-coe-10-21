<?php
  /*
    Template Name: Listing
    Template Post Type: page
  */
?>
<?php $blog_id = get_current_blog_id(); ?>
<?php $img = get_field('image_desktop'); ?>
<?php $imgMobile = get_field('image_mobile'); ?>
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

        <?php if ( !($img && $imgMobile) ) : ?>
        <h1>
          <?php echo the_title(); ?>
        </h1>
        <?php endif; ?>

        <?php if ( $intro_heading || $intro_text ) : ?>
          <?php if ( $intro_heading ) : ?>
            <h2>
              <?php echo $intro_heading; ?>
            </h2>
          <?php endif; ?>
          <?php if ( $intro_text ) : ?>
            <?php echo $intro_text; ?>
          <?php endif; ?>
        <?php endif; ?>
      </div>

    </div>
    <div class="container">
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
