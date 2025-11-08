<?php
/**
 * Title: Footer
 * Slug: basse/footer
 * Categories: footer
 * Block Types: core/template-part/footer
 * Viewport Width: 1920
 * Description: Footer with logo, site tile, navigation and social links
 *
 * @package Basse
 * @since Basse 0.1.0
 */  
?>

<!-- wp:group {"metadata":{"name":"Footer 1"},"align":"full","className":"basse-pattern-footer-1","style":{"spacing":{"blockGap":"0"},"elements":{"link":{"color":{"text":"var:preset|color|white"}}}},"backgroundColor":"black","textColor":"white","layout":{"type":"constrained"}} -->
<div class="wp-block-group alignfull basse-pattern-footer-1 has-white-color has-black-background-color has-text-color has-background has-link-color">
    <!-- wp:paragraph {"align":"center","style":{"spacing":{"padding":{"top":"var:preset|spacing|x-large","bottom":"var:preset|spacing|large"}}},"fontSize":"x-small"} -->
    <p class="has-text-align-center has-x-small-font-size" style="padding-top:var(--wp--preset--spacing--x-large);padding-bottom:var(--wp--preset--spacing--large)"><a href="#header" data-type="internal" data-id="#header">Back to Top</a></p>
    <!-- /wp:paragraph -->

    <!-- wp:columns {"verticalAlignment":"center","align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|large"}},"border":{"top":{"color":"var:preset|color|white","style":"dotted","width":"1px"}}}} -->
    <div class="wp-block-columns alignwide are-vertically-aligned-center" style="border-top-color:var(--wp--preset--color--white);border-top-style:dotted;border-top-width:1px;padding-top:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--large)">
        <!-- wp:column {"verticalAlignment":"center","width":"15%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:15%">
            <!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|small"}},"layout":{"type":"flex","flexWrap":"nowrap","justifyContent":"center"}} -->
            <div class="wp-block-group">
                <!-- wp:site-logo {"style":{"layout":{"selfStretch":"fixed","flexSize":"48px"}}} /-->

                <!-- wp:site-title {"level":0,"style":{"typography":{"fontStyle":"normal","fontWeight":"600"}},"fontSize":"medium"} /-->
            </div>
            <!-- /wp:group -->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center","width":"70%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:70%">
            <!-- wp:navigation {"ref":8,"overlayMenu":"never","layout":{"type":"flex","justifyContent":"center"}} /-->
        </div>
        <!-- /wp:column -->

        <!-- wp:column {"verticalAlignment":"center","width":"15%"} -->
        <div class="wp-block-column is-vertically-aligned-center" style="flex-basis:15%">
            <!-- wp:social-links {"iconColor":"black","iconColorValue":"var:preset|color|black","iconBackgroundColor":"white","iconBackgroundColorValue":"var:preset|color|white","openInNewTab":true,"style":{"spacing":{"blockGap":{"left":"var:preset|spacing|medium"}}},"layout":{"type":"flex","justifyContent":"center","flexWrap":"nowrap"}} -->
            <ul class="wp-block-social-links has-icon-color has-icon-background-color">
                <!-- wp:social-link {"url":"#0","service":"github","label":"GitHub"} /-->

                <!-- wp:social-link {"url":"#0","service":"dribbble","label":"Dribbble"} /-->

                <!-- wp:social-link {"url":"#0","service":"wordpress","label":"WordPress"} /-->
            </ul>
            <!-- /wp:social-links -->
        </div>
        <!-- /wp:column -->
    </div>
    <!-- /wp:columns -->

    <!-- wp:group {"align":"wide","style":{"spacing":{"padding":{"top":"var:preset|spacing|large","bottom":"var:preset|spacing|x-large"},"blockGap":"var:preset|spacing|small"}},"layout":{"type":"default"}} -->
    <div class="wp-block-group alignwide" style="padding-top:var(--wp--preset--spacing--large);padding-bottom:var(--wp--preset--spacing--x-large)">
        <!-- wp:paragraph {"align":"center","fontSize":"x-small"} -->
        <p class="has-text-align-center has-x-small-font-size"><a href="#0">Terms</a> | <a href="#0">Privacy</a></p>
        <!-- /wp:paragraph -->
         
        <!-- wp:paragraph {"align":"center","fontSize":"x-small"} -->
        <p class="has-text-align-center has-x-small-font-size">© 2025. Copyright Statement</p>
        <!-- /wp:paragraph -->
    </div>
    <!-- /wp:group -->
</div>
<!-- /wp:group -->