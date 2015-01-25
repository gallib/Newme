<?php
/**
 * The main page template file
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
                <?php the_title('<h1 class="small-only-text-center">', '</h1>'); ?>
                </div>
            </div>
            <div class="row">
                <div class="small-12 columns">
                    <?php the_content(); ?>
                </div>
            </div> <?php

        endwhile;
    else :
        get_template_part('content', 'none');
    endif; ?>
    </div>
</section>

<?php get_footer(); ?>