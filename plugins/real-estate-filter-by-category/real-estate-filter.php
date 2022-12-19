<?php
/*
Plugin Name: Real estate filter by category
Plugin URI: https://vahanius.ru
Description: This plugin adds a filter to posts by category
Version: 1.0
Author: Vahan Hakobyan
Author URI: https://vahanius.com
*/

include(plugin_dir_path(__FILE__) . '/widget/ref-widget.php');
add_action('wp_enqueue_scripts', 'ref_jquery_scripts');

function ref_jquery_scripts()
{
    wp_enqueue_script('jquery');
    wp_register_script('scripts', plugins_url('/assets/js/scripts.js', __FILE__), array('jquery'), true);
    wp_localize_script('scripts', 'ref_obj', array('ajaxurl' => admin_url('admin-ajax.php')));
    wp_enqueue_script('scripts');
    wp_register_style('ref-styles', plugins_url('/assets/css/style.css',__FILE__ ));
    wp_enqueue_style('ref-styles');
}

/**
 * Ajax Callback
 */

add_action('wp_ajax_ref_filter', 'ref_filter_function');
add_action('wp_ajax_nopriv_ref_filter', 'ref_filter_function');

function ref_filter_function()
{
    if (isset($_POST['tax'])) {
        $args['tax_query'] = array(
            'post_type' => 'nedvizhimost',
            'orderby' => 'date',
            array(
                'taxonomy' => 'list_agency',
                'field' => 'slug',
                'terms' => $_POST['tax']
            )
        );
    }else{
        echo 'Parameter error';
        wp_die();
    }
    $filtred_posts = 'posts_in_'.$_POST['tax'];
    $posts = new WP_Query($args);
    set_transient( $filtred_posts, $posts, 2 * HOUR_IN_SECONDS );
    $res = '';
    if ($posts->have_posts()) :
        while ($posts->have_posts()) : $posts->the_post();
                $res .= '<article id="post-'.get_the_ID().'" class="real-estate-item"><a href="' . get_the_permalink() . '">';
            if (has_post_thumbnail()) {
                $res .= '<div class="featured-image"><img src="'.get_the_post_thumbnail_url().'" alt=""></div>';
            }
                $res .= '<div class="info-price"></div>
                            <div class="meta">
                               <h3 class="info-title">'.get_the_title().'</h3>
                               <div class="info-sizes">';
                               $area = get_field( "area" );
                               if( $area ) {
                $res .='<div class="info-size"><img src="'. get_stylesheet_directory_uri().'/assets/img/size.svg" alt="">'. $area . ' м²</div>';
                               }
                               $living_area = get_field( "living_area" );
                               if( $living_area ) {
                $res.='<div class="info-livesize"><img src="'.get_stylesheet_directory_uri().'/assets/img/live-size.svg" alt="">'.$living_area . ' м²</div>';
                               }
                               $floor = get_field( "floor" );
                               if( $floor ) {
                $res.='<div class="info-floor"><img src="'.get_stylesheet_directory_uri().'/assets/img/floor.svg" alt="">'.$floor.'</div>';};
                $res.='</div>';
                               $address = get_field( "address" );
                               if( $address ) {
                $res.='<div class="info-address"><img src="'.get_stylesheet_directory_uri().'/assets/img/location.svg" alt="">'.$address.'</div>';
                               }
                                $price = get_field( "price" );
                                if( $price ) {
                $res.='<div class="info-price"><img src="'.get_stylesheet_directory_uri().'/assets/img/price.svg" alt="">$' . number_format($price).'</div>';
                                }
                $res.='</div></a></article>';
            endwhile;
            endif;
            echo $res;
        wp_die();
    }
