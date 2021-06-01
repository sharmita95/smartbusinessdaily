<?php
define('WP_CACHE', true); // Added by WP Rocket
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
// ** MySQL settings ** //
/** The name of the database for WordPress */
//define( 'DB_NAME', 'conteoy0_bb8' );
define( 'DB_NAME', 'smartbus_sbd' );
/** MySQL database username */
//define( 'DB_USER', 'conteoy0_bb8' );
define( 'DB_USER', 'smartbus_sbd' );
/** MySQL database password */
define( 'DB_PASSWORD', 'B3FEDACe8j5a9mp1c6q7g4' );
/** MySQL hostname */
define( 'DB_HOST', 'localhost' );
/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );
/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
define('DISALLOW_FILE_EDIT', true);
/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Y@Q)oW+1NIKWE?shXs1)iFa=1,joIbU%8]qos:&|T]%^GUV)4b+8rn4<bvhfOB6/');
define('SECURE_AUTH_KEY',  'k44n<Yu`|c3XW9(y`X{.Zd`72sFIZ<e`z-]fT/4*3x4g|d|-_4<nDW3oy!v>`T;g');
define('LOGGED_IN_KEY',    '~%~8R@?]vao@8W~knLk4vQZ8jW$F:9J#|c!i+g`8DNYN%gw:&ePe,Z`j<]CnexH,');
define('NONCE_KEY',        ',fBh|:~_}3?pJAjZs@!m+hkw:`grp&mFW_G}}$(*I:@mX<%|Px9*FTugFHKb<NZ|');
define('AUTH_SALT',        '=y8gQm}s+Kn+Z`7|Hh+|w&8P^c[+A7cj~AdU yB0f-3*>I{qD91`nMMNt-GyjSJ?');
define('SECURE_AUTH_SALT', 'QR-.e`}^V!ZerpuxLO-WMOJ[X1WaG[QcjNg&;a`VwV[,m~=ZZ:V>{$|O-z{-b)R*');
define('LOGGED_IN_SALT',   ']E*xDsb`r|.gLm!8tE4`|!,5vi_}Tqtyr;Ns/*.GrjT;{_%|51T:`.:3+|7dEi=C');
define('NONCE_SALT',       'oHu2vi+HL#${,_Wm){K!-u^l +*+Inbs-ClfK_8!hbF|HCfXk2GrI8.,Ll5zaek0');
/**
 * Other customizations.
 */
define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');
/**
 * Turn off automatic updates since these are managed upstream.
 */
define('AUTOMATIC_UPDATER_DISABLED', true);
/**#@-*/
/**
 * Word*/                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
/*Press Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'bb8_';
/**
 * For develop*/                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                
/*ers: WordPress debugging mode.
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
define( 'AUTOSAVE_INTERVAL', 300 );
define( 'WP_POST_REVISIONS', 5 );
define( 'EMPTY_TRASH_DAYS', 7 );
define( 'WP_CRON_LOCK_TIMEOUT', 120 );
/* That's all, stop editing! Happy blogging. */
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
// include_once(ABSPATH . WPINC . '/header.php');