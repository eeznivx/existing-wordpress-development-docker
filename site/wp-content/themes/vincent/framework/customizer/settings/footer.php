<?php
/**
 * Footer setting for Customizer
 *
 * @package vincent
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Footer General
$this->sections['vincent_footer_general'] = array(
	'title' => esc_html__( 'General', 'vincent' ),
	'panel' => 'vincent_footer',
	'settings' => array(
		array(
			'id' => 'footer_columns',
			'default' => '4',
			'control' => array(
				'label' => esc_html__( 'Footer Column(s)', 'vincent' ),
				'type' => 'select',
				'choices' => array(
					'5' => 'Style 5',
					'4' => 'Style 4',
					'3' => 'Style 3',
					'2' => 'Style 2',
					'1' => 'Style 1',
				),
			),
		),
		array(
			'id' => 'footer_column_gutter',
			'default' => '35',
			'transport' => 'postMessage',
			'control' => array(
				'label' => esc_html__( 'Footer Column Gutter', 'vincent' ),
				'type' => 'select',
				'choices' => array(
					'5'    => '5px',
					'10'   => '10px',
					'15'   => '15px',
					'20'   => '20px',
					'25'   => '25px',
					'30'   => '30px',
					'35'   => '35px',
					'40'   => '40px',
					'45'   => '45px',
					'50'   => '50px',
					'60'   => '60px',
					'70'   => '70px',
					'80'   => '80px',
				),
			),
		),
		array(
			'id' => 'footer_text_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '#footer-widgets .widget',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'footer_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background Color', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '#footer',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'footer_top_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Top Padding', 'vincent' ),
				'description' => esc_html__( 'Example: 60px.', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '#footer',
				'alter' => 'padding-top',
			),
		),
		array(
			'id' => 'footer_bottom_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Padding', 'vincent' ),
				'description' => esc_html__( 'Example: 60px.', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '#footer-widgets',
				'alter' => 'padding-bottom',
			),
		),
	),
);

// Footer Subscribe
$this->sections['vincent_footer_subscribe'] = array(
	'title' => esc_html__( 'Subscribe Form', 'vincent' ),
	'panel' => 'vincent_footer',
	'settings' => array(
		array(
			'id' => 'subscribe',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable', 'vincent' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'subscribe_title',
			'default' => esc_html__( 'Subscribe to our newsletter and stay updated on the latest news and special offers', 'vincent' ),
			'control' => array(
				'label' => esc_html__( 'Subscribe Title', 'vincent' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'subscribe_subtitle',
			'default' => esc_html__( 'We promise not to spam your inbox!', 'vincent' ),
			'control' => array(
				'label' => esc_html__( 'Note', 'vincent' ),
				'type' => 'text',
			),
		),
	),
);