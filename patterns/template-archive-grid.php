<?php
/**
 * Title: Archive Template
 * Slug: basse/template-archive-grid
 * Description: A three column grid layout for archive pages.
 * Categories: basse/templates
 * Keywords: archive, index, posts, query, loop
 * Block Types:
 * Post Types:
 * Template Types: archive, index
 * Viewport Width: 1920
 * Inserter: false
 *
 * @package Basse
 * @since Basse 0.1.0
 */ 
?>

<!-- wp:template-part {"slug":"header","theme":"basse"} /-->

<!-- wp:group {"tagName":"main","metadata":{"name":"Main"},"style":{"spacing":{"margin":{"top":"0"},"padding":{"top":"0","bottom":"var:preset|spacing|x-large"},"blockGap":"var:preset|spacing|x-large"}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="margin-top:0;padding-top:0;padding-bottom:var(--wp--preset--spacing--x-large)">
    <!-- wp:pattern {"slug":"basse/hero-archive-heading-1"} /-->
     
    <!-- wp:pattern {"slug":"basse/post-loop-3-column-grid"} /-->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","theme":"basse","style":{"spacing":{"margin":{"top":"0"}}}} /-->