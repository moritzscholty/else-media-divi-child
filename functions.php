<?php
/**
 * else.media's Divi Child Starterkit
 * functions.php
 *
 * ===== NOTES ==================================================================
 *
 * Unlike style.css, the functions.php of a child theme does not override its
 * counterpart from the parent. Instead, it is loaded in addition to the parent's
 * functions.php. (Specifically, it is loaded right before the parent's file.)
 *
 * In that way, the functions.php of a child theme provides a smart, trouble-free
 * method of modifying the functionality of a parent theme.
 *
 *
 * =============================================================================== */

// child theme styles
function divichild_enqueue_scripts() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'divichild_enqueue_scripts' );

// login form styles
function custom_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_stylesheet_directory_uri() . '/admin.css' );
}
add_action( 'login_enqueue_scripts', 'custom_login_stylesheet' );

// backend styles
function load_custom_wp_admin_style(){
    wp_register_style( 'custom_wp_admin_css', get_bloginfo('stylesheet_directory') . '/admin.css', false, '1.0.0' );
    wp_enqueue_style( 'custom_wp_admin_css' );
}
add_action('admin_enqueue_scripts', 'load_custom_wp_admin_style');

// backend styles themes
function elsemedia_admin_color_scheme() {
  //Get the theme directory
  $theme_dir = get_stylesheet_directory_uri();

  // else.media
  wp_admin_css_color( 'elsemedia', __( 'elsemedia' ),
    $theme_dir . '/admin.css',
    array( '#23282d', '#fff', '#d54e21' , '#657a84')
  );
}
add_action('admin_init', 'elsemedia_admin_color_scheme');

// backend styles default avatar
add_filter( 'avatar_defaults', 'mytheme_default_avatar' );
function mytheme_default_avatar( $avatar_defaults )
{
    $avatar = get_option('avatar_default');

    $new_avatar_url = get_stylesheet_directory_uri() . '/assets/images/admin.png';

    if( $avatar != $new_avatar_url )
    {
        update_option( 'avatar_default', $new_avatar_url );
    }

    $avatar_defaults[ $new_avatar_url ] = 'else.media Avatar';
    return $avatar_defaults;
}
