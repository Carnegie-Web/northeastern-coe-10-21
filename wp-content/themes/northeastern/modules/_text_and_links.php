<?php $teaser = get_sub_field('teaser'); ?>

<section class="container" aria-label="Path">
  <div class="block-spacing">

<?php if (is_page_template( 'page--program.php' )) : ?>
  <div class="grid grid--3-2">
    <div class="zero">
      <?php the_sub_field('heading'); ?>
    </div>
    <div>
      <?php if($teaser): ?>
        <p>
          <?php the_sub_field('teaser'); ?>
        </p>
      <?php endif; ?>
      <div class="button-group button-group-2 button-group-alt">
        <ul>
          <?php while(have_rows('links')): the_row(); ?>
            <?php $link = get_sub_field('link'); ?>
            <li>
              <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="button button--black-red">
                <span class="button__text"><?php echo $link['title']; ?></span>
                <span class="button__arrow">
                  <?php echo svgstore('arrow', '', ''); ?>
                </span>
              </a>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>
    </div>
  </div>
<?php else : ?>
  <?php if($teaser): ?>
    <div class="grid grid--2-3">
      <div class="zero">
        <?php the_sub_field('heading'); ?>
        <?php the_sub_field('teaser'); ?>
      </div>
    <?php else: ?>
      <div class="grid grid--2-3 grid--middle">
        <div class="zero">
          <?php the_sub_field('heading'); ?>
        </div>
    <?php endif; ?>
    <div>
      <div class="button-group">
        <?php while(have_rows('links')): the_row(); ?>
          <?php $link = get_sub_field('link'); ?>
          <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="button button--black-red">
            <span class="button__text"><?php echo $link['title']; ?></span>
            <span class="button__arrow">
              <?php echo svgstore('arrow', '', ''); ?>
            </span>
          </a>
        <?php endwhile; ?>
      </div>
    </div>
  </div>
<?php endif; ?>

  </div>
</section>
