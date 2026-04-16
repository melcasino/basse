<?php
/**
 * WordPress default theme.json data filter function
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
 * Modify WordPress default theme.json data
 * 
 * @since 0.1.0
 * 
 * @see 'wp_theme_json_data_default'
 * @see 'after_setup_theme'
 */
function modify_wp_default_theme_json_data( $theme_json ) {
	
    $data = $theme_json->get_data();

	if ( isset( $data['settings']['color'] ) ) { 
		unset( $data['settings']['color']['palette']['default'] );
		unset( $data['settings']['color']['gradients']['default'] );
		unset( $data['settings']['color']['duotone']['default'] );
	}

	if ( isset( $data['settings']['spacing'] ) ) {
		$data['settings']['spacing']['spacingScale']['steps'] = 0;
		unset( $data['settings']['spacing']['spacingScale']['default'] );
		unset( $data['settings']['spacing']['spacingSizes']['default'] );
	}

	$theme_json->update_with( $data );

    return $theme_json;
}
add_filter( 'wp_theme_json_data_default', THEME_NS . '\modify_wp_default_theme_json_data' );