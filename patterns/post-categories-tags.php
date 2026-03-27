<?php
/**
 * Title: Post Categories and Tags
 * Slug: basse/post-categories-tags
 * Description: Single post categories and tags
 * Categories:
 * Keywords: categories, tags, post
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

<!-- wp:group {"className":"basse-pattern-post-categories-tags","style":{"spacing":{"blockGap":"0.5em"}},"layout":{"type":"default"}} -->
<div class="wp-block-group basse-pattern-post-categories-tags">
    <!-- wp:post-terms {"term":"category","prefix":"\u003cstrong\u003eCategories:\u003c/strong\u003e ","fontSize":"x-small"} /-->

    <!-- wp:post-terms {"term":"post_tag","prefix":"\u003cstrong\u003eTags:\u003c/strong\u003e ","fontSize":"x-small"} /-->
</div>
<!-- /wp:group -->