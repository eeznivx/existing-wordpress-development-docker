<?php
/**
 * Theme Plugins
 *
 * @package vincent
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @link Thanks https://themes.trac.wordpress.org/browser/firmasite/1.1.13/functions/class-tgm-plugin-activation.php
 */
require get_template_directory() . '/framework/class-tgm-plugin-activation.php';


// Register action to declare required plugins
add_action( 'tgmpa_register', 'vincent_register_plugins' );

/**
 * Register third-party plugins
 */
function vincent_register_plugins() {
	$plugins = array(
		array(
			'name'     				=> esc_html__( 'WPBakery Page Builder', 'vincent'), // The plugin name
			'slug'     				=> 'js_composer', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'source'   				=> get_stylesheet_directory() . '/framework/plugins/js_composer.zip', // The plugin source
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		),
		array(
			'name'     				=> esc_html__('Revolution Slider', 'vincent'), // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'source'             	=> get_stylesheet_directory() . '/framework/plugins/revslider.zip', // The plugin source
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		),
		array(
			'name'     				=> esc_html__( 'Meta Box', 'vincent'), // The plugin name
			'slug'     				=> 'meta-box', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'     				=> esc_html__( 'Contact Form 7', 'vincent'), // The plugin name
			'slug'     				=> 'contact-form-7', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'     				=> esc_html__( 'Woocommerce', 'vincent'), // The plugin name
			'slug'     				=> 'woocommerce', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'     				=> esc_html__( 'One Click Demo Import', 'vincent'), // The plugin name
			'slug'     				=> 'one-click-demo-import', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'     				=> esc_html__( 'MailChimp for WordPress', 'vincent'), // The plugin name
			'slug'     				=> 'mailchimp-for-wp', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
		),
		array(
			'name'     				=> esc_html__( 'WPRT Addons for Vincent', 'vincent'),  // The plugin name
			'slug'     				=> 'wprt-addons', // The plugin slug (typically the folder name)
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'source'             	=> esc_url('https://ninzio.com/vincent/_plugins/wprt-addons.zip'),
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		),
	);

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'default_path' => '',                      // Default absolute path to pre-packaged plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
		'strings'      => array(
			'page_title'                      => esc_html__( 'Install Required Plugins', 'vincent' ),
			'menu_title'                      => esc_html__( 'Install Plugins', 'vincent' ),
			'installing'                      => esc_html__( 'Installing Plugin: %s', 'vincent' ), // %s = plugin name.
			'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'vincent' ),
			'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'vincent' ), // %1$s = plugin name(, 'vincent's).
			'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'vincent' ), // %1$s = plugin name(, 'vincent's).
			'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'vincent' ), // %1$s = plugin name(, 'vincent's).
			'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'vincent' ), // %1$s = plugin name(, 'vincent's).
			'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'vincent' ), // %1$s = plugin name(, 'vincent's).
			'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'vincent' ), // %1$s = plugin name(, 'vincent's).
			'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'vincent' ), // %1$s = plugin name(, 'vincent's).
			'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'vincent' ), // %1$s = plugin name(, 'vincent's).
			'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'vincent' ),
			'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'vincent' ),
			'return'                          => esc_html__( 'Return to Required Plugins Installer', 'vincent' ),
			'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'vincent' ),
			'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'vincent' ), // %s = dashboard link.
			'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
		)
	);

	tgmpa( $plugins, $config );
}
