<div class="container">
  <div class="block-spacing">
    <?php while(have_rows('announcements')): the_row(); ?>
      <?php $img = get_sub_field('image'); ?>
      
      <?php if (get_row_index() != 1) : ?>
        <div class="block--top">
      <?php endif; ?>
      <?php if($img): ?>
        <div class="grid grid--3-2">
          <div>
            <?php echo wp_get_attachment_image($img, 'announcement', false, array( "class" => "vertical-line-desktop" )); ?>
                      </div>
          <div>
            <h3><?php the_sub_field('heading'); ?></h3>
            <p class="text-white"><?php the_sub_field('teaser'); ?></p>
            <?php $link = get_sub_field('link'); ?>
            <?php if ( $link ) : ?>
              <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="button button--inline-block text-white">
                <span class="button__text">
                  <?php echo $link['title']; ?>
                </span>
                <span class="button__arrow button__arrow--red">
                  <?php echo svgstore('arrow', '', ''); ?>
                </span>
              </a>
            <?php endif; ?>
          </div>
        </div>
      <?php else: ?>
          <div class="container--narrow">
            <div class="vertical-line-desktop">
              <h3><?php the_sub_field('heading'); ?></h3>
              <p class="text-white"><?php the_sub_field('teaser'); ?></p>
              <?php $link = get_sub_field('link'); ?>
              <?php if ( $link ) : ?>
                <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="button button--inline-block text-white">
                  <span class="button__text">
                    <?php echo $link['title']; ?>
                  </span>
                  <span class="button__arrow button__arrow--red">
                    <?php echo svgstore('arrow', '', ''); ?>
                  </span>
                </a>
              <?php endif; ?>
            </div>
          </div>
      <?php endif; ?>
      <?php if (get_row_index() != 1) : ?>
        </div>
      <?php endif; ?>
    <?php endwhile; ?>
  </div>
</div>
