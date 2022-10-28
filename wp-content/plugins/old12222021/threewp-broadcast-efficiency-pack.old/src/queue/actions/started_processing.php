<?php

namespace threewp_broadcast\premium_pack\queue\actions;

/**
	@brief		The queue has begun processing items.
	@details	This action knows that there are items to be processed.
	@since		2021-01-22 20:50:13
**/
class started_processing
	extends action
{
	/**
		@brief		IN: The POST data.
		@since		2021-01-22 20:53:39
	**/
	public $post;
}
