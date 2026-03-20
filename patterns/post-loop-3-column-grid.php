<?php
/**
 * Title: Post loop 3 column grid
 * Slug: basse/post-loop-3-column-grid
 * Description: This 3-column post loop grid is best used on index and archive pages where the loop can inherit the query from the page.
 * Categories: query
 * Keywords: blog, posts, query, loop, 3 column, grid
 * Block Types: core/query
 * Post Types:
 * Template Types:
 * Viewport Width: 1340
 * Inserter: true
 *
 * @package Basse
 * @since Basse 0.1.0
 */ 
?>

<!-- wp:query {"query":{"perPage":9,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"taxQuery":null,"parents":[],"format":[]},"metadata":{"categories":["posts"],"patternName":"basse/post-loop-3-column-grid","name":"Post loop 3 column grid"},"align":"wide","className":"basse-pattern-post-loop-3-column-grid"} -->
<div class="wp-block-query alignwide basse-pattern-post-loop-3-column-grid">
    <!-- wp:post-template {"layout":{"type":"grid","columnCount":null,"minimumColumnWidth":"20rem"}} -->
        <!-- wp:pattern {"slug":"basse/blog-post-card-1"} /-->
    <!-- /wp:post-template -->

    <!-- wp:query-pagination {"className":"is-style-fill-light-small","style":{"spacing":{"margin":{"top":"var:preset|spacing|large"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
        <!-- wp:query-pagination-previous /-->

        <!-- wp:query-pagination-numbers /-->

        <!-- wp:query-pagination-next /-->
    <!-- /wp:query-pagination -->

    <!-- wp:query-no-results -->
        <!-- wp:paragraph {"align":"center","placeholder":"<?php esc_html_e( 'Add text or blocks that will display when a query returns no results.', 'basse' ) ?>"} -->
        <p class="has-text-align-center"><?php esc_html_e( 'No results found', 'basse' ) ?></p>
        <!-- /wp:paragraph -->
    <!-- /wp:query-no-results -->
</div>
<!-- /wp:query -->