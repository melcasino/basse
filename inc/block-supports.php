<?php
/**
 * Block Supports.
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



function modify_block_supports( $args, $block_type ) {

    // Array of all block names(including namespace) to be modified.
    $blocks_to_modify = array(
        array(
            'block_name'    =>  'core/template-part',
            'supports'      =>  array(
                'spacing'	=>	array(
                    'padding'						=>	true,
                    'margin'						=>	array( 'top', 'bottom' ),
                    'blockGap'						=>	true,
                    '__experimentalDefaultControls'	=>	array(
                        'padding'	=>	true,
                        'margin'	=>	true,
                        'blockGap'	=>	false,
                    )
                ),
                'position'  =>  array(
                    'sticky'    =>  true,
                ),
            )
        ),
        array(
            'block_name'    =>  'core/query',
            'supports'      =>  array(
                'spacing'	=>	array(
                    'padding'						=>	true,
                    'margin'						=>	array( 'top', 'bottom' ),
                    'blockGap'						=>	true,
                    '__experimentalDefaultControls'	=>	array(
                        'padding'	=>	true,
                        'margin'	=>	true,
                        'blockGap'	=>	false,
                    )
                ),
            )
        ),
        array(
            'block_name'    =>  'core/post-content',
            'supports'      =>  array(
                'interactivity'  =>	array(
                    'clientNavigation' =>  true,
                ),
            )
        ),
        array(
            'block_name'    =>  'core/group',
            'supports'      =>  array(
                'interactivity'  =>	array(
                    'clientNavigation' =>  true,
                ),
            )
        ),
        array(
            'block_name'    =>  'core/heading',
            'supports'      =>  array(
                'shadow'    =>	true,
            )
        ),
        array(
            'block_name'    =>  'core/paragraph',
            'supports'      =>  array(
                'shadow'    =>	true,
				'align'     =>	array( 'wide', 'full' ),
            )
        ),
    );

    // Create an array of block names from $blocks_to_modify
    $block_names = array();
    foreach ( $blocks_to_modify as $block ) $block_names[] = $block['block_name'];

    // Check if $block_type is in the array of blocks names that are going to be modified.
	if ( !in_array( $block_type, $block_names ) ) return $args;

    // Check if block supports is set. If not set, set it to be an empty array.
	if ( !isset( $args['supports'] ) ) $args['supports'] = array();

    // Loop through the array of blocks to modify
    foreach ( $blocks_to_modify as $block ) {
        
        // Merge the provided supports array to the current block supports array 
        if ( $block['block_name'] === $block_type ) {
            $args['supports'] = array_merge(
                $args['supports'],
                $block['supports']
            );
        }
    }
    
    return $args;
}
add_filter( 'register_block_type_args', THEME_NS . '\modify_block_supports', 10, 2 );