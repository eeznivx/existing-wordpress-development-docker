<?php
/**
 * Bottom Bar
 *
 * @package vincent
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer
if ( ! vincent_get_mod( 'bottom_bar', true ) ) return false;

$css = '';
$copyright = vincent_get_mod( 'bottom_copyright', '&copy; Vincent Eight. All rights reserved.' );
$content = vincent_get_mod( 'bottom_right_content', '' );

if ( is_page() && $bottom_bg = vincent_metabox('bottom_bg') )
    $css = 'background-color:'. $bottom_bg .';';
?>

<div id="bottom" style="<?php echo esc_attr( $css ); ?>">
    <div class="vincent-container">
        <div class="bottom-bar-inner-wrap">
            <div class="bottom-bar-copyright">
                <?php
                if ( $copyright ) : ?>
                    <div id="copyright">
                        <?php printf( '%s', do_shortcode( $copyright ) ); ?>
                    </div>
                <?php endif; ?>
            </div><!-- /.bottom-bar-copyright -->

            <?php if ( $content ) : ?>
                <div class="bottom-bar-content">
                    <?php printf( '%s', do_shortcode( $content ) ); ?>
                </div><!-- /.bottom-bar-content -->
            <?php endif; ?>

            <div class="bottom-bar-menu">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'bottom',
                    'fallback_cb'    => false,
                    'container'      => false,
                    'menu_class'     => 'bottom-nav',
                ) );
                ?>
            </div><!-- /.bottom-bar-menu -->
        </div>
    </div>
</div><!-- /#bottom -->