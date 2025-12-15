<?php
/**
 * Theme setup functions
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
 * Setup theme defaults, register and remove WordPress features
 * 
 */
function set_theme_defaults() {
    
    // Remove core block patterns.
    remove_theme_support( 'core-block-patterns' );
}
add_action( 'after_setup_theme', THEME_NS . '\set_theme_defaults' );



/**
 * Register style variations
 * 
 */
function register_block_style_variations() {
    $block_styles = array(
        'core/button'   =>  array(
            'outline-default'   =>  __( 'Outline', 'basse'),    
            'fill-small'        =>  __( 'Fill - Small', 'basse'),
            'outline-small'     =>  __( 'Outline - Small', 'basse'),
        ),
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



/**
 * Register pattern categories
 * 
 */
function register_pattern_categories() {
    $block_pattern_categories = array(
        THEME_NS . '/templates'	=> array(
            'label' => __( 'Templates', THEME_NS ),
        ),
        THEME_NS . '/pages'		=> array(
            'label' => __( 'Pages', THEME_NS ),
        ),
        THEME_NS . '/sections'	=> array(
            'label' => __( 'Sections', THEME_NS ),
        ),
        THEME_NS . '/cards'	    => array(
            'label' => __( 'Cards', THEME_NS ),
        ),
    );

    foreach ( $block_pattern_categories as $name => $properties ) {
        if ( ! \WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
            register_block_pattern_category( $name, $properties );
        }
    }
}
add_action( 'init', THEME_NS . '\register_pattern_categories' );



/**
 * Modify WordPress default theme.json data
 * 
 */
function modify_wp_default_theme_json_data( $theme_json ) {
	
    $data = $theme_json->get_data();

	if ( isset( $data['settings']['color'] ) ) { 
		unset( $data['settings']['color']['palette']['default'] );
		unset( $data['settings']['color']['gradients']['default'] );
		unset( $data['settings']['color']['duotone']['default'] );
	}

	if ( isset( $data['settings']['spacing'] ) ) {
		$data['settings']['spacing']['spacingScale']['steps'] = 0;
		unset( $data['settings']['spacing']['spacingScale']['default'] );
		unset( $data['settings']['spacing']['spacingSizes']['default'] );
	}

    if ( isset( $data['styles']['blocks']['core/button']['variations']['outline'] ) ) {
        $data['styles']['blocks']['core/button']['variations']['outline']['spacing']['padding'] = array(
            'top'       =>  '0.75em',
            'right'     =>  '1.125em',
            'bottom'    =>  '0.75em',
            'left'      =>  '1.125em'
        );
        $data['styles']['blocks']['core/button']['variations']['outline']['border']['width'] = '1px';
    }

	$theme_json->update_with( $data );

    return $theme_json;
}
add_filter( 'wp_theme_json_data_default', THEME_NS . '\modify_wp_default_theme_json_data' );