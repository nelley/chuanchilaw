<?php
/**
 * Chuan Chi theme functions and definitions
 */

/**
 * load the CSS from parent theme
 */
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );

function enqueue_parent_styles() {
   wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

/**
 * remove the admin bar for all users
 */
show_admin_bar(false);

/**
 * remove filters from parent theme
 */
add_action( 'init', 'remove_nav_ellip_filter' );

function remove_nav_ellip_filter() {
    remove_filter( 'wp_nav_menu', 'twentynineteen_add_ellipses_to_nav' );
    /* remove the ellipses of nav-menu */
    remove_filter( 'walker_nav_menu_start_el', 'twentynineteen_nav_menu_social_icons' );
    /* remove the svg icons of social menu */
}

