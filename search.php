<?php
/**
 * The search template file
 *
 * @package WordPress
 * @subpackage Newme
 * @since Newme 1.0
 */

get_header(); ?>

<section class="row content-wrapper">
    <div class="small-12 columns">

    <?php
    if (have_posts()) : ?>

        <h1><?php printf(__('Search Results for: %s', 'newme'), get_search_query()); ?></h1> <?php

        while (have_posts()) : the_post();

            get_template_part('content', 'search');

        endwhile;

        the_posts_pagination(
            array(
                'prev_text' => __('Previous page', 'newme'),
                'next_text' => __('Next page', 'newme'),
            )
        );
    else :
        get_template_part('content', 'none');
    endif; ?>
    </div>
</section>

<?php get_footer(); ?>