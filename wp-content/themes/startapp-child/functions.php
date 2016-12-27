<?php
/**
 * StartApp Child
 *
 * @author 8guild
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
	wp_enqueue_style( 'startapp-child', get_stylesheet_directory_uri() . '/style.css', array(), null );
}

add_action( 'wp_enqueue_scripts', 'startapp_child_scripts', 12 );

