<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$default_shop_layout = Bw::get_option('shop_default_layout');

// overwrite default layout
$queried_object = get_queried_object();
if( is_object( $queried_object ) and ! is_shop() ) {
    $archive_shop_layout = get_field('layout', $queried_object);
    echo $archive_shop_layout;
    if( ! empty( $archive_shop_layout ) and $archive_shop_layout !== 'default' ) { $default_shop_layout = $archive_shop_layout; }
}

// overwrite layout with page template settings.
global $bw_page_id;
if( $bw_page_id ) {
    $page_shop_layout = Bw::get_meta('layout', $bw_page_id);
    if( ! empty( $page_shop_layout ) and $page_shop_layout !== 'default' ) {
        $default_shop_layout = $page_shop_layout;
    }
}

$product_layout = ( ( $default_shop_layout == 'boxed_list_right_sidebar' or $default_shop_layout == 'boxed_list_left_sidebar' ) and ( is_shop() or is_product_category() ) ) ? 'product-list' : 'product-standard';
wc_get_template_part( 'content', $product_layout );