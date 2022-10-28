<section class="hero hero--slider" aria-label="Hero">
  <?php while (have_rows('slides')) : the_row(); ?>
    <?php $img = get_sub_field('image_desktop'); ?>
    <?php $imgDesktopAttributes = wp_get_attachment_image_src($img, 'department-hero-desktop', false); ?>
    <?php $imgMobile = get_sub_field('image_mobile'); ?>
    <?php $heading = get_sub_field('heading'); ?>
    <?php $caption = get_sub_field('caption'); ?>
    <?php $video = get_sub_field('video'); ?>
    <?php $link = get_sub_field('link'); ?>
    <?php $video_button_text = get_sub_field('video_button_text'); 
    $video_button_text = $video_button_text ? $video_button_text : 'Watch Video';
    ?>
    
    <?php if ( $img ) : ?>
      <div class="hero__slide">
        <div class="hero__image">
          <picture>
            <source srcset="<?php echo $imgDesktopAttributes[0]; ?>" media="(min-width: 48em)" />
            <?php echo wp_get_attachment_image($imgMobile, 'department-hero-mobile', false); ?>
          </picture>
        </div>
        <?php if($heading || $caption || $video): ?>
          <div class="hero__content">
            <div class="hero__container container">
              <?php if($heading) : ?>
                <div class="hero__headline-alt">
                  <?php the_sub_field('heading'); ?>
                </div>
              <?php endif; ?>
              <?php if($caption) : ?>
                <p class="hero__paragraph">
                  <?php the_sub_field('caption'); ?>
                </p>
              <?php endif; ?>
              <?php if($video) : ?>
                <a href="<?php echo $video; ?>" class="hero__btn" data-minimodal>
                  <?php echo svgstore('video', '', 'hero__btn__icon') ?>
                  <span class="hero__btn__text"><?php echo $video_button_text; ?></span>
                </a>
              <?php elseif($link) : ?>
                <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="hero__btn">
                  <span class="hero__btn__text"><?php echo $link['title']; ?></span>
                </a>
              <?php endif; ?>
            </div>
          </div>
        <?php endif; ?>
      </div>
    <?php endif; ?>
  <?php endwhile; ?>  
</section>