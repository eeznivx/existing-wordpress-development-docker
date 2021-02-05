/**
 * Update Customizer settings live.
*/

( function( $ ) {

var objBg = {
	input_background_color: "textarea,input[type='text'],input[type='password'],input[type='datetime'],input[type='datetime-local'],input[type='date'],input[type='month'],input[type='time'],input[type='week'],input[type='number'],input[type='email'],input[type='url'],input[type='search'],input[type='tel'],input[type='color']",
	header_background: ".header-style-1 #site-header",
	header_two_background: ".header-style-2 #site-header:after",
	mobile_button_color: ".mobile-button:before, .mobile-button:after, .mobile-button span",
	featured_title_background: "#featured-title",
	featured_title_breadcrumbs_background: "#featured-title #breadcrumbs .breadcrumbs-inner:after",
	featured_title_heading_background: "#featured-title .main-title:after",
	wrapper_background_color: ".site-layout-boxed #wrapper",
	main_content_background: "#main-content",
	left_content_background: "#inner-content",
	right_content_background: ".sidebar-left #sidebar, .sidebar-right #sidebar",
	blog_entry_content_background: ".hentry .post-content-wrap",
	sidebar_widget_tags_background: "#sidebar .widget.widget_tag_cloud .tagcloud a",
	footer_background: "#footer",
	footer_widget_title_line_color: "#footer-widgets .widget .widget-title > span:after",
	footer_widget_tags_background: "#footer-widgets .widget.widget_tag_cloud .tagcloud a:after",
	bottom_background: "#bottom",
	project_related_background: ".project-related-wrap",
};

$.each( objBg, function( k, v ) {
	wp.customize(k, function(e) {
	    e.bind(function(e) {
	        var o = $(".customizer-" + k);
	        if (e) {
	            var t = '<style class="customizer-' + k + '">' + v + ' { background-color: ' + e + "; }</style>";
	            o.length ? o.replaceWith(t) : $("head").append(t)
	        } else o.remove()
	    })
	});
});

var objColor = {
	input_color: "textarea,input[type='text'],input[type='password'],input[type='datetime'],input[type='datetime-local'],input[type='date'],input[type='month'],input[type='time'],input[type='week'],input[type='number'],input[type='email'],input[type='url'],input[type='search'],input[type='tel'],input[type='color']",
	menu_link_color: ".header-style-1 #main-nav > ul > li > a",
	menu_link_color_hover: ".header-style-1 #main-nav > ul > li > a:hover",
	menu_two_link_color: ".header-style-2 #main-nav > ul > li > a",
	menu_two_link_color_hover: ".header-style-2 #main-nav > ul > li > a:hover",
	mobile_menu_color: "#main-nav-mobi ul > li > a",
	featured_title_breadcrumbs_color: "#featured-title #breadcrumbs",
	featured_title_breadcrumbs_link_color: "#featured-title #breadcrumbs a",
	featured_title_breadcrumbs_link_hover_color: "#featured-title #breadcrumbs a:hover",
	featured_title_heading_color: "#featured-title .main-title",
	blog_title_color: ".hentry .post-title a",
	blog_title_color_hover: ".hentry .post-title a:hover",
	blog_entry_meta_item_icon_color: ".hentry .post-meta .post-meta-content .item .inner:before",
	blog_entry_meta_item_color: ".hentry .post-meta .item",
	blog_entry_meta_item_link_color: ".hentry .post-meta .item a",
	blog_entry_meta_item_link_color_hover: ".hentry .post-meta .item a:hover",
	blog_excerpt_color: ".hentry .post-excerpt",
	sidebar_widget_title_color: "#sidebar .widget .widget-title",
	sidebar_widget_built_in_link_color: "#sidebar .widget.widget_categories ul li a, #sidebar .widget.widget_meta ul li a, #sidebar .widget.widget_pages ul li a, #sidebar .widget.widget_archive ul li a",
	sidebar_widget_search_form_icon_color: "#sidebar .widget.widget_search .search-form .search-submit:before",
	sidebar_widget_tags_color: "#sidebar .widget.widget_tag_cloud .tagcloud a",
	blog_single_title_color: ".hentry .post-content-single-wrap .post-title",
	blog_single_author_name_color: ".hentry .post-author .name",
	blog_single_author_text_color: ".hentry .post-author .author-desc > p",
	blog_single_comment_name_color: ".comment-author, .comment-author a",
	blog_single_comment_title_color: ".comments-area .comments-title, .comments-area .comment-reply-title",
	footer_text_color: "#footer-widgets .widget",
	footer_widget_title_color: "#footer-widgets .widget .widget-title",
	footer_widget_built_in_link_color: "#footer-widgets .widget.widget_categories ul li a, #footer-widgets .widget.widget_meta ul li a, #footer-widgets .widget.widget_pages ul li a, #footer-widgets .widget.widget_archive ul li a",
	footer_widget_search_form_icon_color: "#footer-widgets .widget.widget_search .search-form .search-submit:before",
	footer_widget_tags_color: "#footer-widgets .widget.widget_tag_cloud .tagcloud a",
	footer_widget_links_color: "#footer-widgets .widget.widget_links ul li a",
	bottom_color: "#bottom",
	bottom_link_color: "#bottom a, #bottom ul.bottom-nav > li > a",
	bottom_link_color_hover: "#bottom a:hover, #bottom ul.bottom-nav > li > a:hover"
}

$.each( objColor, function( k, v ) {
	wp.customize(k, function(e) {
	    e.bind(function(e) {
	        var o = $(".customizer-" + k);
	        if (e) {
	            var t = '<style class="customizer-' + k + '">' + v + ' { color: ' + e + "; }</style>";
	            o.length ? o.replaceWith(t) : $("head").append(t)
	        } else o.remove()
	    })
	});
});

var objBoderColor = {
	input_border_color: "textarea,input[type='text'],input[type='password'],input[type='datetime'],input[type='datetime-local'],input[type='date'],input[type='month'],input[type='time'],input[type='week'],input[type='number'],input[type='email'],input[type='url'],input[type='search'],input[type='tel'],input[type='color']",
	menu_border_color: ".header-style-2 #site-header .site-navigation-wrap",
	left_content_border_color: "#inner-content:after",
	right_content_border_color: ".sidebar-left #sidebar, .sidebar-right #sidebar",
	sidebar_widget_search_form_border_color: "#sidebar .widget.widget_search .search-form .search-field",
	sidebar_widget_tags_border: "#sidebar .widget.widget_tag_cloud .tagcloud a",
	blog_single_comment_form_border_color: ".name-wrap input, .email-wrap input, .message-wrap textarea",
	footer_widget_search_form_border_color: "#footer-widgets .widget.widget_search .search-form .search-field",
}

$.each( objBoderColor, function( k, v ) {
	wp.customize(k, function(e) {
	    e.bind(function(e) {
	        var o = $(".customizer-" + k);
	        if (e) {
	            var t = '<style class="customizer-' + k + '">' + v + ' { border-color: ' + e + "; }</style>";
	            o.length ? o.replaceWith(t) : $("head").append(t)
	        } else o.remove()
	    })
	});
});

var objBorderWidth = {
	input_border_width: "textarea,input[type='text'],input[type='password'],input[type='datetime'],input[type='datetime-local'],input[type='date'],input[type='month'],input[type='time'],input[type='week'],input[type='number'],input[type='email'],input[type='url'],input[type='search'],input[type='tel'],input[type='color']",
	menu_border_width: ".header-style-2 #site-header .site-navigation-wrap",
	left_content_border_width: "#inner-content:after",
	right_content_border_width: ".sidebar-left #sidebar, .sidebar-right #sidebar",
	sidebar_widget_search_form_border_width: "#sidebar .widget.widget_search .search-form .search-field",
	blog_single_comment_form_border_width: ".name-wrap input, .email-wrap input, .message-wrap textarea",
	footer_widget_search_form_border_width: "#footer-widgets .widget.widget_search .search-form .search-field",
}

$.each( objBorderWidth, function( k, v ) {
	wp.customize(k, function(e) {
	    e.bind(function(e) {
	        var o = $(".customizer-" + k);
	        if (e) {
	            var t = '<style class="customizer-' + k + '">' + v + ' { border-width: ' + e + "; }</style>";
	            o.length ? o.replaceWith(t) : $("head").append(t)
	        } else o.remove()
	    })
	});
});

var objBorderRadius = {
	input_border_rounded: "textarea,input[type='text'],input[type='password'],input[type='datetime'],input[type='datetime-local'],input[type='date'],input[type='month'],input[type='time'],input[type='week'],input[type='number'],input[type='email'],input[type='url'],input[type='search'],input[type='tel'],input[type='color']",
	right_content_border_rounded: ".sidebar-left #sidebar, .sidebar-right #sidebar",
	sidebar_widget_tags_rounded: "#sidebar .widget.widget_tag_cloud .tagcloud a",
	footer_widget_tags_rounded: "#footer-widgets .widget.widget_tag_cloud .tagcloud a:after",
	blog_single_comment_avatar_rounded: ".comment-list article .gravatar",
	blog_single_comment_form_rounded: ".name-wrap input, .email-wrap input, .message-wrap textarea",
}

$.each( objBorderRadius, function( k, v ) {
	wp.customize(k, function(e) {
	    e.bind(function(e) {
	        var o = $(".customizer-" + k);
	        if (e) {
	            var t = '<style class="customizer-' + k + '">' + v + ' { border-radius: ' + e + "; }</style>";
	            o.length ? o.replaceWith(t) : $("head").append(t)
	        } else o.remove()
	    })
	});
});

var objPadding = {
	header_search_icon_margin: '#site-header #header-search',
	header_cart_icon_margin: '.nav-top-cart-wrapper',
	site_layout_wrapper_margin: ".site-layout-boxed #wrapper",
	left_content_padding: "#inner-content",
	right_content_padding: ".sidebar-left #sidebar, .sidebar-right #sidebar",
	blog_entry_content_padding: ".hentry .post-content-wrap",
	sidebar_widget_built_in_list_padding: "#sidebar .widget.widget_categories ul li, #sidebar .widget.widget_meta ul li, #sidebar .widget.widget_pages ul li, #sidebar .widget.widget_archive ul li",
	sidebar_widget_tags_padding: "#sidebar .widget.widget_tag_cloud .tagcloud a",
	footer_widget_built_in_list_padding: "#footer-widgets .widget.widget_categories ul li, #footer-widgets .widget.widget_meta ul li, #footer-widgets .widget.widget_pages ul li, #footer-widgets .widget.widget_archive ul li",
	footer_widget_tags_padding: "#footer-widgets .widget.widget_tag_cloud .tagcloud a",
	footer_widget_links_padding: "#footer-widgets .widget.widget_links ul li",
	bottom_padding: "#bottom .bottom-bar-inner-wrap",
	project_related_padding:".project-related-wrap",
}

$.each( objPadding, function( k, v ) {
	wp.customize(k, function(e) {
	    e.bind(function(e) {
	        var o = $(".customizer-" + k);
	        if (e) {
	            var t = '<style class="customizer-' + k + '">' + v + ' { padding: ' + e + "; }</style>";
	            o.length ? o.replaceWith(t) : $("head").append(t)
	        } else o.remove()
	    })
	});
});

var objMargin = {
	blog_title_margin: ".hentry .post-title",
	blog_entry_meta_margin: ".hentry .post-meta",
	blog_excerpt_margin: ".hentry .post-excerpt",
	blog_single_author_margin: ".hentry .post-author",
	blog_single_title_margin: ".hentry .post-content-single-wrap .post-title",
	blog_single_meta_margin: ".hentry .post-content-single-wrap .post-meta",
	sidebar_widget_title_margin: "#sidebar .widget .widget-title",
	footer_widget_title_margin: "#footer-widgets .widget .widget-title",
}

$.each( objMargin, function( k, v ) {
	wp.customize(k, function(e) {
	    e.bind(function(e) {
	        var o = $(".customizer-" + k);
	        if (e) {
	            var t = '<style class="customizer-' + k + '">' + v + ' { margin: ' + e + "; }</style>";
	            o.length ? o.replaceWith(t) : $("head").append(t)
	        } else o.remove()
	    })
	});
});

// Logo 1 Margin
wp.customize("logo_margin", function(e) {
    e.bind(function(e) {
        var o = $(".customizer-logo_margin");
        if (e) {
            var t = '<style class="customizer-logo_margin">@media only screen and (min-width: 992px) { .header-style-1 #site-logo-inner { margin: ' + e + "; } }</style>";
            o.length ? o.replaceWith(t) : $("head").append(t)
        } else o.remove()
    })
});

// Logo 2 Margin
wp.customize("logotwo_margin", function(e) {
    e.bind(function(e) {
        var o = $(".customizer-logotwo_margin");
        if (e) {
            var t = '<style class="customizer-logotwo_margin">@media only screen and (min-width: 992px) { .header-style-2 #site-logo-inner { margin: ' + e + "; } }</style>";
            o.length ? o.replaceWith(t) : $("head").append(t)
        } else o.remove()
    })
});

var objWidth = {
	left_container_width: "#site-content",
	sidebar_width: ".sidebar-left #sidebar, .sidebar-right #sidebar",
	site_desktop_container_width: ".site-layout-full-width .vincent-container, .site-layout-boxed #page",
	blog_single_author_avatar_width: ".hentry .post-author .author-avatar, .hentry .post-author .author-avatar a",
	blog_single_comment_avatar_width: ".comment-list article .gravatar",
	footer_widget_title_line_width: "#footer-widgets .widget .widget-title > span:after",
}

$.each( objWidth, function( k, v ) {
	wp.customize(k, function(e) {
	    e.bind(function(e) {
	        var o = $(".customizer-" + k);
	        if (e) {
	            var t = '<style class="customizer-' + k + '">' + v + ' { width: ' + e + "; }</style>";
	            o.length ? o.replaceWith(t) : $("head").append(t)
	        } else o.remove()
	    })
	});
});

var objHeight = {
	footer_widget_title_line_height: "#footer-widgets .widget .widget-title > span:after",
}

$.each( objHeight, function( k, v ) {
	wp.customize(k, function(e) {
	    e.bind(function(e) {
	        var o = $(".customizer-" + k);
	        if (e) {
	            var t = '<style class="customizer-' + k + '">' + v + ' { height: ' + e + "; }</style>";
	            o.length ? o.replaceWith(t) : $("head").append(t)
	        } else o.remove()
	    })
	});
});

var objLineHeight = {
	menu_height: "#site-header #main-nav > ul > li > a",
}

$.each( objLineHeight, function( k, v ) {
	wp.customize(k, function(e) {
	    e.bind(function(e) {
	        var o = $(".customizer-" + k);
	        if (e) {
	            var t = '<style class="customizer-' + k + '">' + v + ' { height: ' + e + "; line-height: " + e + "; }</style>";
	            o.length ? o.replaceWith(t) : $("head").append(t)
	        } else o.remove()
	    })
	});
});

var objTopPadding = {
	header_top_padding: ".header-style-1 #site-header-inner",
	header_two_top_padding: ".header-style-2 #site-header-inner",
	featured_title_top_padding: "#featured-title .inner-wrap",
	main_content_top_padding: "#main-content",
	footer_top_padding: "#footer"
}

$.each( objTopPadding, function( k, v ) {
	wp.customize(k, function(e) {
	    e.bind(function(e) {
	        var o = $(".customizer-" + k);
	        if (e) {
	            var t = '<style class="customizer-' + k + '">' + v + ' { padding-top: ' + e + "; }</style>";
	            o.length ? o.replaceWith(t) : $("head").append(t)
	        } else o.remove()
	    })
	});
});

var objBottomPadding = {
	header_bottom_padding: ".header-style-1 #site-header-inner",
	header_two_bottom_padding: ".header-style-2 #site-header-inner",
	featured_title_bottom_padding: "#featured-title .inner-wrap",
	main_content_bottom_padding: "#main-content, .footer-has-subs #main-content",
	footer_bottom_padding: "#footer-widgets",
}

$.each( objBottomPadding, function( k, v ) {
	wp.customize(k, function(e) {
	    e.bind(function(e) {
	        var o = $(".customizer-" + k);
	        if (e) {
	            var t = '<style class="customizer-' + k + '">' + v + ' { padding-bottom: ' + e + "; }</style>";
	            o.length ? o.replaceWith(t) : $("head").append(t)
	        } else o.remove()
	    })
	});
});

var objLeftRightPadding = {
	menu_link_spacing: ".header-style-1 #main-nav > ul > li, .header-style-2 #main-nav > ul > li",
}

$.each( objLeftRightPadding, function( k, v ) {
	wp.customize(k, function(e) {
	    e.bind(function(e) {
	        var o = $(".customizer-" + k);
	        if (e) {
	            var t = '<style class="customizer-' + k + '">' + v + ' { padding-left: ' + e + "; padding-right: " + e + "; }</style>";
	            o.length ? o.replaceWith(t) : $("head").append(t)
	        } else o.remove()
	    })
	});
});

var objTopMargin = {
	sidebar_widget_bottom_margin: "#sidebar .widget",
	blog_entry_content_bottom_margin: ".hentry",
}

$.each( objTopMargin, function( k, v ) {
	wp.customize(k, function(e) {
	    e.bind(function(e) {
	        var o = $(".customizer-" + k);
	        if (e) {
	            var t = '<style class="customizer-' + k + '">' + v + ' { margin-top: ' + e + "; }</style>";
	            o.length ? o.replaceWith(t) : $("head").append(t)
	        } else o.remove()
	    })
	});
});

var objOpacity = {
	header_two_background_opacity: ".header-style-2 #site-header:after",
}

$.each( objOpacity, function( k, v ) {
	wp.customize(k, function(e) {
	    e.bind(function(e) {
	        var o = $(".customizer-" + k);
	        if (e) {
	            var t = '<style class="customizer-' + k + '">' + v + ' { opacity: ' + e + "; }</style>";
	            o.length ? o.replaceWith(t) : $("head").append(t)
	        } else o.remove()
	    })
	});
});

var objBottomMargin = {
	blog_single_comment_title_margin_bottom: ".comments-area .comments-title, .comments-area .comment-reply-title",
	blog_single_comment_article_margin_bottom: ".comment-list article",
	featured_title_heading_bottom_margin: "#featured-title.centered .title-group",
	blog_entry_meta_content_bottom_margin: ".post-meta-content-inner",
	shop_item_bottom_margin: ".woocommerce-page .content-woocommerce .products li",
}

$.each( objBottomMargin, function( k, v ) {
	wp.customize(k, function(e) {
	    e.bind(function(e) {
	        var o = $(".customizer-" + k);
	        if (e) {
	            var t = '<style class="customizer-' + k + '">' + v + ' { margin-bottom: ' + e + "; }</style>";
	            o.length ? o.replaceWith(t) : $("head").append(t)
	        } else o.remove()
	    })
	});
});

var objRightMargin = {
	blog_single_author_avatar_margin_right: ".hentry .post-author .author-avatar",
	blog_single_comment_avatar_margin_right: ".comment-list article .gravatar",
}

$.each( objRightMargin, function( k, v ) {
	wp.customize(k, function(e) {
	    e.bind(function(e) {
	        var o = $(".customizer-" + k);
	        if (e) {
	            var t = '<style class="customizer-' + k + '">' + v + ' { margin-right: ' + e + "; }</style>";
	            o.length ? o.replaceWith(t) : $("head").append(t)
	        } else o.remove()
	    })
	});
});

// Footer Widget Tag space between
wp.customize("footer_widget_tags_space_between", function(e) {
    e.bind(function(e) {
        var o = $(".customizer-footer_widget_tags_space_between");
        if (e) {
            var t = '<style class="customizer-footer_widget_tags_space_between">#footer-widgets .widget.widget_tag_cloud .tagcloud a { margin-right:' + e + "; margin-bottom: " + e + "; }</style>";
            o.length ? o.replaceWith(t) : $("head").append(t)
        } else o.remove()
    })
});

// Widget Tags space between
wp.customize("sidebar_widget_tags_space_between", function(e) {
    e.bind(function(e) {
        var o = $(".customizer-sidebar_widget_tags_space_between");
        if (e) {
            var t = '<style class="customizer-sidebar_widget_tags_space_between">#sidebar .widget.widget_tag_cloud .tagcloud a { margin-right:' + e + "; margin-bottom: " + e + "; }</style>";
            o.length ? o.replaceWith(t) : $("head").append(t)
        } else o.remove()
    })
});

// Mobile Logo Width
wp.customize("mobile_logo_width", function(e) {
    e.bind(function(e) {
        var o = $(".customizer-mobile_logo_width");
        if (e) {
            var t = '<style class="customizer-mobile_logo_width">@media only screen and (max-width: 991px) { #site-logo { max-width: ' + e + "; } }</style>";
            o.length ? o.replaceWith(t) : $("head").append(t)
        } else o.remove()
    })
});

// Mobile Logo Margin
wp.customize("mobile_logo_margin", function(e) {
    e.bind(function(e) {
        var o = $(".customizer-mobile_logo_margin");
        if (e) {
            var t = '<style class="customizer-mobile_logo_margin">@media only screen and (max-width: 991px) { #site-logo-inner { margin: ' + e + "; } }</style>";
            o.length ? o.replaceWith(t) : $("head").append(t)
        } else o.remove()
    })
});

// Mobile Menu Item height
wp.customize("mobile_menu_item_height", function(e) {
    e.bind(function(e) {
        var o = $(".customizer-mobile_menu_item_height");
        if (e) {
            var t = '<style class="customizer-mobile_menu_item_height">#main-nav-mobi ul > li > a, #main-nav-mobi .menu-item-has-children .arrow { line-height:' + e + "; }</style>";
            o.length ? o.replaceWith(t) : $("head").append(t)
        } else o.remove()
    })
});

// Site title Text
wp.customize('blogname', function( value ) { value.bind( function( newval ) { $( '.site-logo-text' ).text( newval ); }); });

// Copyright Text
wp.customize('bottom_copyright', function( value ) { value.bind( function( newval ) { $( '#copyright' ).html( newval ); }); });

// Bottom Right Content
wp.customize('bottom_right_content', function( value ) { value.bind( function( newval ) { $( '.bottom-bar-content' ).html( newval ); }); });

// Footer Gutter
wp.customize('footer_column_gutter', function( value ) {
	var widgets = $( '#footer-widgets' ).children('.footer-grid');
	value.bind( function( newval ) {
		var classes = widgets.attr("class").split(' ');
		if ( classes ) {
			$.each(classes, function(i, c) {
				if (c.indexOf("gutter-") == 0) {
					widgets.removeClass(c);
				}
			});
		}
		if ( newval ) {
			widgets.addClass( 'gutter-'+ newval );
		}
	});
});

} )( jQuery );
