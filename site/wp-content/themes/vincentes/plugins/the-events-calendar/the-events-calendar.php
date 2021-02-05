<?php
/* Tribe Events Calendar support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 1 - register filters, that add/remove lists items for the Theme Options
if (!function_exists('vincentes_tribe_events_theme_setup1')) {
	add_action( 'after_setup_theme', 'vincentes_tribe_events_theme_setup1', 1 );
	function vincentes_tribe_events_theme_setup1() {
		add_filter( 'vincentes_filter_list_sidebars', 'vincentes_tribe_events_list_sidebars' );
	}
}

// Theme init priorities:
// 3 - add/remove Theme Options elements
if (!function_exists('vincentes_tribe_events_theme_setup3')) {
	add_action( 'after_setup_theme', 'vincentes_tribe_events_theme_setup3', 3 );
	function vincentes_tribe_events_theme_setup3() {
		if (vincentes_exists_tribe_events()) {
		
			vincentes_storage_merge_array('options', '', array(
				// Section 'Tribe Events' - settings for show pages
				'events' => array(
					"title" => esc_html__('Events', 'vincentes'),
					"desc" => wp_kses_data( __('Select parameters to display the events pages', 'vincentes') ),
					"type" => "section"
					),
				'expand_content_events' => array(
					"title" => esc_html__('Expand content', 'vincentes'),
					"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'vincentes') ),
					"refresh" => false,
					"std" => 1,
					"type" => "checkbox"
					),
				'header_style_events' => array(
					"title" => esc_html__('Header style', 'vincentes'),
					"desc" => wp_kses_data( __('Select style to display the site header on the events pages', 'vincentes') ),
					"std" => 'inherit',
					"options" => array(),
					"type" => "select"
					),
				'header_position_events' => array(
					"title" => esc_html__('Header position', 'vincentes'),
					"desc" => wp_kses_data( __('Select position to display the site header on the events pages', 'vincentes') ),
					"std" => 'inherit',
					"options" => array(),
					"type" => "select"
					),
				'header_widgets_events' => array(
					"title" => esc_html__('Header widgets', 'vincentes'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on the events pages', 'vincentes') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'sidebar_widgets_events' => array(
					"title" => esc_html__('Sidebar widgets', 'vincentes'),
					"desc" => wp_kses_data( __('Select sidebar to show on the events pages', 'vincentes') ),
					"std" => 'tribe_events_widgets',
					"options" => array(),
					"type" => "select"
					),
				'sidebar_position_events' => array(
					"title" => esc_html__('Sidebar position', 'vincentes'),
					"desc" => wp_kses_data( __('Select position to show sidebar on the events pages', 'vincentes') ),
					"refresh" => false,
					"std" => 'left',
					"options" => array(),
					"type" => "select"
					),
				'hide_sidebar_on_single_events' => array(
					"title" => esc_html__('Hide sidebar on the single event', 'vincentes'),
					"desc" => wp_kses_data( __("Hide sidebar on the single event's page", 'vincentes') ),
					"std" => 0,
					"type" => "checkbox"
					),
				'widgets_above_page_events' => array(
					"title" => esc_html__('Widgets at the top of the page', 'vincentes'),
					"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'vincentes') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'widgets_above_content_events' => array(
					"title" => esc_html__('Widgets above the content', 'vincentes'),
					"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'vincentes') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'widgets_below_content_events' => array(
					"title" => esc_html__('Widgets below the content', 'vincentes'),
					"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'vincentes') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'widgets_below_page_events' => array(
					"title" => esc_html__('Widgets at the bottom of the page', 'vincentes'),
					"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'vincentes') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'footer_scheme_events' => array(
					"title" => esc_html__('Footer Color Scheme', 'vincentes'),
					"desc" => wp_kses_data( __('Select color scheme to decorate footer area', 'vincentes') ),
					"std" => 'dark',
					"options" => array(),
					"type" => "select"
					),
				'footer_widgets_events' => array(
					"title" => esc_html__('Footer widgets', 'vincentes'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'vincentes') ),
					"std" => 'footer_widgets',
					"options" => array(),
					"type" => "select"
					),
				'footer_columns_events' => array(
					"title" => esc_html__('Footer columns', 'vincentes'),
					"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'vincentes') ),
					"dependency" => array(
						'footer_widgets_events' => array('^hide')
					),
					"std" => 0,
					"options" => vincentes_get_list_range(0,6),
					"type" => "select"
					),
				'footer_wide_events' => array(
					"title" => esc_html__('Footer fullwide', 'vincentes'),
					"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'vincentes') ),
					"std" => 0,
					"type" => "checkbox"
					)
				)
			);
		}
	}
}

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('vincentes_tribe_events_theme_setup9')) {
	add_action( 'after_setup_theme', 'vincentes_tribe_events_theme_setup9', 9 );
	function vincentes_tribe_events_theme_setup9() {
		
		if (vincentes_exists_tribe_events()) {
			add_action( 'wp_enqueue_scripts', 								'vincentes_tribe_events_frontend_scripts', 1100 );
			add_filter( 'vincentes_filter_merge_styles',						'vincentes_tribe_events_merge_styles' );
			add_filter( 'vincentes_filter_post_type_taxonomy',				'vincentes_tribe_events_post_type_taxonomy', 10, 2 );
			if (!is_admin()) {
				add_filter( 'vincentes_filter_detect_blog_mode',				'vincentes_tribe_events_detect_blog_mode' );
				add_filter( 'vincentes_filter_get_post_categories', 			'vincentes_tribe_events_get_post_categories');
				add_filter( 'vincentes_filter_get_post_date',		 			'vincentes_tribe_events_get_post_date');
			} else {
				add_action( 'admin_enqueue_scripts',						'vincentes_tribe_events_admin_scripts' );
			}
		}
		if (is_admin()) {
			add_filter( 'vincentes_filter_tgmpa_required_plugins',			'vincentes_tribe_events_tgmpa_required_plugins' );
		}

	}
}


// Remove 'Tribe Events' section from Customizer
if (!function_exists('vincentes_tribe_events_customizer_register_controls')) {
	add_action( 'customize_register', 'vincentes_tribe_events_customizer_register_controls', 100 );
	function vincentes_tribe_events_customizer_register_controls( $wp_customize ) {
		$wp_customize->remove_panel( 'tribe_customizer');
	}
}


// Check if Tribe Events is installed and activated
if ( !function_exists( 'vincentes_exists_tribe_events' ) ) {
	function vincentes_exists_tribe_events() {
		return class_exists( 'Tribe__Events__Main' );
	}
}

// Return true, if current page is any tribe_events page
if ( !function_exists( 'vincentes_is_tribe_events_page' ) ) {
	function vincentes_is_tribe_events_page() {
		$rez = false;
		if (vincentes_exists_tribe_events())
			if (!is_search()) $rez = tribe_is_event() || tribe_is_event_query() || tribe_is_event_category() || tribe_is_event_venue() || tribe_is_event_organizer();
		return $rez;
	}
}

// Detect current blog mode
if ( !function_exists( 'vincentes_tribe_events_detect_blog_mode' ) ) {
	//Handler of the add_filter( 'vincentes_filter_detect_blog_mode', 'vincentes_tribe_events_detect_blog_mode' );
	function vincentes_tribe_events_detect_blog_mode($mode='') {
		if (vincentes_is_tribe_events_page())
			$mode = 'events';
		return $mode;
	}
}

// Return taxonomy for current post type
if ( !function_exists( 'vincentes_tribe_events_post_type_taxonomy' ) ) {
	//Handler of the add_filter( 'vincentes_filter_post_type_taxonomy',	'vincentes_tribe_events_post_type_taxonomy', 10, 2 );
	function vincentes_tribe_events_post_type_taxonomy($tax='', $post_type='') {
		if (vincentes_exists_tribe_events() && $post_type == Tribe__Events__Main::POSTTYPE)
			$tax = Tribe__Events__Main::TAXONOMY;
		return $tax;
	}
}

// Show categories of the current event
if ( !function_exists( 'vincentes_tribe_events_get_post_categories' ) ) {
	//Handler of the add_filter( 'vincentes_filter_get_post_categories', 		'vincentes_tribe_events_get_post_categories');
	function vincentes_tribe_events_get_post_categories($cats='') {
		if (get_post_type() == Tribe__Events__Main::POSTTYPE)
			$cats = vincentes_get_post_terms(', ', get_the_ID(), Tribe__Events__Main::TAXONOMY);
		return $cats;
	}
}

// Return date of the current event
if ( !function_exists( 'vincentes_tribe_events_get_post_date' ) ) {
	//Handler of the add_filter( 'vincentes_filter_get_post_date', 'vincentes_tribe_events_get_post_date');
	function vincentes_tribe_events_get_post_date($dt='') {
		if (get_post_type() == Tribe__Events__Main::POSTTYPE) {
			$dt = tribe_get_start_date(null, true, 'Y-m-d');
			$dt = sprintf($dt < date('Y-m-d') 
								? esc_html__('Started on %s', 'vincentes') 
								: esc_html__('Starting %s', 'vincentes'),
								date(get_option('date_format'), strtotime($dt)));
		}
		return $dt;
	}
}
	
// Enqueue Tribe Events admin scripts and styles
if ( !function_exists( 'vincentes_tribe_events_admin_scripts' ) ) {
	//Handler of the add_action( 'admin_enqueue_scripts', 'vincentes_tribe_events_admin_scripts' );
	function vincentes_tribe_events_admin_scripts() {
		//Uncomment next line if you want disable custom UI styles from Tribe Events plugin

	}
}

// Enqueue Tribe Events custom scripts and styles
if ( !function_exists( 'vincentes_tribe_events_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'vincentes_tribe_events_frontend_scripts', 1100 );
	function vincentes_tribe_events_frontend_scripts() {
		if (vincentes_is_tribe_events_page()) {

			if (vincentes_is_on(vincentes_get_theme_option('debug_mode')) && vincentes_get_file_dir('plugins/the-events-calendar/the-events-calendar.css')!='')
				wp_enqueue_style( 'vincentes-the-events-calendar',  vincentes_get_file_url('plugins/the-events-calendar/the-events-calendar.css'), array(), null );
				wp_enqueue_style( 'vincentes-the-events-calendar-images',  vincentes_get_file_url('css/the-events-calendar.css'), array(), null );
		}
	}
}

// Merge custom styles
if ( !function_exists( 'vincentes_tribe_events_merge_styles' ) ) {
	//Handler of the add_filter('vincentes_filter_merge_styles', 'vincentes_tribe_events_merge_styles');
	function vincentes_tribe_events_merge_styles($list) {
		$list[] = 'plugins/the-events-calendar/the-events-calendar.css';
		$list[] = 'css/the-events-calendar.css';
		return $list;
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'vincentes_tribe_events_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('vincentes_filter_tgmpa_required_plugins',	'vincentes_tribe_events_tgmpa_required_plugins');
	function vincentes_tribe_events_tgmpa_required_plugins($list=array()) {
		if (in_array('the-events-calendar', vincentes_storage_get('required_plugins')))
			$list[] = array(
					'name' 		=> esc_html__('Tribe Events Calendar', 'vincentes'),
					'slug' 		=> 'the-events-calendar',
					'required' 	=> false
				);
		return $list;
	}
}



// Add Tribe Events specific items into lists
//------------------------------------------------------------------------

// Add sidebar
if ( !function_exists( 'vincentes_tribe_events_list_sidebars' ) ) {
	//Handler of the add_filter( 'vincentes_filter_list_sidebars', 'vincentes_tribe_events_list_sidebars' );
	function vincentes_tribe_events_list_sidebars($list=array()) {
		$list['tribe_events_widgets'] = array(
											'name' => esc_html__('Tribe Events Widgets', 'vincentes'),
											'description' => esc_html__('Widgets to be shown on the Tribe Events pages', 'vincentes')
											);
		return $list;
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if (vincentes_exists_tribe_events()) { require_once VINCENTES_THEME_DIR . 'plugins/the-events-calendar/the-events-calendar.styles.php'; }
?>