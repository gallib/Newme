<?php
/**
 * Newme functions and definitions
 *
 * @package WordPress
 * @subpackage Newme
 * @since Newme 1.0
 */

// add functions located functions folders
include get_template_directory() . '/functions/theme-contact.php';
include get_template_directory() . '/functions/theme-menu.php';
include get_template_directory() . '/functions/theme-options.php';

if (!function_exists('newme_setup')) :
/**
 * Sets up theme
 *
 * @since Newme 1.0
 */
function newme_setup() {
    // Load text domain
    load_theme_textdomain('newme', get_template_directory() . '/languages');

    // Enable post thumbnails
    add_theme_support('post-thumbnails');

    // set post thumbnails size
    add_image_size('newme-about', 800, 800, true);

    // WordPress manage the title for us
    add_theme_support('title-tag');

    // remove accents in filename
    add_filter('sanitize_file_name', 'remove_accents');

    // enable menu in backoffice
    register_nav_menus(
        array(
            'main-nav' => __('The Main Menu', 'newme'),
        )
    );
}
endif;
add_action('after_setup_theme', 'newme_setup');

if (!function_exists('newme_get_image_directory_uri')) :
/**
 * Return image directory uri
 *
 * @since  Newme 1.0
 *
 * @return string
 */
function newme_get_image_directory_uri()
{
    return get_template_directory_uri() . '/images';
}
endif;

if (!function_exists('newme_enqueue_scripts')) :
/**
 * Enqueue styles and scripts
 *
 * @since Newme 1.0
 */
function newme_enqueue_scripts()
{
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', get_template_directory_uri() . '/bower_components/jquery/dist/jquery.min.js', array(), '', true);
    }

    wp_register_style(
        'newme-fontawesome-style',
        get_template_directory_uri() . '/assets/font-awesome/css/font-awesome.min.css'
    );

    wp_register_style(
        'newme-foundation-style',
        get_template_directory_uri() . '/css/'. (!defined(WP_DEBUG) || !WP_DEBUG ? '' : 'min/') .'app.css'
    );

    wp_register_style(
        'newme-style',
        get_template_directory_uri() . '/css/'. (!defined(WP_DEBUG) || !WP_DEBUG ? '' : 'min/') .'style.css',
        array('newme-fontawesome-style', 'newme-foundation-style')
    );

    wp_enqueue_style('newme-style');

    wp_register_script(
        'newme-modernizr',
        get_template_directory_uri() . '/bower_components/modernizr/modernizr.js'
    );

    wp_register_script(
        'newme-foundation-js',
        get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.js', array('jquery'),
        false,
        true
    );

    wp_register_script(
        'newme-foundation-topbar',
        get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.topbar.js',
        array('newme-foundation-js'),
        false,
        true
    );

    wp_register_script(
        'newme-foundation-equalizer',
        get_template_directory_uri() . '/bower_components/foundation/js/foundation/foundation.equalizer.js',
        array('newme-foundation-js'),
        false,
        true
    );

    wp_register_script(
        'newme-app',
        get_template_directory_uri() . '/js/app.js',
        array('newme-foundation-js'),
        false,
        true
    );

    wp_enqueue_script('jquery');
    wp_enqueue_script('newme-modernizr');
    wp_enqueue_script('newme-foundation-topbar');
    wp_enqueue_script('newme-foundation-equalizer');
    wp_enqueue_script('newme-app');

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    // app.js variables
    $data = array(
        'ajax_url'                => admin_url('admin-ajax.php'),
        'menu_back'               => __('Back', 'newme'),
        'contact_mandatory_field' => __('This field is mandatory.', 'newme')
    );

    wp_localize_script('newme-app', 'newme', $data);
}
endif;
add_action('wp_enqueue_scripts', 'newme_enqueue_scripts');

if (!function_exists('newme_remove_thumbnail_dimensions')) :
/**
 * Remove hardcoded width/height from post thumbnail
 *
 * @since  Newme 1.0
 *
 * @param  string  $html
 * @param  integer $post_id
 * @param  integer $post_image_id
 *
 * @return string
 */
function newme_remove_thumbnail_dimensions($html, $post_id, $post_image_id) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );

    return $html;
}
endif;
add_filter( 'post_thumbnail_html', 'newme_remove_thumbnail_dimensions', 10, 3);

if (!function_exists('newme_get_background_colors')) :
/**
 * Get background colors
 *
 * @since  Newme 1.0
 *
 * @return array
 */
function newme_get_background_colors()
{
    return array(
        '#19b5fe' => __('Blue', 'newme'),
        '#03c9a9' => __('Cyan', 'newme'),
        '#9b59b6' => __('Violet', 'newme'),
        '#c0392b' => __('Red', 'newme'),
        '#d35400' => __('Orange', 'newme')

    );
}
endif;

if (!function_exists('newme_get_page_background_color')) :
/**
 * Get background color for a page
 *
 * @since  Newme 1.0
 *
 * @return string
 */
function newme_get_page_background_color()
{
    $page_id = get_queried_object_id();
    $color   = get_post_meta($page_id, '_newme_background_color', true);

    if (is_404()) {
        $color = '#c0392b';
    } else if (is_search()) {
        $color = '#d35400';
    } else if (!$color) {
        $colors = newme_get_background_colors();
        $color  = key($colors);
    }

    return $color;
}
endif;

if (!function_exists('newme_entry_meta')) :
/**
 * Print html meta information like date, tags, categories
 *
 * @since  Newme 1.0
 */
function newme_entry_meta()
{
    if (get_post_type() == 'post') {
        echo '<span><i class="fa fa-clock-o"></i> ' . get_the_date() . ' </span>';

        printf(
            '<span><i class="fa fa-user"></i><a href="%s">%s</a></span>',
            esc_url(get_author_posts_url(get_the_author_meta('ID'))),
            get_the_author()
        );

        $categories_list = get_the_category_list(', ');
        if ($categories_list) {
            printf(
                '<span><i class="fa fa-tags"></i>%s</span>',
                $categories_list
            );
        }

        $tags_list = get_the_tag_list('', ', ');
        if ($tags_list) {
            printf(
                '<span><i class="fa fa-folder-open"></i>%s</span>',
                $tags_list
            );
        }
    }
}
endif;

if (!function_exists('newme_comment_nav')) :
/**
 * Display comment navigation
 *
 * @since Newme 1.0
 */
function newme_comment_nav() {
    if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
        <nav class="navigation comment-navigation" role="navigation">
            <div class="nav-links">
                <?php
                $prev_link = get_previous_comments_link(__('Older Comments', 'newme'));
                if ($prev_link) :
                    printf( '<span class="nav-previous">%s</span>', $prev_link);
                endif;

                $next_link = get_next_comments_link(__('Newer Comments', 'newme'));
                if ($next_link) :
                    printf( '<span class="nav-next">%s</span>', $next_link );
                endif;
                ?>
            </div>
        </nav>
        <?php
    endif;
}
endif;

if (!function_exists('newme_adapt_comment_form')) :
function newme_adapt_comment_form($args)
{
    $args['class_submit'] = 'button';

    return $args;
}
endif;
add_filter('comment_form_defaults', 'newme_adapt_comment_form');