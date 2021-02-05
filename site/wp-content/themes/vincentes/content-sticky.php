<?php
/**
 * The Sticky template to display the sticky posts
 *
 * Used for index/archive
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0
 */

$vincentes_columns = max(1, min(3, count(get_option( 'sticky_posts' ))));
$vincentes_post_format = get_post_format();
$vincentes_post_format = empty($vincentes_post_format) ? 'standard' : str_replace('post-format-', '', $vincentes_post_format);
$vincentes_animation = vincentes_get_theme_option('blog_animation');

?><div class="column-1_<?php echo esc_attr($vincentes_columns); ?>"><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_sticky post_format_'.esc_attr($vincentes_post_format) ); ?>
	<?php echo (!vincentes_is_off($vincentes_animation) ? ' data-animation="'.esc_attr(vincentes_get_animation_classes($vincentes_animation)).'"' : ''); ?>
	>

	<?php
	if ( is_sticky() && is_home() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	vincentes_show_post_featured(array(
		'thumb_size' => vincentes_get_thumb_size($vincentes_columns==1 ? 'big' : ($vincentes_columns==2 ? 'med' : 'avatar'))
	));

	if ( !in_array($vincentes_post_format, array('link', 'aside', 'status', 'quote')) ) {
		?>
		<div class="post_header entry-header">
			<?php
			// Post title
			the_title( sprintf( '<h6 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h6>' );
			// Post meta
			vincentes_show_post_meta(apply_filters('vincentes_filter_post_meta_args', array(), 'sticky', $vincentes_columns));
			?>
		</div><!-- .entry-header -->
		<?php
	}
	?>
</article></div>