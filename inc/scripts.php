<?php
/**
 * Styles and Scripts functions.
 * 
 * @package	  basse
 * @author    Mel Casiño
 * @copyright Copyright (c) 2025, Mel Casiño
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-late
 * @since     0.1.0
 */



namespace basse;



/**
 * Exit if accessed directly
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}



/**
 * Enqueue frontend CSS and JS
 * 
 */
function enqueue_frontend_assets() {
    // Frontend CSS metadata
    $frontend_css_metadata = include THEME_DIR . '/assets/css/frontend.asset.php';

    // Check if frontend.css file has content
    if ( filesize( THEME_DIR . '/assets/css/frontend.css' ) > 0 ) {

        // Enqueue frontend CSS
        wp_enqueue_style( 
            sanitize_title( THEME_NS ) . '-frontend', 
            THEME_URI . '/assets/css/frontend.css', 
            $frontend_css_metadata['dependencies'], 
            $frontend_css_metadata['version'] 
        );
    }
}
add_action( 'wp_enqueue_scripts', THEME_NS . '\enqueue_frontend_assets' );



/**
 * Load editor CSS
 * 
 */
function load_editor_css() {
    add_editor_style(
        array(
            './assets/css/editor.css',
        )
    );
}
add_action( 'after_theme_setup', THEME_NS . '\load_editor_CSS' );



/**
 * Enqueue editor CSS and JS
 * These assets are for the Editor itself and not 
 * for the user-generated content (i.e. "blocks", "patterns", etc. ).
 * 
 */
function enqueue_editor_assets() {
    // Editor JS metadata
    $editor_js_metadata = include THEME_DIR . '/assets/js/editor.asset.php';

    // Enqueue editor JS
    wp_enqueue_script( 
        sanitize_title( THEME_NS) . '-editor', 
        THEME_URI . '/assets/js/editor.js', 
        $editor_js_metadata['dependencies'], 
        $editor_js_metadata['version'], 
        true 
    );
}
add_action( 'enqueue_block_editor_assets', THEME_NS . '\enqueue_editor_assets' );



/**
 * Enqueue block styles in the current page only when the block is being used.
 * This will enqueue default custom CSS that is too long or complex to add in theme.json.
 * 
 * The following are required for this function to work:
 * 1. CSS files must be stored in the "/assets/css/blocks/block-custom-css" directory.
 * 2. CSS file must follow the following naming convention:
 *    If block name is "namespace/block-slug", the CSS filename for that block will be "namespace---block-slug.css"
 *    e.g. core/buttons --> core---buttons.css
 * 
 */
function enqueue_custom_block_styles() {

    // Scan the folder where the custom block styles are located.
    $css_file_paths = glob( THEME_DIR . '/assets/css/blocks/block-custom-css/*.css' );
    $css_file_metadata_paths = glob( THEME_DIR . '/assets/css/blocks/block-custom-css/*.php' );

    // Filter the array of all custom block styles file paths to get only the default CSS file paths and re-index the output array.
    $default_css_file_paths = array_values( array_filter( $css_file_paths, function( $file_path ) {  return !str_contains( basename( $file_path ), '-rtl.css'); } ) );

    // Filter the array of all custom block styles file paths to get only the RTL CSS file paths and re-index the output array.
    $rtl_css_file_paths = array_values( array_filter( $css_file_paths, function( $file_path ) {  return str_contains( basename( $file_path ), '-rtl.css'); } ) );

    foreach ( $default_css_file_paths as $i => $file_path ) {
        // Get the filename, basename (filename with no extension), namespace, block slug and block name.
        $filename   = basename( $file_path );
        $basename   = basename( $file_path, '.css' );
        $namespace  = explode( '---', $basename )[0];
        $block_slug = explode( '---', $basename )[1];
        $block_name = str_replace( '---', '/', $basename );

        // Get the metadata of the current CSS file
        $css_file_metadata = isset( $css_file_metadata_paths[$i] ) ? include $css_file_metadata_paths[$i] : null;
        
        // Enqueue block CSS
        wp_enqueue_block_style(
            $block_name,
            array(
                'handle' => sanitize_title( THEME_NS ) . '-' . $namespace . '-' . $block_slug,
                'src'    => THEME_URI . '/assets/css/blocks/block-custom-css/' . $filename,
                'path'   => $file_path,
                'ver'    => $css_file_metadata ? $css_file_metadata['version'] : THEME_VER
            )
        );
    }
}
add_action( 'init', THEME_NS . '\enqueue_custom_block_styles' );



/**
 * Enqueue custom block patterns styles only when patterns are being used in the page.
 * 
 * The following are required for this function to work:
 * 1. All block patterns CSS files must be stored in "/assets/css/blocks/patterns" directory.
 * 2. All block patterns CSS files must have the required file headers:
 *           
 *      Name:               The Pattern Name. Required.
 *      Block Name:         The block name. Must contain namespace and block slug (e.g. namespace/block-slug). Required
 *      Class Name:         The CSS Class Name used in the pattern. Must be unique. Required
 *      Load In:            Where the asset will be loaded. Optional. When provided, may be either 'frontend' or 'editor'. Default: null.
 *      Loading Method:     The preferred loading Method. Optional. When provided, may be either 'inline' or 'external'. Default: 'inline'.
 *      Critical:           Whether the CSS asset is a critial CSS or not. Only relevant when 'Loading Method' is 'external'. 
 *                          Optional. When provided, may be either 'true' or 'false'. Default: false.     
 * 
 * Uses the following Utility function:
 * dynamically_enqueue_custom_block_style()
 * 
 */
function enqueue_custom_block_patterns_styles() {

    // Scan the folder where the custom block patterns styles are located.
    $patterns_css_file_paths = glob( THEME_DIR . '/assets/css/blocks/patterns/*.css' );
    $patterns_css_file_metadata = glob( THEME_DIR . '/assets/css/blocks/patterns/*.php' );

    // Filter the array of all patterns CSS file paths to get only the default CSS file paths. 
    $patterns_default_css_file_paths = array_values( array_filter( $patterns_css_file_paths, function( $file_path ) {  return !str_contains( basename( $file_path ), '-rtl.css'); } ) );

    // Filter the array of all patterns CSS file paths to get only the RTL CSS file paths.
    $patterns_rtl_css_file_paths = array_values( array_filter( $patterns_css_file_paths, function( $file_path ) {  return str_contains( basename( $file_path ), '-rtl.css'); } ) );

    // Loop through all the default CSS file paths
    foreach( $patterns_default_css_file_paths as $i => $file_path ) {

        // Default file headers
        $default_file_headers = array(
            'name'              =>  'Name',
            'block_name'        =>  'Block Name',
            'class_name'        =>  'Class Name',
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

        // Create the $args array that will be passed as an argment to the enqueue function
        $args = array();
        $args = !empty( $css_file_headers['load_in'] ) ? array_merge( $args, array( 'load_in' => $css_file_headers['load_in'] ) ) : $args;
        $args = !empty( $css_file_headers['loading_method'] ) ? array_merge( $args, array( 'loading_method' => $css_file_headers['loading_method'] ) ) : $args;
        $args = !empty( $css_file_headers['critical'] ) ? array_merge( $args, array( 'critical' => filter_var( $css_file_headers['critical'], FILTER_VALIDATE_BOOLEAN ) ) ) : $args;

        // Enqueue the CSS asset using a custom function
        dynamically_enqueue_custom_block_style( 
            $css_file_headers['block_name'],
            $css_file_headers['class_name'], 
            $file_path, 
            $version,
            $args
        );
    }
}
add_action( 'init', THEME_NS . '\enqueue_custom_block_patterns_styles' );



/**
 * Enqueue custom block patterns JS only when patterns are being used in the page.
 * 
 * * The following are required for this function to work:
 * 1. All block patterns CSS files must be stored in "/assets/css/blocks/patterns" directory.
 * 2. All block patterns CSS files must have the required file headers:
 *           
 *      Name:               The Pattern Name. Required.
 *      Block Name:         The block name. Must contain namespace and block slug (e.g. namespace/block-slug). Required
 *      Class Name:         The CSS Class Name used in the pattern. Must be unique. Required
 *      Load In:            Where the asset will be loaded. Optional. When provided, may be either 'frontend' or 'editor'. Default: null.
 *      Loading Method:     The preferred loading Method. Optional. When provided, may be either 'inline' or 'external'. Default: 'inline'.     
 * 
 * Uses the following Utility function:
 * dynamically_enqueue_custom_block_script()
 * 
 */
function enqueue_custom_block_patterns_scripts() {

    // Scan the folder where the custom block patterns styles are located.
    $patterns_js_file_paths = glob( THEME_DIR . '/assets/js/blocks/patterns/*.js' );
    $patterns_js_file_metadata = glob( THEME_DIR . '/assets/js/blocks/patterns/*.php' );
    
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
add_action( 'init', THEME_NS . '\enqueue_custom_block_patterns_scripts' );