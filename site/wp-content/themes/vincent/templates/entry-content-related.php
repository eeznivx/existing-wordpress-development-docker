<?php
/**
 * Entry Content / Related Post
 *
 * @package vincent
 * @version 3.6.8
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! has_tag() ) { return; }
$tags = wp_get_post_tags( $post->ID );
$first_tag = $tags[0]->term_id;

$query_args = array(
    'tag__in' => array( $first_tag ),
    'post__not_in' => array( $post->ID ),
    'posts_per_page' => -1
);

$query = new WP_Query( $query_args );

if ( $query->have_posts() ) : ?>
    <?php wp_enqueue_script( 'slick' ); ?>

    <h3 class="related-title"><?php echo esc_html__('Related News', 'vincent'); ?></h3>
    
    <div class="post-related">
        <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="post-item">
            <div class="inner">
                <?php
                $the_cat = get_the_category();
                $category_name = $the_cat[0]->cat_name;
                $category_link = get_category_link( $the_cat[0]->cat_ID );

                $size = 'vincent-post-grid';
                $thumb = get_the_post_thumbnail( get_the_ID(), $size );

                if ( $thumb )
                    echo '<div class="thumb"><a href="' . esc_url( get_permalink() ) . '">'. $thumb .'</a></div>';
                ?>
                <div class="content">
                    <h4><a href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h4>
                    <div class="post-cat">
                        <?php the_category( ', ', get_the_ID() ); ?>
                    </div>
                </div>
            </div>
            </div>
        <?php endwhile; ?>
    </div><!-- /.post-related -->

<?php endif; wp_reset_postdata(); ?>



