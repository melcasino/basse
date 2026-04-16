<?php
/**
 * Theme functions file
 * 
 * This file is autoloaded by WordPress and is used to load any other 
 * necessary PHP files that will add functionality and bootstrap the theme.
 * 
 * @package	  basse
 * @since     0.1.0
 * @author    Mel Casiño
 * @copyright Copyright (c) 2025, Mel Casiño
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-late
 */



namespace basse;



// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



// Define Constants
define( 'THEME_VER', wp_get_theme()->get( 'Version' ) );
define( 'THEME_DIR', get_template_directory() );
define( 'THEME_URI', esc_url( get_template_directory_uri() ) );
define( 'THEME_NS', __NAMESPACE__ );



// Load required files
require_once THEME_DIR . '/inc/utils/utils.php';
require_once THEME_DIR . '/inc/custom-functions/custom-functions.php';
require_once THEME_DIR . '/inc/setup/setup.php';
require_once THEME_DIR . '/inc/block/block.php';
require_once THEME_DIR . '/inc/editor/editor.php';
require_once THEME_DIR . '/inc/scripts/scripts.php';