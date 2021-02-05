<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
} ?>

<?php get_header(); ?>
    <div id="content-wrap" class="vincent-container">
        <div id="site-content" class="site-content clearfix">
            <div id="inner-content" class="inner-content-wrap">
            	<div class="content-woocommerce">
					<?php if ( have_posts() ) : ?>
					<?php
						// woocommerce_before_shop_loop hook.
						do_action( 'woocommerce_before_shop_loop' );
					?>

					<?php woocommerce_product_loop_start(); ?>
						<?php woocommerce_product_subcategories(); ?>
						<?php while ( have_posts() ) : the_post(); ?>
							<?php wc_get_template_part( 'content', 'product' ); ?>
						<?php endwhile; // end of the loop. ?>
					<?php woocommerce_product_loop_end(); ?>

					<?php
						// woocommerce_after_main_content hook.
						do_action( 'woocommerce_after_shop_loop' );
					?>
					<?php endif; ?>
				</div>
            </div><!-- /#inner-content -->
        </div><!-- /#site-content -->
        
        <?php get_sidebar(); ?>
    </div><!-- /#content-wrap -->
<?php get_footer(); ?>