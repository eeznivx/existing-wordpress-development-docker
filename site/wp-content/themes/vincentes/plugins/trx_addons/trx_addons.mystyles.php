<?php
// Add plugin-specific colors and fonts to the custom CSS
if (!function_exists('vincentes_trx_addons_get_mycss')) {
	add_filter('vincentes_filter_get_css', 'vincentes_trx_addons_get_mycss', 10, 4);
	function vincentes_trx_addons_get_mycss($css, $colors, $fonts, $scheme='') {

        if (isset($css['fonts']) && $fonts) {
            $css['fonts'] .= <<<CSS
            .sc_item_subtitle,
            .vc_tta-tabs .sc_icons .sc_icons_item_title,
            body .mejs-container *{
                {$fonts['p_font-family']}
            }
            .sc_price_info .sc_price_title,
            .trx_addons_dropcap {
                {$fonts['h1_font-family']}
            }

CSS;
        }

        if (isset($css['colors']) && $colors) {
            $css['colors'] .= <<<CSS
            .trx_addons_accent,
            .trx_addons_accent > a,
            .trx_addons_accent > * {
                color: {$colors['text_link']};
            }
            .trx_addons_accent_hovered,
            .trx_addons_accent_hovered > a,
            .trx_addons_accent_hovered > * {
                color: {$colors['text_hover']};
            }
            .trx_addons_accent_bg {
                color: {$colors['inverse_link']};
                background-color: {$colors['text_link']};
            }
            .trx_addons_accent_hovered_bg {
                color: {$colors['alter_dark']};
                background-color: {$colors['text_link2']};
            }

            .trx_addons_tooltip {
                color: {$colors['text_dark']};
                border-color: {$colors['text_dark']};
            }
            .trx_addons_tooltip:before {
                background-color: {$colors['text_dark']};
                color: {$colors['inverse_link']};
            }
            .trx_addons_tooltip:after {
                border-top-color: {$colors['text_dark']};
            }

            .trx_addons_dropcap_style_1 {
                background: {$colors['text_dark']};
                color: {$colors['inverse_link']};
            }
            .trx_addons_dropcap_style_2 {
                background: {$colors['text_link']};
                color: {$colors['inverse_link']};
            }

            ul[class*="trx_addons_list_custom"] > li:before {
            }
            ul[class*="trx_addons_list"] > li:before{
                color: {$colors['text_link']};
            }
            ul[class*="trx_addons_list_success"] > li:before {
                color: {$colors['text_dark']};
            }



            .sc_table table tr:first-child th,
            .sc_table table tr:first-child td {
                color: {$colors['inverse_link']};
                background-color: {$colors['text_dark']};
                border-color: {$colors['bg_color_02']};
            }
            .sc_table table td {
                border-color: {$colors['bd_color']};
            }

            .footer_wrap .socials_wrap .social_item .social_icon,
            .scheme_self.footer_wrap .socials_wrap .social_item .social_icon,
            .socials_wrap .social_item .social_icon {
                color: {$colors['inverse_link']};
                background-color: {$colors['text_link']};
            }
            .footer_wrap .socials_wrap .social_item:hover .social_icon,
            .scheme_self.footer_wrap .socials_wrap .social_item:hover .social_icon,
            .socials_wrap .social_item:hover .social_icon {
                color: {$colors['inverse_link']};
                background-color: {$colors['text_hover2']};
            }
            .sc_layouts_row_type_compact .sc_layouts_item_icon,
            .sc_layouts_row_type_compact .search_wrap .search_submit {
                color: {$colors['text_hover']};
            }
            .sc_layouts_row_type_compact .sc_layouts_cart:hover .sc_layouts_item_icon,
            .sc_layouts_row_type_compact .search_wrap .search_submit:hover {
                color: {$colors['text_dark']};
            }


            .sc_layouts_menu_nav>li>a {
                color: {$colors['text']} !important;
            }
            .sc_layouts_menu_nav>li>a:hover,
            .sc_layouts_menu_nav>li.sfHover>a,
            .sc_layouts_menu_nav>li.current-menu-item>a,
            .sc_layouts_menu_nav>li.current-menu-parent>a,
            .sc_layouts_menu_nav>li.current-menu-ancestor>a {
                color: {$colors['text_link']} !important;
            }
            .sc_layouts_menu_nav > li > ul:before,
            .sc_layouts_menu_nav>li ul {
                background-color: {$colors['text_link']};
            }
            .sc_layouts_menu_popup .sc_layouts_menu_nav>li>a,
            .sc_layouts_menu_nav>li li>a {
                color: {$colors['inverse_link']} !important;
                background: {$colors['bg_color_0']} !important;
            }
            .sc_layouts_menu_popup .sc_layouts_menu_nav>li>a:hover,
            .sc_layouts_menu_popup .sc_layouts_menu_nav>li.sfHover>a,
            .sc_layouts_menu_nav>li li>a:hover,
            .sc_layouts_menu_nav>li li.sfHover>a,
            .sc_layouts_menu_nav>li li.current-menu-item>a,
            .sc_layouts_menu_nav>li li.current-menu-parent>a,
            .sc_layouts_menu_nav>li li.current-menu-ancestor>a {
                 color: {$colors['text_link2']} !important;
                background: {$colors['bg_color_0']} !important;
            }


            .breadcrumbs_item.current {
                color: {$colors['text_dark']} !important;
            }
            .sc_layouts_title_breadcrumbs a:hover {
                color: {$colors['text_dark_07']} !important;
            }

            .footer_wrap .widget li a {
                color: {$colors['text']};
            }
            .footer_wrap .widget li a:hover {
                color: {$colors['text_link2']};
            }
            .sc_slider_controls .slider_controls_wrap > a,
            .slider_swiper.slider_controls_side .slider_controls_wrap > a,
            .slider_outer_controls_side .slider_controls_wrap > a {
                color: {$colors['text_hover2']};
                background-color: {$colors['text_link2']};
            }
            .sc_slider_controls .slider_controls_wrap > a:hover,
            .slider_swiper.slider_controls_side .slider_controls_wrap > a:hover,
            .slider_outer_controls_side .slider_controls_wrap > a:hover {
                color: {$colors['inverse_link']};
                background-color: {$colors['text_hover2']};
            }

            .sc_skills .sc_skills_total {
                color: {$colors['text_dark']};
            }
            .sc_skills_counter .sc_skills_icon {
                color: {$colors['text_link']};
            }
            .sc_skills .sc_skills_item_title {
                color: {$colors['text']};
            }
            .sc_skills_counter .sc_skills_item_title {
                color: {$colors['text_dark']};
            }
            .scheme_self.footer_wrap .widget li a,
            .scheme_self.footer_wrap .sc_layouts_row {
                color: {$colors['text_dark_05']};
            }

            /* Price */
            .sc_price {
                color: {$colors['text']};
                background-color: {$colors['bg_color']};
            }
            .sc_price .sc_price_icon {
                color: {$colors['text']};
            }
            .sc_price .sc_price_label {
                background-color: {$colors['text_link']};
                color: {$colors['inverse_link']};
            }
            .sc_price_title:after,
            .sc_price_info .sc_price_subtitle {
                color: {$colors['text_link']};
            }
            .sc_price_info .sc_price_title,
            .sc_price_info .sc_price_title a {
                color: {$colors['text_dark']};
            }
            .sc_price_info .sc_price_price {
                color: {$colors['text']};
            }
            .sc_price_info .sc_price_description,
            .sc_price_info .sc_price_details {
                color: {$colors['text']};
            }
            .sc_item_title:after {
                color: {$colors['text_link']};
            }
            .scheme_dark .sc_item_title:after,
            .scheme_dark .sc_item_subtitle {
                color: {$colors['text_link2']};
            }
             .scheme_dark .sc_testimonials_item_author_title {
                color: {$colors['text_link2']};
             }

            .sc_testimonials .sc_slider_controls .slider_controls_wrap > a,
            .sc_testimonials .slider_swiper.slider_controls_side .slider_controls_wrap > a,
            .sc_testimonials .slider_outer_controls_side .slider_controls_wrap > a {
                color: {$colors['text_link2']};
                background-color: {$colors['bg_color_0']};
            }
            .sc_testimonials .sc_slider_controls .slider_controls_wrap > a:hover,
            .sc_testimonials .slider_swiper.slider_controls_side .slider_controls_wrap > a:hover,
            .sc_testimonials .slider_outer_controls_side .slider_controls_wrap > a:hover {
                color: {$colors['inverse_link']};
                background-color: {$colors['bg_color_0']};
            }
            .sc_icons .sc_icons_item_title {
                color: {$colors['text_dark']};
            }
             .sc_icons_item_description {
                color: {$colors['text']};
             }
             .sc_events_full .event-date {
                color: {$colors['text_light']};
             }
             .sc_events_full .event-date > span:before {
                color: {$colors['text_dark']};
             }
             .sc_dishes_default .sc_dishes_item {
                color: {$colors['text']};
                background-color: {$colors['bg_color_0']};
             }
             .vc_tta-tabs .sc_icons{
                border-color: {$colors['bd_color']};
             }
             .sc_team_default .sc_team_item {
                color: {$colors['text']};
                background-color: {$colors['bg_color_0']};
             }
             .sc_team_default .sc_team_item_subtitle {
                color: {$colors['text']};
             }
             .sc_team_default .sc_team_item_header:after {
                color: {$colors['text_link']};
             }
             .sc_services_list .sc_services_item_featured_left .sc_services_item_icon, .sc_services_list .sc_services_item_featured_right .sc_services_item_icon {
                color: {$colors['text_dark']};
             }
             .sc_action_item_description {
                color: {$colors['text_dark']};
             }
             .sc_action_item_title:after {
                color: {$colors['text_link2']};
             }
             .widget_content .sc_twitter_item a,
             .widget_twitter .widget_content .sc_twitter_item .sc_twitter_item_icon {
                color: {$colors['text_link2']} !important;
             }
             .twitter-text,
             .widget_content .sc_twitter_item a:hover {
                color: {$colors['text_dark']} !important;
             }
             .sc_twitter_slider.slider_outer_controls_side .slider_controls_wrap > .slider_prev,
             .sc_twitter_slider.slider_outer_controls_side .slider_controls_wrap > .slider_next {
                color: {$colors['text_link2']};
                background-color: {$colors['bg_color_0']};
             }
             .sc_twitter_slider.slider_outer_controls_side .slider_controls_wrap > .slider_prev:hover,
             .sc_twitter_slider.slider_outer_controls_side .slider_controls_wrap > .slider_next:hover {
                color: {$colors['text_dark']};
             }
             .scheme_dark .sc_promo .sc_promo_title,
             .BigWhiteText:after {
                color: {$colors['text_link2']};
             }
             .sc_blogger_item {
                background-color: {$colors['bg_color_0']};
             }
             .post_item_none_search .search_wrap .search_submit, .post_item_none_archive .search_wrap .search_submit {
                color: {$colors['text_dark']};
             }
             .single-tribe_events .tribe-events-cal-links {
                border-color: {$colors['bd_color']};
             }


CSS;
		}

		return $css;
	}
}
?>