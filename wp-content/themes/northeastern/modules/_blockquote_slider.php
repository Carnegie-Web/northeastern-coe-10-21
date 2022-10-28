<div class="block--top">
  <div class="block-spacing">
    <div class="blockquote--slider">
      <?php while(have_rows('quotes')): the_row(); ?>
        <div class="blockquote__slide">
          <blockquote class="blockquote">
            <q class="h2"><?php the_sub_field('quote'); ?></q>
            <cite>
              <?php the_sub_field('attribution'); ?>
            </cite>
          </blockquote>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</div>
