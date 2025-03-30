<?php
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
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',          '_I:dJL8>gte;l @oUQi?VRn!|cqHcS7g{:]B#8 U$Jd2Ii@%;)HOMn ^VyYp}2d)' );
define( 'SECURE_AUTH_KEY',   'yTWP.g8Xc?<}xoBcdQMZIn@7Rq#OjYa;>43;H&B)#a%sFD~V`wx#E_y9S@?81ZiH' );
define( 'LOGGED_IN_KEY',     'gOq.tS#4RF_XO#YgqJp)#8. vdQ*2;bM9Lgv}9>#~d^>+EOi5Q!cgPe,kvV3j%kE' );
define( 'NONCE_KEY',         '`IpZ%DI|T-S}W.8w_HgS&h/TC->x4-2bJ[Xs_-LxY0JMb#xW~>J7o&ZPZLP14pF ' );
define( 'AUTH_SALT',         'W_e($7K$t4R2Tw ZG0:6w95quD:#z4Eo;>Cv11t!wEZ!84M92sW>K_&D7[Yp5hAZ' );
define( 'SECURE_AUTH_SALT',  'Q%SV?#^;LlBe/OHro*Uq>8OHxoALYU&H[`(JDcjs=j}-Cfm>$.MHALO5;W5al!nO' );
define( 'LOGGED_IN_SALT',    'g 8~@o1YdxVk, ~F@ [l30RTQUe{lA[aNgKg`-jMF$K?^U(wC*f0K[]oSniK~u@P' );
define( 'NONCE_SALT',        '[W/,L03@G/4Ue6SgiBfM{TE{}{ ~aswf{VS@A|KV%Wb{!pk+.;op^T/deHAJ3OZI' );
define( 'WP_CACHE_KEY_SALT', '/C3Qa!XhhH`~;d_!F?VU +%P0?LdB$]j]Q2CWzLW[EpB=0}os~=tPd.Y_w@,{pK{' );


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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
