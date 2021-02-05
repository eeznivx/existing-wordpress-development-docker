<?php
/**
 * Featured Title
 *
 * @package vincent
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Exit if disabled via Customizer or Metabox
if ( ! vincent_get_mod( 'featured_title', true ) || vincent_metabox('hide_featured_title') )
    return;

$title = vincent_get_mod( 'blog_featured_title', 'Latest News' );
$subtitle = vincent_get_mod( 'blog_featured_subtitle', '' );

if ( is_singular() ) {
    $title = get_the_title();
} elseif ( is_search() ) {
    $title = sprintf( esc_html__( 'Search results for &quot;%s&quot;', 'vincent' ), get_search_query() );
} elseif ( is_404() ) {
    $title = esc_html__( 'Not Found', 'vincent' );
} elseif ( is_author() ) {
    the_post();
    $title = sprintf( esc_html__( 'Author Archives: %s', 'vincent' ), get_the_author() );
    rewind_posts();
} elseif ( is_day() ) {
    $title = sprintf( esc_html__( 'Daily Archives: %s', 'vincent' ), get_the_date() );
} elseif ( is_month() ) {
    $title = sprintf( esc_html__( 'Monthly Archives: %s', 'vincent' ), get_the_date( 'F Y' ) );
} elseif ( is_year() ) {
    $title = sprintf( esc_html__( 'Yearly Archives: %s', 'vincent' ), get_the_date( 'Y' ) );
} elseif ( is_tax() || is_category() || is_tag() ) {
    $title = single_term_title( '', false );
}

if ( is_page() && vincent_metabox('custom_featured_title' ) ) {
    $title = vincent_metabox('custom_featured_title' );
    $subtitle = vincent_metabox('custom_featured_subtitle');
}

if ( vincent_is_woocommerce_shop() ) {
    $title = vincent_get_mod( 'shop_featured_title', 'Our Shop' );
    $subtitle = vincent_get_mod( 'shop_featured_subtitle', '' );
}

if ( is_singular( 'product' ) ) {
    $sptitle = vincent_get_mod( 'shop_single_featured_title', 'Our Shop' );
    if ( $sptitle != '' ) {
        $title = $sptitle;
    } else {
        $title = get_the_title();
    }

    $subtitle = vincent_get_mod( 'shop_single_featured_subtitle', '' );
}

if ( is_singular( 'post' ) ) {
    $title = vincent_get_mod( 'blog_single_featured_title', 'Latest News' );
    $subtitle = vincent_get_mod( 'blog_single_featured_subtitle', '' );
} ?>

<div id="featured-title" class="<?php echo vincent_feature_title_cls(); ?>" style="<?php echo vincent_featured_title_bg(); ?>">
    <div class="vincent-container clearfix">
        <div class="inner-wrap">
        <?php
            // Dont load if disabled via Customizer
            if ( vincent_get_mod( 'featured_title_heading', true ) ) : ?>
                <div class="title-group">
                    <h1 class="main-title">
                        <?php echo esc_html( $title ); ?>
                    </h1>
                    <?php if ( $subtitle ) : ?>
                        <h5 class="sub-title"><?php echo do_shortcode( $subtitle ); ?></h5>
                    <?php endif; ?>

                </div>
            <?php endif;

            // Dont load if disabled via Customizer
            if ( vincent_get_mod( 'featured_title_breadcrumbs', true ) ) : ?>
                <div id="breadcrumbs">
                    <div class="breadcrumbs-inner">
                        <div class="breadcrumb-trail">
                            <?php vincent_breadcrumbs(); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div><!-- /#featured-title -->

