<?php

namespace fse_wpeaxf\Inc\Core;

/**
 * Fired during plugin deactivation
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @link       http://www.fse-online.co.uk
 * @since      2.1.3
 *
 * @author     FSE Online Ltd
 */

class Deactivator {

	/**
	 * Short Description.
	 *
	 * Long Description.
	 *
	 * @since    2.1.3
	 */
	public static function deactivate() {
		// cron job will refresh upon deactivate already 

	}

}
