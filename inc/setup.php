<?php
/**
 * Theme setup functions
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
 * Setup theme defaults, register and remove WordPress features
 * 
 */
function set_theme_defaults() {
    
    // Remove core block patterns.
    remove_theme_support( 'core-block-patterns' );
}
add_action( 'after_setup_theme', THEME_NS . '\set_theme_defaults' );



/**
 * Register pattern categories
 * 
 */
function register_pattern_categories() {
    $block_pattern_categories = array(
        'templates'	=> array(
            'label' => __( 'Templates', THEME_NS ),
        ),
        'pages'		=> array(
            'label' => __( 'Pages', THEME_NS ),
        ),
        'sections'	=> array(
            'label' => __( 'Sections', THEME_NS ),
        ),
        'cards'	    => array(
            'label' => __( 'Cards', THEME_NS ),
        ),
    );

    foreach ( $block_pattern_categories as $name => $properties ) {
        register_block_pattern_category( $name, $properties );
    }
}
add_action( 'init', THEME_NS . '\register_pattern_categories', 9 );