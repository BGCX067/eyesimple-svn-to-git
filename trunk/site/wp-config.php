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
define('DB_NAME', 'eyesimpl_site');

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
define('AUTH_KEY',         't>?(nJktT,J* MyuD/pU0KL-DCMy^s-//6WmXk^zE_#DYN)tmcr[+J$7#_ZxR.SL');
define('SECURE_AUTH_KEY',  '_ayPmV?}NEH:pdud?CC:;R5*)ZoT~kgtE8}<_bg>Tf?)W6g -)Yrk<h=I4b_A;Uc');
define('LOGGED_IN_KEY',    '<3pBV+ZV][j?{=CwL`~<?7TJ$TOz`7=tr05D;PklW{MI8,Jo #,2{qvUM%U14e=u');
define('NONCE_KEY',        'Ykha:8JbwH9YXkb=tiv-t1:YwW=`5H}9f=vyJ:q:y-<Qy_fBDl+Bc/~qimpOw*1v');
define('AUTH_SALT',        '++1W,}JW`42`G=L8iwm}:?0~#<YM5na-=nTx8obLY>-7brP_Ge}rpq)ZLGgfBJI{');
define('SECURE_AUTH_SALT', '*sz*_o4RKXD!~!45p7}uM}h*/^bqN~og8 -M7W^>)q|vRub%>)8-U9ft!RUVb/FX');
define('LOGGED_IN_SALT',   'yO ag9/@;&>/B `SUhOE=28%utKqC~]dYR{@kZmjcd`R[uyqc|VRF2-[fM%{_]>_');
define('NONCE_SALT',       '_ar8+5Kqise6r?eeBJpb9jVxx%Li9$}_:j:8~vmoW4@o`ui$2Y/uzyos}=G2p;/,');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'es_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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

ini_set('display_errors', 0);
	
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
