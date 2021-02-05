<?php
/**
 * Framework functions
 *
 * @package vincent
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return class for reploader
function vincent_preloader_class() {
	// Get preloader option from theme mod
	$class = vincent_get_mod( 'preloader', 'animsition' );
	return esc_attr( $class );
}

// Return classes for elements
function vincent_element_classes( $elm ) {
	// Get element style from theme mod
	$style = vincent_get_mod( $elm, 'style-1' );
	return esc_attr( $style );
}

// Return background CSS
function vincent_bg_css( $style ) {
	$css = '';
	if ( $style = vincent_get_mod( $style ) ) {
		if ( 'fixed' == $style ) {
			$css .= ' background-position: center center; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;';
		} elseif ( 'fixed-top' == $style ) {
			$css .= ' background-position: center top; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;';
		} elseif ( 'fixed-bottom' == $style ) {
			$css .= ' background-position: center bottom; background-repeat: no-repeat; background-attachment: fixed; background-size: cover;';
		} elseif ( 'cover' == $style ) {
			$css .= ' background-repeat: no-repeat; background-position: center center; background-size: cover;';
		} elseif ( 'center-top' == $style ) {
			$css .= ' background-repeat: no-repeat; background-position: center top;';
		} elseif ( 'repeat' == $style ) {
			$css .= ' background-repeat: repeat;';
		} elseif ( 'repeat-x' == $style ) {
			$css .= ' background-repeat: repeat-x;';
		} elseif ( 'repeat-y' == $style ) {
			$css .= ' background-repeat: repeat-y;';
		}
	}

	return esc_attr( $css );
}

// Return background style for elements
function vincent_element_bg_css( $bg ) {
	$css = '';
	$style = $bg .'_style';

	if ( $bg_img = vincent_get_mod( $bg, null ) )
		$css .= 'background-image: url('. esc_url( $bg_img ). ');';

	$css .= vincent_bg_css($style);

	return esc_attr( $css );
}

// Return background for Featured Title
function vincent_featured_title_bg() {
	$css = '';

	if ( is_page() && vincent_metabox('featured_title_bg') ) {
		$images = vincent_metabox( 'featured_title_bg', array( 'size' => 'full', 'limit' => 1 ) );
		$image = reset( $images );
		$css .= 'background-image: url('. esc_url( $image['url'] ). ');';
	} elseif ( is_single() && ( $bg_img = vincent_get_mod( 'blog_single_featured_title_background_img' ) ) ) {
		$css .= 'background-image: url('. esc_url( $bg_img ). ');';
	} elseif ( $bg_img = vincent_get_mod( 'featured_title_background_img', null ) ) {
		$css .= 'background-image: url('. esc_url( $bg_img ). ');';
	}

	$css .= vincent_bg_css('featured_title_background_img_style');

	return esc_attr( $css );
}

// Header search - fullscreen 
function vincent_header_search_full() {
?>
    <div class="search_wrap search-style-fullscreen">
        <div class="search_form_wrap">
            <form role="search" method="get" class="search_form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                <input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'keyword(s)', 'placeholder', 'vincent' ); ?>" value="<?php echo get_search_query(); ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label', 'vincent' ); ?>" />
                <button type="submit" class="search-submit" title="<?php esc_attr_e('Search', 'vincent'); ?>"><?php esc_html_e('SEARCH', 'vincent'); ?></button>
                <a class="search-close"></a>
            </form>
        </div>
    </div>
<?php
}

// Return cart header
function vincent_header_cart() {
	if ( class_exists( 'woocommerce' ) ) : ?>
        <div class="nav-top-cart-wrapper">
            <a class="nav-cart-trigger" href="<?php echo esc_url( wc_get_cart_url() ) ?>">
            	<span class="cart-icon coreicon-cart">
                <?php if ( $items_count = WC()->cart->get_cart_contents_count() ): ?>
                    <span class="shopping-cart-items-count"><?php echo esc_html( $items_count ) ?></span>
                <?php else: ?>
                    <span class="shopping-cart-items-count">0</span>
                <?php endif ?>
                </span>
            </a>

            <div class="nav-shop-cart">
                <div class="widget_shopping_cart_content">
                    <?php woocommerce_mini_cart() ?>
                </div>
            </div>
        </div><!-- /.nav-top-cart-wrapper -->
	<?php endif;
}

// Remove products and pages results from the search form widget
function vincent_custom_search_query( $query ) {
	if ( is_admin() || ! $query->is_main_query() )
		return;

	if ( isset( $_GET['post_type'] ) && ( $_GET['post_type'] == 'product' ) )
		return;

	if ( $query->is_search() ) {
    	$in_search_post_types = get_post_types( array( 'exclude_from_search' => false ) );

	    $post_types_to_remove = array( 'product' );

	    foreach ( $post_types_to_remove as $post_type_to_remove ) {
			if ( is_array( $in_search_post_types ) 
				&& in_array( $post_type_to_remove, $in_search_post_types ) 
			) {
				unset( $in_search_post_types[ $post_type_to_remove ] );
				$query->set( 'post_type', $in_search_post_types );
			}
	    }
	}
}
add_action( 'pre_get_posts', 'vincent_custom_search_query' );

// Featured Title style
function vincent_feature_title_cls() {
	// Define classes
	$classes = 'clearfix';

	// Get featured style from theme mod
	$style = vincent_get_mod( 'featured_title_style', 'simple' );

	// Get custom classes
	$classes .= ( 'simple' == $style ) ? ' simple' : ' centered';

	// Return classes
	return esc_attr( $classes );
}

// Get layout position for pages
function vincent_layout_position() {
	// Default layout position
	$layout = 'sidebar-right';

	// Get layout position for site
	$layout = vincent_get_mod( 'site_layout_position', 'sidebar-right' );

	// Get layout position for single post
	if ( is_singular( 'post' ) )
		$layout = vincent_get_mod('single_post_layout_position', 'sidebar-right');

	// Single post/page can have custom layout position
	if ( is_singular() && vincent_metabox('page_layout') )
		$layout = vincent_metabox('page_layout');

	// Get layout position for shop pages
	if ( class_exists( 'woocommerce' ) ) {
		if ( is_shop() || is_product_category() )
			$layout = vincent_get_mod('shop_layout_position', 'no-sidebar');  
		if ( is_singular( 'product' ) )
			$layout = vincent_get_mod('shop_single_layout_position', 'no-sidebar');
		if ( is_cart() || is_checkout() ) {
			if ( vincent_metabox('page_layout') ) {
				$layout = vincent_metabox('page_layout');
			} else {
				$layout = 'no-sidebar';
			}
		}
	}

	return $layout;
}

// Render favicon icon to head tag
function vincent_site_icon() {
	if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
		if ( $favicon = vincent_get_mod( 'favicon' ) ) {
			echo '<link rel="shortcut icon" href="'. esc_url( $favicon ) .'" type="image/x-icon">';
		}
	}
}
add_action( 'wp_head', 'vincent_site_icon' );

// Sets the content width in pixels, based on the theme's design and stylesheet.
function vincent_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'vincent_content_width', 1170 );
}
add_action( 'after_setup_theme', 'vincent_content_width', 0 );

// Modifies tag cloud widget arguments to have all tags in the widget same font size.
function vincent_widget_tag_cloud_args( $args ) {
	$args['largest'] = 1;
	$args['smallest'] = 1;
	$args['unit'] = 'em';
	return $args;
}
add_filter( 'widget_tag_cloud_args', 'vincent_widget_tag_cloud_args' );

// Custom classes to body tag
function vincent_body_classes() {
	$classes[] = '';

	// Header fixed
	if ( vincent_get_mod( 'header_fixed', false ) )
		$classes[] = 'header-fixed';

	// Get layout position
	$classes[] = vincent_layout_position();

	// Get layout style
	$layout_style = vincent_get_mod( 'site_layout_style', 'full-width' );
	$classes[] = 'site-layout-'. $layout_style;

	// Get header style
	$header_style = vincent_get_mod( 'header_site_style', 'style-1' );
	if ( is_page() && vincent_metabox('header_style') )
		$header_style = vincent_metabox('header_style');
	$classes[] = 'header-'. $header_style;

	// Get menu item current style
	$cur_menu_style = vincent_get_mod( 'menu_link_current', 'cur-menu-1' );
	$classes[] = $cur_menu_style;

	if ( is_page() ) $classes[] = 'is-page';

	if ( is_page_template( 'templates/page-onepage.php' ) )
		$classes[] = 'one-page';

	if ( is_single() ) $classes[] = 'is-single-post';

	if ( ( is_page() && vincent_metabox('hide_padding_content') )
		|| ( is_singular('project') && vincent_metabox('hide_padding_content') ) )
		$classes[] = 'no-padding-content';

	// Add classes for Woo pages
	if ( vincent_is_woocommerce_page() )
		$classes[] = 'woocommerce-page';

	if ( vincent_is_woocommerce_shop() || vincent_is_woocommerce_archive_product() ) {
		$shop_cols = vincent_get_mod( 'shop_columns', '3' );
		$classes[] = 'shop-col-'. $shop_cols;
	}

	// Boxed Layout dropshadow
	if ( 'boxed' == $layout_style && vincent_get_mod( 'site_layout_boxed_shadow' ) )
		$classes[] = 'box-shadow';

	if ( vincent_get_mod( 'header_search_icon' ) )
		$classes[] = 'header-simple-search';

	if ( vincent_metabox('header_four_line') )
		$classes[] = 'header-has-line';	

	if ( is_singular( 'project' ) )
		$classes[] = 'page-single-project';

	if ( ! vincent_get_mod( 'subscribe', false ) || ( is_page() && vincent_metabox('hide_footer_subs') ) ) {
		$classes[] = 'footer-no-subs';
	} else { $classes[] = 'footer-has-subs'; }

	if ( ! is_active_sidebar( 'sidebar-footer-1' ) &&
		! is_active_sidebar( 'sidebar-footer-2' ) &&
		! is_active_sidebar( 'sidebar-footer-3' ) &&
		! is_active_sidebar( 'sidebar-footer-4' ) )
		$classes[] = 'footer-no-widget';

	// Return classes
	return $classes;
}
add_filter( 'body_class', 'vincent_body_classes' );

// Change default read more style
function vincent_excerpt_more( $more ) {
	return '';
}
add_filter( 'excerpt_more', 'vincent_excerpt_more', 10 );

// Custom excerpt length for posts
function vincent_content_length() {
	$length = vincent_get_mod( 'blog_excerpt_length', '50' );
	$length = intval( $length );
	if ( ! empty( $length ) || $length != 0 )
	return $length;
}
add_filter( 'excerpt_length', 'vincent_content_length', 999 );

// Prevent page scroll when clicking the more link
function vincent_remove_more_link_scroll( $link ) {
	$link = preg_replace( '|#more-[0-9]+|', '', $link );
	return $link;
}
add_filter( 'the_content_more_link', 'vincent_remove_more_link_scroll' );

// Remove read-more link so we can custom it
function vincent_remove_read_more_link() {
    return '';
}
add_filter( 'the_content_more_link', 'vincent_remove_read_more_link' );

// Returns blog entry blocks
function vincent_blog_entry_layout_blocks() {

	// Get layout blocks
	$blocks = vincent_get_mod( 'blog_entry_composer' );

	// If blocks are 100% empty return defaults
	$blocks = $blocks ? $blocks : 'title,meta,excerpt_content,readmore';

	// Convert blocks to array so we can loop through them
	if ( ! is_array( $blocks ) ) {
		$blocks = explode( ',', $blocks );
	}

	// Set block keys equal to vals
	$blocks = array_combine( $blocks, $blocks );

	// Return blocks
	return $blocks;
}

// Render meta blog bar
function vincent_entry_meta() {
	// Get meta items from theme mod
	$meta_item = vincent_get_mod( 'blog_entry_meta_items', array( 'categories' ) );

	// If blocks are 100% empty return defaults
	$meta_item = $meta_item ? $meta_item : 'date,author,comments,categories';

	// Turn into array if string
	if ( $meta_item && ! is_array( $meta_item ) ) {
		$meta_item = explode( ',', $meta_item );
	}

	// Set keys equal to values
	$meta_item = array_combine( $meta_item, $meta_item );

	// Loop through items
	foreach ( $meta_item as $item ) :
		if ( 'author' == $item ) { 
			printf( '<span class="post-by-author item"><span class="inner">By <a href="%s" title="%s">%s</a></span></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( esc_html__( 'View all posts by %s', 'vincent' ), get_the_author() ) ),
				get_the_author()
				);
		}
		elseif ( 'date' == $item ) {
			printf( '<span class="post-date item"><span class="inner"><span class="entry-date">%1$s</span></span></span>',
				get_the_date()
			);
		}
		elseif ( 'comments' == $item ) {
			if ( comments_open() || get_comments_number() ) {
				echo '<span class="post-comment item"><span class="inner">';
				comments_popup_link( esc_html__( '0 comment', 'vincent' ), esc_html__( '1 Comment', 'vincent' ), esc_html__( '% Comments', 'vincent' ) );
				echo '</span></span>';
			}
		}
		elseif ( 'categories' == $item ) {
			echo '<span class="post-meta-categories item"><span class="inner">';
			the_category( ', ', get_the_ID() );
			echo '</span></span>';
		}
	endforeach;
}

// Returns correct Google Fonts URL if you want to change it to another CDN
function vincent_get_google_fonts_url() {
	return esc_url( apply_filters( 'vincent_get_google_fonts_url', '//fonts.googleapis.com' ) );
}

// Minify CSS
function vincent_minify_css( $css = '' ) {
	// Return if no CSS
	if ( ! $css ) return;

	// Normalize whitespace
	$css = preg_replace( '/\s+/', ' ', $css );

	// Remove ; before }
	$css = preg_replace( '/;(?=\s*})/', '', $css );

	// Remove space after , : ; { } */ >
	$css = preg_replace( '/(,|:|;|\{|}|\*\/|>) /', '$1', $css );

	// Remove space before , ; { }
	$css = preg_replace( '/ (,|;|\{|})/', '$1', $css );

	// Strips leading 0 on decimal values (converts 0.5px into .5px)
	$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );

	// Strips units if value is 0 (converts 0px to 0)
	$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

	// Trim
	$css = trim( $css );

	// Return minified CSS
	return $css;
}

// Get post meta, using rwmb_meta() function from Meta Box class
function vincent_metabox( $key, $args = array(), $post_id = null ) {
    if ( ! function_exists( 'rwmb_meta' ) )
      	return false;
    return rwmb_meta( $key, $args, $post_id );
}

// Render numeric pagination
function vincent_pagination( $query = '', $echo = true ) {
	
	// Arrows with RTL support
	$prev_arrow = 'fa fa-angle-left';
	$next_arrow = 'fa fa-angle-right';
	
	// Get global $query
	if ( ! $query ) {
		global $wp_query;
		$query = $wp_query;
	}

	// Set vars
	$total  = $query->max_num_pages;
	$big    = 999999999;

	// Display pagination
	if ( $total > 1 ) {

		// Get current page
		if ( $current_page = get_query_var( 'paged' ) ) {
			$current_page = $current_page;
		} elseif ( $current_page = get_query_var( 'page' ) ) {
			$current_page = $current_page;
		} else {
			$current_page = 1;
		}

		// Get permalink structure
		if ( get_option( 'permalink_structure' ) ) {
			if ( is_page() ) {
				$format = 'page/%#%/';
			} else {
				$format = '/%#%/';
			}
		} else {
			$format = '&paged=%#%';
		}

		$args = array(
			'base'      => str_replace( $big, '%#%', html_entity_decode( get_pagenum_link( $big ) ) ),
			'format'    => $format,
			'current'   => max( 1, $current_page ),
			'total'     => $total,
			'mid_size'  => 3,
			'type'      => 'list',
			'prev_text' => '<span class="'. $prev_arrow .'"></span>',
			'next_text' => '<span class="'. $next_arrow .'"></span>',
		);

		// Output pagination
		if ( $echo ) {
			echo '<div class="vincent-pagination clearfix">'. paginate_links( $args ) .'</div>';
		} else {
			return '<div class="vincent-pagination clearfix">'. paginate_links( $args ) .'</div>';
		}

	}
}

// Returns array of Social Options for the Top Bar
function vincent_topbar_social_options() {
	return apply_filters ( 'vincent_topbar_social_options', array(
		'facebook' => array(
			'label' => esc_html__( 'Facebook', 'vincent' ),
			'icon_class' => 'vincent-facebook',
		),
		'twitter' => array(
			'label' => esc_html__( 'Twitter', 'vincent' ),
			'icon_class' => 'vincent-twitter',
		),
		'youtube' => array(
			'label' => esc_html__( 'Youtube', 'vincent' ),
			'icon_class' => 'vincent-youtube',
		),
		'vimeo' => array(
			'label' => esc_html__( 'Vimeo', 'vincent' ),
			'icon_class' => 'vincent-vimeo',
		),
		'tumblr'  => array(
			'label' => esc_html__( 'Tumblr', 'vincent' ),
			'icon_class' => 'vincent-tumblr',
		),
		'pinterest'  => array(
			'label' => esc_html__( 'Pinterest', 'vincent' ),
			'icon_class' => 'vincent-pinterest',
		),
		'linkedin'  => array(
			'label' => esc_html__( 'LinkedIn', 'vincent' ),
			'icon_class' => 'vincent-linkedin',
		),
		'instagram'  => array(
			'label' => esc_html__( 'Instagram', 'vincent' ),
			'icon_class' => 'vincent-instagram',
		),
		'skype' => array(
			'label' => esc_html__( 'Github', 'vincent' ),
			'icon_class' => 'vincent-github',
		),
		'Apple' => array(
			'label' => esc_html__( 'Apple', 'vincent' ),
			'icon_class' => 'vincent-apple',
		),
		'android' => array(
			'label' => esc_html__( 'Android', 'vincent' ),
			'icon_class' => 'vincent-android',
		),
		'behance'  => array(
			'label' => esc_html__( 'Behance', 'vincent' ),
			'icon_class' => 'vincent-behance',
		),
		'dribbble' => array(
			'label' => esc_html__( 'Dribbble', 'vincent' ),
			'icon_class' => 'vincent-dribbble',
		),
		'flickr'  => array(
			'label' => esc_html__( 'Flickr', 'vincent' ),
			'icon_class' => 'vincent-flickr',
		),

		'paypal'  => array(
			'label' => esc_html__( 'Paypal', 'vincent' ),
			'icon_class' => 'vincent-paypal',
		),
		'soundcloud'  => array(
			'label' => esc_html__( 'Soundcloud', 'vincent' ),
			'icon_class' => 'vincent-soundcloud',
		),
		'spotify'  => array(
			'label' => esc_html__( 'Spotify', 'vincent' ),
			'icon_class' => 'vincent-spotify',
		),
	) );
}

// Display or get post image
function vincent_get_image( $args = array() ) {
	$default =  array(
		'post_id'  => get_the_ID(),
		'size'     => 'thumbnail',
		'format'   => 'html', // html or src
		'attr'     => '',
		'meta_key' => '',
		'scan'     => true,
		'default'  => '',
	);

	$args = wp_parse_args( $args, $default );

	if ( ! $args['post_id'] )
		$args['post_id'] = get_the_ID();

	// Get image from cache
	$key = md5( serialize( $args ) );
	$image_cache = wp_cache_get( $args['post_id'], 'vincent_get_image' );

	if ( ! is_array( $image_cache ) )
		$image_cache = array();

	if ( empty( $image_cache[$key] ) ) {
		// Get post thumbnail
		if ( has_post_thumbnail( $args['post_id'] ) ) {
			$id = get_post_thumbnail_id();
			$html = wp_get_attachment_image( $id, $args['size'], false, $args['attr'] );
			list( $src ) = wp_get_attachment_image_src( $id, $args['size'], false, $args['attr'] );
		}

		// Get the first image in the custom field
		if ( ! isset( $html, $src ) && $args['meta_key'] ) {
			$id = get_post_meta( $args['post_id'], $args['meta_key'], true );

			// Check if this post has attached images
			if ( $id ) {
				$html = wp_get_attachment_image( $id, $args['size'], false, $args['attr'] );
				list( $src ) = wp_get_attachment_image_src( $id, $args['size'], false, $args['attr'] );
			}
		}

		// Get the first attached image
		if ( ! isset( $html, $src ) ) {
			$image_ids = array_keys( get_children( array(
				'post_parent'    => $args['post_id'],
				'post_type'	     => 'attachment',
				'post_mime_type' => 'image',
				'orderby'        => 'menu_order',
				'order'	         => 'ASC',
			) ) );

			// Check if this post has attached images
			if ( ! empty( $image_ids ) ) {
				$id = $image_ids[0];
				$html = wp_get_attachment_image( $id, $args['size'], false, $args['attr'] );
				list( $src ) = wp_get_attachment_image_src( $id, $args['size'], false, $args['attr'] );
			}
		}

		// Get the first image in the post content
		if ( ! isset( $html, $src ) && ( $args['scan'] ) ) {
			preg_match( '|<img.*?src=[\'"](.*?)[\'"].*?>|i', get_post_field( 'post_content', $args['post_id'] ), $matches );

			if ( !empty( $matches ) ) {
				$html = $matches[0];
				$src = $matches[1];
			}
		}

		// Use default when nothing found
		if ( ! isset( $html, $src ) && !empty( $args['default'] ) ) {
			if ( is_array( $args['default'] ) ) {
				$html = $args['html'];
				$src = $args['src'];
			} else {
				$html = $src = $args['default'];
			}
		}

		// Still no images found?
		if ( ! isset( $html, $src ) )
			return false;

		$output = 'html' === strtolower( $args['format'] ) ? $html : $src;

		$image_cache[$key] = $output;
		wp_cache_set( $args['post_id'], $image_cache, 'vincent_get_image' );
	}
	// If image already cached
	else {
		$output = $image_cache[$key];
	}

	$output = apply_filters( 'vincent_get_image', $output, $args );

	return $output;
}

// Check if it is WooCommerce Page
function vincent_is_woocommerce_page() {
    if ( function_exists ( "is_woocommerce" ) && is_woocommerce() )
		return true;

    $woocommerce_keys = array (
    	"woocommerce_shop_page_id" ,
        "woocommerce_terms_page_id" ,
        "woocommerce_cart_page_id" ,
        "woocommerce_checkout_page_id" ,
        "woocommerce_pay_page_id" ,
        "woocommerce_thanks_page_id" ,
        "woocommerce_myaccount_page_id" ,
        "woocommerce_edit_address_page_id" ,
        "woocommerce_view_order_page_id" ,
        "woocommerce_change_password_page_id" ,
        "woocommerce_logout_page_id" ,
        "woocommerce_lost_password_page_id" );

    foreach ( $woocommerce_keys as $wc_page_id ) {
		if ( get_the_ID () == get_option ( $wc_page_id , 0 ) ) {
			return true ;
		}
    }
    
    return false;
}

// Checks if is WooCommerce Shop page
function vincent_is_woocommerce_shop() {
	if ( ! class_exists( 'woocommerce' ) ) {
		return false;
	} elseif ( is_shop() ) {
		return true;
	}
}

// Checks if is WooCommerce archive product page
function vincent_is_woocommerce_archive_product() {
	if ( ! class_exists( 'woocommerce' ) ) {
		return false;
	} elseif ( is_product_category() || is_product_tag() ) {
		return true;
	}
}

function vincent_trim_words( $text, $limit ) {
    if ( str_word_count($text, 0) > $limit ) {
		$words = str_word_count( $text, 2 );
		$pos = array_keys( $words );
		$text = substr( $text, 0, $pos[$limit] );
	}
  return $text;
}

// TinyMCE from removing span tags
add_filter('tiny_mce_before_init', 'vincent_tinymce_init');
function vincent_tinymce_init( $initArray ) {
	$opts = '*[*]';
	$initArray['valid_elements'] = $opts;
	$initArray['extended_valid_elements'] = $opts;
	return $initArray;
}

// Hexdec color string to rgb(a) string
function vincent_hex2rgba( $color, $opacity = false ) {
 	$default = 'rgb(0,0,0)';

	if ( empty( $color ) ) return $default; 
    if ( $color[0] == '#' ) $color = substr( $color, 1 );

    if ( strlen( $color ) == 6 ) {
		$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }

    $rgb =  array_map( 'hexdec', $hex );

    if ( $opacity ) {
    	if ( abs($opacity ) > 1 ) $opacity = 1.0;
    	$output = 'rgba('. implode( ",", $rgb ) .','. $opacity .')';
    } else {
    	$output = 'rgb('. implode( ",", $rgb ) .')';
    }

    return $output;
}