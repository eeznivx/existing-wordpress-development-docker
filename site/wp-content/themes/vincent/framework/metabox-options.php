<?php
/**
 * Metabox Options
 *
 * @package vincent
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return the registered-widget array
function vincent_get_widget_registered() {
	global $wp_registered_sidebars;

	$widgets_areas = array();
	if ( ! empty( $wp_registered_sidebars ) ) {
		foreach ( $wp_registered_sidebars as $widget_area ) {
			$name = isset ( $widget_area['name'] ) ? $widget_area['name'] : '';
			$id = isset ( $widget_area['id'] ) ? $widget_area['id'] : '';
			if ( $name && $id ) {
				$widgets_areas[$id] = $name;
			}
		}
	}

	return $widgets_areas;
}

// Return the all-widget array
function vincent_get_widget_mods() {
	$new_arr = array();
	$widget_areas_mod = vincent_get_mod( 'widget_areas' );
	
	if (is_array($widget_areas_mod) || is_object($widget_areas_mod)) {
		foreach( $widget_areas_mod as $key ) {
			$new_arr[sanitize_key($key)] = $key;
		}
	}
	
	$widget_areas = vincent_get_widget_registered() + $new_arr;

	return $widget_areas;
}

// Registering meta boxes. Using Meta Box plugin: https://metabox.io/
function vincent_register_meta_boxes( $meta_boxes ) {
	// Post Format Gallery
	$meta_boxes[] = array(
		'title'  => esc_html__( 'Post Format: Gallery', 'vincent' ),
		'id'     => 'opt-meta-box-post-format-gallery',
		'pages'  => array( 'post' ),
		'fields' => array(
			array(
				'name' => esc_html__( 'Images', 'vincent' ),
				'id'   => 'gallery_images',
				'type' => 'image_advanced',
			),
		),
	);

	// Post Format Video
	$meta_boxes[] = array(
		'title'  => esc_html__( 'Post Format: Video ( Embeded video from youtube, vimeo...)', 'vincent' ),
		'id'     => 'opt-meta-box-post-format-video',
		'pages'  => array( 'post' ),
		'fields' => array(
			array(
				'name' => esc_html__( 'Video URL or Embeded Code', 'vincent' ),
				'id'   => 'video_url',
				'type' => 'textarea',
			),
		)
	);

	// Partner
	$meta_boxes[] = array(
		'title'  => esc_html__( 'Partner Settings', 'vincent' ),
		'id'     => 'opt-meta-box-partner',
		'pages'  => array( 'partner' ),
		'fields' => array(
			array(
				'name' => esc_html__( 'Hyperlink', 'vincent' ),
				'id'   => 'partner_hyperlink',
				'type'       => 'text',
				'desc'  => esc_html__( "Partne's URL. Leave blank to disable (please 'http://' included).", 'vincent' )
			),
		)
	);

	// Portfolio
	$meta_boxes[] = array(
		'title'  => esc_html__( 'Project Settings', 'vincent' ),
		'id'     => 'opt-meta-box-project',
		'pages'  => array( 'project' ),
		'fields' => array(
			array(
				'name'    => esc_html__( 'Image Cropping', 'vincent' ),
				'id'      => 'image_crop',
				'type'    => 'select',
				'options' => array(
					'default' =>  esc_html__( 'Default', 'vincent' ),
					'full' => esc_html__( 'Full', 'vincent' ),
					'square' => esc_html__( '600 x 600', 'vincent' ),
					'square1' => esc_html__( '960 x 960', 'vincent' ),
					'square2' => esc_html__( '480 x 480', 'vincent' ),
					'rectangle' => esc_html__( '600 x 500', 'vincent' ),
					'rectangle1' => esc_html__( '960 x 480', 'vincent' ),
					'rectangle2' => esc_html__( '480 x 960', 'vincent' ),
				),
				'std'     => 'default',
			),
		)
	);

	// Member
	$meta_boxes[] = array(
		'title'  => esc_html__( 'Member Information', 'vincent' ),
		'id'     => 'opt-meta-box-pages',
		'pages'  => array( 'member' ),
		'fields' => array(
			array(
				'name' => esc_html__( 'Name', 'vincent' ),
				'id'   => 'name',
				'type'       => 'text',
			),
			array(
				'name' => esc_html__( 'Position', 'vincent' ),
				'id'   => 'position',
				'type'       => 'text',
			),
			array(
				'name' => esc_html__( 'Facebook', 'vincent' ),
				'id'   => 'facebook',
				'type'       => 'text',
			),
			array(
				'name' => esc_html__( 'Twitter', 'vincent' ),
				'id'   => 'twitter',
				'type'       => 'text',
			),
			array(
				'name' => esc_html__( 'Linkedin', 'vincent' ),
				'id'   => 'linkedin',
				'type'       => 'text',
			),
			array(
				'name' => esc_html__( 'Google +', 'vincent' ),
				'id'   => 'google_plus',
				'type'       => 'text',
			),
			array(
				'name' => esc_html__( 'Instagram', 'vincent' ),
				'id'   => 'instagram',
				'type'       => 'text',
			),
		)
	);

	// Testimonials
	$meta_boxes[] = array(
		'title'  => esc_html__( 'Testimonials Information', 'vincent' ),
		'id'     => 'opt-meta-box-pages',
		'pages'  => array( 'testimonials' ),
		'fields' => array(
			array(
				'name' => esc_html__( 'Heading', 'vincent' ),
				'id'   => 'heading',
				'type'       => 'text',
			),
			array(
				'name' => esc_html__( 'Name', 'vincent' ),
				'id'   => 'name',
				'type'       => 'text',
			),
			array(
				'name' => esc_html__( 'Position', 'vincent' ),
				'id'   => 'position',
				'type'       => 'text',
			),
			array(
				'name' => esc_html__( 'Text', 'vincent' ),
				'id'   => 'text',
				'type' => 'textarea',
			),
		)
	);

	// Page Settings
	$meta_boxes[] = array(
		'title'  => esc_html__( 'Page Settings', 'vincent' ),
		'id'     => 'opt-meta-box-pages',
		'pages'  => array( 'page', 'project' ),
		'fields' => array(
			array(
				'name'    => esc_html__( 'Header Option', 'vincent' ),
				'id'      => 'header_style',
				'type'    => 'select',
				'options' => array(
					'style-1' => esc_html__( 'Header White', 'vincent' ),
					'style-2' => esc_html__( 'Header Transparent', 'vincent' ),
				),
				'std'     => 'style-1',
			),
			array(
				'name' => esc_html__( 'Show Header Line?', 'vincent' ),
				'id'   => 'header_four_line',
				'type' => 'checkbox',
			),
			array(
				'name'    => esc_html__( 'Layout Position', 'vincent' ),
				'id'      => 'page_layout',
				'type'    => 'image_select',
				'options' => array(
					'no-sidebar'  => get_template_directory_uri() . '/assets/admin/img/full-content.png',
					'sidebar-left'  => get_template_directory_uri() . '/assets/admin/img/sidebar-left.png',
					'sidebar-right' => get_template_directory_uri() . '/assets/admin/img/sidebar-right.png',
				),
				'std' 		=> 'no-sidebar',
			),
			array(
				'name'    => esc_html__( 'Sidebar', 'vincent' ),
				'id'      => 'page_sidebar',
				'type'    => 'select',
				'options' => vincent_get_widget_mods(),
				'std'     => 'sidebar-page',
				'desc'    => esc_html__( 'This option do not apply if Layout Position is full-width.', 'vincent' )
			),
			array(
				'name' => esc_html__( 'Remove: Padding Content?', 'vincent' ),
				'id'   => 'hide_padding_content',
				'type' => 'checkbox',
			),
			array(
				'name' => esc_html__( 'Hide: Footer Subscribe?', 'vincent' ),
				'id'   => 'hide_footer_subs',
				'type' => 'checkbox',
			),
		)
	);

	// Featured Title Settings
	$meta_boxes[] = array(
		'title'  => esc_html__( 'Featured Title Settings', 'vincent' ),
		'id'     => 'opt-meta-box-featured-title',
		'pages'  => array( 'page' ),
		'fields' => array(
			array(
				'name' => esc_html__( 'Hide: Featured Title?', 'vincent' ),
				'id'   => 'hide_featured_title',
				'type' => 'checkbox',
			),
			array(
				'type'		=>	'image_advanced',
				'name'		=>	esc_html__( 'Background', 'vincent' ),
				'id'		=>	'featured_title_bg',
			    'max_file_uploads' => 1,
			),
			array(
				'type'		=>	'text',
				'name'		=>	esc_html__( 'Custom Title', 'vincent' ),
				'id'		=>	'custom_featured_title',
			),
			array(
				'type'		=>	'text',
				'name'		=>	esc_html__( 'Custom Sub-Title', 'vincent' ),
				'id'		=>	'custom_featured_subtitle',
			),
		)
	);

	// Footer Settings
	$meta_boxes[] = array(
		'title'  => esc_html__( 'Footer Settings', 'vincent' ),
		'id'     => 'opt-meta-box-footer',
		'pages'  => array( 'page' ),
		'fields' => array(
			array(
			    'name'          => 'Footer Widget: Background',
			    'id'            => 'footer_bg',
			    'type'          => 'color',
			    'alpha_channel' => true,
			),
			array(
			    'name'          => 'Bottom Bar: Background',
			    'id'            => 'bottom_bg',
			    'type'          => 'color',
			    'alpha_channel' => true,
			),
		)
	);

	return $meta_boxes;
}
add_filter( 'rwmb_meta_boxes', 'vincent_register_meta_boxes' );

// Enqueue script for handling actions with meta boxes
function vincent_admin_filter_meta_box() {
	wp_enqueue_script( 'vincent-metabox-script', get_template_directory_uri() . '/assets/admin/js/meta-boxes.js', array( 'jquery' ), '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'vincent_admin_filter_meta_box' );