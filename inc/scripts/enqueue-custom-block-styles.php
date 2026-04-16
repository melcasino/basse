<?php
/**
 * Custom default block styles enqueueing function and hook
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
 * Enqueue block styles
 * 
 * Enqueue block styles in the current page only when the block is being used.
 * This will enqueue default custom CSS that is too long or complex to add in theme.json.
 * The following are required for this function to work:
 * 
 * 1. CSS files must be stored in the "/assets/css/block/block-custom-css" directory.
 * 2. CSS file must follow the following naming convention:
 *    If block name is "namespace/block-slug", the CSS filename for that block will be "namespace---block-slug.css"
 *    e.g. core/buttons --> core---buttons.css
 * 
 * @since 0.1.0
 */
function enqueue_custom_block_styles() {

    // Scan the folder where the custom block styles are located.
    $css_file_paths = glob( THEME_DIR . '/assets/css/block/block-custom-css/*.css' );
    $css_file_metadata_paths = glob( THEME_DIR . '/assets/css/block/block-custom-css/*.php' );

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
                'src'    => THEME_URI . '/assets/css/block/block-custom-css/' . $filename,
                'path'   => $file_path,
                'ver'    => $css_file_metadata ? $css_file_metadata['version'] : THEME_VER
            )
        );
    }
}
add_action( 'init', THEME_NS . '\enqueue_custom_block_styles' );