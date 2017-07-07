<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'dbmahamaha');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'root');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8mb4');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'YHa!f0j?E_CXt&N3<+1W`jd1`yz:`kp*F!u>22`e$-mDal04.gR2bdHd?((DF-*1');
define('SECURE_AUTH_KEY', 'o[P+^OT>9wOkV7L 0S?=0/[uII6pJXrZK]eS~!ydy-)9Roiw3-@c!d]?t=I,H%IL');
define('LOGGED_IN_KEY', 'DctJ`obwM|YO(;8f2_I_{W4@{V|bY;w]?4`(um=;pD;MLoE?oi1V:i, n+dmz?w1');
define('NONCE_KEY', 'mS!{{I_ooGps_xuwGt-RSCR0>)bRO_g8CgTMCe~@[)!:b9BhhBZ=cq>!I;EU;0X.');
define('AUTH_SALT', 'uM5xeUa^-s<]b)$$sm^]+JaCm0PqW+cjp=:QP/sub!pe>qCTa&g%k2D{/MTuHpy;');
define('SECURE_AUTH_SALT', '-HrwDF_Q*=!kz6bChk(`<i6`6k3| <I|K?5HzssW<Q{dBMPuG<l&Sh*^((XEHzB)');
define('LOGGED_IN_SALT', '&#GENd c^bO+c8T@|70NLBW(Q N784k 8IVs!)4}kw5EM&hunR8nX4*XNmOt]TBs');
define('NONCE_SALT', 'IAJ8m83WY^@a49SxdVv<8pRUnckJBp!nv9JU$NcN?a^`.HXG8nqM;lP1NV|Eb[KQ');

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';


/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

