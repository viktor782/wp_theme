<?php

require dirname(__FILE__) . '/init/posttypes.php';
require dirname(__FILE__) . '/init/metabox.php';
require dirname(__FILE__) . '/init/costume_tax_taxonomy_image.php';
require dirname(__FILE__) . '/init/costume_rent_taxonomy_image.php';
require dirname(__FILE__) . '/init/taxonomy_show_in_menu.php';
require dirname(__FILE__) . '/init/shortcodes.php';

register_nav_menus( array(
    'primary' => 'Primary'
) );

if ( function_exists('register_sidebar') )
{
    register_sidebars(1, array(
        'id' => 'widget-header-left-top',
        'name' => 'Header left top',
        'description' => '',
        'before_widget' => '<div class="widget widget-header-left-top">',
        'after_widget' => '</div>',
        'before_title' => '<span class="widget-title">',
        'after_title' => '</span>'
    ));
    
    register_sidebars(1, array(
        'id' => 'widget-header-right-top',
        'name' => 'Header right top',
        'description' => '',
        'before_widget' => '<div class="widget widget-header-right-top">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => ''
    ));
    
    register_sidebars(1, array(
        'id' => 'widget-header-menu',
        'name' => 'Header mobile menu',
        'description' => '',
        'before_widget' => '<ul class="menu-top">',
        'after_widget' => '</ul>',
        'before_title' => '',
        'after_title' => ''
    ));
    
    register_sidebars(1, array(
        'id' => 'widget-header-middle',
        'name' => 'Header header middle',
        'description' => '',
        'before_widget' => '<div class="widget widget-header-middle">',
        'after_widget' => '</div>',
        'before_title' => '',
        'after_title' => ''
    ));
    
    
    register_sidebars(1, array(
        'id' => 'footer',
        'name' => 'Footer',
        'description' => '',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));
    
    register_sidebars(1, array(
        'id' => 'store-top',
        'name' => 'Store top',
        'description' => '',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '',
        'after_title' => ''
    ));
        
}
if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
	//add_theme_support( 'woocommerce' );
        set_post_thumbnail_size( 150, 150 ); // default Post Thumbnail dimensions   
}

if ( function_exists( 'add_image_size' ) ) { 
    //add_image_size( 'rev_photo', 148, 148, true ); 
}

function custom_excerpt_more( $more ) {
	return ' ...';
}
add_filter( 'excerpt_more', 'custom_excerpt_more' );
function custom_excerpt_length( $length ) {
	return 200;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function add_theme_scripts(){
    wp_enqueue_script("jquery");
    wp_enqueue_script( 'swiper', get_template_directory_uri() . '/js/swiper.min.js', array('jquery') );
    wp_enqueue_script( 'fancybox', get_template_directory_uri() . '/js/fancybox.umd.js', array('jquery') );
    wp_enqueue_script( 'init', get_template_directory_uri() . '/js/init.js', array('jquery', 'swiper') );
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

function add_theme_style(){
    //wp_enqueue_style( 'fonts', get_template_directory_uri() . '/fonts/stylesheet.css');
    wp_enqueue_style( 'swiper', get_template_directory_uri() . '/css/swiper.min.css');
    wp_enqueue_style( 'fancybox', get_template_directory_uri() . '/css/fancybox.css');
    wp_enqueue_style( 'slider', get_template_directory_uri() . '/css/slider.css');
    wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style( 'mediacss', get_template_directory_uri() . '/css/media.css');
}
add_action( 'wp_enqueue_scripts', 'add_theme_style' );

function posts_ordering($query)
{
    $query->set( 'orderby', 'id' );
    $query->set( 'order', 'DESC' );
}
add_action('pre_get_posts', 'posts_ordering');

// Costume tags links
function getAnimalsLink() {
    $termId = 42;
    switch (pll_current_language()) {
        case 'en':
            $termId = 46;
            break;
        case 'ru':
            $termId = 44;
            break;
    }
    return get_term_link($termId, 'costume_tags');
}

function getCartoonsLink() {
    $termId = 54;
    switch (pll_current_language()) {
        case 'en':
            $termId = 60;
            break;
        case 'ru':
            $termId = 58;
            break;
    }
    return get_term_link($termId, 'costume_tags');
}

function getCircusCostumesLink() {
    $termId = 78;
    switch (pll_current_language()) {
        case 'en':
            $termId = 76;
            break;
        case 'ru':
            $termId = 80;
            break;
    }
    return get_term_link($termId, 'costume_tags');
}

function getCorporateMascotsLink() {
    $termId = 84;
    switch (pll_current_language()) {
        case 'en':
            $termId = 86;
            break;
        case 'ru':
            $termId = 82;
            break;
    }
    return get_term_link($termId, 'costume_tags');
}

function getCostumeAccessoryCollectionsLink() {
    $termId = 94;
    switch (pll_current_language()) {
        case 'en':
            $termId = 98;
            break;
        case 'ru':
            $termId = 96;
            break;
    }
    return get_term_link($termId, 'costume_tags');
}

function getCostumesInTheFormOfFoodLink() {
    $termId = 92;
    switch (pll_current_language()) {
        case 'en':
            $termId = 88;
            break;
        case 'ru':
            $termId = 90;
            break;
    }
    return get_term_link($termId, 'costume_tags');
}

function getHalloweenLink() {
    $termId = 69;
    switch (pll_current_language()) {
        case 'en':
            $termId = 74;
            break;
        case 'ru':
            $termId = 72;
            break;
    }
    return get_term_link($termId, 'costume_tags');
}

function getNewYearLink() {
    $termId = 62;
    switch (pll_current_language()) {
        case 'en':
            $termId = 67;
            break;
        case 'ru':
            $termId = 65;
            break;
    }
    return get_term_link($termId, 'costume_tags');
}

function getSuperheroesLink() {
    $termId = 48;
    switch (pll_current_language()) {
        case 'en':
            $termId = 52;
            break;
        case 'ru':
            $termId = 50;
            break;
    }
    return get_term_link($termId, 'costume_tags');
}
add_filter('woocommerce_add_to_cart_fragments', 'header_add_to_cart_fragment');

function header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    ob_start();
    ?>
    <span class="basket-btn__counter">(<?php echo sprintf($woocommerce->cart->cart_contents_count); ?>)</span>
    <?php
    $fragments['.basket-btn__counter'] = ob_get_clean();
    return $fragments;
}

remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
add_action( 'after_setup_theme', 'viv_setup' );

function viv_setup() {
    add_theme_support( 'woocommerce' );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
}

// Убрать сортировку товаров
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );


add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
  
function custom_override_checkout_fields( $fields ) {
  //unset($fields['billing']['billing_first_name']);// имя
  //unset($fields['billing']['billing_last_name']);// фамилия
  unset($fields['billing']['billing_company']); // компания
  unset($fields['billing']['billing_address_1']);//
  unset($fields['billing']['billing_address_2']);//
  unset($fields['billing']['billing_city']);
  unset($fields['billing']['billing_postcode']);
  unset($fields['billing']['billing_country']);
  unset($fields['billing']['billing_state']);
  //unset($fields['billing']['billing_phone']);
  unset($fields['order']['order_comments']);
  unset($fields['billing']['billing_email']);
  //unset($fields['account']['account_username']);
  //unset($fields['account']['account_password']);
  //unset($fields['account']['account_password-2']);
  unset($fields['shipping']['shipping_country']);
  unset($fields['shipping']['shipping_first_name']);
unset($fields['shipping']['shipping_last_name']);
unset($fields['shipping']['shipping_company']);
unset($fields['shipping']['shipping_address_1']);
unset($fields['shipping']['shipping_address_2']);
unset($fields['shipping']['shipping_city']);
unset($fields['shipping']['shipping_postcode']);
unset($fields['shipping']['shipping_state']);


    return $fields;
}