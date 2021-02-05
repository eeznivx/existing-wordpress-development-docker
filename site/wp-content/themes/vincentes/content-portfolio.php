<?php
/**
 * The Portfolio template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0
 */

$vincentes_blog_style = explode('_', vincentes_get_theme_option('blog_style'));
$vincentes_columns = empty($vincentes_blog_style[1]) ? 2 : max(2, $vincentes_blog_style[1]);
$vincentes_post_format = get_post_format();
$vincentes_post_format = empty($vincentes_post_format) ? 'standard' : str_replace('post-format-', '', $vincentes_post_format);
$vincentes_animation = vincentes_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_portfolio post_layout_portfolio_'.esc_attr($vincentes_columns).' post_format_'.esc_attr($vincentes_post_format).(is_sticky() && !is_paged() ? ' sticky' : '') ); ?>
	<?php echo (!vincentes_is_off($vincentes_animation) ? ' data-animation="'.esc_attr(vincentes_get_animation_classes($vincentes_animation)).'"' : ''); ?>>
	<?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	$vincentes_image_hover = vincentes_get_theme_option('image_hover');
	// Featured image
	vincentes_show_post_featured(array(
		'thumb_size' => vincentes_get_thumb_size(strpos(vincentes_get_theme_option('body_style'), 'full')!==false || $vincentes_columns < 3 ? 'masonry-big' : 'masonry'),
		'show_no_image' => true,
		'class' => $vincentes_image_hover == 'dots' ? 'hover_with_info' : '',
		'post_info' => $vincentes_image_hover == 'dots' ? '<div class="post_info">'.esc_html(get_the_title()).'</div>' : ''
	));
	?>
</article>