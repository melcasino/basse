<?php
/**
 * Block related functions
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
require_once __DIR__ . '/register-block-style-variations.php';
require_once __DIR__ . '/register-block-pattern-categories.php';
require_once __DIR__ . '/modify-block-supports.php';