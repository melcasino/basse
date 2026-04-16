<?php
/**
 * Setup theme defaults function
 * 
 * @package basse
 * @since   0.1.0
 */



namespace basse;



// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * Setup theme defaults
 * 
 * Set theme defaults, register and remove WordPress features.
 * 
 * @since   0.1.0
 * 
 * @see 'after_setup_theme'
 * 
 */
function set_theme_defaults() {
    
    // Remove core block patterns.
    remove_theme_support( 'core-block-patterns' );
}
add_action( 'after_setup_theme', THEME_NS . '\set_theme_defaults' );