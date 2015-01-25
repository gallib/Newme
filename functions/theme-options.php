<?php
/**
 * Newme options functions
 *
 * @package WordPress
 * @subpackage Newme
 * @since Newme 1.0
 */

if (!function_exists('newme_background_color_meta_box')) :
    /**
     * Create the background color meta box
     *
     * @since Newme 1.0
     */
    function newme_background_color_meta_box()
    {
        $screens = array('post', 'page');

        foreach($screens as $screen) {
            add_meta_box(
                'newme_background_color',
                __('Background color', 'newme'),
                'newme_background_color_meta_box_callback',
                $screen,
                'side'
            );
        }

    }
endif;
add_action('add_meta_boxes', 'newme_background_color_meta_box');

if (!function_exists('newme_background_color_meta_box_callback')) {
    /**
     * Add background color meta box
     *
     * @since  Newme 1.0
     *
     * @param  WP_Post $post
     */
    function newme_background_color_meta_box_callback($post)
    {
        wp_nonce_field('newme_background_color_meta_box', 'newme_background_color_meta_box_nonce');

        $colors = newme_get_background_colors();

        $color  = get_post_meta($post->ID, '_newme_background_color', true);

        ?>

        <table class="form-table">
            <tr class="form-field">
                <th scope="row">
                    <label for="newme_background_color"><?php _e('Color', 'newme'); ?></label>
                </th>
                <td>
                    <select id="newme_background_color" name="newme_background_color"> <?php
                        foreach ($colors as $color_id => $color_name) : ?>
                            <option <?php echo $color_id == $color ? 'selected="selected" ' : ''; ?>value="<?php echo $color_id; ?>"><?php echo $color_name; ?></option> <?php
                        endforeach;

                        ?>
                    </select>
                </td>
            </tr>
        </table>

        <?php
    }
}

if (!function_exists('newme_save_background_color_meta_box')) {
    /**
     * Save the background color meta box
     *
     * @since  Newme 1.0
     *
     * @param  integer $post_id
     */
    function newme_save_background_color_meta_box($post_id)
    {
        if (!isset($_POST['newme_background_color_meta_box_nonce']) || !wp_verify_nonce($_POST['newme_background_color_meta_box_nonce'], 'newme_background_color_meta_box')) {
            return;
        }

        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return;
        }

        if (!current_user_can('edit_post', $post_id)) {
            return;
        }

        $color = sanitize_text_field($_POST['newme_background_color']);

        update_post_meta($post_id, '_newme_background_color', $color);
    }
}
add_action('save_post', 'newme_save_background_color_meta_box');
