<div class="footer__top footer__top--dept">
  <div class="container">
    <div class="grid grid--tight">
      <div class="footer__top__grid">
        <h3 class="text-white"><?php bloginfo('name'); ?></h3>
        <?php get_template_part('modules/_footer_social'); ?>
      </div>
      <div class="footer__top__grid">
        <?php while (have_rows('department_footer_links', 'options')) : the_row(); ?>
          <?php $link = get_sub_field('link'); ?>
          <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="text-white button footer__link">
            <span class="button__text"><?php echo $link['title']; ?></span>
          </a>
        <?php endwhile; ?>
      </div>
      <div class="footer__top__grid">
        <?php if (is_multisite()) { switch_to_blog(1); } ?>
          <a href="<?php echo network_site_url(); ?>" class="button button--outline text-white">
              <span class="button__text"><?php bloginfo('name'); ?></span>
            <span class="button__arrow">
              <?php echo svgstore('arrow', '', '') ?>
            </span>
          </a>
        <?php if (is_multisite()) { restore_current_blog(); } ?>
      </div>
    </div>
  </div>
</div>