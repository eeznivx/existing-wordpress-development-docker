<?php
/**
 * The template to display the page title and breadcrumbs
 *
 * @package WordPress
 * @subpackage VINCENTES
 * @since VINCENTES 1.0
 */

// Page (category, tag, archive, author) title

if ( vincentes_need_page_title() ) {
	vincentes_sc_layouts_showed('title', true);
	vincentes_sc_layouts_showed('postmeta', true);
	?>
	<div class="top_panel_title sc_layouts_row sc_layouts_row_type_normal">
		<div class="content_wrap">
			<div class="sc_layouts_column sc_layouts_column_align_center">
				<div class="sc_layouts_item">
					<div class="sc_layouts_title sc_align_center">
						<?php

						// Blog/Post title
						?><div class="sc_layouts_title_title"><?php
							$vincentes_blog_title = vincentes_get_blog_title();
							$vincentes_blog_title_text = $vincentes_blog_title_class = $vincentes_blog_title_link = $vincentes_blog_title_link_text = '';
							if (is_array($vincentes_blog_title)) {
								$vincentes_blog_title_text = $vincentes_blog_title['text'];
								$vincentes_blog_title_class = !empty($vincentes_blog_title['class']) ? ' '.$vincentes_blog_title['class'] : '';
								$vincentes_blog_title_link = !empty($vincentes_blog_title['link']) ? $vincentes_blog_title['link'] : '';
								$vincentes_blog_title_link_text = !empty($vincentes_blog_title['link_text']) ? $vincentes_blog_title['link_text'] : '';
							} else
								$vincentes_blog_title_text = $vincentes_blog_title;
							?>
							<h1 class="sc_layouts_title_caption<?php echo esc_attr($vincentes_blog_title_class); ?>"><?php
								$vincentes_top_icon = vincentes_get_category_icon();
								if (!empty($vincentes_top_icon)) {
									$vincentes_attr = vincentes_getimagesize($vincentes_top_icon);
									?><img src="<?php echo esc_url($vincentes_top_icon); ?>" <?php if (!empty($vincentes_attr[3])) vincentes_show_layout($vincentes_attr[3]);?>><?php
								}
								echo wp_kses_data($vincentes_blog_title_text);
							?></h1>
							<?php
							if (!empty($vincentes_blog_title_link) && !empty($vincentes_blog_title_link_text)) {
								?><a href="<?php echo esc_url($vincentes_blog_title_link); ?>" class="theme_button theme_button_small sc_layouts_title_link"><?php echo esc_html($vincentes_blog_title_link_text); ?></a><?php
							}
							
							// Category/Tag description
							if ( is_category() || is_tag() || is_tax() ) 
								the_archive_description( '<div class="sc_layouts_title_description">', '</div>' );
		
						?></div><?php
	
						// Breadcrumbs
						?><div class="sc_layouts_title_breadcrumbs"><?php
							do_action( 'vincentes_action_breadcrumbs');
						?></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
}
?>