<?php
/**
 * Guild Importer Autoloader
 *
 * @author 8guild
 */

/**
 * Load classes from WordPress Importer plugin
 *
 * @param string $class Class name
 *
 * @return bool
 */
function guild_importer_loader( $class ) {
	$root   = GUILD_IMPORTER_DIR;
	$subdir = '';
	$found  = false;

	$core = array(
		'Guild_Importer_Plugin',
		'Guild_Importer_Storage',
	);

	$importers = array(
		'Guild_Import_XML',
		'Guild_Import_Extra',
		'Guild_Import_Revslider',
		'WP_Import',
		'WXR_Parser',
		'WXR_Parser_SimpleXML',
		'WXR_Parser_XML',
		'WXR_Parser_Regex',
	);

	// first search core classes
	if ( in_array( $class, $core ) ) {
		$found  = true;
		$subdir = '/core/';
	}

	// second search in importers
	if ( in_array( $class, $importers ) ) {
		$found  = true;
		$subdir = '/importers/';
	}

	if ( false === $found ) {
		return true; // call next loader
	}

	$chunks   = explode( '_', strtolower( $class ) );
	$filename = 'class-' . implode( '-', $chunks ) . '.php';
	$path     = $root . $subdir . $filename;

	if ( file_exists( $path ) ) {
		require $path;
	}

	return true;
}

spl_autoload_register( 'guild_importer_loader' );