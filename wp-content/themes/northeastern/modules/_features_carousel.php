<div class="container">
  <div class="block-spacing">
    <div class="container--narrow block-center text-center zero">
      <?php the_sub_field('heading'); ?>
      </h2>
    </div>
    <div class="feature feature--slider">
      <?php while(have_rows('features')): the_row(); ?>
        <?php $type = get_sub_field('type'); ?>
        <div class="feature__item">
          <div class="feature__content animate-In">
            <h4><?php the_sub_field('header'); ?></h4>

            <p class="feature__text">
              <?php the_sub_field('teaser'); ?>
            </p>

            <div>
              <?php if($type == 'video'): ?>
                <a href="<?php echo get_sub_field('video'); ?>" class="button button--inline-block" data-minimodal>
                <span class="button__video">
                  <?php echo svgstore('video', '', ''); ?>
                </span>
                <span class="button__text">Watch the video</span>
              <?php else: ?>
                <?php $link = get_sub_field('link'); ?>
                <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="button button--inline-block">
                <span class="button__text"><?php echo $link['title']; ?></span>
                <span class="button__arrow">
                  <?php echo svgstore('arrow', '', ''); ?>
                </span>
              <?php endif; ?>
              </a>

            </div>

          </div>
          <div class="feature__media animate-In">
            <?php if($type == 'video'): ?>
              <div class="feature__image feature__media__gradient">
            <?php else: ?>
              <div class="feature__image">
            <?php endif; ?>
            <?php echo wp_get_attachment_image(get_sub_field('image'), 'feature-slider', false); ?>
              <?php if($type == 'video'): ?>
                <a href="<?php echo get_sub_field('video'); ?>" class="media__btn" data-minimodal>
                  <?php echo svgstore('play', 'Play Video', 'media__btn__icon'); ?>
                </a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>
