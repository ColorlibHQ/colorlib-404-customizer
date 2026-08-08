<?php defined( 'ABSPATH' ) || exit; ?>
<div id="colorlib-notfound">
    <div class="colorlib-notfound-bg"></div>
    <div class="colorlib-notfound">
        <div class="colorlib-notfound-404">
            <h1 class="colorlib-heading">404</h1>
        </div>
        <h2 id="colorlib_404_customizer_page_heading" class="colorlib-heading"><?php echo wp_kses_post( cnfp_get_option( 'colorlib_404_customizer_page_heading' ) ); ?></h2>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="colorlib-home-btn"
           id="colorlib_404_customizer_button_text"><?php echo wp_kses_post( cnfp_get_option( 'colorlib_404_customizer_button_text' ) ); ?></a>

        <a href="<?php echo esc_url( cnfp_get_option( 'colorlib_404_customizer_contact_link' ) ); ?>"
           class="colorlib-contact-btn"><?php echo esc_html__( 'Contact us', 'colorlib-404-customizer' ); ?></a>
		<?php cnfp_social_links(); ?>
    </div>
    <p style="color:#fff;" class="colorlib-copyright"><span><?php esc_html_e( '404 Page Template designed by', 'colorlib-404-customizer' ); ?></span> <a href="https://colorlib.com/" style="color:#fff;" target="_blank" rel="noopener">Colorlib.</a></p>
</div>