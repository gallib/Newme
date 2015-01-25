<?php
/**
 * Template name: Contact
 *
 * The contact page template file
 *
 * @package WordPress
 * @subpackage Newme
 * @since Newme 1.0
 */

get_header(); ?>

<section id="contact" class="row content-wrapper">
    <div class="small-12 columns">

    <?php
    if (have_posts()) :
        while (have_posts()) : the_post(); ?>

            <div class="row">
                <div class="small-12 columns">
                <?php the_title('<h1 class="small-only-text-center">', '</h1>'); ?>
                </div>
            </div>
            <div class="row">
                <div class="small-12 columns">
                    <?php the_content(); ?>
                </div>
            </div>
            <div class="contact-form-wrapper">
                <form id="contact-form" name="contact-form">
                    <?php wp_nonce_field('ajax_contact_nonce', 'contact_nonce'); ?>
                    <input type="hidden" id="action" name="action" value="contact_form" />
                    <div class="row">
                        <div class="medium-6 columns">
                            <label for="name"><?php _e('Your name', 'newme'); ?> *</label>
                            <input type="text" id="name" name="name" value="" placeholder="<?php _e('Name', 'newme'); ?>" required />
                        </div>
                        <div class="medium-6 columns">
                            <label for="email"><?php _e('Your email', 'newme'); ?> *</label>
                            <input type="email" id="email" name="email" value="" placeholder="<?php _e('Email', 'newme'); ?>" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 columns">
                            <label for="subject"><?php _e('Subject', 'newme'); ?> *</label>
                            <input type="text" id="subject" name="subject" value="" placeholder="<?php _e('Subject', 'newme'); ?>" required />
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 columns">
                            <label for="message"><?php _e('Your message', 'newme'); ?> *</label>
                            <textarea id="message" name="message" placeholder="<?php _e('Message', 'newme'); ?>" required></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="small-12 columns">
                            <input type="submit" id="submit" name="submit" class="button" value="<?php _e('Send', 'newme'); ?>" />
                        </div>
                    </div>
                </form>
            </div> <?php

        endwhile;
    else :
        get_template_part('content', 'none');
    endif; ?>
    </div>
</section>

<?php get_footer(); ?>