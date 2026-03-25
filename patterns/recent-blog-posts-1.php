<?php
/**
 * Title: Recent Blog Posts 1
 * Slug: basse/recent-blog-posts-1
 * Description: A section with three recent blog posts in a 3-column layout.
 * Categories: basse/sections
 * Keywords: recent blog posts, blog posts, latest blog posts, blog, post, query
 * Block Types:
 * Post Types:
 * Template Types:
 * Viewport Width: 1920
 * Inserter: true
 *
 * @package Basse
 * @since Basse 0.1.0
 */ 
?>

<!-- wp:group {"tagName":"aside","align":"full","className":"basse-pattern-recent-blog-posts-1","style":{"spacing":{"padding":{"top":"var:preset|spacing|x-large","bottom":"var:preset|spacing|x-large"},"blockGap":"var:preset|spacing|large"}},"backgroundColor":"neutral-50","layout":{"type":"constrained"}} -->
<aside class="wp-block-group alignfull basse-pattern-recent-blog-posts-1 has-neutral-50-background-color has-background" style="padding-top:var(--wp--preset--spacing--x-large);padding-bottom:var(--wp--preset--spacing--x-large)">
    <!-- wp:heading {"align":"wide"} -->
    <h2 class="wp-block-heading alignwide"><?php esc_html_e( 'Recent Posts', 'basse' ) ?></h2>
    <!-- /wp:heading -->

    <!-- wp:query {"query":{"perPage":3,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"ignore","inherit":false,"taxQuery":null,"parents":[],"format":[]},"align":"wide"} -->
    <div class="wp-block-query alignwide">
        <!-- wp:post-template {"layout":{"type":"grid","columnCount":null,"minimumColumnWidth":"20rem"}} -->
            <!-- wp:pattern {"slug":"basse/blog-post-card-2"} /-->
        <!-- /wp:post-template -->

        <!-- wp:query-no-results -->
            <!-- wp:paragraph {"align":"center","placeholder":"<?php esc_html_e( 'Add text or blocks that will display when a query returns no results.', 'basse' ) ?>"} -->
            <p class="has-text-align-center"><?php esc_html_e( 'No results found.', 'basse' ) ?></p>
            <!-- /wp:paragraph -->
        <!-- /wp:query-no-results -->
    </div>
    <!-- /wp:query -->
</aside>
<!-- /wp:group -->