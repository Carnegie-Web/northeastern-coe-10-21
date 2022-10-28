<?php $img = get_field('image_desktop'); ?>
<?php $imgDesktopAttributes = wp_get_attachment_image_src($img, 'landing-hero-desktop', false); ?>
<?php $imgMobile = get_field('image_mobile'); ?>
<?php $heading = get_field('hero_title'); ?>

<?php if ( $img && $imgMobile ) : ?>
  <section class="hero hero--landing" aria-label="Hero">
    <div class="hero__image">
      
      <picture>
        <source srcset="<?php echo $imgDesktopAttributes[0]; ?>" media="(min-width: 48em)" />
        <?php echo wp_get_attachment_image($imgMobile, 'landing-hero-mobile', false); ?>
      </picture>
      
    </div>
    <?php if ( $heading ) :?>
      <div class="hero__content">
        <div class="hero__container container">
          <h1 class="hero__headline">
            <?php echo $heading; ?>
          </h1>
        </div>
      </div>
    <?php endif; ?>
  </section>
<?php endif; ?>