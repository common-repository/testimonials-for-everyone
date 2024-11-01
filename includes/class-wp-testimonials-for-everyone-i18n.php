<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://wppforeveryone.com
 * @since      1.0.0
 *
 * @package    Wppfe_Testimonials_For_Everyone
 * @subpackage Wppfe_Testimonials_For_Everyone/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wppfe_Testimonials_For_Everyone
 * @subpackage Wppfe_Testimonials_For_Everyone/includes
 * @author     wppforeveryone <info@wppforeveryone.com>
 */
class Wppfe_Testimonials_For_Everyone_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'testimonials-for-everyone',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
