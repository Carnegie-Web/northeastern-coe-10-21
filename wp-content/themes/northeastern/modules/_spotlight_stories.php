<section class="container" aria-label="stories">
  <div class="block">
    <div class="grid grid--2-3">
      <div class="zero">
        <?php the_sub_field('heading'); ?>
      </div>
      <?php $link = get_sub_field('more_link'); ?>
      <?php if($link): ?>
        <div class="button-text-right">
          <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="button button--black-red button--block">
            <span class="button__text"><?php echo $link['title']; ?></span>
            <span class="button__arrow">
              <?php echo svgstore('arrow', '', ''); ?>
            </span>
          </a>
        </div>
      <?php endif; ?>
    </div>
  </div>
  <div class="block-spacing">
    <div class="grid grid--2">
      <?php while(have_rows('spotlight_stories')): the_row(); ?>
        <?php $post_id = get_sub_field('spotlight_story'); ?>
        <?php $sq = new WP_Query(array(
            'post_type' => 'news',
            'p' => $post_id,
          ));
        ?>
        <?php while($sq->have_posts()): $sq->the_post(); ?>
          <?php $meta = get_post_meta(get_the_ID()); ?>
          <?php $vid = $meta['spotlight_video'][0]; ?>
          <div class="stories__block animate-In">
            <div class="stories__image">
              <?php echo wp_get_attachment_image($meta['spotlight_image'][0], 'landing-small-square', false); ?>
            </div>
            <div class="stories__content">
              <div class="stories__headline">
                <?php echo $meta['spotlight_heading'][0]; ?><br>
                <?php echo $meta['spotlight_subheading'][0]; ?>
              </div>
              <p>
                <?php echo excerpt(20); ?>
              </p>
              <?php if($vid): ?>
                <a href="<?php echo $vid; ?>" class="card__video__group" data-minimodal>
                  <?php echo svgstore('video', '', 'card__video__icon'); ?>
                  <span class="card__video__text">Watch</span>
                </a>
              <?php else: ?>
                <a href="<?php echo get_the_permalink(); ?>" class="button button--black-red button--inline-block">
                  <span class="button__text">Read More</span>
                  <span class="button__arrow">
                    <?php echo svgstore('arrow', '', '') ?>
                  </span>
                </a>
              <?php endif; ?>
            </div>
          </div>
        <?php endwhile; wp_reset_postdata(); ?>
      <?php endwhile; ?>
    </div>
  </div>
</section>
