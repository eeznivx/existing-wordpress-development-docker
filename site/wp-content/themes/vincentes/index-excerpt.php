<?php
/**
 * The template for homepage posts with "Excerpt" style
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0
 */

vincentes_storage_set('blog_archive', true);

get_header(); 

if (have_posts()) {

	echo get_query_var('blog_archive_start');

	?><div class="posts_container"><?php
	
	$vincentes_stickies = is_home() ? get_option( 'sticky_posts' ) : false;
	$vincentes_sticky_out = vincentes_get_theme_option('sticky_style')=='columns' 
							&& is_array($vincentes_stickies) && count($vincentes_stickies) > 0 && get_query_var( 'paged' ) < 1;
	if ($vincentes_sticky_out) {
		?><div class="sticky_wrap columns_wrap"><?php	
	}
	while ( have_posts() ) { the_post(); 
		if ($vincentes_sticky_out && !is_sticky()) {
			$vincentes_sticky_out = false;
			?></div><?php
		}
		get_template_part( 'content', $vincentes_sticky_out && is_sticky() ? 'sticky' : 'excerpt' );
	}
	if ($vincentes_sticky_out) {
		$vincentes_sticky_out = false;
		?></div><?php
	}
	
	?></div><?php

	vincentes_show_pagination();

	echo get_query_var('blog_archive_end');

} else {

	if ( is_search() )
		get_template_part( 'content', 'none-search' );
	else
		get_template_part( 'content', 'none-archive' );

}

get_footer();
?>