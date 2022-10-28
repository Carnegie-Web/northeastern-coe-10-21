<?php

$count = -1;
$class = ' grid--4';

$meta_query = '';
$tax_query = '';

$faculty_id = '';

$display_name = '';


if (isset($_GET['facid'])) {
  $faculty_id  = sanitize_text_field($_GET['facid']);
}

if ($faculty_id) {
  $meta_query = array(
      array(
        'key'     => 'faculty_members',
        'value'   =>  $faculty_id,
        'compare' => 'LIKE'
      )
  );
  $user_info = get_userdata($faculty_id);
  if ($user_info) {
    $display_name = $user_info->display_name;
  }
}

$news = get_posts([
  'post_type' => 'news',
  'numberposts' => $count,
  'meta_query' => $meta_query,
]);


?>
<?php if ($news && $faculty_id) : ?>
  <div class="zero">
    <h1>Related News for <?php echo $display_name; ?></h1>
  </div>
  <div class="container">
    <div class="block-spacing">
      <div class="grid<?php echo $class; ?>">
        <?php foreach ($news as $post) : setup_postdata($post); ?>
          <?php 
          $faculty_ids = get_field('faculty_members');
            if ( $faculty_ids && $faculty_id && in_array( $faculty_id, $faculty_ids ) ): ?>
              <div>
                <div class="card__item news__item">
                  <?php $img = get_field('image'); ?>
                  <?php if ( $img ) : ?>
                    <div class="card__image">
                      <?php echo wp_get_attachment_image($img, 'horizontal-standard', false); ?>
                    </div>
                  <?php endif; ?>
                  <div class="card__content zero">
                    <!-- <?php 
                    $term = get_primary_term('news_categories', $post->ID);
                    if($term) {
                      echo "<div class=\"category\">";
                      echo $term->name ;
                      echo "</div>";
                    }?> -->
                    <?php 
                    //redirect if this is an external article
                    $redirect = get_field('redirect_link');
                    $link = $redirect ? $redirect : get_the_permalink();
                    $target = $redirect ? 'target="_blank"' : '';
                    ?>
                    <h4>
                      <a href="<?php echo $link; ?>" <?php echo $target; ?> ><?php the_title(); ?></a>
                    </h4>
                    <?php the_excerpt(); ?>
                  </div>
                </div>
              </div>
            <?php endif; ?>
        <?php endforeach; wp_reset_postdata(); ?>
        
      </div>
    </div>
  </div>
<?php endif; ?>