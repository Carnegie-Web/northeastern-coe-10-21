<section class="container--beige" aria-label="stories">
  <div class="container">
    <div class="block-spacing">
      <div class="grid grid--2-3 grid--middle">
        <div class="zero">
          <?php the_sub_field('heading'); ?>
          <?php the_sub_field('teaser'); ?>
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
      <div class="block--top">
        <div class="card--stories">
          <?php $i = 0; ?>
          <?php while(have_rows('spotlights')): the_row(); ?>
            <?php $post_id = get_sub_field('spotlight_story'); 
              $spotlight_image = get_field('spotlight_image', $post_id);
              $spotlight_image_wide = get_field('spotlight_image_wide', $post_id);
              $spotlight_heading = get_field('spotlight_heading', $post_id);
              $spotlight_subheading = get_field('spotlight_subheading', $post_id);
              
            ?>
              <?php if($i == 0): ?>
                <div class="grid grid--2">
                  <div class="grid grid--2 card--stories-first card__story--show">
              <?php endif; ?>
              <?php if($i == 0 || $i == 1): ?>
                <div>
                  <a href="<?php echo get_the_permalink($post_id); ?>" class="card__item">
                    <div class="card__image">
                      <?php if ( $spotlight_image ) : ?>
                        <?php echo wp_get_attachment_image($spotlight_image, 'landing-square', false); ?>
                      <?php endif; ?>
                    </div>
                    <div class="card__content">
                      <div class="card__headline"><?php echo get_the_title($post_id); ?></div>
                      <div class="card__bottom">
                        <div class="card__name"><?php echo $spotlight_heading; ?></div>
                        <div class="card__title"><?php echo $spotlight_subheading; ?></div>
                        <?php echo svgstore('arrow', '', 'card__arrow__icon'); ?>
                      </div>
                    </div>
                  </a>
                </div>
              <?php endif; ?>
              <?php if($i == 2): ?>
                </div>
                <div class="card__story--show">
                  <a href="<?php echo get_the_permalink($post_id); ?>" class="card__item card__item--absolute">
                  <div class="card__image">
                    <?php if ( $spotlight_image && $spotlight_image_wide ) : ?>
                      <picture>
                        <source srcset="<?php echo $spotlight_image_wide; ?>" media="(min-width: 64em)" />
                        <?php echo wp_get_attachment_image($spotlight_image, 'landing-square', false); ?>
                      </picture>
                    <?php endif; ?>
                  </div>
                  <div class="card__content">
                    <div class="card__headline"><?php echo get_the_title($post_id); ?></div>
                    <div class="card__bottom">
                      <div class="card__name"><?php echo $spotlight_heading; ?></div>
                      <div class="card__title"><?php echo $spotlight_subheading; ?></div>
                      <?php echo svgstore('arrow', '', 'card__arrow__icon'); ?>
                    </div>
                  </div>
                  </a>
              <?php endif; ?>
              <?php if($i == 3): ?>
                <div class="block-small-top card__story--show">
                  <a href="<?php echo get_the_permalink($post_id); ?>" class="card__item card__item--horizontal">
                    <div class="card__image">
                      <?php if ( $spotlight_image ) : ?>
                        <?php echo wp_get_attachment_image($spotlight_image, 'landing-square', false); ?>
                      <?php endif; ?>
                    </div>
                    <div class="card__content">
                      <div class="card__headline"><?php echo get_the_title($post_id); ?></div>
                      <div class="card__bottom">
                        <div class="card__name"><?php echo $spotlight_heading; ?></div>
                        <div class="card__title"><?php echo $spotlight_subheading; ?></div>
                        <?php echo svgstore('arrow', '', 'card__arrow__icon'); ?>
                      </div>
                    </div>
                  </a>
                </div>
              </div>
              <?php endif; ?>
              <?php if($i == 4): ?>
                </div>
                <div class="grid grid--2 card__story--show">
                  <div>
                    <div class="block-small-top">
                      <a href="<?php echo get_the_permalink($post_id); ?>" class="card__item card__item--horizontal">
                        <div class="card__image">
                          <?php if ( $spotlight_image ) : ?>
                            <?php echo wp_get_attachment_image($spotlight_image, 'landing-square', false); ?>
                          <?php endif; ?>
                        </div>
                        <div class="card__content">
                          <div class="card__headline"><?php echo get_the_title($post_id); ?></div>
                          <div class="card__bottom">
                            <div class="card__name"><?php echo $spotlight_heading; ?></div>
                            <div class="card__title"><?php echo $spotlight_subheading; ?></div>
                            <?php echo svgstore('arrow', '', 'card__arrow__icon'); ?>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
              <?php endif; ?>
              <?php if($i == 5): ?>
                <div>
                  <div class="block-small-top">
                    <a href="<?php echo get_the_permalink($post_id); ?>" class="card__item card__item--horizontal">
                      <div class="card__image">
                        <?php if ( $spotlight_image ) : ?>
                          <?php echo wp_get_attachment_image($spotlight_image, 'landing-square', false); ?>
                        <?php endif; ?>
                      </div>
                      <div class="card__content">
                        <div class="card__headline"><?php echo get_the_title($post_id); ?></div>
                        <div class="card__bottom">
                          <div class="card__name"><?php echo $spotlight_heading; ?></div>
                          <div class="card__title"><?php echo $spotlight_subheading; ?></div>
                          <?php echo svgstore('arrow', '', 'card__arrow__icon'); ?>
                        </div>
                      </div>
                    </a>
                  </div>
                </div>
              </div>
              <?php endif; ?>
            <?php $i++;?>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
  </div>
</section>
