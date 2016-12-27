<?php

/**
 * For storing objects
 *
 * @author 8guild
 */
class Guild_Importer_Storage {

	/**
	 * Object Storage
	 *
	 * @var array
	 */
	private $storage = array();

	/**
	 * @var Guild_Importer_Storage|null
	 */
	private static $instance = null;

	/**
	 * Get the instance
	 *
	 * @return Guild_Importer_Storage|null
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
	 * Add
	 *
	 * @param string $key    Key
	 * @param mixed  $object Object
	 */
	public function add( $key, $object ) {
		$this->storage[ $key ] = $object;
	}

	/**
	 * Get
	 *
	 * @param string $key Key
	 *
	 * @return mixed
	 */
	public function get( $key ) {
		return $this->storage[ $key ];
	}
}
