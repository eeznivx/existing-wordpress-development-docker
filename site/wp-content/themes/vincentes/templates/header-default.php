<?php
/**
 * The template to display default site header
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0
 */

$vincentes_header_css = $vincentes_header_image = '';
$vincentes_header_video = vincentes_get_header_video();
if (true || empty($vincentes_header_video)) {
	$vincentes_header_image = get_header_image();
	if (vincentes_is_on(vincentes_get_theme_option('header_image_override')) && apply_filters('vincentes_filter_allow_override_header_image', true)) {
		if (is_category()) {
			if (($vincentes_cat_img = vincentes_get_category_image()) != '')
				$vincentes_header_image = $vincentes_cat_img;
		} else if (is_singular() || vincentes_storage_isset('blog_archive')) {
			if (has_post_thumbnail()) {
				$vincentes_header_image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				if (is_array($vincentes_header_image)) $vincentes_header_image = $vincentes_header_image[0];
			} else
				$vincentes_header_image = '';
		}
	}
}

?><header class="top_panel top_panel_default<?php
					echo !empty($vincentes_header_image) || !empty($vincentes_header_video) ? ' with_bg_image' : ' without_bg_image';
					if ($vincentes_header_video!='') echo ' with_bg_video';
					if ($vincentes_header_image!='') echo ' '.esc_attr(vincentes_add_inline_css_class('background-image: url('.esc_url($vincentes_header_image).');'));
					if (is_single() && has_post_thumbnail()) echo ' with_featured_image';
					if (vincentes_is_on(vincentes_get_theme_option('header_fullheight'))) echo ' header_fullheight trx-stretch-height';
					?> scheme_<?php echo esc_attr(vincentes_is_inherit(vincentes_get_theme_option('header_scheme')) 
													? vincentes_get_theme_option('color_scheme') 
													: vincentes_get_theme_option('header_scheme'));
					?>"><?php

	// Background video
	if (!empty($vincentes_header_video)) {
		get_template_part( 'templates/header-video' );
	}
	
	// Main menu
	if (vincentes_get_theme_option("menu_style") == 'top') {
		get_template_part( 'templates/header-navi' );
	}

	// Page title and breadcrumbs area
	get_template_part( 'templates/header-title');

	// Header widgets area
	get_template_part( 'templates/header-widgets' );

	// Header for single posts
	get_template_part( 'templates/header-single' );

?></header>