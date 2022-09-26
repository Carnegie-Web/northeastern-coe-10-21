<h2>Parameters Tutorial</h2>
<h3>How to call the URL and what each parameter does... <span color="green">test it don`t be shy :)</span> </h3>
	<li>post type: post</li>
	<li>post status: publish</li>
	<li>posts per page: 20</li>
	<?php echo custom_simple_rss_admin_href(''); ?>	

<hr>
	<p>
	Accepts any valid wordpress image sizes : full / large / medium
	OR a string of width and height (in that order) values in pixels seperetad by 'x'. for example '400x300'
	</p>
	<h5>Examples:</h5>
	<p>
		Display full size
		<?php echo custom_simple_rss_admin_href('&csrp_thumbnail_size=full'); ?>
	</p>
	<p>	
		<?php echo custom_simple_rss_admin_href('&csrp_thumbnail_size=large'); ?>
	<p>
		<?php echo custom_simple_rss_admin_href("&csrp_thumbnail_size=medium"); ?>
	<p>	
		Display custom size
		<?php echo custom_simple_rss_admin_href("&csrp_thumbnail_size=400x300"); ?>
    
<hr>
<h4>csrp_cat (string | optional)</h4>
		<?php echo custom_simple_rss_admin_href("&csrp_cat=4"); ?>
		<?php echo custom_simple_rss_admin_href("&csrp_cat=2,6,17,38"); ?>
		<?php echo custom_simple_rss_admin_href("&csrp_cat=-12,-34,-56"); ?>
<h4>csrp_author (string | optional)</h4>
<hr>
		<?php echo custom_simple_rss_admin_href("&csrp_author_name=john"); ?>
<h4>csrp_posts_per_page (int | optional) default 20</h4>
		<?php echo custom_simple_rss_admin_href("&csrp_posts_per_page=5"); ?>
<h4>csrp_orderby (string | optional) default ‘date’</h4>
	<p>    
		<?php echo custom_simple_rss_admin_href("&csrp_orderby=name"); ?>
<h4>csrp_order (string | optional) default ‘asc’</h4>
	<p>
		<?php echo custom_simple_rss_admin_href("&csrp_orderby=name&csrp_order=DESC"); ?>
<hr>
		Display only future posts:
	   <?php echo custom_simple_rss_admin_href("&csrp_post_status=future"); ?>
	</p>
		Multiple post statuses:
	   <?php echo custom_simple_rss_admin_href("&csrp_post_status=publish,draft"); ?>
	</p>

<h4>csrp_post_type (string | optional) default ‘post’</h4>
	<p>    
		<?php echo custom_simple_rss_admin_href("&csrp_post_type=page"); ?>	</p>
		<?php echo custom_simple_rss_admin_href("&csrp_post_type=books"); ?>
		</p>		
		Multiple post types:
	   <?php echo custom_simple_rss_admin_href("&csrp_post_status=page,post"); ?>
	</p>
<hr>
	<?php echo custom_simple_rss_admin_href("&csrp_posts_per_page=5&csrp_show_meta=1&csrp_meta_key=_thumbnail_id&csrp_meta_value=1448"); ?></p>
    <?php echo custom_simple_rss_admin_href("?call_custom_simple_rss=1&csrp_posts_per_page=5&csrp_show_meta=1&csrp_meta_key=_thumbnail_id&csrp_meta_value=1448&csrp_meta_compare=NOT%20IN"); ?></p>

<h4>Return posts between dates</h4>
	<li>csrp_date (int | required) - <b>! must be set to 1 </b>to intiate the date query</li>
	<li>csrp_date_after (string | optional) - posts after this date. optional values:</li>
		 - 'yyyy-mm-dd',<br>
		 - '1 year ago',<br>
	<li>csrp_date_after_type (string | optional) - get posts by publish date OR modified date default is publish date. optional values:
	</li>
		- 'date',<br>
	<li>csrp_date_before (string | optional) - posts before this date.  optional values:
	</li>
		- 'yyyy-mm-dd',<br>
	<li>csrp_date_before_type (string | optional) - get posts by publish date OR modified date - default is publish date. optional values:</li>
		<p>Return posts modified in 2014
		<?php echo custom_simple_rss_admin_href("&csrp_posts_per_page=5&csrp_date=1&csrp_date_after=2014-01-01&csrp_date_after_type=modified&csrp_date_before=2015-01-01&csrp_date_before_type=modified"); ?></p>
		<?php echo custom_simple_rss_admin_href("&csrp_posts_per_page=5&csrp_date=1&csrp_date_after=1 month ago&csrp_date_after_type=modified&csrp_date_before=1 year ago&csrp_date_before_type=date"); ?></p>
<u><h3>exclude post formats:</h3></u>
<u><h3>show post meta in feed:</h3></u>	
	quite handy if you need the rss as an xml data for external applications or export
	disabled by default.</p>
<hr>
<u><h3>show post thumbnail in feed:</h3></u>	

<u><h3>show posts / custom post types by taxonomy:</h3></u>
	<li>csrp_tax_name (string | required) - the tax name/slug for example "actor"</li>

		Show all posts from custom post type "movie"(post_type=movie) where taxonomy is "actor" and actors(terms) are 58 or 57
<u><h3>show custom tax for post:</h3></u>
	<li>csrp_show_post_terms (string | required) the tax name miltiple tax divided by comma</li>
