<?php
/**
 * The template to display menu in the footer
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0.10
 */

// Footer menu
$vincentes_menu_footer = vincentes_get_nav_menu(array(
											'location' => 'menu_footer',
											'class' => 'sc_layouts_menu sc_layouts_menu_default'
											));
if (!empty($vincentes_menu_footer)) {
	?>
	<div class="footer_menu_wrap">
		<div class="footer_menu_inner">
			<?php vincentes_show_layout($vincentes_menu_footer); ?>
		</div>
	</div>
	<?php
}
?>