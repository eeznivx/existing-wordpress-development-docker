<?php
/**
 * The template to display the socials in the footer
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0.10
 */


// Socials
if ( vincentes_is_on(vincentes_get_theme_option('socials_in_footer')) && ($vincentes_output = vincentes_get_socials_links()) != '') {
	?>
	<div class="footer_socials_wrap socials_wrap">
		<div class="footer_socials_inner">
			<?php vincentes_show_layout($vincentes_output); ?>
		</div>
	</div>
	<?php
}
?>