<?php
/**
 * Solaris skin file for theme.
 */

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }

// Theme init
if (!function_exists('themerex_skin_theme_setup_solaris')) {
	add_action( 'themerex_action_init_theme', 'themerex_skin_theme_setup_solaris', 1 );
	function themerex_skin_theme_setup_solaris() {

		// Add skin fonts in the used fonts list
		add_filter('themerex_filter_used_fonts',			'themerex_filter_used_fonts_solaris');
		// Add skin fonts (from Google fonts) in the main fonts list (if not present).
		add_filter('themerex_filter_list_fonts',			'themerex_filter_list_fonts_solaris');

		// Add skin stylesheets
		add_action('themerex_action_add_styles',			'themerex_action_add_styles_solaris');
		// Add skin inline styles
		add_filter('themerex_filter_add_styles_inline',		'themerex_filter_add_styles_inline_solaris');
		// Add skin responsive styles
		add_action('themerex_action_add_responsive',		'themerex_action_add_responsive_solaris');
		// Add skin responsive inline styles
		add_filter('themerex_filter_add_responsive_inline',	'themerex_filter_add_responsive_inline_solaris');

		// Add skin scripts
		add_action('themerex_action_add_scripts',			'themerex_action_add_scripts_solaris');
		// Add skin scripts inline
		add_action('themerex_action_add_scripts_inline',	'themerex_action_add_scripts_inline_solaris');

		// Return main color (if not set in the theme options)
		add_filter('themerex_filter_get_main_color',		'themerex_filter_get_main_color_solaris', 10, 1);
		// Return accent color (if not set in the theme options)
		add_filter('themerex_filter_get_accent_color',			'themerex_filter_get_accent_color_solaris',  10, 1);
	}
}




//------------------------------------------------------------------------------
// Skin's fonts
//------------------------------------------------------------------------------

// Add skin fonts in the used fonts list
if (!function_exists('themerex_filter_used_fonts_solaris')) {
	//add_filter('themerex_filter_used_fonts', 'themerex_filter_used_fonts_solaris');
	function themerex_filter_used_fonts_solaris($theme_fonts) {
		$theme_fonts['Cabin'] = 1;
		$theme_fonts['Julius Sans One'] = 1;
		return $theme_fonts;
	}
}

// Add skin fonts (from Google fonts) in the main fonts list (if not present).
// To use custom font-face you not need add it into list in this function
// How to install custom @font-face fonts into the theme?
// All @font-face fonts are located in "theme_name/css/font-face/" folder in the separate subfolders for the each font. Subfolder name is a font-family name!
// Place full set of the font files (for each font style and weight) and css-file named stylesheet.css in the each subfolder.
// Create your @font-face kit by using Fontsquirrel @font-face Generator (http://www.fontsquirrel.com/fontface/generator)
// and then extract the font kit (with folder in the kit) into the "theme_name/css/font-face" folder to install
if (!function_exists('themerex_filter_list_fonts_solaris')) {
	//add_filter('themerex_filter_list_fonts', 'themerex_filter_list_fonts_solaris');
	function themerex_filter_list_fonts_solaris($list) {
		// Example:
		// if (!isset($list['Advent Pro'])) {
		//		$list['Advent Pro'] = array(
		//			'family' => 'sans-serif',																						// (required) font family
		//			'link'   => 'Advent+Pro:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic',	// (optional) if you use Google font repository
		//			'css'    => themerex_get_file_url('/css/font-face/Advent-Pro/stylesheet.css')									// (optional) if you use custom font-face
		//			);
		// }
		if (!isset($list['Roboto']))				$list['Roboto'] = array('family'=>'sans-serif');
		if (!isset($list['Love Ya Like A Sister']))	$list['Love Ya Like A Sister'] = array('family'=>'cursive', 'link'=>'Love+Ya+Like+A+Sister:400&subset=latin');
		return $list;
	}
}


//------------------------------------------------------------------------------
// Skin's stylesheets
//------------------------------------------------------------------------------
// Add skin stylesheets
if (!function_exists('themerex_action_add_styles_solaris')) {
	//add_action('themerex_action_add_styles', 'themerex_action_add_styles_solaris');
	function themerex_action_add_styles_solaris() {
		// Add stylesheet files
		themerex_enqueue_style( 'themerex-skin-style', themerex_get_file_url('skins/solaris/skin.css'), array(), null );
	}
}

// Add skin inline styles
if (!function_exists('themerex_filter_add_styles_inline_solaris')) {
	//add_filter('themerex_filter_add_styles_inline', 'themerex_filter_add_styles_inline_solaris');
	function themerex_filter_add_styles_inline_solaris($custom_style) {

		// Links color
		$clr = themerex_get_custom_option('main_color');
		if (!empty($clr)) {
			$rgb = themerex_hex2rgb($clr);
			$custom_style .= '
				a,
				.main_color,
				.bg_tint_dark a:hover,
				.bg_tint_light a:hover,
				a.accent_color:hover,
				.post_item_excerpt .tags_info a:hover,
				.post_item_extra .tags_info a:hover,
				.post_item_related .post_title a:hover,
				.isotope_item .tags_info a:hover,
				.isotope_wrap .isotope_item_grid .post_item .hover_wrap .hover_content a.hover:hover:before,
				.isotope_wrap .isotope_item_square .post_item .hover_wrap .hover_content a.hover:hover:before,
				.isotope_wrap .isotope_item_portfolio .post_item .hover_wrap .hover_content a.hover:hover:before,
				.isotope_wrap .isotope_item_alternative .post_item .hover_wrap .hover_content a.hover:hover:before,
				.isotope_filters a.active,
				.isotope_filters a:hover,
				.post_info_bottom a:hover,
				.content .post_info .post_info_counters span,
				.content .post_info a.post_counters_views,
				.content .post_info a:hover,
				.post_author .post_author_title a,
				.widget_area a,
				.widget_area ul li:before,
				.widget_area ul li a:hover,
				.widget_area button:before,
				.widget_area .post_title a:hover,
				.widget_area .widget_text a:hover,
				.widget_area .post_info a:hover,
				.post_info .post_info_counters .post_counters_item:before,
				.post_info .post_info_counters .post_counters_likes.disabled,
				.widget_area .post_item .post_info .post_info_author:hover,
				.widget_area.bg_tint_dark ul li:before,
				.widget_area.bg_tint_dark ul li a:hover,
				.widget_area.bg_tint_dark button:before,
				.widget_area.bg_tint_dark .post_title a:hover,
				.widget_area.bg_tint_dark .widget_text a:hover,
				.widget_area.bg_tint_dark .post_info a:hover,
				.widget_area .widget_search .search_button:hover:before,
				.user-popUp .formItems .popup_form .popup_form_field.icon:before,
				.sc_accordion.sc_accordion_style_1 .sc_accordion_item .sc_accordion_title.ui-state-active,
				.sc_accordion.sc_accordion_style_1 .sc_accordion_item .sc_accordion_title:hover,
				.sc_audio .sc_audio_author_name,
				.sc_button.sc_button_style_border,
				.sc_button.sc_button_style_border.sc_button_bg_custom:before,
				.sc_button.sc_button_style_border.sc_button_bg_color:before,
				.sc_dropcaps.sc_dropcaps_style_1 .sc_dropcaps_item,
				.sc_emailer .sc_emailer_button:hover,
				blockquote.sc_quote.style_1:before,
				.sc_list_style_iconed li:before,
				.sc_list_style_iconed .sc_list_icon,
				.sc_scroll_controls_wrap a:hover,
				.sc_slider_controls_wrap a:hover,
				.sc_team_style_1 .sc_team_item .sc_team_heading .sc_team_item_title a:hover,
				.sc_team_style_2 .sc_team_item .sc_team_item_title a:hover,
				.sc_toggles.sc_toggles_style_1 .sc_toggles_item .sc_toggles_title.ui-state-active,
				.sc_toggles.sc_toggles_style_1 .sc_toggles_item .sc_toggles_title:hover,
				.sc_toggles.sc_toggles_style_2 .sc_toggles_item .sc_toggles_title.ui-state-active,
				.sc_toggles.sc_toggles_style_2 .sc_toggles_item .sc_toggles_title.ui-state-active .sc_toggles_icon,
				.bg_tint_light .sc_twitter .sc_slider_controls_wrap a:hover,
				.picker__button--close:before,
				.sc_button.sc_button_style_border.sc_button_bg_white_2:before
				'.(!themerex_exists_woocommerce() ? '' : ',
					/* WooCommerce styles */
					.woocommerce .woocommerce-message:before, .woocommerce-page .woocommerce-message:before,
					.woocommerce div.product span.price, .woocommerce div.product p.price, .woocommerce #content div.product span.price, .woocommerce #content div.product p.price, .woocommerce-page div.product span.price, .woocommerce-page div.product p.price, .woocommerce-page #content div.product span.price, .woocommerce-page #content div.product p.price,.woocommerce ul.products li.product .price,.woocommerce-page ul.products li.product .price,
					.woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce #content input.button.alt:hover, .woocommerce-page a.button.alt:hover, .woocommerce-page button.button.alt:hover, .woocommerce-page input.button.alt:hover, .woocommerce-page #respond input#submit.alt:hover, .woocommerce-page #content input.button.alt:hover,
					.woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce #content input.button:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page #content input.button:hover,
					.woocommerce .quantity input[type="button"]:hover, .woocommerce #content input[type="button"]:hover, .woocommerce-page .quantity input[type="button"]:hover, .woocommerce-page #content .quantity input[type="button"]:hover,
					.woocommerce ul.cart_list li > .amount, .woocommerce ul.product_list_widget li > .amount, .woocommerce-page ul.cart_list li > .amount, .woocommerce-page ul.product_list_widget li > .amount,
					.woocommerce ul.cart_list li span .amount, .woocommerce ul.product_list_widget li span .amount, .woocommerce-page ul.cart_list li span .amount, .woocommerce-page ul.product_list_widget li span .amount,
					.woocommerce ul.cart_list li ins .amount, .woocommerce ul.product_list_widget li ins .amount, .woocommerce-page ul.cart_list li ins .amount, .woocommerce-page ul.product_list_widget li ins .amount,
					.woocommerce.widget_shopping_cart .total .amount, .woocommerce .widget_shopping_cart .total .amount, .woocommerce-page.widget_shopping_cart .total .amount, .woocommerce-page .widget_shopping_cart .total .amount,
					.woocommerce a:hover h3, .woocommerce-page a:hover h3,
					.woocommerce .cart-collaterals .order-total strong, .woocommerce-page .cart-collaterals .order-total strong,
					.woocommerce .checkout #order_review .order-total .amount, .woocommerce-page .checkout #order_review .order-total .amount,
					.woocommerce .star-rating, .woocommerce-page .star-rating, .woocommerce .star-rating:before, .woocommerce-page .star-rating:before,
					.widget_area .widgetWrap ul > li .star-rating span, .woocommerce #review_form #respond .stars a, .woocommerce-page #review_form #respond .stars a,
					.woocommerce .summary .price,
					.woocommerce-page .summary .price,
					.woocommerce ul.products li.product .price,
					.woocommerce-page ul.products li.product .price,
					ul.products li.product .price,
					.woocommerce-product-rating .woocommerce-review-link:hover,
					.woocommerce-page .woocommerce-product-rating .woocommerce-review-link:hover,
					.woocommerce .product_meta a:hover,
					header .sidebar_cart ul.cart_list li > a:hover,
					.woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit:hover, .woocommerce #content input.button:hover, .woocommerce-page a.button:hover, .woocommerce-page button.button:hover, .woocommerce-page input.button:hover, .woocommerce-page #respond input#submit:hover, .woocommerce-page #content input.button:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit.alt:hover, .woocommerce #content input.button.alt:hover, .woocommerce-page a.button.alt:hover, .woocommerce-page button.button.alt:hover, .woocommerce-page input.button.alt:hover, .woocommerce-page #respond input#submit.alt:hover, .woocommerce-page #content input.button.alt:hover,
					.woocommerce ul.products li.product .add_to_cart_button:hover,
					.woocommerce-page ul.products li.product .add_to_cart_button:hover,
					ul.products li.product .star-rating:before,
					ul.products li.product .star-rating span,
					.woocommerce ul.products li.product h3 a:hover,
					.woocommerce-page ul.products li.product h3 a:hover,
					.products .product_cats a:hover
				').'
				{
					color:'.esc_attr($clr).';
				}


				input[type="submit"]:hover,
				input[type="button"]:hover,
				button:hover,
				.sc_button.sc_button_style_filled:hover
				'.(!themerex_exists_woocommerce() ? '' : ',
					/* WooCommerce styles */
					header .sidebar_cart .widget_shopping_cart_content .cart_list li a.remove:hover,
					.woocommerce a.remove,
					.woocommerce a.remove:hover
				').'
				{
					color:'.esc_attr($clr).' !important;
				}


				.main_color_bgc,
				.sc_table table tr:first-child,
				.menu_user_wrap .menu_user_nav > li ul li a:hover,
				.menu_user_wrap .menu_user_nav > li ul li.current-menu-item > a,
				.menu_user_wrap .menu_user_nav > li ul li.current-menu-ancestor > a,
				.menu_user_wrap .menu_user_nav > li.menu_user_register,
				.menu_user_wrap .menu_user_nav > li.menu_user_login,
				.menu_user_wrap .menu_user_nav > li.menu_user_logout,
				.post_format_link .post_descr:before,
				.pagination_single > .pager_numbers,
				.pagination_single a:hover,
				.pagination_slider .pager_cur:hover,
				.pagination_slider .pager_cur:focus,
				.pagination_pages > .active,
				.pagination_pages > a:hover,
				.pagination_wrap .pager_next:hover,
				.pagination_wrap .pager_prev:hover,
				.pagination_wrap .pager_last:hover,
				.pagination_wrap .pager_first:hover,
				.widget_area .widget_calendar td a:hover,
				.widget_area .widget_calendar .today .day_wrap,
				.widget_area .widget_product_tag_cloud a:hover,
				.widget_area .widget_tag_cloud a:hover,
				.scroll_to_top,
				a.tribe-events-read-more:hover,
				.tribe-events-button:hover,
				.tribe-events-nav-previous a:hover,
				.tribe-events-nav-next a:hover,
				.tribe-events-widget-link a:hover,
				.tribe-events-viewmore a:hover,
				.sc_accordion.sc_accordion_style_1 .sc_accordion_item .sc_accordion_title.ui-state-active .sc_accordion_icon_opened,
				.sc_accordion.sc_accordion_style_1 .sc_accordion_item .sc_accordion_title:hover .sc_accordion_icon_opened,
				.sc_accordion.sc_accordion_style_1 .sc_accordion_item .sc_accordion_title:hover .sc_accordion_icon_closed,
				.sc_accordion.sc_accordion_style_2 .sc_accordion_item .sc_accordion_title.ui-state-active,
				.sc_accordion.sc_accordion_style_2 .sc_accordion_item .sc_accordion_title.ui-state-active .sc_accordion_icon_opened,
				.sc_accordion.sc_accordion_style_2 .sc_accordion_item .sc_accordion_title:hover .sc_accordion_icon_opened,
				.sc_accordion.sc_accordion_style_2 .sc_accordion_item .sc_accordion_title:hover .sc_accordion_icon_closed,
				input[type="submit"],
				input[type="button"],
				button,
				.sc_button.sc_button_style_filled,
				.sc_button.sc_button_style_filled.sc_button_bg_color,
				.sc_dropcaps.sc_dropcaps_style_3 .sc_dropcaps_item,
				.sc_highlight_style_1,
				blockquote.sc_quote.style_2:before,
				.sc_price_block.sc_price_block_style_2,
				.widget_area .sc_tabs.sc_tabs_style_2 .sc_tabs_titles li a:hover,
				.widget_area .sc_tabs.sc_tabs_style_2 .sc_tabs_titles li.ui-state-active a,
				.sc_toggles.sc_toggles_style_1 .sc_toggles_item .sc_toggles_title.ui-state-active .sc_toggles_icon_opened,
				.sc_toggles.sc_toggles_style_1 .sc_toggles_item .sc_toggles_title:hover .sc_toggles_icon_opened,
				.sc_toggles.sc_toggles_style_2 .sc_toggles_item .sc_toggles_title .sc_toggles_icon,
				.sc_tooltip_parent .sc_tooltip,
				.sc_tooltip_parent .sc_tooltip:before,
				.sc_button.sc_button_style_filled.sc_button_bg_color,
				.sc_button.sc_button_style_filled.sc_button_bg_color:after,
				.sc_button.sc_button_style_filled.sc_button_bg_color_2:hover:after,
				.sc_button.sc_button_style_filled.sc_button_bg_color_2:active:after,
				.sc_button.sc_button_style_filled.sc_button_bg_white_2
				'.(!themerex_exists_woocommerce() ? '' : ',
					/* WooCommerce styles */
					.woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce #content input.button.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page #content input.button.alt,
					.woocommerce ul.products li.product .add_to_cart_button,
					.woocommerce-page ul.products li.product .add_to_cart_button,
					.woocommerce span.new, .woocommerce-page span.new,
					.woocommerce span.onsale, .woocommerce-page span.onsale
				').'
				{
					background-color: '.esc_attr($clr).';
				}

				.sc_price_block.sc_price_block_style_3 .sc_price_block_link .sc_button:hover,
				.sc_button.sc_button_style_filled.sc_button_bg_color_2:hover {
					background-color: '.esc_attr($clr).' !important;
				}

				::selection {
					background-color: '.esc_attr($clr).';
				}
				::-moz-selection {
					background-color: '.esc_attr($clr).';
				}


				.main_color_bg,
				.photostack nav span:hover,
				.photostack nav span.current,
				#bbpress-forums div.bbp-topic-content a,
				#buddypress button, #buddypress a.button, #buddypress input[type="submit"], #buddypress input[type="button"], #buddypress input[type="reset"], #buddypress ul.button-nav li a, #buddypress div.generic-button a, #buddypress .comment-reply-link, a.bp-title-button, #buddypress div.item-list-tabs ul li.selected a
				{
					background: '.esc_attr($clr).';
				}


				.main_color_border,
				.sc_table table tr:first-child th,
				pre.code,
				#toc .toc_item.current,
				#toc .toc_item:hover,
				.isotope_filters a.active,
				.isotope_filters a:hover,
				.pagination_single > .pager_numbers,
				.pagination_single a:hover,
				.pagination_slider .pager_cur:hover,
				.pagination_slider .pager_cur:focus,
				.pagination_pages > .active,
				.pagination_pages > a:hover,
				.pagination_wrap .pager_next:hover,
				.pagination_wrap .pager_prev:hover,
				.pagination_wrap .pager_last:hover,
				.pagination_wrap .pager_first:hover,
				.post_info_bottom a:hover,
				.widget_area .widget_product_tag_cloud a:hover,
				.widget_area .widget_tag_cloud a:hover,
				.sc_accordion.sc_accordion_style_1 .sc_accordion_item .sc_accordion_title.ui-state-active,
				.sc_accordion.sc_accordion_style_1 .sc_accordion_item .sc_accordion_title.ui-state-active .sc_accordion_icon_opened,
				.sc_accordion.sc_accordion_style_1 .sc_accordion_item .sc_accordion_title:hover .sc_accordion_icon_opened,
				.sc_accordion.sc_accordion_style_1 .sc_accordion_item .sc_accordion_title:hover .sc_accordion_icon_closed,
				.sc_accordion.sc_accordion_style_1 .sc_accordion_item .sc_accordion_title:hover,
				.sc_accordion.sc_accordion_style_2 .sc_accordion_item .sc_accordion_title.ui-state-active,
				.sc_accordion.sc_accordion_style_2 .sc_accordion_item .sc_accordion_title.ui-state-active .sc_accordion_icon_opened,
				.sc_accordion.sc_accordion_style_2 .sc_accordion_item .sc_accordion_title:hover .sc_accordion_icon_opened,
				.sc_accordion.sc_accordion_style_2 .sc_accordion_item .sc_accordion_title:hover .sc_accordion_icon_closed,
				input[type="submit"],
				input[type="button"],
				button,
				.sc_button.sc_button_style_filled,
				.sc_button.sc_button_style_filled.sc_button_bg_color,
				.sc_scroll_controls_wrap a:hover,
				.widget_area .sc_tabs.sc_tabs_style_2 .sc_tabs_titles li a:hover,
				.widget_area .sc_tabs.sc_tabs_style_2 .sc_tabs_titles li.ui-state-active a,
				.sc_toggles.sc_toggles_style_1 .sc_toggles_item .sc_toggles_title.ui-state-active,
				.sc_toggles.sc_toggles_style_1 .sc_toggles_item .sc_toggles_title:hover,
				.sc_toggles.sc_toggles_style_2 .sc_toggles_item .sc_toggles_title .sc_toggles_icon,
				.picker__day--today:before,
				.picker__button--today:before,
				.picker__button--clear:before,
				.sc_contact_form_order .sc_contact_form_button button:focus,
				.sc_button.sc_button_style_filled.sc_button_bg_color,
				.sc_button.sc_button_style_filled.sc_button_bg_white_2
				'.(!themerex_exists_woocommerce() ? '' : ',
					/* WooCommerce styles */
					.woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit, .woocommerce #content input.button, .woocommerce-page a.button, .woocommerce-page button.button, .woocommerce-page input.button, .woocommerce-page #respond input#submit, .woocommerce-page #content input.button, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit.alt, .woocommerce #content input.button.alt, .woocommerce-page a.button.alt, .woocommerce-page button.button.alt, .woocommerce-page input.button.alt, .woocommerce-page #respond input#submit.alt, .woocommerce-page #content input.button.alt,
					.woocommerce ul.products li.product .add_to_cart_button,
					.woocommerce-page ul.products li.product .add_to_cart_button
				').'
				{
					border-color: '.esc_attr($clr).'; 
				}

				.sc_tabs.sc_tabs_style_2 .sc_tabs_titles li a:hover,
				.sc_tabs.sc_tabs_style_2 .sc_tabs_titles li.ui-state-active a {
					border-right-color: '.esc_attr($clr).';
				}

				input[type="submit"]:hover,
				input[type="button"]:hover,
				button:hover,
				.sc_button.sc_button_style_filled:hover,
				.sc_button.sc_button_style_filled.sc_button_bg_color_2:hover
				{
					border-color: '.esc_attr($clr).' !important;
				}

				.hover_wrap .hover_link:hover:before,
				.sc_button.sc_button_style_border.sc_button_bg_custom:hover:before,
				.sc_button.sc_button_style_border.sc_button_bg_color:hover:before,
				.sc_button.sc_button_style_border.sc_button_bg_white_2:hover:before {
					box-shadow: 0 0 0 35px '.esc_attr($clr).' inset;
				}

				.sc_button.sc_button_style_border.sc_button_bg_custom:before,
				.sc_button.sc_button_style_border.sc_button_bg_color:before,
				.sc_button.sc_button_style_border.sc_button_bg_white_2:before {
				    box-shadow: 0 0 0 2px '.esc_attr($clr).' inset;
			    }
			';
		}




		// Accent color
		$clr = themerex_get_custom_option('accent_color');
		if (!empty($clr)) {
			$rgb = themerex_hex2rgb($clr);
			$custom_style .= '
				.accent_color,
				.link_light,
				.bg_tint_light a,
				.bg_tint_light h1, .bg_tint_light h2, .bg_tint_light h3, .bg_tint_light h4, .bg_tint_light h5, .bg_tint_light h6,
				.bg_tint_light h1 a, .bg_tint_light h2 a, .bg_tint_light h3 a, .bg_tint_light h4 a, .bg_tint_light h5 a, .bg_tint_light h6 a,
				.menu_main_wrap .menu_main_nav > li ul li a:hover,
				.menu_main_wrap .menu_main_nav > li ul li.current-menu-item > a,
				.menu_main_wrap .menu_main_nav > li ul li.current-menu-ancestor > a,
				.search_wrap.search_style_regular .search_form_wrap .search_submit,
				.search_wrap.search_style_regular .search_icon,
				.search_results .post_more,
				.search_results .search_results_close,
				.page_top_wrap .breadcrumbs a.breadcrumbs_item:hover,
				.page_top_wrap .breadcrumbs .breadcrumbs_item.home,
				.top_panel_style_dark.article_style_boxed .page_top_wrap .breadcrumbs a.breadcrumbs_item:hover,
				.post_item_excerpt .post_title a,
				.post_item_extra .post_title a,
				.isotope_wrap .isotope_item .post_title a,
				.reviews_block .reviews_item:nth-child(3n+1) .reviews_stars_hover,
				.reviews_block .reviews_item:nth-child(3n+2) .reviews_stars_hover,
				.reviews_block .reviews_item:nth-child(3n+3) .reviews_stars_hover,
				.comments_list_wrap .comment_info > span.comment_author,
				.widget_area .post_title a,
				.widget_area .widget_rss li > a,
				.widget_area .widget_calendar .month_cur,
				.user-popUp .formItems .popup_form .login_field.popup_form_field.icon:before,
				.sc_oblique_wrap h4,
				.sc_oblique_wrap h3,
				.sc_audio .sc_audio_title,
				.sc_button.sc_button_style_border.sc_button_bg_link,
				.sc_button.sc_button_style_border.sc_button_bg_link:before,
				.sc_dropcaps.sc_dropcaps_style_2 .sc_dropcaps_item,
				.sc_image_wrap figcaption,
				.sc_image_wrap figcaption a,
				.sc_team_item .sc_team_heading .sc_team_item_title,
				.sc_team_item .sc_team_heading .sc_team_item_title a,
				.sc_team_item .sc_team_item_title,
				.sc_team_item .sc_team_item_title a,
				.sc_testimonials.style_2 .sc_testimonial_author a,
				.sc_title_icon,
				.picker__month,
				.picker__year,
				.sc_button.sc_button_style_border.sc_button_bg_color_2:before,
				.sc_button.sc_button_style_border.sc_button_bg_white:before
				'.(!themerex_exists_woocommerce() ? '' : ',
					/* WooCommerce styles */
					.woocommerce div.product .product_title,
					ul.products li.product h3 a,
					ul.products li.product h3 a,
					ul.products li.product .price,
					ul.products li.product .price,
					.woocommerce nav.woocommerce-pagination ul li a:focus,
					.woocommerce nav.woocommerce-pagination ul li a:hover,
					.woocommerce nav.woocommerce-pagination ul li span.current
				').'
				{
					color:'.esc_attr($clr).';
				}



				.sc_button.sc_button_style_filled.sc_button_bg_link:hover
				{
					color:'.esc_attr($clr).' !important;
				}


				.accent_color_bgc,
				.top_panel_fixed.top_panel_over.top_panel_opacity_transparent .top_panel_wrap,
				.menu_user_wrap .menu_user_nav > li,
				.menu_user_wrap .menu_user_nav > li ul,
				.menu_main_wrap .menu_main_nav_area .menu_main_responsive,
				.menu_main_wrap .menu_main_nav_area .menu_main_responsive a:hover,
				.user-popUp.account_wrap .user_cart,
				.pagination_viewmore > a,
				.viewmore_loader,
				.mfp-preloader span,
				.sc_video_frame.sc_video_active:before,
				.post_featured .post_nav_item:before,
				.post_featured .post_nav_item .post_nav_info,
				.tribe-events-calendar thead th,
				a.tribe-events-read-more,
				.tribe-events-button,
				.tribe-events-nav-previous a,
				.tribe-events-nav-next a,
				.tribe-events-widget-link a,
				.tribe-events-viewmore a,
				.sc_button.sc_button_style_filled.sc_button_bg_link,
				.sc_button.sc_button_style_filled.sc_button_bg_color_2,
				.sc_button.sc_button_style_filled.sc_button_bg_color_2:after,
				.sc_button.sc_button_style_filled.sc_button_bg_color:hover:after,
				.sc_button.sc_button_style_filled.sc_button_bg_color:active:after,
				.sc_button.sc_button_style_filled.sc_button_bg_white,
				.sc_blogger.layout_date .sc_blogger_item .sc_blogger_date,
				.sc_dropcaps.sc_dropcaps_style_4 .sc_dropcaps_item,
				.sc_highlight_style_2,
				.sc_price_block.sc_price_block_style_1,
				.sc_skills_bar .sc_skills_item .sc_skills_count,
				.sc_skills_counter .sc_skills_item.sc_skills_style_3 .sc_skills_count,
				.sc_skills_counter .sc_skills_item.sc_skills_style_4 .sc_skills_count,
				.sc_skills_counter .sc_skills_item.sc_skills_style_4 .sc_skills_info,
				.sc_scroll_bar .swiper-scrollbar-drag:before
				'.(!themerex_exists_woocommerce() ? '' : ',
					/* WooCommerce styles */
					.reviews_block .reviews_max_level_100:nth-child(3n+1) .reviews_stars_hover,
					.reviews_block .reviews_item:nth-child(3n+1) .reviews_slider ,
					.reviews_block .reviews_max_level_100:nth-child(3n+2) .reviews_stars_hover,
					.reviews_block .reviews_item:nth-child(3n+2) .reviews_slider,
					.reviews_block .reviews_max_level_100:nth-child(3n+3) .reviews_stars_hover,
					.reviews_block .reviews_item:nth-child(3n+3) .reviews_slider,
					.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
					.woocommerce-page .widget_price_filter .ui-slider .ui-slider-range,
					.woocommerce nav.woocommerce-pagination ul li a,
					.woocommerce nav.woocommerce-pagination ul li span.current
				').'
				{
					background-color: '.esc_attr($clr).';
				}


				.custom_options #co_toggle,
				.sc_button.sc_button_style_filled.sc_button_bg_color:hover,
				.sc_contact_form_order .sc_contact_form_button button:hover
				{
					background-color: '.esc_attr($clr).' !important;
				}


				.accent_color_bg,
				.widget_area .widget_calendar .weekday,
				.picker__wrap,
				#bbpress-forums div.bbp-topic-content a,
				#buddypress button, #buddypress a.button, #buddypress input[type="submit"],
				#buddypress input[type="button"], #buddypress input[type="reset"],
				#buddypress ul.button-nav li a, #buddypress div.generic-button a,
				#buddypress .comment-reply-link, a.bp-title-button,
				#buddypress div.item-list-tabs ul li.selected a
				'.(!themerex_exists_woocommerce() ? '' : ',
					/* WooCommerce styles */
					.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
					.woocommerce-page .widget_price_filter .ui-slider .ui-slider-handle
				').'
				{
					background: '.esc_attr($clr).';
				}


				.accent_color_border,
				.search_wrap.search_style_regular.search_opened,
				.content .search_wrap.search_style_regular,
				.menu_user_wrap .search_wrap,
				.pagination > a,
				.post_format_aside.post_item_single .post_content p,
				.post_format_aside .post_descr,
				.sc_button.sc_button_style_filled.sc_button_bg_link,
				.sc_button.sc_button_style_filled.sc_button_bg_color_2,
				.sc_button.sc_button_style_filled.sc_button_bg_white,
				.sc_blogger.layout_date .sc_blogger_item .sc_blogger_date,
				.sc_dropcaps.sc_dropcaps_style_2 .sc_dropcaps_item,
				.sc_skills_bar .sc_skills_item .sc_skills_count,
				.sc_team_style_2 .sc_team_item a.sc_team_item_avatar:hover
				'.(!themerex_exists_woocommerce() ? '' : ',
					/* WooCommerce styles */
					.woocommerce nav.woocommerce-pagination ul li a,
					.woocommerce nav.woocommerce-pagination ul li span.current
				').'
				{
					border-color: '.esc_attr($clr).'; 
				}

				.sc_button.sc_button_style_filled.sc_button_bg_link:hover,
				.sc_button.sc_button_style_filled.sc_button_bg_color:hover,
				.sc_contact_form_order .sc_contact_form_button button:hover
				{
					border-color: '.esc_attr($clr).' !important;
				}

				'.(!themerex_exists_woocommerce() ? '' : '
					.woocommerce .woocommerce-message, .woocommerce-page .woocommerce-message {
						border-top-color: '.esc_attr($clr).';
					}
				').'

				.sc_button.sc_button_style_border.sc_button_bg_color_2:before,
				.sc_button.sc_button_style_border.sc_button_bg_white:before,
				.sc_button.sc_button_style_border.sc_button_bg_link:before {
				    box-shadow: 0 0 0 2px '.esc_attr($clr).' inset;
			    }
				.sc_button.sc_button_style_border.sc_button_bg_color_2:hover:before,
				.sc_button.sc_button_style_border.sc_button_bg_white:hover:before,
				.sc_button.sc_button_style_border.sc_button_bg_link:hover:before {
			        box-shadow: 0 0 0 35px '.esc_attr($clr).' inset;
			    }


				.sc_countdown.sc_countdown_style_2 .sc_countdown_separator,
				.sc_countdown.sc_countdown_style_2 .sc_countdown_label {
					color: rgba('.(int)$rgb['r'].','.(int)$rgb['g'].','.(int)$rgb['b'].', 0.8);
				}

				.sc_slider_swiper .sc_slider_info {
					background-color: rgba('.(int)$rgb['r'].','.(int)$rgb['g'].','.(int)$rgb['b'].', 0.8) !important;
				}

				.picker__weekday {
					background: rgba('.(int)$rgb['r'].','.(int)$rgb['g'].','.(int)$rgb['b'].', 0.6) !important;
				}

				.sc_team_style_1 .sc_team_item .hover_mask {
				    background: rgba('.(int)$rgb['r'].','.(int)$rgb['g'].','.(int)$rgb['b'].', 0.7);
				}

				.sc_countdown.sc_countdown_style_2 .sc_countdown_digits span {
					background-color: rgba('.(int)$rgb['r'].','.(int)$rgb['g'].','.(int)$rgb['b'].', 0.5);
				}
			';
		}


		return $custom_style;
	}
}

// Add skin responsive styles
if (!function_exists('themerex_action_add_responsive_solaris')) {
	//add_action('themerex_action_add_responsive', 'themerex_action_add_responsive_solaris');
	function themerex_action_add_responsive_solaris() {
		if (file_exists(themerex_get_file_dir('skins/solaris/skin-responsive.css')))
			themerex_enqueue_style( 'theme-skin-responsive-style', themerex_get_file_url('skins/solaris/skin-responsive.css'), array(), null );
	}
}

// Add skin responsive inline styles
if (!function_exists('themerex_filter_add_responsive_inline_solaris')) {
	//add_filter('themerex_filter_add_responsive_inline', 'themerex_filter_add_responsive_inline_solaris');
	function themerex_filter_add_responsive_inline_solaris($custom_style) {
		return $custom_style;	
	}
}


//------------------------------------------------------------------------------
// Skin's scripts
//------------------------------------------------------------------------------

// Add skin scripts
if (!function_exists('themerex_action_add_scripts_solaris')) {
	//add_action('themerex_action_add_scripts', 'themerex_action_add_scripts_solaris');
	function themerex_action_add_scripts_solaris() {
		if (file_exists(themerex_get_file_dir('skins/solaris/skin.js')))
			themerex_enqueue_script( 'theme-skin-script', themerex_get_file_url('skins/solaris/skin.js'), array(), null );
		if (themerex_get_theme_option('show_theme_customizer') == 'yes' && file_exists(themerex_get_file_dir('skins/solaris/skin.customizer.js')))
			themerex_enqueue_script( 'theme-skin-customizer-script', themerex_get_file_url('skins/solaris/skin.customizer.js'), array(), null );
	}
}

// Add skin scripts inline
if (!function_exists('themerex_action_add_scripts_inline_solaris')) {
	//add_action('themerex_action_add_scripts_inline', 'themerex_action_add_scripts_inline_solaris');
	function themerex_action_add_scripts_inline_solaris() {
		echo '<script type="text/javascript">'
			. 'jQuery(document).ready(function() {'
			. "if (THEMEREX_GLOBALS['theme_font']=='') THEMEREX_GLOBALS['theme_font'] = 'Cabin';"
			. "THEMEREX_GLOBALS['main_color'] = '" . apply_filters('themerex_filter_get_main_color', themerex_get_custom_option('main_color')) . "';"
			. "THEMEREX_GLOBALS['accent_color'] = '" . apply_filters('themerex_filter_get_accent_color', themerex_get_custom_option('accent_color')) . "';"
			. "});"
			. "</script>";
	}
}


//------------------------------------------------------------------------------
// Get skin's colors
//------------------------------------------------------------------------------


// Return main theme bg color
if (!function_exists('themerex_filter_get_theme_bgcolor_solaris')) {
	//add_filter('themerex_filter_get_theme_bgcolor', 'themerex_filter_get_theme_bgcolor_solaris', 10, 1);
	function themerex_filter_get_theme_bgcolor_solaris($clr) {
		//return '#ffffff';
		return empty($clr) ? '#ffffff' : $clr;
	}
}

// Return main color (if not set in the theme options)
if (!function_exists('themerex_filter_get_main_color_solaris')) {
	//add_filter('themerex_filter_get_main_color', 'themerex_filter_get_main_color_solaris', 10, 1);
	function themerex_filter_get_main_color_solaris($clr) {
		return empty($clr) ? '#f15a23' : $clr;
	}
}

// Return accent color (if not set in the theme options)
if (!function_exists('themerex_filter_get_accent_color_solaris')) {
	//add_filter('themerex_filter_get_accent_color', 'themerex_filter_get_accent_color_solaris', 10, 1);
	function themerex_filter_get_accent_color_solaris($clr) {
		return empty($clr) ? '#63cac5' : $clr;
	}
}
?>