<?php $cnfp_options = get_option( 'cnfp_settings' ); ?>
<div id="colorlib-notfound">
    <div class="colorlib-notfound">
        <div class="colorlib-notfound-404">
            <h1>4<span></span>4</h1>
        </div>
        <h2 id="colorlib_404_customizer_page_heading"><?php echo wp_kses_post( $cnfp_options['colorlib_404_customizer_page_heading'] ); ?></h2>
        <p id="colorlib_404_customizer_content"><?php echo wp_kses_post( $cnfp_options['colorlib_404_customizer_content'] ); ?></p>
        <a href="<?php echo esc_url(get_home_url()); ?>"
           id="colorlib_404_customizer_button_text"><?php echo wp_kses_post( $cnfp_options['colorlib_404_customizer_button_text'] ); ?></a>
    </div>
    <p class="colorlib-copyright"><span><?php _e( '404 Page Template designed by','colorlib-404-customizer' ); ?></span> <a href="https://colorlib.com/" target="_blank">Colorlib.</a></p>
</div>
