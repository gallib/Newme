<?php
/**
 * The 404 not found template file
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
                <p><?php _e('Sorry but there is nothing here...', 'newme'); ?></p>
                <?php get_search_form(); ?>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>