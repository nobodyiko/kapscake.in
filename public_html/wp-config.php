<?php
define( 'WP_CACHE', true );
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
define( 'DB_NAME', 'u615969973_86Nby' );

/** Database username */
define( 'DB_USER', 'u615969973_CUkNN' );

/** Database password */
define( 'DB_PASSWORD', 'nlmQmGT9kf' );

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
define( 'AUTH_KEY',          ']gy-A8F&lIgQnL}BHWh%H5r5NE59}e,dCuZ8Ec]] jx_501v6hh5H|^Oi(bZf>U`' );
define( 'SECURE_AUTH_KEY',   'cJYiNui[-4IL7fFf:sYef_3+bk24<mpl4qULEVMC1t/qP=F!!Y0?wdcpXBR6{bA>' );
define( 'LOGGED_IN_KEY',     'sSAK}QlMCtDF8qS0:i~#Fph/2@hfpsPxo1DR|y)>zk7?gb[zctZ}~;lNf[x8k6<)' );
define( 'NONCE_KEY',         '#cn/tHj{0L]<Jw7R;p[q2:~MIvG2heo))S!,W=3xrnX8Vg(S>x.Fo4jk9P/sC_JE' );
define( 'AUTH_SALT',         '^x&nof8qY}#)A q-k|md.+q|c},qUYgGusQ(Qan]!PuymU,w#dnf[taB` .OOUo,' );
define( 'SECURE_AUTH_SALT',  'Bl RZ5G.3[++USfW#hvO3MOm^q%.d3ox#MTM%H9{66)SR42/[>ZWAyJx:AUQc!wa' );
define( 'LOGGED_IN_SALT',    'I{Hn{Qnfh//H0b-XF/hUWj5,$(y%x$jlP`E;R~ -g.k#..pr;M|MbZ^qEWmC=(Kx' );
define( 'NONCE_SALT',        'Xfu^_h%)j5.*Iu+4z95rFe?>/7E_edU@wk..~!VOx]WQW?DQmX` KUPgplJ:6wfi' );
define( 'WP_CACHE_KEY_SALT', '7,0/Jz9(uA<.}4:|4npv>1yP;74GP8ta0J.Qa0q)i]2GHeO+ENkf*XKm) ny^H[_' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */



define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
