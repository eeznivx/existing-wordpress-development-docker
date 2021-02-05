<?php
/**
 * The template to display the side menu
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0
 */
?>
<div class="menu_side_wrap scheme_<?php echo esc_attr(vincentes_is_inherit(vincentes_get_theme_option('menu_scheme')) 
																	? (vincentes_is_inherit(vincentes_get_theme_option('header_scheme')) 
																		? vincentes_get_theme_option('color_scheme') 
																		: vincentes_get_theme_option('header_scheme')) 
																	: vincentes_get_theme_option('menu_scheme'));
			echo " menu_side_".esc_attr(vincentes_get_theme_option('menu_side_icons') > 0 ? 'icons' : 'dots');
			?>">
	<span class="menu_side_button icon-menu-2"></span>

	<div class="menu_side_inner">
		<?php
		// Logo
		set_query_var('vincentes_logo_args', array('type' => 'side'));
		get_template_part( 'templates/header-logo' );
		set_query_var('vincentes_logo_args', array());
		// Main menu button
		?>
		<div class="toc_menu_item">
			<a href="#" class="toc_menu_description menu_mobile_description"><span class="toc_menu_description_title"><?php esc_html_e('Main menu', 'vincentes'); ?></span></a>
			<a class="menu_mobile_button toc_menu_icon icon-menu-2" href="#"></a>
		</div>		
	</div>
	
</div><!-- /.menu_side_wrap -->