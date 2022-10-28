<?php
/*
Plugin Name: TablePress Extension: Fix corrupted tables
Plugin URI: https://tablepress.org/faq/corrupted-tables/
Description: Extension for TablePress to fix corrupted tables
Version: 1.4
Author: Tobias Bäthge
Author URI: https://tobias.baethge.com/
*/

// Prohibit direct script loading.
defined( 'ABSPATH' ) || die( 'No direct script access allowed!' );

/**
 * TablePress Extension: Fix corrupted tables
 * @author Tobias Bäthge
 * @since 1.0
 */
class TablePress_Restore_Corrupted_Tables {

	/**
	 * Container for the number of tables that were restored, for the admin notice.
	 *
	 * @since 1.3
	 * @var array
	 */
	protected static $_number_fixed_tables = array(
		'wp51_update' => 0,
		'hack_script_tag' => 0,
		'hack_script_tag_failed' => 0,
	);

	/**
	 * On plugin activation, load plugin data and run data restoration functions.
	 *
	 * @since 1.3
	 */
	public static function activate() {
		self::$_number_fixed_tables = get_option( 'tablepress_number_fixed_tables', self::$_number_fixed_tables );

		self::_restore_tables_wp51_update();
		self::_restore_tables_hack_script_tag();

		update_option( 'tablepress_number_fixed_tables', self::$_number_fixed_tables, true );
	}

	/**
	 * On plugin deactivation, delete plugin data from the database.
	 *
	 * @since 1.3
	 */
	public static function deactivate() {
		delete_option( 'tablepress_number_fixed_tables' );
	}

	/**
	 * Show a success message.
	 *
	 * @since 1.0
	 */
	public static function admin_notice() {
		self::$_number_fixed_tables = get_option( 'tablepress_number_fixed_tables', self::$_number_fixed_tables );

		$link = 'exporting';
		if ( is_callable( array( 'TablePress', 'url') ) ) {
			$link = '<a href="' . TablePress::url( array( 'action' => 'export', 'export_format' => 'json' ) ) . '">exporting</a>';
		}

		?>
		<div class="notice notice-success is-dismissible">
			<h1><strong>Your TablePress tables should be working again!</strong></h1>
			<p>Please check if you can edit your tables again.</p>
			<p>
			<?php if ( self::$_number_fixed_tables['wp51_update'] > 0 ) : ?>
				In total, <?php echo self::$_number_fixed_tables['wp51_update']; ?> table(s) with the WordPress 5.1 problem were restored.
			<?php endif; ?>
			<?php if ( self::$_number_fixed_tables['hack_script_tag'] > 0 ) : ?>
				In total, <?php echo self::$_number_fixed_tables['hack_script_tag']; ?> table(s) that were affected by a hack could be restored. You should probably still <a href="https://codex.wordpress.org/FAQ_My_site_was_hacked">check and clean</a> your site.
			<?php endif; ?>
			<?php if ( self::$_number_fixed_tables['hack_script_tag_failed'] > 0 ) : ?>
				<strong>There was a problem:</strong> <?php echo self::$_number_fixed_tables['hack_script_tag_failed']; ?> table(s) that were seemingly affected by a hack could <strong>NOT</strong> be restored.
			<?php endif; ?>
			</p>
			<p>If you are still experiencing problems with corrupted tables, please don't hesitate to contact me <a href="mailto:wordpress@tobias.baethge.com">via email</a>. In that case, please create a temporary admin account for me, so that I can take a direct look at the problem on your site.</p>
			<p>To prevent similar problems in the future, it is always recommended to create a backup, e.g. by <?php echo $link; ?> all your tables in the JSON format in a ZIP archive.</p>
			<?php if ( 0 === self::$_number_fixed_tables['hack_script_tag_failed'] ) : ?>
			<p><strong>You may now deactivate and delete the "TablePress Extension: Fix corrupted tables" plugin from your site again.</strong></p>
			<?php endif; ?>
			<?php if ( defined( 'TablePress::version' ) && version_compare( TablePress::version, '1.9.2', '<' ) ) : ?>
			<p><strong>Please update TablePress to the latest available version! Only this assures that you benefit from bug fixes and enhancements!</strong></p>
			<?php endif; ?>
		</div>
		<?php
	}

	/**
	 * Search and replace corrupted JSON code in the `wp_posts` database table, after the WordPress 5.1 update.
	 *
	 * @see https://core.trac.wordpress.org/ticket/46316
	 *
	 * @since 1.3
	 */
	protected static function _restore_tables_wp51_update() {
		global $wpdb;

		$search_replace_cases = array(
			'rel=\"noopener noreferrer\"'									=> 'rel=\\\"noopener noreferrer\\\"',
			'rel=\"\\\&quot;noopener\\\&quot; noopener noreferrer\"'		=> 'rel=\\\"noopener noreferrer\\\"',
			'rel=\"\\\&quot;noopener noopener noreferrer\" noreferrer\\\"'	=> 'rel=\\\"noopener noreferrer\\\"',
			'rel=\"\\&quot;noopener noopener noreferrer\" noreferrer\\\"'	=> 'rel=\\\"noopener noreferrer\\\"',
			'rel=\"\\\&quot;nofollow noopener noreferrer\" noopener\\\"'	=> 'rel=\\\"nofollow noopener noreferrer\\\"',
			'rel=\"\\&quot;nofollow noopener noreferrer\" noopener\\\"'		=> 'rel=\\\"nofollow noopener noreferrer\\\"',
			'rel=\"\\\&quot;nofollow\\\&quot; noopener noreferrer\"'		=> 'rel=\\\"nofollow noopener noreferrer\\\"',
			'rel=\"\\&quot;nofollow\\&quot; noopener noreferrer\"'			=> 'rel=\\\"nofollow noopener noreferrer\\\"',
			'rel=\"\\\&quot;nofollow noopener noreferrer\"'					=> 'rel=\\\"nofollow noopener noreferrer\\\"',
			'rel=\"\\&quot;nofollow noopener noreferrer\"'					=> 'rel=\\\"nofollow noopener noreferrer\\\"',
			'rel=\"\\\&quot;lightboxes\\\&quot; noopener noreferrer\"'		=> 'rel=\\\"lightboxes noopener noreferrer\\\"',
			'rel=\"\\&quot;lightboxes\\&quot; noopener noreferrer\"'		=> 'rel=\\\"lightboxes noopener noreferrer\\\"',
		);

		foreach ( $search_replace_cases as $search => $replace ) {
			$number_fixed_tables_query = $wpdb->query( "UPDATE `{$wpdb->posts}` SET `post_content` = REPLACE( `post_content`, '{$search}', '{$replace}' ) WHERE `post_type` = 'tablepress_table'" );
			self::$_number_fixed_tables['wp51_update'] += $number_fixed_tables_query;
		}
	}

	/**
	 * Search and replace corrupted JSON code in the `wp_posts` database table, with appended <script> tags from hacks.
	 *
	 * @since 1.3
	 */
	protected static function _restore_tables_hack_script_tag() {
		global $wpdb;

		// Find all TablePress tables that don't end in the JSON equivalent of a two-dimensional array ("]]) and thus have content (like <script> tags) after them.
		$corrupted_tables_posts = $wpdb->get_results( "SELECT `id`, `post_content` FROM `{$wpdb->posts}` WHERE ( `post_type` = 'tablepress_table' AND `post_content` NOT LIKE '%\"]]' )", ARRAY_A );

		if ( is_null( $corrupted_tables_posts ) ) {
			return;
		}

		foreach ( $corrupted_tables_posts as $table_post ) {
			/*
			 * Try to remove <script> tags at the end, by looking for <script> tags after the closing "]] of the JSON code.
			 * To be sure that it's the closing "]], the RegEx checks if there's a non-\ character followed by an even number of \ before the "]].
			 * This can not occur anywhere in the JSON string, as the " would be escaped with a single \, i.e. there can only be an odd number of \.
			 */
			$fixed_post_content = preg_replace( '@([^\\\\](?:\\\\\\\\)*"]])<script.*</script>$@i', '$1', $table_post['post_content'] );

			// Only write to the database if the fixed content is really JSON, to not risk data loss if something went wrong.
			if ( ! is_null( json_decode( $fixed_post_content, true ) ) ) {
				$wpdb->query( $wpdb->prepare( "UPDATE `{$wpdb->posts}` SET `post_content` = %s WHERE ( `ID` = %s AND `post_type` = 'tablepress_table' )", $fixed_post_content, $table_post['id'] ) );
				self::$_number_fixed_tables['hack_script_tag']++;
			} else {
				self::$_number_fixed_tables['hack_script_tag_failed']++;
			}
		}
	}

} // class TablePress_Restore_Corrupted_Tables

register_activation_hook( __FILE__, array( 'TablePress_Restore_Corrupted_Tables', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'TablePress_Restore_Corrupted_Tables', 'deactivate' ) );
add_action( 'admin_notices', array( 'TablePress_Restore_Corrupted_Tables', 'admin_notice' ) );
