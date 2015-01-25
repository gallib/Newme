<?php
/**
 * The search content template file
 *
 * @package WordPress
 * @subpackage Newme
 * @since Newme 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('search-article'); ?>>
    <div class="row">
        <div class="small-12 columns">
        <?php the_title(sprintf('<h2 class="small-only-text-center"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
        </div>
    </div>
    <div class="row">
        <div class="small-12 columns">
            <?php the_content(); ?>
        </div>
    </div>
</article>