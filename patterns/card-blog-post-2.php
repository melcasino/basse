<?php
/**
 * Title: Blog Post Card 2
 * Slug: basse/blog-post-card-2
 * Description: A blog post card with post title, featured image and publish date. Use this within query block.
 * Categories: query, basse/cards
 * Keywords: card, image, blog post
 * Block Types: core/query, core/post-template
 * Post Types:
 * Template Types:
 * Viewport Width: 400
 * Inserter: true
 *
 * @package Basse
 * @since Basse 0.1.0
 */ 
?>

<!-- wp:group {"tagName":"article","className":"basse-pattern-blog-post-card-2","style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":null}} -->
<article class="wp-block-group basse-pattern-blog-post-card-2">
    <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small"},"layout":{"columnSpan":2}},"layout":{"type":"default"}} -->
    <div class="wp-block-group">
        <!-- wp:post-title {"level":3,"isLink":true,"style":{"elements":{"link":{"color":{"text":"var:preset|color|black"}}}},"fontSize":"base"} /-->

        <!-- wp:post-date {"metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}},"fontSize":"small"} /-->
    </div>
    <!-- /wp:group -->

    <!-- wp:post-featured-image {"aspectRatio":"1","height":"","sizeSlug":"thumbnail"} /-->
</article>
<!-- /wp:group -->