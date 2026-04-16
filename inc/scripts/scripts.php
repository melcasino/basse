<?php
/**
 * Styles and scripts related functions
 * 
 * @package	  basse
 * @since     0.1.0
 */



namespace basse;



// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



// Load required files
require_once __DIR__ . '/enqueue-frontend-assets.php';
require_once __DIR__ . '/load-editor-css.php';
require_once __DIR__ . '/enqueue-editor-css-and-js.php';
require_once __DIR__ . '/enqueue-custom-block-styles.php';
require_once __DIR__ . '/enqueue-block-style-variations-css.php';
require_once __DIR__ . '/enqueue-block-patterns-custom-styles.php';
require_once __DIR__ . '/enqueue-block-patterns-custom-scripts.php';