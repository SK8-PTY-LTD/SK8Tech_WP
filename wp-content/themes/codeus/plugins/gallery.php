<?php

/* Register new post type */
add_action('init', 'codeus_post_type_gallery');
function codeus_post_type_gallery() {
	$labels = array(
		'name' => _x('Galleries', 'post type general name', 'codeus'),
		'singular_name' => _x('Gallery', 'post type singular name', 'codeus'),
		'add_new' => _x('Add New Gallery', 'book', 'codeus'),
		'add_new_item' => __('Add New Gallery', 'codeus'),
		'edit_item' => __('Edit Gallery', 'codeus'),
		'new_item' => __('New Gallery', 'codeus'),
		'view_item' => __('View Gallery', 'codeus'),
		'search_items' => __('Search Gallery', 'codeus'),
		'not_found' => __('No Gallery found', 'codeus'),
		'not_found_in_trash' => __('No Gallery found in Trash', 'codeus'),
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
		'supports' => array('title'),
	);

	register_post_type('codeus_gallery', $args);

}

add_action('add_meta_boxes', 'codeus_gallery_add_settings_box');
function codeus_gallery_add_settings_box() {
	add_meta_box('codeus_gallery_settings', sprintf(__('Gallery Manager (ID = %s)', 'codeus'), (isset($_REQUEST['post']) && $_REQUEST['post'] ? $_REQUEST['post'] : 0)), 'codeus_gallery_settings_box', 'codeus_gallery', 'normal', 'default');
}

function codeus_gallery_settings_box() {

	global $post;
	if ( metadata_exists( 'post', $post->ID, 'codeus_gallery_images' ) ) {
		$codeus_gallery_images_ids = get_post_meta( $post->ID, 'codeus_gallery_images', true );
	} else {
		$attachments_ids = get_posts( 'post_parent=' . $post->ID . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids' );
		$codeus_gallery_images_ids = implode( ',', $attachments_ids);
	}

	$attachments_ids = array_filter( explode( ',', $codeus_gallery_images_ids ) );

	echo '<div id="gallery_manager">';
	echo '<input type="hidden" id="codeus_gallery_images" name="codeus_gallery_images" value="' . esc_attr( $codeus_gallery_images_ids ) . '" />';
	echo '<a id="upload_button" class="button" href="javascript:void(0);" style="font-size: 16px;">' . __('Add images','codeus') . '</a>';

	echo '<ul class="gallery-images">';
	if ( $attachments_ids ) {
		foreach ( $attachments_ids as $attachment_id ) {
			echo '<li class="image" data-attachment_id="' . esc_attr( $attachment_id ) . '"><a target="_blank" href="' . get_edit_post_link($attachment_id) . '" class="edit">' .wp_get_attachment_image( $attachment_id, 'thumbnail' ) . '</a><a href="javascript:void(0);" class="remove">x</a></li>';
		}
	}
	echo '</ul><br class="clear" />';

	echo '</div>';

?>



<?php

}


add_action('save_post', 'codeus_gallery_save_settings');
function codeus_gallery_save_settings($post_id) {
	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return $post_id;
	if(!isset($_POST['post_type'])) {
		return $post_id;
	}
	if(!current_user_can('edit_post', $post_id)) {
		return $post_id;
	}

	$attachments_ids = array_filter( explode( ',', $_POST['codeus_gallery_images'] ) );
	update_post_meta( $post_id, 'codeus_gallery_images', implode( ',', $attachments_ids ) );

}


if (isset($_GET['post']))
{
	if (get_post_type($_GET['post']) == "codeus_gallery")
	{
		add_action('admin_enqueue_scripts', 'codeus_gallery_admin_scripts');
	}
}

function codeus_gallery_admin_scripts ()
{
	wp_enqueue_script('thickbox');
	wp_register_script('gallery-upload', get_template_directory_uri().'/js/jquery.upload.js', array('jquery','media-upload','thickbox'));
	wp_enqueue_script('gallery-upload');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('jquery-ui-sortable', 'jquery-ui-widget', 'jquery-ui-core');
}

function edit_codeus_gallery_media_upload_tabs ($tabs)
{

	unset($tabs["type_url"]);
	unset($tabs["library"]);

	return $tabs;

}

/*

Detect Media Upload only for gallery/portfolio post type

*/

if (isset( $_REQUEST['post_id'] ) && get_post_type($_REQUEST['post_id']) == "codeus_gallery")
{

	/*

	Hook Gallery Scripts & Styles

	*/

	add_action('admin_print_scripts', 'codeus_gallery_admin_scripts');

	add_filter("media_upload_tabs", "edit_codeus_gallery_media_upload_tabs");

}

// Print gallery
function codeus_gallery($gallery = '', $gallery_size = 0, $style='no-style', $text_alignment='left', $shortcode=false, $ids='') {
	if(! empty($ids)) {
		$codeus_gallery_images_ids = $ids;
	} else {
		if ( metadata_exists( 'post', $gallery, 'codeus_gallery_images' ) ) {
			$codeus_gallery_images_ids = get_post_meta( $gallery, 'codeus_gallery_images', true );
		} else {
			$attachments_ids = get_posts( 'post_parent=' . $gallery . '&numberposts=-1&post_type=attachment&orderby=menu_order&order=ASC&post_mime_type=image&fields=ids' );
			$codeus_gallery_images_ids = implode( ',', $attachments_ids);
		}
	}
	$attachments_ids = array_filter( explode( ',', $codeus_gallery_images_ids ) );
?>
<?php if(count($attachments_ids)) : ?>
	<?php switch ($gallery_size) {
		case 0:
		case 1: {
	?>
		<div class="gallery noscript <?php echo ($gallery_size ? 'small' : 'full'); ?> <?php if ($shortcode) : ?>shortcode <?php echo $text_alignment; ?><?php endif; ?>">
			<div class="container">
				<ul class="preview clearfix styled">
					<?php foreach($attachments_ids as $attachment_id) : ?>
						<?php
							$item = get_post($attachment_id);
							$large_image_url = wp_get_attachment_image_src($item->ID, 'codeus_gallery_' . ($gallery_size ? 'small' : 'full'));
							$full_image_url = wp_get_attachment_image_src($item->ID, 'full');
						?>
						<?php if($large_image_url[0]) : ?>
							<li>
								<a class="fancy_gallery" rel="group-<?php echo $gallery; ?>" href="<?php echo $full_image_url[0]; ?>">
									<img src="<?php echo $large_image_url[0]; ?>" width="<?php echo $large_image_url[1]?>" height="<?php echo $large_image_url[2]?>" alt="" />
									<?php if($item->post_excerpt || $item->post_content) : ?>
										<span class="slide-info">
											<?php if($item->post_excerpt) : ?><span class="slide-caption"><?php echo $item->post_excerpt; ?></span><?php endif; ?>
											<?php if($item->post_content) : ?><span class="slide-description"><?php echo $item->post_content; ?></span><?php endif; ?>
										</span>
									<?php endif; ?>
									<span class="overlay"><span class="p-icon"></span></span>
								</a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>
			<div class="thumbs_wrapper">
				<ul class="thumbs clearfix styled">
					<?php foreach($attachments_ids as $attachment_id) : ?>
						<?php
							$item = get_post($attachment_id);
							$small_image_url = wp_get_attachment_image_src($item->ID, 'codeus_gallery_thumb');
						?>
						<?php if($small_image_url[0]) : ?>
							<li>
								<a class="thumb" href="<?php echo $large_image_url[0]; ?>">
									<img src="<?php echo $small_image_url[0]; ?>" width="<?php echo $small_image_url[1]?>" height="<?php echo $small_image_url[2]?>" alt="" />
								</a>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
		<div class="loading"></div>
	<?php
			break;
		}
		case 2: {
	?>
		<div class="gallery-three-columns">
				<ul class="preview clearfix styled">
					<?php foreach($attachments_ids as $attachment_id) : ?>
						<?php
							$item = get_post($attachment_id);
							$small_image_url = codeus_thumbnail($item->ID, 'codeus_gallery_medium');
							$full_image_url = wp_get_attachment_image_src($item->ID, 'full');
						?>
						<?php if($small_image_url[0]) : ?>
							<li>
								<div class="image wrap-box <?php echo $style; ?>" style="width: <?php echo $small_image_url[1]; ?>px; height: <?php echo $small_image_url[2]; ?>px;"><div class="wrap-box-inner">
									<?php if($style == 'style-5') { echo '<div class="shadow-wrap">'; } ?>
									<a class="fancy_gallery" rel="group-<?php echo $gallery; ?>" href="<?php echo $full_image_url[0]; ?>">
										<img src="<?php echo $small_image_url[0]; ?>" class="wrap-box-element" width="<?php echo $small_image_url[1]; ?>" height="<?php echo $small_image_url[2]; ?>" alt="">
										<span class="overlay"><span class="p-icon"></span></span>
										<span class="slide-info" style="display:none;">
											<?php if($item->post_excerpt) : ?><span class="slide-caption"><?php echo $item->post_excerpt; ?></span><?php endif; ?>
											<?php if($item->post_content) : ?><span class="slide-description"><?php echo $item->post_content; ?></span><?php endif; ?>
										</span>
									</a>
									<?php if($style == 'style-5') { echo '</div>'; } ?>
								</div>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
		</div>
	<?php
			break;
		}
		case 3: {
	?>
		<div class="gallery-four-columns">
				<ul class="preview clearfix styled">
					<?php foreach($attachments_ids as $attachment_id) : ?>
						<?php
							$item = get_post($attachment_id);
							$small_image_url = codeus_thumbnail($item->ID, 'codeus_gallery_medium_small');
							$full_image_url = wp_get_attachment_image_src($item->ID, 'full');
						?>
						<?php if($small_image_url[0]) : ?>
							<li>
								<div class="image wrap-box <?php echo $style; ?>" style="width: <?php echo $small_image_url[1]; ?>px; height: <?php echo $small_image_url[2]; ?>px;"><div class="wrap-box-inner">
									<?php if($style == 'style-5') { echo '<div class="shadow-wrap">'; } ?>
									<a class="fancy_gallery" rel="group-<?php echo $gallery; ?>" href="<?php echo $full_image_url[0]; ?>">
										<img src="<?php echo $small_image_url[0]; ?>" class="wrap-box-element" width="<?php echo $small_image_url[1]; ?>" height="<?php echo $small_image_url[2]; ?>" alt="">
										<span class="overlay"><span class="p-icon"></span></span>
										<span class="slide-info" style="display:none;">
											<?php if($item->post_excerpt) : ?><span class="slide-caption"><?php echo $item->post_excerpt; ?></span><?php endif; ?>
											<?php if($item->post_content) : ?><span class="slide-description"><?php echo $item->post_content; ?></span><?php endif; ?>
										</span>
									</a>
									<?php if($style == 'style-5') { echo '</div>'; } ?>
								</div>
							</li>
						<?php endif; ?>
					<?php endforeach; ?>
				</ul>
		</div>
	<?php
		}
			break;
		default:
			# code...
			break;
	} ?>

<?php endif; ?>

<?php
}

// Shortcode
function codeus_gallery_shortc($gallery_atts) {
	extract(shortcode_atts(array(
		'gallery_id' => 0,
		'gallery_size' => 0,
		'text_alignment'=>'left',
		'title' => '',
		'style' => 'no-style',
		'ids' => '',
	), $gallery_atts));
	ob_start();
	codeus_gallery($gallery_id,$gallery_size,$style,$text_alignment,true,$ids);
	$gallery_content = trim(preg_replace('/\s\s+/', '', ob_get_clean()));
	if($title) {
		$gallery_content = '<h3>'.$title.'</h3>'.$gallery_content;
	}
	return $gallery_content;
}

?>