<?php

if ( class_exists( 'Bw_theme' ) ) {
    class Bw_custom_theme extends Bw_theme
    {

        static $theme_main_color = '#b99867';
        static $theme_styles;

        static function init()
        {
            # main components
            if (!is_admin()) {
                add_action('after_setup_theme', array('Bw_custom_theme', 'components'));
            } // hook init
            # add list of thumbnails
            //self::add_thumbs();
        }

        static function components()
        {
            wc_print_notice('Entre aqui');
            self::enqueue_custom_assets();
        }

        static function enqueue_custom_assets()
        {

        }
    }
}