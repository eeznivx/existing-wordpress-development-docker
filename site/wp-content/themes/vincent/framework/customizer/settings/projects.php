<?php
/**
 * Projects setting for Customizer
 *
 * @package vincent
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Project Related General
$this->sections['vincent_projects_general'] = array(
	'title' => esc_html__( 'General', 'vincent' ),
	'panel' => 'vincent_projects',
	'settings' => array(
		array(
			'id' => 'project_related',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable', 'vincent' ),
				'type' => 'checkbox',
				'active_callback' => 'vincent_cac_has_single_project',
			),
		),
		array(
			'id' => 'project_related_title',
			'default' => esc_html__( 'Related Projects', 'vincent' ),
			'control' => array(
				'label' => esc_html__( 'Project Related Title', 'vincent' ),
				'type' => 'text',
				'active_callback' => 'vincent_cac_has_related_project',
			),
		),
		array(
			'id' => 'project_related_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Wrap Padding', 'vincent' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 100px 0px 100px 0px', 'vincent' ),
				'active_callback' => 'vincent_cac_has_related_project',
			),
			'inline_css' => array(
				'target' => '.project-related-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'project_related_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Wrap Background', 'vincent' ),
				'active_callback' => 'vincent_cac_has_related_project',
			),
			'inline_css' => array(
				'target' => '.project-related-wrap',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'project_related_query',
			'default' => 7,
			'control' => array(
				'label' => esc_html__( 'Number of items', 'vincent' ),
				'type' => 'number',
				'active_callback' => 'vincent_cac_has_related_project',
			),
		),
		array(
			'id' => 'project_related_column',
			'default' => '3',
			'control' => array(
				'label' => esc_html__( 'Columns', 'vincent' ),
				'type' => 'select',
				'choices' => array(
					'4' => '4',
					'3' => '3',
					'2' => '2',
				),
				'active_callback' => 'vincent_cac_has_related_project',
			),
		),
		array(
			'id' => 'project_related_item_spacing',
			'default' => 0,
			'control' => array(
				'label' => esc_html__( 'Spacing between items', 'vincent' ),
				'type' => 'number',
				'active_callback' => 'vincent_cac_has_related_project',
			),
		),
		array(
			'id' => 'project_related_img_crop',
			'default' => 'square',
			'control' => array(
				'label' => esc_html__( 'Image Size', 'vincent' ),
				'type' => 'select',
				'choices' => array(
					'square' => '600 x 600',
					'rectangle' => '600 x 500',
					'rectangle2' => '600 x 390',
				),
				'active_callback' => 'vincent_cac_has_related_project',
			),
		),

	),
);