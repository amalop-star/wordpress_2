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
define( 'DB_NAME', 'wordpress_db2' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         '*10fL|!s2g|IcQQ%d%!/bX3|Z)6-YIxA2,10W%Cxj~XU^l#D?rC^h@QnmQXV[_gM' );
define( 'SECURE_AUTH_KEY',  'zo}3mfR29H0p*<PPG5]C9ThSkb+rVAeaF^0+a~$&;<*:nr#VNLT3mM<7Q?-H*CVO' );
define( 'LOGGED_IN_KEY',    'Y|W&tRZt<p#R{Ay>!YvW?j-i/atVl[3#OZQVf+@:/jQ07)_sM#,M@cm-shL)pYCt' );
define( 'NONCE_KEY',        '8g4m.j4SHn_XYQZskpXC c|#bj>yqs+ja 5CRch y$n!W;4o_l7y*/bf4Q&fEIEF' );
define( 'AUTH_SALT',        'ymwk &3VNDj2|G52n#L[fR{Wrr@;3BVH[O,j*X$ C:4S>U6+&.^VX+UA9xaeiquu' );
define( 'SECURE_AUTH_SALT', ']_19akw0s.jm1SI;nD-.@<;%ZD4z=AsThVED}WfAEy`1K.3.%k,mCxcs+ F-)5OD' );
define( 'LOGGED_IN_SALT',   'Q%NFFHgJ>akum2(A8;o;/Hc/L*@oz9fGs!K7p7~qPfICC; +h`K%;^`TToORmmvC' );
define( 'NONCE_SALT',       '%)vU]OpbT_Om|O}@w8Etq6jt(}`T&?vtw-2I)9I1qHbS{/DxK4Oy|>f(`C{_7<</' );

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
