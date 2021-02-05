<?php get_header(); ?>
    <div id="content-wrap" class="vincent-container">

		<div class="no-results">
			<div class="no-results-content">
				<div class="no-results-title">
					<h1><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'vincent' ); ?></h1>
				</div>

				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'vincent' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		</div><!-- /.no-results -->

    </div><!-- /#content-wrap -->
<?php get_footer(); ?>



