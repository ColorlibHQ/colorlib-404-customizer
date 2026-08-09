<?php defined( 'ABSPATH' ) || exit; ?>
<div id="colorlib-notfound">
    <div class="colorlib-notfound">
        <div class="colorlib-notfound-404">
            <h1>4<span>0</span>4</h1>
        </div>
        <p id="colorlib_404_customizer_page_heading"><?php echo wp_kses_post( cnfp_get_option( 'colorlib_404_customizer_page_heading' ) ); ?></p>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
           id="colorlib_404_customizer_button_text"><?php echo wp_kses_post( cnfp_get_option( 'colorlib_404_customizer_button_text' ) ); ?></a>
    </div>
    <p style="color:#fff;" class="colorlib-copyright"><span><?php esc_html_e( '404 Page Template designed by', 'colorlib-404-customizer' ); ?></span> <a href="https://colorlib.com/" style="color:#fff;" target="_blank" rel="noopener">Colorlib.</a></p>
</div>

