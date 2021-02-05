<?php
/**
 * The template to display the copyright info in the footer
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0.10
 */

// Copyright area
$vincentes_footer_scheme =  vincentes_is_inherit(vincentes_get_theme_option('footer_scheme')) ? vincentes_get_theme_option('color_scheme') : vincentes_get_theme_option('footer_scheme');
$vincentes_copyright_scheme = vincentes_is_inherit(vincentes_get_theme_option('copyright_scheme')) ? $vincentes_footer_scheme : vincentes_get_theme_option('copyright_scheme');
?> 
<div class="footer_copyright_wrap scheme_<?php echo esc_attr($vincentes_copyright_scheme); ?>">
	<div class="footer_copyright_inner">
		<div class="content_wrap">
			<div class="copyright_text"><?php
				// Replace {{...}} and [[...]] on the <i>...</i> and <b>...</b>
				$vincentes_copyright = vincentes_prepare_macros(vincentes_get_theme_option('copyright'));
				if (!empty($vincentes_copyright)) {
					// Replace {date_format} on the current date in the specified format
					if (preg_match("/(\\{[\\w\\d\\\\\\-\\:]*\\})/", $vincentes_copyright, $vincentes_matches)) {
						$vincentes_copyright = str_replace($vincentes_matches[1], date(str_replace(array('{', '}'), '', $vincentes_matches[1])), $vincentes_copyright);
					}
					// Display copyright
					echo wp_kses_data(nl2br($vincentes_copyright));
				}
			?></div>
		</div>
	</div>
</div>
