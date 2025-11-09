<?php
/**
 * Title: Post loop with static page heading
 * Slug: basse/post-loop-list-static-page-heading
 * Categories: query
 * Block Types: core/query
 * Viewport Width: 1920
 * Description: A page with a static heading and a list of all posts with title, publish date and content.
 *
 * @package Basse
 * @since Basse 0.1.0
 */ 
?>

<!-- wp:query {"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"taxQuery":null,"parents":[],"format":[]},"tagName":"main","enhancedPagination":true,"className":"post-loop-list-default","layout":{"type":"constrained"}} -->
<main class="wp-block-query post-loop-list-default">
    <!-- wp:heading {"level":1} -->
    <h1 class="wp-block-heading"><?php echo esc_html_x( 'Posts', 'This is a title of a page that displays a list of posts.', 'basse' ) ?></h1>
    <!-- /wp:heading -->
     
    <!-- wp:post-template {"style":{"spacing":{"margin":{"top":"var:preset|spacing|large"}}}} -->
        <!-- wp:group {"tagName":"article","style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"default"}} -->
        <article class="wp-block-group">
            <!-- wp:post-title /-->

            <!-- wp:post-date {"metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}}} /-->

            <!-- wp:post-content /-->
        </article>
        <!-- /wp:group -->
    <!-- /wp:post-template -->

    <!-- wp:query-pagination {"paginationArrow":"arrow","layout":{"type":"flex","justifyContent":"space-between"}} -->
        <!-- wp:query-pagination-previous /-->

        <!-- wp:query-pagination-numbers {"midSize":1} /-->

        <!-- wp:query-pagination-next /-->
    <!-- /wp:query-pagination -->

    <!-- wp:query-no-results -->
        <!-- wp:paragraph {"align":"center","placeholder":"Add text or blocks that will display when a query returns no results."} -->
        <p class="has-text-align-center"><?php echo esc_html_x( 'No results found.', 'A message saying that there are no results found on the default page query.', 'basse' ) ?></p>
        <!-- /wp:paragraph -->
    <!-- /wp:query-no-results -->
</main>
<!-- /wp:query -->