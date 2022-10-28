<div class="block">
  <div class="container--beige">
    <div class="block__inner">
      <?php if (get_sub_field('heading')) : ?>
        <h3><?php the_sub_field('heading'); ?></h3>
      <?php endif; ?>
      <?php the_sub_field('content'); ?>

      <?php $link = get_sub_field('link'); ?>
      <?php if ($link) : ?>
        <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="button button--inline-block button--black-red">
          <span class="button__text"><?php echo $link['title']; ?></span>
          <span class="button__arrow">
            <?php echo svgstore('arrow', '', '') ?>
          </span>
        </a>
      <?php endif; ?>
    </div>
  </div>
</div>

