<?php
/**
 * Newme menu functions
 *
 * @package WordPress
 * @subpackage Newme
 * @since Newme 1.0
 */

if (!function_exists('newme_main_nav')) :
    /**
     * Get main menu
     *
     * @since  Newme 1.0
     */
    function newme_main_nav()
    {
        wp_nav_menu(array(
            'container'       => false,
            'container_class' => '',
            'menu'            => __('The Main Menu', 'newme'),
            'menu_class'      => 'right',
            'theme_location'  => 'main-nav',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
        ));
    }
endif;

if (!function_exists('newme_nav_menu_item_parent_classing')) :
    /**
     * Add "has-dropdown" CSS class to navigation menu items that have children in a submenu.
     * Source: http://jointswp.com/
     *
     * @since Newme 1.0
     *
     * @param  array  $classes
     * @param  object $item
     * @return array
     */
    function newme_nav_menu_item_parent_classing($classes, $item)
    {
        global $wpdb;

        $sql = 'SELECT COUNT(meta_id) FROM ' . $wpdb->prefix . 'postmeta WHERE meta_key=\'_menu_item_menu_item_parent\' AND meta_value=\'' . $item->ID . '\'';

        $has_children = $wpdb->get_var($sql);

        if ( $has_children > 0 ) {
            $classes[] = 'has-dropdown';
        }

        return $classes;
    }
endif;
add_filter('nav_menu_css_class', 'newme_nav_menu_item_parent_classing', 10, 2);

if (!function_exists('newme_change_submenu_class')) :
/**
 * Deletes empty classes and changes the sub menu class name
 * Source: http://jointswp.com/
 *
 * @since Newme 1.0
 *
 * @param  string $menu
 * @return string
 */
function newme_change_submenu_class($menu)
{
    $menu = preg_replace('/ class="sub-menu"/',' class="dropdown"',$menu);
    return $menu;
}
endif;
add_filter('wp_nav_menu','newme_change_submenu_class');

if (!function_exists('newme_active_nav_class')) :
/**
 * Use the active class of the ZURB Foundation for the current menu item.
 * Source http://jointswp.com/
 *
 * @since Newme 1.0
 *
 * @param  array  $classes
 * @param  object $item
 * @return array
 */
function newme_active_nav_class($classes, $item)
{
    if ( $item->current == 1 || $item->current_item_ancestor == true ) {
        $classes[] = 'active';
    }
    return $classes;
}
endif;
add_filter('nav_menu_css_class', 'newme_active_nav_class', 10, 2);
