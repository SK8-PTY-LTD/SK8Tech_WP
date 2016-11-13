<?php

/* Register new post type */
add_action('init', 'codeus_post_type_client');
function codeus_post_type_client() {
	$labels = array(
		'name' => _x('Client', 'post type general name', 'codeus'),
		'menu_name' => __('Clients', 'codeus'),
		'singular_name' => _x('Client', 'post type singular name', 'codeus'),
		'add_new' => _x('Add New Client', 'book', 'codeus'),
		'add_new_item' => __('Add New Client', 'codeus'),
		'edit_item' => __('Edit Client', 'codeus'),
		'new_item' => __('New Client', 'codeus'),
		'view_item' => __('View Client', 'codeus'),
		'search_items' => __('Search Clients', 'codeus'),
		'not_found' =>  __('No Clients found', 'codeus'),
		'not_found_in_trash' => __('No Clients found in Trash', 'codeus'), 
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $labels,
		'public' => false,
		'query_var' => false,
		'publicly_queryable' => false,
		'show_ui' => true, 
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'thumbnail', 'page-attributes'),
	);

	register_post_type('codeus_client', $args);

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
		'codeus_clientssets',
		'codeus_client',
		array(
			'labels'=> $labels,
			'show_ui' => true,
			'public'=>false,
			'rewrite' => false,
			'query_var' => false,
			'hierarchical' => false,
		)
	);
}

/* Rebuild post form */
add_action( 'do_meta_boxes', 'codeus_client_image_box' );
function codeus_client_image_box() {
	remove_meta_box( 'postimagediv', 'client', 'side' );
	add_meta_box('postimagediv', __('Client Image', 'codeus'), 'post_thumbnail_meta_box', 'codeus_client', 'normal', 'high');
}


add_action('add_meta_boxes', 'codeus_client_add_settings_box');
function codeus_client_add_settings_box() {
	add_meta_box('codeus_client_settings', __('Client Settings', 'codeus'), 'codeus_client_settings_box', 'codeus_client', 'normal', 'default');
}

function codeus_client_settings_box() {
	global $post;
	wp_nonce_field( plugin_basename(__FILE__), 'myplugin_noncename' );
	$client_description = get_post_meta($post->ID, "codeus_client_description", true);
	$client_link = get_post_meta($post->ID, "codeus_client_link", true);
?>
<p class="meta-options">
	<label for="client_description"><?php _e( 'Client description', 'codeus' ); ?>:</label><br /><input name="codeus_client_description" type="text" id="client_description" value="<?php print $client_description; ?>" size="60" /><br />
	<label for="client_link"><?php _e( 'Client link', 'codeus' ); ?>:</label><br /><input name="codeus_client_link" type="text" id="client_link" value="<?php print $client_link; ?>" size="60" />
</p>
<?php
}

add_action('save_post', 'codeus_client_save_settings');
function codeus_client_save_settings($post_id) {
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
		0 => 'codeus_client_description',
		1 => 'codeus_client_link',
	);
	foreach($post_metas as $post_meta) {
		if(isset($_POST[$post_meta])) {
			update_post_meta($post_id, $post_meta, $_POST[$post_meta]);
		}
	}
}

// Print Clients
function codeus_clients_block($clientsset = '', $title = '') {
	$clients_loop = new WP_Query(array(
		'post_type' => 'codeus_client',
		'tax_query' =>$clientsset ? array(
			array(
				'taxonomy' => 'codeus_clientssets',
				'field' => 'slug',
				'terms' => explode(',', $clientsset)
			)
		) : array(),
		'orderby' => 'menu_order ID',
		'order' => 'ASC',
		'posts_per_page' => -1,
	));
	$clients_title = __('Our Clients', 'codeus');
	$clients_description = '';
	if($clients_set = get_term_by('slug', $clientsset, 'codeus_clientssets')) {
		$clients_title = $clients_set->name;
		$clients_description = $clients_set->description;
	}
	$clients_title = $title ? $title : $clients_title;
	global $post;
	$client_posttemp = $post;
?>
<?php if($clients_loop->have_posts()) : ?>
	<div class="central-wrapper"><div class="fullwidth">
		<h2 class="bar-title"><?php echo $clients_title; ?></h2>
		<?php if($clients_description) : ?>
			<div class="set-description"><?php echo $clients_description; ?></div>
		<?php endif; ?>
	</div></div>
	<div class="carousel-wrapper"><div class="carousel"><ul class="list lazy-loading styled" data-ll-item-delay="0">
		<?php while ( $clients_loop->have_posts() ) : $clients_loop->the_post(); $image = codeus_thumbnail( get_post_thumbnail_id(), 'codeus_clients_block_item'); ?>
			<li class="lazy-loading-item" data-ll-effect="drop-right">
				<a href="<?php echo get_post_meta($post->ID, 'codeus_client_link', 1); ?>" class="clearfix" title="<?php the_title(); ?>"><span style="background-image: url('<?php echo $image[0]; ?>');"></span></a>
			</li>
			<?php $post = $client_posttemp; wp_reset_postdata(); ?>
		<?php endwhile; ?>
	</ul></div></div>
<?php endif; ?>

<?php
}

function codeus_clients($clientsset = '', $count = -1, $client_filter=true) {
	$clients_loop = new WP_Query(array(
		'post_type' => 'codeus_client',
		'tax_query' =>$clientsset ? array(
			array(
				'taxonomy' => 'codeus_clientssets',
				'field' => 'slug',
				'terms' => explode(',', $clientsset)
			)
		) : array(),
		'orderby' => 'menu_order ID',
		'order' => 'ASC',
		'posts_per_page' => -1,
	));
	global $post;
	$client_posttemp = $post;
?>
<?php if($clients_loop->have_posts()) : ?>
	<div class="clients lazy-loading" data-count="<?php echo $count; ?>">
		<?php if ($client_filter) : ?>
			<?php
				if($clientsset) {
					$terms = explode(',', $clientsset);
					foreach($terms as $key => $term) {
						$terms[$key] = get_term_by('slug', $term, 'codeus_clientssets');
						if(!$terms[$key]) {
							unset($terms[$key]);
						}
					}
				} else {
					$terms = get_terms('codeus_clientssets', array('hide_empty' => false));
				}
				$terms_set = array();
				foreach ($terms as $term)
					$terms_set[$term->slug] = $term;
			?>
			<?php if(count($terms)) : ?>
				<ul class="filter styled">
					<li class="mix-filter iconed" data-filter="all">
						<a href="javascript:void(0);">
							<span class="icon">&#xe645;</span>
							<?php _e('Show All', 'codeus'); ?>
						</a>
					</li>
					<?php foreach($terms as $term) : ?>
						<li data-filter="<?php echo $term->slug; ?>" class="mix-filter <?php if(get_option('clientssets_' . $term->term_id . '_icon')) { echo 'iconed'; } ?>">
							<a href="javascript:void(0);">
								<?php if(get_option('clientssets_' . $term->term_id . '_icon')) : ?><span class="icon">&#x<?php echo get_option('clientssets_' . $term->term_id . '_icon'); ?>;</span><?php endif; ?>
								<?php echo $term->name; ?>
							</a>
						</li>
					<?php endforeach; ?>
				</ul>
			<?php endif; ?>
		<?php endif; ?>
		<ul class="list styled">
			<?php while ( $clients_loop->have_posts() ) : $clients_loop->the_post(); ?>
			<?php $slugs = wp_get_object_terms($post->ID, 'codeus_clientssets', array('fields' => 'slugs')); ?>
			<?php
				if(!($link = get_post_meta($post->ID, 'codeus_client_link', 1))) {
					$link = '#';
				}
				if(!($image = codeus_thumbnail( get_post_thumbnail_id(), 'codeus_clients_block_item'))) {
					$image = array(0 => 'none');
				}
				;
			?>
			<li class="<?php echo implode(' ', $slugs); ?> lazy-loading-item" data-ll-effect="drop-right" data-ll-item-delay="0">
				<a href="<?php echo $link; ?>" title="<?php the_title(); ?>"><span style="background-image: url('<?php echo $image[0]; ?>');"></span></a>
			</li>
			<?php $post = $client_posttemp; wp_reset_postdata(); ?>
			<?php endwhile; ?>
		</ul>
	</div>
<?php endif; ?>

<?php
}

// Shortcode
function codeus_clients_shortcode($clients_atts) {
	extract(shortcode_atts(array(
		'clientsset' => '',
		'title' => '',
		'count' => -1,
		'filter_disabled' => false
	), $clients_atts));
	ob_start();
	codeus_clients($clientsset, $count, !$filter_disabled);
	$clients_content = trim(preg_replace('/\s\s+/', '', ob_get_clean()));
	if($title) {
		$clients_content = '<h3>'.$title.'</h3>'.$clients_content;
	}
	return $clients_content;
}

add_action('codeus_clientssets_edit_form','codeus_clientssets_form');
add_action('codeus_clientssets_add_form','codeus_clientssets_form');

function codeus_clientssets_form() {
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
}

add_action('codeus_clientssets_add_form_fields','codeus_clientssets_add_form_fields');
function codeus_clientssets_add_form_fields() {
?>
	<div class="form-field">
		<label for="clientssets_icon"><?php _e('Icon', 'codeus'); ?></label>
		<input class= "icon" type="text" id="clientssets_icon" name="clientssets_icon"/><br/>
		<?php _e('Enter icon code', 'codeus'); ?>. <a href="<?php echo get_template_directory_uri(); ?>/fonts/user-icons-list.php" onclick="tb_show('<?php _e('Icons info', 'codeus'); ?>', this.href+'?TB_iframe=true'); return false;"><?php _e('Show Icon Codes', 'codeus'); ?></a>
	</div>
<?php
}

add_action('codeus_clientssets_edit_form_fields','codeus_clientssets_edit_form_fields');
function codeus_clientssets_edit_form_fields() {
?>
	<tr class="form-field">
		<th valign="top" scope="row"><label for="clientssets_icon"><?php _e('Icon', 'codeus'); ?></label></th>
		<td>
			<input class= "icon" type="text" id="clientssets_icon" name="clientssets_icon" value="<?php echo get_option('clientssets_' . $_REQUEST['tag_ID'] . '_icon'); ?>"/><br />
			<span class="description"><?php _e('Enter icon code', 'codeus'); ?>. <a href="<?php echo get_template_directory_uri(); ?>/fonts/user-icons-list.php" onclick="tb_show('<?php _e('Icons info', 'codeus'); ?>', this.href+'?TB_iframe=true'); return false;"><?php _e('Show Icon Codes', 'codeus'); ?></a></span>
		</td>
	</tr>
<?php
}

add_action('create_codeus_clientssets','codeus_clientssets_create');
function codeus_clientssets_create($id) {
	if(isset($_REQUEST['clientssets_icon'])) {
		update_option( 'clientssets_' . $id . '_icon', $_REQUEST['clientssets_icon'] );
	}
}

add_action('edit_codeus_clientssets','codeus_clientssets_update');
function codeus_clientssets_update($id) {
	if(isset($_REQUEST['clientssets_icon'])) {
		update_option( 'clientssets_' . $id . '_icon', $_REQUEST['clientssets_icon'] );
	}
}

add_action('delete_codeus_clientssets','codeus_clientssets_delete');
function codeus_clientssets_delete($id) {
	delete_option( 'clientssets_' . $id . '_icon' );
}

?>