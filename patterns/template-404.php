<?php
/**
 * Title: 404 Page
 * Slug: basse/template-404
 * Description: The page that shows when no other page is found.
 * Categories: basse/templates
 * Keywords: page not found, 404
 * Block Types:
 * Post Types:
 * Template Types: 404
 * Viewport Width: 1920
 * Inserter: false
 *
 * @package Basse
 * @since Basse 0.1.0
 */ 
?>

<!-- wp:group {"tagName":"main","style":{"spacing":{"padding":{"top":"var:preset|spacing|x-large","bottom":"var:preset|spacing|x-large"}},"dimensions":{"minHeight":"100vh"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center","verticalAlignment":"center"}} -->
<main class="wp-block-group" style="min-height:100vh;padding-top:var(--wp--preset--spacing--x-large);padding-bottom:var(--wp--preset--spacing--x-large)">
    <!-- wp:group {"layout":{"type":"constrained","contentSize":"580px"}} -->
    <div class="wp-block-group">
        <!-- wp:heading {"textAlign":"center","level":1} -->
        <h1 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Page not found', 'basse' ) ?></h1>
        <!-- /wp:heading -->

        <!-- wp:paragraph {"align":"center"} -->
        <p class="has-text-align-center"><?php esc_html_e( 'Sorry, the page you are looking for doesn’t exist or has been moved. Kindly go back to the ', 'basse' ) ?><a href="<?php echo esc_url( home_url( '/' ) ); ?>" data-type="page"><?php esc_html_e( 'homepage', 'basse' ) ?></a><?php esc_html_e( ' or try searching.', 'basse' ) ?></p>
        <!-- /wp:paragraph -->

        <!-- wp:search {"label":"Search","showLabel":false,"placeholder":"Enter search term...","width":85,"widthUnit":"%","buttonText":"Search","align":"center"} /-->
    </div>
    <!-- /wp:group -->
</main>
<!-- /wp:group -->