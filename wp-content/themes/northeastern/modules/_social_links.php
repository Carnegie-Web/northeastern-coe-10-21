<div class="block">
	<div class="sidebar__share">
	  	<?php $heading = get_sub_field('heading'); ?>
	  	<?php if ( $heading ) : ?>
	  		<span class="sidebar__share__label"><?php echo get_sub_field('heading'); ?></span>
	  	<?php endif; ?>
		<?php while (have_rows('links')) : the_row(); ?>
			<?php $link = get_sub_field('link'); ?>
			<?php $image = get_sub_field('social_icon'); ?>
		    <?php if ( $link && $image) : ?>
		      <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="st-custom-button sidebar__share__link">
		      	<?php echo wp_get_attachment_image($image, 'social-icon', false); ?>
		      </a>
		    <?php endif; ?>
		<?php endwhile; ?>
	</div>
	<hr>
</div>