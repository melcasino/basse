<?php
/**
 * Title: Blog Post Card 1
 * Slug: basse/blog-post-card-1
 * Description: A blog post card with post title, featured image and post excerpt. Use this within query block.
 * Categories: query, basse/cards
 * Keywords: card, image, text, box, content, link, button
 * Block Types: core/query, core/post-template
 * Viewport Width: 400
 * Inserter: true
 *
 * @package Basse
 * @since Basse 0.1.0
 */ 
?>

<!-- wp:group {"tagName":"article","metadata":{"name":"Blog post card 1"},"className":"basse-pattern-blog-post-card-1","style":{"spacing":{"blockGap":"var:preset|spacing|small","padding":{"top":"var:preset|spacing|medium","bottom":"var:preset|spacing|medium","left":"var:preset|spacing|medium","right":"var:preset|spacing|medium"}},"border":{"radius":{"topLeft":"0.5rem","topRight":"0.5rem","bottomLeft":"0.5rem","bottomRight":"0.5rem"},"width":"1px"},"dimensions":{"minHeight":"100%"}},"backgroundColor":"white","borderColor":"neutral-200","layout":{"type":"flex","orientation":"vertical","flexWrap":"nowrap","justifyContent":"stretch"}} -->
<article class="wp-block-group basse-pattern-blog-post-card-1 has-border-color has-neutral-200-border-color has-white-background-color has-background" style="border-width:1px;border-top-left-radius:0.5rem;border-top-right-radius:0.5rem;border-bottom-left-radius:0.5rem;border-bottom-right-radius:0.5rem;min-height:100%;padding-top:var(--wp--preset--spacing--medium);padding-right:var(--wp--preset--spacing--medium);padding-bottom:var(--wp--preset--spacing--medium);padding-left:var(--wp--preset--spacing--medium)">
    <!-- wp:group {"tagName":"header","metadata":{"name":"Article Header"},"style":{"spacing":{"blockGap":"var:preset|spacing|small"},"layout":{"selfStretch":"fit","flexSize":null}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"stretch"}} -->
    <header class="wp-block-group">
        <!-- wp:post-title {"fontSize":"medium"} /-->

        <!-- wp:group {"metadata":{"name":"Post Meta"},"style":{"spacing":{"blockGap":{"top":"var:preset|spacing|small","left":"var:preset|spacing|small"}},"typography":{"lineHeight":"1.25"}},"fontSize":"x-small","layout":{"type":"flex","flexWrap":"wrap"}} -->
        <div class="wp-block-group has-x-small-font-size" style="line-height:1.25">
            <!-- wp:group {"style":{"spacing":{"blockGap":"0.25rem"},"layout":{"selfStretch":"fit","flexSize":null}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
            <div class="wp-block-group">
                <!-- wp:paragraph {"style":{"layout":{"selfStretch":"fit","flexSize":null}}} -->
                <p><?php esc_html_e( 'Posted on:', 'basse' ); ?></p>
                <!-- /wp:paragraph -->

                <!-- wp:post-date {"datetime":"2026-01-08T13:00:42.530Z","format":"M j, Y","metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}}} /-->
            </div>
            <!-- /wp:group -->

            <!-- wp:group {"tagName":"address","style":{"spacing":{"blockGap":"0.25rem"}},"layout":{"type":"flex","flexWrap":"nowrap"}} -->
            <address class="wp-block-group">
                <!-- wp:paragraph -->
                <p><?php esc_html_e( 'By:', 'basse' ); ?></p>
                <!-- /wp:paragraph -->

                <!-- wp:post-author-name /-->
            </address>
            <!-- /wp:group -->
        </div>
        <!-- /wp:group -->

        <!-- wp:post-featured-image {"aspectRatio":"16/9","sizeSlug":"full","style":{"border":{"radius":{"topLeft":"0.25rem","topRight":"0.25rem","bottomLeft":"0.25rem","bottomRight":"0.25rem"}},"layout":{"selfStretch":"fit","flexSize":null}}} /-->
    </header>
    <!-- /wp:group -->

    <!-- wp:post-excerpt {"moreText":"","showMoreOnNewLine":false,"excerptLength":18,"style":{"layout":{"selfStretch":"fill","flexSize":null}}} /-->

    <!-- wp:group {"tagName":"footer","metadata":{"name":"Article Footer"},"style":{"spacing":{"margin":{"top":"var:preset|spacing|small"}}},"layout":{"type":"constrained"}} -->
    <footer class="wp-block-group" style="margin-top:var(--wp--preset--spacing--small)">
        <!-- wp:read-more {"content":"Continue Reading","className":"is-style-fill-light-small","style":{"layout":{"selfStretch":"fit","flexSize":null}}} /-->
    </footer>
    <!-- /wp:group -->
</article>
<!-- /wp:group -->