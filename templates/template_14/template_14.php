<?php defined( 'ABSPATH' ) || exit; ?>
<div id="colorlib-notfound">
    <div class="colorlib-notfound">
        <div class="colorlib-notfound-bg">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <h1 id="colorlib_404_customizer_page_heading" class="colorlib-heading"><?php echo wp_kses_post( cnfp_get_option( 'colorlib_404_customizer_page_heading' ) ); ?></h1>
        <h2 id="colorlib_404_customizer_content" class="colorlib-heading"><?php echo wp_kses_post( cnfp_get_option( 'colorlib_404_customizer_content' ) ); ?></h2>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
           id="colorlib_404_customizer_button_text"><?php echo wp_kses_post( cnfp_get_option( 'colorlib_404_customizer_button_text' ) ); ?></a>
		<?php cnfp_social_links(); ?>
    </div>
    <p class="colorlib-copyright"><span><?php esc_html_e( '404 Page Template designed by', 'colorlib-404-customizer' ); ?></span> <a href="https://colorlib.com/" target="_blank" rel="noopener">Colorlib.</a></p>
</div>

