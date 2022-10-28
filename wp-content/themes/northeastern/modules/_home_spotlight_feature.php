<section class="container--beige" aria-label="stories">
  <div class="container">
    <div class="block-spacing">
      <div class="grid grid--2-3 grid--middle">
        <div class="zero">
          <?php the_sub_field('heading'); ?>
        </div>
        <?php $link = get_sub_field('more_link'); ?>
        <?php if($link): ?>
          <div class="button-text-right">
            <a href="<?php echo $link['url']; ?>" class="button button--black-red button--block">
              <span class="button__text"><?php echo $link['title']; ?></span>
              <span class="button__arrow">
                <?php echo svgstore('arrow', '', ''); ?>
              </span>
            </a>
          </div>
        <?php endif; ?>
      </div>
      <div class="block--top">
        <div class="grid grid--slider">
          <?php while(have_rows('spotlight_stories')): the_row(); ?>
            <?php $post_id = get_sub_field('spotlight_story');
              $vid = get_field('spotlight_video', $post_id);
              $cat_override = get_field('spotlight_category', $post_id);
              $cat = get_primary_term('news_categories', $post_id);
              $spotlight_image = get_field('spotlight_image', $post_id);
              $news_image = get_field('image', $post_id);
              $spotlight_heading = get_field('spotlight_heading', $post_id);
              $spotlight_subheading = get_field('spotlight_subheading', $post_id);
              $image_id = $spotlight_image ? $spotlight_image : $news_image;
              ?>
              <div class="animate-In">
                <?php if($vid): ?>
                  <a href="<?php echo $vid; ?>" class="card__item" data-minimodal>
                    <div class="card__image">
                      <?php echo wp_get_attachment_image($image_id, 'landing-square', false); ?>
                    </div>
                    <div class="card__content">
                      <?php if ( $cat_override ) : ?>
                        <div class="card__category"><?php echo $cat_override; ?></div>
                      <?php else : ?>
                        <div class="card__category"><?php echo $cat->name; ?></div>
                      <?php endif; ?>
                      <div class="card__name"><?php echo $spotlight_heading; ?></div>
                      <div class="card__title"><?php echo $spotlight_subheading; ?></div>
                      <div class="card__video__group">
                        <?php echo svgstore('video', '', 'card__video__icon'); ?>
                        <span class="card__video__text">Watch</span>
                      </div>
                    </div>
                  </a>
                <?php else: ?>
                  <a href="<?php echo get_the_permalink($post_id); ?>" class="card__item">
                    <?php if( $image_id ) : ?>
                      <div class="card__image">
                        <?php echo wp_get_attachment_image($image_id, 'landing-square', false); ?>
                      </div>
                    <?php endif; ?>
                    <div class="card__content">
                      <?php if ( $cat_override ) : ?>
                        <div class="card__category"><?php echo $cat_override; ?></div>
                      <?php else : ?>
                        <div class="card__category"><?php echo $cat->name; ?></div>
                      <?php endif; ?>
                      <div class="card__name"><?php echo $spotlight_heading; ?></div>
                      <div class="card__title"><?php echo $spotlight_subheading; ?></div>
                      <?php echo svgstore('arrow', '', 'card__arrow__icon'); ?>
                    </div>
                  </a>
                <?php endif; ?>
              </div>
            <?php endwhile; ?>

        </div>
      </div>
    </div>
  </div>
</section>
