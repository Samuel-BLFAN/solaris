<?php 
global $THEMEREX_GLOBALS;
if (empty($THEMEREX_GLOBALS['menu_user'])) 
	$THEMEREX_GLOBALS['menu_user'] = themerex_get_nav_menu('menu_user');
if (empty($THEMEREX_GLOBALS['menu_user'])) {
	?>
	<ul id="menu_user" class="menu_user_nav">
    <?php
} else {
	$menu = themerex_substr($THEMEREX_GLOBALS['menu_user'], 0, themerex_strlen($THEMEREX_GLOBALS['menu_user'])-5);
	$pos = themerex_strpos($menu, '<ul');
	if ($pos!==false) $menu = themerex_substr($menu, 0, $pos+3) . ' class="menu_user_nav"' . themerex_substr($menu, $pos+3);
	echo str_replace('class=""', '', $menu);
}
?>

<?php if (themerex_is_woocommerce_page() && themerex_get_custom_option('show_currency')=='yes') { ?>
	<li class="menu_user_currency">
		<a href="#">$</a>
		<ul>
			<li><a href="#"><b>&#36;</b> <?php _e('Dollar', 'themerex'); ?></a></li>
			<li><a href="#"><b>&euro;</b> <?php _e('Euro', 'themerex'); ?></a></li>
			<li><a href="#"><b>&pound;</b> <?php _e('Pounds', 'themerex'); ?></a></li>
		</ul>
	</li>
<?php } ?>



<?php if (themerex_get_custom_option('show_languages')=='yes' && function_exists('icl_get_languages')) {
	$languages = icl_get_languages('skip_missing=1');
	if (!empty($languages)) {
		$lang_list = '';
		$lang_active = '';
		foreach ($languages as $lang) {
			$lang_title = esc_attr($lang['translated_name']);	//esc_attr($lang['native_name']);
			if ($lang['active']) {
				$lang_active = $lang_title;
			}
			$lang_list .= "\n".'<li><a rel="alternate" hreflang="' . esc_attr($lang['language_code']) . '" href="' . esc_url(apply_filters('WPML_filter_link', $lang['url'], $lang)) . '">'
				.'<img src="' . esc_url($lang['country_flag_url']) . '" alt="' . esc_attr($lang_title) . '" title="' . esc_attr($lang_title) . '" />'
				. ($lang_title)
				.'</a></li>';
		}
		?>
		<li class="menu_user_language">
			<a href="#"><span><?php echo ($lang_active); ?></span></a>
			<ul><?php echo ($lang_list); ?></ul>
		</li>
<?php
	}
}



if (themerex_get_custom_option('show_bookmarks')=='yes') {
	// Load core messages
	themerex_enqueue_messages();
	?>
	<li class="menu_user_bookmarks"><a href="#" class="bookmarks_show icon-heart-1" title="<?php _e('Show bookmarks', 'themerex'); ?>"></a>
	<?php 
		$list = themerex_get_value_gpc('themerex_bookmarks', '');
		if (!empty($list)) $list = json_decode($list, true);
		?>
		<ul class="bookmarks_list">
			<li><a href="#" class="bookmarks_add icon-star-empty" title="<?php _e('Add the current page into bookmarks', 'themerex'); ?>"><?php _e('Add bookmark', 'themerex'); ?></a></li>
			<?php 
			if (!empty($list)) {
				foreach ($list as $bm) {
					echo '<li><a href="'.esc_url($bm['url']).'" class="bookmarks_item">'.($bm['title']).'<span class="bookmarks_delete icon-cancel-1" title="'.__('Delete this bookmark', 'themerex').'"></span></a></li>';
				}
			}
			?>
		</ul>
	</li>
	<?php 
}


if (themerex_get_custom_option('show_login')=='yes' && is_user_logged_in() )  { ?>
		<li class="menu_user_logout"><a href="<?php echo wp_logout_url(home_url()); ?>"><?php _e('Logout', 'themerex'); ?></a></li>
		<?php
}
?>

</ul>