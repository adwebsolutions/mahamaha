<?php $woo_active = Bw_woo::woo_active_plugin(); ?>
<?php if( $woo_active ): ?>
    <div class="bw-setting-icon bw-cell bw-shopcart">
        <a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>">
            <?php $cart_contents_count = WC()->cart->cart_contents_count; ?>
            <?php if( (int)$cart_contents_count > 0 ): ?><sub class="bw-round animated"><?php echo (int)$cart_contents_count; ?></sub><?php endif; ?>
        </a>
<?php if(is_front_page()):?>
        <img src="<?php echo BW_URI_ASSETS . 'img/cart_white.png'; ?>" alt="">
<?php else: ?>
        <img src="<?php echo get_stylesheet_directory_uri(). '/img/cart_green_ico.png'; ?>" alt="">
<?php endif;?>
        <div class="bw-top-prods-holder bw-top-prods-cart">
            <div class="bw-top-prods">
                <?php get_template_part( 'templates/header/cart' ); ?>
            </div>
        </div>
    </div>
<?php endif; ?>