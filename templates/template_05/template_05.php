<?php defined( 'ABSPATH' ) || exit; ?>
<div id="colorlib-notfound">
    <div class="colorlib-notfound">
        <div class="colorlib-notfound-404">
            <h1>404</h1>
        </div>
        <h2 id="colorlib_404_customizer_page_heading"><?php echo wp_kses_post( cnfp_get_option( 'colorlib_404_customizer_page_heading' ) ); ?></h2>
        <form class="colorlib-notfound-search" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search"
              method="get">
            <input type="search" placeholder="<?php echo esc_attr__( 'Search...', 'colorlib-404-customizer' ); ?>"
                   value="<?php echo esc_attr( get_search_query( false ) ); ?>" name="s">
            <button type="submit"><?php echo esc_html__( 'Search', 'colorlib-404-customizer' ); ?></button>
        </form>
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><span class="arrow"></span><span
                    id="colorlib_404_customizer_button_text"><?php echo wp_kses_post( cnfp_get_option( 'colorlib_404_customizer_button_text' ) ); ?></span></a>
    </div>
    <p class="colorlib-copyright""><span><?php esc_html_e( '404 Page Template designed by', 'colorlib-404-customizer' ); ?></span> <a href="https://colorlib.com/" target="_blank" rel="noopener">Colorlib.</a></p>
</div>


