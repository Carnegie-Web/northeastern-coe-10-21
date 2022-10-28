<section class="container" aria-label="overview">
    <div class="block container--clear">
      <div class="main__content">
        <div class="zero">
          <?php 
          $overview_heading = get_field('overview_heading');
          $overview_intro = get_field('overview_intro');
          $img = get_field('overview_image'); 
          $caption = get_field('overview_image_caption');
          $video_url = get_field('overview_image_video_url');
          ?>
          <?php if ( $overview_heading ) : ?>
            <h2><?php echo $overview_heading; ?></h2>
          <?php endif; ?>
          <?php if ( $overview_heading ) : ?>
            <p class="p-intro">
              <?php echo $overview_intro; ?>
            </p>
          <?php endif; ?>
          <?php if ( !empty($img) ) : ?>
            <div class="button-group button-group-2 button-group-alt">
              <ul>
                <?php while(have_rows('overview_links')): the_row(); ?>
                  <?php $link = get_sub_field('link'); ?>
                  <li>
                    <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="button button--black-red">
                    <span class="button__text"><?php echo $link['title']; ?></span>
                    <span class="button__arrow">
                      <?php echo svgstore('arrow', '', '') ?>
                    </span>
                    </a>
                  </li>
                <?php endwhile; ?>
              </ul>
            </div>
          <?php endif; ?>
        </div>
      </div>
      <div class="main__sidebar zero">
        <?php if ( !empty($img) ) : ?>
          <figure class="image__container media__image">
          <div class="image">
            <?php if( !empty($img) ): ?>
              <?php echo wp_get_attachment_image($img, 'program-overview', false); ?>
            <?php endif; ?>
            <?php if ($video_url) : ?>
              <a href="<?php echo $video_url ?>" class="media__btn" data-minimodal="">
                <?php echo svgstore('play', 'Play Video', 'media__btn__icon') ?>
              </a>
            <?php endif ?>
          </div>
          <?php if ($caption) : ?>
            <figcaption class="image__caption">
              <?php echo $caption; ?>
            </figcaption>
          <?php endif ?>
        </figure>
        <?php else : ?>
          <div class="button-group button-group-alt">
            <?php while(have_rows('overview_links')): the_row(); ?>
              <?php $link = get_sub_field('link'); ?>
              <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="button button--black-red">
                <span class="button__text"><?php echo $link['title']; ?></span>
                <span class="button__arrow">
                  <?php echo svgstore('arrow', '', '') ?>
                </span>
              </a>
            <?php endwhile; ?>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </section>