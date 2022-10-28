<?php $heading_level = get_sub_field('heading_level'); ?>
<?php $heading = get_sub_field('heading'); ?>
<?php $teaser = get_sub_field('teaser'); ?>
<?php $view_all = get_sub_field('view_all'); ?>
<div class="block">
  <div class="grid grid--2-3 grid--middle">
    <div class="zero">
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
      <?php if($teaser): ?>
        <p><?php echo $teaser; ?></p>
      <?php endif; ?>
    </div>
      <div class="button-text-right">
        <?php if($view_all): ?>
          <a href="<?php echo $view_all['url']; ?>" <?php link_target($view_all); ?> class="button button--black-red button--block">
            <span class="button__text"><?php echo $view_all['title']; ?></span>
            <span class="button__arrow">
              <?php echo svgstore('arrow', '', ''); ?>
            </span>
          </a>
        <?php endif; ?>
      </div>
  </div>
  <?php if(have_rows('cards')): ?>
    <ul class="program__list">
      <?php while(have_rows('cards')): the_row(); ?>
        <li class="program__item animate-In">
          <?php $link = get_sub_field('link'); ?>
          <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="program__card">
            <span class="program__image">
              <?php echo wp_get_attachment_image(get_sub_field('image'), 'landing-square', false); ?>
            </span>
            <span class="button text-white">
              <span class="button__text"><?php echo $link['title']; ?></span>
              <span class="button__arrow">
                <span class="button__arrow">
                  <?php echo svgstore('arrow', '', ''); ?>
                </span>
              </span>
            </span>
            <div class="program__gradient"></div>
          </a>
          <p><?php the_sub_field('teaser'); ?></p>
        </li>
      <?php endwhile; ?>
    </ul>
  <?php endif; ?>
</div>
<hr>
