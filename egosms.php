<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/ABHarop
 * @since             1.0.0
 * @package           Egosms
 *
 * @wordpress-plugin
 * Plugin Name:       EgoSMS
 * Plugin URI:        https://github.com/ABHarop/egosms
 * Description:       The EgoSMS Plugin integrates the Ego SMS Bulk messaging platform to your WordPress website.
 * Version:           1.0.0
 * Author:            Arop Boniface
 * Author URI:        https://github.com/ABHarop
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       egosms
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'EGOSMS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-egosms-activator.php
 */
function activate_egosms() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-egosms-activator.php';
	Egosms_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-egosms-deactivator.php
 */
function deactivate_egosms() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-egosms-deactivator.php';
	Egosms_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_egosms' );
register_deactivation_hook( __FILE__, 'deactivate_egosms' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-egosms.php';

// Display the egosms on the left panel
function egosms(){
    add_menu_page(
        __( 'EgoSMS', 'textdomain' ),
        'EgoSMS',
        'manage_options', //  The capability required for this menu to be displayed to the user.
        'EgoSMS',
        'egosms_page',
       // PLUGIN_URL . '/assets/img/icon.png', 110
    );

}

// importing external css
function import_scripts_and_styles() {
    // To enqueue style.css
    wp_enqueue_style( 'style.css', get_stylesheet_directory_uri() . 'assets/css/style.css', array(), time(), false );
    // To enqueue custom-script.js
    wp_enqueue_script( 'custom-js', get_stylesheet_directory_uri() . '/assets/js/custom-script.js', array(), "", true );
}
add_action('wp_enqueue_scripts', 'import_scripts_and_styles');

add_action( 'admin_menu','egosms' );

function egosms_page(){
    require_once 'pages/admin.php';
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_egosms() {

	$plugin = new Egosms();
	$plugin->run();

}
run_egosms();
