<?php
/**
 * Visual Composer Configuration
 *
 * @package vincent
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Vincent_VC_Config {

	// Start things up
	public function __construct() {
		// Admin only functions
		if ( is_admin() ) {
			// Set in theme mode & disable updater
			if ( function_exists( 'vc_set_as_theme' ) ) {
				$disable_updater = true;
				vc_set_as_theme( $disable_updater );
			}
			
			// Add admin notice on product license tab
			add_action( 'admin_notices', array( 'Vincent_VC_Config', 'vc_license_tab_notice' ) );
		}

		// Run on init
		add_action( 'init', array( 'Vincent_VC_Config', 'init' ), 20 );

		// Tweak scripts
		add_action( 'wp_enqueue_scripts', array( 'Vincent_VC_Config', 'load_composer_front_css' ), 0 );
		add_action( 'wp_enqueue_scripts', array( 'Vincent_VC_Config', 'load_remove_styles' ) );
		add_action( 'wp_footer', array( 'Vincent_VC_Config', 'remove_footer_scripts' ) );

		// Remove VC welcome screen
		add_action( 'admin_menu', array( 'Vincent_VC_Config', 'remove_welcome' ), 999 );
		remove_action( 'vc_activation_hook', 'vc_page_welcome_set_redirect' );
		remove_action( 'init', 'vc_page_welcome_redirect' );
		remove_action( 'admin_init', 'vc_page_welcome_redirect' );
	}

	// Add admin notice on product license tab
	public static function vc_license_tab_notice() {
		$screen = get_current_screen();
		if ( 'visual-composer_page_vc-updater' == $screen->id )
			echo '<div class="error"><p><strong>'. esc_html__( 'Activating the Visual Composer plugin is 100% optional and NOT required to function correctly with the theme.', 'vincent' ) .'</strong></p></div>';
	}

	// Functions that run on init
	public static function init() {
		// Remove templatera notice
		remove_action( 'admin_notices', 'templatera_notice' );

		// Set defaults for admin
		if ( function_exists( 'vc_set_default_editor_post_types' ) )
			vc_set_default_editor_post_types( array( 'page', 'portfolio' ) );

		// Set defaults for editor
		if ( function_exists( 'vc_editor_set_post_types ') ) {
			$types = vc_settings()->get( 'content_types' );

			if ( empty( $types  ) )
				vc_editor_set_post_types( array( 'page', 'portfolio' ) );
		}

		// Array of elements to remove
		$elements = array(
			'vc_teaser_grid',
			'vc_posts_grid',
			'vc_posts_slider',
			'vc_carousel',
			'vc_gallery',
			'vc_wp_text',
			'vc_wp_pages',
			'vc_wp_links',
			'vc_wp_categories',
			'vc_wp_meta',
			'vc_images_carousel',
		);

		// Loop through elements to remove and remove them
		if ( is_array( $elements ) ) {
			foreach ( $elements as $element ) {
				vc_remove_element( $element );
			}
		}
	}

	// Removes "About" page in the Visual Composer
	public static function remove_welcome() {
		remove_submenu_page( 'vc-general', 'vc-welcome' );
	}

	// Load js_composer_front CSS eaerly on for easier modification
	public static function load_composer_front_css() {
		wp_enqueue_style( 'js_composer_front' );
	}

	// Load and remove stylesheets
	public static function load_remove_styles() {
		// Add Scripts
		wp_enqueue_style(
			'vincent-visual-composer',
			get_template_directory_uri() . '/assets/css/visual-composer.css',
			array(
				'vincent-theme-style',
				'js_composer_front'
			),
			'1.0.0'
		);

		wp_deregister_style( 'font-awesome' );
		wp_dequeue_style( 'font-awesome' );

		wp_deregister_style( 'animate-css' );
		wp_dequeue_style( 'animate-css' );
	}

	// Remove scripts hooked in too late for me to remove on wp_enqueue_scripts
	public static function remove_footer_scripts() {
		// JS
		wp_dequeue_script( 'vc_pageable_owl-carousel' );
		wp_dequeue_script( 'vc_grid-js-imagesloaded' );

		// Styles conflict with owl carousel styles
		wp_deregister_style( 'vc_pageable_owl-carousel-css-theme' );
		wp_dequeue_style( 'vc_pageable_owl-carousel-css-theme' );
		wp_deregister_style( 'vc_pageable_owl-carousel-css' );
		wp_dequeue_style( 'vc_pageable_owl-carousel-css' );
	}
}
new Vincent_VC_Config();