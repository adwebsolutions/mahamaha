<?php
if ( class_exists( 'Bw_theme_ajax' ) ) {
    class Bw_custom_theme_ajax extends Bw_theme_ajax
    {

        static $funcs = array(
            '__call_featured_cat_products',
        );

        static function init()
        {

            # localize script
            add_action('wp_footer', array('Bw_custom_theme_ajax', 'bw_ajax'));

            self::alocate_callbacks();

        }

        static function bw_ajax()
        {

            wp_localize_script('bw-main', 'bw_theme_ajax', array(
                'ajax' => admin_url('admin-ajax.php'),
                'ismobile' => wp_is_mobile(),
                'home' => home_url(),
                'uri_assets' => BW_URI_ASSETS,
                'nonce' => wp_create_nonce('ajax-nonce')
            ));

        }

        static function alocate_callbacks()
        {

            foreach (self::$funcs as $func) {

                add_action('wp_ajax_nopriv_' . $func, array('Bw_custom_theme_ajax', $func));
                add_action('wp_ajax_' . $func, array('Bw_custom_theme_ajax', $func));

            }
        }

        static function __call_featured_cat_products()
        {
            $number_of_posts = (int)$_POST['number_of_posts'];
            $items_per_row = (int)$_POST['items_per_row'];
            $cat_activa = esc_attr(str_replace('tab_', '', $_POST['tab']));
            $params = isset($_POST['params']) ? esc_attr($_POST['params']) : "";

            require(get_stylesheet_directory() . '/templates/query-custom-products.php');

            if ($output->have_posts()) {

                global $woocommerce_loop;
                $woocommerce_loop['columns'] = $items_per_row;

                while ($output->have_posts()) {
                    $output->the_post();
                    wc_get_template_part('content', 'product');
                }

            }
            wp_reset_postdata();
            exit;

        }

    }
}