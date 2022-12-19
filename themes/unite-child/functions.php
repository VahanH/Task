<?php 
	 add_action( 'wp_enqueue_scripts', 'unite_child_enqueue_styles' );
	 function unite_child_enqueue_styles() {
 		  wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); 
     }

/**
 *
 *
 * Custom Post Types And Taxonomies
 *
 */
function register_custom_post_types_and_taxes()
{

    /**
     * Post Type: Недвижимость.
     */

    $labels = [
        "name" => esc_html__("Недвижимость", "unite"),
        "singular_name" => esc_html__("Недвижимость", "unite"),
    ];

    $args = [
        "label" => esc_html__("Недвижимость", "unite"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "rest_namespace" => "wp/v2",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => true,
        "can_export" => false,
        "rewrite" => ["slug" => "nedvizhimost", "with_front" => true],
        "query_var" => true,
        "supports" => ["title", "editor", "thumbnail", "custom-fields", "page-attributes"],
        "show_in_graphql" => false,
    ];

    register_post_type("nedvizhimost", $args);

    /**
     * Post Type: Агентство.
     */

    $labels = [
        "name" => esc_html__("Агентство", "unite"),
        "singular_name" => esc_html__("Агентство", "unite"),
    ];

    $args = [
        "label" => esc_html__("Агентство", "unite"),
        "labels" => $labels,
        "description" => "",
        "public" => true,
        "publicly_queryable" => true,
        "show_ui" => true,
        "show_in_rest" => true,
        "rest_base" => "",
        "rest_controller_class" => "WP_REST_Posts_Controller",
        "rest_namespace" => "wp/v2",
        "has_archive" => false,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "delete_with_user" => false,
        "exclude_from_search" => false,
        "capability_type" => "post",
        "map_meta_cap" => true,
        "hierarchical" => true,
        "can_export" => false,
        "rewrite" => ["slug" => "agentstvo", "with_front" => true],
        "query_var" => true,
        "supports" => ["title", "editor", "thumbnail", "custom-fields", "page-attributes"],
        "taxonomies" => ["tip_nedvizhimosti"],
        "show_in_graphql" => false,
    ];

    register_post_type("agentstvo", $args);


    /**
     * Taxonomy: Тип недвижимости.
     */

    $labels = [
        "name" => esc_html__("Тип недвижимости", "unite"),
        "singular_name" => esc_html__("Тип недвижимости", "unite"),
    ];


    $args = [
        "label" => esc_html__("Тип недвижимости", "unite"),
        "labels" => $labels,
        "public" => true,
        "publicly_queryable" => true,
        "hierarchical" => true,
        "show_ui" => true,
        "show_in_menu" => true,
        "show_in_nav_menus" => true,
        "query_var" => true,
        "rewrite" => ['slug' => 'tip_nedvizhimosti', 'with_front' => true,],
        "show_admin_column" => false,
        "show_in_rest" => true,
        "show_tagcloud" => false,
        "rest_base" => "tip_nedvizhimosti",
        "rest_controller_class" => "WP_REST_Terms_Controller",
        "rest_namespace" => "wp/v2",
        "show_in_quick_edit" => false,
        "sort" => false,
        "show_in_graphql" => false,
    ];
    register_taxonomy("tip_nedvizhimosti", ["nedvizhimost"], $args);

        /**
         * Taxonomy: Лист Агентств.
         */

        $labels = [
            "name" => esc_html__( "Лист Агентств", "unite" ),
            "singular_name" => esc_html__( "Лист Агентств", "unite" ),
        ];


        $args = [
            "label" => esc_html__( "Лист Агентств", "unite" ),
            "labels" => $labels,
            "public" => true,
            "publicly_queryable" => true,
            "hierarchical" => true,
            "show_ui" => true,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "query_var" => true,
            "rewrite" => [ 'slug' => 'list_agency', 'with_front' => true,  'hierarchical' => true, ],
            "show_admin_column" => false,
            "show_in_rest" => true,
            "show_tagcloud" => false,
            "rest_base" => "list_agency",
            "rest_controller_class" => "WP_REST_Terms_Controller",
            "rest_namespace" => "wp/v2",
            "show_in_quick_edit" => false,
            "sort" => false,
            "show_in_graphql" => false,
        ];
        register_taxonomy( "list_agency", [ "nedvizhimost", "agentstvo" ], $args );
}

add_action( 'init', 'register_custom_post_types_and_taxes' );
