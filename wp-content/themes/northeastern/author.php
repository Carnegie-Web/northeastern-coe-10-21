<?php if (is_multisite()) { switch_to_blog(1); } ?>
<?php 
global $curauth;
global $wp;

$current_url = home_url( add_query_arg( array(), $wp->request ) );
$curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
$author_id = $curauth->ID;
$email = get_field('preferred_email'); 
$preferred_email = $email ? $email : $curauth->user_email;
$news = get_posts([
  'post_type' => 'news',
  'numberposts' => -1,
  'meta_query'     => array(
      array(
        'key'     => 'faculty_members',
        'value'   =>  $author_id,
        'compare' => 'LIKE'
      ),
    )
]);


$publications = get_field('publications');
$publications_link = get_field('publications_link');
$research = get_field('research_intro');
$research_overview = get_field('research_overview');
$research_overview_image = get_field('research_overview_image');
$research_initiatives = get_field('research_initiatives');
$research_areas = get_field('department_theme');
$selected_research_projects = get_field('selected_research_projects');
$research_centers_and_institutes = get_field('research_centers_and_institutes');
$has_research = false;
$has_news = false;
$image = get_field('profile_image'); 
$subpage_heading = get_field('subpage_heading');

//Determine if author has related news.
foreach ($news as $news_item){
  $is_author = false;
  $faculty_ids = get_field('faculty_members', $news_item->ID);
  if ( $faculty_ids && $author_id && in_array( $author_id, $faculty_ids ) ) {
    $has_news = true;
  }
}

if(have_rows('research_sections_1', 'user_'.$author_id) ) {
  while( have_rows('research_sections_1', 'user_'. $author_id) ): the_row();
    if (get_sub_field('content')) {
      $has_research = true;
    }
  endwhile;  
}

$faculty_intro = get_field('faculty_intro');  
$education = get_field('education'); 
$licensure = get_field('licensure'); 
$honors_and_awards = get_field('honors_and_awards'); 
$teaching_interests = get_field('teaching_interests'); 
$leadership_positions = get_field('leadership_positions'); 
$affiliations = get_field('professional_affiliations'); 

$office_info = get_field('office_info'); 
$office_phone = get_field('office_phone'); 
$lab_location = get_field('lab_location'); 
$lab_phone = get_field('lab_phone'); 

$related_links = get_field('related_links');
$related_links_count = $related_links ? 1 : 0;
$social_links = get_field('social_links', 'user_'.$author_id);
$social_links_count = $social_links ? 1 : 0;
?>

<?php if (is_multisite()) { restore_current_blog(); } ?>

<?php 
//Gets all the data of the author, using the ID
$authorData = get_userdata( $author_id );

//checks if the author has the role of 'subscriber'
if (in_array( 'student', $authorData->roles)):
    get_header( null, [ 'header_var' => 'noindex' ] );
else:
    get_header();
endif;
?>

<main id="main-content">
  <?php if ( !post_password_required() ) : ?>
    <div class="faculty">
      <div class="main container container--clear">
        <?php get_template_part('modules/_breadcrumb'); ?>
        <div class="faculty__container">
          <?php if ($image) : ?>
            <div class="faculty__image">
              <?php echo wp_get_attachment_image($image, 'faculty-profile'); ?>
              <a href="<?php echo wp_get_attachment_image_src($image, '')[0]; ?>" class="faculty__image__link" download>
                <?php echo svgstore('download', 'Download', '') ?>
              </a>
            </div>
          <?php endif; ?>

          <div class="faculty__main">
            <div class="faculty__intro">
              <h1 class="h2"><?php echo $curauth->display_name; ?></h1>
              <?php if( have_rows('roles', 'user_'.$author_id) ): ?>
                <p>
                  <?php while( have_rows('roles', 'user_'. $author_id) ): the_row(); ?>
                    <?php echo get_sub_field('role'); ?>,&nbsp;
                    <?php $link = get_sub_field('link'); ?>
                    <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?>><?php echo $link['title']; ?></a><br/>
                  <?php endwhile; ?>
                </p>
              <?php endif; ?>
            </div>
            <div class="faculty__cols">
              <div class="faculty__col">
                <h2 class="h5">Contact</h2>
                <ul class="faculty__list">
                  <li><a href="mailto:<?php echo $preferred_email; ?>"><?php echo $preferred_email; ?></a></li>
                  <li><?php echo get_field('address'); ?></li>
                </ul>
                <?php if ($social_links_count > 0) : ?>
                  <h2 class="h5">Social Media</h2>
                  <ul class="faculty__list faculty__list--inline">
                    <?php while (have_rows('social_links', 'user_'.$author_id)) : the_row(); ?>
                      <?php $link = get_sub_field('link'); ?>
                      <?php $social_type = get_sub_field('type'); ?>
                      <li>
                        <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="faculty__social"><?php echo svgstore(strtolower($social_type),strtolower($social_type), '') ?>
                        </a>
                      </li>
                    <?php endwhile; ?>
                  </ul>
                <?php endif; ?>
              </div>
              <div class="faculty__col">
                <?php if ( $office_info || $office_phone ) : ?>
                  <h2 class="h5">Office</h2>
                  <ul class="faculty__list">
                    <?php if ( $office_info ) : ?>
                      <li><?php echo $office_info; ?></li>
                    <?php endif; ?>
                    <?php if ( $office_phone ) : ?>
                      <li><?php echo $office_phone; ?></li>
                    <?php endif; ?>
                  </ul>
                <?php endif; ?>
                <?php if ( $lab_location || $lab_phone ) : ?>
                  <h2 class="h5">Lab</h2>
                  <ul class="faculty__list">
                    <?php if ( $lab_location ) : ?>
                      <li><?php echo $lab_location; ?></li>
                    <?php endif; ?>
                    <?php if ( $lab_phone ) : ?>
                      <li><?php echo $lab_phone; ?></li>
                    <?php endif; ?>
                  </ul>
                <?php endif; ?>
              </div>
              <div class="faculty__col">
                <?php if ($related_links_count > 0 || $subpage_heading) : ?>
                  <h2 class="h5">Related Links</h2>
                  <ul class="faculty__list">
                    <?php if ($subpage_heading) : ?>
                      <li><a href="<?php echo $current_url; ?>/research"><?php echo $subpage_heading; ?></a></li>
                    <?php endif; ?>
                    <?php while (have_rows('related_links', 'user_'.$author_id)) : the_row(); ?>
                      <?php $link = get_sub_field('link'); ?>
                      <li>
                        <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?>><?php echo $link['title']; ?></a>
                      </li>
                    <?php endwhile; ?>
                  </ul>
                <?php endif; ?>
                <p>
                  <?php $file = get_field('cv'); ?>
                  <?php if ( $file ) : ?>
                    <a href="<?php echo $file['url']; ?>" class="cta__link" download>
                      <?php echo svgstore('download', '', 'cta__link__icon') ?>
                      <span>Download CV</span>
                    </a>
                  <?php endif; ?>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="main container container--mid container--clear">
      <?php if ( $research ) : ?>
        <div>
          <h2 class="h4">Research Focus</h2>
          <p><?php echo $research; ?></p>
        </div>
      <?php endif; ?>
      <div class="tabbed">
        <div class="tabbed__nav">
          <ul class="tabbed__nav__list">
            <li class="tabbed__nav__item">
              <button class="tabbed__nav__button">
                Biography
              </button>
            </li>
            <?php if ($research || $research_overview || $has_research || $research_initiatives || $research_areas || $selected_research_projects || $research_centers_and_institutes) : ?>
            <li class="tabbed__nav__item">
              <button class="tabbed__nav__button">
                Research
              </button>
            </li>
            <?php endif; ?>
            <?php if ($publications) : ?>
            <li class="tabbed__nav__item">
              <button class="tabbed__nav__button">
                Publications
              </button>
            </li>
            <?php endif; ?>
            <?php if ($news && $has_news) : ?>
              <li class="tabbed__nav__item">
                <button class="tabbed__nav__button">
                  Related News
                </button>
              </li>
            <?php endif; ?>
          </ul>
        </div>
        <div class="tabbed__content">
          <div class="tabbed__main">
            <button class="accordion__toggle tabbed__toggle"><?php echo svgstore('cross', 'Toggle Accordion', 'accordion__toggle__icon') ?>
            <span class="accordion__toggle__text">
              Biography
            </span></button>
            <div class="tabbed__content__item">
              <div class="tabbed__content__interior">
                <?php if ( $faculty_intro ) : ?>
                  <h2 class="h4">About</h2>
                  <?php echo $faculty_intro; ?>
                <?php endif; ?>
                <?php if ( $education ) : ?>
                  <div class="split">
                    <div class="split__side">
                      <h2 class="h4">Education</h2>
                    </div>
                    <div class="split__side">
                      <?php echo $education; ?>
                    </div>
                  </div>
                <?php endif; ?>
                <?php if ( $licensure ) : ?>
                  <div class="split">
                    <div class="split__side">
                      <h2 class="h4">Licensure</h2>
                    </div>
                    <div class="split__side">
                      <?php echo $licensure; ?>
                    </div>
                  </div>
                <?php endif; ?>
                <?php if ( $honors_and_awards ) : ?>
                  <div class="split">
                    <div class="split__side">
                      <h2 class="h4">Honors &amp; Awards</h2>
                    </div>
                    <div class="split__side">
                      <?php echo $honors_and_awards; ?>
                    </div>
                  </div>
                <?php endif; ?>
                <?php if ( $teaching_interests ) : ?>
                  <div class="split">
                    <div class="split__side">
                      <h2 class="h4">Teaching Interests</h2>
                    </div>
                    <div class="split__side">
                      <?php echo $teaching_interests; ?>
                    </div>
                  </div>
                <?php endif; ?>
                <?php if ( $leadership_positions ) : ?>
                  <div class="split">
                    <div class="split__side">
                      <h2 class="h4">Leadership Positions</h2>
                    </div>
                    <div class="split__side">
                      <?php echo $leadership_positions; ?>
                    </div>
                  </div>
                <?php endif; ?>
                <?php if ( $affiliations ) : ?>
                  <div class="split">
                    <div class="split__side">
                      <h2 class="h4">Professional Affiliations</h2>
                    </div>
                    <div class="split__side">
                      <?php echo $affiliations; ?>
                    </div>
                  </div>
                <?php endif; ?>
              </div>
            </div>
            <?php if ($research || $research_overview || $has_research || $research_initiatives || $research_areas || $selected_research_projects || $research_centers_and_institutes) : ?>
              <button class="accordion__toggle tabbed__toggle"><?php echo svgstore('cross', 'Toggle Accordion', 'accordion__toggle__icon') ?>
              <span class="accordion__toggle__text">
                Research
              </span></button>
              <div class="tabbed__content__item">
                <div class="tabbed__content__interior">
                  <?php if ( $research || $research_overview ) : ?>
                    <div class="tabbed__intro">
                      <h2 class="h4">Research Overview</h2>
                      <p><?php echo $research; ?></p>
                      <?php if ( $research_overview_image ) : ?>
                        <div class="align-left zero">
                          <figure class="image__container">
                            <div class="image">
                              <?php echo wp_get_attachment_image($research_overview_image, 'listing-image'); ?>
                            </div>
                            <?php $image_caption = wp_get_attachment_caption($research_overview_image);
                              if ( $image_caption ) : ?>
                                <figcaption class="image__caption">
                                  <?php echo $image_caption; ?>
                                </figcaption>
                              <?php endif; ?>
                          </figure>
                        </div>
                      <?php endif; ?>
                      <?php if ( $research_overview ) : ?>
                        <?php echo $research_overview; ?>
                      <?php endif; ?>
                    </div>
                  <?php endif; ?>
                  <?php if( have_rows('research_callouts', 'user_'.$author_id) ): ?>
                    <?php while( have_rows('research_callouts', 'user_'. $author_id) ): the_row(); ?>
                      <?php $img = get_sub_field('image'); ?>
                      <div class="callout">
                        <?php if ( $img ) : ?>
                          <div class="callout__image">
                            <?php echo wp_get_attachment_image($img, 'horizontal-standard', false); ?>
                          </div>
                        <?php endif; ?>
                        <div class="callout__content">
                          <h2 class="h5"><?php echo get_sub_field('heading'); ?></h2>
                          <?php echo get_sub_field('content'); ?>
                          <?php $link = get_sub_field('link'); ?>
                          <?php if ($link) : ?>
                              <a href="<?php echo $link['url']; ?>" <?php link_target($link); ?> class="button button--black-red button--block">
                                <span class="button__text"><?php echo $link['title']; ?></span>
                                <?php echo svgstore('arrow', '', 'button__arrow'); ?>
                              </a>
                          <?php endif; ?>
                        </div>
                      </div>
                    <?php endwhile; ?>
                  <?php endif; ?>
                  <?php 
                  if( $selected_research_projects ): ?>
                    <div class="split">
                      <div class="split__side">
                        <h2 class="h4">Selected Research Projects</h2>
                      </div>
                      <div class="split__side">
                        <?php echo $selected_research_projects; ?>
                      </div>
                    </div>
                  <?php endif; ?>
                  <?php 
                  if( $research_centers_and_institutes ): ?>
                    <div class="split">
                      <div class="split__side">
                        <h2 class="h4">Research Centers and Institutes</h2>
                      </div>
                      <div class="split__side">
                        <?php echo $research_centers_and_institutes; ?>
                      </div>
                    </div>
                  <?php endif; ?>
                  <?php 

                  if( $research_initiatives ): ?>
                    <div class="split">
                      <div class="split__side">
                        <h2 class="h4">College Research Initiatives</h2>
                      </div>
                      <div class="split__side">
                        <ul>
                          <?php foreach( $research_initiatives as $term ): ?><li>
                            <?php $research_initiative_link = get_field('related_link', $term); ?>
                            <a href="<?php echo $research_initiative_link['url']; ?>" <?php link_target($research_initiative_link); ?> class="button button--black-red button--block"><span class="button__text"><?php echo $term->name; ?></span>
                              <span class="button__arrow">
                                <?php echo svgstore('arrow', 'link', '') ?>
                              </span>
                            </a></li>
                          <?php endforeach; ?>
                        </ul>
                      </div>
                    </div>
                  <?php endif; ?>
                  <?php if( $research_areas ): ?>
                    <div class="split">
                      <div class="split__side">
                        <h2 class="h4">Department Research Areas</h2>
                      </div>
                      <div class="split__side">
                        <ul>
                          <?php foreach( $research_areas as $term ): ?>
                            <?php $research_areas_link = get_field('related_link', $term); ?><li>
                            <a href="<?php echo $research_areas_link['url']; ?>" <?php link_target($research_areas_link); ?>><?php echo $term->name; ?>
                            </a></li>
                          <?php endforeach; ?>
                        </ul>
                      </div>
                    </div>
                  <?php endif; ?>
                  <?php if( have_rows('research_sections_1', 'user_'.$author_id) ): ?>
                    <?php while( have_rows('research_sections_1', 'user_'. $author_id) ): the_row(); ?>
                      <?php $heading = get_sub_field('heading'); ?>
                      <?php $content = get_sub_field('content'); ?>
                      <?php if ( $content ) : ?>
                        <div class="split">
                          <?php if ( $heading ) : ?>
                            <div class="split__side">
                              <h2 class="h4"><?php echo $heading; ?></h2>
                            </div>
                          <?php endif; ?>
                          <?php if ( $content ) : ?>
                            <div class="split__side">
                              <?php echo $content; ?>
                            </div>
                          <?php endif; ?>
                        </div>
                      <?php endif; ?>
                    <?php endwhile; ?>
                  <?php endif; ?>
                </div>
              </div>
            <?php endif; ?>
            <?php if ($publications) : ?>
              <button class="accordion__toggle tabbed__toggle"><?php echo svgstore('cross', 'Toggle Accordion', 'accordion__toggle__icon') ?>
              <span class="accordion__toggle__text">
                Publications
              </span></button>
              <div class="tabbed__content__item">
                <div class="tabbed__content__interior">
                  <?php $publications_heading = get_field('publications_heading'); ?>
                  <?php if ( $publications_heading ) : ?>
                    <h2 class="h4"><?php echo $publications_heading; ?></h2>
                  <?php else : ?>
                    <h2 class="h4">Selected Publications</h2>
                  <?php endif; ?>
                  <?php echo $publications; ?>
                  <?php if ( $publications_link ) : ?>
                    <a href="<?php echo $publications_link['url']; ?>" <?php link_target($publications_link); ?> class="button button--black-red button--block">
                      <span class="button__text"><?php echo $publications_link['title']; ?></span>
                      <span class="button__arrow">
                        <?php echo svgstore('arrow', '', ''); ?>
                      </span>
                    </a>
                  <?php endif; ?>
                </div>
              </div>
            <?php endif; ?>
            <?php if ($news && $has_news) : ?>
              <button class="accordion__toggle tabbed__toggle"><?php echo svgstore('cross', 'Toggle Accordion', 'accordion__toggle__icon') ?>
              <span class="accordion__toggle__text">
                Related News
              </span></button>
              <div class="tabbed__content__item">
                <div class="tabbed__content__interior">
                  <?php $news_count = 0; ?>
                  <?php foreach ($news as $post) : setup_postdata($post); ?>
                    <?php 
                    $is_author = false;
                    $faculty_ids = get_field('faculty_members');
                    if ( $faculty_ids && $author_id && in_array( $author_id, $faculty_ids ) && $news_count < 10 ): ?>
                      <div class="list__item">
                        <?php $img = get_field('image'); ?>
                        <?php if ( $img ) : ?>
                          <div class="list__image">
                            <?php echo wp_get_attachment_image($img, 'horizontal-standard', false); ?>
                          </div>
                        <?php endif; ?>
                        <div class="list__content">
                        <?php 
                          $term = get_primary_term('news_categories', $post->ID);
                          if($term) {
                            echo "<p class=\"list__meta\">";
                            echo $term->name ;
                            echo "</p>";
                          }?>
                          <p class="list__date"><?php echo get_the_date('M d, Y'); ?></p>
                          <?php 
                          //redirect if this is an external article
                          $redirect = get_field('redirect_link');
                          $link = $redirect ? $redirect : get_the_permalink();
                          $target = $redirect ? 'target="_blank"' : '';
                          ?>
                          <h2 class="list__title h4"><a href="<?php echo $link; ?>" <?php echo $target; ?> ><?php the_title(); ?></a></h2>
                          <?php the_excerpt(); ?>
                        </div>
                      </div>
                      <?php $news_count++; ?>
                    <?php endif; ?>
                  <?php endforeach; wp_reset_postdata(); ?>
                  <p>
                    <?php $news_link = get_field('news_landing_page', 'option'); ?>
                    <?php if ( $news_link ) : ?>
                      <a href="<?php echo $news_link['url']; ?>?facid=<?php echo $author_id; ?>" <?php link_target($news_link); ?> class="button button--black-red button--block">
                        <span class="button__text">View All Related News</span>
                        <span class="button__arrow">
                          <?php echo svgstore('arrow', '', ''); ?>
                        </span>
                      </a>
                    <?php endif; ?>
                  </p>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  <?php else : ?>
    <div class="main container container--clear">
      <?php the_content(); ?>
    </div>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
