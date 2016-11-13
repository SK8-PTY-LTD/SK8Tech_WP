<?php

/* Register new post type */
add_action('init', 'codeus_post_type_team');
function codeus_post_type_team() {
	$labels = array(
		'name' => _x('Team', 'post type general name', 'codeus'),
		'singular_name' => _x('Team', 'post type singular name', 'codeus'),
		'add_new' => _x('Add New Person', 'book', 'codeus'),
		'add_new_item' => __('Add New Person', 'codeus'),
		'edit_item' => __('Edit Person', 'codeus'),
		'new_item' => __('New Person', 'codeus'),
		'view_item' => __('View Person', 'codeus'),
		'search_items' => __('Search Persons', 'codeus'),
		'not_found' => __('No Person found', 'codeus'),
		'not_found_in_trash' => __('No Person found in Trash', 'codeus'), 
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
		'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
	);

	register_post_type('codeus_team', $args);
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
		'codeus_teamsets',
		'codeus_team',
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
add_action('add_meta_boxes', 'codeus_team_add_settings_box');
function codeus_team_add_settings_box() {
	add_meta_box('codeus_team_settings', __('Team Settings', 'codeus'), 'codeus_team_settings_box', 'codeus_team', 'normal', 'default');
}

function codeus_team_settings_box() {
	global $post;
	wp_nonce_field( plugin_basename(__FILE__), 'myplugin_noncename' );
	$team_name = get_post_meta($post->ID, "codeus_team_name", true);
	$team_position = get_post_meta($post->ID, "codeus_team_position", true);
	$team_phone = get_post_meta($post->ID, "codeus_team_phone", true);
	$team_link = get_post_meta($post->ID, "codeus_team_link", true);
	$team_hide_email = get_post_meta($post->ID, "codeus_team_hide_email", true);
	$team_url = get_post_meta($post->ID, "codeus_team_url", true);
?>
<p class="meta-options">
	<label for="team_name"><?php _e( 'Name', 'codeus' ) ?>:</label><br /><input name="codeus_team_name" type="text" id="team_name" value="<?php print $team_name; ?>" size="60" /><br />
	<label for="team_position"><?php _e( 'Position', 'codeus' ) ?>:</label><br /><input name="codeus_team_position" type="text" id="team_position" value="<?php print $team_position; ?>" size="60" /><br />
	<label for="team_phone"><?php _e( 'Tel.', 'codeus' ) ?>:</label><br /><input name="codeus_team_phone" type="text" id="team_phone" value="<?php print $team_phone; ?>" size="60" /><br />
	<label for="team_link"><?php _e( 'Email', 'codeus' ) ?>:</label><br /><input name="codeus_team_link" type="text" id="team_link" value="<?php print $team_link; ?>" size="60" /><br />
	<label for="team_url"><?php _e( 'Link', 'codeus' ) ?>:</label><br /><input name="codeus_team_url" type="text" id="team_url" value="<?php print $team_url; ?>" size="60" /><br />
	<label for="team_hide_email"><?php _e( 'Hide Email', 'codeus' ) ?>:</label><br /><input name="codeus_team_hide_email" type="checkbox" id="team_hide_email" <?php if ($team_hide_email): ?>checked="checked"<?php endif; ?> />
</p>
<?php
}

add_action('save_post', 'codeus_team_save_settings');
function codeus_team_save_settings($post_id) {
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
		0 => 'codeus_team_name',
		1 => 'codeus_team_position',
		2 => 'codeus_team_phone',
		3 => 'codeus_team_link',
		4 => 'codeus_team_url',
		5 => 'codeus_team_hide_email',
	);
	foreach($post_metas as $post_meta) {
		if(isset($_POST[$post_meta])) {
			update_post_meta($post_id, $post_meta, $_POST[$post_meta]);
		}
	}
}

function strrotation($s) {
    static $letters = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz';
    $rep = substr($letters, 26) . substr($letters, 0, 26);
    return strtr($s, $letters, $rep);
}

add_action( 'widgets_init', 'codeus_team_register_widgets' );
function codeus_team_register_widgets() {
	if ( !is_blog_installed() )
		return;
	register_widget('Codeus_Widget_Team');
}

class Codeus_Widget_Team extends WP_Widget {

	function Codeus_Widget_Team() {
		// Instantiate the parent object
		parent::__construct( 'team', 'Team' );
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		echo $before_widget;
		if ( $title )
			echo $before_title . $title . $after_title;
		echo '<div class="testimonials_wrap">';
		codeus_get_team($instance['sets']);
		echo '</div>';
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
		
		$terms = get_terms( 'codeus_teamsets', array('hide_empty' => false) );
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

// Shortcode
function codeus_team_shortcode($team_atts) {
	extract(shortcode_atts(array(
		'teamsets' => '',
		'title' => ''
	), $team_atts));
	ob_start();
	codeus_team_list($teamsets, $title);
	$team_content = trim(preg_replace('/\s\s+/', '', ob_get_clean()));
	return $team_content;
}

function codeus_team_list($teamsets, $title) {
	if (!is_array($teamsets)) {
		$teamsets = explode(',', $teamsets);
	}
	foreach ($teamsets as $k=>$v) {
		$teamsets[$k] = trim($v);
	}
	
	if (in_array('__all__', $teamsets))
		$teamsets = array();
	
	$sets = implode(',', $teamsets);
	
	$team_loop = new WP_Query(array(
		'post_type' => 'codeus_team',
		'tax_query' => $sets ? array(
			array(
				'taxonomy' => 'codeus_teamsets',
				'field' => 'slug',
				'terms' => explode(',', $sets)
			)
		) : array(),
		'orderby' => 'menu_order',
		'order' => 'ASC',
		'posts_per_page' => -1,
	));
	
	global $post;
	global $vc_manager;
	$team_posttemp = $post;
?>
<?php if($team_loop->have_posts()) : ?>
	<div class="team-list-wrapper">
		<?php if ($title): ?><h2 class="title"><?php echo $title; ?></h2><?php endif; ?>
		<div class="team-list">
			<?php while ( $team_loop->have_posts() ) : $team_loop->the_post(); ?>
				<?php $image_url = codeus_thumbnail( get_post_thumbnail_id(), 'codeus_testimonial_photo'); ?>
				<div class="team-element">
					<div class="team-element-image">
						<?php if (get_post_meta(get_the_ID(), 'codeus_team_url', 1)): ?><a href="<?php echo get_post_meta(get_the_ID(), 'codeus_team_url', 1); ?>" rel="nofollow"><?php endif; ?>
						<?php if($image_url[0]) : ?>
							<img src="<?php echo $image_url[0]; ?>" alt="" />
						<?php else: ?>
							<img src="<?php echo get_template_directory_uri(); ?>/images/x.gif" alt="" />
						<?php endif; ?>
						<?php if (get_post_meta(get_the_ID(), 'codeus_team_url', 1)): ?></a><?php endif; ?>
					</div>
					<?php if (get_post_meta(get_the_ID(), 'codeus_team_name', 1)): ?><div class="team-element-name"><?php echo get_post_meta(get_the_ID(), 'codeus_team_name', 1); ?></div><?php endif; ?>
					<?php if (get_post_meta(get_the_ID(), 'codeus_team_position', 1)): ?><div class="team-element-position"><?php echo get_post_meta(get_the_ID(), 'codeus_team_position', 1); ?></div><?php endif; ?>
					<?php /* if (get_post_meta(get_the_ID(), 'codeus_team_phone', 1)): ?><div class="team-element-phone"><?php echo get_post_meta(get_the_ID(), 'codeus_team_phone', 1); ?></div><?php endif; */ ?>
					<?php if (get_post_meta(get_the_ID(), 'codeus_team_link', 1)): ?>
						<div class="team-element-email">
							<?php if (get_post_meta(get_the_ID(), 'codeus_team_hide_email', 1)): ?>
								<?php
									$email_code = strrotation('<a href="mailto:'.get_post_meta(get_the_ID(), 'codeus_team_link', 1).'">'.translate('Send Message', 'codeus').'</a>');
								?>
								<?php if($vc_manager->mode() != 'page_editable') : ?>
									<script type="text/javascript">
										document.write("<?php echo preg_replace("/\r?\n/", "\\n", addslashes($email_code)); ?>".replace(/[a-zA-Z]/g, function(c){return String.fromCharCode((c<="Z"?90:122)>=(c=c.charCodeAt(0)+13)?c:c-26);}));
									</script>
								<?php endif; ?>
							<?php else: ?>
								<a href="mailto:<?php echo get_post_meta(get_the_ID(), 'codeus_team_link', 1); ?>"><?php echo get_post_meta(get_the_ID(), 'codeus_team_link', 1); ?></a>
							<?php endif; ?>
						</div>
					<?php endif; ?>
				</div>
			<?php endwhile; ?>
			<?php $post = $team_posttemp; wp_reset_postdata(); ?>
		</div>
	</div>
<?php endif; ?>

<?php

}

function codeus_get_team($sets) {
	
	if (in_array('__all__', $sets))
		$sets = array();
	
	$terms = get_terms( 'codeus_teamsets', array('hide_empty' => false) );
	
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
	
	$team_loop = new WP_Query(array(
		'post_type' => 'codeus_team',
		'tax_query' => $sets ? array(
			array(
				'taxonomy' => 'codeus_teamsets',
				'field' => 'slug',
				'terms' => explode(',', $sets)
			)
		) : array(),
		'orderby' => 'rand',
		'posts_per_page' => -1,
	));
	global $post;
	global $vc_manager;
	$team_posttemp = $post;
?>
<?php if($team_loop->have_posts()) : ?>
	<div class="team-block">
		<?php while ( $team_loop->have_posts() ) : $team_loop->the_post(); ?>
			<div class="team-item">
				<?php $image_url = codeus_thumbnail( get_post_thumbnail_id(), 'codeus_testimonial_photo'); ?>
				<?php if($image_url[0]) : ?>
					<div class="team-image">
						<?php if (get_post_meta(get_the_ID(), 'codeus_team_url', 1)): ?><a href="<?php echo get_post_meta(get_the_ID(), 'codeus_team_url', 1); ?>" rel="nofollow"><?php endif; ?>
						<img src="<?php echo $image_url[0]; ?>" alt="" />
						<?php if (get_post_meta(get_the_ID(), 'codeus_team_url', 1)): ?></a><?php endif; ?>
					</div>
				<?php endif; ?>
				<?php if(get_post_meta(get_the_ID(), 'codeus_team_name', 1)): ?>
					<div class="team-name"><span class="text"><?php echo get_post_meta(get_the_ID(), 'codeus_team_name', 1); ?></span></div>
				<?php endif; ?>
				<?php if(get_post_meta(get_the_ID(), 'codeus_team_phone', 1)): ?>
					<div class="team-phone"><span class="icon">&#xe602;</span><span class="text"><?php echo get_post_meta(get_the_ID(), 'codeus_team_phone', 1); ?></span></div>
				<?php endif; ?>
				<?php if(get_post_meta(get_the_ID(), 'codeus_team_link', 1)): ?>
					<div class="team-email">
						<span class="icon">&#xe601;</span>
						<span class="text">
							<?php if (get_post_meta(get_the_ID(), 'codeus_team_hide_email', 1)): ?>
								<?php
									$email_code = strrotation('<a href="mailto:'.get_post_meta(get_the_ID(), 'codeus_team_link', 1).'">'.translate('Send Message', 'codeus').'</a>');
								?>
								<?php if($vc_manager->mode() != 'page_editable') : ?>
									<script type="text/javascript">
										document.write("<?php echo preg_replace("/\r?\n/", "\\n", addslashes($email_code)); ?>".replace(/[a-zA-Z]/g, function(c){return String.fromCharCode((c<="Z"?90:122)>=(c=c.charCodeAt(0)+13)?c:c-26);}));
									</script>
								<?php endif; ?>
							<?php else: ?>
								<a href="mailto:<?php echo get_post_meta(get_the_ID(), 'codeus_team_link', 1); ?>"><?php echo get_post_meta(get_the_ID(), 'codeus_team_link', 1); ?></a>
							<?php endif; ?>
						</span>
					</div>
				<?php endif; ?>
			</div>
			<?php $post = $team_posttemp; wp_reset_postdata(); ?>
		<?php endwhile; ?>
	</div>
<?php endif; ?>

<?php
}

?>