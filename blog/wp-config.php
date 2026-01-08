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
define('DB_NAME', 'citizenshare');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         '/TtOhWF6>|f~7SgggzB:-O0;JxMY&51D#d*>q,-@nE`rKLs516GZvV.f6rk!Ws0}');
define('SECURE_AUTH_KEY',  '+ 9!|%{+2mar)}-kJ sm<l=7ZuTB=qu >eJilfw6_?U;{&fzVg]($+hq&HsHjM9W');
define('LOGGED_IN_KEY',    '1j=-Y0o{mH2aA.:X0L;OBP,).g=}#_6/wZrQ6R+@L%jJ|lUfiXrdyXlX~B!+.z>S');
define('NONCE_KEY',        '`X(Pp6UK}^8#s6Vg}m|sBk([Q4]XegWi8~SKLu%vC~Gl2ux@xVp5<C-.e-ry>8&>');
define('AUTH_SALT',        'P`z`~<6nJ_@r=%|KMXHA+jv_~2_TTeHvH.TalyMft.1<C.925k]<tAF4|<Dr@>>}');
define('SECURE_AUTH_SALT', '.h?%y7b6$L8%R9Nql|3;Y-RPr?~LA$F&uUJ7F/~)K`j`z6xr7b8H~[>EvElD`M?L');
define('LOGGED_IN_SALT',   ';MU#Sm3/1%r%<<^|*?]C;|;kazUuhup}rVX|WA@|31baMwB1|3D~9Gl7Hj@)7^./');
define('NONCE_SALT',       '!WYh_]sFnf^r;hADDt)?uM&mEo-Xyz@nzD.,%q6+E +9XHxeZs]d.IXo-K7&K]&>');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
