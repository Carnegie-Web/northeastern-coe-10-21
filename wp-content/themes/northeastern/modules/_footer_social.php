<ul class="footer__social">
	<?php while (have_rows('social_links', 'options')) : the_row(); ?>
	  <?php $link = get_sub_field('link'); ?>
	  <li class="footer__social__item">
	    <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="footer__social__link"><?php echo svgstore(strtolower($link['title']),strtolower($link['title']), '') ?>
	    </a>
	  </li>
	<?php endwhile; ?>
</ul>