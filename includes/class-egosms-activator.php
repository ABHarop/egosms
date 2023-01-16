<?php

/**
 * Fired during plugin activation
 *
 * @link       https://github.com/ABHarop
 * @since      1.0.0
 *
 * @package    Egosms
 * @subpackage Egosms/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Egosms
 * @subpackage Egosms/includes
 * @author     Arop Boniface <arop@pahappa.com>
 */
class Egosms_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
		$prefix = $wpdb->prefix;
		$message_tb = $prefix . "egosms_messages";

		//Check if table exists. In case it's false we create it
		if($wpdb->get_var("SHOW TABLES LIKE '$message_tb'") !== $message_tb){
			$msql = "CREATE TABLE $message_tb(
				id mediumint unsigned not null primary key auto_increment,
				recipient varchar(20),
				message text
			)";

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($msql);
		}

	}

}
