<?php
/**
 * Theme setup functions
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
require_once __DIR__ . '/modify-wp-default-theme-json-data.php';
require_once __DIR__ . '/set-theme-defaults.php';