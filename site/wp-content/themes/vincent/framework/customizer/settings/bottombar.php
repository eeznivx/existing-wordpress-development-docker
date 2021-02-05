<?php
/**
 * Bottom Bar setting for Customizer
 *
 * @package vincent
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Bottom Bar General
$this->sections['vincent_bottombar_general'] = array(
	'title' => esc_html__( 'General', 'vincent' ),
	'panel' => 'vincent_bottombar',
	'settings' => array(
		array(
			'id' => 'bottom_bar',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'vincent' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'bottom_copyright',
			'transport' => 'postMessage',
			'default' => '&copy; Vincent Eight. All rights reserved.',
			'control' => array(
				'label' => esc_html__( 'Copyright', 'vincent' ),
				'type' => 'vincent_textarea',
				'active_callback' => 'vincent_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_right_content',
			'transport' => 'postMessage',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Right Content', 'vincent' ),
				'type' => 'vincent_textarea',
				'active_callback' => 'vincent_cac_has_bottombar',
			),
		),
		array(
			'id' => 'bottom_padding',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'text',
				'label' => esc_html__( 'Padding', 'vincent' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'vincent' ),
				'active_callback'=> 'vincent_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom .bottom-bar-inner-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'bottom_background',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'vincent' ),
				'active_callback'=> 'vincent_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom',
				'alter' => 'background',
			),
		),
		array(
			'id' => 'bottom_color',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'vincent' ),
				'active_callback'=> 'vincent_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => '#bottom',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'bottom_link_color',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Links', 'vincent' ),
				'active_callback'=> 'vincent_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => array(
					'#bottom a',
					'#bottom ul.bottom-nav > li > a'
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'bottom_link_color_hover',
			'transport' => 'postMessage',
			'control' =>  array(
				'type' => 'color',
				'label' => esc_html__( 'Links: Hover', 'vincent' ),
				'active_callback'=> 'vincent_cac_has_bottombar',
			),
			'inline_css' => array(
				'target' => array(
					'#bottom a:hover',
					'#bottom ul.bottom-nav > li > a:hover'
				),
				'alter' => 'color',
			),
		),
	),
);