<?php
/**
 * Title: Post loop list search results
 * Slug: basse/post-loop-list-search-results
 * Description: This post loop is best used on search results template.
 * Categories: query
 * Keywords: query, loop, search, search results
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

<!-- wp:query {"queryId":5,"query":{"perPage":9,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"taxQuery":null,"parents":[],"format":[]},"tagName":"main","enhancedPagination":true,"className":"basse-pattern-post-loop-list-search-results","style":{"spacing":{"margin":{"top":"0"},"padding":{"top":"var:preset|spacing|x-large","bottom":"var:preset|spacing|x-large"},"blockGap":"var:preset|spacing|large"}},"layout":{"type":"constrained"}} -->
<main class="wp-block-query basse-pattern-post-loop-list-search-results" style="margin-top:0;padding-top:var(--wp--preset--spacing--x-large);padding-bottom:var(--wp--preset--spacing--x-large)">
    <!-- wp:group {"tagName":"header","style":{"border":{"radius":{"topLeft":"0.75rem","topRight":"0.75rem","bottomLeft":"0.75rem","bottomRight":"0.75rem"}}},"layout":{"type":"default"}} -->
    <header class="wp-block-group" style="border-top-left-radius:0.75rem;border-top-right-radius:0.75rem;border-bottom-left-radius:0.75rem;border-bottom-right-radius:0.75rem">
        <!-- wp:search {"label":"\u003cstrong\u003eSearch\u003c/strong\u003e","showLabel":false,"placeholder":"<?php esc_html_e( 'Enter search term...', 'basse' ) ?>","widthUnit":"px","buttonText":"<?php esc_html_e( 'Search', 'basse' ) ?>"} /-->

        <!-- wp:query-title {"type":"search","style":{"spacing":{"margin":{"top":"var:preset|spacing|small"}},"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"base"} /-->
    </header>
    <!-- /wp:group -->

    <!-- wp:post-template {"style":{"spacing":{"margin":{"top":"var:preset|spacing|x-large"}}}} -->
        <!-- wp:pattern {"slug":"basse/blog-post-card-3"} /-->

        <!-- wp:separator {"className":"is-style-default","style":{"spacing":{"margin":{"top":"var:preset|spacing|medium","bottom":"0"}},"border":{"width":"1px"}},"backgroundColor":"light-gray","borderColor":"neutral-200"} -->
        <hr class="wp-block-separator has-text-color has-light-gray-color has-alpha-channel-opacity has-light-gray-background-color has-background is-style-default has-border-color has-neutral-200-border-color" style="border-width:1px;margin-top:var(--wp--preset--spacing--medium);margin-bottom:0"/>
        <!-- /wp:separator -->
    <!-- /wp:post-template -->

    <!-- wp:query-pagination {"paginationArrow":"arrow","className":"is-style-fill-light-small","style":{"spacing":{"margin":{"top":"var:preset|spacing|large"}}},"layout":{"type":"flex","justifyContent":"center"}} -->
        <!-- wp:query-pagination-previous /-->

        <!-- wp:query-pagination-numbers {"midSize":1} /-->

        <!-- wp:query-pagination-next /-->
    <!-- /wp:query-pagination -->

    <!-- wp:query-no-results -->
        <!-- wp:paragraph {"align":"center","placeholder":"<?php esc_html_e( 'Add text or blocks that will display when a query returns no results.', 'basse' ) ?>"} -->
        <p class="has-text-align-center"><?php esc_html_e( 'No results found', 'basse' ) ?></p>
        <!-- /wp:paragraph -->
    <!-- /wp:query-no-results -->
</main>
<!-- /wp:query -->