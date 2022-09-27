<?php
function theme_setup() {
  // let wordpress manage the title tag
  add_theme_support('title-tag');
  // add featured images support
  add_theme_support('post-thumbnails');
  // add editor css
  add_editor_style([get_theme_file_uri('dist/css/style.css')]);
  // menus
  register_nav_menus([
    'header' => 'Header',
    'audience' => 'Audience',
    'actions' => 'Actions',
  ]);
  // image sizes
  add_image_size('home-hero-desktop', 1434, 562, true);
  add_image_size('home-hero-tablet', 930, 560, true);
  add_image_size('department-hero-desktop', 1440, 751, true);
  add_image_size('department-hero-mobile', 400, 500, true);
  add_image_size('landing-hero-desktop', 1440, 400, true);
  add_image_size('program-hero-desktop', 1440, 700, true);
  add_image_size('landing-hero-mobile', 480, 700, true);
  add_image_size('landing-square', 600, 600, true);
  add_image_size('landing-small-square', 250, 250, true);
  add_image_size('spotlight-wide', 600, 285, true);
  add_image_size('card-image', 600, 400, true);
  add_image_size('listing-image', 300, 200, true);
  add_image_size('feature-slider', 768, 512, true);
  add_image_size('horizontal-standard', 600, 400, true);
  add_image_size('sidebar-feature', 318, 212, true);
  add_image_size('program-contacts', 145, 110, true);
  add_image_size('faculty-profile', 280, 380, true);
  add_image_size('faculty-listing', 173, 230, true);
  add_image_size('announcement', 375, 250, true);
  add_image_size('program-overview', 380, 255, true);
  add_image_size('home-card-rectangular', 600, 285, true);
  add_image_size('social-icon', 20, 20, true);

  // add acf options pages
  if (function_exists('acf_add_options_page')) {
    acf_add_options_page();
  }
}
add_action('after_setup_theme', 'theme_setup');

// only show acf menu item for local dev
function hide_acf_menu_item() {
  return !(strpos(get_bloginfo('url'), 'localhost') === false && strpos(get_bloginfo('url'), 'edu.northeastern-coe') === false);
}
add_filter('acf/settings/show_admin', 'hide_acf_menu_item');



add_filter('acf/settings/load_json', 'coe_acf_json_load_point');
function coe_acf_json_load_point( $paths ) {
    // remove original path (optional)
    unset($paths[0]);
    // append path
    $paths[] = get_stylesheet_directory() . '/acf-json';
    // return
    return $paths;
}


// theme css
function theme_css() {
  wp_enqueue_style('global-font-css', get_theme_file_uri('/dist/css/material-icons.css'), [], null, 'all');
  wp_enqueue_style('global-footer-style-css', get_theme_file_uri('/dist/css/footer.css'), [], null, 'all');
  wp_enqueue_style('global-header-style-css', get_theme_file_uri('/dist/css/utilitynav.css'), [], null, 'all');
  wp_enqueue_style('theme-fonts', 'https://fonts.googleapis.com/css?family=Playfair+Display:400,700%7CLato:300,300i,400,400i,700,700i,900,900i', [], null, 'all');
  wp_enqueue_style('theme-main', get_theme_file_uri('/dist/css/style.css'), [], null, 'all');
}
add_action('wp_enqueue_scripts', 'theme_css');

// theme js
function theme_js() {
  wp_enqueue_script('theme-main', get_theme_file_uri('/dist/js/main.js'), [], null, true);
  wp_enqueue_script('share-this', '//platform-api.sharethis.com/js/sharethis.js#property=5c82cc7a4c495400114fe99d&product=custom-share-buttons', [], null, true);
  wp_enqueue_script( 'department-loader', '//widget.academicanalytics.com/scripts/AcA_NE_COE.js', array( 'jquery' ), '1.0.0', true );
}
add_action('wp_enqueue_scripts', 'theme_js');

//CPT
// news custom taxonomy
function ctax_news_categories() {
  $args = [
    'public' => true,
    'hierarchical' => true,
    'label' => 'News Categories',
    'rewrite' => ['slug' => 'news/categories'],
    'has_archive' => true
  ];
  register_taxonomy('news_categories', 'news', $args);
}
add_action('init', 'ctax_news_categories');

// news custom taxonomy
function ctax_news_topics() {
  $args = [
    'public' => true,
    'hierarchical' => true,
    'label' => 'News Topics',
    'rewrite' => ['slug' => 'news/topics'],
    'has_archive' => true
  ];
  register_taxonomy('news_topics', 'news', $args);
}
add_action('init', 'ctax_news_topics');

// news custom taxonomy
function ctax_news_programs() {
  $args = [
    'public' => true,
    'hierarchical' => true,
    'label' => 'Programs',
    'has_archive' => true
  ];
  register_taxonomy('news_programs', 'news', $args);
}
add_action('init', 'ctax_news_programs');

// news custom taxonomy
function ctax_news_organizations() {
  $args = [
    'public' => true,
    'hierarchical' => true,
    'label' => 'Organizations',
    'rewrite' => ['slug' => 'news/organizations'],
    'has_archive' => true
  ];
  register_taxonomy('news_organizations', 'news', $args);
}
add_action('init', 'ctax_news_organizations');

// news custom post type
function cpt_news() {
  $labels = array(
    'name' => _x( 'News', 'news' ),
    'singular_name' => _x( 'News', 'news' ),
    'add_new' => _x( 'Add New', 'news' ),
    'add_new_item' => _x( 'Add New News', 'news' ),
    'edit_item' => _x( 'Edit News', 'news' ),
    'new_item' => _x( 'New News', 'news' ),
    'view_item' => _x( 'View News', 'news' ),
    'search_items' => _x( 'Search News', 'news' ),
    'not_found' => _x( 'No news found', 'news' ),
    'not_found_in_trash' => _x( 'No news found in Trash', 'news' ),
    'parent_item_colon' => _x( 'Parent News:', 'news' ),
    'menu_name' => _x( 'News', 'news' ),
  );
  $args = [
    'public' => true,
    'labels' => $labels,
    'has_archive' => true,
    'supports' => ['title', 'thumbnail', 'excerpt', 'editor', 'author'],
    'capability_type' => 'news_item',
    'map_meta_cap' => true,
  ];
  register_post_type('news', $args);
}
add_action('init', 'cpt_news');

// page department custom taxonomy
function ctax_page_department() {
  $args = [
    'public' => false,
    'hierarchical' => true,
    'label' => 'Departments',
    'show_admin_column' => true,
    'show_ui' => current_user_can('administrator'),
    'meta_box_cb' => current_user_can('administrator') ? 'post_categories_meta_box' : false,
  ];
  register_taxonomy('page_department', ['page','news','program','organization'], $args);
}
add_action('init', 'ctax_page_department');

// program format ctax
function ctax_format() {
  $args = [
    'public' => false,
    'hierarchical' => true,
    'label' => 'Format',
    'show_ui' => true
  ];
  register_taxonomy('format', 'program', $args);
}
add_action('init', 'ctax_format');

// regional_campuses ctax
function ctax_regional_campuses() {
  $args = [
    'public' => false,
    'hierarchical' => true,
    'label' => 'Regional Campuses',
    'show_ui' => true
  ];
  register_taxonomy('regional_campuses', 'program', $args);
}
add_action('init', 'ctax_regional_campuses');

// research_initiatives ctax
function ctax_research_initiatives() {
  $args = [
    'public' => false,
    'hierarchical' => true,
    'label' => 'Research Initiatives',
    'show_ui' => true
  ];
  register_taxonomy('research_initiatives', ['post','user'], $args);
}
add_action('init', 'ctax_research_initiatives');

// research_initiatives ctax
function ctax_department_themes() {
  $args = [
    'public' => false,
    'hierarchical' => true,
    'label' => 'Department Themes',
    'show_ui' => true
  ];
  register_taxonomy('department_themes', ['post','user'], $args);
}
add_action('init', 'ctax_department_themes');

// position_type ctax
function ctax_position_type() {
  $args = [
    'public' => false,
    'hierarchical' => true,
    'label' => 'Position Types',
    'show_ui' => true
  ];
  register_taxonomy('position_type', ['post','user'], $args);
}
add_action('init', 'ctax_position_type');

// program cpt
function cpt_program() {
  $labels = array(
    'name' => _x( 'Program Card', 'program' ),
    'singular_name' => _x( 'Program Card', 'program' ),
    'add_new' => _x( 'Add New', 'program' ),
    'add_new_item' => _x( 'Add New Program Card', 'program' ),
    'edit_item' => _x( 'Edit Program Card', 'program' ),
    'new_item' => _x( 'New Program Card', 'program' ),
    'view_item' => _x( 'View Program Card', 'program' ),
    'search_items' => _x( 'Search Program Cards', 'program' ),
    'not_found' => _x( 'No program card found', 'program' ),
    'not_found_in_trash' => _x( 'No program found in Trash', 'program' ),
    'parent_item_colon' => _x( 'Parent Program Card:', 'program' ),
    'menu_name' => _x( 'Program Card', 'program' ),
  );
  $args = [
    'public' => true,
    'labels' => $labels,
    'supports' => ['title', 'thumbnail'],
    'rewrite' => ['slug' => 'programs']
  ];
  register_post_type('program', $args);
}
add_action('init', 'cpt_program');

// organization custom post type
function cpt_organization() {
  $labels = array(
    'name' => _x( 'Organization', 'organization' ),
    'singular_name' => _x( 'Organization', 'organization' ),
    'add_new' => _x( 'Add New', 'organization' ),
    'add_new_item' => _x( 'Add New Organization', 'organization' ),
    'edit_item' => _x( 'Edit Organization', 'organization' ),
    'new_item' => _x( 'New Organization', 'organization' ),
    'view_item' => _x( 'View Organization', 'organization' ),
    'search_items' => _x( 'Search Organizations', 'organization' ),
    'not_found' => _x( 'No organization found', 'organization' ),
    'not_found_in_trash' => _x( 'No organization found in Trash', 'organization' ),
    'parent_item_colon' => _x( 'Parent Organization:', 'organization' ),
    'menu_name' => _x( 'Organization', 'organization' ),
  );
  $args = [
    'public' => true,
    'labels' => $labels,
    'has_archive' => false,
    'supports' => ['title', 'thumbnail', 'editor'],
    'rewrite' => ['slug' => 'orgs']
  ];
  register_post_type('organization', $args);
}
add_action('init', 'cpt_organization');

  // organization custom taxonomy
function ctax_organization_categories() {
  $args = [
    'public' => true,
    'hierarchical' => true,
    'label' => 'Organization Categories',
    'rewrite' => ['slug' => 'organization/categories'],
    'has_archive' => true
  ];
  register_taxonomy('organization_categories', 'organization', $args);
}
add_action('init', 'ctax_organization_categories');

  // organization custom taxonomy
function ctax_organization_type() {
  $args = [
    'public' => true,
    'hierarchical' => true,
    'label' => 'Organization Types',
    'show_ui' => true
  ];
  register_taxonomy('organization_type', 'organization', $args);
}
add_action('init', 'ctax_organization_type');

// talent type custom taxonomy
function ctax_talent_type() {
  $args = [
    'public' => false,
    'hierarchical' => true,
    'label' => 'Talent Types',
    'show_ui' => true,
  ];
  register_taxonomy('talent_type', 'talent', $args);
}
add_action('init', 'ctax_talent_type');

// talent discipline custom taxonomy
function ctax_talent_discipline() {
  $args = [
    'public' => false,
    'hierarchical' => true,
    'label' => 'Talent Disciplines',
    'show_ui' => true,
  ];
  register_taxonomy('talent_discipline', 'talent', $args);
}
add_action('init', 'ctax_talent_discipline');

// talent custom post type
function cpt_talent() {
  $args = [
    'public' => false,
    'hierarchical' => true,
    'label' => 'Talent',
    'supports' => ['title', 'thumbnail', 'editor'],
    'show_ui' => true,
  ];
  register_post_type('talent', $args);
}
add_action('init', 'cpt_talent');

//filters

// filter to disable reset password
//function disable_password_reset() { return false; }
//add_filter ( 'allow_password_reset', 'disable_password_reset' );

// filter query repeater field for user listing
function user_posts_where( $user_query ) {

  $user_query->query_where = str_replace("meta_key = 'roles_$", "meta_key LIKE 'roles_%", $user_query->query_where);

  return $user_query;

}

add_filter('pre_user_query', 'user_posts_where');


add_filter( 'body_class', 'add_body_class' );
function add_body_class( $classes ) {
  $blog_id = get_current_blog_id();
  if ( $blog_id != '1' ) {
      $classes[] = 'dept';
  }
  if ( is_page_template( 'page--program.php' ) ) {
      $classes[] = 'program';
  }
  return $classes;
}

// filter - add custom mce formats
function northeastern_mce_buttons_2($buttons) {
  array_unshift($buttons, 'styleselect');
  return $buttons;
}
add_filter('mce_buttons_2', 'northeastern_mce_buttons_2');
function northeastern_mce_before_init($settings) {
  $style_formats = [
    [
      'title' => 'Introduction',
      'selector' => 'p',
      'classes' => 'p-intro'
    ],
    [
      'title' => 'Button Gray',
      'selector' => 'a',
      'classes' => 'cta cta--gray'
    ],
    [
      'title' => 'Button Red',
      'selector' => 'a',
      'classes' => 'cta cta--red'
    ],
    [
      'title' => 'Button Black',
      'selector' => 'a',
      'classes' => 'cta cta--black'
    ],
    [
      'title' => 'Custom Table',
      'selector' => 'table',
      'classes' => 'custom-table'
    ],
    [
      'title' => 'Small Text',
      'selector' => 'p',
      'classes' => 'caption'
    ]
  ];
  $settings['style_formats'] = json_encode($style_formats);
  return $settings;
}
add_filter('tiny_mce_before_init', 'northeastern_mce_before_init');

// filter - wrap tablepress tables in table div
add_filter( 'tablepress_table_output', 'tp_add_wrapper', 10, 3 );
function tp_add_wrapper( $output, $table, $render_options ) {
  $output = "<div class=\"table\">\n{$output}\n</div>";
  return $output;
}

//Add Dynamic Faculty Subpage
function coe_read_endpoint() {
    add_rewrite_endpoint( 'research', EP_AUTHORS );
}
add_action( 'init', 'coe_read_endpoint' );

function coe_read_template( $template = '' ) {
    global $wp_query;
    if( ! array_key_exists( 'research', $wp_query->query_vars ) ) return $template;

    $template = locate_template( 'page--faculty-subpage.php' );
    return $template;
}
add_filter( 'author_template', 'coe_read_template' );

// Make role position types by department searchable on faculty
function coe_convert_role_to_standard_wp_meta($post_id) {
  $meta_key = 'role_wp';
  delete_user_meta($post_id, $meta_key);
  $saved_values = array();

  // now we'll look at the repeater and save any values
  if (have_rows('roles', 'user_'.$post_id)) {
    while (have_rows('roles', 'user_'.$post_id)) {
      the_row();

      // get the value of this row
      $role_position_type = get_sub_field('position_type');
      $role_dept = get_sub_field('department');

      // see if this value has already been saved
      // note that I am using isset rather than in_array
      // the reason for this is that isset is faster than in_array
      if (isset($saved_values[$role_position_type.'-'.$role_dept])) {
        // no need to save this one we already have it
        continue;
      }

      // not already save, so add it using add_post_meta()
      // note that we are using false for the 4th parameter
      // this means that this meta key is not unique
      // and can have more then one value
      add_user_meta($post_id, $meta_key, $role_position_type.'-'.$role_dept, false);

      // add it to the values we've already saved
      $saved_values[$role_position_type.'-'.$role_dept] = $role_position_type.'-'.$role_dept;

    } // end while have rows
  } // end if have rows
} // end function
add_filter('profile_update', 'coe_convert_role_to_standard_wp_meta', 30);

/* Functions */
// inline svg
function svgstore($svg, $title, $class) {
  $output = '<span class="'.($class ? $class : '').' svgstore svgstore--'.$svg.'">
    <svg>
      '.($title ? '<title>'.$title.'</title>' : '').'
      <use xlink:href="'.get_template_directory_uri().'/dist/img/svgstore.svg#'.$svg.'"></use>
    </svg>
  </span>';
  return $output;
}

// add link target if it exists
function link_target($link) {
  $target = $link['target'];
  echo $target ? "target='$target'" : '';
}

// get exclude ids
function get_exclude_child_ids($current) {
  $exclude = '';
  $children = get_children($current);
  if ($children) {
    foreach ($children as $child) {
      $child_id = $child->ID;
      if (get_field('exclude_from_subnav', $child_id)) {
        $exclude .= $child_id . ',';
      }
      $grandchildren = get_children($child_id);
      if ($grandchildren) {
        foreach ($grandchildren as $grandchild) {
          $grandchild_id = $grandchild->ID;
          if (get_field('exclude_from_subnav', $grandchild_id)) {
            $exclude .= $grandchild_id . ',';
          }
        }
      }
    }
  }
  return $exclude;
}

// Get primary category
function get_primary_term( $taxonomy = 'category', $post_id = false ) {
  // Bail if no taxonomy.
  if ( ! $taxonomy ) {
    return false;
  }
  // If no post ID, set it.
  if ( ! $post_id ) {
    $post_id = get_the_ID();
  }
  // If checking for WPSEO.
  if ( class_exists( 'WPSEO_Primary_Term' ) ) {
    // Get the primary term.
    $wpseo_primary_term = new WPSEO_Primary_Term( $taxonomy, $post_id );
    $wpseo_primary_term = $wpseo_primary_term->get_primary_term();
    // If we have one, return it.
    if ( $wpseo_primary_term ) {
      return get_term( $wpseo_primary_term );
    }
  }
  // We don't have a primary, so let's get all the terms.
  $terms = get_the_terms( $post_id, $taxonomy );
  // Bail if no terms.
  if ( ! $terms || is_wp_error( $terms ) ) {
    return false;
  }
  // Return the first term.
  return $terms[0];
}

// Limit Excerpt Length by number of Words
function excerpt( $limit ) {
  $excerpt = explode(' ', get_the_excerpt(), $limit);
  if (count($excerpt) >= $limit) {
    array_pop($excerpt);
    $excerpt = implode(" ",$excerpt).'...';
  } else {
    $excerpt = implode(" ",$excerpt);
  }
  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
  return $excerpt;
}

// Get comma separated taxonomy terms.
function get_delimited_taxonomy( $taxonomy, $post_id = false ) {
  // Return if no taxonomy.
  if ( ! $taxonomy ) {
    return '';
  }
  // If no post ID, set it.
  if ( ! $post_id ) {
    $post_id = get_the_ID();
  }
  $terms = get_the_terms( $post_id , $taxonomy );
  if ( ! empty( $terms ) ) {
    $taxonomy_string = '';
    foreach ( $terms as $term ) {
      $taxonomy_string .= '"' . $term->name . '", ';
    }
    $taxonomy_string = rtrim( $taxonomy_string, ', ' );
    return $taxonomy_string;
  }
}

/**
 * Enable unfiltered_html capability for Editors.
 *
 * @param  array  $caps    The user's capabilities.
 * @param  string $cap     Capability name.
 * @param  int    $user_id The user ID.
 * @return array  $caps    The user's capabilities, with 'unfiltered_html' potentially added.
 */
function coe_add_unfiltered_html_capability_to_admin( $caps, $cap, $user_id ) {

  if ( 'unfiltered_html' === $cap && user_can( $user_id, 'administrator' ) ) {

    $caps = array( 'unfiltered_html' );

  }
  return $caps;
}
add_filter( 'map_meta_cap', 'coe_add_unfiltered_html_capability_to_admin', 1, 3 );

// header nav walker
class Header_Nav_Walker extends Walker_Nav_Menu {
  public function start_lvl(&$output, $depth = 0, $args = array()) {
    if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
      $t = '';
      $n = '';
    } else {
      $t = "\t";
      $n = "\n";
    }
    $indent = str_repeat($t, $depth);
    $classes = array('menu__list--sub');
    $class_names = join(' ', apply_filters('nav_menu_submenu_css_class', $classes, $args, $depth));
    $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
    $before = '<button class="menu__btn">' . svgstore('dropdown', '', 'menu__btn__icon') . '</button>';
    $output .= "{$n}{$indent}{$before}<ul$class_names>{$n}";
  }
  public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
      $t = '';
      $n = '';
    } else {
      $t = "\t";
      $n = "\n";
    }
    $indent = ($depth) ? str_repeat($t, $depth) : '';
    $classes = empty($item->classes) ? array() : (array)$item->classes;
    $classes[] = 'menu-item-' . $item->ID;
    $classes[] = $depth === 0 ? 'menu__item' : 'menu__item--sub';
    $args = apply_filters('nav_menu_item_args', $args, $item, $depth);
    $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
    $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
    $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
    $id = $id ? ' id="' . esc_attr($id) . '"' : '';
    $output .= $indent . '<li' . $id . $class_names . '>';
    $atts = array();
    $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
    $atts['target'] = !empty($item->target) ? $item->target : '';
    $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
    $atts['href'] = !empty($item->url) ? $item->url : '';
    $atts['class'] = $depth === 0 ? 'menu__link' : 'menu__link--sub';
    $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
    $attributes = '';
    foreach ($atts as $attr => $value) {
      if (!empty($value)) {
        $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
        $attributes .= ' ' . $attr . '="' . $value . '"';
      }
    }
    $title = apply_filters('the_title', $item->title, $item->ID);
    $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);
    $item_output = $args->before;
    $item_output .= '<a' . $attributes . '>';
    $item_output .= $args->link_before . $title . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;
    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
  public function end_el(&$output, $item, $depth = 0, $args = array()) {
    if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
      $t = '';
      $n = '';
    } else {
      $t = "\t";
      $n = "\n";
    }
    $output .= "</li>{$n}";
  }
}

// header audience nav walker
class Mega_Nav_Walker extends Walker_Nav_Menu {
  public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
    if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
      $t = '';
      $n = '';
    } else {
      $t = "\t";
      $n = "\n";
    }
    $indent = ($depth) ? str_repeat($t, $depth) : '';
    $classes = empty($item->classes) ? array() : (array)$item->classes;
    $classes[] = 'menu-item-' . $item->ID;
    $classes[] = $depth === 0 ? 'mega__item' : '';
    $args = apply_filters('nav_menu_item_args', $args, $item, $depth);
    $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
    $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
    $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
    $id = $id ? ' id="' . esc_attr($id) . '"' : '';
    $output .= $indent . '<li' . $id . $class_names . '>';
    $atts = array();
    $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
    $atts['target'] = !empty($item->target) ? $item->target : '';
    $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
    $atts['href'] = !empty($item->url) ? $item->url : '';
    $atts['class'] = $depth === 0 ? 'mega__link' : '';
    $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
    $attributes = '';
    foreach ($atts as $attr => $value) {
      if (!empty($value)) {
        $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
        $attributes .= ' ' . $attr . '="' . $value . '"';
      }
    }

    $title = apply_filters('the_title', $item->title, $item->ID);
    $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);
    $title = '<span class="mega__link__text">' . $title . '</span>';
    $after = svgstore('arrow', '', 'mega__link__icon');
    $item_output = $args->before;
    $item_output .= '<a' . $attributes . '>';
    $item_output .= $args->link_before . $title . $args->link_after . $after;
    $item_output .= '</a>';
    $item_output .= $args->after;
    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
  public function end_el(&$output, $item, $depth = 0, $args = array()) {
    if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
      $t = '';
      $n = '';
    } else {
      $t = "\t";
      $n = "\n";
    }
    $output .= "</li>{$n}";
  }
}
// header actions nav walker
class Actions_Nav_Walker extends Walker_Nav_Menu {
  public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
  {
    if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
      $t = '';
      $n = '';
    } else {
      $t = "\t";
      $n = "\n";
    }
    $indent = ($depth) ? str_repeat($t, $depth) : '';
    $classes = empty($item->classes) ? array() : (array)$item->classes;
    $classes[] = 'menu-item-' . $item->ID;
    $classes[] = $depth === 0 ? 'topbar__cta__item' : '';
    $args = apply_filters('nav_menu_item_args', $args, $item, $depth);
    $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
    $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';
    $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
    $id = $id ? ' id="' . esc_attr($id) . '"' : '';
    $output .= $indent . '<li' . $id . $class_names . '>';
    $atts = array();
    $atts['title'] = !empty($item->attr_title) ? $item->attr_title : '';
    $atts['target'] = !empty($item->target) ? $item->target : '';
    $atts['rel'] = !empty($item->xfn) ? $item->xfn : '';
    $atts['href'] = !empty($item->url) ? $item->url : '';
    $atts['class'] = $depth === 0 ? 'topbar__link' : '';
    $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);
    $attributes = '';
    foreach ($atts as $attr => $value) {
      if (!empty($value)) {
        $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
        $attributes .= ' ' . $attr . '="' . $value . '"';
      }
    }
    $title = apply_filters('the_title', $item->title, $item->ID);
    $title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);
    $item_output = $args->before;
    $item_output .= '<a' . $attributes . '>';
    $item_output .= $args->link_before . $title . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;
    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
  public function end_el(&$output, $item, $depth = 0, $args = array()) {
    if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
      $t = '';
      $n = '';
    } else {
      $t = "\t";
      $n = "\n";
    }
    $output .= "</li>{$n}";
  }
}
// sidebar subnav walker class
class Sub_Nav_Walker extends Walker_Nav_Menu {
    var $tree_type = 'page';

    var $db_fields = array ('parent' => 'post_parent', 'id' => 'ID');

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        switch ($depth) {
            case 0:
                $output .= $indent.'<div class="subnav__item--flex"><button class="subnav__link__toggle">'. svgstore('dropdown', '', '') .'</button></div>';
                $output .= $indent."<ul class='subnav__list--sub'>\n";
                break;
            default:
                break;
        }
    }

    function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        switch ($depth) {
            case 0:
                $output .= "\n".$indent."</ul>\n";
                break;
            default:
                break;
        }
    }

    function start_el( &$output, $page, $depth=0, $args=array(), $current_page=0 ) {
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
          $t = '';
          $n = '';
        } else {
          $t = "\t";
          $n = "\n";
        }
        $indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

        extract($args, EXTR_SKIP);
        if ( $depth == 0 ) {
          $css_class = array('subnav__item', 'page-item-'.$page->ID);
        } else {
          $css_class = array('page_item', 'page-item-'.$page->ID);
        }

        if ( !empty($current_page) ) {
            $_current_page = get_page( $current_page );
            if ( isset($_current_page->ancestors) && in_array($page->ID, (array) $_current_page->ancestors) )
                $css_class[] = 'subnav__ancestor';
            if ( $page->ID == $current_page )
                $css_class[] = ' subnav__item--active';
            elseif ( $_current_page && $page->ID == $_current_page->post_parent )
                $css_class[] = 'subnav__parent';
        } elseif ( $page->ID == get_option('page_for_posts') ) {
            $css_class[] = 'current_page_parent';
        }

        $css_class = implode(' ', apply_filters('page_css_class', $css_class, $page));

        $title = apply_filters( 'the_title', $page->post_title, $page->ID );
        switch ($depth) {
            case 0:
                $page_link = '<a href="' . get_permalink($page->ID) . '" class="subnav__link" title="' . $title . '">' . $link_before . $title . $link_after . '</a>';
                $output .= $indent . '<li class="' . $css_class . '">'.$page_link;
                break;
            case 1:
                $page_link = '<a href="' . get_permalink($page->ID) . '" class="subnav__link--sub" title="' . $title . '">' . $link_before . $title . $link_after . '</a>';
                $output .= $indent . '<li class="' . $css_class . ' subnav__item--sub">'.$page_link;
                break;
            default:
                break;
        }

    }

    public function end_el( &$output, $item, $depth = 0, $args = array() ) {
      if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
        $t = '';
        $n = '';
      } else {
        $t = "\t";
        $n = "\n";
      }
      $output .= "</li>{$n}";
    }
}

add_action('future_to_pending', 'coe_send_emails_on_new_event');
add_action('new_to_pending', 'coe_send_emails_on_new_event');
add_action('draft_to_pending', 'coe_send_emails_on_new_event');
add_action('auto-draft_to_pending', 'coe_send_emails_on_new_event');

function coe_send_emails_on_new_event($post) {
  if(get_post_type($post->ID) === 'news') {
    $emails = get_option('admin_email');
    $title = wp_strip_all_tags(get_the_title($post->ID));
    $url = get_permalink($post->ID);
    $message = "Link to news story: \n{$url}";

    wp_mail($emails, "New news story pending review: {$title}", $message);
  }
  if (get_post_type($post->ID) === 'tribe_events') {
    $emails = get_option('admin_email');
    $title = wp_strip_all_tags(get_the_title($post->ID));
    $url = get_permalink($post->ID);
    $message = " \n{$url}";

    wp_mail($emails, "New event pending review: {$title}", $message);
  }

}

remove_action( 'template_redirect', 'maybe_redirect_404' );

// Writing a script for read only fields (for gravity forms)

add_filter( 'gform_pre_render', 'add_readonly_script' );

function add_readonly_script( $form ) {

    ?>

<script type="text/javascript">

   jQuery(document).ready(function(){

/* apply only to a input with a class of gf_readonly */

   jQuery(".gf_readonly input").attr("readonly","readonly");

});

</script>

     <?php
          return $form;
}
add_filter("gform_field_value_rand_number", "populate_rand_number");

function populate_rand_number(){
   return (substr(md5(uniqid()),0,15));
}

// COE code for gravity forms password page (jej 8/10/2021)

/*

*Sending data from form to external data base

*/

add_action("gform_after_submission_34", "push_fields", 10, 2);

function push_fields($entry, $form){

$firstName = $entry["1.3"];

$lastName = $entry["1.6"];

$email = $entry["2"];

$nuid = $entry["12"];

$updatedpassword = $entry["4"];

$servername = "localhost";

$username = "coegravity";

$password = "coegrav2020";

$dbname = "ecc";

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

// set the PDO error mode to exception

$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = "INSERT INTO passwdrequest (firstName, lastName, email, nuid, password, creation_time) VALUES ('$firstName ','$lastName' ,'$email ','$nuid ','$updatedpassword',now())";

// use exec() because no results are returned

$conn->exec($sql);

//echo "New record created successfully";

}
