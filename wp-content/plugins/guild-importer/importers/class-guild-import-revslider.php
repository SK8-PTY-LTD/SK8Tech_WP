<?php

/**
 * Import the Revolution Sliders.
 *
 * @author 8guild
 */
class Guild_Import_Revslider {

	/**
	 * Sliders
	 *
	 * @var array
	 */
	private $sliders = array();

	/**
	 * Imported sliders
	 *
	 * @var array
	 */
	private $importedSliders = array();

	/**
	 * Constructor
	 *
	 * @param array $sliders Array of sliders' .zip
	 */
	public function __construct( $sliders ) {
		$this->sliders = (array) $sliders;
	}

	public function import() {
		if ( empty( $this->sliders ) ) {
			return __( 'Do not call revslider importer with empty data.', 'guild-importer' );
		}

		if ( ! function_exists( 'is_plugin_active' ) ) {
			include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		}

		if ( ! is_plugin_active( 'revslider/revslider.php' ) ) {
			return __( 'You should activate Revolution Slider plugin before importing.', 'guild-importer' );
		}

		// get args
		$update_animations  = (bool) isset( $_POST['update_animations'] ) ? $_POST['update_animations'] : true;
		$update_navigations = (bool) isset( $_POST['update_navigations'] ) ? $_POST['update_navigations'] : true;
		$update_static      = (bool) isset( $_POST['update_static_captions'] ) ? $_POST['update_static_captions'] : 'none';

		// if plugin active all required classes should be loaded
		$slider = new RevSliderSlider();
		$output = array();

		foreach ( $this->sliders as $item ) {
			$item     = wp_normalize_path( $item );
			$response = $slider->importSliderFromPost(
				$update_animations,
				$update_static,
				$item,
				false,
				false,
				$update_navigations
			);

			if ( false == $response['success'] ) {
				$output[] = sprintf( __( 'Revolution Slider import error: %s', 'guild-importer' ), $response['error'] );
			} else {
				$output[] = sprintf( __( 'Slider #%s import success.', 'guild-importer' ), $response['sliderID'] );
			}

			$this->importedSliders[] = $response;
		}

		return implode( '', $output );
	}
}