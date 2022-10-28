<?php
$count = get_sub_field('number');
$count = $count ? $count : 3;
$departments = get_sub_field('department');
$category = get_sub_field('categories');
$topic = get_sub_field('topics');
$heading = get_sub_field('heading');
$meta_query = '';

if($departments || $category || $topic) {
  $meta_query = array('relation' => 'AND');
  if (!empty($departments)) {
      $meta_query[] = array(
      'key' => '__ecp_custom_2',
      'value' => $departments,
      'compare' => '='
    );
  }
  if (!empty($topic)) {
      $meta_query[] = array(
      'key' => '__ecp_custom_3',
      'value' => $topic,
      'compare' => '='
    );
  }
  if (!empty($category)) {
      $meta_query[] = array(
      'key' => '__ecp_custom_4',
      'value' => $category,
      'compare' => '='
    );
  }
}

if (is_multisite()) { switch_to_blog(1); }
$events = tribe_get_events([
    'start_date' => date('Y-m-d H:i:s'),
    'eventDisplay' => 'list',
    'meta_query' => $meta_query,
    'hide_upcoming' => false,
    'posts_per_page' => $count
  ]);
?>

<?php $feed_style = get_sub_field('feed_style'); ?>

<?php if ( $events ) : ?>
  <div class="container">
    <div class="block-spacing">
      <div class="grid grid--2-3">
        <div class="zero">
          <?php if ( $heading ) : ?>
            <?php echo $heading; ?>
          <?php else : ?>
            <h2>Events</h2>
          <?php endif; ?>
        </div>

        <div class="button-text-right">
          <a href="<?php echo get_post_type_archive_link('tribe_events'); ?>" class="button button--inline-block button--black-red">
            <span class="button__text">More Events</span>
            <span class="button__arrow">
              <?php echo svgstore('arrow', '', '') ?>
            </span>
          </a>
        </div>
      </div>
      <div class="block--top">
        <div class="grid grid--slider">
          <?php foreach ($events as $post) : setup_postdata($post); ?>
            <div class="event_feed_module_item">
              <a href="<?php the_permalink(); ?>" class="card__item event__item">
                <div class="card__content">
                  <div class="event__date">
                    <?php $startdate = tribe_get_start_date($post, false, 'l, F j'); ?>
                    <?php $starttime = " / " . preg_replace( array( ' /am/', ' /pm/' ), array( 'AM', 'PM' ), tribe_get_start_date($post, false, 'g:ia')); ?>
                    <?php $enddate = tribe_get_end_date($post, false, 'l, F j'); ?><br>
                    <?php $endtime = " / " . preg_replace( array( ' /am/', ' /pm/' ), array( 'AM', 'PM' ), tribe_get_end_date($post, false, 'g:ia')); ?>
                    <?php $location = tribe_get_venue($post); ?>
                    <?php $printdate = ''; ?>
                    <?php
                    if ($startdate !== $enddate){
                      $printdate = "<span class=\"text-red\">" . $startdate . "</span> / " . $starttime . " - " . "<span class=\"text-red\">" . $enddate . " </span>" . $endtime;
                    }
                    else {
                      $printdate = "<span class=\"text-red\">" . $startdate . "</span>" . $starttime;
                    }
                    ?>
                    <?php echo $printdate ?>
                  </div>
                  <?php if($feed_style != 'no-images'): ?>
                    <?php if ( has_post_thumbnail($post->ID) ) : ?>
                      <div class="event__image">
                        <?php the_post_thumbnail('card-image'); ?>
                      </div>
                    <?php endif; ?>
                  <?php endif; ?>
                  <div class="card__bottom">
                    <span class="event__title">
                      <?php if ($location) : ?>
                        <div class="caption"><?php echo $location; ?></div>
                      <?php endif; ?>
                      <?php the_title(); ?>
                    </span>
                    <?php echo svgstore('arrow', '', 'card__arrow__icon'); ?>
                  </div>
                </div>
              </a>
            </div>
          <?php endforeach; wp_reset_postdata(); ?>
          

        </div>
      </div>
    </div>
  </div>
<?php endif; ?>
<?php if (is_multisite()) { restore_current_blog(); } ?>
