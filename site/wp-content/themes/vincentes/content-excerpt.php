<?php
/**
 * The default template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0
 */

$vincentes_post_format = get_post_format();
$vincentes_post_format = empty($vincentes_post_format) ? 'standard' : str_replace('post-format-', '', $vincentes_post_format);
$vincentes_animation = vincentes_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_excerpt post_format_'.esc_attr($vincentes_post_format) ); ?>
	<?php echo (!vincentes_is_off($vincentes_animation) ? ' data-animation="'.esc_attr(vincentes_get_animation_classes($vincentes_animation)).'"' : ''); ?>
	><?php

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}


    // Title and post meta
    if (get_the_title() != '') {
        ?>
        <div class="post_header entry-header">
            <?php
            do_action('vincentes_action_before_post_title');

            // Post title
            the_title( sprintf( '<h4 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h4>' );

            do_action('vincentes_action_before_post_meta');

            // Post meta
            $vincentes_components = vincentes_is_inherit(vincentes_get_theme_option_from_meta('meta_parts'))
                ? 'date,author,counters'
                : vincentes_array_get_keys_by_value(vincentes_get_theme_option('meta_parts'));
            $vincentes_counters = vincentes_is_inherit(vincentes_get_theme_option_from_meta('counters'))
                ? 'comments'
                : vincentes_array_get_keys_by_value(vincentes_get_theme_option('counters'));

            if (!empty($vincentes_components))
                vincentes_show_post_meta(apply_filters('vincentes_filter_post_meta_args', array(
                        'components' => $vincentes_components,
                        'counters' => $vincentes_counters,
                        'seo' => false
                    ), 'excerpt', 1)
                );
            ?>
        </div><!-- .post_header --><?php
    }

    // Featured image
	vincentes_show_post_featured(array( 'thumb_size' => vincentes_get_thumb_size( strpos(vincentes_get_theme_option('body_style'), 'full')!==false ? 'full' : 'big' ) ));


	// Post content
	?><div class="post_content entry-content"><?php
		if (vincentes_get_theme_option('blog_content') == 'fullpost') {
			// Post content area
			?><div class="post_content_inner"><?php
				the_content( '' );
			?></div><?php
			// Inner pages
			wp_link_pages( array(
				'before'      => '<div class="page_links"><span class="page_links_title">' . esc_html__( 'Pages:', 'vincentes' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'vincentes' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

		} else {

			$vincentes_show_learn_more = !in_array($vincentes_post_format, array('link', 'aside', 'status', 'quote'));

			// Post content area
			?><div class="post_content_inner"><?php
				if (has_excerpt()) {
					the_excerpt();
				} else if (strpos(get_the_content('!--more'), '!--more')!==false) {
					the_content( '' );
				} else if (in_array($vincentes_post_format, array('link', 'aside', 'status'))) {
					the_content();
				} else if ($vincentes_post_format == 'quote') {
					if (($quote = vincentes_get_tag(get_the_content(), '<blockquote>', '</blockquote>'))!='')
						vincentes_show_layout(wpautop($quote));
					else
						the_excerpt();
				} else if (substr(get_the_content(), 0, 1)!='[') {
					the_excerpt();
				}
			?></div><?php
			// More button
			if ( $vincentes_show_learn_more ) {
				?><p><a class="sc_button_simple" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'vincentes'); ?></a></p><?php
			}

		}
	?></div><!-- .entry-content -->
</article>