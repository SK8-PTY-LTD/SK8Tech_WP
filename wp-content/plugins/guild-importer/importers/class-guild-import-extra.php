<?php

/**
 * Import the extra data, which is not included in the WordPress export file.
 *
 * @author 8guild
 */
class Guild_Import_Extra {

	/**
	 * Path to .json with extra data
	 *
	 * @var string
	 */
	private $extra = '';

	/**
	 * Constructor
	 *
	 * @param string $extra Path to .json
	 */
	public function __construct( $extra ) {
		$this->extra = wp_normalize_path( $extra );
	}

	public function import() {
		$data = json_decode( file_get_contents( $this->extra ), true );
		if ( empty( $data ) ) {
			return __( 'Error: can not parse the JSON file or it is empty.', 'guild-importer' );
		}

		// get required wp_import object
		$storage   = Guild_Importer_Storage::instance();
		$wp_import = $storage->get( 'wp_import' );

		$this->import_users( $data );
		$this->import_menu_locations( $data );
		$this->import_options( $data );
		$this->import_widgets( $data, $wp_import );
		$this->import_menu_meta( $data, $wp_import );

		return __( 'Extra Data import complete..', 'guild-importer' );
	}

	/**
	 * Import users metadata
	 *
	 * @param mixed $data
	 */
	private function import_users( $data ) {
		if ( ! array_key_exists( 'users', $data ) || empty( $data['users'] ) ) {
			return;
		}

		$users = $data['users'];
		foreach ( $users as $user_login => $user_data ) {
			$user = get_user_by( 'login', $user_login );
			if ( false === $user ) {
				continue;
			}

			if ( ! is_array( $user_data ) || empty( $user_data ) ) {
				continue;
			}

			foreach ( $user_data as $meta_key => $meta_value ) {
				update_user_meta( $user->ID, $meta_key, maybe_unserialize( base64_decode( $meta_value ) ) );
			}
		}
	}

	/**
	 * Import menu locations
	 *
	 * @param mixed $data
	 */
	private function import_menu_locations( $data ) {
		if ( ! array_key_exists( 'menu_locations', $data )
		     || empty( $data['menu_locations'] )
		) {
			return;
		}

		$menus           = $data['menu_locations'];
		$locations_menus = array();
		foreach ( $menus as $location => $menu_slug ) {
			if ( empty( $menu_slug ) ) {
				continue;
			}

			$menu                         = wp_get_nav_menu_object( $menu_slug );
			$locations_menus[ $location ] = (int) $menu->term_id;
		}

		set_theme_mod( 'nav_menu_locations', $locations_menus );
	}

	/**
	 * Import menu meta data
	 *
	 * @param mixed     $data
	 * @param WP_Import $wp_import WP_Import object
	 */
	private function import_menu_meta( $data, $wp_import ) {
		if ( ! array_key_exists( 'menu_meta', $data ) || empty( $data['menu_meta'] ) ) {
			return;
		}

		$menu_meta = $data['menu_meta'];
		foreach ( $menu_meta as $post_id => $meta ) {
			if ( ! array_key_exists( (int) $post_id, $wp_import->processed_menu_items ) ) {
				continue;
			}

			$menu_item_id = $wp_import->processed_menu_items[ $post_id ];
			foreach ( $meta as $k => $v ) {
				update_post_meta( $menu_item_id, $k, maybe_unserialize( base64_decode( $v ) ) );
			}
		}
	}

	/**
	 * Import the Theme Options
	 *
	 * @param mixed $data
	 */
	private function import_options( $data ) {
		if ( ! array_key_exists( 'options', $data ) || empty( $data['options'] ) ) {
			return;
		}

		$options = (array) $data['options'];
		foreach ( $options as $option => $value ) {
			update_option( $option, maybe_unserialize( base64_decode( $value ) ) );
		}
	}

	/**
	 * Import widgets
	 *
	 * @param array     $data
	 * @param WP_Import $wp_import WP_Import object
	 */
	private function import_widgets( $data, $wp_import ) {
		if ( ! array_key_exists( 'widgets', $data ) ) {
			return;
		}

		/*
		 * Fix the situation with nav_menu widgets.
		 *
		 * Because imported menus has another IDs, than exported ones.
		 * Create the map with [exported_menu_id => imported_menu_id]
		 */
		$nav_menus_map = array();
		$terms         = isset( $wp_import->terms ) ? (array) $wp_import->terms : array();
		foreach ( $terms as $term ) {
			if ( 'nav_menu' !== $term['term_taxonomy'] ) {
				continue;
			}

			$exporter_menu = (int) $term['term_id'];
			$imported_menu = (int) wp_get_nav_menu_object( $term['slug'] )->term_id;

			$nav_menus_map[ $exporter_menu ] = $imported_menu;
			unset( $exporter_menu, $imported_menu );
		}
		unset( $term );

		$imported_sidebars  = $data['widgets'];
		$processed_sidebars = array();
		foreach ( $imported_sidebars as $sidebar => $widgets ) {
			foreach ( $widgets as $widget => $widget_data ) {
				$processed_sidebars[ $sidebar ][] = $widget;

				$widget_base   = trim( substr( $widget, 0, strrpos( $widget, '-' ) ) );
				$widget_idx    = (int) trim( substr( $widget, strrpos( $widget, '-' ) + 1 ) );
				$widget_option = 'widget_' . $widget_base;
				$widget_data   = maybe_unserialize( base64_decode( $widget_data ) );

				// Fix nav_menu
				if ( 'nav_menu' === $widget_base
				     && is_array( $widget_data )
				     && array_key_exists( 'nav_menu', $widget_data )
				     && array_key_exists( $widget_data['nav_menu'], $nav_menus_map )
				) {
					$exported_menu_id        = (int) $widget_data['nav_menu'];
					$widget_data['nav_menu'] = (int) $nav_menus_map[ $exported_menu_id ];
				}

				$widgets_settings = get_option( $widget_option );
				if ( false === $widgets_settings || empty( $widgets_settings ) ) {
					$widgets_settings = array(
						$widget_idx    => $widget_data,
						'_multiwidget' => 1,
					);
				} elseif ( is_array( $widgets_settings ) ) {
					$widgets_settings[ $widget_idx ] = $widget_data;
				}

				update_option( $widget_option, $widgets_settings );
				unset( $widget_base, $widget_idx, $widget_option, $widget_data, $widgets_settings );

				continue;
			}
			unset( $widget, $widget_data );
		}

		wp_set_sidebars_widgets( $processed_sidebars );
	}
}