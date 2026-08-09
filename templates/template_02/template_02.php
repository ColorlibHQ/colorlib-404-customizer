<?php defined( 'ABSPATH' ) || exit; ?>
<div id="colorlib-notfound">
    <div class="colorlib-notfound">
        <div class="colorlib-notfound-404">
            <h1>4<span>0</span>4</h1>
        </div>
        <h2 id="colorlib_404_customizer_page_heading"><?php echo wp_kses_post( cnfp_get_option( 'colorlib_404_customizer_page_heading' ) ); ?></h2>
        <form class="colorlib-notfound-search" action="<?php echo esc_url( home_url( '/' ) ); ?>" role="search"
              method="get">
            <input type="search" name="s" placeholder="<?php esc_attr_e( 'Search...', 'colorlib-404-customizer' ); ?>">
            <button type="submit"><span></span></button>
        </form>
    </div>
    <p class="colorlib-copyright"><span><?php esc_html_e( '404 Page Template designed by', 'colorlib-404-customizer' ); ?></span> <a href="https://colorlib.com/" target="_blank" rel="noopener">Colorlib.</a></p>
</div>
