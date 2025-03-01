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
define( 'DB_NAME', 'db_homedesk' );

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
define( 'AUTH_KEY',         'HyPmcWbQhaB$r?nTaJHAz{!eH5E5/a4P<(t4vQH&iNjceufQ&Jx)9q#LciJihcq4' );
define( 'SECURE_AUTH_KEY',  '`M#a@BCZ@jbp<YK(;-`4si=Qa0!>;QO_Vi<zX0gTs{IfPQNSEx#kVk:JgWAUq+*~' );
define( 'LOGGED_IN_KEY',    ')%mtNso)Yk:I~/)7x7@Y<Ce{ejiDe$E{-=M`PnANkYbAg@=bF<!{i|OQBny<#6Sr' );
define( 'NONCE_KEY',        '(.8@3q`nI^6PO:~cnfP;|Ppn]fOz^UQN6XLaw=63$6i&+&~ ,8QElHh;M0)6>*jz' );
define( 'AUTH_SALT',        '6CcW&#SiQn9dT6D821Y h,3$:wIv43-/1wYHIVPQH;Nj/B`4`{rwig43C5Q:kPN|' );
define( 'SECURE_AUTH_SALT', 'CW[7@|Qe:r-U,}W,S-pBblJqZ,#F[uv>Zo1j:M+Ad/Bdq6gV}4SQN:~72sjU Fku' );
define( 'LOGGED_IN_SALT',   'IQbsI?_Hq[l(u|joD,]3xoXiC<I]XJ%#.(yVzix5Xh+S_-C&jgfet[%7hi5RO09m' );
define( 'NONCE_SALT',       '2&u!zT*#%*#lG:Y&r)%M.~w<A&G4- }^.D&>?J?TQ:};XjDSN~Aiy[T%(2_5@+9M' );

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
$table_prefix = 'wp_db54_home_';

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
