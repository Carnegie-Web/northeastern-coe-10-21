<?php
  /*
    Template Name: Homepage
    Template Post Type: page
  */
?>

<?php get_header(); ?>
<main id="main-content">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php $type = get_field('hero_type'); ?>
    <?php if($type == 'image'): ?>
      <section class="hero hero--home" aria-label="Hero">
        <?php $overlay_text = get_field('hero_overlay'); ?>
        <?php $index = 1; ?>
        <?php while(have_rows('hero_image_slider')): the_row(); ?>
          <?php $img = get_sub_field('image'); ?>
          <div class="hero__background" id="background-<?php echo $index; ?>">
            <?php echo wp_get_attachment_image($img, 'home-hero-desktop', false); ?>
          </div>
          <?php $index++; ?>
        <?php endwhile; wp_reset_postdata(); ?>
        <div class="hero__container container--relative container">
          <?php if ($overlay_text): ?>
            <div class="hero__headline">
              <?php echo $overlay_text; ?>
            </div>
          <?php endif; ?>
          <ul class="hero__nav">
            <?php $index = 1; ?>
            <?php while(have_rows('hero_image_slider')): the_row(); ?>
              <li class="hero__item">
                <?php $link = get_sub_field('link'); ?>
                <?php if($link): ?>
                  <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="hero__link" data-id="background-<?php echo $index; ?>">
                    <span class="hero__category"><?php the_sub_field('eyebrow'); ?></span>
                    <span class="hero__text__wrap">
                      <span class="hero__text"><?php echo $link['title']; ?></span>
                      <?php echo svgstore('arrow', '', 'hero__link__icon') ?>
                    </span>
                  </a>
                <?php endif; ?>
              </li>
              <?php $index++; ?>
            <?php endwhile; wp_reset_postdata(); ?>
          </ul>
        </div>
      </section>
    <?php else: ?>
      <?php while(have_rows('video_hero')): the_row(); ?>
        <?php $img = get_sub_field('background_image_desktop'); ?>
        <?php $imgDesktopAttributes = wp_get_attachment_image_src($img, 'department-hero-desktop', false); ?>
        <?php $imgMobile = get_sub_field('background_image_mobile'); ?>
        <?php $heading = get_sub_field('heading'); ?>
        <?php $video = get_sub_field('background_video'); ?>
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
      <?php endwhile; ?>
    <?php endif; ?>

    <?php while(have_rows('text_and_link_block_1')): the_row(); ?>
      <?php get_template_part('modules/_text_and_links'); ?>
    <?php endwhile; ?>

    <?php while(have_rows('spotlight_feature')): the_row(); ?>
      <?php get_template_part('modules/_home_spotlight_feature'); ?>
    <?php endwhile; ?>

    <?php while(have_rows('highlights')): the_row(); ?>
      <section class="container--black" aria-label="Research">
        <div class="container">
          <div class="block-spacing">
            <div class="grid grid--2-3 grid--middle">
              <div class="zero">
                <?php the_sub_field('heading'); ?>
              </div>
              <?php $hlink = get_sub_field('heading_link'); ?>
              <?php if($hlink): ?>
                <div class="button-text-right">
                  <a href="<?php echo $hlink['url']; ?>" <?php link_target($hlink); ?> class="button button--block">
                    <span class="button__text text-white"><?php echo $hlink['title']; ?></span>
                    <span class="button__arrow button__arrow--red">
                      <?php echo svgstore('arrow', '', ''); ?>
                    </span>
                  </a>
                </div>
              <?php endif; ?>
            </div>
            <?php if(have_rows('links')): ?>
              <div class="block--top">
                <ul class="button__grid">
                  <?php while(have_rows('links')): the_row(); ?>
                    <?php $link = get_sub_field('link'); ?>
                    <li><a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="button button--solid">
                      <span class="button__text button__text--lg"><?php echo $link['title']; ?></span>
                      <span class="button__arrow">
                        <?php echo svgstore('arrow', '', ''); ?>
                      </span>
                    </a></li>
                  <?php endwhile; ?>
                </ul>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </section>
    <?php endwhile; ?>

    <?php if(have_rows('features_carousel')): ?>
      <section class="container--beige">
        <?php while(have_rows('features_carousel')): the_row(); ?>
          <?php get_template_part('modules/_features_carousel'); ?>
        <?php endwhile; ?>
      </section>
    <?php endif; ?>

    <?php while(have_rows('programs')): the_row(); ?>
      <section class="container" aria-label="Programs">
        <div class="block-spacing">
          <div class="container--narrow zero">
            <?php the_sub_field('heading'); ?>
          </div>
          <div class="block">
            <div class="button-group button-group-alt">
              <?php while(have_rows('links')): the_row(); ?>
                <?php $link = get_sub_field('link'); ?>
                <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="button button--solid-red animate-In">
                  <span class="button__text--xlg"><?php echo $link['title']; ?></span>
                  <span class="button__arrow">
                    <?php echo svgstore('arrow', '', ''); ?>
                  </span>
                </a>
              <?php endwhile; ?>
            </div>
          </div>
          <div class="grid grid--4">
            <?php while(have_rows('image_links')): the_row(); ?>
              <?php $link = get_sub_field('link'); ?>
              <div class="animate-In">
                <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="card__item card__item--program">
                  <div class="card__image">
                    <?php echo wp_get_attachment_image(get_sub_field('image'), 'card-image', false); ?>
                  </div>
                  <div class="card__content">
                    <div class="button button--black-red">
                      <span class="button__text"><?php echo $link['title']; ?></span>
                      <span class="button__arrow">
                        <?php echo svgstore('arrow', '', ''); ?>
                      </span>
                    </div>
                  </div>
                </a>
              </div>
            <?php endwhile; ?>
          </div>
        </div>
      </section>
    <?php endwhile; ?>

    <?php while(have_rows('spotlight_grid')): the_row(); ?>
      <?php get_template_part('modules/_home_spotlight_grid'); ?>
    <?php endwhile; ?>

    <?php while(have_rows('single_image_feature')): the_row(); ?>
      <section class="container">
        <div class="block-spacing">
          <div class="feature__item feature__item--swap">
            <div class="feature__content container--red animate-In">
              <?php the_sub_field('heading'); ?>
              <div class="button-group">
                <?php while(have_rows('links')): the_row(); ?>
                  <?php $link = get_sub_field('link'); ?>
                  <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="button text-white">
                    <span class="button__text"><?php echo $link['title']; ?></span>
                    <span class="button__arrow">
                      <?php echo svgstore('arrow', '', ''); ?>
                    </span>
                  </a>
                <?php endwhile; ?>
              </div>
            </div>
            <div class="feature__media animate-In">
              <div class="feature__image ">
                <?php echo wp_get_attachment_image(get_sub_field('image'), 'feature-slider', false); ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php endwhile; ?>

    <?php while(have_rows('text_and_link_block_2')): the_row(); ?>
      <?php get_template_part('modules/_text_and_links'); ?>
    <?php endwhile; ?>

  <?php endwhile; endif; wp_reset_postdata(); ?>
</main>
<?php get_footer(); ?>
