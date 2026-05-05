<?php
/**
 * Editor related functions
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
require_once __DIR__ . '/register-custom-template-part-areas.php';
require_once __DIR__ . '/disable-openverse.php';
require_once __DIR__ . '/remove-third-party-block-plugins.php';