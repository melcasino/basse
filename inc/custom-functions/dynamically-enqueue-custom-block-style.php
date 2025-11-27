<?php
/**
 * This function dynamically enqueue a custom block CSS only if the specified block 
 * contains a specified CSS class name that is associated to the CSS file.
 * 
 * @param string $block_name (required) 
 * The name of the block where the CSS asset will be used. It must have the block namespace and the block slug. (e.g. core/button)
 * 
 * @param string $class_name (required) 
 * The CSS class name associated to the CSS asset. It must be unique.
 * 
 * @param string $path (required) 
 * The full path of the CSS file.
 * 
 * @param string|bool|null $version (optional)
 * The version of the CSS file.
 * 
 * @param array $args (optional)
 * An array of additional style loading strategies.
 * |
 * |    $args['loading_method'] string
 * |    Optional. If provided, may be either 'inline' or 'external'.
 * |    Default: 'inline'
 * |
 * |    $args['load_in'] string 
 * |    Optional. If provided, may be either 'frontend' or 'editor'. If not defined, asset will be loaded in both frontend and editor.
 * |
 * |    $args['critical'] boolean
 * |    Optional. Whether the asset being enqueued is a critical CSS or not. This is only relevant if $args['loading_method] is set to 'external'.
 * |    When left to default, CSS being enqueued will not be render-blocking. If set to 'true' CSS being enqueued must be set as render-blocking to avoid FOUC.
 * |    If style is critical and just small, consider inlining the style by setting $args['loading_method'] to 'external'. 
 * |    Default: 'false'
 * |
 * Default: array()
 * 
 * @return void
 * 
 * 
 * Uses the following Utility function:
 * block_has_class()
 * 
 * Uses the following WordPress filter hook:
 * render_block_{$this->name}
 * 
 * 
 * @package	  basse
 * @author    Mel Casiño
 * @copyright Copyright (c) 2025, Mel Casiño
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-late
 * @since     0.1.0
 * 
 */



namespace basse;



/**
 * Exit if accessed directly
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {

	exit;

}



function dynamically_enqueue_custom_block_style( string $block_name, string $class_name, string $path, string|bool|null $version = false, array $args = array() ) {
    
    // Bail early if required functions does not exist.
    if ( !function_exists( 'basse\block_has_class' ) ) return;

    // Bail early if $block_name or $class_name is not set
    if ( !isset( $block_name ) || !isset( $class_name ) ) return;

    // Validate passed arguments
    if ( !str_contains( $block_name, '/' ) || str_contains( $block_name, ' ' ) ) return;
    if ( str_contains( $class_name, ' ' )  || str_starts_with( $class_name, '.') ) return;
    if ( !file_exists( $path) ) return;
    if ( !empty( $args ) ) {
        if ( array_key_exists( 'loading_method', $args )  ) {
            if ( strtolower( $args['loading_method'] ) !== 'inline' ) {
                if ( strtolower( $args['loading_method'] ) !== 'external' ) return;
            }
        }

        if( array_key_exists( 'load_in', $args ) ) {
            if ( strtolower( $args['load_in'] ) !== 'frontend' ) {
                if ( strtolower( $args['load_in'] ) !== 'editor' ) {
                    if ( !is_null( $args['load_in'] ) ) {
                        return;
                    }
                }
            }
        }

        if( array_key_exists( 'critical', $args ) ) {
            if( !is_bool( $args['critical'] ) ) return;
        }
    }

    // Set variables that will be used in enqueueing the asset.
    $handle = THEME_NS . '-' . strtolower( str_replace( '/', '-', $block_name ) ) . '-' . $class_name;
    $asset_source = str_replace( THEME_DIR, THEME_URI, $path );
    $version = $version ? $version : THEME_VER;
    $loading_method =  $args['loading_method'] ?? 'inline';
    $load_in = $args['load_in'] ?? null;
    $critical = $args['critical'] ?? false;

    // Add additional string to the $handle variable based on the value of the $load_in variable.
    if ( isset( $load_in ) && strtolower( $load_in ) === 'frontend' ) {
        $handle = $handle . '-frontend';
    } else if ( isset( $load_in ) && strtolower( $load_in ) === 'editor' ) {
        $handle = $handle . '-editor';
    }

    // Check if the current page being rendered is an admin area or not.
    if ( is_admin() ) {

        // Check if the asset being enqueued is for editor or both by checking the 
        // argument that is being passed to the $load_in parameter.
        if ( !isset( $load_in ) || strtolower( $load_in ) === 'editor' ) {

            // Enqueue asset in the editor
            wp_enqueue_block_style(
                $block_name,
                array(
                    'handle' => $handle,
                    'src'    => $asset_source,
                    'path'   => $path,
                    'ver'    => $version
                )
            );
        }

    } else {

        // Check if the asset being enqueued is for frontend or both by checking the 
        // argument that is being passed to the $load_in parameter.
        if ( !isset( $load_in ) || strtolower( $load_in ) === 'frontend' ) {
    
            // Create a function for filtering the blocks in the current page and assign it to a variable.
            $filter_callback_function = function( string $content, array $block ) 
            use ( &$filter_callback_function, $block_name, $class_name, $handle, $path, $asset_source, $version, $loading_method, $critical ): string {
    
                // Check if the current block being filtered contains a CSS class specified in the $class_name being passed.
                if ( block_has_class( $block, $class_name ) ) {
    
                    // Check the loading method specified for the CSS asset. (i.e. "inline" or "extrnal")
                    if ( strtolower( $loading_method ) === 'inline' ) {

                        // Temporary fix for a "core/query" block issue.
                        // "core/query" CSS generated from theme.json not rendered when "enhancedPagination" attribute is false. 
                        // @refer https://github.com/WordPress/gutenberg/issues/68580
                        //
                        // Because of the issue mentioned above, any custom styles for "core/query" block that is set 
                        // to be enqueued in an inline manner will fail to load.
                        // Check on the issue in the future and remove this solution when it is already fixed.
                        // 
                        if ( $block_name === 'core/query' && ( !isset( $block['attrs']['enhancedPagination'] ) || isset( $block['attrs']['enhancedPagination'] ) === false ) ) {
                            wp_enqueue_style( 'wp-block-query' );
                        }
                        // END of fix
    
                        // Get the content of the CSS file and assign it to a variable.
                        $css_file_content = file_get_contents( $path );
                        
                        // Register a block style for the block instance that has the CSS class name that is associated 
                        // to the CSS file being processed and use its content as an inline style for the block.
                        register_block_style(
                            $block_name,
                            array(
                                'name'         => $class_name,
                                'label'        => __( '.' . $class_name, THEME_NS ),
                                'is_default'   => true,
                                'inline_style' => preg_replace('#/\*!.*?\*/#s', '', $css_file_content), // Uses regex to remove file headers from CSS file content
                            )
                        );
    
                    } else if ( strtolower( $loading_method ) === 'external' ) {
                        wp_enqueue_style( $handle, $asset_source, array(), $version );
    
                        // Check if the CSS asset being enqueued is a critical CSS.
                        if ( !$critical ) {

                            // Create style loader tag filter callback function and assign to a variable.
                            $style_loader_tag_filter_callback_function = function( $tag, $style_handle, $href ) use ( $handle ) {
                                if ( $handle === $style_handle ) {
                                    $tag = '<link id="' . $handle . '-css" rel="stylesheet" href="' . $href . '" media="print" onload="this.media=\'all\'" >' 
                                        . '<noscript>' . $tag . '</noscript>';           
                                }

                                return $tag;
                            };
    
                            // Filter the style link tag for the enqueued asset and make it non-render blocking.
                            add_filter( 'style_loader_tag', $style_loader_tag_filter_callback_function, 10, 4 );
                        }
                    }

                    // Remove the block filter after enqueing the CSS asset.
                    remove_filter( "render_block_{$block_name}", $filter_callback_function, 10, 2 );
                }
    
                // Return the block content
                return $content;
            };
    
            // Filter all blocks with a name attribute that matches to the $block_name being passed 
            // and use the $filter_callback_function variable as the filter's callback fucntion.
            add_filter( "render_block_{$block_name}", $filter_callback_function, 10, 2 );
        }
    }
}