<?php
/**
 * The template to display the background video in the header
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0.14
 */
$vincentes_header_video = vincentes_get_header_video();
$vincentes_embed_video = '';
if (!empty($vincentes_header_video) && !vincentes_is_from_uploads($vincentes_header_video)) {
	if (vincentes_is_youtube_url($vincentes_header_video) && preg_match('/[=\/]([^=\/]*)$/', $vincentes_header_video, $matches) && !empty($matches[1])) {
		?><div id="background_video" data-youtube-code="<?php echo esc_attr($matches[1]); ?>"></div><?php
	} else {
		global $wp_embed;
		if (false && is_object($wp_embed)) {
			$vincentes_embed_video = do_shortcode($wp_embed->run_shortcode( '[embed]' . trim($vincentes_header_video) . '[/embed]' ));
			$vincentes_embed_video = vincentes_make_video_autoplay($vincentes_embed_video);
		} else {
			$vincentes_header_video = str_replace('/watch?v=', '/embed/', $vincentes_header_video);
			$vincentes_header_video = vincentes_add_to_url($vincentes_header_video, array(
				'feature' => 'oembed',
				'controls' => 0,
				'autoplay' => 1,
				'showinfo' => 0,
				'modestbranding' => 1,
				'wmode' => 'transparent',
				'enablejsapi' => 1,
				'origin' => home_url(),
				'widgetid' => 1
			));
			$vincentes_embed_video = '<iframe src="' . esc_url($vincentes_header_video) . '" width="1170" height="658" allowfullscreen="0" frameborder="0"></iframe>';
		}
		?><div id="background_video"><?php vincentes_show_layout($vincentes_embed_video); ?></div><?php
	}
}
?>