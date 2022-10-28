<?php $blog_id = get_current_blog_id(); 
$image = get_field('image'); 
$faculty_ids = get_field('faculty_members');

?>

<?php get_header(); ?>
<main id="main-content">
  <?php if ( !post_password_required() ) : ?>
    <div class="main container container--clear">
      <aside class="main__sidebar main__sidebar--alt">
        <?php get_template_part('modules/_subnav'); ?>
        <?php while (have_rows('sidebar_modules')) : the_row(); ?>
            <?php get_template_part('modules/_' . get_row_layout()); ?>
        <?php endwhile; ?>
      </aside>
      <div class="main__content news">
        <?php get_template_part('modules/_breadcrumb'); ?>

        <h1 class="h2">
          <?php echo the_title(); ?>
        </h1>
        <?php get_template_part('modules/_postmeta'); ?>
        <?php echo wp_get_attachment_image($image, ''); ?>
        <?php the_content(); ?>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
          <?php while (have_rows('module_blocks')) : the_row(); ?>
            <?php while (have_rows('modules')) : the_row(); ?>
              <?php get_template_part('modules/_' . get_row_layout()); ?>
            <?php endwhile; ?>
          <?php endwhile; ?>
        <?php endwhile; endif; wp_reset_postdata(); ?>
        <?php if ( $faculty_ids ) : ?>
          <?php 
            if (is_multisite()) { switch_to_blog(1); }
            $faculty_count = 0;
            if (is_array($faculty_ids)) {
              $faculty_count = count($faculty_ids); 
            }
            $ictr = 0; 
            echo "<p class=\"list__meta--news\">Related Faculty: "
          ?>
          <?php 
          foreach ( $faculty_ids as $faculty_id ) : ?>
            <a href="<?php echo get_author_posts_url( $faculty_id, get_the_author_meta( 'user_nicename', $faculty_id ) ); ?>" class="contact__name"><?php echo get_the_author_meta( 'display_name', $faculty_id ); ?></a><?php $ictr++;
            if ( $ictr < $faculty_count ){echo ", ";} ?>
          <?php endforeach; ?>
          <?php echo "</p>"; ?>
          <?php if (is_multisite()) { restore_current_blog(); } ?>
        <?php endif; ?>
        <?php 
        $term = get_delimited_taxonomy('page_department', $post->ID);
        if($term) {
          echo "<p class=\"list__meta--news\">Related Departments:";
          echo str_replace('"', '', $term) ;
          echo "</p>";
        }?>
      </div>
    </div>
  <?php else : ?>
    <div class="main container container--clear">
      <?php the_content(); ?>
    </div>
  <?php endif; ?>
</main>
<?php get_footer(); ?>