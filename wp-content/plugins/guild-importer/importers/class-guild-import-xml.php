<?php

/**
 * Import the XML file with native WordPress data
 *
 * @author 8guild
 */
class Guild_Import_XML {

	/**
	 * Path to .xml file
	 *
	 * @var string
	 */
	private $xml = '';

	/**
	 * Processed posts
	 *
	 * @var array
	 */
	public $processed_posts = array();

	/**
	 * Constructor
	 *
	 * @param string $xml Path to .xml
	 */
	public function __construct( $xml ) {
		$this->xml = wp_normalize_path( $xml );
	}

	/**
	 * Do the job
	 */
	public function import() {
		// Options
		$args = array(
			'import_attachments' => isset( $_POST['import_attachments'] ) ? true : false,
			'resize_attachments' => isset( $_POST['resize_attachments'] ) ? true : false,
			'authors'            => empty( $_POST['authors'] ) ? 'create' : esc_attr( $_POST['authors'] ),
		);

		if ( ! file_exists( $this->xml ) ) {
			return __( 'Error importing WordPress Data. Provided .xml file not exists', 'guild-importer' );
		}

		define( 'WP_LOAD_IMPORTERS', true );
		define( 'IMPORT_DEBUG', false );

		if ( ! class_exists( 'WP_Importer' ) ) {
			require ABSPATH . 'wp-admin/includes/class-wp-importer.php';
		}

		$wp_import                  = new WP_Import();
		$wp_import->processed_posts = $this->processed_posts;

		$data = $wp_import->parse( $this->xml );
		if ( is_wp_error( $data ) ) {
			/** @var WP_Error $data */
			return $data->get_error_message();
		}

		// Prepare the data to be used in process_author_mapping();
		$wp_import->get_authors_from_import( $data );
		unset( $data );

		$author_data = array();
		foreach ( $wp_import->authors as $wxr_author ) {
			$author = new \stdClass();
			// Always in the WXR
			$author->user_login = $wxr_author['author_login'];

			// Should be in the WXR; no guarantees
			if ( isset ( $wxr_author['author_email'] ) ) {
				$author->user_email = $wxr_author['author_email'];
			}

			if ( isset( $wxr_author['author_display_name'] ) ) {
				$author->display_name = $wxr_author['author_display_name'];
			}

			if ( isset( $wxr_author['author_first_name'] ) ) {
				$author->first_name = $wxr_author['author_first_name'];
			}

			if ( isset( $wxr_author['author_last_name'] ) ) {
				$author->last_name = $wxr_author['author_last_name'];
			}

			$author_data[] = $author;
		}

		// Build the author mapping
		$author_mapping = $this->process_author_mapping( $args['authors'], $author_data );
		if ( is_wp_error( $author_mapping ) ) {
			return $author_mapping->get_error_message();
		}

		$author_in = wp_list_pluck( $author_mapping, 'old_user_login' );
		$author_out = wp_list_pluck( $author_mapping, 'new_user_login' );
		unset( $author_mapping, $author_data );

		// $user_select needs to be an array of user IDs
		$user_select         = array();
		$invalid_user_select = array();
		foreach ( $author_out as $author_login ) {
			$user = get_user_by( 'login', $author_login );
			if ( $user ) {
				$user_select[] = $user->ID;
			} else {
				$invalid_user_select[] = $author_login;
			}
		}

		if ( ! empty( $invalid_user_select ) ) {
			return sprintf( __( 'These user_logins are invalid: %s', 'guild-importer' ), implode( ',', $invalid_user_select ) );
		}
		unset( $author_out );

		// Drive the import
		$wp_import->fetch_attachments = (bool) $args['import_attachments'];

		$_GET  = array( 'import' => 'wordpress', 'step' => 2 );
		$_POST = array(
			'imported_authors'  => $author_in,
			'user_map'          => $user_select,
			'fetch_attachments' => $wp_import->fetch_attachments,
		);

		// skip time consuming thumbnail generation
		// @see https://wp-cli.org/commands/import/
		if ( true === (bool) $args['resize_attachments'] ) {
			add_filter( 'intermediate_image_sizes_advanced', array( $this, 'filter_set_image_sizes' ) );
		}

		$wp_import->import( $this->xml );
		$this->processed_posts += $wp_import->processed_posts;

		// store the importer for further usage
		// for example it requires for Extra importer
		$storage = Guild_Importer_Storage::instance();
		$storage->add( 'wp_import', $wp_import );

		return __( 'WordPress Data import complete...', 'guild-importer' );

	}

	/**
	 * Return null here to prevent the core image resizing logic from running.
	 *
	 * @param array $sizes
	 *
	 * @return null
	 */
	public function filter_set_image_sizes( $sizes ) {
		return null;
	}

	/**
	 * Process how the authors should be mapped
	 *
	 * Returns author mapping array if successful, WP_Error if something bad happened
	 *
	 * @param string $authors_arg The `author` option in Advanced Options: skip or create
	 * @param array  $author_data An array of WP_User-esque author objects
	 *
	 * @return array|WP_Error
	 */
	private function process_author_mapping( $authors_arg, $author_data ) {
		switch( $authors_arg ) {
			case 'create':
				// Create authors if they don't yet exist; maybe match on email or user_login
				return $this->create_authors_for_mapping( $author_data );
				break;

			case 'skip':
				// Skip any sort of author mapping
				return array();
				break;
			default:
				return new WP_Error(
					'invalid_authors_arg',
					sprintf( __( 'Invalid authors %s', 'guild-importer' ), $authors_arg )
				);
		}
	}

	/**
	 * Create users if they don't exist, and build an author mapping file
	 *
	 * @param array $author_data An array of WP_User-esque author objects
	 *
	 * @return array|WP_Error
	 */
	private function create_authors_for_mapping( $author_data ) {
		$author_mapping = array();
		foreach ( $author_data as $author ) {
			if ( isset( $author->user_email ) ) {
				if ( $user = get_user_by( 'email', $author->user_email ) ) {
					$author_mapping[] = array(
						'old_user_login' => $author->user_login,
						'new_user_login' => $user->user_login,
					);
					continue;
				}
			}
			if ( $user = get_user_by( 'login', $author->user_login ) ) {
				$author_mapping[] = array(
					'old_user_login' => $author->user_login,
					'new_user_login' => $user->user_login,
				);
				continue;
			}

			$user = array(
				'user_login' => '',
				'user_email' => '',
				'user_pass'  => wp_generate_password(),
			);

			$user    = array_merge( $user, (array) $author );
			$user_id = wp_insert_user( $user );
			if ( is_wp_error( $user_id ) ) {
				return $user_id;
			}

			$user = get_user_by( 'id', $user_id );
			$author_mapping[] = array(
				'old_user_login' => $author->user_login,
				'new_user_login' => $user->user_login,
			);
		}

		return $author_mapping;
	}
}