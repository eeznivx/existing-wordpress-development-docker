<?php
/**
 * The template 'Style 1' to displaying related posts
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0
 */

$vincentes_link = get_permalink();
$vincentes_post_format = get_post_format();
$vincentes_post_format = empty($vincentes_post_format) ? 'standard' : str_replace('post-format-', '', $vincentes_post_format);
?><div id="post-<?php the_ID(); ?>" 
	<?php post_class( 'related_item related_item_style_1 post_format_'.esc_attr($vincentes_post_format) ); ?>><?php
	vincentes_show_post_featured(array(
		'thumb_size' => vincentes_get_thumb_size( (int) vincentes_get_theme_option('related_posts') == 1 ? 'huge' : 'big' ),
		'show_no_image' => false,
		'singular' => false,
		'post_info' => '<div class="post_header entry-header">'
							. '<div class="post_categories">' . vincentes_get_post_categories('') . '</div>'
							. '<h6 class="post_title entry-title"><a href="' . esc_url($vincentes_link) . '">' . get_the_title() . '</a></h6>'
							. (in_array(get_post_type(), array('post', 'attachment'))
									? '<span class="post_date"><a href="' . esc_url($vincentes_link) . '">' . vincentes_get_date() . '</a></span>'
									: '')
						. '</div>'
		)
	);
?></div>