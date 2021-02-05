<?php
/**
 * Layout setting for Customizer
 *
 * @package vincent
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Layout Style
$this->sections['vincent_layout_style'] = array(
	'title' => esc_html__( 'Layout Site', 'vincent' ),
	'panel' => 'vincent_layout',
	'settings' => array(
		array(
			'id' => 'site_layout_style',
			'default' => 'full-width',
			'control' => array(
				'label' => esc_html__( 'Layout Style', 'vincent' ),
				'type' => 'select',
				'choices' => array(
					'full-width' => esc_html__( 'Full Width','vincent' ),
					'boxed' => esc_html__( 'Boxed','vincent' )
				),
			),
		),
		array(
			'id' => 'site_layout_boxed_shadow',
			'control' => array(
				'label' => esc_html__( 'Box Shadow', 'vincent' ),
				'type' => 'checkbox',
				'active_callback' => 'vincent_cac_has_boxed_layout',
			),
		),
		array(
			'id' => 'site_layout_wrapper_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Wrapper Margin', 'vincent' ),
				'desc' => esc_html__( 'Top Right Bottom Left. Default: 30px 0px 30px 0px.', 'vincent' ),
				'active_callback' => 'vincent_cac_has_boxed_layout',
			),
			'inline_css' => array(
				'target' => '.site-layout-boxed #wrapper',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'wrapper_background_color',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Outer Background Color', 'vincent' ),
				'type' => 'color',
				'active_callback' => 'vincent_cac_has_boxed_layout',
			),
			'inline_css' => array(
				'target' => '.site-layout-boxed #wrapper',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'wrapper_background_img',
			'control' => array(
				'label' => esc_html__( 'Outer Background Image', 'vincent' ),
				'type' => 'image',
				'active_callback' => 'vincent_cac_has_boxed_layout',
			),
		),
		array(
			'id' => 'wrapper_background_img_style',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Outer Background Image Style', 'vincent' ),
				'type'  => 'image',
				'type'  => 'select',
				'choices' => array(
					''             => esc_html__( 'Default', 'vincent' ),
					'cover'        => esc_html__( 'Cover', 'vincent' ),
					'center-top'        => esc_html__( 'Center Top', 'vincent' ),
					'fixed-top'    => esc_html__( 'Fixed Top', 'vincent' ),
					'fixed'        => esc_html__( 'Fixed Center', 'vincent' ),
					'fixed-bottom' => esc_html__( 'Fixed Bottom', 'vincent' ),
					'repeat'       => esc_html__( 'Repeat', 'vincent' ),
					'repeat-x'     => esc_html__( 'Repeat-x', 'vincent' ),
					'repeat-y'     => esc_html__( 'Repeat-y', 'vincent' ),
				),
				'active_callback' => 'vincent_cac_has_boxed_layout',
			),
		),
	),
);

// Layout Position
$this->sections['vincent_layout_position'] = array(
	'title' => esc_html__( 'Layout Position', 'vincent' ),
	'panel' => 'vincent_layout',
	'settings' => array(
		array(
			'id' => 'site_layout_position',
			'default' => 'sidebar-right',
			'control' => array(
				'label' => esc_html__( 'Site Layout Position', 'vincent' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'vincent' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'vincent' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'vincent' ),
				),
				'desc' => esc_html__( 'Specify layout for all pages on website. (e.g. pages, blog posts, single post, archives, etc ). Single page can override this setting in Page Settings metabox when edit.', 'vincent' )
			),
		),
		array(
			'id' => 'single_post_layout_position',
			'default' => 'sidebar-right',
			'control' => array(
				'label' => esc_html__( 'Single Post Layout Position', 'vincent' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'vincent' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'vincent' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'vincent' ),
				),
				'desc' => esc_html__( 'Specify layout for all single post pages.', 'vincent' )
			),
		),
	),
);

// Layout Widths
$this->sections['vincent_layout_widths'] = array(
	'title' => esc_html__( 'Layout Widths', 'vincent' ),
	'panel' => 'vincent_layout',
	'settings' => array(
		array(
			'id' => 'site_desktop_container_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Container', 'vincent' ),
				'type' => 'text',
				'desc' => esc_html__( 'Default: 1170px', 'vincent' ),
			),
			'inline_css' => array(
				'target' => array( 
					'.site-layout-full-width .vincent-container',
					'.site-layout-boxed #page'
				),
				'alter' => 'width',
			),
		),
		array(
			'id' => 'left_container_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Content', 'vincent' ),
				'type' => 'text',
				'desc' => esc_html__( 'Example: 66%', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '#site-content',
				'alter' => 'width',
			),
		),
		array(
			'id' => 'sidebar_width',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Sidebar', 'vincent' ),
				'type' => 'text',
				'desc' => esc_html__( 'Example: 23%', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '#sidebar',
				'alter' => 'width',
			),
		),
	),
);