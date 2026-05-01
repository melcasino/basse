<?php
/**
 * Block patterns custom CSS enqueueing function and hook
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
 * Enqueue block patterns custom styles
 * 
 * This function will process all custom block patterns styles for enqueueing.
 * The following are required for this function to work:
 * 
 *    1. All block patterns CSS files must be stored in "/assets/css/block/block-patterns" directory.
 *    2. All block patterns CSS files must have the required file headers:
 *           
 *       - Name:               Required. The Pattern Name.
 *       - Block Name:         Required. The block name. Must contain namespace and block slug (e.g. core/group).
 *       - Class Name:         Required. The CSS Class Name used in the pattern. Must be unique.
 *       - Dependencies:       Optional. A comma separted registered stylesheet handles the stylesheet depends on.
 *       - Media:              Optional. The media for which this stylesheet has been defined. Accepts media types like 'all', 'print' and 'screen', or media queries like '(orientation: portrait)' and '(max-width: 640px)'.
 *       - Load In:            Optional. Where the asset will be loaded. Optional. Default 'null'. Accepts 'frontend' or 'editor'.
 *       - Loading Method:     Optional. The preferred loading Method. Optional. Default 'inline'. Accepts 'inline' or 'external'. 
 *       - Critical:           Optional. Whether the CSS asset is a critial CSS or not. Only relevant when 'Loading Method' is 'external'. 
 *                             Default 'false'. Accepts 'true' or 'false'.  
 * 
 * @since 0.1.0
 * 
 * @see get_file_data()
 * @see basse\dynamically_enqueue_custom_block_style()
 */
function enqueue_block_patterns_custom_styles() {

    // Scan the folder where the custom block patterns styles are located.
    $patterns_css_file_paths = glob( THEME_DIR . '/assets/css/block/block-patterns/*.css' );
    $patterns_css_file_metadata = glob( THEME_DIR . '/assets/css/block/block-patterns/*.php' );

    // Filter the array of all patterns CSS file paths to get only the default CSS file paths. 
    $patterns_default_css_file_paths = array_values( array_filter( $patterns_css_file_paths, function( $file_path ) {  return ! str_contains( basename( $file_path ), '-rtl.css'); } ) );

    // Loop through all the default CSS file paths
    foreach( $patterns_default_css_file_paths as $i => $file_path ) {

        // Default file headers
        $default_file_headers = array(
            'name'              =>  'Name',
            'block_name'        =>  'Block Name',
            'class_name'        =>  'Class Name',
            'dependencies'      =>  'Dependencies',
            'media'             =>  'Media',
            'load_in'           =>  'Load In',
            'loading_method'    =>  'Loading Method',
            'critical'          =>  'Critical'
        );

        // Get the file headers of the current file being loop through
        $css_file_headers = get_file_data( $file_path, $default_file_headers );

        // Get the CSS file metadata of the current file being loop through.
        $css_file_metadata = isset( $patterns_css_file_metadata[$i] ) ? include  $patterns_css_file_metadata[$i] : null;

        // If it is set, get the version number of the current file being 
        // loop through from the CSS file metadata.
        $version = $css_file_metadata['version'] ?? null;

        // Create asset handle
        $handle = THEME_NS . '-pattern---' . strtolower( str_replace( ' ', '-', $css_file_headers['name'] ) );
        if ( strtolower( $css_file_headers['load_in'] ) === 'frontend' ) {
            $handle = $handle . '---frontend';
        } elseif( strtolower( $css_file_headers['load_in'] ) === 'editor' ) {
            $handle = $handle . '---editor';
        }

        // Create asset source from $file_path
        $src = str_replace( THEME_DIR, THEME_URI, $file_path );

        // Create array of dependencies from $css_file_headers['dependencies']
        $deps = ! empty( $css_file_headers['dependencies'] ) ? explode( ',', $css_file_headers['dependencies'] ) : null;

        // Create the $args array that will be passed as an argument to the custom enqueue function
        $args = array();
        $args = array_merge( $args, array( 'handle' => $handle ) );
        $args = array_merge( $args, array( 'path' => $file_path ) );
        $args = array_merge( $args, array( 'src' => $src ) );
        $args = ! is_null( $deps ) ? array_merge( $args, array( 'deps' => $deps ) ) : $args;
        $args = ! is_null( $version ) ? array_merge( $args, array( 'ver' => $version ) ) : $args;
        $args = ! empty( $css_file_headers['media'] ) ? array_merge( $args, array( 'media' => $css_file_headers['media'] ) ) : $args;
        $args = ! empty( $css_file_headers['load_in'] ) ? array_merge( $args, array( 'load_in' => $css_file_headers['load_in'] ) ) : $args;
        $args = ! empty( $css_file_headers['loading_method'] ) ? array_merge( $args, array( 'loading_method' => $css_file_headers['loading_method'] ) ) : $args;
        $args = ! empty( $css_file_headers['critical'] ) ? array_merge( $args, array( 'critical' => filter_var( $css_file_headers['critical'], FILTER_VALIDATE_BOOLEAN ) ) ) : $args;

        // Enqueue the CSS asset using a custom function
        dynamically_enqueue_custom_block_style( 
            $css_file_headers['block_name'],
            $css_file_headers['class_name'], 
            $args
        );
    }
}
add_action( 'init', THEME_NS . '\enqueue_block_patterns_custom_styles' );