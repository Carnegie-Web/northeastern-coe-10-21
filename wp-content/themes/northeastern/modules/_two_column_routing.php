<?php $heading_level = get_sub_field('heading_level'); ?>
<?php $heading = get_sub_field('heading'); ?>
<div class="container">
  <div class="block-spacing">
    <div class="container--narrow block-center text-center zero">
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
    </div>
    <div class="block--top">
      <div class="grid grid--2">
        <?php while(have_rows('columns')): the_row(); ?>
          <div class="grid__item__spacing">
            <?php echo wp_get_attachment_image(get_sub_field('image'), 'card-image', false); ?>
            <h3><?php the_sub_field('sub_heading'); ?></h3>
            <p class="text-white">
              <?php the_sub_field('teaser'); ?>
            </p>
            <?php if(have_rows('links')): ?>
              <div class="button-group">
                <?php while(have_rows('links')): the_row(); ?>
                  <?php $link = get_sub_field('link'); ?>
                  <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="button">
                    <span class="button__text text-white"><?php echo $link['title']; ?></span>
                    <span class="button__arrow">
                      <?php echo svgstore('arrow', '', ''); ?>
                    </span>
                  </a>
                <?php endwhile; ?>
              </div>
            <?php endif; ?>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
</div>
