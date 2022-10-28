<?php 
$video_url = get_sub_field('video_url');
$image = get_sub_field('image'); 
$caption = get_sub_field('caption');?>
<section class="container--border" aria-label="experiential learning">
    <div class="container">
      <div class="block-spacing">
        <div class="grid grid--2">
          <div class="zero block-small-bottom">
            <h2><?php the_sub_field('heading'); ?></h2>
            <p>
              <?php the_sub_field('content'); ?>
            </p>
          </div>
          <div class="zero">
            <figure class="image__container<?php if (strlen(get_sub_field('video_url')) > 0) { echo " media__image"; } ?>">
              <div class="image">
                <?php if( !empty($image) ): ?>
                  <img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
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
          </div>
        </div>
      </div>
    </div>
  </section>