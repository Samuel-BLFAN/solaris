<div id="user-popUp" class="account_wrap user-popUp mfp-with-anim mfp-hide">
	<div class="user-account">
	<?php $current_user = wp_get_current_user(); ?>
	<div class="user_account">
		<?php
		$user_avatar = '';
		if ($current_user->user_email) $user_avatar = get_avatar($current_user->user_email, 63*min(2, max(1, themerex_get_theme_option("retina_ready"))));
		if ($user_avatar) {	?>
			<span class="user_avatar"><?php echo ($user_avatar); ?></span>
		<?php } ?>
		<span class="user_text"><?php _e('My account:', 'themerex'); ?></span>
		<span class="user_name"><?php echo ($current_user->display_name); ?></span>
	</div>

	<?php if (themerex_exists_woocommerce() && (themerex_is_woocommerce_page() && themerex_get_custom_option('show_cart')=='shop' || themerex_get_custom_option('show_cart')=='always') && !(is_checkout() || is_cart() || defined('WOOCOMMERCE_CHECKOUT') || defined('WOOCOMMERCE_CART'))) { ?>
		<div class="user_cart">
				<span class="icon"></span>
				<span class="cart_text"><?php _e('Shopping Cart:', 'themerex'); ?></span>
				<span class="cart_total"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
		</div>
	<?php } ?>

	<ul class="user_info">
		<?php if (current_user_can('publish_posts')) { ?>
			<li class="new_post"><a href="<?php echo home_url(); ?>/wp-admin/post-new.php?post_type=post" class="icon icon-post"><?php _e('New post', 'themerex'); ?></a></li>
		<?php } ?>
		<li class="settings"><a href="<?php echo get_edit_user_link(); ?>" class="icon icon-cog-1"><?php _e('Settings', 'themerex'); ?></a></li>
		<li class="help"><a href="#" class="icon icon-lifebuoy"><?php _e('Help', 'themerex'); ?></a></li>
	</ul>

	<div class="user_logout"><a href="<?php echo wp_logout_url(home_url()); ?>" class="icon icon-logout sc_button sc_button_square sc_button_style_filled sc_button_bg_custom sc_button_size_medium"><?php _e('Log out', 'themerex'); ?></a></div>

	</div>
</div>