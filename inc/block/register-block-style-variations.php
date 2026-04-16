<?php
/**
 * Block style variations registration function
 * 
 * @package basse
 * @since   0.1.0
 */



namespace basse;



// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



/**
 * Register block style variations
 * 
 * @since 0.1.0
 * 
 * @see 'register_block_style'
 * @see 'init'
 * @link https://developer.wordpress.org/themes/features/block-style-variations/
 */
function register_block_style_variations() {
    $block_styles = array(
        'core/button'           =>  array(
            'fill-small'            =>  __( 'Fill - Small', 'basse' ),
            'fill-light-default'    =>  __( 'Fill Light', 'basse' ),
            'fill-light-small'      =>  __( 'Fill Light - Small', 'basse' ),    
            'outline-default'       =>  __( 'Outline', 'basse' ),
            'outline-small'         =>  __( 'Outline - Small', 'basse' ),
        ),
        'core/read-more'        =>  array(
            'fill-small'            =>  __( 'Fill - Small', 'basse' ),
            'fill-light-default'    =>  __( 'Fill Light', 'basse' ),
            'fill-light-small'      =>  __( 'Fill Light - Small', 'basse' ),
            'outline-default'       =>  __( 'Outline', 'basse' ),    
            'outline-small'         =>  __( 'Outline - Small', 'basse' ),
        ),
        'core/accordion'        =>  array(
            'core-accordion-style-1'    =>  __( 'Style 1', 'basse' ),
        ),
        'core/query-pagination' =>  array(
            'fill-light-default'    =>  __( 'Fill Light', 'basse' ),
            'fill-light-small'      =>  __( 'Fill Light - Small', 'basse' ),
            'outline-default'       =>  __( 'Outline', 'basse' ),
            'outline-small'         =>  __( 'Outline - Small', 'basse' ),
        ),
        'core/post-navigation-link' =>  array(
            'label-on-top' =>  __( 'Label On Top', 'basse' ),
        ),
        'core/navigation'       =>  array(
            'core-navigation-style-1' =>  __( 'Style 1', 'basse' ),
        ) 
    );

    foreach ( $block_styles as $block => $styles ) {
		foreach ( $styles as $style_name => $style_label ) {
			register_block_style(
				$block,
				array(
					'name'  =>  $style_name,
					'label' =>  $style_label,
				)
			);
		}
	}
}
add_action( 'init', THEME_NS . '\register_block_style_variations' );