<?php
/**
 * The search form template file
 *
 * @package WordPress
 * @subpackage Newme
 * @since Newme 1.0
 */
?>

<div class="row">
    <div class="medium-8 large-6 columns">
        <form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
            <label for="search-field"><?php _e('Try a search', 'newme'); ?>:</label>
            <input type="search" id="search-field" class="search-field" placeholder="<?php _e('Search', 'newme') ?>" value="<?php echo get_search_query() ?>" name="s" />
            <input type="submit" class="button" value="<?php _e('Search', 'newme') ?>" />
        </form>
    </div>
</div>
