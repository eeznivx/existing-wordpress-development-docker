<?php
/**
 * The template to display the widgets area in the footer
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0.10
 */

// Footer sidebar
$vincentes_footer_name = vincentes_get_theme_option('footer_widgets');
$vincentes_footer_present = !vincentes_is_off($vincentes_footer_name) && is_active_sidebar($vincentes_footer_name);
if ($vincentes_footer_present) { 
	vincentes_storage_set('current_sidebar', 'footer');
	$vincentes_footer_wide = vincentes_get_theme_option('footer_wide');
	ob_start();
	if ( is_active_sidebar($vincentes_footer_name) ) {
		dynamic_sidebar($vincentes_footer_name);
	}
	$vincentes_out = trim(ob_get_contents());
	ob_end_clean();
	if (!empty($vincentes_out)) {
		$vincentes_out = preg_replace("/<\\/aside>[\r\n\s]*<aside/", "</aside><aside", $vincentes_out);
		$vincentes_need_columns = true;
		if ($vincentes_need_columns) {
			$vincentes_columns = max(0, (int) vincentes_get_theme_option('footer_columns'));
			if ($vincentes_columns == 0) $vincentes_columns = min(4, max(1, substr_count($vincentes_out, '<aside ')));
			if ($vincentes_columns > 1)
				$vincentes_out = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($vincentes_columns).' widget ', $vincentes_out);
			else
				$vincentes_need_columns = false;
		}
		?>
		<div class="footer_widgets_wrap widget_area<?php echo !empty($vincentes_footer_wide) ? ' footer_fullwidth' : ''; ?> sc_layouts_row  sc_layouts_row_type_normal">
			<div class="footer_widgets_inner widget_area_inner">
				<?php 
				if (!$vincentes_footer_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($vincentes_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'vincentes_action_before_sidebar' );
				vincentes_show_layout($vincentes_out);
				do_action( 'vincentes_action_after_sidebar' );
				if ($vincentes_need_columns) {
					?></div><!-- /.columns_wrap --><?php
				}
				if (!$vincentes_footer_wide) {
					?></div><!-- /.content_wrap --><?php
				}
				?>
			</div><!-- /.footer_widgets_inner -->
		</div><!-- /.footer_widgets_wrap -->
		<?php
	}
}
?>