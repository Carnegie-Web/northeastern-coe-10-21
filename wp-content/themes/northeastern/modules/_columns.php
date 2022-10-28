<?php 
$count = count(get_sub_field('columns'));
if($count == 4) {
  $class = ' grid--4';
} elseif($count == 3) {
  $class = '';
} elseif($count == 2) {
  $class = ' grid--2';
} elseif($count == 1) {
  $class = ' grid--1';
} else {
  $class = ' grid--2';
}
?>
<div class="block-small zero">
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
  <div class="grid<?php echo $class; ?>">
    <?php while (have_rows('columns')) : the_row(); ?>
      <div>
        <?php $column_style = get_sub_field('column_style'); ?>
        <?php if($column_style == 'border'): ?>
          <hr>
        <?php endif; ?>
        <?php if (get_sub_field('column_heading')) : ?>
          <div class="h5"><?php the_sub_field('column_heading'); ?></div>
        <?php endif; ?>
        <?php the_sub_field('content'); ?>
      </div>
    <?php endwhile; ?>  
  </div>
</div>