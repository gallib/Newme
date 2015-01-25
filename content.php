<?php
/**
 * The content template file
 *
 * @package WordPress
 * @subpackage Newme
 * @since Newme 1.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>
    <div class="row">
        <div class="small-12 columns">
        <?php
            if (is_single()) :
                the_title('<h1 class="small-only-text-center">', '</h1>');
            else :
                the_title(sprintf('<h2 class="small-only-text-center"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
            endif;
        ?>
            <p class="article-entry-meta"><?php newme_entry_meta(); ?></p>
        </div>
    </div>
    <div class="row">
        <div class="small-12 columns"> <?php
            the_content(sprintf(
                __('Continue reading %s', 'newme'),
                get_the_title()
            )); ?>
        </div>
    </div>
</article>