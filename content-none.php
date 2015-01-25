<?php
/**
 * The template shown when no post is found
 *
 * @package WordPress
 * @subpackage Newme
 * @since Newme 1.0
 */

get_header(); ?>

<section class="row content-wrapper">
    <div class="small-12 columns">
        <div class="row">
            <div class="small-12 columns">
                <h1><?php _e('Content not found', 'newme'); ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="small-12 columns">
                <p> <?php
                if (is_search()) :
                    _e('Sorry but nothing matched with your search. Maybe try with other keywords ?', 'newme');
                else :
                    _e('Sorry but we can\'t find what you were looking for.', 'newme');
                endif; ?>
                </p>
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
