<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://wppforeveryone.com
 * @since      1.0.0
 *
 * @package    Wppfe_Testimonials_For_Everyone
 * @subpackage Wppfe_Testimonials_For_Everyone/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wppfe_Testimonials_For_Everyone
 * @subpackage Wppfe_Testimonials_For_Everyone/public
 * @author     wppforeveryone <info@wppforeveryone.com>
 */
class Wppfe_Testimonials_For_Everyone_Public {


	private $plugin_name;
	private $version;

	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
	}

	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_name,
			plugin_dir_url( __FILE__ ) . 'css/wp-testimonials-for-everyone-public.css',
			array(),
			$this->version,
			'all' );
	}

	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name,
			plugin_dir_url( __FILE__ ) . 'js/wp-testimonials-for-everyone-public.js',
			array( 'jquery' ),
			$this->version,
			false );
	}

}
