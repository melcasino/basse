<?php
/**
 * Title: Header
 * Slug: basse/header
 * Description: Site header with site title and navigation.
 * Categories: header
 * Keywords:  header, site header
 * Block Types: core/template-part/header
 * Post Types:
 * Template Types:
 * Viewport Width: 1920
 * Inserter: true
 *
 * @package Basse
 * @since Basse 0.1.0
 */
?>

<!-- wp:group {"metadata":{"name":"Header 1"},"align":"full","className":"basse-pattern-header-1","style":{"spacing":{"padding":{"top":"var:preset|spacing|small","bottom":"var:preset|spacing|small"}}},"backgroundColor":"white","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull basse-pattern-header-1 has-white-background-color has-background" style="padding-top:var(--wp--preset--spacing--small);padding-bottom:var(--wp--preset--spacing--small)">
    <!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
    <div class="wp-block-group alignwide">
        <!-- wp:site-title {"level":0,"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"medium"} /-->

        <!-- wp:navigation {"ref":8,"layout":{"type":"flex","justifyContent":"space-between"}} /-->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->