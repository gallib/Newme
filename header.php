<?php
/**
 * The template for displaying the header
 *
 * @package WordPress
 * @subpackage Newme
 * @since Newme 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <link rel="shortcut icon" href="<?php echo newme_get_image_directory_uri(); ?>/images/favicon.ico" />
    <!--[if lt IE 9]>
    <script src="<?php echo esc_url(get_template_directory_uri()); ?>/js/html5.js"></script>
    <![endif]-->
    <script>(function(){document.documentElement.className='js'})();</script>
    <link href="http://fonts.googleapis.com/css?family=Raleway:600" rel="stylesheet" type="text/css" />
    <link href="http://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet" type="text/css" />
    <?php wp_head(); ?>
    <style type="text/css">body{background: <?php echo newme_get_page_background_color(); ?>;}</style>
</head>

<?php newme_get_page_background_color(); ?>

<body <?php body_class(); ?>>
<header class="fixed">
    <nav class="top-bar" data-topbar role="navigation">
        <ul class="title-area">
            <li class="name">
                <a href="<?php echo get_home_url(); ?>"><img src="<?php echo newme_get_image_directory_uri(); ?>/logo.png" alt="Alain Pellaux" /></a>
            </li>
            <li class="toggle-topbar menu-icon"><a href="#"><span><?php _e('Menu', 'newme'); ?></span></a></li>
        </ul>

        <section class="top-bar-section">
            <?php newme_main_nav(); ?>
        </section>
    </nav>
</header>
