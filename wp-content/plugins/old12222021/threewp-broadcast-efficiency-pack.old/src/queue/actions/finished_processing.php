<?php

namespace threewp_broadcast\premium_pack\queue\actions;

/**
	@brief		The queue has finished processing for this time.
	@details	This action knows that items were broadcasted.
	@since		2021-01-22 20:50:13
**/
class finished_processing
	extends action
{
	/**
		@brief		IN: The ajax data that is returned to the user.
		@since		2021-01-22 20:53:27
	**/
	public $ajax;

	/**
		@brief		IN: The POST data.
		@since		2021-01-22 20:53:39
	**/
	public $post;
}
