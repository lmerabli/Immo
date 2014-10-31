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
define('DB_NAME', 'WordPress4');

/** MySQL database username */
define('DB_USER', 'wp_immo');
define('DB_USER', 'root');


/** MySQL database password */
define('DB_PASSWORD', 'wp_immo_pw');
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', '83.156.178.59:5555');
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
define('AUTH_KEY',         '#._O=t;:2YNQp<2<!R_=P[;/VQ)foBdIK`Fx-K-GX/G]tlxp~yGh:v&P E/vVy p');
define('SECURE_AUTH_KEY',  'V{nWXVAfz^Y.=*tv=MuBH|P/?/t~dt~ -Z=oubg]z|rL0TH_]7/`&[!k7P>`8JEp');
define('LOGGED_IN_KEY',    'Y {-Ms3v%We<$}):}wjU8z{,]YVEln_)tRfX&cI|DS()l1#h}|cZkI}AW9[Kjeel');
define('NONCE_KEY',        '(pd1Qq0:}rtN]]1F|h|P|2nUv>Y8rK_^/s.T%&,b_p9JLM7w?y[[({!meC[|%PXL');
define('AUTH_SALT',        'Ld1PodyyE<oqs(Z,ad{L|u7C@{q5Vy@1;@C7=TgFsa;/};$2vJs8!8AM(F{zHuM-');
define('SECURE_AUTH_SALT', 'A^H-zFQ+u33EUR{Lc+6<mhiHZ=@-lr%L}yF8wH!1bE-a#E7nVv=h(dzCeo-SjsLv');
define('LOGGED_IN_SALT',   'JPzPt^B//#):|6H6/q{25JbO3Ae7`J6SqQ7#@aUfjj 3H$PS81E!wwy=!M@lEzs=');
define('NONCE_SALT',       '7Q[jMy5~DJx-WSLZfo3K))Bs57n.pu_]=FV:bna]?prFN9-56b>Vl%:|i(H+5el=');

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
