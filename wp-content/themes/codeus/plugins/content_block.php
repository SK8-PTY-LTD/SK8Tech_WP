<?php

function codeus_widget_print($post_id, $id) {
	global $post;
	$post = get_post($post_id);
	global $wp_registered_sidebars, $wp_registered_widgets;

		if ( !isset($wp_registered_widgets[$id]) ) return 0;

		$params = array_merge(
			array( array_merge( $wp_registered_sidebars['sidebar'], array('widget_id' => $id, 'widget_name' => $wp_registered_widgets[$id]['name']) ) ),
			(array) $wp_registered_widgets[$id]['params']
		);

		// Substitute HTML id and class attributes into before_widget
		$classname_ = '';
		foreach ( (array) $wp_registered_widgets[$id]['classname'] as $cn ) {
			if ( is_string($cn) )
				$classname_ .= '_' . $cn;
			elseif ( is_object($cn) )
				$classname_ .= '_' . get_class($cn);
		}
		$classname_ = ltrim($classname_, '_');
		$params[0]['before_widget'] = sprintf($params[0]['before_widget'], $id, $classname_);

		$params = apply_filters( 'dynamic_sidebar_params', $params );

		$callback = $wp_registered_widgets[$id]['callback'];

		do_action( 'dynamic_sidebar', $wp_registered_widgets[$id] );

		if ( is_callable($callback) ) {
			call_user_func_array($callback, $params);
			$did_one = true;
		}

}

/* Content block for news page */
function codeus_content_block($params = NULL) {
	$page = isset($params->page) ? $params->page : 0;
	$page = get_page($page);
	$block_class = 'fullwidth';
	if($page) {
		$page_template = get_post_meta($page->ID, '_wp_page_template', true);
		$page_sidebar = get_post_meta($page->ID, '_sidebars_widgets', true);
		if(is_array($page_sidebar) && count($page_sidebar)) {
			$page_sidebar = $page_sidebar['sidebar'];
			if(in_array($page_template, array('page_sidebar.php', 'page_sidebar_left.php'))) {
				$block_class = 'center';
			}
		}
		$page_title= apply_filters('the_title', $page->post_title);
		$page_content = apply_filters('the_content', $page->post_content);
	}
?>

<?php if(!$page) : ?>
	<div class="empty fullwidth"><?php _e('No Page', 'codeus'); ?></div>
<?php else : ?>
	<div>
		<?php if(is_array($page_sidebar) && $block_class != 'fullwidth' && count($page_sidebar)) : ?>
			<div class="panel clearfix">
		<?php endif; ?>
		<div class="<?php echo $block_class; ?>">
			<div class="lazy-loading" data-ll-item-delay="0">
				<h2 class="lazy-loading-item" data-ll-effect="drop-top" data-ll-step="0.5"><?php echo $page_title; ?></h2>
			</div>
			<div class="lazy-loading" data-ll-item-delay="0">
				<div class="lazy-loading-item" data-ll-effect="fading">
					<div class="inner"><?php echo $page_content; ?></div>
				</div>
			</div>
		</div>
		<?php if(is_array($page_sidebar) && $block_class != 'fullwidth' && count($page_sidebar)) : ?>
				<div class="sidebar">
					<?php foreach($page_sidebar as $widget) : ?>
						<?php codeus_widget_print($page->ID, $widget); ?>
					<?php endforeach; ?>
				</div>
			</div><!-- .panel -->
		<?php endif; ?>
	</div>
<?php endif; ?>

<?php
}

?>