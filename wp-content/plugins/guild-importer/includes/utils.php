<?php
/**
 * Utilities
 *
 * @author 8guild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load the template
 *
 * @param string $template Current template file
 * @param array  $args Args passed to template
 *
 * @return bool
 */
function gi_load_template( $template, $args = array() ) {
	if ( empty( $template ) ) {
		return false;
	}

	/**
	 * Filter the list of directories with importer templates
	 *
	 * @param array  $dirs Directories list
	 * @param string $template Current template name
	 * @param array  $args Args passed to template
	 */
	$dirs = apply_filters( 'guild/importer/template_dirs', array(
		get_stylesheet_directory() . '/template-parts/importer',
		get_template_directory() . '/template-parts/importer',
		GUILD_IMPORTER_DIR . '/templates',
	), $template, $args );

	$located = false;
	foreach ( (array) $dirs as $dir ) {
		if ( file_exists( $dir . DIRECTORY_SEPARATOR . $template ) ) {
			$located = $dir . DIRECTORY_SEPARATOR . $template;
			break;
		}
	}

	if ( false === $located ) {
		return false;
	}

	include $located;

	return true;
}

/**
 * Return bytes from strings like 256M, etc
 *
 * @param string $val Value
 *
 * @return int|string
 */
function gi_get_bytes( $val ) {
	$val  = trim( $val );
	$last = strtolower( $val[ strlen( $val ) - 1 ] );
	switch ( $last ) {
		// The 'G' modifier is available since PHP 5.1.0
		case 'g':
			$val *= 1024;
		case 'm':
			$val *= 1024;
		case 'k':
			$val *= 1024;
	}

	return $val;
}