<?php  

$research_area_base = get_sub_field('research_area');;
$research_initiatives_base = get_sub_field('research_initiative');;
$module_type = get_sub_field('module_type');
$display_count = '1000';

if ( $module_type == 'filtered') {
	$user_meta_query = array(
		'relation' => 'AND',
		array( 
		      'key'=> 'type', 
		      'value'   => [ 'Faculty', 'Staff' ],
		      'compare' => 'IN'
		),
		array(
		  'last_name_clause'  => [
		      'key'     => 'last_name',
		      'compare' => 'EXISTS'
		  ],
		  'first_name_clause' => [
		      'key'     => 'first_name',
		      'compare' => 'EXISTS'
		  ],
		)
	);
	if ($research_initiatives_base) {
	  $user_meta_query[] = array('key' => 'research_initiatives', 'value' => $research_initiatives_base, 'compare' => 'LIKE');
	};

	if ($research_area_base) {
	  $user_meta_query[] = array('key' => 'department_theme', 'value' => $research_area_base, 'compare' => 'LIKE');
	};
	if ($user_meta_query) {
	  $args = array(
	    'orderby' => [
	        'last_name_clause'  => 'ASC',
	        'first_name_clause' => 'ASC',
	    ],
	    'number' => $display_count,
	    'meta_query' => $user_meta_query
	  );
	}
	
	$user_query = new WP_User_Query( $args );
	$users = $user_query->results;

}
else
{
	$users = get_sub_field('contacts'); 
}


?>
<?php if( $users ) : ?>
	<?php if (is_page_template( 'page--landing.php' )) : ?>
		<section aria-label="program contacts" class="expand__container--contacts expand__container--white container--border">
			<div class="container expand__container__group collapsed">
				<div class="block-spacing">
					<div class="grid grid--3-2">
						<div class="zero">
							<div class="h2"><?php echo get_sub_field('heading'); ?></div>
						</div>
						<div>
	<?php else : ?>
		<div class="block-spacing-bottom">
	        <section aria-label="program contacts" class="expand__container--contacts container--border-bottom expand__container--white">
	          	<div class="expand__container__group">
	            	<div class="block-small zero">
	              		<h2><?php echo get_sub_field('heading'); ?></h2>
	<?php endif; ?>
    <?php foreach( $users as $user) : ?>
    	<?php if (is_multisite()) { switch_to_blog(1); } ?>
    	<?php if (!is_integer($user)) { $user = $user->ID; } ?>
	    	<?php $curauth = get_userdata($user); 
	    	$image = get_field('profile_image','user_'. $user);
	    	$email = get_field('preferred_email','user_'. $user); 
	        $preferred_email = $email ? $email : get_the_author_meta( 'user_email', $user );?>

	    	<div class="contact__item">
			  <hr>
			  <div class="contact__image">
			  	<?php echo wp_get_attachment_image($image, 'faculty-profile', false); ?>
			  </div>
			  <div class="contact__content">
			  	
			    <a href="<?php echo get_author_posts_url( $user, get_the_author_meta( 'user_nicename', $user ) ); ?>" class="contact__name"><?php echo get_the_author_meta( 'display_name', $user ); ?></a>
			    <?php while( have_rows('roles', 'user_'. $user) ): the_row(); ?>
			    	<div class="caption">
	                  <?php echo get_sub_field('role'); ?>,&nbsp;
	                  <?php $link = get_sub_field('link'); ?>
	                  <?php $link2 = get_sub_field('link_2'); ?>
	                  <?php $link3 = get_sub_field('link_3'); ?>
	                  <?php $separator = $link3 ? ',' : '&'; ?>
	                  <?php echo $link['title']; ?>
	                  <?php if ( $link2 ) : ?>
	                  	<?php echo $separator . ' ' . $link2['title']; ?>
	                  <?php endif; ?>
	                  <?php if ( $link3 ) : ?>
	                  	<?php echo '&' . ' ' . $link3['title']; ?>
	                  <?php endif; ?><br/>
	              	</div>
	            <?php endwhile; ?>
	            <div class="caption"><?php echo get_field('office_phone','user_'. $user); ?><br/><a href="mailto:<?php echo $preferred_email; ?>"><?php echo $preferred_email; ?></a></div>
			    <p><?php echo get_the_author_meta( 'research_intro', $user ); ?></p>
			  </div>
			</div>
		<?php if (is_multisite()) { restore_current_blog(); } ?>
    <?php endforeach; ?>
    <?php if (is_page_template( 'page--landing.php' )) : ?>
					</div>
			    </div>
			</div>
		</div>
		<button class="expand__btn expand__btn--contacts">
			<?php echo svgstore('plus', 'Expand Section', 'expand__button--open') ?>
			<?php echo svgstore('minus', 'Collapse Section', 'expand__button--close') ?>
		</button>
	</section>
	<?php else : ?>
					</div>
				</div>
				<button class="expand__btn expand__btn--contacts">
  					<?php echo svgstore('plus', 'Expand Section', 'expand__button--open') ?>
  					<?php echo svgstore('minus', 'Collapse Section', 'expand__button--close') ?>
    			</button>
			</section>
		</div>
	<?php endif; ?>
<?php endif; ?>