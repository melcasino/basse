<?php
/**
 * Title: Header
 * Slug: basse/header
 * Categories: header
 * Block Types: core/template-part/header
 * Viewport Width: 1920
 * Description: Site header with site title and navigation.
 *
 * @package Basse
 * @since Basse 0.1.0
 */
?>

<!-- wp:group {"align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|small","bottom":"var:preset|spacing|small"}}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--small);padding-bottom:var(--wp--preset--spacing--small)">
    <!-- wp:group {"align":"wide","layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"space-between"}} -->
    <div class="wp-block-group alignwide">
        <!-- wp:site-title {"level":0,"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"medium"} /-->
        <!-- wp:navigation {"ref":8} /-->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->