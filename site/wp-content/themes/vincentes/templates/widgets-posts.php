<?php
/**
 * The template to display posts in widgets and/or in the search results
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0
 */

$vincentes_post_id    = get_the_ID();
$vincentes_post_date  = vincentes_get_date();
$vincentes_post_title = get_the_title();
$vincentes_post_link  = get_permalink();
$vincentes_post_author_id   = get_the_author_meta('ID');
$vincentes_post_author_name = get_the_author_meta('display_name');
$vincentes_post_author_url  = get_author_posts_url($vincentes_post_author_id, '');

$vincentes_args = get_query_var('vincentes_args_widgets_posts');
$vincentes_show_date = isset($vincentes_args['show_date']) ? (int) $vincentes_args['show_date'] : 1;
$vincentes_show_image = isset($vincentes_args['show_image']) ? (int) $vincentes_args['show_image'] : 1;
$vincentes_show_author = isset($vincentes_args['show_author']) ? (int) $vincentes_args['show_author'] : 1;
$vincentes_show_counters = isset($vincentes_args['show_counters']) ? (int) $vincentes_args['show_counters'] : 1;
$vincentes_show_categories = isset($vincentes_args['show_categories']) ? (int) $vincentes_args['show_categories'] : 1;

$vincentes_output = vincentes_storage_get('vincentes_output_widgets_posts');

$vincentes_post_counters_output = '';
if ( $vincentes_show_counters ) {
	$vincentes_post_counters_output = '<span class="post_info_item post_info_counters">'
								. vincentes_get_post_counters('comments')
							. '</span>';
}


$vincentes_output .= '<article class="post_item with_thumb">';

if ($vincentes_show_image) {
	$vincentes_post_thumb = get_the_post_thumbnail($vincentes_post_id, vincentes_get_thumb_size('tiny'), array(
		'alt' => get_the_title()
	));
	if ($vincentes_post_thumb) $vincentes_output .= '<div class="post_thumb">' . ($vincentes_post_link ? '<a href="' . esc_url($vincentes_post_link) . '">' : '') . ($vincentes_post_thumb) . ($vincentes_post_link ? '</a>' : '') . '</div>';
}

$vincentes_output .= '<div class="post_content">'
			. ($vincentes_show_categories 
					? '<div class="post_categories">'
						. vincentes_get_post_categories()
						. $vincentes_post_counters_output
						. '</div>' 
					: '')
			. '<h6 class="post_title">' . ($vincentes_post_link ? '<a href="' . esc_url($vincentes_post_link) . '">' : '') . ($vincentes_post_title) . ($vincentes_post_link ? '</a>' : '') . '</h6>'
			. apply_filters('vincentes_filter_get_post_info', 
								'<div class="post_info">'
									. ($vincentes_show_date 
										? '<span class="post_info_item post_info_posted">'
											. ($vincentes_post_link ? '<a href="' . esc_url($vincentes_post_link) . '" class="post_info_date">' : '') 
											. esc_html($vincentes_post_date) 
											. ($vincentes_post_link ? '</a>' : '')
											. '</span>'
										: '')
									. ($vincentes_show_author 
										? '<span class="post_info_item post_info_posted_by">' 
											. esc_html__('by', 'vincentes') . ' ' 
											. ($vincentes_post_link ? '<a href="' . esc_url($vincentes_post_author_url) . '" class="post_info_author">' : '') 
											. esc_html($vincentes_post_author_name) 
											. ($vincentes_post_link ? '</a>' : '') 
											. '</span>'
										: '')
									. (!$vincentes_show_categories && $vincentes_post_counters_output
										? $vincentes_post_counters_output
										: '')
								. '</div>')
		. '</div>'
	. '</article>';
vincentes_storage_set('vincentes_output_widgets_posts', $vincentes_output);
?>