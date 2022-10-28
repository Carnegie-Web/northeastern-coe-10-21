<?php

$count = get_sub_field('number');
$count = $count ? $count : 4;
if($count > 3 ) {
  $class = ' grid--4';
} elseif($count == 2) {
  $class = ' grid--2';
} else {
  $class = '';
}

$meta_query = '';
$tax_query = '';

$news_tags = get_sub_field('categories');
$topics_tags = get_sub_field('topics');
$department_tags = get_sub_field('departments');
$program_tags = get_sub_field('programs');
$organization_tags = get_sub_field('organizations');
$news_type = get_sub_field('news_type');
$news_tax_query = '';

if ($news_type) {
  $meta_query = array(
      array(
          'key' => 'news_type',
          'value' => $news_type,
          'compare' => 'LIKE'
      )
  );
}

if ($news_tags || $department_tags || $program_tags || $topics_tags || $organization_tags) {
  $news_tax_query = array('relation' => 'AND');
  if (!empty($news_tags)) {
      $news_tax_query[] = array(
      'taxonomy' => 'news_categories',
      'field' => 'id',
      'terms' => $news_tags
    );
  }
  if (!empty($department_tags)) {
      $news_tax_query[] = array(
      'taxonomy' => 'page_department',
      'field' => 'id',
      'terms' => $department_tags
    );
  }
  if (!empty($program_tags)) {
      $news_tax_query[] = array(
      'taxonomy' => 'news_programs',
      'field' => 'id',
      'terms' => $program_tags
    );
  }
  if (!empty($topics_tags)) {
      $news_tax_query[] = array(
      'taxonomy' => 'news_topics',
      'field' => 'id',
      'terms' => $topics_tags
    );
  }
  if (!empty($organization_tags)) {
      $news_tax_query[] = array(
      'taxonomy' => 'news_organizations',
      'field' => 'id',
      'terms' => $organization_tags
    );
  }
}

$news = get_posts([
  'post_type' => 'news',
  'numberposts' => $count,
  'tax_query' => $news_tax_query,
  'meta_query' => $meta_query,
]);


?>
<?php if ($news) : ?>
  <div class="container">
    <div class="block-spacing">
      <div class="grid grid--2-3 grid--center">
        <div class="zero">
          <h3 class="h2"><?php the_sub_field('heading'); ?></h3>
        </div>
        <?php $link = get_sub_field('more_link'); ?>
        <div class="button-text-right">
          <?php if ($link) : ?>
              <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="button button--inline-block button--black-red">
                <span class="button__text"><?php echo $link['title']; ?></span>
                <?php echo svgstore('arrow', '', 'button__arrow'); ?>
              </a>
          <?php endif; ?>
        </div>
      </div>
      <div class="block--top">
        <div class="grid<?php echo $class; ?> grid--slider">
          <?php foreach ($news as $post) : setup_postdata($post); ?>
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
          <?php endforeach; wp_reset_postdata(); ?>
          
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>