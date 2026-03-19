<?php
/**
 * Title: Page Wide
 * Slug: basse/template-page-wide
 * Description: A wide page layout where the content sits in a wide container in the middle of the page.
 * Categories: basse/templates
 * Keywords: page, wide, centered
 * Block Types:
 * Post Types:
 * Template Types: page
 * Viewport Width: 1920
 * Inserter: false
 *
 * @package Basse
 * @since Basse 0.1.0
 */ 
?>

<!-- wp:template-part {"slug":"header","theme":"basse","area":"header"} /-->

<!-- wp:group {"tagName":"main","metadata":{"name":"Main"},"style":{"spacing":{"margin":{"top":"0"},"padding":{"top":"var:preset|spacing|x-large","bottom":"var:preset|spacing|x-large"},"blockGap":"var:preset|spacing|large"}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="margin-top:0;padding-top:var(--wp--preset--spacing--x-large);padding-bottom:var(--wp--preset--spacing--x-large)">
    <!-- wp:group {"tagName":"header","align":"wide","layout":{"type":"default"}} -->
    <header class="wp-block-group alignwide">
        <!-- wp:post-title {"level":1} /-->

        <!-- wp:post-featured-image {"aspectRatio":"16/9","style":{"spacing":{"margin":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large"}}}} /-->
    </header>
    <!-- /wp:group -->

    <!-- wp:post-content {"align":"wide","layout":{"type":"default"}} /-->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","theme":"basse","area":"footer","style":{"spacing":{"margin":{"top":"0"}}}} /-->