<?php
/**
 * Theme functions: init, enqueue scripts and styles, include required files and widgets
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0
 */

if (!defined("VINCENTES_THEME_DIR")) define("VINCENTES_THEME_DIR", trailingslashit( get_template_directory() ));
if (!defined("VINCENTES_CHILD_DIR")) define("VINCENTES_CHILD_DIR", trailingslashit( get_stylesheet_directory() ));

// Theme storage
$VINCENTES_STORAGE = array(
	// Theme required plugin's slugs
	'required_plugins' => array(

		// Required plugins
		// DON'T COMMENT OR REMOVE NEXT LINES!
		'trx_addons',

		// Recommended (supported) plugins
		// If plugin not need - comment (or remove) it
		'contact-form-7',
		'essential-grid',
		'instagram-feed',
		'js_composer',
		'revslider',
		'the-events-calendar',
		'vc-extensions-bundle',
		'woocommerce'
		)
);


//-------------------------------------------------------
//-- Theme init
//-------------------------------------------------------

// Theme init priorities:
// 1 - register filters to add/remove lists items in the Theme Options
// 2 - create Theme Options
// 3 - add/remove Theme Options elements
// 5 - load Theme Options
// 9 - register other filters (for installer, etc.)
//10 - standard Theme init procedures (not ordered)

if ( !function_exists('vincentes_theme_setup1') ) {
	add_action( 'after_setup_theme', 'vincentes_theme_setup1', 1 );
	function vincentes_theme_setup1() {
		// Make theme available for translation
		// Translations can be filed in the /languages directory
		// Attention! Translations must be loaded before first call any translation functions!
		load_theme_textdomain( 'vincentes', get_template_directory() . '/languages' );

		// Set theme content width
		$GLOBALS['content_width'] = apply_filters( 'vincentes_filter_content_width', 1170 );
	}
}

if ( !function_exists('vincentes_theme_setup') ) {
	add_action( 'after_setup_theme', 'vincentes_theme_setup' );
	function vincentes_theme_setup() {

		// Add default posts and comments RSS feed links to head 
		add_theme_support( 'automatic-feed-links' );
		
		// Custom header setup
		add_theme_support( 'custom-header', array(
			'header-text'=>false,
			'video' => true
			)
		);

		// Custom backgrounds setup
		add_theme_support( 'custom-background', array()	);
		
		// Supported posts formats
		add_theme_support( 'post-formats', array('gallery', 'video', 'audio', 'link', 'quote', 'image', 'status', 'aside', 'chat') ); 
 
 		// Autogenerate title tag
		add_theme_support('title-tag');
 		
		// Add theme menus
		add_theme_support('nav-menus');
		
		// Switch default markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption') );
		
		// Editor custom stylesheet - for user
		add_editor_style( array_merge(
			array(
				'css/editor-style.css',
				vincentes_get_file_url('css/fontello/css/fontello-embedded.css')
			),
			vincentes_theme_fonts_for_editor()
			)
		);	
	
		// Register navigation menu
		register_nav_menus(array(
			'menu_main' => esc_html__('Main Menu', 'vincentes'),
			'menu_mobile' => esc_html__('Mobile Menu', 'vincentes'),
			'menu_footer' => esc_html__('Footer Menu', 'vincentes')
			)
		);

		// Excerpt filters
		add_filter( 'excerpt_length',						'vincentes_excerpt_length' );
		add_filter( 'excerpt_more',							'vincentes_excerpt_more' );
		
		// Add required meta tags in the head
		add_action('wp_head',		 						'vincentes_wp_head', 0);
		
		// Load current page/post customization (if present)
		add_action('wp_footer',		 						'vincentes_wp_footer');
		add_action('admin_footer',	 						'vincentes_wp_footer');

		// Enqueue scripts and styles for frontend
		add_action('wp_enqueue_scripts', 					'vincentes_wp_scripts', 1000);			// priority 1000 - load styles
																									// before the plugin's support custom styles
																									// (with priority 1100)
		add_action('wp_enqueue_scripts', 					'vincentes_wp_scripts_child', 1200);		// priority 1200 - load styles
																									// after the plugin's support custom styles
																									// (with priority 1100)
		add_action('wp_enqueue_scripts', 					'vincentes_wp_scripts_responsive', 2000);	// priority 2000 - load responsive
																									// after all other styles
		add_action('wp_footer',		 						'vincentes_localize_scripts');
		
		// Add body classes
		add_filter( 'body_class',							'vincentes_add_body_classes' );

		// Register sidebars
		add_action('widgets_init',							'vincentes_register_sidebars');

		// Set options for importer (before other plugins)
		add_filter( 'trx_addons_filter_importer_options',	'vincentes_importer_set_options', 9 );
	}

}


//-------------------------------------------------------
//-- Theme scripts and styles
//-------------------------------------------------------

// Load frontend scripts
if ( !function_exists( 'vincentes_wp_scripts' ) ) {
	//Handler of the add_action('wp_enqueue_scripts', 'vincentes_wp_scripts', 1000);
	function vincentes_wp_scripts() {
		
		// Enqueue styles
		//------------------------
		
		// Links to selected fonts
		$links = vincentes_theme_fonts_links();
		if (count($links) > 0) {
			foreach ($links as $slug => $link) {
				wp_enqueue_style( sprintf('vincentes-font-%s', $slug), $link );
			}
		}
		
		// Fontello styles must be loaded before main stylesheet
		// This style NEED the theme prefix, because style 'fontello' in some plugin contain different set of characters
		// and can't be used instead this style!
		wp_enqueue_style( 'fontello',  vincentes_get_file_url('css/fontello/css/fontello-embedded.css') );

		// Load main stylesheet
		$main_stylesheet = get_template_directory_uri() . '/style.css';
		wp_enqueue_style( 'vincentes-main', $main_stylesheet, array(), null );

		// Add custom bg image for the body_style == 'boxed'
		if ( vincentes_get_theme_option('body_style') == 'boxed' && ($bg_image = vincentes_get_theme_option('boxed_bg_image')) != '' )
			wp_add_inline_style( 'vincentes-main', '.body_style_boxed { background-image:url('.esc_url($bg_image).') }' );

		// Merged styles
		if ( vincentes_is_off(vincentes_get_theme_option('debug_mode')) )
			wp_enqueue_style( 'vincentes-styles', vincentes_get_file_url('css/__styles.css') );

		// Custom colors
		if ( !is_customize_preview() && !isset($_GET['color_scheme']) && vincentes_is_off(vincentes_get_theme_option('debug_mode')) )
			wp_enqueue_style( 'vincentes-colors', vincentes_get_file_url('css/__colors.css') );
		else
			wp_add_inline_style( 'vincentes-main', vincentes_customizer_get_css() );

		// Add post nav background
		vincentes_add_bg_in_post_nav();

		// Disable loading JQuery UI CSS
		wp_deregister_style('jquery_ui');
		wp_deregister_style('date-picker-css');


		// Enqueue scripts	
		//------------------------
		
		// Modernizr will load in head before other scripts and styles
		if ( in_array(substr(vincentes_get_theme_option('blog_style'), 0, 7), array('gallery', 'portfol', 'masonry')) )
			wp_enqueue_script( 'modernizr', vincentes_get_file_url('js/theme.gallery/modernizr.min.js'), array(), null, false );

		// Superfish Menu
		// Attention! To prevent duplicate this script in the plugin and in the menu, don't merge it!
		wp_enqueue_script( 'superfish', vincentes_get_file_url('js/superfish.js'), array('jquery'), null, true );
		
		// Merged scripts
		if ( vincentes_is_off(vincentes_get_theme_option('debug_mode')) )
			wp_enqueue_script( 'vincentes-init', vincentes_get_file_url('js/__scripts.js'), array('jquery'), null, true );
		else {
			// Skip link focus
			wp_enqueue_script( 'skip-link-focus-fix', vincentes_get_file_url('js/skip-link-focus-fix.js'), null, true );
			// Background video
			$header_video = vincentes_get_header_video();
			if (!empty($header_video) && !vincentes_is_inherit($header_video)) {
				if (vincentes_is_youtube_url($header_video))
					wp_enqueue_script( 'tubular', vincentes_get_file_url('js/jquery.tubular.js'), array('jquery'), null, true );
				else
					wp_enqueue_script( 'bideo', vincentes_get_file_url('js/bideo.js'), array(), null, true );
			}
			// Theme scripts
			wp_enqueue_script( 'vincentes-utils', vincentes_get_file_url('js/_utils.js'), array('jquery'), null, true );
			wp_enqueue_script( 'vincentes-init', vincentes_get_file_url('js/_init.js'), array('jquery'), null, true );	
		}
		
		// Comments
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}

		// Media elements library	
		if (vincentes_get_theme_setting('use_mediaelements')) {
			wp_enqueue_style ( 'mediaelement' );
			wp_enqueue_style ( 'wp-mediaelement' );
			wp_enqueue_script( 'mediaelement' );
			wp_enqueue_script( 'wp-mediaelement' );
		}
	}
}

// Load child-theme stylesheet (if different) after all styles (with priorities 1000 and 1100)
if ( !function_exists( 'vincentes_wp_scripts_child' ) ) {
	//Handler of the add_action('wp_enqueue_scripts', 'vincentes_wp_scripts_child', 1200);
	function vincentes_wp_scripts_child() {
		$main_stylesheet = get_template_directory_uri() . '/style.css';
		$child_stylesheet = get_stylesheet_directory_uri() . '/style.css';
		if ($child_stylesheet != $main_stylesheet) {
			wp_enqueue_style( 'vincentes-child', $child_stylesheet, array('vincentes-main'), null );
		}
	}
}

// Add variables to the scripts in the frontend
if ( !function_exists( 'vincentes_localize_scripts' ) ) {
	//Handler of the add_action('wp_footer', 'vincentes_localize_scripts');
	function vincentes_localize_scripts() {

		$video = vincentes_get_header_video();

		wp_localize_script( 'vincentes-init', 'VINCENTES_STORAGE', apply_filters( 'vincentes_filter_localize_script', array(
			// AJAX parameters
			'ajax_url' => esc_url(admin_url('admin-ajax.php')),
			'ajax_nonce' => esc_attr(wp_create_nonce(admin_url('admin-ajax.php'))),
			
			// Site base url
			'site_url' => get_site_url(),
			'theme_url' => get_template_directory_uri(),
						
			// Site color scheme
			'site_scheme' => sprintf('scheme_%s', vincentes_get_theme_option('color_scheme')),
			
			// User logged in
			'user_logged_in' => is_user_logged_in() ? true : false,
			
			// Window width to switch the site header to the mobile layout
			'mobile_layout_width' => 767,
			'mobile_device' => wp_is_mobile(),
						
			// Sidemenu options
			'menu_side_stretch' => vincentes_get_theme_option('menu_side_stretch') > 0 ? true : false,
			'menu_side_icons' => vincentes_get_theme_option('menu_side_icons') > 0 ? true : false,

			// Video background
			'background_video' => vincentes_is_from_uploads($video) ? $video : '',

			// Video and Audio tag wrapper
			'use_mediaelements' => vincentes_get_theme_setting('use_mediaelements') ? true : false,

			// Messages max length
			'comment_maxlength'	=> intval(vincentes_get_theme_setting('comment_maxlength')),

			
			// Internal vars - do not change it!
			
			// Flag for review mechanism
			'admin_mode' => false,

			// E-mail mask
			'email_mask' => '^([a-zA-Z0-9_\\-]+\\.)*[a-zA-Z0-9_\\-]+@[a-z0-9_\\-]+(\\.[a-z0-9_\\-]+)*\\.[a-z]{2,6}$',
			
			// Strings for translation
			'strings' => array(
					'ajax_error'		=> esc_html__('Invalid server answer!', 'vincentes'),
					'error_global'		=> esc_html__('Error data validation!', 'vincentes'),
					'name_empty' 		=> esc_html__("The name can't be empty", 'vincentes'),
					'name_long'			=> esc_html__('Too long name', 'vincentes'),
					'email_empty'		=> esc_html__('Too short (or empty) email address', 'vincentes'),
					'email_long'		=> esc_html__('Too long email address', 'vincentes'),
					'email_not_valid'	=> esc_html__('Invalid email address', 'vincentes'),
					'text_empty'		=> esc_html__("The message text can't be empty", 'vincentes'),
					'text_long'			=> esc_html__('Too long message text', 'vincentes')
					)
			))
		);
	}
}

// Load responsive styles (priority 2000 - load it after main styles and plugins custom styles)
if ( !function_exists( 'vincentes_wp_scripts_responsive' ) ) {
	//Handler of the add_action('wp_enqueue_scripts', 'vincentes_wp_scripts_responsive', 2000);
	function vincentes_wp_scripts_responsive() {
		wp_enqueue_style( 'vincentes-responsive', vincentes_get_file_url('css/responsive.css') );
	}
}

//  Add meta tags and inline scripts in the header for frontend
if (!function_exists('vincentes_wp_head')) {
	//Handler of the add_action('wp_head',	'vincentes_wp_head', 1);
	function vincentes_wp_head() {
		?>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<meta name="format-detection" content="telephone=no">
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<link rel="pingback" href="<?php esc_url(bloginfo( 'pingback_url' )); ?>">
		<?php
	}
}

// Add theme specified classes to the body
if ( !function_exists('vincentes_add_body_classes') ) {
	//Handler of the add_filter( 'body_class', 'vincentes_add_body_classes' );
	function vincentes_add_body_classes( $classes ) {
		$classes[] = 'body_tag';	// Need for the .scheme_self
		$classes[] = 'scheme_' . esc_attr(vincentes_get_theme_option('color_scheme'));

		$blog_mode = vincentes_storage_get('blog_mode');
		$classes[] = 'blog_mode_' . esc_attr($blog_mode);
		$classes[] = 'body_style_' . esc_attr(vincentes_get_theme_option('body_style'));

		if (in_array($blog_mode, array('post', 'page'))) {
			$classes[] = 'is_single';
		} else {
			$classes[] = ' is_stream';
			$classes[] = 'blog_style_'.esc_attr(vincentes_get_theme_option('blog_style'));
			if (vincentes_storage_get('blog_template') > 0)
				$classes[] = 'blog_template';
		}
		
		if (vincentes_sidebar_present()) {
			$classes[] = 'sidebar_show sidebar_' . esc_attr(vincentes_get_theme_option('sidebar_position')) ;
		} else {
			$classes[] = 'sidebar_hide';
			if (vincentes_is_on(vincentes_get_theme_option('expand_content')))
				 $classes[] = 'expand_content';
		}
		
		if (vincentes_is_on(vincentes_get_theme_option('remove_margins')))
			 $classes[] = 'remove_margins';

		$classes[] = 'header_style_' . esc_attr(vincentes_get_theme_option("header_style"));
		$classes[] = 'header_position_' . esc_attr(vincentes_get_theme_option("header_position"));

		$menu_style= vincentes_get_theme_option("menu_style");
		$classes[] = 'menu_style_' . esc_attr($menu_style) . (in_array($menu_style, array('left', 'right'))	? ' menu_style_side' : '');
		$classes[] = 'no_layout';
		
		return $classes;
	}
}
	
// Load current page/post customization (if present)
if ( !function_exists( 'vincentes_wp_footer' ) ) {
	//Handler of the add_action('wp_footer', 'vincentes_wp_footer');
	//and add_action('admin_footer', 'vincentes_wp_footer');
	function vincentes_wp_footer() {
		if (($css = vincentes_get_inline_css()) != '') {
			wp_enqueue_style(  'vincentes-inline-styles',  vincentes_get_file_url('css/__inline.css') );
			wp_add_inline_style( 'vincentes-inline-styles', $css );
		}
	}
}


//-------------------------------------------------------
//-- Sidebars and widgets
//-------------------------------------------------------

// Register widgetized areas
if ( !function_exists('vincentes_register_sidebars') ) {
	// Handler of the add_action('widgets_init', 'vincentes_register_sidebars');
	function vincentes_register_sidebars() {
		$sidebars = vincentes_get_sidebars();
		if (is_array($sidebars) && count($sidebars) > 0) {
			foreach ($sidebars as $id=>$sb) {
				register_sidebar( array(
										'name'          => esc_html($sb['name']),
										'description'   => esc_html($sb['description']),
										'id'            => esc_attr($id),
										'before_widget' => '<aside id="%1$s" class="widget %2$s">',
										'after_widget'  => '</aside>',
										'before_title'  => '<h5 class="widget_title">',
										'after_title'   => '</h5>'
										)
								);
			}
		}
	}
}

// Return theme specific widgetized areas
if ( !function_exists('vincentes_get_sidebars') ) {
	function vincentes_get_sidebars() {
		$list = apply_filters('vincentes_filter_list_sidebars', array(
			'sidebar_widgets'		=> array(
											'name' => esc_html__('Sidebar Widgets', 'vincentes'),
											'description' => esc_html__('Widgets to be shown on the main sidebar', 'vincentes')
											),
			'header_widgets'		=> array(
											'name' => esc_html__('Header Widgets', 'vincentes'),
											'description' => esc_html__('Widgets to be shown at the top of the page (in the page header area)', 'vincentes')
											),
			'above_page_widgets'	=> array(
											'name' => esc_html__('Top Page Widgets', 'vincentes'),
											'description' => esc_html__('Widgets to be shown below the header, but above the content and sidebar', 'vincentes')
											),
			'above_content_widgets' => array(
											'name' => esc_html__('Above Content Widgets', 'vincentes'),
											'description' => esc_html__('Widgets to be shown above the content, near the sidebar', 'vincentes')
											),
			'below_content_widgets' => array(
											'name' => esc_html__('Below Content Widgets', 'vincentes'),
											'description' => esc_html__('Widgets to be shown below the content, near the sidebar', 'vincentes')
											),
			'below_page_widgets' 	=> array(
											'name' => esc_html__('Bottom Page Widgets', 'vincentes'),
											'description' => esc_html__('Widgets to be shown below the content and sidebar, but above the footer', 'vincentes')
											),
			'footer_widgets'		=> array(
											'name' => esc_html__('Footer Widgets', 'vincentes'),
											'description' => esc_html__('Widgets to be shown at the bottom of the page (in the page footer area)', 'vincentes')
											)
			)
		);
		return $list;
	}
}


//-------------------------------------------------------
//-- Theme fonts
//-------------------------------------------------------

// Return links for all theme fonts
if ( !function_exists('vincentes_theme_fonts_links') ) {
	function vincentes_theme_fonts_links() {
		$links = array();
		
		/*
		Translators: If there are characters in your language that are not supported
		by chosen font(s), translate this to 'off'. Do not translate into your own language.
		*/
		$google_fonts_enabled = ( 'off' !== esc_html_x( 'on', 'Google fonts: on or off', 'vincentes' ) );
		$custom_fonts_enabled = ( 'off' !== esc_html_x( 'on', 'Custom fonts (included in the theme): on or off', 'vincentes' ) );
		
		if ( ($google_fonts_enabled || $custom_fonts_enabled) && !vincentes_storage_empty('load_fonts') ) {
			$load_fonts = (array)vincentes_storage_get('load_fonts');
			if (count($load_fonts) > 0) {
				$google_fonts = '';
				foreach ($load_fonts as $font) {
					$slug = vincentes_get_load_fonts_slug($font['name']);
					$url  = vincentes_get_file_url( sprintf('css/font-face/%s/stylesheet.css', $slug));
					if ($url != '') {
						if ($custom_fonts_enabled) {
							$links[$slug] = $url;
						}
					} else {
						if ($google_fonts_enabled) {
							$google_fonts .= ($google_fonts ? '|' : '') 
											. str_replace(' ', '+', $font['name'])
											. ':' 
											. (empty($font['styles']) ? '400,400italic,700,700italic' : $font['styles']);
						}
					}
				}
				if ($google_fonts && $google_fonts_enabled) {
					$links['google_fonts'] = sprintf('%s://fonts.googleapis.com/css?family=%s&subset=%s', vincentes_get_protocol(), $google_fonts, vincentes_get_theme_option('load_fonts_subset'));
				}
			}
		}
		return $links;
	}
}

// Return links for WP Editor
if ( !function_exists('vincentes_theme_fonts_for_editor') ) {
	function vincentes_theme_fonts_for_editor() {
		$links = array_values(vincentes_theme_fonts_links());
		if (is_array($links) && count($links) > 0) {
			for ($i=0; $i<count($links); $i++) {
				$links[$i] = str_replace(',', '%2C', $links[$i]);
			}
		}
		return $links;
	}
}


//-------------------------------------------------------
//-- The Excerpt
//-------------------------------------------------------
if ( !function_exists('vincentes_excerpt_length') ) {
	function vincentes_excerpt_length( $length ) {
		return max(1, vincentes_get_theme_setting('max_excerpt_length'));
	}
}

if ( !function_exists('vincentes_excerpt_more') ) {
	function vincentes_excerpt_more( $more ) {
		return '&hellip;';
	}
}


//------------------------------------------------------------------------
// One-click import support
//------------------------------------------------------------------------

// Set theme specific importer options
if ( !function_exists( 'vincentes_importer_set_options' ) ) {
	//Handler of the add_filter( 'trx_addons_filter_importer_options',	'vincentes_importer_set_options', 9 );
	function vincentes_importer_set_options($options=array()) {
		if (is_array($options)) {
			// Save or not installer's messages to the log-file
			$options['debug'] = false;
			// Prepare demo data
			$options['demo_url'] = esc_url(vincentes_get_protocol() . '://demofiles.ancorathemes.com/vinsentes/');
			// Required plugins
			$options['required_plugins'] = vincentes_storage_get('required_plugins');
			// Default demo
			$options['files']['default']['title'] = esc_html__('Vincentes Demo', 'vincentes');
			$options['files']['default']['domain_dev'] = esc_url(vincentes_get_protocol().'://vinsentes.dv.ancorathemes.com');		// Developers domain
			$options['files']['default']['domain_demo']= esc_url(vincentes_get_protocol().'://vincentes.ancorathemes.com');		// Demo-site domain
			// If theme need more demo - just copy 'default' and change required parameter

		}
		return $options;
	}
}

// Add checkbox with "I agree ..."
if ( ! function_exists( 'vincentes_comment_form_agree' ) ) {
    add_filter('comment_form_fields', 'vincentes_comment_form_agree', 11);
    function vincentes_comment_form_agree( $comment_fields ) {
        $privacy_text = vincentes_get_privacy_text();
        if ( ! empty( $privacy_text ) ) {
            $comment_fields['i_agree_privacy_policy'] = vincentes_single_comments_field(
                array(
                    'form_style'        => 'default',
                    'field_type'        => 'checkbox',
                    'field_req'         => '',
                    'field_icon'        => '',
                    'field_value'       => '1',
                    'field_name'        => 'i_agree_privacy_policy',
                    'field_title'       => $privacy_text,
                )
            );
        }
        return $comment_fields;
    }
}



//-------------------------------------------------------
//-- Include theme (or child) PHP-files
//-------------------------------------------------------

require_once VINCENTES_THEME_DIR . 'includes/utils.php';
require_once VINCENTES_THEME_DIR . 'includes/storage.php';
require_once VINCENTES_THEME_DIR . 'includes/lists.php';
require_once VINCENTES_THEME_DIR . 'includes/wp.php';

if (is_admin()) {
	require_once VINCENTES_THEME_DIR . 'includes/tgmpa/class-tgm-plugin-activation.php';
	require_once VINCENTES_THEME_DIR . 'includes/admin.php';
}

require_once VINCENTES_THEME_DIR . 'theme-options/theme.customizer.php';

require_once VINCENTES_THEME_DIR . 'theme-specific/theme.tags.php';
require_once VINCENTES_THEME_DIR . 'theme-specific/theme.hovers/theme.hovers.php';


// Plugins support
if (is_array($VINCENTES_STORAGE['required_plugins']) && count($VINCENTES_STORAGE['required_plugins']) > 0) {
	foreach ($VINCENTES_STORAGE['required_plugins'] as $plugin_slug) {
		$plugin_slug = vincentes_esc($plugin_slug);
		$plugin_path = VINCENTES_THEME_DIR . sprintf('plugins/%s/%s.php', $plugin_slug, $plugin_slug);
		if (file_exists($plugin_path)) { require_once $plugin_path; }
	}
}
?>