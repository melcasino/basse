<?php
/**
 * Block patterns custom JS enqueueing function and hook
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
 * Enqueue block patterns custom scripts
 * 
 * This function will enqueue custom JS associated to any pattern only when the patterns are being used in the page.
 * The following are required for this function to work:
 * 
 * 1. All block patterns JS files must be stored in "/assets/js/block/block-patterns" directory.
 * 2. All block patterns JS files must have the required file headers:
 *           
 *    - Name:               Required. The Pattern Name.
 *    - Block Name:         Required. The block name. Must contain namespace and block slug (e.g. namespace/block-slug).
 *    - Class Name:         Required. The CSS Class Name used in the pattern. Must be unique.
 *    - Load In:            Optional. Where the asset will be loaded. Optional. Default 'null'. Accepts 'frontend' or 'editor'.
 *    - Loading Method:     Optional. The preferred loading Method. Optional. Default 'inline'. Accepts 'inline' or 'external'.    
 * 
 * @since 0.1.0
 * 
 * @see 'get_file_data()'
 * @see 'basse\dynamically_enqueue_custom_block_script()'
 */
function enqueue_block_patterns_custom_scripts() {

    // Scan the folder where the custom block patterns styles are located.
    $patterns_js_file_paths = glob( THEME_DIR . '/assets/js/block/block-patterns/*.js' );
    $patterns_js_file_metadata = glob( THEME_DIR . '/assets/js/block/block-patterns/*.php' );
    
    foreach( $patterns_js_file_paths as $i => $file_path ) {

        // Default file headers
        $default_file_headers = array(
            'name'              =>  'Name',
            'block_name'        =>  'Block Name',
            'class_name'        =>  'Class Name',
            'load_in'           =>  'Load In',
            'loading_method'    =>  'Loading Method',
        );

        // Get the file headers of the current file being loop through
        $js_file_headers = get_file_data( $file_path, $default_file_headers );

        // Get the JS file metadata of the current file being loop through.
        $js_file_metadata = isset( $patterns_js_file_metadata[$i] ) ? include  $patterns_js_file_metadata[$i] : null;

        // If it is set, get the version number of the current file being 
        // loop through from the JS file metadata.
        $version = $js_file_metadata['version'] ?? null;

        // If it is set, get the array of dependency handles of the current file being 
        // loop through from the JS file metadata. 
        $dependencies = $js_file_metadata['dependencies'] ?? array();

        // Create the file source using the file path
        $src = str_replace( THEME_DIR, THEME_URI, $file_path );

        // Create the $args array that will be passed as an argment to the enqueue function
        $args = array(
            'strategy'  =>  'defer',
        );
        $args = !empty( $js_file_headers['load_in'] ) ? array_merge( $args, array( 'load_in' => $js_file_headers['load_in'] ) ) : $args;
        $args = !empty( $js_file_headers['loading_method'] ) ? array_merge( $args, array( 'loading_method' => $js_file_headers['loading_method'] ) ) : $args;

        // Enqueue the JS asset using a custom function
        dynamically_enqueue_custom_block_script(
            $js_file_headers['block_name'],
            $js_file_headers['class_name'],
            $file_path,
            $src,
            $dependencies,
            $version,
            $args
        );
    }
}
add_action( 'init', THEME_NS . '\enqueue_block_patterns_custom_scripts' );