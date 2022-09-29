<?php
$root_url = get_permalink(get_queried_object_id());

$pg = sanitize_text_field($_GET['pg'] ?? 1);
$per = sanitize_text_field($_GET['per'] ?? null);
$search = sanitize_text_field($_GET['search'] ?? null);
$phd_student = sanitize_text_field($_GET['phd_student'] ?? null);
$postdoc = sanitize_text_field($_GET['postdoc'] ?? null);
$discipline = sanitize_text_field($_GET['discipline'] ?? null);
$letter = sanitize_text_field($_GET['letter'] ?? null);

$items_per_page = $per ?: get_sub_field('items_per_page');
$footer_content = get_sub_field('footer_content');

$types = get_terms([
  'taxonomy' => 'talent_type',
  'hide_empty' => false,
]);

$disciplines = get_terms([
  'taxonomy' => 'talent_discipline',
  'hide_empty' => false,
]);

$args = [
  'post_type' => 'talent',
  'order' => 'ASC',
  'orderby' => 'title',
  'posts_per_page' => $items_per_page,
];

$tax_query = [];

if ($pg) {
  $args['paged'] = $pg;
}

if ($search) {
  $args['s'] = $search;
}

$type_terms = [];
if ($phd_student) $type_terms[] = 'phd_student';
if ($postdoc) $type_terms[] = 'postdoc';
if (!empty($type_terms)) {
  $tax_query[] = [
    'taxonomy' => 'talent_type',
    'field' => 'slug',
    'terms' => $type_terms,
  ];
}

if ($discipline) {
  $tax_query[] = [
    'taxonomy' => 'talent_discipline',
    'field' => 'slug',
    'terms' => $discipline,
  ];
}

if ($letter) {
  $args['starts_with'] = $letter;
}

if (!empty($tax_query)) {
  $args['tax_query'] = $tax_query;
}

$posts = new WP_Query($args);
$total = $posts->found_posts;
$pages = ceil($total / $items_per_page);

$pg_args = [
  'base' => $root_url,
  'pages' => $pages,
  'current' => $pg,
];
?>

<div class="talent-listing">

  <form>
    <label for="talent-search" class="hide">Search</label>
    <input id="talent-search" class="list__input" type="search" placeholder="Search" name="search" <?php if ($search) { echo "value='$search'"; } ?>>
  </form>

  <hr class="hr--small">

  <form class="dropdown__filters">

    <span class="dropdown__label label">Filter by:</span>

    <?php foreach ($types as $term) : ?>
      <label class="filter__label filter__label--alt">
        <input type="checkbox" value="on" name="<?php echo $term->slug; ?>" <?php if (${$term->slug} === 'on') { echo 'checked'; } ?>>
        <span class="filter__checkbox"><?php echo $term->name; ?></span>
      </label>
    <?php endforeach; ?>

    <label for="discipline" class="hide">Select discipline</label>
    <select class="dropdown__select" id="discipline" name="discipline">
      <option value="">Discipline</option>
      <?php foreach ($disciplines as $term) : ?>
        <option value="<?php echo $term->slug; ?>" <?php if ($discipline === $term->slug) { echo 'selected'; } ?>><?php echo $term->name; ?></option>
      <?php endforeach; ?>
    </select>

    <div class="dropdown__filters__group">
      <button class="cta cta--red">
        Apply Filters
      </button>
      <br>
      <a href="<?php echo $root_url; ?>" class="cta__link">
        <span>Reset Filters</span>
      </a>
    </div>

  </form>

  <div class="list__search__group">
    <span class="list__search__label label">Search by Letter of Last Name:</span>
    <?php foreach (range('a', 'z') as $val) : ?>
      <a href="<?php echo "$root_url?letter=$val"; ?>" class="list__search__link <?php if ($val === $letter) { echo 'active'; } ?>"><?php echo $val; ?></a>
    <?php endforeach; ?>
  </div>

  <div class="grid grid--2">
    <div class="list__result">
      <span>
        <?php echo $total; ?> Items found
      </span>
    </div>
    <?php if ($pages > 1) : ?>
      <div id="pagination" class="pagination">
        <?php get_template_part('modules/_pagination', null, $pg_args); ?>
      </div>
    <?php endif;; ?>
  </div>

  <div class="list">
    <div class="grid grid--5">

      <?php while ($posts->have_posts()) : $posts->the_post(); ?>
        <?php
        $title = explode(', ', get_the_title(), 2);
        $name = "$title[1] $title[0]";
        $email = get_field('email');
        $linkedin = get_field('linkedin');
        $personal_link = get_field('personal_link');
        ?>
        <div>
          <div class="block-small">
            <?php the_post_thumbnail('faculty-listing', ['class' => 'block-smaller-bottom']); ?>
            <h2 class="list__contact__headline">
              <span class="contact__name contact__name--alt"><?php echo $name; ?></span>
            </h2>
            <div class="text-small">
              <?php the_content(); ?>
            </div>
            <ul class="caption caption__link__list--alt">
              <li>
                <a href="mailto:<?php echo $email; ?>" class="caption__link"><?php echo $email; ?></a>
              </li>
              <li>
                <?php if ($linkedin) : ?>
                  <a href="<?php echo $linkedin; ?>" class="contact__icon">
                    <span class="hide">LinkedIn</span>
                    <?php echo svgstore('linkedin', '', ''); ?>
                  </a>
                <?php endif; ?>
                <?php if ($personal_link) : ?>
                  <a href="<?php echo $personal_link; ?>" class="contact__icon">
                    <span class="hide">Personal Link</span>
                    <?php echo svgstore('arrow-up-right', '', ''); ?>
                  </a>
                <?php endif; ?>
              </li>
            </ul>
          </div>
        </div>
      <?php endwhile; wp_reset_postdata(); ?>

    </div>
  </div>

  <?php if ($pages > 1) : ?>
    <div id="pagination" class="pagination block">
      <?php get_template_part('modules/_pagination', null, $pg_args); ?>
    </div>
  <?php endif; ?>

  <hr>

  <div class="main__narrow text-small">
    <?php echo $footer_content; ?>
  </div>

</div>
