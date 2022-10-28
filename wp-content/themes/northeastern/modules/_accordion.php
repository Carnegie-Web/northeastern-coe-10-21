<div class="block-small zero">
  <?php if (get_sub_field('heading')) : ?>
    <div class="h5"><?php the_sub_field('heading'); ?></div>
  <?php endif; ?>
  <div class="accordion-group">
    <?php while (have_rows('items')) : the_row(); ?>
      <div class="accordion">
        <button class="accordion__toggle">
          <?php echo svgstore('cross', 'Toggle Accordion', 'accordion__toggle__icon') ?>
          <span class="accordion__toggle__text">
            <?php the_sub_field('heading'); ?>
          </span>
        </button>
        <div class="accordion__content">
          <div class="accordion__interior zero">
            <?php the_sub_field('content'); ?>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
</div>
