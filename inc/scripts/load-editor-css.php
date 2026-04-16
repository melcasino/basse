<?php
/**
 * Editor CSS loading function and hook
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
 * Load editor CSS
 * 
 * @since 0.1.0
 */
function load_editor_css() {
    add_editor_style(
        array(
            './assets/css/editor.css',
        )
    );
}
add_action( 'after_setup_theme', THEME_NS . '\load_editor_css' );