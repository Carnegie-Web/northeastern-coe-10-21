<div class="sidebar__panel">
  <div class="h5">
    <?php echo get_sub_field('heading'); ?>
  </div>
  <ul class="caption__link__list">
    <?php while(have_rows('links')): the_row(); ?>
      <?php $link = get_sub_field('link'); ?>
      <li>
        <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="caption__link">
        <?php echo $link['title']; ?>
        </a>
      </li>
    <?php endwhile; ?>
  </ul>
</div>