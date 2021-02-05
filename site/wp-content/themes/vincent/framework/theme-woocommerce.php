<?php
/**
 * Woocommerce
 *
 * @package vincent
 * @version 3.6.8
 */

// Disable WooCommerce styles
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// Remove breadcrumb (we're using the WooFramework default breadcrumb)
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);

// Removes the "shop" title on the main shop page
add_filter( 'woocommerce_show_page_title', '__return_false' );

// Remove Heading Text Tab
add_filter( 'woocommerce_product_description_heading', '__return_false' );
add_filter( 'woocommerce_product_additional_information_heading', '__return_false' );

// Change gravatar size
add_filter( 'woocommerce_review_gravatar_size', 'vincent_woocommerce_gravatar_size', 10 );
function vincent_woocommerce_gravatar_size() { return 100; }

// Adjust markup on all WooCommerce pages
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

// Remove WC sidebar
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

// Fix html on item product 
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

add_action( 'woocommerce_before_shop_loop_item', 'vincent_before_shop_loop_item' );
add_action( 'vincent_before_shop_loop_item', 'woocommerce_show_product_loop_sale_flash', 10 );
add_action( 'vincent_before_shop_loop_item', 'woocommerce_template_loop_product_thumbnail', 10 );

function vincent_before_shop_loop_item() {
	echo '<div class="product-thumbnail">';
	do_action( 'vincent_before_shop_loop_item' );
	echo '</div><div class="product-info">';
}
add_action( 'woocommerce_after_shop_loop_item', function() {
	echo '</div>';
}, 99 );

// Update the number on cart icon
add_filter( 'woocommerce_add_to_cart_fragments', 'agrikole_woocommerce_cart_link_fragment' );
if ( ! function_exists( 'agrikole_woocommerce_cart_link_fragment' ) ) {
	// Ensure cart contents update when products are added to the cart via AJAX
	function agrikole_woocommerce_cart_link_fragment( $fragments ) {
		global $woocommerce;
		ob_start(); ?>

		<a class="nav-cart-trigger" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php esc_attr_e( 'View your shopping cart', 'agrikole' ); ?>">
			<?php
			$item_count = sprintf(
				_n( '%d', '%d', WC()->cart->get_cart_contents_count(), 'agrikole' ),
				WC()->cart->get_cart_contents_count()
			);
			?>
			<span class="cart-icon coreicon-cart"><span class="shopping-cart-items-count"><?php echo esc_html( $item_count ); ?></span></span>
		</a>		

		<?php $fragments['a.nav-cart-trigger'] = ob_get_clean();

		return $fragments;
	}
}

// Output the script placeholder for cart updater
add_action( 'wp_footer', 'vincent_cart_fragments_placeholder', 100 );
function vincent_cart_fragments_placeholder() {
	echo '<script id="shopping-cart-items-updater" type="text/javascript"></script>';
}

// Display products per page
add_filter( 'loop_shop_per_page', 'vincent_products_per_page', 20 );
function vincent_products_per_page() {
	if ( ! $items = vincent_get_mod('shop_products_per_page') ) {
		return 6;
	} else {
		return $items;
	}
}

// Change columns in product loop
add_filter( 'loop_shop_columns', 'vincent_shop_loop_columns', 20 );
function vincent_shop_loop_columns() {

	if ( ! $cols = vincent_get_mod('shop_columns') ) {
		return 3;
	} else {
		if ( $cols == '2' ) return 2;
		if ( $cols == '3' ) return 3;
		if ( $cols == '4' ) return 4;
	}
}

add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

// Change columns in related products output to 4
add_filter( 'woocommerce_output_related_products_args', 'vincent_related_products' );
function vincent_related_products() {
	$args = array(
		'posts_per_page' => 4,
		'columns'        => 10,
	);
	return $args;
}

// Change product thumbnails columns to 6
add_filter('woocommerce_product_thumbnails_columns','vincent_custom_storefront_gallery' );
function vincent_custom_storefront_gallery( $column ) {
	$column  = 6;
	return $column ;
}