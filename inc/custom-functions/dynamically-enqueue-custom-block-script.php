<?php
/**
 * Block JS dynamic enqueueing function
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
 * Dynamically enqueue custom block script
 * 
 * This function dynamically enqueue a custom block JS only if the specified block 
 * has the custom CSS class name that is associated to the JS file.
 * 
 * @since 0.1.0
 * 
 * @see render_block_{$this->name}
 * @see wp_parse_args()
 * @see basse\block_has_class()
 * 
 * @param string           $block_name   The name of the block where the JS asset will be used. 
 *                                       It must have the block namespace and the block slug. (e.g. core/button)
 * @param string           $class_name   The CSS class name associated to the JS asset. It must be unique.
 * @param array            $args {
 *     An array of arguments for the JS file.
 *     
 *     @type string           $handle         The handle for the script. Should be uniqe.
 *     @type string           $src            The source URL of the script. Default ''.
 *     @type string           $path           The absolute path of the JS file, so that it can potentially be inlined.
 *     @type string[]         $deps           An array of registered script handles this script depends on. Default 'array()'.
 *     @type string|bool|null $version        The version of the JS file. If undefined or set to 'false', the curent theme version will be used. 
 *                                            If set to 'NULL', no version will be added.
 *                                            Default 'false'.
 *     @type string           $strategy       Optional. If provided, may be either 'defer' or 'async'.
 *     @type bool             $in_footer      Optional. Whether to print the script in the footer. Default 'true'.
 *     @type string           $fetchpriority  Optional. The fetch priority for the script. Accepts 'high', or 'low'. Default 'auto'.
 *     @type string           $loading_method Optional. If provided, may be either 'inline' or 'external'. Default: 'external'.
 *     @type string           $load_in        Optional. If provided, may be either 'frontend' or 'editor'. 
 *                                            If not defined, asset will be loaded in both frontend and editor.
 * }
 */
function dynamically_enqueue_custom_block_script( string $block_name, string $class_name, array $args ) {

    // Bail early if required functions does not exist.
    if ( ! function_exists( 'basse\block_has_class' ) ) return;

    // Bail early if $block_name or $class_name is not set.
    if ( ! isset( $block_name ) || ! isset( $class_name ) ) return;

    // Set defaults for the $args
    $args = wp_parse_args( 
                $args, 
                array(
                    'handle'            =>  '',
                    'src'               =>  '',
                    'deps'              =>  array(),
                    'ver'               =>  false,
                    'in_footer'         =>  true,
                    'loading_method'    =>  'external',
                ) 
            );

    // Validate passed arguments and silently fail if not valid.
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

        if ( array_key_exists( 'deps', $args ) ) {
            if ( ! is_array( $args['deps'] ) ) {
                return;
            }
        }

        if ( array_key_exists( 'ver', $args ) ) {
            if ( ! is_string( $args['ver'] ) && $args['ver'] !== false && ! is_null( $args['ver'] ) ) {
                return;
            }
        }

        if ( array_key_exists( 'strategy', $args ) ) { 
            if ( $args['strategy'] !== 'defer' && $args['strategy'] !== 'async' ) {
                return;
            }
        }

        if ( array_key_exists( 'in_footer', $args ) ) {
            if ( ! is_bool( $args['in_footer'] ) ) { 
                return; 
            } 
        }

        if ( array_key_exists( 'fetchpriority', $args ) ) {
            if ( $args['fetchpriority'] !== 'low' && $args['fetchpriority'] !== 'high' &&  $args['fetchpriority'] !== 'auto' ) { 
                return; 
            }
        }

        if ( array_key_exists( 'loading_method', $args ) ) { 
            if ( strtolower( $args['loading_method'] ) !== 'inline' && strtolower( $args['loading_method'] ) !== 'external' ) {
                return;
            }
        }
        if( array_key_exists( 'load_in', $args ) ) {
            if ( strtolower( $args['load_in'] ) !== 'frontend' && strtolower( $args['load_in'] ) !== 'editor' ) {
                return;
            }
        }
    }

    // Set variables that will be used in enqueueing the asset.
    $handle = $args['handle'];
    $src = $args['src'];
    $path = $args['path'];
    $deps = $args['deps'];
    $version = $args['ver'] === false ? THEME_VER : $args['ver'];
    $loading_method =  $args['loading_method'];
    $load_in = isset( $args['load_in'] ) ? strtolower( $args['load_in'] ) : null; 
    $enqueue_args = array_filter( $args, function( $key ) {
        return $key === 'strategy' || $key === 'in_footer' || $key === 'fetchpriority';
    }, ARRAY_FILTER_USE_KEY );

    // Check if the current page being rendered is an admin area or not.
    if ( is_admin() ) {

        // Check if the asset being enqueued is for editor or both by checking the 
        // argument that is being passed to the $load_in parameter.
        if ( ! isset( $load_in ) || strtolower( $load_in ) === 'editor' ) {

            // Enqueue asset in the editor
            add_action( 
                'enqueue_block_assets', 
                static function() use ( $handle, $src, $deps, $version, $enqueue_args ): void {
                    wp_enqueue_script( $handle, $src, $deps, $version, $enqueue_args );
                } 
            );
        }

    } else {
        
        // Check if the asset being enqueued is for frontend or both by checking the 
        // argument that is being passed to the $load_in parameter.
        if ( ! isset( $load_in ) || strtolower( $load_in ) === 'frontend' ) {
            
            // Create a function for filtering the blocks in the current page and assign it to a variable.
            $block_content_filter_callback_function = static function( string $content, array $block ) 
            use ( &$block_content_filter_callback_function, $block_name, $class_name, $handle, $path, $src, $version, $deps, $loading_method, $enqueue_args ): string {
    
                // Check if the current block being filtered contains the CSS class being passed to $class_name parameter.
                if ( block_has_class( $block, $class_name ) ) {
    
                    // Check the loading method specified for the JS asset.
                    if ( strtolower( $loading_method ) === 'inline' && isset( $path ) ) {

                        // Enqueue dependencies
                        if ( ! empty( $deps ) ) {
                            foreach ( $deps as $dependency ) {
                                wp_enqueue_script( $dependency );
                            }
                        }

                        // Update asset handle
                        $handle .= '-' . strtolower( $loading_method ) . '-js';
                        
                        // Get the content of the JS file and assign it to a variable.
                        $js_file_content = preg_replace('#/\*!.*?\*/#s', '', file_get_contents( $path ) ); // Uses regex to remove file headers from JS file content
                        
                        // Check if asset is set to load in footer or not
                        if ( $enqueue_args[ 'in_footer' ] ) {

                            // Load JS inline in footer
                            add_action( 
                                'wp_footer', 
                                static function() use ( $handle, $js_file_content ): void {
                                    ?>
                                    <script id="<?php echo esc_attr( $handle ) ?>">
                                        <?php echo $js_file_content ?>
                                    </script>
                                    <?php
                                }, 20 
                            );
                        } else {

                            // Load JS inline in header
                            add_action( 
                                'wp_head', 
                                static function() use ( $handle, $js_file_content ): void {
                                    ?>
                                    <script id="<?php echo esc_attr( $handle ) ?>">
                                        <?php echo $js_file_content ?>
                                    </script>
                                    <?php
                                }, 20 
                            );
                        }
    
                    } else if ( strtolower( $loading_method ) === 'external' || ( strtolower( $loading_method ) === 'inline' || ! isset( $path ) ) ) {

                        // Enqueue asset in the editor
                        wp_enqueue_script( $handle, $src, $deps, $version, $enqueue_args );
                    }

                    // Remove the block filter after enqueing the JS asset.
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