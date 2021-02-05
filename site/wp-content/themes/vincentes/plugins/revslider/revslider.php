<?php
/* Revolution Slider support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('vincentes_revslider_theme_setup9')) {
	add_action( 'after_setup_theme', 'vincentes_revslider_theme_setup9', 9 );
	function vincentes_revslider_theme_setup9() {
		if (vincentes_exists_revslider()) {
			add_action( 'wp_enqueue_scripts', 					'vincentes_revslider_frontend_scripts', 1100 );
			add_filter( 'vincentes_filter_merge_styles',			'vincentes_revslider_merge_styles' );
		}
		if (is_admin()) {
			add_filter( 'vincentes_filter_tgmpa_required_plugins','vincentes_revslider_tgmpa_required_plugins' );
		}
	}
}

// Check if RevSlider installed and activated
if ( !function_exists( 'vincentes_exists_revslider' ) ) {
	function vincentes_exists_revslider() {
		return function_exists('rev_slider_shortcode');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'vincentes_revslider_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('vincentes_filter_tgmpa_required_plugins',	'vincentes_revslider_tgmpa_required_plugins');
	function vincentes_revslider_tgmpa_required_plugins($list=array()) {
		if (in_array('revslider', vincentes_storage_get('required_plugins'))) {
			$path = vincentes_get_file_dir('plugins/revslider/revslider.zip');
			$list[] = array(
					'name' 		=> esc_html__('Revolution Slider', 'vincentes'),
					'slug' 		=> 'revslider',
                    'version'	=> '6.0.6',
					'source'	=> !empty($path) ? $path : 'upload://revslider.zip',
					'required' 	=> false
			);
		}
		return $list;
	}
}
	
// Enqueue custom styles
if ( !function_exists( 'vincentes_revslider_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'vincentes_revslider_frontend_scripts', 1100 );
	function vincentes_revslider_frontend_scripts() {
		if (vincentes_is_on(vincentes_get_theme_option('debug_mode')) && vincentes_get_file_dir('plugins/revslider/revslider.css')!='')
			wp_enqueue_style( 'vincentes-revslider',  vincentes_get_file_url('plugins/revslider/revslider.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'vincentes_revslider_merge_styles' ) ) {
	//Handler of the add_filter('vincentes_filter_merge_styles', 'vincentes_revslider_merge_styles');
	function vincentes_revslider_merge_styles($list) {
		$list[] = 'plugins/revslider/revslider.css';
		return $list;
	}
}
?>