/**
 * Primary Editor Script
 * 
 * @package	  basse
 * @author    Mel Casiño
 * @copyright Copyright (c) 2025, Mel Casiño
 * @license   https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0-or-late
 * @since     0.1.0
 */



// Import all dependencies
import { unregisterBlockStyle } from '@wordpress/blocks';
import domReady from '@wordpress/dom-ready';



// Unregister block stlye variations
domReady( () => {
    const blocks = [
        {
            'blockName': 'core/button',
            'styleVariations': [ 'outline' ],
        },
        {
            'blockName': 'core/separator',
            'styleVariations':  [ 'wide', 'dots' ],
        },
        {
            'blockName': 'core/image',
            'styleVariations':  [ 'rounded' ],
        },
        {
            'blockName': 'core/quote',
            'styleVariations':  [ 'plain' ],
        }
    ];

    blocks.forEach( block => {
        block.styleVariations.forEach( styleVariation => unregisterBlockStyle( block.blockName, styleVariation ) ); 
    } );
} );