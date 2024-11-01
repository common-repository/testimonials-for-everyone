<?php

/**
 * Fired during plugin activation
 *
 * @link       https://wppforeveryone.com
 * @since      1.0.0
 *
 * @package    Wppfe_Testimonials_For_Everyone
 * @subpackage Wppfe_Testimonials_For_Everyone/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wppfe_Testimonials_For_Everyone
 * @subpackage Wppfe_Testimonials_For_Everyone/includes
 * @author     wppforeveryone <info@wppforeveryone.com>
 */
class Wppfe_Testimonials_For_Everyone_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;

		$table_name = $wpdb->prefix . 'wpfe_testimonials';
		$shortcode_table = $wpdb->prefix . 'wpfe_testimonial_shortcodes';

		$charset_collate = $wpdb->get_charset_collate();

		$sql1 = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        post_id bigint(20) NOT NULL,
        image_url varchar(255) DEFAULT '' NOT NULL,
        author varchar(100) DEFAULT '' NOT NULL,
        company varchar(100) DEFAULT '' NOT NULL,
        content text NOT NULL,
        link varchar(255) DEFAULT '' NOT NULL,
        rating int(5) DEFAULT 5 NOT NULL,
        testimonial_order int(11) DEFAULT 0 NOT NULL,
        PRIMARY KEY  (id),
        INDEX idx_post_id (post_id),
        INDEX idx_author (author),
        INDEX idx_company (company),
        INDEX idx_testimonial_order (testimonial_order)
    ) $charset_collate;";

		$sql2 = "CREATE TABLE $shortcode_table (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        shortcode varchar(100) NOT NULL,
        post_id bigint(20) NOT NULL,
        PRIMARY KEY (id),
        UNIQUE KEY shortcode (shortcode),
        INDEX idx_post_id (post_id)
    ) $charset_collate;";

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql1);
		dbDelta($sql2);
	}


}
