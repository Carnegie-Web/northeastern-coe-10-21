<?php $heading_level = get_sub_field('heading_level'); ?>
<?php $heading = get_sub_field('heading'); ?>
<?php 
$count = count(get_sub_field('stats'));
$style = get_sub_field('style'); ?>
<?php if($style == 'standard'): ?>
  <hr>
<?php endif; ?>
<div class="block">
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
  <div class="block-small">
    <div class="grid grid--<?php echo $count; ?> grid--slider">
      <?php while(have_rows('stats')): the_row(); ?>
        <?php $color = get_sub_field('color'); ?>
        <div class="text-center animate-In">
          <div class="stats__headline text-<?php echo $color; ?>">
            <?php the_sub_field('number'); ?>
          </div>
          <p class="text-<?php echo $color; ?>">
            <strong>
              <?php the_sub_field('label'); ?>
            </strong>
          </p>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>
<hr>
