<?php
		if ($post_data['post_video']) {
			echo trim(themerex_get_video_frame($post_data['post_video'], $post_data['post_video_image'] ? $post_data['post_video_image'] : $post_data['post_thumb']));
		} else if ($post_data['post_audio']) {
			echo trim(themerex_get_audio_frame($post_data['post_audio'], $post_data['post_audio_image'] ? $post_data['post_audio_image'] : $post_data['post_thumb_url']));
		} else if ($post_data['post_thumb'] && ($post_data['post_format']!='gallery' || !$post_data['post_gallery'] || themerex_get_custom_option('gallery_instead_image')=='no')) {
			?>
			<div class="post_thumb">
			<?php
			if ($post_data['post_format']=='link' && $post_data['post_url']!='')
				echo '<a href="'.esc_url($post_data['post_url']).'"'.($post_data['post_url_target'] ? ' target="'.esc_attr($post_data['post_url_target']).'"' : '').'>'.($post_data['post_thumb']).'</a>';
			else if ($post_data['post_link']!='') {
				echo ($post_data['post_thumb']);
				echo '<div class="hover_wrap"><div class="link_wrap"><a class="hover_link icon-right-open" href="' . esc_url($post_data['post_link']) . '">' . __('preview', 'themerex') . '</a></div></div>';
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