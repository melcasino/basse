<?php
/**
 * Title: Single Post Narrow
 * Slug: basse/template-single-narrow
 * Description: A centered single post layout where the content sits in a narrow container in the middle of the page.
 * Categories: basse/templates
 * Keywords: single post, post, narrow, centered
 * Block Types:
 * Post Types:
 * Template Types: single
 * Viewport Width: 1920
 * Inserter: false
 *
 * @package Basse
 * @since Basse 0.1.0
 */ 
?>

<!-- wp:template-part {"slug":"header","theme":"basse","area":"header"} /-->

<!-- wp:group {"tagName":"main","metadata":{"name":"Main"},"style":{"spacing":{"margin":{"top":"0"},"blockGap":"0"}},"layout":{"type":"constrained"}} -->
<main class="wp-block-group" style="margin-top:0">
    <!-- wp:group {"tagName":"article","metadata":{"name":"Article"},"align":"full","style":{"spacing":{"blockGap":"var:preset|spacing|large","padding":{"top":"var:preset|spacing|x-large","bottom":"var:preset|spacing|x-large"}}},"layout":{"type":"constrained","contentSize":"645px","wideSize":"768px"}} -->
    <article class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--x-large);padding-bottom:var(--wp--preset--spacing--x-large)">
        <!-- wp:group {"tagName":"header","metadata":{"name":"Header"},"align":"wide","layout":{"type":"constrained"}} -->
        <header class="wp-block-group alignwide">
            <!-- wp:post-title {"level":1} /-->

            <!-- wp:group {"metadata":{"name":"Post Meta"},"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|small","left":"var:preset|spacing|small"}},"typography":{"lineHeight":"1.25"}},"fontSize":"x-small","layout":{"type":"flex","flexWrap":"nowrap"}} -->
            <div class="wp-block-group has-x-small-font-size" style="line-height:1.25">
                <!-- wp:group {"style":{"spacing":{"blockGap":"0.25rem"},"layout":{"selfStretch":"fit","flexSize":null}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group">
                    <!-- wp:paragraph {"style":{"layout":{"selfStretch":"fit","flexSize":null}}} -->
                    <p>Posted on:</p>
                    <!-- /wp:paragraph -->

                    <!-- wp:post-date {"datetime":"2026-01-08T13:00:42.530Z","format":"M j, Y","metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}}} /-->
                </div>
                <!-- /wp:group -->

                <!-- wp:group {"style":{"spacing":{"blockGap":"0.25rem"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group">
                    <!-- wp:paragraph -->
                    <p>By:</p>
                    <!-- /wp:paragraph -->

                    <!-- wp:post-author-name /-->
                </div>
                <!-- /wp:group -->
            </div>
            <!-- /wp:group -->

            <!-- wp:post-featured-image {"aspectRatio":"16/9","align":"wide","style":{"spacing":{"margin":{"top":"var:preset|spacing|large"}}}} /-->
        </header>
        <!-- /wp:group -->

        <!-- wp:post-content /-->

        <!-- wp:group {"tagName":"footer","metadata":{"name":"Footer"},"style":{"spacing":{"blockGap":"var:preset|spacing|large"}},"layout":{"type":"default"}} -->
        <footer class="wp-block-group">
            <!-- wp:pattern {"slug":"basse/social-share-links-1"} /-->

            <!-- wp:separator {"style":{"border":{"width":"1px"}},"borderColor":"neutral-100"} -->
            <hr class="wp-block-separator has-alpha-channel-opacity has-border-color has-neutral-100-border-color" style="border-width:1px"/>
            <!-- /wp:separator -->

            <!-- wp:pattern {"slug":"basse/post-categories-tags"} /-->

            <!-- wp:pattern {"slug":"basse/post-navigation-1"} /-->

            <!-- wp:pattern {"slug":"basse/comments"} /-->
        </footer>
        <!-- /wp:group -->
    </article>
    <!-- /wp:group -->

    <!-- wp:pattern {"slug":"basse/recent-blog-posts-1"} /-->
</main>
<!-- /wp:group -->

<!-- wp:template-part {"slug":"footer","theme":"basse","area":"footer","style":{"spacing":{"margin":{"top":"0"}}}} /-->