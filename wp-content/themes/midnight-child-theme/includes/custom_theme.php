<?php

if ( class_exists( 'Bw_theme' ) ) {
    class Bw_custom_theme extends Bw_theme
    {

        static $theme_main_color = '#29B473';
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
            self::enqueue_custom_assets();
        }

        static function enqueue_custom_assets() {

            # css
            //wp_deregister_style('bw-media-css');
            //wp_deregister_style('style');
           // wp_deregister_style('bw-style');
           // wp_deregister_style('bw-reset');

           // Bw_assets::addStyle('bw-reset', 'assets/css/reset.css');
          //  Bw_assets::addStyle('bw-style', 'assets/css/style.css');
         //   Bw_assets::addStyle('bw-media', 'assets/css/media.css');
           // add_action( 'wp_enqueue_scripts', array( 'Bw_assets', 'register_assets' ) );
          //  Bw_assets::addStyle('style', 'style.css');

        }
    }
}