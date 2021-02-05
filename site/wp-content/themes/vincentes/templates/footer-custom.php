<?php
/**
 * The template to display default site footer
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0.10
 */

$vincentes_footer_scheme =  vincentes_is_inherit(vincentes_get_theme_option('footer_scheme')) ? vincentes_get_theme_option('color_scheme') : vincentes_get_theme_option('footer_scheme');
$vincentes_footer_id = str_replace('footer-custom-', '', vincentes_get_theme_option("footer_style"));
$vincentes_footer_meta = get_post_meta($vincentes_footer_id, 'trx_addons_options', true);
?>
<footer class="footer_wrap footer_custom footer_custom_<?php echo esc_attr($vincentes_footer_id); 
						?> footer_custom_<?php echo esc_attr(sanitize_title(get_the_title($vincentes_footer_id))); 
						if (!empty($vincentes_footer_meta['margin']) != '') 
							echo ' '.esc_attr(vincentes_add_inline_css_class('margin-top: '.esc_attr(vincentes_prepare_css_value($vincentes_footer_meta['margin'])).';'));
						?> scheme_<?php echo esc_attr($vincentes_footer_scheme); 
						?>">
	<?php
    // Custom footer's layout
    do_action('vincentes_action_show_layout', $vincentes_footer_id);
	?>
</footer><!-- /.footer_wrap -->
