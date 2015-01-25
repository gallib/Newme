<?php
/**
 * Newme contact functions
 *
 * @package WordPress
 * @subpackage Newme
 * @since Newme 1.0
 */

if (!function_exists('newme_send_contact_form')) :
/**
 * Send form is valid
 *
 * @since  Newme 1.0
 */
function newme_send_contact_form()
{
    check_ajax_referer('ajax_contact_nonce', 'contact_nonce');

    $post = array_map('trim', filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING));

    $required_fields = array('name', 'email', 'subject', 'message');

    foreach ($required_fields as $key => $field) {
        if ($post[$field]) {
            unset($required_fields[$key]);
        }
    }

    if (!empty($required_fields)) {
        wp_send_json_error(array('required_fields' => $required_fields));
    }

    $name    = wp_strip_all_tags($post['name']);
    $email   = sanitize_email($post['email']);
    $subject = wp_strip_all_tags($post['subject']);
    $message = nl2br(stripslashes(wp_kses($post['message'], $post['message'])));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        wp_send_json_error(array('errors' => array('email' => __('Email is not valid', 'newme'))));
    }

    $admin_email = get_option('admin_email');

    $headers = array(
        'FROM: ' . sprintf(__('%s contact form', 'newme'), get_option('blogname'))  . ' <' . $admin_email . '>' . "\r\n"
    );

    $html = '
        <p><span style="font-weight:bold;">' . __('From', 'newme') . ': </span>' . $name . '</p>
        <p><span style="font-weight:bold;">' . __('Email', 'newme') . ': </span><a href="mailto:' . $email . '">' . $email . '</a></p>
        <p><span style="font-weight:bold;">' . __('Subject', 'newme') . ': </span>' . $subject . '</p>
        <p><span style="font-weight:bold;">' . __('Message', 'newme') . ':</span><br />' . $message . '</p>
    ';

    add_filter('wp_mail_content_type', create_function('', 'return "text/html";'));

    if (wp_mail($admin_email, sprintf(__('Contact request: %s', 'newme'), $subject), $html, $headers)) {
        wp_send_json_success(array('message' => __('Your message has been sent, thank you. We\'ll be in touch soon!', 'newme')));
    } else {
        wp_send_json_error();
    }
}
endif;
add_action('wp_ajax_contact_form', 'newme_send_contact_form');
add_action('wp_ajax_nopriv_contact_form', 'newme_send_contact_form');