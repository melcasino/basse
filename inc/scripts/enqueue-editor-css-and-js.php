<?php
/**
 * Editor CSS and JS enqueueing function and hook
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
 * Enqueue editor CSS and JS
 * 
 * These assets are for the Editor itself and not 
 * for the user-generated content (i.e. "blocks", "patterns", etc. ).
 * 
 * @since 0.1.0
 */
function enqueue_editor_assets() {
    // Editor JS metadata
    $editor_js_metadata = include THEME_DIR . '/assets/js/editor.asset.php';

    // Enqueue editor JS
    wp_enqueue_script( 
        sanitize_title( THEME_NS) . '-editor', 
        THEME_URI . '/assets/js/editor.js', 
        $editor_js_metadata['dependencies'], 
        $editor_js_metadata['version'], 
        true 
    );
}
add_action( 'enqueue_block_editor_assets', THEME_NS . '\enqueue_editor_assets' );