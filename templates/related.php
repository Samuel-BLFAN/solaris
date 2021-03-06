<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'themerex_template_related_theme_setup' ) ) {
	add_action( 'themerex_action_before_init_theme', 'themerex_template_related_theme_setup', 1 );
	function themerex_template_related_theme_setup() {
		themerex_add_template(array(
			'layout' => 'related',
			'mode'   => 'blogger',
			'need_columns' => true,
			'title'  => __('Related posts /no columns/', 'themerex'),
			'thumb_title'  => __('Default image Related(crop)', 'themerex'),
			'w'		 => 400,
			'h'		 => 250
		));
		themerex_add_template(array(
			'layout' => 'related_2',
			'template' => 'related',
			'mode'   => 'blog',
			'need_columns' => true,
			'title'  => __('Related posts /2 columns/', 'themerex'),
			'thumb_title'  => __('Large image Related(crop)', 'themerex'),
			'w'		 => 750,
			'h'		 => 442
		));
		themerex_add_template(array(
			'layout' => 'related_3',
			'template' => 'related',
			'mode'   => 'blog',
			'need_columns' => true,
			'title'  => __('Related posts /3 columns/', 'themerex'),
			'thumb_title'  => __('Medium image Related(crop)', 'themerex'),
			'w'		 => 400,
			'h'		 => 350
		));
		themerex_add_template(array(
			'layout' => 'related_4',
			'template' => 'related',
			'mode'   => 'blog',
			'need_columns' => true,
			'title'  => __('Related posts /4 columns/', 'themerex'),
			'thumb_title'  => __('Small image Related(crop)', 'themerex'),
			'w'		 => 250,
			'h'		 => 200
		));
	}
}

// Template output
if ( !function_exists( 'themerex_template_related_output' ) ) {
	function themerex_template_related_output($post_options, $post_data) {
		$show_title = true;	//!in_array($post_data['post_format'], array('aside', 'chat', 'status', 'link', 'quote'));
		$parts = explode('_', $post_options['layout']);
		$style = $parts[0];
		$columns = max(1, min(4, empty($parts[1]) ? $post_options['columns_count'] : (int) $parts[1]));
		$tag = themerex_sc_in_shortcode_blogger(true) ? 'div' : 'article';
		if ($columns > 1) {
			?>
			<div class="<?php echo 'column-1_'.esc_attr($columns); ?> column_padding_bottom">
			<?php
		}
		?>
		<<?php echo ($tag); ?> class="post_item post_item_<?php echo esc_attr($style); ?> post_item_<?php echo esc_attr($post_options['number']); ?>">

			<div class="post_content">
				<?php if ($post_data['post_video'] || $post_data['post_thumb'] || $post_data['post_gallery']) { ?>
				<div class="post_featured">

					<?php
					if ($post_data['post_thumb'] && ($post_data['post_format']!='gallery' || !$post_data['post_gallery'])) {
						?>
						<div class="post_thumb">
							<?php
							if ($post_data['post_format']=='link' && $post_data['post_url']!='')
								echo '<a href="'.esc_url($post_data['post_url']).'"'.($post_data['post_url_target'] ? ' target="'.esc_attr($post_data['post_url_target']).'"' : '').'>'.($post_data['post_thumb']).'</a>';
							else if ($post_data['post_link']!='') {
								echo '<a href="' . esc_url($post_data['post_link']) . '">' .($post_data['post_thumb']). '</a>';
							}
							else
								echo trim($post_data['post_thumb']);
							?>
						</div>
					<?php
					} else if ($post_data['post_gallery']) {
						themerex_enqueue_slider();
						echo trim($post_data['post_gallery']);
					}
					?>

				</div>
				<?php } ?>

				<?php if ($show_title) { ?>
					<div class="post_content_wrap">
					<?php if (!isset($post_options['links']) || $post_options['links']) { ?>
						<h4 class="post_title"><a href="<?php echo esc_url($post_data['post_link']); ?>"><?php echo ($post_data['post_title']); ?></a></h4>
					<?php } else { ?>
						<h4 class="post_title"><?php echo ($post_data['post_title']); ?></h4>
					<?php }	?>

					<span class="post_info_posted post_info_date" itemprop="datePublished">
						<?php echo esc_html($post_data['post_date']); ?>
					</span>

					</div>
				<?php } ?>
			</div>	<!-- /.post_content -->
		</<?php echo ($tag); ?>>	<!-- /.post_item -->
		<?php
		if ($columns > 1) {
			?>
			</div>
			<?php
		}
	}
}
?>