<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

// Function to enqueue parent and child styles
if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        // Enqueue parent style
        wp_enqueue_style( 'oceanwp-parent-style', get_template_directory_uri() . '/style.css' );
        
        // Enqueue child style
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'oceanwp-parent-style' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

// END ENQUEUE PARENT ACTION

/*  concerne la mise en forme du formulaire contact*/ 
add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array('parent-style') );
}
/*  pour l'affichage du lien Admine*/
// Ajout d'une fonction pour filtrer les éléments du menu
function filter_menu_items($items, $args) {
    // Vérifie si l'utilisateur est connecté
    if (is_user_logged_in()) {
        // Renvoie les éléments du menu tels quels si l'utilisateur est connecté
        return $items;
    } else {
        // Parcourt les éléments du menu
        foreach ($items as $key => $item) {
            // Vérifie si le lien est celui de l'admin
            if ($item->title == 'Admin') {
                // Supprime l'élément du menu si l'utilisateur n'est pas connecté
                unset($items[$key]);
            }
        }
        // Renvoie les éléments filtrés du menu
        return $items;
    }
}
add_filter('wp_nav_menu_objects', 'filter_menu_items', 10, 2);