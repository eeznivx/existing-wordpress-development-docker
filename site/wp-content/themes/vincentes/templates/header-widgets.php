<?php
/**
 * The template to display the widgets area in the header
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0
 */

// Header sidebar
$vincentes_header_name = vincentes_get_theme_option('header_widgets');
$vincentes_header_present = !vincentes_is_off($vincentes_header_name) && is_active_sidebar($vincentes_header_name);
if ($vincentes_header_present) { 
	vincentes_storage_set('current_sidebar', 'header');
	$vincentes_header_wide = vincentes_get_theme_option('header_wide');
	ob_start();
	if ( is_active_sidebar($vincentes_header_name) ) {
		dynamic_sidebar($vincentes_header_name);
	}
	$vincentes_widgets_output = ob_get_contents();
	ob_end_clean();
	if (!empty($vincentes_widgets_output)) {
		$vincentes_widgets_output = preg_replace("/<\/aside>[\r\n\s]*<aside/", "</aside><aside", $vincentes_widgets_output);
		$vincentes_need_columns = strpos($vincentes_widgets_output, 'columns_wrap')===false;
		if ($vincentes_need_columns) {
			$vincentes_columns = max(0, (int) vincentes_get_theme_option('header_columns'));
			if ($vincentes_columns == 0) $vincentes_columns = min(6, max(1, substr_count($vincentes_widgets_output, '<aside ')));
			if ($vincentes_columns > 1)
				$vincentes_widgets_output = preg_replace("/class=\"widget /", "class=\"column-1_".esc_attr($vincentes_columns).' widget ', $vincentes_widgets_output);
			else
				$vincentes_need_columns = false;
		}
		?>
		<div class="header_widgets_wrap widget_area<?php echo !empty($vincentes_header_wide) ? ' header_fullwidth' : ' header_boxed'; ?>">
			<div class="header_widgets_inner widget_area_inner">
				<?php 
				if (!$vincentes_header_wide) { 
					?><div class="content_wrap"><?php
				}
				if ($vincentes_need_columns) {
					?><div class="columns_wrap"><?php
				}
				do_action( 'vincentes_action_before_sidebar' );
				vincentes_show_layout($vincentes_widgets_output);
				do_action( 'vincentes_action_after_sidebar' );
				if ($vincentes_need_columns) {
					?></div>	<!-- /.columns_wrap --><?php
				}
				if (!$vincentes_header_wide) {
					?></div>	<!-- /.content_wrap --><?php
				}
				?>
			</div>	<!-- /.header_widgets_inner -->
		</div>	<!-- /.header_widgets_wrap -->
		<?php
	}
}
?>