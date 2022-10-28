<?php if (!get_field('hide_breadcrumbs')) : ?>
  <nav class="breadcrumb" aria-label="breadcrumb">
    <a href="/" class="breadcrumb__icon"><?php echo svgstore('house', 'Home', '') ?></a><span class="breadcrumb__separator">/</span>

      <?php if(function_exists('bcn_display'))
	    {
	        bcn_display();
	    }?>
  </nav>
<?php endif; ?>