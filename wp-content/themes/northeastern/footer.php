<?php $blog_id = get_current_blog_id(); ?>
    <footer class="footer">
      <?php if ( $blog_id == '1' ) : ?>
        <?php get_template_part('modules/_footer'); ?>
      <?php else : ?>
        <?php get_template_part('modules/_footer_department'); ?>
      <?php endif; ?>
      <div class="footer__bottom">
      </div>
      <?php get_template_part('modules/_university_footer'); ?>
    </footer>
  </div>
    <?php wp_footer(); ?>
  </body>

</html>
