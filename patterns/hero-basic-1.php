<?php
/**
 * Title: Hero Basic 1
 * Slug: basse/hero-basic-1
 * Description: A basic hero section with heading and a sub-heading.
 * Categories: basse/sections
 * Keywords: page header, header, hero, heading
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

<!-- wp:group {"tagName":"header","align":"full","className":"basse-pattern-hero-basic-1","style":{"spacing":{"padding":{"top":"var:preset|spacing|x-large","bottom":"var:preset|spacing|x-large"}}},"backgroundColor":"neutral-50","layout":{"type":"constrained"}} -->
<header class="wp-block-group alignfull basse-pattern-hero-basic-1 has-neutral-50-background-color has-background" style="padding-top:var(--wp--preset--spacing--x-large);padding-bottom:var(--wp--preset--spacing--x-large)">
    <!-- wp:heading {"textAlign":"center","level":1} -->
    <h1 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Our latest blog articles', 'basse' ) ?></h1>
    <!-- /wp:heading -->

    <!-- wp:paragraph {"align":"center","style":{"spacing":{"margin":{"top":"var:preset|spacing|small"}}},"fontSize":"medium"} -->
    <p class="has-text-align-center has-medium-font-size" style="margin-top:var(--wp--preset--spacing--small)"><?php esc_html_e( 'Learn the latest and greatest in WordPress site building. Checkout tutorials, tips and tricks, and video walkthroughs on our blog.', 'basse' ) ?></p>
    <!-- /wp:paragraph -->
</header>
<!-- /wp:group -->