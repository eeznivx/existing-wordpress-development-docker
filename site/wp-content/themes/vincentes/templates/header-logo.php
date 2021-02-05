<?php
/**
 * The template to display the logo or the site name and the slogan in the Header
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0
 */

$vincentes_args = get_query_var('vincentes_logo_args');

// Site logo
$vincentes_logo_image  = vincentes_get_logo_image(isset($vincentes_args['type']) ? $vincentes_args['type'] : '');
$vincentes_logo_text   = vincentes_is_on(vincentes_get_theme_option('logo_text')) ? get_bloginfo( 'name' ) : '';
$vincentes_logo_slogan = get_bloginfo( 'description', 'display' );
if (!empty($vincentes_logo_image) || !empty($vincentes_logo_text)) {
	?><a class="sc_layouts_logo" href="<?php echo is_front_page() ? '#' : esc_url(home_url('/')); ?>"><?php
		if (!empty($vincentes_logo_image)) {
			$vincentes_attr = vincentes_getimagesize($vincentes_logo_image);
			echo '<img src="'.esc_url($vincentes_logo_image).'"'.(!empty($vincentes_attr[3]) ? sprintf(' %s', $vincentes_attr[3]) : '').'>' ;
		} else {
			vincentes_show_layout(vincentes_prepare_macros($vincentes_logo_text), '<span class="logo_text">', '</span>');
			vincentes_show_layout(vincentes_prepare_macros($vincentes_logo_slogan), '<span class="logo_slogan">', '</span>');
		}
	?></a><?php
}
?>