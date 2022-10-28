<?php
global $wp;
$current_url = home_url( add_query_arg( array(), $wp->request ) );

//get default number of items
$display_count = get_sub_field('number');
$display_count = $display_count ? $display_count : 8;

// get labels
$filter_by_text = get_sub_field('filter_by_textText') ? get_sub_field('filter_by_textText') : 'Filter By' ; 
$apply_filters_text = get_sub_field('apply_filters_text') ? get_sub_field('apply_filters_text') : 'Apply Filters' ; 
$reset_filters_text = get_sub_field('reset_filters_text') ? get_sub_field('reset_filters_text') : 'Reset Filters' ;

// setup departments
$departments = get_terms([
  'taxonomy' => 'page_department',
  'hide_empty' => false,
]);

// setup departments
$programs = get_terms([
  'taxonomy' => 'news_programs',
  'hide_empty' => false,
]);

// setup research_initiatives
$news_categories = get_terms([
  'taxonomy' => 'news_categories',
  'hide_empty' => false,
]);

// setup research_initiatives
$news_topics = get_terms([
  'taxonomy' => 'news_topics',
  'hide_empty' => false,
]);

$date_query = '';
$tax_query = '';
$meta_query = '';

$departments_base = '';
$programs_base = '';
$news_categories_base = '';
$news_topics_base = '';
$news_type_base = '';
$organizations_base = '';

$department_tags = '';
$program_tags = '';
$news_categories_tags = '';
$news_topics_tags = '';
$selected_year = '';
$selected_month = '';

$keyword = '';

// get base filter
$departments_base = get_sub_field('departments');
$programs_base = get_sub_field('programs');
$news_categories_base = get_sub_field('category');
$news_topics_base = get_sub_field('news_topics');
$news_type_base = get_sub_field('news_type');
$organizations_base = get_sub_field('organizations');

if (isset($_GET['dept'])) {
  $department_tags  = sanitize_text_field($_GET['dept']);
}

if (isset($_GET['prg'])) {
  $program_tags  = sanitize_text_field($_GET['prg']);
}

if (isset($_GET['cat'])) {
  $news_categories_tags  = sanitize_text_field($_GET['cat']);
}

if (isset($_GET['top'])) {
  $news_topics_tags  = sanitize_text_field($_GET['top']);
}

if (isset($_GET['yr'])) {
  $selected_year  = sanitize_text_field($_GET['yr']);
}

if (isset($_GET['mth'])) {
  $selected_month  = sanitize_text_field($_GET['mth']);
}

if (isset($_GET['q'])) {
  $keyword  = sanitize_text_field($_GET['q']);
}

// Next, get the current page
$paged = ( get_query_var('paged')) ? get_query_var('paged') : 1;
// After that, calculate the offset
$offset = ( $paged - 1 ) * $display_count;

if ($news_type_base) {
  $meta_query = array(
      array(
          'key' => 'news_type',
          'value' => $news_type_base,
          'compare' => 'LIKE'
      )
  );
}

// build tax query
if ($department_tags || $program_tags || $news_categories_tags || $news_topics_tags || $departments_base || $programs_base || $news_categories_base || $news_topics_base || $organizations_base) {
  $tax_query = array('relation' => 'AND');
  if (!empty($news_categories_tags)) {
      $tax_query[] = array(
      'taxonomy' => 'news_categories',
      'field' => 'id',
      'terms' => $news_categories_tags
    );
  }
  if (!empty($news_topics_tags)) {
      $tax_query[] = array(
      'taxonomy' => 'news_topics',
      'field' => 'id',
      'terms' => $news_topics_tags
    );
  }
  if (!empty($program_tags)) {
      $tax_query[] = array(
      'taxonomy' => 'news_programs',
      'field' => 'id',
      'terms' => $program_tags
    );
  }
  if (!empty($department_tags)) {
      $tax_query[] = array(
      'taxonomy' => 'page_department',
      'field' => 'id',
      'terms' => $department_tags
    );
  }
  if (!empty($news_categories_base)) {
      $tax_query[] = array(
      'taxonomy' => 'news_categories',
      'field' => 'id',
      'terms' => $news_categories_base
    );
  }
  if (!empty($news_topics_base)) {
      $tax_query[] = array(
      'taxonomy' => 'news_topics',
      'field' => 'id',
      'terms' => $news_topics_base
    );
  }
  if (!empty($programs_base)) {
      $tax_query[] = array(
      'taxonomy' => 'news_programs',
      'field' => 'id',
      'terms' => $programs_base
    );
  }
  if (!empty($departments_base)) {
      $tax_query[] = array(
      'taxonomy' => 'page_department',
      'field' => 'id',
      'terms' => $departments_base
    );
  }
  if (!empty($organizations_base)) {
      $tax_query[] = array(
      'taxonomy' => 'news_organizations',
      'field' => 'id',
      'terms' => $organizations_base
    );
  }
}

// build date query
if ($selected_year || $selected_month) {
  $date_query = array(
    array(
      'relation' => 'AND'
    )
  );
}

if ($selected_year) {
  $date_query [][] = array(
    'year' => $selected_year
  );
}

if ($selected_month) {
  $date_query [][] = array(
    'month' => $selected_month
  );
}

if ($date_query || $tax_query || $keyword || $meta_query) {
  $args = array(
    'post_type' => 'news',
    'orderby' => 'date',
    'order' => 'DESC',
    'paged' => $paged,
    'posts_per_page' => $display_count,
    'offset'     =>  $offset,
    'tax_query' => $tax_query,
    'meta_query' => $meta_query,
    'date_query' => $date_query,
    's' => $keyword
  );
}
else {
  $args = array(
    'post_type' => 'news',
    'orderby' => 'date',
    'order' => 'DESC',
    'paged' => $paged,
    'posts_per_page' => $display_count,
    'offset'     =>  $offset
  );
}


$wp_query = new WP_Query( $args );

$total_posts = $wp_query->found_posts;
$total_pages = ceil($total_posts / $display_count);

?>

<div class="news-listing">
  <form id="news_search_keyword" method="get" action="<?php echo $current_url; ?>">
    <input type="hidden" name="paged" value="1"/>
    <label for="news-search" class="hide">Search</label>
    <input id="news-search" name="q" class="list__input" type="search" placeholder="Search">  
  </form>
  <form id="news_search" method="get" action="<?php echo $current_url; ?>">
    <input type="hidden" name="paged" value="1"/>
    <div class="dropdown__filters">
      <span class="dropdown__label label"><?php echo $filter_by_text; ?>:</span>
      <?php if (!$departments_base) : ?>
        <label for="dept" class="hide">Select Department</label>
        <select class="dropdown__select" name="dept" id="dept">
          <option value="">Department</option>
          <?php foreach ($departments as $term) : ?>
              <option value="<?php echo $term->term_id; ?>"<?php if($department_tags == $term->term_id){ echo" selected";} ?>><?php echo $term->name; ?></option>
          <?php endforeach; ?>
        </select>
      <?php endif; ?>
      <?php if (!$programs_base) : ?>
        <label for="prg" class="hide">Select Program</label>
        <select class="dropdown__select" name="prg" id="prg">
          <option value="">Program</option>
          <?php foreach ($programs as $term) : ?>
              <option value="<?php echo $term->term_id; ?>"<?php if($program_tags == $term->term_id){ echo" selected";} ?>><?php echo $term->name; ?></option>
          <?php endforeach; ?>
        </select>
      <?php endif; ?>
      <?php if (!$news_categories_base) : ?>
        <label for="cat" class="hide">Select Category</label>
        <select class="dropdown__select" name="cat" id="cat">
          <option value="">Category</option>
          <?php foreach ($news_categories as $term) : ?>
              <option value="<?php echo $term->term_id; ?>"<?php if($news_categories_tags == $term->term_id){ echo" selected";} ?>><?php echo $term->name; ?></option>
          <?php endforeach; ?>
        </select>
      <?php endif; ?>
      <?php if (!$news_topics_base) : ?>
        <label for="top" class="hide">Select Topic</label>
        <select class="dropdown__select" name="top" id="top">
          <option value="">Topic</option>
          <?php foreach ($news_topics as $term) : ?>
              <option value="<?php echo $term->term_id; ?>"<?php if($news_topics_tags == $term->term_id){ echo" selected";} ?>><?php echo $term->name; ?></option>
          <?php endforeach; ?>
        </select>
      <?php endif; ?>
        <label for="yr" class="hide">Select Year</label>
        <?php
        $earliest_year = 2008; 
        $latest_year = date('Y'); 
        print '<select class="dropdown__select" name="yr" id="yr">';
        print '<option value="">Year</option>';
        foreach ( range( $latest_year, $earliest_year ) as $i ) {
          print '<option value="'.$i.'"'.($i == $selected_year ? ' selected="selected"' : '').'>'.$i.'</option>';
        }
        print '</select>';
        ?>
        <label for="mth" class="hide">Select Month</label>
        <select class="dropdown__select" name="mth" id="mth">
          <option value=''>Month</option>
          <option value='1'<?php if($selected_month == '1'){ echo" selected";} ?>>January</option>
          <option value='2'<?php if($selected_month == '2'){ echo" selected";} ?>>February</option>
          <option value='3'<?php if($selected_month == '3'){ echo" selected";} ?>>March</option>
          <option value='4'<?php if($selected_month == '4'){ echo" selected";} ?>>April</option>
          <option value='5'<?php if($selected_month == '5'){ echo" selected";} ?>>May</option>
          <option value='6'<?php if($selected_month == '6'){ echo" selected";} ?>>June</option>
          <option value='7'<?php if($selected_month == '7'){ echo" selected";} ?>>July</option>
          <option value='8'<?php if($selected_month == '8'){ echo" selected";} ?>>August</option>
          <option value='9'<?php if($selected_month == '9'){ echo" selected";} ?>>September</option>
          <option value='10'<?php if($selected_month == '10'){ echo" selected";} ?>>October</option>
          <option value='11'<?php if($selected_month == '11'){ echo" selected";} ?>>November</option>
          <option value='12'<?php if($selected_month == '12'){ echo" selected";} ?>>December</option>
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
  <div class="grid grid--2">
    <div class="list__result">
      <span>
        <?php echo $total_posts; ?> Items found
      </span>
    </div>
    <?php
    $url_params_regex = '/\?.*?$/';
    preg_match($url_params_regex, get_pagenum_link(), $url_params);
    
    $base   = !empty($url_params[0]) ? preg_replace($url_params_regex, '', get_pagenum_link()).'%_%/'.$url_params[0] : get_pagenum_link().'%_%';
    $format = 'page/%#%';

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
    echo '</div>';
    ?>
  </div>
  <div class="list">
    

    <?php while($wp_query->have_posts()) : $wp_query->the_post(); ?>
      <!--start faculty block-->
      <div class="list__item">
        <?php $image = get_field('image'); ?>
        <?php if ( $image ) : ?>
          <div class="list__image">
            <?php echo wp_get_attachment_image($image, 'listing', false); ?>
          </div>
        <?php endif; ?>
        <div class="list__content">
          <p class="list__date"><?php echo get_the_date('M d, Y'); ?></p>
          <h2 class="list__title h4">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h2>
          <p><?php the_excerpt(); ?></p>
          <?php 
            $term = get_delimited_taxonomy('page_department', $post->ID);
            if($term) {
              echo "<p class=\"list__meta--news\">";
              echo str_replace('"', '', $term) ;
              echo "</p>";
            }?>
        </div>
      </div>
      <!--end faculty block-->
    <?php endwhile; ?>
    <?php wp_reset_postdata(); // reset the query ?>
  </div>

    <?php
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
echo '</div>';
?>

</div>