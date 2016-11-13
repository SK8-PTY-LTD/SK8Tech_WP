<?php

/* Register new post type */
add_action('init', 'codeus_post_type_portfolios');
function codeus_post_type_portfolios() {
	$labels = array(
		'name' => _x('Portfolio items', 'post type general name', 'codeus'),
		'menu_name' => __('Portfolios', 'codeus'),
		'singular_name' => _x('Portfolio item', 'post type singular name', 'codeus', 'codeus'),
		'all_items' => __('Items', 'codeus'),
		'add_new' => _x('Add New Item', 'book', 'codeus'),
		'add_new_item' => __('Add New Item', 'codeus'),
		'edit_item' => __('Edit Item', 'codeus'),
		'new_item' => __('New Item', 'codeus'),
		'view_item' => __('View Item', 'codeus'),
		'search_items' => __('Search Items', 'codeus'),
		'not_found' =>  __('No Items found', 'codeus'),
		'not_found_in_trash' => __('No Items found in Trash', 'codeus'),
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => array('slug' => 'portfolios', 'with_front' => false),
		'capability_type' => 'page',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'),
	);

	register_post_type('codeus_portfolios', $args);

	$labels = array(
		'name' => _x( 'Sets', 'taxonomy general name', 'codeus' ),
		'singular_name' => _x( 'Set', 'taxonomy singular name', 'codeus' ),
		'search_items' =>  __( 'Search Sets', 'codeus' ),
		'all_items' => __( 'All Sets', 'codeus' ),
		'parent_item' => __( 'Parent Set', 'codeus' ),
		'parent_item_colon' => __( 'Parent Set:', 'codeus' ),
		'edit_item' => __( 'Edit Set', 'codeus' ), 
		'update_item' => __( 'Update Set', 'codeus' ),
		'add_new_item' => __( 'Add New Set', 'codeus' ),
		'new_item_name' => __( 'New Set Name', 'codeus' ),
	);
	register_taxonomy(
		'codeus_portfoliosets',
		'codeus_portfolios',
		array(
			'public'=>false,
			'hierarchical' => false,
			'labels'=> $labels,
			'query_var' => false,
			'show_ui' => true,
			'rewrite' => false,
		)
	);
}

add_action('add_meta_boxes', 'codeus_portfolio_add_settings_box',0);
function codeus_portfolio_add_settings_box() {
	add_meta_box('codeus_portfolio_settings', __('General Settings', 'codeus'), 'codeus_portfolio_settings_box', 'codeus_portfolios', 'normal', 'default');
}

function codeus_portfolio_settings_box() {
	global $post;
	wp_nonce_field( plugin_basename(__FILE__), 'myplugin_noncename' );
	$portfolio_overview_title = get_post_meta($post->ID, "codeus_portfolio_overview_title", true);
	$portfolio_link = get_post_meta($post->ID, "codeus_portfolio_link", true);
	$portfolio_type = get_post_meta($post->ID, "codeus_portfolio_type", true);
	$portfolio_type_options = array('self-link' => __('Portfolio Page', 'codeus'), 'inner-link' => __('Internal Link', 'codeus'), 'outer-link' => __('External Link', 'codeus'), 'full-image' => __('Full-Size Image', 'codeus'), 'youtube' => __('YouTube Video', 'codeus'), 'vimeo' => __('Vimeo Video', 'codeus'), 'self_video' => __('Self-Hosted Video', 'codeus'));
?>
<p class="meta-options">
	<label for="portfolio_overview_title"><?php _e( 'Alternative title (for portfolio overviews)', 'codeus' ) ?>:</label><br /><input name="codeus_portfolio_overview_title" type="text" id="portfolio_overview_title" value="<?php echo $portfolio_overview_title; ?>" size="60" /><br />
	<label for="portfolio_type"><?php _e( 'Type of portfolio item', 'codeus' ) ?>:</label><br />
	<select name="codeus_portfolio_type" id="portfolio_type">
		<?php foreach($portfolio_type_options as $value => $label) : ?>
			<option value="<?php echo $value; ?>"<?php if($value == $portfolio_type) {echo ' selected';} ?>><?php echo $label; ?></option>
		<?php endforeach; ?>
	</select><br />
	<label for="portfolio_link"><?php _e( 'Link to another page or video ID (for YouTube or Vimeo)', 'codeus' ) ?>:</label><br /><input name="codeus_portfolio_link" type="text" id="portfolio_link" value="<?php print $portfolio_link; ?>" size="60" />
</p>
<?php
}

add_action('save_post', 'codeus_portfolio_save_settings');
function codeus_portfolio_save_settings($post_id) {
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return $post_id;
	if(!isset($_POST['post_type'])) {
		return $post_id;
	}
	if(isset($_POST['myplugin_noncename']) && !wp_verify_nonce( $_POST['myplugin_noncename'], plugin_basename(__FILE__))) {
		return $post_id;
	}
	if(!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	$post_metas = array(
		0 => 'codeus_portfolio_overview_title',
		1 => 'codeus_portfolio_link',
		2 => 'codeus_portfolio_type',
	);
	foreach($post_metas as $post_meta) {
		if(isset($_POST[$post_meta])) {
			update_post_meta($post_id, $post_meta, $_POST[$post_meta]);
		}
	}
}

// Print Portfolio Block
function codeus_portfolio_block($portfolio = '', $title = '') {
	$portfolio_loop = new WP_Query(array(
		'post_type' => 'codeus_portfolios',
		'tax_query' =>$portfolio ? array(
			array(
				'taxonomy' => 'codeus_portfoliosets',
				'field' => 'slug',
				'terms' => explode(',', $portfolio)
			)
		) : array(),
		'orderby' => 'menu_order ID',
		'order' => 'ASC',
		'posts_per_page' => -1,
	));
	$portfolio_title = __('Portfolio', 'codeus');
	$portfolio_description = '';
	if($portfolio_set = get_term_by('slug', $portfolio, 'codeus_portfoliosets')) {
		$portfolio_title = $portfolio_set->name;
		$portfolio_description = $portfolio_set->description;
	}
	$portfolio_title = $title ? $title : $portfolio_title;
	global $post;
	$portfolio_posttemp = $post;
?>
<?php if($portfolio_loop->have_posts()) : ?>
	<div class="lazy-loading" data-ll-item-delay="0">
		<div class="central-wrapper"><div class="fullwidth">
			<h2 class="bar-title lazy-loading-item" data-ll-effect="fading"><?php echo $portfolio_title; ?></h2>
			<?php if($portfolio_description) : ?>
				<div class="set-description"><?php echo $portfolio_description; ?></div>
			<?php endif; ?>
		</div></div>
		<div class="carousel-wrapper"><div class="carousel"><ul class="thumbs noscript styled">
			<?php while ( $portfolio_loop->have_posts() ) : $portfolio_loop->the_post(); ?>
				<li class="<?php echo $type = get_post_meta($post->ID, 'codeus_portfolio_type', 1); ?> lazy-loading-item" data-ll-effect="drop-bottom">
					<?php 
						$small_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'codeus_portfolio1');
						$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
						if($type == 'full-image' && !get_post_meta($post->ID, 'codeus_portfolio_link', 1)) {
							$link = $large_image_url[0];
						} elseif($type == 'self-link') {
							$link = get_permalink($post->ID);
						} elseif($type == 'youtube') {
							$link = 'http://www.youtube.com/embed/'.get_post_meta($post->ID, 'codeus_portfolio_link', 1).'?rel=0&amp;autoplay=1';
						} elseif($type == 'vimeo') {
							$link = 'http://player.vimeo.com/video/'.get_post_meta($post->ID, 'codeus_portfolio_link', 1);
						} else {
							$link = get_post_meta($post->ID, 'codeus_portfolio_link', 1);
						}
						if(!$link) {
							$link = '#';
						}
					?>
					<a<?php if($type == 'outer-link') {echo ' target="_blank"';} ?><?php if($type == 'full-image') {echo ' class="fancy"';} ?> href="<?php echo $link; ?>">
						<?php if($small_image_url[0]) : ?><span class="image"><img src="<?php echo $small_image_url[0]?>" width="<?php echo $small_image_url[1]?>" height="<?php echo $small_image_url[2]?>" alt="<?php the_title(); ?>" /><span class="overlay"><span class="p-icon"></span></span></span><?php endif; ?>
					</a>
					<div class="caption">
						<div class="title">
							<div class="title-hover-color"></div>
							<div class="title-inner"><div class="title-inner-content">
								<?php if($portfolio_overview_title = get_post_meta($post->ID, 'codeus_portfolio_overview_title', 1)) : ?>
									<?php echo $portfolio_overview_title; ?>
								<?php else : ?>
									<?php the_title(); ?>
								<?php endif; ?>
							</div></div>
							<?php if(codeus_get_option('show_social_icons')) : ?>
								<a href="javascript:void(0);" class="share-block-toggle" title="<?php _e('Share', 'codeus')?>">&#xe607;</a>
								<span class="share-block">
									<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?s=100&amp;p%5Burl%5D=<?php echo urlencode($link); ?>&amp;p%5Btitle%5D=<?php echo urlencode(get_the_title()); ?>&amp;p%5Bimages%5D%5B0%5D=<?php echo urlencode($large_image_url[0]); ?>">&#xe601;</a>
									<a target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_title()); ?>&amp;url=<?php echo urlencode($link); ?>">&#xe603;</a>
									<a target="_blank" href="https://plus.google.com/share?url=<?php echo urlencode($link); ?>">&#xe602;</a>
									<a target="_blank" href="http://www.pinterest.com/pin/create/button/?url=<?php echo urlencode($link); ?>&amp;media=<?php echo urlencode($large_image_url[0]); ?>&amp;description=<?php echo urlencode(get_the_title()); ?>">&#xe605;</a>
									<a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode($link); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>">&#xe604;</a>
									<a target="_blank" href="http://www.stumbleupon.com/submit?url=<?php echo urlencode($link); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>">&#xe606;</a>
								</span>
							<?php endif; ?>
						</div>
						<div class="small-title">
							<?php if($portfolio_overview_title = get_post_meta($post->ID, 'codeus_portfolio_overview_title', 1)) : ?>
								<?php echo $portfolio_overview_title; ?>
							<?php else : ?>
								<?php the_title(); ?>
							<?php endif; ?>
						</div>
						<?php if(has_excerpt()) : ?><div class="description"><?php the_excerpt(); ?></div><?php endif; ?>
					</div>
					<?php if($type == 'self_video') : ?>
						<div class="videoblock" style="display: none;"><?php echo codeus_selfvideoerror(); ?></div>
					<?php endif; ?>
				</li>
				<?php $post = $portfolio_posttemp; wp_reset_postdata(); ?>
			<?php endwhile; ?>
		</ul><div class="loading"></div></div></div>
	</div>
<?php endif; ?>

<?php
}

function term_has_subsets($term, $all_sets) {
	foreach ($all_sets as $subterm) {
		if ($subterm->parent == $term->term_id) {
			return true;
		}
	}
	return false;
}

function get_term_subsets($term, $all_sets) {
	$result = array();
	foreach ($all_sets as $subterm) {
		if ($subterm->parent == $term->term_id) {
			$result[] = $subterm;
		}
	}
	return $result;
}

function print_portolio_subsets($parent_term, $all_portfolio_terms, $mobile) {
	$subsets = get_term_subsets($parent_term, $all_portfolio_terms);
	if (count($subsets) > 0) {
		?>
			<ul class="dl-submenu">
				<?php foreach($subsets as $term) : 
					$term_has_childs = term_has_subsets($term, $all_portfolio_terms);
				?>
					<li class="<?php if (!$mobile || ($mobile && !$term_has_childs)): ?>mix-filter<?php endif; ?> <?php if($term_has_childs): ?>filter-parent-item<?php endif; ?> <?php if(get_option('portfoliosets_' . $term->term_id . '_icon')) { echo 'iconed'; } ?>">
						<a href="javascript:void(0);" data-filter="<?php echo $term->slug; ?>">
							<?php if(get_option('portfoliosets_' . $term->term_id . '_icon')) : ?><span class="icon">&#x<?php echo get_option('portfoliosets_' . $term->term_id . '_icon'); ?>;</span><?php endif; ?>
							<?php echo $term->name; ?>
						</a>
						<?php print_portolio_subsets($term, $all_portfolio_terms, $mobile); ?>
					</li>
				<?php endforeach; ?>
			</ul>
		<?php
	}
}

// Print Portfolio
function codeus_portfolio($portfolio = '', $image_size = '', $count = 0, $portfolio_filter = 0, $title='') {
	if($image_size == '') {
		$image_size = 'full';
	}
	if(!$count) {
		$count = 10;
	}
	$portfolio_loop = new WP_Query(array(
		'post_type' => 'codeus_portfolios',
		'tax_query' =>$portfolio ? array(
			array(
				'taxonomy' => 'codeus_portfoliosets',
				'field' => 'slug',
				'terms' => explode(',', $portfolio)
			)
		) : array(),
		'orderby' => 'menu_order ID',
		'order' => 'ASC',
		'posts_per_page' => -1
	));
	global $post;
	$portfolio_posttemp = $post;
?>
<?php if($portfolio_loop->have_posts()) : ?>
	<div class="portfolio noscript <?php echo $image_size; ?>">
		<?php if($title) : ?>
			<h2><?php echo $title; ?></h2>
		<?php endif; ?>
		<div class="<?php echo ($portfolio_filter ? ' rubrics' : ' galleriffic'); ?>" data-count="<?php echo $count; ?>">
			<?php if($portfolio_filter) : ?>
				<?php
					$all_portfolio_terms = get_terms('codeus_portfoliosets', array('hide_empty' => false));

					if($portfolio) {
						$terms = explode(',', $portfolio);
						foreach($terms as $key => $term) {
							$terms[$key] = get_term_by('slug', $term, 'codeus_portfoliosets');
							if(!$terms[$key]) {
								unset($terms[$key]);
							}
						}
					} else {
						$terms = get_terms('codeus_portfoliosets', array('hide_empty' => false));
					}

					$terms_set = array();
					foreach ($terms as $term)
						$terms_set[$term->slug] = $term;
				?>
				<?php if(count($terms)) : ?>
					<div class="portolio-filter-wrapper clearfix">
						<a class="menu-toggle dl-trigger" href="javascript:void(0);">Menu</a>
						<ul class="filter styled">
							<li class="mix-filter iconed">
								<a href="javascript:void(0);" data-filter="all">
									<span class="icon">&#xe645;</span>
									<?php _e('Show All', 'codeus'); ?>
								</a>
							</li>
							<?php foreach($terms as $term) : ?>
								<li class="mix-filter <?php if(get_option('portfoliosets_' . $term->term_id . '_icon')) { echo 'iconed'; } ?>">
									<a href="javascript:void(0);" data-filter="<?php echo $term->slug; ?>">
										<?php if(get_option('portfoliosets_' . $term->term_id . '_icon')) : ?><span class="icon">&#x<?php echo get_option('portfoliosets_' . $term->term_id . '_icon'); ?>;</span><?php endif; ?>
										<?php echo $term->name; ?>
									</a>
									<?php print_portolio_subsets($term, $all_portfolio_terms, false); ?>
								</li>
							<?php endforeach; ?>
						</ul>

						<ul class="styled dl-menu">
							<li class="mix-filter iconed">
								<a href="javascript:void(0);" data-filter="all">
									<span class="icon">&#xe645;</span>
									<?php _e('Show All', 'codeus'); ?>
								</a>
							</li>
							<?php foreach($terms as $term) :
								$term_has_childs = term_has_subsets($term, $all_portfolio_terms);
							?>
								<li class="<?php if(!$term_has_childs): ?>mix-filter<?php endif; ?> <?php if(get_option('portfoliosets_' . $term->term_id . '_icon')) { echo 'iconed'; } ?>">
									<a href="javascript:void(0);" data-filter="<?php echo $term->slug; ?>">
										<?php if(get_option('portfoliosets_' . $term->term_id . '_icon')) : ?><span class="icon">&#x<?php echo get_option('portfoliosets_' . $term->term_id . '_icon'); ?>;</span><?php endif; ?>
										<?php echo $term->name; ?>
									</a>
									<?php print_portolio_subsets($term, $all_portfolio_terms, true); ?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif; ?>
			<?php endif; ?>
			<ul class="thumbs-temp styled"></ul>
			<ul class="thumbs lazy-loading styled" data-ll-item-delay="0">
			<?php while ( $portfolio_loop->have_posts() ) : $portfolio_loop->the_post(); ?>
				<?php $slugs = wp_get_object_terms($post->ID, 'codeus_portfoliosets', array('fields' => 'slugs')); ?>
				<li class="<?php echo $type = get_post_meta($post->ID, 'codeus_portfolio_type', 1); ?> <?php echo implode(' ', $slugs); ?><?php if($image_size != 'list') : ?> lazy-loading-item<?php endif; ?>" data-ll-effect="drop-bottom">
					<?php
						$small_image_url = codeus_thumbnail(get_post_thumbnail_id(), 'codeus_portfolio_' . ($image_size == 'list' ? 'medium' : $image_size));
						$large_image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
						if($type == 'full-image' && !get_post_meta($post->ID, 'codeus_portfolio_link', 1)) {
							$link = $large_image_url[0];
						} elseif($type == 'self-link') {
							$link = get_permalink($post->ID);
						} elseif($type == 'youtube') {
							$link = 'http://www.youtube.com/embed/'.get_post_meta($post->ID, 'codeus_portfolio_link', 1).'?autoplay=1';
						} elseif($type == 'vimeo') {
							$link = 'http://player.vimeo.com/video/'.get_post_meta($post->ID, 'codeus_portfolio_link', 1).'?autoplay=1';
						} else {
							$link = get_post_meta($post->ID, 'codeus_portfolio_link', 1);
						}
						if(!$link) {
							$link = '#';
						}
					?>
					<?php if($image_size == 'list') : ?><div class="left-block"><?php endif; ?>
					<a<?php if($type == 'outer-link') {echo ' target="_blank"';} ?><?php if($type == 'full-image') {echo ' class="fancy"';} ?> href="<?php echo $link; ?>">
						<?php if($small_image_url[0]) : ?><span class="image"><img src="<?php echo $small_image_url[0]?>" width="<?php echo $small_image_url[1]?>" height="<?php echo $small_image_url[2]?>" alt="<?php the_title(); ?>" /><span class="overlay"><span class="p-icon"></span></span></span><?php endif; ?>
					</a>
					<div class="caption">
						<div class="title">
							<?php if ($image_size != 'small'):?><div class="title-hover-color"></div><?php endif; ?>
							<div class="title-inner"><div class="title-inner-content">
								<?php if ($image_size != 'small'):?>
									<?php if($portfolio_overview_title = get_post_meta($post->ID, 'codeus_portfolio_overview_title', 1)) : ?>
										<?php echo $portfolio_overview_title; ?>
									<?php else : ?>
										<?php the_title(); ?>
									<?php endif; ?>
								<?php endif; ?>
							</div></div>
							<?php if(codeus_get_option('show_social_icons')) : ?>
								<a href="javascript:void(0);" class="share-block-toggle" title="<?php _e('Share', 'codeus')?>">&#xe607;</a>
								<span class="share-block">
									<a target="_blank" href="https://www.facebook.com/sharer/sharer.php?s=100&amp;p%5Burl%5D=<?php echo urlencode($link); ?>&amp;p%5Btitle%5D=<?php echo urlencode(get_the_title()); ?>&amp;p%5Bimages%5D%5B0%5D=<?php echo urlencode($large_image_url[0]); ?>">&#xe601;</a>
									<a target="_blank" href="https://twitter.com/intent/tweet?text=<?php echo urlencode(get_the_title()); ?>&amp;url=<?php echo urlencode($link); ?>">&#xe603;</a>
									<a target="_blank" href="https://plus.google.com/share?url=<?php echo urlencode($link); ?>">&#xe602;</a>
									<a target="_blank" href="http://www.pinterest.com/pin/create/button/?url=<?php echo urlencode($link); ?>&amp;media=<?php echo urlencode($large_image_url[0]); ?>&amp;description=<?php echo urlencode(get_the_title()); ?>">&#xe605;</a>
									<a target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo urlencode($link); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>">&#xe604;</a>
									<a target="_blank" href="http://www.stumbleupon.com/submit?url=<?php echo urlencode($link); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>">&#xe606;</a>
								</span>
							<?php endif; ?>
						</div>
						<?php if ($image_size == 'small'):?>
							<div class="small-title">
								<?php if($portfolio_overview_title = get_post_meta($post->ID, 'codeus_portfolio_overview_title', 1)) : ?>
									<?php echo $portfolio_overview_title; ?>
								<?php else : ?>
									<?php the_title(); ?>
								<?php endif; ?>
							</div>
						<?php endif; ?>
						<?php if($image_size == 'list') : ?></div></div><div class="right-block"><?php endif; ?>
						<?php if(has_excerpt()) : ?><div class="description"><?php the_excerpt(); ?></div><?php endif; ?>
						<?php if ($image_size != 'small'):?>
							<div class="info">
								<?php echo get_the_date(); ?>
								<?php
									foreach ($slugs as $slug)
										if (isset($terms_set[$slug]))
											echo '<span>|</span><a data-slug="'.$terms_set[$slug]->slug.'">'.$terms_set[$slug]->name.'</a>';
								?>
							</div>
						<?php endif; ?>
					</div>
					<?php if($type == 'self_video') : ?>
						<div class="videoblock" style="display: none;"><?php echo codeus_selfvideoerror(); ?></div>
					<?php endif; ?>
				</li>
				<?php $post = $portfolio_posttemp; wp_reset_postdata(); ?>
			<?php endwhile; ?>
		</ul></div>
	</div>
	<div class="loading"></div>
<?php endif; ?>

<?php
}

// Shortcode
function codeus_portfolio_shortcode($portfolio_atts) {
	extract(shortcode_atts(array(
		'portfolioset' => '',
		'thumb_size' => '',
		'items_per_page' => 0,
		'title' => ''
	), $portfolio_atts));
	ob_start();
	codeus_portfolio($portfolioset, $thumb_size, $items_per_page);
	$portfolio_content = trim(preg_replace('/\s\s+/', '', ob_get_clean()));
	if($title) {
		$portfolio_content = '<h3>'.$title.'</h3>'.$portfolio_content;
	}
	return $portfolio_content;
}


add_action( 'admin_enqueue_scripts', 'codeus_portfolio_admin_scripts' );
function codeus_portfolio_admin_scripts() {
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
}

/* Widget class */
class Codeus_Widget_ProjectInfo extends WP_Widget {

	function __construct() {
		$widget_ops = array('classname' => 'project_info', 'description' => __( 'Project Info / Contact Info / Custom Iconed Fields', 'codeus') );
		parent::__construct('project_info', __('Project Info / Contact Info / Custom Iconed Fields', 'codeus'), $widget_ops);
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$fields = $instance['fields'];
		$button_url = $instance['button_url'];
		if(!($button_text = $instance['button_text'])) {
			$button_text = __('Project Preview', 'codeus');
		}

		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
?>

	<?php foreach($fields as $field) : ?>
		<?php if($field['title']) : ?>
		<div class="project_info-item<?php if($field['icon']) echo ' iconed'; ?>">
			<div class="title">
				<?php if($field['icon']) : ?><span class="icon">&#x<?php echo $field['icon']; ?>;</span><?php endif; ?>
				<?php echo $field['title']; ?>
			</div>
			<div class="value"><?php echo $field['value']; ?></div>
		</div>
		<?php endif; ?>
	<?php endforeach; ?>
	<?php if($button_url) : ?>
		<div><a class="button" href="<?php echo $button_url; ?>"><?php echo $button_text; ?></a></div>
	<?php endif; ?>

<?php
		echo $after_widget; 
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args((array) $new_instance, array( 'title' => '', 'fields' => array(), 'button_url' => '', 'button_text' => '' ));
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['fields'] = $new_instance['fields'];
		$instance['button_url'] = $new_instance['button_url'];
		$instance['button_text'] = $new_instance['button_text'];
		return $instance; 
	}

	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'fields' => array(), 'button_url' => '', 'button_text' => '' ) );
		$title = $instance['title'];
		$fields = $instance['fields'];
		$button_url = $instance['button_url'];
		$button_text = $instance['button_text'];
?>

	<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'codeus'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
	<h3>Fields:</h3>
	<?php for( $i=0; $i < 10; $i++ ) : ?>
		<h4>Field #<?php echo ($i+1); ?>:</h4>
		<p><label for="<?php echo $this->get_field_id('fields_' . $i . '_title'); ?>"><?php _e('Title', 'codeus'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('fields_' . $i . '_title'); ?>" name="<?php echo $this->get_field_name('fields') . '[' . $i . '][title]'; ?>" type="text" value="<?php echo isset($fields[$i]) ? $fields[$i]['title'] : ''; ?>" /></label></p>
		<p><label for="<?php echo $this->get_field_id('fields_' . $i . '_value'); ?>"><?php _e('Value', 'codeus'); ?>: <textarea class="widefat" rows="3" cols="20" id="<?php echo $this->get_field_id('fields_' . $i . '_value'); ?>" name="<?php echo $this->get_field_name('fields') . '[' . $i . '][value]'; ?>"><?php echo isset($fields[$i]) ? $fields[$i]['value'] : ''; ?></textarea></label></p>
		<p>
			<label for="<?php echo $this->get_field_id('fields_' . $i . '_icon'); ?>"><?php _e('Icon', 'codeus'); ?>: <input class="widefat icon" id="<?php echo $this->get_field_id('fields_' . $i . '_icon'); ?>" name="<?php echo $this->get_field_name('fields') . '[' . $i . '][icon]'; ?>" type="text" value="<?php echo isset($fields[$i]) ? $fields[$i]['icon'] : ''; ?>" /></label><br/>
			<?php _e('Enter icon code', 'codeus'); ?>. <a href="<?php echo get_template_directory_uri(); ?>/fonts/user-icons-list.php" onclick="tb_show('<?php _e('Icons info', 'codeus'); ?>', this.href+'?TB_iframe=true'); return false;"><?php _e('Show Icon Codes', 'codeus'); ?></a>
		</p>
	<?php endfor; ?>
	<p>&nbsp;</p>
	<p><label for="<?php echo $this->get_field_id('button_url'); ?>"><?php _e('Button URL', 'codeus'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('button_url'); ?>" name="<?php echo $this->get_field_name('button_url'); ?>" type="text" value="<?php echo $button_url; ?>" /></label></p>
	<p><label for="<?php echo $this->get_field_id('button_text'); ?>"><?php _e('Button Text', 'codeus'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('button_text'); ?>" name="<?php echo $this->get_field_name('button_text'); ?>" type="text" value="<?php echo $button_text; ?>" /></label></p>
<?php
	}
}

/* Widget initialization */
add_action('widgets_init', 'codeus_project_info_widgets_init');
function codeus_project_info_widgets_init() {
	if ( !is_blog_installed() )
		return;
	register_widget('Codeus_Widget_ProjectInfo');
}

add_action('codeus_portfoliosets_edit_form','codeus_portfoliosets_form');
add_action('codeus_portfoliosets_add_form','codeus_portfoliosets_form');

function codeus_portfoliosets_form() {
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
}

add_action('codeus_portfoliosets_edit_form_fields','codeus_portfoliosets_edit_form_fields');
function codeus_portfoliosets_edit_form_fields() {
?>
	<tr class="form-field">
		<th valign="top" scope="row"><label for="portfoliosets_icon"><?php _e('Icon', 'codeus'); ?></label></th>
		<td>
			<input class= "icon" type="text" id="portfoliosets_icon" name="portfoliosets_icon" value="<?php echo get_option('portfoliosets_' . $_REQUEST['tag_ID'] . '_icon'); ?>"/><br />
			<span class="description"><?php _e('Enter icon code', 'codeus'); ?>. <a href="<?php echo get_template_directory_uri(); ?>/fonts/user-icons-list.php" onclick="tb_show('<?php _e('Icons info', 'codeus'); ?>', this.href+'?TB_iframe=true'); return false;"><?php _e('Show Icon Codes', 'codeus'); ?></a></span>
		</td>
	</tr>
<?php
}

add_action('codeus_portfoliosets_add_form_fields','codeus_portfoliosets_add_form_fields');
function codeus_portfoliosets_add_form_fields() {
?>
	<div class="form-field">
		<label for="portfoliosets_icon"><?php _e('Icon', 'codeus'); ?></label>
		<input class= "icon" type="text" id="portfoliosets_icon" name="portfoliosets_icon"/><br/>
		<?php _e('Enter icon code', 'codeus'); ?>. <a href="<?php echo get_template_directory_uri(); ?>/fonts/user-icons-list.php" onclick="tb_show('<?php _e('Icons info', 'codeus'); ?>', this.href+'?TB_iframe=true'); return false;"><?php _e('Show Icon Codes', 'codeus'); ?></a>
	</div>
<?php
}

add_action('create_codeus_portfoliosets','codeus_portfoliosets_create');
function codeus_portfoliosets_create($id) {
	if(isset($_REQUEST['portfoliosets_icon'])) {
		update_option( 'portfoliosets_' . $id . '_icon', $_REQUEST['portfoliosets_icon'] );
	}
}

add_action('edit_codeus_portfoliosets','codeus_portfoliosets_update');
function codeus_portfoliosets_update($id) {
	if(isset($_REQUEST['portfoliosets_icon'])) {
		update_option( 'portfoliosets_' . $id . '_icon', $_REQUEST['portfoliosets_icon'] );
	}
}

add_action('delete_codeus_portfoliosets','codeus_portfoliosets_delete');
function codeus_portfoliosets_delete($id) {
	delete_option( 'portfoliosets_' . $id . '_icon' );
}

?>