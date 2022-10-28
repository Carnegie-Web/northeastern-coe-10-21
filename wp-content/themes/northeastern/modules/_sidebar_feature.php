<?php 
  $img = get_sub_field('image'); 
  $link = get_sub_field('link');
?>

<div class="sidebar__panel">
  <?php if ( $img ) : ?>
    <?php echo wp_get_attachment_image($img, 'sidebar-feature', false); ?>
  <?php endif; ?>

  <?php if (get_sub_field('heading')) : ?>
    <h3><?php the_sub_field('heading'); ?></h3>
  <?php endif; ?>
  <?php if (get_sub_field('teaser')) : ?>
    <?php the_sub_field('teaser'); ?>
  <?php endif; ?>
  <?php if ($link) : ?>
      <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="button button--inline-block button--black-red">
        <span class="button__text"><?php echo $link['title']; ?></span>
        <span class="button__arrow">
          <?php echo svgstore('arrow', '', '') ?>
        </span>
      </a>
  <?php endif; ?>
</div>