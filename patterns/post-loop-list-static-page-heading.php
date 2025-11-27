<?php
/**
 * Title: Post loop with static page heading
 * Slug: basse/post-loop-list-static-page-heading
 * Categories: query
 * Block Types: core/query
 * Viewport Width: 1920
 * Inserter: true
 * Description: A page with a static heading and a list of all posts with title, publish date and content.
 *
 * @package Basse
 * @since Basse 0.1.0
 */ 
?>

<!-- wp:query {"query":{"perPage":10,"pages":0,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","exclude":[],"sticky":"","inherit":true,"taxQuery":null,"parents":[],"format":[]},"tagName":"main","className":"basse-pattern-post-loop-list-default","layout":{"type":"constrained"},"style":{"spacing":{"margin":{"top":"0"},"padding":{"top":"var:preset|spacing|x-large","bottom":"var:preset|spacing|x-large"},"blockGap":"var:preset|spacing|large"}}} -->
<main class="wp-block-query basse-pattern-post-loop-list-default" style="margin-top:0; padding-top:var(--wp--preset--spacing--x-large); padding-bottom:var(--wp--preset--spacing--x-large)">
    <!-- wp:heading {"level":1} -->
    <h1 class="wp-block-heading"><?php echo esc_html_x( 'Posts', 'This is a title of a page that displays a list of posts.', 'basse' ) ?></h1>
    <!-- /wp:heading -->
     
    <!-- wp:post-template -->
        <!-- wp:group {"tagName":"article","metadata":{"name":"Article"},"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"default"}} -->
        <article class="wp-block-group">
            <!-- wp:group {"tagName":"header","metadata":{"name":"Header"},"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"constrained"}} -->
            <header class="wp-block-group">
                <!-- wp:post-title /-->

                <!-- wp:group {"metadata":{"name":"Publish date"},"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"fontSize":"small","layout":{"type":"flex","flexWrap":"nowrap"}} -->
                <div class="wp-block-group has-small-font-size">
                    <!-- wp:paragraph -->
                    <p>Posted on:</p>
                    <!-- /wp:paragraph -->

                    <!-- wp:post-date {"format":"M j, Y","metadata":{"bindings":{"datetime":{"source":"core/post-data","args":{"field":"date"}}}}} /-->
                </div>
                <!-- /wp:group -->
            </header>
            <!-- /wp:group -->

            <!-- wp:post-content /-->
        </article>
        <!-- /wp:group -->
         
        <!-- wp:separator {"className":"is-style-default","style":{"spacing":{"margin":{"top":"var:preset|spacing|medium","bottom":"0"}},"border":{"width":"1px"}},"backgroundColor":"light-gray"} -->
        <hr class="wp-block-separator has-text-color has-light-gray-color has-alpha-channel-opacity has-light-gray-background-color has-background is-style-default" style="border-width:1px;margin-top:var(--wp--preset--spacing--medium);margin-bottom:0"/>
        <!-- /wp:separator -->
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