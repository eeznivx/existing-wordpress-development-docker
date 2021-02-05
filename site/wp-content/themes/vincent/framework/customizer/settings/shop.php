<?php
/**
 * Shop setting for Customizer
 *
 * @package vincent
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Main Shop
$this->sections['vincent_shop_general'] = array(
	'title' => esc_html__( 'Main Shop', 'vincent' ),
	'panel' => 'vincent_shop',
	'settings' => array(
		array(
			'id' => 'shop_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Shop Layout Position', 'vincent' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'vincent' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'vincent' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'vincent' ),
				),
				'desc' => esc_html__( 'Specify layout for main shop page.', 'vincent' ),
				'active_callback' => 'vincent_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_featured_title',
			'default' => esc_html__( 'Our Shop', 'vincent' ),
			'control' => array(
				'label' => esc_html__( 'Shop: Featured Title', 'vincent' ),
				'type' => 'text',
				'active_callback' => 'vincent_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_featured_subtitle',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Shop: Featured Sub-Title', 'vincent' ),
				'type' => 'vincent_textarea',
				'rows' => 5,
				'active_callback' => 'vincent_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_products_per_page',
			'default' => 6,
			'control' => array(
				'label' => esc_html__( 'Products Per Page', 'vincent' ),
				'type' => 'number',
				'active_callback' => 'vincent_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_columns',
			'default' => '3',
			'control' => array(
				'label' => esc_html__( 'Shop Columns', 'vincent' ),
				'type' => 'select',
				'choices' => array(
					'2' => '2',
					'3' => '3',
					'4' => '4',
				),
				'active_callback' => 'vincent_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_item_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Item Bottom Margin', 'vincent' ),
				'description' => esc_html__( 'Example: 30px.', 'vincent' ),
				'active_callback' => 'vincent_cac_has_woo',
			),
			'inline_css' => array(
				'target' => '.woocommerce-page .content-woocommerce .products li',
				'alter' => 'margin-bottom',
			),
		),
	),
);

// Single Shop
$this->sections['vincent_single_shop_general'] = array(
	'title' => esc_html__( 'Single Shop', 'vincent' ),
	'panel' => 'vincent_shop',
	'settings' => array(
		array(
			'id' => 'shop_single_featured_title',
			'default' => esc_html__( 'Our Shop', 'vincent' ),
			'control' => array(
				'label' => esc_html__( 'Shop Single: Featured Title', 'vincent' ),
				'type' => 'text',
				'active_callback' => 'vincent_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_single_featured_subtitle',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Shop Single: Featured Sub-Title', 'vincent' ),
				'type' => 'vincent_textarea',
				'rows' => 5,
				'active_callback' => 'vincent_cac_has_woo',
			),
		),
		array(
			'id' => 'shop_single_layout_position',
			'default' => 'no-sidebar',
			'control' => array(
				'label' => esc_html__( 'Shop Single Layout Position', 'vincent' ),
				'type' => 'select',
				'choices' => array(
					'sidebar-right' => esc_html__( 'Right Sidebar', 'vincent' ),
					'sidebar-left'  => esc_html__( 'Left Sidebar', 'vincent' ),
					'no-sidebar'    => esc_html__( 'No Sidebar', 'vincent' ),
				),
				'desc' => esc_html__( 'Specify layout on the shop single page.', 'vincent' ),
				'active_callback' => 'vincent_cac_has_woo',
			),
		),
	),
);