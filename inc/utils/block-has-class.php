<?php
/**
 * This function checks if a block contains a specific CSS class.
 * The "render_block" or "render_block_{$this->name}" filters can be used to provide the $block argument.
 * 
 * @param array $block - A full block instance, including name and attributes.
 * @param string $class_name - the CSS class name that we are going to look for on the current block.
 * @return bool
 * 
 * @package	  basse
 * @author    Mel Casiño
 * @copyright Copyright (c) 2025, Mel Casiño
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-late
 * @since     0.1.0
 * 
 */



namespace basse;



/**
 * Exit if accessed directly
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}



function block_has_class( array $block, string $class_name ): bool {
    if ( empty( $block['attrs'] ) ) return false;

    $block = $block['attrs'];

    if ( empty( $block['className'] ) ) return false;

    $classes = explode( ' ', $block['className'] );

    return in_array( $class_name, $classes, true );
}