<?php get_header(); ?>
    <div id="content-wrap" class="vincent-container">
        <div id="site-content" class="site-content clearfix">
            <div id="inner-content" class="inner-content-wrap">
				<?php if ( have_posts() ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'templates/entry-content' ); ?>
					<?php endwhile; ?>
					<?php vincent_pagination(); ?>
				<?php endif; ?>
            </div><!-- /#inner-content -->
        </div><!-- /#site-content -->
        
        <?php get_sidebar(); ?>
    </div><!-- /#content-wrap -->
<?php get_footer(); ?>