<?php
$count = count(get_sub_field('columns'));
if($count == 4) {
  $class = ' grid--4';
  $number = 'four';
} elseif($count == 3) {
  $class = '';
  $number = 'three';
} elseif($count == 2) {
  $class = ' grid--2';
  $number = 'two';
} elseif($count == 1) {
  $class = ' grid--1';
  $number = 'one';
} else {
  $class = ' grid--2';
  $number = 'two';
}
?>
<section class="container" aria-label="<?php echo $number; ?> column module">
  <div class="block">
    <?php $heading_level = get_sub_field('heading_level'); ?>
    <?php $heading = get_sub_field('heading'); ?>
    <?php if($heading): ?>
      <?php if($heading_level == 'h2'): ?>
        <h2><?php echo $heading; ?></h2>
      <?php elseif($heading_level == 'h3'): ?>
        <h3><?php echo $heading; ?></h3>
      <?php elseif($heading_level == 'h4'): ?>
        <h4><?php echo $heading; ?></h4>
      <?php elseif($heading_level == 'h5'): ?>
        <h5><?php echo $heading; ?></h5>
      <?php elseif($heading_level == 'h6'): ?>
        <h6><?php echo $heading; ?></h6>
      <?php endif; ?>
    <?php endif; ?>
    <div class="block-small-bottom">
      <div class="grid <?php echo $class; ?>">
        <?php while(have_rows('columns')): the_row(); ?>
          <?php $sub_heading = get_sub_field('sub_heading'); ?>
          <?php $img = get_sub_field('image'); ?>
          <?php $link_style = get_sub_field('link_style'); ?>
          <?php $link = get_sub_field('link'); ?>
          <div>
            <?php if($sub_heading): ?>
              <h4><?php echo $sub_heading; ?></h4>
            <?php endif; ?>
            <?php echo wp_get_attachment_image($img, 'card-image', false); ?>
            <p><?php the_sub_field('teaser'); ?></p>
            <?php if($link): ?>
              <?php if($link_style == 'button'): ?>
                <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="cta cta--gray">
                  <?php echo $link['title']; ?>
                </a>
              <?php else: ?>
                <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="button button--black-red button--inline-block">
                  <span class="button__text"><?php echo $link['title']; ?></span>
                  <span class="button__arrow">
                    <?php echo svgstore('arrow', '', ''); ?>
                  </span>
                </a>
              <?php endif; ?>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
</section>
