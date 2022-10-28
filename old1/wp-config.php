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
define( 'DB_NAME', 'coemain' );

/** MySQL database username */
define( 'DB_USER', 'wordpresscoe' );

/** MySQL database password */
define( 'DB_PASSWORD', 'commwordcoe' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '2[fqrAb%s_OlH)z/6yU.Xn|F3vS(< +kJ;btonb>(mx:BY/F,t[%C|z,U,{=k6!D' );
define( 'SECURE_AUTH_KEY',  'C)<:hvjl;y&KH0)iH&UF/hd(ewz{m$3sNrPfO5R*nszV[qe2TmD*,X;<*k}RLS&p' );
define( 'LOGGED_IN_KEY',    'd_wXjNsR?h}_P.-[ZJ&*Gqy,=z<%if-`*Y,6c~ADI<V3+<b>mvIgb9Ewb I}-Z24' );
define( 'NONCE_KEY',        'GY*D26ar4Y?8dNrwuGzTWf<WUhEY-`6-dwC${k`]uYfd0Y~7ATZf(3y|wVUCGu*W' );
define( 'AUTH_SALT',        '<O]i8j9h^&.1}OA0td9~yAFKbBp!RT$1?eE>w?&y:#m$g(l)x?V8tV2,6p,%6%$!' );
define( 'SECURE_AUTH_SALT', '=HV444ncu)!G*nV8-E>`=(@Ec`}e[<uoGSuZ%fyi17FDqic@E&EDcOSP)mn@:#Jh' );
define( 'LOGGED_IN_SALT',   'Lj*mkuD-SFEx!W]2D9bk1#zm5}8G|Fo13 wR^~%c5:A,yNJ=b~:cz05hvbaa0C:U' );
define( 'NONCE_SALT',       'U?r qX)}y3G#.y0..-hZi~el]3 2yJel)YAn)V%IM_&HP}]-rI2/Yk=Z<WWkbAJI' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );
define( 'WP_ALLOW_MULTISITE', true );

define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', true);
define('DOMAIN_CURRENT_SITE', 'coe.northeastern.edu');
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);
define('COOKIE_DOMAIN', false);
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
