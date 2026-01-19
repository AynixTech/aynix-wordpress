<?php

define('WP_HOME', 'https://aynix.tech');
define('WP_SITEURL', 'https://aynix.tech');

define('WP_CACHE', false);

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u703617904_S5lVb' );

/** Database username */
define( 'DB_USER', 'u703617904_0hiUa' );

/** Database password */
define( 'DB_PASSWORD', 'TLJjD2Taq3' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          '74O,T|Q5;-DzYgr=2TtB;}74-iB[*B)({2O:-mO#kZlTru=8s}?OjaB_[CBOlUd|' );
define( 'SECURE_AUTH_KEY',   'y>LJp<()}{Td7@gsd::l2=YuNl$*,O [+y%8Wx]%rpaXzJNY!Bt2NbYwn9V{!P6u' );
define( 'LOGGED_IN_KEY',     '-l<]Joz.cAZN^DgeOHUsdz9xhA?J DVX|E-*>c%1$*]6qcs9Z_4y`gOBi.MjTPW(' );
define( 'NONCE_KEY',         '9<;2/bz,Woo(iIKI:K_|$y~mv{LXI`N~0jU)yG ?<|pe5K|A=s7vx7xyT/UJ$IB$' );
define( 'AUTH_SALT',         '21GZHPj9#B g,gl,D!YskHGdn U>l `fK>KmY_Hy)qo)sT9e1%1RqBSTO}`7x8eV' );
define( 'SECURE_AUTH_SALT',  'L2,f?Kt%_&_4=gvJ.vXJ% At TQY!D_P?.=zV%u[7pKp(n6e>6RM.281GY}t*g#N' );
define( 'LOGGED_IN_SALT',    '9v,-U:@@@C(sw=bkXG<qO(8Mb_K<+A?:+(>wI`d?6sF,?fym5n U2iP4)`v8}zWL' );
define( 'NONCE_SALT',        '=wzT5&0-]6^%9eN_#7.~B6prahb6vs#5Pp2N<,4jyXQwKp:&~!sQo&CT3$?(II9W' );
define( 'WP_CACHE_KEY_SALT', 'VD4Q%{7Txg>_QkS]PO0x6HWFjWZy+D6ablzY!ti]5Skn3bgS6 J)STRw;Z72A)S2' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors', 0);


define( 'FS_METHOD', 'direct' );
define( 'COOKIEHASH', '2a92bfcbf4b8bcd06f7457acdd108ad8' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
