<?php
$nsl = Bw::get_option('newsletter');
if( $nsl and ! wp_is_mobile() ) {
    $nsl_page = Bw::get_option('newsletter_page'); ?>
        <?php
        $nsl_once = Bw::get_option('newsletter_once');
        $nsl_once_class = $nsl_once ? ' bw-show-once' : '';
        $nsl_bg = Bw::get_option('newsletter_bg');
        $nsl_content = Bw::get_option('newsletter_content');
        $nls_style  = '';
        $nls_style .= ! empty( $nsl_bg ) ? 'background-image:url(' . esc_url( $nsl_bg ) . ');' : '';
        $nsl_trigger = ! ( $nsl_page > 0 and $nsl_page == get_the_ID() ) ? ' bw-dont-trigger' : '';
        ?>
        <div id="bw-nsl" class="bw-modal<?php echo $nsl_trigger . $nsl_once_class; ?>" style="<?php echo $nls_style; ?>">
            <?php echo do_shortcode( Bw::get_option( 'newsletter_content' ) ); ?>
            <span class="bw-modal-close"></span>
        </div>
    <?php
}
