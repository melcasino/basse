<?php
/**
 * Block CSS class checker function.
 * 
 * @package	  basse
 * @since     0.1.0
 */



namespace basse;



// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * Block has class
 * 
 * A utility function to check the existence of a CSS class name in a single block instance.
 * To get a single block instance, "render_block" or "render_block_{$this->name}" filters can be use.
 * 
 * @since 0.1.0
 * 
 * @see 'render_block'
 * @see 'render_block_{$this->name}'
 * 
 * @param array $block - A full block instance, including name and attributes.
 * @param string $class_name - the CSS class name that we are going to look for on the current block.
 * @return bool True if the block instance contains the specified class name, false if it does not.
 */
function block_has_class( array $block, string $class_name ): bool {
    if ( empty( $block['attrs'] ) ) return false;

    $block = $block['attrs'];

    if ( empty( $block['className'] ) ) return false;

    $classes = explode( ' ', $block['className'] );

    return in_array( $class_name, $classes, true );
}