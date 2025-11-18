<?php
/**
 * Custom functions.
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
 * Load required files
 * 
 */
require_once THEME_DIR . '/inc/custom-functions/dynamically-enqueue-custom-block-style.php';