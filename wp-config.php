<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'logistic' );

/** Database username */
define( 'DB_USER', 'admin' );

/** Database password */
define( 'DB_PASSWORD', '1234' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '^*rNYPou[>hBTt_!@;=kl];k7f3Uk6~zb1:uIb}GaE]NA:Q[Qey-Pp0R<mH~afc|' );
define( 'SECURE_AUTH_KEY',  'C`tTByZ+CY/Rwm3NLrL;:/1:DM/rEwG{SIAQac)&i*+D%fC]KOGnyP%rZ5~~YPLX' );
define( 'LOGGED_IN_KEY',    'Hqwq;dQ:Q|R!PQvgE`_<Sw~[it%)Np-#qpKZPyqq%&zC93OpDg}W{Z~y[)E#l`$~' );
define( 'NONCE_KEY',        'V`H}Al*k:,/-hS+2Ba+lExdl_)0fu(Y=[>s4(Q4lRG)I+ov^0V!N: ?#!p><VXnK' );
define( 'AUTH_SALT',        'zdcLE=U8ep^.} dB1]g*1BA/nNBYVLl_I27-A+/v%yHM726N_K%/U~7@[)[Q41AE' );
define( 'SECURE_AUTH_SALT', '/B$`>;WNc<g>^[]Kd/Eq;WvOEFqb2?z|bk2%8]rJYB*bz`kt/iBAwO(J4CT9gH,Q' );
define( 'LOGGED_IN_SALT',   ',D(YznBft%b7 PZ<J9kI0bG*WX;&Hl8aa~?{Wa~*7D;7-AwatX%SjwF={cQ|2i3I' );
define( 'NONCE_SALT',       'B{t7R $k)2jEnI{hbIwW1k%G_.1|olTkfm,fi,*~r cm[Eid>{pa0SIYOnJ]C^$l' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
