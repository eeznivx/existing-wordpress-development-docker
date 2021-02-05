<?php
/**
 * Entry Content / Read More
 *
 * @package vincent
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Get text more
$text_more = vincent_get_mod( 'blog_entry_button_read_more_text' );
$text_more   = $text_more ? $text_more : esc_html__( 'Read more', 'vincent' ); ?>

<div class="post-read-more">
	<div class="post-link">
		<a href="<?php esc_url( the_permalink() ); ?>" class="" title="<?php echo esc_attr( $text_more ); ?>">
			<?php echo esc_html( $text_more ); ?>
		</a>
	</div><!-- .post-link -->
</div>