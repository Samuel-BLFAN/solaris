<?php

// Disable direct call
if ( ! defined( 'ABSPATH' ) ) { exit; }


/* Theme setup section
-------------------------------------------------------------------- */

if ( !function_exists( 'themerex_template_portfolio_theme_setup' ) ) {
	add_action( 'themerex_action_before_init_theme', 'themerex_template_portfolio_theme_setup', 1 );
	function themerex_template_portfolio_theme_setup() {
		themerex_add_template(array(
			'layout' => 'portfolio_2',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => __('Portfolio tile (with hovers, different height) /2 columns/', 'themerex'),
			'thumb_title'  => __('Large image', 'themerex'),
			'w'		 => 750,
			'h_crop' => 422,
			'h'		 => null
		));
		themerex_add_template(array(
			'layout' => 'portfolio_3',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => __('Portfolio tile /3 columns/', 'themerex'),
			'thumb_title'  => __('Medium image', 'themerex'),
			'w'		 => 400,
			'h_crop' => 225,
			'h'		 => null
		));
		themerex_add_template(array(
			'layout' => 'portfolio_4',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => __('Portfolio tile /4 columns/', 'themerex'),
			'thumb_title'  => __('Small image', 'themerex'),
			'w'		 => 250,
			'h_crop' => 141,
			'h'		 => null
		));
		themerex_add_template(array(
			'layout' => 'grid_2',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => __('Grid tile (with hovers, equal height) /2 columns/', 'themerex'),
			'thumb_title'  => __('Large image (crop)', 'themerex'),
			'w'		 => 750,
			'h' 	 => 422
		));
		themerex_add_template(array(
			'layout' => 'grid_3',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => __('Grid tile /3 columns/', 'themerex'),
			'thumb_title'  => __('Medium image (crop)', 'themerex'),
			'w'		 => 400,
			'h'		 => 225
		));
		themerex_add_template(array(
			'layout' => 'grid_4',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => __('Grid tile /4 columns/', 'themerex'),
			'thumb_title'  => __('Small image (crop)', 'themerex'),
			'w'		 => 250,
			'h'		 => 141
		));
		themerex_add_template(array(
			'layout' => 'square_2',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => __('Square tile (with hovers, width=height) /2 columns/', 'themerex'),
			'thumb_title'  => __('Large square image (crop)', 'themerex'),
			'w'		 => 750,
			'h' 	 => 750
		));
		themerex_add_template(array(
			'layout' => 'square_3',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => __('Square tile /3 columns/', 'themerex'),
			'thumb_title'  => __('Medium square image (crop)', 'themerex'),
			'w'		 => 400,
			'h'		 => 400
		));
		themerex_add_template(array(
			'layout' => 'square_4',
			'template' => 'portfolio',
			'mode'   => 'blog',
			'need_isotope' => true,
			'title'  => __('Square tile /4 columns/', 'themerex'),
			'thumb_title'  => __('Small square image (crop)', 'themerex'),
			'w'		 => 250,
			'h'		 => 250
		));

		// Add template specific scripts
		add_action('themerex_action_blog_scripts', 'themerex_template_portfolio_add_scripts');
	}
}

// Add template specific scripts
if (!function_exists('themerex_template_portfolio_add_scripts')) {
	//add_action('themerex_action_blog_scripts', 'themerex_template_portfolio_add_scripts');
	function themerex_template_portfolio_add_scripts($style) {
		if (themerex_substr($style, 0, 10) == 'portfolio_' || themerex_substr($style, 0, 5) == 'grid_' || themerex_substr($style, 0, 7) == 'square_') {
			themerex_enqueue_script( 'isotope', themerex_get_file_url('js/jquery.isotope.min.js'), array(), null, true );
			themerex_enqueue_style( 'themerex-portfolio-style', themerex_get_file_url('css/core.portfolio.css'), array(), null );
		}
	}
}

// Template output
if ( !function_exists( 'themerex_template_portfolio_output' ) ) {
	function themerex_template_portfolio_output($post_options, $post_data) {
		$show_title = !in_array($post_data['post_format'], array('aside', 'chat', 'status', 'link', 'quote'));
		$parts = explode('_', $post_options['layout']);
		$style = $parts[0];
		$columns = max(1, min(4, empty($parts[1]) ? 1 : (int) $parts[1]));
		$tag = themerex_sc_in_shortcode_blogger(true) ? 'div' : 'article';
		$post_options['hover']='';
		$link_start = !isset($post_options['links']) || $post_options['links'] ? '<a href="'.esc_url($post_data['post_link']).'">' : '';
		$link_start_hover = !isset($post_options['links']) || $post_options['links'] ? '<a class="hover" href="'.esc_url($post_data['post_attachment']).'" title="'.esc_attr($post_data['post_title']).'">' : '';
		$link_end = !isset($post_options['links']) || $post_options['links'] ? '</a>' : '';

			// All rest portfolio styles (portfolio, grid, square) with 2 and more columns
			?>
			<div class="isotope_item isotope_item_<?php echo esc_attr($style); ?> isotope_item_<?php echo esc_attr($post_options['layout']); ?> isotope_column_<?php echo esc_attr($columns); ?>
						<?php
						if ($post_options['filters'] != '') {
							if ($post_options['filters']=='categories' && !empty($post_data['post_terms'][$post_data['post_taxonomy']]->terms_ids))
								echo ' flt_' . join(' flt_', $post_data['post_terms'][$post_data['post_taxonomy']]->terms_ids);
							else if ($post_options['filters']=='tags' && !empty($post_data['post_terms'][$post_data['post_taxonomy_tags']]->terms_ids))
								echo ' flt_' . join(' flt_', $post_data['post_terms'][$post_data['post_taxonomy_tags']]->terms_ids);
						}
						?>">
				<<?php echo ($tag); ?> class="post_item post_item_<?php echo esc_attr($style); ?> post_item_<?php echo esc_attr($post_options['layout']); ?>
					<?php echo 'post_format_'.esc_attr($post_data['post_format']) 
						. ($post_options['number']%2==0 ? ' even' : ' odd') 
						. ($post_options['number']==0 ? ' first' : '') 
						. ($post_options['number']==$post_options['posts_on_page'] ? ' last' : '');
					?>">
	
					<div class="post_content isotope_item_content">
						<div class="post_featured img">
							<?php
							echo ($post_data['post_thumb']);
							?>
							<div class="hover_wrap">
								<div class="hover_content">
									<h4 class="post_title"><?php echo ($link_start) . ($post_data['post_title']) . ($link_end); ?></h4>
									<?php echo ($link_start_hover) . ($link_end); ?>
								</div>
							</div>
						</div>
					</div>				<!-- /.post_content -->
				</<?php echo ($tag); ?>>	<!-- /.post_item -->
			</div>						<!-- /.isotope_item -->
			<?php
	}
}
?>