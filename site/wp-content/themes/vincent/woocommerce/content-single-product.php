<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit; ?>

<div id="content-wrap" class="vincent-container">
    <div id="site-content" class="site-content clearfix">
        <div id="inner-content" class="inner-content-wrap">
        	<div class="content-woocommerce">
				<?php
					// woocommerce_before_single_product hook.
					 do_action( 'woocommerce_before_single_product' );

					 if ( post_password_required() ) {
					 	echo get_the_password_form();
					 	return;
					 }
				?>

				<div id="product-<?php the_ID(); ?>" <?php post_class( 'woo-single-post-class' ); ?>>
					<?php
						// woocommerce_before_single_product_summary hook.
						do_action( 'woocommerce_before_single_product_summary' );
					?>

					<div class="summary entry-summary">
						<?php
							// woocommerce_single_product_summary hook.
							do_action( 'woocommerce_single_product_summary' );
						?>
					</div><!-- .summary -->

					<?php
						// woocommerce_after_single_product_summary hook.
						do_action( 'woocommerce_after_single_product_summary' );
					?>
				</div><!-- /#product-<?php the_ID(); ?> -->

				<?php do_action( 'woocommerce_after_single_product' ); ?>
			</div>
	    </div><!-- /#inner-content -->
	</div><!-- /#site-content -->

    <?php get_sidebar(); ?>
</div><!-- /#content-wrap -->