<?php
/**
 * Guild Importer
 *
 * Plugin Name: Importer by 8Guild
 * Plugin URI:  http://8guild.com
 * Description: Simple and extensible plugin for implementing the one click demo import feature
 * Version:     0.1.0
 * Author:      8Guild
 * Author URI:  http://8guild.com
 * Text Domain: guild-importer
 * License:     GPL3+
 * License URI: http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path: languages
 *
 * @author  8guild <info@8guild.com>
 * @license GNU General Public License, version 3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	return;
}

define( 'GUILD_IMPORTER_BASENAME', plugin_basename( __FILE__ ) );
define( 'GUILD_IMPORTER_DIR', untrailingslashit( plugin_dir_path( __FILE__ ) ) );
define( 'GUILD_IMPORTER_URI', plugins_url( '/assets', __FILE__ ) );
define( 'GUILD_IMPORTER_INC_DIR', GUILD_IMPORTER_DIR . '/includes' );

require __DIR__ . '/includes/autoloader.php';
require __DIR__ . '/includes/utils.php';
require __DIR__ . '/includes/api.php';

add_action( 'plugins_loaded', array( Guild_Importer_Plugin::instance(), 'setup' ) );
