<?php

namespace threewp_broadcast\premium_pack\rebroadcaster
{

/**
	@brief			Periodically and automatically rebroadcast specific posts.
	@plugin_group	Efficiency
	@since			2021-08-25 20:04:59
**/
class Rebroadcaster
	extends \threewp_broadcast\premium_pack\base
{
	/**
		@brief		The meta key that specifies how often to rebroadcast.
		@since		2021-08-25 20:05:11
	**/
	public static $rebroadcast_hours_meta_key = 'broadcast_rebroadcast_hours';

	public function _construct()
	{
		$this->add_action( 'broadcast_rebroadcast_post' );
		$this->add_action( 'threewp_broadcast_broadcasting_started' );
		$this->add_action( 'threewp_broadcast_prepare_meta_box' );
	}

	// --------------------------------------------------------------------------------------------
	// ----------------------------------------- Admin
	// --------------------------------------------------------------------------------------------

	// --------------------------------------------------------------------------------------------
	// ----------------------------------------- Callbacks
	// --------------------------------------------------------------------------------------------

	/**
		@brief		Rebroadcast this post now.
		@since		2021-08-25 20:05:11
	**/
	public function broadcast_rebroadcast_post( $post_id )
	{
		$this->debug( 'Going to rebroadcast post %s on blog %s.', $post_id, get_current_blog_id() );

		ThreeWP_Broadcast()
			->api()
			->update_children( $post_id );

		$this->maybe_schedule_rebroadcast( $post_id );

		$this->debug( 'Done rebroadcasting post %s.', $post_id );
		exit;
	}

	/**
		@brief		Started.
		@since		2021-07-20 22:51:06
	**/
	public function threewp_broadcast_broadcasting_started( $action )
	{
		$bcd = $action->broadcasting_data;

		$this->handle_meta_box_data( $bcd );

		$this->maybe_schedule_rebroadcast( $bcd->post->ID );
	}

	/**
		@brief		Modify the meta box with modification data.
		@since		20131016
	**/
	public function threewp_broadcast_prepare_meta_box( $action )
	{
		$meta_box_data = $action->meta_box_data;
		$form = $meta_box_data->form;
		$post = $action->meta_box_data->post;

		$rebroadcast_hours = get_post_meta( $post->ID, static::$rebroadcast_hours_meta_key, true );
		$rebroadcast_hours = intval( $rebroadcast_hours );

		$broadcast_rebroadcast_hours_input = $form->number( 'broadcast_rebroadcast_hours' )
			->description( 'How often to rebroadcast the post.' )
			->label( 'Rebroadcast hours' )
			->min( 0 )
			->value( $rebroadcast_hours );
		$meta_box_data->convert_form_input_later( 'broadcast_rebroadcast_hours' );
	}

	// --------------------------------------------------------------------------------------------
	// ----------------------------------------- Misc functions
	// --------------------------------------------------------------------------------------------

	/**
		@brief		Handle the input from the meta box.
		@since		2021-09-30 11:11:29
	**/
	public function handle_meta_box_data( $bcd )
	{
		$mbd = $bcd->meta_box_data;

		if ( $this->user_id() < 1 )
			return $this->debug( 'Not a real user.' );

		$input = $mbd->form->input( 'broadcast_rebroadcast_hours' );
		if ( ! $input )
			return;

		$rebroadcast_hours = $input->get_filtered_post_value();

		if ( $rebroadcast_hours < 1 )
		{
			$this->debug( 'Not going to rebroadcast.' );
			delete_post_meta( $bcd->post->ID, static::$rebroadcast_hours_meta_key );
			return;
		}

		$bcd->custom_fields()->set( static::$rebroadcast_hours_meta_key, $rebroadcast_hours );

		$this->debug( 'Post will be rebroadcasted every %s hours.', $rebroadcast_hours );

	}

	/**
		@brief		Schedule a rebroadcast of this post.
		@since		2021-08-22 22:07:57
	**/
	public function maybe_schedule_rebroadcast( $post_id )
	{
		$rebroadcast_hours = get_post_meta( $post_id, static::$rebroadcast_hours_meta_key, true );

		if ( $rebroadcast_hours < 1 )
		{
			$this->debug( 'Post %s does not want to be rebroadcasted.', $post_id );
			wp_clear_scheduled_hook( 'broadcast_rebroadcast_post', [ $post_id ] );
			return;
		}

		$next_time = time() + ( $rebroadcast_hours * HOUR_IN_SECONDS );

		$this->debug( 'Scheduling a rebroadcast in %s (GMT) + %d hours = %s (GMT)',
			date( 'Y-m-d H:i:s', time() ),
			$rebroadcast_hours,
			date( 'Y-m-d H:i', $next_time )
		);
		wp_schedule_single_event( $next_time, 'broadcast_rebroadcast_post', [ $post_id ] );
	}
}

} // namespace

namespace
{
	function Broadcast_Rebroadcaster()
	{
		return threewp_broadcast\premium_pack\rebroadcaster\Rebroadcaster::instance();
	}
}
