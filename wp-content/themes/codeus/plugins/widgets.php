<?php

add_action( 'widgets_init', 'codeus_register_widgets' );
function codeus_register_widgets() {
	if ( !is_blog_installed() )
		return;
	register_widget('Codeus_Widget_Picturebox');
	register_widget('Codeus_Widget_Popular_Posts');
	register_widget('Codeus_Widget_Recent_Posts');
	register_widget('Codeus_Widget_Flickr');
	register_widget('Codeus_Widget_Submenu');
	register_widget('Codeus_Widget_Tweets');
	register_widget('Codeus_Widget_Facebook_Page');
}

/* PICTUREBOX */

class Codeus_Widget_Picturebox extends WP_Widget {
	function Codeus_Widget_Picturebox() {
		$widget_ops = array('classname' => 'picturebox', 'description' => __('Display Picture', 'codeus') );
		parent::__construct('Picturebox', __('Picturebox', 'codeus'), $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$image = $instance['image'];
		$title = $instance['title'];
		$text = $instance['text'];
		$link = $instance['link'];
		if(!empty($image)) {
			if(!empty($title)) {
				echo $before_title.$title.$after_title;
			}
			echo '<div class="image">';
			if(!empty($link)) {
				echo '<a href="'.$link.'">';
			} else {
				echo '<a href="'.$image.'" class="fancy">';
			}
			if($image) {
				echo '<img src="'.$image.'" alt="'.$title.'"/>';
			}
			echo '</a>';
			echo '</div>';
			if(!empty($text)) {
				echo '<div class="description">'.$text.'</div>';
			}
		}
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['image'] = strip_tags($new_instance['image']);
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = $new_instance['text'];
		$instance['link'] = strip_tags($new_instance['link']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'image' => '', 'title' => '', 'text' => '', 'link' => '' ) );
		$image = strip_tags($instance['image']);
		$title = strip_tags($instance['title']);
		$text = $instance['text'];
		$link = strip_tags($instance['link']);

?>
			<p><label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Image link', 'codeus'); ?>: <input class="widefat picture-select" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="text" value="<?php echo esc_attr($image); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'codeus'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Description', 'codeus'); ?>: <textarea class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>"><?php echo esc_attr($text); ?></textarea></label></p>
			<p><label for="<?php echo $this->get_field_id('link'); ?>"><?php _e('Link', 'codeus'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('link'); ?>" name="<?php echo $this->get_field_name('link'); ?>" type="text" value="<?php echo esc_attr($link); ?>" /></label></p>
<?php
	}
}

/* POPULAR POSTS */

class Codeus_Widget_Popular_Posts extends WP_Widget {
	function Codeus_Widget_Popular_Posts() {
		$widget_ops = array('classname' => 'Custom_Popular_Posts', 'description' => __('The popular posts with thumbnails', 'codeus') );
		parent::__construct('Custom_Popular_Posts', __('Popular Posts', 'codeus'), $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = $instance['title'];
		$items = $instance['items'];
		
		if(!is_numeric($items))
		{
			$items = 3;
		}
		if(empty($title)) {
			$title = __('Popular Posts', 'codeus');
		}

		if(!empty($items))
		{
			echo $before_title.$title.$after_title;
			pp_posts('popular', $items, TRUE);
		}
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['items'] = strip_tags($new_instance['items']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'items' => '') );
		$title = strip_tags($instance['title']);
		$items = strip_tags($instance['items']);

?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'codeus'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('items'); ?>"><?php _e('Items (default 3)', 'codeus'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" /></label></p>
<?php
	}
}

/* RECENT POSTS */

class Codeus_Widget_Recent_Posts extends WP_Widget {
	function Codeus_Widget_Recent_Posts() {
		$widget_ops = array('classname' => 'Custom_Recent_Posts', 'description' => __('The recent posts with thumbnails', 'codeus') );
		parent::__construct('Custom_Recent_Posts', __('Recent Posts', 'codeus'), $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$title = $instance['title'];
		$items = $instance['items'];
		
		if(!is_numeric($items))
		{
			$items = 3;
		}
		if(empty($title)) {
			$title = __('Recent Posts', 'codeus');
		}

		if(!empty($items))
		{
			echo $before_title.$title.$after_title;
			pp_posts('recent', $items, TRUE);
		}
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['items'] = strip_tags($new_instance['items']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'items' => '') );
		$title = strip_tags($instance['title']);
		$items = strip_tags($instance['items']);

?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'codeus'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('items'); ?>"><?php _e('Items (default 3)', 'codeus'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" /></label></p>
<?php
	}
}


function pp_posts($sort = 'recent', $items = 3, $echo = TRUE)
{
	$return_html = '';
	
	if($sort == 'recent')
	{
		$posts = get_posts('numberposts='.$items.'&order=DESC&orderby=date&post_type=post&post_status=publish');
	}
	else
	{
		global $wpdb;
		
		$query = "SELECT ID, post_title, post_content, post_date FROM {$wpdb->prefix}posts WHERE post_type = 'post' AND post_status= 'publish' ORDER BY comment_count DESC LIMIT 0,".$items;
		$posts = $wpdb->get_results($query);
	}
	
	if(!empty($posts))
	{
		$return_html.= '<ul class="posts blog styled">';

			foreach($posts as $post)
			{
				$image_thumb = '';
								
				if(has_post_thumbnail($post->ID, 'codeus_post_list')) {
					$image_id = get_post_thumbnail_id($post->ID);
					$image_thumb = wp_get_attachment_image_src($image_id, 'codeus_post_list', true);
				}
				
				$return_html.= '<li class="clearfix"><table class="nostyle"><tbody><tr>';
				
				if(!empty($image_thumb)) {
					$return_html.= '<td><div class="image"><a href="'.get_permalink($post->ID).'"><img src="'.$image_thumb[0].'" alt=""/></a></div></td>';
				} else {
					$return_html.= '<td><div class="image dummy"><a href="'.get_permalink($post->ID).'"></a></div></td>';
				}
				$return_html.= '<td><a href="'.get_permalink($post->ID).'">'.$post->post_title.'</a><br/>';
				$return_html.= '<span class="date">'.apply_filters('get_the_date', mysql2date(get_option('date_format'), $post->post_date), '').'</span><span></td></tr></tbody></table></li>';

			}

		$return_html.= '</ul>';

	}
	
	if($echo)
	{
		echo $return_html;
	}
	else
	{
		return $return_html;
	}
}

/* PHOTOSTREAM */

class Codeus_Widget_Flickr extends WP_Widget {
	function Codeus_Widget_Flickr() {
		$widget_ops = array('classname' => 'Custom_Flickr', 'description' => __('Display your recent Flickr photos', 'codeus') );
		parent::__construct('Custom_Flickr', __('Flickr', 'codeus'), $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$flickr_id = empty($instance['flickr_id']) ? ' ' : apply_filters('widget_title', $instance['flickr_id']);
		$title = $instance['title'];
		$items = $instance['items'];
		
		if(!is_numeric($items))
		{
			$items = 9;
		}
		
		if(empty($title))
		{
			$title = __('Photostream', 'codeus');
		}
		
		if(!empty($items) && !empty($flickr_id))
		{
			$photos_arr = get_flickr(array('type' => 'user', 'id' => $flickr_id, 'items' => $items));
			
			if(!empty($photos_arr))
			{
				echo $before_title.$title.$after_title;
				echo '<div class="flickr clearfix">';
				$num = 0;
				foreach($photos_arr as $photo) {
					echo '<div class="flickr-item position-'.($num % 3).'">';
					echo '<a href="'.$photo['url'].'" title="'.$photo['title'].'" class="fancy"><img src="'.$photo['thumb_url'].'" alt="" /></a>';
					echo '</div>';
					$num++;
				}
				
				echo '</div>';
			}
		}
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['items'] = strip_tags($new_instance['items']);
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['flickr_id'] = strip_tags($new_instance['flickr_id']);

		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'items' => '', 'flickr_id' => '', 'title' => '') );
		$items = strip_tags($instance['items']);
		$flickr_id = strip_tags($instance['flickr_id']);
		$title = strip_tags($instance['title']);

?>
			<p><label for="<?php echo $this->get_field_id('flickr_id'); ?>"><?php printf(__('Flickr ID <a href="%s">Find your Flickr ID here</a>', 'codeus'), 'http://idgettr.com/'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('flickr_id'); ?>" name="<?php echo $this->get_field_name('flickr_id'); ?>" type="text" value="<?php echo esc_attr($flickr_id); ?>" /></label></p>
			
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'codeus'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

			<p><label for="<?php echo $this->get_field_id('items'); ?>"><?php _e('Items (default 9)', 'codeus'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('items'); ?>" name="<?php echo $this->get_field_name('items'); ?>" type="text" value="<?php echo esc_attr($items); ?>" /></label></p>
<?php
	}
}

function get_flickr($settings) {
	if (!function_exists('MagpieRSS')) {
	    // Check if another plugin is using RSS, may not work
	    include_once (ABSPATH . WPINC . '/class-simplepie.php');
	}
	
	if(!isset($settings['items']) || empty($settings['items']))
	{
		$settings['items'] = 9;
	}
	
	// get the feeds
	if ($settings['type'] == "user") { $rss_url = 'http://api.flickr.com/services/feeds/photos_public.gne?id=' . $settings['id'] . '&tags=' . (isset($settings['tags']) ? $settings['tags'] : ''). '&per_page='.$settings['items'].'&format=rss_200'; }
	elseif ($settings['type'] == "favorite") { $rss_url = 'http://api.flickr.com/services/feeds/photos_faves.gne?id=' . $settings['id'] . '&format=rss_200'; }
	elseif ($settings['type'] == "set") { $rss_url = 'http://api.flickr.com/services/feeds/photoset.gne?set=' . $settings['set'] . '&nsid=' . $settings['id'] . '&format=rss_200'; }
	elseif ($settings['type'] == "group") { $rss_url = 'http://api.flickr.com/services/feeds/groups_pool.gne?id=' . $settings['id'] . '&format=rss_200'; }
	elseif ($settings['type'] == "public" || $settings['type'] == "community") { $rss_url = 'http://api.flickr.com/services/feeds/photos_public.gne?tags=' . $settings['tags'] . '&format=rss_200'; }
	else {
	    print '<strong>'.__('No "type" parameter has been setup. Check your settings, or provide the parameter as an argument.', 'codeus').'</strong>';
	    die();
	}
	# get rss file
	
	$feed = new SimplePie();
	$feed->set_feed_url($rss_url);
	$feed->set_cache_location(get_template_directory().'/cache/');
	$feed->init();
	$feed->handle_content_type();

	$photos_arr = array();
	
	foreach ($feed->get_items() as $key => $item)
	{
	    $enclosure = $item->get_enclosure();
	    $img = image_from_description($item->get_description()); 
	    $thumb_url = select_image($img, 0);
	    $large_url = select_image($img, 4);
	    
	    $photos_arr[] = array(
	    	'title' => $enclosure->get_title(),
	    	'thumb_url' => $thumb_url,
	    	'url' => $large_url,
	    );
	    
	    $current = intval($key+1);
	    
	    if($current == $settings['items'])
	    {
	    	break;
	    }
	} 

	return $photos_arr;
}

function image_from_description($data) {
    preg_match_all('/<img src="([^"]*)"([^>]*)>/i', $data, $matches);
    return $matches[1][0];
}

function select_image($img, $size) {
    $img = explode('/', $img);
    $filename = array_pop($img);

    // The sizes listed here are the ones Flickr provides by default.  Pass the array index in the

    // 0 for square, 1 for thumb, 2 for small, etc.
    $s = array(
        '_s.', // square
        '_t.', // thumb
        '_m.', // small
        '.',   // medium
        '_b.'  // large
    );

    $img[] = preg_replace('/(_(s|t|m|b))?\./i', $s[$size], $filename);
    return implode('/', $img);
}

/* SUBMENU */

class Codeus_Widget_Submenu extends WP_Widget {

	function __construct() {
		$widget_ops = array( 'description' => __('Submenu.', 'codeus') );
		parent::__construct( 'submenu', __('Submenu', 'codeus'), $widget_ops );
	}

	function widget($args, $instance) {
		// Get menu
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;

		if ( !$nav_menu )
			return;

		echo $args['before_widget'];

		wp_nav_menu( array( 'fallback_cb' => '', 'menu' => $nav_menu, 'walker' => new Submenu_Walker_Nav_Menu, 'items_wrap' => '<ul class="styled">%3$s</ul>') );

		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		return $instance;
	}

	function form( $instance ) {
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

		// Get menus
		$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );

		// If no menus exists, direct the user to go and create some.
		if ( !$menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.', 'codeus'), admin_url('nav-menus.php') ) .'</p>';
			return;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id('nav_menu'); ?>"><?php _e('Select Menu', 'codeus'); ?>:</label>
			<select id="<?php echo $this->get_field_id('nav_menu'); ?>" name="<?php echo $this->get_field_name('nav_menu'); ?>">
		<?php
			foreach ( $menus as $menu ) {
				echo '<option value="' . $menu->term_id . '"'
					. selected( $nav_menu, $menu->term_id, false )
					. '>'. $menu->name . '</option>';
			}
		?>
			</select>
		</p>
		<?php
	}
}

add_filter('wp_nav_menu_items', 'codeus_wp_nav_menu_items_before', 9, 2);
function codeus_wp_nav_menu_items_before($items, $args) {
	if(is_object($args->walker) && get_class($args->walker) == 'Submenu_Walker_Nav_Menu') {
		return $items.'@#@';
	}
	return $items;
}

add_filter('wp_nav_menu_items', 'codeus_wp_nav_menu_items_after', 11, 2);
function codeus_wp_nav_menu_items_after($items, $args) {
	if(is_object($args->walker) && get_class($args->walker) == 'Submenu_Walker_Nav_Menu') {
		return substr($items, 0, strpos($items, "@#@"));
	}
	return $items;
}

class Submenu_Walker_Nav_Menu extends Walker_Nav_Menu {
	
	var $current_tree_ids = array();
	
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		if ($depth == 0) 
			return;
			
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"styled\">\n";
	}
		
	function end_lvl( &$output, $depth = 0, $args = array() ) {
		if ($depth == 0) 
			return;
			
		$indent = str_repeat("\t", $depth);
		$output .= "$indent</ul>\n";
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		if ($depth == 0 && ($item->current_item_ancestor || $item->current)) {
			$this->current_tree_ids[] = $item->ID;
		}
		
		if (!in_array($item->menu_item_parent, $this->current_tree_ids))
			return;
		
		$this->current_tree_ids[] = $item->ID;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

		if($depth != 0) {
			$output .= $indent . '<li' . $id . $value . $class_names .'>';
		}

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;

		if($depth != 0) {
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {
		if (!in_array($item->menu_item_parent, $this->current_tree_ids))
			return;
			
		$output .= "</li>\n";
	}
}


/* TWEETS */

class Codeus_Widget_Tweets extends WP_Widget {

	function Codeus_Widget_Tweets()
	{
		$widget_ops = array('classname' => 'tweets', 'description' => '');

		$control_ops = array('id_base' => 'tweets-widget');

		parent::__construct('tweets-widget', 'Twitter', $widget_ops, $control_ops);
	}
	
	function widget($args, $instance)
	{
		extract($args);
		$title = apply_filters('widget_title', $instance['title']);
		$consumer_key = $instance['consumer_key'];
		$consumer_secret = $instance['consumer_secret'];
		$access_token = $instance['access_token'];
		$access_token_secret = $instance['access_token_secret'];
		$twitter_id = $instance['twitter_id'];
		$count = $instance['count'];

		echo $before_widget;
		
		if($title) {
			echo $before_title.$title.$after_title;
		}
		
		if($twitter_id && $consumer_key && $consumer_secret && $access_token && $access_token_secret && $count) { 
		$transName = 'list_tweets_'.$args['widget_id'];
		$cacheTime = 10;
		delete_transient($transName);
		if(false === ($twitterData = get_transient($transName))) {
		     // require the twitter auth class
		     @require_once 'twitteroauth/twitteroauth.php';
		     $twitterConnection = new TwitterOAuth(
							$consumer_key,	// Consumer Key
							$consumer_secret,   	// Consumer secret
							$access_token,       // Access token
							$access_token_secret    	// Access token secret
							);
		    $twitterData = $twitterConnection->get(
							  'statuses/user_timeline',
							  array(
							    'screen_name'     => $twitter_id,
							    'count'           => $count,
							    'exclude_replies' => false
							  )
							);
		     if($twitterConnection->http_code != 200)
		     {
		          $twitterData = get_transient($transName);
		     }

		     // Save our new transient.
		     set_transient($transName, $twitterData, 60 * $cacheTime);
		};
		$twitter = get_transient($transName);
		if($twitter && is_array($twitter)) {
		?>
		<div class="twitter-box">
			<div class="twitter-holder">
				<div class="b">
					<div class="tweets-container" id="tweets_<?php echo $args['widget_id']; ?>">
						<ul id="jtwt" class="styled">
							<?php foreach($twitter as $tweet): ?>
							<li class="jtwt_tweet">
								<p class="jtwt_tweet_text icon-twitter">
								<?php
								$latestTweet = $tweet->text;
								$latestTweet = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '&nbsp;<a href="http://$1" target="_blank">http://$1</a>&nbsp;', $latestTweet);
								$latestTweet = preg_replace('/@([a-z0-9_]+)/i', '&nbsp;<a href="http://twitter.com/$1" target="_blank">@$1</a>&nbsp;', $latestTweet);
								echo $latestTweet;
								?>
								</p>
								<?php
								$twitterTime = strtotime($tweet->created_at);
								$timeAgo = $this->ago($twitterTime);
								?>
								<a href="http://twitter.com/<?php echo $tweet->user->screen_name; ?>/statuses/<?php echo $tweet->id_str; ?>" class="jtwt_date"><?php echo $timeAgo; ?></a>
							</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
			<span class="arrow"></span>
		</div>
		<?php }}
		
		echo $after_widget;
	}
	
	function ago($time)
	{
	   $periods = array("second", "minute", "hour", "day", "week", "month", "year", "decade");
	   $lengths = array("60","60","24","7","4.35","12","10");

	   $now = time();

	       $difference     = $now - $time;
	       $tense         = "ago";

	   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
	       $difference /= $lengths[$j];
	   }

	   $difference = round($difference);

	   if($difference != 1) {
	       $periods[$j].= "s";
	   }

	   return "$difference $periods[$j] ago ";
	}

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['title'] = strip_tags($new_instance['title']);
		$instance['consumer_key'] = $new_instance['consumer_key'];
		$instance['consumer_secret'] = $new_instance['consumer_secret'];
		$instance['access_token'] = $new_instance['access_token'];
		$instance['access_token_secret'] = $new_instance['access_token_secret'];
		$instance['twitter_id'] = $new_instance['twitter_id'];
		$instance['count'] = $new_instance['count'];

		return $instance;
	}

	function form($instance)
	{
		$defaults = array(
			'title' => 'Recent Tweets',
			'twitter_id' => '',
			'count' => 3,
			'consumer_key' => '',
			'consumer_secret' => '',
			'access_token' => '',
			'access_token_secret' => ''
		);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
		<p><?php printf(__('<a href="%s">Find or Create your Twitter App</a>', 'codeus'), 'http://dev.twitter.com/apps'); ?></p>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('consumer_key'); ?>">Consumer Key:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('consumer_key'); ?>" name="<?php echo $this->get_field_name('consumer_key'); ?>" value="<?php echo $instance['consumer_key']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('consumer_secret'); ?>">Consumer Secret:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('consumer_secret'); ?>" name="<?php echo $this->get_field_name('consumer_secret'); ?>" value="<?php echo $instance['consumer_secret']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('access_token'); ?>">Access Token:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('access_token'); ?>" name="<?php echo $this->get_field_name('access_token'); ?>" value="<?php echo $instance['access_token']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('access_token_secret'); ?>">Access Token Secret:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('access_token_secret'); ?>" name="<?php echo $this->get_field_name('access_token_secret'); ?>" value="<?php echo $instance['access_token_secret']; ?>" />
		</p>
		
		<p>
			<label for="<?php echo $this->get_field_id('twitter_id'); ?>">Twitter ID:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" value="<?php echo $instance['twitter_id']; ?>" />
		</p>

			<label for="<?php echo $this->get_field_id('count'); ?>">Number of Tweets:</label>
			<input class="widefat" style="width: 216px;" id="<?php echo $this->get_field_id('count'); ?>" name="<?php echo $this->get_field_name('count'); ?>" value="<?php echo $instance['count']; ?>" />
		</p>

	<?php
	}
}

/* FACEBOOK */

class Codeus_Widget_Facebook_Page extends WP_Widget {
	function Codeus_Widget_Facebook_Page() {
		$widget_ops = array('classname' => 'Custom_Facebook_Page', 'description' => __('Facebook page like box', 'codeus') );
		parent::__construct('Custom_Facebook_Page', __('Facebook Page', 'codeus'), $widget_ops);
	}

	function widget($args, $instance) {
		extract($args, EXTR_SKIP);

		echo $before_widget;
		$fb_page_url = $instance['fb_page_url'];
		$title = $instance['title'];
		if(!empty($fb_page_url)){
			echo $before_title;
			if($title) {
				echo $title;
			} else {
				echo __('Find us on Facebook', 'codeus');
			}
			echo $after_title;
?>
<div><iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo urlencode($fb_page_url); ?>&amp;width=285&amp;height=258&amp;show_faces=true&amp;colorscheme=light&amp;stream=false&amp;show_border=false&amp;header=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:285px; height:250px; margin:  -10px 0 -10px -10px; vertical-align: top;" allowTransparency="true"></iframe></div>
<?php
		}
		
		echo $after_widget;
	}

	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['fb_page_url'] = strip_tags($new_instance['fb_page_url']);
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}

	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'fb_page_url' => '', 'title' => '') );
		$fb_page_url = strip_tags($instance['fb_page_url']);
		$title = strip_tags($instance['title']);

?>
			<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'codeus'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
			<p><label for="<?php echo $this->get_field_id('fb_page_url'); ?>"><?php _e('Facebook Page URL', 'codeus'); ?>: <input class="widefat" id="<?php echo $this->get_field_id('fb_page_url'); ?>" name="<?php echo $this->get_field_name('fb_page_url'); ?>" type="text" value="<?php echo esc_attr($fb_page_url); ?>" /></label></p>
<?php
	}
}

?>