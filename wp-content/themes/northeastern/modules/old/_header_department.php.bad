<?php $search_url = get_field('search_url', 'option'); ?>
<header class="header <?php if (is_page_template( 'page--program-finder.php' )) : ?>header--alt<?php endif; ?>">
  <div class="header__small">
    <a href="<?php bloginfo('url'); ?>" class="header__logo">
      
      <?php bloginfo('name'); ?>
      
    </a>
    <button class="header__small__btn toggle-menu">
      <span></span>
    </button>
  </div>
  <div class="header__menu">
    <div class="header__menu__container">
      <form class="search" action="<?php echo $search_url; ?>">
  <div class="container">
    <div class="search__container">
      <label for="site-search" class="hide">Search</label>
      <input id="site-search" name="q" type="search" class="search__input" placeholder="Search">
      <button class="search__btn">
  <?php echo svgstore('search', 'Submit Search', 'search__btn__icon') ?>
</button>
    </div>
  </div>
</form>
      
      <div class="topbar">
<?php
  if ( has_nav_menu( 'actions' ) ) {
    wp_nav_menu([
      'theme_location' => 'actions',
      'container' => '',
      'depth' => 1,
      'menu_class' => 'topbar__cta',
      'walker' => new Actions_Nav_Walker(),
    ]);
  }
?>
  <ul class="topbar__nav">
    <li class="topbar__nav__item">
      <a href="#" class="topbar__nav__link">Find Faculty &amp; Staff</a>
    </li>
    <li class="topbar__nav__item">
      <button class="topbar__btn toggle-info">
        <span class="topbar__btn__text">Info For</span>
        
 
<?php echo svgstore('dropdown', 'Toggle Info', 'topbar__btn__icon--dropdown') ?>
      </button>
      <div class="mega">
  <div class="container">
    <button class="mega__btn">
      
  <?php echo svgstore('dropdown', 'Return to Menu', 'mega__btn__icon') ?>

      <span class="mega__btn__text">Menu</span>
    </button>
    <?php
    if ( has_nav_menu( 'audience' ) ) {
      wp_nav_menu([
        'theme_location' => 'audience',
        'container' => '',
        'depth' => 1,
        'menu_class' => 'mega__list',
        'walker' => new Mega_Nav_Walker(),
      ]);
    }
    ?>
  </div>
</div>
    </li>
    <li class="topbar__nav__item">
      <button class="topbar__btn toggle-search">
        <span class="topbar__btn__text">Search</span>
        
  <?php echo svgstore('search', 'Open Search', 'topbar__btn__search--open') ?>

        
  <?php echo svgstore('cross', 'Close Search', 'topbar__btn__search--close') ?>

      </button>

    </li>
  </ul>
  

</div>
<div class="menu">
  
  <div class="menu__top__group">
    <div class="menu__headline"><a href="<?php bloginfo('url'); ?>" class="header__logo--large"><?php bloginfo('name'); ?></a></div>
    <a href="<?php echo network_site_url(); ?>" class="menu__logo--dept">
      <?php echo svgstore('logo-small', 'Northeastern University College of Engineering', '') ?>
    </a>
  </div>

  <?php
  if ( has_nav_menu( 'header' ) ) {
    wp_nav_menu([
      'theme_location' => 'header',
      'container' => '',
      'depth' => 2,
      'menu_class' => 'menu__list',
      'walker' => new Header_Nav_Walker(),
    ]);
  }
  ?>
  
</div>
    </div>
  </div>
</header>