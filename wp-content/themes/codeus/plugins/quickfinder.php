<?php

/* Register new post type */
add_action('init', 'codeus_post_type_quickfinders');
function codeus_post_type_quickfinders() {
	$labels = array(
		'name' => _x('Quickfinders', 'post type general name', 'codeus'),
		'singular_name' => _x('Quickfinder', 'post type singular name', 'codeus'),
		'add_new' => _x('Add New Quickfinder', 'book', 'codeus'),
		'add_new_item' => __('Add New Quickfinder', 'codeus'),
		'edit_item' => __('Edit Quickfinder', 'codeus'),
		'new_item' => __('New Quickfinder', 'codeus'),
		'view_item' => __('View Quickfinder', 'codeus'),
		'search_items' => __('Search Quickfinders', 'codeus'),
		'not_found' =>  __('No Quickfinder found', 'codeus'),
		'not_found_in_trash' => __('No Quickfinder found in Trash', 'codeus'), 
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $labels,
		'publicly_queryable' => false,
		'show_ui' => true, 
		'query_var' => false,
		'rewrite' => false,
		'public' => false,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'page-attributes', 'thumbnail'),
	);

	register_post_type('codeus_quickfinders', $args);

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
		'codeus_quickfindersets',
		'codeus_quickfinders',
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

add_action('add_meta_boxes', 'codeus_quickfinder_add_settings_box');
function codeus_quickfinder_add_settings_box() {
	add_meta_box('codeus_quickfinder_settings', __('Quickfinder Settings', 'codeus'), 'codeus_quickfinder_settings_box', 'codeus_quickfinders', 'normal', 'default');
}

function codeus_quickfinder_settings_box() {
	global $post;
	wp_nonce_field( plugin_basename(__FILE__), 'myplugin_noncename' );
	$quickfinder_description = get_post_meta($post->ID, "codeus_quickfinder_description", true);
	$quickfinder_link = get_post_meta($post->ID, "codeus_quickfinder_link", true);
	$quickfinder_link_target = get_post_meta($post->ID, "codeus_quickfinder_link_target", true);
	$quickfinder_background_color = get_post_meta($post->ID, "codeus_quickfinder_background_color", true);
	$quickfinder_icon_color = get_post_meta($post->ID, "codeus_quickfinder_icon_color", true);
	$quickfinder_icon = get_post_meta($post->ID, "codeus_quickfinder_icon", true);
?>
<p class="meta-options">
	<label for="quickfinder_description"><?php _e( 'Quickfinder item description', 'codeus' ); ?>:</label><br /><input name="codeus_quickfinder_description" type="text" id="quickfinder_description" value="<?php print $quickfinder_description; ?>" size="60" /><br />
	<label for="quickfinder_link"><?php _e( 'Quickfinder item link', 'codeus' ); ?>:</label><br /><input name="codeus_quickfinder_link" type="text" id="quickfinder_link" value="<?php print $quickfinder_link; ?>" size="60" /><br />
	<label for="quickfinder_link_target"><?php _e( 'Quickfinder item link target', 'codeus' ); ?>:</label><br />
	<select name="codeus_quickfinder_link_target" id="quickfinder_link_target">
		<option value="_self"<?php echo ($quickfinder_link_target == '_self' ? ' selected' : '') ?>>_self</option>
		<option value="_blank"<?php echo ($quickfinder_link_target == '_blank' ? ' selected' : '') ?>>_blank</option>
	</select><br />
	<label for="quickfinder_background_color"><?php _e( 'Quickfinder item background color', 'codeus' ); ?>:</label><br /><input name="codeus_quickfinder_background_color" type="text" id="quickfinder_background_color" value="<?php print $quickfinder_background_color; ?>" size="60" class="color-select" /><br />
	<label for="quickfinder_icon_color"><?php _e( 'Quickfinder item icon color', 'codeus' ); ?>:</label><br /><input name="codeus_quickfinder_icon_color" type="text" id="quickfinder_icon_color" value="<?php print $quickfinder_icon_color; ?>" size="60" class="color-select" /><br />
	<label for="quickfinder_icon"><?php _e( 'Quickfinder item icon', 'codeus' ); ?>:</label><br /><input name="codeus_quickfinder_icon" type="text" id="quickfinder_icon" value="<?php print $quickfinder_icon; ?>" size="60" /><br />
	<?php _e('Enter icon code', 'codeus'); ?>. <a href="<?php echo get_template_directory_uri(); ?>/fonts/user-icons-list.php" onclick="tb_show('<?php _e('Icons info', 'codeus'); ?>', this.href+'?TB_iframe=true'); return false;"><?php _e('Show Icon Codes', 'codeus'); ?></a>
</p>
<?php
}

add_action('save_post', 'codeus_quickfinder_save_settings');
function codeus_quickfinder_save_settings($post_id) {
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
		0 => 'codeus_quickfinder_description',
		1 => 'codeus_quickfinder_link',
		2 => 'codeus_quickfinder_link_target',
		3 => 'codeus_quickfinder_background_color',
		4 => 'codeus_quickfinder_icon_color',
		5 => 'codeus_quickfinder_icon',
	);
	foreach($post_metas as $post_meta) {
		if(isset($_POST[$post_meta])) {
			update_post_meta($post_id, $post_meta, $_POST[$post_meta]);
		}
	}
}

// Print Quickfinder
function codeus_quickfinder_block($quickfinder = '') {
	$quickfinder_loop = new WP_Query(array(
		'post_type' => 'codeus_quickfinders',
		'tax_query' =>$quickfinder ? array(
			array(
				'taxonomy' => 'codeus_quickfindersets',
				'field' => 'slug',
				'terms' => explode(',', $quickfinder)
			)
		) : array(),
		'orderby' => 'menu_order ID',
		'order' => 'ASC',
		'posts_per_page' => -1,
	));
	global $post;
	$quickfinder_posttemp = $post;
?>
<?php if($quickfinder_loop->have_posts()) : ?>
	<ul class="lazy-loading styled" data-ll-force-start="1">
		<?php
			while ( $quickfinder_loop->have_posts() ) : $quickfinder_loop->the_post();
			$link = get_post_meta($post->ID, 'codeus_quickfinder_link', 1);
			$target = get_post_meta($post->ID, 'codeus_quickfinder_link_target', 1);
			$bcolor = get_post_meta($post->ID, 'codeus_quickfinder_background_color', 1);
			$color = get_post_meta($post->ID, 'codeus_quickfinder_icon_color', 1);
			$desc = get_post_meta($post->ID, 'codeus_quickfinder_description', 1);
			$icon = get_post_meta($post->ID, 'codeus_quickfinder_icon', 1);
			$image = codeus_thumbnail( get_post_thumbnail_id(), 'codeus_quickfinder');
		?>
			<li>
				<?php if($link) : ?><a href="<?php echo $link ?>" class="clearfix"<?php if($target) : ?> target="<?php echo $target; ?>"<?php endif; ?>><?php endif; ?>
					<?php if($image[0]) : ?>
						<span class="image thumb lazy-loading-item" data-ll-item-delay="0" data-ll-effect="clip"><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /><span class="overlay"></span></span>
					<?php else : ?>
						<span class="image lazy-loading-item" data-ll-item-delay="0" data-ll-effect="clip" style="<?php if($bcolor) : ?>background-color: <?php echo $bcolor; ?>;<?php endif; ?> <?php if($color) : ?>color: <?php echo $color; ?>;<?php endif; ?>"><?php if($icon) : ?>&#x<?php echo $icon; ?>;<?php endif; ?></span>
					<?php endif; ?>
					<span class="lazy-loading-item caption" data-ll-item-delay="200" data-ll-effect="fading">
						<span class="title"><?php the_title(); ?></span>
						<?php if($desc) : ?><span class="description"><?php echo $desc; ?></span><?php endif; ?>
					</span>
				<?php if($link) : ?></a><?php endif; ?>
			</li>
			<?php $post = $quickfinder_posttemp; wp_reset_postdata(); ?>
		<?php endwhile; ?>
	</ul>
<?php endif; ?>

<?php
}

function codeus_quickfinder($quickfinder = '') {
	$quickfinder_loop = new WP_Query(array(
		'post_type' => 'codeus_quickfinders',
		'tax_query' =>$quickfinder ? array(
			array(
				'taxonomy' => 'codeus_quickfindersets',
				'field' => 'slug',
				'terms' => explode(',', $quickfinder)
			)
		) : array(),
		'orderby' => 'menu_order ID',
		'order' => 'ASC',
		'posts_per_page' => -1,
	));
	global $post;
	$quickfinder_posttemp = $post;
?>

<?php if($quickfinder_loop->have_posts()) : ?>
	<div class="quickfinder">
		<ul class="styled">
			<?php
				while ( $quickfinder_loop->have_posts() ) : $quickfinder_loop->the_post();
				$link = get_post_meta($post->ID, 'codeus_quickfinder_link', 1);
				$target = get_post_meta($post->ID, 'codeus_quickfinder_link_target', 1);
				$bcolor = get_post_meta($post->ID, 'codeus_quickfinder_background_color', 1);
				$color = get_post_meta($post->ID, 'codeus_quickfinder_icon_color', 1);
				$desc = get_post_meta($post->ID, 'codeus_quickfinder_description', 1);
				$icon = get_post_meta($post->ID, 'codeus_quickfinder_icon', 1);
				$image = codeus_thumbnail( get_post_thumbnail_id(), 'codeus_quickfinder');
			?>
				<li class="lazy-loading" data-ll-finish-delay="200">
					<?php if($link) : ?><a href="<?php echo $link ?>" class="clearfix"<?php if($target) : ?> target="<?php echo $target; ?>"<?php endif; ?>><?php endif; ?>
						<?php if($image[0]) : ?>
							<span class="image thumb lazy-loading-item" data-ll-item-delay="0" data-ll-effect="clip"><img src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" /><span class="overlay"></span></span>
						<?php else : ?>
							<span class="image lazy-loading-item" data-ll-item-delay="0" data-ll-effect="clip" style="<?php if($bcolor) : ?>background-color: <?php echo $bcolor; ?>;<?php endif; ?> <?php if($color) : ?>color: <?php echo $color; ?>;<?php endif; ?>"><?php if($icon) : ?>&#x<?php echo $icon; ?>;<?php endif; ?></span>
						<?php endif; ?>
						<span class="lazy-loading-item caption" data-ll-item-delay="200" data-ll-effect="fading">
							<span class="title"><?php the_title(); ?></span>
							<?php if($desc) : ?><span class="description"><?php echo $desc; ?></span><?php endif; ?>
						</span>
					<?php if($link) : ?></a><?php endif; ?>
				</li>
				<?php $post = $quickfinder_posttemp; wp_reset_postdata(); ?>
			<?php endwhile; ?>
		</ul>
	</div>
<?php endif; ?>

<?php
}

// Shortcode
function codeus_quickfinder_shortcode($quickfinder_atts) {
	extract(shortcode_atts(array(
		'quickfinderset' => '',
		'title' => '',
	), $quickfinder_atts));
	ob_start();
	codeus_quickfinder($quickfinderset);
	$quickfinder_content = trim(preg_replace('/\s\s+/', '', ob_get_clean()));
	if($title) {
		$quickfinder_content = '<h3>'.$title.'</h3>'.$quickfinder_content;
	}
	return $quickfinder_content;
}

?>