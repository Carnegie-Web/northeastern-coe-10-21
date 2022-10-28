<?php 

$file = get_sub_field('file');

if( $file ): ?>
	<div class="block-small zero">
		<a href="<?php echo $file['url']; ?>" target="_blank" class="cta__link">
			<?php echo svgstore('download', 'Download File', 'cta__link__icon') ?>

			<span><?php the_sub_field('link_text'); ?></span>
		</a>
	</div>
<?php endif; ?>