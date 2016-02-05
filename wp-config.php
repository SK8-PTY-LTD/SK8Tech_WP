<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'skasia_wp1' );

/** MySQL database username */
define( 'DB_USER', 'skasia_wp1' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Q@KQMKRC]sv(mgDmyQ&85]*5' );

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'cbfdEXUT2SVTvNENQ2z23vnD3yB3Dw9x99qVkOUL2iiXnBgiB6mwEMNNUuZ76MEY');
define('SECURE_AUTH_KEY',  'XR0u6Yn0hv5ul1GFgJJi0cYdemBDp82nwOJDGYXY4N0BiVO5OxW1PjMA1MpeTu2K');
define('LOGGED_IN_KEY',    'V3A65W2Fc2jlQFP40oqONpb5LYCEMQebd4bazHF278wLsZY1Bho2CTBSVhNw177h');
define('NONCE_KEY',        'JXysA7MT0lFpFsOKFyOXMfMr7eSCqO2SEJY5aOGuzMWwIVhodrFb77HHw3E3sJCR');
define('AUTH_SALT',        'TkD6sCammpuQlwc6iRmG08PRoU9BVRWzD9GRk1YAjMkYyh1DyGCqnpmnOciMDXhp');
define('SECURE_AUTH_SALT', 'UpKxDmw00ivxb9plKuvCvuSDxhaED5Jp63j4kk0e6fsPnmBiic5LeadYuzkBqlC2');
define('LOGGED_IN_SALT',   'ggORvu0E829bwMcPPRt675ExFT7meSyGbdFoHKrbuIBlwn1JpwKhRi99tOxo7F4x');
define('NONCE_SALT',       '1dMw5o66EN8TpnD82YjwjCha22mhvMfoQgHdAp3Ahsfxp5RiuJlTF3h1wrNiYcrK');

/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');

/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);
define( 'WP_HOME', 'http://sk8.tech' );
define( 'WP_SITEURL', 'http://sk8.tech' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
