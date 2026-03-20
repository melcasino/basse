<?php
/**
 * Title: Archive Heading 1
 * Slug: basse/hero-archive-heading-1
 * Description: An archive heading and basic hero section with archive title and term description.
 * Categories: query, basse/sections
 * Keywords: archive header, header, hero, heading
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

<!-- wp:group {"tagName":"header","metadata":{"categories":["posts","basse/sections"],"patternName":"basse/hero-archive-heading-1"},"align":"full","className":"basse-pattern-archive-heading-1","style":{"spacing":{"padding":{"top":"var:preset|spacing|x-large","bottom":"var:preset|spacing|x-large"}}},"backgroundColor":"neutral-50","layout":{"type":"constrained"}} -->
<header class="wp-block-group alignfull basse-pattern-archive-heading-1 has-neutral-50-background-color has-background" style="padding-top:var(--wp--preset--spacing--x-large);padding-bottom:var(--wp--preset--spacing--x-large)">
    <!-- wp:query-title {"type":"archive","textAlign":"center","showPrefix":false} /-->

    <!-- wp:term-description {"textAlign":"center"} /-->
</header>
<!-- /wp:group -->