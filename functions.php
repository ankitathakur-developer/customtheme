<?php 
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

register_nav_menus(
    array('primary-menu'=> 'Header',
    'footer-menu'=> 'Footer')
);


function mytheme_add_woocommerce_support() {
    add_theme_support( 'woocommerce' );
    }
    add_action( 'after_setup_theme', 'mytheme_add_woocommerce_support' );

    
    // Ensure the file is not accessed directly
    if ( ! defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly
    }
    



    // Function to enqueue styles
    function my_custom_theme_enqueue_styles() {
        // Enqueue the main stylesheet
        wp_enqueue_style( 'custom-style', get_stylesheet_uri() . '/style.css', array(), wp_get_theme()->get('Version') );
    }
    // Hook into the wp_enqueue_scripts action to enqueue styles
    add_action( 'wp_enqueue_scripts', 'my_custom_theme_enqueue_styles' );
  

// function testing(){
//     echo 'testing function file';
// }
// add_shortcode('show_code', 'testing');





//Modify the query 
function filter_products_by_multiple_categories($query) {
    if (!is_admin() && $query->is_main_query() && is_shop()) {
        $tax_query = array('relation' => 'AND');

        if (isset($_GET['category1']) && !empty($_GET['category1'])) {
            $tax_query[] = array(
                'taxonomy' => 'product_cat',
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_GET['category1']),
            );
        }

        if (isset($_GET['category2']) && !empty($_GET['category2'])) {
            $tax_query[] = array(
                'taxonomy' => 'product_tag',
                'field'    => 'slug',
                'terms'    => sanitize_text_field($_GET['category2']),
            );
        }

        if (count($tax_query) > 1) {
            $query->set('tax_query', $tax_query);
        }
    }
}
add_action('pre_get_posts', 'filter_products_by_multiple_categories');
