<?php
/**
 * Accent color
 *
 * @package vincent
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Start Class
if ( ! class_exists( 'Vincent_Accent_Color' ) ) {
	class Vincent_Accent_Color {
		// Main constructor
		public function __construct() {
			add_filter( 'vincent_custom_colors_css', array( 'Vincent_Accent_Color', 'generate' ), 1 );
		}

		// Generates arrays of elements to target
		private static function arrays( $return ) {
			// Color
			$texts = apply_filters( 'vincent_accent_texts', array(
				'.text-accent-color', '#site-logo .site-logo-text:hover',
				'.bypostauthor > article .comment-author',
				'#main-nav-mobi ul > li > a:hover',
				'.header-style-1 #site-header .nav-top-cart-wrapper .nav-cart-trigger:hover',
				'.header-style-1 #site-header .header-search-icon:hover',
				'.header-style-1 .search-style-fullscreen .search-submit:hover:after',
				'#featured-title #breadcrumbs a:hover',
				'.hentry .post-title a:hover',
				'.hentry .post-meta a:hover',
				'.hentry .post-tags a:hover',
				'.hentry .post-related .post-item h4 a:hover',
				'.hentry .post-related .post-item .post-cat a:hover',
				'.comment-reply a:hover',
				'.comment-author a:hover',
				'.logged-in-as a',
				'#sidebar .widget.widget_calendar caption',
				'#footer-widgets .widget.widget_calendar caption',
				'.widget.widget_categories ul li a:hover',
				'.widget.widget_meta ul li a:hover',
				'.widget.widget_pages ul li a:hover',
				'.widget.widget_archive ul li a:hover',
				'.widget.widget_recent_entries ul li a:hover',
				'.widget.widget_recent_comments ul li a:hover',
				'#footer-widgets .widget.widget_categories ul li a:hover',
				'#footer-widgets .widget.widget_meta ul li a:hover',
				'#footer-widgets .widget.widget_pages ul li a:hover',
				'#footer-widgets .widget.widget_archive ul li a:hover',
				'#footer-widgets .widget.widget_recent_entries ul li a:hover',
				'#footer-widgets .widget.widget_recent_comments ul li a:hover',
				'.widget.widget_nav_menu ul li a:hover',
				'.widget.widget_nav_menu .menu > li.current-menu-item > a',
				'.widget.widget_nav_menu .menu > li.current-menu-item',
				'#sidebar .widget.widget_calendar tbody #today',
				'#sidebar .widget.widget_calendar tbody #today a',
				'#footer-widgets .widget.widget_calendar tbody #today',
				'#footer-widgets .widget.widget_calendar tbody #today a',
				'#sidebar .widget.widget_links ul li a:hover',
				'#footer-widgets .widget.widget_links ul li a:hover',
				'#sidebar .widget.widget_twitter .tweet-text a',
				'#sidebar .widget.widget_search .search-form .search-submit:hover:before',
				'#footer-widgets .widget.widget_search .search-form .search-submit:hover:before',
				'#sidebar .widget.widget_socials .socials a:hover',
				'#footer-widgets .widget.widget_socials .socials a:hover',
				'#sidebar .widget.widget_recent_posts h3 a:hover',
				'#footer-widgets .widget.widget_recent_posts h3 a:hover',
				'.footer-subscribe .icon',
				'#bottom ul.bottom-nav > li.current-menu-item > a',
				'#scroll-top:hover',
				'.no-results-content .search-form .search-submit:hover:before',

				// shortcodes
				'.vincent-accordions .accordion-item .accordion-heading:hover',
				'.vincent-accordions.style-1 .accordion-item .accordion-heading > .inner:before',
				'.vincent-accordions.style-2 .accordion-item.active .accordion-heading',
				'.vincent-links.accent',
				'.vincent-button.outline.outline-accent',
				'.vincent-button.outline.outline-accent .icon',
				'.vincent-counter .icon-wrap .icon.accent',
				'.vincent-counter .prefix.accent',
				'.vincent-counter .suffix.accent',
				'.vincent-counter .number.accent',
				'.vincent-divider.has-icon .icon-wrap > span.accent',
				'.vincent-image-box .item .title a:hover',
				'.vincent-images-grid .zoom-popup:hover',
				'.vincent-news .news-item .text-wrap .title a:hover',
				'.vincent-news .news-item .text-wrap .post-cat a:hover',
				'.vincent-news .exlink a:hover',
				'#project-filter .cbp-filter-item:hover',
				'#project-filter .cbp-filter-item.cbp-filter-item-active',
				'.project-box .project-image:hover .project-text h2 a:hover',
				'.project-box .project-text .link:hover a',
				'.vincent-team .socials li a:hover',
				'.vincent-team-grid .socials li a:hover',
				'.vincent-video-icon a:after',
				'.vincent-list .icon.accent',

				 // Woocommerce
				'.woocommerce-page .woocommerce-MyAccount-content .woocommerce-info .button',
				'.woocommerce-page .woocommerce-message .button',
				'.woocommerce-page .woocommerce-info .button',
				'.woocommerce-page .woocommerce-error .button',
				'.widget_product_categories ul li a:hover',
				'.product_list_widget .product-title:hover',
				'.widget_recent_reviews .product_list_widget a:hover',
				'.product_list_widget .mini_cart_item a:hover',
				'.widget_product_categories ul li a:hover',

				 // Default Link
				 'a',
			) );

			// Background color
			$backgrounds = apply_filters( 'vincent_accent_backgrounds', array(
				'bg-accent',
				'blockquote:before',
				'button:hover',
				'input[type="button"]:hover',
				'input[type="reset"]:hover',
				'input[type="submit"]:hover',
				'button:focus',
				'input[type="button"]:focus',
				'input[type="reset"]:focus',
				'input[type="submit"]:focus',
				'.sticky-post',
				'.search-style-fullscreen.search-opened .search-submit:hover',
				'.header-style-1.cur-menu-1 #main-nav > ul > li.current-menu-item > a span:before',
				'.header-style-1.cur-menu-1 #main-nav > ul > li.current-menu-parent > a span:before',
				'.header-style-1.cur-menu-1 #main-nav > ul > li > a span:before',
				'.header-style-2 .nav-top-cart-wrapper .shopping-cart-items-count',
				'.post-media .slick-prev:hover',
				'.post-media .slick-next:hover',
				'.post-media .slick-dots li.slick-active button',
				'.hentry .post-related .slick-next:hover',
				'.hentry .post-related .slick-prev:hover',
				'#sidebar .widget.widget_recent_posts .recent-news .thumb.icon',
				'#footer-widgets .widget.widget_recent_posts .recent-news .thumb.icon',
				'#sidebar .widget.widget_tag_cloud .tagcloud a:hover',
				'#footer-widgets .widget.widget_tag_cloud .tagcloud a:hover',
				'.widget_product_tag_cloud .tagcloud a:hover',
				'.footer-subscribe .submit-wrap input',
				'.vincent-pagination ul li a.page-numbers:hover',
				'.woocommerce-pagination .page-numbers li .page-numbers:hover',
				'.vincent-pagination ul li .page-numbers.current',
				'.woocommerce-pagination .page-numbers li .page-numbers.current',

				// shortcodes
				'.vincent-button.accent',
				'.vincent-button.outline.outline-accent:hover',
				'.vincent-counter .sep.accent',
				'.vincent-headings .sep.accent',
				'.vincent-images-grid .cbp-nav-pagination-item',
				'.vincent-socials a:hover',
				'.vincent-socials.style-2 a:hover',
				'.owl-theme .owl-nav [class*="owl-"]:hover',
				'.owl-theme .owl-dots .owl-dot span',
				'.owl-theme .owl-dots .owl-dot.active span',
				
				// woocemmerce
				'.woocommerce-page .wc-proceed-to-checkout .button',
				'.woocommerce-page #payment #place_order',
				'.widget_price_filter .price_slider_amount .button:hover',
				'.woocommerce-page .woocommerce-MyAccount-content .woocommerce-info .button',
			) );

			// Border color
			$borders = apply_filters( 'vincent_accent_borders', array(
				'.animsition-loading:after',
				'#sidebar .widget.widget_tag_cloud .tagcloud a:hover',
				'#footer-widgets .widget.widget_tag_cloud .tagcloud a:hover',
				'.widget_product_tag_cloud .tagcloud a:hover',

				// shortcodes
				'.vincent-accordions.style-2 .accordion-item.active .accordion-heading',
				'.vincent-button.outline.outline-accent',
				'.vincent-button.outline.outline-accent:hover',
				'.divider-icon-before.accent',
				'.divider-icon-after.accent',
				'.vincent-divider.has-icon .divider-double.accent',
				'.vincent-news .exlink a:before',

				// woocommerce
				'.widget_price_filter .price_slider_amount .button:hover'
			) );

			// Gradient color
			$gradients = apply_filters( 'vincent_accent_gradient', array(
				'.vincent-progress .progress-animate.accent'
			) );

			// Return array
			if ( 'texts' == $return ) {
				return $texts;
			} elseif ( 'backgrounds' == $return ) {
				return $backgrounds;
			} elseif ( 'borders' == $return ) {
				return $borders;
			} elseif ( 'gradients' == $return ) {
				return $gradients;
			}
		}

		// Generates the CSS output
		public static function generate( $output ) {

			// Get custom accent
			$default_accent = '#0b77ee';
			$custom_accent  = vincent_get_mod( 'accent_color' );

			// Return if accent color is empty or equal to default
			if ( ! $custom_accent || ( $default_accent == $custom_accent ) )
				return $output;

			// Define css var
			$css = '';

			// Get arrays
			$texts       = self::arrays( 'texts' );
			$backgrounds = self::arrays( 'backgrounds' );
			$borders     = self::arrays( 'borders' );
			$gradients    = self::arrays( 'gradients' );

			// Texts
			if ( ! empty( $texts ) )
				$css .= implode( ',', $texts ) .'{color:'. $custom_accent .';}';

			// Backgrounds
			if ( ! empty( $backgrounds ) )
				$css .= implode( ',', $backgrounds ) .'{background-color:'. $custom_accent .';}';

			// Borders
			if ( ! empty( $borders ) ) {
				foreach ( $borders as $key => $val ) {
					if ( is_array( $val ) ) {
						$css .= $key .'{';
						foreach ( $val as $key => $val ) {
							$css .= 'border-'. $val .'-color:'. $custom_accent .';';
						}
						$css .= '}'; 
					} else {
						$css .= $val .'{border-color:'. $custom_accent .';}';
					}
				}
			}

			// Gradients
			if ( ! empty( $gradients ) )
				$css .= implode( ',', $gradients ) .'{background: '. vincent_hex2rgba($custom_accent, 1) .';background: -moz-linear-gradient(left, '. vincent_hex2rgba($custom_accent, 1) .' 0%, '. vincent_hex2rgba($custom_accent, 0.5) .' 100%);background: -webkit-linear-gradient( left, '. vincent_hex2rgba($custom_accent, 1) .' 0%, '. vincent_hex2rgba($custom_accent, 0.5) .' 100% );background: linear-gradient(to right, '. vincent_hex2rgba($custom_accent, 1) .' 0%, '. vincent_hex2rgba($custom_accent, 0.5) .' 100%);}';

			// Return CSS
			if ( ! empty( $css ) )
				$output .= '/*ACCENT COLOR*/'. $css;

			// Return output css
			return $output;
		}
	}
}

new Vincent_Accent_Color();