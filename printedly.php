<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://expresspixel.com
 * @since             1.0.0
 * @package           Printedly
 *
 * @wordpress-plugin
 * Plugin Name:       printedly
 * Plugin URI:        http://printedly.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Printedly
 * Author URI:        http://expresspixel.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       printedly
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-printedly-activator.php
 */
function activate_printedly() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-printedly-activator.php';
	Printedly_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-printedly-deactivator.php
 */
function deactivate_printedly() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-printedly-deactivator.php';
	Printedly_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_printedly' );
register_deactivation_hook( __FILE__, 'deactivate_printedly' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-printedly.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_printedly() {

	$plugin = new Printedly();
	$plugin->run();

}
run_printedly();
