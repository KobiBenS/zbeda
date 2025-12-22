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
define( 'AUTH_KEY',          'XPm<d~o/[A4R]^@8[)r5&Y4<P8D@j(9w ;RVZ/6weE>pdxSl3WT+J.OH2S.s2V5p' );
define( 'SECURE_AUTH_KEY',   '>YSKemsx3],CZX4ZZGe]/q6R@UGe<MWln!-MBKM2KMhR<zS6y<F}ory-}8*rO=m@' );
define( 'LOGGED_IN_KEY',     '$Z;4`L2I,_O6B3^br>CB@rD!8 %b^DQ:6#RBaS5p,|2uqeU!<REh&%]+dJq[|>G%' );
define( 'NONCE_KEY',         'FtS^AQ__WtDk`1AwhU1l7yP0OuG>Qs6_::&nQ?e5L=:z{,^sP|;|/W(K2x/oZWkU' );
define( 'AUTH_SALT',         '0j`VRu8K)<k`zRl;:JPb{hLhzgIy@F]=<ul((jvJt7Pmh?_7M_=4+;NL6mC([Nq=' );
define( 'SECURE_AUTH_SALT',  ',-D^a|<?0&{>2[,1*[.)_$-xMrYs*V+zgt?<Y~ ;gT?4En?3iDQ@X7[;YR7q|R.N' );
define( 'LOGGED_IN_SALT',    '>`b^0J,ch640Q[)A[Hg&bS#|;:3)OAoGVW>JpAuh{ET;d1@p#7Dfwe`.XWbwU5Yg' );
define( 'NONCE_SALT',        '7~`zk,*F4$u]UmTEL9=]^9Ngn0;7%gr(PA(*-sp[OD,$j>+P&2#WU)HgZ[f}KPKj' );
define( 'WP_CACHE_KEY_SALT', ':0UNB5X}O*wI25b5Ka%-^8+~/iE%n[+ii[V0c?i(TxypQN4Z&10LI%Kv#M-1* KV' );


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
