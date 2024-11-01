<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wppfe.com
 * @since             1.0.0
 * @package           Wppfe_Testimonials_For_Everyone
 *
 * @wordpress-plugin
 * Plugin Name:       Testimonials For Everyone
 * Plugin URI:        https://wppfe.com
 * Description:       "Testimonials for Everyone" is a WordPress plugin designed to easily add beautifully styled testimonials to your posts and pages. With seamless integration into the Gutenberg block editor, it allows users to customize and display testimonials that enhance trust and credibility on any part of their site. Perfect for showcasing customer feedback with modern, responsive designs.
 * Version:           1.5.1
 * Author:            wppfe
 * Author URI:        https://wppfe.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       testimonials-for-everyone
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


define( 'WPPFE_TESTIMONIALS_FOR_EVERYONE_VERSION', '1.5.1' );

function wppfetest_activate_wppfe_testimonials_for_everyone() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-testimonials-for-everyone-activator.php';
	$current_time = current_time('mysql');
	update_option('wppfe_testimonialsfe_activation_time', $current_time);
	Wppfe_Testimonials_For_Everyone_Activator::activate();
}


function wppfetest_deactivate_wppfe_testimonials_for_everyone() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-testimonials-for-everyone-deactivator.php';
	delete_option('wppfe_testimonialsfe_activation_time');
	Wppfe_Testimonials_For_Everyone_Deactivator::deactivate();
}


register_activation_hook( __FILE__, 'wppfetest_activate_wppfe_testimonials_for_everyone' );
register_deactivation_hook( __FILE__, 'wppfetest_deactivate_wppfe_testimonials_for_everyone' );

require plugin_dir_path( __FILE__ ) . 'includes/class-wp-testimonials-for-everyone.php';


function wppfetest_run_wppfe_testimonials_for_everyone() {

	$plugin = new Wppfe_Testimonials_For_Everyone();
	$plugin->run();

}
wppfetest_run_wppfe_testimonials_for_everyone();
