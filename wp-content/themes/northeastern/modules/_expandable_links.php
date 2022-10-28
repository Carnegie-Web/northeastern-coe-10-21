<?php 
$count = count(get_sub_field('expandable_links'));
if($count > 3 ) {
  $class = ' grid--4';
} elseif($count == 2) {
  $class = ' grid--2';
} elseif($count == 1) {
  $class = ' grid--1';
} else {
  $class = '';
}

?>
<section class="container--beige expand__container--list" aria-label="link group">
  <div class="container expand__container__group--list">
    <div class="block-spacing">
      <div class="grid<?php echo $class; ?>">
        <?php while(have_rows('expandable_links')): the_row(); ?>
          <div class="expand__grid__item">
            <button class="expand__accordion__toggle">
              <h4 class="h4-border expand__headline">
                <?php echo svgstore('cross', 'Toggle Accordion', 'expand__accordion__toggle__icon'); ?>
                <span class="expand__accordion__toggle__text">
                  <?php the_sub_field('heading'); ?>
                </span>
              </h4>
            </button>
            <div class="expand__accordion__content">
              <div class="expand__accordion__interior">
                <div class="button-group">
                  <?php while(have_rows('links')): the_row(); ?>
                    <?php $link = get_sub_field('link'); ?>
                    <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="list__link">
                      <?php echo $link['title']; ?>
                    </a>
                  <?php endwhile; ?>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
  <button class="expand__btn expand__btn--list">
    <?php echo svgstore('plus', 'Expand Section', 'expand__button--open'); ?>
    <?php echo svgstore('minus', 'Collapse Section', 'expand__button--close'); ?>
  </button>
</section>
