<?php
/**
 * Template name: About me
 *
 * The about me page template file
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
            <div class="row" data-equalizer>
                <div class="medium-4 columns about-me-picture" data-equalizer-watch> <?php
                    if (has_post_thumbnail()) :
                        the_post_thumbnail('newme-about');
                    else : ?>
                        <img src="http://lorempixel.com/800/800/cats" alt="<?php _e('A post thumbnail picture could be a good idea, no ?', 'newme'); ?>" /> <?php
                    endif; ?>
                </div>
                <div class="medium-8 columns content-wrapper" data-equalizer-watch>
                    <div class="content-body" >
                        <?php the_content(); ?>
                    </div>
                </div>
            </div> <?php

        endwhile;
    else :
        get_template_part('content', 'none');
    endif; ?>
    </div>
</section>

<?php get_footer(); ?>