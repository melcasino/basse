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
 *    - Name:               Required. The Pattern Name. Should be unique.
 *    - Block Name:         Required. The block name. Must contain namespace and block slug (e.g. namespace/block-slug).
 *    - Class Name:         Required. The CSS Class Name used in the pattern. Should be unique.
 *    - Dependencies:       Optional. A comma separated registered script handles this script depends on.
 *    - Strategy:           Optional. If provided, may be either 'defer' or 'async'.
 *    - In Footer:          Optional. Whether to print the script in the footer. Default 'true'.
 *    - Fetch Priority:     Optional. The fetch priority for the script. Accepts 'high' or 'low'. Default 'auto'.
 *    - Load In:            Optional. Where the asset will be loaded. Accepts 'frontend' or 'editor'.
 *    - Loading Method:     Optional. The preferred loading Method. Accepts 'inline' or 'external'. Default 'external'.   
 * 
 * @since 0.1.0
 * 
 * @see get_file_data()
 * @see basse\dynamically_enqueue_custom_block_script()
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
            'dependencies'      =>  'Dependencies',
            'strategy'          =>  'Strategy',
            'in_footer'         =>  'In Footer',
            'fetchpriority'     =>  'Fetch Priority',
            'load_in'           =>  'Load In',
            'loading_method'    =>  'Loading Method',
        );

        // Get the file headers of the current file being loop through
        $js_file_headers = get_file_data( $file_path, $default_file_headers );

        // Get the JS file metadata of the current file being loop through.
        $js_file_metadata = isset( $patterns_js_file_metadata[$i] ) ? include  $patterns_js_file_metadata[$i] : null;

        // Create asset handle
        $handle = THEME_NS . '-pattern---' . strtolower( str_replace( ' ', '-', $js_file_headers['name'] ) );
        if ( strtolower( $js_file_headers['load_in'] ) === 'frontend' ) {
            $handle .= '---frontend';
        } elseif( strtolower( $js_file_headers['load_in'] ) === 'editor' ) {
            $handle .= '---editor';
        }

        // Create the file source using the file path
        $src = str_replace( THEME_DIR, THEME_URI, $file_path );

        // If it is set, get the array of dependency handles of the current file  
        // being loop through from the JS file metadata and/or file header. 
        $dependencies = $js_file_metadata['dependencies'] ?? null;

        if ( ! empty( $js_file_headers['dependencies'] ) ) {
            if ( ! is_null( $dependencies) ) {
                $dependencies = array_merge( $dependencies, explode( ',', $js_file_headers['dependencies'] ) );
            } else {
                $dependencies = explode( ',', $js_file_headers['dependencies'] );
            }
        }

        // Create the $args array that will be passed as an argment to the enqueue function
        $args = array(
            'handle'    =>  $handle,
            'src'       =>  $src,
            'path'      =>  $file_path,
        );

        $args = isset( $dependencies ) ? array_merge( $args, array( 'deps' => $dependencies ) ) : $args;
        $args = isset( $js_file_metadata['version'] ) ? array_merge( $args, array( 'version' => $js_file_metadata['version'] ) ) : $args;
        $args = ! empty( $js_file_headers['strategy'] ) ? array_merge( $args, array( 'strategy' => $js_file_headers['strategy'] ) ) : $args;
        $args = ! empty( $js_file_headers['in_footer'] ) ? array_merge( $args, array( 'in_footer' => $js_file_headers['in_footer'] ) ) : $args;
        $args = ! empty( $js_file_headers['fetchpriority'] ) ? array_merge( $args, array( 'fetchpriority' => $js_file_headers['fetchpriority'] ) ) : $args;
        $args = ! empty( $js_file_headers['load_in'] ) ? array_merge( $args, array( 'load_in' => $js_file_headers['load_in'] ) ) : $args;
        $args = ! empty( $js_file_headers['loading_method'] ) ? array_merge( $args, array( 'loading_method' => $js_file_headers['loading_method'] ) ) : $args;

        // Enqueue the JS asset using a custom function if all required file headers are set.
        if ( ! empty( $js_file_headers['name'] ) && ! empty( $js_file_headers['block_name'] ) && ! empty( $js_file_headers['class_name'] ) ) {
            dynamically_enqueue_custom_block_script(
                $js_file_headers['block_name'],
                $js_file_headers['class_name'],
                $args
            );
        }
    }
}
add_action( 'init', THEME_NS . '\enqueue_block_patterns_custom_scripts' );