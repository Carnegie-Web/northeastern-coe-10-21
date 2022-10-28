<div class="container">
  <div class="block-spacing">
    <div class="grid grid--2-3">
      <div class="zero pre-footer__grid__item">
        <h3><?php the_sub_field('title'); ?></h3>
      </div>
      <div class="pre-footer__grid__item">
        <span class="category"><?php the_sub_field('icons_label'); ?></span>

        <ul class="footer__social">
          <?php while(have_rows('social_links')): the_row(); ?>
            <?php $link = get_sub_field('link'); ?>
            <?php $type = get_sub_field('type'); ?>
            <?php if($type == 'facebook'): ?>
              <li class="footer__social__item"><a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="footer__social__link"><?php echo svgstore('facebook', 'Facebook', ''); ?></a></li>
            <?php elseif($type == 'twitter'): ?>
              <li class="footer__social__item"><a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="footer__social__link"><?php echo svgstore('twitter', 'Twitter', ''); ?></a></li>
            <?php elseif($type == 'instagram'): ?>
              <li class="footer__social__item"><a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="footer__social__link"><?php echo svgstore('instagram', 'Instagram', ''); ?></a></li>
            <?php elseif($type == 'linkedin'): ?>
              <li class="footer__social__item"><a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="footer__social__link"><?php echo svgstore('linkedin', 'LinkedIn', ''); ?></a></li>
            <?php elseif($type == 'youtube'): ?>
              <li class="footer__social__item"><a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="footer__social__link"><?php echo svgstore('youtube', 'YouTube', ''); ?></a></li>
            <?php elseif($type == 'weibo'): ?>
              <li class="footer__social__item"><a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="footer__social__link"><?php echo svgstore('weibo', 'Weibo', ''); ?></a></li>
            <?php else: ?>
              <li class="footer__social__item"><a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="footer__social__link"><?php echo svgstore('weibo', 'Weibo', ''); ?></a></li>
            <?php endif; ?>
          <?php endwhile; ?>
        </ul>
      </div>
    </div>
  </div>
</div>
