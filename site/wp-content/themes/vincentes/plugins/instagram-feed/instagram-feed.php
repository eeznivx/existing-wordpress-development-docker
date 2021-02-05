<?php
/* Custom Feeds for Instagram support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('vincentes_instagram_feed_theme_setup9')) {
	add_action( 'after_setup_theme', 'vincentes_instagram_feed_theme_setup9', 9 );
	function vincentes_instagram_feed_theme_setup9() {
		if (is_admin()) {
			add_filter( 'vincentes_filter_tgmpa_required_plugins',		'vincentes_instagram_feed_tgmpa_required_plugins' );
		}
	}
}

// Check if Custom Feeds for Instagram installed and activated
if ( !function_exists( 'vincentes_exists_instagram_feed' ) ) {
	function vincentes_exists_instagram_feed() {
		return defined('SBIVER');
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'vincentes_instagram_feed_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('vincentes_filter_tgmpa_required_plugins',	'vincentes_instagram_feed_tgmpa_required_plugins');
	function vincentes_instagram_feed_tgmpa_required_plugins($list=array()) {
		if (in_array('instagram-feed', vincentes_storage_get('required_plugins')))
			$list[] = array(
					'name' 		=> esc_html__('Custom Feeds for Instagram', 'vincentes'),
					'slug' 		=> 'instagram-feed',
					'required' 	=> false
				);
		return $list;
	}
}
?>