<?php

namespace threewp_broadcast\premium_pack\queue;

/**
	@brief		Handle post actions.
	@since		2020-12-17 11:12:22
**/
class Post_Action_Queue
	extends \threewp_broadcast\premium_pack\base
	implements Data_Processor_Interface
{
	/**
		@brief		The type of queue data we handle.
		@since		2017-09-24 19:34:57
	**/
	public static $queue_data_type = 'post_action';

	/**
		@brief		Which post actions do we listen for?
		@since		2020-12-17 11:27:11
	**/
	public static $post_actions = [ 'find_unlinked' ];

	public function _construct()
	{
		$this->add_action( 'broadcast_queue_display_settings' );
		$this->add_action( 'broadcast_queue_process_data_item' );
		$this->add_action( 'broadcast_queue_save_settings' );
		$this->add_action( 'broadcast_queue_show_queue_table_data' );
		$this->add_action( 'threewp_broadcast_post_action', 9 );		// Just before Broadcast itself.
	}

	/**
		@brief		broadcast_queue_display_settings
		@since		2017-12-20 14:54:12
	**/
	public function broadcast_queue_display_settings( $action )
	{
		$form = $action->form;

		$fs = $form->fieldset( 'fs_post_actions' )
			// Fieldset label for post settings
			->label( __( 'Post actions', 'threewp_broadcast' ) );

		$m_posts = $fs->markup( 'm_posts' )
			->p( __( 'These settings apply to low priority post actions. Currently only the find unlinked post action.', 'threewp_broadcast' ) );

		$fs->checkbox( 'use_post_action_queue' )
			->checked( $this->get_site_option( 'use_post_action_queue' ) )
			// Input title / description
			->description( __( 'Use the queue system for post actions.', 'threewp_broadcast' ) )
			// Input label
			->label( __( 'Enabled for posta actions', 'threewp_broadcast' ) );
	}

	/**
		@brief		broadcast_queue_process_data_item
		@since		2017-08-13 21:45:18
	**/
	public function broadcast_queue_process_data_item( actions\process_data_item $action )
	{
		if ( $action->data->type != static::$queue_data_type )
			return;

		$post_action = $action->data->uncompress();

		// By switching to high prio we won't be intercepting this action anymore.
		$post_action->high_priority = true;

		switch_to_blog( $post_action->parent_blog_id );
		$post_action->execute();
		restore_current_blog();

		// We're done!
		$action->result = true;
	}

	/**
		@brief		Save the settings.
		@since		2017-12-20 15:03:19
	**/
	public function broadcast_queue_save_settings( $action )
	{
		$form = $action->form;

		$value = $form->get_post_value( 'use_post_action_queue' );
		$this->update_site_option( 'use_post_action_queue', $value );
	}

	/**
		@brief		broadcast_queue_show_queue_table_data
		@since		2017-08-13 22:51:57
	**/
	public function broadcast_queue_show_queue_table_data( actions\show_queue_table_data $action )
	{
		if ( $action->data->type != static::$queue_data_type )
			return;

		$pd = broadcast_queue()->new_process_data();
		$pd->parent_blog_id = $action->item->parent_blog_id;
		$pd->parent_post_id = $action->item->parent_post_id;
		$pd->item_count = 1;
		$pd->build();

		$post_action = $action->data->uncompress();

		$text = sprintf( "Post action: %s for post %s on blog %s",
			$post_action->action,
			$post_action->post_id,
			$post_action->parent_blog_id
		);

		$action->row->td( 'details' )->text( wpautop( $text ) . $pd->html );
	}

	/**
		@brief		Site options.
		@since		2017-12-20 15:00:03
	**/
	public function site_options()
	{
		return array_merge( [
			/**
				@brief		Use the action queue?
				@since		2020-12-17 11:15:57
			**/
			'use_post_action_queue' => true,
		], parent::site_options() );
	}

	/**
		@brief		Intercept the post action action.
		@since		2020-12-17 11:16:11
	**/
	public function threewp_broadcast_post_action( $action )
	{
		// We must be interested in this post action.
		if ( ! in_array( $action->action, static::$post_actions ) )
			return;

		// Action must be low prio.
		if ( $action->high_priority )
			return;

		$use_queue = broadcast_queue()->is_enabled();
		$use_queue &= $this->get_site_option( 'use_post_action_queue' );

		if ( ! $use_queue )
		{
			$this->debug( 'Queue is not enabled for post actions.' );
			return;
		}

		// We save this so that we know which blog to use as the parent.
		$action->parent_blog_id = get_current_blog_id();

		// Create a new queue data object.
		$insert_data_action = broadcast_queue()->new_action( 'insert_data' );
		$insert_data_action->blogs = [ get_current_blog_id() ];
		$insert_data_action->data->created = $this->now();
		$insert_data_action->data->compress( $action );
		$insert_data_action->data->type = static::$queue_data_type;
		$insert_data_action->data->parent_blog_id = $action->parent_blog_id;
		$insert_data_action->data->parent_post_id = $action->post_id;
		$insert_data_action->execute();

		$action->finish();
	}
}
