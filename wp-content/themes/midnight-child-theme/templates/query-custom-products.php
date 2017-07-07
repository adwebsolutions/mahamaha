<?php
$query_post_type = isset( $query_post_type ) ? $query_post_type : 'post';
$params = isset( $params) ? $params : '';
$cat_activa = isset($cat_activa) ?  $cat_activa : '';
$query_tax = isset( $query_tax ) ? $query_tax : array();
$number_of_posts = isset( $number_of_posts ) ? $number_of_posts : get_option('posts_per_page');
$query_require_img = isset( $query_require_img ) ? $query_require_img : false;
$query_offset = ( isset( $number_of_posts ) and Bw::current_page() > 1 ) ? ( ( Bw::current_page() - 1 ) * $number_of_posts ) : 0;

$post_args = array(
    'post_type'             => 'product',
    'posts_per_page'        => $number_of_posts,
    'offset'		        => $query_offset,
    'post_status'           => 'publish',
    'ignore_sticky_posts'   => true,
    'meta_query' 	        => array(),
    'tax_query'             => $query_tax
);
if (!empty($cat_activa)) {
    $quary_raw['tax_query'] = array(
        array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => array($cat_activa)
        )
    );
}
if (isset($params)):
    $params = explode(" ",$params);
    foreach ($params as $p => $v):
        if ($v == 'featured'){
            $post_args['meta_query'] = array(
                'relation' => 'AND',
                array(
                    'key' => '_featured',
                    'value' => 'yes',
                    'compare' => '='
                )
            );
        }
        if ($v == 'sale'){
            $array_sale = array(array(
                    'key' => '_sale_price',
                    'value' => 0,
                    'compare' => '>'
            ));
            if(!empty($post_args['meta_query'])){
                $temp_array = array_merge($post_args['meta_query'],$array_sale);
                $post_args['meta_query'] = $temp_array;
            }
            else {
                $post_args['meta_query'] = $array_sale;
            }
        }
        if ($v == 'new_badge'){
            $array_new = array(array(
                    'key' => 'is_new',
                    'value' => '1',
                    'compare' => '='
            ));
            if(!empty($post_args['meta_query'])){
                $temp_array = array_merge($post_args['meta_query'],$array_new);
                $post_args['meta_query'] = $temp_array;
            }
            else {
                $post_args['meta_query'] = $array_new;
            }
        }
        if ($v == 'best_sellers'){
            $post_args['meta_key'] = 'total_sales';
            $post_args['orderby'] = 'meta_value_num';
        }
        if ( $v== 'new') {
            $post_args['order'] = 'DESC';
            $post_args['orderby'] = 'date';
            break;
        }
    endforeach;
endif;

if( $query_require_img ) {
    $post_args['meta_query'][] = array(
        'key' => '_thumbnail_id',
        'compare' => 'EXISTS'
    );
}

if( isset( $quary_raw ) ) {
    $post_args = array_merge( $post_args, $quary_raw );
}

global $post;

$output = new WP_Query( $post_args );
