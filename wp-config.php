<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress4');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'm}cCGCuW6OHGgbjoN]47u~zJr2|b;>xm9f:d_AuVbXh]q,e:*Q_[,&w+cj8%it{n');
define('SECURE_AUTH_KEY',  ':0#UYB3!T6UeTsjFy>M4EwsyA BV4JurD;NAbX8{ jvxiBZ5ae/;?@.oZ2rU9No]');
define('LOGGED_IN_KEY',    '8GWcZFl`zlB%QBVh*YG]MZ3[qo=O!xN4g1.?]nF?tJ#B=8?sZ);./D97``^0AeYl');
define('NONCE_KEY',        'K<)JEYbo:|`HUmJ%Sn6X`(kM+/OV3eMT<lPK.!c688E>qox9Df%3gd^a@ %JP.- ');
define('AUTH_SALT',        '-3FDRBK-FAR^[=88o@L?V6]Q!+&c*X;B5q?u}16.`Z)VxysP)Fg`0f2:V J0QjM*');
define('SECURE_AUTH_SALT', '<?wJSFIh(w(o#q2I_re;#-rOhE]z<h0uVG 8]cf%[!(Y_ar24$tc=?u[D[WHEi.9');
define('LOGGED_IN_SALT',   'b}?b?x9i<#;.y%$2,6nvt>8Dc]RP>w,:xr-U{n%4iW1L520;;oZ3f0zW(S5k*DXy');
define('NONCE_SALT',       'DvDjxm<I^Y$Q6Nwn0B;D}nIvZn]!?~Z?bE!dVD~he7q4;9$b20@+E)0#O(a`UFS}');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
