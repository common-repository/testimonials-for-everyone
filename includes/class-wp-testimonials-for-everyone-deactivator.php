<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://wppforeveryone.com
 * @since      1.0.0
 *
 * @package    Wppfe_Testimonials_For_Everyone
 * @subpackage Wppfe_Testimonials_For_Everyone/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Wppfe_Testimonials_For_Everyone
 * @subpackage Wppfe_Testimonials_For_Everyone/includes
 * @author     wppforeveryone <info@wppforeveryone.com>
 */
class Wppfe_Testimonials_For_Everyone_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
		global $wpdb;

		$table_name = $wpdb->prefix . 'wpfe_testimonials';
		$shortcode_table = $wpdb->prefix . 'wpfe_testimonials_shortcode';

		$wpdb->query( $wpdb->prepare( "DROP TABLE IF EXISTS %s", $table_name ) );
		$wpdb->query( $wpdb->prepare( "DROP TABLE IF EXISTS %s", $shortcode_table ) );
	}

}
