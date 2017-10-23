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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'rudia');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');
define('FS_METHOD', 'direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'q%YpWnUT8+35IA6|O#|]3Xq5N+[35{}+`d4IHJEciSdWM(yEq/9rszvJZ-WQhvu>');
define('SECURE_AUTH_KEY',  '?#A@p`_+Zt?N?a-=-7DHPdzhjS^+?)-P2Y!Ktj9V:[iW_7W;y*sFj#2Fgv[9RVHj');
define('LOGGED_IN_KEY',    'lL+DD.[M4 #;HYN*~]Jb(^Uolv0#|Tfa0?Z7/~pd#.*WkXvF d0Z>-+c_#y+-6e=');
define('NONCE_KEY',        'h/LwRk5c;:VRwI/w66gzJOu[up;$2!.$j<cjrLtb6WmQ[r%bQ~1TaC1;aHVx%lgs');
define('AUTH_SALT',        'l])Y&}U&W{<N2=y9]3&[9wcGYElJBD+9RE(LHpTu];cViG_lW}!SPW^9+y.mYeVq');
define('SECURE_AUTH_SALT', 'D1O9sanV~&`OZw-.:o 0f/:%5faIgsIgsj^aG6T~bZ-1;FbjlM8lxr~<& Qb)>oe');
define('LOGGED_IN_SALT',   'RfrhIZwmSlhpi-[3- &-Uh$WG-:XGz,I`hri}|H^~~V`gkFYZ>-N/9@{aDb*dp_*');
define('NONCE_SALT',       'u.pX-7DO(WT0<rZWJc |n;$>BZG:R(,Rh+wu>-~=2Up=<nKq!K~!H~;GtZOdNr+t');
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
