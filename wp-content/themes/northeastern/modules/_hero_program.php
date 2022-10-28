<?php $img = get_field('image_desktop'); ?>
<?php $imgDesktopAttributes = wp_get_attachment_image_src($img, 'program-hero-desktop', false); ?>
<?php $imgMobile = get_field('image_mobile'); ?>
<?php $heading = get_field('hero_title'); ?>
<?php $viewProgramsLink = get_field('view_programs_link'); ?>
<?php $blog_id = get_current_blog_id(); ?>
  
<section class="hero" aria-label="Hero">
  <div class="hero__image hero__image-alt">
    <?php if ( $img && $imgMobile ) : ?>
      <picture>
        <source srcset="<?php echo $imgDesktopAttributes[0]; ?>" media="(min-width: 32em)" />
        <?php echo wp_get_attachment_image($imgMobile, 'landing-hero-mobile', false); ?>
      </picture>
    <?php endif; ?>
  </div>
  <div class="hero__content-alt">
    <div class="hero__container">
      <div class="container">
        <?php get_template_part('modules/_breadcrumb'); ?>
        <?php if ( $heading ) :?>
          <h1 class="text-white"><?php echo $heading; ?></h1>
        <?php endif; ?>
      </div>
      <div class="hero__cta">
        <?php while (have_rows('cta_buttons')) : the_row(); ?>
          <?php $link = get_sub_field('link'); ?>
          <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="cta cta--red cta-half">
            <?php echo $link['title']; ?>
          </a>
        <?php endwhile; ?>
        <?php if ( $viewProgramsLink ) : ?>
          <a href="<?php echo $viewProgramsLink['url']; ?>" class="cta cta--black cta-full">
            <?php echo svgstore('filter', '', 'cta__icon') ?>
            <?php echo $viewProgramsLink['title']; ?>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</section>

<?php if ( $heading ) :?>
  <div class="program-sticky">
    <div class="container">
      <h3><?php echo $heading; ?></h3>
        <div class="hero__cta">
          <?php if ( $viewProgramsLink ) : ?>
            <a href="<?php echo $viewProgramsLink['url']; ?>" class="cta cta--black">
              <?php echo svgstore('filter', '', 'cta__icon') ?>
              <?php echo $viewProgramsLink['title']; ?>
            </a>
          <?php endif; ?>
          <?php while (have_rows('cta_buttons')) : the_row(); ?>
            <?php $link = get_sub_field('link'); ?>
            <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="cta cta--red">
              <?php echo $link['title']; ?>
            </a>
          <?php endwhile; ?>
        </div>
    </div>
  </div>
<?php endif; ?>