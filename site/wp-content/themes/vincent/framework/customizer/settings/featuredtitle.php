<?php
/**
 * Featured Title setting for Customizer
 *
 * @package vincent
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Featured Title General
$this->sections['vincent_featuredtitle_general'] = array(
	'title' => esc_html__( 'General', 'vincent' ),
	'panel' => 'vincent_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'vincent' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'featured_title_style',
			'default' => 'simple',
			'control' => array(
				'label'  => esc_html__( 'Style', 'vincent' ),
				'type' => 'select',
				'choices' => array(
					'simple' => esc_html__( 'Simple', 'vincent' ),
					'centered' => esc_html__( 'Centered', 'vincent' ),
				),
				'active_callback' => 'vincent_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_top_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Top Padding', 'vincent' ),
				'description' => esc_html__( 'Example: 30px', 'vincent' ),
				'active_callback' => 'vincent_cac_has_featured_title',
			),
			'inline_css' => array(
				'target' => array(
					'#featured-title .inner-wrap',
				),
				'alter' => 'padding-top',
			),
		),
		array(
			'id' => 'featured_title_bottom_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Padding', 'vincent' ),
				'description' => esc_html__( 'Example: 30px', 'vincent' ),
				'active_callback' => 'vincent_cac_has_featured_title',
			),
			'inline_css' => array(
				'target' => array(
					'#featured-title .inner-wrap',
				),
				'alter' => 'padding-bottom',
			),
		),
		array(
			'id' => 'featured_title_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Background', 'vincent' ),
				'active_callback' => 'vincent_cac_has_featured_title',
			),
			'inline_css' => array(
				'target' => '#featured-title',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'vincent' ),
				'active_callback' => 'vincent_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_background_img_style',
			'default' => 'repeat',
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
				'active_callback' => 'vincent_cac_has_featured_title',
			),
		),
	),
);

// Featured Title Heading
$this->sections['vincent_featuredtitle_heading'] = array(
	'title' => esc_html__( 'Heading', 'vincent' ),
	'panel' => 'vincent_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title_heading',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'vincent' ),
				'type' => 'checkbox',
				'active_callback' => 'vincent_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_heading_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Heading Bottom Margin', 'vincent' ),
				'active_callback' => 'vincent_cac_has_featured_title_center',
				'description' => esc_html__( 'Example: 5px.', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '#featured-title.centered .title-group',
				'alter' => 'margin-bottom',
			),
		),
		array(
			'id' => 'featured_title_heading_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'vincent' ),
				'active_callback' => 'vincent_cac_has_featured_title_heading',
			),
			'inline_css' => array(
				'target' => '#featured-title .main-title',
				'alter' => 'color',
			),
		),
	),
);

// Featured Title Breadcrumbs
$this->sections['vincent_featuredtitle_breadcrumbs'] = array(
	'title' => esc_html__( 'Breadcrumbs', 'vincent' ),
	'panel' => 'vincent_featuredtitle',
	'settings' => array(
		array(
			'id' => 'featured_title_breadcrumbs',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'vincent' ),
				'type' => 'checkbox',
				'active_callback' => 'vincent_cac_has_featured_title',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'vincent' ),
				'active_callback' => 'vincent_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => array(
					'#featured-title #breadcrumbs',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'vincent' ),
				'active_callback' => 'vincent_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => '#featured-title #breadcrumbs a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'featured_title_breadcrumbs_link_hover_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color: Hover', 'vincent' ),
				'active_callback' => 'vincent_cac_has_featured_title_breadcrumbs',
			),
			'inline_css' => array(
				'target' => '#featured-title #breadcrumbs a:hover',
				'alter' => 'color',
			),
		),
	),
);