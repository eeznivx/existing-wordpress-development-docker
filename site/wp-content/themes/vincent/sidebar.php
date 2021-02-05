<?php
// Get layout position
$layout = vincent_layout_position();
if ( $layout == 'no-sidebar' ) return;

$sidebar = 'sidebar-blog';

if ( is_page() && vincent_metabox('page_sidebar') )
	$sidebar = vincent_metabox('page_sidebar');

if ( vincent_is_woocommerce_page() )
	$sidebar = 'sidebar-shop';

if ( is_active_sidebar( $sidebar ) ) : ?>

<div id="sidebar">
	<div id="inner-sidebar" class="inner-content-wrap">
		<?php dynamic_sidebar( $sidebar ); ?>
	</div><!-- /#inner-sidebar -->
</div><!-- /#sidebar -->

<?php endif; ?>