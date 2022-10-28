<div class="footer__top">
  <div class="container">
    <div class="grid grid--tight">
      <div class="footer__top__grid">
        <h3 class="text-white"><?php bloginfo('name'); ?></h3>
      </div>
      <div class="footer__top__grid">
        <span class="category text-white">Connect with COE</span>
        <?php get_template_part('modules/_footer_social'); ?>
      </div>
      <div class="footer__top__grid">
        <?php $link = get_field('footer_button', 'option'); ?>
        <?php if ( $link ) : ?>
          <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="button button--inline-block text-white">
            <span class="button__text"><?php echo $link['title']; ?></span>
            <span class="button__arrow"><?php echo svgstore('arrow', '', '') ?></span>
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</div>