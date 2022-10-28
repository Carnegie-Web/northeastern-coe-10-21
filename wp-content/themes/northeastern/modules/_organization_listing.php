<?php
global $wp;
$current_url = home_url( add_query_arg( array(), $wp->request ) );
$current_fullurl = home_url() . $_SERVER['REQUEST_URI'];

//get default number of items
$display_count = get_sub_field('number');
$display_count = $display_count ? $display_count : 8;

// get labels
$filter_by_text = get_sub_field('filter_by_textText') ? get_sub_field('filter_by_textText') : 'Filter By' ; 
$apply_filters_text = get_sub_field('apply_filters_text') ? get_sub_field('apply_filters_text') : 'Apply Filters' ; 
$reset_filters_text = get_sub_field('reset_filters_text') ? get_sub_field('reset_filters_text') : 'Reset Filters' ;
$search_by_letter_text = get_sub_field('search_by_letter_text') ? get_sub_field('search_by_letter_text') : 'Search By Letter' ;

// setup departments
$organization_type = get_terms([
  'taxonomy' => 'organization_type',
  'hide_empty' => false,
]);

$keyword = '';

$meta_query = '';
$tax_query = '';
$alpha = '';
$organization_type_tags = '';
$display = '';

if (isset($_GET['ot'])) {
  $organization_type_tags  = sanitize_text_field($_GET['ot']);
}

if (isset($_GET['alpha'])) {
  $alpha  = sanitize_text_field($_GET['alpha']);
}

if (isset($_GET['q'])) {
  $keyword  = sanitize_text_field($_GET['q']);
}

if (isset($_GET['display'])) {
  $display  = sanitize_text_field($_GET['display']);
}

if ($display == 'all') {
  $display_count = '1000';
}
// Next, get the current page
$paged = ( get_query_var('paged')) ? get_query_var('paged') : 1;
// After that, calculate the offset
$offset = ( $paged - 1 ) * $display_count;

// build meta query
if ($alpha) {
  $meta_query = array(
    array(
      'key' => 'organization_name',
      'value' => '^' . $alpha,
      'compare' => 'REGEXP'
    )
  );
}
elseif ($organization_type_tags) {
  $tax_query = array(
    array(
      'taxonomy' => 'organization_type',
      'field' => 'id',
      'terms' => $organization_type_tags
    )
  );
}

if ($meta_query || $tax_query || $keyword) {
  $args = array(
    'post_type' => 'organization',
    'paged' => $paged,
    'posts_per_page' => $display_count,
    'offset'     =>  $offset,
    'tax_query' => $tax_query,
    'meta_query' => $meta_query,
    's' => $keyword,
    'orderby' => 'title',
    'order' => 'ASC'
  );
}
else {
  $args = array(
    'post_type' => 'organization',
    'paged' => $paged,
    'posts_per_page' => $display_count,
    'offset'     =>  $offset,
    'orderby' => 'title',
    'order' => 'ASC'
  );
}


$wp_query = new WP_Query( $args );

$total_posts = $wp_query->found_posts;
$total_pages = ceil($total_posts / $display_count);

?>

<div class="org-listing">
  <form id="org_search_keyword" method="get" action="<?php echo $current_url; ?>">
    <input type="hidden" name="paged" value="1"/>
    <label for="org-search" class="hide">Search</label>
    <input id="org-search" name="q" class="list__input" type="search" placeholder="Search">  
  </form>
  <form id="org_search" method="get" action="<?php echo $current_url; ?>">
    <input type="hidden" name="paged" value="1"/>
    <div class="dropdown__filters">
      <span class="dropdown__label label"><?php echo $filter_by_text; ?>:</span>
        <label for="ot" class="hide">Select Organization Type</label>
        <select class="dropdown__select" name="ot" id="ot">
          <option value="">Organization Type</option>
          <?php foreach ($organization_type as $term) : ?>
              <option value="<?php echo $term->term_id; ?>"<?php if($organization_type_tags == $term->term_id){ echo" selected";} ?>><?php echo $term->name; ?></option>
          <?php endforeach; ?>
        </select>
      <div class="dropdown__filters__group">
        <button type='submit' class="cta cta--red">
          <?php echo $apply_filters_text; ?>
        </button>
        <br>
        <a href="<?php echo $current_url; ?>" class="cta__link">
          <span><?php echo $reset_filters_text; ?></span>
        </a>
      </div>
    </div>
  </form>
  <div class="list__search__group">
    <span class="list__search__label label"><?php echo $search_by_letter_text; ?>:</span>

    <a href="<?php echo $current_url; ?>?alpha=a" class="list__search__link">A</a>
    <a href="<?php echo $current_url; ?>?alpha=b" class="list__search__link">B</a>
    <a href="<?php echo $current_url; ?>?alpha=c" class="list__search__link">C</a>
    <a href="<?php echo $current_url; ?>?alpha=d" class="list__search__link">D</a>
    <a href="<?php echo $current_url; ?>?alpha=e" class="list__search__link">E</a>
    <a href="<?php echo $current_url; ?>?alpha=f" class="list__search__link">F</a>
    <a href="<?php echo $current_url; ?>?alpha=g" class="list__search__link">G</a>
    <a href="<?php echo $current_url; ?>?alpha=h" class="list__search__link">H</a>
    <a href="<?php echo $current_url; ?>?alpha=i" class="list__search__link">I</a>
    <a href="<?php echo $current_url; ?>?alpha=j" class="list__search__link">J</a>
    <a href="<?php echo $current_url; ?>?alpha=k" class="list__search__link">K</a>
    <a href="<?php echo $current_url; ?>?alpha=l" class="list__search__link">L</a>
    <a href="<?php echo $current_url; ?>?alpha=m" class="list__search__link">M</a>
    <a href="<?php echo $current_url; ?>?alpha=n" class="list__search__link">N</a>
    <a href="<?php echo $current_url; ?>?alpha=o" class="list__search__link">O</a>
    <a href="<?php echo $current_url; ?>?alpha=p" class="list__search__link">P</a>
    <a href="<?php echo $current_url; ?>?alpha=q" class="list__search__link">Q</a>
    <a href="<?php echo $current_url; ?>?alpha=r" class="list__search__link">R</a>
    <a href="<?php echo $current_url; ?>?alpha=s" class="list__search__link">S</a>
    <a href="<?php echo $current_url; ?>?alpha=t" class="list__search__link">T</a>
    <a href="<?php echo $current_url; ?>?alpha=u" class="list__search__link">U</a>
    <a href="<?php echo $current_url; ?>?alpha=v" class="list__search__link">V</a>
    <a href="<?php echo $current_url; ?>?alpha=w" class="list__search__link">W</a>
    <a href="<?php echo $current_url; ?>?alpha=x" class="list__search__link">X</a>
    <a href="<?php echo $current_url; ?>?alpha=y" class="list__search__link">Y</a>
    <a href="<?php echo $current_url; ?>?alpha=z" class="list__search__link">Z</a>
  </div>
  <div class="grid grid--2">
  <div class="list__result">
    <span>
      <?php echo $total_posts; ?> Items found
    </span>
  </div>
  <?php
    if ($display != 'all') {
  $url_params_regex = '/\?.*?$/';
  preg_match($url_params_regex, get_pagenum_link(), $url_params);
  
  $base   = !empty($url_params[0]) ? preg_replace($url_params_regex, '', get_pagenum_link()).'%_%/'.$url_params[0] : get_pagenum_link().'%_%';
  $format = 'page/%#%';
  $display_var = strpos($current_fullurl, '?') ? '&display=all' : '?display=all';

echo '<div id="pagination" class="pagination">';
  $current_page = max(1, get_query_var('paged'));
  echo paginate_links(array(
    'base' => $base,
    'format' => $format,
    'current' => $current_page,
    'total' => $total_pages,
    'prev_next'          => true,
    'prev_text'          => __('« Previous'),
    'next_text'          => __('Next »'),
    'type'         => 'plain',
    ));
if ($total_pages > 1) {
  echo '<a href="' . $current_fullurl . $display_var . '&paged=1" class="page-numbers">View All</a>';
}
echo '</div>';
}
?>
</div>
  <div class="list">
    

    <?php while($wp_query->have_posts()) : $wp_query->the_post(); ?>
      <!--start faculty block-->
      <div class="list__item">
        <?php if ( has_post_thumbnail() ) : ?>
          <div class="list__image">
            <?php the_post_thumbnail('listing'); ?>
          </div>
        <?php endif; ?>
        <div class="list__content">
          <h2 class="list__title h4">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h2>
          <p><?php the_excerpt(); ?></p>
        </div>
      </div>
      <!--end faculty block-->
    <?php endwhile; ?>
    <?php wp_reset_postdata(); // reset the query ?>
  </div>

    <?php
    if ($display != 'all') {
  $url_params_regex = '/\?.*?$/';
  preg_match($url_params_regex, get_pagenum_link(), $url_params);
  
  $base   = !empty($url_params[0]) ? preg_replace($url_params_regex, '', get_pagenum_link()).'%_%/'.$url_params[0] : get_pagenum_link().'%_%';
  $format = 'page/%#%';

echo '<div id="pagination" class="pagination block">';
  $current_page = max(1, get_query_var('paged'));
  echo paginate_links(array(
    'base' => $base,
    'format' => $format,
    'current' => $current_page,
    'total' => $total_pages,
    'prev_next'          => true,
    'prev_text'          => __('« Previous'),
    'next_text'          => __('Next »'),
    'type'         => 'plain',
    ));
if ($total_pages > 1) {
  echo '<a href="' . $current_fullurl . $display_var . '&paged=1" class="page-numbers">View All</a>';
}
echo '</div>';
}
?>

</div>