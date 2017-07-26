<?php
include dirname(__FILE__) . '/includes/custom-theme-options.php';

        if( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {
    function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {

        global $post, $product;
        $output = '<div class="bw-woo-image"><div class="bw-woo-image-inner">';

        if ( has_post_thumbnail() ) {
            $output .= get_the_post_thumbnail( $post->ID, $size );
        }else{
            $output .= '<img src="' . BW_URI_ASSETS . 'img/empty/400x559.png" alt="">';
        }

        $output .= '</div>';
        $output .= '<ul class="bw-woo-buttons">';

        if( $product->price and $product->is_in_stock() and $product->product_type == 'simple' ) {
            $output .= '<li data-product_id="' . $product->get_id() . '" class="add_to_cart_button ajax_add_to_cart bw-woo-button-cart' . ( Bw_woo::is_product_in_cart( $product->get_id() ) ? ' added' : '' ) . '"><img src="' . BW_URI_ASSETS . 'img/cart_white.png" alt=""></li>';
        }

        if( Bw_woo::wishlist_active_plugin() ) {
            $output .= '<li data-product-type="simple" data-product-id="' . $product->get_id() . '" class="add_to_wishlist bw-woo-button-wishlist' . ( Bw_woo::is_product_in_wishlist( $product->get_id() ) ? ' added' : '' ) . '"><img src="' . BW_URI_ASSETS . 'img/wishlist_white.png" alt=""></li>';
        }

        $output .= '</ul>';

        $output .= '</div>';

        if( Bw::get_option('enable_ql')) {
            $output .= '<span class="bw-quick-look" data-modal="bw-modal-quick-look" data-product_id="' . $product->get_id() . '">' . esc_html__('Quick look', 'midnight') . '</span>';
        }
        else
            $output .= '<span class="link-product">'. esc_html__('View product','midnight-child') .'</span>';

        $average = $product->get_average_rating();
        if( $average ) {
            $output .= '<div class="product-rating">'.
                '<div class="star-rating" title="' . sprintf( esc_html__( 'Rated %s out of 5', 'woocommerce' ), $average ) . '">'.
                '<span style="width:' . ( ( $average / 5 ) * 100 ) . '%">'.
                '<strong itemprop="ratingValue" class="rating">' . $average . '</strong> ' . esc_html__( 'out of 5', 'woocommerce' ).
                '</span>'.
                '</div>'.
                '</div>';
        }

        return $output;
    }
}

add_filter('woocommerce_product_tabs', 'woocommerce_remove_reviews_tab', 98);
function woocommerce_remove_reviews_tab($tabs) {
    unset( $tabs['description'] );
    return $tabs;
}


add_action('after_setup_theme','loadParentClass',99);
function loadParentClass(){
    require dirname(__FILE__).'/includes/custom_theme.php';
    require dirname(__FILE__).'/includes/custom_theme_ajax.php';
    require dirname(__FILE__).'/includes/custom_page_builder.php';
    Bw_custom_theme::init();
    Bw_custom_theme_ajax::init();
    Bw_custom_page_builder::init();
}

add_action( 'wp_enqueue_scripts', 'custom_enqueue_styles',99 );
function custom_enqueue_styles() {
    wp_enqueue_script( 'custom-script', get_stylesheet_directory_uri() .'/js/custom.js',array('jquery'),'1.0', true);

    wp_dequeue_script( 'bw-main' );
    wp_deregister_script( 'bw-main' );

    wp_register_script( 'bw-main', get_stylesheet_directory_uri() . '/js/main.js', array('jquery', 'bw-vendors'),'1.0',true);
    wp_enqueue_script('bw-main');

    wp_dequeue_style( 'style' );
    wp_deregister_style( 'style' );
    //wp_dequeue_style( 'bw-media' );
    //wp_deregister_style( 'bw-media' );

   // wp_register_style( 'bw-media', get_template_directory_uri() . '/assets/css/media.css',array(),1.0,true);
    wp_register_style( 'style', get_stylesheet_directory_uri() . '/style.css',array('bw-style','bw-media'),'1.0');
    //wp_enqueue_style( 'bw-media' );
    wp_enqueue_style( 'style' );
   // wp_enqueue_style('style',get_stylesheet_directory_uri().'/style.css',array(),1.0,true);
}

remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
?>