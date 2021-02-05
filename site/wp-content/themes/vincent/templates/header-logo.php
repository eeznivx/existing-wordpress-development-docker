<?php
/**
 * Header / Logo
 *
 * @package vincent
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Define variables
$logo_url = home_url( '/' );
$logo_title = get_bloginfo( 'name' );
$logo_img = vincent_get_mod( 'custom_logo' );
$logo_retina_img = vincent_get_mod( 'retina_logo' );
$logo_width = intval( vincent_get_mod( 'logo_width' ) );
$logo_height = intval( vincent_get_mod( 'logo_height' ) );

// Get header style
$header_style = vincent_get_mod( 'header_site_style', 'style-1' );
if ( is_page() && vincent_metabox('header_style') )
	$header_style = vincent_metabox('header_style');

if ( $header_style == 'style-2' ) {
	$logo_img = vincent_get_mod( 'custom_logotwo' );
	$logo_retina_img = vincent_get_mod( 'retina_logotwo' );
	$logo_width = intval( vincent_get_mod( 'logotwo_width' ) );
	$logo_height = intval( vincent_get_mod( 'logotwo_height' ) );	
}

// Get logo size
$logo_size = '';
if ( $logo_width )
	$logo_size .= 'width=' . $logo_width;

if ( $logo_height )
	$logo_size .= ' height='. $logo_height;

// Get data for retina logo
$data_retina = '';
if ( $logo_retina_img )
	$data_retina .= ' data-retina=' . esc_url( $logo_retina_img );

if ( $logo_width && $logo_height )
	$data_retina .= ' data-width='. esc_attr( $logo_width ) .' data-height=' . esc_attr( $logo_height );
?>

<div id="site-logo" class="clearfix">
	<div id="site-logo-inner">
		<?php if ( $logo_img ) : ?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( $logo_title ); ?>" rel="home" class="main-logo"><img src="<?php echo esc_url( $logo_img ); ?>" <?php echo esc_attr( $logo_size ); ?> alt="<?php echo esc_attr( $logo_title ); ?>" <?php echo esc_html( $data_retina ); ?> /></a>
		<?php else : ?>
			<a href="<?php echo esc_url( $logo_url ); ?>" title="<?php echo esc_attr( $logo_title ); ?>" rel="home" class="site-logo-text"><?php echo esc_html( $logo_title ); ?></a>
		<?php endif; ?>
	</div>
</div><!-- #site-logo -->