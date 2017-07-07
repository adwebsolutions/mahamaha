<?php
/**
 * Created by PhpStorm.
 * User: yailet
 * Date: 01-Jul-17
 * Time: 12:48 AM
 */
if ( class_exists( 'Bw_page_builder' ) ) {
    class Bw_custom_page_builder extends Bw_page_builder
    {

        static $modules = array(
            'theme_featured_cat_products_slider',
        );

        static function init() {

            // don't load if page builder is not enabled.
            // TODO

            if( class_exists( 'Bwpb_map' ) ) {

                self::$shop_filter = array(
                    array(
                        'type' => 'select',
                        'fields' => array(
                            'latest' => 'Latest products',
                            'featured' => 'Featured products',
                            'latest_by_cat' => 'Latest products from a category',
                            'top_rating' => 'Top rated products',
                            'best_sellers' => 'Best selling products',
                            'new_badge' => 'New products',
                            'sale' => 'On sale',
                        ),
                        'param_name' => 'source',
                        'heading' => esc_html__( 'Post source', 'midnight' ),
                        'description' => 'Select what type of posts to be displayed.',
                    ),
                    /* latest posts from a category */
                    array(
                        'type' => 'taxonomies',
                        'heading' => esc_html__( 'Category', 'midnight' ),
                        'param_name' => 'category',
                        'description' => esc_html__( 'Hold down Command key (or CTRL on Windows) to select multiple categories.', 'midnight' ),
                        'tx_type' => 'product_cat',
                        'allow_empty' => true,
                        'multiple' => true,
                        'dependency' => array( 'element' => 'source', 'value' => 'latest_by_cat' ),
                    ),
                );

                // modules
                foreach( self::$modules as $module ) {
                    if( is_admin() ) {
                        add_action( 'admin_init', array( 'Bw_custom_page_builder', $module ) );
                    }else{
                        if( method_exists( 'Bwpb_shortcode_definition', 'the_shortcode' ) ) {
                            Bwpb_shortcode_definition::the_shortcode( $module, array( 'Bw_custom_page_builder', "pb_shortcode_{$module}" ) );
                        }
                    }
                }

                add_action( 'after_setup_theme', array( 'Bw_custom_page_builder' ) );
            }
        }

        static function theme_featured_cat_products_slider()
        {
            Bwpb_map::map(array(
                'name' => esc_html__('Featured cat products slider', 'midnight'),
                'base' => 'theme_featured_cat_products_slider',
                'icon' => 'bwpb-icon-theme-slider-prod',
                'open_settings_on_create' => true,
                'category' => esc_html__('Theme', 'midnight'),
                'params' => array(
                    array(
                        'type' => 'taxonomies',
                        'heading' => esc_html__('Category', 'midnight'),
                        'param_name' => 'category',
                        'description' => esc_html__('Hold down Command key (or CTRL on Windows) to select multiple categories.', 'midnight'),
                        'tx_type' => 'product_cat',
                        'allow_empty' => true,
                        'multiple' => true,
                    ),
                    array(
                        'type' => 'true_false',
                        'heading' => esc_html__('Featured', 'midnight'),
                        'param_name' => 'featured',
                        'value' => '1',
                        'width' => 50,
                    ),
                    array(
                        'type' => 'true_false',
                        'heading' => esc_html__('On sale', 'midnight'),
                        'param_name' => 'sale',
                        'width' => 50,
                    ),
                    array(
                        'type' => 'true_false',
                        'heading' => esc_html__('Best sellers', 'midnight'),
                        'param_name' => 'best_sellers',
                        'width' => 50,
                    ),
                    array(
                        'type' => 'true_false',
                        'heading' => esc_html__('New', 'midnight'),
                        'param_name' => 'new',
                        'width' => 50,
                    ),
                    array(
                        'type' => 'true_false',
                        'heading' => esc_html__('New with badge', 'midnight'),
                        'param_name' => 'new_badge',
                    ),
                    array(
                        'type' => 'true_false',
                        'heading' => esc_html__('Enable autoplay', 'midnight'),
                        'param_name' => 'autoplay',
                        'width' => 50,
                    ),
                    array(
                        'type' => 'true_false',
                        'heading' => esc_html__('Enable navigation', 'midnight'),
                        'param_name' => 'navigation',
                        'width' => 50,
                    ),
                    array(
                        'type' => 'number_slider',
                        'heading' => esc_html__('Number of products per category', 'midnight'),
                        'param_name' => 'number_of_posts',
                        'min' => 3,
                        'max' => 20,
                        'step' => 1,
                        'value' => 8,
                        'append_before' => '',
                        'append_after' => 'products.',
                    ),
                    array(
                        'type' => 'number_slider',
                        'heading' => esc_html__('Items per slide', 'midnight'),
                        'param_name' => 'items_per_row',
                        'min' => 3,
                        'max' => 6,
                        'step' => 1,
                        'value' => 4,
                        'append_before' => '',
                        'append_after' => 'products.',
                    ),
                    array(
                        'type' => 'textfield',
                        'param_name' => 'class'
                    )
                ),
            ));

        }

        static function pb_shortcode_theme_featured_cat_products_slider($atts, $content)
        {
            extract(shortcode_atts(array(
                'category' => '',
                'featured' => false,
                'best_sellers' => false,
                'sale' => false,
                'new' => false,
                'new_badge' => false,
                'autoplay' => false,
                'navigation' => false,
                'number_of_posts' => 4,
                'items_per_row' => 4,
                'class' => '',
            ), $atts));

            $tabs = array();
            if (!empty($category)) {
                $cat_temp = explode(',', $category);

                foreach ( $cat_temp as $cat => $value){

                    $temp = get_term_by('id',$value,'product_cat');
                    $tabs[$temp->slug] = esc_html__($temp->name);
                }
            }


            $params  = ($featured) ? 'featured ' : '';
            $params .= ($best_sellers) ? 'best_sellers ' : '';
            $params .= ($sale) ? 'sale ' : '';
            $params .= ($new) ? 'new ' : '';
            $params .= ($new_badge) ? 'new_badge ' : '';

            $slider_data = ' data-slides="' . (int)$items_per_row . '"';
            $slider_data .= $autoplay ? ' data-autoplay' : '';
            $slider_data .= $navigation ? ' data-navigation' : '';

            ob_start();

            echo '<div class="bw-featured-cat-products bw-cols-' . (int)$items_per_row . '" data-items_per_row="' . (int)$items_per_row . '" data-number_of_posts="' . (int)$number_of_posts . '" data-param="' . $params .'">';

            if (count($tabs) > 1) {

                echo '<ul class="bw-featured-cat-tabs bw-no-select">';

                $c = 0;
                global $woocommerce_loop;
                $woocommerce_loop['columns'] = (int)$items_per_row;


                foreach ($tabs as $tab => $label) {
                    if($c == 0) $cat_activa = $tab;
                    echo "<li data-tab='{$tab}' " . ($c == 0 ? 'class="bw-active"' : '') . ">{$label}</li>";
                    $c++;
                }
                echo '</ul>';
            }

            require(get_stylesheet_directory() . '/templates/query-custom-products.php');

            if ($output->have_posts()) {
                echo "<div class='woocommerce bw-row'>";
                echo "<ul class='bw-slider bw-featured-slider products'" . $slider_data . ">";
                while ($output->have_posts()) {
                    $output->the_post();
                    wc_get_template_part('content', 'product');
                }
                echo "</ul>";
                echo "</div>";
            }
            wp_reset_postdata();

            echo '</div>';

            return ob_get_clean();

        }
    }
}

