<?php
/**
 * The template to display custom header from the ThemeREX Addons Layouts
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0.06
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

$vincentes_header_id = str_replace('header-custom-', '', vincentes_get_theme_option("header_style"));
$vincentes_header_meta = get_post_meta($vincentes_header_id, 'trx_addons_options', true);

?><header class="top_panel top_panel_custom top_panel_custom_<?php echo esc_attr($vincentes_header_id); 
						?> top_panel_custom_<?php echo esc_attr(sanitize_title(get_the_title($vincentes_header_id)));
						echo !empty($vincentes_header_image) || !empty($vincentes_header_video) 
							? ' with_bg_image' 
							: ' without_bg_image';
						if ($vincentes_header_video!='') 
							echo ' with_bg_video';
						if ($vincentes_header_image!='') 
							echo ' '.esc_attr(vincentes_add_inline_css_class('background-image: url('.esc_url($vincentes_header_image).');'));
						if (!empty($vincentes_header_meta['margin']) != '') 
							echo ' '.esc_attr(vincentes_add_inline_css_class('margin-bottom: '.esc_attr(vincentes_prepare_css_value($vincentes_header_meta['margin'])).';'));
						if (is_single() && has_post_thumbnail()) 
							echo ' with_featured_image';
						if (vincentes_is_on(vincentes_get_theme_option('header_fullheight'))) 
							echo ' header_fullheight trx-stretch-height';
						?> scheme_<?php echo esc_attr(vincentes_is_inherit(vincentes_get_theme_option('header_scheme')) 
														? vincentes_get_theme_option('color_scheme') 
														: vincentes_get_theme_option('header_scheme'));
						?>"><?php

	// Background video
	if (!empty($vincentes_header_video)) {
		get_template_part( 'templates/header-video' );
	}
		
	// Custom header's layout
	do_action('vincentes_action_show_layout', $vincentes_header_id);

	// Header widgets area
	get_template_part( 'templates/header-widgets' );
		
?></header>