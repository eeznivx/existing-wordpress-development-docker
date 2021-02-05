<?php
/**
 * Header setting for Customizer
 *
 * @package vincent
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Header General
$this->sections['vincent_header_general'] = array(
	'title' => esc_html__( 'General', 'vincent' ),
	'panel' => 'vincent_header',
	'settings' => array(
		// Header 1
		array(
			'id' => 'header_background',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Background', 'vincent' ),
				'active_callback' => 'vincent_cac_has_header_one',
				'type' => 'color',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-1 #site-header'
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'header_top_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Top Padding', 'vincent' ),
				'description' => esc_html__( 'Example: 50px.', 'vincent' ),
				'active_callback' => 'vincent_cac_has_header_one',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-1 #site-header-inner'
				),
				'alter' => 'padding-top',
			),
		),
		array(
			'id' => 'header_bottom_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Padding', 'vincent' ),
				'description' => esc_html__( 'Example: 50px.', 'vincent' ),
				'active_callback' => 'vincent_cac_has_header_one',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-1 #site-header-inner'
				),
				'alter' => 'padding-bottom',
			),
		),
		// Header 2 - Float
		array(
			'id' => 'header_two_background',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Background', 'vincent' ),
				'active_callback' => 'vincent_cac_has_header_two',
				'type' => 'color',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-2 #site-header:after'
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'header_two_background_opacity',
			'transport' => 'postMessage',
			'default' => '0.0001',
			'control' => array(
				'label'  => esc_html__( 'Background Opacity', 'vincent' ),
				'active_callback' => 'vincent_cac_has_header_two',
				'type' => 'select',
				'choices' => array(
					'1' => esc_html__( '1', 'vincent' ),
					'0.9' => esc_html__( '0.9', 'vincent' ),
					'0.8' => esc_html__( '0.8', 'vincent' ),
					'0.7' => esc_html__( '0.7', 'vincent' ),
					'0.6' => esc_html__( '0.6', 'vincent' ),
					'0.5' => esc_html__( '0.5', 'vincent' ),
					'0.4' => esc_html__( '0.4', 'vincent' ),
					'0.3' => esc_html__( '0.3', 'vincent' ),
					'0.2' => esc_html__( '0.2', 'vincent' ),
					'0.1' => esc_html__( '0.1', 'vincent' ),
					'0.0001' => esc_html__( '0', 'vincent' ),
				),
			),
			'inline_css' => array(
				'target' => '.header-style-2 #site-header:after',
				'alter' => 'opacity',
			),
		),
		array(
			'id' => 'header_two_top_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Top Padding', 'vincent' ),
				'description' => esc_html__( 'Example: 50px.', 'vincent' ),
				'active_callback' => 'vincent_cac_has_header_two',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-2 #site-header-inner'
				),
				'alter' => 'padding-top',
			),
		),
		array(
			'id' => 'header_two_bottom_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Padding', 'vincent' ),
				'description' => esc_html__( 'Example: 50px.', 'vincent' ),
				'active_callback' => 'vincent_cac_has_header_two',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-2 #site-header-inner'
				),
				'alter' => 'padding-bottom',
			),
		),
	)
);

// Header Logo
$this->sections['vincent_header_logo'] = array(
	'title' => esc_html__( 'Logo', 'vincent' ),
	'panel' => 'vincent_header',
	'settings' => array(
		// Logo 1
		array(
			'id' => 'logo_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Logo Margin', 'vincent' ),
		 		'description' => esc_html__( 'Top Right Bottom Left. Example: 30px 0px 0px 0px.', 'vincent' ),
		 		'active_callback' => 'vincent_cac_has_header_one',
			),
			'inline_css' => array(
				'media_query' => '(min-width: 992px)',
				'target' => '.header-style-1 #site-logo-inner',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'custom_logo',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Logo Image', 'vincent' ),
				'type' => 'image',
				'active_callback' => 'vincent_cac_has_header_one',
			),
		),
		array(
			'id' => 'logo_width',
			'control' => array(
				'label' => esc_html__( 'Logo Width', 'vincent' ),
				'description' => esc_html__( 'This should be exactly the same as the width of the logo.', 'vincent' ),
				'type' => 'text',
				'active_callback' => 'vincent_cac_has_header_one',
			),
		),
		array(
			'id' => 'logo_height',
			'control' => array(
				'label' => esc_html__( 'Logo Height', 'vincent' ),
				'type' => 'text',
				'description' => esc_html__( 'This should be exactly the same as the height of the logo.', 'vincent' ),
				'active_callback' => 'vincent_cac_has_header_one',
			),
		),
		array(
			'id' => 'retina_logo',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Retina Logo Image', 'vincent' ),
				'type' => 'image',
				'description' => esc_html__('2x times your logo dimension.', 'vincent' ),
				'active_callback' => 'vincent_cac_has_header_one',
			),
		),
		// Logo 2
		array(
			'id' => 'logotwo_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Logo Margin', 'vincent' ),
		 		'description' => esc_html__( 'Top Right Bottom Left. Example: 30px 0px 0px 0px.', 'vincent' ),
		 		'active_callback' => 'vincent_cac_has_header_two',
			),
			'inline_css' => array(
				'media_query' => '(min-width: 992px)',
				'target' => '.header-style-2 #site-logo-inner',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'custom_logotwo',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Logo Image', 'vincent' ),
				'type' => 'image',
				'active_callback' => 'vincent_cac_has_header_two',
			),
		),
		array(
			'id' => 'logotwo_width',
			'control' => array(
				'label' => esc_html__( 'Logo Width', 'vincent' ),
				'description' => esc_html__( 'This should be exactly the same as the width of the logo.', 'vincent' ),
				'type' => 'text',
				'active_callback' => 'vincent_cac_has_header_two',
			),
		),
		array(
			'id' => 'logotwo_height',
			'control' => array(
				'label' => esc_html__( 'Logo Height', 'vincent' ),
				'type' => 'text',
				'description' => esc_html__( 'This should be exactly the same as the height of the logo.', 'vincent' ),
				'active_callback' => 'vincent_cac_has_header_two',
			),
		),
		array(
			'id' => 'retina_logotwo',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Retina Logo Image', 'vincent' ),
				'type' => 'image',
				'description' => esc_html__('2x times your logo dimension.', 'vincent' ),
				'active_callback' => 'vincent_cac_has_header_two',
			),
		),
	)
);

// Header Menu
$this->sections['vincent_header_menu'] = array(
	'title' => esc_html__( 'Menu', 'vincent' ),
	'panel' => 'vincent_header',
	'settings' => array(
		// General
		array(
			'id' => 'menu_link_spacing',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Link Spacing', 'vincent' ),
				'description' => esc_html__( 'Example: 20px', 'vincent' ),
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-1 #main-nav > ul > li',
					'.header-style-2 #main-nav > ul > li'
				),
				'alter' => array(
					'padding-left',
					'padding-right',
				),
			),
		),
		array(
			'id' => 'menu_height',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Menu Height', 'vincent' ),
				'description' => esc_html__( 'Example: 100px', 'vincent' ),
			),
			'inline_css' => array(
				'target' => array(
					'#site-header #main-nav > ul > li > a',
				),
				'alter' => array(
					'height',
					'line-height',
				),
			),
		),
		// Header 1
		array(
			'id' => 'menu_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'vincent' ),
				'active_callback' => 'vincent_cac_has_header_one',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-1 #main-nav > ul > li > a',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'menu_link_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Hover', 'vincent' ),
				'active_callback' => 'vincent_cac_has_header_one',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-1 #main-nav > ul > li > a:hover',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'menu_link_current',
			'default' => 'cur-menu-1',
			'control' => array(
				'label' => esc_html__( 'Current Link Style', 'vincent' ),
				'type' => 'select',
				'choices' => array(
					'cur-menu-1' => esc_html__( 'Style 1', 'vincent' ),
					'cur-menu-2'  => esc_html__( 'Style 2', 'vincent' ),
				),
				'active_callback' => 'vincent_cac_has_header_one',
			),
		),
		// Header 2
		array(
			'id' => 'menu_two_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'vincent' ),
				'active_callback' => 'vincent_cac_has_header_two',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-2 #main-nav > ul > li > a',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'menu_two_link_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Hover', 'vincent' ),
				'active_callback' => 'vincent_cac_has_header_two',
			),
			'inline_css' => array(
				'target' => array(
					'.header-style-2 #main-nav > ul > li > a:hover',
				),
				'alter' => 'color',
			),
		),
	)
);

// Search & Cart
$this->sections['vincent_header_search_cart'] = array(
	'title' => esc_html__( 'Search & Cart Icon', 'vincent' ),
	'panel' => 'vincent_header',
	'settings' => array(
		// Search Icon
		array(
			'id' => 'header_search_icon',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Search Icon', 'vincent' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'header_search_icon_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Search Icon: Margin', 'vincent' ),
				'description' => esc_html__( 'Example: 30px 0px 30px 10px', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '#site-header #header-search',
				'alter' => 'padding',
			),
		),
		// Cart Icon
		array(
			'id' => 'header_cart_icon',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Cart Icon', 'vincent' ),
				'type' => 'checkbox',
				'active_callback' => 'vincent_cac_has_woo',
			),
		),
		array(
			'id' => 'header_cart_icon_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Cart Icon: Margin', 'vincent' ),
				'description' => esc_html__( 'Example: 30px 0px 30px 10px', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '.nav-top-cart-wrapper',
				'alter' => 'padding',
			),
		),
	)
);