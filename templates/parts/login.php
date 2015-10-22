<div id="user-popUp" class="user-popUp mfp-with-anim mfp-hide">
	<div class="sc_tabs">
		<ul class="loginHeadTab">
			<li><a href="#loginForm" class="loginFormTab icon"><?php _e('Log In', 'themerex'); ?></a></li>
			<li><a href="#registerForm" class="registerFormTab icon"><?php _e('Create an Account', 'themerex'); ?></a></li>
		</ul>

		<div id="loginForm" class="formItems loginFormBody popup_wrap popup_login">
			<div class="form_left">
				<form action="<?php echo wp_login_url(); ?>" method="post" name="login_form" class="popup_form login_form">
					<input type="hidden" name="redirect_to" value="<?php echo esc_attr(home_url()); ?>">
					<div class="icon popup_form_field login_field iconed_field icon-mail-1"><input type="text" id="log" name="log" value="" placeholder="<?php _e('Login or Email', 'themerex'); ?>"></div>
					<div class="icon popup_form_field password_field iconed_field icon-lock-1"><input type="password" id="password" name="pwd" value="" placeholder="<?php _e('Password', 'themerex'); ?>"></div>
					<div class="popup_form_field remember_field">
						<a href="<?php echo wp_lostpassword_url( get_permalink() ); ?>" class="forgot_password"><?php _e('Forgot password?', 'themerex'); ?></a>
						<input type="checkbox" value="forever" id="rememberme" name="rememberme">
						<label for="rememberme"><?php _e('Remember me', 'themerex'); ?></label>
					</div>
					<div class="popup_form_field submit_field"><input type="submit" class="submit_button sc_button sc_button_square sc_button_style_filled sc_button_bg_link sc_button_size_medium" value="<?php _e('Login', 'themerex'); ?>"></div>
				</form>
			</div>
			<div class="form_right">
				<div class="login_socials_title"><?php _e('You can login using your social profile', 'themerex'); ?></div>
				<div class="login_socials_list">
					<a href="#" class="iconLogin fb"></a>
					<a href="#" class="iconLogin tw"></a>
					<a href="#" class="iconLogin gg"></a>
				</div>
				<div class="login_socials_problem"><a href="#"><?php _e('Problem with login?', 'themerex'); ?></a></div>
				<div class="result message_block"></div>
			</div>
		</div>


		<div id="registerForm" class="formItems registerFormBody popup_wrap popup_registration">
			<form name="registration_form" method="post" class="popup_form registration_form">
				<input type="hidden" name="redirect_to" value="<?php echo esc_attr(home_url()); ?>"/>
				<div class="form_left">
					<div class="icon popup_form_field login_field iconed_field icon-user-3"><input type="text" id="registration_username" name="registration_username"  value="" placeholder="<?php _e('User name (login)', 'themerex'); ?>"></div>
					<div class="icon popup_form_field email_field iconed_field icon-mail-1"><input type="text" id="registration_email" name="registration_email" value="" placeholder="<?php _e('E-mail', 'themerex'); ?>"></div>
					<div class="popup_form_field agree_field">
						<input type="checkbox" value="agree" id="registration_agree" name="registration_agree">
						<label for="registration_agree"><?php _e('I agree with', 'themerex'); ?></label> <a href="#"><?php _e('Terms &amp; Conditions', 'themerex'); ?></a>
					</div>
					<div class="popup_form_field submit_field"><input type="submit" class="submit_button sc_button sc_button_square sc_button_style_filled sc_button_bg_link sc_button_size_medium" value="<?php _e('Sign Up', 'themerex'); ?>"></div>
				</div>
				<div class="form_right">
					<div class="icon popup_form_field password_field iconed_field icon-lock-1"><input type="password" id="registration_pwd"  name="registration_pwd"  value="" placeholder="<?php _e('Password', 'themerex'); ?>"></div>
					<div class="icon popup_form_field password_field iconed_field icon-lock-1"><input type="password" id="registration_pwd2" name="registration_pwd2" value="" placeholder="<?php _e('Confirm Password', 'themerex'); ?>"></div>
					<div class="popup_form_field description_field"><?php _e('Minimum 6 characters', 'themerex'); ?></div>
				</div>
			</form>
			<div class="result messageBlock"></div>
		</div>

	</div>	<!-- /.sc_tabs -->
</div>		<!-- /.user-popUp -->