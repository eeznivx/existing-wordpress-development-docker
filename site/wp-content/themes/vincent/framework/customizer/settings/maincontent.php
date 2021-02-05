<?php
/**
 * Main Content setting for Customizer
 *
 * @package vincent
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Main Content General
$this->sections['vincent_maincontent_general'] = array(
	'title' => esc_html__( 'General', 'vincent' ),
	'panel' => 'vincent_maincontent',
	'settings' => array(
		array(
			'id' => 'main_content_top_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Top Padding', 'vincent' ),
				'description' => esc_html__( 'Example: 30px', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '#main-content',
				'alter' => 'padding-top',
			),
		),
		array(
			'id' => 'main_content_bottom_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Bottom Padding', 'vincent' ),
				'description' => esc_html__( 'Example: 30px', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '#main-content, .footer-has-subs #main-content',
				'alter' => 'padding-bottom',
			),
		),
		array(
			'id' => 'main_content_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '#main-content',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'main_content_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'vincent' ),
			),
		),
		array(
			'id' => 'main_content_background_img_style',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Background Image Style', 'vincent' ),
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
			),
		),
	),
);

// Main Content Left
$this->sections['vincent_maincontent_left'] = array(
	'title' => esc_html__( 'Content', 'vincent' ),
	'panel' => 'vincent_maincontent',
	'settings' => array(
		array(
			'id' => 'left_content_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'vincent' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 30px', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '#inner-content',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'left_content_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '#inner-content',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'left_content_border_width',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Border Width', 'vincent' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0px 2px 0px 0px', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '#inner-content:after',
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'left_content_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border Color', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '#inner-content:after',
				'alter' => 'border-color',
			),
		),
	),
);

// Main Content Right
$this->sections['vincent_maincontent_right'] = array(
	'title' => esc_html__( 'Sidebar', 'vincent' ),
	'panel' => 'vincent_maincontent',
	'settings' => array(
		array(
			'id' => 'right_content_padding',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'vincent' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 30px', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '.sidebar-left #sidebar, .sidebar-right #sidebar',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'right_content_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '.sidebar-left #sidebar, .sidebar-right #sidebar',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'right_content_border_width',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Border Width', 'vincent' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0px 3px 3px 0px', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '.sidebar-left #sidebar, .sidebar-right #sidebar',
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'right_content_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Border Color', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '.sidebar-left #sidebar, .sidebar-right #sidebar',
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'right_content_border_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Border Rounded', 'vincent' ),
			),
			'inline_css' => array(
				'target' => array(
					'.sidebar-left #sidebar, .sidebar-right #sidebar',
				),
				'alter' => 'border-radius',
			),
		),
	),
);