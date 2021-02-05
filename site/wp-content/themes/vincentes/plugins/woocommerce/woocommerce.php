<?php
/* Woocommerce support functions
------------------------------------------------------------------------------- */

// Theme init priorities:
// 1 - register filters, that add/remove lists items for the Theme Options
if (!function_exists('vincentes_woocommerce_theme_setup1')) {
	add_action( 'after_setup_theme', 'vincentes_woocommerce_theme_setup1', 1 );
	function vincentes_woocommerce_theme_setup1() {

		add_theme_support( 'woocommerce' );

		// Next setting from the WooCommerce 3.0+ enable built-in image zoom on the single product page
		add_theme_support( 'wc-product-gallery-zoom' );

		// Next setting from the WooCommerce 3.0+ enable built-in image slider on the single product page
		add_theme_support( 'wc-product-gallery-slider' );

		// Next setting from the WooCommerce 3.0+ enable built-in image lightbox on the single product page
		add_theme_support( 'wc-product-gallery-lightbox' );

		add_filter( 'vincentes_filter_list_sidebars', 	'vincentes_woocommerce_list_sidebars' );
		add_filter( 'vincentes_filter_list_posts_types',	'vincentes_woocommerce_list_post_types');
	}
}

// Theme init priorities:
// 3 - add/remove Theme Options elements
if (!function_exists('vincentes_woocommerce_theme_setup3')) {
	add_action( 'after_setup_theme', 'vincentes_woocommerce_theme_setup3', 3 );
	function vincentes_woocommerce_theme_setup3() {
		if (vincentes_exists_woocommerce()) {

			vincentes_storage_merge_array('options', '', array(
				// Section 'WooCommerce' - settings for show pages
				'shop' => array(
					"title" => esc_html__('Shop', 'vincentes'),
					"desc" => wp_kses_data( __('Select parameters to display the shop pages', 'vincentes') ),
					"type" => "section"
					),
				'expand_content_shop' => array(
					"title" => esc_html__('Expand content', 'vincentes'),
					"desc" => wp_kses_data( __('Expand the content width if the sidebar is hidden', 'vincentes') ),
					"refresh" => false,
					"std" => 1,
					"type" => "checkbox"
					),
				'stretch_tabs_area' => array(
					"title" => esc_html__('Stretch tabs area', 'vincentes'),
					"desc" => wp_kses_data( __('Stretch area with tabs on the single product to the screen width if the sidebar is hidden', 'vincentes') ),
					"std" => 1,
					"type" => "checkbox"
					),
				'posts_per_page_shop' => array(
					"title" => esc_html__('Products per page', 'vincentes'),
					"desc" => wp_kses_data( __('How many products should be displayed on the shop page. If empty - use global value from the menu Settings - Reading', 'vincentes') ),
					"std" => '',
					"type" => "text"
					),
				'blog_columns_shop' => array(
					"title" => esc_html__('Shop loop columns', 'vincentes'),
					"desc" => wp_kses_data( __('How many columns should be used in the shop loop (from 2 to 4)?', 'vincentes') ),
					"std" => 2,
					"options" => vincentes_get_list_range(2,4),
					"type" => "select"
					),
				'related_posts_shop' => array(
					"title" => esc_html__('Related products', 'vincentes'),
					"desc" => wp_kses_data( __('How many related products should be displayed in the single product page?', 'vincentes') ),
					"std" => 3,
					"options" => vincentes_get_list_range(0,9),
					"type" => "select"
					),
				'related_columns_shop' => array(
					"title" => esc_html__('Related columns', 'vincentes'),
					"desc" => wp_kses_data( __('How many columns should be used to output related products in the single product page?', 'vincentes') ),
					"std" => 3,
					"options" => vincentes_get_list_range(1,4),
					"type" => "select"
					),
				'shop_mode' => array(
					"title" => esc_html__('Shop mode', 'vincentes'),
					"desc" => wp_kses_data( __('Select style for the products list', 'vincentes') ),
					"std" => 'thumbs',
					"options" => array(
						'thumbs'=> esc_html__('Thumbnails', 'vincentes'),
						'list'	=> esc_html__('List', 'vincentes'),
					),
					"type" => "select"
					),
				'shop_hover' => array(
					"title" => esc_html__('Hover style', 'vincentes'),
					"desc" => wp_kses_data( __('Hover style on the products in the shop archive', 'vincentes') ),
					"std" => 'shop',
					"options" => apply_filters('vincentes_filter_shop_hover', array(
						'none' => esc_html__('None', 'vincentes'),
						'shop' => esc_html__('Icons', 'vincentes'),
						'shop_buttons' => esc_html__('Buttons', 'vincentes')
					)),
					"type" => "select"
					),
				'header_style_shop' => array(
					"title" => esc_html__('Header style', 'vincentes'),
					"desc" => wp_kses_data( __('Select style to display the site header on the shop archive', 'vincentes') ),
					"std" => 'inherit',
					"options" => array(),
					"type" => "select"
					),
				'header_position_shop' => array(
					"title" => esc_html__('Header position', 'vincentes'),
					"desc" => wp_kses_data( __('Select position to display the site header on the shop archive', 'vincentes') ),
					"std" => 'inherit',
					"options" => array(),
					"type" => "select"
					),
				'header_widgets_shop' => array(
					"title" => esc_html__('Header widgets', 'vincentes'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the header on the shop pages', 'vincentes') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'sidebar_widgets_shop' => array(
					"title" => esc_html__('Sidebar widgets', 'vincentes'),
					"desc" => wp_kses_data( __('Select sidebar to show on the shop pages', 'vincentes') ),
					"std" => 'woocommerce_widgets',
					"options" => array(),
					"type" => "select"
					),
				'sidebar_position_shop' => array(
					"title" => esc_html__('Sidebar position', 'vincentes'),
					"desc" => wp_kses_data( __('Select position to show sidebar on the shop pages', 'vincentes') ),
					"refresh" => false,
					"std" => 'left',
					"options" => array(),
					"type" => "select"
					),
				'hide_sidebar_on_single_shop' => array(
					"title" => esc_html__('Hide sidebar on the single product', 'vincentes'),
					"desc" => wp_kses_data( __("Hide sidebar on the single product's page", 'vincentes') ),
					"std" => 0,
					"type" => "checkbox"
					),
				'widgets_above_page_shop' => array(
					"title" => esc_html__('Widgets at the top of the page', 'vincentes'),
					"desc" => wp_kses_data( __('Select widgets to show at the top of the page (above content and sidebar)', 'vincentes') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'widgets_above_content_shop' => array(
					"title" => esc_html__('Widgets above the content', 'vincentes'),
					"desc" => wp_kses_data( __('Select widgets to show at the beginning of the content area', 'vincentes') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'widgets_below_content_shop' => array(
					"title" => esc_html__('Widgets below the content', 'vincentes'),
					"desc" => wp_kses_data( __('Select widgets to show at the ending of the content area', 'vincentes') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'widgets_below_page_shop' => array(
					"title" => esc_html__('Widgets at the bottom of the page', 'vincentes'),
					"desc" => wp_kses_data( __('Select widgets to show at the bottom of the page (below content and sidebar)', 'vincentes') ),
					"std" => 'hide',
					"options" => array(),
					"type" => "select"
					),
				'footer_scheme_shop' => array(
					"title" => esc_html__('Footer Color Scheme', 'vincentes'),
					"desc" => wp_kses_data( __('Select color scheme to decorate footer area', 'vincentes') ),
					"std" => 'dark',
					"options" => array(),
					"type" => "select"
					),
				'footer_widgets_shop' => array(
					"title" => esc_html__('Footer widgets', 'vincentes'),
					"desc" => wp_kses_data( __('Select set of widgets to show in the footer', 'vincentes') ),
					"std" => 'footer_widgets',
					"options" => array(),
					"type" => "select"
					),
				'footer_columns_shop' => array(
					"title" => esc_html__('Footer columns', 'vincentes'),
					"desc" => wp_kses_data( __('Select number columns to show widgets in the footer. If 0 - autodetect by the widgets count', 'vincentes') ),
					"dependency" => array(
						'footer_widgets_shop' => array('^hide')
					),
					"std" => 0,
					"options" => vincentes_get_list_range(0,6),
					"type" => "select"
					),
				'footer_wide_shop' => array(
					"title" => esc_html__('Footer fullwide', 'vincentes'),
					"desc" => wp_kses_data( __('Do you want to stretch the footer to the entire window width?', 'vincentes') ),
					"std" => 0,
					"type" => "checkbox"
					)
				)
			);
		}
	}
}

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('vincentes_woocommerce_theme_setup9')) {
	add_action( 'after_setup_theme', 'vincentes_woocommerce_theme_setup9', 9 );
	function vincentes_woocommerce_theme_setup9() {

		if (vincentes_exists_woocommerce()) {
			add_action( 'wp_enqueue_scripts', 								'vincentes_woocommerce_frontend_scripts', 1100 );
			add_filter( 'vincentes_filter_merge_styles',						'vincentes_woocommerce_merge_styles' );
			add_filter( 'vincentes_filter_get_post_info',		 				'vincentes_woocommerce_get_post_info');
			add_filter( 'vincentes_filter_post_type_taxonomy',				'vincentes_woocommerce_post_type_taxonomy', 10, 2 );
			if (!is_admin()) {
				add_filter( 'vincentes_filter_detect_blog_mode',				'vincentes_woocommerce_detect_blog_mode' );
				add_filter( 'vincentes_filter_get_post_categories', 			'vincentes_woocommerce_get_post_categories');
				add_filter( 'vincentes_filter_allow_override_header_image',	'vincentes_woocommerce_allow_override_header_image' );
				add_action( 'vincentes_action_before_post_meta',				'vincentes_woocommerce_action_before_post_meta');
				add_action( 'pre_get_posts',								'vincentes_woocommerce_pre_get_posts' );
				add_filter( 'vincentes_filter_localize_script',				'vincentes_woocommerce_localize_script' );
			}
		}
		if (is_admin()) {
			add_filter( 'vincentes_filter_tgmpa_required_plugins',			'vincentes_woocommerce_tgmpa_required_plugins' );
		}

		// Add wrappers and classes to the standard WooCommerce output
		if (vincentes_exists_woocommerce()) {

			// Remove WOOC sidebar
			remove_action( 'woocommerce_sidebar', 						'woocommerce_get_sidebar', 10 );

			// Remove link around product item
			remove_action('woocommerce_before_shop_loop_item',			'woocommerce_template_loop_product_link_open', 10);
			remove_action('woocommerce_after_shop_loop_item',			'woocommerce_template_loop_product_link_close', 5);


			// Remove link around product category
			remove_action('woocommerce_before_subcategory',				'woocommerce_template_loop_category_link_open', 10);
			remove_action('woocommerce_after_subcategory',				'woocommerce_template_loop_category_link_close', 10);

			// Open main content wrapper - <article>
			remove_action( 'woocommerce_before_main_content',			'woocommerce_output_content_wrapper', 10);
			add_action(    'woocommerce_before_main_content',			'vincentes_woocommerce_wrapper_start', 10);
			// Close main content wrapper - </article>
			remove_action( 'woocommerce_after_main_content',			'woocommerce_output_content_wrapper_end', 10);
			add_action(    'woocommerce_after_main_content',			'vincentes_woocommerce_wrapper_end', 10);

			// Close header section
			add_action(    'woocommerce_archive_description',			'vincentes_woocommerce_archive_description', 15 );

			// Add theme specific search form
			add_filter(    'get_product_search_form',					'vincentes_woocommerce_get_product_search_form' );

			// Change text on 'Add to cart' button
			add_filter(    'woocommerce_product_add_to_cart_text',		'vincentes_woocommerce_add_to_cart_text' );
			add_filter(    'woocommerce_product_single_add_to_cart_text','vincentes_woocommerce_add_to_cart_text' );

			// Add list mode buttons
			add_action(    'woocommerce_before_shop_loop', 				'vincentes_woocommerce_before_shop_loop', 10 );

			// Set columns number for the products loop
			add_filter(    'loop_shop_columns',							'vincentes_woocommerce_loop_shop_columns' );
			add_filter(    'post_class',								'vincentes_woocommerce_loop_shop_columns_class' );
			add_filter(    'product_cat_class',							'vincentes_woocommerce_loop_shop_columns_class', 10, 3 );
			// Open product/category item wrapper
			add_action(    'woocommerce_before_subcategory_title',		'vincentes_woocommerce_item_wrapper_start', 9 );
			add_action(    'woocommerce_before_shop_loop_item_title',	'vincentes_woocommerce_item_wrapper_start', 9 );
			// Close featured image wrapper and open title wrapper
			add_action(    'woocommerce_before_subcategory_title',		'vincentes_woocommerce_title_wrapper_start', 20 );
			add_action(    'woocommerce_before_shop_loop_item_title',	'vincentes_woocommerce_title_wrapper_start', 20 );

			// Add tags before title
			add_action(    'woocommerce_before_shop_loop_item_title',	'vincentes_woocommerce_title_tags', 30 );

			// Wrap product title into link
			add_action(    'the_title',									'vincentes_woocommerce_the_title');
			// Wrap category title into link
			add_action(		'woocommerce_before_subcategory_title',		'vincentes_woocommerce_before_subcategory_title', 22, 1 );
			add_action(		'woocommerce_after_subcategory_title',		'vincentes_woocommerce_after_subcategory_title', 2, 1 );


			// Close title wrapper and add description in the list mode
			add_action(    'woocommerce_after_shop_loop_item_title',	'vincentes_woocommerce_title_wrapper_end', 7);
			add_action(    'woocommerce_after_subcategory_title',		'vincentes_woocommerce_title_wrapper_end2', 10 );
			// Close product/category item wrapper
			add_action(    'woocommerce_after_subcategory',				'vincentes_woocommerce_item_wrapper_end', 20 );
			add_action(    'woocommerce_after_shop_loop_item',			'vincentes_woocommerce_item_wrapper_end', 20 );

			// Add product ID into product meta section (after categories and tags)
			add_action(    'woocommerce_product_meta_end',				'vincentes_woocommerce_show_product_id', 10);

			// Set columns number for the product's thumbnails
			add_filter(    'woocommerce_product_thumbnails_columns',	'vincentes_woocommerce_product_thumbnails_columns' );

			// Decorate price
			add_filter(    'woocommerce_get_price_html',				'vincentes_woocommerce_get_price_html' );


			// Detect current shop mode
			if (!is_admin()) {
				$shop_mode = vincentes_get_value_gpc('vincentes_shop_mode');
				if (empty($shop_mode) && vincentes_check_theme_option('shop_mode'))
					$shop_mode = vincentes_get_theme_option('shop_mode');
				if (empty($shop_mode))
					$shop_mode = 'thumbs';
				vincentes_storage_set('shop_mode', $shop_mode);
			}
		}
	}
}

// Theme init priorities:
// Action 'wp'
// 1 - detect override mode. Attention! Only after this step you can use overriden options (separate values for the shop, courses, etc.)
if (!function_exists('vincentes_woocommerce_theme_setup_wp')) {
	add_action( 'wp', 'vincentes_woocommerce_theme_setup_wp' );
	function vincentes_woocommerce_theme_setup_wp() {
		if (vincentes_exists_woocommerce()) {
			// Set columns number for the related products
			if ((int) vincentes_get_theme_option('related_posts') == 0) {
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
			} else {
				add_filter(    'woocommerce_output_related_products_args',	'vincentes_woocommerce_output_related_products_args' );
				add_filter(    'woocommerce_related_products_columns',		'vincentes_woocommerce_related_products_columns' );
			}
		}
	}
}


// Check if WooCommerce installed and activated
if ( !function_exists( 'vincentes_exists_woocommerce' ) ) {
	function vincentes_exists_woocommerce() {
		return class_exists('Woocommerce');
	}
}

// Return true, if current page is any woocommerce page
if ( !function_exists( 'vincentes_is_woocommerce_page' ) ) {
	function vincentes_is_woocommerce_page() {
		$rez = false;
		if (vincentes_exists_woocommerce())
			$rez = is_woocommerce() || is_shop() || is_product() || is_product_category() || is_product_tag() || is_product_taxonomy() || is_cart() || is_checkout() || is_account_page();
		return $rez;
	}
}

// Detect current blog mode
if ( !function_exists( 'vincentes_woocommerce_detect_blog_mode' ) ) {
	//Handler of the add_filter( 'vincentes_filter_detect_blog_mode', 'vincentes_woocommerce_detect_blog_mode' );
	function vincentes_woocommerce_detect_blog_mode($mode='') {
		if (is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy())
			$mode = 'shop';
		else if (is_product() || is_cart() || is_checkout() || is_account_page())
			$mode = 'shop';
		return $mode;
	}
}


// Return taxonomy for current post type
if ( !function_exists( 'vincentes_woocommerce_post_type_taxonomy' ) ) {
	//Handler of the add_filter( 'vincentes_filter_post_type_taxonomy',	'vincentes_woocommerce_post_type_taxonomy', 10, 2 );
	function vincentes_woocommerce_post_type_taxonomy($tax='', $post_type='') {
		if ($post_type == 'product')
			$tax = 'product_cat';
		return $tax;
	}
}

// Return true if page title section is allowed
if ( !function_exists( 'vincentes_woocommerce_allow_override_header_image' ) ) {
	//Handler of the add_filter( 'vincentes_filter_allow_override_header_image', 'vincentes_woocommerce_allow_override_header_image' );
	function vincentes_woocommerce_allow_override_header_image($allow=true) {
		return is_product() ? false : $allow;
	}
}

// Return shop page ID
if ( !function_exists( 'vincentes_woocommerce_get_shop_page_id' ) ) {
	function vincentes_woocommerce_get_shop_page_id() {
		return get_option('woocommerce_shop_page_id');
	}
}

// Return shop page link
if ( !function_exists( 'vincentes_woocommerce_get_shop_page_link' ) ) {
	function vincentes_woocommerce_get_shop_page_link() {
		$url = '';
		$id = vincentes_woocommerce_get_shop_page_id();
		if ($id) $url = get_permalink($id);
		return $url;
	}
}

// Show categories of the current product
if ( !function_exists( 'vincentes_woocommerce_get_post_categories' ) ) {
	//Handler of the add_filter( 'vincentes_filter_get_post_categories', 		'vincentes_woocommerce_get_post_categories');
	function vincentes_woocommerce_get_post_categories($cats='') {
		if (get_post_type()=='product') {
			$cats = vincentes_get_post_terms(', ', get_the_ID(), 'product_cat');
		}
		return $cats;
	}
}

// Add 'product' to the list of the supported post-types
if ( !function_exists( 'vincentes_woocommerce_list_post_types' ) ) {
	//Handler of the add_filter( 'vincentes_filter_list_posts_types', 'vincentes_woocommerce_list_post_types');
	function vincentes_woocommerce_list_post_types($list=array()) {
		$list['product'] = esc_html__('Products', 'vincentes');
		return $list;
	}
}

// Show price of the current product in the widgets and search results
if ( !function_exists( 'vincentes_woocommerce_get_post_info' ) ) {
	//Handler of the add_filter( 'vincentes_filter_get_post_info', 'vincentes_woocommerce_get_post_info');
	function vincentes_woocommerce_get_post_info($post_info='') {
		if (get_post_type()=='product') {
			global $product;
			if ( $price_html = $product->get_price_html() ) {
				$post_info = '<div class="post_price product_price price">' . trim($price_html) . '</div>' . $post_info;
			}
		}
		return $post_info;
	}
}

// Show price of the current product in the search results streampage
if ( !function_exists( 'vincentes_woocommerce_action_before_post_meta' ) ) {
	//Handler of the add_action( 'vincentes_action_before_post_meta', 'vincentes_woocommerce_action_before_post_meta');
	function vincentes_woocommerce_action_before_post_meta() {
		if (get_post_type()=='product') {
			global $product;
			if ( $price_html = $product->get_price_html() ) {
				?><div class="post_price product_price price"><?php vincentes_show_layout($price_html); ?></div><?php
			}
		}
	}
}

// Enqueue WooCommerce custom styles
if ( !function_exists( 'vincentes_woocommerce_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'vincentes_woocommerce_frontend_scripts', 1100 );
	function vincentes_woocommerce_frontend_scripts() {
			if (vincentes_is_on(vincentes_get_theme_option('debug_mode')) && vincentes_get_file_dir('plugins/woocommerce/woocommerce.css')!='')
				wp_enqueue_style( 'vincentes-woocommerce',  vincentes_get_file_url('plugins/woocommerce/woocommerce.css'), array(), null );
	}
}

// Merge custom styles
if ( !function_exists( 'vincentes_woocommerce_merge_styles' ) ) {
	//Handler of the add_filter('vincentes_filter_merge_styles', 'vincentes_woocommerce_merge_styles');
	function vincentes_woocommerce_merge_styles($list) {
		$list[] = 'plugins/woocommerce/woocommerce.css';
		return $list;
	}
}

// Filter to add in the required plugins list
if ( !function_exists( 'vincentes_woocommerce_tgmpa_required_plugins' ) ) {
	//Handler of the add_filter('vincentes_filter_tgmpa_required_plugins',	'vincentes_woocommerce_tgmpa_required_plugins');
	function vincentes_woocommerce_tgmpa_required_plugins($list=array()) {
		if (in_array('woocommerce', vincentes_storage_get('required_plugins')))
			$list[] = array(
					'name' 		=> esc_html__('WooCommerce', 'vincentes'),
					'slug' 		=> 'woocommerce',
					'required' 	=> false
				);

		return $list;
	}
}


if ( ! function_exists( 'vincentes_woocommerce_price_filter_widget_step' ) ) {
    add_filter('woocommerce_price_filter_widget_step', 'vincentes_woocommerce_price_filter_widget_step');
    function vincentes_woocommerce_price_filter_widget_step( $step = '' ) {
        $step = 1;
        return $step;
    }
}



// Add WooCommerce specific items into lists
//------------------------------------------------------------------------

// Add sidebar
if ( !function_exists( 'vincentes_woocommerce_list_sidebars' ) ) {
	//Handler of the add_filter( 'vincentes_filter_list_sidebars', 'vincentes_woocommerce_list_sidebars' );
	function vincentes_woocommerce_list_sidebars($list=array()) {
		$list['woocommerce_widgets'] = array(
											'name' => esc_html__('WooCommerce Widgets', 'vincentes'),
											'description' => esc_html__('Widgets to be shown on the WooCommerce pages', 'vincentes')
											);
		return $list;
	}
}




// Decorate WooCommerce output: Loop
//------------------------------------------------------------------------

// Add query vars to set products per page
if (!function_exists('vincentes_woocommerce_pre_get_posts')) {
	//Handler of the add_action( 'pre_get_posts', 'vincentes_woocommerce_pre_get_posts' );
	function vincentes_woocommerce_pre_get_posts($query) {
		if (!$query->is_main_query()) return;
		if ($query->get('post_type') == 'product') {
			$ppp = get_theme_mod('posts_per_page_shop', 0);
			if ($ppp > 0)
				$query->set('posts_per_page', $ppp);
		}
	}
}


// Before main content
if ( !function_exists( 'vincentes_woocommerce_wrapper_start' ) ) {
	//Handler of the add_action('woocommerce_before_main_content', 'vincentes_woocommerce_wrapper_start', 10);
	function vincentes_woocommerce_wrapper_start() {
		if (is_product() || is_cart() || is_checkout() || is_account_page()) {
			?>
			<article class="post_item_single post_type_product">
			<?php
		} else {
			?>
			<div class="list_products shop_mode_<?php echo !vincentes_storage_empty('shop_mode') ? vincentes_storage_get('shop_mode') : 'thumbs'; ?>">
				<div class="list_products_header">
			<?php
		}
	}
}

// After main content
if ( !function_exists( 'vincentes_woocommerce_wrapper_end' ) ) {
	//Handler of the add_action('woocommerce_after_main_content', 'vincentes_woocommerce_wrapper_end', 10);
	function vincentes_woocommerce_wrapper_end() {
		if (is_product() || is_cart() || is_checkout() || is_account_page()) {
			?>
			</article><!-- /.post_item_single -->
			<?php
		} else {
			?>
			</div><!-- /.list_products -->
			<?php
		}
	}
}

// Close header section
if ( !function_exists( 'vincentes_woocommerce_archive_description' ) ) {
	//Handler of the add_action( 'woocommerce_archive_description', 'vincentes_woocommerce_archive_description', 15 );
	function vincentes_woocommerce_archive_description() {
		?>
		</div><!-- /.list_products_header -->
		<?php
	}
}

// Add list mode buttons
if ( !function_exists( 'vincentes_woocommerce_before_shop_loop' ) ) {
	//Handler of the add_action( 'woocommerce_before_shop_loop', 'vincentes_woocommerce_before_shop_loop', 10 );
	function vincentes_woocommerce_before_shop_loop() {
		?>
		<div class="vincentes_shop_mode_buttons"><form action="<?php echo esc_url(vincentes_get_current_url()); ?>" method="post"><input type="hidden" name="vincentes_shop_mode" value="<?php echo esc_attr(vincentes_storage_get('shop_mode')); ?>" /><a href="#" class="woocommerce_thumbs icon-th" title="<?php esc_attr_e('Show products as thumbs', 'vincentes'); ?>"></a><a href="#" class="woocommerce_list icon-th-list" title="<?php esc_attr_e('Show products as list', 'vincentes'); ?>"></a></form></div><!-- /.vincentes_shop_mode_buttons -->
		<?php
	}
}

// Number of columns for the shop streampage
if ( !function_exists( 'vincentes_woocommerce_loop_shop_columns' ) ) {
	//Handler of the add_filter( 'loop_shop_columns', 'vincentes_woocommerce_loop_shop_columns' );
	function vincentes_woocommerce_loop_shop_columns($cols) {
		return max(2, min(4, vincentes_get_theme_option('blog_columns')));
	}
}

// Add column class into product item in shop streampage
if ( !function_exists( 'vincentes_woocommerce_loop_shop_columns_class' ) ) {
	//Handler of the add_filter( 'post_class', 'vincentes_woocommerce_loop_shop_columns_class' );
	//Handler of the add_filter( 'product_cat_class', 'vincentes_woocommerce_loop_shop_columns_class', 10, 3 );
	function vincentes_woocommerce_loop_shop_columns_class($classes, $class='', $cat='') {
		global $woocommerce_loop;
		if (is_product()) {
			if (!empty($woocommerce_loop['columns'])) {
				$classes[] = ' column-1_'.esc_attr($woocommerce_loop['columns']);
			}
		} else if (is_shop() || is_product_category() || is_product_tag() || is_product_taxonomy()) {
			$classes[] = ' column-1_'.esc_attr(max(2, min(4, vincentes_get_theme_option('blog_columns'))));
		}
		return $classes;
	}
}


// Open item wrapper for categories and products
if ( !function_exists( 'vincentes_woocommerce_item_wrapper_start' ) ) {
	//Handler of the add_action( 'woocommerce_before_subcategory_title', 'vincentes_woocommerce_item_wrapper_start', 9 );
	//Handler of the add_action( 'woocommerce_before_shop_loop_item_title', 'vincentes_woocommerce_item_wrapper_start', 9 );
	function vincentes_woocommerce_item_wrapper_start($cat='') {
		vincentes_storage_set('in_product_item', true);
		$hover = vincentes_get_theme_option('shop_hover');
		?>
		<div class="post_item post_layout_<?php echo esc_attr(vincentes_storage_get('shop_mode')); ?>">
			<div class="post_featured hover_<?php echo esc_attr($hover); ?>">
				<?php do_action('vincentes_action_woocommerce_item_featured_start'); ?>
				<a href="<?php echo esc_url(is_object($cat) ? get_term_link($cat->slug, 'product_cat') : get_permalink()); ?>">
				<?php
	}
}

// Open item wrapper for categories and products
if ( !function_exists( 'vincentes_woocommerce_open_item_wrapper' ) ) {
	//Handler of the add_action( 'woocommerce_before_subcategory_title', 'vincentes_woocommerce_title_wrapper_start', 20 );
	//Handler of the add_action( 'woocommerce_before_shop_loop_item_title', 'vincentes_woocommerce_title_wrapper_start', 20 );
	function vincentes_woocommerce_title_wrapper_start($cat='') {
				?></a><?php
				if (($hover = vincentes_get_theme_option('shop_hover')) != 'none') {
					?><div class="mask"></div><?php
					vincentes_hovers_add_icons($hover, array('cat'=>$cat));
				}
				do_action('vincentes_action_woocommerce_item_featured_end');
				?>
			</div><!-- /.post_featured -->
			<div class="post_data">
				<div class="post_data_inner">
					<div class="post_header entry-header">
					<?php
	}
}


// Display product's tags before the title
if ( !function_exists( 'vincentes_woocommerce_title_tags' ) ) {
	//Handler of the add_action( 'woocommerce_before_shop_loop_item_title', 'vincentes_woocommerce_title_tags', 30 );
	function vincentes_woocommerce_title_tags() {
		global $product;
		vincentes_show_layout(wc_get_product_tag_list( $product->get_id(), ', ', '<div class="post_tags product_tags">', '</div>' ));
	}
}

// Wrap product title into link
if ( !function_exists( 'vincentes_woocommerce_the_title' ) ) {
	//Handler of the add_filter( 'the_title', 'vincentes_woocommerce_the_title' );
	function vincentes_woocommerce_the_title($title) {
		if (vincentes_storage_get('in_product_item') && get_post_type()=='product') {
			$title = '<a href="'.esc_url(get_permalink()).'">'.esc_html($title).'</a>';
		}
		return $title;
	}
}

// Wrap category title to the link: open tag
if ( !function_exists( 'vincentes_woocommerce_before_subcategory_title' ) ) {
	//Handler of the add_action( 'woocommerce_before_subcategory_title', 'vincentes_woocommerce_before_subcategory_title', 10, 1 );
function vincentes_woocommerce_before_subcategory_title($cat) {
if (vincentes_storage_get('in_product_item') && is_object($cat)) {
	?><a href="<?php echo esc_url(get_term_link($cat->slug, 'product_cat')); ?>"><?php
}
}
}

// Wrap category title to the link: close tag
if ( !function_exists( 'vincentes_woocommerce_after_subcategory_title' ) ) {
	//Handler of the add_action( 'woocommerce_after_subcategory_title', 'vincentes_woocommerce_after_subcategory_title', 10, 1 );
function vincentes_woocommerce_after_subcategory_title($cat) {
if (vincentes_storage_get('in_product_item') && is_object($cat)) {
	?></a><?php
}
}
}

// Add excerpt in output for the product in the list mode
if ( !function_exists( 'vincentes_woocommerce_title_wrapper_end' ) ) {
	//Handler of the add_action( 'woocommerce_after_shop_loop_item_title', 'vincentes_woocommerce_title_wrapper_end', 7);
	function vincentes_woocommerce_title_wrapper_end() {
			?>
			</div><!-- /.post_header -->
		<?php
		if (!is_product()) {
		    $excerpt = apply_filters('the_excerpt', get_the_excerpt());
			?>
			<div class="post_content entry-content"><?php vincentes_show_layout($excerpt); ?></div>
			<?php
		}
	}
}

// Add excerpt in output for the product in the list mode
if ( !function_exists( 'vincentes_woocommerce_title_wrapper_end2' ) ) {
	//Handler of the add_action( 'woocommerce_after_subcategory_title', 'vincentes_woocommerce_title_wrapper_end2', 10 );
	function vincentes_woocommerce_title_wrapper_end2($category) {
			?>
			</div><!-- /.post_header -->
		<?php
		if (vincentes_storage_get('shop_mode') == 'list' && is_shop() && !is_product()) {
			?>
			<div class="post_content entry-content"><?php vincentes_show_layout($category->description); ?></div><!-- /.post_content -->
			<?php
		}
	}
}

// Close item wrapper for categories and products
if ( !function_exists( 'vincentes_woocommerce_close_item_wrapper' ) ) {
	//Handler of the add_action( 'woocommerce_after_subcategory', 'vincentes_woocommerce_item_wrapper_end', 20 );
	//Handler of the add_action( 'woocommerce_after_shop_loop_item', 'vincentes_woocommerce_item_wrapper_end', 20 );
	function vincentes_woocommerce_item_wrapper_end($cat='') {
				?>
				</div><!-- /.post_data_inner -->
			</div><!-- /.post_data -->
		</div><!-- /.post_item -->
		<?php
		vincentes_storage_set('in_product_item', false);
	}
}

// Change text on 'Add to cart' button
if ( !function_exists( 'vincentes_woocommerce_add_to_cart_text' ) ) {
    //Handler of the add_filter( 'woocommerce_product_add_to_cart_text',	'vincentes_woocommerce_add_to_cart_text' );
    //Handler of the add_filter( 'woocommerce_product_single_add_to_cart_text','vincentes_woocommerce_add_to_cart_text' );
    function vincentes_woocommerce_add_to_cart_text($text='') {
        global $product;
        $product_type = $product->get_type();
        switch ( $product_type ) {
            case 'external':
                return $product->get_button_text();
                break;
            default:
                return esc_html__('Buy now', 'vincentes');
        }
    }
}

// Decorate price
if ( !function_exists( 'vincentes_woocommerce_get_price_html' ) ) {
	//Handler of the add_filter(    'woocommerce_get_price_html',	'vincentes_woocommerce_get_price_html' );
	function vincentes_woocommerce_get_price_html($price='') {

		return $price;
	}
}



// Decorate WooCommerce output: Single product
//------------------------------------------------------------------------

// Add WooCommerce specific vars into localize array
if (!function_exists('vincentes_woocommerce_localize_script')) {
	//Handler of the add_filter( 'vincentes_filter_localize_script','vincentes_woocommerce_localize_script' );
	function vincentes_woocommerce_localize_script($arr) {
		$arr['stretch_tabs_area'] = !vincentes_sidebar_present() ? vincentes_get_theme_option('stretch_tabs_area') : 0;
		return $arr;
	}
}

// Add Product ID for the single product
if ( !function_exists( 'vincentes_woocommerce_show_product_id' ) ) {
	//Handler of the add_action( 'woocommerce_product_meta_end', 'vincentes_woocommerce_show_product_id', 10);
	function vincentes_woocommerce_show_product_id() {
		$authors = wp_get_post_terms(get_the_ID(), 'pa_product_author');
		if (is_array($authors) && count($authors)>0) {
			echo '<span class="product_author">'.esc_html__('Author: ', 'vincentes');
			$delim = '';
			foreach ($authors as $author) {
				echo  esc_html($delim) . '<span>' . esc_html($author->name) . '</span>';
				$delim = ', ';
			}
			echo '</span>';
		}
		echo '<span class="product_id">'.esc_html__('Product ID: ', 'vincentes') . '<span>' . get_the_ID() . '</span></span>';
	}
}

// Number columns for the product's thumbnails
if ( !function_exists( 'vincentes_woocommerce_product_thumbnails_columns' ) ) {
	//Handler of the add_filter( 'woocommerce_product_thumbnails_columns', 'vincentes_woocommerce_product_thumbnails_columns' );
	function vincentes_woocommerce_product_thumbnails_columns($cols) {
		return 4;
	}
}

// Set products number for the related products
if ( !function_exists( 'vincentes_woocommerce_output_related_products_args' ) ) {
	//Handler of the add_filter( 'woocommerce_output_related_products_args', 'vincentes_woocommerce_output_related_products_args' );
	function vincentes_woocommerce_output_related_products_args($args) {
		$args['posts_per_page'] = max(0, min(9, vincentes_get_theme_option('related_posts')));
		$args['columns'] = max(1, min(4, vincentes_get_theme_option('related_columns')));
		return $args;
	}
}

// Set columns number for the related products
if ( !function_exists( 'vincentes_woocommerce_related_products_columns' ) ) {
	//Handler of the add_filter('woocommerce_related_products_columns', 'vincentes_woocommerce_related_products_columns' );
	function vincentes_woocommerce_related_products_columns($columns) {
		$columns = max(1, min(4, vincentes_get_theme_option('related_columns')));
		return $columns;
	}
}



// Decorate WooCommerce output: Widgets
//------------------------------------------------------------------------

// Search form
if ( !function_exists( 'vincentes_woocommerce_get_product_search_form' ) ) {
	//Handler of the add_filter( 'get_product_search_form', 'vincentes_woocommerce_get_product_search_form' );
	function vincentes_woocommerce_get_product_search_form($form) {
		return '
		<form role="search" method="get" class="search_form" action="' . esc_url(home_url('/')) . '">
			<input type="text" class="search_field" placeholder="' . esc_attr__('Search for products &hellip;', 'vincentes') . '" value="' . get_search_query() . '" name="s" /><button class="search_button" type="submit">' . esc_html__('Search', 'vincentes') . '</button>
			<input type="hidden" name="post_type" value="product" />
		</form>
		';
	}
}


// Add plugin-specific colors and fonts to the custom CSS
if (vincentes_exists_woocommerce()) { require_once VINCENTES_THEME_DIR . 'plugins/woocommerce/woocommerce.styles.php'; }
?>