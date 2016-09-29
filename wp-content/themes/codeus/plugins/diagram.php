<?php

add_action( 'widgets_init', 'codeus_diagram_register_widgets' );
function codeus_diagram_register_widgets() {
	if ( !is_blog_installed() )
		return;
	register_widget('Codeus_Widget_Diagram');
}

class Codeus_Widget_Diagram extends WP_Widget {

	function Codeus_Widget_Diagram() {
		// Instantiate the parent object
		parent::__construct( 'diagram', 'Diagram' );
	}

	function widget( $args, $instance ) {
		extract($args);
		$title = apply_filters('widget_title', empty($instance['title']) ? '' : $instance['title'], $instance, $this->id_base);
		echo $before_widget;
		echo '<div class="diagram-item">';
		echo '<div class="diagram-wrapper">';
		codeus_build_diagram($title, $instance['summary'], $instance['type'], $instance['skills'], true);
		echo '</div>';
		echo '</div>';
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['summary'] = strip_tags($new_instance['summary']);
		$instance['type'] = strip_tags($new_instance['type']);
		$instance['skills'] = $new_instance['skills'];
		var_dump($instance);
		return $instance;
	}
	
	function get_skill_code($id, $data=null) {
		if (!is_array($data))
			$data = array(
				'title' => '',
				'amount' => '',
				'color' => '',
			);
		?>
			<fieldset style="border: 1px dashed #DFDFDF; padding: 0 5px; margin: 0 0 10px 0;">
				<p><label for="skill_<?php echo $id.'_'.$this->get_field_id('title'); ?>"><?php _e('Title:', 'codeus'); ?></label>
				<input class="widefat" id="skill_<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('skills').'['.$id.'][title]'; ?>" type="text" value="<?php echo esc_attr($data['title']); ?>" /></p>
				<p><label for="skill_<?php echo $id.'_'.$this->get_field_id('amount'); ?>"><?php _e('Amount (in percents):', 'codeus'); ?></label>
				<input class="widefat" id="skill_<?php echo $this->get_field_id('amount'); ?>" name="<?php echo $this->get_field_name('skills').'['.$id.'][amount]'; ?>" type="text" value="<?php echo esc_attr($data['amount']); ?>" /></p>
				<div><label for="skill_<?php echo $id.'_'.$this->get_field_id('color'); ?>"><?php _e('Color:', 'codeus'); ?></label>
				<div><input class="widefat color-select" style="float: left;" id="skill_<?php echo $this->get_field_id('color'); ?>" name="<?php echo $this->get_field_name('skills').'['.$id.'][color]'; ?>" type="text" value="<?php echo esc_attr($data['color']); ?>" /></div><br style="clear: both;"></div>
				<div class="widget-control-actions"><a href="#" class="diagram-delete-skill">Delete skill</a></div>
			</fieldset>
		<?php
	}
	
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'summary' => '', 'type' => '', 'skills' => array() ) );
		$title = strip_tags($instance['title']);
		$summary = strip_tags($instance['summary']);
		$type = strip_tags($instance['type']);
		$skills = $instance['skills'];
?>
		<script class="diagram-edit-skill-template" type="text/template">
			<?php $this->get_skill_code('%INDEX%'); ?>
		</script>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:', 'codeus'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>
		
		<p><label for="<?php echo $this->get_field_id('summary'); ?>"><?php _e('Summary:', 'codeus'); ?></label>
		<textarea class="widefat" id="<?php echo $this->get_field_id('summary'); ?>" name="<?php echo $this->get_field_name('summary'); ?>"><?php echo esc_attr($summary); ?></textarea></p>
		
		<p><label for="<?php echo $this->get_field_id('type'); ?>"><?php _e('Type:', 'codeus'); ?></label>
		<select class="widefat" id="<?php echo $this->get_field_id('type'); ?>" name="<?php echo $this->get_field_name('type'); ?>">
			<option <?php if ($type == 'circle') echo 'selected="selected"'; ?> value="circle"><?php _e('Circle', 'codeus'); ?></option>
			<option <?php if ($type == 'line') echo 'selected="selected"'; ?> value="line"><?php _e('Lines', 'codeus'); ?></option>
		</select></p>
		<p><?php _e('Skills', 'codeus'); ?>:</p>
		<div class="diagram-edit-skills">
			<?php
				if (count($skills) > 0)
					foreach ($skills as $key=>$skill)
						$this->get_skill_code($key, $skill);
				else
					$this->get_skill_code(0);
			?>
			<div class="widget-control-actions" style="margin-top: 10px;"><a class="diagram-edit-add-skill" href="#">Add skill</a></div>
		</div>
		<script type="text/javascript">
			if (codeus_init_diagram_edit != undefined)
				codeus_init_diagram_edit();
		</script>
<?php
	}
}

add_action( 'admin_enqueue_scripts', 'codeus_admin_diagram__scripts_init' );
function codeus_admin_diagram__scripts_init() {
	wp_enqueue_script('diagram-edit', get_template_directory_uri() . '/js/diagram_edit.js', array('jquery'));
}

function codeus_build_diagram($title, $summary, $type, $skills, $is_widget) {
	if ($type == 'line')
		codeus_build_line_diagram($title, $summary, $skills, $is_widget);
	
	if ($type == 'circle')
		codeus_build_circle_diagram($title, $summary, $skills);
}

function codeus_build_line_diagram($title, $summary, $skills, $is_widget) {
	?>
	<?php if (!empty($title)): ?>
		<h3 <?php if ($is_widget): ?>class="widget-title"<?php endif; ?>><?php echo $title; ?></h3>
	<?php endif; ?>
	<?php if (!empty($summary)): ?>
		<div <?php if ($is_widget): ?>class="diagram-summary"<?php else: ?>class="diagram-summary-text"<?php endif; ?>><?php echo $summary; ?></div>
	<?php endif; ?>
	<div class="lazy-loading lazy-loading-not-hide" data-ll-item-delay="0">
		<div class="digram-line-box lazy-loading-item" data-ll-effect="action" data-ll-action-func="codeus_start_line_digram">
			<?php foreach ($skills as $skill): ?>
				<div class="skill-element">
					<div class="skill-header clearfix">
						<div class="skill-title"><?php echo $skill['title']; ?></div>
						<div class="skill-amount"><?php echo $skill['amount']; ?></div>
					</div>
					<div class="skill-line"><div data-amount="<?php echo $skill['amount']; ?>" style="width: 0; background: <?php echo $skill['color']; ?>;"></div></div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
}

function codeus_build_circle_diagram($title, $summary, $skills) {
	$max_font_size = 0;
	if(codeus_get_option('h5_font_size')) {
		$max_font_size = codeus_get_option('h5_font_size');
	} else if (codeus_get_option('body_font_size')) {
		$max_font_size = codeus_get_option('body_font_size');
	}
	?>
	<div class="diagram-circle clearfix" <?php if ($max_font_size != 0): ?>data-max-font-size="<?php echo $max_font_size; ?>"<?php endif; ?> data-title="<?php echo htmlspecialchars($title); ?>" data-summary="<?php echo htmlspecialchars($summary); ?>">
		<div class="box-wrapper">
			<div class="box"></div>
		</div>
		<div class="skills">
			<?php foreach ($skills as $skill): ?>
				<div class="skill-arc">
					<span class="title"><?php echo $skill['title']; ?></span>
					<input type="hidden" class="percent" value="<?php echo $skill['amount']; ?>" />
					<input type="hidden" class="color" value="<?php echo $skill['color']; ?>" />
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php
}

// Shortcode
function codeus_diagram_shortcode($atts, $content) {
	extract(shortcode_atts(array(
		'title' => '',
		'summary' => '',
		'type' => 'circle',
	), $atts));
	$pattern = get_shortcode_regex();
	$matches = array();
	preg_match_all("/$pattern/s", $content, $matches);
	$skills = array();
	foreach ($matches[0] as $v) {
		$js = do_shortcode($v);
		$skill = json_decode($js, true);
		$skills[] = $skill;
	}
	$return_html = '<div class="diagram-item">';
	$return_html .= '<div class="diagram-wrapper">';
	ob_start();
	codeus_build_diagram($title, $summary, $type, $skills, false);
	$return_html .= trim(preg_replace('/\s\s+/', '', ob_get_clean()));
	$return_html .= '</div>';
	$return_html .= "</div>";
	return $return_html;
}

function codeus_skill_shortcode($atts, $content) {
	return json_encode($atts);
}

?>