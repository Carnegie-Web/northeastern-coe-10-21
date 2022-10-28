<?php 
$video_url = get_sub_field('video_url');
$image = get_sub_field('image'); 
$image_alignment = get_sub_field('image_alignment');
$caption = get_sub_field('caption');?>


<?php if ($image_alignment == 'left' || $image_alignment == 'right') : ?>
	<div class="align-<?php echo $image_alignment; ?> zero">
<?php endif; ?>
	<figure class="image__container<?php if (strlen(get_sub_field('video_url')) > 0) { echo " media__image"; } ?>">
		<div class="image">
			<?php if( !empty($image) ): ?>
				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
			<?php endif; ?>
			<?php if ($video_url) : ?>
				<a href="<?php echo $video_url ?>" class="media__btn" data-minimodal="">
				  <?php echo svgstore('play', 'Play Video', 'media__btn__icon') ?>
		        </a>
	        <?php endif ?>
		</div>
		<?php if ($caption) : ?>
			<figcaption class="image__caption">
			  <?php echo $caption; ?>
			</figcaption>
		<?php endif ?>
	</figure>
<?php if ($image_alignment == 'left' || $image_alignment == 'right') : ?>
	</div>
<?php endif; ?>