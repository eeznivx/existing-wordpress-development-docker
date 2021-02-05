<?php
/**
 * General setting for Customizer
 *
 * @package vincent
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Accent Colors
$this->sections['vincent_accent_colors'] = array(
	'title' => esc_html__( 'Accent Colors', 'vincent' ),
	'panel' => 'vincent_general',
	'settings' => array(
		array(
			'id' => 'accent_color',
			'default' => '#0b77ee',
			'control' => array(
				'label' => esc_html__( 'Accent Color', 'vincent' ),
				'type' => 'color',
			),
		),
	)
);

// Favicon
$this->sections['vincent_favicon'] = array(
	'title' => esc_html__( 'Favicon', 'vincent' ),
	'panel' => 'vincent_general',
	'settings' => array(
		array(
			'id' => 'favicon',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Site Icon', 'vincent' ),
				'type' => 'image',
				'description' => esc_html__( 'The Site Icon is used as a browser and app icon for your site. Icons must be square, and at least 512 pixels wide and tall.', 'vincent' ),
			),
		),
	)
);

// PreLoader
$this->sections['vincent_preloader'] = array(
	'title' => esc_html__( 'PreLoader', 'vincent' ),
	'panel' => 'vincent_general',
	'settings' => array(
		array(
			'id' => 'preloader',
			'default' => 'animsition',
			'control' => array(
				'label' => esc_html__( 'Preloader Option', 'vincent' ),
				'type' => 'select',
				'choices' => array(
					'animsition' => esc_html__( 'Enable','vincent' ),
					'' => esc_html__( 'Disable','vincent' )
				),
			),
		),
	)
);

// Header Site
$this->sections['vincent_header_site'] = array(
	'title' => esc_html__( 'Header Site', 'vincent' ),
	'panel' => 'vincent_general',
	'settings' => array(
		array(
			'id' => 'header_site_style',
			'default' => 'style-1',
			'control' => array(
				'label' => esc_html__( 'Header Style', 'vincent' ),
				'type' => 'select',
				'choices' => array(
					'style-1' => esc_html__( 'Header White', 'vincent' ),
					'style-2' => esc_html__( 'Header Transparent', 'vincent' ),
				),
				'desc' => esc_html__( 'Header Style for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Page Settings metabox when edit.', 'vincent' )
			),
		),
		array(
			'id' => 'header_fixed',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Header Fixed: Enable', 'vincent' ),
				'type' => 'checkbox',
			),
		),
	),
);

// Scroll to top
$this->sections['vincent_scroll_top'] = array(
	'title' => esc_html__( 'Scroll Top Button', 'vincent' ),
	'panel' => 'vincent_general',
	'settings' => array(
		array(
			'id' => 'scroll_top',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'vincent' ),
				'type' => 'checkbox',
			),
		),
	),
);

// Forms
$this->sections['vincent_general_forms'] = array(
	'title' => esc_html__( 'Forms', 'vincent' ),
	'panel' => 'vincent_general',
	'settings' => array(
		array(
			'id' => 'input_border_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Border Rounded', 'vincent' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-radius',
			),
		),
		array(
			'id' => 'input_background_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'vincent' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'input_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border Color', 'vincent' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'input_border_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Border Width', 'vincent' ),
				'description' => esc_html__( 'Enter a value in pixels. Example: 1px.', 'vincent' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'input_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'vincent' ),
			),
			'inline_css' => array(
				'target' => array(
					'textarea,input[type="text"],input[type="password"],input[type="datetime"],input[type="datetime-local"],input[type="date"],input[type="month"],input[type="time"],input[type="week"],input[type="number"],input[type="email"],input[type="url"],input[type="search"],input[type="tel"],input[type="color"]',
				),
				'alter' => 'color',
			),
		),
	),
);

// Responsive
$this->sections['vincent_responsive'] = array(
	'title' => esc_html__( 'Responsive', 'vincent' ),
	'panel' => 'vincent_general',
	'settings' => array(
		// Mobile Button
		array(
			'id' => 'heading_mobile_button',
			'control' => array(
				'type' => 'vincent-heading',
				'label' => esc_html__( 'Mobile Button', 'vincent' ),
			),
		),
		array(
			'id' => 'mobile_button_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Mobile Button Color', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '.mobile-button:before, .mobile-button:after, .mobile-button span',
				'alter' => 'background-color'
			),
		),
		// Mobile Logo
		array(
			'id' => 'heading_mobile_logo',
			'control' => array(
				'type' => 'vincent-heading',
				'label' => esc_html__( 'Mobile Logo', 'vincent' ),
			),
		),
		array(
			'id' => 'mobile_logo_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Mobile Logo: Width', 'vincent' ),
				'description' => esc_html__( 'Example: 200px.', 'vincent' ),
			),
			'inline_css' => array(
				'media_query' => '(max-width: 991px)',
				'target' => '#site-logo',
				'alter' => 'max-width',
			),
		),
		array(
			'id' => 'mobile_logo_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Mobile Logo: Margin', 'vincent' ),
				'description' => esc_html__( 'Example: 10px 0px 10px 0px.', 'vincent' ),
			),
			'inline_css' => array(
				'media_query' => '(max-width: 991px)',
				'target' => '#site-logo-inner',
				'alter' => 'margin',
			),
		),
		// Mobile Menu
		array(
			'id' => 'heading_mobile_menu',
			'control' => array(
				'type' => 'vincent-heading',
				'label' => esc_html__( 'Mobile Menu', 'vincent' ),
			),
		),
		array(
			'id' => 'mobile_menu_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '#main-nav-mobi ul > li > a',
				'alter' => 'color'
			),
		),
		array(
			'id' => 'mobile_menu_item_height',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Item Height', 'vincent' ),
				'description' => esc_html__( 'Example: 40px.', 'vincent' ),
			),
			'inline_css' => array(
				'target' => array(
					'#main-nav-mobi ul > li > a',
					'#main-nav-mobi .menu-item-has-children .arrow'
				),
				'alter' => 'line-height'
			),
		),
	)
);