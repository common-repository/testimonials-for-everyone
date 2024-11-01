<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://wppforeveryone.com
 * @since      1.0.0
 *
 * @package    Wppfe_Testimonials_For_Everyone
 * @subpackage Wppfe_Testimonials_For_Everyone/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wppfe_Testimonials_For_Everyone
 * @subpackage Wppfe_Testimonials_For_Everyone/admin
 * @author     wppforeveryone <info@wppforeveryone.com>
 */
class Wppfe_Testimonials_For_Everyone_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $plugin_name The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string $version The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param string $plugin_name The name of this plugin.
	 * @param string $version The version of this plugin.
	 *
	 * @since    1.0.0
	 */
	public function __construct( $plugin_name, $version ) {
		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		$this->wppfetfe_register_testimonial_shortcode();
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		$screen = get_current_screen();

		if ( isset( $screen->id ) && in_array( $screen->id,
				[
					'toplevel_page_testimonialsfe-overview',
					'testimonials-for-everyone_page_testimonialsfe-help',
					'testimonials-for-everyone_page_testimonialsfe-support'
				] ) ) {
			wp_enqueue_style( 'tailwindcss',
				'https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css',
//				array(),
				$this->version,
				'all'
			);
		}

		wp_enqueue_style( $this->plugin_name,
			plugin_dir_url( __FILE__ ) . 'css/wp-testimonials-for-everyone-admin.css',
			array(),
//			time(),
			$this->version,
			'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_name . '-masonry',
			plugin_dir_url( __FILE__ ) . 'js/masonry.js',
			array( 'jquery' ),
//			time(),
			$this->version,
			false );

		wp_enqueue_script( $this->plugin_name,
			plugin_dir_url( __FILE__ ) . 'js/wp-testimonials-for-everyone-admin.js',
			array( 'jquery' ),
//			time(),
			$this->version,
			false );
	}

	function wpte_enqueue_block_editor_assets() {
		wp_enqueue_script(
			'wpte-block-js',
			plugins_url( 'js/dist/block.js', __FILE__ ),
			array( 'wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor' ),
//			time(),
            $this->version
		);

		wp_enqueue_style(
			'wpte-testimonials-editor-style',
			plugins_url( 'css/editor.css', __FILE__ ),
			array( 'wp-edit-blocks' ),
			$this->version,
//			time()
		);
	}

	function wpte_enqueue_block_assets() {
		wp_enqueue_style(
			'wpte-testimonials-style',
			plugins_url( 'css/style.css', __FILE__ ),
			array(),
//			time()
			$this->version
		);
	}

	function wpte_render_testimonial_block( $attributes, $postIdFrom = null ) {
		global $wpdb;
		global $post;

		$table_name = $wpdb->prefix . 'wpfe_testimonials';
		$post_id    = isset( $attributes['postId'] ) ? (int) $attributes['postId'] : $post->ID;

		$testimonials = $wpdb->get_results( $wpdb->prepare(
			"SELECT * FROM {$table_name} WHERE post_id = %d ORDER BY testimonial_order ASC",
			$post_id
		) );

		if ( empty( $testimonials ) ) {
			return '<p>' . __( 'No testimonials exist. Please add some testimonials.',
					'testimonials-for-everyone' ) . '</p>';
		}

		ob_start();

		$imageAligment            = $attributes['imageAlign'] ?? 'left';
		$showCompany              = $attributes['showCompany'] ?? true;
		$showImage                = $attributes['showImage'] ?? true;
		$testimonialsLayout       = $attributes['testimonialsLayout'] ?? 'standard';
		$showRating               = $attributes['showRating'] ?? true;
		$testimonialsNumberInGrid = $attributes['testimonialsNumberInGrid'] ?? 2;

		echo '<div class="wpte-testimonials ' . esc_attr( $testimonialsLayout ?? '' ) . '"';

		if ( isset( $testimonialsLayout ) && ( $testimonialsLayout !== 'standard' || $testimonialsLayout !== 'masonry' ) ) {
			echo ' style="column-count: 2; grid-template-columns: repeat(' . esc_attr( $testimonialsNumberInGrid ) . ', 1fr)"';
		}

		echo '>';

		foreach ( $testimonials as $testimonial ) {
			$gridRow = '';
			if ( isset( $testimonialsLayout ) && $testimonialsLayout === 'masonry' ) {
				$randomSpan = random_int( 10, 30 );
				$gridRow    = ' grid-row: span ' . esc_attr( $randomSpan ) . '; ';
			}
			?>
            <div class="testimonial" style="background-color: <?php
			echo esc_attr( $attributes['backgroundColor'] ); ?>; border: <?php
			echo esc_attr( $attributes['borderSize'] ); ?>px solid <?php
			echo esc_attr( $attributes['borderColor'] ); ?>; border-radius: <?php
			echo esc_attr( $attributes['borderRadius'] ); ?>px;
                    padding-top: <?php
			echo esc_attr( $attributes['paddingTop'] ); ?>px;
                    padding-bottom: <?php
			echo esc_attr( $attributes['paddingBottom'] ?? 0 ); ?>px;
                    padding-left: <?php
			echo esc_attr( $attributes['paddingLeft'] ?? 0 ); ?>px;
                    padding-right: <?php
			echo esc_attr( $attributes['paddingRight'] ?? 0 ); ?>px;
			<?php
			echo $gridRow; ?>
                    ">
				<?php
				if ( $imageAligment === 'left' ) : ?>
                    <div style="display: flex; align-items: center;">
						<?php

						if ( $showImage && $testimonial->image_url ): ?>
                            <div style="width: <?php
							echo esc_attr( $attributes['imageSize'] ); ?>px; height: <?php
							echo esc_attr( $attributes['imageSize'] ); ?>px; background-image: url('<?php
							echo esc_url( $testimonial->image_url ); ?>'); background-size: cover; background-position: center; border-radius: <?php
							echo esc_attr( $attributes['imageRounded'] ? '50%' : '0' ); ?>; margin-right: 10px;"></div>
						<?php
						endif; ?>
                        <div>
                            <p class="author" style="
                                    color: <?php
							echo esc_attr( $attributes['authorColor'] ); ?>;
                                    font-size: <?php
							echo esc_attr( $attributes['authorFontSize'] ); ?>px;
                                    font-weight: <?php
							echo esc_attr( $attributes['authorFontWeight'] ); ?>;
                                    ">
								<?php
								echo esc_html( $testimonial->author ); ?></p>
							<?php
							if ( $showCompany && $testimonial->company ): ?>
                                <p class="company" style="
                                        color: <?php
								echo esc_attr( $attributes['companyColor'] ); ?>;
                                        font-size: <?php
								echo esc_attr( $attributes['companyFontSize'] ); ?>px;
                                        font-weight: <?php
								echo esc_attr( $attributes['companyFontWeight'] ); ?>;
                                        ">
									<?php
									echo esc_html( $testimonial->company ); ?></p>
							<?php
							endif; ?>
                        </div>
                    </div>
				<?php
				endif; ?>

				<?php
				if ( $imageAligment === 'center' ) : ?>
                    <div>
						<?php
						if ( $showImage && $testimonial->image_url ): ?>
                            <div style="text-align:center;">
                                <div style="width: <?php
								echo esc_attr( $attributes['imageSize'] ); ?>px; margin:0 auto; height: <?php
								echo esc_attr( $attributes['imageSize'] ); ?>px; background-image: url('<?php
								echo esc_url( $testimonial->image_url ); ?>'); background-size: cover; background-position: center; border-radius: <?php
								echo esc_attr( $attributes['imageRounded'] ? '50%' : '0' ); ?>;"></div>
                            </div>
						<?php
						endif; ?>
                        <div>
                            <p class="author" style="
                                    color: <?php
							echo esc_attr( $attributes['authorColor'] ); ?>;
                                    text-align: <?php
							echo esc_attr( $attributes['authorAlign'] ); ?>;
                                    font-size: <?php
							echo esc_attr( $attributes['authorFontSize'] ); ?>px;
                                    font-weight: <?php
							echo esc_attr( $attributes['authorFontWeight'] ); ?>;
                                    ">
								<?php
								echo esc_html( $testimonial->author ); ?></p>
							<?php
							if ( $showCompany && $testimonial->company ): ?>
                                <p class="company" style="
                                        color: <?php
								echo esc_attr( $attributes['companyColor'] ); ?>;
                                        text-align: <?php
								echo esc_attr( $attributes['companyAlign'] ); ?>;
                                        font-size: <?php
								echo esc_attr( $attributes['companyFontSize'] ); ?>px;
                                        font-weight: <?php
								echo esc_attr( $attributes['companyFontWeight'] ); ?>;">
									<?php
									echo esc_html( $testimonial->company ); ?></p>
							<?php
							endif; ?>
                        </div>
                    </div>
				<?php
				endif; ?>

				<?php
				if ( $imageAligment === 'right' ) : ?>
                    <div style="display: flex; align-items: center; flex-direction: row-reverse;">
						<?php
						if ( $showImage && $testimonial->image_url ): ?>
                            <div style="width: <?php
							echo esc_attr( $attributes['imageSize'] ); ?>px; height: <?php
							echo esc_attr( $attributes['imageSize'] ); ?>px; background-image: url('<?php
							echo esc_url( $testimonial->image_url ); ?>'); background-size: cover; background-position: center; border-radius: <?php
							echo esc_attr( $attributes['imageRounded'] ? '50%' : '0' ); ?>; margin-left: 10px;"></div>
						<?php
						endif; ?>
                        <div>
                            <p class="author" style="
                                    color: <?php
							echo esc_attr( $attributes['authorColor'] ); ?>;
                                    text-align:right;
                                    font-size: <?php
							echo esc_attr( $attributes['authorFontSize'] ); ?>px;">
								<?php
								echo esc_html( $testimonial->author ); ?></p>
							<?php
							if ( $showCompany && $testimonial->company ): ?>
                                <p class="company" style="
                                        color: <?php
								echo esc_attr( $attributes['companyColor'] ); ?>;
                                        text-align:right;
                                        font-size: <?php
								echo esc_attr( $attributes['companyFontSize'] ); ?>px;">
									<?php
									echo esc_html( $testimonial->company ); ?></p>
							<?php
							endif; ?>
                        </div>
                    </div>
				<?php
				endif; ?>

                <p class="content" style="
                        margin-top: 10px;
                        color: <?php
				echo esc_attr( $attributes['contentColor'] ); ?>;
                        text-align: <?php
				echo esc_attr( $attributes['contentAlign'] ); ?>;
                        font-size: <?php
				echo esc_attr( $attributes['testimonialFontSize'] ); ?>px;
                        font-weight: <?php
				echo esc_attr( $attributes['testimonialFontWeight'] ); ?>;
                        ">
					<?php
					echo wp_kses_post( $testimonial->content ); ?></p>
				<?php
				if ( $showRating ): ?>
                    <div class="rating" style="
                            color: <?php
					echo esc_attr( $attributes['starColor'] ?? 'gold' ); ?>;
                            text-align: <?php
					echo esc_attr( $attributes['starAligment'] ?? 'left' ); ?>;
                            font-size: <?php
					echo esc_attr( $attributes['starSize'] ?? '15' ); ?>px;">
						<?php
						echo esc_attr( str_repeat( '★', $testimonial->rating ) . str_repeat( '☆',
								5 - $testimonial->rating ) ); ?>
                    </div>
				<?php
				endif; ?>
            </div>
			<?php
		}

		echo '</div>';

		return ob_get_clean();
	}

	function wpte_render_testimonial_block_outside( $attributes, $postIdFrom = null ) {
		global $wpdb;
		global $post;

		$table_name = $wpdb->prefix . 'wpfe_testimonials';
		$post_id    = isset( $attributes['postId'] ) ? (int) $attributes['postId'] : $post->ID;
		if ( isset( $postIdFrom ) && $postIdFrom != 0 ) {
			$post_id = $postIdFrom;
		}

		$testimonials = $wpdb->get_results( $wpdb->prepare(
			"SELECT * FROM {$table_name} WHERE post_id = %d ORDER BY testimonial_order ASC",
			$post_id
		) );

		if ( empty( $testimonials ) ) {
			return '<p>' . __( 'No testimonials exist. Please add some testimonials.',
					'testimonials-for-everyone' ) . '</p>';
		}

		ob_start();

		$imageAligment            = $attributes['imageAlign'] ?? 'left';
		$showCompany              = $attributes['showCompany'] ?? true;
		$showRating               = $attributes['showRating'] ?? true;
		$backgroundColor          = $attributes['backgroundColor'] ?? '#fff';
		$testimonialLayout        = $attributes['testimonialsLayout'] ?? 'standard';
		$testimonialsNumberInGrid = $attributes['testimonialsNumberInGrid'] ?? 2;
		$border = [
			'size' => $attributes['borderSize'] ?? '1',
			'color' => $attributes['borderColor'] ?? '#000',
			'radius' => $attributes['borderRadius'] ?? 0,
		];
        $padding = [
			'top' => $attributes['paddingTop'] ?? 15,
			'bottom' => $attributes['paddingBottom'] ?? 15,
			'left' => $attributes['paddingLeft'] ?? 15,
			'right' => $attributes['paddingRight'] ?? 15,
        ];
        $imageSize = $attributes['imageSize'] ?? 15;
        $imageRounded = $attributes['imageRounded'] ?? false;
        $authorColor = $attributes['authorColor'] ?? '#000';
        $authorFontSize =  $attributes['authorFontSize'] ?? 15;
        $authorFontWeight = $attributes['authorFontWeight'] ?? '300';
        $companyColor = $attributes['companyColor'] ?? '#000';
        $companyFontSize = $attributes['companyFontSize'] ?? 15;
        $companyFontWeight = $attributes['companyFontWeight'] ?? '300';
        $showImage = $attributes['showImage'] ?? true;
        $authorAlign = $attributes['authorAlign'] ?? 'left';
        $companyAlign = $attributes['companyAlign'] ?? 'left';
        $contentColor = $attributes['contentColor'] ?? '#000';
        $contentAlign = $attributes['contentAlign'] ?? 'left';
        $contentFontSize = $attributes['testimonialFontSize'] ?? 15;
        $contentFontWeight = $attributes['testimonialFontWeight'] ?? '300';
        $starColor = $attributes['starColor'] ?? 'gold';
        $starAlign = $attributes['starAligment'] ?? 'left';
        $starSize = $attributes['starSize'] ?? 20;

		echo '<div class="wpte-testimonials ' . esc_attr( $testimonialLayout ?? '' ) . '"';

		if ( isset( $testimonialLayout ) && ( $testimonialLayout !== 'standard' || $testimonialLayout !== 'masonry' ) ) {
			echo ' style="column-count: 2; grid-template-columns: repeat(' . esc_attr( $testimonialsNumberInGrid ) . ', 1fr)"';
		}

		echo '>';

		foreach ( $testimonials as $testimonial ) {
			$gridRow = '';
			if ( isset( $testimonialLayout ) && $testimonialLayout === 'masonry' ) {
				$randomSpan = random_int( 10, 30 );
				$gridRow    = ' grid-row: span ' . esc_attr( $randomSpan ) . '; ';
			}
			?>
            <div class="testimonial" style="background-color: <?php
			echo esc_attr( $backgroundColor ); ?>; border: <?php
			echo esc_attr( $border['size'] ); ?>px solid <?php
			echo esc_attr( $border['color'] ); ?>; border-radius: <?php
			echo esc_attr( $border['radius'] ); ?>px;
                    padding-top: <?php
			echo esc_attr( $padding['top'] ); ?>px;
                    padding-bottom: <?php
			echo esc_attr( $padding['bottom'] ); ?>px;
                    padding-left: <?php
			echo esc_attr( $padding['left'] ); ?>px;
                    padding-right: <?php
			echo esc_attr( $padding['right'] ); ?>px;
			<?php
			echo $gridRow; ?>
                    ">
				<?php
				if ( $imageAligment === 'left' ) : ?>
                    <div style="display: flex; align-items: center;">
						<?php

						if ( $showImage && $testimonial->image_url ): ?>
                            <div style="width: <?php
							echo esc_attr( $imageSize ); ?>px; height: <?php
							echo esc_attr( $imageSize ); ?>px; background-image: url('<?php
							echo esc_url( $testimonial->image_url ); ?>'); background-size: cover; background-position: center; border-radius: <?php
							echo esc_attr( $imageRounded ? '50%' : '0' ); ?>; margin-right: 10px;"></div>
						<?php
						endif; ?>
                        <div>
                            <p class="author" style="
                                    color: <?php
							echo esc_attr( $authorColor ); ?>;
                                    font-size: <?php
							echo esc_attr( $authorFontSize ); ?>px;
                                    font-weight: <?php
							echo esc_attr( $authorFontWeight ); ?>;
                                    ">
								<?php
								echo esc_html( $testimonial->author ); ?></p>
							<?php
							if ( $showCompany && $testimonial->company ): ?>
                                <p class="company" style="
                                        color: <?php
								echo esc_attr( $companyColor ); ?>;
                                        font-size: <?php
								echo esc_attr( $companyFontSize ); ?>px;
                                        font-weight: <?php
								echo esc_attr( $companyFontWeight ); ?>;
                                        ">
									<?php
									echo esc_html( $testimonial->company ); ?></p>
							<?php
							endif; ?>
                        </div>
                    </div>
				<?php
				endif; ?>

				<?php
				if ( $imageAligment === 'center' ) : ?>
                    <div>
						<?php
						if ( $showImage && $testimonial->image_url ): ?>
                            <div style="text-align:center;">
                                <div style="width: <?php
								echo esc_attr( $imageSize ); ?>px; margin:0 auto; height: <?php
								echo esc_attr( $imageSize ); ?>px; background-image: url('<?php
								echo esc_url( $testimonial->image_url ); ?>'); background-size: cover; background-position: center; border-radius: <?php
								echo esc_attr( $imageRounded ? '50%' : '0' ); ?>;"></div>
                            </div>
						<?php
						endif; ?>
                        <div>
                            <p class="author" style="
                                    color: <?php
							echo esc_attr( $authorColor ); ?>;
                                    text-align: <?php
							echo esc_attr( $authorAlign ); ?>;
                                    font-size: <?php
							echo esc_attr( $authorFontSize ); ?>px;
                                    font-weight: <?php
							echo esc_attr( $authorFontWeight ); ?>;
                                    ">
								<?php
								echo esc_html( $testimonial->author ); ?></p>
							<?php
							if ( $showCompany && $testimonial->company ): ?>
                                <p class="company" style="
                                        color: <?php
								echo esc_attr( $companyColor ); ?>;
                                        text-align: <?php
								echo esc_attr( $companyAlign ); ?>;
                                        font-size: <?php
								echo esc_attr( $companyFontSize ); ?>px;
                                        font-weight: <?php
								echo esc_attr( $companyFontWeight ); ?>;">
									<?php
									echo esc_html( $testimonial->company ); ?></p>
							<?php
							endif; ?>
                        </div>
                    </div>
				<?php
				endif; ?>

				<?php
				if ( $imageAligment === 'right' ) : ?>
                    <div style="display: flex; align-items: center; flex-direction: row-reverse;">
						<?php
						if ( $showImage && $testimonial->image_url ): ?>
                            <div style="width: <?php
							echo esc_attr( $imageSize ); ?>px; height: <?php
							echo esc_attr( $imageSize ); ?>px; background-image: url('<?php
							echo esc_url( $testimonial->image_url ); ?>'); background-size: cover; background-position: center; border-radius: <?php
							echo esc_attr( $imageRounded ? '50%' : '0' ); ?>; margin-left: 10px;"></div>
						<?php
						endif; ?>
                        <div>
                            <p class="author" style="
                                    color: <?php
							echo esc_attr( $authorColor); ?>;
                                    text-align:right;
                                    font-size: <?php
							echo esc_attr( $authorFontSize ); ?>px;">
								<?php
								echo esc_html( $testimonial->author ); ?></p>
							<?php
							if ( $showCompany && $testimonial->company ): ?>
                                <p class="company" style="
                                        color: <?php
								echo esc_attr( $companyColor ); ?>;
                                        text-align:right;
                                        font-size: <?php
								echo esc_attr( $companyFontSize ); ?>px;">
									<?php
									echo esc_html( $testimonial->company ); ?></p>
							<?php
							endif; ?>
                        </div>
                    </div>
				<?php
				endif; ?>

                <p class="content" style="
                        margin-top: 10px;
                        color: <?php
				echo esc_attr( $contentColor ); ?>;
                        text-align: <?php
				echo esc_attr( $contentAlign ); ?>;
                        font-size: <?php
				echo esc_attr( $contentFontSize ); ?>px;
                        font-weight: <?php
				echo esc_attr( $contentFontWeight ); ?>;
                        ">
					<?php
					echo wp_kses_post( $testimonial->content ); ?></p>
				<?php
				if ( $showRating ): ?>
                    <div class="rating" style="
                            color: <?php
					echo esc_attr( $starColor ); ?>;
                            text-align: <?php
					echo esc_attr( $starAlign ); ?>;
                            font-size: <?php
					echo esc_attr( $starSize ); ?>px;">
						<?php
						echo esc_attr( str_repeat( '★', $testimonial->rating ) . str_repeat( '☆',
								5 - $testimonial->rating ) ); ?>
                    </div>
				<?php
				endif; ?>
            </div>
			<?php
		}

		echo '</div>';

		return ob_get_clean();
	}


	function wpte_register_testimonial_block() {
		register_block_type( 'wp-testimonials-for-everyone/testimonial', array(
			'render_callback' => [ $this, 'wpte_render_testimonial_block' ],
			'attributes'      => array(
				'content'                  => array(
					'type'     => 'string',
					'source'   => 'html',
					'selector' => 'p',
				),
				'author'                   => array(
					'type'     => 'string',
					'source'   => 'text',
					'selector' => '.author',
				),
				'company'                  => array(
					'type'     => 'string',
					'source'   => 'text',
					'selector' => '.company',
				),
				'link'                     => array(
					'type'      => 'string',
					'source'    => 'attribute',
					'attribute' => 'href',
					'selector'  => '.website-link',
				),
				'rating'                   => array(
					'type'    => 'number',
					'default' => 5,
				),
				'starColor'                => array(
					'type'    => 'string',
					'default' => '#ffcc00',
				),
				'testimonialsLayout'       => [
					'type'    => 'string',
					'default' => 'standard'
				],
				'authorColor'              => array(
					'type'    => 'string',
					'default' => '#222222',
				),
				'companyColor'             => array(
					'type'    => 'string',
					'default' => '#222222',
				),
				'contentColor'             => array(
					'type'    => 'string',
					'default' => '#222222',
				),
				'starSize'                 => array(
					'type'    => 'number',
					'default' => 20,
				),
				'starAligment'             => array(
					'type'    => 'string',
					'default' => 'left',
				),
				'showImage'                => array(
					'type'    => 'boolean',
					'default' => true,
				),
				'showCompany'              => array(
					'type'    => 'boolean',
					'default' => true,
				),
				'showLink'                 => array(
					'type'    => 'boolean',
					'default' => true,
				),
				'showRating'               => array(
					'type'    => 'boolean',
					'default' => true,
				),
				'image_url'                => array(
					'type'    => 'string',
					'default' => '',
				),
				'imageSize'                => array(
					'type'    => 'number',
					'default' => 100,
				),
				'imageRounded'             => array(
					'type'    => 'boolean',
					'default' => false,
				),
				'imageAlign'               => array(
					'type'    => 'string',
					'default' => 'left',
				),
				'authorAlign'              => array(
					'type'    => 'string',
					'default' => 'left',
				),
				'companyAlign'             => array(
					'type'    => 'string',
					'default' => 'left',
				),
				'contentAlign'             => array(
					'type'    => 'string',
					'default' => 'left',
				),
				'backgroundColor'          => array(
					'type'    => 'string',
					'default' => '#ffffff',
				),
				'borderSize'               => array(
					'type'    => 'number',
					'default' => 1,
				),
				'testimonialsNumberInGrid' => array(
					'type'    => 'number',
					'default' => 2,
				),
				'borderColor'              => array(
					'type'    => 'string',
					'default' => '#000000',
				),
				'borderRadius'             => array(
					'type'    => 'number',
					'default' => 0,
				),

			),
		) );
	}

	function wpte_save_testimonials() {
		global $wpdb;

		$post_id = isset( $_POST['post_id'] ) ? intval( $_POST['post_id'] ) : 0;
		if ( $post_id <= 0 ) {
			wp_send_json_error( 'Invalid post ID' );

			return;
		}

		$raw_testimonials       = isset( $_POST['testimonials'] ) ? sanitize_text_field( wp_unslash( $_POST['testimonials'] ) ) : '';
		$sanitized_testimonials = $raw_testimonials;

		$testimonials = json_decode( $sanitized_testimonials, true );

		// Check for JSON errors and valid array structure
		if ( json_last_error() !== JSON_ERROR_NONE || ! is_array( $testimonials ) ) {
			wp_send_json_error( 'Invalid testimonials data' );

			return;
		}

		$table_name = $wpdb->prefix . 'wpfe_testimonials';

		foreach ( $testimonials as $testimonial ) {
			// Validate each required field
			$testimonial_id    = isset( $testimonial['id'] ) ? intval( $testimonial['id'] ) : 0;
			$image_url         = isset( $testimonial['image_url'] ) ? sanitize_text_field( $testimonial['image_url'] ) : '';
			$author            = isset( $testimonial['author'] ) ? sanitize_text_field( $testimonial['author'] ) : '';
			$company           = isset( $testimonial['company'] ) ? sanitize_text_field( $testimonial['company'] ) : '';
			$content           = isset( $testimonial['content'] ) ? sanitize_textarea_field( $testimonial['content'] ) : '';
			$link              = isset( $testimonial['link'] ) ? esc_url_raw( $testimonial['link'] ) : '';
			$rating            = isset( $testimonial['rating'] ) ? intval( $testimonial['rating'] ) : 0;
			$testimonial_order = isset( $testimonial['order'] ) ? intval( $testimonial['order'] ) : 0;

			if ( empty( $author ) || empty( $content ) ) {
				wp_send_json_error( 'For some testimonials missing required fields - Author & Content' );

				return;
			}

			if ( $testimonial_id ) {
				$wpdb->update(
					$table_name,
					[
						'post_id'           => $post_id,
						'image_url'         => $image_url,
						'author'            => $author,
						'company'           => $company,
						'content'           => $content,
						'link'              => $link,
						'rating'            => $rating,
						'testimonial_order' => $testimonial_order,
					],
					[ 'id' => $testimonial_id ],
					[
						'%d',
						'%s',
						'%s',
						'%s',
						'%s',
						'%s',
						'%d',
						'%d'
					],
					[ '%d' ]
				);
			} else {
				$wpdb->insert(
					$table_name,
					[
						'post_id'           => $post_id,
						'image_url'         => $image_url,
						'author'            => $author,
						'company'           => $company,
						'content'           => $content,
						'link'              => $link,
						'rating'            => $rating,
						'testimonial_order' => $testimonial_order,
					],
					[
						'%d',
						'%s',
						'%s',
						'%s',
						'%s',
						'%s',
						'%d',
						'%d'
					]
				);
			}
		}

		wp_send_json_success();
	}

	function wpte_fetch_testimonials() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'wpfe_testimonials';
		$post_id    = isset( $_POST['post_id'] ) ? (int) $_POST['post_id'] : 0;

		if ( $post_id <= 0 ) {
			wp_send_json_error( 'Invalid post ID' );

			return;
		}

		$results = $wpdb->get_results( $wpdb->prepare(
			"SELECT * FROM {$table_name} WHERE post_id = %d ORDER BY testimonial_order ASC",
			$post_id
		) );

		wp_send_json_success( $results );
	}

	function wpte_delete_testimonial() {
		global $wpdb;
		$table_name = $wpdb->prefix . 'wpfe_testimonials';
		$id         = intval( $_POST['id'] );

		$result = $wpdb->delete( $table_name, [ 'id' => $id ], [ '%d' ] );

		if ( $result ) {
			wp_send_json_success();
		} else {
			wp_send_json_error();
		}
	}

	function wpte_display_testimonials( $atts ) {
		$post_id = intval( $atts['post_id'] );
		if ( $post_id <= 0 ) {
			return __( 'Invalid post ID', 'testimonials-for-everyone' );
		}

		global $wpdb;
		$table_name   = $wpdb->prefix . 'wpfe_testimonials';
		$testimonials = $wpdb->get_results( $wpdb->prepare( "SELECT * FROM {$table_name} WHERE post_id = %d ORDER BY testimonial_order ASC",
			$post_id ) );

		if ( empty( $testimonials ) ) {
			return '<p>' . __( 'No testimonials exist. Please add some testimonials.',
					'testimonials-for-everyone' ) . '</p>';
		}

		ob_start();
		echo '<div class="wpte-testimonials">';
		foreach ( $testimonials as $testimonial ) {
			?>
            <div class="testimonial" style="background-color: <?php
			echo esc_attr( $atts['backgroundColor'] ); ?>; border: <?php
			echo esc_attr( $atts['borderSize'] ); ?>px solid <?php
			echo esc_attr( $atts['borderColor'] ); ?>; border-radius: <?php
			echo esc_attr( $atts['borderRadius'] ); ?>px; padding: 15px; margin-bottom: 15px;">
				<?php
				if ( $atts['showImage'] && $testimonial->image_url ): ?>
                    <div style="display: flex; align-items: center;">
                        <div style="width: <?php
						echo esc_attr( $atts['imageSize'] ); ?>px; height: <?php
						echo esc_attr( $atts['imageSize'] ); ?>px; background-image: url('<?php
						echo esc_url( $testimonial->image_url ); ?>'); background-size: cover; background-position: center; border-radius: <?php
						echo esc_attr( $atts['imageRounded'] ? '50%' : '0' ); ?>; margin-right: <?php
						echo $atts['imageAlign'] === 'left' ? '10px' : '0'; ?>; margin-left: <?php
						echo $atts['imageAlign'] === 'right' ? '10px' : '0'; ?>;"></div>
                        <div>
                            <p class="author" style="margin-left: <?php
							echo esc_attr( $atts['showImage'] ? '10px' : '0' ); ?>; color: <?php
							echo esc_attr( $atts['authorColor'] ); ?>;"><?php
								echo esc_html( $testimonial->author ); ?></p>
							<?php
							if ( $atts['showCompany'] && $testimonial->company ): ?>
                                <p class="company" style="margin-left: <?php
								echo esc_attr( $atts['showImage'] ? '10px' : '0' ); ?>; color: <?php
								echo esc_attr( $atts['companyColor'] ); ?>;"><?php
									echo esc_html( $testimonial->company ); ?></p>
							<?php
							endif; ?>
                        </div>
                    </div>
				<?php
				endif; ?>
                <p class="content" style="margin-top: 10px; color: <?php
				echo esc_attr( $atts['contentColor'] ); ?>;"><?php
					echo wp_kses_post( $testimonial->content ); ?></p>
				<?php
				if ( $atts['showRating'] ): ?>
                    <div class="rating" style="color: <?php
					echo esc_attr( $atts['starColor'] ); ?>; font-size: <?php
					echo esc_attr( $atts['starSize'] ); ?>px;">
						<?php
						echo esc_attr( str_repeat( '★', $testimonial->rating ) . str_repeat( '☆',
								5 - $testimonial->rating ) ); ?>
                    </div>
				<?php
				endif; ?>
            </div>
			<?php
		}
		echo '</div>';

		return ob_get_clean();
	}


	public function wpte_add_plugin_admin_menu() {
		add_menu_page(
			'Testimonials For Everyone',
			'Testimonials For Everyone',
			'manage_options',
			'testimonialsfe-overview',
			array( $this, 'wpte_display_overview_page' ),
			'dashicons-format-chat',
			20
		);

		add_submenu_page(
			'testimonialsfe-overview',   // Parent slug (main page)
			'Help & Tutorials',          // Page title
			'Help & Tutorials',          // Menu title
			'manage_options',            // Capability
			'testimonialsfe-help',       // Menu slug
			array( $this, 'wpte_display_help_page' )  // Callback function
		);

		add_submenu_page(
			'testimonialsfe-overview',   // Parent slug (main page)
			'Support',          // Page title
			'Support',          // Menu title
			'manage_options',            // Capability
			'testimonialsfe-support',       // Menu slug
			array( $this, 'wpte_display_support_page' )  // Callback function
		);
	}

	public function wpte_display_help_page() {
		require_once 'partials/' . $this->plugin_name . '-admin-help.php';
	}

	public function wpte_display_overview_page() {
		require_once 'partials/' . $this->plugin_name . '-admin-overview.php';
	}

	public function wpte_display_support_page() {
		require_once 'partials/' . $this->plugin_name . '-admin-support.php';
	}

	function wpte_has_five_minutes_passed() {
		$activation_time         = get_option( 'wppfe_testimonialsfe_activation_time' );
		$current_time            = current_time( 'mysql' );
		$time_difference         = strtotime( $current_time ) - strtotime( $activation_time );
		$five_minutes_in_seconds = 4 * 24 * 60 * 60;

		return $time_difference >= $five_minutes_in_seconds;
	}

	function wppfetfe_admin_notices() {
		if ( get_user_meta( get_current_user_id(), 'wppfetfe_notice_4days_dismissed', true ) ) {
			return;
		}

		if ( $this->wpte_has_five_minutes_passed() ) {
			?>
            <div class="notice notice-info is-dismissible" id="wppfetfe-notice">
                <p>Fantastic! You've been using <i>Testimonials for Everyone</i> for over 4 days now. May we ask you to
                    give it a <strong>5-star</strong> rating on Wordpress.org?</p>
                <hr>
                <a href="https://wordpress.org/support/plugin/testimonials-for-everyone/reviews/#postform"
                   target="_blank">Ok, you deserved it</a>&nbsp;|&nbsp;
                <a href="#" id="already-did-btn">I already did</a>&nbsp;|&nbsp;
                <a href="#" id="not-good-enough-btn">No, not good enough</a>
                <br><br>
            </div>

            <script type="text/javascript">
                jQuery(document).ready(function ($) {
                    // Dismiss notice functionality
                    $('#wppfetfe-notice').on('click', '.notice-dismiss', function () {
                        $.post(ajaxurl, {
                            action: 'wppfetfe_dismiss_notice'
                        });
                    });

                    // "I already did" button functionality
                    $('#already-did-btn').on('click', function (e) {
                        e.preventDefault();
                        $.post(ajaxurl, {
                            action: 'wppfetfe_dismiss_notice'
                        }, function () {
                            $('#wppfetfe-notice').fadeOut(); // Dismiss the notice after the action
                        });
                    });

                    // "No, not good enough" button functionality
                    $('#not-good-enough-btn').on('click', function (e) {
                        e.preventDefault();
                        $.post(ajaxurl, {
                            action: 'wppfetfe_dismiss_notice'
                        }, function () {
                            $('#wppfetfe-notice').fadeOut(); // Dismiss the notice after the action
                        });
                    });
                });
            </script>
			<?php
		}
	}

	function wppfetfe_dismiss_notice() {
		update_user_meta( get_current_user_id(), 'wppfetfe_notice_4days_dismissed', true );
		wp_send_json_success();
	}


	public function wppfetfe_render_testimonial_shortcode( $atts ) {
		// Extract the 'post_id' from the shortcode attributes
		$attributes = shortcode_atts( [ 'post_id' => 0 ], $atts );

		if ( intval( $attributes['post_id'] ) <= 0 ) {
			return __( 'Invalid post ID', 'testimonials-for-everyone' );
		}

		// Get the post content using the post ID
		$post_content = get_post_field( 'post_content', $attributes['post_id'] );

		if ( ! $post_content ) {
			return __( 'Unable to fetch testimonials.', 'testimonials-for-everyone' );
		}

		// Parse the blocks from the post content to find your testimonial block
		$blocks                       = parse_blocks( $post_content );
		$testimonial_block_attributes = [];

		foreach ( $blocks as $block ) {
			if ( $block['blockName'] === 'wp-testimonials-for-everyone/testimonial' ) {
				// Found the testimonial block, get its attributes
				$testimonial_block_attributes = $block['attrs'];
				break;
			}
		}

		// Merge the block attributes with the shortcode attributes
		$merged_attributes = array_merge( $testimonial_block_attributes, $attributes );

		// Call the rendering method with the merged attributes
		return $this->wpte_render_testimonial_block_outside( $merged_attributes, $attributes['post_id'] ?? null );
	}

	public function wppfetfe_register_testimonial_shortcode() {
		add_shortcode( 'wppfetfe_testimonials', [ $this, 'wppfetfe_render_testimonial_shortcode' ] );
	}


}
