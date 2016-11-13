<?php

/* Register new post type */
add_action('init', 'codeus_post_type_slide');
function codeus_post_type_slide() {
	$labels = array(
		'name' => _x('Slide', 'post type general name', 'codeus'),
		'singular_name' => _x('Slide', 'post type singular name', 'codeus'),
		'menu_name' => __('Slideshow', 'codeus'),
		'add_new' => _x('Add New Slide', 'book', 'codeus'),
		'add_new_item' => __('Add New Slide', 'codeus'),
		'edit_item' => __('Edit Slide', 'codeus'),
		'new_item' => __('New Slide', 'codeus'),
		'view_item' => __('View Slide', 'codeus'),
		'search_items' => __('Search Slides', 'codeus'),
		'not_found' =>  __('No Slide found', 'codeus'),
		'not_found_in_trash' => __('No Slide found in Trash', 'codeus'), 
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'show_ui' => true, 
		'query_var' => false,
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'thumbnail', 'excerpt', 'page-attributes'),
	);

	register_post_type('codeus_slide', $args);

	$labels = array(
		'name' => _x( 'Slideshow', 'taxonomy general name', 'codeus' ),
		'singular_name' => _x( 'Slideshow', 'taxonomy singular name', 'codeus' ),
		'search_items' =>  __( 'Search Slideshows', 'codeus' ),
		'all_items' => __( 'All Slideshows', 'codeus' ),
		'parent_item' => __( 'Parent Slideshow', 'codeus' ),
		'parent_item_colon' => __( 'Parent Slideshow:', 'codeus' ),
		'edit_item' => __( 'Edit Slideshow', 'codeus' ), 
		'update_item' => __( 'Update Slideshow', 'codeus' ),
		'add_new_item' => __( 'Add New Slideshow', 'codeus' ),
		'new_item_name' => __( 'New Slideshow Name', 'codeus' ),
	);
	register_taxonomy(
		'codeus_slideshow',
		'codeus_slide',
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

add_action('add_meta_boxes', 'codeus_slide_add_settings_box');
function codeus_slide_add_settings_box() {
	add_meta_box('codeus_slide_settings', __('Slide Settings', 'codeus'), 'codeus_slide_settings_box', 'codeus_slide', 'normal', 'default');
}

function codeus_slide_settings_box() {
	global $post;
	wp_nonce_field( plugin_basename(__FILE__), 'myplugin_noncename' );
	$slide_link = get_post_meta($post->ID, "codeus_slide_link", true);
	$slide_text_position = get_post_meta($post->ID, "codeus_slide_text_position", true);
	$slide_text_position_options = array(0 => __('None', 'codeus'), 1 => __('Left', 'codeus'), 2 => __('Right', 'codeus'));
?>
<p class="meta-options">
	<label for="slide_link"><?php _e( 'Slide link', 'codeus' ) ?>:</label><br /><input name="codeus_slide_link" type="text" id="slide_link" value="<?php print $slide_link; ?>" size="60" /><br />
	<label for="slide_text_position"><?php _e( 'Slide text position', 'codeus' ) ?>:</label><br />
	<select name="codeus_slide_text_position" id="slide_text_position">
		<?php foreach($slide_text_position_options as $value => $label) : ?>
			<option value="<?php echo $value; ?>"<?php if($value == $slide_text_position) {echo ' selected';} ?>><?php echo $label; ?></option>
		<?php endforeach; ?>
	</select>
</p>
<?php
}

add_action('save_post', 'codeus_slide_save_settings');
function codeus_slide_save_settings($post_id) {
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
		0 => 'codeus_slide_link',
		1 => 'codeus_slide_text_position',
	);
	foreach($post_metas as $post_meta) {
		if(isset($_POST[$post_meta])) {
			update_post_meta($post_id, $post_meta, $_POST[$post_meta]);
		}
	}
}

function codeus_slideshow($slideshow = '') {
	$slide_loop = new WP_Query(array(
		'post_type' => 'codeus_slide',
		'tax_query' =>$slideshow ? array(
			array(
				'taxonomy' => 'codeus_slideshow',
				'field' => 'slug',
				'terms' => explode(',', $slideshow)
			)
		) : array(),
		'orderby' => 'menu_order ID',
		'order' => 'ASC',
		'posts_per_page' => -1,
	));
	global $post;
	$slide_posttemp = $post;
	$id = time().rand();
	$slider_options = array();
	if(codeus_get_option('slider_effect')) {
		$slider_options[] = 'effect: "'.codeus_get_option('slider_effect').'"';
	} else {
		$slider_options[] = 'effect: "random"';
	}
	if(codeus_get_option('slider_slices')) {
		$slider_options[] = 'slices: '.codeus_get_option('slider_slices');
	} else {
		$slider_options[] = 'slices: 15';
	}
	if(codeus_get_option('slider_boxCols')) {
		$slider_options[] = 'boxCols: '.codeus_get_option('slider_boxCols');
	} else {
		$slider_options[] = 'boxCols: 8';
	}
	if(codeus_get_option('slider_boxRows')) {
		$slider_options[] = 'boxRows: '.codeus_get_option('slider_boxRows');
	} else {
		$slider_options[] = 'boxRows: 4';
	}
	if(codeus_get_option('slider_animSpeed')) {
		$slider_options[] = 'animSpeed: "'.(codeus_get_option('slider_animSpeed')*100).'"';
	} else {
		$slider_options[] = 'animSpeed: 500';
	}
	if(codeus_get_option('slider_pauseTime')) {
		$slider_options[] = 'pauseTime: "'.(codeus_get_option('slider_pauseTime')*1000).'"';
	} else {
		$slider_options[] = 'pauseTime: 3000';
	}
	if(codeus_get_option('slider_directionNav')) {
		$slider_options[] = 'directionNav: true';
	} else {
		$slider_options[] = 'directionNav: false';
	}
	if(codeus_get_option('slider_controlNav')) {
		$slider_options[] = 'controlNav: true';
	} else {
		$slider_options[] = 'controlNav: false';
	}
?>
<?php if($slide_loop->have_posts()) : ?>
	<div id="slideshow-<?php echo $id; ?>" class="nivoSlider">
		<?php while ( $slide_loop->have_posts() ) : $slide_loop->the_post(); ?>
			<?php
				$image_url = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
				$stp = get_post_meta($post->ID, 'codeus_slide_text_position', 1);
			?>
			<?php if($image_url) : ?>
				<?php if($link = get_post_meta($post->ID, 'codeus_slide_link', 1)) : ?>
					<a href="<?php echo $link; ?>" class="slide">
				<?php else : ?>
					<div class="slide">
				<?php endif; ?>
					<img alt="<?php the_title(); ?>" src="<?php echo $image_url[0]; ?>" />
					<?php if($stp) : ?>
						<div class="caption" style="display: none;">
							<div class="caption-<?php if($stp == 2) { echo 'right'; } else { echo 'left'; } ?>">
								<div class="title"><?php the_title(); ?></div>
								<div class="clear"></div>
								<div class="description"><?php the_excerpt(); ?></div>
								<div class="clear"></div>
							</div>
						</div>
					<?php endif; ?>
				<?php if($link) : ?>
					</a>
				<?php else : ?>
					</div>
				<?php endif; ?>
			<?php endif; ?>
		<?php endwhile; ?>
	</div>
	<div class="loading"></div>
	<script type="text/javascript">
		(function($) {
			$(document).ready(function() {
				$('#slideshow-<?php echo $id; ?>').nivoSlider({
					<?php echo implode(', ', $slider_options); if(count($slider_options)) { echo ','; } ?>
					beforeChange: function(){
						$('#slideshow-<?php echo $id; ?> .nivo-caption').animate({ opacity: 'hide' }, 500);
					},
					afterChange: function(){
						var data = $('#slideshow-<?php echo $id; ?>').data('nivo:vars');
						var index = data.currentSlide;
						if($('#slideshow-<?php echo $id; ?> .slide:eq('+index+') .caption').length) {
							$('#slideshow-<?php echo $id; ?> .nivo-caption').html($('#slideshow-<?php echo $id; ?> .slide:eq('+index+') .caption').html());
							$('#slideshow-<?php echo $id; ?> .nivo-caption').animate({ opacity: 'show' }, 500);
						} else {
							$('#slideshow-<?php echo $id; ?> .nivo-caption').html('');
						}
					},
					afterLoad: function(){
						if($('#slideshow-<?php echo $id; ?> .slide:eq(0) .caption').length) {
							$('#slideshow-<?php echo $id; ?> .nivo-caption').html($('#slideshow-<?php echo $id; ?> .slide:eq(0) .caption').html());
							$('#slideshow-<?php echo $id; ?> .nivo-caption').show();
						}
					}
				});
			});
		})(jQuery);
	</script>
<?php endif; ?>

<?php
}

?>