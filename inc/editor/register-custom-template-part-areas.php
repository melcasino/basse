<?php
/**
 * Custom template part areas register function
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
 * Register custom template part areas
 * 
 * @since 0.1.0
 * 
 * @see 'default_wp_template_part_areas'
 * 
 * @param array $areas - An array of area definitions.
 */
function register_custom_template_part_areas( array $areas ) {

    // Array of custom template part areas
    $new_areas = array(
        array(
            'area'          =>  'sidebar',
            'area_tag'      =>  'section',
            'label'         =>  __( 'Sidebar', 'basse' ),
            'description'   =>  __( 'The Sidebar template defines a page area that can be found on the Page (With Sidebar) template.', 'basse' ),
            'icon'          =>  'sidebar',
        ),
    );

    // Loop through the array of template part areas and register each of it.
    foreach ( $new_areas as $new_area ) {
        $areas[] = $new_area;
    }

    return $areas;
}
add_filter( 'default_wp_template_part_areas', THEME_NS . '\register_custom_template_part_areas' );