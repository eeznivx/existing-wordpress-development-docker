<?php
/*
 * Template Name: Blog List Template
 */
get_header(); ?>

<?php
if ( get_query_var('paged') ) {
   $paged = get_query_var('paged');
} elseif ( get_query_var('page') ) {
   $paged = get_query_var('page');
} else {
   $paged = 1;
}

$query_args = array(
    'post_type' => 'post',
    'paged'     => $paged
);

$query_args['posts_per_page'] = 9;
$query = new WP_Query( $query_args ); ?>

<div id="content-wrap" class="vincent-container">
    <div id="site-content" class="site-content clearfix">
        <div id="inner-content" class="inner-content-wrap">
			<?php if ( $query->have_posts() ) : ?>
				<div class="blog-list">
				<?php while ( $query->have_posts() ) : $query->the_post(); ?>
					<?php get_template_part( 'templates/entry-content' ); ?>
				<?php endwhile; ?>
				</div><!-- /.blog-list -->
				<?php vincent_pagination($query); ?>
			<?php endif; ?>

			<?php wp_reset_postdata(); ?>
        </div><!-- /#inner-content -->
    </div><!-- /#site-content -->
    
    <?php get_sidebar(); ?>
</div><!-- /#content-wrap -->

<?php get_footer(); ?>

