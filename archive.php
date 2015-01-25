<?php
/**
 * The archive template file
 *
 * @package WordPress
 * @subpackage Newme
 * @since Newme 1.0
 */

get_header(); ?>

<section class="row content-wrapper">
    <div class="small-12 columns">

    <?php
    if (have_posts()) :
        while (have_posts()) : the_post(); ?>

            <div class="row">
                <div class="small-12 columns">
                <?php
                    the_title(sprintf('<h2 class="small-only-text-center"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>');
                ?>
                </div>
            </div>
            <div class="row">
                <div class="small-12 columns"> <?php
                    the_content(sprintf(
                        __('Continue reading %s', 'newme'),
                        get_the_title()
                    )); ?>
                </div>
            </div> <?php

        endwhile;
    else :
        get_template_part('content', 'none');
    endif; ?>
    </div>
</section>

<?php get_footer(); ?>