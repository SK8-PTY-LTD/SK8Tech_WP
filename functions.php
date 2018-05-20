<?php
/**
 * SK8Tech
 *
 * @author SK8Tech
 */

/**
 * Enqueue child scripts and styles
 *
 * Note the priority: 12.
 * This function should be executed after the callback in the parent theme
 *
 * @see startapp_scripts()
 */
function startapp_child_scripts() {
	wp_enqueue_style('sk8tech', get_stylesheet_directory_uri() . '/style.css', array(), null);
}

add_action('wp_enqueue_scripts', 'startapp_child_scripts', 12);

add_filter('auto_update_plugin', '__return_true');

/**
 * Plugin Name: Custom Press-This Post Type
 * Plugin URI:  https://gist.github.com/flexseth/7a16ccd62653323af0a6
 * @author: Jacktator
 */
add_action('wp_ajax_press-this-save-post', function () {
	add_filter('wp_insert_post_data', function ($data) {
		if (isset($data['post_type']) && 'post' === $data['post_type']) {
			$data['post_type'] = 'epkb_post_type_1';
		}

		return $data;
	}, PHP_INT_MAX);

}, 0);

/**
 * Remove WP Version From Styles
 * @author: Jack
 * @see: https://www.codementor.io/tips/8369241717/remove-version-number-from-css-js-in-wordpress-theme
 */
// Remove WP Version From Styles
add_filter('style_loader_src', 'sdt_remove_ver_css_js', 9999);
// Remove WP Version From Scripts
add_filter('script_loader_src', 'sdt_remove_ver_css_js', 9999);
// Function to remove version numbers
function sdt_remove_ver_css_js($src) {
	if (strpos($src, 'ver=')) {
		$src = remove_query_arg('ver', $src);
	}

	return $src;
}

/**
 * How To Fix Chinese Language WordPress Excerpts Issue
 * @author: Jack
 * @see: http://www.dezzain.com/snippets/how-to-fix-chinese-language-wordpress-excerpts-issue/
 */
function dez_filter_chinese_excerpt($output) {
	global $post;
//check if its chinese character input
	$chinese_output = preg_match_all("/\p{Han}+/u", $post->post_content, $matches);
	if ($chinese_output) {
		$output = mb_substr($output, 0, 50) . '...';
	}
	return $output;
}
add_filter('get_the_excerpt', 'dez_filter_chinese_excerpt');