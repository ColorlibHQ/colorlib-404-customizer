<?php $cnfp_options = get_option( 'cnfp_settings' ); ?>
<div id="colorlib-notfound">
    <div class="colorlib-notfound">
        <div class="colorlib-notfound-404">
            <h1>404</h1>
            <h2 id="colorlib_404_customizer_page_heading"><?php echo wp_kses_post( $cnfp_options['colorlib_404_customizer_page_heading'] ); ?></h2>
        </div>
        <a href="<?php echo esc_url(get_home_url()); ?>"
           id="colorlib_404_customizer_button_text"><?php echo wp_kses_post( $cnfp_options['colorlib_404_customizer_button_text'] ); ?></a>
    </div>
    <p style="color:#fff" class="colorlib-copyright"><span><?php _e( '404 Page Template designed by','colorlib-404-customizer' ); ?></span> <a href="https://colorlib.com/" style="color:#fff;" target="_blank">Colorlib.</a></p>
</div>
