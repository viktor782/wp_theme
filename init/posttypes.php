<?php
function cptui_register_my_cpts_costume() {

    /**
     * Post Type: Костюмы.
     */

    $labels = [
        "name" => __( "Костюмы", "custom-post-type-ui" ),
        "singular_name" => __( "Костюм", "custom-post-type-ui" ),
    ];

    $args = [
        "label" => __( "Костюмы", "custom-post-type-ui" ),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => false,
        "rewrite" => [ "slug" => "costume", "with_front" => true ],
        "query_var" => true,
        "supports" => [ "title", "editor", "thumbnail", "custom-fields" ],
        "taxonomies" => [ "costume_tax", "costume_tags" ],
        "show_in_graphql" => false,
    ];

    register_post_type( "costume", $args );
}

add_action( 'init', 'cptui_register_my_cpts_costume' );


function cptui_register_my_taxes_costume_tax() {

    /**
     * Taxonomy: Категории костюмов.
     */

    $labels = [
        "name" => __( "Категории костюмов", "custom-post-type-ui" ),
        "singular_name" => __( "Категория костюма", "custom-post-type-ui" ),
    ];


    $args = [
        "label" => __( "Категории костюмов", "custom-post-type-ui" ),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => [ 'slug' => 'costume_tax', 'with_front' => true, ],
        "show_admin_column" => false,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "costume_tax",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => false,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "costume_tax", [ "costume" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_costume_tax' );

function cptui_register_my_taxes_costume_tags() {

    /**
     * Taxonomy: Теги костюмов.
     */

    $labels = [
        "name" => __( "Теги костюмов", "custom-post-type-ui" ),
        "singular_name" => __( "Категория костюма", "custom-post-type-ui" ),
    ];


    $args = [
        "label" => __( "Теги костюмов", "custom-post-type-ui" ),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => [ 'slug' => 'costume_tags', 'with_front' => true ],
        "show_admin_column" => false,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "costume_tags",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => false,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "costume_tags", [ "costume" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_costume_tags' );

function cptui_register_my_taxes_costume_rent() {

    /**
     * Taxonomy: Категории аренды.
     */

    $labels = [
        "name" => __( "Категории аренды", "custom-post-type-ui" ),
        "singular_name" => __( "Аренда костюма", "custom-post-type-ui" ),
    ];


    $args = [
        "label" => __( "Категории аренды", "custom-post-type-ui" ),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => [ 'slug' => 'costume_rent', 'with_front' => true, ],
        "show_admin_column" => false,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "costume_rent",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "show_in_quick_edit" => false,
        "show_in_graphql" => false,
    ];
    register_taxonomy( "costume_rent", [ "costume" ], $args );
}
add_action( 'init', 'cptui_register_my_taxes_costume_rent' );