<?php
/**
 * Custom block pattern category registration function
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
 * Register block pattern categories
 * 
 * @since 0.1.0
 * 
 * @see 'register_block_pattern_category'
 * @see 'init'
 * @link https://developer.wordpress.org/themes/features/block-patterns/#registering-a-pattern-category
 */
function register_block_pattern_categories() {
    $block_pattern_categories = array(
        THEME_NS . '/templates'	=> array(
            'label' => __( 'Templates', THEME_NS ),
        ),
        THEME_NS . '/pages'		=> array(
            'label' => __( 'Pages', THEME_NS ),
        ),
        THEME_NS . '/sections'	=> array(
            'label' => __( 'Sections', THEME_NS ),
        ),
        THEME_NS . '/cards'	    => array(
            'label' => __( 'Cards', THEME_NS ),
        ),
    );

    foreach ( $block_pattern_categories as $name => $properties ) {
        if ( ! \WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
            register_block_pattern_category( $name, $properties );
        }
    }
}
add_action( 'init', THEME_NS . '\register_block_pattern_categories' );