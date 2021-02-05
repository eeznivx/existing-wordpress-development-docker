<?php
/**
 * Entry Content / Author
 *
 * @package vincent
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( is_single() && ! get_the_author_meta( 'description' ) )
	return;
?>

<div class="post-author cleafix">
    <div class="author-avatar">
        <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );?>" rel="author">
            <?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'vincent_author_bio_avatar_size', 80 ) ); ?>
        </a>
    </div>
    <div class="author-desc">
        <h4 class="name"><?php the_author_meta( 'nickname' ); ?></h4>
        <p><?php the_author_meta( 'description' ); ?></p>
        <div class="author-socials">
            <?php if ( $url = get_the_author_meta( 'rt_facebook' ) ) : ?>
                <a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr__( 'Facebook', 'vincent' ); ?>">
                    <i class="coreicon-facebook"></i>
                </a>
            <?php endif; ?>

            <?php if ( $url = get_the_author_meta( 'rt_twitter' ) ) : ?>
                <a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr__( 'Twitter', 'vincent' ); ?>">
                    <i class="coreicon-twitter"></i>
                </a>
            <?php endif; ?>

            <?php if ( $url = get_the_author_meta( 'rt_google_plus' ) ) : ?>
                <a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr__( 'Google +', 'vincent' ); ?>">
                    <i class="coreicon-googleplus"></i>
                </a>
            <?php endif; ?>

            <?php if ( $url = get_the_author_meta( 'rt_linkedin' ) ) : ?>
                <a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr__( 'Linkedin', 'vincent' ); ?>">
                    <i class="coreicon-linkedin"></i>
                </a>
            <?php endif; ?>

            <?php if ( $url = get_the_author_meta( 'rt_pinterest' ) ) : ?>
                <a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr__( 'Pinterest', 'vincent' ); ?>">
                    <i class="coreicon-pinterest"></i>
                </a>
            <?php endif; ?>

            <?php if ( $url = get_the_author_meta( 'rt_instagram' ) ) : ?>
                <a href="<?php echo esc_url( $url ); ?>" title="<?php echo esc_attr__( 'Instagram', 'vincent' ); ?>">
                    <i class="coreicon-instagram"></i>
                </a>
            <?php endif; ?>
        </div>
    </div>
</div>




