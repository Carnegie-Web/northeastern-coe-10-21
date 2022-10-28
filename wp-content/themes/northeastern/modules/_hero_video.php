<?php $img = get_field('background_image_desktop'); ?>
<?php $imgDesktopAttributes = wp_get_attachment_image_src($img, 'department-hero-desktop', false); ?>
<?php $imgMobile = get_field('background_image_mobile'); ?>
<?php $heading = get_field('heading'); ?>
<?php $video = get_field('background_video'); ?>
<?php if ( $img && $imgMobile && $video ) : ?>
<section class="hero hero--video" aria-label="Hero">

  <div class="hero__image">
    <picture>
      <source srcset="<?php echo $imgDesktopAttributes[0]; ?>" media="(min-width: 48em)" />
      <?php echo wp_get_attachment_image($imgMobile, 'department-hero-mobile', false); ?>
    </picture>
    <div class="hero__video">
      <video muted loop autoplay playsinline>
        <source src="javascript:void(0)" data-src="<?php echo $video; ?>" type="video/mp4" />
      </video>
    </div>
  </div>

  <?php if ( $heading ) : ?>
    <div class="hero__content">
      <div class="hero__container container">
        <div class="hero__headline-alt">
          <?php echo $heading; ?>
        </div>
      </div>
    </div>
  <?php endif; ?>
</section>
<?php endif; ?>