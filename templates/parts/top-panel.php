			<?php 
				// WP custom header
				$header_image = $header_color = '';

			if (($header_image = get_header_image()) == '') {
				$header_image = themerex_get_custom_option('top_panel_bg_image');
			}

			$header_color = apply_filters('themerex_filter_get_accent_color', themerex_get_custom_option('top_panel_bg_color'));
				$header_style = $top_panel_opacity!='transparent' && ($header_image!='' || $header_color!='')
					? ' style="background: ' 
						. ($header_image!=''  ? 'url('.esc_url($header_image).') no-repeat center top' : '')
						. ($header_color!=''  ? ' '.esc_attr($header_color).';' : '')
						.'"' 
					: '';
			?>

			<div class="top_panel_fixed_wrap"></div>

			<header class="top_panel_wrap" <?php echo ($header_style); ?>>
				
				<?php if (themerex_get_custom_option('show_menu_user')=='yes') { ?>
					<div class="menu_user_wrap">
						<div class="menu_content_wrap clearfix">

							<?php if (themerex_get_custom_option('show_search')=='yes') echo do_shortcode('[trx_search open="no" title=""]'); ?>

							<div class="menu_user_area menu_user_right menu_user_nav_area">
								<?php require_once( themerex_get_file_dir('templates/parts/user-panel.php') ); ?>
							</div>
							<?php if (themerex_get_custom_option('show_contact_info')=='yes') { ?>
							<div class="menu_user_area menu_user_left menu_user_contact_area"><?php echo force_balance_tags(trim(themerex_get_custom_option('contact_info'))); ?></div>
							<?php } ?>
						</div>
					</div>
				<?php } ?>

				<div class="menu_main_wrap logo_<?php echo esc_attr(themerex_get_custom_option('logo_align')); ?><?php echo ($THEMEREX_GLOBALS['logo_text'] ? ' with_text' : ''); ?>">
					<div class="menu_content_wrap clearfix">
						<div class="logo">
							<a href="<?php echo esc_url(home_url()); ?>"><?php echo ($THEMEREX_GLOBALS['logo'] ? '<img src="'.esc_url($THEMEREX_GLOBALS['logo']).'" class="logo_main" alt="">' : ''); ?><?php echo ($THEMEREX_GLOBALS['logo_fixed'] ? '<img src="'.esc_url($THEMEREX_GLOBALS['logo_fixed']).'" class="logo_fixed" alt="">' : ''); ?><?php echo ($THEMEREX_GLOBALS['logo_text'] ? '<span class="logo_text">'.($THEMEREX_GLOBALS['logo_text']).'</span>' : ''); ?></a>
						</div>

						<?php
						if (themerex_get_custom_option('show_login')=='yes') {

							// Load Popup engine
							themerex_enqueue_popup_login();
							themerex_enqueue_script('jquery-ui-tabs', false, array('jquery','jquery-ui-core'), null, true);
							themerex_enqueue_script('jquery-effects-fade', false, array('jquery','jquery-effects-core'), null, true);

							if ( !is_user_logged_in() ) {
								// Load core messages
								themerex_enqueue_messages();
								?>
								<div class="login_wrap">
									<a href="#user-popUp" class="popup_link popup_login_link">
										<?php _e('Log in', 'themerex'); ?>
									</a>
									<?php require_once( themerex_get_file_dir('templates/parts/login.php') ); ?>
								</div>
								<?php

							} else { ?>
								<div class="login_wrap">
									<a href="#user-popUp" class="popup_link popup_account_link">
										<?php _e('My account', 'themerex'); ?>
									</a>
									<?php require_once( themerex_get_file_dir('templates/parts/account.php') ); ?>
								</div>
								<?php
							}
						}
						?>

						<?php if (themerex_exists_woocommerce() && (themerex_is_woocommerce_page() && themerex_get_custom_option('show_cart')=='shop' || themerex_get_custom_option('show_cart')=='always') && !(is_checkout() || is_cart() || defined('WOOCOMMERCE_CHECKOUT') || defined('WOOCOMMERCE_CART'))) { ?>
							<div class="cart">
								<a href="#" class="cart_button icon-shopping-cart"></a>

								<ul class="sidebar_cart"><li>
										<?php
										do_action( 'before_sidebar' );
										$THEMEREX_GLOBALS['current_sidebar'] = 'cart';
										if (!dynamic_sidebar('sidebar-cart')) {
											the_widget('WC_Widget_Cart', 'title=&hide_if_empty=0');
										}
										?>
									</li>
								</ul>

							</div>
						<?php } ?>
		
						<a href="#" class="menu_main_responsive_button icon-menu-1"></a>
	
						<nav role="navigation" class="menu_main_nav_area">
							<?php
							if (empty($THEMEREX_GLOBALS['menu_main'])) $THEMEREX_GLOBALS['menu_main'] = themerex_get_nav_menu('menu_main');
							if (empty($THEMEREX_GLOBALS['menu_main'])) $THEMEREX_GLOBALS['menu_main'] = themerex_get_nav_menu();
							echo ($THEMEREX_GLOBALS['menu_main']);
							?>
						</nav>
					</div>
				</div>

			</header>
