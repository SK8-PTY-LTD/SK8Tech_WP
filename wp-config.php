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
define('DB_NAME', 'skasia_sk8tech');

/** MySQL database username */
define('DB_USER', 'skasia_sk8tech');

/** MySQL database password */
define('DB_PASSWORD', '-,h^RUODD#6e');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('WP_CACHE', true); //Added by WP-Cache Manager
define('WPCACHEHOME', '/home/skasia/public_html/sk8.tech/wp-content/plugins/wp-super-cache/'); //Added by WP-Cache Manager

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'VvpH$I0!;V2NL4I0X[@(Ww:~Xh,Hs-6kuplOSqmFQ@8H:QIYDhpVVBFy9NEs=jSw');
define('SECURE_AUTH_KEY', 'ix6CTu;18ytA,{+)P/nz9@K!]?9W7OUmMVb7(#gju0R}*;*>|.Qq^jD,8S@5g_w)');
define('LOGGED_IN_KEY', 'pNRri!IA}x`H9u/DLal^_]5I>l*1amHa{ ~I_/z]L+:0:5]O:9yMz}#m!FHQ<&2Y');
define('NONCE_KEY', 'c0RF(@ryr4Gtt4{uB8CF`<l[h$aY2FG2#0N.I~] Bn>*][q:wd BH,({jU2#zzr0');
define('AUTH_SALT', 'n>OH*YAZIiGV}Jt7&s=g(r@a5LH+Xa@`zZbc}aY&!7RMI.{.56C^?5!<m)|Gq5? ');
define('SECURE_AUTH_SALT', 'Bx#l)2&rx{Og(E%*tvm=j~ysj>*]/XTQ.fy(dCuLh23|tvkt6h-<3shp42`CxS}e');
define('LOGGED_IN_SALT', 'iAu$BzqP6Xwvqy3MbUm!ap8^.54B8<J~=0SDJo^iDM7GkR2lC+=u!4Cv&10]f_8_');
define('NONCE_SALT', 'n(^5DZ*55lL6p1tDt9:&$8@U>qxumy_PO#)97gaU@r`ow/:egYoAr4oyA(cf8`Cw');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'sk8_';

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
if (!defined('ABSPATH')) {
	define('ABSPATH', dirname(__FILE__) . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';