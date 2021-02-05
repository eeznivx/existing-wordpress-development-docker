<?php
/**
 * The template for homepage posts with "Portfolio" style
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0
 */

vincentes_storage_set('blog_archive', true);

// Load scripts for both 'Gallery' and 'Portfolio' layouts!
wp_enqueue_script( 'imagesloaded' );
wp_enqueue_script( 'masonry' );
wp_enqueue_script( 'classie', vincentes_get_file_url('js/theme.gallery/classie.min.js'), array(), null, true );
wp_enqueue_script( 'vincentes-gallery-script', vincentes_get_file_url('js/theme.gallery/theme.gallery.js'), array(), null, true );

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	$vincentes_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$vincentes_sticky_out = vincentes_get_theme_option('sticky_style')=='columns' 
							&& is_array($vincentes_stickies) && count($vincentes_stickies) > 0 && get_query_var( 'paged' ) < 1;
	
	// Show filters
	$vincentes_cat = vincentes_get_theme_option('parent_cat');
	$vincentes_post_type = vincentes_get_theme_option('post_type');
	$vincentes_taxonomy = vincentes_get_post_type_taxonomy($vincentes_post_type);
	$vincentes_show_filters = vincentes_get_theme_option('show_filters');
	$vincentes_tabs = array();
	if (!vincentes_is_off($vincentes_show_filters)) {
		$vincentes_args = array(
			'type'			=> $vincentes_post_type,
			'child_of'		=> $vincentes_cat,
			'orderby'		=> 'name',
			'order'			=> 'ASC',
			'hide_empty'	=> 1,
			'hierarchical'	=> 0,
			'exclude'		=> '',
			'include'		=> '',
			'number'		=> '',
			'taxonomy'		=> $vincentes_taxonomy,
			'pad_counts'	=> false
		);
		$vincentes_portfolio_list = get_terms($vincentes_args);
		if (is_array($vincentes_portfolio_list) && count($vincentes_portfolio_list) > 0) {
			$vincentes_tabs[$vincentes_cat] = esc_html__('All', 'vincentes');
			foreach ($vincentes_portfolio_list as $vincentes_term) {
				if (isset($vincentes_term->term_id)) $vincentes_tabs[$vincentes_term->term_id] = $vincentes_term->name;
			}
		}
	}
	if (count($vincentes_tabs) > 0) {
		$vincentes_portfolio_filters_ajax = true;
		$vincentes_portfolio_filters_active = $vincentes_cat;
		$vincentes_portfolio_filters_id = 'portfolio_filters';
		if (!is_customize_preview())
			wp_enqueue_script('jquery-ui-tabs', false, array('jquery', 'jquery-ui-core'), null, true);
		?>
		<div class="portfolio_filters vincentes_tabs vincentes_tabs_ajax">
			<ul class="portfolio_titles vincentes_tabs_titles">
				<?php
				foreach ($vincentes_tabs as $vincentes_id=>$vincentes_title) {
					?><li><a href="<?php echo esc_url(vincentes_get_hash_link(sprintf('#%s_%s_content', $vincentes_portfolio_filters_id, $vincentes_id))); ?>" data-tab="<?php echo esc_attr($vincentes_id); ?>"><?php echo esc_html($vincentes_title); ?></a></li><?php
				}
				?>
			</ul>
			<?php
			$vincentes_ppp = vincentes_get_theme_option('posts_per_page');
			if (vincentes_is_inherit($vincentes_ppp)) $vincentes_ppp = '';
			foreach ($vincentes_tabs as $vincentes_id=>$vincentes_title) {
				$vincentes_portfolio_need_content = $vincentes_id==$vincentes_portfolio_filters_active || !$vincentes_portfolio_filters_ajax;
				?>
				<div id="<?php echo esc_attr(sprintf('%s_%s_content', $vincentes_portfolio_filters_id, $vincentes_id)); ?>"
					class="portfolio_content vincentes_tabs_content"
					data-blog-template="<?php echo esc_attr(vincentes_storage_get('blog_template')); ?>"
					data-blog-style="<?php echo esc_attr(vincentes_get_theme_option('blog_style')); ?>"
					data-posts-per-page="<?php echo esc_attr($vincentes_ppp); ?>"
					data-post-type="<?php echo esc_attr($vincentes_post_type); ?>"
					data-taxonomy="<?php echo esc_attr($vincentes_taxonomy); ?>"
					data-cat="<?php echo esc_attr($vincentes_id); ?>"
					data-parent-cat="<?php echo esc_attr($vincentes_cat); ?>"
					data-need-content="<?php echo (false===$vincentes_portfolio_need_content ? 'true' : 'false'); ?>"
				>
					<?php
					if ($vincentes_portfolio_need_content) 
						vincentes_show_portfolio_posts(array(
							'cat' => $vincentes_id,
							'parent_cat' => $vincentes_cat,
							'taxonomy' => $vincentes_taxonomy,
							'post_type' => $vincentes_post_type,
							'page' => 1,
							'sticky' => $vincentes_sticky_out
							)
						);
					?>
				</div>
				<?php
			}
			?>
		</div>
		<?php
	} else {
		vincentes_show_portfolio_posts(array(
			'cat' => $vincentes_cat,
			'parent_cat' => $vincentes_cat,
			'taxonomy' => $vincentes_taxonomy,
			'post_type' => $vincentes_post_type,
			'page' => 1,
			'sticky' => $vincentes_sticky_out
			)
		);
	}

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>