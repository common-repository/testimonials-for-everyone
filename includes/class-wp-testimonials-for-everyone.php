<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://wppforeveryone.com
 * @since      1.0.0
 *
 * @package    Wppfe_Testimonials_For_Everyone
 * @subpackage Wppfe_Testimonials_For_Everyone/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Wppfe_Testimonials_For_Everyone
 * @subpackage Wppfe_Testimonials_For_Everyone/includes
 * @author     wppforeveryone <info@wppforeveryone.com>
 */
class Wppfe_Testimonials_For_Everyone {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Wppfe_Testimonials_For_Everyone_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $plugin_name The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string $version The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'WPPE_TESTIMONIALS_FOR_EVERYONE_VERSION' ) ) {
			$this->version = WPPFE_TESTIMONIALS_FOR_EVERYONE_VERSION;
		} else {
			$this->version = '1.5.1';
		}
		$this->plugin_name = 'testimonials-for-everyone';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}


	private function load_dependencies() {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-testimonials-for-everyone-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wp-testimonials-for-everyone-i18n.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wp-testimonials-for-everyone-admin.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wp-testimonials-for-everyone-public.php';

		$this->loader = new Wppfe_Testimonials_For_Everyone_Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Wpfe_Testimonials_For_Everyone_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {
		$plugin_i18n = new Wppfe_Testimonials_For_Everyone_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$plugin_admin = new Wppfe_Testimonials_For_Everyone_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		$this->loader->add_action( 'enqueue_block_editor_assets', $plugin_admin, 'wpte_enqueue_block_editor_assets' );
		$this->loader->add_action( 'enqueue_block_assets', $plugin_admin, 'wpte_enqueue_block_assets' );
		$this->loader->add_action( 'init', $plugin_admin, 'wpte_register_testimonial_block' );
		$this->loader->add_action('wp_ajax_wpte_save_testimonials', $plugin_admin, 'wpte_save_testimonials');
		$this->loader->add_action('wp_ajax_nopriv_wpte_save_testimonials', $plugin_admin, 'wpte_save_testimonials');
		$this->loader->add_action('wp_ajax_wpte_fetch_testimonials', $plugin_admin, 'wpte_fetch_testimonials');
		$this->loader->add_action('wp_ajax_nopriv_wpte_fetch_testimonials', $plugin_admin, 'wpte_fetch_testimonials');
		$this->loader->add_action('wp_ajax_wpte_delete_testimonial', $plugin_admin, 'wpte_delete_testimonial');
		$this->loader->add_action('admin_notices', $plugin_admin, 'wppfetfe_admin_notices');
		$this->loader->add_action('wp_ajax_wppfetfe_dismiss_notice', $plugin_admin, 'wppfetfe_dismiss_notice');

		$this->loader->add_action('admin_menu', $plugin_admin, 'wpte_add_plugin_admin_menu');

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {
		$plugin_public = new Wppfe_Testimonials_For_Everyone_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @return    string    The name of the plugin.
	 * @since     1.0.0
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @return    Wppfe_Testimonials_For_Everyone_Loader    Orchestrates the hooks of the plugin.
	 * @since     1.0.0
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @return    string    The version number of the plugin.
	 * @since     1.0.0
	 */
	public function get_version() {
		return $this->version;
	}

}
