<?php
/**
 * Remove 3rd-party block plugins in the editor
 * 
 * @package basse
 * @since   0.1.0
 */



namespace basse;



// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



// Remove action hook that loads 3rd-party block plugins in the editor
remove_action( 'enqueue_block_editor_assets', 'wp_enqueue_editor_block_directory_assets' );