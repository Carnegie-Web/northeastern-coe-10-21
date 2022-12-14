<?php

namespace Tribe\Events\Pro\Admin\Manager;

use Tribe__Main;

/**
 * Class Settings configurations for Calendar Manager.
 *
 * @since   5.9.0
 *
 * @package Tribe\Events\Pro\Admin\Manager
 */
class Settings {

	/**
	 * Modify the General Settings tabs fields to include Calendar Manager checkbox.
	 *
	 * @since 5.9.0
	 *
	 * @param array $fields Previous fields on the General Settings.
	 *
	 * @return array Modified fields.
	 */
	public function filter_include_settings( array $fields = [] ) {
		$fields = Tribe__Main::array_insert_after_key(
			'tribeEventsMiscellaneousTitle',
			$fields,
			$this->get_activate_settings()
		);

		return $fields;
	}

	/**
	 * Fetches the setting field for calendar manager checkbox.
	 *
	 * @since 5.9.0
	 *
	 * @return array[] Return the fields related to the calendar manager.
	 */
	public function get_activate_settings() {
		return [
			'default_admin_calendar_manager' => [
				'type'            => 'checkbox_bool',
				'label'           => esc_html__( 'Calendar Manager', 'tribe-events-calendar-pro' ),
				'tooltip'         => esc_html__( 'Enable the Calendar Manager as the default page for viewing Events on the Administration page.', 'tribe-events-calendar-pro' ),
				'default'         => false,
				'validation_type' => 'boolean',
			],
		];
	}

	/**
	 * Determines if the calendar manager is being used as the default.
	 *
	 * @since 5.9.0
	 *
	 *
	 * @return bool
	 */
	public function use_calendar_manager() {
		return tribe_is_truthy( tribe_get_option( 'default_admin_calendar_manager', false ) );
	}
}