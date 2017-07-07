(function($){

    "use strict";
    var top_bar_top 	= '50px';
    var header_H 		= 0;

    function adminBarH(){
        var height = 0;

        // WP adminbar
        if( $( 'body' ).hasClass( 'admin-bar' ) ){
            height += $( '#wpadminbar' ).innerHeight();
        }

        // WC demo store
        if( $( 'body' ).hasClass( 'woocommerce-demo-store' ) ){
            height += $( 'body > p.demo_store' ).innerHeight();
        }

        return height;
    }

    function set_sticky(){
        if( $( 'body' ).hasClass( 'sticky-header' ) ){
            if( ( $(window).width() >= 768 ) ){
                var start_y = header_H;
                var window_y = $(window).scrollTop();

                if( window_y > start_y ){

                    if( ! ( $( '.bw-header' ).hasClass( 'enable-sticky' ) ) ){

                        $( '.bw-header' )
                            .addClass( 'enable-sticky' )
                            .css( 'top', -60 )
                            .animate({
                                'top': adminBarH() + 'px'
                            }, 300 );

                        // Header width
                       // mfn_header();
                    }

                } else {

                    if( $( '.bw-header' ).hasClass( 'enable-sticky' ) ){

                        $( '.bw-header' )
                            .removeClass( 'enable-sticky' )
                            .css( 'top', top_bar_top );

                        // Header width
                       // mfn_header();
                    }
                }
            }
        }
    }

    function set_stickyH(){
        // default: $( '.bw-header' ).innerHeight() + $( '.top_bar' ).innerHeight();
        header_H =  $( '.top_bar' ).innerHeight();

    }

    $(document).ready(function() {

        top_bar_top = parseInt($('.bw-header').css('top'), 10);
        if (top_bar_top < 0) top_bar_top = 51;
        top_bar_top = top_bar_top + 'px';

        set_stickyH();

        set_sticky();

    });

    $(window).scroll(function(){

        set_sticky();

    });
})(jQuery);