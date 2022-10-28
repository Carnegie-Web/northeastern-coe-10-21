<?php

namespace threewp_broadcast\premium_pack;

class ThreeWP_Broadcast_Efficiency_Pack
	extends \threewp_broadcast\premium_pack\Plugin_Pack
{
	public $plugin_version = BROADCAST_EFFICIENCY_PACK_VERSION;

	public function edd_get_item_name()
	{
		return 'ThreeWP Broadcast Efficiency Pack';
	}

	public function get_plugin_classes()
	{
		return
		[
			__NAMESPACE__ . '\\blog_groups\\Blog_Groups_2',
			__NAMESPACE__ . '\\duplicate_attachments\\Duplicate_Attachments',
			__NAMESPACE__ . '\\find_some_unlinked_children\\Find_Some_Unlinked_Children',
			__NAMESPACE__ . '\\new_blog_broadcast\\New_Blog_Broadcast',
			__NAMESPACE__ . '\\purge_children\\Purge_Children',
			__NAMESPACE__ . '\\queue\\Queue',
			__NAMESPACE__ . '\\rebroadcast\\Rebroadcast',
			__NAMESPACE__ . '\\rebroadcaster\\Rebroadcaster',
			__NAMESPACE__ . '\\send_to_many\\Send_To_Many',
		];
	}

	/**
		@brief		Show our license in the tabs.
		@since		2015-10-28 15:10:14
	**/
	public function threewp_broadcast_plugin_pack_tabs( $action )
	{
		$action->tabs->tab( 'efficiency_pack' )
			->callback( [ $this, 'edd_admin_license_tab' ] )		// this, because the tabs object comes from plugin pack, not from here.
			->name_( 'Efficiency pack license' );
	}
}
