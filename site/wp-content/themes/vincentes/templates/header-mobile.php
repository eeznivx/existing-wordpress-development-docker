<?php
/**
 * The template to show mobile menu
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0
 */
?>
<div class="menu_mobile_overlay"></div>
<div class="menu_mobile menu_mobile_<?php echo esc_attr(vincentes_get_theme_option('menu_mobile_fullscreen') > 0 ? 'fullscreen' : 'narrow'); ?> scheme_dark">
	<div class="menu_mobile_inner">
		<a class="menu_mobile_close icon-cancel"></a><?php

		// Logo
		set_query_var('vincentes_logo_args', array('type' => 'inverse'));
		get_template_part( 'templates/header-logo' );
		set_query_var('vincentes_logo_args', array());

		// Mobile menu
		$vincentes_menu_mobile = vincentes_get_nav_menu('menu_mobile');
		if (empty($vincentes_menu_mobile)) {
			$vincentes_menu_mobile = apply_filters('vincentes_filter_get_mobile_menu', '');
			if (empty($vincentes_menu_mobile)) $vincentes_menu_mobile = vincentes_get_nav_menu('menu_main');
			if (empty($vincentes_menu_mobile)) $vincentes_menu_mobile = vincentes_get_nav_menu();
		}
		if (!empty($vincentes_menu_mobile)) {
			if (!empty($vincentes_menu_mobile))
				$vincentes_menu_mobile = str_replace(
					array('menu_main', 'id="menu-', 'sc_layouts_menu_nav', 'sc_layouts_hide_on_mobile', 'hide_on_mobile'),
					array('menu_mobile', 'id="menu_mobile-', '', '', ''),
					$vincentes_menu_mobile
					);
			if (strpos($vincentes_menu_mobile, '<nav ')===false)
				$vincentes_menu_mobile = sprintf('<nav class="menu_mobile_nav_area">%s</nav>', $vincentes_menu_mobile);
			vincentes_show_layout(apply_filters('vincentes_filter_menu_mobile_layout', $vincentes_menu_mobile));
		}

		// Search field
		do_action('vincentes_action_search', 'normal', 'search_mobile', false);
		
		// Social icons
		vincentes_show_layout(vincentes_get_socials_links(), '<div class="socials_mobile">', '</div>');
		?>
	</div>
</div>
