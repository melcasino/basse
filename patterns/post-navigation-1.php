<?php
/**
 * Title: Post Navigation 1
 * Slug: basse/post-navigation-1
 * Description: Single post navigation. Use this in single post template.
 * Categories: 
 * Keywords: post navigation, single post, navigation
 * Block Types:
 * Post Types:
 * Template Types:
 * Viewport Width: 768
 * Inserter: true
 *
 * @package Basse
 * @since Basse 0.1.0
 */ 
?>

<!-- wp:group {"className":"basse-pattern-post-navigation","layout":{"type":"grid","minimumColumnWidth":"13rem"}} -->
<div class="wp-block-group basse-pattern-post-navigation">
    <!-- wp:post-navigation-link {"type":"previous","label":"<?php esc_html_e( 'Previous Post:', 'basse' ) ?>","showTitle":true,"className":"is-style-label-on-top","style":{"layout":{"selfStretch":"fill","flexSize":null}}} /-->

    <!-- wp:post-navigation-link {"textAlign":"right","label":"<?php esc_html_e( 'Next Post:', 'basse' ) ?>","showTitle":true,"className":"is-style-label-on-top","style":{"layout":{"selfStretch":"fill","flexSize":null}}} /--></div>
<!-- /wp:group -->