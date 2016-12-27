<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * This is a main plugin file.
 *
 * Here will be loaded all required assets and setup
 * all required hooks to make this plugin works correctly.
 *
 * But this is no God object. You can not access to other
 * parts of plugin (e.g. Importer itself) through this class.
 *
 * @author 8guild
 */
class Guild_Importer_Plugin {

	/**
	 * @var Guild_Importer_Plugin|null
	 */
	private static $instance = null;

	/**
	 * Holds the page title
	 *
	 * @var string
	 */
	public $page_title = '';

	/**
	 * Holds the hook name for the admin page
	 *
	 * @see Guild_Importer_Plugin::admin_menu()
	 *
	 * @var string
	 */
	public $page_hook = '';

	/**
	 * Holds the menu title for a new admin page
	 *
	 * @var string
	 */
	public $menu_title = '';

	/**
	 * Holds the menu slug for a new admin page
	 *
	 * @see Guild_Importer_Plugin::admin_menu()
	 *
	 * @var string
	 */
	public $menu_slug = 'guild-import-page';

	/**
	 * Parent menu file slug
	 *
	 * @var string
	 */
	public $parent_slug = 'themes.php';

	/**
	 * Capability needed to view the importer page
	 *
	 * @var string
	 */
	public $capability = 'import';

	/**
	 * Nonce required for form submitting
	 *
	 * @see wp_nonce_field()
	 * @see wp_verify_nonce()
	 *
	 * @var string
	 */
	public $nonce = 'guild_importer_nonce';

	/**
	 * Nonce field required for form submitting
	 *
	 * @see wp_nonce_field()
	 * @see wp_verify_nonce()
	 *
	 * @var string
	 */
	public $nonce_field = 'guild_importer_nonce_field';

	/**
	 * Form action
	 *
	 * @var string
	 */
	public $action = '';

	/**
	 * Holds configurable array of strings
	 *
	 * Default values are added during the plugin setup
	 *
	 * @var array
	 */
	public $strings = array();

	/**
	 * Import variants
	 *
	 * Each variant should contains the .xml and .json files
	 * with all information for import process.
	 *
	 * @example
	 * [
	 *   key     => unique-key
	 *   preview => /path/to/image.jpg,
	 *   title   => 'Variant title',
	 *   import => [
	 *     xml     => path/to/theme/demo/unique-key/demo.xml
	 *     extra   => path/to/theme/demo/unique-key/extra.json
	 *   ]
	 * ]
	 *
	 * @var array
	 */
	public $variants = array();

	/**
	 * Importers
	 *
	 * Keys should be the same and in variant[import]
	 * Values is an Importer class name
	 *
	 * @example [xml => Guild_Import_XML]
	 *
	 * @var array
	 */
	public $importers = array();

	/**
	 * Get the instance
	 *
	 * @return Guild_Importer_Plugin|null
	 */
	public static function instance() {
		if ( null === self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Constructor
	 */
	public function __construct() {}

	/**
	 * Setup the Guild Importer Plugin
	 *
	 * Adds plugin info, populates default strings,
	 * does "guild/importer/init" hook and hooks in the
	 * interactions to init.
	 */
	public function setup() {
		$this->strings = array(
			'invalid_nonce'          => __( 'Bad nonce', 'guild-importer' ),
			// %s is a variant key
			'invalid_variant'        => __( 'Given variant `%s` not found', 'guild-importer' ),
			// %1$s is a path to file, %2$s is a variant key
			'invalid_xml'            => __( 'Can not read XML file `%1$s`. Given variant is `%2$s`', 'guild-importer' ),
			// %1$s is a path to extra.json file, %2$s is a variant key
			'invalid_extra'          => __( 'Can not read extra file `%1$s. Given variant is `%2$s`', 'guild-importer' ),
			'inactive_importer'      => __( 'WordPress Importer needs to be activated', 'guild-importer' ),
			'missing_importer'       => __( 'WordPress Importer needs to be installed', 'guild-importer' ),
			'success_import'         => __( 'Data imported successfully', 'guild-importer' ),
			// %s passed argument
			'invalid_authors_arg'    => __( 'Author argument `%s` is invalid.', 'guild-importer' ),
			// %s is a list of comma-separated user logins
			'invalid_author_mapping' => __( 'These user_logins are invalid: %s', 'guild-importer' ),

		);

		add_action( 'init', array( $this, 'textdomain' ) );
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'guild/importer/register', array( $this, 'init_importers' ), 1 );

		do_action_ref_array( 'guild/importer/init', array( $this ) );
	}

	/**
	 * Load plugin translation
	 *
	 * @hooked init
	 * @see  Guild_Importer_Plugin::setup()
	 */
	public function textdomain() {
		load_plugin_textdomain( 'guild-importer', false, GUILD_IMPORTER_DIR . '/languages' );
	}

	/**
	 * Initialise the interactions between Guild Importer and WordPress
	 *
	 * @see Guild_Importer_Plugin::admin_menu()
	 * @see Guild_Importer_Plugin::assets()
	 * @see Guild_Importer_Plugin::import()
	 */
	public function init() {
		/**
		 * By default importer load on admin screens and not during AJAX call.
		 * Using this filter you can overrule that behaviour
		 *
		 * Default is `is_admin()`
		 *
		 * @param bool $is_importer Whether or not Importer should load
		 */
		if ( true !== apply_filters( 'guild/importer/load', is_admin() ) ) {
			return;
		}

		do_action( 'guild/importer/register' );

		// All variants should be registered after this point

		if ( empty( $this->variants ) || ! is_array( $this->variants ) ) {
			return;
		}

		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'assets' ) );
	}

	/**
	 * Register the built-in importers
	 *
	 * @hooked guild/importer/register 1
	 */
	public function init_importers() {
		gi_register_importer( 'xml', 'Guild_Import_XML' );
		gi_register_importer( 'extra', 'Guild_Import_Extra' );
		gi_register_importer( 'revslider', 'Guild_Import_Revslider' );
	}

	/**
	 * Adds submenu page if any variants are registered
	 *
	 * This page disappears once the variants are not registered
	 *
	 * @see Guild_Importer_Plugin::init()
	 */
	public function admin_menu() {
		/**
		 * Filter the arguments for a new admin page
		 *
		 * @param array $args Page args
		 */
		$args = apply_filters( 'guild/importer/menu_args', array(
			'parent_slug' => $this->parent_slug,
			'page_title'  => $this->page_title,
			'menu_title'  => $this->menu_title,
			'capability'  => $this->capability,
			'menu_slug'   => $this->menu_slug,
			'callback'    => array( $this, 'render' ),
		) );

		if ( 'themes.php' === $this->parent_slug ) {
			$hook = add_theme_page(
				$args['page_title'],
				$args['menu_title'],
				$args['capability'],
				$args['menu_slug'],
				$args['callback']
			);
		} else {
			$hook = add_submenu_page(
				$args['parent_slug'],
				$args['page_title'],
				$args['menu_title'],
				$args['capability'],
				$args['menu_slug'],
				$args['callback']
			);
		}

		$this->page_hook = $hook;
	}

	/**
	 * Render the page contents
	 *
	 * This method is the callback for the admin_menu method function.
	 * This displays the admin page and form area where the user can
	 * select a variant to import with advanced settings
	 *
	 * The import process is triggered via AJAX
	 *
	 * @see Guild_Importer_Plugin::admin_menu()
	 */
	public function render() {
		// detect the action
		$url    = parse_url( $_SERVER['REQUEST_URI'] );
		$script = pathinfo( $url['path'], PATHINFO_BASENAME );
		parse_str( $url['query'], $query );

		// add step 2
		$query['step'] = 2;

		$action = add_query_arg( $query, $script );
		$action = get_admin_url( null, $action );

		$this->action = $action;
		unset( $url, $script, $query, $action );


		if ( isset( $_GET['step'] ) && 2 === (int) $_GET['step'] ) {

			// prepare links
			$links = implode( ' | ', array(
				'dashboard' => '<a href="' . admin_url() . '">' . __( 'Return to Dashboard', 'guild-importer' ) . '</a>',
			) );

			if ( isset( $_POST['action'] ) && 'guild_import' === $_POST['action'] ) {

				// so, user send a form
				// first of all - check the nonce
				if ( ! $this->is_nonce_valid() ) {
					gi_load_template( 'invalid-nonce.php', array(
						'title'   => $this->page_title,
						'links'   => $links,
					) );

					return;
				}

				// get current variant
				$variant = $this->get_variant( esc_attr( $_POST['variant'] ) );
				if ( empty( $variant ) ) {
					gi_load_template( 'not-found.php', array(
						'title'   => $this->page_title,
						'links'   => $links,
						'variant' => $_POST['variant'],
					) );

					return;
				}

				?>
				<div class="wrap">
					<h1><?php echo esc_html( $this->page_title ); ?></h1>

					<?php
					$data = (array) $variant['import'];
					foreach ( $data as $key => $item ) {
						if ( ! array_key_exists( $key, $this->importers ) ) {
							continue;
						}

						$reflection = new \ReflectionClass( $this->importers[ $key ] );
						$importer   = $reflection->newInstanceArgs( array( $item ) );

						ob_end_flush();
						$output = call_user_func( array( $importer, 'import' ) );

						if ( is_wp_error( $output ) ) {
							if ( $output->get_error_data() && is_string( $output->get_error_data() ) ) {
								$output = $output->get_error_message() . ': ' . $output->get_error_data();
							} else {
								$output = $output->get_error_message();
							}
						}

						echo '<p>', $output, '</p>', "\n";
						ob_start();
					}

					echo '<p>', __( 'All done!', 'guild-importer' ), '</p>';
					echo '<p>', $links, '</p>';
					?>
				</div>
				<?php

			} else {

				// user visit step=2 without sending a form

				gi_load_template( 'no-direct-access.php', array(
					'title' => $this->page_title,
					'links' => $links
				) );
			}
		} else {
			gi_load_template( 'step-1.php', array( 'instance' => $this ) );
		}
	}

	/**
	 * Enqueue assets
	 *
	 * @param string $hook Current page hook
	 */
	public function assets( $hook ) {
		if ( $this->page_hook !== $hook ) {
			return;
		}

		wp_enqueue_style( 'guild-importer', $this->plugin_url( '/css/importer.css' ), array(), null );
		wp_enqueue_script( 'guild-importer', $this->plugin_url( '/js/importer.js' ), array( 'jquery' ), null, true );
	}

	/**
	 * Register importer
	 *
	 * @param string $key      Importer key. Should be similar as in variant[import]
	 * @param string $importer Importer class name
	 */
	public function register_importer( $key, $importer ) {
		$this->importers[ $key ] = $importer;
	}

	/**
	 * Add individual variant to our collection of variants
	 *
	 * If the required keys are not set or the variant with the same
	 * key already exists, the variant is not added.
	 *
	 * @param array $variant Single import variant
	 *
	 * @return void
	 */
	public function register_variant( $variant ) {
		if ( empty( $variant['key'] )
		     || ! is_string( $variant['key'] )
		     || array_key_exists( $variant['key'], $this->variants )
		) {
			return;
		}

		$defaults = array(
			'key'       => '',
			'name'      => '',
			'link'      => '',
			'preview'   => '',
			'xml'       => '',
			'extra'     => '',
			'revslider' => '',
		);

		$variant        = wp_parse_args( $variant, $defaults );
		$variant['key'] = preg_replace( '/[^a-zA-Z0-9_-]/', '', $variant['key'] );

		// add variant to collection
		$this->variants[ $variant['key'] ] = $variant;
	}

	/**
	 * Amend default configuration settings
	 *
	 * @param array $args Array of config options
	 */
	public function config( $args ) {
		$keys = array(
			'parent_slug',
			'page_title',
			'menu_title',
			'menu_slug',
			'capability',
			'nonce',
			'nonce_field',
		);

		foreach ( $keys as $key ) {
			if ( array_key_exists( $key, $args ) ) {
				if ( is_array( $args[ $key ] ) ) {
					$this->$key = array_merge( $this->$key, $args[ $key ] );
				} else {
					$this->$key = $args[ $key ];
				}
			}
		}
	}

	/**
	 * Returns the absolute path to plugin
	 *
	 * @return string
	 */
	public function plugin_path() {
		return GUILD_IMPORTER_DIR;
	}

	/**
	 * Returns the plugin URI
	 *
	 * @param string $path Custom path inside the assets directory
	 *
	 * @return string
	 */
	public function plugin_url( $path = '' ) {
		return GUILD_IMPORTER_URI . $path;
	}

	/**
	 * Return variants
	 *
	 * @return array
	 */
	public function get_variants() {
		return $this->variants;
	}

	/**
	 * Return the single variant by provided key
	 *
	 * @param string $variant Variant key
	 *
	 * @return null|mixed
	 */
	public function get_variant( $variant ) {
		return array_key_exists( $variant, $this->variants ) ? $this->variants[ $variant ] : null;
	}

	/**
	 * Return registered importers
	 *
	 * @return array
	 */
	public function get_importers() {
		return $this->importers;
	}

	/**
	 * Checks if nonce is valid
	 *
	 * @return bool
	 */
	public function is_nonce_valid() {
		return isset( $_POST[ $this->nonce_field ] ) && wp_verify_nonce( $_POST[ $this->nonce_field ], $this->nonce );
	}
}