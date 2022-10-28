<div class="block-small zero">
  <?php if (get_sub_field('heading')) : ?>
    <div class="h5"><?php the_sub_field('heading'); ?></div>
  <?php endif; ?>
    <div class="tabbed tabbed--default tabbed--<?php echo count(get_sub_field('tabs')); ?>">
    <div class="tabbed__nav">
      <ul class="tabbed__nav__list">
        <?php while (have_rows('tabs')) : the_row(); ?>
          <li class="tabbed__nav__item">
            <?php if(strlen(get_sub_field('tab_title')) > 0): ?>
              <button class="tabbed__nav__button"><?php the_sub_field('tab_title'); ?></button>
            <?php endif; ?>
          </li>
        <?php endwhile; ?>
      </ul>
    </div>
    <div class="tabbed__content">
      <div class="tabbed__main">
        <?php while (have_rows('tabs')) : the_row(); ?>
          <?php if(strlen(get_sub_field('tab_title')) > 0): ?>
            <button class="accordion__toggle tabbed__toggle"><?php the_sub_field('tab_title'); ?></button>
          <?php endif; ?>
          <div class="tabbed__content__item">
            <div class="tabbed__content__interior">
              <?php the_sub_field('tab_content'); ?>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
</div>