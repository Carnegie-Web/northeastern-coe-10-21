<?php if (is_singular('news')) : ?>
  <div class="postmeta">
    <div class="postmeta__timestamp">
      <?php echo get_the_date(); ?>
    </div>
    <div class="postmeta__tags">
      <?php the_terms($post->ID, 'news_tag', 'Tags: '); ?>
    </div>
  </div>
<?php endif; ?>