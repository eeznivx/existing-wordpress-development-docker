<?php get_header(); ?>
    <div id="content-wrap" class="vincent-container">
        <div id="site-content" class="site-content clearfix">
            <div id="inner-content" class="inner-content-wrap">
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'templates/entry-content-single' ); ?>

					<?php
					if ( comments_open() || get_comments_number() )
						comments_template( '', true );
					?>
				<?php endwhile;; ?>
            </div><!-- /#inner-content -->
        </div><!-- /#site-content -->
        
        <?php get_sidebar(); ?>
    </div><!-- /#content-wrap -->
<?php get_footer(); ?>