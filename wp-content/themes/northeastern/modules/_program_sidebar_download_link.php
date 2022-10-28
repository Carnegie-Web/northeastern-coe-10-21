<?php 
$file = get_sub_field('file');
$link = get_sub_field('link');
$linktype = get_sub_field('link_type');
if( $linktype == 'download' ) : ?>
  <?php if( $file ): ?>
    <br/>
    <a href="<?php echo $file['url']; ?>" target="_blank" class="cta__link">
    	<?php echo svgstore('download', 'Download File', 'cta__link__icon') ?>

    	<span><?php the_sub_field('link_text'); ?></span>
    </a>
  <?php endif; ?>
<?php else : ?>
  <?php if( $link ): ?>
    <br/>
    <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="button button--black-red button--block">
      <span class="button__text">
        <?php echo $link['title']; ?>
      </span>
      <?php echo svgstore('arrow', '', 'button__arrow'); ?>
    </a>
  <?php endif; ?>
<?php endif; ?>
