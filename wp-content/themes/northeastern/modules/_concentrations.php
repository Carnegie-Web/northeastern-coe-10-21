<div class="block">
  <?php while (have_rows('items')) : the_row(); ?>
    <?php $heading = get_sub_field('heading'); ?>
    <?php $img = get_sub_field('image'); ?>
    <div class="grid--push">
      <hr>
      <div class="grid grid--3-2 grid--push">
        <?php if ( $img ) : ?>
          <div>
            <?php echo wp_get_attachment_image($img, 'announcement', false); ?>
          </div>
        <?php endif; ?>
        <div>
          <?php if($heading): ?>
            <div class="h5"><?php echo $heading; ?></div>
          <?php endif; ?>
          <p>
            <?php the_sub_field('content'); ?>
          </p>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
</div>