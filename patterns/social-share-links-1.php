<?php
/**
 * Title: Social Share Links 1
 * Slug: basse/social-share-links-1
 * Description: Icon button style social sharing links in a horizontal layout.
 * Categories:
 * Keywords: social sharing, share links, share buttons, social
 * Block Types:
 * Post Types:
 * Template Types:
 * Viewport Width: 600
 * Inserter: true
 *
 * @package Basse
 * @since Basse 0.1.0
 */ 
?>

<!-- wp:group {"className":"basse-pattern-social-share-links-1","style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"default"}} -->
<div class="wp-block-group basse-pattern-social-share-links-1">
    <!-- wp:paragraph -->
    <p><strong><?php esc_html_e( 'Share the post:', 'basse' ) ?></strong></p>
    <!-- /wp:paragraph -->

    <?php
    
    if ( WP_Block_Type_Registry::get_instance()->is_registered( 'outermost/social-sharing' ) ) {
        ?>
        
        <!-- wp:outermost/social-sharing {"iconBackgroundColor":"black","iconBackgroundColorValue":"#000000","style":{"spacing":{"blockGap":{"top":"var:preset|spacing|small","left":"var:preset|spacing|small"}}}} -->
        <ul class="wp-block-outermost-social-sharing has-icon-background-color">
            <!-- wp:outermost/social-sharing-link {"service":"facebook"} /-->

            <!-- wp:outermost/social-sharing-link {"service":"x"} /-->

            <!-- wp:outermost/social-sharing-link {"service":"linkedin"} /-->

            <!-- wp:outermost/social-sharing-link {"service":"reddit"} /-->
        </ul>
        <!-- /wp:outermost/social-sharing -->

        <?php
    } else {
        ?>

        <!-- wp:paragraph -->
        <p><em><a href="<?php esc_url( 'https://wordpress.org/plugins/social-sharing-block/' ) ?>" target="_blank" rel="noreferrer noopener"><?php esc_html_e( 'Social Sharing Block', 'basse' ) ?></a><?php esc_html_e( ' goes here...', 'basse' ) ?></em></p>
        <!-- /wp:paragraph -->
        
        <?php
    }

    ?>
</div>
<!-- /wp:group -->