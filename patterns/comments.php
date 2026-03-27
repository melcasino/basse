<?php
/**
 * Title: Comments
 * Slug: basse/comments-1
 * Description: A comment secton with a list of comments for a post and a comment form.
 * Categories: 
 * Keywords: post comments, comments, comment form
 * Block Types:
 * Post Types:
 * Template Types:
 * Viewport Width: 768
 * Inserter: true
 *
 * @package Basse
 * @since Basse 0.1.0
 */ 
?>

<!-- wp:comments {"className":"basse-pattern-comments"} -->
<div class="wp-block-comments basse-pattern-comments">
    <!-- wp:heading -->
    <h2 class="wp-block-heading"><?php esc_html_e( 'Comments', 'basse' ) ?></h2>
    <!-- /wp:heading -->

    <!-- wp:comments-title {"level":3} /-->

    <!-- wp:comment-template -->
        <!-- wp:columns {"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|small"}}}} -->
        <div class="wp-block-columns">
            <!-- wp:column {"width":"40px"} -->
            <div class="wp-block-column" style="flex-basis:40px">
                <!-- wp:avatar {"size":40,"style":{"border":{"radius":"20px"}}} /-->
            </div>
            <!-- /wp:column -->

            <!-- wp:column {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}}} -->
            <div class="wp-block-column">
                <!-- wp:comment-author-name {"isLink":false,"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"small"} /-->

                <!-- wp:group {"style":{"spacing":{"margin":{"top":"0px","bottom":"0px"}}},"layout":{"type":"flex"}} -->
                <div class="wp-block-group" style="margin-top:0px;margin-bottom:0px">
                    <!-- wp:comment-date {"fontSize":"small"} /-->

                    <!-- wp:comment-edit-link {"fontSize":"small"} /-->
                </div>
                <!-- /wp:group -->

                <!-- wp:comment-content /-->

                <!-- wp:comment-reply-link {"fontSize":"small"} /-->
            </div>
            <!-- /wp:column -->
        </div>
        <!-- /wp:columns -->
    <!-- /wp:comment-template -->

    <!-- wp:comments-pagination /-->

    <!-- wp:post-comments-form /-->
</div>
<!-- /wp:comments -->