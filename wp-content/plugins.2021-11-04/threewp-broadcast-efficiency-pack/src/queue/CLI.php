<?php

namespace threewp_broadcast\premium_pack\queue;

use \WP_CLI;

/**
 * Broadcast commands to handle broadcasting and linking.
 * @since		2018-10-31 18:14:07
**/
class CLI
{
	/**
		* Process the queue.
		* @since		2021-04-07 21:00:51
	**/
	public function process()
	{
		WP_CLI::line( 'Processing the queue...' );
		broadcast_queue()->http_process();
	}
}
