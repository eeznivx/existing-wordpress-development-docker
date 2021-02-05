<?php
/**
 * The Classic template to display the content
 *
 * Used for index/archive/search.
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0
 */

$vincentes_blog_style = explode('_', vincentes_get_theme_option('blog_style'));
$vincentes_columns = empty($vincentes_blog_style[1]) ? 1 : max(1, $vincentes_blog_style[1]);
$vincentes_expanded = !vincentes_sidebar_present() && vincentes_is_on(vincentes_get_theme_option('expand_content'));
$vincentes_post_format = get_post_format();
$vincentes_post_format = empty($vincentes_post_format) ? 'standard' : str_replace('post-format-', '', $vincentes_post_format);
$vincentes_animation = vincentes_get_theme_option('blog_animation');

?><article id="post-<?php the_ID(); ?>" 
	<?php post_class( 'post_item post_layout_chess post_layout_chess_'.esc_attr($vincentes_columns).' post_format_'.esc_attr($vincentes_post_format) ); ?>
	<?php echo (!vincentes_is_off($vincentes_animation) ? ' data-animation="'.esc_attr(vincentes_get_animation_classes($vincentes_animation)).'"' : ''); ?>>

	<?php
	// Add anchor
	if ($vincentes_columns == 1 && shortcode_exists('trx_sc_anchor')) {
		echo do_shortcode('[trx_sc_anchor id="post_'.esc_attr(get_the_ID()).'" title="'.esc_attr(get_the_title()).'"]');
	}

	// Sticky label
	if ( is_sticky() && !is_paged() ) {
		?><span class="post_label label_sticky"></span><?php
	}

	// Featured image
	vincentes_show_post_featured( array(
											'class' => $vincentes_columns == 1 ? 'trx-stretch-height' : '',
											'show_no_image' => true,
											'thumb_bg' => true,
											'thumb_size' => vincentes_get_thumb_size(
																	strpos(vincentes_get_theme_option('body_style'), 'full')!==false
																		? ( $vincentes_columns > 1 ? 'huge' : 'original' )
																		: (	$vincentes_columns > 2 ? 'big' : 'huge')
																	)
											) 
										);

	?><div class="post_inner"><div class="post_inner_content"><?php 

		?><div class="post_header entry-header"><?php 
			do_action('vincentes_action_before_post_title'); 

			// Post title
			the_title( sprintf( '<h3 class="post_title entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' );
			
			do_action('vincentes_action_before_post_meta'); 

			// Post meta
			$vincentes_components = vincentes_is_inherit(vincentes_get_theme_option_from_meta('meta_parts')) 
										? 'categories,date'.($vincentes_columns < 3 ? ',counters' : '').($vincentes_columns == 1 ? ',edit' : '')
										: vincentes_array_get_keys_by_value(vincentes_get_theme_option('meta_parts'));
			$vincentes_counters = vincentes_is_inherit(vincentes_get_theme_option_from_meta('counters')) 
										? 'comments'
										: vincentes_array_get_keys_by_value(vincentes_get_theme_option('counters'));
			$vincentes_post_meta = empty($vincentes_components) 
										? '' 
										: vincentes_show_post_meta(apply_filters('vincentes_filter_post_meta_args', array(
                                                'components' => 'date, author',
												'counters' => $vincentes_counters,
												'seo' => false,
												'echo' => false
												), $vincentes_blog_style[0], $vincentes_columns)
											);
			vincentes_show_layout($vincentes_post_meta);
		?></div><!-- .entry-header -->
	
		<div class="post_content entry-content">
			<div class="post_content_inner">
				<?php
				$vincentes_show_learn_more = !in_array($vincentes_post_format, array('link', 'aside', 'status', 'quote'));
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
				?>
			</div>
			<?php
			// Post meta
			if (in_array($vincentes_post_format, array('link', 'aside', 'status', 'quote'))) {
				vincentes_show_layout($vincentes_post_meta);
			}
			// More button
			if ( $vincentes_show_learn_more ) {
				?><p><a class="more-link" href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html_e('Read more', 'vincentes'); ?></a></p><?php
			}
			?>
		</div><!-- .entry-content -->

	</div></div><!-- .post_inner -->

</article>