<?php
/**
 * Blog setting for Customizer
 *
 * @package vincent
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Blog Posts General
$this->sections['vincent_blog_post'] = array(
	'title' => esc_html__( 'General', 'vincent' ),
	'panel' => 'vincent_blog',
	'settings' => array(
		array(
			'id' => 'blog_featured_title',
			'default' => esc_html__( 'Latest News', 'vincent' ),
			'control' => array(
				'label' => esc_html__( 'Blog Featured Title', 'vincent' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'blog_featured_subtitle',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Blog Featured Sub-Title', 'vincent' ),
				'type' => 'vincent_textarea',
				'rows' => 5,
			),
		),
		array(
			'id' => 'blog_entry_content_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Entry Content Background Color', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '.post-content-wrap',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'blog_entry_content_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Entry Content Padding', 'vincent' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'blog_entry_content_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Entry Bottom Margin', 'vincent' ),
				'description' => esc_html__( 'Example: 30px.', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '.hentry',
				'alter' => 'margin-top',
			),
		),
		array(
			'id' => 'blog_entry_composer',
			'default' => 'title,meta,excerpt_content,readmore',
			'control' => array(
				'label' => esc_html__( 'Entry Content Elements', 'vincent' ),
				'type' => 'vincent-sortable',
				'object' => 'Vincent_Customize_Control_Sorter',
				'choices' => array(
					'title'           => esc_html__( 'Title', 'vincent' ),
					'meta'            => esc_html__( 'Meta', 'vincent' ),
					'excerpt_content' => esc_html__( 'Excerpt', 'vincent' ),
					'readmore'        => esc_html__( 'Read More', 'vincent' ),
				),
				'desc' => esc_html__( 'Drag and drop elements to re-order.', 'vincent' ),
			),
		),
	),
);

// Blog Posts Title
$this->sections['vincent_blog_post_title'] = array(
	'title' => esc_html__( 'Blog Post - Title', 'vincent' ),
	'panel' => 'vincent_blog',
	'settings' => array(
		array(
			'id' => 'blog_title_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Margin', 'vincent' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-title',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'blog_title_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'vincent' ),
			),
			'inline_css' => array(
				'target' => array(
					'.hentry .post-title a',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_title_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color Hover', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-title a:hover',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Meta
$this->sections['vincent_blog_post_meta'] = array(
	'title' => esc_html__( 'Blog Post - Meta', 'vincent' ),
	'panel' => 'vincent_blog',
	'settings' => array(
		array(
			'id' => 'blog_entry_meta_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Meta Margin', 'vincent' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0 0 20px 0.', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta',
				'alter' => 'margin',
			),
		),
		array(
			'id'  => 'blog_entry_meta_items',
			'default' => array( 'categories' ),
			'control' => array(
				'label' => esc_html__( 'Meta Items', 'vincent' ),
				'desc' => esc_html__( 'Click and drag and drop elements to re-order them.', 'vincent' ),
				'type' => 'vincent-sortable',
				'object' => 'Vincent_Customize_Control_Sorter',
				'choices' => array(
					'date'       => esc_html__( 'Date', 'vincent' ),
					'author'     => esc_html__( 'Author', 'vincent' ),
					'comments' => esc_html__( 'Comments', 'vincent' ),
					'categories' => esc_html__( 'Categories', 'vincent' ),
				),
			),
		),
		array(
			'id' => 'heading_blog_entry_meta_item',
			'control' => array(
				'type' => 'vincent-heading',
				'label' => esc_html__( 'Item Meta', 'vincent' ),
			),
		),
		array(
			'id' => 'blog_entry_meta_item_icon_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Separate Color', 'vincent' ),
			),
			'inline_css' => array(
				'target' => array(
					'.hentry .post-meta .post-meta-content .item .inner:before',
				),
				'alter' => array(
					'color',
				),
			),
		),
		array(
			'id' => 'blog_entry_meta_item_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_entry_meta_item_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_entry_meta_item_link_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color Hover', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item a:hover',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Excerpt
$this->sections['vincent_blog_post_excerpt'] = array(
	'title' => esc_html__( 'Blog Post - Excerpt', 'vincent' ),
	'panel' => 'vincent_blog',
	'settings' => array(
		array(
			'id' => 'blog_content_style',
			'default' => 'style-1',
			'control' => array(
				'label' => esc_html__( 'Content Style', 'vincent' ),
				'type' => 'select',
				'choices' => array(
					'style-1' => esc_html__( 'Normal', 'vincent' ),
					'style-2' => esc_html__( 'Excerpt', 'vincent' ),
				),
			),
		),
		array(
			'id' => 'blog_excerpt_length',
			'default' => '50',
			'control' => array(
				'label' => esc_html__( 'Excerpt length', 'vincent' ),
				'type' => 'text',
				'desc' => esc_html__( 'This option only apply for Content Style: Excerpt.', 'vincent' )
			),
		),
		array(
			'id' => 'blog_excerpt_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Margin', 'vincent' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0 0 30px 0.', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-excerpt',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'blog_excerpt_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'vincent' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-excerpt',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Read More
$this->sections['vincent_blog_post_read_more'] = array(
	'title' => esc_html__( 'Blog Post - Read More', 'vincent' ),
	'panel' => 'vincent_blog',
	'settings' => array(
		array(
			'id' => 'blog_entry_button_read_more_text',
			'default' => esc_html__( 'Read more', 'vincent' ),
			'control' => array(
				'label' => esc_html__( 'Button Text', 'vincent' ),
				'type' => 'text',
			),
		),
	),
);

