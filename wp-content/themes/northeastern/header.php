<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <script src="https://cdn.jsdelivr.net/npm/@northeastern-web/global-elements@%5E1.0.0/dist/js/index.umd.js" defer></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@northeastern-web/global-elements@%5E1.0.0/dist/css/index.css">
  <script src="https://cdn.jsdelivr.net/npm/@northeastern-web/kernl-ui@%5E2.0.0-alpha.44/dist/js/index.umd.js" defer></script>

  <?php extract($args); ?>
  <?php 
    if ($header_var && $header_var=='noindex') {
        echo "<meta name='robots' content='noindex, nofollow'>";
    } else {
      //do nothing
    }
  ?>
  <?php wp_head(); ?>

</head>
<?php $blog_id = get_current_blog_id(); ?>
<body <?php body_class(); ?>>
	  <nav aria-label="Skip Navigation"><a class="skip-link" href="#main-content">Skip Navigation</a></nav>

  <div class="canvas">
    <?php get_template_part('modules/_university_header'); ?>
    <?php if ( $blog_id == '1' ) : ?>
      <?php get_template_part('modules/_header'); ?>
    <?php else : ?>
      <?php get_template_part('modules/_header_department'); ?>
    <?php endif; ?>
