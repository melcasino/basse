<?php
/**
 * Theme functions file, which is autoloaded by WordPress. This file is used to
 * load any other necessary PHP files that will add functionality and bootstrap the theme.
 * 
 * @package	  basse
 * @author    Mel Casiño
 * @copyright Copyright (c) 2025, Mel Casiño
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-late
 * @since     0.1.0
 */



namespace basse;



/**
 * Exit if accessed directly
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}



/**
 * Define Constants
 * 
 */
define( 'THEME_VER', wp_get_theme()->get( 'Version' ) );
define( 'THEME_DIR', get_template_directory() );
define( 'THEME_URI', esc_url( get_template_directory_uri() ) );
define( 'THEME_NS', __NAMESPACE__ );



/**
 * Load required files
 * 
 */
require_once THEME_DIR . '/inc/setup.php';
require_once THEME_DIR . '/inc/scripts.php';
require_once THEME_DIR . '/inc/custom-functions.php';
require_once THEME_DIR . '/inc/utils.php';