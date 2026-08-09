<?php defined( 'ABSPATH' ) || exit; ?>
<div id="colorlib-notfound">
    <div class="colorlib-notfound">
        <div>
            <div class="colorlib-notfound-404">
                <h1>!</h1>
            </div>
            <h2>Error<br>404</h2>
        </div>
        <p id="colorlib_404_customizer_content"><?php echo wp_kses_post( cnfp_get_option( 'colorlib_404_customizer_content' ) ); ?>
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
               id="colorlib_404_customizer_button_text"><?php echo wp_kses_post( cnfp_get_option( 'colorlib_404_customizer_button_text' ) ); ?></a>
        </p>
    </div>
    <p class="colorlib-copyright"><span><?php esc_html_e( '404 Page Template designed by', 'colorlib-404-customizer' ); ?></span> <a href="https://colorlib.com/" target="_blank" rel="noopener">Colorlib.</a></p>
</div>

