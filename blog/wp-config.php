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
define('DB_NAME', 'blog_rrhhingenia');

/** MySQL database username */
define('DB_USER', 'blogger');

/** MySQL database password */
define('DB_PASSWORD', '&W7ip23d');

/** MySQL hostname */
define('DB_HOST', 'localhost:3306');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',       'F7HSv0JkZ#rwlbdFL(ZQ6sHIqbPLN()HjN1jaP8sS8eVEH3qH(#O!gOuIpWU#fXa');
define('SECURE_AUTH_KEY',       'lt9G6f6CBziDzDVzrSZR8xI9f)63CuC)@EV#11Y1o^tojSi5hVds(RXrdzOBe5vy');
define('LOGGED_IN_KEY',       'cU6Da(wKENKA(W0nPtn9y&&lFZ*&KtsD4HngJ99t&kZ!amQFKVUMvCw*w^bez1b2');
define('NONCE_KEY',       'Y%jTKZTj44lfGY#pT3KAJtBkjP347^BWWeT*o)NRglKOxx114EygpwexdA2Ypoos');
define('AUTH_SALT',       'HXdW218*E436mEw)Z!D#3%Z39hm^F)SCy7QKtca2zQCu^I&!QrVWYn(aTnbE0n(4');
define('SECURE_AUTH_SALT',       'l&SMIb7@%TPgKA5uInsjKP(9XFY8W8zb7DM3X#80A)OC4QSzCZMhEXQrh2@CaTIe');
define('LOGGED_IN_SALT',       'D2XxVuQWf1cWVA)@x613K(R(4PC1OfqlpihZ6M7OHOwA)!G1EBnHyR1Q@2g@SEkt');
define('NONCE_SALT',       'nctKaa@t)ZD&HE95zYw3mAuzuYxNt@mD4z0Ni6n)PT2^mKAKQ2CNlE6k*tTlypIO');
/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

define( 'WP_ALLOW_MULTISITE', true );

define ('FS_METHOD', 'direct');
