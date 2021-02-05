<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0
 */

$vincentes_sidebar_position = vincentes_get_theme_option('sidebar_position');
if (vincentes_sidebar_present()) {
	ob_start();
	$vincentes_sidebar_name = vincentes_get_theme_option('sidebar_widgets');
	vincentes_storage_set('current_sidebar', 'sidebar');
	if ( is_active_sidebar($vincentes_sidebar_name) ) {
		dynamic_sidebar($vincentes_sidebar_name);
	}
	$vincentes_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($vincentes_out)) {
		?>
		<div class="sidebar <?php echo esc_attr($vincentes_sidebar_position); ?> widget_area<?php if (!vincentes_is_inherit(vincentes_get_theme_option('sidebar_scheme'))) echo ' scheme_'.esc_attr(vincentes_get_theme_option('sidebar_scheme')); ?>" role="complementary">
			<div class="sidebar_inner">
				<?php
				do_action( 'vincentes_action_before_sidebar' );
				vincentes_show_layout(preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $vincentes_out));
				do_action( 'vincentes_action_after_sidebar' );
				?>
			</div><!-- /.sidebar_inner -->
		</div><!-- /.sidebar -->
		<?php
	}
}
?>