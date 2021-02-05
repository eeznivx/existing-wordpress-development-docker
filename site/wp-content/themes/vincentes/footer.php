<?php
/**
 * The Footer: widgets area, logo, footer menu and socials
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0
 */

						// Widgets area inside page content
						vincentes_create_widgets_area('widgets_below_content');
						?>				
					</div><!-- </.content> -->

					<?php
					// Show main sidebar
					get_sidebar();

					// Widgets area below page content
					vincentes_create_widgets_area('widgets_below_page');

					$vincentes_body_style = vincentes_get_theme_option('body_style');
					if ($vincentes_body_style != 'fullscreen') {
						?></div><!-- </.content_wrap> --><?php
					}
					?>
			</div><!-- </.page_content_wrap> -->

			<?php
			// Footer
			$vincentes_footer_style = vincentes_get_theme_option("footer_style");
			if (strpos($vincentes_footer_style, 'footer-custom-')===0) $vincentes_footer_style = 'footer-custom';
			get_template_part( "templates/{$vincentes_footer_style}");
			?>

		</div><!-- /.page_wrap -->

	</div><!-- /.body_wrap -->

	<?php if (vincentes_is_on(vincentes_get_theme_option('debug_mode')) && vincentes_get_file_dir('images/makeup.jpg')!='') { ?>
		<img src="<?php echo esc_url(vincentes_get_file_url('images/makeup.jpg')); ?>" id="makeup">
	<?php } ?>

	<?php wp_footer(); ?>

</body>
</html>