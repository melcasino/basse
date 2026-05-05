<?php
/**
 * Function to remove openverse in the editor
 * 
 * @package basse
 * @since   0.1.0
 */



namespace basse;



// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * Disable Openverse in the editor
 * 
 * @since 0.1.0
 * 
 * @param array $editor_settings Default editor settings.
 * 
 * @return array Filtered editor settings.
 */
function disable_openverse( array $editor_settings ) {
	$editor_settings['enableOpenverseMediaCategory'] = false;

	return $editor_settings;
}
add_filter( 'block_editor_settings_all', THEME_NS . '\disable_openverse' );