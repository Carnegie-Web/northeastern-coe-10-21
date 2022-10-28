<?php
// setup departments
$departments = get_terms([
  'taxonomy' => 'page_department',
  'hide_empty' => false,
]);

// setup formats
$formats = get_terms([
  'taxonomy' => 'format',
  'hide_empty' => false,
]);

// setup regional campuses
$regional_campuses = get_terms([
  'taxonomy' => 'regional_campuses',
  'hide_empty' => false,
]);

?>
<div class="finder">

  <div class="finder__intro">
    <div class="finder__intro__title">
      <h1><?php echo the_title(); ?></h1>
    </div>
    <div class="finder__intro__text">
      <?php the_content(); ?>
    </div>
  </div>

  <div class="finder__container">

    <div class="finder__side">

      <div class="finder__tabs">
        <button class="finder__tab finder__tab--filter finder__tab--active">Filter</button>
        <button class="finder__tab finder__tab--search">Search</button>
      </div>

      <div class="finder__filter finder__filter--active">
        <div class="finder__group">
          <h2 class="h5">Undergraduate</h2>
          <label class="filter__label">
            <input type="checkbox" value="BS" data-filter="level">
            <span class="filter__checkbox">Bachelor of Science (BS)</span>
          </label>
          <label class="filter__label">
            <input type="checkbox" value="Minor" data-filter="level">
            <span class="filter__checkbox">Minor</span>
          </label>
          <label class="filter__label">
            <input type="checkbox" value="BS/JD" data-filter="level">
            <span class="filter__checkbox">BS/JD</span>
          </label>
          <label class="filter__label">
            <input type="checkbox" value="PlusOne" data-filter="level">
            <span class="filter__checkbox">PlusOne</span>
          </label>
          <h2 class="h5">Graduate</h2>
          <label class="filter__label">
            <input type="checkbox" value="MS" data-filter="level">
            <span class="filter__checkbox">Master of Science (MS)</span>
          </label>
          <label class="filter__label">
            <input type="checkbox" value="PhD" data-filter="level">
            <span class="filter__checkbox">PhD</span>
          </label>
          <label class="filter__label">
            <input type="checkbox" value="Graduate Certificate" data-filter="level">
            <span class="filter__checkbox">Graduate Certificate</span>
          </label>
        </div>
        <div class="finder__group">
          <h2 class="h5">Departments</h2>
          <label class="filter__label">
            <input type="radio" name="department" value="" data-filter="department" checked>
            <span class="filter__radio">All</span>
          </label>
          <?php foreach ($departments as $term) : ?>
            <label class="filter__label">
              <input type="radio" name="department" value="<?php echo $term->name; ?>" data-filter="department">
              <span class="filter__radio"><?php echo $term->name; ?></span>
            </label>
          <?php endforeach; ?>
        </div>
        <div class="finder__group">
          <h2 class="h5">Format</h2>
          <?php foreach ($formats as $term) : ?>
            <label class="filter__label">
              <input type="checkbox" value="<?php echo $term->name; ?>" data-filter="format">
              <span class="filter__checkbox"><?php echo $term->name; ?></span>
            </label>
          <?php endforeach; ?>
        </div>
        <div class="finder__group">
          <h2 class="h5">Regional Campuses</h2>
          <label class="filter__label">
            <input type="radio" name="campus" value="" data-filter="campus" checked>
            <span class="filter__radio">All</span>
          </label>
          <?php foreach ($regional_campuses as $term) : ?>
            <label class="filter__label">
              <input type="radio" name="campus" value="<?php echo $term->name; ?>" data-filter="campus">
              <span class="filter__radio"><?php echo $term->name; ?></span>
            </label>
          <?php endforeach; ?>
        </div>
        <div class="finder__related">
          <?php while(have_rows('related_links')): the_row(); ?>
              <h2 class="h4"><?php echo get_sub_field('heading'); ?></h2>
              <ul class="finder__links">
              <?php while(have_rows('links')): the_row(); ?>
                <?php $link = get_sub_field('link'); ?>
                <?php if ($link) : ?>
                  <li>
                    <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?>>
                      <?php echo $link['title']; ?>
                    </a>
                  </li>
                <?php endif; ?>
              <?php endwhile; ?>
              </ul>
          <?php endwhile; ?>
        </div>
      </div>
      <div class="finder__search">
        <div class="finder__group">
          <label class="finder__hidden" for="finder__input">What are you interested in?</label>
          <input id="finder__input" class="finder__input" type="search" placeholder="What are you interested in?">
          <?php while(have_rows('popular_search_terms')): the_row(); ?>
              <h2 class="h5"><?php echo get_sub_field('heading'); ?></h2>
              <div class="finder__popular">
              <?php while(have_rows('search_terms')): the_row(); ?>
                  <button class="finder__suggestion"><?php echo get_sub_field('search_term'); ?></button>
              <?php endwhile; ?>
              </div>
          <?php endwhile; ?>
        </div>
      </div>
    </div>
    <div class="finder__main">
      <div class="finder__info"></div>
      <div class="finder__results"></div>
    </div>
  </div>
</div>