<?php
/**
 * Title: Post loop grid with page heading
 * Slug: basse/post-loop-grid-static-page-heading
 * Description: This post loop grid is best used on index and archive pages where the loop can inherit the query from the page.
 * Categories: query
 * Keywords: blog, posts, query, loop
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

<!-- wp:query {"queryId":2,"query":{"perPage":9,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"taxQuery":null,"parents":[],"format":[]},"tagName":"main","enhancedPagination":true,"className":"basse-pattern-post-loop-grid-static-page-heading","style":{"spacing":{"margin":{"top":"0"},"padding":{"top":"0","bottom":"var:preset|spacing|x-large"},"blockGap":"var:preset|spacing|x-large"}},"layout":{"type":"constrained"}} -->
<main class="wp-block-query basse-pattern-post-loop-grid-static-page-heading" style="margin-top:0;padding-top:0;padding-bottom:var(--wp--preset--spacing--x-large)">
    <!-- wp:pattern {"slug":"basse/hero-basic-1"} /-->

    <!-- wp:post-template {"align":"wide","layout":{"type":"grid","columnCount":null,"minimumColumnWidth":"20rem"}} -->
        <!-- wp:pattern {"slug":"basse/blog-post-card-1"} /-->
    <!-- /wp:post-template -->

    <!-- wp:query-pagination {"paginationArrow":"arrow","align":"wide","className":"is-style-fill-light-small","style":{"spacing":{"margin":{"top":"var:preset|spacing|large"}}},"layout":{"type":"flex","justifyContent":"center","flexWrap":"nowrap","orientation":"horizontal"}} -->
        <!-- wp:query-pagination-previous {"label":"","style":{"layout":{"selfStretch":"fit","flexSize":null}}} /-->

        <!-- wp:query-pagination-numbers {"midSize":1,"style":{"layout":{"selfStretch":"fit","flexSize":null}}} /-->

        <!-- wp:query-pagination-next {"label":"","style":{"layout":{"selfStretch":"fit","flexSize":null}}} /-->
    <!-- /wp:query-pagination -->

    <!-- wp:query-no-results {"align":"wide"} -->
        <!-- wp:paragraph {"align":"center","placeholder":"Add text or blocks that will display when a query returns no results."} -->
        <p class="has-text-align-center"><?php esc_html_e( 'No results found', 'basse' ) ?></p>
        <!-- /wp:paragraph -->
    <!-- /wp:query-no-results -->
</main>
<!-- /wp:query -->