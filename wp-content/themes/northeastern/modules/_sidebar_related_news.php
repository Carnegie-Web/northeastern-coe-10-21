<?php 
$post_id = get_queried_object_id();
$count = get_sub_field('number');
$count = $count ? $count : 3;
$count = 3;
$news_tax_query = '';
$news = '';
$term = get_primary_term('news_categories', $post_id);

if ($term) {
  $news_tax_query = array(
    'relation' => 'OR',
    array(
      'taxonomy' => 'news_categories',
      'field' => 'id',
      'terms' => $term->term_id
    )
  );
  $news = get_posts([
  	'post_type' => 'news',
  	'numberposts' => $count,
  	'post__not_in' => array(get_the_ID()),
  	'tax_query' => $news_tax_query
  ]);
}
?>

<?php if ($news) : ?>
    <?php foreach ($news as $post) : setup_postdata($post); ?>
    	<div class="sidebar__panel">
            <div>
              <div class="card__item news__item">
                <?php $img = get_field('image'); ?>
                <?php if ( $img ) : ?>
                    <?php echo wp_get_attachment_image($img, 'sidebar-feature', false); ?>
                <?php endif; ?>
                <div class="card__content zero">
                  <?php
                  if($term) {
                    echo "<div class=\"category\">";
                    echo $term->name ;
                    echo "</div>";
                  }?>
                  <?php 
                  //redirect if this is an external article
                  $redirect = get_field('redirect_link');
                  $link = $redirect ? $redirect : get_the_permalink();
                  $target = $redirect ? 'target="_blank"' : '';
                  ?>
                  <h3>
                    <a href="<?php echo $link; ?>" <?php echo $target; ?> ><?php the_title(); ?></a>
                  </h3>
                  <?php echo '<p>' . excerpt('15') . '</p>'; ?>
                </div>
              </div>
            </div>
        </div>
     <?php endforeach; wp_reset_postdata(); ?>
<?php endif; ?>