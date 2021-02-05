<?php
/**
 * Header / Menu
 *
 * @package vincent
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( vincent_get_mod( 'header_cart_icon', false ) )
	echo vincent_header_cart();

if ( vincent_get_mod( 'header_search_icon', false ) ) {
	echo vincent_header_search_full();
} ?>

<ul class="nav-extend active">
	<?php if ( vincent_get_mod( 'header_search_icon', false ) ) : ?>
	<li class="ext"><?php get_search_form(); ?></li>
	<?php endif; ?>

	<?php if ( class_exists( 'woocommerce' ) && vincent_get_mod( 'header_cart_icon', false ) ) : ?>
	<li class="ext"><a class="cart-info" href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php echo esc_attr( 'View your shopping cart', 'vincent' ); ?>"><?php echo sprintf ( _n( '%d item', '%d items', WC()->cart->get_cart_contents_count(), 'vincent' ), WC()->cart->get_cart_contents_count() ); ?> <?php echo WC()->cart->get_cart_total(); ?></a></li>
	<?php endif; ?>
</ul>

<?php
	$menu = '';
	if ( is_page_template( 'templates/page-onepage.php' ) ) {
		$menu = 'onepage';
	} else {
		$menu = 'primary';
	}
?>

<?php if ( has_nav_menu( 'primary' ) || has_nav_menu( 'onepaeg' ) ) : ?>
	<div class="mobile-button"><span></span></div>

	<nav id="main-nav" class="main-nav">
	<?php
		wp_nav_menu( array(
			'theme_location' => $menu,
			'link_before' => '<span>',
			'link_after'=>'</span>',
			'fallback_cb' => false,
			'container' => false
		) );
	?>
	</nav>
<?php endif; ?>
