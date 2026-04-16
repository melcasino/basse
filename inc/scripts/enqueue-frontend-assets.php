<?php
/**
 * Frontend assets enqueueing function and hook
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
 * Enqueue frontend CSS and JS
 * 
 * @since 0.1.0
 */
function enqueue_frontend_assets() {
    // Frontend CSS metadata
    $frontend_css_metadata = include THEME_DIR . '/assets/css/frontend.asset.php';

    // Check if frontend.css file has content
    if ( filesize( THEME_DIR . '/assets/css/frontend.css' ) > 0 ) {

        // Enqueue frontend CSS
        wp_enqueue_style( 
            sanitize_title( THEME_NS ) . '-frontend', 
            THEME_URI . '/assets/css/frontend.css', 
            $frontend_css_metadata['dependencies'], 
            $frontend_css_metadata['version'] 
        );
    }
}
add_action( 'wp_enqueue_scripts', THEME_NS . '\enqueue_frontend_assets' );