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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'broncebat_new' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '^]w_&D) e{G5|/raJG|Ap#{,K]f4Yh$wp7pG/8gfQ[zdyb7174;#5z6X;`&Bo)Hv' );
define( 'SECURE_AUTH_KEY',  'a:<SJH=DBO!IEfl3TcWO/Uo:{NxBr7nH1Ce%8ls{P$^Z]d%$Xw,jJa6SHz6`S|71' );
define( 'LOGGED_IN_KEY',    '%XYh]h-Dm0+^i_:V_!KG@V&-SQCpydyvsY(2.0x*g <LsONW_p#,@WD^u*>gA~oT' );
define( 'NONCE_KEY',        'u< <A(|SMqW$|miYBUU^p+B^|ppv&opuDQU?P9thf!m<fgM<uOH)Vc,TfJjjc$wB' );
define( 'AUTH_SALT',        '<E{.yy}!?hfjSXT;j0U[iwhd3)Gn7yPrXPvt-iC^=,&rOk$rWSw;roSC@JA_mBw~' );
define( 'SECURE_AUTH_SALT', '$~JKt{?Yd ; }2o22a:QwbEc,FE,3%]qMHB:2?rwi:)V6t`/|Db%9TiEq}n  N{#' );
define( 'LOGGED_IN_SALT',   'KaIgc/)M2e,8(q%@eZ{F/hPqNF&EcM.I?slaUIC8>dqh0d4b:,$Ap1<ZWPG-:;wK' );
define( 'NONCE_SALT',       ';-[(:I!;TM3P%a-E!y4oy/.?w ABFY5y;-`BBDWvHX~$%&yI}*vEy[<oiLk#W9`G' );

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
