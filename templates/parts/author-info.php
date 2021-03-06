<?php
//===================================== Post author info =====================================
if (themerex_get_custom_option("show_post_author") == 'yes') {
	$post_author_name = $post_author_socials = '';
	$show_post_author_socials = true;
	if ($post_data['post_type']=='post') {
		$post_author_title = __('About', 'themerex');
		$post_author_name = $post_data['post_author'];
		$post_author_url = $post_data['post_author_url'];
		$post_author_email = get_the_author_meta('user_email', $post_data['post_author_id']);
		$post_author_avatar = get_avatar($post_author_email, 90*min(2, max(1, themerex_get_theme_option("retina_ready"))));
		$post_author_descr = do_shortcode(nl2br(get_the_author_meta('description', $post_data['post_author_id'])));
		if ($show_post_author_socials) $post_author_socials = themerex_show_user_socials(array('author_id'=>$post_data['post_author_id'], 'style'=>'icons', 'size'=>'tiny', 'echo' => false));
	}
	if (!empty($post_author_name)) {
		?>
		<section class="post_author author vcard" itemprop="author" itemscope itemtype="http://schema.org/Person">
			<div class="post_author_avatar"><a href="<?php echo esc_url($post_data['post_author_url']); ?>" itemprop="image"><?php echo ($post_author_avatar); ?></a></div>
			<h6 class="post_author_title"><?php echo esc_html($post_author_title); ?> <span itemprop="name"><a href="<?php echo esc_url($post_author_url); ?>" class="fn"><?php echo ($post_author_name); ?></a></span></h6>
			<div class="post_author_info" itemprop="description"><?php echo ($post_author_descr); ?></div>
			<?php if ($post_author_socials!='') echo ($post_author_socials); ?>
		</section>
	<?php
	}
}
?>