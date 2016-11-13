<?php

/* Register new post type */
add_action('init', 'codeus_post_type_testimonials');
function codeus_post_type_testimonials() {
	$labels = array(
		'name' => _x('Testimonials', 'post type general name', 'codeus'),
		'singular_name' => _x('Testimonial', 'post type singular name', 'codeus'),
		'add_new' => _x('Add New Testimonial', 'book', 'codeus'),
		'add_new_item' => __('Add New Testimonial', 'codeus'),
		'edit_item' => __('Edit Testimonial', 'codeus'),
		'new_item' => __('New Testimonial', 'codeus'),
		'view_item' => __('View Testimonial', 'codeus'),
		'search_items' => __('Search Testimonials', 'codeus'),
		'not_found' =>  __('No Testimonial found', 'codeus'),
		'not_found_in_trash' => __('No Testimonial found in Trash', 'codeus'), 
		'parent_item_colon' => ''
	);
	$args = array(
		'labels' => $labels,
		'public' => false,
		'publicly_queryable' => false,
		'show_ui' => true, 
		'query_var' => false,
		'rewrite' => false,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'editor', 'thumbnail'),
	);

	register_post_type('codeus_testimonials', $args);
	flush_rewrite_rules();
	
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
		'codeus_testimonialsets',
		'codeus_testimonials',
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

/* Rebuild post form */
add_action('add_meta_boxes', 'codeus_testimonial_add_settings_box');
function codeus_testimonial_add_settings_box() {
	add_meta_box('codeus_testimonial_settings', __('Testimonial Settings', 'codeus'), 'codeus_testimonial_settings_box', 'codeus_testimonials', 'normal', 'default');
}

function codeus_testimonial_settings_box() {
	global $post;
	wp_nonce_field( plugin_basename(__FILE__), 'myplugin_noncename' );
	$testimonial_name = get_post_meta($post->ID, "codeus_testimonial_name", true);
	$testimonial_position = get_post_meta($post->ID, "codeus_testimonial_position", true);
	$testimonial_company = get_post_meta($post->ID, "codeus_testimonial_company", true);
	$testimonial_phone = get_post_meta($post->ID, "codeus_testimonial_phone", true);
	$testimonial_link = get_post_meta($post->ID, "codeus_testimonial_link", true);
?>
<p class="meta-options">
	<label for="testimonial_name"><?php _e( 'Name', 'codeus' ) ?>:</label><br /><input name="codeus_testimonial_name" type="text" id="testimonial_name" value="<?php print $testimonial_name; ?>" size="60" /><br />
	<label for="testimonial_position"><?php _e( 'Position', 'codeus' ) ?>:</label><br /><input name="codeus_testimonial_position" type="text" id="testimonial_position" value="<?php print $testimonial_position; ?>" size="60" /><br />
	<label for="testimonial_company"><?php _e( 'Company', 'codeus' ) ?>:</label><br /><input name="codeus_testimonial_company" type="text" id="testimonial_company" value="<?php print $testimonial_company; ?>" size="60" /><br />
	<label for="testimonial_phone"><?php _e( 'Tel.', 'codeus' ) ?>:</label><br /><input name="codeus_testimonial_phone" type="text" id="testimonial_phone" value="<?php print $testimonial_phone; ?>" size="60" /><br />
	<label for="testimonial_link"><?php _e( 'Link to Company', 'codeus' ) ?>:</label><br /><input name="codeus_testimonial_link" type="text" id="testimonial_link" value="<?php print $testimonial_link; ?>" size="60" />
</p>
<?php
}

add_action('save_post', 'codeus_testimonial_save_settings');
function codeus_testimonial_save_settings($post_id) {
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
		0 => 'codeus_testimonial_name',
		1 => 'codeus_testimonial_position',
		2 => 'codeus_testimonial_company',
		3 => 'codeus_testimonial_phone',
		4 => 'codeus_testimonial_link',
	);
	foreach($post_metas as $post_meta) {
		if(isset($_POST[$post_meta])) {
			update_post_meta($post_id, $post_meta, $_POST[$post_meta]);
		}
	}
}

add_action( 'widgets_init', 'codeus_testimonials_register_widgets' );
function codeus_testimonials_register_widgets() {
	if ( !is_blog_installed() )
		return;
	register_widget('Codeus_Widget_Testimonials');
}

class Codeus_Widget_Testimonials extends WP_Widget {

	function Codeus_Widget_Testimonials() {
		// Instantiate the parent object
		parent::__construct( 'testimonials', 'Testimonials' );
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		echo '<div class="testimonials_wrap">';
		codeus_get_testimonials($instance['sets']);
		echo '</div>';
?>
<script type='text/javascript'>
	jQuery('.sidebar .widget.widget_testimonials .widget-title').wrap('<div class="lazy-loading" data-ll-item-delay="0"><div class="lazy-loading-item" data-ll-effect="drop-top" data-ll-step="0.5"></div></div>');
	jQuery('.sidebar .widget.widget_testimonials .testimonials_wrap').wrap('<div class="lazy-loading" data-ll-item-delay="0"><div class="lazy-loading-item" data-ll-effect="drop-right-unwrap" data-ll-item-delay="400"></div></div>');
	jQuery('.sidebar .widget.widget_testimonials .testimonials_wrap .image > div').wrap('<span class="lazy-loading-item" style="display: block;" data-ll-item-delay="0" data-ll-effect="clip"></span>');
</script>
<?php
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$sets = array();
		foreach ($new_instance as $k=>$v) {
			if (preg_match('%^sets-(.+)$%', $k, $m))
				if ($m[1])
					$sets[] = $m[1];
		}
		$instance['sets'] = $sets;
		return $instance;
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'sets' => array() ) );
		$title = strip_tags($instance['title']);
		$sets = $instance['sets'];
		
		$terms = get_terms( 'codeus_testimonialsets', array('hide_empty' => false) );
?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'codeus'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		
		<div>
			<label><b><?php _e('Sets:', 'codeus'); ?></b></label>
			<div style="text-align: left;">
				<p>
					<input id="<?php echo $this->get_field_id('sets-__all__'); ?>" name="<?php echo $this->get_field_name('sets-__all__'); ?>" type="checkbox" <?php if (in_array('__all__', $sets)) echo 'checked="checked"'; ?> value="1" />
					<label for="<?php echo $this->get_field_id('sets-__all__'); ?>">All</label>
				</p>
				<?php foreach ($terms as $term){ ?>
					<p>
						<input id="<?php echo $this->get_field_id('sets-'.$term->term_id); ?>" name="<?php echo $this->get_field_name('sets-'.$term->term_id); ?>" type="checkbox" <?php if (in_array($term->term_id, $sets)) echo 'checked="checked"'; ?> value="1" />
						<label for="<?php echo $this->get_field_id('sets-'.$term->term_id); ?>"><?php echo $term->name; ?></label>
					</p>
				<?php } ?>
			</div>
		</div>
<?php
	}
}

function codeus_get_testimonials($sets) {
	
	if (in_array('__all__', $sets))
		$sets = array();
	
	$terms = get_terms( 'codeus_testimonialsets', array('hide_empty' => false) );
	
	$sets_list = array();
	foreach ($terms as $k=>$v)
		$sets_list[$v->term_id] = $v->slug;
	
	if (count($sets) > 0) {
		$tmp = array();
		foreach ($sets as $k=>$v)
			if ($sets_list[$v])
				$tmp[] = $sets_list[$v];
		$sets = $tmp;
	}
	
	$sets = implode(',', $sets);
	
	$testimonials_loop = new WP_Query(array(
		'post_type' => 'codeus_testimonials',
		'tax_query' => $sets ? array(
			array(
				'taxonomy' => 'codeus_testimonialsets',
				'field' => 'slug',
				'terms' => explode(',', $sets)
			)
		) : array(),
		'orderby' => 'rand',
		'posts_per_page' => -1,
	));
	global $post;
	$testimonials_posttemp = $post;
?>
<?php if($testimonials_loop->have_posts()) : ?>
	<div class="testimonials"><div class="testimonials-list">
		<?php while ( $testimonials_loop->have_posts() ) : $testimonials_loop->the_post(); ?>
			<div class="testimonial_item">
				<?php $image_url = codeus_thumbnail( get_post_thumbnail_id(), 'codeus_testimonial_photo'); ?>
				<table class="nostyle"><tbody><tr>
					<?php if($image_url[0]) : ?><td class="image"><div><img src="<?php echo $image_url[0]; ?>" alt="" /></div></td><?php endif; ?>
					<td class="info">
						<?php if(get_post_meta(get_the_ID(), 'codeus_testimonial_name', 1)) { echo '<span class="name">'.get_post_meta(get_the_ID(), 'codeus_testimonial_name', 1).'</span><br />'; } ?>
						<?php if(get_post_meta(get_the_ID(), 'codeus_testimonial_position', 1)) { echo get_post_meta(get_the_ID(), 'codeus_testimonial_position', 1).'<br />'; } ?>
						<?php if(get_post_meta(get_the_ID(), 'codeus_testimonial_company', 1)) { echo get_post_meta(get_the_ID(), 'codeus_testimonial_company', 1).'<br />'; } ?>
						<?php if(get_post_meta(get_the_ID(), 'codeus_testimonial_phone', 1)) { echo 'Tel.: '.get_post_meta(get_the_ID(), 'codeus_testimonial_phone', 1).'<br />'; } ?>
						<?php if(get_post_meta(get_the_ID(), 'codeus_testimonial_link', 1)) { echo '<a href="'.get_post_meta(get_the_ID(), 'codeus_testimonial_link', 1).'">'.get_post_meta(get_the_ID(), 'codeus_testimonial_link', 1).'</a>'; } ?>
					</td>
				</tr></tbody></table>
				<blockquote>
					<p>...<?php echo get_the_content(); ?></p>
				</blockquote>
			</div>
			<?php $post = $testimonials_posttemp; wp_reset_postdata(); ?>
		<?php endwhile; ?>
	</div><a href="javascript:void(0);" class="button next"><?php _e('Next', 'codeus'); ?></a></div>
<?php endif; ?>

<?php
}

?>