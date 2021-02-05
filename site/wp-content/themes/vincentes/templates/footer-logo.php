<?php
/**
 * The template to display the site logo in the footer
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0.10
 */

// Logo
if (vincentes_is_on(vincentes_get_theme_option('logo_in_footer'))) {
	$vincentes_logo_image = '';
	if (vincentes_get_retina_multiplier(2) > 1)
		$vincentes_logo_image = vincentes_get_theme_option( 'logo_footer_retina' );
	if (empty($vincentes_logo_image)) 
		$vincentes_logo_image = vincentes_get_theme_option( 'logo_footer' );
	$vincentes_logo_text   = get_bloginfo( 'name' );
	if (!empty($vincentes_logo_image) || !empty($vincentes_logo_text)) {
		?>
		<div class="footer_logo_wrap">
			<div class="footer_logo_inner">
				<?php
				if (!empty($vincentes_logo_image)) {
					$vincentes_attr = vincentes_getimagesize($vincentes_logo_image);
					echo '<a href="'.esc_url(home_url('/')).'"><img src="'.esc_url($vincentes_logo_image).'" class="logo_footer_image"'.(!empty($vincentes_attr[3]) ? sprintf(' %s', $vincentes_attr[3]) : '').'></a>' ;
				} else if (!empty($vincentes_logo_text)) {
					echo '<h1 class="logo_footer_text"><a href="'.esc_url(home_url('/')).'">' . esc_html($vincentes_logo_text) . '</a></h1>';
				}
				?>
			</div>
		</div>
		<?php
	}
}
?>