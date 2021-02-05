<?php
/**
 * Footer Subscribe
 *
 * @package vincent
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( ! vincent_get_mod( 'subscribe', false ) || ( is_page() && vincent_metabox('hide_footer_subs') ) )
	return false;

$title = vincent_get_mod( 'subscribe_title', 'Subscribe to our newsletter and stay updated on the latest news and special offers' );
$subtitle = vincent_get_mod( 'subscribe_subtitle', 'We promise not to spam your inbox!' );

if ( class_exists('MC4WP_MailChimp') ) {
	echo '<div class="footer-subscribe clearfix"><div class="inner">';
		echo '<div class="icon"><i class="coreicon-heart"></i></div>';
		if ( $title ) echo '<h5 class="heading">'. esc_html( $title ) .'</h5>';
		echo '<div class="form-wrap">';
			mc4wp_show_form(0);
		echo '</div>';
		if ( $subtitle) echo '<div class="subheading">'. esc_html( $subtitle ) .'</div>';
	echo '</div></div>';
}