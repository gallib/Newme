<?php
/**
 * The single post template file
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
        while (have_posts()) : the_post();

            get_template_part('content');

            if (comments_open() || get_comments_number()) :
            	comments_template();
			endif;

        endwhile;
    else :
        get_template_part('content', 'none');
    endif; ?>
    </div>
</section>

<?php get_footer(); ?>