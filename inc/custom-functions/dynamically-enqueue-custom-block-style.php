<?php
/**
 * Block CSS dynamic enqueueing function
 * 
 * @package basse
 * @since 0.1.0
 */



namespace basse;



// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * Dynamically enqueue custom block style
 * 
 * This function dynamically enqueue a custom block CSS only if the specified block 
 * contains the custom CSS class name that is associated to the style.
 * 
 * @since 0.1.0
 * 
 * @see render_block_{$this->name}
 * @see basse\block_has_class()
 * 
 * @param string $block_name The name of the block where the CSS asset will be used. 
 *                           It must have the block namespace and the block slug. (e.g. core/button)
 * @param string $class_name The CSS class name associated to the CSS asset. It must be unique.
 * @param array  $args {
 *     An array of arguments for the stylesheet.
 * 
 *     @type string           $handle         The handle for the stylesheet.
 *     @type string|false     $src            The source URL of the stylesheet.
 *     @type string|null      $path           Optional. Absolute path to the stylesheet, so that it can potentially be inlined.
 *     @type string|bool|null $ver            The stylesheet version number. If undefined or set to 'false', the curent theme version will be used. 
 *                                            If set to 'NULL', no version will be added. 
 *                                            Default 'false'.
 *     @type string[]         $deps           Optional. Array of registered stylesheet handles this stylesheet depends on. Default 'array()'.
 *     @type string           $media          Optional. The media for which this stylesheet has been defined.
 *                                            Accepts media types like 'all', 'print' and 'screen', or media queries like '(orientation: portrait)' and '(max-width: 640px)'.
 *                                            Default 'all'.
 *     @type string           $loading_method Optional. Whether the CSS will be loaded inline or externally. 
 *                                            If set to 'inline', $args['path'] must be defined, otherwise asset will be loaded externally. 
 *                                            Default 'inline'. Accepts 'inline' or 'external'.
 *     @type string           $load_in        Optional. Whether the CSS will be loaded in frontend or editor. 
 *                                            If undefined, asset will be loaded in both frontend and editor.
 *                                            Accepts 'frontend' or 'editor'.
 *     @type bool             $critical       Optional. Whether the CSS being enqueued is a critical CSS or not. 
 *                                            This is only relevant if $args['loading_method] is set to 'external'.
 *                                            If undefined or set to 'false', CSS being enqueued will not be render-blocking. 
 *                                            If set to 'true' CSS being enqueued will be set as render-blocking to avoid FOUC.
 *                                            If style is critical and just small, consider inlining the style by setting $args['loading_method'] to 'inline'.
 *                                            Default 'false'.     
 * }
 */
function dynamically_enqueue_custom_block_style( string $block_name, string $class_name, array $args ) {

    // Bail early if required functions does not exist.
    if ( ! function_exists( 'basse\block_has_class' ) ) return;

    // Bail early if $block_name or $class_name is not set
    if ( ! isset( $block_name ) || ! isset( $class_name ) ) return;

    // Set defaults for $args.
    $args = wp_parse_args( 
                $args, 
                array(
                    'handle'            =>  '',
                    'src'               =>  '',
                    'deps'              =>  array(),
                    'ver'               =>  false,
                    'media'             =>  'all',
                    'loading_method'    =>  'inline',
                    'critical'          =>  false
                ) 
            );

    // Validate passed arguments
    if ( ! str_contains( $block_name, '/' ) || str_contains( trim( $block_name ), ' ' ) ) return;
    if ( str_contains( trim( $class_name ), ' ' ) || str_starts_with( $class_name, '.') ) return;
    if ( ! empty( $args ) ) {
        if ( array_key_exists( 'handle', $args ) ) {
            if ( empty( trim( $args['handle'] ) ) || ! is_string( $args['handle'] ) ) {
                return;       
            }
        }

        if ( array_key_exists( 'src', $args ) ) {
            if ( ! is_string( $args['src'] ) ) {
                return;
            } 

            if ( ! str_starts_with( $args['src'], 'http://' ) && ! str_starts_with( $args['src'], 'https://' ) ) {
                return;
            }
        }

        if ( array_key_exists( 'path', $args ) ) {
            if ( ! is_string( $args['path'] ) && ! file_exists( $args['path'] ) ) {
                return;
            }
        }

        if ( array_key_exists( 'ver', $args ) ) {
            if ( ! is_string( $args['ver'] ) && $args['ver'] !== false && ! is_null( $args['ver'] ) ) {
                return;
            }
        }

        if ( array_key_exists( 'media', $args ) ) {
            if ( ! is_string( $args['media'] ) ) {
                return;
            }
        }

        if ( array_key_exists( 'loading_method', $args ) ) {
            if ( strtolower( $args['loading_method'] ) !== 'inline' && strtolower( $args['loading_method'] ) !== 'external' ) {
                return;
            }
        }

        if ( array_key_exists( 'load_in', $args ) ) {
            if ( strtolower( $args['load_in'] ) !== 'frontend' && strtolower( $args['load_in'] ) !== 'editor' ) {
                return;
            }
        }

        if ( array_key_exists( 'critical', $args ) ) {
            if ( ! is_bool( $args['critical'] ) ) return;
        }
    }

    // Create asset enqueue parameters.
    $handle = $args['handle'];
    $src = $args['src'];
    $path = $args['path'];
    $rtl_path = isset( $path ) ? str_replace( '.css', '-rtl.css', $path ) : null;
    $dependencies = $args['deps'];
    $version = $args['ver'] === null ? '' : ( $args['ver'] === false ? THEME_VER : $args['ver'] );
    $media = $args['media'];
    $loading_method = strtolower( $args['loading_method'] );
    $load_in = isset( $args['load_in'] ) ? strtolower( $args['load_in'] ) : null;
    $critical = $args['critical'];

    // Check if the current page being rendered is an admin area or not.
    if ( is_admin() ) {

        // Check if the asset being enqueued is for editor or both by checking the 
        // argument that is being passed to the $load_in parameter.
        if ( ! isset( $load_in ) || $load_in === 'editor' ) {

            // Enqueue asset in the editor
            wp_enqueue_block_style(
                $block_name,
                array( 
                    'handle'    =>  $handle, 
                    'src'       =>  $src, 
                    'deps'      =>  $dependencies, 
                    'ver'       =>  $version, 
                    'media'     =>  $media, 
                    'path'      =>  $path 
                )
            );
        }

    } else {

        // Check if the asset being enqueued is for frontend or both by checking the 
        // argument that is being passed to the $load_in parameter.
        if ( ! isset( $load_in ) || $load_in === 'frontend' ) {
    
            // Create a function for filtering the blocks in the current page and assign it to a variable.
            $block_content_filter_callback_function = static function ( string $content, array $block ) 
            use ( &$block_content_filter_callback_function, $block_name, $class_name, $handle, $path, $rtl_path, $src, $dependencies, $version, $media, $loading_method, $critical ): string {
    
                // Check if the current block being filtered contains a CSS class specified in the $class_name being passed.
                if ( block_has_class( $block, $class_name ) ) {
    
                    // Check the loading method specified for the CSS asset. (i.e. "inline" or "external")
                    if ( $loading_method === 'inline' && isset( $path ) ) {

                        // Enqueue dependencies
                        if ( ! empty( $dependencies ) ) {
                            foreach ( $dependencies as $dependency ) {
                                wp_enqueue_style( $dependency );
                            }
                        }

                        // Temporary fix for a "core/query" block issue.
                        // "core/query" CSS generated from theme.json not rendered when "enhancedPagination" attribute is false. 
                        // As a temporary fix, "core/query" block style must be enqueued manually when "enhancedPagination" attribute is set to false.
                        //
                        // @link https://github.com/WordPress/gutenberg/issues/68580
                        //
                        // @todo Check on the issue in the future and remove this temporary fix when it is already resolved.
                        // 
                        if ( $block_name === 'core/query' && ( ! isset( $block['attrs']['enhancedPagination'] ) || isset( $block['attrs']['enhancedPagination'] ) === false ) ) {
                            wp_enqueue_style( 'wp-block-query' );
                        }
                        // END of fix
    
                        // Get the content of the CSS file and assign it to a variable.
                        $css_file_content = file_get_contents( $path );
                        $css_file_content_rtl = file_get_contents( $rtl_path );

                        // Set @media rule
                        $css_file_content = $media === 'all' ? $css_file_content : "@media $media { $css_file_content }";
                        $css_file_content_rtl = $media === 'all' ? $css_file_content_rtl : "@media $media { $css_file_content_rtl }";
                        
                        // Register a block style for the block instance that has the CSS class name that is associated 
                        // to the CSS file being processed and use its content as an inline style for the block.
                        if ( is_rtl() && file_exists( $rtl_path ) ) {

                            // Register RTL style
                            register_block_style(
                                $block_name,
                                array(
                                    'name'         => $class_name,
                                    'label'        => __( '.' . $class_name, THEME_NS ),
                                    'is_default'   => true,
                                    'inline_style' => preg_replace('#/\*!.*?\*/#s', '', $css_file_content_rtl), // Uses regex to remove file headers from CSS file content
                                )
                            );
                        } else {

                            // Register Regular style
                            register_block_style(
                                $block_name,
                                array(
                                    'name'         => $class_name,
                                    'label'        => __( '.' . $class_name, THEME_NS ),
                                    'is_default'   => true,
                                    'inline_style' => preg_replace('#/\*!.*?\*/#s', '', $css_file_content), // Uses regex to remove file headers from CSS file content
                                )
                            );
                        }
    
                    } else if ( $loading_method === 'external' || ( $loading_method === 'inline' && ! isset( $path ) ) ) {
                        wp_enqueue_style( $handle, $src, $dependencies, $version, $media );
    
                        // Check if the CSS asset being enqueued is a critical CSS.
                        if ( $critical === false ) {

                            // Create style loader tag filter callback function and assign to a variable.
                            $style_loader_tag_filter_callback_function = static function( $tag, $style_handle, $href, $media ) use ( $handle ) {
                                if ( $handle === $style_handle ) {
                                    $tag = '<link id="' . $style_handle . '-css" rel="stylesheet" href="' . $href . '" media="print" onload="this.media=\'' . $media . '\'" >' 
                                        . '<noscript>' . $tag . '</noscript>';           
                                }

                                return $tag;
                            };
    
                            // Filter the style link tag for the enqueued asset and make it non-render blocking.
                            add_filter( 'style_loader_tag', $style_loader_tag_filter_callback_function, 10, 4 );
                        }
                    }

                    // Remove the block filter after enqueing the CSS asset.
                    remove_filter( "render_block_{$block_name}", $block_content_filter_callback_function, 10, 2 );
                }
    
                // Return the block content
                return $content;
            };
    
            // Filter all blocks with a name attribute that matches to the $block_name being passed 
            // and use the $block_content_filter_callback_function variable as the filter's callback fucntion.
            add_filter( "render_block_{$block_name}", $block_content_filter_callback_function, 10, 2 );
        }
    }
}