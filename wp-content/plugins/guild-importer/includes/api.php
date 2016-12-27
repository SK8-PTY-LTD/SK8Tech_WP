<?php
/**
 * Guild Importer API
 *
 * @author 8guild
 */

/**
 * Register the variants to importer
 *
 * @param array $variants Variants or skins
 * @param array $args     Demo import args
 */
function gi_register( $variants, $args ) {
	$instance = Guild_Importer_Plugin::instance();

	// register variants
	foreach ( $variants as $variant ) {
		call_user_func( array( $instance, 'register_variant' ), $variant );
	}

	// add args
	call_user_func( array( $instance, 'config' ), $args );
}

/**
 * Register importer
 *
 * @param string $key      Importer key. Should be similar as in variant[import]
 * @param string $importer Importer class name
 */
function gi_register_importer( $key, $importer ) {
	$instance = Guild_Importer_Plugin::instance();

	call_user_func( array( $instance, 'register_importer' ), $key, $importer );
}