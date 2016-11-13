<?php

/* Register new post type */
add_action('init', 'codeus_post_type_news');
function codeus_post_type_news() {
	$labels = array(
		'name' => _x('News', 'post type general name', 'codeus'),
		'singular_name' => _x('News', 'post type singular name', 'codeus'),
		'add_new' => _x('Add New News', 'book', 'codeus'),
		'add_new_item' => __('Add New News', 'codeus'),
		'edit_item' => __('Edit News', 'codeus'),
		'new_item' => __('New News', 'codeus'),
		'view_item' => __('View News', 'codeus'),
		'search_items' => __('Search News', 'codeus'),
		'not_found' => __('No News found', 'codeus'),
		'not_found_in_trash' => __('No News found in Trash', 'codeus'), 
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true, 
		'query_var' => true,
		'rewrite' => array('slug' => 'news', 'with_front' => false),
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
	);

	register_post_type('codeus_news', $args);

}

/* News block for home page */
function codeus_news_block($params = NULL) {
	$block_class = 'fullwidth';
	if(isset($params->news_layout) && $params->news_layout == 'with_sidebar') {
		$block_class = 'center';
	}
	$news_count = isset($params->news_count) && $params->news_count > 0 ? $params->news_count : 4;
	$news = get_posts(array('numberposts' => $news_count, 'post_type' => 'codeus_news', 'suppress_filters' => false));
?>

<?php if($block_class == 'center') : ?>
	<div class="panel clearfix">
<?php endif; ?>

<div class="<?php echo $block_class; ?>">
	<h2><?php _e('News', 'codeus'); ?></h2>
	<div class="news_list lazy-loading clearfix" data-ll-item-delay="0">
		<?php if(!count($news)) : ?>
			<div class="empty"><?php _e('No News found', 'codeus'); ?></div>
		<?php endif; ?>
		<?php foreach($news as $news_item) : ?>
			<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $news_item->ID ), 'codeus_post_list' ); ?>
			<div class="news_item lazy-loading-item clearfix" data-ll-effect="fading">
				<div class="left-col">
					<a href="<?php echo get_permalink($news_item->ID); ?>" class="image">
						<?php if ($image[0]): ?>
							<img src="<?php echo $image[0]; ?>" alt="" />
						<?php else: ?>
							<span class="empty"></span>
						<?php endif; ?>
					</a>
					<span class="date"><?php echo apply_filters('get_the_date', mysql2date('d M Y', $news_item->post_date), 'd M Y'); ?></span>
				</div>
				<div class="news-content">
					<div class="title"><a href="<?php echo get_permalink($news_item->ID); ?>"><?php echo apply_filters('the_title', $news_item->post_title); ?></a></div>
					<div class="text"><?php echo apply_filters('the_excerpt', $news_item->post_excerpt); ?></div>
				</div>
			</div>
		<?php endforeach; ?>
		<div class="all-news lazy-loading-item" data-ll-effect="fading"><a href="<?php echo isset($params->news_link) ? $params->news_link : '#'; ?>"><?php _e('Read all news', 'codeus'); ?></a></div>
	</div>
</div>

<?php if($block_class == 'center') : ?>
		<div class="sidebar">
			<?php if(isset($params->news_sidebar_header)) : ?>
				<h3 class="widget-title"><?php echo $params->news_sidebar_header; ?></h3>
			<?php endif; ?>
			<?php if(isset($params->news_sidebar_html)) : ?>
				<div><?php echo apply_filters('widget_text', $params->news_sidebar_html); ?></div>
			<?php endif; ?>
		</div>
	</div><!-- .panel -->
<?php endif; ?>

<?php
}

// Shortcode
function codeus_news_shortcode($news_atts) {
	extract(shortcode_atts(array(
		'items_per_page' => 4,
		'post_type' => 'codeus_news'
	), $news_atts));
	$page = (get_query_var('paged')) ? get_query_var('paged') : ((get_query_var('page')) ? get_query_var('page') : 1);
	$news = get_posts(array('post_type' => $post_type, 'numberposts' => $items_per_page, 'offset' => ($page-1)*$items_per_page, 'suppress_filters' => false));
	$pages = ceil(count(get_posts(array('post_type' => $post_type, 'numberposts' => -1, 'offset' => 0, 'suppress_filters' => false)))/$items_per_page);
	ob_start();
?>
	<?php if(!count($news)) : ?>
		<div class="empty"><?php _e('No News found', 'codeus'); ?></div>
	<?php else: ?>
		<ul class="newslist styled">
			<?php foreach($news as $news_item) : ?>
				<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $news_item->ID ), 'codeus_post_list' ); ?>
				<li>
					<div class="news-info">
						<div class="datetime">
							<div class="day"><?php echo apply_filters('get_the_date', mysql2date('d M Y', $news_item->post_date), 'd M Y'); ?></div>
							<h2 class="time"><?php echo apply_filters('get_the_date', mysql2date('H:i', $news_item->post_date), 'H:i'); ?></h2>
						</div>
						<div class="thumbnail">
							<a href="<?php echo get_permalink($news_item->ID); ?>">
								<?php if ($image[0]): ?>
									<img src="<?php echo $image[0]; ?>" alt="" />
								<?php else: ?>
									<span class="empty"></span>
								<?php endif; ?>
							</a>
						</div>
					</div>
					<div class="text">
						<h3><a href="<?php echo get_permalink($news_item->ID); ?>"><?php echo apply_filters('the_title', $news_item->post_title); ?></a></h3>
						<?php echo apply_filters('the_excerpt', $news_item->post_excerpt); ?>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
		<?php codeus_pagination($page, $pages); ?>
	<?php endif; ?>
<?php
	$news_content = trim(preg_replace('/\s\s+/', '', ob_get_clean()));
	return $news_content;
}

?>