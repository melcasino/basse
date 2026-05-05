<?php
/**
 * Custom functions
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
require_once __DIR__ . '/enqueue-block-style-if-block-has-class.php';
require_once __DIR__ . '/dynamically-enqueue-custom-block-script.php';