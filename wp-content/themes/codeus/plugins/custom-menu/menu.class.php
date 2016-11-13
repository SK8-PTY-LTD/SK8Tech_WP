<?php
/**
 * Codeus Menu class.
 *
*/

class Codeus_Menu {

	public $fat_menu = false;
	public $fat_columns = 3;

	function __construct() {

		// add custom menu fields to menu
		add_filter( 'wp_setup_nav_menu_item', array( $this, 'add_custom_nav_fields' ) );

		// save menu custom fields
		add_action( 'wp_update_nav_menu_item', array( $this, 'update_custom_nav_fields' ), 10, 3 );

		// replace menu walker
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'replace_walker_class' ), 90, 2 );

		// add admin css
		add_action( 'admin_print_styles-nav-menus.php', array( $this, 'add_admin_menu_inline_css' ), 15 );

		// add media uploader
		add_action( 'admin_enqueue_scripts', array( $this, 'uploader_scripts' ), 15 );
	}

	function add_custom_nav_fields( $menu_item ) {
        $menu_item->codeus_mobile_clickable = get_post_meta( $menu_item->ID, '_menu_item_codeus_mobile_clickable', true );
		return $menu_item;
	}

	function update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {
        if (isset($_REQUEST['codeus_mobile_clickable'], $_REQUEST['codeus_mobile_clickable'][$menu_item_db_id]))
        	update_post_meta( $menu_item_db_id, '_menu_item_codeus_mobile_clickable', true );
        else
        	update_post_meta( $menu_item_db_id, '_menu_item_codeus_mobile_clickable', false );
	}

	function replace_walker_class( $walker, $menu_id ) {

		if ( 'Walker_Nav_Menu_Edit' == $walker ) {
			$walker = 'Codeus_Edit_Menu_Walker';
		}

		return $walker;
	}

	/**
	 * Add some beautiful inline css for admin menus.
	 *
	 */
	function add_admin_menu_inline_css() {
		$css = '
            .wrapper-codeus-mobile-clickable {
                padding-top: 10px;
            }
		';
		wp_add_inline_style( 'wp-admin', $css );
	}

	/**
	 * Enqueue uploader scripts.
	 *
	 */
	function uploader_scripts() {
		if ( function_exists( 'wp_enqueue_media' ) ) {
			wp_enqueue_media();
		}
	}
}

if ( !class_exists('Dt_Edit_Menu_Walker') ) {
	include_once( dirname(__FILE__) . '/edit-menu-walker.class.php' );
}
