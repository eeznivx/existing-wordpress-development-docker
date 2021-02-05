<?php
/**
 * Entry Content / Tags
 *
 * @package vincent
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( is_single() && ! vincent_get_mod( 'blog_single_tags', true ) )
	return;

$text = vincent_get_mod( 'blog_single_tags_text', 'Tags:' );
the_tags( '<div class="post-tags clearfix">'. esc_html( $text ),'','</div>' );


