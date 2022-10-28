<div class="container">
  <div class="block-spacing zero">
    <h2><?php the_sub_field('heading'); ?></h2>
    <div class="container--narrow">
      <p class="text-white"><?php the_sub_field('teaser'); ?></p>
    </div>

    <div class="grid grid--push grid--feature grid--slider">
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
          <div class="feature__item">
            <div class="feature__image">
              <?php echo wp_get_attachment_image($meta['spotlight_image_wide'][0], 'feature-slider', false); ?>
            </div>
            <div class="feature__content">
              <p class="text-white caption">
                <?php echo excerpt(29); ?>
              </p>
              <?php if($vid): ?>
                <a href="<?php echo $vid; ?>" class="card__video__group" data-minimodal>
                  <?php echo svgstore('video', '', 'card__video__icon'); ?>
                  <span class="card__video__text">Watch</span>
                </a>
              <?php else: ?>
                <a href="<?php echo get_the_permalink(); ?>" class="button button--inline-block">
                  <span class="button__text text-white">Read more</span>
                  <span class="button__arrow button__arrow--red">
                    <?php echo svgstore('arrow', '', ''); ?>
                  </span>
                </a>
              <?php endif; ?>
            </div>
          </div>
        <?php endwhile; wp_reset_postdata(); ?>
      <?php endwhile; ?>
    </div>
  </div>
</div>
