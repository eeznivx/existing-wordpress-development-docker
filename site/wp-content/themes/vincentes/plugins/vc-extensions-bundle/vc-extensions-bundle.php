<?php
/* WPBakery Page Builder Extensions Bundle support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('vincentes_vc_extensions_theme_setup9')) {
	add_action( 'after_setup_theme', 'vincentes_vc_extensions_theme_setup9', 9 );
	function vincentes_vc_extensions_theme_setup9() {
		if (vincentes_exists_visual_composer()) {
			add_action( 'wp_enqueue_scripts', 								'vincentes_vc_extensions_frontend_scripts', 1100 );
			add_filter( 'vincentes_filter_merge_styles',						'vincentes_vc_extensions_merge_styles' );
		}
	
		if (is_admin()) {
			add_filter( 'vincentes_filter_tgmpa_required_plugins',		'vincentes_vc_extensions_tgmpa_required_plugins' );
		}
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'vincentes_vc_extensions_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('vincentes_filter_tgmpa_required_plugins',	'vincentes_vc_extensions_tgmpa_required_plugins');
	function vincentes_vc_extensions_tgmpa_required_plugins($list=array()) {
		if (in_array('vc-extensions-bundle', vincentes_storage_get('required_plugins'))) {
			$path = vincentes_get_file_dir('plugins/vc-extensions-bundle/vc-extensions-bundle.zip');
			$list[] = array(
					'name' 		=> esc_html__('WPBakery Page Builder Extensions Bundle', 'vincentes'),
					'slug' 		=> 'vc-extensions-bundle',
                    'version'	=> '3.5.4',
					'source'	=> !empty($path) ? $path : 'upload://vc-extensions-bundle.zip',
					'required' 	=> false
			);
		}
		return $list;
	}
}

// Check if VC Extensions installed and activated
if ( !function_exists( 'vincentes_exists_vc_extensions' ) ) {
	function vincentes_exists_vc_extensions() {
		return class_exists('Vc_Manager') && class_exists('VC_Extensions_CQBundle');
	}
}
	
// Enqueue VC custom styles
if ( !function_exists( 'vincentes_vc_extensions_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'vincentes_vc_extensions_frontend_scripts', 1100 );
	function vincentes_vc_extensions_frontend_scripts() {
		if (vincentes_is_on(vincentes_get_theme_option('debug_mode')) && vincentes_get_file_dir('plugins/vc-extensions-bundle/vc-extensions-bundle.css')!='')
			wp_enqueue_style( 'vincentes-vc-extensions-bundle',  vincentes_get_file_url('plugins/vc-extensions-bundle/vc-extensions-bundle.css'), array(), null );
	}
}
	
// Merge custom styles
if ( !function_exists( 'vincentes_vc_extensions_merge_styles' ) ) {
	//Handler of the add_filter('vincentes_filter_merge_styles', 'vincentes_vc_extensions_merge_styles');
	function vincentes_vc_extensions_merge_styles($list) {
		$list[] = 'plugins/vc-extensions-bundle/vc-extensions-bundle.css';
		return $list;
	}
}
?>