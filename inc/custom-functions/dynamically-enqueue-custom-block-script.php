<?php
/**
 * This function dynamically enqueue a custom block JS only if the specified block 
 * contains a specified CSS class name that is associated to the JS file.
 * 
 * @param string $block_name (required) 
 * The name of the block where the JS asset will be used. It must have the block namespace and the block slug. (e.g. core/button)
 * 
 * @param string $class_name (required) 
 * The CSS class name associated to the JS asset. It must be unique.
 * 
 * @param string $path (required) 
 * The full path of the JS file.
 * 
 * @param string $src (required) 
 * The full URL of the script, or path of the script relative to the WordPress root directory.
 * Default: ''
 * 
 * @param string[] $dependencies (optional)
 * An array of registered script handles this script depends on.
 * Default: array()
 * 
 * @param string|bool|null $version (optional)
 * The version of the JS file.
 * 
 * @param array $args (optional)
 * An array of additional style loading strategies.
 * |
 * |    $args['strategy'] string
 * |    Optional. If provided, may be either 'defer' or 'async'.
 * |
 * |    $args['in_footer'] string
 * |    Optional. Whether to print the script in the footer.
 * |    Default 'true'
 * |
 * |    $args['loading_method'] string
 * |    Optional. If provided, may be either 'inline' or 'external'.
 * |    Default: 'external'
 * |
 * |    $args['load_in'] string 
 * |    Optional. If provided, may be either 'frontend' or 'editor'. If not defined, asset will be loaded in both frontend and editor.
 * |    Default: 'frontend'
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
 */



namespace basse;



/**
 * Exit if accessed directly
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {

    exit;

}



function dynamically_enqueue_custom_block_script( string $block_name, string $class_name, string $path, string $src = '', array $dependencies = array(), string|bool|null $version = false, array|bool $args = array() ) {

    // Bail early if required functions does not exist.
    if ( !function_exists( 'basse\block_has_class' ) ) return;

    // Bail early if $block_name or $class_name is not set.
    if ( !isset( $block_name ) || !isset( $class_name ) ) return;

    // Validate passed arguments and silently fail if not valid.
    if ( !str_contains( $block_name, '/' ) || str_contains( $block_name, ' ' ) ) return;
    if ( str_contains( $class_name, ' ' )  || str_starts_with( $class_name, '.') ) return;
    if ( !file_exists( $path) ) return;
    if ( !filter_var( $src, FILTER_VALIDATE_URL ) ) return;
    if ( is_array( $args ) && !empty( $args ) ) {
        if ( array_key_exists( 'loading_method', $args ) ) {
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
    }

    // Set variables that will be used in enqueueing the asset.
    $version = $version ? $version : THEME_VER;
    if ( empty( $args ) || !isset( $args[ 'in_footer' ] ) ) $args[ 'in_footer' ] = true;
    $loading_method =  $args['loading_method'] ?? 'external';
    if ( !array_key_exists( 'load_in', $args ) ) $args[ 'load_in' ] = 'frontend'; 
    $handle = THEME_NS . '-' . strtolower( str_replace( '/', '-', $block_name ) ) . '-' . $class_name;
    $enqueue_args = array_filter( $args, function( $key ) {
        return $key !== 'loading_method' && $key !== 'load_in';
    }, ARRAY_FILTER_USE_KEY );

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
            add_action( 
                'enqueue_block_assets', 
                function() use ( $handle, $src, $dependencies, $version, $enqueue_args ): void {
                    wp_enqueue_script( $handle, $src, $dependencies, $version, $enqueue_args );
                } 
            );
        }

    } else {

        // Check if the asset being enqueued is for frontend or both by checking the 
        // argument that is being passed to the $load_in parameter.
        if ( !isset( $load_in ) || strtolower( $load_in ) === 'frontend' ) {
    
            // Create a function for filtering the blocks in the current page and assign it to a variable.
            $filter_callback_function = function( string $content, array $block ) 
            use ( &$filter_callback_function, $block_name, $class_name, $handle, $path, $src, $version, $dependencies, $loading_method, $enqueue_args ): string {
    
                // Check if the current block being filtered contains a CSS class specified in the $class_name being passed.
                if ( block_has_class( $block, $class_name ) ) {
    
                    // Check the loading method specified for the JS asset. (i.e. "inline" or "extrnal")
                    if ( strtolower( $loading_method ) === 'inline' ) {
    
                        // Get the content of the JS file and assign it to a variable.
                        $js_file_content = preg_replace('#/\*!.*?\*/#s', '', file_get_contents( $path ) ); // Uses regex to remove file headers from JS file content
                        
                        // Check if asset is set to load in footer or not
                        if ( $enqueue_args[ 'in_footer' ] ) {

                            // Load JS inline in footer
                            add_action( 
                                'wp_footer', 
                                function() use ( $handle, $js_file_content ): void {
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
                                function() use ( $handle, $js_file_content ): void {
                                    ?>
                                    <script id="<?php echo esc_attr( $handle ) ?>">
                                        <?php echo $js_file_content ?>
                                    </script>
                                    <?php
                                }, 20 
                            );
                        }
    
                    } else if ( strtolower( $loading_method ) === 'external' ) {

                        // Enqueue asset in the editor
                        wp_enqueue_script( $handle, $src, $dependencies, $version, $enqueue_args );
                    }

                    // Remove the block filter after enqueing the JS asset.
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